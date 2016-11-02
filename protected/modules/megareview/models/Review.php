<?php

/**
 * This is the model class for table "{{megareview_review}}".
 *
 * The followings are the available columns in table '{{megareview_review}}':
 * @property integer $id
 * @property integer $id_mega_user
 * @property integer $moderation_status
 * @property integer $review_target
 * @property string $rating
 * @property string $text
 * @property string $date_add
 * @property integer $has_audio
 * @property string $audio_file
 * @property integer $has_video
 * @property string $video_file
 * @property string $video_preview
 */
class Review extends yupe\models\YModel
{
    static public $MODERATION_ON = 0;
    static public $MODERATION_SUCCESS = 1;
    static public $MODERATION_FAILED = 2;

    static public function getStatuses()
    {
        return [self::$MODERATION_ON => "На модерации", self::$MODERATION_FAILED => "Не прошел модерацию", self::$MODERATION_SUCCESS => "Прошел модерацию"];
    }

    private static $_targets = null;

    public static function getAllTargets()
    {
        if (self::$_targets === null) {
            $result = [];
            $result[-1] = "Общий отзыв";
            $products = Product::model()->findAll();
            foreach ($products as $item) {
                $result[$item->id] = $item->name;
            }
            self::$_targets = $result;
        }
        return self::$_targets;
    }

    public function getTargets()
    {
        return self::getAllTargets();
    }


    public static function getByProduct($idProduct, $onlyApproved = true)
    {
        $criteria = new CDbCriteria();
        $criteria->compare("review_target", $idProduct);
        if ($onlyApproved) {
            $criteria->compare("moderation_status", self::$MODERATION_SUCCESS);
        }
        $result = Review::model()->findAll($criteria);
        return $result;
    }

    public static function hasNonModerated($idProduct)
    {
        $idUser = Yii::app()->user->getId();
        if ($idUser <= 0)
            return false;
        $megauser = Megauser::model()->find("id_user = " . $idUser);
        if ($megauser == null)
            return false;

        $criteria = new CDbCriteria();
        $criteria->compare("review_target", $idProduct);
        $criteria->compare("id_mega_user", $megauser->id);
        $criteria->compare("moderation_status", self::$MODERATION_ON);
        return Review::model()->exists($criteria);
    }

    public static function getRating($idProduct, $onlyApproved = true)
    {
        $criteria = new CDbCriteria();
        $criteria->compare("review_target", $idProduct);
        if ($onlyApproved) {
            $criteria->compare("moderation_status", self::$MODERATION_SUCCESS);
        }
        $criteria->select = "AVG(rating) as rating";
        $review = Review::model()->find($criteria);
        return ($review->rating > 0 ? $review->rating : 4);
    }


    public function getUsers()
    {
        $result = [];
        $megausers = Megauser::model()->findAll();
        foreach ($megausers as $item) {
            $user = $item->getUser();
            if ($user != null)
                $result[$item->id] = $user->nick_name;
        }
        return $result;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{megareview_review}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('review_target, moderation_status, id_mega_user, has_audio, has_video', 'numerical', 'integerOnly' => true),
            array('rating', 'length', 'max' => 3),
            array('text', 'length', 'max' => 300),
            array('audio_file, video_file, video_preview', 'length', 'max' => 150),
            array('date_add', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('review_target, moderation_status, id, id_mega_user, rating, text, date_add, has_audio, audio_file, has_video, video_file, video_preview', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'megauser' => [self::BELONGS_TO, 'Megauser', 'id_mega_user'],
        );
    }

    public function behaviors()
    {
        return array(
            'upload' => array(
                'class' => 'yupe\components\behaviors\FileUploadBehavior',
                'scenarios' => array('insert', 'update'),
                'attributeName' => 'audio_file',
                'types' => "mp3",
                'maxSize' => 5368709120,
                'uploadPath' => "/upload/audio",
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'id_mega_user' => 'Пользователь (модуль "Отзывы")',
            'rating' => 'Оценка',
            'text' => 'Текст отзыва',
            'date_add' => 'Дата добавления',
            "review_target" => 'Цель отзыва',
            'moderation_status' => 'Статус модерации',
            'has_audio' => 'Имеется аудио',
            'audio_file' => 'Аудиофайл',
            'has_video' => 'Имеется видео',
            'video_file' => 'Видеофайл',
            'video_preview' => 'Путь к превью видео',
        );
    }

    public function getDateAsString()
    {
        $mas = explode("-", $this->date_add);
        $months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
        return $months[($mas[1] - 1)] . " " . $mas[0];
    }

    public function getAudioPath()
    {
        return "/uploads" . $this->getUploadPath() . "/" . $this->audio_file;
    }

    public function getVideoPath()
    {
        return $this->video_file . "&amp;autoplay=1";
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('moderation_status', $this->moderation_status);
        $criteria->compare('review_target', $this->review_target);
        $criteria->compare('id_mega_user', $this->id_mega_user);
        $criteria->compare('rating', $this->rating, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('date_add', $this->date_add, true);
        $criteria->compare('has_audio', $this->has_audio);
        $criteria->compare('audio_file', $this->audio_file, true);
        $criteria->compare('has_video', $this->has_video);
        $criteria->compare('video_file', $this->video_file, true);
        $criteria->compare('video_preview', $this->video_preview, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Review the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->date_add = date("Y-m-d");
        }
        return parent::beforeSave();
    }
}
