@extends('admin_layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Đơn hàng
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                <input type="checkbox" name="post[]"><i>
              </th>
              <th>Tên người đặt hàng</th>
              <th>Ngày đặt hàng</th>
              <th>Tổng đơn</th>
              <th>Trạng thái</th>
              <th style="width:30px;">Chi tiết đơn hàng</th>
            </tr>
          </thead>
          <tbody>
            @foreach($show_order as $key => $order)
            <tr>
              <?php 
                    $test = '';
                    if($order->order_status!=0){
                      $test = 'not-allowed';
                    }
                  ?>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $order->customer_name }}</td>
              <td>{{ $order->order_date }}</td>
              <td>{{ number_format($order->order_total) }}</td>
                  <td><a class="status" style="cursor: {{ $test }}" href="{{URL::to('/update-order-status/'.$order->order_id)}}">
                <?php 
                    if($order->order_status==0){
                      echo "Đang xử lý";
                    }
                    else {
                      echo "Đã giao hàng";
                    }
                  ?>
                  </a>
              </td>
              <td class="action_category" style="width:100px;">
                <a href="{{URL::to('/show-order-detail/'.$order->order_id)}}" ui-toggle-class="" class="styling-action-product"><i class="fa fa-info" aria-hidden="true"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection