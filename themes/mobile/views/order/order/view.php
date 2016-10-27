<?php
/* @var $model Order */
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');

$this->title = [Yii::t('OrderModule.order', 'Order #{n}', [$model->id]), Yii::app()->getModule('yupe')->siteName];
?>

<div class="main__order-box grid">
    <div class="grid-module-12">
        <?php $this->widget('yupe\widgets\YFlashMessages'); ?>
    </div>
    <div class="order-box">
        <?php if ($model->payment_method_id == 0 &&  !$model->isPaid()  && !empty($model->delivery) && $model->delivery->hasPaymentMethods()): ?>
            <div class="order-box">
                <h1 class="h2">Оформление заказа > Шаг 3. ОПЛАТА</h1>
                <div class="order-box__body">
                    <?php foreach ((array)$model->delivery->paymentMethods as $payment): ?>
                        <div class="rich-radio payment-method">
                            <input class="rich-radio__input payment-method-radio" type="radio" name="payment_method_id" value="<?= $payment->id; ?>" checked="" id="payment-<?= $payment->id; ?>" hidden="hidden">
                            <label for="payment-<?= $payment->id; ?>" class="rich-radio__label">
                                <div class="rich-radio-body">
                                    <div class="rich-radio-body__content">
                                        <div class="rich-radio-body__heading">
                                            <span class="rich-radio-body__title"><?= CHtml::encode($payment->name); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <div class="payment-form rich-radio__input" style="visibility: hidden">
                                <?= $payment->getPaymentForm($model) ;?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="order-box__bottom order-box__bottom_left">
                <button type="submit" class="btn_cart btn btn_big btn_primary" id="start-payment">
                    Оплатить
                    <span class="fa fa-fw fa-play"></span>
                </button>
            </div>

        <?php endif; ?>

        <div class="order-box__header order-box__header_black">
            <div class="order-box__header-content"><?= Yii::t("OrderModule.order", "Order #"); ?> <b><?= $model->id ?></b> (<?= $model->status->getTitle(); ?>)
            </div>
        </div>
        <div class="order-box__body">
            <div class="detail-view">
                <?php if ($model->getAddress()): ?>
                    <div class="detail-view__item">
                        <div class="detail-view__title"><?= Yii::t("OrderModule.order", "Address"); ?>:</div>
                        <div class="detail-view__text"><?= CHtml::encode($model->getAddress()); ?></div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($model->name)): ?>
                    <div class="detail-view__item">
                        <div class="detail-view__title"><?= CHtml::activeLabel($model, 'name'); ?>:</div>
                        <div class="detail-view__text"><?= CHtml::encode($model->name); ?></div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="detail-view">
                <div class="detail-view__item">
                    <div class="detail-view__title"><?= CHtml::activeLabel($model, 'delivery_id'); ?>:</div>
                    <div class="detail-view__text"><?= CHtml::encode($model->delivery->name); ?></div>
                </div>
            </div>

            <?php if (!empty($model->payment_method_id)):?>
                <div class="detail-view">
                    <div class="detail-view__item">
                        <div class="detail-view__title"><?= CHtml::activeLabel($model, 'payment_method_id'); ?>:</div>
                        <div class="detail-view__text"><?= CHtml::encode($model->payment->name); ?></div>
                    </div>
                </div>
                <?php if ($model->isPaid()):?>
                    <div class="detail-view">
                        <div class="detail-view__item">
                            <div class="detail-view__text corporateColor">Заказ уже оплачен</div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($model->payment_method_id == 4) :?>
                    <div class="detail-view">
                        <div class="detail-view__item">
                            Ваш заказ принят, ближайшее время с Вами свяжется оператор для уточнения стоимости и условий доставки. Спасибо, что выбрали органическую косметику ручной работы «АлтайЯ»
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>


        </div>
    </div>
    <div class="main__title">
        <h2 class="h2"><?= Yii::t("OrderModule.order", "Order details"); ?></h2>
    </div>
    <div class="order-box">
        <div class="cart-list">
            <?php foreach ((array)$model->products as $position): ?>
                <div class="cart-list__item js-cart__item">
                    <div class="cart-item js-cart__item">
                        <div class="cart-item__info"><?= CHtml::encode($position->product_name); ?></div>
                        <div class="cart-item__price"><?= number_format($position->price,0,'.',' '); ?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span></div>
                        <div class="cart-item__quantity"><?= $position->quantity; ?></div>
                        <div class="cart-item__summ"><?= number_format($position->getTotalPrice(),0,'.',' '); ?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="order-box__bottom">
            <div class="order-box__subtotal"><?= Yii::t("OrderModule.order", "Total"); ?>:
                <div class="product-price"><?= number_format($model->total_price,0,'.',' '); ?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span></div>
            </div>
            <div class="order-box__subtotal"><?= Yii::t("OrderModule.order", "Delivery price"); ?>:
                <div class="product-price"><?= number_format($model->getDeliveryPrice(),0,'.',' ');?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span></div>
            </div>
            <?php
            $couponDiscount = $model->getCouponDiscount($model->getCoupons());
            ?>
            <?php if ($couponDiscount > 0):?>
                <div class="order-box__subtotal">Скидка по промокоду:
                    <div class="product-price"><?= number_format($couponDiscount ,0,'.',' ')?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span></div>
                </div>
            <?php endif; ?>
            <div class="order-box__subtotal order-box__subtotal_big"><?= Yii::t("OrderModule.order", "Total"); ?>:
                <div class="product-price"><?= number_format($model->getTotalPriceWithDelivery(),0,'.',' '); ?><span class="ruble"> <?= Yii::t("OrderModule.order", Yii::app()->getModule('store')->currency); ?></span></div>
            </div>
        </div>
    </div>

</div>
