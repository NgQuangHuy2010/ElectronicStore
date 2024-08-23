@extends ('User/LayoutUser/LayoutUser')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<section class="shop spad">
    <div class="container container-product">
        <div class="filter__item">
            <div class="row">
                <div class="col-lg-12 col-md-5">
                    <div class="filter__sort">
                        <span>Hãng</span>
                      
                            @foreach ($producers as $producer)
                               
                                <a class="btn btn-light border border-secondary mx-1" href="{{ url()->current() }}?producer={{ urlencode($producer) }}&sort={{ $sort }}">{{ $producer }}</a>
                               
                            @endforeach
                        
                    </div>

                </div>
                <div class="col-lg-12 col-md-5">
                    <form method="GET" action="{{ route('User.Product', ['id' => $id]) }}" class="filter__sort">
                        <span>Sắp xếp </span>
                        <button type="submit" name="sort" value="asc"
                            class="btn btn-light border border-secondary mr-2">
                            <i class="fa-solid fa-arrow-up-wide-short" style="color: #141415;"></i> Giá thấp > cao
                        </button>
                        <button type="submit" name="sort" value="desc" class="btn btn-light border border-secondary">
                            <i class="fa-solid fa-arrow-down-wide-short" style="color: #0c0d0d;"></i> Giá cao > thấp
                        </button>
                    </form>

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
                                    <a href="{{route('User.ProductDetails', [khongdau($product->name_product), $product->id])}}"
                                        class="text-decoration-none">
                                        <p class="card-title">{{$product->name_product}}</p>
                                    </a>
                                    <h6 class="card-text text-price my-0 py-1">
                                        {{ number_format($product->discount, 0, ',', '.') }} ₫
                                    </h6>
                                    <p><del>{{ number_format($product->price_product, 0, ',', '.') }} ₫</del></p>
                                    <div>
                                        <p class="my-0">Model:&nbsp;{{$product->model}}</p>
                                        <p class="my-1">Hãng:&nbsp; {{$product->producer}}</p>
                                        <p class="my-1">Nơi sản xuất:&nbsp; {{$product->origin}}</p>
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