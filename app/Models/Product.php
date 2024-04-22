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
        'code', 'name', 'price', 'description', 'image', 'imagep1', 'imagep2', 'imagep3', 'imagep4', 'sizepd', 'colorpd', 'materialpd', 'warrantypd', 'advantage'
    ];


    public function getCode($code)
    {
        return $code;
    }
    public function setCode($code)
    {
        $this->attributes['code'] = $code;
    }

    public function getName($name)
    {
        return $name;
    }
    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getPrice($price)
    {
        return $price;
    }
    public function setPrice($price)
    {
        $this->attributes['price'] = $price;
    }

    public function getDescription($description)
    {
        return $description;
    }
    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getImage($image)
    {
        return $image;
    }
    public function setImage($image)
    {
        $this->attributes['image'] = $image;
    }

    public function getImagep1($imagep1)
    {
        return $imagep1;
    }
    public function setImagep1($imagep1)
    {
        $this->attributes['imagep1'] = $imagep1;
    }

    public function getImagep2($imagep2)
    {
        return $imagep2;
    }
    public function setImagep2($imagep2)
    {
        $this->attributes['imagep2'] = $imagep2;
    }

    public function getImagep3($imagep3)
    {
        return $imagep3;
    }
    public function setImagep3($imagep3)
    {
        $this->attributes['imagep3'] = $imagep3;
    }

    public function getImagep4($imagep4)
    {
        return $imagep4;
    }
    public function setImagep4($imagep4)
    {
        $this->attributes['imagep4'] = $imagep4;
    }

    public function getSizepd($sizepd)
    {
        return $sizepd;
    }
    public function setSizepd($sizepd)
    {
        $this->attributes['sizepd'] = $sizepd;
    }

    public function getColorpd($colorpd)
    {
        return $colorpd;
    }
    public function setColorpd($colorpd)
    {
        $this->attributes['colorpd'] = $colorpd;
    }

    public function getMaterialpd($materialpd)
    {
        return $materialpd;
    }
    public function setMaterialpd($materialpd)
    {
        $this->attributes['materialpd'] = $materialpd;
    }

    public function getWarrantypd($warrantypd)
    {
        return $warrantypd;
    }
    public function setWarrantypd($warrantypd)
    {
        $this->attributes['warrantypd'] = $warrantypd;
    }

    public function getAdvantage($advantage)
    {
        return $advantage;
    }
    public function setAdvantage($advantage)
    {
        $this->attributes['advantage'] = $advantage;
    }
}
