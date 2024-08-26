@extends('User.LayoutUser.LayoutLogin')

@section('content')
<style>
    .btn-login {
        font-size: 0.9rem;
        letter-spacing: 0.05rem;
        padding: 0.75rem 1rem;
    }

    .btn-google {
        color: white !important;
        background-color: #ea4335;
    }

    .btn-facebook {
        color: white !important;
        background-color: #3b5998;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif
            
            @if (session('statusVerified'))
                <div class="alert alert-info">
                    {{ session('statusVerified') }}
                </div>
            @endif
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <h2 class="card-title text-center mb-5 ">Đăng nhập</h2>
                    <form method="post">
                        <div class="form-floating mb-3">
                            <input class="form-control" placeholder="name@email.com">
                            <label for="floatingInput">Email </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" placeholder="Password">


                            <label for="floatingPassword">Mật khẩu</label>
                        </div>

                        <div class="d-flex justify-content-between flex-wrap my-3">
                            <div class=" text-wrap">
                                <a class="text-dark">Quên mật khẩu?</a>
                            </div>
                            <div class="text-wrap">
                                <span>Bạn chưa có tài khoản ?</span> <a href="{{Route('User.Register')}}"
                                    class="text-dark">Đăng ký</a>
                            </div>
                        </div>

                        <div class="d-grid">

                            <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit"><i
                                    class="fa-solid fa-right-to-bracket px-2"></i>Đăng nhập</button>
                        </div>
                    </form>

                    <hr class="my-4">
                    <div class="d-grid mb-2">
                        <a class="btn btn-google btn-login text-uppercase fw-bold">
                            <i class="fab fa-google me-2"></i> Sign in with Google
                        </a>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-facebook btn-login text-uppercase fw-bold" type="submit">
                            <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection