@extends ('Admin/LayoutAdmin/LayoutAdmin')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Cập nhật sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Sản phẩm</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <form action="{{route('Admin.ProductUpdate', $product_old->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thông tin chung</h5>
                            <!-- General Form Elements -->

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="inputText" class=" col-form-label">Tên sản phẩm <span
                                            class="text-danger">*</span></label>

                                    <input
                                        value="{{old('name_product', isset($product_old->name_product) ? $product_old->name_product : null)}}"
                                        name="name_product" type="text" class="form-control">
                                    {!!$errors->first('name_product', '<div class="has-error text-danger">:message</div>')!!}
                                </div>

                            </div>
                            <div class="row my-5">
                                <div class="col-sm-6">
                                    <label for="inputText" class=" col-form-label">Danh mục <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="idCategory">
                                        <option value="">Chọn danh mục...</option>
                                        @foreach($category as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $product_old->idCategory ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!!$errors->first('idCategory', '<div class="has-error text-danger">:message</div>')!!}
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputText" class=" col-form-label">Model<span
                                            class="text-danger">*</span></label>

                                    <input
                                        value="{{old('model', isset($product_old->model) ? $product_old->model : null)}}"
                                        name="model" type="text" class="form-control">
                                    {!!$errors->first('model', '<div class="has-error text-danger">:message</div>')!!}
                                </div>
                            </div>

                            <div class="row my-5">
                                <!-- Nhà sản xuất -->
                                <div class="col-sm-6">
                                    <label for="producer" class="col-form-label">Hãng </label>
                                    <input
                                        value="{{old('producer', isset($product_old->producer) ? $product_old->producer : null)}}"
                                        name="producer" type="text" class="form-control">
                                    {!! $errors->first('producer', '<div class="has-error text-danger">:message</div>') !!}
                                </div>

                                <!-- Nguồn gốc -->
                                <div class="col-sm-6">
                                    <label for="origin" class="col-form-label">Nơi sản xuất </label>
                                    <input
                                        value="{{old('origin', isset($product_old->origin) ? $product_old->origin : null)}}"
                                        name="origin" type="text" class="form-control">
                                    {!! $errors->first('origin', '<div class="has-error text-danger">:message</div>') !!}
                                </div>
                            </div>





                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Giá sản phẩm</h5>
                            <!-- General Form Elements -->
                            <div class="row my-2">
                                <div class="col-sm-6">
                                    <label for="inputText" class=" col-form-label">Giá gốc<span
                                            class="text-danger">*</span></label>

                                    <input
                                        value="{{old('price_product', isset($product_old->price_product) ? $product_old->price_product : null)}}"
                                        name="price_product" type="text" class="form-control money-input">
                                    {!!$errors->first('price_product', '<div class="has-error text-danger">:message</div>')!!}

                                </div>

                                <div class="col-sm-6">
                                    <label for="inputText" class=" col-form-label">Giá bán<span
                                            class="text-danger">*</span></label>

                                    <input
                                        value="{{old('discount', isset($product_old->discount) ? $product_old->discount : null)}}"
                                        name="discount" type="text" class="form-control money-input">
                                    {!!$errors->first('discount', '<div class="has-error text-danger">:message</div>')!!}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Hình ảnh sản phẩm</h5>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-4 col-form-label">Hình ảnh<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input
                                        value="{{old('image', isset($product_old->image) ? $product_old->image : null)}}"
                                        class="form-control" type="file" onchange="onUpload(this)" name="image"
                                        accept="image/*">
                                    {!!$errors->first('image', '<div class="has-error text-danger">:message</div>')!!}
                                    <div class="row py-4">
                                        <div class="col-6">
                                            <strong>Hình ảnh hiện tại</strong>
                                            @if(isset($product_old->image))
                                                <div class="mt-2">
                                                    <img src="{{ asset('public/file/img/img_product/' . $product_old->image) }}"
                                                        alt="Current Image" style="max-height: 200px;">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-6">
                                            <strong>Hình ảnh mới</strong>
                                            <div id="preview" class="mt-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-4 col-form-label">Hình ảnh thông số</label>
                                <div class="col-sm-10">
                                    <input
                                        value="{{old('image_specifications', isset($product_old->image_specifications) ? $product_old->image_specifications : null)}}"
                                        class="form-control" type="file" name="image_specifications" onchange="onUploadNewImageSpecifications(this)"
                                        accept="image_specifications/*">
                                    {!!$errors->first('image_specifications', '<div class="has-error text-danger">:message</div>')!!}
                                    <div class="row py-4">
                                        <div class="col-6">
                                        <strong>Hình ảnh hiện tại</strong>
                                    @if(isset($product_old->image_specifications))
                                        <div class="mt-2">
                                            <img src="{{ asset('public/file/img/img_product/' . $product_old->image_specifications) }}"
                                                alt="Current Image" style="max-height: 200px;">
                                        </div>
                                    @endif
                                        </div>

                                        <div class="col-6">
                                            <strong>Hình ảnh mới</strong>
                                            <div id="new_image_specifications" class="mt-4"></div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="row my-5 ">
                                <div class="col-sm-10 ">
                                    <button type="submit" class="btn btn-primary mx-3"><i
                                            class="bi bi-sd-card-fill px-2"></i>Lưu</button>
                                    <a href="{{route("Admin.ProductIndex")}}" class="btn btn-secondary"><i
                                            class="bi bi-arrow-return-left px-2"></i>Quay lại</a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mô tả sản phẩm</h5>
                            <label for="inputText" class="col-form-label">Mô tả</label>
                            <textarea name="description" id="description" type="text" class="form-control" cols="30"
                                rows="10">{{old('description', isset($product_old->description) ? $product_old->description : null)}}</textarea>
                            <script>CKEDITOR.replace('description');</script>
                            {!!$errors->first('description', '<div class="has-error text-danger">:message</div>')!!}
                        </div>
                    </div>
                </div>
            </div>
        </form><!-- End General Form Elements -->

    </section>

</main><!-- End #main -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/js/dropify.min.js"></script>
<script>
    function onUpload(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var preview = document.getElementById('preview');
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Uploaded Image" style="max-width: 100%; max-height: 300px;">';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Initialize Dropify plugin
    $('.dropify').dropify();
</script>
<script>
    function onUploadNewImageSpecifications(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var preview = document.getElementById('new_image_specifications');
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Uploaded Image" style="max-width: 100%; max-height: 300px;">';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Initialize Dropify plugin
    $('.dropify').dropify();
</script>
<script>
    // Hàm dùng để định dạng số tiền
    function formatCurrency(input) {
        var value = input.value.replace(/\D/g, ''); // Loại bỏ tất cả ký tự không phải là số
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Thêm dấu phẩy ngăn cách hàng nghìn
        input.value = value + ' đ'; // Thêm đơn vị tiền tệ
    }

    // Gắn sự kiện cho tất cả các input có class "money-input"
    document.querySelectorAll('.money-input').forEach(function (input) {
        input.addEventListener('input', function (e) {
            formatCurrency(this);
        });
    });
</script>
@endsection