<?php $this->title = [Yii::t('default', 'Error') . ' ' . $error['code'], Yii::app()->getModule('yupe')->siteName]; ?>
<div class="main__title grid">
    <h1 class="h2"><?= Yii::t('default', 'Error') . ' ' . $error['code']; ?>!</h1>
</div>
<div class="main__product-description grid">
    <?php
    switch ($error['code']) {
        case '404':
            $msg = Yii::t(
                'default',
                'К сожалению, ссылка недействительная, но вы можете выбрать товары {link}',
                [
                    '{link}' => CHtml::link(
                        Yii::t('default', 'из нашего каталога'),
                        $this->createUrl("/" . Yii::app()->defaultController . '/store'),
                        [
                            'title' => Yii::t('default', 'из нашего каталога'),
                            'alt' => Yii::t('default', 'из нашего каталога'),
                        ]
                    ),

                ]
            );
            break;
        default:
            $msg = $error['message'];
            break;
    }
    ?>
    <p class="b-error"><?= $msg; ?></p>
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
