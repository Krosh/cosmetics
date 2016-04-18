<?php

/**
 * Slide основная модель для работы с изображениями
 *
 * @author Valek Vergilyush <v.vergilyush@gmail.com>
 * @link http://green-s.pro
 * @copyright 2010-2014 green-s.pro
 * @package yupe.modules.slide.models
 * @since 0.1
 *
 */

/**
 * This is the model class for table "Slide".
 *
 * The followings are the available columns in table 'Slide':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $file
 * @property string $slideshow_identifier
 * @property string $creation_date
 * @property string $user_id
 * @property integer $status

 * The followings are the available model relations:
 * @property User $user
 */

Yii::import('application.modules.page.models.*');

class Slide extends yupe\models\YModel
{
    const STATUS_SHOW = 1;
    const STATUS_HIDE = 0;



    public function getPage()
    {
        if ($this->slideshow_identifier == "mainpage")
            return "Главная страница";
        else
        {
            $page = Page::model()->findBySlug($this->slideshow_identifier);
            if ($page != null)
                return $page->title;
            return "----";
        }
    }

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className - class name
     *
     * @return Slide the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * table name
     *
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{slide_slide}}';
    }

    /**
     * validation rules
     *
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, description', 'filter', 'filter' => array(new CHtmlPurifier(), 'purify')),
            array('file', 'required'),
            array('name, description, url', 'filter', 'filter' => 'trim'),
            array('status, sort', 'numerical', 'integerOnly' => true),
            array('user_id, status', 'length', 'max' => 11),
            array('name, file, slideshow_identifier', 'length', 'max' => 250),
            array('slideshow_identifier, id, name, description, url, creation_date, user_id, status', 'safe', 'on' => 'search'),
        );
    }

    public function behaviors()
    {
        $module = Yii::app()->getModule('slide');

        return array(
            'slideUpload' => array(
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'scenarios'     => array('insert', 'update'),
                'attributeName' => 'file',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'requiredOn'    => 'insert',
                'uploadPath'    => $module->uploadPath,
            	'resizeOptions' => array(
            						'width' => 1920,
            						'height' => 656,
            						'quality' => array(
            								'jpegQuality' => 75,
            								'pngCompressionLevel' => 7
            						),
            			),
            		),

        );
    }

    public function afterDelete()
    {
        @unlink(Yii::app()->getModule('slide')->getUploadPath() . '/' . $this->file);



        return parent::afterDelete();
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array_merge(
            array(
                'slide'    => array(self::BELONGS_TO, 'Slide', 'id'),
                'user'     => array(self::BELONGS_TO, 'User', 'user_id'),
            ),
			array()
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'            => Yii::t('SlideModule.slide', 'id'),
            'name'          => Yii::t('SlideModule.slide', 'Title'),
            'description'   => Yii::t('SlideModule.slide', 'Description'),
            'file'          => Yii::t('SlideModule.slide', 'File'),
        	'url'        	=> Yii::t('SlideModule.slide', 'Url'),
            'creation_date' => Yii::t('SlideModule.slide', 'Created at'),
            'user_id'       => Yii::t('SlideModule.slide', 'Creator'),
            'status'        => Yii::t('SlideModule.slide', 'Status'),
            'slideshow_identifier' => 'Страница со слайдером',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria();

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.slideshow_identifier', $this->slideshow_identifier, true);
        $criteria->compare('t.description', $this->description, true);
        $criteria->compare('t.url', $this->url, true);
        $criteria->compare('t.file', $this->file, true);
        $criteria->compare('t.creation_date', $this->creation_date, true);
        $criteria->compare('t.user_id', $this->user_id, true);
        $criteria->compare('t.status', $this->status);


        return new CActiveDataProvider(get_class($this), array(
        		'criteria' => $criteria,
        		'sort'     => array('defaultOrder' => 't.sort')
        		));
    }

    public function beforeValidate()
    {
        if ($this->getIsNewRecord()) {
            $this->creation_date = new CDbExpression('NOW()');
            $this->user_id = Yii::app()->user->getId();
        }

        return parent::beforeValidate();
    }

    public function getStatusList()
    {
        return array(
            self::STATUS_SHOW    => Yii::t('SlideModule.slide', 'show'),
            self::STATUS_HIDE => Yii::t('SlideModule.slide', 'hide')
        );
    }

    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('SlideModule.slide', '*unknown*');
    }


    /**
     * Проверка на возможность редактировать/удалять изображения
     *
     * @return boolean can change
     **/
    public function canChange()
    {
        return Yii::app()->user->isSuperUser() || Yii::app()->user->getId() == $this->user_id;
    }





    /**
     * Получаем имя того, кто загрузил картинку:
     *
     * @return string user full name
     **/
    public function getUserName()
    {
        return $this->user instanceof User
            ? $this->user->getFullName()
            : '---';
    }



    public function getName()
    {
        return $this->name ? $this->name : $this->alt;
    }

    public function sort(array $items)
    {
    	$transaction = Yii::app()->db->beginTransaction();

    	try {

    		foreach ($items as $id => $priority) {

    			$model = $this->findByPk($id);

    			if (null === $model) {
    				continue;
    			}

    			$model->sort = (int)$priority;

    			if (!$model->update('sort')) {
    				throw new CDbException('Error sort menu items!');
    			}

    		}

    		$transaction->commit();

    		return true;
    	} catch (Exception $e) {
    		$transaction->rollback();

    		return false;
    	}
    }
}
