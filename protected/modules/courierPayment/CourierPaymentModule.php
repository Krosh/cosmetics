<?php

use yupe\components\WebModule;

/**
 * Class CourierPaymentModule
 */
class CourierPaymentModule extends WebModule
{
    /**
     *
     */
    const VERSION = '0.9.9';

    /**
     * @return array
     */
    public function getDependencies()
    {
        return ['payment'];
    }

    /**
     * @return bool
     */
    public function getNavigation()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getAdminPageLink()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getIsShowInAdminMenu()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * @return array
     */
    public function getEditableParams()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('CourierPaymentModule.courierPayment', 'Store');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return Yii::t('CourierPaymentModule.courierPayment', 'CourierPayment');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return Yii::t('CourierPaymentModule.courierPayment', 'CourierPayment payment module');
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('CourierPaymentModule.courierPayment', 'Dark_Cs');
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('CourierPaymentModule.courierPayment', 'darkcs2@gmail.com');
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-rub';
    }

    /**
     *
     */
    public function init()
    {
        parent::init();
    }
}
