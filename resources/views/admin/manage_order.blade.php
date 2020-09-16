@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kệ đơn hàng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        
                   
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên người mua hàng</th>
            <th>Tổng tiền</th>
            <th>Ngày mua hàng</th>

            <th>Tình trạng</th>
            <th>Xác nhận đơn</th>
            <th>Tùy chọn</th>
            <th>In hóa đơn</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_order as $key=>$order)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$order->name }}</td>
            <td>{{$order->order_total }}</td>
            <td>{{$order->created_at }}</td>
            <td>{{$order->order_status }}</td>
            <td>
              <?php
              if($order->order_status=='Đang chờ xử lý'){
                ?>
              <a href="{{URL::to('/confirm-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-retweet text-success text-active"></i></a>

                <a href="{{URL::to('/reject-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-close text-danger text"></i></a>
                <?php
                }elseif($order->order_status=='Xác nhận đơn hàng'){
                  ?>
                  <a href="{{URL::to('/ship-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-check-circle-o text-success text-active"></i></a>
                <?php
                }elseif($order->order_status=='Đang giao hàng'){
                  ?>
                  <a href="{{URL::to('/finish-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-truck text-success text-active"></i></a>
                <?php
                }elseif($order->order_status=='Đã hoàn thành'){
                  ?>
                  <a href="#" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-money text-success text-active"></i></a>


                <?php
                }else{
                  ?>
                  <a href="#" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-close text-muted text"></i></a>
                <?php    
                }
              ?>
            </td>
            <td>
              <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không ?')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-trash text-danger text"></i>
              </a>
            </td>
            <td>
              <a href="{{URL::to('/bill/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-print text-success text-active"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{$all_order->links()}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection 