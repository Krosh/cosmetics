<?php

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');

/* @var $category StoreCategory */

if (isset($isHit))
 $this->breadcrumbs = [Yii::t("StoreModule.store", "Хиты продаж")];
    else
$this->breadcrumbs = [Yii::t("StoreModule.store", "Catalog")];

?>
<!--<div class="main__title grid">
    <h1 class="h2"><?/*= Yii::t("StoreModule.store", "Product catalog"); */?></h1>
</div>
-->
<div class="main__catalog grid">
    <div class="cols">
        <div class="col grid-module-3">
            <div class="catalog-filter">
                <?php $this->widget('application.modules.store.widgets.CategoryWidget', ['view' => 'category-sidebar-widget', 'depth' => 2, 'htmlOptions' => ['class' => 'side-menu']]); ?>
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
                            'homeLink' => '<li><a href="/">' . Yii::t('Yii.zii', 'Home') . '</a>',
                            'activeLinkTemplate' => '<li><a href="{url}">{label}</a>',
                            'inactiveLinkTemplate' => '<li><a>{label}</a>',
                            'htmlOptions' => []
                        ]
                    );?>
                </div>
            </div>
            <?php $this->widget(
                'zii.widgets.CListView', [
                    'dataProvider' => $dataProvider,
                    'itemView' => '_itemPreview',
                    'template' => '
                       <!-- <div class="catalog-controls">
                            <div class="catalog-controls__col">{sorter}</div>
                        </div>-->
                        {items}
                        {pager}
                    ',
                    'summaryText' => '',
                    'enableHistory' => true,
                    'cssFile' => false,
                    'itemsCssClass' => 'catalog__items',
                    'sortableAttributes' => [
                        'sku',
                        'name',
                        'price',
                        'update_time'
                    ],
                    'sorterHeader' => '<div class="sorter__description">Сортировать:</div>',
                    'htmlOptions' => [
                        'class' => 'catalog'
                    ],
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
<?php $this->widget('application.modules.store.widgets.ProducersWidget', ['limit' => 25]) ?>

