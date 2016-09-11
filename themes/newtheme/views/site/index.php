<?php $this->pageTitle = Yii::app()->getModule('yupe')->siteName; ?>

<div class="main__hit-slider grid">
    <?php
    $this->widget('application.modules.slide.widgets.SlideWidget',
        ["slideshow_identifier" => "mainpage", "containerClass" => "main__promo-slider", "height" => "650"]);
    ?>
</div>
<div class="main__hit-slider grid packs">
    <div class="h2">Хиты продаж</div>
    <div class="main__logos">
        <?php
        $criteria = new CDbCriteria();
        $criteria->compare("is_special", 1);
        $criteria->scopes = ["published"];
        $products = Product::model()->findAll($criteria);
        ?>
        <?php foreach ($products as $item): ?>
            <a href="<?= Yii::app()->createUrl('/store/product/view', ['name' => CHtml::encode($item->slug)]); ?>">
                <div class="main__logos_topseller_item">
                    <div class="main__topseller_logo">
                        <?php
                        $item->disableBehavior("upload");
                        $url = $item->getImageUrl(200, 200, false);
                        ?>
                        <img src="<?= $url ?>"/>
                    </div>
                    <div class="main__logo_topseller_item-title ">
                        <?= $item->title; ?>
                    </div>
                    <div class="product-price"><?= $item->getResultPrice() ?><span
                            class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                    </div>
                    <div class="btn btn_cart quick-add-product-to-cart" data-product-id="<?= $item->id; ?>"
                         data-cart-add-url="<?= Yii::app()->createUrl('/cart/cart/add'); ?>">
                        <?= Yii::t('StoreModule.store', 'Into cart') ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="main__hit-slider grid">
    <div class="b-reviews">
        <div style="margin: 0 auto">
            <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'servisy', 'layout' => 'main_logos']); ?>
        </div>
        <!--   <div class="b-reviews__item">
               <div class="b-reviews__item--logo">
               Логотип
               </div>
               <div class="b-reviews__item--description">
                   Описание
               </div>
           </div>
           <div class="b-reviews__item">
               <div class="b-reviews__item--logo">
                   Логотип
               </div>
               <div class="b-reviews__item--description">
                   Описание
               </div>
           </div>
           <div class="b-reviews__item">
               <div class="b-reviews__item--logo">
               Логотип
               </div>
               <div class="b-reviews__item--description">
                  Описание
               </div>
           </div>
           <div class="b-reviews__item">
               <div class="b-reviews__item--logo">
                 логотип
               </div>
               <div class="b-reviews__item--description">
                Описание
               </div>
           </div>
           <div class="b-reviews__item">
               <div class="b-reviews__item--logo">
               логотип
               </div>
               <div class="b-reviews__item--description">
                описание
               </div>
           </div>
           <div class="b-reviews__item">
               <div class="b-reviews__item--logo">
                 логотип
               </div>
               <div class="b-reviews__item--description">
                   описание
               </div>
           </div>-->
    </div>
    <!--
        <?php /*$this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'servisy', 'layout' => 'main_logos']); */ ?>

-->
</div>
<div class="main__hit-slider grid packs">
    <div class="h2">Наборы</div>
    <div class="main__logos">
        <?php
        $criteria = new CDbCriteria();
        $criteria->compare("type_id", 2);
        $products = Product::model()->findAll($criteria);
        $criteria->scopes = ["published"];
        ?>
        <?php foreach ($products as $item): ?>
            <a href="<?= Yii::app()->createUrl('/store/product/view', ['name' => CHtml::encode($item->slug)]); ?>">
                <div class="main__logos_item">
                    <div class="main__logo">
                        <img src="<?= StoreImage::product($item, 150, 150, false) ?>"/>
                    </div>
                    <div class="main__logo_item-title main__pack-title">
                        <?= $item->title; ?>
                    </div>
                    <div class="product-price"><?= $item->getResultPrice() ?><span
                            class="ruble"> <?= Yii::t("StoreModule.store", Yii::app()->getModule('store')->currency); ?></span>
                    </div>
                    <div class="btn btn_cart quick-add-product-to-cart" data-product-id="<?= $item->id; ?>"
                         data-cart-add-url="<?= Yii::app()->createUrl('/cart/cart/add'); ?>">
                        <?= Yii::t('StoreModule.store', 'Into cart') ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="main__hit-slider grid" style="padding: 3px">
    <div class="b-audio-feedback__title">
        «Отзывы о косметике «АлтайЯ»
    </div>
</div>
<div class="main__hit-slider grid" style="padding: 0 10px">
    <?php
    $reviews = Review::getByProduct(-1);
    ?>
    <?php foreach ($reviews as $item): ?>
        <div class="b-audio-feedback">
            <div style="display: flex">
                <div class="b-audio-feedback__head">
                    <div class="b-audio-feedback__info-author">
                        <div class="b-audio-feedback__name">
                            <?= $item->megauser->fio; ?>
                            <div class="b-audio-feedback__city">
                                <?= $item->megauser->adres; ?>
                            </div>
                            <div class="b-audio-feedback__date">
                                <?= $item->getDateAsString(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b-audio-feedback__body">
                    <div class="b-audio-feedback__description-audio">
                        <?= $item->text; ?>
                    </div>
                    <br>
                </div>
            </div>
            <?php if ($item->has_audio): ?>
                <div class="audio-player" style="width: 90%">
                    <audio class="audio" preload="true" src="<?= $item->getAudioPath(); ?>">
                    </audio>
                </div>
            <?php endif; ?>
            <?php if ($item->has_video): ?>
                <div class="b-youtube">
                    <div class="b-youtube__preview">
                        <a class="video-youtube" title="Отзыв"
                           href="<?= $item->getVideoPath(); ?>">Ссылка на youtube</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<div class="main__hit-slider grid" style="padding: 3px">
    <div class="b-audio-feedback__title">
        <a href="#">«Все аудио- и видео-отзывы» </a>
    </div>
</div>
<div class="main__hit-slider grid">
    <div class="h2">Органический мир косметики</div>
    <div class="widget last-posts-widget">
        <?php if ($this->beginCache('application.modules.blog.widgets.LastPostsWidget', ['duration' => $this->yupe->coreCacheTime])): ?>
            <?php $this->widget(
                'application.modules.blog.widgets.LastPostsWidget',
                ['cacheTime' => $this->yupe->coreCacheTime, "limit" => 2]
            ); ?>
            <?php $this->endCache(); ?>
        <?php endif; ?>
    </div>
</div>

<!--<div class="main__new-slider grid">
    <div class="new-slider js-overlay-items">
        <div class="h2">Новинки</div>
        <?php /*$this->widget('application.modules.store.widgets.ProductsFromCategoryWidget', ['slug' => 'chasy']); */ ?>
    </div>
</div>
<div class="main__recently-viewed-slider">
    <div class="grid">
        <div class="h3">Вы недавно смотрели</div>
        <div data-show='3' data-scroll='3' data-infinite="data-infinite" class="h-slider js-slick">
            <div class="h-slider__buttons h-slider__buttons_noclip">
                <div class="btn h-slider__control h-slider__next js-slick__next"></div>
                <div class="btn h-slider__control h-slider__prev js-slick__prev"></div>
            </div>
            <div class="h-slider__slides js-slick__container">
                <div class="h-slider__slide">
                    <div class="grid-module-4">
                        <div class="product-mini">
                            <div class="product-mini__thumbnail">
                                <a href="javascript:void(0);">
                                    <img src="<? /*= $this->mainAssets */ ?>/images/content/product-small-1.jpg" class="product-mini__img">
                                </a>
                            </div>
                            <div class="product-mini__info">
                                <div class="product-mini__title"><a href="javascript:void(0);" class="product-mini__link">Humani generis de regius</a>
                                </div>
                                <div class="product-mini__price">
                                    <div class="product-price">12304<span class="ruble"> руб.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-slider__slide">
                    <div class="grid-module-4">
                        <div class="product-mini">
                            <div class="product-mini__thumbnail">
                                <a href="javascript:void(0);">
                                    <img src="<? /*= $this->mainAssets */ ?>/images/content/product-small-1.jpg" class="product-mini__img">
                                </a>
                            </div>
                            <div class="product-mini__info">
                                <div class="product-mini__title"><a href="javascript:void(0);" class="product-mini__link">Humani generis de regius</a>
                                </div>
                                <div class="product-mini__price">
                                    <div class="product-price">12304<span class="ruble"> руб.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-slider__slide">
                    <div class="grid-module-4">
                        <div class="product-mini">
                            <div class="product-mini__thumbnail">
                                <a href="javascript:void(0);">
                                    <img src="<? /*= $this->mainAssets */ ?>/images/content/product-small-1.jpg" class="product-mini__img">
                                </a>
                            </div>
                            <div class="product-mini__info">
                                <div class="product-mini__title"><a href="javascript:void(0);" class="product-mini__link">Humani generis de regius</a>
                                </div>
                                <div class="product-mini__price">
                                    <div class="product-price">12304<span class="ruble"> руб.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-slider__slide">
                    <div class="grid-module-4">
                        <div class="product-mini">
                            <div class="product-mini__thumbnail">
                                <a href="javascript:void(0);">
                                    <img src="<? /*= $this->mainAssets */ ?>/images/content/product-small-1.jpg" class="product-mini__img">
                                </a>
                            </div>
                            <div class="product-mini__info">
                                <div class="product-mini__title"><a href="javascript:void(0);" class="product-mini__link">Humani generis de regius</a>
                                </div>
                                <div class="product-mini__price">
                                    <div class="product-price">12304<span class="ruble"> руб.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-slider__slide">
                    <div class="grid-module-4">
                        <div class="product-mini">
                            <div class="product-mini__thumbnail">
                                <a href="javascript:void(0);">
                                    <img src="<? /*= $this->mainAssets */ ?>/images/content/product-small-1.jpg" class="product-mini__img">
                                </a>
                            </div>
                            <div class="product-mini__info">
                                <div class="product-mini__title"><a href="javascript:void(0);" class="product-mini__link">Humani generis de regius</a>
                                </div>
                                <div class="product-mini__price">
                                    <div class="product-price">12304<span class="ruble"> руб.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
--><?php /*$this->widget('application.modules.store.widgets.ProducersWidget', ['limit' => 25]) */ ?>

