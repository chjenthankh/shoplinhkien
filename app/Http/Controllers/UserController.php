<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function getDanhSach()
    {
    	// $taikhoan = DB::table('tbl_customer')->paginate(5);
	    // return view('admin_layout')->with('admin.user_list',$taikhoan);

	    $all_user = DB::table('tbl_customer')->paginate(5);
    	$manager_user=view('admin.user_list')->with('all_user',$all_user);
    	return view('admin_layout')->with('admin.user_list',$manager_user);

    }
    public function getXoa($customer_id){
    	DB::table('tbl_customer')->where('id', '=', $customer_id)->delete();
    	return Redirect()->back()->with('message','Đã xóa tài khoản ');

	}
	public function addUser(){
         
        return view('admin.add_user');
    }
    public function saveUser(Request $request){
		$this->validate($request, [
			'email' => 'required|email|unique:tbl_customer,email',
            'phone' => 'required|min:10|max:11|',
			'name' => 'required|',
			'password' => 'required|'
		]);
		
		$data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);;
        $data['created_at'] = Carbon::now();
        $customer_id = DB::table('tbl_customer')->insertGetId($data);

       
        return Redirect()->back()->with('message','Đã thêm tài khoản ');

    }

	public function getInfor(){
		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		$customer = DB::table('tbl_customer')->where('id',Auth::user()->id)->first();
		return view('pages.user.information',['category'=>$cate_product,'brand'=>$brand_product])->with('customer',$customer);
	}
	public function postInfor(request $rq){
		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		
		$rq->validate([
			'email' => 'required|email|unique:tbl_customer,email,' . Auth::user()->id . ',id',
			'phone' => 'required|min:10|max:11|',
			'name' => 'required|'
		]);
		
		$controls = array();
		$controls['email'] = $rq->email;
		$controls['phone'] = $rq->phone;
		$controls['name'] = $rq->name;
		try
		{
			DB::table('tbl_customer')->where('id',Auth::user()->id)->update($controls);
			$customer = DB::table('tbl_customer')->where('id',Auth::user()->id)->first();
			return view('pages.user.information')->with('category',$cate_product)->with('brand',$brand_product)->with('success', 'Cập nhật thành công!')->with('customer',$customer);
		}
		catch(Exception $e)
		{
			return -1;
		}
	}

	public function getDoiMatKhau(){
		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		return view('pages.user.changepass',['category'=>$cate_product,'brand'=>$brand_product]);
	}

	public function postDoiMatKhau(request $request){
		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		$customer = DB::table('tbl_customer')->where('id',Auth::user()->id)->first();

		$this->validate($request, [
			'old_password' => 'required|max:255|',
            'new_password' => 'required|min:6|confirmed'
		]);

		$customer = DB::table('tbl_customer')->where('id', Auth::user()->id)->first();
		if((Hash::check($request->get('old_password'), Auth::user()->password)))
		{
			DB::table('tbl_customer')->where('id', Auth::user()->id)->update([
				'password' => Hash::make($request->new_password),
				'updated_at' => Carbon::now()
			]);
			return view('pages.user.changepass')->with('category',$cate_product)->with('brand',$brand_product)->with('success', 'Đổi mật khẩu thành công!');
		}
		else{
			return view('pages.user.changepass')->with('category',$cate_product)->with('brand',$brand_product)->with('warning', 'Mật khẩu cũ không chính xác!');
		}
	}

	public function getDiaChi(){
		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		$customer = DB::table('tbl_customer_address')->where('customer_id',Auth::user()->id)->get();
			
		return view('pages.user.address',['category'=>$cate_product,'brand'=>$brand_product])->with('customer',$customer);
	}
	public function postThemDiaChi(request $request){
		$data=array();
		$data['customer_id']=Auth::user()->id;
    	$data['Province']=$request->Province;
    	$data['District']=$request->District;
		$data['Ward']=$request->Ward;
		$data['Address']=$request->Address;

		DB::table('tbl_customer_address')->insert($data);
		
		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		$customer = DB::table('tbl_customer_address')->where('customer_id',Auth::user()->id)->get();

    	return view('pages.user.address')->with('category',$cate_product)->with('brand',$brand_product)->with('customer',$customer)->with('thongbaothem', 'Thêm thành công');
	}

	public function postSuaDiaChi(request $request){

		DB::table('tbl_customer_address')->where('id',$request->ID_edit)->update([
			'Province' => $request->Province_edit,
			'District' =>  $request->District_edit,
			'Ward' => $request->Ward_edit,
			'Address' => $request->Address_edit,
		]);
		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		$customer = DB::table('tbl_customer_address')->where('customer_id',Auth::user()->id)->get();
		return view('pages.user.address')->with('category',$cate_product)->with('brand',$brand_product)->with('customer',$customer)->with('thongbaosua', 'Sửa thành công');
	}

	public function getXoaDiaChi(request $request)
	{
		DB::table('tbl_customer_address')->where('id',$request->id)->delete();

		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		$customer = DB::table('tbl_customer_address')->where('customer_id',Auth::user()->id)->get();
		return view('pages.user.address')->with('category',$cate_product)->with('brand',$brand_product)->with('customer',$customer)->with('thongbaoxoa', 'Xóa thành công');
	}

	public function getDaXem(request $request)
	{
		DB::table('tbl_customer_address')->where('id',$request->id)->delete();

		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		$customer_view = DB::table('tbl_customer_view')
		->join('tbl_product','tbl_customer_view.customer_product_view','=','tbl_product.product_id')
        ->select('tbl_customer_view.*','tbl_product.*')->where('tbl_customer_view.customer_id',Auth::user()->id)->paginate(8);
		return view('pages.user.view')->with('category',$cate_product)->with('brand',$brand_product)->with('customer_view',$customer_view);
	}
	public function addWishList($product_id)
	{
		$customer_view = DB::table('tbl_customer_wishlist')->where('customer_id',Auth::user()->id)->get();
        $flag = true;
        foreach($customer_view as $cus_view){
            if($cus_view->customer_product_wishlist == $product_id ){
                $flag = false;
                break;
            }
        }
        if($flag) {
            $data = array();
            $data['customer_id'] = Auth::user()->id;
            $data['customer_product_wishlist'] = $product_id;
            DB::table('tbl_customer_wishlist')->insert($data);
        }

		// $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		// $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		return redirect()->back();
	}
	public function deleteWishList($product_id)
	{
		DB::table('tbl_customer_wishlist')->where('customer_id',Auth::user()->id)
		->where('customer_product_wishlist',$product_id)->delete();

		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		return redirect()->back();
	}
	public function getWishList()
	{
		$customer_wishlist = DB::table('tbl_customer_wishlist')
		->join('tbl_product','tbl_customer_wishlist.customer_product_wishlist','=','tbl_product.product_id')
        ->select('tbl_customer_wishlist.*','tbl_product.*')->where('tbl_customer_wishlist.customer_id',Auth::user()->id)->paginate(4);

		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		return view('pages.user.wishlist')->with('category',$cate_product)->with('brand',$brand_product)->with('customer_wishlist',$customer_wishlist);
    }
    public function getReset($customer_id){
        $data = array();
        $data['password'] = Hash::make('123456');
       

        // $data['slug_brand_product'] = $request->slug_brand_product;
      
        DB::table('tbl_customer')->where('id',$customer_id)->update($data);
        return Redirect()->back()->with('message','Mật khẩu cấp lại là: 123456 ');
    }
}