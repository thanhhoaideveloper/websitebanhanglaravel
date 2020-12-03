<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
session_start();

class categoryProductController extends Controller
{
    public function add_category_product(){
        return view('admin.add_category_product');
    }

    public function show_category_product(){
        $show_category_product = DB::table('tbl_category_product')->get();
        $manager_product = view('admin.show_category_product')->with('show_category_product',$show_category_product);
        return view('admin_layout')->with('admin.show_category_product',$manager_product);

    }

    public function save_category_product(Request $request){
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_status'] = $request->category_status;
        print_r($data);
        DB::table('tbl_category_product')->insert($data);
    return Redirect::to('/show-category-product');
    }

    public function update_category_product($category_id){
        $update_category_product = DB::table('tbl_category_product')->where('category_id',$category_id)->get();
        $manager_product = view('admin.update_category_product')->with('update_category_product',$update_category_product);
        return view('admin_layout')->with('admin.update_category_product',$manager_product);
    }

    public function update_category_value_product(Request $request,$category_id){
       $data = array();
       $data['category_name'] = $request->category_name;
       $data['category_desc'] = $request->category_desc;
       DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
       return Redirect::to('/show-category-product');
    }


    public function update_category_status($category_id){
        $category_status = DB::table('tbl_category_product')->select('category_status')->where('category_id',$category_id)->get();
        $status = collect($category_status)->all()[0]->category_status;
        $data = array();
        if($status == 0){
            $data['category_status'] = 1;
        }
        else{
            $data['category_status'] = 0;
        }
        DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
            return Redirect::to('/show-category-product');
    }


    public function delete_category_product($product_id){
        DB::table('tbl_category_product')->where('category_id',$product_id)->delete();
        return Redirect::to('/show-category-product');
    }

}
