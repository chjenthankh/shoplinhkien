@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Tài khoản quản lý
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
                                @foreach($admin_info as $key => $admin)
                                <form role="form" action="{{URL::to('/admin/'.$admin->id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khách hàng</label>
                                    <input required="text" type="text" name="admin_name" value="{{$admin->name}}" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input required="text" type="text" name="admin_email" value="{{$admin->email}}" class="form-control" id="exampleInputEmail1" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input required="text" type="password" name="admin_password" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input required="text" type="text" name="admin_phone" value="{{$admin->phone}}" class="form-control" id="exampleInputEmail1">
                                </div>
                                
                               
                                <button type="submit" name="add_brand_product" class="btn btn-info">Cập nhật thông tin</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection 