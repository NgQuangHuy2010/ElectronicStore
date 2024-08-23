<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function Index(Request $request, $id = null)
    {
        // Tạo đối tượng truy vấn sản phẩm theo danh mục để lấy $query dùng sort sản phẩm đang có 
        $query = Products::where('idCategory', $id);
        
        // Lấy giá trị của tham số 'sort' từ request
        $sort = $request->get('sort');
        
        // Áp dụng sắp xếp nếu tham số 'sort' có giá trị
        if ($sort === 'asc' || $sort === 'desc') {
            $query->orderBy('discount', $sort);
        }
          // Lấy giá trị của tham số 'producer' từ request
    $producer = $request->get('producer');
    if ($producer) {
        $query->where('producer', $producer);
    }
        // Lấy sản phẩm sau khi áp dụng sắp xếp (nếu có)
        $data['ListProduct'] = $query->get();
        
        // Lấy danh sách các thương hiệu khác nhau trong danh mục cụ thể
        $data['producers'] = Products::where('idCategory', $id)
                                    ->distinct('producer')
                                    ->pluck('producer');
        
        // Truyền biến $id đến view để duy trì thông tin danh mục
        $data['id'] = $id;
        
        // Truyền giá trị sắp xếp hiện tại đến view để có thể giữ giá trị trong form
        $data['sort'] = $sort;
        
        return view('User/Pages/Product', $data);
    }
    
    

    
    public function Details($name = null,$id = null)
    {
        $data['ProductDetails'] = Products::where('id', $id)->first();
        $data["RelatedProducts"] = Products::where('idCategory', $data['ProductDetails']->idCategory)->inRandomOrder()->get();
        // dd($data);
        return view("User/Pages/ProductDetails", $data);

    }
}
