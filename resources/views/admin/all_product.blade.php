@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kệ sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
                   
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <form action="{{URL::to('/tim-kiem-sp')}}" method="POST" >
            {{csrf_field()}}
          <input type="text" name="keywords_sp" placeholder="Tìm kiếm sản phẩm">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-sm btn-default" type="button">Tìm kiếm sản phẩm</button>
          </span>
          </form>
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
            
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hình sản phẩm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            

            <th>Hiển thị</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key=>$pro)
          <tr>
            
            <td>{{$pro->product_name }}</td>
            <td>{{$pro->product_price }}</td>
            <td><img src="public/uploads/product/{{$pro->product_image }}" height="100" width="100"></td>
            <td>{{$pro->category_name }}</td>
            <td>{{$pro->brand_name }}</td>
            <td><span class="text-ellipsis">
              <?php
              if($pro->product_status==0){
                ?>
                <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
              }else{
                ?>
                <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php            
              }
              ?>
            </span></td>
            
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không ?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
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
       
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{$all_product->links()}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection 