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
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/common.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/mediaelementplayer.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery-ui.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery-ui.structure.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/jquery-ui.theme.css');
    Yii::app()->getClientScript()->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css');

    Yii::app()->getClientScript()->registerCoreScript('jquery');
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/index.js', CClientScript::POS_END);
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
<div class="main">
    <div class="main__header">
        <div class="header grid">
            <div class="header__left-column">
                <a href="<?= Yii::app()->createUrl('/store') ?>" class="header__catalog-link">
                    Каталог<i class="fa fa-book fa-lg fa-fw"></i>
                </a>
                <div class="header__search-widget">
                    <?php $this->widget('application.modules.store.widgets.SearchProductWidget'); ?>
                </div>
            </div>
            <div class="header__center-column">
                <a href="<?= Yii::app()->createUrl(Yii::app()->hasModule('homepage') ? '/homepage/hp/index' : '/site/index') ?>"
                   class="header__logo-link">
                    <img src="<?= $this->mainAssets ?>/images/logo_final_small_centered.png" class="header-logo-image">
                </a>
            </div>
            <div class="header__right-column">
                <?php if (Yii::app()->hasModule('cart')): ?>
                    <div id="shopping-cart-widget">
                        <?php $this->widget('application.modules.cart.widgets.ShoppingCartWidget'); ?>
                    </div>
                <?php endif; ?>

                <span class="span-clientmenu">
                <?php if (Yii::app()->getUser()->isGuest): ?>
                    <a href="<?= Yii::app()->createUrl('/user/account/login') ?>" class="btn_login-button">
                        <i class="fa fa-lock fa-lg fa-fw"></i><?= Yii::t('UserModule.user', 'Login'); ?>
                    </a>
                <?php else: ?>
                    <div id="client-dropdown" class="toolbar-button_dropdown">
                                    <span class="toolbar-button__label" style="color: black">
                                        <i class="fa fa-user fa-lg fa-fw"></i> Личный кабинет
                                    </span>
                        <span class="badge badge_light-blue"></span>

                        <div class="dropdown-menu">
                            <div
                                class="dropdown-menu__header"><?= Yii::app()->getUser()->getProfile()->getFullName() ?></div>
                            <!--                            <div class="dropdown-menu__item">-->
                            <!--                                <div class="dropdown-menu__link">-->
                            <!--                                    <a href="-->
                            <? //= Yii::app()->createUrl('/order/user/index') ?><!--">Мои заказы</a>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="dropdown-menu__item">
                                <div class="dropdown-menu__link">
                                    <a href="<?= Yii::app()->createUrl('/user/profile/profile') ?>">
                                        <?= Yii::t('UserModule.user', 'My profile') ?>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown-menu__separator"></div>
                            <div class="dropdown-menu__item">
                                <div class="dropdown-menu__link dropdown-menu__link_exit">
                                    <a href="<?= Yii::app()->createUrl('/user/account/logout') ?>">
                                        <?= Yii::t('UserModule.user', 'Logout'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
             </span>
            <span class="header__right-item" style="margin-top: 15px">
                 <i class="fa fa-phone fa-lg fa-fw"></i><?php $module = Yii::app()->getModule("store");
                echo $module->phone; ?>
            </span>
            <span class="header__right-item" style="margin-top: 10px">
                 <i class="fa fa-envelope fa-fw" style="font-size: 1.2em"></i><a href="mailto:zakaz@ayaorganic.ru">zakaz@ayaorganic.ru</a>
            </span>
            </div>


        </div>
    </div>
    <div class="main__navbar" style="margin-top: 5px">
        <div class="navbar">
            <div class="navbar__wrapper grid">
                <div class="navbar__menu">
                    <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'verhnee-menyu-s-kategoriyami']); ?>
                    <?php /*$this->widget('application.modules.store.widgets.CategoryWidget', ['depth' => 2]); */ ?>
                </div>
            </div>
        </div>
        <?= $content ?>
        <div class="main__footer">
            <div class="bottom_social grid">
                <h2 class="h2">АлтайЯ в социальных сетях</h2>
                <div class="bottom_social-icons">
                    <a href="https://www.facebook.com/ayaorganic.ru"><i class="fa fa-facebook"></i></a>
                    <a href="http://vk.com/ayaorganic"><i class="fa fa-vk"></i></a>
                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                    <a href="https://www.instagram.com/ayaorganic.ru/"><i class="fa fa-instagram"></i></a>
                    <a href="http://ok.ru/group/53041416044757"><i class="fa fa-odnoklassniki"></i></a>
                </div>
            </div>

            <div class="footer">
                <div class="grid">
                    <div class="footer__wrap">
                        <div class="footer__group">
                            <div class="footer__item footer__item_header">О продукции</div>
                            <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'menyu-o-produkcii', 'layout' => 'footer']); ?>
                        </div>
                        <div class="footer__group">
                            <div class="footer__item footer__item_header">О нас</div>
                            <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'menyu-o-nas', 'layout' => 'footer']); ?>
                        </div>
                        <div class="footer__group">
                            <a href="<?= $this->createUrl("/store") ?>">
                                <div class="footer__item footer__item_header">Каталог</div>
                            </a>
                            <?php $this->widget('application.modules.store.widgets.CategoryWidget', [
                                'view' => 'footer'
                            ]); ?>
                        </div>
                        <div class="footer__group">
                            <div class="footer__item footer__item_header">Сервисы</div>
                            <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'servisy-s-korotkimi-nazvaniyami', 'layout' => 'footer']); ?>
                        </div>
                    </div>
                    <div class="footer__copyright">
                        <?= date("Y") ?>,&laquoАлтайЯ&raquo, все права защищены / <a
                            href="<?= $this->createUrl("/safety.docx") ?>">Политика безопасности</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php \yupe\components\TemplateEvent::fire(ShopThemeEvents::BODY_END); ?>
    <div class='notifications top-right' id="notifications"></div>
    <?php
    Yii::app()->clientScript->registerScript("setCatalogHeight",
        '$(".catalog-filter").height($(".catalog-filter").parent().height())');
    ?>


    <!— Yandex.Metrika counter —>
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter37659580 = new Ya.Metrika({
                        id: 37659580,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true,
                        webvisor: true,
                        trackHash: true
                    });
                } catch (e) {
                }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/37659580" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!— /Yandex.Metrika counter —>
    <!— /Yandex.Metrika counter —>

    <script type="text/javascript"
            src="http://api.venyoo.ru/wnew.js?wc=venyoo/default/science&widget_id=6657789764304896"></script>
    <script>
        $(document).ready(
            function () {
                $('.audio').mediaelementplayer({
                    alwaysShowControls: true,
                    features: ['playpause', 'volume', 'progress'],
                    audioVolume: 'horizontal',
                    audioWidth: 450,
                    audioHeight: 70,
                    iPadUseNativeControls: true,
                    iPhoneUseNativeControls: true,
                    AndroidUseNativeControls: true
                });
            }
        )
    </script>

    <script>
        $(document).ready(
            function () {
                var a = $(".product-gallery").height();
                var b = $("#js-height-block").height();
                if (a <= b) {
                    $(".b-next-read").show();
                    var c = a - 100;
                    $("#js-height-block").css("max-height", c);
                }
                else {
                    $(".b-next-read").hide();
                };
                $("#btn-next-read").click(
                    function () {
                        $("#js-height-block").css("max-height", 2000);
                    }
                )

            }
        )
    </script>
</body>
</html>