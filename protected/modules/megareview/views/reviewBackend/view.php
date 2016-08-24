<?php
/**
 * Отображение для view:
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
    $model->id,
];

$this->pageTitle = Yii::t('MegareviewModule.megareview', 'Отзывы - просмотр');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MegareviewModule.megareview', 'Управление отзывами'), 'url' => ['/megareview/reviewBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MegareviewModule.megareview', 'Добавить отзыв'), 'url' => ['/megareview/reviewBackend/create']],
    ['label' => Yii::t('MegareviewModule.megareview', 'Отзыв') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('MegareviewModule.megareview', 'Редактирование отзыва'), 'url' => [
        '/megareview/reviewBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('MegareviewModule.megareview', 'Просмотреть отзыв'), 'url' => [
        '/megareview/reviewBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('MegareviewModule.megareview', 'Удалить отзыв'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/megareview/reviewBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('MegareviewModule.megareview', 'Вы уверены, что хотите удалить отзыв?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('MegareviewModule.megareview', 'Просмотр') . ' ' . Yii::t('MegareviewModule.megareview', 'отзыва'); ?>
        <br/>
        <small>&laquo;<?php echo $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'id_mega_user',
        'rating',
        'text',
        'date_add',
        'has_audio',
        'audio_file',
        'has_video',
        'video_file',
        'video_preview',
    ],
]); ?>
