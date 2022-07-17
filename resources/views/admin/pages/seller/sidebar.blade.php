<div class="col-lg-3 col-md-4">

    <div class="ibox">
        <div class="ibox-body text-center">
            <div class="m-t-20">
                @if(isset($seller->image))
                <img class="img-circle" src="{{asset('')}}uploads/sellers/{{$seller->image}}" alt="{{ucwords($seller->name)}}" />
                @else
                <img class="img-circle" src="{{asset('')}}logo.jpg" />
                @endif
            </div>
            <h5 class="font-strong m-b-10 m-t-10">{{ucwords($seller->company_name)}}</h5>
            <input type="hidden" name="seller_id" id="seller_id" value="{{$seller->id}}">
            <div class="m-b-20 text-muted">{{$seller->email}}</div>
            <div class="m-b-20 text-muted">{{$seller->company_phone}}</div>
            <div class="m-b-20 text-muted">Join Date:: {{ date('M d, Y',strtotime($seller->created_at)) }}</div>

            <div>
                <a href="{{ route('admin.seller.order-history', $seller->id) }}" class="btn btn-default btn-rounded m-b-5"> Order list</a>
                <a href="{{ route('admin.seller.cancel-history', $seller->id) }}" class="btn btn-default btn-rounded m-b-5">Cancel list</a>
            </div>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-body">
            <div class="row text-center m-b-20">
                <div class="col-4">
                    <div class="text-muted">Product</div>
                    <div class="font-24 profile-stat-count">{{$totalProduct}}</div>
                </div>
                <div class="col-4">
                    <div class="text-muted"> Earning</div>
                    <div class="font-24 profile-stat-count">{{$totalEarning}}</div>
                </div>
                <div class="col-4">
                    <div class="text-muted"> Payout</div>
                    <div class="font-24 profile-stat-count">{{round($totalPayout,0)}}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-body">
            <div class="row text-center m-b-20">
                <div class="col-4">
                    <div class="text-muted">Delivered</div>
                    <div class="font-24 profile-stat-count">{{$totalDelivered}}</div>
                </div>
                <div class="col-4">
                    <div class="text-muted"> Returned</div>
                    <div class="font-24 profile-stat-count">{{$totalReturned}}</div>
                </div>
                <div class="col-4">
                    <div class="text-muted"> Cancelled</div>
                    <div class="font-24 profile-stat-count">{{$totalCancelled}}</div>
                </div>
            </div>
        </div>
    </div>
</div>