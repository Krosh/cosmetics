<?php
/* @var Ingredient $data */
//$productUrl = Yii::app()->createUrl('/store/product/view', ['name' => CHtml::encode($data->slug)]);
//$basePrice = (float)$data->getBasePrice();
?>
<div class="ingridient__item">
     <img src="<?= $data->getImageUrl(150, 180, false) ?>" class="ingridient__img" />
    <div class="ingridient__title"><?= $data->name?></div>
    <div class="ingridient__description"><?= $data->short_description?></div>
</div>
