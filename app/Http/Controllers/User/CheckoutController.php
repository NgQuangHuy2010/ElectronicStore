<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;


class CheckoutController extends Controller
{
    public function Index(Request $request){
        // dd($request->all());
        $cart = Session::get('cart', []);
        $checkoutData = [
            'totalAmount' => $request->input('totalAmount'),
            'shippingFee' => $request->input('shippingFee'),
            'totalPayment' => $request->input('totalPayment'),
            'cart' => $cart
        ];
        
        Session::put('CheckoutData', $checkoutData);
        // dd($checkoutData);
        $locations = $this->getApi();
        return view("User/Pages/Checkout",array_merge($checkoutData, ['locations' => $locations]) );
    }
    public function getApi()
    {
        //D:\laragon\www\Electronics_Store\storage\app\json_data\select_address.json
        $json = Storage::get('json_data/select_address.json');
        $locations = json_decode($json, true);
        // dd($locations);
        // Trả về dữ liệu
        return $locations;

    }
}
