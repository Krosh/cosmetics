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


$reviews = Review::getByProduct($product->id);
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
<div class="product__title">
    <h2 class="h2"><?= CHtml::encode($product->name); ?></h2>
</div>
<div class="main__product-description grid">
    <div class="product-description">
        <div class="product-description__img-block grid-module-5">
            <div class="product-gallery js-product-gallery">
                <form action="<?= Yii::app()->createUrl('cart/cart/add'); ?>" method="post">
                    <div class="product-gallery__body">
                        <div data-product-image class="product-gallery__img-wrap">
                            <img src="<?= StoreImage::product($product); ?>" class="product-gallery__main-img">
                        </div>
                    </div>
                    <?php if ($product->isSpecial()): ?>
                        <div class="product-gallery__label">
                            <div class="product-label product-label_hit big-label">
                                <div class="product-label__text">Хит</div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $hraneniya = $product->attribute(Attribute::model()->findByAttributes(['name' => "novinka"])); ?>
                    <?php if ($hraneniya != null): ?>
                        <div class="product-gallery__label">
                            <div class="product-label product-label_hit">
                                <div class="product-label__text">NEW</div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="product__rating">
                        Рейтинг: <?= Review::getRating($product->id); ?>
                        <div class="rating-count">
                            Оценки (<?= count($reviews); ?>)
                        </div>
                    </div>

                    <div class="entry__price">
                        <div class="product-price">
                            <input type="hidden" id="base-price"
                                   value="<?= round($product->getResultPrice(), 2); ?>"/>
                            <span id="result-price"><?= round($product->getResultPrice(), 2); ?></span>
                        <span
                            class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                            <?php if ($product->hasDiscount()): ?>
                                <div
                                    class="product-price product-price_old"><?= round($product->getBasePrice(), 2) ?>
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
                    <div class="entry__cart-button">
                        <button class="btn btn_cart" id="add-product-to-cart"
                                data-loading-text="<?= Yii::t("StoreModule.store", "Adding"); ?>">
                            <?= Yii::t('StoreModule.store', 'Into cart') ?>
                        </button>
                    </div>


                    <div class="product-gallery__nav">
                        <img src="<?= $product->getImageUrl(); ?>" alt=""
                             class="product-gallery__nav-img">
                        <?php foreach ($product->getImages() as $key => $image): ?>
                            <img src="<?= $image->getImageUrl(); ?>" alt=""
                                 class="product-gallery__nav-img">
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
                    <?php $slogan = $product->attribute(Attribute::model()->findByAttributes(['name' => "slogan"])); ?>
                    <?php if ($slogan != null): ?>
                        <div class="wysiwyg entry__slogan">
                            <?= $slogan; ?>
                        </div>
                    <?php endif; ?>
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
                        <?php
                        $end = strpos($deystvie, '</p>');
                        $firstPart = substr($deystvie, 0, $end + 4);
                        $secondPart = substr($deystvie, $end + 4);
                        ?>
                        <div class="entry__attribute">
                            <div class="wysiwyg">
                                ДЕЙСТВИЕ:
                                <br>

                                <div class="preview-product-description">
                                    <?= $firstPart; ?>
                                    <br>
                                    <?= $secondPart; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="product-description__buy grid-module-1">

        </div>
        <div class="product-description__buy grid-module-2">

            <input type="hidden" name="Product[id]" value="<?= $product->id; ?>"/>
            <?=
            CHtml::hiddenField(
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
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="tabs">
            <?php if ($product->category_id != 6): ?>
                <?php $this->widget('application.modules.store.widgets.IngridientsWidget', ['product' => $product, 'code' => null,]); ?>
            <?php endif; ?>
        </div>

        <div class="tabs">
            <div class="tabs__title">
                ПРИМЕНЕНИЕ:
            </div>
            <div class="tabs__content">
                <?php $primenenie = $product->attribute(Attribute::model()->findByAttributes(['name' => "primenenie"])); ?>
                <?php if ($primenenie != null): ?>
                    <div class="wysiwyg">
                        <?= $primenenie; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="tabs">
            <div class="tabs__title">
                ХРАНЕНИЕ:
            </div>
            <div class="tabs__content">
                <?php $hraneniya = $product->attribute(Attribute::model()->findByAttributes(['name' => "usloviya-hraneniya"])); ?>
                <?php if ($hraneniya != null): ?>
                    <div class="wysiwyg">
                        <?= $hraneniya; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="tabs">
            <div class="tabs__title">
                ОТЗЫВЫ:
            </div>
            <?php if (Review::hasNonModerated($product->id)): ?>
                <div class="b-reviews-product--alert">
                    Ваш отзыв появится после модерации <span
                        class="ui-icon ui-icon-alert"></span>
                </div>
            <?php endif; ?>

            <?php foreach ($reviews as $review): ?>
                <div class="b-reviews-product">
                    <div class="b-reviews-product__head">
                        <div class="b-reviews-product__head--info">
                            <a href="<?= $review->megauser->social_link; ?>"> <?= $review->megauser->fio; ?> </a>
                        </div>
                    </div>
                    <div class="b-reviews-product__body">
                        <div class="b-reviews-product__body--text">
                            <?= $review->text; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div style="text-align: right">
                <button class="btn_cart btn_inverse  btn" id="btn-reviews" type="button">
                    Оставить свой отзыв
                </button>
            </div>
        </div>

        <div class="b-confirm-reviews">
            <?php if (Yii::app()->user->getId() > 0): ?>
                <div class="b-modal-reviews">
                    <div class="b-modal-reviews__head">
                        <div class="b-modal-reviews__question">
                            Вам понравился товар ?
                        </div>
                    </div>
                    <form action="" id="b-modal__form">
                        <?=
                        CHtml::hiddenField(
                            Yii::app()->getRequest()->csrfTokenName,
                            Yii::app()->getRequest()->csrfToken
                        ); ?>
                        <div class="b-modal-reviews__body">
                            <label for="modal__rating">Ваша оценка: </label>

                            <div class="rating__info">От 1 до 5</div>
                            <input type="text" id="modal__rating" value="4" name="modal__rating">
                            <br>
                            <input type="text" id="modal__product-id" name="modal__product-id"
                                   value="<?= CHtml::encode($product->id); ?>"
                                   hidden>
                            <label for="b-modal-reviews__text">Ваш комментарий: </label>
                            <br>
                            <textarea class="b-modal-reviews__textarea" name="b-modal-reviews__text"
                                      id="b-modal-reviews__text">
                            </textarea>
                        </div>
                        <div class="b-modal-reviews__btns">
                            <button class="btn_cart btn" type="submit"> Отправить</button>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <div class="social_form">
                    <div>
                        <?php
                        $this->widget('ext.eauth.EAuthWidget', array('action' => '/loginFromSocial', "needShowDialogReview" => 1));
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--<div class="main__product-tabs grid">
    <div class="tabs tabs_classic tabs_gray js-tabs">
        <ul data-nav="data-nav" class="tabs__list">
            <li class="tabs__item"><a href="#tab1"
                                      class="tabs__link"> ИНГРЕДИЕНТЫ <img
                        style="height: 15px;margin-left: 20px;vertical-align: middle;margin-bottom: 5px;"
                        src="<?/*= $this->mainAssets */?>/images/triangle.png" alt=""> </a>
            </li>
            <li class="tabs__item"><a href="#tab2"
                                      class="tabs__link"> ПРИМЕНЕНИЕ <img
                        style="height: 15px;margin-left: 20px;vertical-align: middle;margin-bottom: 5px;"
                        src="<?/*= $this->mainAssets */?>/images/triangle.png" alt=""> </a>
            </li>
            <li class="tabs__item"><a href="#tab3"
                                      class="tabs__link">ХРАНЕНИЕ <img
                        style="height: 15px;margin-left: 20px;vertical-align: middle;margin-bottom: 5px;"
                        src="<?/*= $this->mainAssets */?>/images/triangle.png" alt=""> </a>
            </li>
            <li class="tabs__item"><a href="#tab4"
                                      class="tabs__link">ОТЗЫВЫ (<?/*= count($reviews); */?>) <img
                        style="height: 15px;margin-left: 20px;vertical-align: middle;margin-bottom: 5px;"
                        src="<?/*= $this->mainAssets */?>/images/triangle.png" alt=""> </a>
            </li>
        </ul>
        <div class="tabs__bodies js-tabs-bodies">
            <div id="tab1" class="tabs__body js-tab">
                <?php /*if ($product->category_id != 6): */?>
                    <?php /*$this->widget('application.modules.store.widgets.IngridientsWidget', ['product' => $product, 'code' => null,]); */?>
                <?php /*endif; */?>
            </div>
            <div id="tab2" class="tabs__body js-tab">
                <?php /*$primenenie = $product->attribute(Attribute::model()->findByAttributes(['name' => "primenenie"])); */?>
                <?php /*if ($primenenie != null): */?>
                    <div class="entry__attribute">

                        <div class="h3 tabs__title" style="text-align: center">ПРИМЕНЕНИЕ:</div>
                        <br>

                        <div class="wysiwyg">
                            <?/*= $primenenie; */?>
                        </div>
                    </div>
                <?php /*endif; */?>
            </div>
            <div id="tab3" class="tabs__body js-tab">
                <?php /*$hraneniya = $product->attribute(Attribute::model()->findByAttributes(['name' => "usloviya-hraneniya"])); */?>
                <?php /*if ($hraneniya != null): */?>
                    <div class="entry__attribute">
                        <div class="h3 tabs__title" style="text-align: center">ХРАНЕНИЕ:</div>
                        <br>

                        <div class="wysiwyg">
                            <?/*= $hraneniya; */?>
                        </div>
                    </div>
                <?php /*endif; */?>
            </div>
            <div id="tab4" class="tabs__body js-tab">
                <div class="h3 tabs__title" style="text-align: center">ОТЗЫВЫ</div>
                <br>

                <?php /*if (Review::hasNonModerated($product->id)): */?>
                    <div class="b-reviews-product--alert">
                        Ваш отзыв появится после модерации <span
                            class="ui-icon ui-icon-alert"></span>
                    </div>
                <?php /*endif; */?>

                <?php /*foreach ($reviews as $review): */?>
                    <div class="b-reviews-product">
                        <div class="b-reviews-product__head">
                            <div class="b-reviews-product__head--avatar">
                                <div class="head--avatar"
                                     style="background-image:url('<?/*= $review->megauser->avatar_path; */?>')">

                                    <?php /*if ($review->megauser->social_type > 0): */?>
                                        <div class="social_pic"
                                             style="background-image:url('<?/*= $this->mainAssets */?>/images/<?/*= $review->megauser->social_type */?>.png')">

                                        </div>
                                    <?php /*endif; */?>
                                </div>
                            </div>
                            <div class="b-reviews-product__head--info">
                                <a href="<?/*= $review->megauser->social_link; */?>"> <?/*= $review->megauser->fio; */?> </a>
                            </div>
                        </div>
                        <div class="b-reviews-product__body">
                            <div class="b-reviews-product__body--star">
                                <div class="b-reviews-product__body--rating">
                                    <div class="rating-reviews">
                                        <input type="hidden" name="val" value="<?/*= $review->rating; */?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="b-reviews-product__body--text">
                                <?/*= $review->text; */?>
                                <div class="b-reviews-product__body--text--time">
                                    <?/*= $review->date_add; */?>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php /*endforeach; */?>

                <div style="text-align: right">
                    <button class="btn_cart btn" id="btn-reviews" type="button">
                        Оставить свой отзыв
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>-->
<?php if ($product->type_id == 2): ?>
    <?php $this->widget('application.modules.store.widgets.PackProductsWidget', ['product' => $product, 'code' => null,]); ?>
<?php else: ?>
    <?php $this->widget('application.modules.store.widgets.LinkedProductsWidget', ['product' => $product, 'code' => null,]); ?>
<?php endif; ?>
<script>
    $("#btn-reviews").on("click", function () {
        $(".b-confirm-reviews").show();
    })
</script>


<script>
    $("#b-modal__form").submit(
        function () {

            if ($("#modal__rating").val() > 0 && $("#modal__rating").val() <= 5) {

                $.ajax(
                    {
                        type: "POST",
                        url: "/review/add",
                        data: $("#b-modal__form").serialize()
                    }
                ).done(
                    function () {
                        $("#b-modal__form").trigger("reset");
                        $(".b-confirm-reviews").hide();
                    }
                );
                return false
            }
            else {
                $(".rating__info").css("color", "red");
                return false
            }


        }
    )

    <?php if (Yii::app()->user->getFlash("needShowDialogReview") == 1):?>
    $(document).ready(
        function () {
            var url = window.location;
            $(location).attr('href', url + "#tab4");
            setTimeout(function () {
                $('#dialog-confirm').dialog('open');
            }, 1500)
        }
    )
    <?php endif; ?>
</script>
