<?php
/**
* ArambaBackendController контроллер для aramba в панели управления
*
* @author yupe team <team@yupe.ru>
* @link http://yupe.ru
* @copyright 2009-2016 amyLabs && Yupe! team
* @package yupe.modules.aramba.controllers
* @since 0.1
*
*/

class ArambaBackendController extends \yupe\components\controllers\BackController
{
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
	public function actionIndex()
	{
        Yii::import('application.modules.aramba.components.arambaApi');
        require_once(Yii::getPathOfAlias('application.modules.aramba.components.arambaApi').".php");
        $module = Yii::app()->getModule('aramba');

        $api = new ArambaApi($module->apiId);
        $balance = $api->getBalance();
        $senders = $api->getSmsSenderIds(0,500);
        $names = ["aramba.ru" => "aramba.ru"];
        foreach ($senders["items"]as $item)
        {
            $names[$item] = $item;
        }
        $senderNames = $names;
		$this->render('index',["balance" => $balance["response"], "names" => $senderNames, "senderName" => $module->senderId]);
	}

    /**
     * Действие для сохранения настройки имени отправителя
     *
     *
     */
    public function actionSave()
    {
        $module = Yii::app()->getModule('aramba');
        $senderId = Yii::app()->request->getParam("senderId","aramba.ru");
        \yupe\models\Settings::saveModuleSettings($module->getId(),["senderId" => $senderId]);
        $module->getSettings(true);
        $this->redirect("/backend/aramba/aramba");

    }

}