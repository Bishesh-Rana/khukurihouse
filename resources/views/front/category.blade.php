@extends('front.layouts.app')


@section('title')

    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif

@stop


@section('content')
@include('front.layouts.error')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('product.category', $category->category_slug) }}">{{ $category->category_name }}</a>
                        </li>
                    </ol>
                </div>
            </div>
            
        </div>
    </nav>
    <!-- Breadcrumb End -->
    <!-- Category Page -->
    <section class="category-page mt mb">
        <div class="container">
            <div class="category-top">
                <div class="category-title">
                    <h3>{{ $category->category_name }}</h3>
                </div>
                <div class="sorting">
                    <div class="sorting-label">
                        <label>Sort By:</label>
                    </div>
                    <div class="sorting-wrap">
                        <div class="sorting-lst">
                            <select class="form-control" name="sortBy">
                                @php
                                    $sortBy = ['price', 'popularity', 'date', 'name'];
                                @endphp
                                @foreach ($sortBy as $sort)
                                    <option value="{{ $sort }}" @if (request('sortBy') == $sort)
                                        {{ 'selected' }}
                                @endif>{{ ucwords($sort) }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="sorting-lst">
                            <select class="form-control" name="direction">
                                <option value="asc" @if (request('direction') == 'asc')
                                    {{ 'selected' }}
                                    @endif>Ascending</option>
                                <option value="desc" @if (request('direction') == 'desc')
                                    {{ 'selected' }}
                                    @endif>Descending</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($categoryProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-wrap">
                            <div class="product-img">
                                <a href="{{ route('product.details', $product->product_slug) }}">
                                    <img src="{{ getFrontImage($product->image,'products') }}" alt="images" /></a>
                                    <div class="group-btn">
                                        <x-_wishlist wishlist="{{$product->userWish}}"  :productId="$product->id"  > </x-_wishlist>
                                        <x-_cart :productId="$product->id"  > </x-_cart>
                                    </div>
                            </div>
                            <div class="product-content">
                                <h4><a
                                        href="{{ route('product.details', $product->product_slug) }}">{{ $product->product_name }}</a>
                                </h4>
                                <span>{{ $product->currency }}&nbsp;{{ $product->product_original_price }}</span>
                                <a href="{{ route('product.details', $product->product_slug) }}"
                                    class="btn">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <nav aria-label="">
                {{ $categoryProducts->links() }}
                {{-- <ul class="pagination">
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                    </li>
                </ul> --}}
            </nav>
        </div>
    </section>
    <!-- Category Page End -->

@stop

@section('footer')

@stop
@push('scripts')
    <script>
        const currentUrl = "{{ request()->url() }}"
        $(document).ready(function() {
            $("select[name='sortBy'],select[name='direction']").on('change', function() {
                console.log(getValues())
                window.location.href = currentUrl + '?sortBy=' + getValues()[0] + '&direction=' +
                    getValues()[1];
            });
        })

        function getValues() {
            return [
                $("select[name='sortBy']").val(),
                $('select[name="direction"]').val(),
            ];
        }
    </script>
@endpush
