@section('title')

Contacts | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Contacts</h1>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Contacts</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>View Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @php $i = 1 @endphp
                    @foreach($contacts as $contact)
                    <tr>
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            {{ucwords($contact->contact_name)}}
                        </td>
                        <td>
                            {{$contact->contact_subject}}
                        </td>
                        <td>
                            {{date('M d, Y | g:i a',strtotime($contact->created_at))}}
                        </td>
                        <td>
                            @if($contact->view_status == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Viewed</span>
                            @else
                            <span class="badge badge-warning m-r-5 m-b-5">Pending</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/ns-admin/contacts/view/'.$contact->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye font-14"></i></a>
                            <a href="{{url('/ns-admin/contacts/delete/'.$contact->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop