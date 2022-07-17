<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('')}}admincast/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{asset('')}}admincast/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{asset('')}}admincast/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{asset('')}}admincast/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('')}}admincast/assets/vendors/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" />
    <link href="{{asset('')}}admincast/assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <link href="{{asset('')}}admincast/assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="{{asset('')}}admincast/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- {{-- <link href="{{asset('')}}admincast/assets/vendors/DataTables/datatables.min.css" rel="stylesheet" /> --}} -->
    <link href="{{asset('')}}admincast/assets/lobibox/dist/css/lobibox.min.css" rel="stylesheet">
    <link href="{{asset('')}}admincast/assets/vendors/summernote/dist/summernote.css" rel="stylesheet" />

    <!-- THEME STYLES-->
    <link href="{{asset('')}}admincast/assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    <link rel="shortcut icon" href="{{asset('')}}uploads/settings/{{$setting->site_mini_logo}}">

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
    @yield('custom-css')
    @yield('header')
</head>

<style>
    a {
        text-decoration: none;
        color: white;
    }

    a:hover {
        color: white;
    }
</style>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="javascript:void()">
                    <span class="brand">
                        @if(isset($setting->site_logo))
                        <img src="{{asset('')}}uploads/settings/{{$setting->site_logo}}" width="90%" height="90%" alt="{{$setting->site_name}}">
                        @else
                        {{$setting->site_name}}
                        @endif
                    </span>
                    <span class="brand-mini"><img src="{{asset('')}}uploads/settings/{{$setting->site_mini_logo}}" alt="{{ config('app.name') }}"></span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <!-- <li>
                        <form class="navbar-search" action="javascript:;">
                            <div class="rel">
                                <span class="search-icon"><i class="ti-search"></i></span>
                                <input class="form-control" placeholder="Search here...">
                            </div>
                        </form>
                    </li> -->
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">


                       {{-- notification of seller newly added product --}}
                       <li class="dropdown dropdown-inbox">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i>
                            <span class="badge badge-primary envelope-badge">{{(count($delivery_all_notify) > 0) ? $delivery_all_notify->count() : '' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">


                            <li class="dropdown-menu-header">
                                <div>
                                    <span><strong>{{$delivery_all_notify->count()}} Newly Assigned</strong> Orders</span>

                                {{-- <a class="pull-right" href="{{ route('product.index') }}">view all</a> --}}
                                </div>
                            </li>
                            @if(count($delivery_all_notify) > 0)
                            <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                                <div>
                                    @foreach($delivery_all_notify as $row)
                                <a class="list-group-item" style="color: black;" href="{{ route('deliveryassign.notification.update',[$row->ref_id]) }}">
                                        <div class="media">
                                            <div class="media-img">
                                                <span class="badge badge-success badge-big"><i class="fa fa-envelope"></i></span>
                                            </div>
                                            <div class="media-body">

                                                <div class="font-strong"> </div>{{$row->ref_id}}<small class="text-muted float-right">{{$row->created_at->diffForHumans()}}</small>
                                                {{-- <div class="font-13">{{$contact->contact_email}}</div> --}}
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </li>
                            @endif

                        </ul>
                    </li>

                    {{--/. notification of seller newly added product --}}

                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                           @if(isset(Auth::guard('delivery')->user()->image))
                            <img src="{{asset('')}}uploads/deliveries/{{Auth::guard('delivery')->user()->image}}" />
                            @endif
                            <span></span>{{Auth::guard('delivery')->user()->first_name}}<i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            @php
                            if(Auth::guard('delivery')->user()->parent_id !=''){
                                $path = route('delivery.staff.profile.show');
                            }
                            else{
                                $path = route('delivery.profile.show');
                            }
                            @endphp
                            <a class="dropdown-item" href=" {{ $path }} "><i class="fa fa-user"></i>Profile</a>
                            <!-- <a class="dropdown-item" href="profile.html"><i class="fa fa-cog"></i>Settings</a>
                            <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a> -->
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="{{url('ns-delivery/logout')}}"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        @include('delivery.layouts.sidebar')
        <div class="content-wrapper">
            @yield('content')
            <footer class="page-footer">
                <div class="font-13">{{date('Y')}} © <b>@if(isset($setting)) {{$setting->site_name}} @else env('APP_NAME') @endif</b> - All rights reserved.</div>
                <a class="px-4" href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589" target="_blank">BUY PREMIUM</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <div class="theme-config">
        <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
        <div class="theme-config-box">
            <div class="text-center font-18 m-b-20">SETTINGS</div>
            <div class="font-strong">LAYOUT OPTIONS</div>
            <div class="check-list m-b-20 m-t-10">
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedNavbar" type="checkbox" checked>
                    <span class="input-span"></span>Fixed navbar</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedlayout" type="checkbox">
                    <span class="input-span"></span>Fixed layout</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input class="js-sidebar-toggler" type="checkbox">
                    <span class="input-span"></span>Collapse sidebar</label>
            </div>
            <div class="font-strong">LAYOUT STYLE</div>
            <div class="m-t-10">
                <label class="ui-radio ui-radio-gray m-r-10">
                    <input type="radio" name="layout-style" value="" checked="">
                    <span class="input-span"></span>Fluid</label>
                <label class="ui-radio ui-radio-gray">
                    <input type="radio" name="layout-style" value="1">
                    <span class="input-span"></span>Boxed</label>
            </div>
            <div class="m-t-10 m-b-10 font-strong">THEME COLORS</div>
            <div class="d-flex m-b-20">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Default">
                    <label>
                        <input type="radio" name="setting-theme" value="default" checked="">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-white"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue">
                    <label>
                        <input type="radio" name="setting-theme" value="blue">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green">
                    <label>
                        <input type="radio" name="setting-theme" value="green">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple">
                    <label>
                        <input type="radio" name="setting-theme" value="purple">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange">
                    <label>
                        <input type="radio" name="setting-theme" value="orange">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink">
                    <label>
                        <input type="radio" name="setting-theme" value="pink">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="White">
                    <label>
                        <input type="radio" name="setting-theme" value="white">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue light">
                    <label>
                        <input type="radio" name="setting-theme" value="blue-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green light">
                    <label>
                        <input type="radio" name="setting-theme" value="green-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple light">
                    <label>
                        <input type="radio" name="setting-theme" value="purple-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange light">
                    <label>
                        <input type="radio" name="setting-theme" value="orange-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink light">
                    <label>
                        <input type="radio" name="setting-theme" value="pink-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    {{-- <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div> --}}
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{asset('')}}admincast/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

    <script src="{{asset('')}}admincast/assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/jquery-knob/dist/jquery.knob.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/lobibox/dist/js/notifications.min.js"></script>
    <script src="{{asset('')}}admincast/assets/vendors/summernote/dist/summernote.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{asset('')}}admincast/assets/js/app.min.js" type="text/javascript"></script>

    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{asset('')}}admincast/assets/js/scripts/form-plugins.js" type="text/javascript"></script>


    @yield('footer-count')
    @yield('footer')
    <!-- <script src="{{asset('')}}admincast/assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script> -->
    <!-- FOR DATA TABLES -->
    {{-- <script type="text/javascript">
        $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
                //"ajax": './assets/demo/data/table_data.json',
                /*"columns": [
                    { "data": "name" },
                    { "data": "office" },
                    { "data": "extn" },
                    { "data": "start_date" },
                    { "data": "salary" }
                ]*/
            });
        });
    </script> --}}

    <script type="text/javascript">
        $(function() {
            $('#summernote').summernote();
            $('#summernote_air').summernote({
                airMode: true
            });
        });
    </script>


</body>

</html>
