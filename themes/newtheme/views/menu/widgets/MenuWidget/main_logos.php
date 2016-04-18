<?php foreach ($this->params['items'] as $item):?>
    <a href= "<?=$this->getController()->createUrl(is_array($item["url"]) ? $item["url"][0]: $item["url"]); ?>">
        <div class="main__logos_item">
            <div class="main__logo small">
                <img src="<?= $this->getController()->mainAssets ?>/images/<?=++$i;?>.jpg">
            </div>
            <div class="main__logo_item-title">
                <?=$item["label"]; ?>
            </div>
        </div>
    </a>
<?php endforeach; ?>
