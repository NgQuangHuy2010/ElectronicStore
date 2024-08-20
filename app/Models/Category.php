<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    protected $fillable = ["name","image"];
    protected $primarykey = "id";
    public $timestamps = false;
    public function Products()
    {
        //dùng hasMany vì trong Category có nhiều Products 
        return $this->hasMany(Products::class, 'idCategory', 'id');  //khóa ngoại trước , khóa chính sau
    }
}
