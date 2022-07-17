@section('title')

Stocks | {{env('APP_NAME')}}

@stop
@extends('seller.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Stocks</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Search Product Stock</div>
    </div>
    <div class="ibox-body">
        <form class="form-inline">
            <label class="sr-only" for="product-name">Product Name</label>
            <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="product-name" type="text" placeholder="Product Name">
            <button class="btn btn-success" type="submit" id="all-filter">Search</button>
        </form>
    </div>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Stocks</div>
        </div>
        @include('seller.layouts.error')

        <div id="table-data">
            @include('seller.list.stockajax')
            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        </div>
    </div>
</div>

<!-- END PAGE CONTENT-->

@stop

@section('footer')
<script type="text/javascript">

    let filterObject = {
        productName: null,
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
            filterObject.path = "{{ URL::route('stocks.ajaxfetch') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.productName = $('#product-name').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('stocks.ajaxfetch') }}?page="+filterObject.page;
            serverRequest();
        });

        function serverRequest(){
        $.ajax({
                type:'GET',
                url:filterObject.path,
                data:filterObject,
                // }
                success:function(data){
                    $('#table-data').html('');
                    $('#table-data').html(data);
                },
                error:function(data){
                    console.log('error');
                }
            });
        }
    });
    
</script>
@endsection