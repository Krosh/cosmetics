<?php
/**
 * Отображение для default/_form:
 *
 * @category YupeView
 * @package  yupe
 * @author Valek Vergilyush <v.vergilyush@gmail.com>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @link http://green-s.pro
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id'                     => 'slide-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'type'                   => 'vertical',
        'htmlOptions'            => array('class' => 'well', 'enctype' => 'multipart/form-data'),
    )
); ?>
<div class="alert alert-info">
    <?php echo Yii::t('SlideModule.slide', 'Fields with'); ?>
    <span class="required">*</span>
    <?php echo Yii::t('SlideModule.slide', 'are required.'); ?>
</div>

<?php echo $form->errorSummary($model); ?>



<div class='row'>
    <div class="col-sm-7">


        <div class='row'>
            <div class="col-sm-12">
                <br/>
                <?php if (!$model->isNewRecord) : ?>
                    <?php echo CHtml::image($model->getImageUrl(350, 200), '', array("width" => 350, "height" => 200)); ?>
                <?php endif; ?>
                <?php echo $form->fileFieldGroup(
                    $model,
                    'file',
                    array(
                        'widgetOptions' => array(
                            'htmlOptions' => array('style' => 'background-color: inherit;'),
                        ),
                    )
                ); ?>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-12">
                <?php
                $pages = Page::model()->published()->findAll();
                $arr = ["maininfo" => 'Главная страница'];
                foreach ($pages as $item)
                {
                    $arr[$item->slug] = $item->title;
                }
                ?>
                <?php echo $form->dropDownListGroup($model, 'slideshow_identifier',array(
                    'widgetOptions' => array(
                        'data' => $arr,
                        'htmlOptions' => array(),
                    ),
                )); ?>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-12">
                <?php echo $form->textFieldGroup($model, 'name'); ?>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-12">
                <?php echo $form->textAreaGroup($model, 'description'); ?>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-12">
                <?php echo $form->textFieldGroup($model, 'url'); ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-sm-8'>
                <?php echo $form->dropDownListGroup(
                    $model,
                    'status',
                    array(
                        'widgetOptions' => array(
                            'data' => $model->getStatusList(),
                        ),
                    )
                ); ?>
            </div>

        </div>

    </div>


    <div class="col-sm-5">
        Подсказка:
        <div style="width: 350px; height: 200px; overflow: hidden;">
            <?php if ($model->isNewRecord) : { ?>
                <?php $baseUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.slide.views.assets')); ?>
                <?php $img = $baseUrl.'/img/hint.jpg'; ?>
            <?php } else : { ?>
                <?php $img = $model->getImageUrl(350, 200); ?>
            <?php } endif; ?>
            <?php echo CHtml::image($img, '', array("width" => 350, "height" => 200)); ?>


            <div style="background-color: rgba(0,0,0,0.5); height: 60px; position: relative; top:-60px; z-index: 2; padding: 10px!important; color:#FFF;">
                <b>Заголовок слайда</b><br/>
                Некоторый текст к слайду
            </div>
        </div>
    </div>

</div>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord ? Yii::t('SlideModule.slide', 'Add slide and close') : Yii::t(
            'SlideModule.slide',
            'Save slide and continue'
        ),
    )
); ?>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'buttonType'  => 'submit',
        'htmlOptions' => array('name' => 'submit-type', 'value' => 'index'),
        'label'       => $model->isNewRecord ? Yii::t('SlideModule.slide', 'Add slide and save') : Yii::t(
            'SlideModule.slide',
            'Save mage and close'
        ),
    )
); ?>

<?php $this->endWidget(); ?>
