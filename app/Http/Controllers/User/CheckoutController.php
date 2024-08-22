<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;


class CheckoutController extends Controller
{
    public function Index(Request $request)
    {
        // dd($request->all());
        $cart = Session::get('cart', []);
        $checkoutData = [
            'totalAmount' => $request->input('totalAmount', old('totalAmount', Session::get('CheckoutData.totalAmount'))),
            'shippingFee' => $request->input('shippingFee', old('shippingFee', Session::get('CheckoutData.shippingFee'))),
            'totalPayment' => $request->input('totalPayment', old('totalPayment', Session::get('CheckoutData.totalPayment'))),
            'cart' => $cart
        ];
        Session::put('CheckoutData', $checkoutData);
        // dd($checkoutData);
        $locations = $this->getApi();
        return view("User/Pages/Checkout", array_merge($checkoutData, ['locations' => $locations]));
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
    public function CheckoutPost(Request $request)
    {
        $message = [
            'fullname.required' => 'Họ và tên không được trống.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ !',
            'phone.required' => 'Số điện thoại không được trống.',
            'phone.numeric' => 'Số điện thoại phải là số !',
            'phone.digits' => 'Số điện thoại phải có 10 chữ số !',
            'address.required' => 'Địa chỉ không được trống.',
            'address.max' => 'Địa chỉ không được vượt quá 250 ký tự !',
            'province.required' => 'Vui lòng chọn tỉnh/thành phố !',
            'district.required' => 'Vui lòng chọn quận/huyện !',
            'ward.required' => 'Vui lòng chọn phường/xã !',
        ];
        if ($request->isMethod("post")) {
            $this->validate($request, [
                'fullname' => 'required|string|max:50',
                'email' => 'nullable|email',
                'phone' => 'required|numeric|digits:10',
                'address' => 'required|string|max:250',
                'province' => 'required|string',
                'district' => 'required|string',
                'ward' => 'required|string',
            ], $message);

            // Lấy dữ liệu từ các ô nhập liệu
            $name = $request->input('fullname');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $address = $request->input('address');

            // Lấy dữ liệu từ input hidden 'selected_locations'
            $selectedLocationsJson = $request->input('selected_locations');
            // giải mã json
            $selectedLocations = json_decode($selectedLocationsJson, true);

            // Tạo chuỗi JSON cho địa chỉ đầy đủ
            $fullAddress = [
                'province' => $selectedLocations['province'],
                'district' => $selectedLocations['district'],
                'ward' => $selectedLocations['ward'],
            ];
            //định dạng thành json với giữ nguyên tiếng việt tunicode
            $fullAddressJson = json_encode($fullAddress, JSON_UNESCAPED_UNICODE);

            $CheckoutData = Session::get('CheckoutData', []);
            // Tạo mảng chứa toàn bộ thông tin checkout


            // Tạo mảng chứa toàn bộ thông tin
            $paymentData = [
                'fullname' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'address_full' => $fullAddressJson, // Lưu chuỗi JSON của địa chỉ đầy đủ
                'checkoutdata' => $CheckoutData,
            ];

            // Lưu toàn bộ thông tin vào session
            Session::put('paymentData', $paymentData);


            // Debug kiểm tra dữ liệu
            $paymentData = Session::get('paymentData');
            dd($paymentData);

            return redirect()->route('User.CheckoutIndex');

        }




        // Redirect hoặc trả về JSON response
        return view("User/Pages/Checkout");
    }

}
