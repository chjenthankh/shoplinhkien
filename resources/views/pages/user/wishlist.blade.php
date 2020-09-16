@extends('layout')
@section('content')
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
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
            <!-- /ASIDE -->

            <!-- MAIN -->
            <div id="main" class="col-md-9">
                <h3>Sản phẩm yêu thích</h3>
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="pull-left">
                        
                        <div class="sort-filter">
                            
                        </div>
                    </div>
                    <div class="pull-right">
                        
                        <ul class="store-pages">
                            {{$customer_wishlist->links()}}
                        </ul>
                    </div>
                </div>
                <!-- /store top filter -->
                <!-- STORE -->
                <div id="store">
                    <!-- row -->
                    <div class="row">
                        <!-- Product Single -->
                        @foreach($customer_wishlist as $wishlist)
                        <a href="{{URL::to('chi-tiet-san-pham/'.$wishlist->product_id)}}">
                        <div class="col-md-3">
                            <div class="product product-single">
                                <a class="cancel-btn" href="{{url('delete-wishlist/'.$wishlist->product_id)}}"><i class="fa fa-trash"></i></a>
                                <div class="product-thumb">                           
                                    <img style ="width:200px; height:200px;" src="{{URL::to('public/uploads/product/'.$wishlist->product_image)}}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">{{number_format($wishlist->product_price).' '.'VNĐ'}}</h3>
                                    <h2 class="product-name"><a href="#">{{$wishlist->product_name}}</a></h2>
                                </div>
                            </div>
                        </div>
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
                            {{$customer_wishlist->links()}}
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