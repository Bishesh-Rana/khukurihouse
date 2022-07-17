@section('title')
Pending Order | {{env('APP_NAME')}}
@stop
@extends('admin.layouts.app')
@section('content')
<!-- START PAGE CONTENT-->
<div class="page-heading" style="margin-top:14px;">
 <div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Search Order By Date</div>
    </div>
    <div class="ibox-body">
        <form class="form-inline">
            <label class="sr-only" for="order-date">Order Date</label>
            <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="order-date" type="date" placeholder="Order Date">
            <button class="btn btn-success" type="submit" id="all-filter">Search</button>
        </form>
    </div>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Seller : Ready To Shipped Orders</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')
            <div id="table-data">
                @include('admin.list.ajaxlist.pending_sellerorder')
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
@stop
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>


<script type="text/javascript">

    $(document).off('click', '.delivery_assign').on('click', '.delivery_assign',function(e){
        var result = confirm('Are you sure?');
        if(result == false)
        {
            return false;
        }
        e.preventDefault();

        var parent = $(this).closest('tr');
    
        var ref_id = $(parent).find('.ref_id').text();
        var delivery_id = $(parent).find('.delivery_name').val();
        if(delivery_id == null)
        {
            $(parent).find('#toast').css('display','block');
            return false;
        } 
        let filterObject = {
            refId: ref_id,
            deliveryId: delivery_id,
        }

        axios.post('/api/delivery-assign',filterObject).then(res => {
         
            console.log('successyo');
            location.reload();
        });
    });

    let filterObject = {
        orderDate: null,
        // parentCategoryName: null,
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
            filterObject.path = "{{ URL::route('admin.list.seller.order.fetch') }}?page="+filterObject.page;
            serverRequest();
        });
        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.orderDate = $('#order-date').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('admin.list.seller.order.fetch') }}?page="+filterObject.page;
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