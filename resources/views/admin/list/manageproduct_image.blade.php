@section('title')

Manage Image | {{env('APP_NAME')}}

@stop

@extends('admin.layouts.app')


@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading" style="margin-top:14px;">
    
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
    
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Product</div>
            </div>
            <div class="ibox-body">
                @include('admin.layouts.error')
                
                <table id="manage_image" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>All Images</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $row)
                        <tr>
                            <td>{{ $row->product_name }}</td>
                            <td>{{ $row->product_sku }}</td>
                            
                            <td>
                                
                                
                                <form method="POST" id="upload_form"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="photo-section" style="width:240px;">
                                        <div class="photo-place">
                                            <input type="file" class="form-control img-display" name="image"/>
                                            <input type="hidden" value="{{ $row->id }}" name="product_id">
                                            <input type="hidden" name="image_id" value="<?php if(isset($row->images[0]) ) echo $row->images[0]->id; else ''; ?>">
                                            <img src="" class="show-img"  width="200px" /></div>
                                            
                                            @if(isset($row->images[0]))
                                          
                                            <img src="{{ asset('uploads/products/'.$row->images[0]->image) }}" class="db-show-img"  width="200px" />
                                            <div class="product-images-search-icon">
                                                <a target="_blank" href="{{ asset('uploads/products/'.$row->images[0]->image) }}" title="View" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-search"></i></a>
                                                <a title="Delete" class="btn btn-danger btn-circle btn-xs" href="{{ route('admin.product.manage.img.delete', $row->images[0]->id) }}" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-times"></i></a>
                                            </div>
                                       
                                            @endif
                                        </div>
                                        
                                    </form>
                                    
                                    <form method="POST" id="upload_form"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="photo-section" style="width:240px;">
                                            <div class="photo-place">
                                                <input type="file" class="form-control img-display" name="image"/>
                                                <input type="hidden" value="{{ $row->id }}" name="product_id">
                                                <input type="hidden" name="image_id" value="<?php if(isset($row->images[1]) ) echo $row->images[1]->id; else ''; ?>">
                                                <img src="" class="show-img"  width="200px" /></div>
                                                @if(isset($row->images[1]))
                                                <img src="{{ asset('uploads/products/'.$row->images[1]->image) }}" class="db-show-img"  width="200px" />
                                                <div class="product-images-search-icon">
                                                    <a target="_blank" href="{{ asset('uploads/products/'.$row->images[1]->image) }}" title="View" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-search"></i></a>
                                                    <a title="Delete" class="btn btn-danger btn-circle btn-xs" href="{{ route('admin.product.manage.img.delete', $row->images[1]->id) }}" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-times"></i></a>
                                                </div>
                                                @endif
                                            </div>
                                        </form>
                                        
                                        <form method="POST" id="upload_form" data-id="upload_form"  enctype="multipart/form-data">
                                            @csrf
                                            <div class="photo-section" style="width:240px;">
                                                <div class="photo-place">
                                                    <input type="file" class="form-control img-display" name="image"/>
                                                    <input type="hidden" value="{{ $row->id }}" name="product_id">
                                                    
                                                    <input type="hidden" name="image_id" value="<?php if(isset($row->images[2]) ) echo $row->images[2]->id; else ''; ?>">
                                                    <img src="" class="show-img"  width="200px" /></div>
                                                    @if(isset($row->images[2]))
                                                    <img src="{{ asset('uploads/products/'.$row->images[2]->image) }}" class="db-show-img"  width="200px" />
                                                    <div class="product-images-search-icon">
                                                        <a target="_blank" href="{{ asset('uploads/products/'.$row->images[2]->image) }}" title="View" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-search"></i></a>
                                                        <a title="Delete" class="btn btn-danger btn-circle btn-xs" href="{{ route('admin.product.manage.img.delete', $row->images[2]->id) }}" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-times"></i></a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </form>
                                            
                                            <form method="POST" id="upload_form"  enctype="multipart/form-data">
                                                @csrf
                                                <div class="photo-section" style="width:240px;">
                                                    <div class="photo-place">
                                                        <input type="file" class="form-control img-display" name="image"/>
                                                        <input type="hidden" value="{{ $row->id }}" name="product_id">
                                                        <input type="hidden" name="image_id" value="<?php if(isset($row->images[3]) ) echo $row->images[3]->id; else ''; ?>">
                                                        <img src="" class="show-img"  width="200px" /></div>
                                                        @if(isset($row->images[3]))
                                                        <img src="{{ asset('uploads/products/'.$row->images[3]->image) }}" class="db-show-img"  width="200px" />
                                                        <div class="product-images-search-icon">
                                                            <a target="_blank" href="{{ asset('uploads/products/'.$row->images[3]->image) }}" title="View" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-search"></i></a>
                                                            <a title="Delete" class="btn btn-danger btn-circle btn-xs" href="{{ route('admin.product.manage.img.delete', $row->images[3]->id) }}" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-times"></i></a>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </form>
                                                
                                                <form method="POST" id="upload_form"  enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="photo-section" style="width:240px;">
                                                        <div class="photo-place">
                                                            <input type="file" class="form-control img-display" name="image"/>
                                                            <input type="hidden" value="{{ $row->id }}" name="product_id">
                                                            <input type="hidden" name="image_id" value="<?php if(isset($row->images[4]) ) echo $row->images[4]->id; else ''; ?>">
                                                            <img src="" class="show-img"  width="200px" /></div>
                                                            @if(isset($row->images[4]))
                                                            <img src="{{ asset('uploads/products/'.$row->images[4]->image) }}" class="db-show-img"  width="200px" />
                                                            <div class="product-images-search-icon">
                                                                <a target="_blank" href="{{ asset('uploads/products/'.$row->images[4]->image) }}" title="View" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-search"></i></a>
                                                                <a title="Delete" class="btn btn-danger btn-circle btn-xs" href="{{ route('admin.product.manage.img.delete', $row->images[4]->id) }}" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-times"></i></a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </form>
                                                    
                                                    <form method="POST" id="upload_form"  enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="photo-section" style="width:240px;">
                                                            <div class="photo-place">
                                                                <input type="file" class="form-control img-display" name="image"/>
                                                                <input type="hidden" value="{{ $row->id }}" name="product_id">
                                                                <input type="hidden" name="image_id" value="<?php if(isset($row->images[5]) ) echo $row->images[5]->id; else ''; ?>">
                                                                
                                                                <img src="" class="show-img"  width="200px" /></div>
                                                                @if(isset($row->images[5]))
                                                                <img src="{{ asset('uploads/products/'.$row->images[5]->image) }}" class="db-show-img"  width="200px" />
                                                                <div class="product-images-search-icon">
                                                                    <a target="_blank" href="{{ asset('uploads/products/'.$row->images[5]->image) }}" title="View" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-search"></i></a>
                                                                    <a title="Delete" class="btn btn-danger btn-circle btn-xs" href="{{ route('admin.product.manage.img.delete', $row->images[5]->id) }}" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-times"></i></a>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </form>
                                                        
                                                        <form method="POST" id="upload_form"  enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="photo-section" style="width:240px;">
                                                                <div class="photo-place">
                                                                    <input type="file" class="form-control img-display" name="image"/>
                                                                    <input type="hidden" value="{{ $row->id }}" name="product_id">
                                                                    <input type="hidden" name="image_id" value="<?php if(isset($row->images[6]) ) echo $row->images[6]->id; else ''; ?>">
                                                                    
                                                                    <img src="" class="show-img"  width="200px" /></div>
                                                                    @if(isset($row->images[6]))
                                                                    <img src="{{ asset('uploads/products/'.$row->images[6]->image) }}" class="db-show-img"  width="200px" />
                                                                    <div class="product-images-search-icon">
                                                                        <a target="_blank" href="{{ asset('uploads/products/'.$row->images[6]->image) }}" title="View" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-search"></i></a>
                                                                        <a title="Delete" class="btn btn-danger btn-circle btn-xs" href="{{ route('admin.product.manage.img.delete', $row->images[6]->id) }}" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-times"></i></a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </form>
                                                            
                                                            <form method="POST" id="upload_form"  enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="photo-section" style="width:240px;">
                                                                    <div class="photo-place">
                                                                        <input type="file" class="form-control img-display" name="image"/>
                                                                        <input type="hidden" value="{{ $row->id }}" name="product_id">
                                                                        <input type="hidden" name="image_id" value="<?php if(isset($row->images[7]) ) echo $row->images[7]->id; else ''; ?>">
                                                                        
                                                                        <img src="" class="show-img"  width="200px" /></div>
                                                                        @if(isset($row->images[7]))

                                                                        <img src="{{ asset('uploads/products/'.$row->images[7]->image) }}" class="db-show-img"  width="200px" />
                                                                        <div class="product-images-search-icon">
                                                                            <a target="_blank" href="{{ asset('uploads/products/'.$row->images[7]->image) }}" title="View" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-search"></i></a>
                                                                            <a title="Delete" class="btn btn-danger btn-circle btn-xs" href="{{ route('admin.product.manage.img.delete', $row->images[7]->id) }}" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-times"></i></a>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </form>
                                                                
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            
                                                            <th>Product Name</th>
                                                            <th>SKU</th>
                                                            <th>All Images</th>
                                                            
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- END PAGE CONTENT-->
                                    
                                    @stop
                                    
                                    @section('footer')
                                    
                                    <script>
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $(document).ready(function() {
                                            $('.img-display').change(function(e) {
                                                e.preventDefault();                    
                                                var upload_form_id =  $(this).closest('form');               
                                                var formData = new FormData(upload_form_id[0]);
                                                image(formData);
                                            });
                                        });
                                        
                                        function image(formData){
                                            $.ajax({
                                                url: "{{ route('admin.manage.productimage')}}",
                                                method: "POST",
                                                data: formData,
                                                dataType: 'JSON',
                                                contentType: false,
                                                cache: false,
                                                processData: false,
                                                success: function(resp) {
                                                    if (resp.status == 'success') {
                                                        Lobibox.notify(resp.status, {
                                                            showClass: 'fadeInDown',
                                                            hideClass: 'fadeUpDown',
                                                            width: 400,
                                                            msg: resp.message,
                                                            delay: 3000,
                                                        });
                                                        
                                                        // $('.db-show-img').css('display', 'none');
                                                    } else {
                                                        Lobibox.notify(resp.status, {
                                                            showClass: 'fadeInDown',
                                                            hideClass: 'fadeUpDown',
                                                            width: 400,
                                                            msg: resp.message['image'],
                                                            delay: 3000,
                                                        });
                                                        $(".dropify-clear").click();
                                                    }
                                                },
                                                error: function(resp) {
                                                    Lobibox.notify('default', {
                                                        continueDelayOnInactiveTab: true,
                                                        size: 'mini',
                                                        delayIndicator: false,
                                                        msg: 'Inte.'
                                                    });
                                                    $(".dropify-clear").click();
                                                }
                                            });
                                        }
                                    </script>
                                    
                                    <script type="text/javascript">
                                        function readURL(input, display_loc) {
                                            
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                
                                                reader.onload = function (e) {
                                                    //   var display_loc = '#'+id+'_display';
                                                    $(display_loc).attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                        
                                        $(".img-display").change(function(){
                                            var parent = $(this).closest('.photo-section');
                                            // console.log(parent);
                                            
                                            var display_loc = $(parent).find('.show-img');
                                            // console.log(display_loc);
                                            readURL(this,display_loc);
                                            
                                        });
                                    </script>
                                    
                                    @endsection
                                    
