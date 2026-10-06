<x-mail::message>
# New Dealer Application

A new dealer has submitted their onboarding application and requires admin verification.

- **Business Name:** {{ $profile->business_name }}
- **Requested Plan:** {{ $profile->plan->name ?? 'N/A' }}
- **Monthly Inventory:** {{ $profile->approx_monthly_inventory ?? 'Not specified' }}

Please log in to the admin dashboard to review their GST certificate and approve or reject their application.

<x-mail::button :url="config('app.frontend_url', 'http://localhost:3000') . '/dealer-applications'">
Review Application
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
