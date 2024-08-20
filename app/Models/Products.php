<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "product";
    protected $fillable = ["name_product", "description", "model", "price_product","discount","image","images","idCategory","status","producer","origin","image_specifications"];
    protected $primarykey = "id";
    public $timestamps = false;
    public function Category()
    {
        return $this->belongsTo(Category::class, 'idCategory', 'id');
    }
}
