<?php
/**
 * Файл конфигурации модуля
 *
 * @category YupeController
 * @package  yupe.modules.slide.install
 * @author Valek Vergilyush <v.vergilyush@gmail.com>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @link http://green-s.pro
 *
 **/
return array(
    'module'    => array(
        'class' => 'application.modules.slide.SlideModule',
    ),
    'import'    => array(
        'application.modules.slide.models.*',
    ),
    'component' => array(),
    'rules'     => array(
        '/slides/<id:\d+>' => 'gallery/gallery/slide/',
    ),
);
