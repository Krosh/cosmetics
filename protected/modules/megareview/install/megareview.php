<?php
/**
 * Файл настроек для модуля megareview
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2016 amyLabs && Yupe! team
 * @package yupe.modules.megareview.install
 * @since 0.1
 *
 */
return [
    'module' => [
        'class' => 'application.modules.megareview.MegareviewModule',
    ],
    'import' => [],
    'component' => [],
    'rules' => [
        '/megareview' => 'megareview/megareview/index',
        '/loginFromSocial' => 'megareview/user/login',
        'testLogin' => 'megareview/user/test',
    ],
];