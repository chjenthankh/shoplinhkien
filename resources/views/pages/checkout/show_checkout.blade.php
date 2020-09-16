@extends('layout')
@section('content')
<div class="row">
				<!-- <form id="checkout-form" class="clearfix"> -->
					<div class="col-md-6">
						<div class="billing-details">
							
							<div class="section-title">
								<h3 class="title">Thông tin gửi hàng</h3>
							</div>
							<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
								{{csrf_field()}}
							<div class="form-group">
							<input class="input" type="text" name="shipping_name" value="{{$customer->name}}" readonly>
							</div>
							
							<div class="form-group">
								<input class="input" type="email" name="shipping_email" value="{{$customer->email}}" readonly>
							</div>
							<div class="form-group">
								<select id="customer_address_id" name="customer_address_id"> 
									<option vale="0"> Chọn địa chỉ</option>
									@foreach($customer_address as $address)
									<option value="{{$address->id}}"> {{$address->Address}} {{$address->Ward}} 
										{{$address->District}} {{$address->Province}} </option>
									@endforeach
								</select>
								<a href="{{url('/dia-chi/')}}" class="active styling-edit" ui-toggle-class="">
									<i style="font-size:20px" class="fa fa-plus text-success text"></i></a>
							</div>
														
							<div class="form-group">
								<input class="input" type="tel" name="shipping_phone" value="{{$customer->phone}}" readonly>
							</div>
							<div class="form-group">
								<p>Ghi chú đơn hàng</p>
								<textarea name="shipping_notes" placeholder="Ghi chú đơn hàng của bạn"	rows="10" required></textarea>
							</div>
							<div class="form-group">
							<input type="submit" value="Gửi" name="send_order" class="primary-btn">
							</div>
							</form>
						</div>
					</div>

					<div class="col-md-6">
						

						
					</div>

					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Đơn hàng</h3>
							</div>
							<?php
							$content=Cart::content();
							
							?>
							<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Sản phẩm</th>
										<th></th>
										<th class="text-center">Giá</th>
										<th class="text-center">Số lượng</th>
										<th class="text-center">Tổng tiền</th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($content as $v_content)
									<tr>
										<td class="thumb"><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" alt=""></td>
										<td class="details">
											<a href="#">{{$v_content->name}}</a>
											{{-- <ul>
												<li><span>Size: XL</span></li>
												<li><span>Color: Camelot</span></li>
											</ul> --}}
										</td>
										<td class="price text-center"><strong>{{number_format($v_content->price).' '.'vnđ'}}</strong></td>
										<td class="qty text-center">
											<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
												{{ csrf_field() }}
											<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}"  >
											<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
											<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
											</form>
										</td>
										<td class="total text-center"><strong class="primary-color">
											<?php
												$subtotal=$v_content->price*$v_content->qty;
												echo number_format($subtotal).' '.'vnđ';
											?>
										</strong>
										<td class="text-right">
											<a class="main-btn icon-btn" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-close"></i></a>
										</td>
									<!-- </td>
										<td class="text-right" ><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></td>
									</tr> -->
									@endforeach
									
								</tbody>
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>Tạm tính</th>
										<th colspan="2" class="sub-total">{{Cart::subtotal().' '.'vnđ'}}</th>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>Thuế VAT</th>
										<td colspan="2">{{Cart::tax().' '.'vnđ'}}</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>Phí ship</th>
										<td colspan="2">Free</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>Thành tiền</th>
										<th colspan="2" class="total">{{Cart::total().' '.'vnđ'}}</th>
									</tr>
								</tfoot>
							</table>
							
						</div>

					</div>
				<!-- </form> -->
			</div>
@endsection