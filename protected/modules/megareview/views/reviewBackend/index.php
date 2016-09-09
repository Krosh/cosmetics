<?php
/**
 * Отображение для index:
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
    Yii::t('MegareviewModule.megareview', 'Управление'),
];

$this->pageTitle = Yii::t('MegareviewModule.megareview', 'Отзывы - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MegareviewModule.megareview', 'Управление отзывами'), 'url' => ['/megareview/reviewBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MegareviewModule.megareview', 'Добавить отзыв'), 'url' => ['/megareview/reviewBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('MegareviewModule.megareview', 'Отзывы'); ?>
        <small><?php echo Yii::t('MegareviewModule.megareview', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?php echo Yii::t('MegareviewModule.megareview', 'Поиск отзывов'); ?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
    <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('review-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
    ?>
</div>

<br/>

<p> <?php echo Yii::t('MegareviewModule.megareview', 'В данном разделе представлены средства управления отзывами'); ?>
</p>

<?php
$this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id' => 'review-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => [
            [
                'name' => 'id_mega_user',
                'value' => '$data->megauser->fio',
            ],
            [
                'name' => 'moderation_status',
                'value' => function ($data) {
                    if ($data->moderation_status == Review::$MODERATION_ON)
                        $status = "primary";
                    elseif ($data->moderation_status == Review::$MODERATION_SUCCESS)
                        $status = "success"; else
                        $status = "error";
                    $result = '<span class="label label-' . $status . '">' . Review::getStatuses()[$data->moderation_status] . '</span>';
                    return $result;
                },
                'type' => 'raw',
                'filter' => Review::getStatuses(),
            ],
            [
                'name' => 'review_target',
                'value' => 'Review::getAllTargets()[$data->review_target]',
                'filter' => Review::getAllTargets(),
            ],
            'rating',
            'text',
            'date_add',
            'has_audio',
//            'audio_file',
//            'has_video',
//            'video_file',
//            'video_preview',
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
