@extends('layout')
@section('content')
<div class="row">
				<!-- <form id="checkout-form" class="clearfix"> -->
					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Lịch sử mua hàng</h3>
							</div>
							<table class="shopping-cart-table table">
								
								<thead>
									<tr>
										<!-- <th>Product</th>
										<th></th> -->
										<th class="text-center">Ngày mua hàng</th>
										<th class="text-center">Tình trạng</th>

										<th class="text-center">Tổng tiền</th>
										
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($user_order as $key=>$order)
									<tr>
										<!-- <td class="thumb"><img src="./img/thumb-product01.jpg" alt=""></td>
										<td class="details">
											<a href="#">{{$order->customer_id}}</a>
											 -->
										
										<td class="price text-center"><strong>{{$order->created_at}}</strong></td>
										<td class="price text-center"><strong>{{$order->order_status}}</strong></td>
										<!-- <td class="qty text-center"><input class="input" type="number" value="1"></td> -->
										<td class="total text-center"><strong class="primary-color">{{$order->order_total}}</strong></td>
										<td>
											 <a style="font-size: 20px;" href="{{URL::to('/view-order-user/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
               								 <i style="color: green" class="fa fa-search text-success text-active"></i></a>
										</td>
										
										
									</tr>
									@endforeach
								</tbody>
								
							</table>
							
						</div>

					</div>


					
				<!-- </form> -->
			</div>
@endsection