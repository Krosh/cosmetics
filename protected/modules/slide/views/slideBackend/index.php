<?php
$this->breadcrumbs = array(
    Yii::t('SlideModule.slide', 'Slides') => array('/slide/slideBackend/index'),
    Yii::t('SlideModule.slide', 'Management'),
);

$this->pageTitle = Yii::t('SlideModule.slide', 'Slides - manage');

$this->menu = array(
    array(
        'icon'  => 'fa fa-fw fa-list-alt',
        'label' => Yii::t('SlideModule.slide', 'Slide management'),
        'url'   => array('/slide/slideBackend/index')
    ),
    array(
        'icon'  => 'fa fa-fw fa-plus-square',
        'label' => Yii::t('SlideModule.slide', 'Add slide'),
        'url'   => array('/slide/slideBackend/create')
    ),
);
?>
<div class="page-header">
    <h1>
        <?php echo ucfirst(Yii::t('SlideModule.slide', 'Slides')); ?>
        <small><?php echo Yii::t('SlideModule.slide', 'management'); ?></small>
    </h1>
</div>



<div id="search-toggle" class="search-form collapse out">
    <?php
    Yii::app()->clientScript->registerScript(
        'search',
        "
    $('.search-form form').submit(function () {
        $.fn.yiiGridView.update('slide-grid', {
            data: $(this).serialize()
        });

        return false;
    });
"
    );
    //$this->renderPartial('_search', array('model' => $model));
    ?>
</div>

<?php
$this->widget(
    'yupe\widgets\CustomGridView',
    array(
        'id'           => 'slide-grid',
    		'sortableRows'      => true,
    		'sortableAjaxSave'  => true,
    		'sortableAttribute' => 'sort',
    		'sortableAction'    => '/slide/slideBackend/sortable',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => array(
            array(
                'name'   => Yii::t('SlideModule.slide', 'file'),
                'type'   => 'raw',
                'value'  => 'CHtml::image($data->getImageUrl(75, 75), $data->name, array("width" => 75, "height" => 75))',
                'filter' => false
            ),
            'name',
            array(
                'name'   => 'slideshow_identifier',
                'value'  => '$data->getPage()',
                'filter' => false
            ),
           /* array(
                'header' => Yii::t('SlideModule.slide', 'Link'),
                'type'   => 'raw',
                'value'  => 'CHtml::link($data->getImageUrl(), $data->getImageUrl())'
            ),*/

        		array(
        				'class'   => 'yupe\widgets\EditableStatusColumn',
        				'name'    => 'status',
        				'url'     => $this->createUrl('/slide/slideBackend/inline'),
        				'source'  => $model->getStatusList(),
        				'options' => [
        				Slide::STATUS_SHOW  => ['class' => 'label-success'],
        				Slide::STATUS_HIDE => ['class' => 'label-danger'],

        				],
        		),

            array(
                'class' => 'yupe\widgets\CustomButtonColumn',
            		'template'=>'{update}{delete}'
            ),
        ),
    )
); ?>
