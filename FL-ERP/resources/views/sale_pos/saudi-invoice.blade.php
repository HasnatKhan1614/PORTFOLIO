<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <title>Receipt-{{$receipt_details->invoice_no}}</title>

  </head>
  <body>
  <div class="page">
  <div class="main1">
  <main>
<div class="container">
<div class="row row-cols-1">
     <!--invoice logo information	-->
 <div class="col " ><!-- Logo -->
		@if(!empty($receipt_details->logo))
			<img style="height: 80px; width: 20cm;" src="{{$receipt_details->logo}}" class="img center-block">
		@endif

 </div>



<div class="row row-cols-1">
     <!--invoice heading information	-->
 <div class="col  small text-center" >@if(!empty($receipt_details->invoice_heading))
						{{-- {!! $receipt_details->invoice_heading !!}--}}
						{!! $receipt_details->invoice_heading !!}

					@endif</div>

 </div>
 <div class ="row row-cols-2">
 
     <!--Bank information	-->
<div class="col "> 
<table class=" table-bordered border-start  small " style="width : 100%" >
<thead>
<tr ><td  style="width :25%;">Bank Name</td>
<td class="text-center" style="width :40%;">@if(!empty($receipt_details->sub_heading_line1))
					{{ $receipt_details->sub_heading_line1 }}
				@endif</td>
<td class="text-end" style="width :35%;">اسم البنك</td></tr>

</thead>
<tbody>
<tr>
<td>CITY</td>
<td class="text-center">@if(!empty($receipt_details->sub_heading_line2))
				{{ $receipt_details->sub_heading_line2 }}
				@endif</td>
<td class="text-end">مدينة</td>
</tr>
<tr>
<td>COMPANY NAME</td>
<td class="text-center">@if(!empty($receipt_details->sub_heading_line3))
					{{ $receipt_details->sub_heading_line3 }}
				@endif</td>
<td class="text-end">اسم الشركة</td>


</tr>
<tr>
<td>Account NO.</td>
<td class="text-center">@if(!empty($receipt_details->sub_heading_line4))
					{{ $receipt_details->sub_heading_line4 }}
				@endif</td>
<td class="text-end">رقم الحساب</td>

</tr>
<tr>

<td>IBAN</td>
<td class="text-center">@if(!empty($receipt_details->sub_heading_line5))
					{{ $receipt_details->sub_heading_line5 }}
				@endif	</td>
<td class="text-end">ايبان</td>

</tr>

</tbody>

</table>

</div>
    <!--Bank information close	-->
  

  <!--Qrcode information	-->

 <!-- qrcode -->
		@if (isset($receipt_details->is_connected) &&
                                $receipt_details->is_connected &&
                                $receipt_details->show_qr_code &&
                                !empty($receipt_details->qr_code_text))
                                {!! $receipt_details->qr_code_text !!}
                                @elseif($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
						<img  style="max-height: 80px; width: auto; margin-left:80px; " src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
					@endif
 
 
 
  <!--proejct information	-->
 </div>
 <div class="row row-cols-2">
 <div class="col border small" > @if(!empty($receipt_details->sell_custom_field_1_value))
				
					{{ $receipt_details->sell_custom_field_1_label }}: {!!$receipt_details->sell_custom_field_1_value ?? ''!!}
				@endif</div>
 <div class="col border small text-end ">اسم المشروع</div>
 </div>

  <!--invoice info information	-->
 
<div class="row row-cols-1 ">
 
 <table class="table-bordered table-sm small">
 <tbody>
 <tr>
 <td style="width :40%;">	@if(!empty($receipt_details->invoice_no_prefix))
				{!! $receipt_details->invoice_no_prefix !!}
			@endif</td>
  <td class="text-center" style="width :20%;">{{$receipt_details->invoice_no}}</td>
   <td class="text-end" style="width :40%;">رقم الفاتورة</td>
    
 </tr>
 
  <tr>
 <td style="width :40%;">@if(!empty($receipt_details->date_label))
		
			
					{{$receipt_details->date_label}}
					@endif
				</td>
  <td class="text-center" style="width :20%;">
				{{$receipt_details->invoice_date}}
			</div>
		</td>
   <td class="text-end" style="width :40%;"> التاريخ</td>
    
 </tr>
 
  <tr>
 <td style="width :40%;">Invoice Type</td>
  <td class="text-center" style="width :20%;">Sales</td>
   <td class="text-end" style="width :40%;">نوع الفاتورة</td>
    
 </tr>

 <tbody>

 </table>

 </div>
  <!-- Seller and buyer info info information	-->

<div class="row row-cols-4"style="background: #d3cecd; font-weight: bold;">
<div class="col border">Seller</div>
<div class="col border  text-end  ">تفاصيل البائع</div>
<div class="col border text-center  ">Buyer</div>
<div class="col border text-end">تفاصيل المشتري </div>

</div>
<!-- Seller and buyer info info information	-->
<div class= "row row-cols-1 ">

<table class="table-bordered border border-dark small border-end  "  >
<tbody>
<tr>
<td>Name</td>
<td>@if(!empty($receipt_details->display_name))
						{{$receipt_details->display_name}}
					@endif
				</td>

<td class="text-end">اسم</td>
<!-- purchase information	-->

<td>	@if(!empty($receipt_details->customer_label))
				{{ $receipt_details->customer_label }}
			@endif
</td>
<td>	<!-- customer info -->
			@if(!empty($receipt_details->customer_name))
				{!! $receipt_details->customer_name !!}
			@endif
			@if(!empty($receipt_details->client_id_label))
			
				{ $receipt_details->client_id_label }} {{ $receipt_details->client_id }}
			@endif</td>

<td class="text-end">اسم</td>
</tr>


<tr>
<td>building No.</td>
<td>@if(!empty($receipt_details->location_custom_fields1))
						{{$receipt_details->location_custom_fields1}}
					@endif</td>

<td class="text-end">رقم المبنى</td>
<!-- purchase information	-->

<td>building No.</td>
<td>@if(!empty($receipt_details->customer_address2))
				{!! $receipt_details->customer_address2!!}
			@endif</td>

<td class="text-end">رقم المبنى</td>

</tr>

<tr>
<td>Street Name</td>
<td>@if(!empty($receipt_details->landmark))
						{{$receipt_details->landmark}}
					@endif</td>

<td class="text-end">شارع</td>
<!-- purchase information	-->

<td>Street Name</td>
<td>	@if(!empty($receipt_details->customer_address1))
				{!! $receipt_details->customer_address1!!}
			@endif
			
			
			</td>

<td class="text-end">شارع</td>

</tr>
<tr>
<td>District.</td>
<td>@if(!empty($receipt_details->state))
						{{$receipt_details->state}}
					@endif</td>

<td class="text-end">حي</td>
<!-- purchase information	-->
<td>District.</td>
<td>	@if(!empty($receipt_details->customer_state))
				{!! $receipt_details->customer_state!!}
			@endif
			</td>

<td class="text-end">حي</td>

</tr>
<tr>
<td>City.</td>
<td>@if(!empty($receipt_details->city))
						{{$receipt_details->city}}
					@endif</td>

<td class="text-end">مدينة</td>

<!-- purchase information	-->
<td>City.</td>
<td>	@if(!empty($receipt_details->customer_city))
				{!! $receipt_details->customer_city!!}
			@endif
			</td>

<td class="text-end">مدينة</td>


</tr>
<tr>
<td>Postal Code.</td>
<td>@if(!empty($receipt_details->zip))
						{{$receipt_details->zip}}
					@endif</td>

<td class="text-end">رمز بريدي</td>
<!-- purchase information	-->
<td>Postal Code.</td>
<td>	@if(!empty($receipt_details->customer_zip))
				{!! $receipt_details->customer_zip!!}
			@endif
			</td>

<td class="text-end">رمز بريدي</td>


</tr>
<tr>
<td>Vat Number.</td>
<td>{{ $receipt_details->tax_info1 }}</td>

<td class="text-end">رقم ضريبة</td>
<!-- purchase information	-->
<td>@if(!empty($receipt_details->customer_tax_label))
				{{ $receipt_details->customer_tax_label }} 
			@endif</td>
<td>{{ $receipt_details->customer_tax_number }}</td>

<td class="text-end">رقم ضريبة</td>
</tr>
<tr>
<td>Country.</td>
<td>@if(!empty($receipt_details->country))
						{{$receipt_details->country}}
					@endif</td>

<td class="text-end">دولة </td>
<!-- purchase information	-->
<td>Country.</td>
<td>	@if(!empty($receipt_details->customer_country))
				{!! $receipt_details->customer_country !!}
			@endif
			</td>

<td class="text-end">دولة </td>

</tr>
<tr>
<td>CR No.</td>
<td>@if(!empty($receipt_details->website))
						{{$receipt_details->website}}
					@endif</td>

<td class="text-end"> رقم تجاري</td>
<!-- purchase information	-->

<td>CR No.</td>
<td>@if(!empty($receipt_details->location_custom_fields))
				{{ $receipt_details->location_custom_fields }}
				@endif</td>

<td class="text-end"> رقم تجاري</td>

</tr>


<tbody>
</table >


</div>



 </div>



</div>
<!-- sales invoice Start products sections 	-->
<div class="row" style="color: #000000 !important;">
	<div class="col-xs-12">
		<br/>
		@php
			$p_width = 45;
		@endphp
		@if(!empty($receipt_details->item_discount_label))
			@php
				$p_width -= 10;
			@endphp
		@endif
		@if(!empty($receipt_details->discounted_unit_price_label))
			@php
				$p_width -= 10;
			@endphp
		@endif
		<table class="table-bordered table-responsive table-slim">
			<thead>
				<tr>
					<th class="text-center" width="{{$p_width}}%">{{$receipt_details->table_product_label}}</th>
					<th class="text-right" width="15%">{{$receipt_details->table_qty_label}}</th>
					<th class="text-right" width="15%">{{$receipt_details->table_unit_price_label}}</th>
					@if(!empty($receipt_details->discounted_unit_price_label))
						<th class="text-right" width="10%">{{$receipt_details->discounted_unit_price_label}}</th>
					@endif
					@if(!empty($receipt_details->item_discount_label))
						<th class="text-right" width="10%">{{$receipt_details->item_discount_label}}</th>
					@endif
					<th class="text-right" width="15%">{{$receipt_details->table_subtotal_label}}</th>
				</tr>
			</thead>
			<tbody>
				@forelse($receipt_details->lines as $line)
					<tr>
						<td>
							@if(!empty($line['image']))
								<img src="{{$line['image']}}" alt="Image" width="50" style="float: left; margin-right: 8px;">
							@endif
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                            @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
                            @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
                            @if(!empty($line['product_description']))
                            	<small>
                            		{!!$line['product_description']!!}
                            	</small>
                            @endif 
                            @if(!empty($line['sell_line_note']))
                            <br>
                            <small>
                            	{!!$line['sell_line_note']!!}
                            </small>
                            @endif 
                            @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
                            @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif

                            @if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
                            @if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] ?? ''}}</small>@endif

                            @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            <br><small>
                            	1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br>
                            	{{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
                            </small>
                            @endif
                        </td>
						<td class="text-right">
							{{$line['quantity']}} {{$line['units']}} 

							@if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            <br><small>
                            	{{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}}
                            </small>
                            @endif
						</td>
						<td class="text-right">{{$line['unit_price_before_discount']}}</td>
						@if(!empty($receipt_details->discounted_unit_price_label))
							<td class="text-right">
								{{$line['unit_price_inc_tax']}} 
							</td>
						@endif
						@if(!empty($receipt_details->item_discount_label))
							<td class="text-right">
								{{$line['total_line_discount'] ?? '0.00'}}

								@if(!empty($line['line_discount_percent']))
								 	({{$line['line_discount_percent']}}%)
								@endif
							</td>
						@endif
						<td class="text-right">{{$line['line_total']}}</td>
					</tr>
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
							<tr>
								<td>
		                            {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
		                            @if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif 
		                        </td>
								<td class="text-right">{{$modifier['quantity']}} {{$modifier['units']}} </td>
								<td class="text-right">{{$modifier['unit_price_inc_tax']}}</td>
								@if(!empty($receipt_details->discounted_unit_price_label))
									<td class="text-right">{{$modifier['unit_price_exc_tax']}}</td>
								@endif
								@if(!empty($receipt_details->item_discount_label))
									<td class="text-right">0.00</td>
								@endif
								<td class="text-right">{{$modifier['line_total']}}</td>
							</tr>
						@endforeach
					@endif
				@empty
					<tr>
						<td colspan="4">&nbsp;</td>
						@if(!empty($receipt_details->discounted_unit_price_label))
    					<td></td>
    					@endif
    					@if(!empty($receipt_details->item_discount_label))
    					<td></td>
    					@endif
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
	</div><!-- sales invoice end products sections 	-->
 
<div class="row row-cols-1" ><!-- sales invoice Total Area 	-->
<div class="row row-cols-2 "  >
<div class="col border text-enter ">Total Amount
</div>
<div class="col border text-end">إجمالي المبالغ</div>
</div>
<div class="row row-cols-1 "><!-- sales invoice Total Details 	-->
 
 <table class="table-bordered table-sm small mx-2">
 <tbody>
 <tr>
 <td style="width :40%;">Total (Excluding VAT)in SAR</td>
  <td class="text-center" style="width :20%;">{{$receipt_details->subtotal}}</td>
   <td class="text-end" style="width :40%;">الإجمالي (باستثناء ضريبة القيمة المضافة) بالريال السعودي</td>
    
 </tr>
 
  <tr>
 <td style="width :40%;">Total VAT 15 % in SAR
				</td>
  <td class="text-center" style="width :20%;">
				(+) {{$receipt_details->tax}}
			</div>
		</td>
   <td class="text-end" style="width :40%;"> إجمالي ضريبة القيمة المضافة 15% بالريال السعودي</td>
    
 </tr>
 
  <tr>
 <td style="width :40%;">Total Amount (Including VAT)in SAR</td>
  <td class="text-center" style="width :20%;">{{$receipt_details->total}}</td>
   <td class="text-end" style="width :40%;">المبلغ الإجمالي (شامل ضريبة القيمة المضافة) بالريال السعودي</td>
    
 </tr>

 <tbody>

 </table>
 

 </div><!-- sales invoice Total Details end div 	-->
<div class="row row-col-5 border">
<div class="col border">
Amount in Words
</div>
<div class="col border">
{{$receipt_details->total_in_words}}
</div>
<div class="col border">
Addditional Note
</div>
<div class="col">
	@if(!empty($receipt_details->additional_notes))
	 
	    {!! nl2br($receipt_details->additional_notes) !!}
	  
    @endif</div>
</div>

 <div class="border-bottom col-md-12">
	    @if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label) )
	        <!-- tax -->
	        @if(!empty($receipt_details->taxes))
	        	<table class="table table-slim table-bordered">
	        		<tr>
	        			<th colspan="2" class="text-center">{{$receipt_details->tax_summary_label}}</th>
	        		</tr>
	        		@foreach($receipt_details->taxes as $key => $val)
	        			<tr>
	        				<td class="text-center"><b>{{$key}}</b></td>
	        				<td class="text-center">{{$val}}</td>
	        			</tr>
	        		@endforeach
	        	</table>
	        @endif
	    @endif
	</div>
 
 
   
 
 

</div><!--containner end	-->

</div></main>
<br><!--main end	-->
<div class="footer">
		<hr class="new5">
@if(!empty($receipt_details->footer_text))
		
			{!! $receipt_details->footer_text !!}
	
		@endif
</div>
			
			
			</div>
			</footer>
</div> <!-- page size info	-->
  </body>
</html>
	<style type="text/css">
	body {
		color: #000000;
		 margin:0;
		padding:0;
		
		
	}
hr.new5 {
  border: 4px solid #357ca5;
  border-radius: 4px;
   margin-top: 0px;

}


.page {
  width: 21cm;
  min-height: 29.7cm;
 
  margin: 1cm auto;
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  font-size: 0.700em;
}



@page {
  size: A4;
  margin: 0;
}

@media print {
  .page {
    margin: 5px;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;

 
  }
 main{
  
  width: 20.5cm;
  min-height: 26.7cm;
 
 
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
 
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }
  footer{
  width: 20.5cm;
 height:2.5cm;
	margin-top:-10px;
	margin-left:5px;
  border: 1px #D3D3D3 solid;
  

  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  
  
  }
  
  table {
  width: 100%;
}

	</style>