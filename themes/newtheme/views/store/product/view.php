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
                'homeLink' => '<li><a href="'.$this->createUrl("/").'">' . Yii::t('Yii.zii', 'Home') . '</a>',
                'activeLinkTemplate' => '<li><a href="{url}">{label}</a>',
                'inactiveLinkTemplate' => '<li><a>{label}</a>',
                'htmlOptions' => []
            ]
        );?>
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
            <div class="entry">
                <?php if (false):?>
                    <div class="entry__toolbar">
                        <div class="entry__toolbar-right">
                            <?php if(Yii::app()->hasModule('favorite')):?>
                                <?php $this->widget('application.modules.favorite.widgets.FavoriteControl', ['product' => $product, 'view' => '_in-product']);?>
                            <?php endif;?>
                            <?php if(Yii::app()->hasModule('compare')):?>
                                <a href="javascript:void(0);" class="entry__toolbar-button"><i class="fa fa-balance-scale"></i></a>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="product__title">
                    <h2 class="h2"><?= CHtml::encode($product->name); ?></h2>
                </div>
                <?php $slogan = $product->attribute( Attribute::model()->findByAttributes(['name' => "slogan"]) ); ?>
                <?php if ($slogan != null):?>
                    <div class="wysiwyg entry__slogan">
                        <?= $slogan;?>
                    </div>
                <?php endif; ?>
                <?php $tip_kozhi = $product->attribute( Attribute::model()->findByAttributes(['name' => "tip-kozhi"]) ); ?>
                <?php if ($tip_kozhi != null):?>
                    <div class="entry__attribute">
                        <div class="wysiwyg">
                            ТИП КОЖИ: <?= $tip_kozhi;?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php $tekstura = $product->attribute( Attribute::model()->findByAttributes(['name' => "tekstura"]) ); ?>
                <?php if ($tekstura != null):?>
                    <div class="entry__attribute">
                        <div class="wysiwyg">
                            ТЕКСТУРА: <?= $tekstura;?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php $deystvie = $product->attribute( Attribute::model()->findByAttributes(['name' => "deystvie"]) ); ?>
                <?php if ($deystvie != null):?>
                    <div class="entry__attribute">
                        <div class="wysiwyg">
                            ДЕЙСТВИЕ: <?= $deystvie;?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php $primenenie = $product->attribute( Attribute::model()->findByAttributes(['name' => "primenenie"]) ); ?>
                <?php if ($primenenie != null):?>
                    <div class="entry__attribute">
                        <div class="wysiwyg">
                            ПРИМЕНЕНИЕ: <?=$primenenie;?>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- <div class="entry__wysiwyg">
                    <div class="wysiwyg">
                        <?/*= $product->description; */?>
                    </div>
                </div>-->
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
                <?php $obem = $product->attribute( Attribute::model()->findByAttributes(['name' => "obem"]) ); ?>
                <?php if ($obem != null):?>
                    <div class="entry__attribute" style="margin-top: 0px">
                        Объем: <?= CHtml::encode($obem);?> мл
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
                        <span class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                        <?php if ($product->hasDiscount()): ?>
                            <div class="product-price product-price_old"><?= round($product->getBasePrice(), 2) ?><span class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (Yii::app()->hasModule('order')): ?>
                    <div class="entry__count">
                        <div class="entry__count-label">Кол-во:</div>
                        <div class="entry__count-input">
                                <span data-min-value='1' data-max-value='99' class="spinput js-spinput">
                                    <span class="spinput__minus js-spinput__minus product-quantity-decrease"></span>
                                    <input name="Product[quantity]" value="1" class="spinput__value" id="product-quantity-input"/>
                                    <span class="spinput__plus js-spinput__plus product-quantity-increase"></span>
                                </span>
                        </div>
                    </div>
                    <div class="entry__subtotal">
                        <span id="product-result-price"><?= round($product->getResultPrice(), 2); ?></span> x
                        <span id="product-quantity">1</span> =
                        <span id="product-total-price"><?= round($product->getResultPrice(), 2); ?></span>
                        <span class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span></div>
                <?php endif; ?>
                <?php if (Yii::app()->hasModule('order')): ?>
                    <div class="entry__cart-button">
                        <button class="btn btn_cart" id="add-product-to-cart"
                                data-loading-text="<?= Yii::t("StoreModule.store", "Adding"); ?>">
                               <?= Yii::t('StoreModule.store', 'Into cart') ?>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="entry__share">

                    <script type="text/javascript">(function(w,doc) {
                            if (!w.__utlWdgt ) {
                                w.__utlWdgt = true;
                                var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
                                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
                                var h=d[g]('body')[0];
                                h.appendChild(s);
                            }})(window,document);
                    </script>
                    <div data-background-alpha="0.0" data-buttons-color="#FFFFFF" data-counter-background-color="#ffffff" data-share-counter-size="12" data-top-button="false" data-share-counter-type="disable" data-share-style="1" data-mode="share" data-like-text-enable="false" data-mobile-view="true" data-icon-color="#ffffff" data-orientation="horizontal" data-text-color="#000000" data-share-shape="round-rectangle" data-sn-ids="vk.fb.ok." data-share-size="30" data-background-color="#ffffff" data-preview-mobile="false" data-mobile-sn-ids="fb.vk.tw.wh.ok.vb." data-pid="1504687" data-counter-background-alpha="1.0" data-following-enable="false" data-exclude-show-more="false" data-selection-enable="true" class="uptolike-buttons" ></div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php if ($product->type_id == 2):?>
    <?php $this->widget('application.modules.store.widgets.PackProductsWidget', ['product' => $product, 'code' => null,]); ?>
<?php else:?>
    <?php $this->widget('application.modules.store.widgets.LinkedProductsWidget', ['product' => $product, 'code' => null,]); ?>
<?php endif; ?>
<?php $this->widget('application.modules.store.widgets.IngridientsWidget', ['product' => $product, 'code' => null,]); ?>

