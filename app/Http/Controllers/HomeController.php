<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
session_start();

class HomeController extends Controller
{
    public function index(){
    	$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
    	$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
    	// ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    	// ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->get();
    	// $manager_product=view('admin.all_product')->with('all_product',$all_product);
    	$all_product=DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(4)->get();
    	$ram_product=DB::table('tbl_product')->where('category_id','13')->where('product_status','0')->orderby('product_id','desc')->limit(4)->get();
        $pc_product=DB::table('tbl_product')->where('category_id','17')->where('product_status','0')->orderby('product_id','desc')->limit(4)->get();
    	if(Auth::check())
        {
            $customer_wishlist = DB::table('tbl_customer_wishlist')->where('customer_id',Auth::user()->id)->get();
            return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('ram_product',$ram_product)
            ->with('pc_product',$pc_product)->with('customer_wishlist',$customer_wishlist);
        }
        else
    	    return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('ram_product',$ram_product)->with('pc_product',$pc_product);
    }
    public function search(Request $request){

        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 


        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);

    }
    public function chinh_sach(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->get();
        // $manager_product=view('admin.all_product')->with('all_product',$all_product);
        $all_product=DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(8)->get();
        $ssd_product=DB::table('tbl_product')->where('category_id','10')->where('product_status','0')->orderby('product_id','desc')->limit(7)->get();
        $pc_product=DB::table('tbl_product')->where('category_id','17')->where('product_status','0')->orderby('product_id','desc')->limit(7)->get();
        return view('wrap.chinh_sach_giao_hang')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('ssd_product',$ssd_product)->with('pc_product',$pc_product);
    }
}
