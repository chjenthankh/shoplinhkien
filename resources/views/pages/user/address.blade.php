@extends('layout')
@section('content')
<div class="container">
    <div class="row">
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
        <div id="store">
            <h3>Địa chỉ </h3>
            <div class="col-md-4">
            <div class="store-filter clearfix">
                <div class="pull-right">
                        @if(empty($customer))
                            <button type="button" class="btn btn-primary fa fa-plus " data-toggle="modal" data-target="#myModal">Thêm địa chỉ </button>
                        @else
                        @foreach($customer as $custom)
                            <div class="form-group">
                                <label style="font-size: 18;color:blue">Địa chỉ: </label>
                                <label style="font-size: 16;"> {{$custom->Address}} {{$custom->Ward}} 
                                    {{$custom->District}} {{$custom->Province}}</label>
                                <a href="#sua" data-toggle="modal" data-target="#myModalEdit" onclick="getCapNhat({{$custom->id}},'{{$custom->Province}}','{{$custom->District}}','{{$custom->Ward}}','{{$custom->Address}}')"class="active styling-edit" ui-toggle-class="">
                                        <i style="font-size:20px" class="fa fa-pencil-square-o text-success text-active"></i></a>
                                <a onclick="return confirm('Bạn có chắc muốn xóa không ?')" href="{{url('/xoa-dia-chi/'.$custom->id)}}" class="active styling-edit" ui-toggle-class="">
                                        <i style="font-size:20px" class="fa fa-trash text-danger text"></i></a>
                            </div>
                            @endforeach
                            <button type="button" class="btn btn-primary fa fa-plus " data-toggle="modal" data-target="#myModal">Thêm địa chỉ </button>
                        @endif
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<form action="{{ url('/them-dia-chi') }}" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Thêm địa chỉ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Province">Tỉnh/Thành phố <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control{{ $errors->has('Province') ? ' is-invalid' : '' }}" id="Province" name="Province" value="{{ old('Province') }}" placeholder="Tỉnh/Thành phố" required />
                        <label for="District">Quận huyện <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control{{ $errors->has('District') ? ' is-invalid' : '' }}" id="District" name="District" value="{{ old('District') }}" placeholder="Quận huyện" required />
                        <label for="Ward">Phường xã <span class="text-danger font-weight-bold">*</span> </label>
                        <input type="text" class="form-control{{ $errors->has('Ward') ? ' is-invalid' : '' }}" id="Ward" name="Ward" value="{{ old('Ward') }}" placeholder="Phường xã" required />
                        <label for="Address">Địa chỉ <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control{{ $errors->has('Address') ? ' is-invalid' : '' }}" id="Address" name="Address" value="{{ old('Address') }}" placeholder="Địa chỉ" required />
                        @if($errors->has('Province'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('Province') }}</strong></div>
                        @elseif($errors->has('District'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('District') }}</strong></div>
                        @elseif($errors->has('Ward'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('Ward') }}</strong></div>
                        @elseif($errors->has('Address'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('Address') }}</strong></div>
                        @endif
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Thực hiện</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{ url('/sua-dia-chi') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" id="ID_edit" name="ID_edit" value="" />
    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Sửa địa chỉ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Province_edit">Tỉnh/Thành phố <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control{{ $errors->has('Province_edit') ? ' is-invalid' : '' }}" id="Province_edit" name="Province_edit" value="{{ old('Province_edit') }}" placeholder="Tỉnh/Thành phố" required />
                        <label for="District_edit">Quận huyện <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control{{ $errors->has('District_edit') ? ' is-invalid' : '' }}" id="District_edit" name="District_edit" value="{{ old('District_edit') }}" placeholder="Quận huyện" required />
                        <label for="Ward_edit">Phường xã <span class="text-danger font-weight-bold">*</span> </label>
                        <input type="text" class="form-control{{ $errors->has('Ward_edit') ? ' is-invalid' : '' }}" id="Ward_edit" name="Ward_edit" value="{{ old('Ward_edit') }}" placeholder="Phường xã" required />
                        <label for="Address_edit">Địa chỉ <span class="text-danger font-weight-bold">*</span></label>
                        <input type="text" class="form-control{{ $errors->has('Address') ? ' is-invalid' : '' }}" id="Address_edit" name="Address_edit" value="{{ old('Address_edit') }}" placeholder="Địa chỉ" required />
                        @if($errors->has('Province'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('Province_edit') }}</strong></div>
                        @elseif($errors->has('District'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('District_edit') }}</strong></div>
                        @elseif($errors->has('Ward'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('Ward_edit') }}</strong></div>
                        @elseif($errors->has('Address'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('Address_edit') }}</strong></div>
                        @endif
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Thực hiện</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

<script type="text/javascript">
    function getCapNhat(id, Province, District, Ward, Address) {
        $('#ID_edit').val(id);
        $('#Province_edit').val(Province);
        $('#District_edit').val(District);
        $('#Ward_edit').val(Ward);
        $('#Address_edit').val(Address);
    }
    
    @if($errors->has('Province') || $errors->has('District') || $errors->has('Ward') || $errors->has('Address'))
        $('#myModal').modal('show');
    @endif
    @if($errors->has('Province_edit') || $errors->has('District_edit') || $errors->has('Ward_edit') || $errors->has('Address_edit'))
        $('#myModalEdit').modal('show');
    @endif
</script>