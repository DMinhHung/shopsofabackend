<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $table = 'shoppingcart';

    // Các trường dữ liệu có thể được gán
    protected $fillable = [
        'productId', 'quantity', 'total',
    ];

    public function getProductId($productId)
    {
        return $productId;
    }
    public function setProductId($productId)
    {
        $this->attributes['productId'] = ($productId);
    }

    public function getQuantity($quantity)
    {
        return $quantity;
    }
    public function setQuantity($quantity)
    {
        $this->attributes['quantity'] = ($quantity);
    }

    public function getTotal($total)
    {
        return $total;
    }
    public function setTotal($total)
    {
        $this->attributes['total'] = ($total);
    }
}
