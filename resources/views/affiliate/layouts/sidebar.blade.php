<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{asset('')}}uploads/affiliates/{{Auth::guard('affiliate')->user()->image}}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{Auth::guard('affiliate')->user()->first_name}}</div><small>Affiliate</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{ route('affiliate.dashboard') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">MANAGEMENT</li>
            <li>
                <a href="{{url('/')}}" target="_blank"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Visit Website</span></a>

            </li>

            <li>
                <a href="{{ route('affiliate.product.index') }}"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                    <span class="nav-label">View All Products</span>
                </a>
            </li>

            <li>
                <a href="{{ route('affiliate.product.sold') }}"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                    <span class="nav-label">Sold Products</span>
                </a>
            </li>

            <li>
                <a href="{{ route('affiliate.product.cancelled') }}"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                    <span class="nav-label">Cancelled Products</span>
                </a>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-money"></i>
                    <span class="nav-label">Finance</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ URL::route('affiliate.view.transaction.overview') }}"><i class="fa fa-money"></i> Transaction Overview </a>
                    </li>
                    <li>
                        <a href="{{ route('affiliate.financial.overview')}}"><i class="fa fa-money"></i> Financial Overview</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->