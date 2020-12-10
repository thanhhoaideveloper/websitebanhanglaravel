@extends('welcome')
@section('content')
@foreach($show_product_detail as $key => $product)
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{ asset('uploads/product/'.$product->product_image)}}" alt="" />
            <h3>ZOOM</h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                      <a href=""><img src="{{asset('/frontend/images/similar1.jpg')}}" alt=""></a>
                      <a href=""><img src="{{asset('/frontend/images/similar2.jpg')}}" alt=""></a>
                      <a href=""><img src="{{asset('/frontend/images/similar3.jpg')}}" alt=""></a>
                    </div>
                    
                </div>

              <!-- Controls -->
              <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{ $product->product_name}}</h2>
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{ URL::to('/save-cart')}}" method="POST">
                 {{ csrf_field() }}
                <span>
                    <span>{{ number_format($product->product_price)}}</span>
                    <label>Quantity:</label>
                    <input type="number" name="quality" min='1' max="10" value="1" />
                    <input type="hidden" name="productid_hidden" value="{{$product->product_id}}" />
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </span>
            </form>
            <p><b>Trạng thái:</b> Còn hàng</p>
            <p><b>Thương hiệu:</b> {{ $product->brand_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div>

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li  class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Đặt điển sản phẩm</a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            <p> 
                {{ $product->product_desc}}
            </p>
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <p> 
                {{ $product->product_content}}
        </div>
        
        <div class="tab-pane fade " id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                
                <p><b>Bình luận</b></p>
                
                <form action="#">
                    <span>
                        <input type="text" placeholder="Tên của bạn"/>
                        <input type="email" placeholder="Địa chỉ email"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Đánh giá </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Gửi
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($recommended_product as $key => $product)
            <div class="item active">	
            <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <img style="height: 150px;width:150px" src="{{ asset('uploads/product/'.$product->product_image)}}" alt="" />
                                    <h2>{{ number_format($product->product_price).' VNĐ'}}</h2>
                                    <p>{{ $product->product_name}}</p>
                                     <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
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
             
        </div>	
        @endforeach   
    </div>
</div>

@endsection