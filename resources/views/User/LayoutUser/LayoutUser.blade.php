<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/User')}}/img/attachment_101759249.png">


    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('public/User')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/User')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/User')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/User')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/User')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/User')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/User')}}/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/User')}}/owlcarousel/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('public/User')}}/owlcarousel/assets/owl.theme.default.min.css" />
    <script src="{{asset('public/User')}}/js/jquery-3.3.1.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="ping"></div>
    </div>



    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a><img src="{{asset('public/User')}}/img/logo.png" alt="Logo"></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>

        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="{{asset('public/User')}}/img/flag.png" alt="">
                <div>Vietnamese</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a><i class="fa fa-user"></i>Đăng nhập</a>
            </div>
        </div>
        <!-- <nav class="humberger__menu__nav mobile-menu">
           <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li>
                    <a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul> 
        </nav> -->
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>

        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i>nqht12345679@gmail.com</li>

            </ul>
        </div>
    </div>
    <!-- Humberger End -->
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i>nqht12345679@gmail.com</li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="{{asset('public/User')}}/img/flag.png" alt="">
                                <div>Vietnamese</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>

                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>


                            <!-- Nếu đã đăng nhập -->
                            <div class="header__top__right__auth">

                                <div class="dropdown">
                                    <a class="nav-link dropdown-toggle" style="cursor:pointer;" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                            class="fa fa-user"></i>Xin chào, @userFullname</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <form id="logoutForm" method="post">

                                            <button type="submit" class="btn btn-link text-dark">Đăng xuất</button>
                                        </form>
                                        <!-- Thêm các mục khác nếu cần -->
                                    </div>
                                </div>
                            </div>

                            <div class="header__top__right__auth">
                                <a><i class="fa fa-user"></i> Đăng nhập</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{route('User.Home')}}"><img src="{{asset('public/User')}}/img/logo.png"
                                alt="Logo"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <!-- <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="./shop-grid.html">Shop</a></li>
                            <li>
                                <a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>  -->
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="{{ route('User.ViewCart') }}">
                                    <i class="fa fa-cart-plus"></i>

                                    <span id="cartItemCount">
                                        @if(Session::has('cart'))
                                            {{ count(Session::get('cart')) }}
                                        @else
                                            0
                                        @endif
                                    </span>
                                </a>
                            </li>
                            <span class="px-1">Giỏ hàng</span>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">


                <div class="col-lg-3">
                    <div
                        class="hero__categories {{ Route::currentRouteName() == 'User.Home' ? 'expanded' : 'collapsed' }}">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Danh mục sản phẩm</span>
                        </div>
                        <ul>
                            @foreach($ListCategory as $category)
                                <li><a href="{{route('User.Product', $category->id)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">

                                <input type="text" placeholder="Bạn cần tìm gì?">
                                <button type="submit" class="site-btn">Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+123-456-789</h5>
                                <span>Hỗ trợ 24/7 </span>
                            </div>
                        </div>
                    </div>

                    @if(request()->is('/'))
                        <div class="hero__item set-bg">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100"
                                            src="{{asset('public/User')}}/img/banner/bao-tri-dien-may-tat-ca-cac-hang-1.webp"
                                            alt="First slide">
                                    </div>
                                    <div class="carousel-item ">
                                        <img class="d-block w-100" src="{{asset('public/User')}}/img/banner/slider_3.webp"
                                            alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100"
                                            src="{{asset('public/User')}}/img/banner/hinh-mau-banner-dien-may_033706200.jpg"
                                            alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    @endif



                </div>

            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    @yield('content')


    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="{{asset('public/User')}}/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Địa chỉ: Việt Nam</li>
                            <li>Số điện thoại: +123-456-789</li>
                            <li>Email: nqht12345679@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <!-- Footer Section End -->
    <!-- Js Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <script src="{{asset('public/User')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/User')}}/js/jquery-ui.min.js"></script>
    <script src="{{asset('public/User')}}/js/jquery.slicknav.js"></script>
    <script src="{{asset('public/User')}}/js/mixitup.min.js"></script>
    <script src="{{asset('public/User')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('public/User')}}/js/main.js"></script>
    <script src="{{asset('public/User')}}/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{asset('public/User')}}/js/owlcarousel.js"></script>

    @RenderSection("Scripts", required: false)


</body>

</html>