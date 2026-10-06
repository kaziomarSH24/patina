<x-mail::message>
# {{ $role === 'buyer' ? 'Payment Confirmed!' : 'You have a new order!' }}

Hi {{ $user->name }},

@if($role === 'buyer')
Great news! Your payment of **₹{{ number_format($escrow->amount, 2) }}** has been successfully captured and is safely held in our Escrow account. 
The seller has been notified to ship your watch. Funds will only be released once you confirm delivery.
@else
Congratulations! A buyer has paid **₹{{ number_format($escrow->amount, 2) }}** for your listing. 
The funds are securely held in our Escrow. Please prepare the watch for shipping and update the tracking details in your dashboard.
@endif

**Order Details:**
- **Amount:** ₹{{ number_format($escrow->amount, 2) }}
- **Escrow ID:** {{ $escrow->id }}

<x-mail::button :url="config('app.url') . ($role === 'buyer' ? '/orders' : '/sales')">
View Order Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
