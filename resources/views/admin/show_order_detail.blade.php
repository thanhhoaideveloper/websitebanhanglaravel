@extends('admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Chi tiết đơn hàng
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                <input type="checkbox" name="post[]"><i>
              </th>
              <th>Mã đơn hàng</th>
              <th>Sản phẩm</th>
              <th>Giá bán</th>
              <th>Số lượng</th>
            </tr>
          </thead>
          <tbody>
            @foreach($show_order_detail as $key => $order_detail)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $order_detail->order_details_id }}</td>
              <td>{{ $order_detail->product_name }}</td>
              <td>{{ number_format($order_detail->product_price) }}</td>
              <td>{{ $order_detail->order_details_quality }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <br>
  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin giao hàng
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                <input type="checkbox" name="post[]"><i>
              </th>
              <th>Tên người nhận</th>
              <th>Email người nhận</th>
              <th>Số điện thoại người nhận</th>
              <th>Địa chỉ nhận</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order_address as $key => $ordder_address)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $ordder_address->customer_name }}</td>
              <td>{{ $ordder_address->customer_email }}</td>
              <td>{{ $ordder_address->customer_phone }}</td>
              <td>{{ $ordder_address->customer_address }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>


@endsection