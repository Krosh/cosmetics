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
                <div class="b-quick-view">
                    <div class="b-quick-view__btn">
                        <a rel="group-<?= CHtml::encode($data->getName()); ?>" href="<?= StoreImage::product($data) ?>" class="b-quick-link fancybox"> Быстрый
                            просмотр <img
                                src="<?= $this->mainAssets ?>/images/eye.png" class="b-quick-link__pic" alt=""></a>
                        <?php foreach ($data->getImages() as $key => $image): ?>
                            <a href="<?= $image->getImageUrl(); ?>" rel="group-<?= CHtml::encode($data->getName()); ?>" class="fancybox"> </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if ($data->isSpecial()): ?>
                <div class="product-gallery__label">
                    <div class="product-label product-label_hit">
                        <div class="product-label__text">Хит</div>
                    </div>
                </div>
            <?php endif; ?>
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
