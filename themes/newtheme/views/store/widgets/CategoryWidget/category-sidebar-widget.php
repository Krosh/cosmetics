<?
$newItems = array();
$newItems[] = ["id" => 1, "label" => "Все продукты", "url" => $this->getController()->createUrl("/store")];
$newItems[] = ["id" => 1, "label" => "<br>", "url" => ""];
$newItems[] = ["id" => 1, "label" => "Хиты продаж", "url" => $this->getController()->createUrl("/store/hit")];
$newItems[] = ["id" => 1, "label" => "<br>", "url" => ""];
$tree = array_merge($newItems,$tree);
$this->widget('zii.widgets.CMenu', [
    'items' => $tree,
    'encodeLabel' => false,
    'itemCssClass' => (isset($htmlOptions['class'])? $htmlOptions['class']: 'top-menu').'__item',
    'htmlOptions' => [
        'class' => isset($htmlOptions['class'])? $htmlOptions['class']: 'top-menu'
    ],
]);?>
