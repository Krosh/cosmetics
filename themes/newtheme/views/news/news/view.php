<?php
/**
 * Отображение для ./themes/default/views/news/news/news.php:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 *
 * @var $this NewsController
 * @var $model News
 **/
?>
<?php
$this->title = [$model->title, Yii::app()->getModule('yupe')->siteName];
$this->metaDescription = $model->description;
$this->metaKeywords = $model->keywords;
?>

<?php
$this->breadcrumbs = [
    Yii::t('NewsModule.news', 'News') => ['/news/news/index'],
    $model->title
];
?>


<div class="main__catalog grid">
    <div class="cols">
        <div class="col grid-module-3">
            <div class="catalog-filter">
                <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'servisy', 'layout' => 'sidebar']); ?>
            </div>
        </div>
        <div class="col grid-module-9">
            <div class="main__breadcrumbs grid">
                <div class="breadcrumbs">
                    <?php $this->widget(
                        'zii.widgets.CBreadcrumbs',
                        [
                            'links' => $this->breadcrumbs,
                            'tagName' => 'ul',
                            'separator' => '',
                            'homeLink' => '<li><a href="' . $this->createUrl("/") . '">' . Yii::t('Yii.zii', 'Home') . '</a>',
                            'activeLinkTemplate' => '<li><a href="{url}">{label}</a>',
                            'inactiveLinkTemplate' => '<li><a>{label}</a>',
                            'htmlOptions' => []
                        ]
                    ); ?>
                </div>
            </div>
            <div class="page__content">
                <div class="main__title grid">
                    <h1 class="h2"><?= CHtml::encode($model->title); ?></h1>
                </div>
                <div class="main__catalog grid fast-order__inputs">
                    <?php if ($model->image): ?>
                        <img src="<?= $model->getImageUrl(); ?>"
                             style="max-width: 300px;width: 100%;float: left;margin: 20px" alt="">
                    <?php endif; ?>
                    <div class="b-news-text">
                        <div class="wysiwyg">
                            <?= $model->full_text; ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin: 10px 0">
            <div style="text-align: center;margin: 10px auto">
                КОММЕНТАРИИ
            </div>
            <div class="product-reviews">
                <?php $this->widget('application.modules.comment.widgets.CommentsWidget', ['model' => $model]); ?>
            </div>
        </div>
    </div>
</div>
<div id="dialog-close" title="Спасибо за комментарий">
    <div style="text-align: center;">
        Спасибо за комментарий, <br> он появится после модерации
    </div>
</div>