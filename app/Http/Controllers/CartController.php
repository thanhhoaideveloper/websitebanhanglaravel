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
        return view('pages.cart.show_cart');
    }

    public function save_cart(Request $request){
        $product_id = $request->productid_hidden;
        $quality = $request->quality;
        Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        return view("pages.cart.show_cart");
    }
}
