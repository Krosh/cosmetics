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
    'import' => [
        'application.modules.megareview.models.*',
    ],
    'component' => [],
    'rules' => [
        '/loginFromSocial' => 'megareview/user/login',
        '/loginFromInstagram' => 'megareview/user/instagram',
        '/testLogin' => 'megareview/user/test',
        '/review/add' => 'megareview/review/add',
    ],
];