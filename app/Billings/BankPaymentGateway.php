<?php

namespace App\Billings;

use Illuminate\Support\Str;

class BankPaymentGateway implements PaymentGatewayContract
{
    private $currency;
    private $discount;

    public function __construct($currency)
    {
        $this->currency = $currency;
        $this->discount = 0;
    }

    public function setDiscount($amount)
    {
        $this->discount = $amount;
    }

    public function charge($amount)
    {
        return [
            'monto' => $amount - $this->discount,
            'numero_confirmacion' => strtoupper(Str::random()),
            'moneda' => $this->currency,
            'discount' => $this->discount,
            'modulo' => get_class(),
        ];
    }
}