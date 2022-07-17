@section('title')

Profile| {{env('APP_NAME')}}

@stop
@extends('seller.layouts.app')

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
        $percent = $profile_count*5.5555555555555555555555555555556;

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
                        @if(isset($seller->image))
                        <img class="img-circle" src="{{ asset('uploads/sellers/'.$seller->image) }}"/>
                        @else
                        <img class="img-circle" src="{{ asset('uploads/others/admin-avatar.png') }}"/>
                        @endif
                    </div>
                    <h5 class="font-strong m-b-10 m-t-10">{{ ucfirst($seller->first_name) }} {{ ucfirst($seller->last_name) }}</h5>
                    <div class="m-b-20 text-muted">{{ $seller->seller_code }}</div>
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
                                 if(isset($seller->first_name)){

                                 ?>
                                <p>
                                    {{ $seller->first_name }}
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
                                     if(isset($seller->last_name)){
    
                                     ?>
                                    <p>
                                        {{ $seller->last_name }}
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
                                <label class="product-form-label">Middle Name (Optional)</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                              <?php if(isset($seller->middle_name)){ ?>
                              <p>{{ $seller->middle_name }}</p>
                              <?php } else{ ?>
                                <p style="color:red;">Provide Your Information !</p>
                              <?php } ?>
                            </div>    
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Phone</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->company_phone)){ ?>
                                    <p>{{ $seller->company_phone }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Email</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->email)){ ?>
                                    <p>{{ $seller->email }}</p>
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
        
        
        {{-- Company information --}}
        <div class="row">
            <div class="col-md-12">
                <div class="ibox ibox-success">
                    <div class="ibox-head custom-heading">
                        <div class="ibox-title top-heading">Company information</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                            
                        </div>
                    </div>
                    <div class="ibox-body">
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Company Legal Name</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                             <?php if(isset($seller->company_name)){ ?>
                            <p>{{ $seller->company_name }}</p>
                            <?php } else{ ?>
                                <p style="color:red;">Provide Your Information !</p>
                            <?php } ?>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Company Website (Optional)</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->company_website)){ ?>
                                    <p>{{ $seller->company_website }}</p>
                                    <?php } else{ ?>
                                        <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label"> Company Short Description</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->company_description)){ ?>
                                    <p>{!! $seller->company_description !!}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        {{-- /.Company information --}}
        
        
        {{-- Contact Address Info --}}
        <div class="row">
            <div class="col-md-12">
                <div class="ibox ibox-success">
                    <div class="ibox-head custom-heading">
                        <div class="ibox-title top-heading">Contact Address Information</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                            
                        </div>
                    </div>
                    <div class="ibox-body">
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Country</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->company_country)){ ?>
                                    <p>{{ $seller->company_country }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">City</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->company_city)){ ?>
                                    <p>{{ $seller->company_city }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">State</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->company_state)){ ?>
                                    <p>{{ $seller->company_state }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>   
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Zip Code</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->zip_code)){ ?>
                                    <p>{{ $seller->zip_code }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>   
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Address</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->company_address)){ ?>
                                    <p>{{ $seller->company_address }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>   
                        
                    </div>
                    
                </div>
            </div>
        </div>
        {{-- /. Contact Address Info --}}
        
        {{-- Bank Detail --}}
        <div class="row">
            <div class="col-md-12">
                <div class="ibox ibox-success">
                    <div class="ibox-head custom-heading">
                        <div class="ibox-title top-heading">Bank Detail</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                            
                        </div>
                    </div>
                    <div class="ibox-body">
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Bank Name </label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->bank_name)){ ?>
                                    <p>{{ $seller->bank_name }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Bank Account Number</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->bank_acc_number)){ ?>
                                    <p>{{ $seller->bank_acc_number }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Pan no.</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->pan_no)){ ?>
                                    <p>{{ $seller->pan_no }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div> 
                        
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Vat no.</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <?php if(isset($seller->vat_no)){ ?>
                                    <p>{{ $seller->vat_no }}</p>
                                    <?php } else{ ?>
                                      <p style="color:red;">Provide Your Information !</p>
                                    <?php } ?>
                            </div>    
                        </div> 
                        
                    </div>
                    
                </div>
            </div>
        </div>
        {{-- /.Bank Detail --}}
        
    </div>

<a href="{{ route('seller.form.edit') }}" class="btn btn-primary btn-lg">Update Your Profile Information</a>
    
    
    
    
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
