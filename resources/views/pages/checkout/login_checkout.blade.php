@extends('layout')
@section('content')
	<div class="row">
				<!-- <form id="checkout-form" class="clearfix"> -->
					<div class="col-md-6">
						<div class="billing-details">
							
							<div class="section-title">
								<h3 class="title">Đăng nhập</h3>
							</div>
							<form role="form" method="post" action="{{ route('login') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="email">Email <span class="text-danger font-weight-bold">*</span></label>
							<input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required />
							@if ($errors->has('email'))
								<div class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="password">Mật khẩu <span class="text-danger font-weight-bold">*</span></label>
							<input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Mật khẩu" required />
							@if ($errors->has('password'))
								<div class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
								<label class="custom-control-label" for="remember">Duy trì đăng nhập</label>
							</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Đăng nhập</button> hoặc <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
					</form>
							
						</div>
					</div>

					<div class="col-md-6">
						<div class="shiping-methods">
							<div class="section-title">
								<h4 class="title">Đăng ký</h4>
							</div>
							<form method="POST" action="{{ route('register') }}">
								@csrf
		
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Họ Tên') }} <span class="text-danger font-weight-bold">*</span> </label> 
		
									<div class="col-md-6">
										<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Họ tên">
		
										@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
		
								<div class="form-group row">
									<label for="email1" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}<span class="text-danger font-weight-bold">*</span> </label> 
		
									<div class="col-md-6">
										<input id="email1" type="email" class="form-control @error('email1') is-invalid @enderror" name="email" value="{{ old('email1') }}" required autocomplete="email1" placeholder="Email">
		
										@error('email1')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Điện thoại') }}</label>
		
									<div class="col-md-6">
										<input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="Số điện thoại">
		
										@error('phone')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
							
								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu') }} <span class="text-danger font-weight-bold">*</span> </label>
		
									<div class="col-md-6">
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mật khẩu">
		
										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
		
								<div class="form-group row">
									<label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Xác nhận mật khẩu') }} <span class="text-danger font-weight-bold">*</span></label> 
		
									<div class="col-md-6">
										<input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Xác nhận mật khẩu">
									</div>
								</div>
		
								<div class="form-group row mb-0">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn btn-primary">
											{{ __('Đăng ký') }}
										</button>
									</div>
								</div>
							</form>
						</div>

						

					
				<!-- </form> -->
			</div>
			<!-- /row -->
		</div>

@endsection