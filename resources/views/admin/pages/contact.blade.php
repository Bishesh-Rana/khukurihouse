@extends('admin.layouts.app')

@section('title')

Contact | {{env('APP_NAME')}}

@stop

@section('content')

<div class="page-heading">
    <h1 class="page-title">Contact Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/ns-admin/contacts')}}">Go Back<i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <table class="table table-striped no-margin table-invoice">
                <tbody>
                    <tr>
                        <th>Full Name</th>
                        <td>{{$contact->contact_name}}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{$contact->contact_number}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$contact->contact_email}}</td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{{$contact->contact_subject}}</td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td>{{$contact->contact_message}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop