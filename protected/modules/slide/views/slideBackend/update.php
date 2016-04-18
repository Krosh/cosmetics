<?php
$this->breadcrumbs = array(
    Yii::t('SlideModule.slide', 'Slides') => array('/slide/slideBackend/index'),
    $model->name                          => array('/slide/slideBackend/view', 'id' => $model->id),
    Yii::t('SlideModule.slide', 'Edit'),
);

$this->pageTitle = Yii::t('SlideModule.slide', 'Slides - edit');

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
    array('label' => Yii::t('SlideModule.slide', 'Slide') . ' «' . mb_substr($model->name, 0, 32) . '»'),
    array(
        'icon'  => 'fa fa-fw fa-pencil',
        'label' => Yii::t('SlideModule.slide', 'Edit slide'),
        'url'   => array(
            '/slide/slideBackend/update',
            'id' => $model->id
        )
    ),
    array(
        'icon'  => 'fa fa-fw fa-eye',
        'label' => Yii::t('SlideModule.slide', 'View slide'),
        'url'   => array(
            '/slide/slideBackend/view',
            'id' => $model->id
        )
    ),
    array(
        'icon'        => 'fa fa-fw fa-trash-o',
        'label'       => Yii::t('SlideModule.slide', 'Remove slide'),
        'url'         => '#',
        'linkOptions' => array(
            'submit'  => array('/slide/slideBackend/delete', 'id' => $model->id),
            'params'  => array(Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken),
            'confirm' => Yii::t('SlideModule.slide', 'Do you really want to remove slide?'),
            'csrf'    => true,
        )
    ),
);
?>
<div class="page-header">
    <h1><?php echo Yii::t('SlideModule.slide', 'Change slide'); ?><br/>
        <small>&laquo;<?php echo $model->name; ?>&raquo;</small>
    </h1>
</div>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
