@section('title')

Pending Order | {{env('APP_NAME')}}

@stop

@extends('delivery.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading" style="margin-top:14px;">
    @include('delivery.partials.order_boxes')
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Pending Orders</div>
            </div>
            <div class="ibox-body">
                @include('admin.layouts.error')

                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Reference Code</th>
                            <th>Customer Name</th>
                            <th>Country</th>
                            <th>Total Product</th>
                            <th>Total Quantity</th>
                            <th>Delivery Assign Date</th>

                            @if(!isset(Auth::guard('delivery')->user()->parent_id))
                            <th>Select Staff</th>
                            @endif

                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($pendings as $key => $row)
                        <tr>
                            <td>
                                {{ ++$key }}
                            </td>

                            <td id="ref_id">{{ $row->ref_id }}</td>
                            <td>
                                {{ ucfirst($row->firstname) }} {{ ucfirst($row->lastname) }}
                            </td>
                            <td>
                                {{$row->country}}
                            </td>
                            <td>
                                {{ $row->total_product }}
                            </td>

                            <td>
                                {{ $row->total_quantity }}
                            </td>

                            <td>
                                {{ date('M d, Y | g:i a',strtotime($row->delivery_assigned_date)) }}
                            </td>

                            @if(!isset(Auth::guard('delivery')->user()->parent_id))
                            <td>
                                <div id="toast" style="display: none; color: red; ">Please select a Delivery</div>
                                <select name="staff_name" id="staff_name" class="form-control staff_name">
                                    <option selected disabled>Select Staff</option>
                                    @foreach($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->first_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            @endif

                            <td>
                                <a href="{{ route('delivery.order.detail', $row->ref_id) }}"> <span class="badge badge-primary m-r-5 m-b-5">View</span></a>
                                @if(!isset(Auth::guard('delivery')->user()->parent_id))
                                @if(isset($row->staff_id))
                                <a href="javascript:void(0)" class="staff_assign"><span class="badge badge-success m-r-5 m-b-5">Assigned</span></a>
                                @else
                                <a href="" onclick="return confirm('Do You Really Want To Assign Staff?')" class="staff_assign"><span class="badge badge-danger m-r-5 m-b-5">Assign Staff</span></a>
                                @endif
                                @endif
                                <!-- <a href="{{ route('delivery.order.fail', $row->ref_id) }}" onclick="return confirm('Do You Really Want To Cancel The Order?')"><span class="badge badge-danger m-r-5 m-b-5">Cancel Delivery</span></a> -->
                                <a href="{{ route('delivery.order.shipped', $row->ref_id) }}"></i><span class="badge badge-success m-r-5 m-b-5">Shipped</span></a>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

    @stop

    @section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
<script type="text/javascript">

$(document).ready(function(){

$('.staff_assign').on('click', function(e){
    e.preventDefault();

    var parent = $(this).closest('tr');
   
    var ref_id = $(parent).find('#ref_id').text();
    // var seller_id = $(parent).find('.ref_id').text();
    var staff_id = $(parent).find('.staff_name').val();
    if(staff_id == null)
    {
        $('#toast').css('display','block');
        return false;
    } 
    let filterObject = {
        refId: ref_id,
        staffId: staff_id,
    }

    axios.post('/api/staff-assign',filterObject).then(res => {
        console.log('success');
        location.reload();
    });
  
    });

});

</script>
@stop