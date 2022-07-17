@section('title')

Sales Return | {{env('APP_NAME')}}

@stop
@extends('delivery.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Sales Return</h1>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <?php if (isset($salesReturn)) {
                    echo "Edit Sales Return";
                } else {
                    echo "Add Sales Return";
                } ?>
            </div>
            <div class="ibox-tools">
                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="ibox-body">
            @include('delivery.layouts.error')
            <?php
            if (isset($salesReturn)) {
                $action = route('delivery.sales.return.update', $salesReturn->id);
                $button = 'Update';
            } else {
                $action = route('delivery.sales.return.add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Seller</label>
                            <select class="form-control select2_demo_1" id="seller" name="seller_id" required>
                                <option value="none" disabled @if(!isset($salesReturn)) selected @endif>Please select a seller</option>
                                @foreach($sellers as $row)
                                <option @if(isset($salesReturn) && $salesReturn->seller_id == $row->id) selected @endif
                                    value="{{ $row->id }}">{{ ucwords($row->company_name) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="product-form">
                            @if(isset($salesReturn))
                            <div class="form-group">
                                <label>Product</label>
                                <select class="form-control select2_demo_1" id="product" name="product_id" required>
                                    @foreach($products as $row)
                                    <option @if(isset($salesReturn) && $salesReturn->product_id == $row->id) selected
                                        @endif
                                        value="{{ $row->id }}">{{ ucwords($row->product_name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" class="form-control m-input" placeholder="Quantity" value="<?php if (isset($salesReturn->quantity)) {
                                                                                                                                    echo $salesReturn->quantity;
                                                                                                                                } else {
                                                                                                                                    echo old('quantity');
                                                                                                                                } ?>">
                            </div>

                            <div class="form-group">
                                <label>Order Number</label>
                                <input type="text" name="ref_id" class="form-control m-input" placeholder="Order Number" value="<?php if (isset($salesReturn->ref_id)) {
                                                                                                                                    echo $salesReturn->ref_id;
                                                                                                                                } else {
                                                                                                                                    echo old('ref_id');
                                                                                                                                } ?>">
                            </div>
                            @endif
                           
                        </div>
                    </div>

                </div>

                <button class="btn btn-info" type="submit">{{ $button }}</button>
                <a class="btn btn-warning" href="{{ route('delivery.sales.return.index')}}">Cancel</a>
            </form>
        </div>

    </div>
</div>
<!-- END PAGE CONTENT-->

@stop

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>

<script>
    $(document).ready(function() {
        $('#seller').on('change', function() {
            var data = {
                seller: $('#seller option:selected').val()
            }
            axios.post("{{route('delivery.get.product.from.seller')}}", data).then(res => {
                console.log(res.data);
                $('#product-form').html('');
                $('#product-form').html(res.data);
                $(".select2_demo_1").select2();
            })
        })
    });
</script>

@endsection