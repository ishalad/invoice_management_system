@component('mail::message')
# Invoice {{ $invoice->invoice_number }}

@component('mail::table')
| Product       | Quantity      | Unit Price    |
| ------------- |:-------------:| -------------:|
@foreach ($invoice->products as $product)
| {{ $product->name }} | {{ $product->pivot->quantity }} | {{ $product->price_per_unit }} |
@endforeach
@endcomponent

Total: {{ $invoice->products->sum(fn($product) => $product->pivot->quantity * $product->price_per_unit) }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
