<?php
/**
 * Отображение для _form:
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 *
 * @var $model Review
 * @var $form TbActiveForm
 * @var $this ReviewBackendController
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'id' => 'review-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['class' => 'well'],
    ]
);
?>

    <div class="alert alert-info">
        <?php echo Yii::t('MegareviewModule.megareview', 'Поля, отмеченные'); ?>
        <span class="required">*</span>
        <?php echo Yii::t('MegareviewModule.megareview', 'обязательны.'); ?>
    </div>

<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->textFieldGroup($model, 'id_mega_user', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('id_mega_user'),
                        'data-content' => $model->getAttributeDescription('id_mega_user')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->textFieldGroup($model, 'rating', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('rating'),
                        'data-content' => $model->getAttributeDescription('rating')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->textFieldGroup($model, 'text', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('text'),
                        'data-content' => $model->getAttributeDescription('text')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->dateTimePickerGroup($model, 'date_add', [
                'widgetOptions' => [
                    'options' => [],
                    'htmlOptions' => []
                ],
                'prepend' => '<i class="fa fa-calendar"></i>'
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->textFieldGroup($model, 'has_audio', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('has_audio'),
                        'data-content' => $model->getAttributeDescription('has_audio')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->textFieldGroup($model, 'audio_file', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('audio_file'),
                        'data-content' => $model->getAttributeDescription('audio_file')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->textFieldGroup($model, 'has_video', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('has_video'),
                        'data-content' => $model->getAttributeDescription('has_video')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->textFieldGroup($model, 'video_file', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('video_file'),
                        'data-content' => $model->getAttributeDescription('video_file')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->textFieldGroup($model, 'video_preview', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('video_preview'),
                        'data-content' => $model->getAttributeDescription('video_preview')
                    ]
                ]
            ]); ?>
        </div>
    </div>

<?php $this->widget(
    'bootstrap.widgets.TbButton', [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => Yii::t('MegareviewModule.megareview', 'Сохранить отзыв и продолжить'),
    ]
); ?>
<?php $this->widget(
    'bootstrap.widgets.TbButton', [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => Yii::t('MegareviewModule.megareview', 'Сохранить отзыв и закрыть'),
    ]
); ?>

<?php $this->endWidget(); ?>