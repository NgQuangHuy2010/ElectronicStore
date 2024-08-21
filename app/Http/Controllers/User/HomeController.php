<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index(){
        $data["ListCategory"]= Category::all();
        $data["RandomProduct"] = Products::inRandomOrder()->get();
        $data["AscProduct"] = Products::orderby("discount", "asc")->get();
        return view("User/Pages/Home",$data);
    }
}
