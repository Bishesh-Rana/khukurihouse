@section('title')

    Flash Sale | {{ env('APP_NAME') }}

@stop
@extends('admin.layouts.app')
@push('scripts')
    <script src="{{ asset('admincast/assets/js/scripts/axios.js') }}"></script>
    <script>
        $(document).ready(function() {
            getProduct();
            var url = "{{ route('productSearch') }}";
            $('#productName').on('input', function() {
                axios({
                        method: 'post',
                        url: url,
                        data: {
                            'productName': $(this).val(),
                        }
                    })
                    .then(response => $('#product').html(response.data))
            })

            $('#productName').on('focusout', function() {
                var value = $(this).val();
                var id = $("option[value=\"" + value + "\"]").first().attr('data-id');
                $('#productId').val(id);
                getProduct();
            })
        })

        function getProduct() {
            var productId = $('#productId').val();
            if (!productId) {
                return null;
            }
            var url = "{{ route('productDetail') }}";
            axios({
                    method: 'post',
                    url: url,
                    data: {
                        'productId':productId,
                    }
                })
                .then(response => $('#productDetails').html(response.data))
        }
    </script>
@endpush
@section('content')

    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Flash Sale</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href=""><i class="la la-home font-20"></i></a>
            </li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Flash Sale Form</div>
            </div>
            <div class="ibox-body">
                @include('admin.layouts.error')
                <div class="container">
                    @if ($flashSale->id)
                        <form action={{ route('flash-sale.update', $flashSale->id) }} method='post' autocomplete='off'>
                            @method('PATCH')
                        @else
                            <form action={{ route('flash-sale.store') }} method='post' autocomplete='off'>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="">Product</label>
                            <input type="text" id='productName' name="productName" class="form-control"
                                placeholder="productName" aria-describedby="helpId" list="product"
                                value="{{ old('productName', optional($flashSale->product)->product_name) }}">
                            <datalist id="product">
                            </datalist>
                            @error('productId')
                                <small id="helpId" class="text-error">{{ $message }}</small>
                            @enderror
                            <input type="hidden" name="productId" id="productId" value="{{ $flashSale->productId }}">
                        </div>

                        <div class="col-12" id="productDetails"></div>
                        <div class="row col-12">
                            <div class="form-group col-6">
                                <label for="">Start Date</label>
                                <input type="dateTime-local" name="startTime" id="" class="form-control" placeholder=""
                                    aria-describedby="helpId" required
                                    value="{{ old('startTime', optional($flashSale->startTime)->format('Y-m-d\TH:i:s')) }}">
                                @error('startTime')
                                    <small id="helpId" class="text-errpr">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="">End Date</label>
                                <input type="dateTime-local" name="endTime" id="" class="form-control" placeholder=""
                                    aria-describedby="helpId"
                                    value="{{ old('endTime', optional($flashSale->endTime)->format('Y-m-d\TH:i:s')) }}">
                                @error('endTime')
                                    <small id="helpId" class="text-errpr">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Total Stock</label>
                                <input type="number" name="totalStock" id="totalStock" class="form-control" placeholder=""
                                    aria-describedby="helpId" value="{{ old('totalStock', $flashSale->totalStock) }}">
                                @error('totalStock')
                                    <small id="helpId" class="text-errpr">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="discount">Discount percentage</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="discount" placeholder="Discount"
                                        min="0" max="100" value="{{ old('discount', $flashSale->discount) }}">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- END PAGE CONTENT-->

@stop
