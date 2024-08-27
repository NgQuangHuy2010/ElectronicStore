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

            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <h2 class="card-title text-center mb-5">Đăng ký</h2>
                    <form method="POST" action="{{ route('User.Register') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName" name="name" placeholder="Fullname" value="{{ old('name') }}">
                            <label for="floatingName">Họ tên <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                            <label for="floatingInput">Email <span class="text-danger">*</span></label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="floatingPhone" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                            <label for="floatingPhone">Số điện thoại</label>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" name="password" placeholder="Password">
                            <label for="floatingPassword">Mật khẩu <span class="text-danger">*</span></label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="floatingConfirmPassword" name="password_confirmation" placeholder="ConfirmPassword">
                            <label for="floatingConfirmPassword">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="my-3">
                            <div class="text-wrap">
                                <span>Bạn đã có tài khoản?</span> <a href="{{ route('User.Login') }}" class="text-dark">Đăng nhập</a>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
