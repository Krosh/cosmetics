<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = [$model->title, Yii::app()->getModule('yupe')->siteName];
$this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $model->description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>
<style>
    .b-audio-feedback {
        width: 100% !important;
    }

</style>
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
                <?php
                $reviews = Review::getByProduct(-1);
                ?>
                <?php foreach ($reviews as $item): ?>
                    <div class="b-audio-feedback">
                        <div style="display: flex">
                            <div class="b-audio-feedback__head">
                                <div class="b-audio-feedback__info-author">
                                    <div class="b-audio-feedback__name">
                                        <?= $item->megauser->fio; ?>
                                        <div class="b-audio-feedback__city">
                                            <?= $item->megauser->adres; ?>
                                        </div>
                                        <div class="b-audio-feedback__date">
                                            <?= $item->getDateAsString(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="b-audio-feedback__body">
                                <div class="b-audio-feedback__description-audio">
                                    <?= $item->text; ?>
                                </div>
                                <br>
                            </div>
                        </div>
                        <?php if ($item->has_audio): ?>
                            <div class="audio-player" style="width: 90%">
                                <audio class="audio" preload="true" src="<?= $item->getAudioPath(); ?>">
                                </audio>
                            </div>
                        <?php endif; ?>
                        <?php if ($item->has_video): ?>
                            <div class="b-youtube">
                                <a class="video-youtube" title="Отзыв"
                                   href="<?= $item->getVideoPath(); ?>">
                                    <?= $item->getVideoPath(); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


