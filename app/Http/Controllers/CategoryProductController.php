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


    public function show_category_product_athome($cate_id){
        $category = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        $category_name = DB::table('tbl_category_product')->where('category_id',$cate_id)->limit(1)->get();
        $show_category_product_athome= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_product.category_id',$cate_id)
        ->get();

        return view('pages.show_category_product_athome')->with('category_name',$category_name)->with('category',$category)->with('brands',$brand)
        ->with('show_category_product_athome',$show_category_product_athome);
        ;
    }
    
    public function show_brand_product_athome($brand_id){
        $category = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        $brand_name = DB::table('tbl_brand_product')->where('brand_id',$brand_id)->limit(1)->get();
        $show_brand_product_athome= DB::table('tbl_product')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.brand_id',$brand_id)
        ->get();

        return view('pages.show_brand_product_athome')->with('brand_name',$brand_name)->with('category',$category)->with('brands',$brand)
        ->with('show_brand_product_athome',$show_brand_product_athome);
        ;
    }


}
