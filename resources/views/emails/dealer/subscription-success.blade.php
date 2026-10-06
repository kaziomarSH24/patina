<x-mail::message>
# Welcome to Patina Dealer Program!

Hi {{ $user->name }},

Your subscription for **{{ $planName }}** has been successfully activated. 
You can now start listing your watches and managing your inventory.

**Transaction Details:**
- **Amount Paid:** ₹{{ number_format($amount, 2) }}
- **Subscription ID:** {{ $subscriptionId }}

<x-mail::button :url="config('app.url') . '/dealer/dashboard'">
Go to Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
