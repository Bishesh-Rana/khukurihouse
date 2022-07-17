<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{asset('')}}uploads/sellers/{{Auth::guard('seller')->user()->image}}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{Auth::guard('seller')->user()->company_name}}</div><small>Seller</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{ route('seller.dashboard') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            
            <li class="heading">MANAGEMENT</li>
            <li>
                <a href="{{route('product.seller',Auth::guard('seller')->user()->seller_code)}}" target="_blank"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Visit Store Page</span></a>

            </li>
            @if(auth()->guard('seller')->user()->parent_id == null)
            <li>
                <a href="{{ route('seller.form.edit')}}"><i class="sidebar-item-icon fa fa-address-book-o"></i>
                    <span class="nav-label">Update Your Information</span></a>

            </li>

            </li>
            @endif
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                    <span class="nav-label">Products</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>

                        <a href="{{  route('seller.product.create') }}"><i class="fa fa-plus"></i> Add Product</a>
                    </li>
                    <li>
                        <a href="{{ route('seller.product.index')}}"><i class="fa fa-circle"></i> Products List</a>
                    </li>

                    <li>
                        <a href="{{ route('seller.product.manageproduct.image.list')}}"><i class="fa fa-file-image-o"></i> Manage Image</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-money"></i>
                    <span class="nav-label">Finance</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ URL::route('seller.view.transaction.overview') }}"><i class="fa fa-money"></i> Transaction Overview </a>
                    </li>
                    <li>
                        <a href="{{ route('seller.financial.overview')}}"><i class="fa fa-money"></i> Financial Overview</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{url('/ns-seller/stocks')}}"><i class="sidebar-item-icon fa fa-archive"></i>
                    <span class="nav-label">Stock</span></a>
            </li>

            <li>
                <a href="{{ route('seller.order.pending') }}"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                    <span class="nav-label">Orders</span></a>
                {{-- <ul class="nav-2-level collapse">
                    <li>
                        
                        <a href="{{ route('seller.order.pending') }}"><i class="fa fa-plus"></i>Pending Orders</a>
            </li>



            <li>
                <a href="{{ route('seller.order.ready.shipping.list') }}"><i class="fa fa-plus"></i>Ready For Shipping</a>
            </li>

            <li>

                <a href="{{ route('seller.order.shipped.list') }}"><i class="fa fa-plus"></i>Shipped Orders</a>
            </li>

            <li>

                <a href="{{ route('seller.order.delivered.list') }}"><i class="fa fa-plus"></i>Delievered Order</a>
            </li>

            <li>

                <a href="{{ route('seller.order.cancel.delivered.list') }}"><i class="fa fa-plus"></i>Cancelled Delivery Order</a>
            </li>

        </ul> --}}
        </li>

        <li>
            <a href="{{ route('seller.review.list') }}"><i class="sidebar-item-icon fa fa-archive"></i>
                <span class="nav-label">Review</span></a>
        </li>

        <li>
            <a href="{{ route('seller.mailbox.list') }}"><i class="sidebar-item-icon fa fa-archive"></i>
                <span class="nav-label">MailBox</span></a>
        </li>

        @if(auth()->guard('seller')->user()->parent_id == null)
        <li>
            <a href="javascript:;"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                <span class="nav-label">Staff</span><i class="fa fa-angle-left arrow"></i></a>
            <ul class="nav-2-level collapse">
                <li>

                    <a href="{{  route('staff.create') }}"><i class="fa fa-plus"></i> Add Staff</a>
                </li>
                <li>
                    <a href="{{ route('staff.index')}}"><i class="fa fa-circle"></i> Staff List</a>
                </li>
            </ul>
        </li>
        @endif
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->