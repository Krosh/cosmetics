<?php
/**
 * Created by JetBrains PhpStorm.
 * User: БОСС
 * Date: 28.05.16
 * Time: 22:21
 * To change this template use File | Settings | File Templates.
 */?>
<div class="coupon">
                            <span class="label" title="<?= $coupon->name; ?>">
                                <?= $coupon->name; ?>
                                <button type="button" class="btn btn_primary close"
                                        data-dismiss="alert">&times;</button>
                                <?= CHtml::hiddenField(
                                    "Order[couponCodes][{$coupon->code}]",
                                    $coupon->code,
                                    [
                                        'class' => 'coupon-input',
                                        'data-code' => $coupon->code,
                                        'data-name' => $coupon->name,
                                        'data-value' => $coupon->value,
                                        'data-type' => $coupon->type,
                                        'data-min-order-price' => $coupon->min_order_price,
                                        'data-free-shipping' => $coupon->free_shipping,
                                    ]
                                ); ?>
                            </span>
</div>