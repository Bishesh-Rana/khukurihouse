@section('title')

Products | {{env('APP_NAME')}}

@stop
@extends('seller.layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">
        <?php if (isset($product)) {
            echo "Edit";
            $action =  route('seller.product.update', $product->id);
            $button = 'Update';
        } else {
            echo "Add";
            $action = route('seller.product.store');
            $button = 'Add';
        }
        ?> Product</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<br />

@include('admin.layouts.error')
<form method="POST" id="upload_form" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    {{-- What You Are Selling Section --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">What You're Selling</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Name</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_name" placeholder="eg :: Converse Chuck Taylor All Star Brown Hi Shoes" type="text" value="<?php if (isset($product->product_name)) {
                                                                                                    echo $product->product_name;
                                                                                                } else {
                                                                                                    echo old('product_name');
                                                                                                } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Product SKU</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_sku" placeholder="eg :: UGG-BB-PUR-06" type="text" value="<?php if (isset($product->product_sku)) {
                                                                                                    echo $product->product_sku;
                                                                                                } else {
                                                                                                    echo old('product_sku');
                                                                                                } ?>">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Code</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_code" placeholder="eg :: Dell G7 15 7588" type="text" value="<?php if (isset($product->product_code)) {
                                                                                                    echo $product->product_code;
                                                                                                } else {
                                                                                                    echo old('product_code');
                                                                                                } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Brand</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_brand" placeholder="eg :: Suzuki,Dell,Nokia" type="text" value="<?php if (isset($product->product_brand)) {
                                                                                                    echo $product->product_brand;
                                                                                                } else {
                                                                                                    echo old('product_brand');
                                                                                                } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Model</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_model" placeholder="eg :: 2018,2019" type="text" value="<?php if (isset($product->product_model)) {
                                                                                                    echo $product->product_model;
                                                                                                } else {
                                                                                                    echo old('product_model');
                                                                                                } ?>">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /. What You Are Selling Section --}}

    {{-- Category Selection --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Your Product Category</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">

                    @if(isset($product))
                    <input type="hidden" name="sub_child_category" id="sub_child_category" value="{{$product->category_id}}">
                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Original Category</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <p>{{$category_tree}}</p>
                        </div>
                    </div>
                    @endif

                    <!-- <div class="row" style="display:none;" id="prashant"> -->
                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <b><label class="product-form-label">For Category Edit</label></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Parent Category</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <select class="form-control select2_demo_1" name="category_id" id="category_id" onchange="getNextChildren(event,this,0)">
                                <option value="0" selected disabled>None</option>
                                @foreach($categories as $row)
                                <option <?php
                                        if (isset($product) && $row->id == $product->category_id) {
                                            echo "selected";
                                        }
                                        ?> value="{{ $row->id }}">{{ ucwords($row->category_name) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row" id="sub-cat">

                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /. Category Selection --}}


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
                            <label class="product-form-label">Highlights</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input ckeditor" name="product_highlights" rows="10"><?php if (isset($product->product_highlights)) {
                                                                                                                    echo $product->product_highlights;
                                                                                                                } else {
                                                                                                                    echo old('product_highlights');
                                                                                                                } ?></textarea>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Description</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input ckeditor" name="product_description" rows="10"><?php if (isset($product->product_description)) {
                                                                                                                    echo $product->product_description;
                                                                                                                } else {
                                                                                                                    echo old('product_description');
                                                                                                                } ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Warrenty Type</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <select name="product_warranty_type" class="form-control" value="{{old('product_warranty_type')}}">
                                <option value="none" selected disabled>--- Select Warrent Type ---</option>
                                <option <?php if (isset($product) && $product->product_warranty_type === 'international_manufacturer_warranty') {
                                            echo "selected";
                                        } ?> value="international_manufacturer_warranty">International Manufacturer Warranty</option>
                                <option <?php if (isset($product) && $product->product_warranty_type === 'non_local_warranty') {
                                            echo "selected";
                                        } ?> value="non_local_warranty">Non-local warranty</option>
                                <option <?php if (isset($product) && $product->product_warranty_type === 'local_seller_warranty') {
                                            echo "selected";
                                        } ?> value="local_seller_warranty">Local seller warranty</option>
                                <option <?php if (isset($product) && $product->product_warranty_type === 'no_warranty') {
                                            echo "selected";
                                        } ?> value="no_warranty">No Warranty</option>
                                <option <?php if (isset($product) && $product->product_warranty_type === 'international_seller_warranty') {
                                            echo "selected";
                                        } ?> value="international_seller_warranty">International Seller Warranty</option>
                                <option <?php if (isset($product) && $product->product_warranty_type === 'international_warranty') {
                                            echo "selected";
                                        } ?> value="international_warranty">International Warranty</option>
                                <option <?php if (isset($product) && $product->product_warranty_type === 'local_warranty') {
                                            echo "selected";
                                        } ?> value="local_warranty">Local Warranty</option>
                                <option <?php if (isset($product) && $product->product_warranty_type === 'original_product') {
                                            echo "selected";
                                        } ?> value="original_product">100 % Original Product</option>
                                <option <?php if (isset($product) && $product->product_warranty_type === 'brand_warranty') {
                                            echo "selected";
                                        } ?> value="brand_warranty">Brand Warranty</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Warrenty Period</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_warrenty_period" placeholder="eg :: 1 month,6months, 1 year" type="text" value="<?php if (isset($product->product_warrenty_period)) {
                                                                                                                echo $product->product_warrenty_period;
                                                                                                            } else {
                                                                                                                echo old('product_warrenty_period');
                                                                                                            } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Original Price</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_original_price" placeholder="eg :: 500,1000" type="number" value="<?php if (isset($product->product_original_price)) {
                                                                                                                echo $product->product_original_price;
                                                                                                            } else {
                                                                                                                echo old('product_original_price');
                                                                                                            } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Compare Price</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_compare_price" placeholder="eg :: 500,1000" type="number" value="<?php if (isset($product->product_compare_price)) {
                                                                                                                echo $product->product_compare_price;
                                                                                                            } else {
                                                                                                                echo old('product_compare_price');
                                                                                                            } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Warrenty Policy</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_warrenty_policy" placeholder="eg :: Not applicable on external damange" type="text" value="<?php if (isset($product->product_warrenty_policy)) {
                                                                                                                echo $product->product_warrenty_policy;
                                                                                                            } else {
                                                                                                                echo old('product_warrenty_policy');
                                                                                                            } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">What Is In Box ?</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_whats_on_box" placeholder="eg :: Mobile, Charger, Earphone" type="text" value="<?php if (isset($product->product_whats_on_box)) {
                                                                                                            echo $product->product_whats_on_box;
                                                                                                        } else {
                                                                                                            echo old('product_whats_on_box');
                                                                                                        } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Package Weight</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-5 form-group">
                            <input class="form-control" name="product_package_weight" placeholder="eg :: 0.2, 0.5, 1" type="number" step="0.01" min="0" value="<?php if (isset($product->product_package_weight)) {
                                                                                                                        echo $product->product_package_weight;
                                                                                                                    } else {
                                                                                                                        echo old('product_package_weight');
                                                                                                                    } ?>">
                        </div>
                        <div class="col-sm-5 form-group">
                        <select class="form-control custom-select" name="weight_measure">
                                @foreach($measures as $row)
                                <option <?php if (isset($product) && $row->id == $product->weight_measure) {
                                            echo "selected";
                                        } ?> value="{{ $row->id }}">{{ ucwords($row->measure_name) }}</option>
                                @endforeach
                        </select>
                    </div>  
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Package Dimension</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_package_dimension" placeholder="eg :: 12cm*10cm*5cm" type="text" value="<?php if (isset($product->product_package_dimension)) {
                                                                                                                echo $product->product_package_dimension;
                                                                                                            } else {
                                                                                                                echo old('product_package_dimension');
                                                                                                            } ?>">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Video Url</label>
                        </div>

                        <div class="col-sm-10 form-group">

                            <div class="input-group">
                                <span class="input-group-addon" style="background-color:#e3e3e3;" id="basic-addon3">https://www.youtube.com/watch?v=</span>
                                <input type="text" name="product_video_url" class="form-control" placeholder="Enter Key Here.." id="basic-url" aria-describedby="basic-addon3" value="<?php if (isset($product->product_video_url)) {
                                                                                                                                                                                            echo $product->product_video_url;
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo old('product_video_url');
                                                                                                                                                                                        } ?>">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /. Basic Information --}}


    {{-- Key Product Information --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Key Product Information</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>

                    </div>
                </div>
                <div class="ibox-body">
                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Key Featured</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input ckeditor" name="product_key_features" rows="10"><?php if (isset($product->product_key_features)) {
                                                                                                                        echo $product->product_key_features;
                                                                                                                    } else {
                                                                                                                        echo old('product_key_features');
                                                                                                                    } ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- /. Key Product Information --}}



    {{-- Upload Products Images --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Upload Products Images</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>

                    </div>
                </div>
                <div class="ibox-body">

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Image</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">

                            <div class="custom-file" style="width:40%">
                                <input type="file" name="image" id="pro_image">
                                <img src="" id="profile-img-tag" width="200px" height="100px" style="display:none;" />

                            </div>
                            @if (!empty($product->image))
                            <hr>
                            <img id="product-image" src="{{ asset('uploads/'.'products/'.$product->image) }}" alt="<?php if (isset($product->name)) {
                                                                                                    echo $product->name;
                                                                                                } ?>" height="100" width="100">
                            <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>

                            @endif

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Gallery</label><span class="alert-astrisk"> *</span> <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                        </div>

                        
                        
                        <div class="col-sm-10 form-group" id="dynamic_field">
                            @if(isset($product->photos))
                            @foreach($product->photos as $key => $photo)
                            <!-- <div class="col-sm-10 form-group"> -->
                            <span>
                            <img src="{{ asset('uploads/'.'products/'.$photo->image) }}" id="count-{{$key+1}}" alt="<?php if (isset($product->name)) {
                                    echo $product->name;
                                } ?>" height="100" width="100">
                                <a href="#" id="delete-image" data-value="{{$photo->id}}" class="btn btn-danger btn-circle btn-xs delete-image"><i class="fa fa-times"></i></a>
                                </span><!-- </div> -->
                            @endforeach
                            <input type="hidden" id="totalCount" value="{{count($photos)}}">
                            @else
                            <input type="hidden" id="totalCount" value="0">
                            @endif
                        </div>    
                        
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Image Alt Tag</label>
                        </div>
                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input" name="alt" rows="1"><?php if (isset($product->alt)) {
                                                                                            echo $product->alt;
                                                                                        } else {
                                                                                            echo old('alt');
                                                                                        } ?></textarea>
                        </div>
                    </div>
                    
                    <br><br>
                    <!-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Product Multi Image</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group" class="display-img">

                            <div class="custom-file" style="width:40%">
                                <input type="file" name="pro_multi_images[]" multiple id="pro_multi_images">
                            </div>

                        </div>

                    </div> -->

                    <!-- <div class="row">
                        @if(isset($product))
                        @foreach($product_photos as $row)

                        <div class="col-lg-2">
                            <div class="contain">
                                <img src="{{ asset('uploads/products/'.$row->image) }}" alt="" height="100" class="disp_img" />
                                <div class="overlay">
                                    <a target="_blank" href="{{ asset('uploads/products/'.$row->image) }}" title="View" class="btn btn-danger btn-circle btn-xs product-search-icon"><i class="fa fa-search"></i></a>
                                    <a title="Delete" class="btn btn-danger btn-circle btn-xs product-delete-icon" href="{{ route('seller.product.img.delete', $row->id) }}" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div> -->

                </div>
            </div>
        </div>
    </div>
    {{-- /. Upload Products Images --}}


    {{-- SEO Description --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">SEO Description</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>

                    </div>
                </div>
                <div class="ibox-body">


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Meta Title</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input" name="meta_title" rows="10"><?php if (isset($product->meta_title)) {
                                                                                                    echo $product->meta_title;
                                                                                                } else {
                                                                                                    echo old('meta_title');
                                                                                                } ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Meta Keyword</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input" name="meta_keyword" rows="10"><?php if (isset($product->meta_keyword)) {
                                                                                                        echo $product->meta_keyword;
                                                                                                    } else {
                                                                                                        echo old('meta_keyword');
                                                                                                    } ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Meta Description</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input" name="meta_description" rows="10"><?php if (isset($product->meta_description)) {
                                                                                                            echo $product->meta_description;
                                                                                                        } else {
                                                                                                            echo old('meta_description');
                                                                                                        } ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Publish Status</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <div class="check-list">

                                <label class="ui-radio ui-radio-primary">
                                    <input type="radio" name="publish_status" value="0" <?php echo (isset($product->publish_status) ? ((isset($product->publish_status) && ($product->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                    <span class="input-span"></span>
                                    Banned
                                </label>
                                <label class="ui-radio ui-radio-primary">
                                    <input type="radio" name="publish_status" value="1" <?php echo (isset($product->publish_status) && ($product->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                    <span class="input-span"></span>
                                    Active
                                </label>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    {{-- /. SEO Description --}}

    <button class="btn btn-info" type="submit">{{ $button }}</button>
    <a class="btn btn-warning" href="{{ route('seller.product.index') }}">Cancel</a>
</form>


<!-- END PAGE CONTENT-->
@stop

@section('footer')

    
<!-- Dynamic Forms jQuery -->
<script>

    $("input:radio[name='warranty']").on('click', function() {
        if ($(this).val() === '1') {
            $("input[name='warranty_period']").removeAttr("disabled");
            $("textarea[name='warranty_description']").removeAttr("disabled");
        } else {
            $("input[name='warranty_period']").attr("disabled", "disabled");
            $("textarea[name='warranty_description']").attr("disabled", "disabled");
        }
    });
</script>

<!-- Multiple image -->

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    var i = $('#totalCount').val();
    if(i == 8)
    {
        $('#add').css('display','none');
    }
    
    $('#add').click(function(){
        if(i == 7){
            $('#add').css('display','none');
        }
        console.log('working');
        i++;
        $('#dynamic_field').append('<div id="row'+i+'" class="custom-file" style="width:25%"> <input type="file" class="this-one" data-value="'+i+'" name="multi_image[]"><img src="" id="profile-img-tag'+i+'" width="80px"/> <button type="button" id="'+i+'" class="btn btn-success btn_remove" style="margin:10px;">Remove</button></div>');
    });

    $(document).on('click','.btn_remove',function(){
        var button_id = $(this).attr("id");
        // console.log(button_id);
        i--;
        $('#add').css('display','');
        $("#row"+button_id+"").remove();
    });

    $(document).on('change',".this-one",function(){
        // console.log(i);
        var j = $(this).data('value');
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#profile-img-tag"+j+"").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        readURL(this);
    });

    $(document).on('click',".delete-image",function(e){
        e.preventDefault();

        let filterObject = {
            imageId: null,
        }
        filterObject.imageId = $(this).data('value');
        // return false;

       var parent = $(this).parent().closest('span');
       
        $(parent).hide();

        $.ajax({
            url: '{{route('seller.deleteSingeImage')}}',
            method: "GET",
            data: filterObject,
            dataType: 'JSON',
            success: function(resp) {
                if (resp.status == 'success') {
                    if(i == 8)
                    {
                        $('#add').css('display','block');
                    }
                    i--;
                    // $('#table-data').html('');
                    Lobibox.notify(resp.status, {
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        width: 400,
                        msg: resp.message,
                        delay: 3000,
                    });
                $('#delete').css('display', 'none');
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
                    msg: 'Internal Server Error.'
                });
                $(".dropify-clear").click();
            }
        });
    });
    
    
});
</script>
<!-- Multiple image -->


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#pro_image').change(function(e) {
            e.preventDefault();
            var formData = new FormData(upload_form);
            $.ajax({
                url: "{{URL::route('seller.productimage')}}",
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
                        msg: 'Internal Server Error.'
                    });
                    $(".dropify-clear").click();
                }
            });
        });
    });
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let nextChildrenTrial = 0;

    function getNextChildren(event, element, childTrial = 0) {
        let parent_id = event.target.value;
        let index = childTrial + 1;

        if (event.target.id === 'sub_category_id' || event.target.id === 'category_id') {
            while (index < nextChildrenTrial) {
                console.log(index);
                document.getElementById("child-label-" + index).remove();
                document.getElementById("child-" + index).remove();
                index++;
            }
            nextChildrenTrial = childTrial + 1;
            event.target.name = 'sub_child_category_id';
            event.target.id = 'sub_child_category_id';
        }

        if (parent_id != 'none') {
            $.ajax({
                url: "{{ route('seller.getsubcategory') }}",
                method: "POST",
                data: {
                    parent_id: parent_id,
                    trial: nextChildrenTrial
                },
            }).then(function(data) {
                $('#sub-cat').css('display', '');
                $('#sub-cat').append(data);
                $(".select2_demo_1").select2();
                event.target.name = 'sub_category_id';
                event.target.id = 'sub_category_id';
                nextChildrenTrial++;
            }).fail(function(xhr, textStatus, errorThrown) {
                console.log("End Reached!!");
            });
        } else {
            $('#sub-cat').css('display', 'none');
        }
    }
</script>


<script>
    $(document).ready(function() {
        let status = "";
        $('#category_id').change(function(e) {
            status = "categoryChange";
        });

        $('#upload_form').submit(function(e) {
            e.preventDefault();

            let form = document.getElementById('upload_form');

            if (status == "categoryChange") {
                let test = form['sub_child_category_id'].value;

                if (test > 0) {
                    form.submit();
                } else {
                    Lobibox.notify('warning', {
                        continueDelayOnInactiveTab: true,
                        msg: 'Please select all category level'
                    });
                }
            } else {
                form.submit();
            }
        });


    });
</script>


<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#pro_image").change(function() {
        $('#profile-img-tag').css('display', '');
        readURL(this);
    });
</script>

<!-- Delete(Hide) image -->
<script>
    $(document).ready(function() {
        $('a#delete').click(function(){
            $('img#product-image').hide();
            $('a#delete').hide();
        })
    });
</script>


@include('admin.layouts.ckeditor')

@stop