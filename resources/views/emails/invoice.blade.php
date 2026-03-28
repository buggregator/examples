@component('mail::message')
# Invoice #{{ $invoiceNumber }}

Dear {{ $customerName }},

Please find your invoice details below:

@component('mail::table')
| Description | Amount |
|:------------|-------:|
| Monthly Subscription (Pro Plan) | ${{ number_format($amount * 0.8, 2) }} |
| Additional Storage (50 GB) | ${{ number_format($amount * 0.15, 2) }} |
| Tax | ${{ number_format($amount * 0.05, 2) }} |
| **Total** | **${{ number_format($amount, 2) }}** |
@endcomponent

@component('mail::panel')
Payment is due within 14 days. Please use invoice reference **{{ $invoiceNumber }}** when making the payment.
@endcomponent

@component('mail::button', ['url' => 'https://example.com/invoices/' . $invoiceNumber, 'color' => 'green'])
Pay Now
@endcomponent

If you have any questions about this invoice, please contact our billing team.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
