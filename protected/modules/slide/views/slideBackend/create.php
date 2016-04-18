<?php
$this->breadcrumbs = array(
    Yii::t('SlideModule.slide', 'Slides') => array('/slide/slideBackend/index'),
    Yii::t('SlideModule.slide', 'Add'),
);

$this->pageTitle = Yii::t('SlideModule.slide', 'Slides - add');

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
        <?php echo Yii::t('SlideModule.slide', 'Slides'); ?>
        <small><?php echo Yii::t('SlideModule.slide', 'add'); ?></small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
