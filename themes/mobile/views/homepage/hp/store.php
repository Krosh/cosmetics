<?php

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');

/* @var $category StoreCategory */

$this->breadcrumbs = [Yii::t("HomepageModule.homepage", "Catalog") => ['/store/product/index']];

?>

<div class="main__catalog grid">
    <div class="cols">
        <div class="col grid-module-3">
xsds
        </div>
        <div class="col grid-module-9">
            <?php $this->widget(
                'zii.widgets.CListView', [
                    'dataProvider' => $dataProvider,
                    'itemView' => '_product',
                    'template' => '
                        <div class="catalog-controls">
                            <div class="catalog-controls__col">{sorter}</div>
                        </div>
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
<?php $this->widget('application.modules.store.widgets.ProducersWidget', ['limit' => 25]);?>