@extends ('User/LayoutUser/LayoutUser')
@section('content')

<section class="shop spad">
    <div class="container container-product">
        <div class="filter__item">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="filter__sort">
                        <span>Sắp xếp </span>
                        <select>
                            <option value="0">Default</option>
                            <option value="0">Default</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    @foreach ($ListProduct as $product)

                        <div class="col-lg-2 col-6 px-1 py-2 ">
                            <div class="card item-card-flashsale">
                                <div class="card-img-top-container">
                                    <img class="card-img-top img-fluid px-1 py-2" alt="Product Image"
                                        src="{{asset('public/file/')}}/img/img_product/{{$product->image}}" />
                                </div>
                                <div class="card-body">
                                    <a href="{{route('User.ProductDetails', [khongdau($product->name_product), $product->id])}}" class="text-decoration-none">
                                        <p class="card-title">{{$product->name_product}}</p>
                                    </a>
                                    <h6 class="card-text text-price my-0 py-1">
                                        {{ number_format($product->discount, 0, ',', '.') }} ₫ </h6>
                                            <p><del>{{ number_format($product->price_product, 0, ',', '.') }} ₫</del></p>
                                    <div>
                                        <p class="my-0">Model:&nbsp;{{$product->model}}</p>
                                        <p class="my-1">Xuất xứ:&nbsp; {{$product->producer}}</p>
                                        <p class="my-1">Nhà sản xuất:&nbsp; {{$product->origin}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endsection