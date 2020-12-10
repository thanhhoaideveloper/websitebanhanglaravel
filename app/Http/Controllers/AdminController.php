<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{

    public function AuthLogin(){
        $admin_name = Session::get('admin_name');
        if($admin_name){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message','Mat khau hoac tai khoan bi sai');
            return Redirect::to('/admin');      
        }
        
    }

    public function logout(){
        Session::forget('admin_name');
        return Redirect::to('/admin');

    }



    //orther 

    public function show_order(){
        $show_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderby('tbl_order.order_id','desc')
        ->get();


        $manager_order = view('admin.show_order')->with('show_order',$show_order);
        return view('admin_layout')->with('admin.show_order',$manager_order);
    }

    public function show_order_detail($order_id){
        $show_order_detail = DB::table('tbl_order_details')
        ->join('tbl_product','tbl_product.product_id','=','tbl_order_details.product_id')
        ->select('tbl_order_details.*','tbl_product.product_name')
        ->where('tbl_order_details.order_id',$order_id)
        ->orderby('tbl_order_details.order_details_id','desc')
        ->get();


        $order_address = DB::table('tbl_order')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->select('tbl_order.*','tbl_customer.*')
        ->where('tbl_order.order_id',$order_id)
        ->orderby('tbl_order.order_id','desc')
        ->get();

        
       
        return view('admin.show_order_detail')->with('show_order_detail',$show_order_detail)->with('order_address',$order_address);
    }


    public function update_order_status($order_id){
        $result  = DB::table('tbl_order')->select('order_status')->where('order_id',$order_id)->get();
        $status = collect($result)->all()[0]->order_status;
        $data = array();
        if($status == 0){
            $data['order_status'] = 1;
            DB::table('tbl_order')->where('order_id',$order_id)->update($data);
        }

        return Redirect::to('/show-order');
        

    }
}
