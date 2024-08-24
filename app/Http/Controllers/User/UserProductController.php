<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function Index(Request $request, $id = null)
    {
        // Khởi tạo truy vấn để lấy sản phẩm theo danh mục
        $query = Products::where('idCategory', $id);
        
        $this->filterProducts($request, $query);
        // Lấy danh sách các nhà sản xuất và phương thức sắp xếp từ request
        $producers = $this->getProducersFromRequest($request); // Lấy danh sách nhà sản xuất từ request
        $sort = $request->get('sort'); // Lấy phương thức sắp xếp (asc hoặc desc)
    
      
        

        // Nếu có nhà sản xuất được chọn, lọc sản phẩm theo nhà sản xuất
        if (!empty($producers)) {
            $query->whereIn('producer', $producers);
        }
    
        // Nếu phương thức sắp xếp hợp lệ, áp dụng sắp xếp cho truy vấn
        if ($this->isValidSortOrder($sort)) {
            $query->orderBy('discount', $sort);
        }
    
        // Lấy danh sách các nhà sản xuất duy nhất có trong danh mục hiện tại
        $allProducers = Products::where('idCategory', $id)
            ->select('producer') // Chọn cột 'producer'
            ->distinct() // Loại bỏ các giá trị trùng lặp
            ->pluck('producer'); // Lấy danh sách nhà sản xuất dưới dạng mảng
    
        // Lấy danh sách sản phẩm sau khi lọc và sắp xếp
        $data = [
            'ListProduct' => $query->get(), // Danh sách sản phẩm
            'id' => $id, // ID danh mục
            'selectedProducers' => $producers, // Danh sách nhà sản xuất đã chọn
            'sort' => $sort, // Phương thức sắp xếp
            'producers' => $allProducers, // Danh sách tất cả các nhà sản xuất
        ];
    
        // Trả về view với dữ liệu đã chuẩn bị
        return view('User/Pages/Product', $data);
    }
    
    private function filterProducts(Request $request, &$query) {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
    
        if ($minPrice && $maxPrice) {
            $minPrice = intval(str_replace('.', '', $minPrice));
            $maxPrice = intval(str_replace('.', '', $maxPrice));
            $query->whereBetween('discount', [$minPrice, $maxPrice]);
        }
    }
    
    

    private function getProducersFromRequest(Request $request)
    {
        $producers = $request->get('producer', []); // Lấy giá trị 'producer' từ request
        if (is_string($producers)) {
            $producers = explode(',', $producers); // Chuyển đổi từ chuỗi thành mảng
        }
        return is_array($producers) ? $producers : []; // Đảm bảo giá trị trả về là mảng
    }
    
    private function isValidSortOrder($sort)
    {
        return in_array($sort, ['asc', 'desc']); // Kiểm tra xem phương thức sắp xếp có hợp lệ không
    }
    
    public function Details($name = null,$id = null)
    {
        $data['ProductDetails'] = Products::where('id', $id)->first();
        $data["RelatedProducts"] = Products::where('idCategory', $data['ProductDetails']->idCategory)->inRandomOrder()->get();
        // dd($data);
        return view("User/Pages/ProductDetails", $data);

    }
}
