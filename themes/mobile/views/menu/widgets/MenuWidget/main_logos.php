<?php foreach ($this->params['items'] as $item): ?>
    <div class="b-reviews__item">
        <div>
            <img src="<?= $this->getController()->mainAssets ?>/images/<?= ++$i; ?>.jpg">
        </div>

                    <a href="<?= $this->getController()->createUrl(is_array($item["url"]) ? $item["url"][0] : $item["url"]); ?>">   <?= $item["label"]; ?> </a>

                <div class="b-reviews__item--description--text">
                    <?= str_replace("{menu}", "", $item["template"]) ?>
                </div>
    </div>
<?php endforeach; ?>