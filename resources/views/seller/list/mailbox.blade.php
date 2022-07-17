@section('title')

Chat List | {{env('APP_NAME')}}

@stop

@section('header')
<link rel="stylesheet" href="{{ asset('admincast/assets/css/pages/mailbox.css') }}">
@endsection

@extends('seller.layouts.app')

@section('content')

 <!-- START PAGE CONTENT-->
 <div class="page-heading">
    <h1 class="page-title">Chatbox</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Chatbox</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <h2>Chat Box</h2>
            {{-- <a class="btn btn-info btn-block" href="mail_compose.html"><i class="fa fa-edit"></i> Compose</a><br> --}}
            <h6 class="m-t-10 m-b-10">List</h6>
            <ul class="list-group list-group-divider inbox-list">
                <li class="list-group-item">
                <a href="{{  route('seller.mailbox.list') }}"><i class="fa fa-inbox"></i> Inbox
                    @if($pending_count!='0')<span class="badge badge-warning badge-square pull-right">{{ $pending_count  }}  </span>@endif
                    </a>
                </li>
                @foreach($mail_list as $row)
                <li class="list-group-item">
                     <img src="{{ asset('uploads/customers/'.$row->image) }}" alt="" style="width: 27px;border-radius: 50%;">
                <a href="{{  route('seller.mailbox.view',$row->customer_id)  }}">{{ $row->name }}
                        @if($row->unseen_count!='0')
                         <span class="badge badge-warning badge-square pull-right">{{ $row->unseen_count }}</span>
                        @else
                        <span class="badge badge-success badge-square pull-right">seen</span>

                        @endif
                    </a>
                </li>
                @endforeach
              
            </ul>
        
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="ibox" id="mailbox-container">
                <div class="mailbox-header">
                    <div class="d-flex justify-content-between">
                    <h5 class="d-none d-lg-block inbox-title"><i class="fa fa-envelope-o m-r-5"></i> Inbox @if($pending_count!='0') ({{ $pending_count }}) @endif</h5>
                      
                    </div>
                    <div class="d-flex justify-content-between inbox-toolbar p-t-20">
                    
                    </div>
                </div>
                <div class="mailbox clf">
                    @include('seller.layouts.error')
                    <table class="table table-hover table-inbox" id="table-inbox">
                        <tbody class="rowlinkx" data-link="row">
                            @foreach($mail_list as $row)
                            <tr>
                              
                                <td>
                                <a href="{{ route('seller.mailbox.view',$row->customer_id) }}" style="color:#3498db;">{{ $row->name }}</a>
                                </td>
                            <td class="mail-message">{!! str_limit($row->comment,30) !!}</td>
                                <td class="hidden-xs"></td>
                                @if($row->seen_status == '1')
                                <td class="mail-label hidden-xs text-success">seen</td>
                                @else
                                <td class="mail-label hidden-xs text-warning">pending</td>
                                @endif
                            <td class="text-right">{{ $row->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- END PAGE CONTENT-->

@endsection

@section('footer')
<script src="{{ asset('admincast/assets/js/scripts/mailbox.js') }}"></script>
@endsection