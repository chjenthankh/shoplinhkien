@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div id="aside" class="col-md-3">


            <!-- aside widget -->
            <div class="aside">
                <h3 class="aside-title">Thông tin tài khoản</h3>
                <ul class="list-links">
                   <a href="{{url('thong-tin-tai-khoan')}}"> <li> Thông tin cá nhân </li> </a>
                </ul>
                <ul class="list-links">
                    <a href="{{url('doi-mat-khau')}}"> <li> Đổi mật khẩu </li> </a>
                 </ul>
                 <ul class="list-links">
                    <a href="{{url('dia-chi')}}"> <li> Địa chỉ </li> </a>
                 </ul>
                 <ul class="list-links">
                    <a href="{{url('da-xem')}}"> <li> Sản phẩm bạn đã xem </li> </a>
                 </ul>
                 <ul class="list-links">
                    <a href="{{url('wishlist')}}"> <li> Sản phẩm yêu thích </li> </a>
                 </ul>
            </div>
            <!-- /aside widget -->

            <!-- aside widget -->
            
            <!-- /aside widget -->

            <!-- aside widget -->
            
            <!-- /aside widget -->
           
        </div>
        <div id="store">
            <h3>Thông tin tài khoản</h3>
            <div class="col-md-4">
            <div class="store-filter clearfix">
                <div class="pull-right">
                    @if(!empty($success))
                            <div class="alert alert-success">{{$success}}</div>
                     @endif
                     @if(!empty($warning))
                            <div class="alert alert-success">{{$warning}}</div>
                     @endif
                    <form action="{{url('/sua-thong-tin-tai-khoan')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ tên </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$customer->name}}" />
                        </div>  
                        <div class="form-group">
                            <label for="phone">Số điện thoại </label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$customer->phone}}" />
                        </div>  
                        <div class="form-group">
                            <label for="email">Email </label>
                            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{$customer->email}}" readonly/>
                        </div>
                        @if ($errors->has('email'))
								<div class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></div>
						@endif
                        <div class="form-control">
                            <button type="submit" class="btn btn-warning">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
