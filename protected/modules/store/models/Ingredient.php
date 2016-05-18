<?php
Yii::import('zii.behaviors.CTimestampBehavior');

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $short_description
 * @property datetime $create_time
 * @property datetime $update_time
 * @property string $image
 * @property integer $position
 * @property integer $external_id
 *
 * @method getImageUrl($width = 0, $height = 0, $crop = true, $defaultImage = null)
 *
 * @property ProductImage $mainImage
 *
 */
class Ingredient extends yupe\models\YModel
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Good the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'yupe_store_ingredients';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['name, slug, short_description', 'required'],
            [
                'id, name, slug, image,position, short_description, create_time, update_time,category_id',
                'safe',
                'on' => 'search',
            ],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    public function scopes()
    {
        return [

        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'image'=> 'Изображение',
            'short_description' => 'Описание',
            'slug' => 'Служебное название'
        ];
    }

    /**
     * @return array customized attribute descriptions (name=>description)
     */
    public function attributeDescriptions()
    {
        return [

        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('short_description', $this->short_description, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);


        return new CActiveDataProvider(
            get_class($this), [
            'criteria' => $criteria,
            'sort' => ['defaultOrder' => 't.position'],
        ]
        );
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $module = Yii::app()->getModule('store');

        return [
            'time' => [
                'class' => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => true,
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
            ],
            'upload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module->uploadPath.'/ingredients',
                'resizeOnUpload' => true,
                'resizeOptions' => [
                    'maxWidth' => 900,
                    'maxHeight' => 900,
                ],
            ],
            'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
            ],
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {

        return parent::beforeValidate();
    }


    /**
     * @return bool
     */
    public function beforeDelete()
    {
        return parent::beforeDelete();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return Yii::app()->createUrl('/store/ingridient/view', ['name' => $this->slug]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param bool|false $absolute
     * @return string
     */
    public function getUrl($absolute = false)
    {
        return $absolute ?
            Yii::app()->createAbsoluteUrl('/store/ingridient/view', ['name' => $this->slug]) :
            Yii::app()->createUrl('/store/ingridient/view', ['name' => $this->slug]);
    }

}
