@section('title')

Products | {{env('APP_NAME')}}

@stop
@extends('affiliate.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Cancelled Products</div>
        </div>
        <div class="ibox-body">
            <form class="form-inline">
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="product_name" type="text" placeholder="Product Name">
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="product_owner_code" type="text" placeholder="Owner Code">
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="product_category" type="text" placeholder="Category Name">
                <button class="btn btn-success" type="submit" id="all-filter">Search</button>
            </form>
            @include('affiliate.layouts.error')
            <div id="table-data">
                @include('affiliate.list.ajaxcancelledproduct.cancelled-product')
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop

@section('footer')
<script type="text/javascript">
    function copyText(id) {
        // var copyText = $("#affiliate_url"+id).text();
        var affiliateUrl = document.getElementById("affiliate_url" + id);
        affiliateUrl.select();
        affiliateUrl.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert("Copied the text: " + affiliateUrl.value);
    }

    let filterObject = {
        productName: null,
        productOwnerCode: null,
        productCategory: null,
        page: null,
        path: null,
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();

            filterObject.page = $(this).attr('href').split('page=')[1];
            filterObject.path = "{{ route('affiliate.ajax.product.cancelled') }}?page=" + filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e) {
            e.preventDefault();
            filterObject.productName = $('#product_name').val();
            filterObject.productOwnerCode = $('#product_owner_code').val();
            filterObject.productCategory = $('#product_category').val();

            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ route('affiliate.ajax.product.cancelled') }}?page=" + filterObject.page;
            serverRequest();
        });

        function serverRequest() {
            $.ajax({
                type: 'GET',
                url: filterObject.path,
                data: filterObject,
                // }
                success: function(data) {
                    $('#table-data').html('');
                    $('#table-data').html(data);
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }
    });
</script>
@endsection