@extends('layout')
@section('content')
<div class="row">
				<form id="checkout-form" class="clearfix">
					<div class="col-md-6">
						
					</div>

					<div class="col-md-6">
						

						
					</div>

					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Giỏ hàng của bạn</h3>
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
										<td colspan="2">
											
										{{Cart::tax().' '.'vnđ'}}</td>
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
								<!-- <a class="primary-btn" href="{{URL::to('/login-checkout')}}">abc</a> -->
								<?php
                    			$customer_id = Session::get('customer_id');
                    // $shipping_id = Session::get('shipping_id');
                   				 if(Auth::check()){ 
               					 ?>
                   					
                   					<a class="primary-btn" href="{{URL::to('/checkout')}}">Thanh toán</a>
                				<?php 
                 			   }else{
               					 ?>
                   					
                   					<a class="primary-btn" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
               					 <?php
                    				}
                				 ?>
							</div>
						</div>

					</div>
				</form>
			</div>
@endsection