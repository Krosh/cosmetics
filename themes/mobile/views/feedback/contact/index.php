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
        <div class="col grid-module-3">
            <div class="catalog-filter">
                <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'servisy', 'layout' => 'sidebar']); ?>
            </div>
        </div>
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
                        <img src="<?= $this->mainAssets ?>/images/feedback.jpg" class="callback__top_logo">
                        <div class="callback__slogan">
                            Доверь свою красоты природе!
                        </div>
                        <div class="callback__text">
                            Хотите поделиться информацией?<br>
                            Оставить свой отзыв или задать вопрос?
                        </div>

                        <!--  <p class="alert alert-info fast-order__inputs">
                            <?/*= Yii::t('FeedbackModule.feedback', 'Fields with'); */?> <span
                                class="required">*</span> <?/*= Yii::t('FeedbackModule.feedback', 'are required.'); */?>
                        </p>
-->
                        <!--                        --><?/*= $form->errorSummary($model); */?>

                      <!--  <?php /*if ($model->type): */?>
                            <div class='row'>
                                <div class="col-sm-6">
                                    <?/*= $form->dropDownList($model, 'type', [
                                        'data' => $module->getTypes(),
                                    ]); */?>
                                </div>
                            </div>
                        --><?php /*endif; */?>

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

                    <!--                        <?php /*if ($module->showCaptcha && !Yii::app()->getUser()->isAuthenticated()): */?>
                            <?php /*if (CCaptcha::checkRequirements()): */?>
                                <div class="fast-order__inputs">
                                    <div class="column grid-module-3">
                                        <?/*= $form->textField($model, 'verifyCode', [
                                            'class' => 'input input_big',
                                            'placeholder' => Yii::t('FeedbackModule.feedback', 'Insert symbols you see on image')
                                        ]); */?>
                                    </div>
                                    <div class="column grid-module-3 pull-right">
                                        <?php /*$this->widget(
                                            'CCaptcha',
                                            [
                                                'showRefreshButton' => true,
                                                'imageOptions' => [
                                                    'width' => '150',
                                                ],
                                                'buttonOptions' => [
                                                    'class' => 'btn btn_big btn_white pull-right',
                                                ],
                                                'buttonLabel' => '<i class="fa fa-fw fa-repeat"></i>',
                                            ]
                                        ); */?>
                                    </div>
                                </div>
                            <?php /*endif; */?>
                        --><?php/* endif; */ ?>

                    <div class="fast-order__inputs" style="text-align: center">
                        <?= CHtml::submitButton(Yii::t('FeedbackModule.feedback', 'Send message'), [
                            'id' => 'login-btn',
                            'class' => 'btn btn_big btn_primary btn_callback',
                        ]) ?>
                    </div>
                    <?php $this->endWidget(); ?>
                    <?php $this->widget('application.modules.callback.widgets.CallbackWidget'); ?>

                </div>


            </div>
        </div>
    </div>
</div>
