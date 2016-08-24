<?php
/**
 * Отображение для megareviewBackend/index
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    Yii::t('MegareviewModule.megareview', 'megareview') => ['/megareview/megareviewBackend/index'],
    Yii::t('MegareviewModule.megareview', 'Index'),
];

$this->pageTitle = Yii::t('MegareviewModule.megareview', 'megareview - index');

$this->menu = $this->getModule()->getNavigation();;
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('MegareviewModule.megareview', 'megareview'); ?>
        <small><?php echo Yii::t('MegareviewModule.megareview', 'Index'); ?></small>
    </h1>
</div>