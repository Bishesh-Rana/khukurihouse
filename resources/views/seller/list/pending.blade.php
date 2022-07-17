@section('title')

Pending Order | {{env('APP_NAME')}}

@stop



@extends('seller.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading" style="margin-top:14px;">
  @include('seller.partials.order_boxes')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Pending Orders</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <label class="sr-only" for="ref_id">Product Name</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="ref_id" type="text" placeholder="abcxyz">
               
                <label class="sr-only" for="ref_id">Customer Name</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="customer_name" type="text" placeholder="Customer Name">
               
                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form>

            @include('admin.layouts.error')
            <div id="table-data">
                @include('seller.list.ajaxorder.pending')
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
        RefId: null,
        CustomerName:null,
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
            filterObject.path = "{{ route('seller.ajax.pending') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
           
            filterObject.RefId = $('#ref_id').val();
            filterObject.CustomerName = $('#customer_name').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ route('seller.ajax.pending') }}?page="+filterObject.page;
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

