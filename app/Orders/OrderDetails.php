<?php

namespace App\Orders;

use App\Billings\PaymentGatewayContract;

class OrderDetails
{
    private $paymentGateway;

    public function __construct(PaymentGatewayContract $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function all()
    {
        $this->paymentGateway->setDiscount(400);

        return [
            'name' => 'Cristyan',
            'address' => 'Final calle 22, S/N',
        ];
    }
}