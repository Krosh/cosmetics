<?php /* @var Post[] $models */ ?>
<div class="blog__slider">
    <?php foreach ($models as $model): ?>
        <div class="blog__item">
            <div class="blog__inner">
                <img src="<?= $model->getImageUrl(350, 180, false) ?>" class="blog__img" />
                <div class="blog__description"><?= $model->getQuote()?></div>
            </div>
            <?= CHtml::link("Подробнее",$model->getUrl(),["class" => "blog__link"]); ?>
        </div>
    <?php endforeach; ?>
</div>
