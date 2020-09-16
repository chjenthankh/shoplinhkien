@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kệ người dùng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
           
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Ngày đăng ký</th>
            <th>Cấp lại mật khẩu</th>
            <th>Xóa người dùng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_user as $key=>$user)
          <tr>
            
            <td>{{$user->name }}</td>
            <td>{{$user->email }}</td>
            <td>{{$user->phone }}</td>
            <td>{{$user->created_at }}</td>
            <td>
              <a onclick="return confirm('Cấp lại tài khoản ?')" href="{{ url('/taikhoan/reset/' . $user->id) }}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-key text-danger text"></i>
            </td>

            <td>
              
              <a onclick="return confirm('Bạn có chắc muốn xóa người dùng này không ?')" href="{{ url('/taikhoan/xoa/' . $user->id) }}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-trash text-danger text"></i>
              </a>
            </td>
          
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm"></small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{$all_user->links()}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection 