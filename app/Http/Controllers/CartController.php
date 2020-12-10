<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
session_start();


class CartController extends Controller
{
    public function show_cart(){
        $sum = 0;
        foreach($_SESSION as $key => $value){
            $id = substr($key,5,10);
            $products = DB::table('tbl_product')->where('product_id',$id)->get();
            foreach($products as $key => $product){
                $sum = $sum + ($value*$product->product_price);
            }
        }

        return view('pages.cart.show_cart')->with('total',$sum);
    }

    public function save_cart(Request $request){
        $product_id = $request->productid_hidden;
        $quality = $request->quality;
        @$_SESSION['cart_'.$product_id]+=$quality;
        return Redirect::to('/show-cart');
    }


    public function add_cart(Request $request){
        $product_id = $request->productid_hidden;
        $quality = $request->quality;
        @$_SESSION['cart_'.$product_id]+=$quality;
        return Redirect::to('/');
    }

    public function plus_quality($product_id){
        $quality = $_SESSION['cart_'.$product_id];
        if($quality<9){
            @$_SESSION['cart_'.$product_id]++;
        }
        return Redirect::to('/show-cart');
    }
    public function minus_quality($product_id){
        $quality = $_SESSION['cart_'.$product_id];
        if($quality>1){
            @$_SESSION['cart_'.$product_id]--;
        }
        return Redirect::to('/show-cart');
    }

    public function delete_cart($product_id){
        unset($_SESSION['cart_'.$product_id]);
        return Redirect::to('/show-cart');
    }
}
