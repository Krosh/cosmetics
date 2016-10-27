<?php
/**
 * @var CActiveForm $form
 */
$this->title = ["Обратная связь", Yii::app()->getModule('yupe')->siteName];
$this->breadcrumbs = ["Обратная связь"];
Yii::import('application.modules.feedback.FeedbackModule');
Yii::import('application.modules.install.InstallModule');
?>

<div class="main__catalog grid">
    <div class="cols">
        <div class="col grid-module-9">
            <div class="main__breadcrumbs grid">
                <div class="breadcrumbs">
                    <?php $this->widget(
                        'zii.widgets.CBreadcrumbs',
                        [
                            'links' => $this->breadcrumbs,
                            'tagName' => 'ul',
                            'separator' => '',
                            'homeLink' => '<li><a href="'.$this->createUrl("/").'">' . Yii::t('Yii.zii', 'Home') . '</a>',
                            'activeLinkTemplate' => '<li><a href="{url}">{label}</a>',
                            'inactiveLinkTemplate' => '<li><a>{label}</a>',
                            'htmlOptions' => []
                        ]
                    );?>
                </div>
            </div>

            <div class="main__catalog grid">
                <?php $this->widget('yupe\widgets\YFlashMessages'); ?>
                <?php $form = $this->beginWidget('CActiveForm', [
                    'id' => 'feedback-form',
                ]); ?>
                <div class="grid-module-5 float-grid-element">
                    <div class="callback__left-column">
                        <?= CHtml::hiddenField("FeedBackForm[theme]","Отзыв с сайта"); ?>

                        <div class="fast-order__inputs">
                            <?= $form->labelEx($model, 'name'); ?>
                            <?= $form->textField($model, 'name', ['class' => 'input input_big']); ?>
                            <?= $form->error($model, 'name') ?>
                        </div>

                        <div class="fast-order__inputs">
                            <?= $form->labelEx($model, 'phone'); ?>
                            <?= $form->textField($model, 'phone', ['class' => 'input input_big']); ?>
                            <?= $form->error($model, 'phone') ?>
                        </div>


                        <div class="fast-order__inputs">
                            <?= $form->labelEx($model, 'email'); ?>
                            <?= $form->textField($model, 'email', ['class' => 'input input_big']); ?>
                            <?= $form->error($model, 'email') ?>
                        </div>



                    </div>
                </div>
                <div class="grid-module-8 float-grid-element">
                    <div class="fast-order__inputs">
                        <?= $form->labelEx($model, 'text'); ?>
                        <?= $form->textArea($model, 'text', ['class' => 'input input_big', 'rows' => 3]); ?>
                        <?= $form->error($model, 'text') ?>
                    </div>
                    <div class="fast-order__inputs" style="text-align: center">
                        <?= CHtml::submitButton(Yii::t('FeedbackModule.feedback', 'Send message'), [
                            'id' => 'login-btn',
                            'class' => 'btn_cart btn btn_big btn_primary btn_callback',
                        ]) ?>
                    </div>
                    <?php $this->endWidget(); ?>
                    <?php $this->widget('application.modules.callback.widgets.CallbackWidget'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
