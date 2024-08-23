@extends ('User/LayoutUser/LayoutUser')
@section('content')

<!-- @* <section class="categories pt-4 border">
    <div class="container">
        <div class="row ">
            <div class="col-md-8 px-0">
                <div class="owl-carousel banner-carousel owl-theme">
                    <div class="item"><img src="~/FE/img/anh-mau-banner-thiet-bi-dien-may_033704340.png" alt="" srcset=""></div>
                    <div class="item"><img src="~/FE/img/9jOQbIcVvcANzIXtzjtqIl9oqpE4a964Dukrak0q.jpg" alt="" srcset=""></div>
                    <div class="item"><img src="~/FE/img/aa.jpg" alt="" srcset=""></div>
                </div>
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-between  px-1">
                <div class="img-container mb-1">
                    <img src="~/FE/img/1630404432-608206000-banner-header1.png" alt="Image 1" />
                </div>
                <div class="img-container">
                    <img src="~/FE/img/9jOQbIcVvcANzIXtzjtqIl9oqpE4a964Dukrak0q.jpg" alt="Image 2" />
                </div>
            </div>
        </div>
    </div>

    <section class="services spad">
        <div class="container ">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-truck"></i>
                        <h6>Vận chuyển</h6>
                        <p>Giao lắp bảo hành,chuyên nghiệp</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-credit-card-alt"></i>
                        <h6>Thanh toán</h6>
                        <p>Thnh toán nhanh gọn</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-phone"></i>
                        <h6>Hỗ trợ 24/7</h6>
                        <p>Dedicated support</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-check-circle"></i>
                        <h6>Chất lượng, uy tín</h6>
                        <p>100% secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section> *@ -->

<!-- Categories Section End -->


<section class="product spad bg-light py-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 px-0">
                <h3 class="flash-sale-title mb-0 px-4 py-2 text-warning-change d-flex justify-content-between">
                    <span class="font-italic">FLASH SALE</span>
                    <span class="font-italic">MUA NGAY</span>
                </h3>

            </div>
            <div class="owl-carousel other-carousel owl-theme pt-1">
                @foreach($AscProduct as $product)
                    <div class="card item-card-flashsale ">
                        <div class="card-img-top-container">
                            <img class="card-img-top img-fluid px-1 py-2" alt="Product Image"
                                src="{{asset('public/file/')}}/img/img_product/{{$product->image}}" />
                        </div>
                        <div class="card-body">
                            <a href="{{route('User.ProductDetails', [khongdau($product->name_product), $product->id])}}" class="text-decoration-none">
                                <p class="card-title py-0">{{$product->name_product}} </p>
                            </a>
                            <h6 class="card-text text-price py-0">{{ number_format($product->discount, 0, ',', '.') }} ₫
                            </h6>
                            <p><del>{{ number_format($product->price_product, 0, ',', '.') }} ₫</del></p>
                            <!-- <span class="badge badge-danger">-14%</span> -->
                            <div>
                                <p class="my-0">Model:&nbsp;{{$product->model}}</p>
                                <p class="my-1">Hãng:&nbsp; {{$product->producer}}</p>
                                <p class="my-1">Nơi sản xuất:&nbsp;{{$product->origin}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>
    </div>
</section>


<!-- product today  recommend-->

<section class="product spad bg-light py-2">
    <div class="container px-0">
        <h2 class="mb-4 text-color-title font-weight-bold">Gợi ý hôm nay</h2>
        <div class="row px-2">
            @foreach($RandomProduct as $product)
                <div class="col-lg-2 col-6 px-1 py-2">
                    <div class="card item-card-flashsale">
                        <div class="card-img-top-container">
                            <img class="card-img-top img-fluid px-1 py-2" alt="Product Image"
                                src="{{asset('public/file/')}}/img/img_product/{{$product->image}}" />
                        </div>
                        <div class="card-body">
                            <a href="{{route('User.ProductDetails', [khongdau($product->name_product), $product->id])}}" class="text-decoration-none">
                                <p class="card-title">{{$product->name_product}}</p>
                            </a>
                            <h6 class="card-text text-price my-0 py-1"> {{ number_format($product->discount, 0, ',', '.') }}
                            ₫</h6>
                            <p class="py-0"><del>{{ number_format($product->price_product, 0, ',', '.') }} ₫</del> <span
                                    class="badge badge-danger">-14%</span> </p>

                            <div>
                                <p class="my-0">Model:&nbsp;{{$product->model}}</p>
                                <p class="my-1">Hãng:&nbsp; {{$product->producer}}</p>
                                <p class="my-1">Nơi sản xuất:&nbsp;{{$product->origin}} </p>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!--end product today  recommend-->
<!-- category -->
<section class="product spad bg-light">
    <div class="container  px-0 py-2">
        <div class="bg-white border-category">
            <div class="col-lg-12 px-0">
                <h2 class="bg-title mb-0 px-3 py-2 text-light text-center">
                    DANH MỤC NỔI BẬT
                </h2>
            </div>
            <!-- Category Items -->

            <div class="py-4 px-5 row d-flex justify-content-between">

                @foreach ($ListCategory as $category)

                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 category-item-test bg-white my-3 mx-0 px-0 text-center">

                        <a href="{{route('User.Product', $category->id)}}" class="text-decoration-none">
                            <div class="circle mx-auto mb-2">
                                <img src="{{asset('public/file/')}}/img/img_category/{{$category->image}}" alt="" class="img-fluid inner-circle" />
                            </div>
                            <p class="category-text m-auto"></p>
                        </a>
                    </div>
                @endforeach




            </div>
        </div>
    </div>
</section>

<!-- category End -->
@endsection