<?
$newItems = array();
//$newItems[] = ["id" => 1, "label" => "Все товары", "url" => $this->getController()->createUrl("/store")];
//$newItems[] = ["id" => 1, "label" => "", "url" => ""];
//$newItems[] = ["id" => 1, "label" => "Хиты продаж", "url" => $this->getController()->createUrl("/store/hit")];
//$newItems[] = ["id" => 1, "label" => "", "url" => ""];
$tree = array_merge($newItems,$this->params['items']); 
$this->widget('zii.widgets.CMenu', [
    'items' => $tree,
    'itemCssClass' => (isset($htmlOptions['class'])? $htmlOptions['class']: 'side-menu').'__item',
    'htmlOptions' => [
        'class' => isset($htmlOptions['class'])? $htmlOptions['class']: 'side-menu'
    ],
    'encodeLabel' => false,
    'submenuHtmlOptions' => [
        'class' => 'dropdown-menu'
    ]
]);?>
