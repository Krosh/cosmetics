<?php foreach ($this->params['items'] as $item): ?>
    <div class="b-reviews__item">
        <div style="text-align:center">
            <img src="<?= $this->getController()->mainAssets ?>/images/<?= ++$i; ?>.jpg">
        </div>
        <div class="b-reviews__logo-desc">
            <div class="b-reviews__item--description">
                <p class="b-reviews__item--description--title">
                    <a href="<?= $this->getController()->createUrl(is_array($item["url"]) ? $item["url"][0] : $item["url"]); ?>">   <?= $item["label"]; ?> </a>
                </p>

                <div class="b-reviews__item--description--text">
                    <?= str_replace("{menu}", "", $item["template"]) ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>