<li class="dropdown dropdown-inbox">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bitbucket" aria-hidden="true"></i>
        <span
            class="badge badge-primary envelope-badge">{{ $order_notification->count() }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
        <li class="dropdown-menu-header">
            <div>
                <span><strong>{{ $order_notification->count() }} New</strong> order</span>
                <a class="pull-right" href="{{ route('admin.list.admin.order') }}">view all</a>
            </div>
        </li>

            <li class="list-group list-group-divider scroller" data-height="240px"
                data-color="#71808f">
                <div>
                    @foreach ($order_notification as $order)
                        <a class="list-group-item" style="color: black;"
                            href="">
                            <div class="media">
                                <div class="media-img">
                                    <span class="badge badge-success badge-big">  <i class="fa fa-bitbucket" aria-hidden="true"></i></span>
                                </div>
                                <div class="media-body">
                                    <div class="font-strong"> </div>
                                    {{ $order->product_name }}<small
                                        class="text-muted float-right">{{\Carbon::parse( $order->created_at)->diffForHumans() }}</small>
                                    <div class="font-13">{{ $order->quantity }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </li>

    </ul>
</li>
