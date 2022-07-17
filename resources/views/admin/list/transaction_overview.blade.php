@section('title')

Admin Transaction Overview | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Transaction Overview</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <!-- <a class="btn btn-outline-primary" href="{{url('/ns-admin/news/create')}}"><i class="fa fa-plus"></i> Add Transaction Overview</a> -->
    </ol>
</div>

<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Search Finance Statement By seller</div>
    </div>
    <div class="ibox-body">
        <form class="form-inline">
            @csrf
            <label class="sr-only" for="company-name">Seller's Company</label>
            <!-- <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="company-name" type="text" placeholder="Company Name"> -->

            <div class="col-sm-3 form-group">
                <label for="transaction_type">For the period</label>

                <input type="text" class="form-control" name="daterange" id="daterange" value="" />
                <!-- <select class="form-control select2_demo_1" id="month" name="month"> -->
                <!-- <option value=" ">All</option> -->
                <!-- <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select> -->
            </div>

            <div class="col-sm-3 form-group">
                <label for="transaction_type">For the Seller</label>

                <select class="form-control select2_demo_1" id="seller_id" name="seller_id">
                    <!-- current year selected garam -->
                    <!-- <option value=" ">All</option> -->
                    @foreach($sellers as $row)
                    <option value="{{ $row->id }}">{{ ucwords($row->company_name) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- <div class="col-sm-2 form-group">
                <label for="transaction_type">For the Year</label>

                <select class="form-control select2_demo_1" id="year" name="year"> -->
            <!-- current year selected garam -->
            <!-- <option value=" ">All</option> -->
            <!-- @foreach($years as $row)
                    <option value="{{ $row->year }}">{{ $row->year }}</option>
                    @endforeach
                </select>
            </div> -->

            <div class="col-sm-3 form-group">
                <label for="transaction_type">Transaction Type</label>

                <select class="form-control select2_demo_1" id="transaction_type" name="transaction_type">
                    <!-- <option value=" ">All</option> -->
                    <option value="commission_fee">Commission Fee</option>
                    <option value="payment_fee">Payment Fee</option>
                    <option value="shipping_fee">Shipping Fee</option>
                    <option value="reversal_commission_fee">Reversal Commission Fee</option>
                    <option value="payment_fee_credit">Payment Fee Credit</option>
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
            <div class="ibox-title">Transaction Overview</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <div id="table-data">
                @include('admin.list.ajaxlist.transaction_overview')
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
        transactionType: null,
        sellerId: null,
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
            filterObject.path = "{{ URL::route('admin.fetch.seller.transaction.overview') }}?page=" + filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e) {
            e.preventDefault();
            filterObject.dateRange = $('#daterange').val();
            // filterObject.month = $('#month').val();
            // filterObject.year = $('#year').val();
            filterObject.transactionType = $('#transaction_type').val();
            filterObject.sellerId = $('#seller_id').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('admin.fetch.seller.transaction.overview') }}?page=" + filterObject.page;
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