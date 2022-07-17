@section('title')

PushNotifications | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">PushNotifications</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{url('/ns-admin/pushnotifications/create')}}"><i class="fa fa-plus"></i> Add PushNotification</a>
    </ol>
</div>
<br>
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Search PushNotification</div>
    </div>
    <div class="ibox-body">
        <form class="form-inline">
            <label class="sr-only" for="pushnotification-name">PushNotification Name</label>
            <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="pushnotification-name" type="text" placeholder="PushNotification Name">
            <button class="btn btn-success" type="submit" id="all-filter">Search</button>
        </form>
    </div>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">PushNotifications</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <div id="table-data">
                @include('admin.list.ajaxlist.pushnotification')
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
        pushnotificationName: null,
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
            filterObject.path = "{{ URL::route('admin.pushnotification.ajaxfetch') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.pushnotificationName = $('#pushnotification-name').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('admin.pushnotification.ajaxfetch') }}?page="+filterObject.page;
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