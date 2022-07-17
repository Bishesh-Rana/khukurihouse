@section('title')

Customers | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Customers</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Customers List</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <label class="sr-only" for="ref_id">Email</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="email" type="text" placeholder="abc@gmail.com">
               
                <label class="sr-only" for="ref_id">Customer Name</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="customer_name" type="text" placeholder="Customer Name">
               
                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form>

            @include('admin.layouts.error')
            <div id="table-data">
                @include('admin.list.ajaxcustomer.customer')
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
        customerName:null,
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
            filterObject.path = "{{ route('ajax.customer.list') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
           
            filterObject.email = $('#email').val();
            filterObject.customerName = $('#customer_name').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ route('ajax.customer.list') }}?page="+filterObject.page;
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

