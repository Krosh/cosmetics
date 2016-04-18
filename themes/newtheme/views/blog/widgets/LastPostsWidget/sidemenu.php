<?php /* @var Post[] $models */ ?>

<?
$newItems = array();
foreach ($models as $item)
{
    $newItems[] = ["label" => $item->getTitle(), "url" => $item->getUrl()];
}
$this->widget('zii.widgets.CMenu', [
    'items' => $newItems,
    'itemCssClass' => (isset($htmlOptions['class'])? $htmlOptions['class']: 'side-menu').'__item',
    'htmlOptions' => [
        'class' => isset($htmlOptions['class'])? $htmlOptions['class']: 'side-menu'
    ],
    'encodeLabel' => false,
    'submenuHtmlOptions' => [
        'class' => 'dropdown-menu'
    ]
]);?>
