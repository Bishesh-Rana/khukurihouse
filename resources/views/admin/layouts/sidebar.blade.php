<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('') }}uploads/admins/{{ Auth::guard('admin')->user()->image }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ Auth::guard('admin')->user()->name }}</div>
                <small>{{ config('app.name') }}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{ url('/ns-admin') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">MANAGEMENT</li>
            <li>
                <a href="{{ url('/') }}" target="_blank"><i class="sidebar-item-icon fa fa-home"></i>
                    <span class="nav-label">Visit Website</span></a>

            </li>
            @if (auth()->guard('admin')->user()->can('browse_role'))
                <li>
                    <a href="{{ url('/ns-admin/roles') }}"><i class="sidebar-item-icon fa fa-bookmark"></i>
                        <span class="nav-label">Roles</span></a>
                </li>
            @endif
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-user-plus"></i>
                    <span class="nav-label">Customers</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    {{-- @if (auth()->guard('admin')->user()->can('create_seller'))
                        <li>
                            <a href="{{ url('ns-admin/sellers/create') }}"><i class="sidebar-item-icon fa fa-plus"></i>
                                Add New Seller</a>
                        </li>
                    @endif
                    @if (auth()->guard('admin')->user()->can('browse_seller'))
                        <li>
                            <a href="{{ url('ns-admin/sellers') }}"><i class="sidebar-item-icon fa fa-circle"></i>
                                Seller List</a>
                        </li>
                    @endif --}}
                    {{-- @if (auth()->guard('admin')->user()->can('create_delivery'))
                        <li>
                            <a href="{{ url('ns-admin/deliveries/create') }}"><i
                                    class="sidebar-item-icon fa fa-plus"></i> Add New Delivery</a>
                        </li>
                    @endif
                    @if (auth()->guard('admin')->user()->can('browse_delivery'))
                        <li>
                            <a href="{{ url('ns-admin/deliveries') }}"><i class="sidebar-item-icon fa fa-circle"></i>
                                Delivery List</a>
                        </li>
                    @endif --}}
                    {{-- @if (auth()->guard('admin')->user()->can('browse_affiliate'))
                        <li>
                            <a href="{{ url('ns-admin/affiliates') }}"><i class="sidebar-item-icon fa fa-circle"></i>
                                Affiliate List</a>
                        </li>
                    @endif --}}
                    @if (auth()->guard('admin')->user()->can('browse_customer'))
                        <li>
                            <a href="{{ route('admin.customer.list') }}"><i
                                    class="sidebar-item-icon fa fa-circle"></i> Customer List</a>
                        </li>
                    @endif
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-globe"></i>
                    <span class="nav-label">Website Management</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    @if (auth()->guard('admin')->user()->can('browse_content'))
                        <li>
                            <a href="{{ url('ns-admin/contents') }}"><i class="sidebar-item-icon fa fa-globe"></i>
                                Contents</a>
                        </li>
                    @endif
                    @if (auth()->guard('admin')->user()->can('browse_slider'))
                        <li>
                            <a href="{{ url('ns-admin/sliders') }}"><i class="sidebar-item-icon fa fa-image"></i>
                                Sliders</a>
                        </li>
                    @endif
                    @if (auth()->guard('admin')->user()->can('browse_advertisement'))
                        <li>
                            <a href="{{ url('ns-admin/advertisements') }}"><i
                                    class="sidebar-item-icon fa fa-flag-o"></i> Advertisements</a>
                        </li>
                    @endif
                    {{-- @if (auth()->guard('admin')->user()->can('browse_brand'))
                        <li>
                            <a href="{{ url('ns-admin/brands') }}"><i class="sidebar-item-icon fa fa-apple"></i>
                                Brands</a>
                        </li>
                    @endif --}}

                </ul>
            </li>
            @if (auth()->guard('admin')->user()->can('browse_category'))
                <!-- <li>
                        <a href="{{ url('/ns-admin/measures') }}"><i class="sidebar-item-icon fa fa-archive"></i>
                            <span class="nav-label">Measures</span></a>
                    </li> -->
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-sitemap"></i>
                        <span class="nav-label">Product Category</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a href="{{ url('ns-admin/categories/create') }}"><i
                                    class="sidebar-item-icon fa fa-plus"></i> Add Category</a>
                        </li>
                        <li>
                            <a href="{{ url('ns-admin/categories') }}"><i class="sidebar-item-icon fa fa-circle"></i>
                                Categories List</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('browse_product'))
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                        <span class="nav-label">Products</span><i class="fa fa-angle-left arrow"></i>
                    </a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a href="{{ url('ns-admin/products/create') }}">
                                <i class="sidebar-item-icon fa fa-plus"></i>Add Product
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('ns-admin/products') }}">
                                <i class="sidebar-item-icon fa fa-circle"></i>Products List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product.manageproduct.image.list') }}">
                                <i class="sidebar-item-icon fa fa-image"></i>Manage Images
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/ns-admin/stocks') }}">
                                <i class="sidebar-item-icon sidebar-item-icon fa fa-archive"></i>Stocks
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('flash-sale.index') }}">
                                <i class="sidebar-item-icon sidebar-item-icon fa fa-bolt"></i>Flash Sale
                            </a>
                        </li>
                    </ul>
                </li>

                @if (auth()->guard('admin')->user()->can('browse_delivery_setting'))
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-truck"></i>
                            <span class="nav-label">Delivery Service
                                Area</span><i
                                class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            @if (auth()->guard('admin')->user()->can('create_delivery_setting'))
                            <li>
                                <a href="{{ route('deliveryServiceArea.create') }}"><i
                                        class="sidebar-item-icon fa fa-plus"></i> Add Area</a>
                            </li>

                            @endif
                            @if (auth()->guard('admin')->user()->can('browse_delivery_setting'))
                                <li>
                                    <a href="{{ route('deliveryServiceArea.index') }}"><i
                                            class="sidebar-item-icon fa fa-circle"></i> Area List</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (auth()->guard('admin')->user()->can('browse_coupon'))
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-tasks"></i>
                            <span class="nav-label">Coupons</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            @if (auth()->guard('admin')->user()->can('create_coupon'))
                                <li>
                                    <a href="{{ route('admin.coupon.create') }}"><i
                                            class="sidebar-item-icon fa fa-plus"></i> Add Coupon</a>
                                </li>
                            @endif
                            @if (auth()->guard('admin')->user()->can('browse_coupon'))
                                <li>
                                    <a href="{{ route('admin.coupon.index') }}"><i
                                            class="sidebar-item-icon fa fa-circle"></i> Coupon List</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-download"></i>
                        <span class="nav-label">Orders</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a href="{{ route('admin.list.admin.order') }}"><i
                                    class="sidebar-item-icon fa fa-shopping-cart"></i> Order List</a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('admin.list.seller.order') }}"><i
                                    class="sidebar-item-icon fa fa-shopping-cart"></i> Seller Order
                                List</a>
                        </li> --}}
                        <li>
                            <a href="javascript:;"><i class="sidebar-item-icon fa fa-cart-plus"></i>
                                <span class="nav-label">Order Placement</span><i
                                    class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-3-level collapse">
                                {{-- <li>
                                    <a href="{{ route('admin.update.order.list') }}"><i
                                            class="sidebar-item-icon fa fa-cart-plus"></i> Updated Order</a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('admin.cancelled.order.list') }}"><i
                                            class="sidebar-item-icon fa fa-cart-plus"></i> Order
                                        Cancelled</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

            @endif

            @if (auth()->guard('admin')->user()->can('browse_news'))
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-newspaper-o"></i>
                        <span class="nav-label">News</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        @if (auth()->guard('admin')->user()->can('browse_news_category'))
                            <li>
                                <a href="{{ url('ns-admin/newsCategories') }}"><i
                                        class="sidebar-item-icon fa fa-sitemap"></i> Categories</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('ns-admin/news') }}"><i class="sidebar-item-icon fa fa-file"></i> News</a>
                        </li>
                        <li>
                            <a href="{{ url('ns-admin/tags') }}"><i class="sidebar-item-icon fa fa-tag"></i> News
                                Tags</a>
                        </li>
                        <li>
                            <a href="{{ url('ns-admin/writers') }}"><i class="sidebar-item-icon fa fa-user"></i> News
                                Writers</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('browse_admin'))
                <li>
                    <a href="{{ url('ns-admin/admins') }}"><i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">User Management</span></a>
                </li>
            @endif
            @if (auth()->guard('admin')->user()->can('browse_setting'))
                <li>
                    <a href="{{ url('ns-admin/settings') }}"><i class="sidebar-item-icon fa fa-cogs"></i>
                        <span class="nav-label">Settings</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->can('browse_admin'))
                <li>
                    <a href=""><i class="sidebar-item-icon fa fa-envelope"></i>
                        <span class="nav-label">Mails</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a href="{{ url('ns-admin/subscribers') }}"><i class="sidebar-item-icon fa fa-users"></i>
                                Subscribers</a>
                        </li>
                        <li>
                            <a href="{{ url('ns-admin/contacts') }}"><i class="sidebar-item-icon fa fa-users"></i>
                                Contacts</a>
                        </li>

                    </ul>
                </li>
            @endif

            {{-- @if (auth()->guard('admin')->user()->can('browse_push_notification'))
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-bell-o"></i>
                        <span class="nav-label">Push Notification</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        @if (auth()->guard('admin')->user()->can('create_push_notification'))
                            <li>
                                <a href="{{ url('ns-admin/pushnotifications/create') }}"><i
                                        class="sidebar-item-icon fa fa-plus"></i> Add Notification</a>
                            </li>
                        @endif
                        @if (auth()->guard('admin')->user()->can('browse_push_notification'))
                            <li>
                                <a href="{{ url('ns-admin/pushnotifications') }}"><i
                                        class="sidebar-item-icon fa fa-circle"></i> Notifications List</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif --}}
            <!-- sales return -->
            {{-- @if (auth()->guard('admin')->user()->can('browse_sales_return'))
                <li>
                    <a href="{{ route('admin.sales.return.index') }}"><i class="sidebar-item-icon fa fa-undo"></i>
                        <span class="nav-label">Sales Return</span></a>
                </li>
            @endif --}}

            {{-- @if (auth()->guard('admin')->user()->can('browse_statement'))
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-money"></i>
                        <span class="nav-label">Seller Finance</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a href="{{ route('admin.view.transaction.overview') }}"><i
                                    class="sidebar-item-icon fa fa-plus"></i>
                                Transaction Overview
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.financial.statement') }}"><i
                                    class="sidebar-item-icon fa fa-circle"></i>
                                Financial Statement
                            </a>
                        </li>

                    </ul>
                </li>
            @endif --}}
{{--
            @if (auth()->guard('admin')->user()->can('browse_affiliate_statement'))
                <li>
                    <a href="javascript:;"><i class="sidebar-item-icon fa fa-money"></i>
                        <span class="nav-label">Associate Finance</span><i
                            class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a href="{{ route('admin.view.affiliate.transaction.overview') }}">
                                <i class="sidebar-item-icon fa fa-plus"></i>Transaction Overview
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.affiliate.financial.statement') }}">
                                <i class="sidebar-item-icon fa fa-circle"></i> Financial Statement
                            </a>
                        </li>
                    </ul>
                </li>
            @endif --}}

        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->
