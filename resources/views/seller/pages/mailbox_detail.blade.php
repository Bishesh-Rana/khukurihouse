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
    <h1 class="page-title">Mail View</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Mail View</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <h2>Chat Box</h2>
            <h6 class="m-t-10 m-b-10">List</h6>
            <ul class="list-group list-group-divider inbox-list">
                <li class="list-group-item">
                <a href="{{ route('seller.mailbox.list') }}"><i class="fa fa-inbox"></i> Inbox
                    @if($pending_count!='0')
                    <span class="badge badge-warning badge-square pull-right">{{ $pending_count  }}  </span>
                    @endif
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
        <div class="col-lg-9 col-md-8" style="overflow:scroll; height:600px; overflow-x:hidden;background-color: #ead5b6;">
            @foreach($messages as $row)
            @if($row->send_by == 'customer')
            <br>
            <div class="row">
                <div class="col-lg-9">
                    <div class="ibox" id="mailbox-container" style="border-radius: 25px;">
                        <div class="mailbox-header d-flex justify-content-between" style="border-bottom: 1px solid #e8e8e8;">
                            <div>
                                <div class="m-t-5 font-13">
                                <img src="{{ asset('uploads/customers/'.$row->image) }}" alt="" style="width: 27px;border-radius: 50%;">
                                <span class="font-strong">{{ $row->name }}</span>
                                </div>
                            <div class="p-r-10 font-13">{{ $row->created_at->diffForHumans() }}</div>
                            </div>
                        
                        </div>
                        <div class="mailbox-body">
                        <p>{!! $row->message !!}</p>
                           </div>
                    
                    </div>
                </div>
            </div>

            @else
            <div class="row">
                <div class="col-lg-9" style="margin-left: 27%;">
                    <div class="ibox" id="mailbox-container" style="background-color: #ced4da; border-radius: 25px;">
                        <div class="mailbox-header d-flex justify-content-between" style="border-bottom: 1px solid #e8e8e8;">
                            <div>
                                <div class="m-t-5 font-13">
                                <img src="{{ asset('uploads/sellers/'.Auth::guard('seller')->user()->image) }}" alt="" style="width: 27px;border-radius: 50%;">
                                <span class="font-strong">{{ Auth::guard('seller')->user()->company_name }}</span>
                                </div>
                                <div class="p-r-10 font-13"><span class="dot" style="height: 8px;
                                    width: 8px;
                                    background-color: #17ca17;
                                    border-radius: 50%;
                                    display: inline-block;"></span> active now</div>
                            </div>
                        
                        </div>
                        <div class="mailbox-body">
                            <p>{!! $row->message !!}</p>
                           </div>
                    
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox" id="mailbox-container" style="border-radius: 25px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="mailbox-header d-flex justify-content-between" style="border-bottom: 1px solid #e8e8e8;">
                            <div>
                                <div class="m-t-5 font-13">
                                <span class="font-strong">Reply</span>
                                </div>
                            </div>
                        
                        </div>
                        <div class="mailbox-body">
                        <form action="{{ route('seller.message.reply') }}" method="POST">
                                @csrf
                        <input type="hidden" name="customer_id" value="{{ $mail_id }}">
                            <textarea name="message" id=""  rows="10"  class="form-control"></textarea>
                            <input type="submit" value="Reply" class="form-control btn btn-primary">
                        </form>
                        </div>
                    
                    </div>
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