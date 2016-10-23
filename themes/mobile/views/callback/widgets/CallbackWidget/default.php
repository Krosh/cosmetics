<?php
/**
 * @var Callback $model
 * @var string $phoneMask
 * @var CActiveForm $form
 */
?>
<h2 class="callback__header">Мы Вам перезвоним!</h2>
<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'callback-form',
    'action' => Yii::app()->createUrl('/callback/callback/send'),
    'enableClientValidation' => true,
    'clientOptions' => [
        'validateOnSubmit' => true,
        'afterValidate' => 'js:callbackSendForm',
    ],
]); ?>

<?= $form->errorSummary($model); ?>

<div class="column grid-module-5">
<div class="fast-order__inputs">
    <?= $form->labelEx($model, 'name'); ?>
    <?= $form->textField($model, 'name', ['class' => 'input input_big']); ?>
    <?= $form->error($model, 'name') ?>
</div>
</div>

<div class="column grid-module-1" style="height: 50px">

</div>
<div class="column grid-module-2">
<div class="fast-order__inputs">
        <?= $form->labelEx($model, 'phone'); ?>
        <?php $this->widget('CMaskedTextField', [
            'model' => $model,
            'attribute' => 'phone',
            'mask' => $phoneMask,
            'htmlOptions' => [
                'class' => 'input input_big'
            ]
        ]); ?>
        <?= $form->error($model, 'phone') ?>
    </div>
</div>

<div class="fast-order__inputs" style="text-align: center">
    <button type="submit" class="btn_cart btn btn_big btn_primary btn_callback" id="callback-send">
        Заказать звонок
    </button>
</div>
<?php $this->endWidget(); ?>
