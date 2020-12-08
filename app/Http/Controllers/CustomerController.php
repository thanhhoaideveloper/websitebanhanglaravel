<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use Cookie;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
session_start();
class CustomerController extends Controller
{
    public function login_checkout(){
        return view('pages.customers.login_customer');
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/');
    }

    public function login_customer(Request $request){
        $customer_account = $request->customer_account;
        $customer_pass = md5($request->customer_pass);

        $result = DB::table('tbl_customer')->where('customer_account',$customer_account)->where('customer_pass',$customer_pass)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        }
        else{
            Cookie::queue('customer_id','err',0.1);
            return Redirect::to('/login-checkout');
        }
    }


    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_account'] = $request->customer_account;
        $data['customer_pass'] = md5($request->customer_pass);
        $data['customer_phone'] = $request->customer_phone;
        print_r($data);
       $customer_id = DB::table('tbl_customer')->insertGetId($data);

         Session::put('customer_id',$customer_id);
         Session::put('customer_name',$request->customer_name);

        return Redirect::to('/checkout');

    }

    public function checkout(){
        $AuthLogin = Session::get('customer_id');
        if($AuthLogin){
            return view('pages.customers.checkout');
        }
        else
            {
                return Redirect::to('/login-checkout');
            }
    }


    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        print_r($data);
       $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$customer_id);

       return Redirect::to('/payment');
    }


    public function payment(){

    }
}
