<div class="main__recently-viewed-slider">
    <div class="grid">
        <div class="h3" style="text-align: center">
            <div class="link-product_title">
                С этим товаром сочетаются
            </div>
        </div>

        <div>
            <?php $this->widget('zii.widgets.CListView', [
                'dataProvider' => $dataProvider,
                'template' => '{items}',
                'itemView' => 'themes.newtheme.views.store.product._item',
                'cssFile' => false,
                'pager' => false,
            ]); ?>
        </div>
    </div>
</div>
