@section('title')
Delivered | {{env('APP_NAME')}}
@stop
@extends('admin.layouts.app')
@section('content')
<!-- START PAGE CONTENT-->
<div class="page-heading" style="margin-top:14px;">
  @include('admin.partials.order_boxes')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Delivered</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <label class="sr-only" for="order-date">Order Date</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="order-date" type="date" placeholder="Order Date">
                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form><br>
            @include('admin.layouts.error')
            <div id="table-data">
                @include('admin.list.ajaxlist.adminshipped')
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            </div>
          
         
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
@stop

@section('footer')

<script type="text/javascript">
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 let filterObject = {
        orderDate: null,
        // parentCategoryName: null,
        page:null,
        path:null,
    }
       $(document).ready(function(){
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            filterObject.page = $(this).attr('href').split('page=')[1];
            filterObject.path = "{{ URL::route('ajax.admin.order.delivered.list.fetch') }}?page="+filterObject.page;
            serverRequest();
        });
        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.orderDate = $('#order-date').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('ajax.admin.order.delivered.list.fetch') }}?page="+filterObject.page;
            serverRequest();
        });
        function serverRequest(){
        $.ajax({
                type:'GET',
                url:filterObject.path,
                data:filterObject,
                // }
                success:function(data){
                    console.log('success');
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