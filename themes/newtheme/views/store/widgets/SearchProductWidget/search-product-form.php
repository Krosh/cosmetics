<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'action' => ['/store/product/index'],
        'method' => 'GET',
    ]
) ?>
<div class="search_wrapper" >
    <span class="search__icon">

</span>
<?= CHtml::textField(
    AttributeFilter::MAIN_SEARCH_QUERY_NAME,
    CHtml::encode(Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME)),
    ['class' => 'search-bar__input']
); ?>
    <div class="clearfix">

    </div>

</div>
<?php $this->endWidget(); ?>
