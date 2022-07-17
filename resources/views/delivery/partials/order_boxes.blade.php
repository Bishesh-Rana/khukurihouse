@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

<div class="row">
    <div class="col-lg-2">
      <a href="{{ route('delivery.order.pending') }}">
      <div class="color-view bg-primary order-boxes">
        <h5> Ready To shipped </h5>
      </div></a>
    </div>

  <div class="col-lg-2">
    <a href="{{ route('delivery.order.shipped.list') }}">
      <div class="color-view bg-primary  order-boxes">
        <h5> Shipped </h5>   
      </div>
    </a>
  </div>

  <div class="col-lg-2">
    <a href="{{ route('delivery.order.delivered.list') }}">
      <div class="color-view bg-primary  order-boxes">
        <h5>Delievered </h5>    
      </div>
    </a>
  </div>

  <div class="col-lg-2">
    <a href="{{ route('delivery.order.failed.list') }}">
      <div class="color-view bg-primary  order-boxes">
        <h5> Fail Delivery </h5>
      </div>
    </a>
  </div>
      </div>

  <ol class="breadcrumb">
      <li class="breadcrumb-item">
          <a href="index.html"><i class="la la-home font-20"></i></a>
      </li>
  </ol>
</div>