<?php
/**
 * Created by JetBrains PhpStorm.
 * User: БОСС
 * Date: 01.04.16
 * Time: 21:39
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="<?=$containerClass; ?>">
    <div data-show='1' data-scroll='1' data-infinite='1' data-autoplay='5000' data-speed='1500' data-dots='1' class="promo-slider js-slick promo-slider_main">
        <div class="promo-slider__slides js-slick__container">
            <?php foreach ($items as $item):?>
                <img src="<?=$item["image"];?>">
            <?php endforeach; ?>
        </div>
    </div>
</div>
