<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
session_start();
class brandProductController extends Controller
{
    public function add_brand_product(){
        return view('admin.add_brand_product');
    }

    public function show_brand_product(){
        $show_brand_product = DB::table('tbl_brand_product')->get();
        $manager_product = view('admin.show_brand_product')->with('show_brand_product',$show_brand_product);
        return view('admin_layout')->with('admin.show_brand_product',$manager_product);

    }

    public function save_brand_product(Request $request){
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_status'] = $request->brand_status;
        print_r($data);
        DB::table('tbl_brand_product')->insert($data);
    return Redirect::to('/show-brand-product');
    }

    public function update_brand_product($brand_id){
        $update_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_id)->get();
        $manager_product = view('admin.update_brand_product')->with('update_brand_product',$update_brand_product);
        return view('admin_layout')->with('admin.update_brand_product',$manager_product);
    }

    public function update_brand_value_product(Request $request,$brand_id){
       $data = array();
       $data['brand_name'] = $request->brand_name;
       $data['brand_desc'] = $request->brand_desc;
       DB::table('tbl_brand_product')->where('brand_id',$brand_id)->update($data);
       return Redirect::to('/show-brand-product');
    }


    public function update_brand_status($brand_id){
        $brand_status = DB::table('tbl_brand_product')->select('brand_status')->where('brand_id',$brand_id)->get();
        $status = collect($brand_status)->all()[0]->brand_status;
        $data = array();
        if($status == 0){
            $data['brand_status'] = 1;
        }
        else{
            $data['brand_status'] = 0;
        }
        DB::table('tbl_brand_product')->where('brand_id',$brand_id)->update($data);
            return Redirect::to('/show-brand-product');
    }


    public function delete_brand_product($brand_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_id)->delete();
        return Redirect::to('/show-brand-product');
    }
}
