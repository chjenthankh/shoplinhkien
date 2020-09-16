<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Shop linh kiện máy tính</title>

  <!-- Google font -->
  <link href="{{asset('https://fonts.googleapis.com/css?family=Hind:400,700')}}" rel="stylesheet">

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}" />

  <!-- Slick -->
  <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/slick.css')}}" />
  <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/slick-theme.css')}}" />

  <!-- nouislider -->
  <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/nouislider.min.css')}}" />

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="{{asset('public/frontend/css/font-awesome.min.css')}}">

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <!-- HEADER -->
  <header>
    <!-- top Header -->
    
    <!-- /top Header -->

    <!-- header -->
    <div id="header">
      <div class="container">
        <div class="pull-left">
          <!-- Logo -->
          <div class="header-logo">
            <a class="logo" href="{{URL::to('/trang-chu')}}">
              <img " src="{{('public/frontend/images/logo.png')}}" alt="">
            </a>
          </div>
          <!-- /Logo -->

          <!-- Search -->
          
          <div class="header-search">
            <form action="{{URL::to('/tim-kiem')}}" method="POST" >
              {{csrf_field()}}
              <input required="text"  name="keywords_submit" class="input search-input" style="padding-left: 0px;
  padding-right: 0px width: 400px;;" type="text" placeholder="Nhập sản phẩm cần tìm">
              <!-- <input type="submit" name="search_items" class="search-btn" placeholder="Tìm kiếm"> -->
              
              <!-- <button class="search-btn"><i class="fa fa-search"></i></button> -->
              <input type="submit" name="search_items" class="search-btn"value="Tìm" style="background-color: #F8694A" width="">
            </form>
          </div>
          <!-- /Search -->
        </div>
        <div class="pull-right">
          <ul class="header-btns">
            <!-- Account -->
            <li class="header-account dropdown default-dropdown">
              <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                <div class="header-btns-icon">
                  <i class="fa fa-user-o"></i>
                </div>
                <strong class="text-uppercase">

                  <?php
                  if(Auth::check()){
                     echo Auth::user()->name;
                  }
                  else{
                    echo 'Tài khoản';
                  }
             
                  ?>
                <i class="fa fa-caret-down"></i></strong>
            </div>
            <!-- <a href="#" class="text-uppercase">Đăng nhập</a> / <a href="#" class="text-uppercase">Đăng ký</a> -->
            <ul class="custom-menu">
              @if(Auth::check())
              <li><a href="{{url('/thong-tin-tai-khoan')}}"><i class="fa fa-user-o"></i> Tài khoản</a></li>
              <li><a href="{{URL::to('/history')}}"><i class="fa fa-history"></i> Lịch sử mua hàng</a></li>
             @endif
              <!-- <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-check"></i> Thanh toán</a></li> -->
              <?php
               $shipping_id = Session::get('shipping_id');
               if(Auth::check() && $shipping_id==NULL){ 
               ?>
               <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                              
               <?php
                }elseif(Auth::check()  && $shipping_id!=NULL){
               ?>
                <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                <?php 
                }else{
                ?>
                  <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                <?php
                }
                 ?>

                  @if(Auth::check()) 

              <li><a href="{{route('logout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
         
              @else
              <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>

                 @endif


                <!-- <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-user-plus"></i> Tạo tài khoản</a></li> -->
              </ul>
            </li>
            <!-- /Account -->

            <!-- Cart -->
            <li class="header-cart dropdown default-dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <div class="header-btns-icon">
                  <i class="fa fa-shopping-cart"></i>
                  <span class="qty">{{Cart::count()}}</span>
                </div>
                <strong class="text-uppercase">Giỏ hàng:</strong>
                <?php
              $content=Cart::content();
              

              ?>
                <br>
                <span>
                    {{Cart::total().' '.'VNĐ'}}
                </span>
              </a>
              <div class="custom-menu">
                <div id="shopping-cart">
                  <div class="shopping-cart-list">
                    <div class="product product-widget">
                      @foreach($content as $v_content)
                      <div class="product-thumb">
                        <img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" alt="">
                      </div>
                      
                      <div class="product-body">
                        <h3 class="product-price">{{number_format($v_content->price).' '.'vnđ'}} <span class="qty">x {{$v_content->qty}}</span></h3>
                        <h2 class="product-name"><a href="#">{{$v_content->name}}</a></h2>
                      </div>
                      <a class="cancel-btn" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-trash"></i></a>
                      <<!-- button class="cancel-btn"><i class="fa fa-trash"></i></button> -->
                      @endforeach
                    </div>
                    
                  </div>
                  <div class="shopping-cart-btns">
                    <a class="main-btn" href="{{URL::to('/show-cart')}}">Xem giỏ hàng</a>
                    @if(Auth::check())
                    <a class="primary-btn" href="{{URL::to('/checkout')}}"><i class="fa fa-arrow-circle-right"></i>Thanh toán</a>
                    @else
                    <a class="primary-btn" href="{{URL::to('/login-checkout')}}"><i class="fa fa-arrow-circle-right"></i>Thanh toán</a>
                    @endif
                    <!-- <button class="primary-btn">Thanh toán <i class="fa fa-arrow-circle-right"></i></button> -->
                  </div>
                </div>
              </div>
            </li>
            <!-- /Cart -->

            <!-- Mobile nav toggle-->
            <li class="nav-toggle">
              <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
            </li>
            <!-- / Mobile nav toggle -->
          </ul>
        </div>
      </div>
      <!-- header -->
    </div>
    <!-- container -->
  </header>
  <!-- /HEADER -->

  <!-- NAVIGATION -->
  <div id="navigation">
    <!-- container -->
    <div class="container">
      <div id="responsive-nav">
        <!-- category nav -->
        <div class="category-nav">
          <div class="category-nav show-on-click ">
          <span class="category-header">Danh mục sản phẩm <i class="fa fa-list"></i></span>
          <ul class="category-list">
            <li class="dropdown side-dropdown">
            @foreach($category as $key =>$cate)
            <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
            @endforeach
          </li>
          </ul>
        </div>
        </div>
        <!-- /category nav -->

        <!-- menu nav -->
        <div class="menu-nav">
          <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
          <ul class="menu-list">
            <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
            
            
            
          </ul>
        </div>
        <!-- menu nav -->
      </div>
    </div>
    <!-- /container -->
  </div>
  <!-- /NAVIGATION -->

  <!-- HOME -->
  <div id="home">
    <!-- container -->
    <div class="container">
      <!-- home wrap -->
      @yield('content')
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /section -->

  <!-- FOOTER -->
  <footer id="footer" class="section section-grey">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- footer widget -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="footer">
            <!-- footer logo -->
            <div class="footer-logo">
              <a class="logo" href="#">
                <img src="{{('public/frontend/images/logo.png')}}" alt="">
              </a>
            </div>
            <!-- /footer logo -->

            <p>Báo cáo đồ án môn Thương mại điện tử</p>
            <p>Website được phát triển trên ngôn ngữ PHP, sử dụng framework Lavarel và Bootstrap.</p>

            <!-- footer social -->
            <ul class="footer-social">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            </ul>
            <!-- /footer social -->
          </div>
        </div>
        <!-- /footer widget -->

        <!-- footer widget -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="footer">
            <h3 class="footer-header">Thông tin về E-Shop</h3>
            <ul class="list-links">
              <li><a href="#">Trang chủ</a></li>
              <li><a href="#">Về E-Shop</a></li>
              <li><a href="#">Tuyển dụng</a></li>
              
            </ul>
          </div>
        </div>
        <!-- /footer widget -->

        <div class="clearfix visible-sm visible-xs"></div>

        <!-- footer widget -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="footer">
            <h3 class="footer-header">Chính sách</h3>
            <ul class="list-links">
              <li><a href="#">Chính sách giao hàng</a></li>
              <li><a href="#">Chính sách đổi trả</a></li>
              <li><a href="#">Qui định bảo hành</a></li>
              <li><a href="#">FAQ</a></li>
            </ul>
          </div>
        </div>
        <!-- /footer widget -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="footer">
            <h3 class="footer-header">Hỗ trợ khách hàng</h3>
            <ul class="list-links">
              <li></li>
              
              
            </ul>
          </div>
        </div>
        <!-- footer subscribe -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          
        </div>
        <!-- /footer subscribe -->
      </div>
      <!-- /row -->
      <hr>
      <!-- row -->
      <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
          <!-- footer copyright -->
          <div class="footer-copyright">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </div>
          <!-- /footer copyright -->
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </footer>
  <!-- /FOOTER -->

  <!-- jQuery Plugins -->
  <script src="{{asset('public/frontend/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/slick.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/nouislider.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.zoom.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/main.js')}}"></script>

</body>

</html>
