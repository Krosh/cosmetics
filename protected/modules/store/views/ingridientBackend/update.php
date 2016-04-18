<?php
/**
 * @var $this ProductBackendController
 * @var $model Product
 */

$this->layout = 'ingredients';

$this->breadcrumbs = [
    Yii::t('StoreModule.store', 'Ингредиенты') => ['/store/ingridientBackend/index'],
    $model->name => ['/store/ingridientBackend/view', 'id' => $model->id],
    Yii::t('StoreModule.store', 'Edition'),
];

$this->pageTitle = Yii::t('StoreModule.store', 'Ингредиенты - edition');

$this->menu = [
    ['label' => Yii::t('StoreModule.store', 'Product') . ' «' . mb_substr($model->name, 0, 32) . '»'],
    [
        'icon' => 'fa fa-fw fa-pencil',
        'label' =>'Изменить ингредиент',
        'url' => [
            '/store/ingridientBackend/update',
            'id' => $model->id
        ]
    ],
    [
        'icon' => 'fa fa-fw fa-eye',
        'label' =>'Просмотреть ингредиент',
        'url' => [
            '/store/ingridientBackend/view',
            'id' => $model->id
        ]
    ],
    [
        'icon' => 'fa fa-fw fa-trash-o',
        'label' =>'Удалить ингредиент',
        'url' => '#',
        'linkOptions' => [
            'submit' => ['/store/ingridientBackend/delete', 'id' => $model->id],
            'params' => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
            'confirm' => 'Вы уверены, что хотите удалить этот ингредиент?',
            'csrf' => true,
        ]
    ],
];
?>
<div class="page-header">
    <h1>
        Изменение ингредиента<br/>
        <small>&laquo;<?= $model->name; ?>&raquo;</small>
    </h1>
</div>

<?= $this->renderPartial('_form', ['model' => $model]); ?>
