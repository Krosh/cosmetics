<?php /*$productUrl = Yii::app()->createUrl('/store/product/view', ['name' => CHtml::encode($data->slug)]); */?><!--

<div class="h-slider__slide">
    <div class="grid-module-4">
        <div class="product-mini">
            <div class="product-mini__thumbnail">
                <a href="javascript:void(0);">
                    <img src="<?/*= $data->getImageUrl(90, 90, false); */?>"
                         class=" product-mini__img">
                </a>
            </div>
            <div class="product-mini__info">
                <div class="product-mini__title"><a href="<?/*= $productUrl; */?>"
                                                    class="product-mini__link"><?/*= Chtml::encode($data->getName()); */?></a>
                </div>
                <div class="product-mini__price">
                    <div class="product-price"><?/*= $data->getResultPrice(); */?><span class="ruble"> <?/*= Yii::app()->getModule('store')->currency;*/?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<?php
$productUrl = Yii::app()->createUrl('/store/product/view', ['name' => CHtml::encode($data->slug)]);
$basePrice = (float)$data->getBasePrice();
?>
<div class="catalog__item">
    <article class="product-vertical">
        <a href="<?= $productUrl; ?>">
            <div class="product-vertical__thumbnail">
                <img src="<?= StoreImage::product($data, 150, 180, false) ?>" class="product-vertical__img" />
            </div>
            <?php if ($data->isSpecial()): ?>
                <div class="product-gallery__label_wide">
                    <div class="product-label product-label_hit">
                        <div class="product-label__text">Хит</div>
                    </div>
                </div>
            <?php endif; ?>
        </a>
        <div class="product-vertical__content"><a href="<?= $productUrl; ?>" class="product-vertical__title"><?= CHtml::encode($data->getName()); ?></a>
            <div class="product-vertical__price">
                <div class="product-price"><?= $data->getResultPrice() ?><span class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span></div>
                <?php if ($data->hasDiscount()): ?>
                    <div class="product-price product-price_old"><?= $basePrice ?><span class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span></div>
                <?php endif; ?>
                <div class="product-vertical-extra__cart">
                    <?php if (Yii::app()->hasModule('cart')): ?>
                        <a href="javascript:void(0);" class="btn btn_cart quick-add-product-to-cart" data-product-id="<?= $data->id; ?>" data-cart-add-url="<?= Yii::app()->createUrl('/cart/cart/add');?>">
                            <?="В корзину" ?>
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </article>
</div>
