<?php
/**
 * Отображение для update:
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('MegareviewModule.megareview', 'Пользователи') => ['/megareview/megauserBackend/index'],
    $model->id => ['/megareview/megauserBackend/view', 'id' => $model->id],
    Yii::t('MegareviewModule.megareview', 'Редактирование'),
];

$this->pageTitle = Yii::t('MegareviewModule.megareview', 'Пользователи - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MegareviewModule.megareview', 'Управление пользователями'), 'url' => ['/megareview/megauserBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MegareviewModule.megareview', 'Добавить пользователя'), 'url' => ['/megareview/megauserBackend/create']],
    ['label' => Yii::t('MegareviewModule.megareview', 'Пользователь') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('MegareviewModule.megareview', 'Редактирование пользователя'), 'url' => [
        '/megareview/megauserBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('MegareviewModule.megareview', 'Просмотреть пользователя'), 'url' => [
        '/megareview/megauserBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('MegareviewModule.megareview', 'Удалить пользователя'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/megareview/megauserBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('MegareviewModule.megareview', 'Вы уверены, что хотите удалить пользователя?'),
        'csrf' => true,
    ]],
];
?>
    <div class="page-header">
        <h1>
            <?php echo Yii::t('MegareviewModule.megareview', 'Редактирование') . ' ' . Yii::t('MegareviewModule.megareview', 'пользователя'); ?>
            <br/>
            <small>&laquo;<?php echo $model->id; ?>&raquo;</small>
        </h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>