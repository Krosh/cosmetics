<?php

return [
    'module' => [
        'class' => 'application.modules.courierPayment.CourierPaymentModule',
    ],
    'component' => [
        'paymentManager' => [
            'paymentSystems' => [
                'courierPayment' => [
                    'class' => 'application.modules.courierPayment.components.payments.CourierPaymentPaymentSystem',
                ]
            ],
        ],
    ],
];
