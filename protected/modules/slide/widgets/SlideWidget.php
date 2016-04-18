<?php

/**
 * GalleryWidget виджет отрисовки галереи изображений
 *
 * @category YupeWidget
 * @package  yupe.modules.gallery.widgets
 * @author Valek Vergilyush <v.vergilyush@gmail.com>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.1
 * @link http://green-s.pro
 *
 */

Yii::import('application.modules.slide.models.*');

class SlideWidget extends yupe\widgets\YWidget
{



    public $containerClass = "page-slider";
    public $slideshow_identifier = "";
    public $view = 'slidewidget';

    /**
     * Запускаем отрисовку виджета
     *
     * @return void
     */
    public function run()
    {



/*
    	$baseUrl = Yii::app()->assetManager->publish(
    			Yii::getPathOfAlias('application.modules.gallery.views.assets')
    	);
*/
    	//Yii::app()->clientScript->registerCssFile($baseUrl.'/css/gallery.css');
    	$module = Yii::app()->getModule('slide');

		$slides = Slide::model()->findAll("status=1 AND slideshow_identifier = '".$this->slideshow_identifier."' order by sort");
		$items = array();
		foreach ($slides as $slide){
			$items[] = array(
				'image' => $slide->getImageUrl($module->maxWidth, $module->maxHeight),
                'label' => $slide->name,
                'caption' => $slide->description,
					);
		}

        if (count($items) > 0)
            $this->render(
                $this->view,
                array(
                    'containerClass' => $this->containerClass,
                    'items' => $items,
                )
            );
    }
}
