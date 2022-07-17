@section('title')

Financial Statement List | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Affiliate Financial Statement</h1>
    <ol class="breadcrumb">
        @if($generate_statement)
        <a class="btn btn-outline-primary" href="{{route('admin.generate.affiliate.monthly.statement')}}"><i class="fa fa-plus"></i> Generate Previous Month Statement</a>
        @endif
    </ol>
</div>

<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Search Finance Statement By Affiliate</div>
    </div>
    <div class="ibox-body">
        <form class="form-inline">
            @csrf

            <div class="col-sm-3 form-group">
                <input type="month" class="form-control" id="month" name="month" value="2020-01">
            </div>

            <div class="col-sm-4 form-group">
                <select class="form-control select2_demo_1" id="affiliate_name" name="affiliate_name">
                    @foreach($affiliates as $row)
                    <option value="{{ $row->affiliate_code }}">{{ ucwords($row->first_name) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- input type bata search -->
            <button class="btn btn-success" type="submit" id="all-filter">Search</button>
        </form>
    </div>
</div>


<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Financial Statement</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <div id="table-data">
                @include('admin.list.ajaxlist.affiliate_finance_index_page')
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
        month: null,
        year: null,
        affiliateName: null,
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
            filterObject.path = "{{ URL::route('affiliate.monthly.statement') }}?page=" + filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e) {
            e.preventDefault();
            filterObject.month = $('#month').val();
            filterObject.year = $('#year').val();
            filterObject.affiliateName = $('#affiliate_name').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('affiliate.monthly.statement') }}?page=" + filterObject.page;
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

<script>
    $(document).ready(function() {
        var txtMonth = document.getElementById('month');
        var date = new Date();
        // var month = "0" + (date.getMonth() + 1);
        var month = "0" + (date.getMonth());
        txtMonth.value = (date.getFullYear() + "-" + (month.slice(-2)));
    });
</script>
@endsection