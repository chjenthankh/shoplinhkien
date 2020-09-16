<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf_token" content="{ csrf_token() }" />
    <title>Cửa hàng linh kiện máy tính</title>
</head>
<body onload="window.print();">
<div id="page" class="page">
    <div class="header">
        <div class="logo"><img style="max-height:70px; max-width:155px" src="{{ asset('public/frontend/images/logo.png') }}"/></div>
        <div class="company">
        <h3>Cửa hàng linh kiện máy tính  </h3>
        <p>Địa chỉ: Long Xuyên, An Giang</p>
    </div>
    </div>
  <br/>
  <div class="title">
        <strong>HÓA ĐƠN BÁN HÀNG</strong>
        
        
  </div>
  <br/>
  <br/>
  <p><strong>Tên khách hàng: </strong>{{$order_details->shipping_name}}</p>
  <p><strong>Địa chỉ:</strong> {{$order_details->shipping_address}}</p>
  <p><strong>Điện thoại:</strong> {{$order_details->shipping_phone}}</p>
   @php $count=1; @endphp
  <table class="TableData">
    <tr>
      <th>STT</th>
      <th>Tên hàng hóa</th>
      <th>Đơn giá</th>
      <th>Số lượng</th>
      <th>Thành tiền</th>
    </tr>
	@foreach($order_products as $key=>$order)
	<tr>
		<td align="center">{{$count}}</td>
		<td align="left">{{$order->product_name}}</td>
		<td align="right">{{$order->product_price}}</td>
		 <td align="center">{{$order->product_sales_quantity}}</td>
		<td align="right">{{$order->product_price}}</td>
	</tr>
	@php $count++; @endphp
	@endforeach
    <tr>
      <td colspan="4" class="tong">Tổng cộng:</td>
      <td class="cotSo">{{$order_details->order_total}}</td>
    </tr>
    
  </table>
 
  <div class="footer-left"><div id="timercheck"></div> <br/>
    Khách hàng 
    <p style="font-style: italic; font-size: 10px">(Ký,ghi rõ họ, tên)</p>
	<br/>
	
	</div>

	<div class="footer-right"><br/>
		<br/>
		Người bán hàng
	<p style="font-style: italic; font-size: 10px">(Ký,đóng dấu,ghi rõ họ, tên)</p>
	</div>
</div>
<script type="text/javascript">
        var today = new Date();//khai báo biến thời gian.

       //lấy thời gian hiện tại
       var y = today.getFullYear();//lấy dữ liệu ra
      var m = today.getMonth()+1;
      var d = today.getDate();
      //in thời gian ra màn hình, lấy thời gian hiện tại
     document.getElementById('timercheck').innerHTML = 'Long Xuyên, Ngày '+d+' Tháng '+m+' Năm '+y;
</script>
		<style>
		body {
				margin: 0;
				padding: 0;
				background-color: #FAFAFA;
				font: 12pt "Tohoma";
			}
			* {
				box-sizing: border-box;
				-moz-box-sizing: border-box;
			}
			.page {
				width: 21cm;
				overflow:hidden;
				min-height:297mm;
				padding: 2.5cm;
				margin-left:auto;
				margin-right:auto;
				background: white;
				box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
			}
			.subpage {
				padding: 1cm;
				border: 5px red solid;
				height: 237mm;
				outline: 2cm #FFEAEA solid;
			}
			 @page {
			 size: A4;
			 margin: 0;
			}
			button {
				width:100px;
				height: 24px;
			}
			.header {
				overflow:hidden;
			}
			.logo {
				background-color:#FFFFFF;
				text-align:left;
				float:left;

			}
			.company {
				padding-top:24px;
				font-size: 
				text-transform:uppercase;
				background-color:#FFFFFF;
				text-align: center;
				float: right;
				font-size:16px;
			}
			.title {
				text-align:center;
				position:relative;
				color:#F8694A;
				font-size: 24px;
				top:1px;
			}
			.footer-left {
				text-align:center;
				text-transform:uppercase;
				padding-top:24px;
				position:relative;
				height: 150px;
				width:50%;
				color:#000;
				float:left;
				font-size: 12px;
				bottom:1px;
			}
			.footer-right {
				text-align:center;
				text-transform:uppercase;
				padding-top:24px;
				position:relative;
				height: 150px;
				width:50%;
				color:#000;
				font-size: 12px;
				float:right;
				bottom:1px;
			}
			.TableData {
				background:#ffffff;
				font: 11px;
				width:100%;
				border-collapse:collapse;
				font-family:Verdana, Arial, Helvetica, sans-serif;
				font-size:12px;
				border:thin solid #d3d3d3;
			}
			.TableData TH {
				background: white;
				text-align: center;
				font-weight: bold;
				color: #000;
				border: solid 1px #ccc;
				height: 24px;
			}
			.TableData TR {
				height: 24px;
				border:thin solid #d3d3d3;
			}
			.TableData TR TD {
				padding-right: 2px;
				padding-left: 2px;
				border:thin solid #d3d3d3;
			}
			.TableData TR:hover {
				background: rgba(0,0,0,0.05);
			}
			.TableData .cotSTT {
				text-align:center;
				width: 10%;
			}
			.TableData .cotTenSanPham {
				text-align:left;
				width: 40%;
			}
			.TableData .cotHangSanXuat {
				text-align:left;
				width: 20%;
			}
			.TableData .cotGia {
				text-align:right;
				width: 120px;
			}
			.TableData .cotSoLuong {
				text-align: center;
				width: 50px;
			}
			.TableData .cotSo {
				text-align: right;
				width: 120px;
			}
			.TableData .tong {
				text-align: right;
				font-weight:bold;
				text-transform:uppercase;
				padding-right: 4px;
			}
			.TableData .cotSoLuong input {
				text-align: center;
			}
			@media print {
			 @page {
			 margin: 0;
			 border: initial;
			 border-radius: initial;
			 width: initial;
			 min-height: initial;
			 box-shadow: initial;
			 background: initial;
			 page-break-after: always;
			}
			}
		</style>
</body>
</html>
