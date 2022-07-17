@section('title')

Delivery Setting List  | {{env('APP_NAME')}}

@stop
@extends('delivery.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Deliver</h1>
    <ol class="breadcrumb">
        <a class="btn btn-outline-primary" href="{{ route('delivery.deliverysetting.create') }}"><i class="fa fa-plus"></i> Add Deliver Setting</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Deliver Setting</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <label class="sr-only" for="product-name">Destination</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="destination" type="text" placeholder="Destination">

                <label class="sr-only" for="product-rating">Rate</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="rate" type="text" placeholder="Rate">

                <label class="sr-only" for="product-rating">Minimum Weight</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="min_weight" type="text" placeholder="Minimum Weight">

                <label class="sr-only" for="product-rating">Maximum Weight</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="max_weight" type="text" placeholder="Maximum Weight">
             
                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form><br>
            @include('delivery.layouts.error')
            <div id="table-data">
                @include('delivery.list.deliversettingajax')
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
        destination: null,
        minWeight: null,
        maxWeight:null,
        rate:null,
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
            filterObject.path = "{{ route('delivery.ajax.deliverysetting.list') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.destination = $('#destination').val();
            filterObject.rate = $('#rate').val();
            filterObject.minWeight = $('#min_weight').val();
            filterObject.maxWeight = $('#max_weight').val();
           
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ route('delivery.ajax.deliverysetting.list') }}?page="+filterObject.page;
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