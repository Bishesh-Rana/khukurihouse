<div class="col-lg-3 col-md-4">
    <div class="ibox">
        <div class="ibox-body text-center">
            <div class="m-t-20">
                @if(isset($customer->image))
                <img class="img-circle" src="{{asset('')}}uploads/customers/{{$customer->image}}" alt="{{ucwords($customer->name)}}" />
                @else
                <img class="img-circle" src="{{asset('')}}logo.jpg" />
                @endif
            </div>
            <h5 class="font-strong m-b-10 m-t-10">{{ucwords($customer->name)}}</h5>
            <input type="hidden" name="customer_id" id="customer_id" value="{{$customer->id}}">
            <div class="m-b-20 text-muted">{{$customer->email}}</div>
            <div class="m-b-20 text-muted">{{$customer->phone}}</div>
            <div class="m-b-20 text-muted">Join Date:: {{ date('M d, Y',strtotime($customer->created_at)) }}</div>

            <div>
                <a href="{{ route('admin.customer.purchase-history', $customer->id) }}" class="btn btn-default btn-rounded m-b-5"> Purchase list</a>
                <a href="{{ route('admin.customer.cancel-history', $customer->id) }}" class="btn btn-default btn-rounded m-b-5">Cancel list</a>
            </div>
        </div>
    </div>

</div>