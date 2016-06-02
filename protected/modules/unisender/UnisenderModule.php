<?php
/**
 * UnisenderModule основной класс модуля unisender
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2016 amyLabs && Yupe! team
 * @package yupe.modules.unisender
 * @since 0.1
 */

require_once(Yii::getPathOfAlias('application.modules.unisender.components.unisenderApi').".php");


class UnisenderModule  extends yupe\components\WebModule
{
    const VERSION = '0.9.8';
    /**
     * @var
     */
    public $apiId;

    /**
     * @var
     */
    public $senderId;




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
        return Yii::t('UnisenderModule.unisender', 'Services');
    }

    /**
     * массив лейблов для параметров (свойств) модуля. Используется на странице настроек модуля в панели управления.
     *
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            "apiId" => Yii::t('UnisenderModule.unisender', 'apiId'),
            "senderId" => Yii::t('UnisenderModule.unisender', 'senderId'),
        ];
    }

    /**
     * массив параметров модуля, которые можно редактировать через панель управления (GUI)
     *
     * @return array
     */
    public function getEditableParams()
    {
        return [
            "apiId",
//            "senderId",
        ];
    }

    /**
     * массив групп параметров модуля, для группировки параметров на странице настроек
     *
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return [
            '1.notify' => [
                'label' => Yii::t('UnisenderModule.unisender', 'Params'),
                'items' => [
                    "apiId",
//                    "senderId",
                ],
            ],
        ];    }

    /**
     * если модуль должен добавить несколько ссылок в панель управления - укажите массив
     *
     * @return array
     */
    public function getNavigation()
    {
        return [
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('UnisenderModule.unisender', 'checkBalance'),
                'url' => ['/unisender/unisenderBackend/index']
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
        return Yii::t('UnisenderModule.unisender', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('UnisenderModule.unisender', 'http://yupe.ru');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('UnisenderModule.unisender', 'unisender');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('UnisenderModule.unisender', 'Описание модуля "unisender"');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('UnisenderModule.unisender', 'Krosh');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('UnisenderModule.unisender', 'team@yupe.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/unisender/unisenderBackend/index';
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-fw fa-fax";
    }

    /**
      * Возвращаем статус, устанавливать ли галку для установки модуля в инсталяторе по умолчанию:
      *
      * @return bool
      **/
    public function getIsInstallDefault()
    {
        return false;
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
                'unisender.models.*',
                'unisender.components.*',
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
                'name' => 'Unisender.UnisenderBackend.Index',
                'description' => Yii::t('UnisenderModule.unisender', 'Manage unisender'),
                'type' => AuthItem::TYPE_OPERATION,
            ]
        ];
    }

    public function sendSms($phone,$text)
    {
        $api = new unisenderApi($this->apiId);
        $result = $api->sendSms(["phone" => $phone, "sender" => $this->senderId, "text" => $text]);
        $result = json_decode($result);
        return $result;
    }
}
