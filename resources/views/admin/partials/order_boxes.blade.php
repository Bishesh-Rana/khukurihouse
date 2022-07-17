@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

<div class="row">
    <div class="col-lg-2">
      <a href="{{ route('admin.list.admin.order') }}">
      <div class="color-view bg-primary order-boxes">
        <h5> Pending </h5>
      </div></a>
  </div>

  <div class="col-lg-2">
    <a href="{{ route('admin.order.ready.shipping.list') }}">
      <div class="color-view bg-primary  order-boxes">
        <h5>Ready For Ship </h5> 
      </div></a>
  </div>

  <div class="col-lg-2">
    <a href="{{ route('admin.order.shipped.list') }}">
      <div class="color-view bg-primary  order-boxes">
        <h5> Shipped </h5>   
      </div>
    </a>
  </div>

  <div class="col-lg-2">
    <a href="{{ route('admin.order.delivered.list') }}">
      <div class="color-view bg-primary  order-boxes">
        <h5>Delievered </h5>    
      </div>
    </a>
  </div>

  <div class="col-lg-2">
    <a href="{{ route('admin.order.cancel.list') }}">
    <div class="color-view bg-primary  order-boxes">
    <h5> Order Cancelled </h5>
    </div></a>
</div>
      </div>

  <ol class="breadcrumb">
      <li class="breadcrumb-item">
          <a href="#"><i class="la la-home font-20"></i></a>
      </li>
  </ol>
</div>