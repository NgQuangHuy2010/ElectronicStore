@extends ('User/LayoutUser/LayoutUser')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<section class="shop spad">
    <div class="container container-product">
        <div class="filter__item">
            <div class="row ">
                <div class="col-lg-12 col-md-5">
                    <div class="filter__sort">
                        <span>Hãng</span> &nbsp;
                        @foreach ($producers as $producer)
                                                @php
                                                    // Lấy danh sách các nhà sản xuất hiện tại từ tham số truy vấn 'producer'
                                                    $currentProducers = request()->get('producer', []);

                                                    // Nếu 'producer' là một chuỗi, chuyển đổi nó thành mảng bằng cách phân tách chuỗi
                                                    if (is_string($currentProducers)) {
                                                        $currentProducers = explode(',', $currentProducers);
                                                    }

                                                    // Nếu sau khi chuyển đổi, 'currentProducers' không phải là mảng, khởi tạo nó là mảng rỗng
                                                    if (!is_array($currentProducers)) {
                                                        $currentProducers = [];
                                                    }

                                                    // Kiểm tra xem nhà sản xuất hiện tại có trong danh sách 'currentProducers' không
                                                    $isActive = in_array($producer, $currentProducers);

                                                    // Cập nhật danh sách nhà sản xuất dựa trên trạng thái 'active'
                                                    // Nếu nhà sản xuất đang hoạt động, loại bỏ nó khỏi danh sách
                                                    // Nếu không, thêm nó vào danh sách
                                                    $newProducers = $isActive
                                                        ? array_diff($currentProducers, [$producer])
                                                        : array_merge($currentProducers, [$producer]);

                                                    // Xây dựng chuỗi truy vấn cho URL
                                                    // Thay đổi tham số 'producer' thành danh sách mới sau khi thêm hoặc xóa
                                                    // Giữ lại tham số 'sort' như cũ
                                                    $queryString = http_build_query([
                                                        'producer' => implode(',', $newProducers),
                                                        'sort' => request()->get('sort')
                                                    ]);                                      
                                                @endphp
                                                <!-- Tạo liên kết cho nhà sản xuất hiện tại -->
                                                <!--  - Nếu nhà sản xuất đang hoạt động, thêm lớp CSS 'active' vào liên kết
                                                     - URL liên kết được xây dựng bằng cách nối URL hiện tại với chuỗi truy vấn mới -->
                                                <a class="btn btn-light border border-secondary mx-1 {{ $isActive ? 'active' : '' }}"
                                                    href="{{ url()->current() . '?' . $queryString }}">
                                                    {{ $producer }}
                                                </a>
                        @endforeach

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 col-md-5 d-flex align-items-center">
                    <form method="GET" action="{{ url()->current() }}" class="filter__sort mr-2">
                        <input type="hidden" name="producer" value="{{ request()->get('producer') }}">
                        <span>Sắp xếp </span> &nbsp;
                        <button type="submit" name="sort" value="{{ request()->get('sort') === 'asc' ? '' : 'asc' }}"
                            class="mx-2 btn btn-light border border-secondary {{ request()->get('sort') === 'asc' ? 'active' : '' }}">
                            <i class="fa-solid fa-arrow-up-wide-short" style="color: #141415;"></i> Giá thấp > cao
                        </button>
                        <button type="submit" name="sort" value="{{ request()->get('sort') === 'desc' ? '' : 'desc' }}"
                            class="btn btn-light border border-secondary {{ request()->get('sort') === 'desc' ? 'active' : '' }}">
                            <i class="fa-solid fa-arrow-down-wide-short" style="color: #0c0d0d;"></i> Giá cao > thấp
                        </button>
                    </form>


                    <div class="sidebar__item">
                        <div class="price-range-wrap">
                            <div class="dropdown">
                                <button class="btn btn-light border dropdown-toggle w-100" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Khoảng giá
                                </button>
                                <div class="dropdown-menu p-4" aria-labelledby="dropdownMenuButton"
                                    style="min-width: 400px;">
                                    <form method="GET" action="{{ url()->current() }}">
                                        <input type="hidden" name="producer" value="{{ request()->get('producer') }}">
                                        <input type="hidden" name="sort" value="{{ request()->get('sort') }}">
                                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                            data-min="100000" data-max="100000000">
                                            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                            <span tabindex="0"
                                                class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                            <span tabindex="0"
                                                class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                        </div>
                                        <div class="range-slider mt-3">
                                            <div class="price-input d-flex align-items-center">
                                                <input type="text" id="minamount" class="form-control text-right"
                                                    placeholder="100.000" style="max-width: 130px;">
                                                <span class="mx-2">-</span>
                                                <input type="text" id="maxamount" class="form-control text-right"
                                                    placeholder="100.000.000" style="max-width: 130px;">

                                            </div>
                                        </div>
                                        <input type="hidden" name="min_price" id="minamount"
                                            value="{{ request()->input('min_price', 0) }}">
                                        <input type="hidden" name="max_price" id="maxamount"
                                            value="{{ request()->input('max_price', 100000000) }}">
                                        <button type="submit" class="btn btn-primary w-100 mt-3">Xem kết quả</button>

                                    </form>
                                </div>
                            </div>
                        </div>
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
<script>
    $(function () {
        // Lấy giá trị từ URL hoặc form
        var minPrice = parseInt("{{ request()->input('min_price', 100000) }}".replace(/\./g, ''));
        var maxPrice = parseInt("{{ request()->input('max_price', 100000000) }}".replace(/\./g, ''));

        // Thiết lập slider
        $(".price-range").slider({
            range: true,
            min: 100000,
            max: 100000000,
            values: [minPrice || 100000, maxPrice || 100000000],
            slide: function (event, ui) {
                $("#minamount").val(ui.values[0].toLocaleString('vi-VN') + '₫');
                $("#maxamount").val(ui.values[1].toLocaleString('vi-VN') + '₫');
                $("input[name='min_price']").val(ui.values[0]);
                $("input[name='max_price']").val(ui.values[1]);
            }
        });

        // Cập nhật giá trị ban đầu cho các trường ẩn
        $("#minamount").val($(".price-range").slider("values", 0).toLocaleString('vi-VN') + '₫');
        $("#maxamount").val($(".price-range").slider("values", 1).toLocaleString('vi-VN') + '₫');
    });
</script>
@endsection