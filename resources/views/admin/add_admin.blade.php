@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm khách hàng
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-admin')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name">Tên khách hàng </label>
                                        <input class="form-control" id="name" name="name" placeholder="Tên khách hàng" />
                                    </div>  
                                    @if ($errors->has('name"'))
                                            <div class="invalid-feedback"><strong>{{ $errors->first('name"') }}</strong></div>
                                    @endif
                                    <div class="form-group">
                                        <label for="email">Email </label>
                                        <input  class="form-control" id="email" name="email" placeholder="Email" />
                                    </div>  
                                    @if ($errors->has('email'))
                                            <div class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></div>
                                    @endif
                                    <div class="form-group">
                                        <label for="password">Mật khẩu </label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" />
                                    </div>
                                    @if ($errors->has('password'))
                                            <div class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></div>
                                    @endif
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại </label>
                                        <input class="form-control" id="phone" name="phone" placeholder="mật khẩu" />
                                    </div>
                                    @if ($errors->has('phone'))
                                            <div class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></div>
                                    @endif
                                
                               
                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm người dùng</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection 