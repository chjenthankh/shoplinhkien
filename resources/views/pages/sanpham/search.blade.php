@extends('layout')
@section('content')
<div id="breadcrumb">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
         

        <li class="active">Tìm kiếm</li>
        

      </ul>
    </div>
  </div>
<div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- ASIDE -->
        <div id="aside" class="col-md-3">


          <!-- aside widget -->
          <div class="aside">

            
            <h3 class="aside-title">Kết quả tìm kiếm</h3>
            
            
            
          </div>
          <!-- /aside widget -->

          <!-- aside widget -->
          
          <!-- /aside widget -->

          <!-- aside widget -->
          
          <!-- /aside widget -->
        </div>
        <!-- /ASIDE -->

        <!-- MAIN -->
        <div id="main" class="col-md-9">
          <!-- store top filter -->
          <div class="store-filter clearfix">
            <div class="pull-left">
              
              <div class="sort-filter">
                
              </div>
            </div>
            <div class="pull-right">
              <div class="page-filter">
                
              </div>
              <ul class="store-pages">
               
              </ul>
            </div>
          </div>
          <!-- /store top filter -->

          <!-- STORE -->
          <div id="store">
            <!-- row -->
            <div class="row">
              <!-- Product Single -->
              @foreach($search_product as $key=> $product)
              <form action="{{URL::to('/save-cart')}}" method="POST">
                      {{csrf_field()}}
              <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
              <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="product product-single">
                  <div class="product-thumb">
                      
                    <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="">
                  </div>
                  <div class="product-body">
                    <h3 class="product-price">{{number_format($product->product_price).' '.'VNĐ'}}</h3>
                    <div class="product-rating">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star-o empty"></i>
                    </div>
                    <input type="hidden" name="qty" class="input"min="1" value="1" type="number">
                   <input name="productid_hidden" type="hidden" value="{{$product->product_id}}">
                    <h2 class="product-name"><a href="#">{{$product->product_name}}</a></h2>
                    <div class="product-btns">
                      <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                      <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                      <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                    </div>
                  </div>
                </div>
              </div>
        </form>
        @endforeach
              <!-- /Product Single -->

              <!-- Product Single -->
              
              <!-- /Product Single -->
            </div>
            <!-- /row -->
          </div>
          <!-- /STORE -->

          <!-- store bottom filter -->
          <div class="store-filter clearfix">
            <div class="pull-left">
              
              <div class="sort-filter">
                
              </div>
            </div>
            <div class="pull-right">
              
              <ul class="store-pages">
                
              </ul>
            </div>
          </div>
          <!-- /store bottom filter -->
        </div>
        <!-- /MAIN -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
@endsection