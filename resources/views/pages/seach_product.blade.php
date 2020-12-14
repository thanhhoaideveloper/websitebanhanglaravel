@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản Phẩm tìm kiếm</h2>
        @foreach($seach_product as $key => $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                                <img style="height: 200px;width:200px" src="{{ asset('uploads/product/'.$product->product_image)}}" alt="" />
                                <h2>{{ number_format($product->product_price).' VNĐ'}}</h2>
                                <p>{{ $product->product_name}}</p>
                            </a>
                            <form action="{{URL::to('/add-cart')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="quality" min='1' max="10" value="1" />
                                <input type="hidden" name="productid_hidden" value="{{$product->product_id}}" />
                                <button type="submit" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Thêm vào giỏ hàng
                                </button>
                            </form>
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

        @endforeach
    </div><!--features_items-->

@endsection