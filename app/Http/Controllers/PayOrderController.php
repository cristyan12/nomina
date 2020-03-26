<?php

namespace App\Http\Controllers;

use App\Orders\OrderDetails;
use App\Billings\PaymentGatewayContract;

class PayOrderController
{
    public function __invoke(OrderDetails $orderDetails, PaymentGatewayContract $paymentGateway)
    {
        $order = $orderDetails->all();

        dd($order, $paymentGateway->charge(2500));
    }
}
