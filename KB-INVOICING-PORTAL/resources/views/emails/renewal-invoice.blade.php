<!DOCTYPE html>
<html>
<head>
    <title>Renewal Invoice</title>
</head>
<body>
    <p>Dear {{ $order->order->user->name }},</p>
    <p>Your order for {{ $order->product->name }} is due for renewal. Below are the details:</p>
    <ul>
        <li>Invoice Number: {{ $renewal->invoice_number }}</li>
        <li>Renewal Price: ${{ number_format($renewal->renewal_price, 2) }}</li>
        <li>Next Due Date: {{ $renewal->next_due_date }}</li>
    </ul>
    <p>Please complete your payment to renew your subscription.</p>
    <p>Thank you for choosing our service!</p>
    <p>Best regards,<br>Your Company</p>
</body>
</html>
