<x-mail::message>
# Subscription Cancelled

Hi {{ $user->name }},

We wanted to let you know that your Patina Dealer Subscription has been cancelled.
Your dealer privileges (including listings and wholesale prices) have been temporarily paused.

If this was a mistake or due to a payment failure, you can reactivate your account at any time by logging into the dashboard.

<x-mail::button :url="config('app.url') . '/dealer/subscription'">
Reactivate Subscription
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
