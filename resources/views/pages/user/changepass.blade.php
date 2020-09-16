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
            <h3>Đổi mật khẩu</h3>
            <div class="col-md-4">
            <div class="store-filter clearfix">
                <div class="pull-right">
                    @if(!empty($success))
                            <div class="alert alert-success">{{$success}}</div>
                     @endif
                    @if(!empty($warning))
                        <div class="alert alert-danger">{{$warning}}</div>
                     @endif
                    <form action="{{url('/doi-mat-khau')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="old_password">Mật khẩu cữ </label>
                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Mật khẩu cữ" />
                        </div>  
                        @if ($errors->has('old_password"'))
								<div class="invalid-feedback"><strong>{{ $errors->first('old_password"') }}</strong></div>
						@endif
                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới </label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Mật khẩu mới" />
                        </div>  
                        @if ($errors->has('new_password'))
								<div class="invalid-feedback"><strong>{{ $errors->first('new_password') }}</strong></div>
						@endif
                        <div class="form-group">
                            <label for="new_password_confirmation">Xác nhận mật khẩu mới </label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Xác nhận mật khẩu mới" />
                        </div>
                        @if ($errors->has('new_password_confirmation'))
								<div class="invalid-feedback"><strong>{{ $errors->first('new_password_confirmation') }}</strong></div>
						@endif
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
