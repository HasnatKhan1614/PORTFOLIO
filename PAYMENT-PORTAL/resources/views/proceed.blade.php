<!DOCTYPE html>
<html>

<head>
    <title>Invoice From {{ $payment->brand->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <title>General Invoice</title>
    <link rel="stylesheet" href="{{ env('ASSET_URL') }}/invoice/assets/css/style.css">
    <style>
        .badge-unpaid {
            background-color: red;
            color: white;
            padding: 4px 8px;
            text-align: center;
            border-radius: 5px;
        }

        .badge-paid {
            background-color: #8dbf42 !important;
            color: white;
            padding: 4px 8px;
            text-align: center;
            border-radius: 5px;
        }
    </style>

    <style>
        .badge-unpaid {
            background-color: red;
            color: white;
            padding: 4px 8px;
            text-align: center;
            border-radius: 5px;
        }

        .badge-paid {
            background-color: #8dbf42 !important;
            color: white;
            padding: 4px 8px;
            text-align: center;
            border-radius: 5px;
        }

        .custom-button {
            width: 100%;
            display: inline-block;
            background-color: #333;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
        }

        .custom-button:hover {
            background-color: #555;
            transform: translateY(-2px);
        }

        .custom-button:active {
            background-color: #222;
            transform: translateY(0);
        }
    </style>


</head>

<body>
    @php
        $taxAmount = ($payment->price * $payment->tax) / 100;
        $totalAmount = $payment->price + $taxAmount;
    @endphp
    <input type="hidden" value="{{ $payment->invoice_number }}" id="invoiceNumber">

    @if ($payment->gateway->type == 'paypal' && $payment->status !== 'paid')
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="cs-container">
                        <div class="cs-invoice cs-style1">
                            <div class="cs-invoice_in" id="download_section">
                                <div class="cs-invoice_head cs-type1 cs-mb25">
                                    @php
                                        $inv_status = strtolower($payment->status) === 'paid' ? 'paid' : 'unpaid';
                                    @endphp
                                    <div class="cs-invoice_left">
                                        <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b
                                                class="cs-primary_color">Invoice
                                                No:</b> {{ $payment->invoice_number }}</p>
                                        <p class="cs-invoice_date cs-primary_color cs-m0"><b
                                                class="cs-primary_color">Date:
                                            </b>{{ $payment->created_at->format('d-m-y') }}</p>
                                        <p class="cs-invoice_date cs-primary_color cs-m0 ]"><b
                                                class="cs-primary_color">Status:
                                            </b><span
                                                class="{{ $inv_status == 'paid' ? 'badge-paid' : 'badge-unpaid' }}">
                                                {{ $payment->status }}</span></p>
                                    </div>
                                    <div class="cs-invoice_right cs-text_right">
                                        @if (!empty($payment->brand->logo_path))
                                            <div class="cs-logo cs-mb5">
                                                <img src="{{ asset('storage/' . $payment->brand->logo_path) }}"
                                                    alt="Logo">
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="cs-invoice_head cs-mb10">
                                    <div class="cs-invoice_left">
                                        <b class="cs-primary_color">Invoice To:</b>
                                        <p>Name: {{ $payment->customer->first_name ?? 'N/A' }}
                                            {{ $payment->customer->last_name ?? '' }}<br>
                                            Email: {{ $payment->customer->email ?? 'N/A' }}<br>
                                            Phone Number: {{ $payment->customer->phone_number ?? 'N/A' }}<br>
                                        </p>
                                    </div>
                                    <div class="cs-invoice_right cs-text_right">
                                        <b class="cs-primary_color">Pay To:</b>
                                        <p>
                                            {{ $payment->brand->name }} <br>
                                        </p>
                                    </div>
                                </div>
                                <div class="cs-table cs-style1">
                                    <div class="cs-round_border">
                                        <div class="cs-table_responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">
                                                            Item</th>
                                                        <th
                                                            class="cs-width_4 cs-semi_bold cs-primary_color cs-focus_bg">
                                                            Description
                                                        </th>
                                                        <th
                                                            class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">
                                                            Qty</th>
                                                        <th
                                                            class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">
                                                            Price</th>
                                                        <th
                                                            class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg cs-text_right">
                                                            Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="cs-width_3">{{ $payment->package_name }}</td>
                                                        <td class="cs-width_4">{{ $payment->description }}</td>
                                                        <td class="cs-width_2">1</td>
                                                        <td class="cs-width_1">
                                                            {{ $payment->currency == 'usd' ? '$' : '' }}
                                                            {{ $payment->currency == 'gbp' ? '£' : '' }}
                                                            {{ $payment->price }}
                                                        </td>
                                                        <td class="cs-width_2 cs-text_right">
                                                            {{ $payment->currency == 'usd' ? '$' : '' }}
                                                            {{ $payment->currency == 'gbp' ? '£' : '' }}
                                                            {{ $payment->price }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="cs-invoice_footer cs-border_top">
                                            <div class="cs-left_footer cs-mobile_hide">
                                                <p class="cs-mb0"><b class="cs-primary_color">Additional
                                                        Information:</b></p>
                                                <p class="cs-m0">At check in you may need to present the credit
                                                    <br>card used for
                                                    payment of this ticket.
                                                </p>
                                            </div>
                                            <div class="cs-right_footer">
                                                <table>
                                                    <tbody>
                                                        <tr class="cs-border_left">
                                                            <td
                                                                class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">
                                                                Subtoal
                                                            </td>
                                                            <td
                                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                                {{ $payment->currency == 'usd' ? '$' : '' }}
                                                                {{ $payment->currency == 'gbp' ? '£' : '' }}
                                                                {{ $payment->price }}</td>
                                                        </tr>
                                                        <tr class="cs-border_left">
                                                            <td
                                                                class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">
                                                                Tax</td>
                                                            <td
                                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                                {{ $payment->tax }}%</td>
                                                        </tr>
                                                        <tr class="cs-border_left">
                                                            <td
                                                                class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">
                                                                Remaining</td>
                                                            <td
                                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                                {{ $payment->remaining }}</td>
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
                                                    <tr class="cs-border_none">
                                                        <td
                                                            class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color">
                                                            Total
                                                            Amount</td>
                                                        <td
                                                            class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">
                                                            {{ $payment->currency == 'usd' ? '$' : '' }}
                                                            {{ $payment->currency == 'gbp' ? '£' : '' }}
                                                            {{ $totalAmount }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="cs-note">
                                    <div class="cs-note_left">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                            <path
                                                d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z"
                                                fill="none" stroke="currentColor" stroke-linejoin="round"
                                                stroke-width="32" />
                                            <path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32" />
                                        </svg>
                                    </div>
                                    <div class="cs-note_right">
                                        <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
                                        <p class="cs-m0">If you have any questions or concerns related to this invoice,
                                            please do not
                                            hesitate to contact us at our customer service.</p>
                                    </div>
                                </div><!-- .cs-note -->
                            </div>
                            {{-- <div class="cs-invoice_btns cs-hide_print">
                                <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <path
                                            d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                                            fill="none" stroke="currentColor" stroke-linejoin="round"
                                            stroke-width="32" />
                                        <rect x="128" y="240" width="256" height="208" rx="24.32"
                                            ry="24.32" fill="none" stroke="currentColor"
                                            stroke-linejoin="round" stroke-width="32" />
                                        <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24"
                                            fill="none" stroke="currentColor" stroke-linejoin="round"
                                            stroke-width="32" />
                                        <circle cx="392" cy="184" r="24" />
                                    </svg>
                                    <span>Print</span>
                                </a>
                                <button id="download_btn" class="cs-invoice_btn cs-color2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <title>Download</title>
                                        <path
                                            d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32" />
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32"
                                            d="M176 272l80 80 80-80M256 48v288" />
                                    </svg>
                                    <span>Download</span>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">

                    <div class="cs-container">
                        <div id="paypal-button-container"></div>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                        <script src="https://www.paypal.com/sdk/js?client-id={{ $payment->gateway->key1 }}&currency=USD"></script>
                        <script>
                            var appUrl = "{{ env('APP_URL') }}";
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            paypal.Buttons({
                                createOrder: function(data, actions) {
                                    return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                value: {{ $totalAmount }} // Replace with the actual amount
                                            }
                                        }],
                                        application_context: {
                                            shipping_preference: 'NO_SHIPPING',
                                            billing_preference: "NO_BILLING"
                                        },
                                        payer: {
                                            name: {
                                                given_name: "{{ $payment->customer->name }}",
                                                surname: "{{ $payment->customer->name }}"
                                            },
                                            email_address: "{{ $payment->customer->email }}",
                                            address: {
                                                address_line_1: '1234 Main Street',
                                                admin_area_2: 'Anytown',
                                                admin_area_1: 'CA',
                                                postal_code: '98765',
                                                country_code: 'US'
                                            }
                                        }
                                    });
                                },
                                onApprove: function(data, actions) {

                                    return actions.order.capture().then(function(details) {


                                        var invoice_number = "{{ $payment->invoice_number }}";




                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            url: "{{ route('paypal.success') }}", // Replace with your server URL
                                            method: 'POST',
                                            data: {
                                                invoice_number: invoice_number,
                                                status: 'COMPLETED',
                                            },
                                            success: function(response) {
                                                if (response.status === 'ok') {
                                                    window.location.href = appUrl + '/invoice/' +
                                                        invoice_number;

                                                }
                                            },

                                            error: function(xhr, status, error) {
                                                console.error(
                                                    'Error sending transaction details to the server: ' +
                                                    error);
                                            }
                                        });



                                    });
                                },
                                /*application_context: {
                                    shipping_preference: "NO_SHIPPING",
                                    billing_preference: "NO_BILLING"
                                }*/
                            }).render('#paypal-button-container');
                        </script>
                    </div>


                </div>
            </div>
        </div>
    @else
        <div class="cs-container">
            <div class="cs-invoice cs-style1">
                <div class="cs-invoice_in" id="download_section">
                    <div class="cs-invoice_head cs-type1 cs-mb25">
                        @php
                            $inv_status = strtolower($payment->status) === 'paid' ? 'paid' : 'unpaid';
                        @endphp
                        <div class="cs-invoice_left">
                            <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b
                                    class="cs-primary_color">Invoice
                                    No:</b> {{ $payment->invoice_number }}</p>
                            <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">Date:
                                </b>{{ $payment->created_at->format('d-m-y') }}</p>
                            <p class="cs-invoice_date cs-primary_color cs-m0 ]"><b class="cs-primary_color">Status:
                                </b><span class="{{ $inv_status == 'paid' ? 'badge-paid' : 'badge-unpaid' }}">
                                    {{ $payment->status }}</span></p>
                        </div>
                        <div class="cs-invoice_right cs-text_right">
                            @if (!empty($payment->brand->logo_path))
                                <div class="cs-logo cs-mb5">
                                    <img src="{{ asset('storage/' . $payment->brand->logo_path) }}" alt="Logo">
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="cs-invoice_head cs-mb10">
                        <div class="cs-invoice_left">
                            <b class="cs-primary_color">Invoice To:</b>
                            <p>Name: {{ $payment->customer->first_name ?? 'N/A' }}
                                {{ $payment->customer->last_name ?? '' }}<br>
                                Email: {{ $payment->customer->email ?? 'N/A' }}<br>
                                Phone Number: {{ $payment->customer->phone_number ?? 'N/A' }}<br>
                            </p>

                        </div>
                        <div class="cs-invoice_right cs-text_right">
                            <b class="cs-primary_color">Pay To:</b>
                            <p>
                                {{ $payment->brand->name }} <br>
                            </p>
                        </div>
                    </div>
                    <div class="cs-table cs-style1">
                        <div class="cs-round_border">
                            <div class="cs-table_responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Item</th>
                                            <th class="cs-width_4 cs-semi_bold cs-primary_color cs-focus_bg">
                                                Description
                                            </th>
                                            <th class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">Qty</th>
                                            <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Price</th>
                                            <th
                                                class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg cs-text_right">
                                                Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="cs-width_3">{{ $payment->package_name }}</td>
                                            <td class="cs-width_4">{{ $payment->description }}</td>
                                            <td class="cs-width_2">1</td>
                                            <td class="cs-width_1">
                                                {{ $payment->currency == 'usd' ? '$' : '' }}
                                                {{ $payment->currency == 'gbp' ? '£' : '' }}
                                                {{ $payment->price }}
                                            </td>
                                            <td class="cs-width_2 cs-text_right">
                                                {{ $payment->currency == 'usd' ? '$' : '' }}
                                                {{ $payment->currency == 'gbp' ? '£' : '' }}
                                                {{ $payment->price }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cs-invoice_footer cs-border_top">
                                <div class="cs-left_footer cs-mobile_hide">
                                    <p class="cs-mb0"><b class="cs-primary_color">Additional Information:</b></p>
                                    <p class="cs-m0">At check in you may need to present the credit <br>card used for
                                        payment of this ticket.</p>
                                </div>
                                <div class="cs-right_footer">
                                    <table>
                                        <tbody>
                                            <tr class="cs-border_left">
                                                <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">
                                                    Subtoal
                                                </td>
                                                <td
                                                    class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                    {{ $payment->currency == 'usd' ? '$' : '' }}
                                                    {{ $payment->currency == 'gbp' ? '£' : '' }}
                                                    {{ $payment->price }}</td>
                                            </tr>
                                            <tr class="cs-border_left">
                                                <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Tax
                                                </td>
                                                <td
                                                    class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                    {{ $payment->tax }}%</td>
                                            </tr>
                                            <tr class="cs-border_left">
                                                <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">
                                                    Remaining</td>
                                                <td
                                                    class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                    {{ $payment->remaining }}</td>
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
                                        <tr class="cs-border_none">
                                            <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color">
                                                Total
                                                Amount
                                            </td>
                                            <td
                                                class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">
                                                {{ $payment->currency == 'usd' ? '$' : '' }}
                                                {{ $payment->currency == 'gbp' ? '£' : '' }}
                                                {{ $totalAmount }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="cs-note">
                        <div class="cs-note_left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                <path
                                    d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z"
                                    fill="none" stroke="currentColor" stroke-linejoin="round"
                                    stroke-width="32" />
                                <path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                            </svg>
                        </div>
                        <div class="cs-note_right">
                            <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
                            <p class="cs-m0">If you have any questions or concerns related to this invoice, please do
                                not
                                hesitate to contact us at our customer service.</p>
                        </div>
                    </div><!-- .cs-note -->
                </div>
                <div class="cs-invoice_btns cs-hide_print">
                    <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
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
                    </a>
                    <button id="download_btn" class="cs-invoice_btn cs-color2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <title>Download</title>
                            <path
                                d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="32" d="M176 272l80 80 80-80M256 48v288" />
                        </svg>
                        <span>Download</span>
                    </button>
                </div>
            </div>
            @if ($inv_status == 'unpaid')
                <div>
                    <a href="{{ url('/pay/' . $payment->invoice_number) }}" class="custom-button">Proceed</a>
                </div>
            @endif
        </div>
    @endif
    <script src="{{ env('ASSET_URL') }}/invoice/assets/js/jquery.min.js"></script>
    <script src="{{ env('ASSET_URL') }}/invoice/assets/js/jspdf.min.js"></script>
    <script src="{{ env('ASSET_URL') }}/invoice/assets/js/html2canvas.min.js"></script>
    <script src="{{ env('ASSET_URL') }}/invoice/assets/js/main.js"></script>
</body>

</html>
