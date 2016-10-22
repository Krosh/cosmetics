<?php $this->pageTitle = Yii::app()->getModule('yupe')->siteName; ?>
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
                        <a href="<?= Yii::app()->createUrl('/store/product/view', ['name' => CHtml::encode($item->slug)]); ?>">  <?= $item->title; ?> </a>
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
    <div style="margin: 0 auto;">
        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'servisy', 'layout' => 'main_logos']); ?>
    </div>
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
        <div class="main__logos_item">
            <a href="<?= Yii::app()->createUrl('/store/product/view', ['name' => CHtml::encode($item->slug)]); ?>">
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

                    </div> </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="main__hit-slider grid" style="padding: 3px">
    <div class="h2">
        Отзывы о косметике «АлтайЯ»
    </div>
</div>
<div class="main__hit-slider grid" style="padding: 0 10px">
    <?php
    $reviews = Review::getByProduct(-1);
    ?>
    <?php foreach ($reviews as $item): ?>
        <div class="b-audio-feedback">
            <div>
                <div class="b-audio-feedback__body">
                    <div class="b-audio-feedback__description-audio">
                        <?= $item->text; ?>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="main__hit-slider grid" style="padding: 3px">
    <div class="b-audio-feedback__title">
        <a href="#">Все аудио- и видео-отзывы </a>
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
