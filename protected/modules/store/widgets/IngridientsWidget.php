<?php

/**
 * Class IngridientsWidget
 */
class IngridientsWidget extends \yupe\widgets\YWidget
{
    /**
     * @var string
     */
    public $view = 'ingridients';

    /**
     * @var null
     */
    public $code = null;
    /**
     * @var Product
     */
    public $product;

    /**
     * @throws CException
     */
    public function run()
    {
        if (!$this->product) {
            return;
        }

        $this->render($this->view, ['dataProvider' => $this->product->getLinkedIngridientsDataProvider()]);
    }
} 
