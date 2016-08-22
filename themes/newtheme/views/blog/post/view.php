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
                            'homeLink' => '<li><a href="'.$this->createUrl("/").'">' . Yii::t('Yii.zii', 'Home') . '</a>',
                            'activeLinkTemplate' => '<li><a href="{url}">{label}</a>',
                            'inactiveLinkTemplate' => '<li><a>{label}</a>',
                            'htmlOptions' => []
                        ]
                    );?>
                </div>
            </div>
            <?= $post->content; ?>
      <!--      <div class="b-audio-feedback">
                <div class="b-audio-feedback__head">
                    <div class="b-audio-feedback__info-author">
                        <div class="b-audio-feedback__name">
                            Елена
                            <br>
                            г. Томск
                            <br>
                            Июнь 2016
                        </div>
                    </div>
                </div>
                <div class="b-audio-feedback__body">
                    <div class="b-audio-feedback__description-audio">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget dui orci. Vestibulum euismod est a
                        erat tempus volutpat. Sed non varius ex. Fusce pretium nulla non leo molestie vehicula. Nullam eu velit
                        in nunc rhoncus ultrices ut a lacus. Praesent eu porttitor risus, a finibus nunc. Nulla dignissim arcu
                        vestibulum tincidunt iaculis.
                    </div>
                    <br>
                    <div class="audio-player">
                        <audio class="audio" preload="true" src="/123.mp3">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="b-audio-feedback">
                <div class="b-audio-feedback__head">
                    <div class="b-audio-feedback__info-author">
                        <div class="b-audio-feedback__name">
                            Елена
                            <br>
                            г. Томск
                            <br>
                            Июнь 2016
                        </div>
                    </div>
                </div>
                <div class="b-audio-feedback__body">
                    <div class="b-audio-feedback__description-audio">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget dui orci. Vestibulum euismod est a
                        erat tempus volutpat. Sed non varius ex. Fusce pretium nulla non leo molestie vehicula. Nullam eu velit
                        in nunc rhoncus ultrices ut a lacus. Praesent eu porttitor risus, a finibus nunc. Nulla dignissim arcu
                        vestibulum tincidunt iaculis.
                    </div>
                    <br>
                    <div class="audio-player">
                        <audio class="audio" preload="true" src="/123.mp3">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="b-audio-feedback">
                <div class="b-audio-feedback__head">
                    <div class="b-audio-feedback__info-author">
                        <div class="b-audio-feedback__name">
                            Елена
                            <br>
                            г. Томск
                            <br>
                            Июнь 2016
                        </div>
                    </div>
                </div>
                <div class="b-audio-feedback__body">
                    <div class="b-audio-feedback__description-audio">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget dui orci. Vestibulum euismod est a
                        erat tempus volutpat. Sed non varius ex. Fusce pretium nulla non leo molestie vehicula. Nullam eu velit
                        in nunc rhoncus ultrices ut a lacus. Praesent eu porttitor risus, a finibus nunc. Nulla dignissim arcu
                        vestibulum tincidunt iaculis.
                    </div>
                    <br>
                    <div class="audio-player">
                        <audio class="audio" preload="true" src="/123.mp3">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="b-audio-feedback">
                <div class="b-audio-feedback__head">
                    <div class="b-audio-feedback__info-author">
                        <div class="b-audio-feedback__name">
                            Елена
                            <br>
                            г. Томск
                            <br>
                            Июнь 2016
                        </div>
                    </div>
                </div>
                <div class="b-audio-feedback__body">
                    <div class="b-audio-feedback__description-audio">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget dui orci. Vestibulum euismod est a
                        erat tempus volutpat. Sed non varius ex. Fusce pretium nulla non leo molestie vehicula. Nullam eu velit
                        in nunc rhoncus ultrices ut a lacus. Praesent eu porttitor risus, a finibus nunc. Nulla dignissim arcu
                        vestibulum tincidunt iaculis.
                    </div>
                    <br>
                    <div class="audio-player">
                        <audio class="audio" preload="true" src="/123.mp3">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="b-audio-feedback">
                <div class="b-audio-feedback__head">
                    <div class="b-audio-feedback__info-author">
                        <div class="b-audio-feedback__name">
                            Елена
                            <br>
                            г. Томск
                            <br>
                            Июнь 2016
                        </div>
                    </div>
                </div>
                <div class="b-audio-feedback__body">
                    <div class="b-audio-feedback__description-audio">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget dui orci. Vestibulum euismod est a
                        erat tempus volutpat. Sed non varius ex. Fusce pretium nulla non leo molestie vehicula. Nullam eu velit
                        in nunc rhoncus ultrices ut a lacus. Praesent eu porttitor risus, a finibus nunc. Nulla dignissim arcu
                        vestibulum tincidunt iaculis.
                    </div>
                    <br>
                    <div class="audio-player">
                        <audio class="audio" preload="true" src="/123.mp3">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="b-audio-feedback">
                <div class="b-audio-feedback__head">
                    <div class="b-audio-feedback__info-author">
                        <div class="b-audio-feedback__name">
                            Елена
                            <br>
                            г. Томск
                            <br>
                            Июнь 2016
                        </div>
                    </div>
                </div>
                <div class="b-audio-feedback__body">
                    <div class="b-audio-feedback__description-audio">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget dui orci. Vestibulum euismod est a
                        erat tempus volutpat. Sed non varius ex. Fusce pretium nulla non leo molestie vehicula. Nullam eu velit
                        in nunc rhoncus ultrices ut a lacus. Praesent eu porttitor risus, a finibus nunc. Nulla dignissim arcu
                        vestibulum tincidunt iaculis.
                    </div>
                    <br>
                    <div class="audio-player">
                        <audio class="audio" preload="true" src="/123.mp3">
                        </audio>
                    </div>
                </div>
            </div>-->

        </div>
    </div>
</div>


