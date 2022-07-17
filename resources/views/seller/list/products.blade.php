@section('title')

Pending Order | {{env('APP_NAME')}}

@stop

@extends('seller.layouts.app')

@section('custom-css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

@endsection
@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading" style="margin-top:14px;">
    @include('seller.partials.manage_order')
    
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
    
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Product</div>
            </div>
            <div class="ibox-body">
                @include('admin.layouts.error')
                
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                          
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
    <!-- END PAGE CONTENT-->
    
    @stop
    
    @section('footer')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 1,
                lengthMenu: [10, 25, 50, 100, 200, 500],
                ajax: {
                   url:  "{{  route('seller.product.ajaxfetch') }}",
                   dataType: 'json',
                   type : 'GET'
                },
                columns: [
                    { data: 'sn' },
                    { data: 'product_name' },
                    { data: 'product_original_price' },     
                    { data: 'image'},     
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
              
        });                    
        });                    
    </script>
    @endsection
    
