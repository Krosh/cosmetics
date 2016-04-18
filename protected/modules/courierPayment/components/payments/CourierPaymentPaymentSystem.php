<?php

/**
 * Class CourierPaymentPaymentSystem
 */

Yii::import('application.modules.courierPayment.CourierPaymentModule');

/**
 * Class CourierPaymentPaymentSystem
 */
class CourierPaymentPaymentSystem extends PaymentSystem
{
    /**
     * @param Payment $payment
     * @param Order $order
     * @param bool|false $return
     * @return mixed|string
     */
    public function renderCheckoutForm(Payment $payment, Order $order, $return = false)
    {
        return Yii::app()->getController()->renderPartial(
            'application.modules.courierPayment.views.form',
            [
                'id' => $order->id,
                'settings' => $payment->getPaymentSystemSettings(),
            ],
            $return
        );
//        return "";
    }

    /**
     * @param Payment $payment
     * @param CHttpRequest $request
     * @return bool
     */
    public function processCheckout(Payment $payment, CHttpRequest $request)
    {
        $orderId = (int)$request->getParam('idOrder');

        $order = Order::model()->findByPk($orderId);

        if (null === $order) {
            Yii::log(
                Yii::t('CourierPaymentModule.courierPayment', 'Order with id = {id} not found!', ['{id}' => $orderId]),
                CLogger::LEVEL_ERROR,
                self::LOG_CATEGORY
            );

            return false;
        }

        if ($order->isPaid()) {
            Yii::log(
                Yii::t('CourierPaymentModule.courierPayment', 'Order with id = {id} already payed!', ['{id}' => $orderId]),
                CLogger::LEVEL_ERROR,
                self::LOG_CATEGORY
            );

            return false;
        }

        $settings = $payment->getPaymentSystemSettings();


        $order->payment_method_id = $payment->id;

        $result = $order->save();


/*        if ($result) {
            Yii::app()->eventManager->fire(OrderEvents::SUCCESS_PAID, new PayOrderEvent($order, $payment));
        } else {
            Yii::app()->eventManager->fire(OrderEvents::FAILURE_PAID, new PayOrderEvent($order, $payment));
        }
*/
        if ($result) {
            Yii::log(
                Yii::t('CourierPaymentModule.courierPayment', 'Success pay order with id = {id}!', ['{id}' => $orderId]),
                CLogger::LEVEL_INFO,
                self::LOG_CATEGORY
            );

            return $order;
        } else {
            Yii::log(
                Yii::t(
                    'CourierPaymentModule.courierPayment',
                    'Error pay order with id = {id}! Error change status!',
                    ['{id}' => $orderId]
                ),
                CLogger::LEVEL_ERROR,
                self::LOG_CATEGORY
            );

            return false;
        }
    }
}
