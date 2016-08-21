<ul class= "side-menu">
    <?php foreach ($this->params["items"] as $item):?>
        <li class = "listItem side-menu__item">
            <a class="listItemLink" href="<?=$item["url"]; ?>"><?=$item["label"]; ?></a>
        </li>
    <?php endforeach; ?>
</ul>
