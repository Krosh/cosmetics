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
    Yii::t('MegareviewModule.megareview', 'Пользователи') => ['/megareview/megauserBackend/index'],
    Yii::t('MegareviewModule.megareview', 'Управление'),
];

$this->pageTitle = Yii::t('MegareviewModule.megareview', 'Пользователи - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('MegareviewModule.megareview', 'Управление пользователями'), 'url' => ['/megareview/megauserBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('MegareviewModule.megareview', 'Добавить пользователя'), 'url' => ['/megareview/megauserBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('MegareviewModule.megareview', 'Пользователи'); ?>
        <small><?php echo Yii::t('MegareviewModule.megareview', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?php echo Yii::t('MegareviewModule.megareview', 'Поиск пользователей'); ?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
    <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('megauser-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
    ?>
</div>

<br/>

<p> <?php echo Yii::t('MegareviewModule.megareview', 'В данном разделе представлены средства управления пользователями'); ?>
</p>

<?php
$this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id' => 'megauser-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => [
            [
                'name' => 'avatar_path',
                'type' => 'raw',
                'value' => 'CHtml::image($data->avatar_path)',
            ],
            [
                'name' => 'social_type',
                'value' => '$data->getSocialAsString()',
            ],
            'fio',
            [
                'name' => 'social_link',
                'type' => 'raw',
                'value' => 'CHtml::link($data->social_link,$data->social_link)',
            ],
//            'adres',
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
