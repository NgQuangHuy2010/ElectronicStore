@extends('User.LayoutUser.LayoutUser')

@section('content')
@if (empty($cart)) {{-- Kiểm tra xem giỏ hàng có rỗng hay không --}}
    <div class="h-50 d-flex flex-column align-items-center justify-content-center">
        <img src="{{asset('public/User')}}/img/cart-null.png" alt="Cart Empty" class="img-fluid mb-3" style="max-width: 250px;">
        <h4 class="text-center">
            Giỏ hàng trống
            <a class="text-danger" href="{{ route('User.Home') }}">Tiếp tục mua hàng</a>
        </h4>
    </div>
@else
    <div class="container-fluid pt-5 h-100">
        <div class="row px-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table text-center mb-0">
                    <thead class="text-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tổng giá</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cart as $productId => $item)
                            <tr>
                                <td class="align-middle">
                                    {{ $item['productName'] }}
                                    <span><img src="{{ $item['productImage'] }}" class="card-img-top img-fluid px-1 py-2" alt="Product Image" style="max-width: 100px; max-height: 100px;" /></span>
                                </td>
                                <td class="align-middle">{{ number_format($item['productPrice'], 0, ',', '.') }} ₫</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <input min="1" type="number" class="form-control form-control-sm" value="{{ $item['quantity'] }}" name="quantity" data-product-id="{{ $productId }}" onchange="updateCart(this)">
                                    </div>
                                </td>
                                <td class="align-middle" id="totalPrice_{{ $productId }}">{{ number_format($item['productPrice'] * $item['quantity'], 0, ',', '.') }} ₫</td>
                                <td class="align-middle">
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="removeItem('{{ $productId }}')"><i class="fa fa-times text-light"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Mã giảm giá">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Thêm mã giảm giá</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5 cart-details">
                    <div class="card-header border-0">
                        <h4 class="font-weight-semi-bold m-0">Chi tiết giỏ hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h4 class="font-weight-medium">Tạm tính</h4>
                            <h5 class="font-weight-medium text-danger" id="totalAmount">{{ number_format($totalAmount, 0, ',', '.') }} ₫</h5>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="font-weight-medium">Phí vận chuyển</h5>
                            <h5 class="font-weight-medium">0 ₫</h5>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h4 class="font-weight-bold text-danger">Tổng tiền thanh toán</h4>
                            <h4 class="font-weight-bold text-danger" id="totalPayment">{{ number_format($totalAmount, 0, ',', '.') }} ₫</h4>
                        </div>
                        <form method="post" action="">
                            @csrf
                            <div class="col-lg-12 pt-3">
                                <button type="submit" class="btn btn-info btn-lg w-100">Thanh toán</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script>
    function formatCurrency(value) {
        // Sử dụng Intl.NumberFormat để định dạng tiền tệ theo định dạng Việt Nam và thêm ký hiệu ₫
        return new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
    }

    function updateCart(inputElement) {
        // Lấy ID sản phẩm từ thuộc tính data-product-id của phần tử input
        var productId = inputElement.getAttribute('data-product-id');
        // Lấy số lượng từ giá trị của phần tử input và chuyển đổi sang số nguyên
        var quantity = parseInt(inputElement.value, 10);

        // Gửi yêu cầu AJAX đến server để cập nhật giỏ hàng
        $.ajax({
            url: '{{ route('cart.update') }}',  // URL endpoint cho yêu cầu cập nhật giỏ hàng
            type: 'POST',  // Phương thức HTTP sử dụng là POST
            data: {
                _token: '{{ csrf_token() }}',  // CSRF token để bảo vệ khỏi các cuộc tấn công CSRF
                productId: productId,  // ID của sản phẩm cần cập nhật
                quantity: quantity  // Số lượng mới của sản phẩm
            },
            success: function (response) {
                // Xử lý khi yêu cầu thành công
                if (response.success) {
                    // Cập nhật giá trị tổng giá của sản phẩm với định dạng tiền tệ và ký hiệu ₫
                    var totalPriceElement = document.getElementById('totalPrice_' + productId);
                    var totalAmountElement = document.getElementById('totalAmount');
                    var totalPaymentElement = document.getElementById('totalPayment');

                    // Nếu phần tử tổng giá của sản phẩm tồn tại, cập nhật giá trị
                    if (totalPriceElement) {
                        totalPriceElement.innerText = formatCurrency(response.totalPrice);
                    }
                    // Nếu phần tử tổng số tiền tồn tại, cập nhật giá trị
                    if (totalAmountElement) {
                        totalAmountElement.innerText = formatCurrency(response.totalAmount);
                    }
                    // Nếu phần tử tổng số tiền thanh toán tồn tại, cập nhật giá trị
                    if (totalPaymentElement) {
                        totalPaymentElement.innerText = formatCurrency(response.totalPayment);
                    }
                } else {
                    // Hiển thị thông báo lỗi nếu cập nhật không thành công
                    alert(response.message);
                }
            },
            error: function () {
                // Hiển thị thông báo lỗi nếu có lỗi xảy ra trong quá trình gửi yêu cầu
                alert('Error updating cart.');
            }
        });
    }
    /**
     * Xóa sản phẩm khỏi giỏ hàng
     * @param {string} productId - ID của sản phẩm cần xóa
     */
    function removeItem(productId) {
        // Xác nhận hành động xóa sản phẩm từ người dùng
        if (confirm('Bạn muốn xóa sản phẩm này?')) {
            // Gửi yêu cầu AJAX đến server để xóa sản phẩm khỏi giỏ hàng
            $.ajax({
                url: '{{ route('cart.remove') }}',  // URL endpoint cho yêu cầu xóa sản phẩm
                type: 'POST',  // Phương thức HTTP sử dụng là POST
                data: {
                    _token: '{{ csrf_token() }}',  // CSRF token để bảo vệ khỏi các cuộc tấn công CSRF
                    productId: productId  // ID của sản phẩm cần xóa
                },
                success: function (response) {
                    // Xử lý khi yêu cầu thành công
                    if (response.success) {
                        // Hiển thị thông báo thành công và làm mới trang
                        alert('Sản phẩm đã được xóa');
                        location.reload();  // Làm mới trang để cập nhật giỏ hàng
                    } else {
                        // Hiển thị thông báo lỗi nếu xóa không thành công
                        alert(response.message);
                    }
                },
                error: function () {
                    // Hiển thị thông báo lỗi nếu có lỗi xảy ra trong quá trình gửi yêu cầu
                    alert('Error removing item from cart.');
                }
            });
        }
    }
</script>

@endsection

