<aside>
    <div class="sidebar left ">
        <div class="side-toggle">
            <span>Customer Dashboard</span>
            <a href="#" class="button-left">
                <i class="las la-bars"></i>
            </a>
        </div>
        <ul class="list-sidebar bg-defoult">
            <li>
                <a href="{{route('customer.dashboard')}}" data-toggle="collapse" data-target="#dashboard" class="collapsed active">
                    <i class="las la-tachometer-alt"></i><span class="nav-label"> Dashboard </span>
                </a>
            </li>
            <li>
                <a href="{{route('customer.dashboard.profile')}}" class="<?php if ($active == "profile") echo 'collapsed active'; ?>">
                    <i class="las la-user-check"></i> <span class="nav-label">My Profile</span>
                </a>
            </li>
            <li>
                <a href="{{route('customer.dashboard.profile.edit',Auth::guard('web')->user()->id)}}" class="<?php if ($active == "editprofile") echo 'collapsed active'; ?>">
                    <i class="las la-edit"></i> <span class="nav-label">Edit Profile</span>
                </a>
            </li>
            {{-- <li>
            <a href="{{route('customer.dashboard.payment.edit',Auth::guard('web')->user()->id)}}" class="<?php if ($active == "payment") echo 'collapsed active'; ?>">
                <i class="las la-coins"></i> <span class="nav-label">My Payment Options</span>
                </a>
            </li> --}}
            <li>
                <a href="{{route('customer.dashboard.orders')}}" class="<?php if ($active == "orders") echo 'collapsed active'; ?>">
                    <i class="lab la-first-order"></i> <span class="nav-label">My Orders</span>
                </a>
            </li>
            <li>
                <a href="{{route('customer.dashboard.complete.orders')}}" class="<?php if ($active == "complete") echo 'collapsed active'; ?>">
                    <i class="las la-clipboard-check"></i> <span class="nav-label">My Completed Orders</span>
                </a>
            </li>
            <li>
                <a href="{{route('customer.dashboard.cancellations')}}" class="<?php if ($active == "cancellations") echo 'collapsed active'; ?>">
                    <i class="las la-recycle"></i> <span class="nav-label">My Cancellations</span>
                </a>
            </li>
            <!-- <li>
                <a href="#">
                    <i class="fa fa-star-o"></i> <span class="nav-label">Rate Your Purchase</span>
                </a>
            </li> -->
            <li>
                <a href="{{route('customer.dashboard.wishlist')}}" class="<?php if ($active == "wishlist") echo 'collapsed active'; ?>">
                    <i class="lab la-gratipay"></i> <span class="nav-label">My Wishlist</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{route('customer.dashboard.favourite.stores')}}">
                    <i class="fa fa-shopping-bag"></i> <span class="nav-label">My Favorite Stores</span>
                </a>
            </li> -->
            {{-- <li>
                <a href="{{route('customer.dashboard.vouchers')}}" class="<?php if ($active == "vouchers") echo 'collapsed active'; ?>">
                    <i class="las la-credit-card"></i> <span class="nav-label">Vouchers</span>
                </a>
            </li> --}}

            <!-- <li>
                <a href="{{route('customer.dashboard.returns')}}" >
                    <i class="fa fa-file-text-o"></i> <span class="nav-label">My Returns</span>
                </a>
            </li> -->
            {{-- <li>
                <a href="{{route('customer.dashboard.chat')}}" class="<?php if ($active == "chat") echo 'collapsed active'; ?>">
                    <i class="las la-comments"></i>
                    <span class="nav-label">My Chat</span>
                </a>
            </li> --}}
            {{-- <li>
                <a href="{{url('/contact#contact')}}" class="<?php if ($active == "feedback") echo 'collapsed active'; ?>">
                    <i class="lab la-rocketchat"></i> <span class="nav-label">My Feedback</span>
                </a>
            </li> --}}
            <li>
                <a href="{{route('customer.dashboard.support')}}" class="<?php if ($active == "support") echo 'collapsed active'; ?>">
                    <i class="las la-microphone"></i> <span class="nav-label">Help & Support</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{route('customer.dashboard.online.payment',Auth::guard('web')->user()->id)}}" class="<?php if ($active == "online-payment") echo 'collapsed active'; ?>">
                    <i class="fa fa-money"></i> <span class="nav-label">Online Payment</span>
                </a>
            </li> -->
            <li>
                <a href="{{route('customer.logout')}}">
                    <i class="las la-sign-out-alt"></i> <span class="nav-label">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>