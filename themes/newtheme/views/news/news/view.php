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
                    <div class="b-news-text"> <?= $model->full_text; ?> </div>
                </div>
            </div>
            <hr style="margin: 10px 0">
            <div style="text-align: center;margin: 10px auto">
                КОММЕНТАРИИ
            </div>
            <div class="b-reviews-product">
                <div class="b-reviews-product__head">
                    <div class="b-reviews-product__head--avatar">
                        <div class="head--avatar">
                            <div class="social_pic">

                            </div>
                        </div>
                    </div>
                    <div class="b-reviews-product__head--info">
                        Елена
                    </div>
                </div>
                <div class="b-reviews-product__body">
                    <div class="b-reviews-product__body--star">
                        <div class="b-reviews-product__body--rating">
                        </div>
                    </div>
                    <div class="b-reviews-product__body--text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis consequat finibus interdum. In
                        hac habitasse platea dictumst. Vestibulum tincidunt non velit nec faucibus. Quisque
                        ultricies urna consectetur erat pulvinar, nec feugiat sapien luctus. Vivamus vitae dolor a
                        lacus porttitor pretium. Mauris sit amet placerat odio, eu vestibulum diam. Aenean eleifend
                        lectus id neque blandit scelerisque. Maecenas convallis nec ipsum sit amet lacinia. Aliquam
                        erat volutpat.
                    </div>
                </div>

            </div>
            <div class="b-reviews-product">
                <div class="b-reviews-product__head">
                    <div class="b-reviews-product__head--avatar">
                        <div class="head--avatar">
                            <div class="social_pic">

                            </div>
                        </div>
                    </div>
                    <div class="b-reviews-product__head--info">
                        Елена
                    </div>
                </div>
                <div class="b-reviews-product__body">
                    <div class="b-reviews-product__body--star">
                        <div class="b-reviews-product__body--rating">
                        </div>
                    </div>
                    <div class="b-reviews-product__body--text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis consequat finibus interdum. In
                        hac habitasse platea dictumst. Vestibulum tincidunt non velit nec faucibus. Quisque
                        ultricies urna consectetur erat pulvinar, nec feugiat sapien luctus. Vivamus vitae dolor a
                        lacus porttitor pretium. Mauris sit amet placerat odio, eu vestibulum diam. Aenean eleifend
                        lectus id neque blandit scelerisque. Maecenas convallis nec ipsum sit amet lacinia. Aliquam
                        erat volutpat.
                    </div>
                </div>

            </div>
            <div class="b-reviews-product">
                <div class="b-reviews-product__head">
                    <div class="b-reviews-product__head--avatar">
                        <div class="head--avatar">
                            <div class="social_pic">

                            </div>
                        </div>
                    </div>
                    <div class="b-reviews-product__head--info">
                        Елена
                    </div>
                </div>
                <div class="b-reviews-product__body">
                    <div class="b-reviews-product__body--star">
                        <div class="b-reviews-product__body--rating">
                        </div>
                    </div>
                    <div class="b-reviews-product__body--text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis consequat finibus interdum. In
                        hac habitasse platea dictumst. Vestibulum tincidunt non velit nec faucibus. Quisque
                        ultricies urna consectetur erat pulvinar, nec feugiat sapien luctus. Vivamus vitae dolor a
                        lacus porttitor pretium. Mauris sit amet placerat odio, eu vestibulum diam. Aenean eleifend
                        lectus id neque blandit scelerisque. Maecenas convallis nec ipsum sit amet lacinia. Aliquam
                        erat volutpat.
                    </div>
                </div>

            </div>
            <div style="text-align: right">
                <button class="btn" id="btn-reviews" type="button" onclick="$('#dialog-confirm').dialog('open');">
                    Оставить комментарий
                </button>
            </div>
        </div>
    </div>
</div>
<div id="dialog-confirm">
    <?php if (Yii::app()->user->getId() > 0): ?>
        <div class="b-modal-reviews">
            <div class="b-modal-reviews__head">
                <div class="b-modal-reviews__question">
                    Ваш комментарий
                </div>
                <div class="b-modal-reviews__rating">
                </div>
            </div>
            <form action="" id="b-modal__form">
                <?=
                CHtml::hiddenField(
                    Yii::app()->getRequest()->csrfTokenName,
                    Yii::app()->getRequest()->csrfToken
                ); ?>
                <div class="b-modal-reviews__body">
                    <textarea class="b-modal-reviews__textarea" name="b-modal-reviews__text" id="">
                    </textarea>
                </div>
                <div class="b-modal-reviews__btns">
                    <button class="btn" type="submit"> Отправить</button>
                </div>
            </form>
        </div>
    <?php else: ?>
        Надо авторизоваться, тут форма для авторизации блаблабла<br>
        <?php
        $this->widget('ext.eauth.EAuthWidget', array('action' => '/loginFromSocial'));
        ?>
    <?php endif; ?>

</div>