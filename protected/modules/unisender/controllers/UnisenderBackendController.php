<?php
/**
* UnisenderBackendController контроллер для unisender в панели управления
*
* @author yupe team <team@yupe.ru>
* @link http://yupe.ru
* @copyright 2009-2016 amyLabs && Yupe! team
* @package yupe.modules.unisender.controllers
* @since 0.1
*
*/
class UnisenderBackendController extends \yupe\components\controllers\BackController
{

    public function actionTestSend()
    {
        $module = Yii::app()->getModule('unisender');
        $res = $module->sendSms("79635233336","Тестовая смс");
        var_dump($res);
        echo "testsend";
    }
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
	public function actionIndex()
	{
        $module = Yii::app()->getModule('unisender');
        $api = new unisenderApi($module->apiId);
        $result = json_decode($api->getUserInfo())->result;
		$this->render('index',["balance" => $result->balance,"senderId" => $module->senderId]);
	}

    /**
     * Действие для сохранения настройки имени отправителя
     *
     *
     */
    public function actionSave()
    {
        $module = Yii::app()->getModule('unisender');
        $senderId = Yii::app()->request->getParam("senderId");
        \yupe\models\Settings::saveModuleSettings($module->getId(),["senderId" => $senderId]);
        $module->getSettings(true);
        $this->redirect("/backend/unisender/unisender");

    }

}