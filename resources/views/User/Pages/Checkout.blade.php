@extends('User.LayoutUser.LayoutUser')
@section('content')

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Chi tiết thanh toán</h4>
            <form action="{{route('User.CheckoutPost')}}" method="POST" id="shipment-form">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ và tên<span class="text-danger">*</span></p>
                                    <input type="text" value="{{old('fullname')}}" name="fullname">
                                    {!!$errors->first('fullname', '<div class="has-error text-danger font-italic">:message</div>')!!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="number" name="phone" value="{{old('phone')}}">
                                    {!!$errors->first('phone', '<div class="has-error text-danger font-italic">:message</div>')!!}

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email" value="{{old('email')}}">
                                    {!!$errors->first('email', '<div class="has-error text-danger font-italic">:message</div>')!!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="">
                                    <p>Tỉnh/Thành phố<span class="text-danger">*</span></p>
                                    <select id="province" name="province" value="{{old('province')}}"
                                        class="w-100 checkout__select">
                                        <option class="w-100" value="">-- Chọn Tỉnh/Thành phố --</option>
                                        @if ($locations)
                                            @foreach ($locations as $province)
                                                <option value="{{ $province['name'] }}" {{ old('province') == $province['name'] ? 'selected' : '' }}>{{ $province['name'] }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Không có dữ liệu</option>
                                        @endif
                                    </select>
                                    {!!$errors->first('province', '<div class="has-error text-danger mb-4 font-italic">:message</div>')!!}

                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <p> Quận/Huyện<span class="text-danger">*</span></p>
                                    <select id="district" name="district" value="{{old('district')}}"
                                        class="w-100 checkout__select">
                                        <option class="w-100" value="">-- Chọn Quận/Huyện --</option>
                                        @if (old('province'))
                                            @foreach ($locations as $province)
                                                @if ($province['name'] == old('province'))
                                                    @foreach ($province['districts'] as $district)
                                                        <option value="{{ $district['name'] }}" {{ old('district') == $district['name'] ? 'selected' : '' }}>
                                                            {{ $district['name'] }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    {!!$errors->first('district', '<div class="has-error text-danger mb-4 font-italic">:message</div>')!!}

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <p>Phường/Xã<span class="text-danger">*</span></p>
                                    <select id="ward" name="ward" value="{{old('ward')}}"
                                        class="w-100 checkout__select">
                                        <option class="w-100" value="">-- Chọn Phường/Xã --</option>
                                        @if (old('district'))
                                            @foreach ($locations as $province)
                                                @foreach ($province['districts'] as $district)
                                                    @if ($district['name'] == old('district'))
                                                        @foreach ($district['wards'] as $ward)
                                                            <option value="{{ $ward['name'] }}" {{ old('ward') == $ward['name'] ? 'selected' : '' }}>
                                                                {{ $ward['name'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </select>
                                    {!!$errors->first('ward', '<div class="has-error text-danger font-italic">:message</div>')!!}

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 pt-2">
                                <div class="checkout__input">
                                    <p>Địa chỉ<span>*</span></p>
                                    <input type="text" name="address" value="{{old('address')}}">
                                    {!!$errors->first('address', '<div class="has-error text-danger font-italic">:message</div>')!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 pt-2">
                                <div class="checkout__input__checkbox">
                                    <input type="radio" name="paymentMethod" id="payment" value="cash" checked>
                                    <img src="{{asset('public/User')}}/img/payment.png" alt="Thanh toán khi nhận hàng"
                                        class="mx-2 radio-icon">
                                    <label class="mb-0" for="payment">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                            <div class="col-lg-6 pt-2">
                                <div class="checkout__input__checkbox">
                                    <input type="radio" name="paymentMethod" id="paypal" value="momo">
                                    <img src="{{asset('public/User')}}/img/momo.png" alt="Thanh toán bằng momo"
                                        class="mx-2 radio-icon">
                                    <label class="mb-0" for="paypal">Thanh toán bằng MoMo </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="selected_locations" name="selected_locations">
                        <div class="row">
                            <div class="col-lg-12 py-2">
                                <button type="submit" class="site-btn btn-lg btn-block">Thanh toán</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Thông tin sản phẩm</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Giá</span></div>
                            <ul>
                                @foreach ($cart as $item)
                                    <li class="product-item">
                                        <p class="product-name">{{ $item['productName'] }}</p>
                                        <span>x {{ $item['quantity'] }} &nbsp;
                                            {{ number_format($item['productPrice'] * $item['quantity'], 0, ',', '.') }}
                                            ₫</span>
                                    </li>

                                @endforeach
                            </ul>
                            <div class="checkout__order__subtotal">Tạm tính
                                <span>{{ number_format($totalAmount, 0, ',', '.') }} ₫ </span>
                            </div>
                            <div class="checkout__order__ship">Phí vận chuyển
                                <span>{{ number_format($shippingFee, 0, ',', '.') }} ₫ </span>
                            </div>
                            <div class="checkout__order__total">Tổng tiền thanh toán
                                <span>{{ number_format($totalPayment, 0, ',', '.') }} ₫ </span>
                            </div>
                        </div>
                    </div>


            </form>

        </div>

    </div>
    </div>
</section>
<script>
    //tạo var locations chứa json($loactions) từ view trên để tạo file js riêng gọi vào 
    var locations = @json($locations);
</script>
<script src="{{asset('public/User')}}/js/select-address.js"></script>
@endsection