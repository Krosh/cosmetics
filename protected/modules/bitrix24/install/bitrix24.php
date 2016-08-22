<?php
/**
 * Файл настроек для модуля bitrix24
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2016 amyLabs && Yupe! team
 * @package yupe.modules.bitrix24.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.bitrix24.Bitrix24Module',
    ],
    'import'    => [],
    'component' => [],
    'rules'     => [
        '/bitrix24' => 'bitrix24/bitrix24/index',
    ],
];