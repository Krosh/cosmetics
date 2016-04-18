<?php
/**
 * @var $this ProductBackendController
 * @var $model Product
 */

$this->layout = 'ingredients';

$this->breadcrumbs = [
    Yii::t('StoreModule.store', 'Ингредиенты') => ['/store/ingridientBackend/index'],
    Yii::t('StoreModule.store', 'Creating'),
];

$this->pageTitle = Yii::t('StoreModule.store', 'Ингредиенты - creating');
?>
<div class="page-header">
    <h1>
        <?= Yii::t('StoreModule.store', 'Ингредиенты'); ?>
        <small><?= Yii::t('StoreModule.store', 'creating'); ?></small>
    </h1>
</div>

<?= $this->renderPartial('_form', ['model' => $model]); ?>
