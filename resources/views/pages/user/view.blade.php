@extends('layout')
@section('content')
<div class="row">
    <div class="aside">			
        <h3 class="aside-title">Các mặt hàng đã xem</h3>
    </div>

    <!-- store top filter -->
    <div class="store-filter clearfix">
        <div class="pull-left">
            
            <div class="sort-filter">
                
            </div>
        </div>
        <div class="pull-right">
            
            <ul class="store-pages">
                {{$customer_view->links()}}
            </ul>
        </div>
    </div>
    <!-- /store top filter -->
        @if($customer_view->isEmpty())
        <div class="col-md-7">
            <div class="pull-right">
                <a href="{{url('trang-chu')}}" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Tiếp tục mua hàng</a>
            </div>
        </div>
        @else
            @foreach($customer_view as $view)
            <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="product product-single">
                <a href="{{URL::to('chi-tiet-san-pham/'.$view->product_id)}}">
                <div class="product-thumb">
                
                <img src="{{URL::to('public/uploads/product/'.$view->product_image)}}" alt="">
                </div>
                <div class="product-body">
                <h3 class="product-price">{{number_format($view->product_price).' '.'VNĐ'}}</h3>
                <div class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o empty"></i>
                </div>
                <h2 class="product-name"><a href="#">{{$view->product_name}}</a></h2>
                <div class="product-btns">
                    <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                    <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                    <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                </div>
                </div>
            </div>
            </div>
            
            @endforeach
        @endif
        <div class="store-filter clearfix">
            <div class="pull-left">
                
                <div class="sort-filter">
                    
                </div>
            </div>
            <div class="pull-right">
                
                <ul class="store-pages">
                    {{$customer_view->links()}}
                </ul>
            </div>
        </div>

@endsection