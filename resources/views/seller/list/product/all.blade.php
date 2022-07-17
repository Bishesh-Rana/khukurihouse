@section('title')

All Product | {{env('APP_NAME')}}

@stop

@extends('seller.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading" style="margin-top:14px;">

    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Search Product</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <label class="sr-only" for="product-name">Product Name</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="product-name" type="text" placeholder="Product Name">
                <label class="sr-only" for="product-sku">Product SKU</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="product-sku" type="text" placeholder="Product SKU">
                <label class="sr-only" for="brand-name">Brand</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="brand-name" type="text" placeholder="Brand">
                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form>
        </div>
    </div>
    @include('seller.partials.manage_order')
   
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
    
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">All Product</div>
            </div>
            <div class="ibox-body">
                @include('admin.layouts.error')
                
                <div id="table-data">
                    @include('seller.list.ajaxproduct.all')
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                </div>
            </div>
        </div>
    </div>
</div>    
    <!-- END PAGE CONTENT-->    
@stop

@section('footer')
<script type="text/javascript">

    let filterObject = {
        productName: null,
        productSku: null,
        brandName: null,
        page:null,
        path:null,
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            
            filterObject.page = $(this).attr('href').split('page=')[1];
            filterObject.path = "{{ URL::route('seller.all.product') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.productName = $('#product-name').val();
            filterObject.productSku = $('#product-sku').val();
            filterObject.brandName = $('#brand-name').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('seller.all.product') }}?page="+filterObject.page;
            serverRequest();
        });

        function serverRequest(){
            document.body.className = "loading";
        $.ajax({
                type:'GET',
                url:filterObject.path,
                data:filterObject,
                // }
                success:function(data){
                    $('#table-data').html('');
                    $('#table-data').html(data);
                    document.body.className = "";

                },
                error:function(data){
                    console.log('error');
                }
            });
        }
    });
    
</script>
@endsection
    
    
    
