<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{asset('')}}uploads/deliveries/{{Auth::guard('delivery')->user()->image}}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{Auth::guard('delivery')->user()->first_name}}</div><small>Delivery</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
            <a class="active" href="{{ route('delivery.dashboard') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">MANAGEMENT</li>
            <li>
                <a href="{{url('/')}}" target="_blank"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Visit Website</span></a>
                    
                </li>
            @if(auth()->guard('delivery')->user()->parent_id == null)
            <li>
                <a href="{{ route('delivery.form.edit')}}"><i class="sidebar-item-icon fa fa-address-book-o"></i>
                    <span class="nav-label">Update Your Information</span></a>
                    
                </li>
            </li>
            @endif 
                
            <li>
                <a href="#"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                <span class="nav-label">Orders</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        
                        <a href="{{route('delivery.order.pending')}}">Pending Orders</a>
                    </li>
                    
                    <li>
                        
                        <a href="{{route('delivery.order.shipped.list')}}">Shipped Orders</a>
                    </li>
                    
                    <li>
                        
                        <a href="{{route('delivery.order.delivered.list')}}">Delievered Order</a>
                    </li>
                    
                    <li>
                        
                        <a href="{{route('delivery.order.failed.list')}}">Cancelled Delivery Order</a>
                    </li>
                    
                </ul>
            </li>

            <li>
            <a href="javascript:;"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                <span class="nav-label">Sales Return</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{  route('delivery.sales.return.create') }}"><i class="fa fa-plus"></i> Add Sales Return</a>
                    </li>
                    <li>
                        <a href="{{ route('delivery.sales.return.index')}}"><i class="fa fa-circle"></i> Sales Return List</a>
                    </li>
                </ul>
            </li>

            <li>
            <a href="javascript:;"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                <span class="nav-label">Delivery Setting</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{  route('delivery.deliverysetting.create') }}"><i class="fa fa-plus"></i> Add Delivery Setting</a>
                    </li>
                    <li>
                        <a href="{{ route('delivery.deliverysetting.list')}}"><i class="fa fa-circle"></i> Delivery Setting List</a>
                    </li>
                </ul>
            </li>

            @if(auth()->guard('delivery')->user()->parent_id == null)
            <li>
            <a href="javascript:;"><i class="sidebar-item-icon fa fa-product-hunt"></i>
                <span class="nav-label">Staff</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        
                        <a href="{{  route('delivery.staff.create') }}"><i class="fa fa-plus"></i> Add Staff</a>
                    </li>
                    <li>
                        <a href="{{ route('delivery.staff.index')}}"><i class="fa fa-circle"></i> Staff List</a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->