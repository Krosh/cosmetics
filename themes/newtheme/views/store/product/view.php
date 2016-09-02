<?php

/* @var $product Product */

$this->pageTitle = $product->getMetaTitle();
$this->description = $product->getMetaDescription();
$this->keywords = $product->getMetaKeywords();

Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/store.js', CClientScript::POS_END);

$this->breadcrumbs = array_merge(
    [Yii::t("StoreModule.store", 'Catalog') => ['/store/product/index']],
    $product->category ? $product->category->getBreadcrumbs(true) : [],
    [CHtml::encode($product->name)]
);
?>
<div class="main__breadcrumbs grid">
    <div class="breadcrumbs">
        <?php $this->widget(
            'zii.widgets.CBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
                'tagName' => 'ul',
                'separator' => '',
                'homeLink' => '<li><a href="' . $this->createUrl("/") . '">' . Yii::t('Yii.zii', 'Home') . '</a>',
                'activeLinkTemplate' => '<li><a href="{url}">{label}</a>',
                'inactiveLinkTemplate' => '<li><a>{label}</a>',
                'htmlOptions' => []
            ]
        ); ?>
    </div>
</div>
<div class="main__product-description grid">
    <div class="product-description">
        <div class="product-description__img-block grid-module-5">
            <div class="product-gallery js-product-gallery">
                <div class="product-gallery__body">
                    <div data-product-image class="product-gallery__img-wrap">
                        <img src="<?= StoreImage::product($product); ?>" class="product-gallery__main-img">
                    </div>
                    <?php if ($product->isSpecial()): ?>
                        <div class="product-gallery__label">
                            <div class="product-label product-label_hit big-label">
                                <div class="product-label__text">Хит</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="product-gallery__nav">
                    <a href="<?= StoreImage::product($product); ?>" rel="group" data-product-thumbnail
                       class="product-gallery__nav-item">
                        <img src="<?= $product->getImageUrl(60, 60, false); ?>" alt=""
                             class="product-gallery__nav-img">
                    </a>
                    <?php foreach ($product->getImages() as $key => $image): ?>
                        <a href="<?= $image->getImageUrl(); ?>" rel="group" data-product-thumbnail
                           class="product-gallery__nav-item">
                            <img src="<?= $image->getImageUrl(60, 60, false); ?>" alt=""
                                 class="product-gallery__nav-img">
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="product-description__entry grid-module-4">
            <div id="js-height-block">
                <div class="entry">
                    <?php if (false): ?>
                        <div class="entry__toolbar">
                            <div class="entry__toolbar-right">
                                <?php if (Yii::app()->hasModule('favorite')): ?>
                                    <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', ['product' => $product, 'view' => '_in-product']); ?>
                                <?php endif; ?>
                                <?php if (Yii::app()->hasModule('compare')): ?>
                                    <a href="javascript:void(0);" class="entry__toolbar-button"><i
                                            class="fa fa-balance-scale"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="product__rating">
                        <div class="rating-star" style="height: 30px;width: 30px"></div>
                        <div class="rating-star" style="height: 30px;width: 30px"></div>
                        <div class="rating-star" style="height: 30px;width: 30px"></div>
                        <div class="rating-star" style="height: 30px;width: 30px"></div>
                        <div class="rating-star-none" style="height: 30px;width: 30px"></div>
                    </div>
                    <div class="product__title">
                        <h2 class="h2"><?= CHtml::encode($product->name); ?></h2>
                    </div>
                    <?php $slogan = $product->attribute(Attribute::model()->findByAttributes(['name' => "slogan"])); ?>
                    <?php if ($slogan != null): ?>
                        <div class="wysiwyg entry__slogan">
                            <?= $slogan; ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry__cart-button">
                        <button class="btn btn_cart" id="add-product-to-cart"
                                data-loading-text="<?= Yii::t("StoreModule.store", "Adding"); ?>">
                            <?= Yii::t('StoreModule.store', 'Into cart') ?>
                        </button>
                    </div>
                    <?php $tip_kozhi = $product->attribute(Attribute::model()->findByAttributes(['name' => "tip-kozhi"])); ?>
                    <?php if ($tip_kozhi != null): ?>
                        <div class="entry__attribute">
                            <div class="wysiwyg">
                                ТИП КОЖИ: <?= $tip_kozhi; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $tekstura = $product->attribute(Attribute::model()->findByAttributes(['name' => "tekstura"])); ?>
                    <?php if ($tekstura != null): ?>
                        <div class="entry__attribute">
                            <div class="wysiwyg">
                                ТЕКСТУРА: <?= $tekstura; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $deystvie = $product->attribute(Attribute::model()->findByAttributes(['name' => "deystvie"])); ?>
                    <?php if ($deystvie != null): ?>
                        <div class="entry__attribute">
                            <div class="wysiwyg">
                                ДЕЙСТВИЕ: <?= $deystvie; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- <div class="entry__wysiwyg">
                    <div class="wysiwyg">
                        <? /*= $product->description; */ ?>
                    </div>
                </div>-->
                </div>

            </div>
            <div class="b-next-read">
                <div class="b-next-read-shadow"></div>
                <button id="btn-next-read">Читать далее</button>
            </div>

        </div>
        <div class="product-description__buy grid-module-1">

        </div>
        <div class="product-description__buy grid-module-2">
            <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post">
                <input type="hidden" name="Product[id]" value="<?= $product->id; ?>"/>
                <?= CHtml::hiddenField(
                    Yii::app()->getRequest()->csrfTokenName,
                    Yii::app()->getRequest()->csrfToken
                ); ?>

                <div class="entry__obem">
                </div>
                <?php $obem = $product->attribute(Attribute::model()->findByAttributes(['name' => "obem"])); ?>
                <?php if ($obem != null): ?>
                    <div class="entry__attribute" style="margin-top: 0px">
                        Объем: <?= CHtml::encode($obem); ?> мл
                    </div>
                <?php endif; ?>

                <?php if ($product->getVariantsGroup()): ?>

                    <div class="entry__title">
                        <h2 class="h3 h_upcase"><?= Yii::t("StoreModule.store", "Variants"); ?></h2>
                    </div>

                    <div class="entry__variants">
                        <?php foreach ($product->getVariantsGroup() as $title => $variantsGroup): ?>
                            <div class="entry__variant">
                                <div class="entry__variant-title"><?= CHtml::encode($title); ?></div>
                                <div class="entry__variant-value">
                                    <?=
                                    CHtml::dropDownList('ProductVariant[]', null, CHtml::listData($variantsGroup, 'id', 'optionValue'), [
                                        'empty' => '--выберите--',
                                        'class' => 'js-select2 entry__variant-value-select noborder',
                                        'options' => $product->getVariantsOptions()
                                    ]); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="entry__price">
                    <div class="product-price">
                        <input type="hidden" id="base-price"
                               value="<?= round($product->getResultPrice(), 2); ?>"/>
                        <span id="result-price"><?= round($product->getResultPrice(), 2); ?></span>
                        <span
                            class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                        <?php if ($product->hasDiscount()): ?>
                            <div class="product-price product-price_old"><?= round($product->getBasePrice(), 2) ?>
                                <span
                                    class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($product->status == Product::STATUS_ACTIVE): ?>
                    <div class="entry__count">
                        <div class="entry__count-label">Кол-во:</div>
                        <div class="entry__count-input">
                                <span data-min-value='1' data-max-value='99' class="spinput js-spinput">
                                    <span class="spinput__minus js-spinput__minus product-quantity-decrease"></span>
                                    <input name="Product[quantity]" value="1" class="spinput__value"
                                           id="product-quantity-input"/>
                                    <span class="spinput__plus js-spinput__plus product-quantity-increase"></span>
                                </span>
                        </div>
                    </div>
                    <div class="entry__subtotal">
                        <span id="product-result-price"><?= round($product->getResultPrice(), 2); ?></span> x
                        <span id="product-quantity">1</span> =
                        <span id="product-total-price"><?= round($product->getResultPrice(), 2); ?></span>
                        <span
                            class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                    </div>
                <?php else: ?>
                    <div class="product-vertical-extra__cart">
                        <div class="product-vertical__non-in-stock">
                            Нет в наличии
                        </div>
                    </div>
                <?php endif; ?>
                <div class="entry__share">

                    <script type="text/javascript">(function (w, doc) {
                            if (!w.__utlWdgt) {
                                w.__utlWdgt = true;
                                var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
                                s.type = 'text/javascript';
                                s.charset = 'UTF-8';
                                s.async = true;
                                s.src = ('https:' == w.location.protocol ? 'https' : 'http') + '://w.uptolike.com/widgets/v1/uptolike.js';
                                var h = d[g]('body')[0];
                                h.appendChild(s);
                            }
                        })(window, document);
                    </script>
                    <div data-background-alpha="0.0" data-buttons-color="#FFFFFF"
                         data-counter-background-color="#ffffff" data-share-counter-size="12"
                         data-top-button="false"
                         data-share-counter-type="disable" data-share-style="1" data-mode="share"
                         data-like-text-enable="false" data-mobile-view="true" data-icon-color="#ffffff"
                         data-orientation="horizontal" data-text-color="#000000" data-share-shape="round-rectangle"
                         data-sn-ids="vk.fb.ok." data-share-size="30" data-background-color="#ffffff"
                         data-preview-mobile="false" data-mobile-sn-ids="fb.vk.tw.wh.ok.vb." data-pid="1504687"
                         data-counter-background-alpha="1.0" data-following-enable="false"
                         data-exclude-show-more="false" data-selection-enable="true" class="uptolike-buttons"></div>
                </div>

            </form>
        </div>
    </div>
</div>
<div class="main__product-tabs grid">
    <div class="tabs tabs_classic tabs_gray js-tabs">
        <ul data-nav="data-nav" class="tabs__list">
            <li class="tabs__item"><a href="#tab1"
                                      class="tabs__link"> ИНГРЕДИЕНТЫ <img
                        style="height: 15px;margin-left: 20px;vertical-align: middle;margin-bottom: 5px;"
                        src="<?= $this->mainAssets ?>/images/triangle.png" alt=""> </a>
            </li>
            <li class="tabs__item"><a href="#tab2"
                                      class="tabs__link"> ПРИМЕНЕНИЕ <img
                        style="height: 15px;margin-left: 20px;vertical-align: middle;margin-bottom: 5px;"
                        src="<?= $this->mainAssets ?>/images/triangle.png" alt=""> </a>
            </li>
            <li class="tabs__item"><a href="#tab3"
                                      class="tabs__link">ХРАНЕНИЕ <img
                        style="height: 15px;margin-left: 20px;vertical-align: middle;margin-bottom: 5px;"
                        src="<?= $this->mainAssets ?>/images/triangle.png" alt=""> </a>
            </li>
            <li class="tabs__item"><a href="#tab4"
                                      class="tabs__link">ОТЗЫВЫ (5) <img
                        style="height: 15px;margin-left: 20px;vertical-align: middle;margin-bottom: 5px;"
                        src="<?= $this->mainAssets ?>/images/triangle.png" alt=""> </a>
            </li>
        </ul>
        <div class="tabs__bodies js-tabs-bodies">
            <div id="tab1" class="tabs__body js-tab">
                <?php if ($product->category_id != 6): ?>
                    <?php $this->widget('application.modules.store.widgets.IngridientsWidget', ['product' => $product, 'code' => null,]); ?>
                <?php endif; ?>
            </div>
            <div id="tab2" class="tabs__body js-tab">
                <?php $primenenie = $product->attribute(Attribute::model()->findByAttributes(['name' => "primenenie"])); ?>
                <?php if ($primenenie != null): ?>
                    <div class="entry__attribute">
                        <div class="wysiwyg">
                            <div class="h3 tabs__title" style="text-align: center">ПРИМЕНЕНИЕ:</div>
                            <br>
                            <?= $primenenie; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div id="tab3" class="tabs__body js-tab">
                <?php $hraneniya = $product->attribute(Attribute::model()->findByAttributes(['name' => "usloviya-hraneniya"])); ?>
                <?php if ($hraneniya != null): ?>
                    <div class="entry__attribute">
                        <div class="wysiwyg">
                            <div class="h3 tabs__title" style="text-align: center">ХРАНЕНИЕ:</div>
                            <br>
                            <?= $hraneniya; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div id="tab4" class="tabs__body js-tab">
                <div class="h3 tabs__title" style="text-align: center">ОТЗЫВЫ</div>
                <br>
                <div class="b-rewies-product--alert">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies vulputate elit, a
                    pretium erat sagittis accumsan. Etiam non arcu ac urna fringilla congue sed a est. <span
                        class="ui-icon ui-icon-alert"></span>
                </div>
                <div class="b-rewies-product">
                    <div class="b-rewies-product__head">
                        <div class="b-rewies-product__head--avatar">
                            <div class="head--avatar">
                                <div class="social_pic">

                                </div>
                            </div>
                        </div>
                        <div class="b-rewies-product__head--info">
                            Елена
                        </div>
                    </div>
                    <div class="b-rewies-product__body">
                        <div class="b-rewies-product__body--star">
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star-none" style="height: 20px;width: 20px"></div>
                        </div>
                        <div class="b-rewies-product__body--text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis consequat finibus interdum. In
                            hac habitasse platea dictumst. Vestibulum tincidunt non velit nec faucibus. Quisque
                            ultricies urna consectetur erat pulvinar, nec feugiat sapien luctus. Vivamus vitae dolor a
                            lacus porttitor pretium. Mauris sit amet placerat odio, eu vestibulum diam. Aenean eleifend
                            lectus id neque blandit scelerisque. Maecenas convallis nec ipsum sit amet lacinia. Aliquam
                            erat volutpat.
                        </div>
                    </div>

                </div>
                <div class="b-rewies-product">
                    <div class="b-rewies-product__head">
                        <div class="b-rewies-product__head--avatar">
                            <div class="head--avatar">
                                <div class="social_pic">

                                </div>
                            </div>
                        </div>
                        <div class="b-rewies-product__head--info">
                            Елена
                        </div>
                    </div>
                    <div class="b-rewies-product__body">
                        <div class="b-rewies-product__body--star">
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star-none" style="height: 20px;width: 20px"></div>
                        </div>
                        <div class="b-rewies-product__body--text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis consequat finibus interdum. In
                            hac habitasse platea dictumst. Vestibulum tincidunt non velit nec faucibus. Quisque
                            ultricies urna consectetur erat pulvinar, nec feugiat sapien luctus. Vivamus vitae dolor a
                            lacus porttitor pretium. Mauris sit amet placerat odio, eu vestibulum diam. Aenean eleifend
                            lectus id neque blandit scelerisque. Maecenas convallis nec ipsum sit amet lacinia. Aliquam
                            erat volutpat.
                        </div>
                    </div>

                </div>
                <div class="b-rewies-product">
                    <div class="b-rewies-product__head">
                        <div class="b-rewies-product__head--avatar">
                            <div class="head--avatar">
                                <div class="social_pic">

                                </div>
                            </div>
                        </div>
                        <div class="b-rewies-product__head--info">
                            Елена
                        </div>
                    </div>
                    <div class="b-rewies-product__body">
                        <div class="b-rewies-product__body--star">
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star" style="height: 20px;width: 20px"></div>
                            <div class="rating-star-none" style="height: 20px;width: 20px"></div>
                        </div>
                        <div class="b-rewies-product__body--text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis consequat finibus interdum. In
                            hac habitasse platea dictumst. Vestibulum tincidunt non velit nec faucibus. Quisque
                            ultricies urna consectetur erat pulvinar, nec feugiat sapien luctus. Vivamus vitae dolor a
                            lacus porttitor pretium. Mauris sit amet placerat odio, eu vestibulum diam. Aenean eleifend
                            lectus id neque blandit scelerisque. Maecenas convallis nec ipsum sit amet lacinia. Aliquam
                            erat volutpat.
                        </div>
                    </div>

                </div>
                <div style="text-align: right">
                    <button class="btn" id="btn-reviews" type="button" onclick="$('#dialog-confirm').dialog('open');">
                        Оставить свой отзыв
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dialog-confirm" title="Отзыв о <?= CHtml::encode($product->name); ?>">
    <?php if (Yii::app()->user->getId() > 0): ?>
        <div class="b-modal-reviews">
            <div class="b-modal-reviews__head">
                <div class="b-modal-reviews__question">
                    Вам понравился товар ?
                </div>
                <div class="b-modal-reviews__rating">
                    <div style="display: inline-block">
                        <ul id="stars"></ul>
                    </div>
                </div>
            </div>
            <form action="" id="b-modal__form">
                <?=
                CHtml::hiddenField(
                    Yii::app()->getRequest()->csrfTokenName,
                    Yii::app()->getRequest()->csrfToken
                ); ?>
                <div class="b-modal-reviews__body">
                    <input type="text" id="modal__rating" name="modal__rating" hidden>
                    <textarea class="b-modal-reviews__textarea" name="b-modal-reviews__text" id="">
                    </textarea>
                </div>
                <div class="b-modal-reviews__btns">
                    <button class="btn" type="submit"> Отправить</button>
                </div>
            </form>
        </div>
    <?php else: ?>
        Надо авторизоваться, тут форма для авторизации блаблабла<br>
        <?php
        $this->widget('ext.eauth.EAuthWidget', array('action' => '/loginFromSocial'));
        ?>
    <?php endif; ?>

</div>

<div id="dialog-close" title="Спасибо за отзыв">
    <div>
        Спасибо за отзыв
    </div>
</div>


<?php if ($product->type_id == 2): ?>
    <?php $this->widget('application.modules.store.widgets.PackProductsWidget', ['product' => $product, 'code' => null,]); ?>
<?php else: ?>
    <?php $this->widget('application.modules.store.widgets.LinkedProductsWidget', ['product' => $product, 'code' => null,]); ?>
<?php endif; ?>
<script>
    $(document).ready(
        function () {
            var el = document.getElementById('stars');
            if (el == null) {
                return;
            }
            var currentRating = 0;
            var maxRating = 5;
            var callback = function (rating) {
                $("#modal__rating").val(rating);
            };
            var myRating = rating(el, currentRating, maxRating, callback);
        }
    )
</script>
<script>
    $("#b-modal__form").submit(
        function () {
            $.ajax(
                {
                    type: "POST",
                    url: "/review/add",
                    data: $("#b-modal__form").serialize()
                }
            ).done(
                function () {
                    $('#dialog-confirm').dialog('close');
                    $('#dialog-close').dialog('open');
                    setTimeout(function () { $('#dialog-close').dialog('close');}, 3000)
                }
            );
            return false
        }
    )
</script>