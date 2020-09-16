@extends('layout')
@section('content')
<div class="row">
	<form action="{{URL::to('/order-place')}}" method="POST">
		{{csrf_field()}}
				<!-- <form id="checkout-form" class="clearfix"> -->
					
					<div class="col-md-6">
						
							
						<div class="payments-methods">
							<div class="section-title">
								<h4 class="title">Phương thức thanh toán</h4>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payment_option" value="1" id="payments-1" >
								<label for="payments-1">Chuyển khoản</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										<p>
								</div>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payment_option" value="2" id="payments-2" checked>
								<label for="payments-2">COD (Trả tiền khi nhận hàng)</label>
								<div class="caption">
									<p>Đơn hàng trên 300.000đ: miễn phí giao hàng.</p>
									<p>Đơn hàng dưới 300.000đ: phụ thu 10.000đ phí giao hàng</p>

								</div>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payment_option" value="3" id="payments-2">
								<label for="payments-2">VISA/MasterCard</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										<p>
								</div>
							</div>
							<input type="submit" value="Mua hàng" name="send_order" class="primary-btn">
						
						<!-- <div class="billing-details">
							
							<div class="section-title">
								<h3 class="title">Thanh toán</h3>
							</div>
							<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
								{{csrf_field()}}
							<div class="form-group">
								<input class="input" type="text" name="shipping_name" placeholder="Họ tên">
							</div>
							
							<div class="form-group">
								<input class="input" type="email" name="shipping_email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="shipping_address" placeholder="Địa chỉ">
							</div>
														
							<div class="form-group">
								<input class="input" type="tel" name="shipping_phone" placeholder="Số điện thoại">
							</div>
							<div class="form-group">
								<p>Ghi chú đơn hàng</p>
								<textarea name="shipping_notes" placeholder="Ghi chú đơn hàng của bạn"	rows="10"></textarea>
							</div>
							<div class="form-group">
							<input type="submit" value="Gửi" name="send_order" class="primary-btn">
							</div>
							</form>
						</div> -->
					</div>

					<div class="col-md-6">
						
						
					</div>
					
					</div>

					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Xem lại giỏ hàng</h3>
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
											<ul>
												<li><span>Size: XL</span></li>
												<li><span>Color: Camelot</span></li>
											</ul>
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
							<div class="pull-right">
								<input type="submit" value="Mua hàng" name="send_order" class="primary-btn">
							</div>
						</div>

					</div>
				<!-- </form> -->
		</form>
			</div>
@endsection