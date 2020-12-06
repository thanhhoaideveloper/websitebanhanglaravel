@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản Phẩm</h2>
        @foreach($show_category_product_athome as $key => $product)
        <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <img style="height: 200px;width:200px" src="{{ asset('uploads/product/'.$product->product_image)}}" alt="" />
                                <h2>{{ number_format($product->product_price).' VNĐ'}}</h2>
                                <p>{{ $product->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                            </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                        </ul>
                    </div>
                
                </div>
            </div>
        </a>
        @endforeach
    </div><!--features_items-->

@endsection