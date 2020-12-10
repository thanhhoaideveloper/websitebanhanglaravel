

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
<link href="{{ asset('/frontend/css/responsive.css') }}" rel="stylesheet">
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->       
<link rel="shortcut icon" href="images/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">


<section id="cart_items" style="margin-top:20px">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/trang-chu')}}" >Trang chủ</a></li>
                <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td>Tên sản phẩm</td>
                        <td class="image">Hình ảnh</td>
                        <td class="price">Giá sản phẩm</td>
                        <td class="quantity">Số lượng sản phẩm</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php   
                            if(Session::get('message')){
                               echo '<tr>
                                    <td colspan="2">
                                        <div class="alert alert-success" role="alert">Thanh toán thành công</div>
                                    </td>
                                    </tr>';

                                Session::forget('message');

                            }else if($_SESSION==null){
                                echo '<tr>
                                    <td colspan="2">
                                        <div class="alert alert-warning" role="alert">Giỏ hàng trống</div>
                                    </td>
                                    </tr>';
                            }


                            foreach($_SESSION as $key => $value){
                            $id = substr($key,5,10); 
                            $products = DB::table('tbl_product')->where('product_id',$id)->get();
                            foreach($products as $key => $product){
                    ?>
                    <tr>
                        <td style="width: 300px">{{ $product->product_name}}</td>

                        <td class="cart_product">
                        <a href=""><img style="width:100px;height:100px"src="{{asset('/uploads/product/'.$product->product_image)}}" alt=""></a>
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($product->product_price).' VNĐ'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{URL::to('/plus-quality/'.$product->product_id)}}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" disabled value="{{$value}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href="{{URL::to('/minus-quality/'.$product->product_id)}}"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                        <p class="cart_total_price">{{number_format($value * $product->product_price).' VNĐ'}}</p>
                        </td>
                        <td class="cart_delete">
                        <a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$product->product_id)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                <?php } }?>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="login-form my-boder"><!--login form-->
                    <h2 style="margin-left:10px">Điền thông tin mua hàng</h2>
                    <?php
                        $customer_name = Session::get('customer_name');
                        $customer_email = Session::get('customer_email');
                        $customer_address = Session::get('customer_address');
                        $customer_phone = Session::get('customer_phone');


                    ?>
                    <form action="{{ URL::to('/payment')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="name" value="{{ $customer_name}}" placeholder="Họ và tên" />
                        <input type="email" name="email" value="{{ $customer_email}}" placeholder="Địa chỉ email" />
                        <input type="text" name="address" value="{{ $customer_address}}" placeholder="Địa chỉ" />
                        <input type="text" name="phone" value="{{ $customer_phone}}" placeholder="Số điện thoại" />
                        <button type="submit" class="btn btn-default">Thanh toán</button>
                    </form>
                </div><!--/login form-->
            </div>
            
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng tiền: <span>{{ number_format($total).' VNĐ'  }}</span></li>
                        <li>Thuế: <span>0 VNĐ</span></li>
                        <li>Phí vận chuyển: <span>Free</span></li>
                        <li>Thành tiền: <span>{{ number_format($total).' VNĐ' }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

<script src="{{asset('frontend/js/jquery.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('frontend/js/price-range.js')}}"></script>
<script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>