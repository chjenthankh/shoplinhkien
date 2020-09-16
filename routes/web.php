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
//frontend
Route::get('/','HomeController@index' );

Route::get('/trang-chu', 'HomeController@index');
Route::post('/tim-kiem','HomeController@search');

//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@details_product');
//backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');

//Danh mục sản phẩm
Route::get('/add-category-product','CategoryProduct@add_category_product');

Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');

Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');
Route::post('/tim-kiem-sp','ProductController@search');

//Thương hiệu sản phẩm
Route::get('/add-brand-product','BrandProduct@add_brand_product');

Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');

Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');

//Sản phẩm
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

//Giỏ hàng
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');

//Thanh toán
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');

//Đơn hàng
Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{orderId}','CheckoutController@view_order');
Route::get('/delete-order/{orderId}','CheckoutController@delete_order');
Route::get('/confirm-order/{confirm_order_id}','CheckoutController@confirm');
Route::get('/reject-order/{confirm_order_id}','CheckoutController@reject');
Route::get('/ship-order/{confirm_order_id}','CheckoutController@ship');
Route::get('/finish-order/{confirm_order_id}','CheckoutController@finish');


//Tài khoản
Route::get('/tai-khoan', 'UserController@getDanhSach');
Route::get('/taikhoan/xoa/{customer_id}', 'UserController@getXoa');
Route::get('/taikhoan/reset/{customer_id}', 'UserController@getReset');
Route::get('/add-user','UserController@addUser');
Route::post('/save-user','UserController@saveUser');

//Quên mật khẩu
Route::get('/forgot-password','SecurityController@forgot');
Route::post('/forgot-password','SecurityController@password');

//wrap
Route::get('/chinh-sach-giao-hang','HomeController@chinh_sach');

//Thông tin tài khoản
Route::get('/thong-tin-tai-khoan', 'UserController@getInfor');
Route::post('/sua-thong-tin-tai-khoan', 'UserController@postInfor');
Route::get('/doi-mat-khau', 'UserController@getDoiMatKhau');
Route::post('/doi-mat-khau', 'UserController@postDoiMatKhau');
Route::get('/dia-chi','UserController@getDiaChi');
Route::post('/them-dia-chi','UserController@postThemDiaChi');
Route::post('/sua-dia-chi','UserController@postSuaDiaChi');
Route::get('/xoa-dia-chi/{id}','UserController@getXoaDiaChi');
Route::get('/da-xem','UserController@getDaXem');
Route::get('/add-wishlist/{product_id}','UserController@addWishList');
Route::get('/delete-wishlist/{product_id}','UserController@deleteWishList');
Route::get('/wishlist','UserController@getWishList');

Route::get('/history','CheckoutController@history');
Route::get('/view-order-user/{orderId}','CheckoutController@view_order_user');
//Hồ sơ admin
Route::get('/admin-profile','AdminController@profile');
Route::post('/admin/{admin_id}','AdminController@update_admin');
Route::get('/tai-khoan-admin', 'AdminController@getDanhSach');
Route::get('/add-admin','AdminController@addUser');
Route::post('/save-admin','AdminController@saveUser');
Route::get('/admin/reset/{admin_id}', 'AdminController@getReset');
Route::get('/admin/xoa/{admin_id}', 'AdminController@getXoa');
//Hóa đơn
Route::get('/bill/{orderId}','CheckoutController@bill');

Auth::routes();
Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');
