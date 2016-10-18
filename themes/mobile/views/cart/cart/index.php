<?php
/* @var $this CartController */
/* @var $positions Product[] */
/* @var $order Order */
/* @var $coupons Coupon[] */
/* @var $form CActiveForm */

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

Yii::app()->getClientScript()->registerScriptFile($mainAssets.'/js/store.js');

$this->title = Yii::t('CartModule.cart', 'Cart');
$this->breadcrumbs = [
    Yii::t("CartModule.cart", 'Catalog') => ['/store/product/index'],
    Yii::t("CartModule.cart", 'Cart'),
];
?>

    <div class="main__title grid cart__empty" <?php if (!Yii::app()->cart->isEmpty()) echo "style = 'display:none'"; ?>>
        <h1 class="h2"><?= Yii::t("CartModule.cart", "Cart is empty"); ?></h1>
        <?= Yii::t("CartModule.cart", "There are no products in cart"); ?>
    </div>
<?php if (!Yii::app()->cart->isEmpty()): ?>
    <div class="cart__non-empty">

        <div class="main__title grid">
            <h1 class="h2">Оформление заказа > Шаг 1. ВАША КОРЗИНА</h1>
        </div>

        <div class="main__cart-box grid">
            <div class="order-box js-cart">
                <div class="order-box__header order-box__header_black">
                    <div class="cart-list-header">
                        <div class="cart-list__column cart-list__column_info">Наименование</div>
                        <div class="cart-list__column"><?= Yii::t("CartModule.cart", "Price"); ?></div>
                        <div class="cart-list__column"><?= Yii::t("CartModule.cart", "Amount"); ?></div>
                        <div class="cart-list__column"><?= Yii::t("CartModule.cart", "Sum"); ?></div>
                    </div>
                </div>
                <div class="cart-list">
                    <?php foreach ($positions as $position): ?>
                        <div class="cart-list__item">
                            <?php $positionId = $position->getId(); ?>
                            <?php $productUrl = Yii::app()->createUrl(
                                '/store/product/view',
                                ['name' => $position->slug]
                            ); ?>
                            <?= CHtml::hiddenField('OrderProduct['.$positionId.'][product_id]', $position->id); ?>
                            <input type="hidden" class="position-id" value="<?= $positionId; ?>"/>

                            <div class="cart-item js-cart__item">
                                <div class="cart-item__info">
                                    <div class="cart-item__thumbnail">
                                        <img src="<?= $position->getProductModel()->getImageUrl(90, 90, false); ?>"
                                             class="cart-item__img"/>
                                    </div>
                                    <div class="cart-item__content grid-module-4">
                                        <?php if ($position->getProductModel()->getCategoryId()): ?>
                                            <div class="cart-item__category"><?= $position->getProductModel(
                                                )->category->name ?></div>
                                        <?php endif; ?>
                                        <div class="cart-item__title">
                                            <a href="<?= $productUrl; ?>" class="cart-item__link"><?= CHtml::encode(
                                                    $position->name
                                                ); ?></a>
                                        </div>
                                        <?php foreach ($position->selectedVariants as $variant): ?>
                                            <h6><?= $variant->attribute->title; ?>: <?= $variant->getOptionValue(); ?></h6>
                                            <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][variant_ids][]', $variant->id); ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="cart-item__price">
                                    <span class="position-price"><?= $position->getPrice(); ?></span>
                                    <span class="ruble"> <?= Yii::t("CartModule.cart", Yii::app()->getModule('store')->currency); ?></span>
                                </div>
                                <div class="cart-item__quantity">
                                <span data-min-value='1' data-max-value='99' class="spinput js-spinput">
                                    <span class="spinput__minus js-spinput__minus cart-quantity-decrease"
                                          data-target="#cart_<?= $positionId; ?>"></span>
                                    <?= CHtml::textField(
                                        'OrderProduct['.$positionId.'][quantity]',
                                        $position->getQuantity(),
                                        ['id' => 'cart_'.$positionId, 'class' => 'spinput__value position-count']
                                    ); ?>
                                    <span class="spinput__plus js-spinput__plus cart-quantity-increase"
                                          data-target="#cart_<?= $positionId; ?>"></span>
                                </span>
                                </div>
                                <div class="cart-item__summ">
                                    <span class="position-sum-price"><?= $position->getSumPrice(); ?></span>
                                    <span class="ruble"> <?= Yii::t("CartModule.cart", Yii::app()->getModule('store')->currency); ?></span>

                                    <div class="cart-item__action">
                                        <a class="js-cart__delete cart-delete-product"
                                           data-position-id="<?= $positionId; ?>">
                                            <i class="fa fa-fw fa-trash-o"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="order-box__bottom ">
                    <div class="cart-box__subtotal">
                        Итого: &nbsp;<span id="cart-total-product-count"><?= Yii::app()->cart->getCount(); ?></span>&nbsp;
                        товар(а)
                        на сумму &nbsp;<span id="cart-full-cost-with-shipping">0</span><span class="ruble"> <?= Yii::t(
                                "CartModule.cart",
                                "RUB"
                            ); ?></span>
                    </div>
                    <div class="cart-box__order-button">
                        <a class="btn btn_big btn_primary"href = "<?=$this->createUrl("/cart/delivery");?>"  >Оформить заказ</a>
                    </div>
                    <div class="orded-box__mini-text">Нажимая кнопку «Оформить заказ», я принимаю условия <a href = "Polzovatelskoe_soglashenie.docx">Пользовательского соглашения</a></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>