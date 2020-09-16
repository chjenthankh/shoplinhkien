<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Illuminate\Support\Facades\Auth;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout(){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function checkout(){
    	

    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $customer = DB::table('tbl_customer')->where('id',Auth::user()->id)->first();
        $customer_address = DB::table('tbl_customer_address')->where('customer_id',Auth::user()->id)->get();

        return view('pages.checkout.show_checkout')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('customer',$customer)->with('customer_address',$customer_address);
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $customer_address = DB::table('tbl_customer_address')->where('id',$request->customer_address_id)->first();
        $address = [$customer_address->Address,$customer_address->District,
        $customer_address->Ward, $customer_address->Province];
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = implode(" ",$address);

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);
        
        return Redirect::to('/payment');
    }
    public function payment(){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);

    }
    public function order_place(Request $request){
        //insert payment_method
     
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Auth::user()->id;
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_data['created_at'] = Carbon::now();
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //insert tbl_order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){

            echo 'Thanh toán chuyển khoản';

        }elseif($data['payment_method']==2){
            Cart::destroy();

            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);

        }else{
            echo 'VISA/MasterCard';

        }
    }
    public function manage_order(){
        
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.id')
        ->select('tbl_order.*','tbl_customer.name')
        ->orderby('tbl_order.order_id','desc')->paginate(10);

        

        $manager_order  = view('admin.manage_order')->with('all_order',$all_order);

        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
    public function view_order($orderId){
        $this->AuthLogin();
        $order_products=DB::table('tbl_order_details')->where('order_id',$orderId)->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')->select('tbl_order_details.*','tbl_product.*')->get();
        $order_details=DB::table('tbl_order')->where('order_id',$orderId)->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->select('tbl_order.*','tbl_shipping.*')->first();


        $manager_order_by_id  = view('admin.view_order')->with('order_products',$order_products)->with('order_details',$order_details);

       
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
       
    }
    public function confirm($confirm_order_id){
        DB::table('tbl_order')->where('order_id',$confirm_order_id)->update(['order_status'=>'Xác nhận đơn hàng']);

        return Redirect::to('manage-order');

    }
    public function ship($confirm_order_id){
        DB::table('tbl_order')->where('order_id',$confirm_order_id)->update(['order_status'=>'Đang giao hàng']);

        return Redirect::to('manage-order');

    }public function finish($confirm_order_id){
        DB::table('tbl_order')->where('order_id',$confirm_order_id)->update(['order_status'=>'Đã hoàn thành']);

        return Redirect::to('manage-order');

    }
    public function reject($confirm_order_id){
        DB::table('tbl_order')->where('order_id',$confirm_order_id)->update(['order_status'=>'Từ chối đơn hàng']);

        return Redirect::to('manage-order');

    }
    
    public function history(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        // return view('login.doithongtin',['thongtin'=>$thongtin]);
        $user_id=Auth::user()->id;
        $user_order=DB::table('tbl_order')->where('customer_id',$user_id)->orderby('order_id','desc')->get();

        
       

        return view('pages.checkout.history')->with('category',$cate_product)->with('brand',$brand_product)->with('user_order',$user_order);
        }
    public function bill($orderId){
       $this->AuthLogin();

        $order_products=DB::table('tbl_order_details')->where('order_id',$orderId)->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')->select('tbl_order_details.*','tbl_product.*')->get();
        $order_details=DB::table('tbl_order')->where('order_id',$orderId)->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->select('tbl_order.*','tbl_shipping.*')->first();

        

       

        return view('admin.bill')->with('order_products',$order_products)->with('order_details',$order_details);
        }
    public function delete_order($orderId){
        DB::table('tbl_order')->where('order_id',$orderId)->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return Redirect::to('manage-order');

    }
    public function view_order_user($orderId){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $order_details=DB::table('tbl_order_details')->where('order_id',$orderId)->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')->select('tbl_order_details.*','tbl_product.*')->get();
        $order_details2=DB::table('tbl_order')->where('order_id',$orderId)->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')->select('tbl_order.*','tbl_shipping.*')->get();



       

         return view('pages.checkout.order_details')->with('category',$cate_product)->with('brand',$brand_product)->with('order_details',$order_details)->with('order_details2',$order_details2);
    }
        
}
