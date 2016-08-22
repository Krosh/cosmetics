<?php
/**
* Отображение для bitrix24Backend/index
*
* @category YupeView
* @package  yupe
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     http://yupe.ru
**/
$this->breadcrumbs = [
    Yii::t('Bitrix24Module.bitrix24', 'bitrix24') => ['/bitrix24/bitrix24Backend/index'],
    Yii::t('Bitrix24Module.bitrix24', 'Index'),
];

$this->pageTitle = Yii::t('Bitrix24Module.bitrix24', 'bitrix24 - index');

$this->menu = $this->getModule()->getNavigation();;
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('Bitrix24Module.bitrix24', 'bitrix24'); ?>
        <small><?php echo Yii::t('Bitrix24Module.bitrix24', 'Index'); ?></small>
    </h1>
</div>