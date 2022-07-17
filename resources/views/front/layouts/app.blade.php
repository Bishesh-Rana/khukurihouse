<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>

    @include('front.layouts.meta')

    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/all.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/animate.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/flaticon.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/lightslider.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/line-awesome.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/metisMenu.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/owl.carousel.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/owl.theme.default.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}front/css/responsive.css" media="all" />

    <link href="{{ asset('') }}admincast/assets/lobibox/dist/css/lobibox.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('') }}favicon.ico">
    @stack('styles')

    <!-- Middle Header -->
    <div class="middle-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <div class="header-wrap">
                <div class="logo-wrapper">
                    <div class="logo">
                        <a href="{{ route('home.index') }}">
                            @if ($setting->site_logo)
                                <img src="{{ asset('') }}uploads/settings/{{ $setting->site_logo }}"
                                    alt="{{ $setting->site_name }}">
                            @endif
                        </a>
                    </div>
                    <div class="toggle-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div id="app">
                    <search></search>
                </div>
                <div class="header-right">
                    <ul>
                        <li>
                            <ul id="site-header-cart" class="site-header-cart menu cart-products-list">
                                @include('front.ajaxcart.cart-list')
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="far fa-heart"></i>
                                {{-- Wishlist --}}
                                <span class="count totalQty">@if (Auth::guard('web')->check()){{ Auth::guard('web')->user()->wishlist->count() }} @else 0 @endif</span>
                            </a>
                        </li>
                        @if (Auth::guard('web')->check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ preg_split('/\s+/', Auth::guard('web')->user()->name, 2)[0] }}</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('customer.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('customer.logout') }}"><i
                                            class="fas fa-sign-in-alt"></i> Log Out</a>

                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                        class="far fa-user"></i></a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('track.order') }}"><i
                                            class="fas fa-truck-pickup"></i>Track Order</a>
                                    <a class="dropdown-item" href="{{ route('customer.login') }}"><i
                                            class="fas fa-sign-in-alt"></i> Log In</a>
                                    <a class="dropdown-item" href="{{ route('customer.register') }}"><i
                                            class="far fa-user"></i> Sign UP</a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Middle Header End -->

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        @foreach ($categories as $category)
                            @php
                                $childcategory = $category->child()->home()->get();
                            @endphp
                            @if (!count($childcategory))
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('product.category', ['category_slug' => $category->category_slug]) }}">
                                        {{ $category->category_name }} <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $category->category_name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($childcategory as $child)
                                            <a class="dropdown-item"
                                                href="{{ route('product.category', ['category_slug' => $child->category_slug]) }}">{{ $child->category_name }}</a>
                                        @endforeach
                                    </div>
                                </li>
                            @endif

                        @endforeach
                        @foreach ($contents as $content)
                            @php
                                $childContent = $content->child;
                            @endphp
                            @if (!count($childContent))
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ $content->external_link ?? $setting->site_url . $content->content_url }}">
                                        {{ $content->content_title }} <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $content->content_title }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($childContent as $child)
                                            <a class="dropdown-item"
                                                href="{{ $child->external_link ?? $setting->site_url . $child->content_url }}">{{ $child->content_title }}</a>
                                        @endforeach
                                    </div>
                                </li>
                            @endif

                        @endforeach

                    </ul>
                </div>
            </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Mobile Menu -->
    <div id="mySidenav" class="sidenav">
        <div class="mobile-logo">
            <a href="{{ route('home.index') }}"><img src="{{ config('settings.logo') }}" alt="logo"></a>
            <a href="javascript:void(0)" id="close-btn" class="closebtn">&times;</a>
        </div>
        <div class="no-bdr1">
            <ul id="menu1">
                {{-- <li><a href="#">Electronics</a></li>
                <li><a href="#">Men</a></li> --}}
                @foreach ($categories as $category)
                    @php
                        $childcategory = $category->child;
                    @endphp
                    @if (!count($childcategory))
                        <li>
                            <a href="{{ route('product.category', ['category_slug' => $category->category_slug]) }}">
                                {{ $category->category_name }}</a>
                        </li>
                    @else
                        <li>
                            <a href="#" class="has-arrow">{{ $category->category_name }}</a>
                            <ul>
                                @foreach ($childcategory as $child)
                                    <li>
                                        <a
                                            href="{{ route('product.category', ['category_slug' => $child->category_slug]) }}">
                                            {{ $child->category_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
    </div>
    <!-- Mobile Menu End -->

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-wrap">
                        <h3>Single Category</h3>
                        <ul>
                            <li>
                                @foreach ($singlecategories as $category)
                                    <a
                                        href="{{ route('product.category', ['category_slug' => $category->category_slug]) }}">{{ $category->category_name }}</a>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-wrap">
                        <h3>{{ $setting->site_name }}</h3>
                        @foreach ($footerContents as $footerContent)
                            <a
                                href="{{ $footerContent->external_link ?? $setting->site_url . $footerContent->content_url }}">{{ $footerContent->content_title }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-wrap">
                        <h3>Help</h3>
                        @foreach ($helpContents as $content)
                            <a
                                href="{{ $content->external_link ?? $setting->site_url . $content->content_url }}">{{ $content->content_title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="footer-middle">
                <div class="footer-middle-left">
                    <!-- <a href="#"><img src="img/download1.svg" alt=""></a> -->
                    <form class="form-inline" action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <input type="email" class="form-control" id="email" name="subscriber_email"
                                placeholder="Enter Your Email">
                        </div>
                        <button type="submit" class="btn btn-danger mb-2">Subscribe</button>
                    </form>
                </div>
                <div class="footer-middle-center">
                    <ul>
                        <li class="facebook">
                            <a href="{{ $setting->facebook }}"><i class="lab la-facebook-f"></i></a>
                        </li>
                        <li class="twitter">
                            <a href="{{ $setting->twitter }}"><i class="lab la-twitter"></i></a>
                        </li>
                        <li class="instagram">
                            <a href="{{ $setting->instagram }}"><i class="lab la-instagram"></i></a>
                        </li>
                        <li class="linkedin">
                            <a href="{{ $setting->linkedin }}"><i class="lab la-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="footer-middle-right">
                    <a href="https://www.himalayanbank.com" target="_blank"><img src="{{ asset('') }}front/img/HBL-Logo.jpg" alt="images"></a>
                    {{-- <a href="https://www.imepay.com.np/" target="_blank"><img src="{{ asset('') }}front/img/card2.png" alt="images"></a>
                    <a href="https://khalti.com/" target="_blank"><img src="{{ asset('') }}front/img/card3.png" alt="images"></a> --}}
                    <a href="https://www.paypal.com" target="_blank"><img src="{{ asset('') }}front/img/card4.png" alt="images"></a>
                    {{-- <a href="https://esewa.com.np" target="_blank"><img src="{{ asset('') }}front/img/card5.png" alt="images"></a> --}}
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Footer Bottom -->
    <section class="footer-bottom">
        <div class="container">
            <div class="fb-wrap">
                <div class="fb-left">
                    <ul>
                        <li>© {{ date('Y') }} Your Website. All Rights Reserved.</li>
                        <li>Powered By: <a href="#">Nectar Digit</a></li>
                    </ul>
                </div>
                <div class="fb-right">
                    <ul>
                        <li>
                            <a href="{{ route('termsofuse') }}">Terms of use</a>
                        </li>
                        <li>
                            <a href="{{ route('privacy') }}">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#">Careers</a>
                        </li>
                        <li>
                            <a href="{{ route('termsandcondition') }}">Terms & Condition</a>
                        </li>
                        <li>
                            <a href="#">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Bottom End -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>

    <script src="{{ asset('js/vue.js') }}"></script>

    <script src="{{ asset('') }}admincast/assets/lobibox/dist/js/notifications.min.js"></script>

    <script src="{{ asset('') }}front/js/jquery.min.js "></script>
    <script src="{{ asset('') }}front/js/popper.min.js "></script>
    <script src="{{ asset('') }}front/js/bootstrap.bundle.min.js "></script>
    <script src="{{ asset('') }}front/js/owl.carousel.min.js "></script>
    <script src="{{ asset('') }}front/js/metisMenu.min.js "></script>
    <script src="{{ asset('') }}front/js/custom.js "></script>
    <script src="{{ asset('') }}front/js/lightslider.min.js "></script>
    @include('front.layouts.error')

    @stack('scripts')
    </body>

</html>
