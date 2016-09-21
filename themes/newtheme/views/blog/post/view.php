<?php
/**
 * @var $this PostController
 */

/* @var $post Post */

/*if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}*/

$this->title = [$post->title, Yii::app()->getModule('yupe')->siteName];
$this->breadcrumbs = [$post->title];
$this->description = $post->description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $post->tags ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>
<style>
    .mejs-controls .mejs-time-rail .mejs-time-total {
        width: 355px !important;
    }
</style>
<div class="main__catalog grid">
    <div class="cols">
        <div class="col grid-module-3">
            <div class="catalog-filter">
                <?php $this->widget(
                    'application.modules.blog.widgets.LastPostsWidget',
                    ['cacheTime' => $this->yupe->coreCacheTime, "limit" => 7, 'view' => 'sidemenu']
                ); ?>
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
            <div class="wysiwyg">
                <?= $post->content; ?>
            </div>
        </div>
    </div>
</div>


