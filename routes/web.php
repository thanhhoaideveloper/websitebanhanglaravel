<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Front End
Route::get('/', 'HomeController@index');

Route::get('/trang-chu','HomeController@index');



//Back End

Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','AdminController@logout');

//category product

Route::get('/add-category-product','categoryProductController@add_category_product');
Route::get('/show-category-product','categoryProductController@show_category_product');
Route::post('/save-category-product','categoryProductController@save_category_product');
Route::get('/update-category-product/{product_id}','categoryProductController@update_category_product');
Route::get('/update-category-status/{product_id}','categoryProductController@update_category_status');
Route::post('/update-category-value-product/{product_id}','categoryProductController@update_category_value_product');
Route::get('/delete-category-product/{product_id}','categoryProductController@delete_category_product');

//brand product

Route::get('/add-brand-product','BrandProductController@add_brand_product');
Route::get('/show-brand-product','BrandProductController@show_brand_product');
Route::post('/save-brand-product','BrandProductController@save_brand_product');
Route::get('/update-brand-product/{product_id}','BrandProductController@update_brand_product');
Route::get('/update-brand-status/{product_id}','BrandProductController@update_brand_status');
Route::post('/update-brand-value-product/{product_id}','BrandProductController@update_brand_value_product');
Route::get('/delete-brand-product/{product_id}','BrandProductController@delete_brand_product');


//products
Route::get('/add-product','ProductController@add_product');
Route::get('/show-product','ProductController@show_product');
Route::post('/save-product','ProductController@save_product');
Route::get('/update-product/{product_id}','ProductController@update_product');
Route::get('/update-brand-status/{product_id}','ProductController@update_status');
Route::post('/update-value-product/{product_id}','ProductController@update_value_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
