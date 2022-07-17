@section('title')

Dashboard | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    {{-- <h5 class="center">USERS</h5>
    <hr>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-pink-300 color-white widget-stat">
                <a href="{{ route('seller.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_sellers }}</h2>
                        <div class="m-b-5">Total SELLERS</div><i class="ti-user widget-stat-icon"></i>
                        <div><i class="fa fa-sun-o m-r-5"></i>{{ $total_holiday_sellers }} On Holiday</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-teal color-white widget-stat">
                <a href="{{ route('delivery.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_deliveries }}</h2>
                        <div class="m-b-5">Total DELIVERIES</div><i class="ti-truck widget-stat-icon"></i>
                        <div><i class="fa fa-check-circle m-r-5"></i>{{ $total_active_deliveries }} Active</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <a href="{{ route('affiliate.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_affiliates }}</h2>
                        <div class="m-b-5">Total AFFILIATES</div><i class="ti-user widget-stat-icon"></i>
                        <div><i class="fa fa-check-circle m-r-5"></i>{{ $total_active_affiliates }} Active</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-ebony-400 color-white widget-stat">
                <a href="{{ route('admin.customer.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_customers }}</h2>
                        <div class="m-b-5">Total CUSTOMERS</div><i class="ti-user widget-stat-icon"></i>
                        <div><i class="fa fa-check-circle m-r-5"></i>{{ $total_verified_customers }} Verified</div>
                    </div>
                </a>
            </div>
        </div>
    </div> --}}

    <h5 class="center">PRODUCTS</h5>
    <hr>
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <a href="{{ route('category.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_categories }}</h2>
                        <div class="m-b-5">Total CATEGORIES</div><i class="ti-panel widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i>{{ $total_parent_categories }} Root Categories</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <a href="{{ route('product.index')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_products }}</h2>
                        <div class="m-b-5">Total PRODUCTS</div><i class="ti-package widget-stat-icon"></i>
                        <div><i class="fa fa-home m-r-5"></i>{{ $total_in_house_products }} In House</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-purple-400 color-white widget-stat">
                <a href="{{ route('admin.stock.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_remaining_stocks }}</h2>
                        <div class="m-b-5">Total STOCKS</div><i class="ti-archive widget-stat-icon"></i>
                        <div><i class="fa fa-truck m-r-5"></i>{{ $total_delivered_stocks }} Delivered</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-yellow-700 color-white widget-stat">
                <a href="{{ route('admin.product.manageproduct.image.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_photos }}</h2>
                        <div class="m-b-5">Total PRODUCT IMAGES</div><i class="ti-image widget-stat-icon"></i>
                        <div><i class="fa fa-picture-o m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <h5 class="center">ORDERS</h5>
    <hr>
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-teal-400 color-white widget-stat">
                <a href="{{ route('admin.list.admin.order')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $admin_pending_orders }}</h2>
                        <div class="m-b-5">Pending ORDERS</div><i class="ti-import widget-stat-icon"></i>
                        <div><i class="fa fa-truck m-r-5"></i>{{ $admin_shipped_orders }} Orders Shipped</div>
                    </div>
                </a>
            </div>
        </div>

        {{-- <div class="col-lg-3 col-md-6">
            <div class="ibox bg-primary color-white widget-stat">
                <a href="{{ route('admin.list.seller.order')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_seller_orders }}</h2>
                        <div class="m-b-5">Total SELLER ORDERS</div><i class="ti-shopping-cart widget-stat-icon"></i>
                        <div><i class="fa fa-share m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div> --}}

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-ebony-300 color-white widget-stat">
                <a href="{{ route('admin.order.delivered.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $admin_delivered_orders }}</h2>
                        <div class="m-b-5">Orders DELIVERED</div><i class="ti-truck widget-stat-icon"></i>
                        <div><i class="fa fa-money m-r-5"></i>{{ $admin_paid_orders }} Paid</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <a href="{{ route('admin.order.cancel.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $admin_cancelled_orders }}</h2>
                        <div class="m-b-5">Orders CANCELLED</div><i class="ti-share-alt widget-stat-icon"></i>
                        <div><i class="fa fa-share m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <h5 class="center">NEWS</h5>
    <hr>
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-yellow-700 color-white widget-stat">
                <a href="{{ route('news.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_news }}</h2>
                        <div class="m-b-5">Total NEWS</div><i class="ti-layout-accordion-list widget-stat-icon"></i>
                        <div><i class="fa fa-share m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-pink-300 color-white widget-stat">
                <a href="{{ route('tags.list')}}">

                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_tags }}</h2>
                        <div class="m-b-5">Total NEWS TAGS</div><i class="ti-tag widget-stat-icon"></i>
                        <div><i class="fa fa-share m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <a href="{{ route('newscategory.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_newscategory }}</h2>
                        <div class="m-b-5">Total NEWS CATEGORY</div><i class="ti-menu-alt widget-stat-icon"></i>
                        <div><i class="fa fa-share m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <a href="{{ route('writter.list')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_writer }}</h2>
                        <div class="m-b-5">Total WRITERS</div><i class="ti-write widget-stat-icon"></i>
                        <div><i class="fa fa-share m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <h5 class="center">SETTINGS</h5>
    <hr>
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-grey color-white widget-stat">
                <a href="{{ url('ns-admin/settings')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{}</h2>
                        <div class="m-b-5">SETTINGS</div><i class="ti-settings widget-stat-icon"></i>
                        <div><i class="fa fa-cog m-r-5"></i></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-purple-400 color-white widget-stat">
                <a href="{{ url('ns-admin/admins')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_admins }}</h2>
                        <div class="m-b-5">Total ADMINS</div><i class="ti-user widget-stat-icon"></i>
                        <div><i class="fa fa-user m-r-5"></i>{{ $total_active_admins }} Active</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <a href="{{ url('ns-admin/contacts')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_contacts }}</h2>
                        <div class="m-b-5">Total CONTACTS</div><i class="ti-user widget-stat-icon"></i>
                        <div><i class="fa fa-user m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-teal color-white widget-stat">
                <a href="{{ url('ns-admin/subscribers')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{ $total_subscribers }}</h2>
                        <div class="m-b-5">Total SUBSCRIBERS</div><i class="ti-user widget-stat-icon"></i>
                        <div><i class="fa fa-user m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <style>
        .visitors-table tbody tr td:last-child {
            display: flex;
            align-items: center;
        }

        .visitors-table .progress {
            flex: 1;
        }

        .visitors-table .progress-parcent {
            text-align: right;
            margin-left: 10px;
        }

        .center{
            text-align: center;
        }
    </style>

</div>
<!-- END PAGE CONTENT-->

@stop
