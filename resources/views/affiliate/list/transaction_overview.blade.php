@section('title')

Affiliate Transaction Overview | {{env('APP_NAME')}}

@stop
@extends('affiliate.layouts.app')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Affiliate Transaction Overview</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <!-- <a class="btn btn-outline-primary" href="{{url('/ns-admin/news/create')}}"><i class="fa fa-plus"></i> Add Transaction Overview</a> -->
    </ol>
</div>

<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Search Finance Statement By Affiliate</div>
    </div>
    <div class="ibox-body">
        <form class="form-inline">
            @csrf
            <!-- <label class="sr-only" for="company-name">Seller's Company</label> -->
            <!-- <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="company-name" type="text" placeholder="Company Name"> -->

            <div class="col-sm-3 form-group">
                <label for="transaction_type">For the period</label>
                <input type="text" class="form-control" name="daterange" id="daterange" value="" />
               
            </div>

        

            <!-- input type bata search -->

            <button class="btn btn-success" type="submit" id="all-filter">Search</button>
        </form>
    </div>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Transaction Overview</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <div id="table-data">
                @include('affiliate.list.ajaxlist.transaction_overview')
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop

@section('footer')

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
    let filterObject = {
        // month: null,
        // year: null,
        dateRange: null,
        affiliateId: null,
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
            filterObject.path = "{{ URL::route('fetch.affiliate.transaction.overview') }}?page=" + filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e) {
            e.preventDefault();
            filterObject.dateRange = $('#daterange').val();
            // filterObject.month = $('#month').val();
            // filterObject.year = $('#year').val();
            filterObject.transactionType = $('#transaction_type').val();
            filterObject.affiliateId = $('#affiliate_id').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('fetch.affiliate.transaction.overview') }}?page=" + filterObject.page;
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
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'right'
        }, function(start, end, label) {
            console.log(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
@endsection