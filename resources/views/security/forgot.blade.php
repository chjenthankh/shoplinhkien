<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Quên mật khẩu?</h2>
                  <p>Bạn có thể lấy lại mật khẩu tại đây.</p>
                  <div class="panel-body">
    
                    <form action="{{url('/forgot-password')}}" id="register-form" role="form" autocomplete="off" class="form" method="post">
    					{{csrf_field()}}
    					@if(session('error'))
    						<div>
    							{{session('error')}}
    						</div>
    					@endif
    					@if(session('success'))
    						<div>
    						{{session('success')}}
    						</div>
    					@endif
                      <div class="form-group">
                        <div class="input-group">

                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="customer_id" name="customer_email" placeholder="Địa chỉ mail" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Lấy lại mật khẩu" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>