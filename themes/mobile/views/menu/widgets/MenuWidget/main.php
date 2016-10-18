<?php
$arr = $this->params['items'];
$res = [];
foreach ($arr as $item)
{
    $item["url"] = $this->getController()->createUrl($item["url"][0]);
    $res[] = $item;
}
$this->widget('zii.widgets.CMenu', [
    'items' => $res,
    'itemCssClass' => 'top-menu__item',
    'htmlOptions' => [
        'class' => 'top-menu'
    ],
    'submenuHtmlOptions' => [
        'class' => 'dropdown-menu'
    ]
]);
