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

class UserController extends \yupe\components\controllers\FrontController
{
    public function actionInstagram()
    {
        Yii::import("ext.yiinstagram.*");

        $backUrl = Yii::app()->getRequest()->getParam("backUrl", false);
        if (!$backUrl) {
            $backUrl = Yii::app()->session["backUrl"];
        } else {
            Yii::app()->session["backUrl"] = $backUrl;
        }

        $needShowDialogReview = Yii::app()->getRequest()->getParam("needShowDialogReview", false);
        if (!$backUrl) {
            $needShowDialogReview = Yii::app()->session["needShowDialogReview"];
        } else {
            Yii::app()->session["needShowDialogReview"] = $needShowDialogReview;
        }

        $instagram = Yii::app()->instagram->getInstagramApp();
        if (isset($_GET['code'])) {
            $session = Yii::app()->getSession();
            $accessToken = $instagram->getAccessToken();
            $instagram->setAccessToken($accessToken);
            $instagramUser = $instagram->getCurrentUser();
            var_dump($instagramUser);

            $megauser = Megauser::model()->find("id_from_social = '{$instagramUser->id}'");
            if ($megauser == null) {
                $megauser = new Megauser();

                // Надо зарегистрировать нового пользователя
                $fio = explode(" ", $instagramUser->full_name);

                $user = new User();
                $user->access_level = 0;
                $user->first_name = $fio[0];
                if (count($fio) > 1)
                    $user->last_name = $fio[1];
//                            $user->username = md5($identity->getState("id")."_cosmetics");
                $user->nick_name = "instagram" . "_" . $instagramUser->id;
                $password = $megauser->getPassword($user->nick_name);
                $user->hash = CPasswordHelper::hashPassword($password);
                $user->email = "mail" . $user->nick_name . "@nomail.com";
                $user->activate();
                if (!$user->save())
                    var_dump($user->getErrors());

                $megauser->avatar_path = $instagramUser->profile_picture;
                $megauser->id_from_social = $instagramUser->id;
                $megauser->social_link = "https://www.instagram.com/" . $instagramUser->username . "/";
                $megauser->id_user = $user->id;
                $megauser->social_type = 5;
                $megauser->fio = $user->first_name . " " . $user->last_name;
                $megauser->save();
            }

            $user = $megauser->getUser();

            // Непосредственно авторизация на сайте
            $password = $megauser->getPassword($user->nick_name);
            $identity = new UserIdentity($user->email, $password);

            if ($identity->authenticate()) {

                Yii::app()->getUser()->login($identity);

                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('UserModule.user', 'You authorized successfully!')
                );

                if ($needShowDialogReview)
                    Yii::app()->user->setFlash("needShowDialogReview", 1);
            }
            var_dump($backUrl);
            $this->redirect($backUrl);
        } else {
            $instagram->openAuthorizationUrl();
        }
    }

    public function actionLogin($service, $backUrl, $needShowDialogReview)
    {
        $services = [1 => "vkontakte", "odnoklassniki", "mailru", "facebook", "instagram"];
        $serviceName = (is_null(Yii::app()->request->getQuery('service')) ? "instagram" : Yii::app()->request->getQuery('service'));
        $serviceType = array_search($serviceName, $services);
        if (isset($serviceName)) {
            /** @var $eauth EAuthServiceBase */
            $eauth = Yii::app()->eauth->getIdentity($serviceName);
            $eauth->redirectUrl = Yii::app()->user->returnUrl;
            $eauth->cancelUrl = $this->createAbsoluteUrl('site/login');

            try {
                if ($eauth->authenticate()) {
                    var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes());
                    $identity = new EAuthUserIdentity($eauth);

                    // successful authentication
                    if ($identity->authenticate()) {
                        $megauser = Megauser::model()->find("id_from_social = '{$identity->getState("id")}'");
                        if ($megauser == null) {
                            $megauser = new Megauser();

                            // Надо зарегистрировать нового пользователя
                            $fio = explode(" ", $identity->getState("name"));
                            $attributes = $identity->getState("attributes");

                            $user = new User();
                            $user->access_level = 0;
                            $user->first_name = $fio[0];
                            $user->last_name = $fio[1];
//                            $user->username = md5($identity->getState("id")."_cosmetics");
                            $user->nick_name = $serviceName . "_" . $identity->getState("id");
                            $password = $megauser->getPassword($user->nick_name);
                            $user->hash = CPasswordHelper::hashPassword($password);
                            $user->email = "mail" . $user->nick_name . "@nomail.com";
                            $user->activate();
                            if (!$user->save())
                                var_dump($user->getErrors());

                            $megauser->avatar_path = $attributes["photo_medium"];
                            $megauser->adres = $attributes["city"];
                            $megauser->id_from_social = $attributes["id"];
                            $megauser->social_link = $attributes["url"];
                            $megauser->id_user = $user->id;
                            $megauser->social_type = $serviceType;
                            $megauser->fio = $user->first_name . " " . $user->last_name;
                            $megauser->save();
                        }

                        $user = $megauser->getUser();

                        // Непосредственно авторизация на сайте
                        $password = $megauser->getPassword($user->nick_name);
                        $identity = new UserIdentity($user->email, $password);

                        if ($identity->authenticate()) {

                            Yii::app()->getUser()->login($identity);

                            Yii::app()->getUser()->setFlash(
                                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                                Yii::t('UserModule.user', 'You authorized successfully!')
                            );

                            if ($needShowDialogReview)
                                Yii::app()->user->setFlash("needShowDialogReview", 1);

                        }


//
                        //var_dump($identity->id, $identity->name, Yii::app()->user->id);exit;

                        // special redirect with closing popup window
                        $eauth->redirect($backUrl);
                    } else {
                        // close popup window and redirect to cancelUrl
                        $eauth->cancel();
                    }
                }

                // Something went wrong, redirect to login page
                $this->redirect(array('site/login'));
            } catch (EAuthException $e) {
                var_dump($e->getMessage());
                // save authentication error to session
                Yii::app()->user->setFlash('error', 'EAuthException: ' . $e->getMessage());

                // close popup window and redirect to cancelUrl
//                $eauth->redirect($eauth->getCancelUrl());
            }
        }


    }

    public function actionTest()
    {
        $this->render("login");
    }
}