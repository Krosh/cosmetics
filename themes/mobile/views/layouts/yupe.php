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
    Yii::app()->getClientScript()->registerCoreScript('jquery');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery.rating.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery-ui.structure.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery-ui.theme.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery-ui.css');
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
    ?>
    <link rel="stylesheet" href="/themes/mobile/web/styles/bootstrap.css">
    <link rel="stylesheet" href="/themes/mobile/web/styles/font-awesome.css">
    <link rel="stylesheet" href="/themes/mobile/web/styles/slidebars.min.css">
    <link rel="stylesheet" href="/themes/mobile/web/styles/mobile-style.css">
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<div class="wrapper" canvas="container">
    <div class="header">
        <div class="header-menu">
            <div class="row">
                <div class="col-xs-3" style="padding: 0">
                    <div class="b-mmenu-btn">
                        <button class="btn-mmenu js-toggle-mmenu-overlay">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
                <div class="col-xs-2">
                </div>
                <div class="col-xs-7" style="padding: 0">
                    <div class="b-personal-area b-personal-area_current-color">
                        <a href="/profile" class="b-personal-area__link b-personal-area_current-color__link">
                            Личный Кабинет
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="row">
            <div class="col-xs-12" style="padding: 0">
                <div class="content">
                    <?= $content ?>
                </div>
                <div class="footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="footer__content">
                                <div class="b-social">
                                    <div class="b-social__title">
                                        АлтайЯ в социальных сетях
                                    </div>
                                    <div class="b-social__pic">
                                        <ul class="list-social__pic">
                                            <li><a href="https://www.facebook.com/ayaorganic.ru"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="http://vk.com/ayaorganic"><i class="fa fa-vk"></i></a></li>
                                            <li><a href="#"><i class="fa fa-youtube-play"></i> </a></li>
                                            <li><a href="https://www.instagram.com/ayaorganic.ru/"><i class="fa fa-instagram"></i> </a></li>
                                            <li><a href="http://ok.ru/group/53041416044757"><i class="fa fa fa-odnoklassniki"></i> </a></li>

                                        </ul>
                                    </div>
                                    <div class="b-social__title">
                                        Контакты
                                    </div>
                                    <div class="b-social__info">
                                        8-919-998-998-5
                                    </div>
                                    <div class="b-social__info">
                                        Адрес электронной почты zakaz@ayaorganic.ru
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
<div off-canvas="mmenu-overlay left overlay">
    <div class="b-mmenu-header">
        <div class="row">
            <div class="col-xs-7" style="padding: 0">
                <div class="b-mmenu-header__name">
                    Меню
                </div>
            </div>
            <div class="col-xs-5" style="padding: 0">
                <div class="b-mmenu-header__close">
                    <button class="btn-mmenu-close js-toggle-mmenu-overlay">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="b-mmenu-content">
        <ul class="list-b-mmenu-content">
            <li><a class="cart__link" href="/cart">Корзина <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            </li>
            <li><a href="/">Главная</a></li>
            <li><a href="/store">Каталог</a></li>
            <?php $this->widget('application.modules.store.widgets.CategoryWidget', [
                'view' => 'footer'
            ]); ?>
        </ul>
    </div>
    <div class="b-mmenu-footer">
        <ul class="list-b-mmenu-footer">
            <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'servisy-s-korotkimi-nazvaniyami', 'layout' => 'footer']); ?>
        </ul>
    </div>
</div>
<script src="/themes/mobile/web/js/slidebars.min.js"></script>
<script src="/themes/mobile/web/js/mobile-script.js"></script>
<script>
    $(function () {
        $("#dialog-confirm").dialog({
            modal: true,
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 500,
        });
    });
    $(function () {
        $("#dialog-close").dialog({
            modal: true,
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox").fancybox({
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {


        $('#js-modal-rating').rating({
            fx: 'half',
            image: '/stars.png',
            loader: '/ajax-loader.gif',
            callback: function (responce) {
                this.vote_success.fadeOut(2000);
            }
        });
    })
</script>

<script type="text/javascript">
    $(function () {
        $('.rating-reviews').ratingReviews({
            fx: 'half',
            image: '/stars.png',
            loader: '/ajax-loader.gif',
            callback: function (responce) {
                this.vote_success.fadeOut(2000);
            }
        });
    })
</script>
<script>
    $(document).ready(function () {
        $(".video-youtube").click(function () {
            $.fancybox({
                'padding': 0,
                'autoScale': false,
                'transitionIn': 'none',
                'transitionOut': 'none',
                'title': this.title,
                'width': 640,
                'height': 385,
                'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
                'helpers': {
                    overlay: {
                        locked: false
                    }
                },
                'type': 'swf',
                'swf': {
                    'wmode': 'transparent',
                    'allowfullscreen': 'true'
                }
            });
            return false;
        });
    });
</script>
</body>
</html>