<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    // Các trường dữ liệu có thể được gán
    protected $fillable = [
        'payment_id', 'product_name', 'quantity', 'amount', 'currency', 'payer_name', 'payer_email', 'payment_status', 'payment_method'
    ];


    public function getPaymentId($payment_id)
    {
        return $payment_id;
    }
    public function setPaymentId($payment_id)
    {
        $this->attributes['payment_id'] = $payment_id;
    }

    public function getProductName($product_name)
    {
        return $product_name;
    }
    public function setProductName($product_name)
    {
        $this->attributes['product_name'] = $product_name;
    }

    public function getQuantity($quantity)
    {
        return $quantity;
    }
    public function setQuantity($quantity)
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getAmount($amount)
    {
        return $amount;
    }
    public function setAmount($amount)
    {
        $this->attributes['amount'] = $amount;
    }

    public function getCurrency($currency)
    {
        return $currency;
    }
    public function setCurrency($currency)
    {
        $this->attributes['currency'] = $currency;
    }

    public function getPayerName($payer_name)
    {
        return $payer_name;
    }
    public function setPayerName($payer_name)
    {
        $this->attributes['payer_name'] = $payer_name;
    }

    public function getPayerEmail($payer_email)
    {
        return $payer_email;
    }
    public function setPayerEmail($payer_email)
    {
        $this->attributes['payer_email'] = $payer_email;
    }

    public function getPaymentStatus($payment_status)
    {
        return $payment_status;
    }
    public function setPaymentStatus($payment_status)
    {
        $this->attributes['payment_status'] = $payment_status;
    }

    public function getPaymentMethod($payment_method)
    {
        return $payment_method;
    }
    public function setPaymentMethod($payment_method)
    {
        $this->attributes['payment_method'] = $payment_method;
    }
}
