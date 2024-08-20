@extends ('Admin/LayoutAdmin/LayoutAdmin')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tạo mới danh mục</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Danh mục</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tạo mới danh mục</h5>
                        <!-- General Form Elements -->
                        <form action="{{route('Admin.CategoryCreate')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Tên danh mục <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input value="{{old('name')}}" name="name" type="text" class="form-control">
                                    {!!$errors->first('name', '<div class="has-error text-danger">:message</div>')!!}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Hình ảnh<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" onchange="onUpload(this)" 
                                        name="image" accept="image/*">
                                    {!!$errors->first('image', '<div class="has-error text-danger">:message</div>')!!}
                                    <div id="preview" class="mt-4"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="bi bi-sd-card-fill px-2"></i>Lưu</button>
                                    <a href="{{route("Admin.CategoryIndex")}}" class="btn btn-secondary"><i
                                            class="bi bi-arrow-return-left px-2"></i>Quay lại</a>

                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>


        </div>
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