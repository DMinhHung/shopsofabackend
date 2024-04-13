<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // Các trường dữ liệu có thể được gán
    protected $fillable = [
        'name', 'price', 'description', 'image'
    ];

    public function getName($name)
    {
        return $name;
    }
    public function setName($name)
    {
        $this->attributes['name'] = ($name);
    }

    public function getPrice($price)
    {
        return $price;
    }
    public function setPrice($price)
    {
        $this->attributes['price'] = ($price);
    }

    public function getDescription($description)
    {
        return $description;
    }
    public function setDescription($description)
    {
        $this->attributes['description'] = ($description);
    }

    public function getImage($image)
    {
        return $image;
    }
    public function setImage($image)
    {
        $this->attributes['image'] = ($image);
    }
}
