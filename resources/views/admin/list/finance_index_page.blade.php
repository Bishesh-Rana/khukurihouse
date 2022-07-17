@section('title')

Financial Statement List | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Financial Statement</h1>
    <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li> -->
        <!-- <form action="{{route('admin.generate.monthly.statement')}}" method="post">
            @csrf
            <div class="row">

                    <div class="form-group">
                        <label>Select Month</label>
                        <select class="form-control select2_demo_1" name="month" required>
                            <option value="1">January</option>
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
                        </select>
                        <button class="btn btn-outline-primary">Generate</button>
                    </div>
            </div>
        </form> -->
        @if($generate_statement)
        <a class="btn btn-outline-primary" href="{{route('admin.generate.monthly.statement')}}"><i class="fa fa-plus"></i> Generate Previous Month Statement</a>
        @endif
    </ol>
</div>

<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Search Finance Statement By seller</div>
    </div>
    <div class="ibox-body">
        <form class="form-inline">
            @csrf
            <!-- <label class="sr-only" for="company-name">Seller's Company</label> -->
            <!-- <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="company-name" type="text" placeholder="Company Name"> -->
            <!-- <div class="col-sm-2 form-group">
                <select class="form-control select2_demo_1" id="month" name="month">
                    <option value=" ">All</option>
                    <option value="1">January</option>
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
                </select>
            </div> -->

            <div class="col-sm-3 form-group">
                <!-- <select class="form-control select2_demo_1" id="year" name="year"> -->
                <input type="month" class="form-control" id="month" name="month" value="2020-01">
                <!-- current year selected garam -->
                <!-- <option value=" ">All</option>
                    @foreach($years as $row)
                    <option value="{{ $row->year }}">{{ $row->year }}</option>
                    @endforeach
                </select> -->
            </div>

            <div class="col-sm-4 form-group">
                <select class="form-control select2_demo_1" id="seller_name" name="seller_name">
                    @foreach($sellers as $row)
                    <option value="{{ $row->id }}">{{ ucwords($row->company_name) }}</option>
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
                @include('admin.list.ajaxlist.finance_index_page')
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
        sellerName: null,
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
            filterObject.path = "{{ URL::route('seller.monthly.statement') }}?page=" + filterObject.page;
            serverRequest();
        });

        $('#all-filter').click(function(e) {
            e.preventDefault();
            filterObject.month = $('#month').val();
            filterObject.year = $('#year').val();
            filterObject.sellerName = $('#seller_name').val();
            filterObject.page = $('#hidden_page').val();
            filterObject.path = "{{ URL::route('seller.monthly.statement') }}?page=" + filterObject.page;
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