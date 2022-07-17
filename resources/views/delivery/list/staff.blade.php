
@extends('delivery.layouts.app')

@section('title')

Delivery Staffs | {{env('APP_NAME')}}

@stop

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Delivery Staffs</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Delivery Staffs</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <label class="sr-only" for="staff-name">Staff Name</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="staff-name" type="text" placeholder="Staff Name">
                <label class="sr-only" for="staff-email">Staff Email</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="staff-email" type="text" placeholder="Staff Email">
                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form>
        </div>
        <div class="ibox-body">
            @include('delivery.layouts.error')

            <div id="table-data">
                @include('delivery.list.staffajax')
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
        staffName: null,
        staffEmail: null,
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
            filterObject.path = "{{ URL::route('delivery.staff.ajaxfetch') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.staffName = $('#staff-name').val();
            filterObject.staffEmail = $('#staff-email').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('delivery.staff.ajaxfetch') }}?page="+filterObject.page;
            serverRequest();
        });

        function serverRequest(){
        $.ajax({
                type:'GET',
                url:filterObject.path,
                data:filterObject,
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
@stop