@extends('layout')
@section('content')
<div class="row">
				<form id="checkout-form" class="clearfix">
					<div class="col-md-12">
						@foreach($order_details2 as $key=>$status)
						<ol class="progtrckr" data-progtrckr-steps="5">
							<?php
				              if($status->order_status=='Đang chờ xử lý'){
				                ?>
				                <li class="progtrckr-done">Đang xử lý</li>
				                <li class="progtrckr-todo">Đã xác nhận</li>
				                <li class="progtrckr-todo">Đang vận chuyển</li>
				                <li class="progtrckr-todo">Hoàn thanh đơn hàng</li>
				             <?php
				                }elseif($status->order_status=='Xác nhận đơn hàng'){
				                  ?>
				                 <li class="progtrckr-done">Đang xử lý</li>
					             <li class="progtrckr-done">Đã xác nhận</li>
					             <li class="progtrckr-todo">Đang vận chuyển</li>
					             <li class="progtrckr-todo">Hoàn thanh đơn hàng</li>
					          <?php
				                }elseif($status->order_status=='Đang giao hàng'){
				                  ?>
				                 <li class="progtrckr-done">Đang xử lý</li>
					             <li class="progtrckr-done">Đã xác nhận</li>
					             <li class="progtrckr-done">Đang vận chuyển</li>
					             <li class="progtrckr-todo">Hoàn thanh đơn hàng</li>
					           <?php
				                }elseif($status->order_status=='Từ chối đơn hàng'){
				                  ?>
				                 <li class="progtrckr-todo">Đang xử lý</li>
					             <li class="progtrckr-todo">Đã xác nhận</li>
					             <li class="progtrckr-todo">Đang vận chuyển</li>
					             <li class="progtrckr-todo">Hoàn thanh đơn hàng</li>
					             <li class="progtrckr-done">Từ chối đơn hàng</li>
				             <?php
				              }else{
				                ?>
				                <li class="progtrckr-done">Đang xử lý</li>
					             <li class="progtrckr-done">Đã xác nhận</li>
					             <li class="progtrckr-done">Đang vận chuyển</li>
					             <li class="progtrckr-done">Hoàn thanh đơn hàng</li>
				                <?php            
				              }
				              ?>
						    <!-- <li class="progtrckr-done">Đang xử lý</li>

						 	<li class="progtrckr-done">Đang vận chuyển</li> -->
						</ol>
						@endforeach
						<style>
							ol.progtrckr {
								    margin: 0;
								    padding: 0;
								    list-style-type none;
								}

								ol.progtrckr li {
								    display: inline-block;
								    text-align: center;
								    line-height: 3.5em;
								}

								ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
								ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
								ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
								ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }
								ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
								ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
								ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
								ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }

								ol.progtrckr li.progtrckr-done {
								    color: black;
								    border-bottom: 4px solid yellowgreen;
								}
								ol.progtrckr li.progtrckr-todo {
								    color: silver; 
								    border-bottom: 4px solid silver;
								}

								ol.progtrckr li:after {
								    content: "\00a0\00a0";
								}
								ol.progtrckr li:before {
								    position: relative;
								    bottom: -2.5em;
								    float: left;
								    left: 50%;
								    line-height: 1em;
								}
								ol.progtrckr li.progtrckr-done:before {
								    content: "\2713";
								    color: white;
								    background-color: yellowgreen;
								    height: 2.2em;
								    width: 2.2em;
								    line-height: 2.2em;
								    border: none;
								    border-radius: 2.2em;
								}
								ol.progtrckr li.progtrckr-todo:before {
								    content: "\039F";
								    color: silver;
								    background-color: white;
								    font-size: 2.2em;
								    bottom: -1.2em;
								}


						</style>
					</div>

					<div class="col-md-6">
						

						
					</div>

					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Chi tiết lịch sử đơn hàng</h3>
							</div>
							
							<table class="shopping-cart-table table">
								<thead>
									@foreach($order_details2 as $key=>$info)
									<tr>
										<th class="text-center">Địa chỉ: {{$info->shipping_address}}</th>
										<th class="text-center">Số điện thoại: {{$info->shipping_phone}}</th>
										<th class="text-center">Email: {{$info->shipping_email}}</th>
										<th class="text-center">Ghi chú: {{$info->shipping_notes}}</th>
									</tr>
									
									
									@endforeach
								</thead>
								
								<thead>
									<tr>
										<th>Sản phẩm</th>
										<th>Tên sản phẩm</th>
										<th class="text-center">Giá</th>
										<th class="text-center">Số lượng</th>
										
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($order_details as $key=>$order_user)
									<tr>
										<td class="thumb"><img src="{{URL::to('public/uploads/product/'.$order_user->product_image)}}" alt=""></td>
										<td class="details">
											<a href="#">{{$order_user->product_name}}</a>
											
										</td>
										<td class="price text-center"><strong class="primary-color">{{number_format($order_user->product_price).' '.'vnđ'}}</strong></td>
										<td class="price text-center">{{$order_user->product_sales_quantity}}</td>
										
										<td class="total text-center"><strong class="primary-color">
											
										</strong>
										
									<!-- </td>
										<td class="text-right" ><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></td>
									</tr> -->
									
									@endforeach
								</tbody>
								
							</table>
							
						</div>
						

					</div>
				</form>
			</div>
@endsection