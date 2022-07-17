@extends('admin.layouts.app')

@section('title')

Seller Cancel List | {{env('APP_NAME')}}

@stop

@section('content')

<!-- START PAGE CONTENT-->

<div class="page-content fade-in-up">
    <div class="row">
        @include('admin.pages.seller.sidebar')
        <div class="col-lg-9 col-md-8">
            <div class="ibox">
                <div class="ibox-body">


                    <h4 class="text-info m-b-20 m-t-20">
                        <i class="fa fa-shopping-basket"></i> Cancel List | Total Cancelled:: {{$orders->total()}}
                    </h4>
                    <div id="table-data">
                        @include('admin.pages.seller.list')
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    </div>
                </div>
            </div>

        </div>
    </div>
    <style>
        .profile-social a {
            font-size: 16px;
            margin: 0 10px;
            color: #999;
        }

        .profile-social a:hover {
            color: #485b6f;
        }

        .profile-stat-count {
            font-size: 22px
        }
    </style>


    @endsection

    @section('footer')
    <script type="text/javascript">
        let filterObject = {
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

                filterObject.sellerId = $('#seller_id').val();
                filterObject.page = $(this).attr('href').split('page=')[1];
                filterObject.path = "{{ URL::route('admin.fetch.seller.cancel-history') }}?page=" + filterObject.page;
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