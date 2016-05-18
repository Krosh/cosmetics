<div class="main__recently-viewed-slider">
    <div class="grid">
        <div class="h3 ingridients__title" style="text-align: center">Активные ингредиенты</div>
        <div>
                <?php $this->widget('zii.widgets.CListView', [
                    'dataProvider' => $dataProvider,
                    'template' => '{items}',
                    'itemView' => '_item',
                    'cssFile' => false,
                    'pager' => false,
                ]); ?>
        </div>
    </div>
</div>
<div class="clearfix">

</div>