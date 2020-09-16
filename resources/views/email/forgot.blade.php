<h1>Hello {{$user->name}}</h1>
<p>
	Please click
	<a href="{{url('reset_password'.$user->customer_email.'/'.$code)}}">Reset</a>
</p>