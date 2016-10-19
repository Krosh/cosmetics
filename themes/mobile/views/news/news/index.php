<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = [$model->title, Yii::app()->getModule('yupe')->siteName];
$this->description = $model->description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>

<div class="main__catalog grid">
    <div class="cols">
        <div class="col grid-module-3">
            <div class="catalog-filter">
                <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'servisy', 'layout' => 'sidebar']); ?>
            </div>
        </div>
        <div class="col grid-module-9">
            <div class="main__breadcrumbs grid">
                <div class="breadcrumbs">
                    <?php $this->widget(
                        'zii.widgets.CBreadcrumbs',
                        [
                            'links' => $this->breadcrumbs,
                            'tagName' => 'ul',
                            'separator' => '',
                            'homeLink' => '<li><a href="'.$this->createUrl("/").'">' . Yii::t('Yii.zii', 'Home') . '</a>',
                            'activeLinkTemplate' => '<li><a href="{url}">{label}</a>',
                            'inactiveLinkTemplate' => '<li><a>{label}</a>',
                            'htmlOptions' => []
                        ]
                    );?>
                </div>
            </div>
            <div class="page__content">
                <?php
                $this->widget(
                    'zii.widgets.CListView',
                    [
                        'dataProvider' => $dataProvider,
                        'itemView' => '_item',
                        'template' => "{items}\n{pager}",
                        'summaryText' => '',
                        'enableHistory' => true,
                        'cssFile' => false,
                        'pagerCssClass' => 'catalog__pagination',
                        'pager' => [
                            'header' => '',
                            'prevPageLabel' => '<i class="fa fa-long-arrow-left"></i>',
                            'nextPageLabel' => '<i class="fa fa-long-arrow-right"></i>',
                            'firstPageLabel' => false,
                            'lastPageLabel' => false,
                            'htmlOptions' => [
                                'class' => 'pagination'
                            ]
                        ]
                    ]
                ); ?>
            </div>
        </div>
    </div>
</div>
