<?php
/**
 * @var integer $id
 * @var string $description
 * @var float $price
 * @var array $settings
 */

$idModule = $settings['moduleId'];
?>

<?= CHtml::form("/payment/process/".$idModule) ?>
<?= CHtml::hiddenField('idOrder', $id) ?>
<?= CHtml::endForm() ?>
