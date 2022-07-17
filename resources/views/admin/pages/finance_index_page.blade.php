@section('title')

Financial Statement | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Financial Statement</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
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
        <form action="{{route('seller.monthly.statement')}}" method="post" class="form-inline">
        @csrf
            <label class="sr-only" for="company-name">Seller's Company</label>
            <!-- <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="company-name" type="text" placeholder="Company Name"> -->
            <div class="col-sm-2 form-group">
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
            </div>

            <div class="col-sm-2 form-group">
                <select class="form-control select2_demo_1" name="year">
                    <!-- current year selected garam -->
                    @foreach($years as $row)
                    <option value="{{ $row->year }}">{{ $row->year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4 form-group">
                <select class="form-control select2_demo_1" name="seller_name">
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

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Content Title</th>
                        <th>Content Type</th>
                        <th>Show On</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    <!-- @foreach($contents as $row) -->
                    <tr>
                        <td>
                            {{$i}}
                        </td>
                        <td>one</td>

                        <td>
                            <span class="badge badge-info m-r-5 m-b-5">once</span>
                        </td>
                        <td>
                            <span class="badge badge-danger m-r-5 m-b-5">None</span>
                        </td>
                        <td>
                            <span class="badge badge-success m-r-5 m-b-5">Active</span>
                            <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                        </td>
                        <td>
                            <a href="{{url('/ns-admin/contents/edit/'.$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                            <a href="{{url('/ns-admin/contents/delete/'.$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                        </td>
                    </tr>
                    @php $i++ @endphp
                    <!-- @endforeach -->

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop