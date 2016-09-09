<?php

/**
 * This is the model class for table "{{megareview_user}}".
 *
 * The followings are the available columns in table '{{megareview_user}}':
 * @property integer $id
 * @property integer $id_user
 * @property string $id_from_social
 * @property integer $social_type
 * @property string $social_link
 * @property string $avatar_path
 * @property string $fio
 * @property string $adres
 */
class Megauser extends yupe\models\YModel
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{megareview_user}}';
    }

    static public function getSocials()
    {
        return [0 => "На сайте ayaorganic.ru", 'vk.com'];
    }

    public function getSocialAsString()
    {
        $soc = self::getSocials();
        return $soc[$this->social_type];
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_user, social_type', 'numerical', 'integerOnly' => true),
            array('social_link, avatar_path, fio, adres', 'length', 'max' => 150),
            array('id_from_social', 'length', 'max' => 40),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_from_social, id_user, social_type, social_link, avatar_path, fio, adres', 'safe', 'on' => 'search'),
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
            'id_user' => 'Пользователь из системы авторизации сайта',
            'social_type' => 'Социальная сеть',
            'social_link' => 'Ссылка на страницу',
            'avatar_path' => 'Путь к аватару',
            'fio' => 'ФИО',
            'adres' => 'Адрес',
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
        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('social_type', $this->social_type);
        $criteria->compare('social_link', $this->social_link, true);
        $criteria->compare('avatar_path', $this->avatar_path, true);
        $criteria->compare('fio', $this->fio, true);
        $criteria->compare('adres', $this->adres, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Megauser the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getPassword($nick)
    {
        return $nick . "-123";
    }

    public function getUser()
    {
        return User::model()->findByPk($this->id_user);
    }
}
