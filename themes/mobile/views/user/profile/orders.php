<?php
/* @var $orders Order[] */

$this->title = Yii::t('OrderModule.order', 'Personal account');
?>
<div class="main__title grid">
    <h1 class="h2"><?= Yii::t('OrderModule.order', 'Orders history'); ?></h1>
</div>
<div class="main__order-box grid">
    <div class="order-box">
        <div class="cart-list">
            <?php foreach ((array)$orders as $order): ?>
                <div class="cart-list__item">
                    <div class="cart-item">
                        <div class="cart-list__column_info"><?= date('d.m.Y в H:i', strtotime($order->date)); ?></div>
                        <div class="cart-list__column_info">
                            <?=
                            CHtml::link(
                                Yii::t('OrderModule.order', 'Order #{n}', [$order->id]),
                                ['/order/order/view', 'url' => $order->url],
                                ['class' => 'cart-item__link']
                            ) . ($order->paid ? ' - ' . $order->getPaidStatus() : ''); ?>
                        </div>
                        <div class="cart-list__column_info">
                            <?= $order->getProductsCost(); ?>
                        </div>
                        <div class="cart-item__quantity"><?= $order->status->getTitle(); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>