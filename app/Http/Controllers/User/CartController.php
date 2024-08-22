<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class CartController extends Controller
{
    public function ViewCart()
    {
        // Lấy giỏ hàng từ session hoặc khởi tạo mảng rỗng nếu không có
        $cart = Session::get('cart', []);

        // Tính tổng tiền của giỏ hàng
        $totalAmount = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['productPrice'] * $item['quantity']);
        }, 0);
        //tạo hàm Shipping riêng biệt để gán giá ship
        $shipping = $this->Shipping();
        $totalPayment = $totalAmount + $shipping;
        // Trả về view với dữ liệu giỏ hàng và tổng tiền
        return view('User/Pages/Cart', [
            'cart' => $cart,
            'totalAmount' => $totalAmount,
            'totalPayment' => $totalPayment,
            'shipping' => $shipping
        ]);
    }

    public function AddToCart(Request $request)
    {
        $productId = $request->input('productId');
        $productName = $request->input('productName');
        $productPrice = $request->input('productPrice');
        $productImage = $request->input('productImage');  // Lấy hình ảnh sản phẩm
        $quantity = $request->input('quantity');

        // Lấy giỏ hàng từ session hoặc khởi tạo mảng rỗng nếu không có
        $cart = Session::get('cart', []);

        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $cart[$productId] = [
                'productName' => $productName,
                'productPrice' => $productPrice,
                'productImage' => $productImage, // Lưu hình ảnh sản phẩm
                'quantity' => $quantity
            ];
        }
        // Lưu giỏ hàng vào session
        Session::put('cart', $cart);
        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng !']);
    }

    public function GetCartItemCount()
    {
        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);

        // Đếm số lượng id sản phẩm  trong giỏ hàng
        $itemCount = count($cart);

        return response()->json(['itemCount' => $itemCount]);
    }

    public function updateCart(Request $request)
    {
        try {
            $productId = $request->input('productId');
            $quantity = $request->input('quantity');

            // Lấy giỏ hàng từ session
            $cart = Session::get('cart', []);

            // Kiểm tra sản phẩm có tồn tại trong giỏ hàng không
            if (!isset($cart[$productId])) {
                return response()->json(['success' => false, 'message' => 'Product not found in cart']);
            }

            // Cập nhật số lượng sản phẩm
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);

            // Tính toán tổng số tiền của giỏ hàng
            $totalAmount = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['productPrice'] * $item['quantity']);
            }, 0);

            //tạo hàm Shipping riêng biệt để gán giá ship
        $shipping = $this->Shipping();
        $totalPayment = $totalAmount + $shipping;

            return response()->json([
                'success' => true,
                'totalPrice' => $cart[$productId]['productPrice'] * $quantity,
                'totalAmount' => $totalAmount,
                'shipping' => $shipping,
                'totalPayment' => $totalPayment
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function removeItem(Request $request)
    {
        try {
            $productId = $request->input('productId');

            // Lấy giỏ hàng từ session
            $cart = Session::get('cart', []);

            // Xóa sản phẩm khỏi giỏ hàng nếu có
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                Session::put('cart', $cart);
            }

            return response()->json(['success' => true, 'message' => 'Product removed from cart']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function Shipping()
    {
        // Logic tính toán phí vận chuyển, có thể là cố định hoặc phụ thuộc vào các điều kiện khác
        return 30000; // Ví dụ: Phí vận chuyển cố định là 30,000₫
    }
}
