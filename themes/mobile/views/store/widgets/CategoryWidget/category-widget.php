<?
$this->widget('zii.widgets.CMenu', [
    'items' => $tree,
    'itemCssClass' => (isset($htmlOptions['class'])? $htmlOptions['class']: 'top-menu').'__item',
    'htmlOptions' => [
        'class' => isset($htmlOptions['class'])? $htmlOptions['class']: 'top-menu'
    ],
    'submenuHtmlOptions' => [
        'class' => 'dropdown-menu'
    ]
]);?>
