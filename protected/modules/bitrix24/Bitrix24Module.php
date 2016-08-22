<?php
/**
 * Bitrix24Module основной класс модуля bitrix24
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2016 amyLabs && Yupe! team
 * @package yupe.modules.bitrix24
 * @since 0.1
 */

class Bitrix24Module  extends yupe\components\WebModule
{
    const VERSION = '0.9.8';

    public $client_id;

    public $domain;

    public $client_secret;

    public $accessToken;

    /**
     * @return \Bitrix24\Bitrix24 Bitrix24 Instance
     */
    public function getBitrix()
    {
        include_once(Yii::getPathOfAlias("vendor.mesilov.bitrix24-php-sdk.src.bitrix24").".php");
        $module = $this;
        $bitrix = new Bitrix24\Bitrix24(true);
        $bitrix->setDomain($module->domain);
        $bitrix->setApplicationId($module->client_id);
        $bitrix->setApplicationSecret($module->client_secret);
        $bitrix->setRefreshToken("sds");
        $bitrix->setRedirectUri("setRedirectUri");
        return $bitrix;
    }

    /**
     * Массив с именами модулей, от которых зависит работа данного модуля
     *
     * @return array
     */
    public function getDependencies()
    {
        return parent::getDependencies();
    }

    /**
     * Работоспособность модуля может зависеть от разных факторов: версия php, версия Yii, наличие определенных модулей и т.д.
     * В этом методе необходимо выполнить все проверки.
     *
     * @return array или false
     */
    public function checkSelf()
    {
        return parent::checkSelf();
    }

    /**
     * Каждый модуль должен принадлежать одной категории, именно по категориям делятся модули в панели управления
     *
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('Bitrix24Module.bitrix24', 'Services');
    }

    /**
     * массив лейблов для параметров (свойств) модуля. Используется на странице настроек модуля в панели управления.
     *
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            "domain" => "Адрес домена Битрикс24",
            "client_id" => "Код приложения",
            "client_secret" => "Ключ приложения",
        ];
    }

    /**
     * массив параметров модуля, которые можно редактировать через панель управления (GUI)
     *
     * @return array
     */
    public function getEditableParams()
    {
        return ["domain","client_id","client_secret","accessToken"];
    }

    /**
     * массив групп параметров модуля, для группировки параметров на странице настроек
     *
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return parent::getEditableParamsGroups();
    }

    /**
     * если модуль должен добавить несколько ссылок в панель управления - укажите массив
     *
     * @return array
     */
    public function getNavigation()
    {
        return [
            ['label' => Yii::t('Bitrix24Module.bitrix24', 'bitrix24')],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('Bitrix24Module.bitrix24', 'Index'),
                'url' => ['/bitrix24/bitrix24Backend/index']
            ],
        ];
    }

    /**
     * текущая версия модуля
     *
     * @return string
     */
    public function getVersion()
    {
        return Yii::t('Bitrix24Module.bitrix24', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('Bitrix24Module.bitrix24', 'http://yupe.ru');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('Bitrix24Module.bitrix24', 'bitrix24');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('Bitrix24Module.bitrix24', 'Описание модуля "bitrix24"');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('Bitrix24Module.bitrix24', 'yupe team');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('Bitrix24Module.bitrix24', 'team@yupe.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/bitrix24/bitrix24Backend/index';
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-fw fa-pencil";
    }

    /**
      * Возвращаем статус, устанавливать ли галку для установки модуля в инсталяторе по умолчанию:
      *
      * @return bool
      **/
    public function getIsInstallDefault()
    {
        return parent::getIsInstallDefault();
    }

    /**
     * Инициализация модуля, считывание настроек из базы данных и их кэширование
     *
     * @return void
     */
    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'bitrix24.models.*',
                'bitrix24.components.*',
            ]
        );
    }

    /**
     * Массив правил модуля
     * @return array
     */
    public function getAuthItems()
    {
        return [
            [
                'name' => 'Bitrix24.Bitrix24Manager',
                'description' => Yii::t('Bitrix24Module.bitrix24', 'Manage bitrix24'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Bitrix24.Bitrix24Backend.Index',
                        'description' => Yii::t('Bitrix24Module.bitrix24', 'Index')
                    ],
                ]
            ]
        ];
    }
}
