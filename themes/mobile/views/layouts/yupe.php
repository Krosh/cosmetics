<!DOCTYPE html>
<html lang="<?= Yii::app()->getLanguage(); ?>">

<head>
    <?php
    \yupe\components\TemplateEvent::fire(ShopThemeEvents::HEAD_START);

    Yii::app()->getController()->widget(
        'vendor.chemezov.yii-seo.widgets.SeoHead',
        [
            'httpEquivs' => [
                'Content-Type' => 'text/html; charset=utf-8',
                'X-UA-Compatible' => 'IE=edge,chrome=1',
                'Content-Language' => 'ru-RU',
                'viewport' => 'width=1200',
                'imagetoolbar' => 'no',
                'msthemecompatible' => 'no',
                'cleartype' => 'on',
                'HandheldFriendly' => 'True',
                'format-detection' => 'telephone=no',
                'format-detection' => 'address=no',
                'apple-mobile-web-app-capable' => 'yes',
                'apple-mobile-web-app-status-bar-style' => 'black-translucent',
            ],
            'defaultTitle' => $this->yupe->siteName,
            'defaultDescription' => $this->yupe->siteDescription,
            'defaultKeywords' => $this->yupe->siteKeyWords,
        ]
    );

    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/slick.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/libs/select2/select2.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/mediaelementplayer.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery-ui.structure.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery-ui.theme.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery-ui.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/unslider.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/unslider-dots.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/rating.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery.rating.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery.fancybox.css');
    Yii::app()->getClientScript()->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/camera.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery.mmenu.all.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/mobile-style.css');
    Yii::app()->getClientScript()->registerCoreScript('jquery');
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/index.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/unslider-min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/slide.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery.collapse.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery.collapse_storage.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery.fancybox.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/overlay.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/product-gallery.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/slick.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/slick.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/tabs.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/toggle.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/libs/select2/select2.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/store.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/mediaelement-and-player.min.js');
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery-ui.js');
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/unslider-min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/camera.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/slide.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/rating.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery.rating-2.0.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery.rating.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery.mmenu.all.min.js', CClientScript::POS_END);
    ?>
    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/favicon/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/favicon/manifest.json">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <meta name='yandex-verification' content='50404e448d6a8a56'/>
    <script type="text/javascript">
        var yupeTokenName = '<?= Yii::app()->getRequest()->csrfTokenName;?>';
        var yupeToken = '<?= Yii::app()->getRequest()->getCsrfToken();?>';
        var yupeCartDeleteProductUrl = '<?= Yii::app()->createUrl('/cart/cart/delete/')?>';
        var yupeCartUpdateUrl = '<?= Yii::app()->createUrl('/cart/cart/update/')?>';
        var yupeCartWidgetUrl = '<?= Yii::app()->createUrl('/cart/cart/widget/')?>';
    </script>
    <?php \yupe\components\TemplateEvent::fire(ShopThemeEvents::HEAD_END); ?>
</head>

<body>
<?php \yupe\components\TemplateEvent::fire(ShopThemeEvents::BODY_START); ?>
<div id="page">
    <div class="header">
        <a href="#menu"><span></span></a>
    </div>
    <div class="content">
        <div class="row"></div>
        <div class="col-xs-12">
            123
        </div>
    </div>
    <nav id="menu">
        <ul>
            <li><a href="/login">Личный кабинет</a></li>
            <li><a href="/card">Корзина</a></li>
            <li><a href="<?= Yii::app()->createUrl('/store') ?>"> Каталог </a></li>
            <li>  <?php if (Yii::app()->hasModule('cart')): ?>
                    <?php $this->widget('application.modules.cart.widgets.ShoppingCartWidget'); ?>
                <?php endif; ?></li>
            <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'verhnee-menyu-s-kategoriyami']); ?>
            <?php /*$this->widget('application.modules.store.widgets.CategoryWidget', ['depth' => 2]); */ ?>
        </ul>
    </nav>
</div>
<script>
    $(document).ready(function () {
        $('nav#menu').mmenu();
    })
</script>
</body>
</html>