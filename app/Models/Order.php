<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    // Các trường dữ liệu có thể được gán
    protected $fillable = [
        'maorder', 'userId', 'shoppingcartId', 'date',
    ];

    public function getMaorder($maorder)
    {
        return $maorder;
    }
    public function setMaorder($maorder)
    {
        $this->attributes['maorder'] = ($maorder);
    }

    public function getUserId($userId)
    {
        return $userId;
    }
    public function setUserId($userId)
    {
        $this->attributes['userId'] = ($userId);
    }

    public function getShoppingcartId($shoppingcartId)
    {
        return $shoppingcartId;
    }
    public function setShoppingcartId($shoppingcartId)
    {
        $this->attributes['shoppingcartId'] = ($shoppingcartId);
    }

    public function getDate($date)
    {
        return $date;
    }
    public function setDate($date)
    {
        $this->attributes['date'] = ($date);
    }
}
