@extends ('Admin/LayoutAdmin/LayoutAdmin')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tạo mới sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Sản phẩm</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <form action="{{route('Admin.ProductCreate')}}" method="post" enctype="multipart/form-data">
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
                               
                                    <input value="{{old('name_product')}}" name="name_product" type="text"
                                        class="form-control">
                                    {!!$errors->first('name_product', '<div class="has-error text-danger">:message</div>')!!}
                                </div>
                             
                            </div>
                            <div class="row my-5">
                            <div class="col-sm-6">
                                <label for="inputText" class=" col-form-label">Danh mục <span
                                        class="text-danger">*</span></label>
                               
                                    <select class="form-select" aria-label="Default select example" name="idCategory">

                                    </select>

                                    {!!$errors->first('idCategory', '<div class="has-error text-danger">:message</div>')!!}
                                </div>
                               <div class="col-sm-6">
                               <label for="inputText" class=" col-form-label">Model<span
                                        class="text-danger">*</span></label>
                                
                                    <input value="{{old('model')}}" name="model" type="text" class="form-control">
                                    {!!$errors->first('model', '<div class="has-error text-danger">:message</div>')!!}
                               </div>
                            </div>

                            <div class="row my-5">
                                <!-- Nhà sản xuất -->
                                <div class="col-sm-6">
                                    <label for="producer" class="col-form-label">Nhà sản xuất <span
                                            class="text-danger">*</span></label>
                                    <input value="{{ old('producer') }}" name="producer" type="text"
                                        class="form-control">
                                    {!! $errors->first('producer', '<div class="has-error text-danger">:message</div>') !!}
                                </div>

                                <!-- Nguồn gốc -->
                                <div class="col-sm-6">
                                    <label for="origin" class="col-form-label">Nguồn gốc <span
                                            class="text-danger">*</span></label>
                                    <input value="{{ old('origin') }}" name="origin" type="text" class="form-control">
                                    {!! $errors->first('origin', '<div class="has-error text-danger">:message</div>') !!}
                                </div>
                            </div>

                          


                            <!-- <div class="row my-5">
                                <label for="inputText" class="col-sm-4 col-form-label">Mô tả sản phẩm<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <textarea value="{{old('description')}}" name="description" type="text"
                                        class="form-control"></textarea>
                                    {!!$errors->first('description', '<div class="has-error text-danger">:message</div>')!!}
                                </div>
                            </div> -->
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
                                
                                    <input value="{{old('price_product')}}" name="price_product" type="text"
                                        class="form-control">
                                    {!!$errors->first('price_product', '<div class="has-error text-danger">:message</div>')!!}
                                
                                </div>
                            
                               <div class="col-sm-6">
                               <label for="inputText" class=" col-form-label">Giá bán<span
                                        class="text-danger">*</span></label>
                               
                                    <input value="{{old('discount')}}" name="discount" type="text" class="form-control">
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
                                    <input class="form-control" type="file" onchange="onUpload(this)" name="image"
                                        accept="image/*">
                                    {!!$errors->first('image', '<div class="has-error text-danger">:message</div>')!!}
                                    <div id="preview" class="mt-4"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-4 col-form-label">Hình ảnh thông số<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" onchange="onUpload(this)"
                                        name="image_specifications" accept="image_specifications/*">
                                    {!!$errors->first('image_specifications', '<div class="has-error text-danger">:message</div>')!!}

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
@endsection