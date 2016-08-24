<?php
/**
 * Отображение для _search:
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'type' => 'vertical',
        'htmlOptions' => ['class' => 'well'],
    ]
);
?>

    <fieldset>
        <div class="row">
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'id', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('id'),
                            'data-content' => $model->getAttributeDescription('id')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
                <?php echo $form->dateTimePickerGroup($model, 'date_add', [
                    'widgetOptions' => [
                        'options' => [],
                        'htmlOptions' => []
                    ],
                    'prepend' => '<i class="fa fa-calendar"></i>'
                ]); ?>
            </div>
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
    </fieldset>

<?php $this->widget(
    'bootstrap.widgets.TbButton', [
        'context' => 'primary',
        'encodeLabel' => false,
        'buttonType' => 'submit',
        'label' => '<i class="fa fa-search">&nbsp;</i> ' . Yii::t('MegareviewModule.megareview', 'Искать отзыв'),
    ]
); ?>

<?php $this->endWidget(); ?>