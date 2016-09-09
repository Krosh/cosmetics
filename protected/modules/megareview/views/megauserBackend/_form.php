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
 * @var $model Megauser
 * @var $form TbActiveForm
 * @var $this MegauserBackendController
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'id' => 'megauser-form',
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

    <!--    <div class="row">
        <div class="col-sm-7">
            <?php /*echo $form->textFieldGroup($model, 'id_user', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('id_user'),
                        'data-content' => $model->getAttributeDescription('id_user')
                    ]
                ]
            ]); */?>
        </div>
    </div>
-->

    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->dropDownListGroup($model, 'social_type', [
                'widgetOptions' => [
                    'data' => Megauser::getSocials(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('social_type'),
                        'data-content' => $model->getAttributeDescription('social_type')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
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
    </div>
    <div class="row">
        <div class="col-sm-7">
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
    </div>
    <div class="row">
        <div class="col-sm-7">
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
    </div>
    <div class="row">
        <div class="col-sm-7">
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

<?php $this->widget(
    'bootstrap.widgets.TbButton', [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => Yii::t('MegareviewModule.megareview', 'Сохранить пользователя и продолжить'),
    ]
); ?>
<?php $this->widget(
    'bootstrap.widgets.TbButton', [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => Yii::t('MegareviewModule.megareview', 'Сохранить пользователя и закрыть'),
    ]
); ?>

<?php $this->endWidget(); ?>