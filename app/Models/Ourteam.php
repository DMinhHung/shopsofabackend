<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ourteam extends Model
{
    use HasFactory;
    protected $table = 'ourteam';

    // Các trường dữ liệu có thể được gán
    protected $fillable = [
        'name', 'image', 'description',
    ];

    public function getName($name)
    {
        return $name;
    }
    public function setName($name)
    {
        $this->attributes['name'] = ($name);
    }

    public function getImage($image)
    {
        return $image;
    }
    public function setImage($image)
    {
        $this->attributes['image'] = ($image);
    }

    public function getDescription($description)
    {
        return $description;
    }
    public function setDescription($description)
    {
        $this->attributes['description'] = ($description);
    }
}
