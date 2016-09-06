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
        $rating = Yii::app()->getRequest()->getParam("modal__rating");
        $target = Yii::app()->getRequest()->getParam("modal__product-id");
        $text = Yii::app()->getRequest()->getParam("b-modal-reviews__text");
        $review = new Review();
        $idUser = Yii::app()->user->getId();
        $megauser = Megauser::model()->find("id_user = " . $idUser);
        if ($megauser == null) {
            $megauser = new Megauser();
            $megauser->avatar_path = "";
            $megauser->id_from_social = "";
            $megauser->social_link = "";
            $megauser->id_user = $idUser;
            $megauser->social_type = 0;
            $megauser->fio = Yii::app()->getUser()->getProfile()->getFullName();
            $megauser->save();
        }
        $review->id_mega_user = $megauser->id;
        $review->review_target = $target;
        $review->has_audio = 0;
        $review->has_video = 0;
        $review->date_add = date("Y-m-d H:i:s");
        $review->rating = $rating;
        $review->text = $text;
        $review->moderation_status = Review::$MODERATION_ON;
        if (!$review->save())
            var_dump($review->getErrors());
    }


}