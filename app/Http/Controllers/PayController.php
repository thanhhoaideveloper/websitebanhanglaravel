<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DB;
use Cookie;
Use \Carbon\Carbon;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class PayController extends Controller
{
    public function payment(Request $request){
        $data = array();
        $data['customer_name'] = $request->name;
        $data['customer_email'] = $request->email;
        $data['customer_address'] = $request->address;
        $data['customer_phone'] = $request->phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);


        //insert order
        $order_total = 0;
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $order_date =  $date->toDateString();
        foreach($_SESSION as $key => $value){
            $id = substr($key,5,10);
            $products = DB::table('tbl_product')->where('product_id',$id)->get();
            foreach($products as $key => $product){
                $order_total  = $order_total  + ($value*$product->product_price);
            }
        }
        $data_order = array();
        $data_order['customer_id'] = $customer_id;
        $data_order['order_total'] = (float)$order_total;
        $data_order['order_date'] = $order_date;
        $data_order['order_status'] ='0';

        $order_id = DB::table('tbl_order')->insertGetId($data_order);


        //insert order detail

        foreach($_SESSION as $key => $value){
            $id = substr($key,5,10);
            $products = DB::table('tbl_product')->where('product_id',$id)->get();
            foreach($products as $key => $product){
                $data_order_d = array();
                $data_order_d['order_id'] = $order_id;
                $data_order_d['product_id'] = $id;
                $data_order_d['product_price'] = $product->product_price;
                $data_order_d['order_details_quality'] = $value;
                
                DB::table('tbl_order_details')->insertGetId($data_order_d);

            }
        }

        foreach($_SESSION as $key => $value){
            $id = substr($key,5,10);
                unset($_SESSION['cart_'.$id]);
            }
       

            Session::put('customer_name',$request->name);
            Session::put('customer_email',$request->email);
            Session::put('customer_address',$request->address);
            Session::put('customer_phone',$request->phone);

            Session::put('message','1');

            return Redirect::to('/show-cart');
    }
}
