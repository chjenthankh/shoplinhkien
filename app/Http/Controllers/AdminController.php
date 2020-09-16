<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\User;
use App\Products;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
    	return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        $user_count=User::count();
        $product_count=Products::count();
        $order_count=Order::count();
    	return view('admin.dashboard',compact('user_count','product_count','order_count'));
    }
    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result = DB::table('tbl_admin')->where('email',$admin_email)->where('password',$admin_password)->first();
    	if($result){
            Session::put('name',$result->name);
            Session::put('admin_id',$result->id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản không hợp lệ');
            return Redirect::to('/admin');
        }

    }

    public function profile(){
        $this->AuthLogin();
        $all_user = DB::table('tbl_customer')->paginate(10);
        
        $admin_id=Session::get('admin_id');
        $admin_info=DB::table('tbl_admin')->where('id',$admin_id)->get();
        $manager_user=view('admin.admin_profile')->with('all_user',$all_user)->with('admin_info',$admin_info);
        return view('admin_layout')->with('admin.admin_profile',$manager_user);
    }
    public function update_admin(Request $request,$admin_id){
        $data = array();
        $data['name'] = $request->admin_name;
        $data['email'] = $request->admin_email;
        $data['phone'] = $request->admin_phone;
        $data['password'] = md5($request->admin_password);

        
      
        DB::table('tbl_admin')->where('id',$admin_id)->update($data);
        Session::put('message','Cập nhật thông tin thành công');
        return Redirect::to('admin-profile');
    }
    public function getDanhSach()
    {
    	// $taikhoan = DB::table('tbl_customer')->paginate(5);
	    // return view('admin_layout')->with('admin.user_list',$taikhoan);

	    $all_user = DB::table('tbl_admin')->paginate(5);
    	$manager_user=view('admin.admin_list')->with('all_user',$all_user);
    	return view('admin_layout')->with('admin.admin_list',$manager_user);

    }

    public function addUser(){
         
        return view('admin.add_admin');
    }
    public function saveUser(Request $request){
		$this->validate($request, [
			'email' => 'required|email|unique:tbl_admin,email',
            'phone' => 'required|min:10|max:11|',
			'name' => 'required|',
			'password' => 'required|'
		]);
		
		$data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = md5($request->password);
        $data['created_at'] = Carbon::now();
        $customer_id = DB::table('tbl_admin')->insertGetId($data);

       
        return Redirect()->back()->with('message','Đã thêm tài khoản ');

    }
    public function getXoa($admin_id){
    	DB::table('tbl_admin')->where('id', '=', $admin_id)->delete();
    	return Redirect()->back()->with('message','Đã xóa tài khoản ');

    }
    public function getReset($admin_id){
        $data = array();
        $data['password'] = md5('123456');
      
        DB::table('tbl_admin')->where('id',$admin_id)->update($data);
        return Redirect()->back()->with('message','Mật khẩu cấp lại là: 123456 ');
    }

}
