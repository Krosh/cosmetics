<?php
/**
 * @var integer $id
 * @var string $description
 * @var float $price
 * @var array $settings
 */

$login = $settings['login'];
$password = $settings['password1'];

$description = Yii::t('RobokassaModule.robokassa', 'Payment order #{id} on "{site}" website', [
    '{id}' => $id,
    '{site}' => Yii::app()->getModule('yupe')->siteName
]);
?>

<?= CHtml::form("http://www.myyupe.ru/payment/process/3") ?>
<?= CHtml::hiddenField('idOrder', $id) ?>
<?= CHtml::endForm() ?>
