@extends ('Admin/LayoutAdmin/LayoutAdmin')
@section('content')
<main id="main" class="main">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<div class="pagetitle">
  <h1>Danh mục</h1>
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
        <h5 class="card-title d-flex justify-content-end"> <a href="{{route("Admin.CategoryCreate")}}" class="btn btn-primary">  <i class="bi bi-plus-circle-fill px-2"></i>Tạo mới</a></h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Hình ảnh</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
  
            <?php    foreach ($category as $value){  ?> 
              <tr>
                <td>{{$value['id']}}</td>
                <td>{{$value['name']}}</td>
                 <td><img width="70" src="{{asset('public/file/img/img_category/'.$value->image)}}" alt=""></td>
                <td>
                <a href="{{route('Admin.CategoryUpdate',$value['id'])}}" class="px-2"><i class="bi bi-pencil-square" style="color:green;"></i></a>
                <a href="{{route('Admin.CategoryDelete',$value['id'])}}"  onclick="confirmation(event)" ><i class="bi bi-trash2 " style="color:red;"></i></a>
                </td>
              </tr>
              <?php }  ?>
              
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);

        Swal.fire({
            title: 'Bạn có chắc muốn xóa không?',
            text: 'Dữ liệu sẽ bị mất vĩnh viễn!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#009900',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
            customClass: {
                container: 'custom-swal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlToRedirect;
            }
        });
    }
</script>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@endsection