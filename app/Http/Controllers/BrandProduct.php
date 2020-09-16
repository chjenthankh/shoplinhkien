<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    public function add_brand_product(){
    	return view('admin.add_brand_product');

    }
    public function all_brand_product(){
    	$all_brand_product=DB::table('tbl_brand')->paginate(5);
    	$manager_brand_product=view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    	return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);

    }
    public function save_brand_product(Request $request){
        $this->validate($request, [
			'brand_product_name' => 'unique:tbl_brand,brand_name',
		]);

    	$data=array();
    	$data['brand_name']=$request->brand_product_name;
    	$data['brand_desc']=$request->brand_product_desc;
    	$data['brand_status']=$request->brand_product_status;

    	DB::table('tbl_brand')->insert($data);
    	Session::put('message','Thêm thành công');
    	return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
    	DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Thành công');
        return Redirect::to('all-brand-product');	
    }
    public function active_brand_product($brand_product_id){
    	DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
    	$edit_brand_product=DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
    	$manager_brand_product=view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
    	return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);

    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this->validate($request, [
			'brand_product_name' => 'unique:tbl_brand,brand_name,'. $request->brand_product_id . ',brand_id'
		]);


    	$data = array();
        $data['brand_name'] = $request->brand_product_name;
        // $data['slug_brand_product'] = $request->slug_brand_product;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật thương hiệu thành công');
        return Redirect::to('all-brand-product');

    }
    public function delete_brand_product($brand_product_id){
    	DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }
    //Kết thúc hàm admin
    public function show_brand_home($brand_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $brand_by_id=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->get();
        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id);
    }
}
