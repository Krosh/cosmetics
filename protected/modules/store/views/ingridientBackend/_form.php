<?php
/**
 * @var $this ProductBackendController
 * @var $model Product
 * @var $form \yupe\widgets\ActiveForm
 */
?>
<?php Yii::app()->getClientScript()->registerCssFile($this->getModule()->getAssetsUrl().'/css/store-backend.css'); ?>



<?php
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',
    [
        'id' => 'product-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => ['enctype' => 'multipart/form-data', 'class' => 'well'],
        'clientOptions' => [
            'validateOnSubmit' => true,
        ],
    ]
); ?>

<div class="alert alert-info">
    <?= Yii::t('StoreModule.store', 'Fields with'); ?>
    <span class="required">*</span>
    <?= Yii::t('StoreModule.store', 'are required'); ?>
</div>

<?= $form->errorSummary($model); ?>


<div class="row">
    <div class="col-sm-7">
        <?= $form->textFieldGroup($model, 'name'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
        <?= $form->slugFieldGroup($model, 'slug', ['sourceAttribute' => 'name']); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?=
        CHtml::image(
            !$model->getIsNewRecord() && $model->image ? $model->getImageUrl(200, 200, true) : '#',
            $model->name,
            [
                'class' => 'preview-image img-thumbnail',
                'style' => !$model->getIsNewRecord() && $model->image ? '' : 'display:none',
            ]
        ); ?>

        <?php if (!$model->getIsNewRecord() && $model->image): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="delete-file"> <?= Yii::t(
                        'YupeModule.yupe',
                        'Delete the file'
                    ) ?>
                </label>
            </div>
        <?php endif; ?>

        <?= $form->fileFieldGroup(
            $model,
            'image',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'onchange' => 'readURL(this);',
                    ],
                ],
            ]
        ); ?>
    </div>
</div>


<div class='row'>
    <div class="col-sm-12 <?= $model->hasErrors('short_description') ? 'has-error' : ''; ?>">
        <?= $form->labelEx($model, 'short_description'); ?>
        <?php $this->widget(
            $this->module->getVisualEditor(),
            [
                'model' => $model,
                'attribute' => 'short_description',
            ]
        ); ?>
        <p class="help-block"></p>
        <?= $form->error($model, 'short_description'); ?>
    </div>
</div>



<br/>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->getIsNewRecord() ? Yii::t('StoreModule.store', 'Add product and continue') : Yii::t(
            'StoreModule.store',
            'Save product and continue'
        ),
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => $model->getIsNewRecord() ? Yii::t('StoreModule.store', 'Add product and close') : Yii::t(
            'StoreModule.store',
            'Save product and close'
        ),
    ]
); ?>

<?php $this->endWidget(); ?>

