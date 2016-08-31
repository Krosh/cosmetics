<?php
/**
 * MegareviewController контроллер для megareview на публичной части сайта
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2016 amyLabs && Yupe! team
 * @package yupe.modules.megareview.controllers
 * @since 0.1
 *
 */

class ReviewController extends \yupe\components\controllers\FrontController
{
    public function actionAdd()
    {
        $rating = Yii::app()->getRequest()->getParam("rating");
        $text = Yii::app()->getRequest()->getParam("text");
        $review = new Review();
        $idUser = Yii::app()->user->getId();
        $megauser = Megauser::model()->find("id_user = " . $idUser->id);
        $review->id_mega_user = $megauser->id;
        $review->has_audio = 0;
        $review->has_video = 0;
        $review->date_add = date("Y-m-d H:i:s");
        $review->rating = $rating;
        $review->text = $text;
        $review->moderation_status = Review::$MODERATION_ON;
        $review->save();
    }


}