<?php
/**
 * @var $this IngridientBackendController
 * @var $model Product
 */

$this->layout = 'ingredients';

$this->breadcrumbs = [
    Yii::t('StoreModule.store', 'Ингредиенты') => ['/store/ingridientBackend/index'],
    Yii::t('StoreModule.store', 'Manage'),
];

$this->pageTitle = 'Ингредиенты - управление';
?>
<div class="page-header">
    <h1>
        <?= Yii::t('StoreModule.store', 'Ингредиенты'); ?>
        <small><?= Yii::t('StoreModule.store', 'administration'); ?></small>
    </h1>
</div>
<?php $this->widget('yupe\widgets\CustomGridView',
    array(
        'id'=>'client-grid',
        'sortableRows'      => true,
        'sortableAjaxSave'  => true,
        'sortableAttribute' => 'position',
        'sortableAction'    => '/store/ingridientBackend/sortable',
        'type' => 'condensed',
        'actionsButtons' => [
            'add' => CHtml::link(
                Yii::t('StoreModule.store', 'Add'),
                ['/store/ingridientBackend/create'],
                ['class' => 'btn btn-sm btn-success pull-right']
            ),

        ],

        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            [
                'type' => 'raw',
                'value' => function ($data) {
                    return CHtml::image(StoreImage::ingredient($data, 40, 40), $data->name, ["width" => 40, "height" => 40, "class" => "img-thumbnail"]);
                },
            ],
            'name',
            'short_description',
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
                'buttons' => [

                ]
            ],

        ),
    )); ?>






