@section('title')

Profile| {{env('APP_NAME')}}

@stop
@extends('delivery.layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Profile</h1>
    <div class="progress m-b-20">
        @php

         $profile_count;
        $percent = $profile_count*25;

        @endphp
        <div class="progress-bar progress-bar-info" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">{{ round($percent) }}% completed</div>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <li class="breadcrumb-item">Profile</li> --}}
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="ibox">
                <div class="ibox-body text-center">
                    <div class="m-t-10">
                        @if(isset($delivery->image))
                        <img class="img-circle" src="{{ asset('uploads/deliveries/'.$delivery->image) }}"/>
                        @else
                        <img class="img-circle" src="{{ asset('uploads/others/admin-avatar.png') }}"/>
                        @endif
                    </div>
                    <h5 class="font-strong m-b-10 m-t-10">{{ ucfirst($delivery->first_name) }} {{ ucfirst($delivery->last_name) }}</h5>
                    {{-- <div class="m-b-20 text-muted">{{ $delivery->delivery_code }}</div> --}}
                    <div class="profile-social m-b-20">
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
        
        <div class="col-lg-9 col-md-8">
            <div class="ibox">
                <div class="ibox-body">
                    
                    <div class="tab-content">
                        @include('admin.layouts.error')
                        
                        <div class="tab-pane fade  show active" id="tab-2">
                            
                            
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label>First Name</label>
                                    <?php 
                                 if(isset($delivery->first_name)){

                                 ?>
                                <p>
                                    {{ $delivery->first_name }}
                              </p>  

                            <?php }
                            else {

                            ?>
                            <p style="color:red;">Provide Your Information !</p>
                            <?php } ?>
                                </div>
                                    
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label>Last Name</label>
                                        <?php 
                                     if(isset($delivery->last_name)){
    
                                     ?>
                                    <p>
                                        {{ $delivery->last_name }}
                                    </p>  
    
                                <?php }
                                else {
    
                                ?>
                                <p style="color:red;">Provide Your Information !</p>
                                <?php } ?>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        
        
        {{-- Basic Information --}}
        <div class="row">
            <div class="col-md-12">
                <div class="ibox ibox-success">
                    <div class="ibox-head custom-heading">
                        <div class="ibox-title top-heading">Basic Information</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                            
                        </div>
                    </div>
                    <div class="ibox-body">
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Email</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($delivery->email)){ ?>
                                    <p>{{ $delivery->email }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>  
                    </div>
                    
                </div>
            </div>
        </div>
        {{-- /. Basic Information --}}
        
        
    </div>

<a href="{{ url('/ns-delivery/my-profile/edit') }}" class="btn btn-primary btn-lg">Update Your Profile Information</a>
    
     
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
