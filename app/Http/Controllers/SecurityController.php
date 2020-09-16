<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Reminder;
use App\User;
use Mail;

class SecurityController extends Controller
{
    public function forgot(){
    	return view('security.forgot');
    }
    public function password(Request $request){
    	$email = $request->email;
    	$checkUser=User::where('customer_email',$email)->first();
    	if($checkUser){
    		return redirect('trang-chu');

    	}
    	else{
    		return redirect('login-checkout');
    	}
    	// $user=User::whereEmail($request->customer_email)->first();
    	// if($user==null){
    	// 	return redirect()->back()->with(['error'=>'Email không tồn tại']);
    	// }
    	// $user=Sentinel::findbyId($user->id);
    	// $reminder=Reminder::exists($user) ? : Reminder::create($user);
    	// $this->sendEmail($user,$reminder->code);
    	// return redirect()->back()->with(['success'=>'Đã gửi code']);
    }
    public function sendEmail($user,$code){
    	// Mail::send(
    	// 	'email.forgot',
    	// 	['user'=>$user,'code'=>$code],
    	// 	function($message) use ($user){
    	// 		$message->to($user->customer_email);
    	// 		$message->subject("$user->name, reset your password.");
    	// 	}
    	// );


    }
}
