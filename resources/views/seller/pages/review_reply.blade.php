@section('title')
Review Reply Page | {{env('APP_NAME')}}

@stop

@extends('seller.layouts.app')


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
            <div class="ibox-title">Product Reviews</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')
            <div class="row">
                <div class="col-lg-12">
                <form action="{{ route('seller.review.reply', $review_id) }}" method="POST">
                    @csrf
                    <div class="card">
                    <img class="card-img-top" src="{{ asset('uploads/products/'.$products_review->image) }}" alt="Product Featured Image" style="height: 210px;
                    width: 211px;">
                        <div class="card-body">
                        <h5 class="card-title"><b>By :</b> {{ $products_review->customer_name }}</h5>
                        <p class="card-text"><b>Review:</b> {{ $products_review->review }}</p>
                        <textarea name="reply"  cols="30" rows="5" class="ckeditor" placeholder="Reply...">        
                        </textarea><br/>
                         <input type="submit" class="btn btn-primary btn-md" value="Reply"/>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
          
        </div>
    </div>
</div>

<!-- END PAGE CONTENT-->

@stop

@section('footer')

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace( 'ckeditor' ,{
        filebrowserBrowseUrl : 'vendor/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl : 'vendor/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : 'vendor/responsive_filemanager/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
    });
    </script>


@endsection



