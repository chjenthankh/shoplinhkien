@extends('layout')
@section('content')

<div class="home-wrap">
        <!-- home slick -->
        <div id="home-slick">
          <!-- banner -->
          <div class="banner banner-1">
            <img src="{{('public/frontend/images/banner_slide1.jpg')}}" alt="">
            
          </div>
          <!-- /banner -->

          <!-- banner -->
          <div class="banner banner-1">
            <img src="{{('public/frontend/images/banner_slide2.jpg')}}" alt="">
            
          </div>
          <!-- /banner -->

          <!-- banner -->
          <div class="banner banner-1">
            <img src="{{('public/frontend/images/banner_slide3.png')}}" alt="">
            
          </div>
          <!-- /banner -->
        </div>
        <!-- /home slick -->
      </div>
      <!-- /home wrap -->
    </div>
    <!-- /container -->
  </div>
  <!-- /HOME -->
<div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      {{-- <div class="row">

        <!-- banner -->
        <div class="col-md-4 col-sm-6">
          <a class="banner banner-1" href="{{URL::to('/danh-muc-san-pham/10')}}">
            <img src="{{('public/frontend/images/banner_1.jpg')}}" alt="">
            
          </a>
        </div>
        <!-- /banner -->

        <!-- banner -->
        <div class="col-md-4 col-sm-6">
          <a class="banner banner-1" href="{{URL::to('/danh-muc-san-pham/15')}}">
            <img src="{{('public/frontend/images/banner_2.jpg')}}" alt="">
            
          </a>
        </div>
        <!-- /banner -->

        <!-- banner -->
        <div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3">
          <a class="banner banner-1" href="{{URL::to('/danh-muc-san-pham/13')}}">
            <img src="{{('public/frontend/images/banner_3.jpg')}}" alt="">
            
          </a>
        </div>
        <!-- /banner -->

      </div> --}}
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- section-title -->
        <div class="col-md-12">
          <div class="section-title">
            <h2 class="title">PC Gaming</h2>
            <div class="pull-right">
              <div class="product-slick-dots-1 custom-dots"></div>
            </div>
          </div>
        </div>
        <!-- /section-title -->

        <!-- banner -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="banner banner-2">
            <img src="{{('public/frontend/images/PC_banner.jpg')}}" alt="">
            
          </div>
        </div>
        <!-- /banner -->

        <!-- Product Slick -->
        <div class="col-md-9 col-sm-6 col-xs-6">

          <div class="row">

            <div id="product-slick-1" class="product-slick">
              @foreach($pc_product as $key=> $pc)
              <!-- Product Single -->
              <form action="{{URL::to('/save-cart')}}" method="POST">
                {{csrf_field()}}
              <div class="product product-single">
                <a href="{{URL::to('chi-tiet-san-pham/'.$pc->product_id)}}">
                <div class="product-thumb">
                  <div class="product-label">
                    <span>PC Gaming</span>

                  </div>
                  <img src="{{URL::to('public/uploads/product/'.$pc->product_image)}}" alt="">
                </div>
                <div class="product-body">
                  <h3 class="product-price">
                    {{number_format($pc->product_price).' '.'VNĐ'}}
                  </h3>
                  <div class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o empty"></i>
                  </div>
                  <h2 class="product-name"><a href="{{URL::to('chi-tiet-san-pham/'.$pc->product_id)}}">{{$pc->product_name}}</a></h2>
                  <div class="qty-input" >
                  
                    <input type="hidden" name="qty" class="input"min="1" value="1" type="number">
                    <input name="productid_hidden" type="hidden" value="{{$pc->product_id}}">
                  </div>
                  <div class="product-btns">
                    @php ($flag = false)
                    @if(Auth::check())
                      @if(isset($customer_wishlist))
                        @foreach($customer_wishlist as $wishlist)
                          @if($wishlist->customer_product_wishlist == $pc->product_id)
                            @php ($flag = true)
                            @break;
                          @endif
                        @endforeach
                         @if($flag)
                            <a style="color:red" href="{{url('delete-wishlist/'.$pc->product_id)}}" class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                            <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                          @else
                            <a href="{{url('add-wishlist/'.$pc->product_id)}}" class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                            <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                          @endif
                      @else
                        <a href="{{url('add-wishlist/'.$pc->product_id)}}" class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                      @endif
                      <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                    @else
                      <a class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                      <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                      <button type ="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                    @endif
                  </div>
                </div>
             </form>
              </div>
              <!-- /Product Single -->
              @endforeach
            </div>
          </div>
        </div>
        <!-- /Product Slick -->
      </div>
      <!-- /row -->

      <!-- row -->
      
    <!-- /container -->
  </div>  
  <!-- section -->
  <div class ="section">
    <div class = "container">
     <div class="row">
        <!-- section title -->
        <div class="col-md-12">
          <div class="section-title">
            <h2 class="title">Sản phẩm mới nhất</h2>
          </div>
        </div>
        <!-- section title -->

        <!-- Product Single -->
        @foreach($all_product as $key=> $product))
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="product product-single">
             <form action="{{URL::to('/save-cart')}}" method="POST">
                {{csrf_field()}}
            <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
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
              <h2 class="product-name"><a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">{{$product->product_name}}</a></h2>
               <div class="qty-input" >
                  
                    <input type="hidden" name="qty" class="input"min="1" value="1" type="number">
                    <input name="productid_hidden" type="hidden" value="{{$product->product_id}}">
                  </div>
              <div class="product-btns">
                @php ($flag = false)
                @if(Auth::check())
                @if(isset($customer_wishlist))
                  @foreach($customer_wishlist as $wishlist)
                    @if($wishlist->customer_product_wishlist == $product->product_id)
                      @php ($flag = true)
                      @break;
                    @endif
                  @endforeach
                   @if($flag)
                      <a style="color:red" href="{{url('delete-wishlist/'.$product->product_id)}}" class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                      <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                    @else
                      <a href="{{url('add-wishlist/'.$product->product_id)}}" class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                      <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                    @endif
                @else
                  <a href="{{url('add-wishlist/'.$product->product_id)}}" class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                  <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                @endif
                <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
              @else
                <a class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
              @endif
              </div>
            </div>
          </form>
          </div>

        </div>
        @endforeach
        <!-- /Product Single -->

        
      </div>
      
      <!-- /row -->

      <!-- row -->
      
      <!-- /row -->

      <!-- row -->
      
      <!-- /row -->
    </div>
  </div>
  <div class ="section">
    <div class = "container">
     <div class="row">
        <!-- section title -->
        <div class="col-md-12">
          <div class="section-title">
            <h2 class="title">RAM</h2>
          </div>
        </div>
        <!-- section title -->

        <!-- Product Single -->
        @foreach($ram_product as $key=> $ram)
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="product product-single">
             <form action="{{URL::to('/save-cart')}}" method="POST">
                {{csrf_field()}}
            <a href="{{URL::to('chi-tiet-san-pham/'.$ram->product_id)}}">
            <div class="product-thumb">
              
              <img src="{{URL::to('public/uploads/product/'.$ram->product_image)}}" alt="">
            </div>
            <div class="product-body">
              <h3 class="product-price">{{number_format($ram->product_price).' '.'VNĐ'}}</h3>
              <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o empty"></i>
              </div>
              <h2 class="product-name"><a href="{{URL::to('chi-tiet-san-pham/'.$ram->product_id)}}">{{$ram->product_name}}</a></h2>
               <div class="qty-input" >
                  
                    <input type="hidden" name="qty" class="input"min="1" value="1" type="number">
                    <input name="productid_hidden" type="hidden" value="{{$ram->product_id}}">
                  </div>
              <div class="product-btns">
                @php ($flag = false)
                @if(Auth::check())
                @if(isset($customer_wishlist))
                  @foreach($customer_wishlist as $wishlist)
                    @if($wishlist->customer_product_wishlist == $ram->product_id)
                      @php ($flag = true)
                      @break;
                    @endif
                  @endforeach
                   @if($flag)
                      <a style="color:red" href="{{url('delete-wishlist/'.$ram->product_id)}}" class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                      <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                    @else
                      <a href="{{url('add-wishlist/'.$ram->product_id)}}" class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                      <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                    @endif
                @else
                  <a href="{{url('add-wishlist/'.$ram->product_id)}}" class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                  <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                @endif
                <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
              @else
                <a class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                <a class="main-btn icon-btn"><i class="fa fa-exchange"></i></a>
                <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
              @endif
              </div>
            </div>
          </form>
          </div>

        </div>
        @endforeach
        <!-- /Product Single -->

        
      </div>
      
      <!-- /row -->

      <!-- row -->
      
      <!-- /row -->

      <!-- row -->
      
      <!-- /row -->
    </div>
  </div>
  </div>



@endsection