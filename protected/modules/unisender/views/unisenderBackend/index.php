<?php
/**
 * Отображение для unisenderBackend/index
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    Yii::t('UnisenderModule.unisender', 'unisender') => ['/unisender/unisenderBackend/index'],
    Yii::t('UnisenderModule.unisender', 'Index'),
];

$this->pageTitle = Yii::t('UnisenderModule.unisender', 'unisender');

$this->menu = $this->getModule()->getNavigation();;
?>

    <div class="page-header">
        <h1>
            <?php echo Yii::t('UnisenderModule.unisender', 'unisender'); ?>
            <small><?php echo Yii::t('UnisenderModule.unisender', 'Index'); ?></small>
        </h1>
    </div>
<?php
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',
    [
        "action" => "/backend/unisender/unisender/save",
        'id' => 'unisender-form',
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
        <div class="col-sm-8">
            Используемое имя отправителя: <?=CHtml::textField("senderId",$senderId,["class" => "form-control"]) ?>
        </div>
    </div>
    <div class='row'>
        <div class="col-sm-4">
            <input type="submit" class="btn btn-primary" value="Сохранить">
        </div>
    </div>

<?php $this->endWidget(); ?>