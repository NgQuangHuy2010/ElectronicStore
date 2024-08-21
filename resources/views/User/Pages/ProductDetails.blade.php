@extends ('User/LayoutUser/LayoutUser')
@section('content')
<!-- Product Details Section Begin -->
<section class="product-details spad pt-1">
    <div class="container ">
        <div class="row">
            <div class="col-lg-7 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item" id="productImage"
                        data-image="{{asset('public/file')}}/img/img_product/{{$ProductDetails->image}}">
                        <img class="product__details__pic__item--large"
                            src="{{asset('public/file')}}/img/img_product/{{$ProductDetails->image}}" alt="">

                    </div>

                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            <img src="{{asset('public/file/')}}/img/img_product/{{$ProductDetails->image}}"
                                alt="Product Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-6">
                <div class="product__details__text">
                    <h3 id="productName">{{$ProductDetails->name_product}}</h3>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span>( 138 reviews )</span>
                    </div>
                    <div class="product__details__price" id="productPrice" data-price="{{$ProductDetails->discount}}">
                        {{ number_format($ProductDetails->discount, 0, ',', '.') }} ₫

                        <h6><del>{{ number_format($ProductDetails->price_product, 0, ',', '.') }} ₫</del></h6>
                    </div>
                    <div class="product__details__button">
                        <div class="quantity pb-5">
                            <span>Số lượng:</span>
                            <div class="pro-qty">
                                <input id="quantity" name="quantity" type="number" min="1" value="1">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="__RequestVerificationToken" value="...">

                    <a href="#" class="btn btn-danger mr-4"><span class="icon_bag_alt"></span> Mua ngay</a>
                    <a id="addToCart" data-product-id="{{$ProductDetails->id}}"
                        class="btn bg-white text-danger border border-danger">
                        <span class="icon_cart_alt text-danger"></span> Thêm vào giỏ hàng
                    </a>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Thông số kỹ thuật</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Giới
                                thiệu sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Reviews ( 2 )</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6 p-5">
                                    <img src="{{asset('public/file/')}}/img/img_product/{{$ProductDetails->image_specifications}}"
                                        alt="Hình ảnh thông số" class="w-100" />
                                </div>
                                <div class="col-lg-6 p-5">
                                    <div class="px-5">
                                        <h5 class="font-weight-bold">Thông số kỹ thuật</h5>
                                        <table class="table table-borderless mt-3">
                                            <tbody>
                                                <tr>
                                                    <td class="font-weight-normal py-2 border-0">Model:</td>
                                                    <td class="ml-3 border-0 ">{{$ProductDetails->model}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-normal py-2 border-0">Nhà sản xuất:</td>
                                                    <td class="ml-3 border-0 ">{{$ProductDetails->producer}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-normal py-2 border-0">Xuất xứ:</td>
                                                    <td class="ml-3 border-0 ">{{$ProductDetails->origin}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12 p-5">
                                    {!!$ProductDetails->description!!}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <h6>Reviews ( 2 )</h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title related__product__title">
                    <h3>SẢN PHẨM LIÊN QUAN</h3>
                </div>
            </div>
            <div class="owl-carousel other-carousel owl-theme pt-1">
                @foreach ($RelatedProducts as $ProductsRelated)
                    <div class="card item-card-flashsale ">
                        <div class="card-img-top-container">
                            <img class="card-img-top img-fluid px-1 py-2" alt="Product Image"
                                src="{{asset('public/file/')}}/img/img_product/{{$ProductsRelated->image}}" />
                        </div>
                        <div class="card-body">
                            <a class="text-decoration-none">
                                <p class="card-title py-0"> {{$ProductsRelated->name_product}}</p>
                            </a>
                            <h6 class="card-text text-price py-0">
                                {{ number_format($ProductsRelated->discount, 0, ',', '.') }} ₫
                            </h6>
                            <p><del>{{ number_format($ProductsRelated->price_product, 0, ',', '.') }} ₫</del></p>
                            <div>
                                <p class="my-0">Model:&nbsp;{{$ProductsRelated->model}}</p>
                                <p class="my-1">Xuất xứ:&nbsp; {{$ProductsRelated->origin}}</p>
                                <p class="my-1">Nhà sản xuất:&nbsp; {{$ProductsRelated->producer}}</p>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>





        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        /**
         * Cập nhật số lượng sản phẩm trong giỏ hàng từ server và hiển thị
         */
        function updateCartItemCount() {
            $.ajax({
                url: '{{ route("User.GetCartItemCount") }}',  // URL endpoint để lấy số lượng sản phẩm trong giỏ hàng
                type: 'GET',  // Phương thức HTTP sử dụng là GET
                success: function (response) {
                    // Xử lý phản hồi từ server
                    var cartItemCountElement = document.getElementById('cartItemCount');
                    if (cartItemCountElement) {
                        // Cập nhật số lượng sản phẩm hoặc hiển thị '0' nếu không có dữ liệu
                        cartItemCountElement.innerText = response.itemCount || '0';
                    } else {
                        console.error('Element with id "cartItemCount" not found.');  // Hiển thị lỗi nếu phần tử không tồn tại
                    }
                },
                error: function () {
                    console.error('Error updating cart item count.');  // Hiển thị lỗi nếu có vấn đề trong quá trình gửi yêu cầu
                }
            });
        }

        /**
         * Xử lý sự kiện nhấp chuột trên nút thêm vào giỏ hàng
         */
        var addToCartButton = document.getElementById('addToCart');

        if (addToCartButton) {
            addToCartButton.addEventListener('click', function () {
                // Lấy thông tin sản phẩm từ các phần tử HTML
                var productId = this.getAttribute('data-product-id');
                var productName = document.getElementById('productName').innerText.trim();
                var productPrice = document.getElementById('productPrice').getAttribute('data-price');
                var productImage = document.getElementById('productImage').getAttribute('data-image');
                var quantity = document.getElementById('quantity').value.trim();

                // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
                $.ajax({
                    url: '{{ route("User.AddToCart") }}',  // URL endpoint để thêm sản phẩm vào giỏ hàng
                    type: 'POST',  // Phương thức HTTP sử dụng là POST
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Thêm CSRF token để bảo vệ khỏi các cuộc tấn công CSRF
                    },
                    data: {
                        productId: productId,
                        productName: productName,
                        productPrice: productPrice,
                        productImage: productImage,
                        quantity: quantity
                    },
                    success: function (response) {
                        // Xử lý phản hồi từ server khi thêm sản phẩm thành công
                        if (response.success) {
                            updateCartItemCount();  // Cập nhật số lượng sản phẩm trong giỏ hàng
                            alert(response.message);  // Hiển thị thông báo thành công
                        } else {
                            alert('Lỗi: ' + response.message);  // Hiển thị thông báo lỗi nếu thêm sản phẩm không thành công
                        }
                    },
                    error: function () {
                        alert('Lỗi khi thêm sản phẩm vào giỏ hàng.');  // Hiển thị thông báo lỗi nếu có vấn đề trong quá trình gửi yêu cầu
                    }
                });
            });
        } else {
            console.error('Element with id "addToCart" not found.');  // Hiển thị lỗi nếu không tìm thấy phần tử nút thêm vào giỏ hàng
        }

        // Gọi hàm cập nhật số lượng sản phẩm khi trang được tải
        updateCartItemCount();
    });
</script>


@endsection