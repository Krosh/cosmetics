<?php
/**
 * @var Product $data
 */
$productUrl = Yii::app()->createUrl('/store/product/view', ['name' => CHtml::encode($data->slug)]);
$basePrice = (float)$data->getBasePrice();
?>
<div class="catalog__item">
    <article class="product-vertical">
        <a href="<?= $productUrl; ?>">
            <div class="product-vertical__thumbnail">
                <img src="<?= StoreImage::product($data, 150, 180, false) ?>" class="product-vertical__img"/>
            </div>
        </a>

        <div class="product-vertical__content"><a href="<?= $productUrl; ?>"
                                                  class="product-vertical__title"><?= CHtml::encode($data->getName()); ?></a>

            <div class="product-vertical__price">
                <div class="product-price"><?= $data->getResultPrice() ?><span
                        class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                </div>
                <?php if ($data->hasDiscount()): ?>
                    <div class="product-price product-price_old"><?= $basePrice ?><span
                            class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                    </div>
                <?php endif; ?>
                <?php if ($data->status == Product::STATUS_ACTIVE): ?>
                    <div class="product-vertical-extra__cart">
                        <a href="javascript:void(0);" class="btn btn_cart quick-add-product-to-cart"
                           data-product-id="<?= $data->id; ?>"
                           data-cart-add-url="<?= Yii::app()->createUrl('/cart/cart/add'); ?>">
                            <?= Yii::t('StoreModule.store', 'Into cart') ?>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="product-vertical-extra__cart">
                        <div class="product-vertical__non-in-stock">
                            Нет в наличии
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </article>
</div>
