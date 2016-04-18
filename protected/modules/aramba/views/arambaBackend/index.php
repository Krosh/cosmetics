<?php
/**
 * Отображение для arambaBackend/index
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    Yii::t('ArambaModule.aramba', 'aramba') => ['/aramba/arambaBackend/index'],
    Yii::t('ArambaModule.aramba', 'Index'),
];

$this->pageTitle = Yii::t('ArambaModule.aramba', 'aramba - index');

$this->menu = $this->getModule()->getNavigation();;
?>

    <div class="page-header">
        <h1>
            <?php echo Yii::t('ArambaModule.aramba', 'aramba'); ?>
            <small><?php echo Yii::t('ArambaModule.aramba', 'Index'); ?></small>
        </h1>
    </div>
<?php
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',
    [
        "action" => "/backend/aramba/aramba/save",
        'id' => 'aramba-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => ['enctype' => 'multipart/form-data', 'class' => 'well'],
    ]
);
?>

    <div class='row'>
        <div class="col-sm-4">
            <h2>Баланс: <strong><?=$balance; ?> Руб.</strong></h2>
        </div>
    </div>
    <div class='row'>
        <div class="col-sm-4">
            Используемое имя отправителя: <?=CHtml::dropDownList("senderId",$senderName,$names,["class" => "form-control"]) ?>
        </div>
    </div>
    <div class='row'>
        <div class="col-sm-4">
            <input type="submit" class="btn btn-primary" value="Сохранить">
        </div>
    </div>

<?php $this->endWidget(); ?>