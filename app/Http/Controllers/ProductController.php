<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
session_start();

class ProductController extends Controller
{
    public function add_product(){
        $categoty = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('category',$categoty)->with('brand',$brand);
    }

    public function show_product(){
        $show_product = DB::table('tbl_product')->get();
        $manager_product = view('admin.show_product')->with('show_product',$show_product);
        return view('admin_layout')->with('admin.show_product',$manager_product);

    }

    public function save_product(Request $request){
        $messages = [
            'image'=>'Định dạng không cho phép',
            'max' =>'kích thước file lơn'
        ];

        $this->validate($request, [
		    'product_image' => 'image|max:2028',
		], $messages);
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['brand_id'] = $request->brand_id;
        $data['category_id'] = $request->category_id;

        $get_image = $request->file('product_image');
        if($request->file('product_image')->isValid()){
            $fileName = $request->file('product_image')->getClientOriginalName();
            $get_image->move(base_path('public/uploads/product'),$fileName);
            $data['product_image'] =$fileName;
            DB::table('tbl_product')->insert($data);
        }
        else{
            $data['product_image'] ='';
            DB::table('tbl_product')->insert($data);
        }
       
    //return Redirect::to('/show-product');
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
