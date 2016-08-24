<?php
/**
 * Отображение для create:
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('MegareviewModule.megareview', 'Отзывы') => ['/megareview/reviewBackend/index'],
    Yii::t('MegareviewModule.megareview', 'Добавление'),
];

$this->pageTitle = Yii::t('MegareviewModule.megareview', 'Отзывы - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MegareviewModule.megareview', 'Управление отзывами'), 'url' => ['/megareview/reviewBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MegareviewModule.megareview', 'Добавить отзыв'), 'url' => ['/megareview/reviewBackend/create']],
];
?>
    <div class="page-header">
        <h1>
            <?php echo Yii::t('MegareviewModule.megareview', 'Отзывы'); ?>
            <small><?php echo Yii::t('MegareviewModule.megareview', 'добавление'); ?></small>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>