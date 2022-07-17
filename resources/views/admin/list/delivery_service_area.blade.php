@section('title')

Delivery Service Area  | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{ route('deliveryServiceArea.create') }}"><i class="fa fa-plus"></i> Add Deliever Service Area</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Delivery Service Area</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="area_name" type="text" placeholder="Area Name">

                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="rate" type="text" placeholder="Rate">

                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form><br>
            @include('admin.layouts.error')
            <div id="table-data">
                @include('admin.list.ajaxlist.delivery_service_area')
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
        area_name: null,
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
            filterObject.path = "{{ route('admin.ajax.deliveryServiceArea.list') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.area_name = $('#area_name').val();
            filterObject.rate = $('#rate').val();

            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ route('admin.ajax.deliveryServiceArea.list') }}?page="+filterObject.page;
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
