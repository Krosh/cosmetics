<?php
/* @var $data News */
?>
<div class="b-news">
    <div
        class="b-news__title"> <?= CHtml::link(CHtml::encode($data->title), $data->getUrl(), ['class' => 'cart-item__link']); ?>
    </div>
    <div class="b-news__content">
        <div class="b-news__head">
            <div class="b-news__head__image" style="background-image: url('<?php if ($data->image): ?>
                <?= $data->getImageUrl(); ?>
            <?php endif; ?>')">
            </div>
        </div>
        <div class="b-news__description">
            <?= $data->short_text; ?>
            <div class="b-news__description__next-read">
                <div class="next-read" style="text-align: center"><a href="<?= $data->getUrl(); ?>"> (Читать далее)</a>
                </div>
                <span class="news-reviews"> <img src="<?= $this->mainAssets ?>/images/news-customer-reviews.png"
                                                 alt=""> Отзывов: 124  </span>
                <span class="news-view"> <img src="<?= $this->mainAssets ?>/images/news-eye.png"
                                              alt="">Просмотров: 1254 </span>
            </div>
        </div>
    </div>
</div>
