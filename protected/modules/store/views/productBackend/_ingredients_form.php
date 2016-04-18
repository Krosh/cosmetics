<?php
/* @var $searchModel ProductSearch */
/* @var $product Product */

?>


<div class="row">
    <div class="col-sm-12">
        <h3>Используемые ингредиенты</h3>
        <?php
        $ingredients = new ProductIngredient('search');
        $ingredients->setAttributes(Yii::app()->getRequest()->getParam('ProductIngredient'));
        $ingredients->product_id = $product->id;
        $this->widget(
            'yupe\widgets\CustomGridView',
            [
                'id' => 'linked-ingredient-grid',
                'type' => 'condensed',
                'dataProvider' => $ingredients->search(),
                'filter' => $ingredients,
                'actionsButtons' => false,
                'bulkActions' => [false],
                'ajaxUrl' => ['/store/productBackend/update', 'id' => $product->id],
                'columns' => [
                    [
                        'type' => 'raw',
                        'value' => function ($data) {
                            return CHtml::link(
                                CHtml::image(
                                    $data->ingredient->getImageUrl(40, 40),
                                    $data->ingredient->name,
                                    ["class" => "img-thumbnail"]
                                ),
                                ["/store/ingridientBackend/update", "id" => $data->ingredient->id]
                            );
                        },
                    ],
                    [
                        'header' => Yii::t('StoreModule.store', 'Name'),
                        'type' => 'raw',
                        'value' => function ($data) {
                            return CHtml::link(
                                $data->ingredient->name,
                                ["/store/ingridientBackend/update", "id" => $data->ingredient->id]
                            );
                        },
                    ],

                    [
                        'class' => 'yupe\widgets\CustomButtonColumn',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => [
                                'url' => function ($data) {
                                    return Yii::app()->createUrl('/store/linkBackend/deleteIngredient', ['id' => $data->id]);
                                },
                            ],
                        ],
                    ],
                ],
            ]
        ); ?>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <h3><?= Yii::t('StoreModule.store', 'Добавить ингредиенты'); ?></h3>
        <?php

        $this->widget(
            'yupe\widgets\CustomGridView',
            [
                'id' => 'ingredients-grid',
                'type' => 'condensed',
                'dataProvider' => $searchModel->getIngredientsFor(isset($product->id) ? $product->id : null),
                'filter' => $searchModel,
                'actionsButtons' => false,
                'bulkActions' => [false],
                'ajaxUrl' => ['/store/linkBackend/ingredientIndex'],
                'columns' => [
                    [
                        'type' => 'raw',
                        'value' => function ($data) {
                            return CHtml::link(
                                CHtml::image($data->getImageUrl(40, 40), $data->name, ["class" => "img-thumbnail"]),
                                ["/store/productBackend/update", "id" => $data->id]
                            );
                        },
                    ],
                    [
                        'name' => 'name',
                        'type' => 'raw',
                        'value' => function ($data) {
                            return CHtml::link($data->name, ["/store/ingredientBackend/update", "id" => $data->id]);
                        },
                    ],
                    [
                        'value' => function ($data) {
                            return $this->widget(
                                'booster.widgets.TbButton',
                                [
                                    'label' => Yii::t('StoreModule.store', 'Add'),
                                    'htmlOptions' => [
                                        'class' => 'link-product-button',
                                        'data-ingredient' => $data->id,
                                    ],
                                ],
                                true
                            );
                        },
                        'type' => 'raw',
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('click', '.link-product-button', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = {
                product_id: <?= isset($product) ? $product->id : null;?>,
                ingredient_id: button.data('ingredient'),
                "<?= Yii::app()->getRequest()->csrfTokenName;?>": "<?= Yii::app()->getRequest()->csrfToken; ?>"
            };
            $.ajax({
                url: "<?= Yii::app()->createUrl('/store/linkBackend/linkIngridient');?>",
                type: 'post',
                data: data,
                success: function (data) {
                    $.fn.yiiGridView.update('linked-ingredient-grid');
                }
            });
        })
    });
</script>
