<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function Index($id = null)
    {
        $data['ListProduct'] = Products::where('idCategory', $id)->get();

        return view("User/Pages/Product", $data);
    }
    public function Details($name = null,$id = null)
    {
        $data['ProductDetails'] = Products::where('id', $id)->first();
        $data["RelatedProducts"] = Products::where('idCategory', $data['ProductDetails']->idCategory)->inRandomOrder()->get();
        // dd($data);
        return view("User/Pages/ProductDetails", $data);

    }
}
