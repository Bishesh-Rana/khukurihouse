@section('title')

Sellers | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Sellers</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{url('/ns-admin/sellers/create')}}"><i class="fa fa-plus"></i> Add Seller</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Sellers</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <label class="sr-only" for="product-name">Seller Name</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="seller_name" type="text" placeholder="Seller Name">

                <label class="sr-only" for="product-rating">Seller Phone</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="seller_phone" type="text" placeholder="Seller Phone">

                <label class="sr-only" for="product-rating">Seller Email</label>

                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="seller_email" type="text" placeholder="Seller Email">
                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form>
            @include('admin.layouts.error')
            <div id="table-data">
                @include('admin.list.ajaxseller.seller')
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            </div>

         
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop


@section('footer')
<script type="text/javascript">

    let filterObject = {
        sellerName: null,
        sellerPhone: null,
        sellerEmail:null,
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
            filterObject.path = "{{ route('admin.ajax.seller.list') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.sellerName = $('#seller_name').val();
            filterObject.sellerPhone = $('#seller_phone').val();
            filterObject.sellerEmail = $('#seller_email').val();
           
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ route('admin.ajax.seller.list') }}?page="+filterObject.page;
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