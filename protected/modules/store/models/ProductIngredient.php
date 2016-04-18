<?php
/**
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $ingredient_id
 *
 */
class ProductIngredient extends \yupe\models\YModel
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'yupe_store_product_ingredient';
    }

    /**
     * @param null|string $className
     * @return $this
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array
     */
    public function relations()
    {
        return [
            'product' => [self::BELONGS_TO, 'Product', 'product_id'],
            'ingredient' => [self::BELONGS_TO, 'Ingredient', 'ingredient_id'],
        ];
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('ingredient_id', $this->ingredient_id);

        return new CActiveDataProvider(
            $this, [
                'criteria' => $criteria,
            ]
        );
    }
}
