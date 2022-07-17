@extends('seller.layouts.app')

@section('title')

{{ucwords($product->product_name)}} | {{env('APP_NAME')}}

@stop

@section('content')

<div class="page-heading">
    <h1 class="page-title">Product Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/ns-seller/products')}}">Go Back<i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <table class="table table-striped no-margin table-invoice">
                <tbody>
                    <tr>
                        <th>Product Name</th>
                        <td>{{ucwords($product->product_name)}}</td>
                    </tr>
                    <tr>
                        <th>In Category</th>
                        <td>{{$product->categoryName}}</td>
                    </tr>
                    <tr>
                        <th>Owner Code</th>
                        <td>{{$product->sellerName}}</td>
                    </tr>
                    <tr>
                        <th>Product Code</th>
                        <td>{{$product->product_code}}</td>
                    </tr>
                    <tr>
                        <th>Product Brand</th>
                        <td>{{$product->product_brand}}</td>
                    </tr>
                    <tr>
                        <th>Product Model</th>
                        <td>{{$product->product_model}}</td>
                    </tr>
                    <tr>
                        <th>Product Highlight</th>
                        <td>{!!$product->product_highlights!!}</td>
                    </tr>
                    <tr>
                        <th>Product Description</th>
                        <td>{!!$product->product_description!!}</td>
                    </tr>
                    <tr>
                        <th>Product Warranty Type</th>
                        <td>{!!$product->product_warranty_type!!}</td>
                    </tr>
                    <tr>
                        <th>Product Warranty Period</th>
                        <td>{{$product->product_warrenty_period}}</td>
                    </tr>
                    <tr>
                        <th>Product Warranty Policy</th>
                        <td>{{$product->product_warrenty_policy}}</td>
                    </tr>
                    <tr>
                        <th>What on the Box</th>
                        <td>{{$product->product_whats_on_box}}</td>
                    </tr>
                    <tr>
                        <th>Product package weight</th>
                        <td>{{$product->product_package_weight}}</td>
                    </tr>
                    <tr>
                        <th>Product package dimension</th>
                        <td>{{$product->product_package_dimension}}</td>
                    </tr>
                    <tr>
                        <th>Product original price</th>
                        <td>Rs. {{number_format($product->product_original_price)}}</td>
                    </tr>
                    <tr>
                        <th>Product compare price</th>
                        <td>Rs. {{$product->product_compare_price}}</td>
                    </tr>
                    <tr>
                        <th>Product key features</th>
                        <td>{!!$product->product_key_features!!}</td>
                    </tr>
                    <tr>
                        <th>Product Image</th>
                        <td>
                            <img src="{{asset('')}}uploads/products/{{$product->image}}" alt="{{$product->product_name}}"  height="200px" height="200px">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="printpage" style="border:1px solid;border-style: inset;border-radius: 5px;margin: 0px auto; text-align:center;">
    <div id="detail">
    <strong> <b>PRODUCT NAME:</b> {{ucwords($product->product_name)}}</strong><br>
    <strong> <b>PRODUCT PRICE:</b> Rs. {{number_format($product->product_original_price)}}</strong><br>
    {{-- <strong> <b>PRODUCT Brand:</b>  {{$product->product_brand}}</strong> --}}
    </div>
    <div id="qr">
                {!! QrCode::size(200)->generate(route('product.details',$product->product_slug)); !!}
                <br>
                

                
    </div>        
</div>
<div class="text-right">
    <button class="btn btn-info" type="button" onclick="printDiv()"><i class="fa fa-print"></i> Print Product QR Code</button>
</div>
@stop

@section('footer')

<script>
    function printDiv() {
        var value1 = document.getElementById('printpage').innerHTML;
        var value2 = document.body.innerHTML;
        document.body.innerHTML = value1;
        document.getElementById("detail").style.textAlign = "center";
        document.getElementById("qr").style.textAlign = "center";
        document.getElementById("qr").style.paddingTop = "10px";
        document.getElementById("qr").style.paddingBottom = "10px";
        document.getElementById("qr").style.borderTop = "1px solid";
        // document.getElementById("qr").style.borderBottom = "1px solid";


        window.print();
        document.body.innerHTML = value2;
        location.reload();

    }
</script>
@endsection