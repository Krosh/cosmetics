<?php

/**
 * This is the model class for table "{{megareview_review}}".
 *
 * The followings are the available columns in table '{{megareview_review}}':
 * @property integer $id
 * @property integer $id_mega_user
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
            array('id_mega_user, has_audio, has_video', 'numerical', 'integerOnly' => true),
            array('rating', 'length', 'max' => 2),
            array('text', 'length', 'max' => 300),
            array('audio_file, video_file, video_preview', 'length', 'max' => 150),
            array('date_add', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_mega_user, rating, text, date_add, has_audio, audio_file, has_video, video_file, video_preview', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'id_mega_user' => 'Id Mega User',
            'rating' => 'Rating',
            'text' => 'Text',
            'date_add' => 'Date Add',
            'has_audio' => 'Has Audio',
            'audio_file' => 'Audio File',
            'has_video' => 'Has Video',
            'video_file' => 'Video File',
            'video_preview' => 'Video Preview',
        );
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
}
