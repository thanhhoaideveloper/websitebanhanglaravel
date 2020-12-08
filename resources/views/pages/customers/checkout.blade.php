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

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li ><a href="/trang-chu">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->

        

        <div class="register-req">
            <p>Làm ơn hay đăng ký để thanh toán và xem lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <form action="{{ URL::to('/save-checkout-customer')}}" method="POST">
            <div class="row">
                <div class="col-sm-6 col-xl-6 col-lg-6">
                    <div class="bill-to">
                        <p>Điền thông tin gởi hàng</p>
                        <div class="form-one">
                                {{ csrf_field() }}
                                <input type="text" name="shipping_name" placeholder="Họ và tên">
                                <input type="email" name="shipping_email" placeholder="Email">
                                <input type="text" name="shipping_address" placeholder="Địa chỉ nhận hàng">
                                <input type="text" name="shipping_phone" placeholder="số điện thoại">
                                <button type="submit" class="btn btn-primary">Gởi</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-6 col-lg-6">
                    <div class="order-message">
                        <p>Ghi chú gởi hàng</p>
                        <textarea name="shipping_notes"  placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>
                    </div>	
                </div>					
            </div>
           
            </form>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->

<script src="{{asset('frontend/js/jquery.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('frontend/js/price-range.js')}}"></script>
<script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>