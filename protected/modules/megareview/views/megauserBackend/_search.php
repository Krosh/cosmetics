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
                <?php echo $form->textFieldGroup($model, 'id_user', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('id_user'),
                            'data-content' => $model->getAttributeDescription('id_user')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'social_type', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('social_type'),
                            'data-content' => $model->getAttributeDescription('social_type')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'social_link', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('social_link'),
                            'data-content' => $model->getAttributeDescription('social_link')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'avatar_path', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('avatar_path'),
                            'data-content' => $model->getAttributeDescription('avatar_path')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'fio', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('fio'),
                            'data-content' => $model->getAttributeDescription('fio')
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'adres', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('adres'),
                            'data-content' => $model->getAttributeDescription('adres')
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
        'label' => '<i class="fa fa-search">&nbsp;</i> ' . Yii::t('MegareviewModule.megareview', 'Искать пользователя'),
    ]
); ?>

<?php $this->endWidget(); ?>