<?php

namespace App\Billings;

use Illuminate\Support\Str;

class CreditPaymentGateway implements PaymentGatewayContract
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
        $fees = $amount * 0.3;

        return [
            'monto' => ($amount - $this->discount) + $fees,
            'numero_confirmacion' => strtoupper(Str::random()),
            'moneda' => $this->currency,
            'discount' => $this->discount,
            'tarifa' => $fees,
            'modulo' => get_class(),
        ];
    }
}