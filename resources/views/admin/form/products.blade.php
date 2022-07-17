@section('title')

Products | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">
        <?php if (isset($product)) {
            echo "Edit";
        } else {
            echo "Add";
        }

        if (isset($product)) {
            $action =  route('product.update', $product->id);
            $button = 'Update';
        } else {

            $action =   route('product.store');
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
                                                                                                                                                                        echo str_replace('"', '', $product->product_name);
                                                                                                                                                                    } else {
                                                                                                                                                                        echo old('product_name');
                                                                                                                                                                    } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-sku">Product SKU</label><span class="alert-astrisk"> *</span>
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
                            <label class="product-form-label-code">Code</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_code" placeholder="eg :: Dell G7 15 7588" type="text" value="<?php if (isset($product->product_code)) {
                                                                                                                                        echo $product->product_code;
                                                                                                                                    } else {
                                                                                                                                        echo old('product_code');
                                                                                                                                    } ?>">
                        </div>
                    </div>


                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-brand">Brand</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_brand" placeholder="eg :: Suzuki,Dell,Nokia" type="text" value="<?php if (isset($product->product_brand)) {
                                                                                                                                            echo $product->product_brand;
                                                                                                                                        } else {
                                                                                                                                            echo old('product_brand');
                                                                                                                                        } ?>">
                        </div>
                    </div> --}}

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
                            <label class="product-form-label-parent">Parent Category</label><span class="alert-astrisk"> *</span>
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

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-hightlights">Highlights</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input ckeditor" id="my-editor" name="product_highlights" rows="10"><?php if (isset($product->product_highlights)) {
                                                                                                                                    echo $product->product_highlights;
                                                                                                                                } else {
                                                                                                                                    echo old('product_highlights');
                                                                                                                                } ?></textarea>
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">
                                Blade</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="blade" placeholder="" type="text" value="<?php if (isset($product->blade)) {
                                                                                                                                                                        echo $product->blade;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo old('blade');
                                                                                                                                                                    } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-sku">Handle</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="handle" placeholder="" type="text" value="<?php if (isset($product->handle)) {
                                                                                                                                    echo $product->handle;
                                                                                                                                } else {
                                                                                                                                    echo old('handle');
                                                                                                                                } ?>">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-code">Blade Weight</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="blade_weight" placeholder="" type="text" value="<?php if (isset($product->blade_weight)) {
                                                                                                                                        echo $product->blade_weight;
                                                                                                                                    } else {
                                                                                                                                        echo old('blade_weight');
                                                                                                                                    } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-code">Total Weight</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="total_weight" placeholder="" type="text" value="<?php if (isset($product->total_weight)) {
                                                                                                                                        echo $product->total_weight;
                                                                                                                                    } else {
                                                                                                                                        echo old('total_weight');
                                                                                                                                    } ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-code">Material</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="material" placeholder="" type="text" value="<?php if (isset($product->material)) {
                                                                                                                                        echo $product->material;
                                                                                                                                    } else {
                                                                                                                                        echo old('material');
                                                                                                                                    } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Description</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input ckeditor" id="description" name="product_description" rows="10"><?php if (isset($product->product_description)) {
                                                                                                                                        echo $product->product_description;
                                                                                                                                    } else {
                                                                                                                                        echo old('product_description');
                                                                                                                                    } ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-warrenty">Warrenty Type</label><span class="alert-astrisk"> *</span>
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
                            <label class="product-form-label-org">Original Price</label><span class="alert-astrisk"> *</span>
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
                            <label class="product-form-label-org">Cargo Price</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="cargo" placeholder="eg :: 500,1000 in dollar" type="number" value="<?php if (isset($product->cargo)) {
                                                                                                                                            echo $product->cargo;
                                                                                                                                        } else {
                                                                                                                                            echo old('cargo');
                                                                                                                                        } ?>">
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-com">Compare Price</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_compare_price" placeholder="eg :: 500,1000" type="number" value="<?php if (isset($product->product_compare_price)) {
                                                                                                                                            echo $product->product_compare_price;
                                                                                                                                        } else {
                                                                                                                                            echo old('product_compare_price');
                                                                                                                                        } ?>">
                        </div>
                    </div> --}}
{{--
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
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-in-box">What Is In Box ?</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_whats_on_box" placeholder="eg :: cover" type="text" value="<?php if (isset($product->product_whats_on_box)) {
                                                                                                                                                            echo $product->product_whats_on_box;
                                                                                                                                                        } else {
                                                                                                                                                            echo old('product_whats_on_box');
                                                                                                                                                        } ?>">
                        </div>
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-pack-weight">Package Weight</label><span class="alert-astrisk"> *</span>
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
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label-dimension">Package Dimension</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" name="product_package_dimension" placeholder="eg :: 12cm*10cm*5cm" type="text" value="<?php if (isset($product->product_package_dimension)) {
                                                                                                                                                    echo $product->product_package_dimension;
                                                                                                                                                } else {
                                                                                                                                                    echo old('product_package_dimension');
                                                                                                                                                } ?>">
                        </div>
                    </div> --}}


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

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">On Sale</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="on_sale" value="0" <?php echo (isset($product->on_sale) ? ((isset($product->on_sale) && ($product->on_sale == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                No
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="on_sale" value="1" <?php echo (isset($product->on_sale) && ($product->on_sale == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Yes
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Best Rated</label>
                        </div>

                        <div class="col-sm-10 form-group">

                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="best_rated" value="0" <?php echo (isset($product->best_rated) ? ((isset($product->best_rated) && ($product->best_rated == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                No
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="best_rated" value="1" <?php echo (isset($product->best_rated) && ($product->best_rated == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Yes
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Show On Home Page</label>
                        </div>

                        <div class="col-sm-10 form-group">

                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="showOnHome" value="0" <?php echo (isset($product->showOnHome) ? ((isset($product->showOnHome) && ($product->showOnHome == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                No
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="showOnHome" value="1" <?php echo (isset($product->showOnHome) && ($product->showOnHome == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Yes
                            </label>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">On Deal?</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="on_deal" value="0" <?php echo (isset($product->on_deal) ? ((isset($product->on_deal) && ($product->on_deal == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                No
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="on_deal" value="1" <?php echo (isset($product->on_deal) && ($product->on_deal == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Yes
                            </label>
                        </div>
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Deal Ends On</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input type="date" class="form-control" name="deal_end_date" value="<?php if (isset($product->deal_end_date)) {
                                                                                                    echo $product->deal_end_date;
                                                                                                } else {
                                                                                                    echo old('deal_end_date');
                                                                                                } ?>">
                        </div>
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Select Contents:</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <select class="form-control select2_demo_1" name="content_id[]" multiple="multiple">
                                @foreach($contents as $row)
                                <option <?php if (isset($product->contents))
                                            foreach ($product->contents as $cont) {
                                                if (isset($product) && $row->id == $cont->pivot->content_id) {
                                                    echo "selected";
                                                }
                                            } ?> value="{{ $row->id }}">{{ ucwords($row->content_title) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">On Sale</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="on_sale" value="0" <?php echo (isset($product->on_sale) ? ((isset($product->on_sale) && ($product->on_sale == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                No
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="on_sale" value="1" <?php echo (isset($product->on_sale) && ($product->on_sale == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Yes
                            </label>
                        </div>
                    </div> --}}

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Delivery Type</label>
                        </div>

                        <div class="col-sm-10 form-group">
                          @foreach ($deliveryType as $type)
                          <label class="ui-radio ui-radio-primary text-capitalize mr-2">
                            <input type="radio" name="deliveryType" value="{{ $type }}" @if(isset($product->deliveryType) &&  $product->deliveryType== $type) {{ "checked" }} @endif>
                            <span class="input-span"></span>
                          {{ $type }}
                        </label>
                          @endforeach

                        </div>
                    </div> --}}
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
                            <label class="product-form-label-ket-featured">Key Featured</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input ckeditor" id="key" name="product_key_features" rows="10"><?php if (isset($product->product_key_features)) {
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
                            <label class="product-form-label-img">Image(Main Photo)</label><span class="alert-astrisk"> *</span>
                        </div>

                        <div class="col-sm-10 form-group">

                            <div class="custom-file" style="width:40%">
                                <input type="file" name="image" id="pro_image">
                                <img src="" id="profile-img-tag" width="80px" />

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
                    <br>
                    <br>

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
                            <label class="product-form-label">Meta Title</label>
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
                            <label class="product-form-label">Meta Keyword</label>
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
                            <label class="product-form-label">Meta Description</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input" name="meta_description" rows="10"><?php if (isset($product->meta_description)) {
                                                                                                            echo $product->meta_description;
                                                                                                        } else {
                                                                                                            echo old('meta_description');
                                                                                                        } ?></textarea>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /. SEO Description --}}


    {{-- Product Verfication --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Product Verification</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>

                    </div>
                </div>
                <div class="ibox-body">

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Poor Quality</label>
                        </div>

                        <div class="col-sm-10 form-group">

                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="quality_status" value="0" <?php echo (isset($product->quality_status) ? ((isset($product->quality_status) && ($product->quality_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                Good
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="quality_status" value="1" <?php echo (isset($product->quality_status) && ($product->quality_status == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Poor
                            </label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Quality Rejected Reason(For Poor Quality)</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input" readonly name="quality_reject_reason" id="quality_reject_reason" rows="5"><?php if (isset($product->quality_reject_reason)) {
                                                                                                                                                    echo $product->quality_reject_reason;
                                                                                                                                                } else {
                                                                                                                                                    echo old('quality_reject_reason');
                                                                                                                                                } ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Quality Control Comment(For Poor Quality)</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input" readonly name="quality_control_comment" id="quality_control_comment" rows="5"><?php if (isset($product->quality_control_comment)) {
                                                                                                                                                        echo $product->quality_control_comment;
                                                                                                                                                    } else {
                                                                                                                                                        echo old('quality_control_comment');
                                                                                                                                                    } ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Policy Violation</label>
                        </div>

                        <div class="col-sm-10 form-group">

                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="policy_status" value="0" <?php echo (isset($product->policy_status) ? ((isset($product->policy_status) && ($product->policy_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                No
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="policy_status" value="1" <?php echo (isset($product->policy_status) && ($product->policy_status == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Yes
                            </label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Quality Rejected Reason(For Policy Violation)</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input" readonly name="policy_reject_reason" id="policy_reject_reason" rows="5"><?php if (isset($product->policy_reject_reason)) {
                                                                                                                                                echo $product->policy_reject_reason;
                                                                                                                                            } else {
                                                                                                                                                echo old('policy_reject_reason');
                                                                                                                                            } ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Quality Control Comment(For Policy Violation)</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input" readonly name="policy_control_comment" id="policy_control_comment" rows="5"><?php if (isset($product->policy_control_comment)) {
                                                                                                                                                    echo $product->policy_control_comment;
                                                                                                                                                } else {
                                                                                                                                                    echo old('policy_control_comment');
                                                                                                                                                } ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Penalty (For Policy Violation)</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" readonly name="penalty_type" id="penalty_type" type="text" value="<?php if (isset($product->penalty_type)) {
                                                                                                                                echo $product->penalty_type;
                                                                                                                            } else {
                                                                                                                                echo old('penalty_type');
                                                                                                                            } ?>">
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Publish Status</label>
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

                    {{-- <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Live Status</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <div class="check-list">

                                <label class="ui-radio ui-radio-primary">
                                    <input type="radio" name="live_status" value="0" <?php echo (isset($product->live_status) ? ((isset($product->live_status) && ($product->live_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                    <span class="input-span"></span>
                                    Banned
                                </label>
                                <label class="ui-radio ui-radio-primary">
                                    <input type="radio" name="live_status" value="1" <?php echo (isset($product->live_status) && ($product->live_status == 1)) ? 'checked="checked"' : ''; ?>>
                                    <span class="input-span"></span>
                                    Active
                                </label>

                            </div>
                        </div>
                    </div> --}}


                </div>

            </div>
        </div>
    </div>
    {{-- /. Product Verfication --}}


    <button class="btn btn-info" type="submit" id="product_form">{{ $button }}</button>
    <a class="btn btn-warning" href="{{ url('ns-admin/products') }}">Cancel</a>
</form>


<!-- END PAGE CONTENT-->
@stop

@section('footer')

<script src="{{ asset('js/validate.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#upload_form').validate({

            onkeyup: function(element) {
                this.element(element);
            },

            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                product_name: {
                    required: true,

                },
                product_sku: {
                    required: true,
                },

                product_code: {
                    required: true,
                },

                product_warranty_type: {
                    required: true,
                },


                product_original_price: {
                    required: true,
                    digits: true,
                },

                product_compare_price: {
                    // required: true,
                    digits: true,
                },

                product_whats_on_box: {
                    required: true,
                },

                product_package_weight: {
                    required: true,
                },

                product_package_dimension: {
                    required: true,
                },
                blade: {
                    required: true,
                },
                handle: {
                    required: true,
                },
                 blade_weight: {
                    required: true,
                },
                 total_weight: {
                    required: true,
                },
                 material: {
                    required: true,
                },

                image: {
                    required: true,
                },

            }
        });


    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        var i = $('#totalCount').val();
        if (i == 8) {
            $('#add').css('display', 'none');
        }

        $('#add').click(function() {
            if (i == 7) {
                $('#add').css('display', 'none');
            }
            console.log('working');
            i++;
            $('#dynamic_field').append('<div id="row' + i + '" class="custom-file" style="width:25%"> <input type="file" class="this-one" data-value="' + i + '" name="multi_image[]" multiple><img src="" id="profile-img-tag' + i + '" width="80px"/> <button type="button" id="' + i + '" class="btn btn-success btn_remove" style="margin:10px;">Remove</button></div>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            // console.log(button_id);
            i--;
            $('#add').css('display', '');
            $("#row" + button_id + "").remove();
        });

        $(document).on('change', ".this-one", function() {
            // console.log(i);
            var j = $(this).data('value');

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#profile-img-tag" + j + "").attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            readURL(this);
        });

        $(document).on('click', ".delete-image", function(e) {
            e.preventDefault();

            let filterObject = {
                imageId: null,
            }
            filterObject.imageId = $(this).data('value');
            // return false;

            var parent = $(this).parent().closest('span');

            $(parent).hide();

            $.ajax({
                url: "{{route('admin.deleteSingeImage')}}",
                method: "GET",
                data: filterObject,
                dataType: 'JSON',
                success: function(resp) {
                    if (resp.status == 'success') {
                        if (i == 8) {
                            $('#add').css('display', 'block');
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

<!-- FOR AUTO SLUG GENERATION -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#category_name").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^\w ]+/g, ''); //removes non-alphanumeric
            Text = Text.replace(/ +/g, '-'); // replaces space with hyphen
            $("#category_slug").val(Text);
        });
    });
</script>

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

    $("input:radio[name='quality_status']").on('click', function() {
        if ($(this).val() === '1') {
            $('#quality_reject_reason').removeAttr("readonly");
            $('#quality_control_comment').removeAttr("readonly");
        } else {
            $('#quality_reject_reason').val("");
            $('#quality_control_comment').val("");
            $('#quality_reject_reason').attr("readonly", "readonly");
            $('#quality_control_comment').attr("readonly", "readonly");
        }
    });

    $("input:radio[name='policy_status']").on('click', function() {
        if ($(this).val() === '1') {
            $('#policy_reject_reason').removeAttr("readonly");
            $('#policy_control_comment').removeAttr("readonly");
            $('#penalty_type').removeAttr("readonly");
        } else {
            $('#policy_reject_reason').val("");
            $('#policy_control_comment').val("");
            $('#penalty_type').val("");
            $('#policy_reject_reason').attr("readonly", "readonly");
            $('#policy_control_comment').attr("readonly", "readonly");
            $('#penalty_type').attr("readonly", "readonly");
        }
    });
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {

        $('#delete').on('click', function() {
            $('#product-image').css('display', 'none');
            $('#delete').css('display', 'none');
        });

        $('#pro_image').change(function(e) {
            e.preventDefault();
            var formData = new FormData(upload_form);
            $.ajax({
                url: "{{URL::route('productimage')}}",
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

            readURL(this);

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                        $('#product-image').css('display', 'none');
                        $('#delete').css('display', 'none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
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
                url: "{{ route('getsubcategory') }}",
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
                let prashant = form['sub_child_category_id'].value;

                if (prashant > 0) {
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

        // $('#edit-category').click(function(e){
        //     e.preventDefault();
        //     $('#prashant').css('display','block');
        // });
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
        $('a#delete').click(function() {
            $('img#product-image').hide();
            $('a#delete').hide();
        })
    });
</script>


@include('admin.layouts.ckeditor')

@stop
