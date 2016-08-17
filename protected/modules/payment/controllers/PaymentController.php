<?php

/**
 * Class PaymentController
 */
class PaymentController extends \yupe\components\controllers\FrontController
{
    /**
     * @param null $id
     * @throws CException
     * @throws CHttpException
     */
    public function actionProcess($id = null)
    {
        /* @var $payment Payment */
        $payment = Payment::model()->findByPk($id);

        if (!$payment && !$payment->module) {
            throw new CHttpException(404);
        }

        /** @var PaymentSystem $paymentSystem */
        if ($paymentSystem = Yii::app()->paymentManager->getPaymentSystemObject($payment->module)) {
            $result = $paymentSystem->processCheckout($payment, Yii::app()->getRequest());

            if ($result instanceof Order) {
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    "Оформление заказа завершено"
                );
                //отправить уведомления
                Yii::app()->orderNotifyService->sendOrderCreatedAdminNotify($result);

                Yii::app()->orderNotifyService->sendOrderCreatedUserNotify($result);


                $this->redirect(['/order/order/view', 'url' => $result->url]);
            }
        }
    }

    public function actionFailed()
    {
        /* @var $order Order */
        $order = Order::model()->findByPk(Yii::app()->getRequest()->getParam("InvId"));

        Yii::app()->getUser()->setFlash(
            yupe\widgets\YFlashMessages::WARNING_MESSAGE,
            "Оплата через Робокассу не прошла"
        );
        $this->redirect(['/order/order/view', 'url' => $order->url]);

    }

}
