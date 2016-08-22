<?php
/**
 * Bitrix24BackendController контроллер для bitrix24 в панели управления
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2016 amyLabs && Yupe! team
 * @package yupe.modules.bitrix24.controllers
 * @since 0.1
 *
 */

use Bitrix24\App;


class Bitrix24BackendController extends \yupe\components\controllers\BackController
{

    public function actionSaveAccessToken($code)
    {
        $module = Yii::app()->getModule('bitrix24');
        \yupe\models\Settings::saveModuleSettings($module->getId(),["accessToken" => $code]);
        $module->getSettings(true);
    }

    public function actionInit()
    {
        $module = Yii::app()->getModule("bitrix24");
        /* @var Bitrix24Module $module */
        $redirectUri = "http://ayaorganic.ru".$this->createUrl("/backend/bitrix24/bitrix24/saveAccessToken");
        var_dump($redirectUri);
        $url = "https://".$module->domain."/oauth/authorize/?client_id=".$module->client_id."&response_type=code&redirect_uri=".urlencode($redirectUri);
        echo $url;
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            $out = curl_exec($curl);
            var_dump($out);
            curl_close($curl);
        }
    }




    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    public function actionIndex()
    {
        $sellFromSiteTitle = "Продажа с сайта №";

        $module = Yii::app()->getModule("bitrix24");
        $redirectUrl = "http://ayaorganic.ru/backend/bitrix24/bitrix24";


        if(empty($_GET['code']) || empty($_GET['member_id']))
        {
            $params = array(
                "response_type" => "code",
                "client_id" => $module->client_id,
                "redirect_uri" => $redirectUrl,
            );
            $path = "/oauth/authorize/";

            Header("HTTP 302 Found");
            Header("Location: ".'https://'.$module->domain.$path."?".http_build_query($params));
            die();
        }

        echo "<a href = '/backend/bitrix24/bitrix24/index'>Обновить</a><br><br>";



// создаем битрикс24 объекты
        $obB24App = new \Bitrix24\Bitrix24(true, null);
        $obB24App->setApplicationScope(['crm']);
        $obB24App->setApplicationId($module->client_id);
        $obB24App->setApplicationSecret($module->client_secret);

// данные пользователя
        $obB24App->setDomain($module->domain);
        $obB24App->setRedirectUri($redirectUrl);
        $obB24App->setMemberId($_GET['member_id']);
        $result = $obB24App->getFirstAccessToken($_GET['code']);
        $result = json_decode($result);
//        if ($result->error == "invalid_token");
//        {
//            $this->redirect("/backend/bitrix24/bitrix24/index");
//        }
        $obB24App->setAccessToken($result->access_token);
        $obB24App->setRefreshToken($result->refresh_token);

        /****  Синхронизация информации по товарам ******/


        $orderModels = Order::model()->findAll();
        $orders = [];
        foreach ($orderModels as $item)
        {
            $orders[$item->id] = $item;
        }

        $obj = new Bitrix24\CRM\Deal\Deal($obB24App);

        $alreadyHasOnBitrix = $obj->getList();
        CVarDumper::dump($alreadyHasOnBitrix,10,true);

        foreach ($alreadyHasOnBitrix as $bitrixDeal)
        {
            if (strpos($bitrixDeal["TITLE"],$sellFromSiteTitle) !== 0)
                continue;
            $id = str_replace($sellFromSiteTitle,"",$bitrixDeal["TITLE"]);
            if (!isset($orders[$id]))
            {
                // Не нашли сделку на сайте????
                continue;
            }
            $order = $orders[$id];
            // Сравниваем данные на идентичность
            $flag = true;
            if ($order->getTotalSummWithDelivery() != $bitrixDeal["OPPORTUNITY"])


        }



        return;
        foreach ($orders as $order)
        {
            $result = $obj->add([
                    "TITLE" => $sellFromSiteTitle.$order->id,
                    "TYPE_ID"=> "GOODS",
                    "STAGE_ID"=> "NEW",
                    "OPENED"=> "Y",
                    "ASSIGNED_BY_ID"=> 1,
                    "PROBABILITY"=> 100,
                    "CURRENCY_ID"=> "RUB",
                    "OPPORTUNITY"=> $order->getTotalPriceWithDelivery(),
                    "BEGINDATE" => str_replace(" ","T",$order->date),
                    "CLOSEDATE" => str_replace(" ","T",$order->payment_time),
                ],
                [
                    "REGISTER_SONET_EVENT" => "Y"
                ]);
        }

        var_dump($result);
        return;

        $obB24User = new \Bitrix24\User\User($obB24App);
        $arCurrentB24User = $obB24User->current();
        var_dump($arCurrentB24User);
    }
}