@section('title')

Affiliates | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('header')
<style>
    .custom-form-control{
        border: 1px solid #ccc;
        border-radius: 2px;
        box-sizing: border-box;
        padding: 3px 4px;
    }
</style>

@stop

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Affiliates</h1>

</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Affiliates</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <label class="sr-only" for="product-name">Affiliate Name</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="affiliate_name" type="text" placeholder="Affiliate Name">

                <label class="sr-only" for="product-rating">Affiliate Phone</label>
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="affiliate_phone" type="text" placeholder="Affiliate Phone">

                <label class="sr-only" for="product-rating">Affiliate Email</label>

                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="affiliate_email" type="text" placeholder="Affiliate Email">
                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form>
            @include('admin.layouts.error')
            <div id="table-data">
                @include('admin.list.ajaxaffiliate.affiliate')
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

    let filterObject = {
        affiliateName: null,
        affiliatePhone: null,
        affiliateEmail:null,
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
            filterObject.path = "{{ route('admin.ajax.affiliate.list') }}?page="+filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e){
            e.preventDefault();
            filterObject.affiliateName = $('#affiliate_name').val();
            filterObject.affiliatePhone = $('#affiliate_phone').val();
            filterObject.affiliateEmail = $('#affiliate_email').val();
           
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ route('admin.ajax.affiliate.list') }}?page="+filterObject.page;
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
    $(document).off('click', '.update').on('click', '.update ',function(e){
        e.preventDefault();
        commissionId = 'commission'+$(this).data('id');
        let data = {
            affiliateId : $(this).data('id'),
            commission : $("#"+commissionId).val()
        }
        
        axios.post("{{route('affiliate.update.commission')}}", data).then(res => {
            $('#table-data').html('');
            $('#table-data').html(res.data);
            Lobibox.notify('success', {
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                width: 400,
                msg: 'Commission Updated',
                delay: 2000,
            });
        });
    })
    
</script>
@endsection