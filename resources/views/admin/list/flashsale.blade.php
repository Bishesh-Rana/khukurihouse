@section('title')

    Flash Sale | {{ env('APP_NAME') }}

@stop
@extends('admin.layouts.app')

@section('content')

    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Flash Sale</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href=""><i class="la la-home font-20"></i></a>
            </li>
            <a class="btn btn-outline-primary" href="{{ route('flash-sale.create') }}">
                <i class="fa fa-plus"></i>
                Add Flash Sale</a>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Flash Sale</div>
            </div>
            <div class="ibox-body">
                @include('admin.layouts.error')

                <table class="table  table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" rowspan="2">#</th>
                            <th class="text-center align-middle" rowspan="2">Product</th>
                            <th class="text-center align-middle" rowspan="2">Start Date</th>
                            <th class="text-center align-middle" rowspan="2">End Date</th>
                            <th class="text-center align-middle" colspan="3">Stock</th>
                            <th class="text-center align-middle" rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle">Total</th>
                            <th class="text-center align-middle">Sold</th>
                            <th class="text-center align-middle">Remaining</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($flashSales as $key => $flashSale)
                            <tr>

                                <td>{{ $key + 1 }}</td>
                                <td>{{ $flashSale->product->product_name }}</td>
                                <td>{{ $flashSale->startTime }}</td>
                                <td>{{ $flashSale->endTime }}</td>
                                <td>{{ $flashSale->totalStock }}</td>
                                <td>{{ $flashSale->soldStock }}</td>
                                <td>{{ $flashSale->remainingStock }}</td>
                                <td class="d-flex">

                                    <form action="{{ route('flash-sale.destroy', $flashSale->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mr-1">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>

                                    <a name="" id="" class="btn btn-primary" href="{{ route('flash-sale.edit',$flashSale->id) }}" role="button"><i
                                            class="fa fa-pencil" aria-hidden="true"></i></a>



                                </td>
                            </tr>
                        @empty
                            <td colspan="7" class="text-center">No Flash Sale Found</td>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ $flashSales->links() }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

@stop
