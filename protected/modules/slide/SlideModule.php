<?php

/**
 * SlideModule основной класс модуля slide
 *
 * @author Valek Vergilyush <v.vergilyush@gmail.com>
 * @link http://green-s.pro
 * @copyright 2010-2014 green-s.pro
 * @package yupe.modules.slide
 * @since 0.1
 *
 */

use yupe\components\WebModule;

class SlideModule extends WebModule
{
    const VERSION = '0.1';

    public $uploadPath = 'slide';
    public $documentRoot;
    public $allowedExtensions = 'jpg,jpeg,png,gif';
    public $minSize = 0;
    public $maxSize = 5242880 /* 5 MB */
    ;
    public $maxFiles = 1;
    public $types;
    public $mimeTypes = 'slide/gif, slide/jpeg, slide/png';
    public $maxWidth = 1170;
    public $maxHeight = 350;
    public function getUploadPath()
    {
        return Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath;
    }

    public function getInstall()
    {
        if (parent::getInstall()) {
            @mkdir($this->getUploadPath(), 0755);
        }

        return false;
    }

    public function getDependencies()
    {
        return array(

        );
    }

    public function getVersion()
    {
        return self::VERSION;
    }

    public function getIcon()
    {
        return "fa fa-fw fa-picture-o";
    }

    public function getParamsLabels()
    {
        return array(
            'uploadPath'        => Yii::t('SlideModule.slide', 'Directory for uploading slides'),
            'allowedExtensions' => Yii::t('SlideModule.slide', 'Allowed extensions (separated by comma)'),
            'minSize'           => Yii::t('SlideModule.slide', 'Minimum size (in bytes)'),
            'maxSize'           => Yii::t('SlideModule.slide', 'Maximum size (in bytes)'),
            'mimeTypes'         => Yii::t('SlideModule.slide', 'Mime types'),
        	'maxWidth' => Yii::t('SlideModule.slide', 'maxWidth'),
        	'maxHeight' => Yii::t('SlideModule.slide', 'maxHeight'),
        );
    }

    public function getEditableParams()
    {
        return array(
            'uploadPath',
            'allowedExtensions',
            'minSize',
            'maxSize',
            'mimeTypes',
        	'maxWidth',
        	'maxHeight',

        );
    }

    public function getEditableParamsGroups()
    {
        return array(
            'main' => array(
                'label' => Yii::t('SlideModule.slide', 'General module settings'),
                'items' => array(
                    'allowedExtensions',
                    'mimeTypes',
                    'minSize',
                    'maxSize',
                    'uploadPath',
                	'maxWidth',
                	'maxHeight'
                )
            )
        );
    }

    public function checkSelf()
    {
        $messages = array();

        $uploadPath = Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath;

        if (!$uploadPath) {
            $messages[WebModule::CHECK_ERROR][] = array(
                'type'    => WebModule::CHECK_ERROR,
                'message' => Yii::t(
                        'SlideModule.slide',
                        'Please, choose catalog for slides! {link}',
                        array(
                            '{link}' => CHtml::link(
                                    Yii::t('SlideModule.slide', 'Change module settings'),
                                    array(
                                        '/yupe/backend/modulesettings/',
                                        'module' => $this->id,
                                    )
                                ),
                        )
                    ),
            );
        }

        if (!is_dir($uploadPath) || !is_writable($uploadPath)) {
            $messages[WebModule::CHECK_ERROR][] = array(
                'type'    => WebModule::CHECK_ERROR,
                'message' => Yii::t(
                        'SlideModule.slide',
                        'Directory "{dir}" is not accessible for writing ot not exists! {link}',
                        array(
                            '{dir}'  => $uploadPath,
                            '{link}' => CHtml::link(
                                    Yii::t('SlideModule.slide', 'Change module settings'),
                                    array(
                                        '/yupe/backend/modulesettings/',
                                        'module' => $this->id,
                                    )
                                ),
                        )
                    ),
            );
        }

        if (!$this->maxSize || $this->maxSize <= 0) {
            $messages[WebModule::CHECK_ERROR][] = array(
                'type'    => WebModule::CHECK_ERROR,
                'message' => Yii::t(
                        'SlideModule.slide',
                        'Set maximum slides size {link}',
                        array(
                            '{link}' => CHtml::link(
                                    Yii::t('SlideModule.slide', 'Change module settings'),
                                    array(
                                        '/yupe/backend/modulesettings/',
                                        'module' => $this->id,
                                    )
                                ),
                        )
                    ),
            );
        }

        return (isset($messages[WebModule::CHECK_ERROR])) ? $messages : true;
    }

    public function getCategory()
    {
        return Yii::t('SlideModule.slide', 'Content');
    }

    public function getName()
    {
        return Yii::t('SlideModule.slide', 'Slides');
    }

    public function getDescription()
    {
        return Yii::t('SlideModule.slide', 'Module for slides management');
    }

    public function getAuthor()
    {
        return Yii::t('SlideModule.slide', 'GREEN');
    }

    public function getAuthorEmail()
    {
        return Yii::t('SlideModule.slide', 'v.vergilyush@gmail.com');
    }

    public function getUrl()
    {
        return Yii::t('SlideModule.slide', 'http://green-s.pro');
    }

    public function init()
    {
        parent::init();

        $this->documentRoot = $_SERVER['DOCUMENT_ROOT'];

        $forImport = array();

        if (Yii::app()->hasModule('gallery')) {
            $forImport[] = 'gallery.models.*';
        }

        $this->setImport(
            array_merge(
                array(
                    'slide.models.*'
                ),
                $forImport
            )
        );
    }

    public function getNavigation()
    {
        return array(
            array(
                'icon'  => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('SlideModule.slide', 'Slides list'),
                'url'   => array('/slide/slideBackend/index')
            ),
            array(
                'icon'  => 'fa fa-fw fa-plus-square',
                'label' => Yii::t('SlideModule.slide', 'Add slide'),
                'url'   => array('/slide/slideBackend/create')
            ),
            array(
                'icon'  => 'fa fa-fw fa-folder-open',
                'label' => Yii::t('SlideModule.slide', 'Slides categories'),
                'url'   => array('/category/categoryBackend/index', 'Category[parent_id]' => (int)$this->mainCategory)
            ),
        );
    }

    public function getAdminPageLink()
    {
        return '/slide/slideBackend/index';
    }

    /**
     * Получаем разрешённые форматы:
     *
     * @return array of allowed extensions
     **/
    public function allowedExtensions()
    {
        return explode(',', $this->allowedExtensions);
    }

    public function getAuthItems()
    {
        return array(
            array(
                'name'        => 'Slide.SlideManager',
                'description' => Yii::t('SlideModule.slide', 'Manage slides'),
                'type'        => AuthItem::TYPE_TASK,
                'items'       => array(
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Slide.SlideBackend.Create',
                        'description' => Yii::t('SlideModule.slide', 'Creating slide')
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Slide.SlideBackend.Delete',
                        'description' => Yii::t('SlideModule.slide', 'Removing slide')
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Slide.SlideBackend.Index',
                        'description' => Yii::t('SlideModule.slide', 'List of slides')
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Slide.SlideBackend.Update',
                        'description' => Yii::t('SlideModule.slide', 'Editing slides')
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Slide.SlideBackend.Inline',
                        'description' => Yii::t('SlideModule.slide', 'Editing slides')
                    ),
                    array(
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'Slide.SlideBackend.View',
                        'description' => Yii::t('SlideModule.slide', 'Viewing slides')
                    ),
                )
            )
        );
    }
}
