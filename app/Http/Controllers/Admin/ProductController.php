<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index(){
        //lấy sản phẩm có mối quan hệ với Category được định nghĩa phương thức có belongsTo trong model Products 
        $data["products"] = Products::with('Category')->get();
        return view("Admin/Product/Index",$data);
    }

    public function Create(){
        return view("Admin/Product/Create");
    }
    
}
