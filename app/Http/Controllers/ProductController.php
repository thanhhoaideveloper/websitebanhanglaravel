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
        $show_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')
        ->get();
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
       
    return Redirect::to('/show-product');
    }

    public function update_product($product_id){
        $category = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        $update_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        $manager_product = view('admin.update_product')->with('update_product',$update_product)
        ->with('category',$category)->with('brand',$brand);
        
        return view('admin_layout')->with('admin.update_product',$manager_product);
    }

    public function update_value_product(Request $request,$product_id){
       $data = array();
       $data['product_name'] = $request->product_name;
       $data['product_desc'] = $request->product_desc;
       $data['product_content'] = $request->product_content;
       $data['category_id'] = $request->category_id;
       $data['brand_id'] = $request->brand_id;
       $data['product_price'] = $request->product_price ;
       $get_image = $request->file('product_image');
       if($get_image){
           $fileName = $request->file('product_image')->getClientOriginalName();
           $get_image->move(base_path('public/uploads/product'),$fileName);
           $data['product_image'] =$fileName;
           DB::table('tbl_product')->where('product_id',$product_id)->update($data);
       }
       DB::table('tbl_product')->where('product_id',$product_id)->update($data);
       return Redirect::to('/show-product');
    }


    public function update_product_status($product_id){
        $product_status = DB::table('tbl_product')->select('product_status')->where('product_id',$product_id)->get();
        $status = collect($product_status)->all()[0]->product_status;
        $data = array();
        if($status == 0){
            $data['product_status'] = 1;
        }
        else{
            $data['product_status'] = 0;
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            return Redirect::to('/show-product');
    }


    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        return Redirect::to('/show-product');
    
    }


    //end admin

    public function show_product_detail($product_id){
        $categoty = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        $show_product_detail = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)
        ->get();

        foreach($show_product_detail as $key => $recommended){
            $category_recommended = $recommended->category_id;
        }

        $recommended_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_recommended)
        ->whereNotIn('tbl_product.product_id',[$product_id])
        ->get();
        return  view('pages.product.show_product_detail')->with('category',$categoty)
                ->with('brands',$brand)
                ->with('recommended_product',$recommended_product)
                ->with('show_product_detail',$show_product_detail);
    }
}
