
    <style>
        /* RESET & BASE */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000 !important;
        }

        .invoice {
            width: 800px;
            margin: 20px auto;
            border: 1px solid #000;
            padding: 10px;
            color: #000 !important;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: -35px;
        }

        .header .left,
        .header .right {
            width: 48%;
        }

        .header .left {
            text-align: left;
        }

        .header .right {
            text-align: right;
            direction: rtl;
        }

        .header h2 {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .header p {
            line-height: 1.3;
        }

        .header hr {
            border: none;
            border-top: 1px solid #000;
            margin: 8px 0;
        }

        /* TITLE + PAGE# */
        .title-row {
            display: flex;
            align-items: center;
            margin: 6px 0;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .title-row .title-box {
            flex: 1;
            text-align: center;
        }

        .title-row .title-box span {
            border: 1px solid #000;
            padding: 2px 12px;
            font-weight: bold;
            font-size: 14px;
        }

        .title-row .page-info {
            text-align: right;
            font-size: 12px;
            margin-right: 22px;
        }

        /* INVOICE META */
        .invoice-info {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .invoice-info td {
            padding: 4px 6px;
            vertical-align: top;
        }

        .invoice-info .ltr {
            text-align: left;
        }

        .invoice-info .rtl {
            text-align: right;
            direction: rtl;
        }

        /* BILL TO & PAY TYPE BOXES */
        .info-boxes {
            display: flex;
            justify-content: space-between;
            gap: 2%;
            margin-top: 8px;
            color: #000;
            margin-bottom: -30px;
        }

        .info-boxes .box {
            border: 1px solid #000;
            padding: 6px;
        }

        .info-boxes .box.customer {
            flex: 3;
        }

        .info-boxes .box.payment {
            flex: 2;
        }

        .info-boxes table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-boxes td {
            vertical-align: top;
            padding: 4px;
        }

        .info-boxes .heading.ltr {
            text-align: left;
            font-weight: bold;
        }

        .info-boxes .heading.rtl {
            text-align: right;
            direction: rtl;
            font-weight: bold;
        }

        .info-boxes .custom-value.ltr {
            text-align: left;
        }

        .info-boxes .custom-value.rtl {
            text-align: right;
            direction: rtl;
        }

        .info-boxes .custom-label.ltr {
            text-align: left;
        }

        .info-boxes .custom-label.rtl {
            text-align: right;
            direction: rtl;
        }

        /* ITEMS TABLE */
        .items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        .custom-label {
            color: #000000;
        }

        .items th,
        .items td {
            border-left: 1.5px solid #000;
            border-right: 1.5px solid #000;
            padding: 6px;
        }

        .items th {
            border-top: 1.5px solid #000;
            border-bottom: 1.5px solid #000;
            background: #b3e5fc;
            text-align: center;
            line-height: 1.5;
        }

        .items td {
            border-bottom: none;
            vertical-align: top;
        }

        .items td.left {
            text-align: left;
            padding-left: 8px;
        }

        .items td.num {
            text-align: right;
            padding-right: 8px;
        }

        .after-items {
            border-top: 1px solid #000;
            margin-top: 1px;
        }

        /* SUMMARY + QR */
        .summary {
            display: flex;
            justify-content: space-between;
            margin-top: 4px;
        }

        .summary-left {
            flex: 3;
        }

        .summary-left p {
            margin: 2px 0;
            font-size: 12px;
        }

        .summary-left .arabic {
            text-align: right;
            direction: rtl;
        }

        .summary-left .outstanding {
            margin-top: 4px;
            font-weight: bold;
        }

        .summary-middle {
            flex: 1;
            text-align: center;
        }

        .summary-middle img {
            width: 100px;
        }

        .summary-right {
            flex: 2;
        }

        .summary-right table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .summary-right td {
            border: 1px solid #000;
            padding: 4px 6px;
        }

        .summary-right .custom-label {
            text-align: left;
        }

        .summary-right .custom-label.rtl {
            direction: rtl;
            text-align: right;
        }

        .summary-right .custom-value {
            text-align: right;
            width: 60px;
        }

        /* SIGNATURES */
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 12px;
            font-size: 12px;
        }

        .sign {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .sign-left {
            justify-content: flex-start;
            direction: ltr;
        }

        .sign-right {
            justify-content: flex-end;
            direction: rtl;
        }

        .sign .line {
            flex: 1;
            border-bottom: 1px dashed #000;
            margin: 0 8px;
            height: 0;
        }

        .post-signature {
            border-top: 1px solid #000;
            margin-top: 8px;
        }

        /* FOOTER */
        .bottom-footer {
            background: #b3e5fc;
            text-align: center;
            font-size: 11px;
            padding: 6px 0;
            margin-top: 0;
            direction: ltr;
        }

        .bottom-footer .arabic {
            display: block;
            direction: rtl;
            margin-top: 2px;
        }

        /* Print-specific styles */
        @media print {
            body {
                margin: 0;
                font-size: 12px;
                -webkit-print-color-adjust: exact !important; /* Chrome, Safari, Edge */
                color-adjust: exact !important; /* Standard */
                color: #000 !important;
                
            }
            .invoice {
                width: 100%;
                margin: 0;
                border: none;
                padding: 10mm;
            }
            .items {

            }
            .summary-middle img {
                max-width: 80px;
            }
            .no-print {
                display: none;
            }
            .items th,
            .bottom-footer {
                background-color: #b3e5fc !important;
                color: #000 !important; /* Ensure text on colored background is black */
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
        }
            
        }
    </style>
    


    <div class="invoice">

        <!-- Header -->
        <div class="header">
            <div class="left">
                @if (!empty($receipt_details->logo))
                    <img style="max-height: 70px; width: auto;" src="{{ $receipt_details->logo }}"
                        class="img img-responsive center-block">
                @endif

                <!-- Header text -->
                @if (!empty($receipt_details->header_text))
                    <div>
                        {!! $receipt_details->header_text !!}
                    </div>
                @endif
                <h2>
                    @if (!empty($receipt_details->display_name))
                        {{ $receipt_details->display_name }}
                    @endif
                </h2>
                @if (!empty($receipt_details->address))
                    <p>{!! $receipt_details->address !!}<br>
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
                    <b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}</p><br>
                @endif
            </div>
            <div class="middle">
                <img src="https://res.cloudinary.com/dsndiwe5z/image/upload/c_thumb,w_120,g_face/v1747835325/image_vnzmws.png"
                    alt="QR Code">
            </div>
            <div class="right">
                @if (!empty($receipt_details->sub_heading_line1))
                    <h2>{{ $receipt_details->sub_heading_line1 }}</h2>
                @endif
                @if (!empty($receipt_details->sub_heading_line2))
                    <p>{{ $receipt_details->sub_heading_line2 }}<br>
                @endif
                @if (!empty($receipt_details->sub_heading_line3))
                    {{ $receipt_details->sub_heading_line3 }}<br>
                @endif
                @if (!empty($receipt_details->sub_heading_line4))
                    {{ $receipt_details->sub_heading_line4 }}<br>
                @endif
                @if (!empty($receipt_details->sub_heading_line5))
                    {{ $receipt_details->sub_heading_line5 }}</p><br>
                @endif
            </div>
        </div>
        <hr>

        <!-- Title + Page# -->
        <div class="title-row">
            <div class="title-box">
                <span>Tax Invoice فاتورة ضريبية</span>
            </div>
        </div>

        <!-- Invoice No. / Date & Time -->
        <table class="invoice-info">
            <tr>
                <td class="ltr">
                    @if (!empty($receipt_details->invoice_no_prefix))
                        {!! $receipt_details->invoice_no_prefix !!}
                        <strong>{{ $receipt_details->invoice_no }}</strong>
                    @endif
                </td>
                <td class="rtl">
                    رقم الفاتورة
                </td>
                <td class="ltr">
                    Date &amp; Time
                    <strong>{{ $receipt_details->invoice_date }}</strong>
                </td>
                <td class="rtl">
                    التاريخ / الوقت
                    {{-- <strong>{{ $receipt_details->invoice_date }}</strong> --}}
                </td>
            </tr>
        </table>

        <!-- Bill To & Pay Type -->
        <div class="info-boxes">
            <div class="box customer">
                <table>
                    <tr>
                        <td class="heading ltr">{{ $receipt_details->customer_label }} </td>
                        <td class="heading rtl">اسم العميل</td>
                    </tr>
                    <tr>
                        <td class="custom-value ltr"><strong>{!! $receipt_details->customer_info !!}</strong></td>

                    </tr>
                    <tr>
                        <td>{{ $receipt_details->customer_mobile }}</td>
                    </tr>
                    <tr>

                        @if (!empty($receipt_details->tax_info1))
                            <td class="custom-label ltr">{{ $receipt_details->tax_label1 }}:
                                {{ $receipt_details->tax_info1 }}</td>
                        @endif
                        <td class="custom-label rtl">الرقم الضريبي للعميل</td>

                        @if (!empty($receipt_details->tax_info2))
                            <td>{{ $receipt_details->tax_label2 }}: {{ $receipt_details->tax_info2 }}</td>
                        @endif
                    </tr>
                </table>
            </div>
            <div class="box payment">
                <table>
                    <tr>
                        <td class="heading ltr">Pay Type<strong>&ensp; &emsp;


                                @if (!empty($receipt_details->payments))
                                    @foreach ($receipt_details->payments as $payment)
                                        {{ $payment['method'] }}
                                    @endforeach
                                @endif



                                &emsp;نقدية
                            </strong></td>
                        <td class="heading rtl">نوع الدفع</td>
                    </tr>
                    <tr>
                        <td class="heading ltr">PO #<strong>&ensp; &emsp;-Na-&emsp;</strong></td>
                        <td class="heading rtl">رقم الطلب</td>
                    </tr>
                </table>
            </div>
        </div>

       <!-- Items -->
<table class="items">
    <thead>
        <tr>
            <th style="width:40px;">
                <div>الرقم</div>
                <div>S#</div>
            </th>
            <th style="width:80px;">
                <div>رمز التخزين</div>
                <div>SKU</div>
            </th>

            @php $p_width = $receipt_details->show_cat_code != 1 ? 30 : 20; @endphp

            @if ($receipt_details->show_cat_code == 1)
                <th style="width:80px;">
                    <div>{{ $receipt_details->cat_code_label_ar ?? 'رقم الصنف' }}</div>
                    <div>{{ $receipt_details->cat_code_label ?? 'Item Code' }}</div>
                </th>
            @endif

            <th>
                <div>الوصف</div>
                <div>{{ $receipt_details->table_product_label ?? 'Product Name' }}</div>
            </th>

            <th style="width:60px;">
                <div>الكمية</div>
                <div>{{ $receipt_details->table_qty_label ?? 'Qty' }}</div>
            </th>

            <th style="width:80px;">
                <div>سعر الوحدة</div>
                <div>{{ $receipt_details->table_unit_price_label ?? 'Price' }}</div>
            </th>

            <th style="width:80px;">
                <div>خصم</div>
                <div>{{ $receipt_details->line_discount_label ?? 'Disc' }}</div>
            </th>

            <th style="width:80px;">
                <div>الضريبة</div>
                <div>{{ $receipt_details->line_tax_label ?? 'VAT(15%)' }}</div>
            </th>

            <th style="width:90px;">
                <div>القيمة الإجمالية</div>
                <div>{{ $receipt_details->table_subtotal_label ?? 'Total' }}</div>
            </th>
        </tr>
    </thead>

    <tbody>
        @foreach ($receipt_details->lines as $line)
            <tr>
                {{-- Serial Number --}}
                <td class="num">{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</td>

                {{-- SKU --}}
                <td class="num">{{ $line ['sub_sku'] ?? '' }}</td>

                {{-- Item Code (if enabled) --}}
                @if ($receipt_details->show_cat_code == 1)
                    <td class="num">{{ $line['cat_code'] ?? '' }}</td>
                @endif

                {{-- Product Details --}}
                <td class="left">
                    {{ $line['name'] }} {{ $line['product_variation'] }} {{ $line['variation'] }}
                    <!--@if (!empty($line['sub_sku']))-->
                    <!--    , {{ $line['sub_sku'] }}-->
                    <!--@endif-->
                    @if (!empty($line['brand']))
                        , {{ $line['brand'] }}
                    @endif
                    @if (!empty($line['product_custom_fields']))
                        , {{ $line['product_custom_fields'] }}
                    @endif
                    @if (!empty($line['product_description']))
                        <br><small>{!! $line['product_description'] !!}</small>
                    @endif
                    @if (!empty($line['sell_line_note']))
                        <br><small class="text-muted">{!! $line['sell_line_note'] !!}</small>
                    @endif
                    @if (!empty($line['lot_number']))
                        , {{ $line['lot_number_label'] }}: {{ $line['lot_number'] }}
                    @endif
                    @if (!empty($line['product_expiry']))
                        , {{ $line['product_expiry_label'] }}: {{ $line['product_expiry'] }}
                    @endif
                    @if (!empty($line['warranty_name']))
                        <br><small>{{ $line['warranty_name'] }}</small>
                        @if (!empty($line['warranty_exp_date']))
                            <small>- {{ @format_date($line['warranty_exp_date']) }}</small>
                        @endif
                        @if (!empty($line['warranty_description']))
                            <small>{{ $line['warranty_description'] }}</small>
                        @endif
                    @endif
                    @if ($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                        <br><small>1 {{ $line['units'] }} = {{ $line['base_unit_multiplier'] }}
                            {{ $line['base_unit_name'] }}<br>
                            {{ $line['base_unit_price'] }} x {{ $line['orig_quantity'] }} =
                            {{ $line['line_total'] }}</small>
                    @endif
                </td>

                {{-- Quantity --}}
                <td class="num">
                    {{ $line['quantity'] }} {{ $line['units'] }}
                    @if ($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                        <br><small>{{ $line['quantity'] }} x {{ $line['base_unit_multiplier'] }} =
                            {{ $line['orig_quantity'] }} {{ $line['base_unit_name'] }}</small>
                    @endif
                </td>

                {{-- Unit Price --}}
                <td class="num">{{ $line['unit_price_before_discount'] }}</td>

                {{-- Discount --}}
                <td class="num">
                    {{ $line['total_line_discount'] ?? '0.00' }}
                    @if (!empty($line['line_discount_percent']))
                        ({{ $line['line_discount_percent'] }}%)
                    @endif
                </td>

                {{-- Tax --}}
                <td class="num">{{ $line['tax'] }} {{ $line['tax_name'] }}</td>

                {{-- Line Total --}}
                <td class="num">{{ $line['line_total'] }}</td>
            </tr>

            {{-- Modifiers --}}
            @if (!empty($line['modifiers']))
                @foreach ($line['modifiers'] as $modifier)
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        @if ($receipt_details->show_cat_code == 1)
                            <td>&nbsp;</td>
                        @endif
                        <td class="left">
                            {{ $modifier['name'] }} {{ $modifier['variation'] }}
                            @if (!empty($modifier['sub_sku']))
                                , {{ $modifier['sub_sku'] }}
                            @endif
                            @if (!empty($modifier['sell_line_note']))
                                <small>({!! $modifier['sell_line_note'] !!})</small>
                            @endif
                        </td>
                        <td class="num">{{ $modifier['quantity'] }} {{ $modifier['units'] }}</td>
                        <td class="num">&nbsp;</td>
                        <td class="num">&nbsp;</td>
                        <td class="num">{{ $modifier['tax'] ?? '' }} {{ $modifier['tax_name'] ?? '' }}</td>
                        <td class="num">{{ $modifier['line_total'] }}</td>
                    </tr>
                @endforeach
            @endif
        @endforeach

        {{-- Fill up to 2 lines minimum --}}
        @php $lines = count($receipt_details->lines); @endphp
        @for ($i = $lines; $i < 2; $i++)
            <tr>
                @for ($j = 0; $j < ($receipt_details->show_cat_code == 1 ? 8 : 7); $j++)
                    <td>&nbsp;</td>
                @endfor
            </tr>
        @endfor
    </tbody>
</table>

       
       
        <div class="after-items"></div>
        @php
        function convertNumberToWords($number) {
            $words = [
                0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four',
                5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine',
                10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen',
                14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen',
                18 => 'eighteen', 19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
                40 => 'forty', 50 => 'fifty', 60 => 'sixty', 70 => 'seventy',
                80 => 'eighty', 90 => 'ninety'
            ];
        
            $levels = [
                1000000000 => 'billion',
                1000000 => 'million',
                1000 => 'thousand',
                100 => 'hundred'
            ];
        
            if ($number < 21) return $words[$number];
            if ($number < 100) {
                return $words[floor($number / 10) * 10] . (($number % 10 > 0) ? '-' . $words[$number % 10] : '');
            }
        
            foreach ($levels as $divisor => $label) {
                if ($number >= $divisor) {
                    $left = floor($number / $divisor);
                    $right = $number % $divisor;
                    return convertNumberToWords($left) . ' ' . $label . ($right ? ' ' . convertNumberToWords($right) : '');
                }
            }
        
            return '';
        }
        
        $totalAmount = floatval($receipt_details->subtotal_unformatted ?? 0);
        $amountParts = explode('.', number_format($totalAmount, 2, '.', ''));
        
        $integerPart = (int) $amountParts[0];
        $decimalPart = str_pad((int) $amountParts[1], 2, '0', STR_PAD_RIGHT);
        
        $amountInWords = ucfirst(convertNumberToWords($integerPart)) . ' and ' . $decimalPart . '/100 ' . ($receipt_details->currency_symbol ?? 'SAR') . ' Only';
        @endphp
        <!-- Summary & QR -->
        <div class="summary">
            <div class="summary-left">
                <p>{{ $amountInWords }}</p>
                {{-- <p class="arabic">أربعة آلاف وتسعمائة وثمانية وستون ريال سعودي فقط</p> --}}
                {{-- <p class="outstanding">
                    Outstanding Balance : <strong>13,633.25-</strong> رصيد عميل مميز :
                </p> --}}
            </div>
            <div class="summary-middle">
                {{-- <img src="https://static.vecteezy.com/system/resources/thumbnails/013/722/213/small_2x/sample-qr-code-icon-png.png"
                    alt="QR Code"> --}}
                @if ($receipt_details->show_barcode || $receipt_details->show_qr_code)
                    @if ($receipt_details->show_barcode)
                        {{-- Barcode --}}
                        <img
                            src="data:image/png;base64,{{ DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2, 30, [39, 48, 54], true) }}">
                    @endif

                    @if ($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
                        <img
                            src="data:image/png;base64,{{ DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54]) }}">
                    @endif
                @endif
            </div>
            <div class="summary-right">
                <table>
                    <tr>
                        <td class="custom-label">Total Amount Excl.VAT</td>
                        <td class="custom-label rtl">المبلغ الإجمالي</td>
                        <td class="custom-value">{{ $receipt_details->subtotal_exc_tax }}</td>
                    </tr>

                    <tr>
                        <td class="custom-label">Discount SR</td>
                        <td class="custom-label rtl">الخصم</td>
                        <td class="custom-value">
                            {{ !empty($receipt_details->discount) ? $receipt_details->discount : '0.00' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="custom-label">Net Amount</td>
                        <td class="custom-label rtl">صافي المجموع</td>
                        <td class="custom-value">
                            {{ number_format(
                                (float) preg_replace('/[^\d.]/', '', $receipt_details->subtotal_exc_tax ?? 0) -
                                    (float) preg_replace('/[^\d.]/', '', $receipt_details->discount ?? 0),
                                2,
                            ) }}
                        </td>
                    </tr>

                    <tr>
                        <td class="custom-label">VAT(15%)</td>
                        <td class="custom-label rtl">قيمة الضريبة المضافة</td>
                        <td class="custom-value">
                            @foreach ($receipt_details->taxes as $key => $val)
                                @if ($key != 'Total Tax')
                                    {{ $val }}
                                    @break
                                @endif
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <td class="custom-label"><strong>Grant Total</strong></td>
                        <td class="custom-label rtl"><strong>المبلغ الإجمالي</strong></td>
                        <td class="custom-value"><strong>{{ $receipt_details->total }}</strong></td>
                    </tr>
                </table>


            </div>
        </div>

        <!-- Signatures -->
        <div class="signatures">
            <div class="sign sign-left">
                Receiver Sign <span class="line"></span> توقيع المستلم
            </div>
            &ensp; &emsp;
            <div class="sign sign-right">
                توقيع البائع<span class="line"></span>Salesman Sign
            </div>
        </div>
        <div class="post-signature"></div>

        <!-- Footer -->
        <div class="bottom-footer">
            Asfan - Northern Industrial - P.O. Box 17964, Jeddah 21494 - C.R: 4030396970 <br>عسفان -الصناعية الشمالية -
            ص.ب 17964 - جدة21494 - س ت : 40303969
        </div>

    </div>

