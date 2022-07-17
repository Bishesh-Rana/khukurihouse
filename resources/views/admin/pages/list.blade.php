@section('title')

Category List | Admin | {{env('APP_NAME')}}

@stop

@extends('admin.layouts.app')
@section('custom-css')
    <style>
        ol {
            list-style-type: none;
        }
        .menu-handle {
            display: block;
            margin-bottom: 5px;
            padding: 6px 4px 6px 12px;
            color: #333;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            cursor: move;
        }

        .menu-handle:hover {
            background: #fff;
        }

        .placeholder {
            margin-bottom: 10px;
            background: #D7F8FD
        }

    </style>
@endsection


@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Category List</h1>
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('//ns-admin/categories')}}">Go Back<i class="la la-home font-20"></i></a>
        </li>
    </ol> --}}
</div>
@include('admin.layouts.error')
<div class="page-content fade-in-up" id="printpage">
    <div class="ibox invoice">
        <div class="invoice-header">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Manage Category Position</h2>
                            <div class="card-tools">
                                <a href="#" type="button" class="btn btn-tool"></a>
                            </div>
                        </div>
                        <div class="card-body card-format">
                            @if ($categories->count() > 0)
                                <ol class="sortable">
                                    @foreach ($categories as $item)
                                            <li id="menuItem_{{ $item->id }}">
                                                <div class="menu-handle d-flex justify-content-between">
                                                    <span>
                                                        {{ $item->category_name }}
                                                    </span>

                                                    <div class="menu-options btn-group">
                                                        <a href="/ns-admin/categories/edit/{{ $item->id }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $item->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                        <!-- Modal -->
                                                            <div class="modal fade text-left" id="deletionservice{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <form action="/ns-admin/categories/delete/{{$item->id}}" method="POST" style="display:inline-block;">
                                                                                @csrf
                                                                                @method("POST")
                                                                                <label for="reason">Are you sure you want to delete??</label><br>
                                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                                <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            ";
                                                            </div>
                                                    </div>
                                                </div>

                                                <ol class="sortable">
                                                @if (count($item->child)>0)
                                                    @foreach ($item->child as $menu)
                                                            <li id="menuItem_{{ $menu->id }}">
                                                                <div class="menu-handle d-flex justify-content-between">
                                                                    <span>
                                                                        {{ $menu->category_name }}
                                                                    </span>

                                                                    <div class="menu-options btn-group">
                                                                        <a href="/ns-admin/categories/edit/{{ $item->id }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $menu->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                        <!-- Modal -->
                                                                            <div class="modal fade text-left" id="deletionservice{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                        </div>
                                                                                        <div class="modal-body text-center">
                                                                                            <form action="/ns-admin/categories/delete/{{$item->id}}" method="POST" style="display:inline-block;">
                                                                                                @csrf
                                                                                                @method("POST")
                                                                                                <label for="reason">Are you sure you want to delete??</label><br>
                                                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                                                <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            ";
                                                                            </div>
                                                                    </div>
                                                                 </div>
                                                            </li>
                                                    @endforeach
                                                @endif

                                                </ol>
                                                {{-- {{ get_nested_menu($item->id) }} --}}
                                                {{-- @include('admin.menu.nested',['data'=>$item->child_menu]) --}}
                                            </li>
                                    @endforeach
                                    <div class="form-group mt-4">
                                        <button type="button" class="btn btn-success btn-sm btn-flat" id="serialize"><i
                                                class="fa fa-save"></i>
                                            Update Menu
                                        </button>
                                    </div>
                                </ol>
                            @else
                                <p class="text-center">Menu Not Found in Database</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <style>
        .invoice {
            padding: 20px
        }

        .invoice-header {
            margin-bottom: 50px
        }

        .invoice-logo {
            margin-bottom: 50px;
        }

        .table-invoice tr td:last-child {
            text-align: right;
        }
    </style>

</div>
<div class="text-right">
    <button class="btn btn-info" type="button" onclick="printDiv()"><i class="fa fa-print"></i> Print</button>
</div>



<!-- END PAGE CONTENT-->

@stop

@section('footer')

<!-- COLLAPSE SCRIPT -->
    <script src="{{ asset('sortablejs/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('sortablejs/jquery.mjs.nestedSortable.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>

        $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            placeholder: 'placeholder',
            handle: 'div.menu-handle',
            helper: 'clone',
            items: 'li',
            opacity: .6,
            maxLevels: 1,
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
        });

        $("#serialize").click(function(e) {
            e.preventDefault();
            $(this).prop("disabled", true);
            $(this).html(
                    `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...`
                );
            var serialized = $('ol.sortable').nestedSortable('serialize');
            // console.log(serialized);
            $.ajax({
                url: "",
                method: "POST",
                url: "{{route('category.postlist')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    sort: serialized
                },
                success: function(res) {
                    toastr.options.closeButton = true
                    toastr.success('Menu Order Successfuly', "Success !");
                    $('#serialize').prop("disabled", false);
                    $('#serialize').html(`<i class="fa fa-save"></i> Update Menu`);
                }
            });
        });

        function show_alert() {
            if (!confirm("Do you really want to do this?")) {
                return false;
            }
            this.form.submit();
        }
    </script>
@stop
