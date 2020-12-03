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
    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $accect_login = Session::get('admin_name');
       if(!$accect_login){
        return Redirect::to('/admin');
       }
       else{
        return view('admin.dashboard');
       }
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
}
