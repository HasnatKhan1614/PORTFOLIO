

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

    @media print {
      
        tr, td {
            page-break-inside: auto !important; /* Let rows break naturally */
            page-break-after: auto;
            page-break-before: auto;
        }
    }
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0 !important;
            padding: 0 !important;
            color: #000000;

        }
    
        @page {
            size: A4;
            margin: 5; /* Remove all browser margins */
        }
    
        .container,
        .row,
        .col,
        .col-12 {
            margin: 0 !important;
            padding: 0 !important;
        }
    
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000 !important;
        }
    
        @media print {
            @page {
                margin: 5; /* No margin in print */
            }
    
            body {
                margin: 5 !important;
                padding: 0 !important;
            }
    
            .print-footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: white;
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>
    
</head>

<body>
    
    <div class="container-fluid p-0 m-0">
        <!-- Company Header -->
        <div class="row">
            <div class="col-6">
                @if (!empty($receipt_details->logo))
                    <img style="max-height: 120px; width: auto;" src="{{ $receipt_details->logo }}"
                        class="img img-responsive center-block">
                @endif

                <!-- Header text -->
                @if (!empty($receipt_details->header_text))
                    <div class="col-xs-12">
                        {!! $receipt_details->header_text !!}
                    </div>
                @endif
                <h4 class="fw-bold">
                    @if (!empty($receipt_details->display_name))
                        {{ $receipt_details->display_name }}
                    @endif
                </h4>
                @if (!empty($receipt_details->address))
                    {!! $receipt_details->address !!}<br>
                @endif
                @if (!empty($receipt_details->contact))
                    {!! $receipt_details->contact !!}<br>
                @endif
                @if (!empty($receipt_details->website))
                    {{ $receipt_details->website }}<br>
                @endif
                @if (!empty($receipt_details->location_custom_fields))
                    {{ $receipt_details->location_custom_fields }}<br>
                @endif

                @if (!empty($receipt_details->tax_info1))
                    <b>{{ $receipt_details->tax_label1 }}</b> {{ $receipt_details->tax_info1 }}<br>
                @endif

                @if (!empty($receipt_details->tax_info2))
                    <b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}<br>
                @endif
            </div>
            <div class="col-6 text-end" dir="rtl">
                <div class="col-6 text-end" dir="rtl">
                    @if (!empty($receipt_details->sub_heading_line1))
                        <h4>{{ $receipt_details->sub_heading_line1 }}</h4><br>
                    @endif
                    @if (!empty($receipt_details->sub_heading_line2))
                        {{ $receipt_details->sub_heading_line2 }}<br>
                    @endif
                    @if (!empty($receipt_details->sub_heading_line3))
                        {{ $receipt_details->sub_heading_line3 }}<br>
                    @endif
                    @if (!empty($receipt_details->sub_heading_line4))
                        {{ $receipt_details->sub_heading_line4 }}<br>
                    @endif
                    @if (!empty($receipt_details->sub_heading_line5))
                        {{ $receipt_details->sub_heading_line5 }}<br>
                    @endif
                </div>
            </div>
        </div>
        <hr style="border-top: 2px solid black;color:#000;">


        <!-- Invoice Title and Page -->
        <div class="row">
            <div class="col-12">
                <div class="text-center p-2 mb-2">
                    <h5 style="display: inline-block; border: 1px solid black; padding: 5px 10px; font-weight: bold;">
                        Tax Invoice <span dir="rtl">فاتورة ضريبية</span>
                    </h5>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-2">
            <div>
                @if (!empty($receipt_details->invoice_no_prefix))
                    <b>{!! $receipt_details->invoice_no_prefix !!}</b>
                @endif
                {{ $receipt_details->invoice_no }}
                <b dir="rtl">رقم الفاتورة</b>
            </div>
            <div class="text-end">
                <strong>Date / Time:</strong> {{ $receipt_details->invoice_date }}
                <b dir="rtl">التاريخ / الوقت</b>
            </div>
        </div>


        <!-- Billing Details Block -->
        <div>
            <div class="row g-3">
                <!-- Left Column (col-8) -->
                <div class="col-8 border p-3 my-3">
                    @if (!empty($receipt_details->types_of_service))
                        <strong>{!! $receipt_details->types_of_service_label !!}:</strong> {{ $receipt_details->types_of_service }}<br>
                        <span dir="rtl">{{ $receipt_details->types_of_service_label }}:
                            {{ $receipt_details->types_of_service }}</span><br>
                        @if (!empty($receipt_details->types_of_service_custom_fields))
                            @foreach ($receipt_details->types_of_service_custom_fields as $key => $value)
                                <strong>{{ $key }}:</strong> {{ $value }}<br>
                                <span dir="rtl">{{ $key }}: {{ $value }}</span><br>
                            @endforeach
                        @endif
                    @endif

                    @if (!empty($receipt_details->table_label) || !empty($receipt_details->table))
                        @if (!empty($receipt_details->table_label))
                            <b>{!! $receipt_details->table_label !!}</b>
                        @endif
                        {{ $receipt_details->table }}<br>
                        <span dir="rtl">{!! $receipt_details->table_label ?? '' !!} {{ $receipt_details->table }}</span><br>
                    @endif

                    @if (!empty($receipt_details->customer_info))
                        <span dir="rtl"><b>{{ $receipt_details->customer_label }}:</b> {!! $receipt_details->customer_info !!}
                            <strong>اسم العميل</strong></span><br>
                    @endif



                    @if (!empty($receipt_details->customer_mobile))
                        <span dir="rtl"><b>{{ $receipt_details->customer_mobile }}</b></span>
                    @endif

                    @if (!empty($receipt_details->client_id_label))
                        <b>{{ $receipt_details->client_id_label }}</b> {{ $receipt_details->client_id }}<br>
                        <span dir="rtl"><b>{{ $receipt_details->client_id_label }}</b>
                            {{ $receipt_details->client_id }}</span><br>
                    @endif

                    @if (!empty($receipt_details->customer_tax_label))
                        <b>{{ $receipt_details->customer_tax_label }}</b>
                        {{ $receipt_details->customer_tax_number }}<br>
                        <span dir="rtl"><b>{{ $receipt_details->customer_tax_label }}</b>
                            {{ $receipt_details->customer_tax_number }}</span><br>
                    @endif

                    @if (!empty($receipt_details->customer_custom_fields))
                        {!! $receipt_details->customer_custom_fields !!}<br>
                        <span dir="rtl">{!! $receipt_details->customer_custom_fields !!}</span><br>
                    @endif

                    @if (!empty($receipt_details->sales_person_label))
                        <b>{{ $receipt_details->sales_person_label }}</b> {{ $receipt_details->sales_person }}<br>
                        <span dir="rtl"><b>{{ $receipt_details->sales_person_label }}</b>
                            {{ $receipt_details->sales_person }}</span><br>
                    @endif

                    @if (!empty($receipt_details->commission_agent_label))
                        <strong>{{ $receipt_details->commission_agent_label }}</strong>
                        {{ $receipt_details->commission_agent }}<br>
                        <span dir="rtl"><strong>{{ $receipt_details->commission_agent_label }}</strong>
                            {{ $receipt_details->commission_agent }}</span><br>
                    @endif

                    @if (!empty($receipt_details->customer_rp_label))
                        <strong>{{ $receipt_details->customer_rp_label }}</strong>
                        {{ $receipt_details->customer_total_rp }}<br>
                        <span dir="rtl"><strong>{{ $receipt_details->customer_rp_label }}</strong>
                            {{ $receipt_details->customer_total_rp }}</span><br>
                    @endif
                </div>

                <!-- Right Column (col-4) -->
                <div class="col-4 text-end border p-3 my-3">

                    @if (!empty($receipt_details->payments))
                    @foreach ($receipt_details->payments as $payment)
                        <div class="d-flex justify-content-between" dir="rtl">
                            <span><b>نوع الدفع</b></span>
                            <span>{{ $payment['amount'] }}</span>
                            <span><b>Pay Type</b></span>
                        </div>
                    @endforeach
                @endif
                

                    @if (!empty($receipt_details->due_date_label))
                        <strong>{{ $receipt_details->due_date_label }}</strong>
                        {{ $receipt_details->due_date ?? '' }}<br>
                        <span dir="rtl"><strong>{{ $receipt_details->due_date_label }}</strong>
                            {{ $receipt_details->due_date ?? '' }}</span><br>
                    @endif

                    @if (!empty($receipt_details->brand_label))
                        <strong>{!! $receipt_details->brand_label !!}</strong> {{ $receipt_details->repair_brand }}<br>
                        <span dir="rtl">{!! $receipt_details->brand_label !!} {{ $receipt_details->repair_brand }}</span><br>
                    @endif

                    @if (!empty($receipt_details->device_label))
                        <strong>{!! $receipt_details->device_label !!}</strong> {{ $receipt_details->repair_device }}<br>
                        <span dir="rtl">{!! $receipt_details->device_label !!} {{ $receipt_details->repair_device }}</span><br>
                    @endif

                    @if (!empty($receipt_details->model_no_label))
                        <strong>{!! $receipt_details->model_no_label !!}</strong> {{ $receipt_details->repair_model_no }}<br>
                        <span dir="rtl">{!! $receipt_details->model_no_label !!}
                            {{ $receipt_details->repair_model_no }}</span><br>
                    @endif

                    @if (!empty($receipt_details->serial_no_label))
                        <strong>{!! $receipt_details->serial_no_label !!}</strong> {{ $receipt_details->repair_serial_no }}<br>
                        <span dir="rtl">{!! $receipt_details->serial_no_label !!}
                            {{ $receipt_details->repair_serial_no }}</span><br>
                    @endif

                    @if (!empty($receipt_details->repair_status_label))
                        <strong>{!! $receipt_details->repair_status_label !!}</strong> {{ $receipt_details->repair_status }}<br>
                        <span dir="rtl">{!! $receipt_details->repair_status_label !!} {{ $receipt_details->repair_status }}</span><br>
                    @endif

                    @if (!empty($receipt_details->repair_warranty_label))
                        <strong>{!! $receipt_details->repair_warranty_label !!}</strong> {{ $receipt_details->repair_warranty }}<br>
                        <span dir="rtl">{!! $receipt_details->repair_warranty_label !!}
                            {{ $receipt_details->repair_warranty }}</span><br>
                    @endif

                    @if (!empty($receipt_details->service_staff_label))
                        <strong>{!! $receipt_details->service_staff_label !!}</strong> {{ $receipt_details->service_staff }}<br>
                        <span dir="rtl">{!! $receipt_details->service_staff_label !!} {{ $receipt_details->service_staff }}</span><br>
                    @endif

                    {{-- Shipping Custom Fields --}}
                    @for ($i = 1; $i <= 5; $i++)
                        @php
                            $label = 'shipping_custom_field_' . $i . '_label';
                            $value = 'shipping_custom_field_' . $i . '_value';
                        @endphp
                        @if (!empty($receipt_details->$label))
                            <strong>{!! $receipt_details->$label !!}:</strong> {!! $receipt_details->$value ?? '' !!}<br>
                            <span dir="rtl"><strong>{!! $receipt_details->$label !!}:</strong>
                                {!! $receipt_details->$value ?? '' !!}</span><br>
                        @endif
                    @endfor

                    {{-- Sale Orders --}}
                    @if (!empty($receipt_details->sale_orders_invoice_no))
                        <strong>@lang('restaurant.order_no'):</strong> {!! $receipt_details->sale_orders_invoice_no !!}<br>
                        <span dir="rtl">@lang('restaurant.order_no'): {!! $receipt_details->sale_orders_invoice_no !!}</span><br>
                    @endif

                    @if (!empty($receipt_details->sale_orders_invoice_date))
                        <strong>@lang('lang_v1.order_dates'):</strong> {!! $receipt_details->sale_orders_invoice_date !!}<br>
                        <span dir="rtl">@lang('lang_v1.order_dates'): {!! $receipt_details->sale_orders_invoice_date !!}</span><br>
                    @endif

                    {{-- Sell Custom Fields --}}
                    @for ($i = 1; $i <= 4; $i++)
                        @php
                            $label = 'sell_custom_field_' . $i . '_label';
                            $value = 'sell_custom_field_' . $i . '_value';
                        @endphp
                        @if (!empty($receipt_details->$value))
                            <strong>{{ $receipt_details->$label }}:</strong> {!! $receipt_details->$value !!}<br>
                            <span dir="rtl"><strong>{{ $receipt_details->$label }}:</strong>
                                {!! $receipt_details->$value !!}</span><br>
                        @endif
                    @endfor
                </div>
            </div>
        </div>



        @php
            $p_width = 45;
        @endphp
        @if (!empty($receipt_details->item_discount_label))
            @php
                $p_width -= 10;
            @endphp
        @endif
        @if (!empty($receipt_details->discounted_unit_price_label))
            @php
                $p_width -= 10;
            @endphp
        @endif

        <!-- Product Table -->
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <td>#</td>

                    @php
                        $p_width = 20;
                    @endphp
                    @if ($receipt_details->show_cat_code != 1)
                        @php
                            $p_width = 30;
                        @endphp
                    @endif
                    <td width="{{ $p_width }}%">
                        الوصف <br> {{ $receipt_details->table_product_label }}  
                    </td>

                    @if ($receipt_details->show_cat_code == 1)
                        <td class="text-right" width="15%">
                            {{ $receipt_details->cat_code_label }}</td>
                    @endif

                    <td class="text-right" width="10%">
                        الوصف <br> {{ $receipt_details->table_qty_label }}
                    </td>
                    <td class="text-right" width="10%">
                        سعر الوحدة  <br> {{ $receipt_details->table_unit_price_label }}
                    </td>
                    {{-- <td class="text-right" width="10%">
                        {{ $receipt_details->discounted_unit_price_label }}
                    </td> --}}
                    <td>
                        تخفيض  <br> {{ $receipt_details->line_discount_label }}
                    </td>
                    <td class="text-right" width="15%">
                        ضريبة  <br> {{ $receipt_details->line_tax_label }}
                    </td>
                    <td class="text-right" width="15%">
                        سعر الوحدة (شامل الضريبة)  <br>  {{ $receipt_details->table_unit_price_label }} (@lang('product.inc_of_tax'))
                    </td>
                    <td class="text-right" width="15%">
                        المجموع الفرعي <br> {{ $receipt_details->table_subtotal_label }}
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($receipt_details->lines as $line)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            @if (!empty($line['image']))
                                <img src="{{ $line['image'] }}" alt="Image" width="50"
                                    style="float: left; margin-right: 8px;">
                            @endif
                            {{ $line['name'] }} {{ $line['product_variation'] }}
                            {{ $line['variation'] }}
                            @if (!empty($line['sub_sku']))
                                , {{ $line['sub_sku'] }}
                                @endif @if (!empty($line['brand']))
                                    , {{ $line['brand'] }}
                                @endif
                                @if (!empty($line['product_custom_fields']))
                                    , {{ $line['product_custom_fields'] }}
                                @endif
                                @if (!empty($line['product_description']))
                                    <small>
                                        {!! $line['product_description'] !!}
                                    </small>
                                @endif
                                @if (!empty($line['sell_line_note']))
                                    <br>
                                    <small class="text-muted">{!! $line['sell_line_note'] !!}</small>
                                @endif
                                @if (!empty($line['lot_number']))
                                    <br> {{ $line['lot_number_label'] }}: {{ $line['lot_number'] }}
                                @endif
                                @if (!empty($line['product_expiry']))
                                    , {{ $line['product_expiry_label'] }}:
                                    {{ $line['product_expiry'] }}
                                @endif

                                @if (!empty($line['warranty_name']))
                                    <br><small>{{ $line['warranty_name'] }} </small>
                                    @endif @if (!empty($line['warranty_exp_date']))
                                        <small>- {{ @format_date($line['warranty_exp_date']) }}
                                        </small>
                                    @endif
                                    @if (!empty($line['warranty_description']))
                                        <small> {{ $line['warranty_description'] ?? '' }}</small>
                                    @endif

                                    @if ($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                                        <br><small>
                                            1 {{ $line['units'] }} =
                                            {{ $line['base_unit_multiplier'] }}
                                            {{ $line['base_unit_name'] }} <br>
                                            {{ $line['base_unit_price'] }} x
                                            {{ $line['orig_quantity'] }} = {{ $line['line_total'] }}
                                        </small>
                                    @endif
                        </td>

                        @if ($receipt_details->show_cat_code == 1)
                            <td>
                                @if (!empty($line['cat_code']))
                                    {{ $line['cat_code'] }}
                                @endif
                            </td>
                        @endif

                        <td class="text-right">
                            {{ $line['quantity'] }} {{ $line['units'] }}

                            @if ($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                                <br><small>
                                    {{ $line['quantity'] }} x {{ $line['base_unit_multiplier'] }} =
                                    {{ $line['orig_quantity'] }} {{ $line['base_unit_name'] }}
                                </small>
                            @endif
                        </td>
                        <td class="text-right">
                            {{ $line['unit_price_before_discount'] }}
                        </td>
                        {{-- <td class="text-right">
                            {{ $line['unit_price_inc_tax'] }}
                        </td> --}}
                        <td class="text-right">
                            {{ $line['total_line_discount'] ?? 0 }}
                            @if (!empty($line['line_discount_percent']))
                                ({{ $line['line_discount_percent'] }}%)
                            @endif
                        </td>
                        <td class="text-right">
                            {{ $line['tax'] }} {{ $line['tax_name'] }}
                        </td>
                        <td class="text-right">
                            {{ $line['unit_price_inc_tax'] }}
                        </td>
                        <td class="text-right">
                            {{ $line['line_total'] }}
                        </td>
                    </tr>
                    @if (!empty($line['modifiers']))
                        @foreach ($line['modifiers'] as $modifier)
                            <tr>
                                <td class="text-center">
                                    &nbsp;
                                </td>
                                <td>
                                    {{ $modifier['name'] }} {{ $modifier['variation'] }}
                                    @if (!empty($modifier['sub_sku']))
                                        , {{ $modifier['sub_sku'] }}
                                    @endif
                                    @if (!empty($modifier['sell_line_note']))
                                        ({!! $modifier['sell_line_note'] !!})
                                    @endif
                                </td>

                                @if ($receipt_details->show_cat_code == 1)
                                    <td>
                                        @if (!empty($modifier['cat_code']))
                                            {{ $modifier['cat_code'] }}
                                        @endif
                                    </td>
                                @endif

                                <td class="text-right">
                                    {{ $modifier['quantity'] }} {{ $modifier['units'] }}
                                </td>
                                <td class="text-right">
                                    &nbsp;
                                </td>
                                <td class="text-center">
                                    &nbsp;
                                </td>
                                <td class="text-center">
                                    &nbsp;
                                </td>
                                <td class="text-center">
                                    &nbsp;
                                </td>
                                <td class="text-center">
                                    {{ $modifier['unit_price_exc_tax'] }}
                                </td>
                                <td class="text-right">
                                    {{ $modifier['line_total'] }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach

                @php
                    $lines = count($receipt_details->lines);
                @endphp

                @for ($i = $lines; $i < 2; $i++)
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        {{-- <td>&nbsp;</td> --}}
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        @if ($receipt_details->show_cat_code == 1)
                            <td>&nbsp;</td>
                        @endif
                    </tr>
                @endfor

            </tbody>
        </table>

        <!-- QR Code and Totals -->
        <div class="row align-items-start mt-3">
            <!-- Placeholder QR and Amount in words -->
            <div class="col-4">
                <div class="row" style="color: #000000 !important;">
                    @if (!empty($receipt_details->footer_text))
                        <div class="@if ($receipt_details->show_barcode || $receipt_details->show_qr_code) col-xs-8 @else col-xs-12 @endif">
                            {!! $receipt_details->footer_text !!}
                        </div>
                    @endif
                    @if ($receipt_details->show_barcode || $receipt_details->show_qr_code)
                        <div class="@if (!empty($receipt_details->footer_text)) col-xs-4 @else col-xs-12 @endif text-center">
                            @if ($receipt_details->show_barcode)
                                {{-- Barcode --}}
                                <img class="img-fluid"
                                    src="data:image/png;base64,{{ DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2, 30, [39, 48, 54], true) }}">
                            @endif

                            @if ($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
                                <img class="img-fluid"
                                    src="data:image/png;base64,{{ DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54]) }}">
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <!-- Totals Table -->
            <div class="col-8">
                <table class="table table-bordered">
                    <!-- Subtotal -->

                    <tr>
                        <th style="width:70%">
                            {!! $receipt_details->subtotal_label !!}
                        </th>
                        <td class="text-right">
                            {{ $receipt_details->subtotal_exc_tax }}
                        </td>
                    </tr>

                    <!-- Discount -->
                    @if (!empty($receipt_details->discount))
                        <tr>
                            <th>
                                {!! $receipt_details->discount_label !!}
                            </th>

                            <td class="text-right">
                                (-) {{ $receipt_details->discount }}
                            </td>
                        </tr>
                    @endif
                    <!-- VAT -->
                    @foreach ($receipt_details->taxes as $key => $val)
                        @if ($key != 'Total Tax')
                            <tr>
                                <td><b>{{ $key }}</b></td>
                                <td class="text-right">{{ $val }}</td>
                            </tr>
                        @endif
                    @endforeach






                    <!-- Total Paid-->
                    {{-- @if (!empty($receipt_details->total_paid))
                        <tr>
                            <th>
                                {!! $receipt_details->total_paid_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->total_paid }}
                            </td>
                        </tr>
                    @endif --}}

                    <!-- Total Due-->
                    @if (!empty($receipt_details->total_due) && !empty($receipt_details->total_due_label))
                        <tr>
                            <th>
                                {!! $receipt_details->total_due_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->total_due }}
                            </td>
                        </tr>
                    @endif

                    @if (!empty($receipt_details->all_due))
                        <tr>
                            <th>
                                {!! $receipt_details->all_bal_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->all_due }}
                            </td>
                        </tr>
                    @endif
                    @if (!empty($receipt_details->total_quantity_label))
                        <tr>
                            <th style="width:70%">
                                {!! $receipt_details->total_quantity_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->total_quantity }}
                            </td>
                        </tr>
                    @endif

                    @if (!empty($receipt_details->total_items_label))
                        <tr>
                            <th style="width:70%">
                                {!! $receipt_details->total_items_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->total_items }}
                            </td>
                        </tr>
                    @endif

                    @if (!empty($receipt_details->total_exempt_uf))
                        <tr>
                            <th style="width:70%">
                                @lang('lang_v1.exempt')
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->total_exempt }}
                            </td>
                        </tr>
                    @endif
                    <!-- Shipping Charges -->
                    @if (!empty($receipt_details->shipping_charges))
                        <tr>
                            <th style="width:70%">
                                {!! $receipt_details->shipping_charges_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->shipping_charges }}
                            </td>
                        </tr>
                    @endif

                    @if (!empty($receipt_details->packing_charge))
                        <tr>
                            <th style="width:70%">
                                {!! $receipt_details->packing_charge_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->packing_charge }}
                            </td>
                        </tr>
                    @endif



                    @if (!empty($receipt_details->total_line_discount))
                        <tr>
                            <th>
                                {!! $receipt_details->line_discount_label !!}
                            </th>

                            <td class="text-right">
                                (-) {{ $receipt_details->total_line_discount }}
                            </td>
                        </tr>
                    @endif

                    @if (!empty($receipt_details->additional_expenses))
                        @foreach ($receipt_details->additional_expenses as $key => $val)
                            <tr>
                                <td>
                                    {{ $key }}:
                                </td>

                                <td class="text-right">
                                    (+)
                                    {{ $val }}
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    @if (!empty($receipt_details->reward_point_label))
                        <tr>
                            <th>
                                {!! $receipt_details->reward_point_label !!}
                            </th>

                            <td class="text-right">
                                (-) {{ $receipt_details->reward_point_amount }}
                            </td>
                        </tr>
                    @endif

                    <!-- Tax -->
                    @if (!empty($receipt_details->tax))
                        <tr>
                            <th>
                                {!! $receipt_details->tax_label !!}
                            </th>
                            <td class="text-right">
                                (+) {{ $receipt_details->tax }}
                            </td>
                        </tr>
                    @endif

                    @if ($receipt_details->round_off_amount > 0)
                        <tr>
                            <th>
                                {!! $receipt_details->round_off_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->round_off }}
                            </td>
                        </tr>
                    @endif

                    <!-- Total -->
                    <tr>
                        <th>
                            {!! $receipt_details->total_label !!}
                        </th>
                        <td class="text-right">
                            {{ $receipt_details->total }}
                            @if (!empty($receipt_details->total_in_words))
                                <br>
                                <small>({{ $receipt_details->total_in_words }})</small>
                            @endif
                        </td>
                    </tr>

                    @if (!empty($receipt_details->payments))
                        @foreach ($receipt_details->payments as $payment)
                            <tr>
                                <td>{{ $payment['method'] }}</td>
                                <td class="text-right">{{ $payment['amount'] }}</td>
                                <td class="text-right">{{ $payment['date'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
                {{-- <table class="table table-bordered">
                    <tr>
                        <td>Total Amount <br><span dir="rtl">المبلغ الإجمالي</span></td>
                        <td class="text-end">3,252.95 SAR</td>
                    </tr>
                    <tr>
                        <td>Discount <br><span dir="rtl">الخصم</span></td>
                        <td class="text-end">0.00 SAR</td>
                    </tr>
                    <tr>
                        <td>Net Amount <br><span dir="rtl">الصافي</span></td>
                        <td class="text-end">3,252.95 SAR</td>
                    </tr>
                    <tr>
                        <td>VAT (15%) <br><span dir="rtl">ضريبة القيمة المضافة</span></td>
                        <td class="text-end">487.94 SAR</td>
                    </tr>
                    <tr>
                        <td><strong>Grand Total</strong><br><span dir="rtl"><strong>إجمالي المبلغ</strong></span>
                        </td>
                        <td class="text-end"><strong>3,740.89 SAR</strong></td>
                    </tr>
                </table> --}}
            </div>
            {{-- <div class="col-12">
                @if (empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label))
                    <!-- tax -->
                    @if (!empty($receipt_details->taxes))
                        <table class="table table-slim table-bordered">
                            <tr>
                                <th colspan="2" class="text-center">{{ $receipt_details->tax_summary_label }}
                                </th>
                            </tr>
                            @foreach ($receipt_details->taxes as $key => $val)
                                <tr>
                                    <td class="text-center"><b>{{ $key }}</b></td>
                                    <td class="text-center">{{ $val }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                @endif
            </div> --}}
        </div>

        <div >

            <!-- Signature Row -->
            <div class="row text-center" style="border: 1px solid #000; background-color: #e9e9e9; padding: 8px 0;">
                <div class="col-6">
                    <span>Receiver Sign</span>____________________
                    <span dir="rtl">توقيع المستلم</span>
                </div>
                <div class="col-6" style="border-right: 1px solid #000;">
                    <span>Salesman Sign</span>____________________
                    <span dir="rtl">توقيع البائع</span>
                </div>
              
            </div>
        
            <!-- Address Section -->
            <div class="row text-center" style="background-color: #e9e9e99f;border: 1px solid #000; border-top: none; font-size: 13px; padding: 5px;">
                <div dir="ltr">Asfan - Northern Industrial - P.O. Box 17964, Jeddah 21494 - C.R: 4030396970</div>
            </div>
            <div class="row text-center" style="background-color: #e9e9e99f;border: 1px solid #000; border-top: none; font-size: 13px; padding: 5px;">
                <div dir="rtl">عسفان - المنطقة الصناعية الشمالية - ص.ب 17964، جدة 21494 - س.ت: 4030396970</div>

            </div>
        </div>
        

    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                const printBtn = document.getElementById('print_invoice');
                if (printBtn) {
                    printBtn.click();
                } else {
                    console.error("Print button not found.");
                }
            }, 1000); 
        });
    </script>
    
</body>

</html>
