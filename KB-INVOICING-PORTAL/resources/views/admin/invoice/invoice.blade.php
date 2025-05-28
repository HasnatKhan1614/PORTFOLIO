<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeMarch">
    <!-- Site Title -->
    <title>General Invoice</title>
    <link rel="stylesheet" href="{{ env('ASSET_URL') }}/dashboard/assets/invoice/assets/css/style.css">
  
</head>

<body>
    <div class="cs-container">
        <div class="cs-invoice cs-style1">
            <div class="cs-invoice_in" id="download_section">
                <div class="cs-invoice_head cs-type1 cs-mb25">
                    <div class="cs-invoice_left cs-text_left">
                        <div class="cs-logo cs-mb5">
                            <img src="{{ env('ASSET_URL') }}/dashboard/assets/invoice/assets/img/logo.png"
                                alt="Logo" style="width: 50%">
                        </div>
                    </div>
                    <div class="cs-invoice_right">
                        <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16">
                            <b class="cs-primary_color">Invoice No:</b> {{ $data['invoice_no'] }}
                        </p>
                        <p class="cs-invoice_date cs-primary_color cs-m0">
                            <b class="cs-primary_color">Date:</b> {{ $data['date'] }}
                        </p>
                        <p class="cs-invoice_date cs-primary_color cs-m0">
                            <b class="cs-primary_color">Status:</b>
                            @if ($data['payment_status'] == 'paid')
                                <span class="badge badge-paid">Paid</span>
                            @else
                                <span class="badge badge-unpaid">Unpaid</span>
                            @endif
                        </p>
                        
                    </div>

                </div>

                <div class="cs-invoice_head cs-mb10">
                    <div class="cs-invoice_left">
                        <b class="cs-primary_color">Invoice To:</b>
                        <p>
                            @isset($data['user']['name'])
                                Name: {{ $data['user']['name'] }}<br>
                            @endisset
                        
                            @isset($data['user']['email'])
                                Email: {{ $data['user']['email'] }}<br>
                            @endisset
                        
                            @isset($data['user']['phone'])
                                Phone: {{ $data['user']['phone'] }}<br>
                            @endisset
                        
                            @isset($data['user']['address'])
                                Address: {{ $data['user']['address'] }}<br>
                            @endisset
                        </p>
                        
                    </div>
                    <div class="cs-invoice_right">
                        <b class="cs-primary_color">Pay To:</b>
                        <p>
                            Company Name: KBSolutions<br>
                        
                                Email: billing@kbsolutions.agency<br>
                        
                                Phone: +16313180445<br>
                        
                                Address: A: 127 N. MADISON AVE. <br> PASADENA, CA 91101<br>
                        </p>
                        
                    </div>
                </div>

                <div class="cs-table cs-style1">
                    <div class="cs-round_border">
                        <div class="cs-table_responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Product</th>
                                        <th class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">Price</th>
                                        <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Qty</th>
                                        <th class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Expire In</th>
                                        <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalAmount = 0; // Initialize total amount
                                    @endphp

                                    @foreach ($data['items'] as $item)
                                    @php
                                    $itemTotal = is_numeric($item['total']) ? $item['total'] : 0;
                                    $totalAmount += $itemTotal;
                                
                                    $tax_type = $data['tax_type'] ?? null;
                                    $tax_value = $data['tax_value'] ?? 0;
                                
                                    $taxAmount = 0;
                                
                                    if ($tax_type === 'percent') {
                                        $taxAmount = ($totalAmount * $tax_value) / 100;
                                        $taxLabel = $tax_value . '%';
                                    } elseif ($tax_type === 'amount') {
                                        $taxAmount = $tax_value;
                                        $taxLabel = number_format($tax_value, 2);
                                    } else {
                                        $taxLabel = '0';
                                    }
                                
                                    $grandTotal = $totalAmount + $taxAmount;
                                @endphp
                                        <tr>
                                            <td class="cs-width_3">{{ $item['product_name'] }}</td>
                                            <td class="cs-width_2">
                                                {{ $item['price'] === 'Free' ? 'Free' : $data['currency_symbol'] . number_format($item['price'], 0) }}
                                            </td>
                                            <td class="cs-width_1">{{ $item['quantity'] }}</td>
                                            <td class="cs-width_3">{{ $item['expire_in'] }}</td>
                                            <td class="cs-width_1">
                                                {{ $item['total'] === '-' ? '-' : $data['currency_symbol'] . number_format($item['total'], 0) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="cs-invoice_footer cs-border_top">
                            <div class="cs-left_footer cs-mobile_hide">
                                @if (isset($data['notes']))
                                <p class="cs-mb0"><b class="cs-primary_color">Additional Information:</b></p>
                                <p class="cs-m0">
                                    {{ $data['notes'] ?? 'N/A' }}
                                </p>
                                @endif
                            </div>
                            <div class="cs-right_footer">
                                <table>
                                    <tbody>
                                        <tr class="cs-border_left">
                                            <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Subtotal
                                            </td>
                                            <td
                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                {{ $data['currency_symbol'] . '' . number_format($totalAmount, 0) }}
                                            </td>
                                        </tr>
                                        <tr class="cs-border_left">
                                            <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Tax</td>
                                            <td
                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                {{ $tax_type === 'percent' ? $taxLabel : $data['currency_symbol'] . $taxLabel }}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="cs-invoice_footer">
                        <div class="cs-left_footer cs-mobile_hide"></div>
                        <div class="cs-right_footer">
                            <table>
                                <tbody>
                                    <!-- Total Amount Row -->
                                    <tr class="cs-border_none">
                                        <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color">Total
                                            Amount</td>
                                        <td colspan="5"
                                            class="cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">
                                            {{ $data['currency_symbol'] ?? '$' }}{{ number_format($grandTotal, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="display-flex space-between cs-mb50">
                    <div>
                        <p class="cs-primary_color cs-mb3 cs-semi_bold">BANK INFO:</p>
                        @foreach ($data['bank_infos'] ?? [] as $bank)
                        <p class="cs-lh-165">
                            @isset($bank['bank_name'])
                                Bank Name:
                                <span class="cs-primary_color cs-semi_bold">{{ $bank['bank_name'] }}</span> <br>
                            @endisset
                    
                            @isset($bank['account_name'])
                                Account Name:
                                <span class="cs-primary_color cs-semi_bold">{{ $bank['account_name'] }}</span> <br>
                            @endisset
                    
                            @isset($bank['account_number'])
                                Account Number:
                                <span class="cs-primary_color cs-semi_bold">{{ $bank['account_number'] }}</span> <br>
                            @endisset
                    
                            @isset($bank['swift_code'])
                                Swift Code:
                                <span class="cs-primary_color cs-semi_bold">{{ $bank['swift_code'] }}</span> <br>
                            @endisset
                    
                            @isset($bank['iban'])
                                Iban:
                                <span class="cs-primary_color cs-semi_bold">{{ $bank['iban'] }}</span>
                            @endisset
                        </p>
                    @endforeach
                    

                    </div>
                    {{-- <div>
                        <p class="cs-secondary_color cs-text_right">Total</p>
                        <p class="cs-primary_color cs-f18 cs-semi_bold cs-f28">$20,690.00</p>
                    </div> --}}
                </div>
                <div class="cs-note">
                    <div class="cs-note_left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z"
                                fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                        </svg>
                    </div>
                    <div class="cs-note_right">
                        <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
                        <p class="cs-m0">At check-in, you may need to present the credit card used for payment of this
                            ticket.</p>
                        <p style="text-align: center; margin-top: 50px;">PDF Generated on {{ \Carbon\Carbon::parse($data['date'])->format('l, F jS, Y') }}</p>
                    </div>
                </div><!-- .cs-note -->
            </div>
            <div class="cs-invoice_btns cs-hide_print">
                {{-- <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <path
                            d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32"
                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                            stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <circle cx="392" cy="184" r="24" />
                    </svg>
                    <span>Print</span>
                </a> --}}
                <button id="download_btn" class="cs-invoice_btn cs-color2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <title>Download</title>
                        <path
                            d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32" />
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32" d="M176 272l80 80 80-80M256 48v288" />
                    </svg>
                    <span>Download</span>
                </button>
                <a href="{{ route('admin.orders.invoice.pay', $data['invoice_no']) }}"
                    class="cs-invoice_btn cs-color1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <path
                            d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32"
                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                            stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <circle cx="392" cy="184" r="24" />
                    </svg>
                    <span>Pay</span>
                </a>

            </div>
         
        </div>
    </div>
    <script src="{{ env('ASSET_URL') }}/dashboard/assets/invoice/assets/js/jquery.min.js"></script>
    <script src="{{ env('ASSET_URL') }}/dashboard/assets/invoice/assets/js/jspdf.min.js"></script>
    <script src="{{ env('ASSET_URL') }}/dashboard/assets/invoice/assets/js/html2canvas.min.js"></script>
    <script src="{{ env('ASSET_URL') }}/dashboard/assets/invoice/assets/js/main.js"></script>
</body>

</html>
