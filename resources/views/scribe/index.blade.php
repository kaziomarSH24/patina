<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Patina API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
                    body .content .php-example code { display: none; }
                    body .content .python-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://10.10.28.53:81";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;,&quot;python&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                            <button type="button" class="lang-button" data-language-name="php">php</button>
                                            <button type="button" class="lang-button" data-language-name="python">python</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-register">
                                <a href="#authentication-POSTapi-v1-auth-register">Register User</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-login">
                                <a href="#authentication-POSTapi-v1-auth-login">User Login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-logout">
                                <a href="#authentication-POSTapi-v1-auth-logout">User Logout</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-verification-email-verification-resend-endpoints">
                                <a href="#authentication-verification-email-verification-resend-endpoints">Verification
Email verification & resend endpoints.</a>
                            </li>
                                                            <ul id="tocify-subheader-authentication-verification-email-verification-resend-endpoints" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="authentication-POSTapi-v1-auth-verify">
                                            <a href="#authentication-POSTapi-v1-auth-verify">POST api/v1/auth/verify</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="authentication-POSTapi-v1-auth-resend-verification">
                                            <a href="#authentication-POSTapi-v1-auth-resend-verification">POST api/v1/auth/resend-verification</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="authentication-password-password-reset-update-endpoints">
                                <a href="#authentication-password-password-reset-update-endpoints">Password
Password reset & update endpoints.</a>
                            </li>
                                                            <ul id="tocify-subheader-authentication-password-password-reset-update-endpoints" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="authentication-POSTapi-v1-auth-forgot-password">
                                            <a href="#authentication-POSTapi-v1-auth-forgot-password">POST api/v1/auth/forgot-password</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="authentication-POSTapi-v1-auth-verify-password-otp">
                                            <a href="#authentication-POSTapi-v1-auth-verify-password-otp">POST api/v1/auth/verify-password-otp</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="authentication-POSTapi-v1-auth-reset-password-with-token">
                                            <a href="#authentication-POSTapi-v1-auth-reset-password-with-token">POST api/v1/auth/reset-password-with-token</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="authentication-POSTapi-v1-auth-update-password">
                                            <a href="#authentication-POSTapi-v1-auth-update-password">POST api/v1/auth/update-password</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-profile" class="tocify-header">
                <li class="tocify-item level-1" data-unique="profile">
                    <a href="#profile">Profile</a>
                </li>
                                    <ul id="tocify-subheader-profile" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="profile-GETapi-v1-profile-me">
                                <a href="#profile-GETapi-v1-profile-me">GET api/v1/profile/me</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-chat" class="tocify-header">
                <li class="tocify-item level-1" data-unique="chat">
                    <a href="#chat">Chat</a>
                </li>
                                    <ul id="tocify-subheader-chat" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="chat-conversations-list-create-11-or-group-conversations">
                                <a href="#chat-conversations-list-create-11-or-group-conversations">Conversations
List & create 1:1 or group conversations.</a>
                            </li>
                                                            <ul id="tocify-subheader-chat-conversations-list-create-11-or-group-conversations" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="chat-GETapi-v1-chat-conversations">
                                            <a href="#chat-GETapi-v1-chat-conversations">GET api/v1/chat/conversations</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-POSTapi-v1-chat-conversations">
                                            <a href="#chat-POSTapi-v1-chat-conversations">POST api/v1/chat/conversations</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="chat-messages-conversation-message-retrieval-creation-editing-deletion-typing-indicators-and-read-receipts">
                                <a href="#chat-messages-conversation-message-retrieval-creation-editing-deletion-typing-indicators-and-read-receipts">Messages
Conversation message retrieval, creation, editing, deletion, typing indicators and read receipts.</a>
                            </li>
                                                            <ul id="tocify-subheader-chat-messages-conversation-message-retrieval-creation-editing-deletion-typing-indicators-and-read-receipts" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="chat-GETapi-v1-chat-conversations--conversation_id--messages">
                                            <a href="#chat-GETapi-v1-chat-conversations--conversation_id--messages">GET api/v1/chat/conversations/{conversation_id}/messages</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-POSTapi-v1-chat-messages">
                                            <a href="#chat-POSTapi-v1-chat-messages">POST api/v1/chat/messages</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-PATCHapi-v1-chat-messages--id-">
                                            <a href="#chat-PATCHapi-v1-chat-messages--id-">update a message</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-DELETEapi-v1-chat-messages--id-">
                                            <a href="#chat-DELETEapi-v1-chat-messages--id-">delete a message (soft delete)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-POSTapi-v1-chat-messages-read">
                                            <a href="#chat-POSTapi-v1-chat-messages-read">POST api/v1/chat/messages/read</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-POSTapi-v1-chat-conversations--conversation--typing">
                                            <a href="#chat-POSTapi-v1-chat-conversations--conversation--typing">broadcast typing indicator</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="chat-groups-manage-group-membership-roles">
                                <a href="#chat-groups-manage-group-membership-roles">Groups
Manage group membership & roles.</a>
                            </li>
                                                            <ul id="tocify-subheader-chat-groups-manage-group-membership-roles" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="chat-POSTapi-v1-chat-groups--conversation_id--members">
                                            <a href="#chat-POSTapi-v1-chat-groups--conversation_id--members">add group members</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-DELETEapi-v1-chat-groups--conversation_id--members">
                                            <a href="#chat-DELETEapi-v1-chat-groups--conversation_id--members">remove group member</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-POSTapi-v1-chat-groups--conversation_id--leave">
                                            <a href="#chat-POSTapi-v1-chat-groups--conversation_id--leave">leave group</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-POSTapi-v1-chat-groups--conversation_id--promote">
                                            <a href="#chat-POSTapi-v1-chat-groups--conversation_id--promote">promote a member to admin</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="chat-POSTapi-v1-chat-groups--conversation_id--demote">
                                            <a href="#chat-POSTapi-v1-chat-groups--conversation_id--demote">demote an admin to member</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-payments" class="tocify-header">
                <li class="tocify-item level-1" data-unique="payments">
                    <a href="#payments">Payments</a>
                </li>
                                    <ul id="tocify-subheader-payments" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="payments-one-time-charges-create-one-off-payments-via-paymentintent-or-checkout-session">
                                <a href="#payments-one-time-charges-create-one-off-payments-via-paymentintent-or-checkout-session">One-Time Charges
Create one-off payments via PaymentIntent or Checkout Session.</a>
                            </li>
                                                            <ul id="tocify-subheader-payments-one-time-charges-create-one-off-payments-via-paymentintent-or-checkout-session" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-one-time-checkout-session">
                                            <a href="#payments-POSTapi-v1-payment-one-time-checkout-session">Create a Stripe Checkout Session for one-time payment.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-one-time-payment-intent">
                                            <a href="#payments-POSTapi-v1-payment-one-time-payment-intent">Create a PaymentIntent for use with frontend card elements (e.g., Stripe.js).</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="payments-subscriptions-manage-user-subscription-lifecycle-create-show-cancel-resume-swap">
                                <a href="#payments-subscriptions-manage-user-subscription-lifecycle-create-show-cancel-resume-swap">Subscriptions
Manage user subscription lifecycle (create, show, cancel, resume, swap).</a>
                            </li>
                                                            <ul id="tocify-subheader-payments-subscriptions-manage-user-subscription-lifecycle-create-show-cancel-resume-swap" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-subscriptions">
                                            <a href="#payments-POSTapi-v1-payment-subscriptions">Create a new subscription checkout session for the user.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-GETapi-v1-payment-subscriptions">
                                            <a href="#payments-GETapi-v1-payment-subscriptions">Get details of the user's active subscription.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-subscriptions-cancel">
                                            <a href="#payments-POSTapi-v1-payment-subscriptions-cancel">Cancel the user's active subscription at the end of the billing period.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-subscriptions-resume">
                                            <a href="#payments-POSTapi-v1-payment-subscriptions-resume">Resume a cancelled subscription if it's still in its grace period.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-subscriptions-swap">
                                            <a href="#payments-POSTapi-v1-payment-subscriptions-swap">Swap the user's subscription to a different plan.</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="payments-refunds-request-refunds-for-eligible-transactions">
                                <a href="#payments-refunds-request-refunds-for-eligible-transactions">Refunds
Request refunds for eligible transactions.</a>
                            </li>
                                                            <ul id="tocify-subheader-payments-refunds-request-refunds-for-eligible-transactions" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-refunds">
                                            <a href="#payments-POSTapi-v1-payment-refunds">Sends a refund request for a specific transaction.</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="payments-invoices-list-download-invoices-generated-by-stripe">
                                <a href="#payments-invoices-list-download-invoices-generated-by-stripe">Invoices
List & download invoices generated by Stripe.</a>
                            </li>
                                                            <ul id="tocify-subheader-payments-invoices-list-download-invoices-generated-by-stripe" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="payments-GETapi-v1-payment-invoices">
                                            <a href="#payments-GETapi-v1-payment-invoices">Display a paginated list of the user's invoices.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-GETapi-v1-payment-invoices--invoice--download">
                                            <a href="#payments-GETapi-v1-payment-invoices--invoice--download">Download a specific invoice as a PDF.</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="payments-payment-methods-manage-saved-cards-default-payment-method">
                                <a href="#payments-payment-methods-manage-saved-cards-default-payment-method">Payment Methods
Manage saved cards & default payment method.</a>
                            </li>
                                                            <ul id="tocify-subheader-payments-payment-methods-manage-saved-cards-default-payment-method" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="payments-GETapi-v1-payment-payment-methods">
                                            <a href="#payments-GETapi-v1-payment-payment-methods">Display a list of the user's saved payment methods.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-payment-methods">
                                            <a href="#payments-POSTapi-v1-payment-payment-methods">Add a new payment method (e.g., a card) for the user.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default">
                                            <a href="#payments-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default">Set a payment method as the user's default.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-DELETEapi-v1-payment-payment-methods--paymentMethod-">
                                            <a href="#payments-DELETEapi-v1-payment-payment-methods--paymentMethod-">Delete a payment method.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-DELETEapi-v1-payment-payment-methods">
                                            <a href="#payments-DELETEapi-v1-payment-payment-methods">Delete all payment methods for the user.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-payment-methods-setup-intent">
                                            <a href="#payments-POSTapi-v1-payment-payment-methods-setup-intent">Create a SetupIntent to securely collect payment method details on the frontend.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-payment-methods-setup-session">
                                            <a href="#payments-POSTapi-v1-payment-payment-methods-setup-session">Create a Checkout Session in 'setup' mode to generate a shareable link
for users to add a payment method on a Stripe-hosted page.</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="payments-billing-portal-access-stripe-hosted-customer-billing-portal">
                                <a href="#payments-billing-portal-access-stripe-hosted-customer-billing-portal">Billing Portal
Access Stripe-hosted customer billing portal.</a>
                            </li>
                                                            <ul id="tocify-subheader-payments-billing-portal-access-stripe-hosted-customer-billing-portal" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="payments-POSTapi-v1-payment-billing-portal">
                                            <a href="#payments-POSTapi-v1-payment-billing-portal">Create a new billing portal session for the authenticated user.</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-kyc-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-kyc-management">
                    <a href="#admin-kyc-management">Admin KYC Management</a>
                </li>
                                    <ul id="tocify-subheader-admin-kyc-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-kyc-management-GETapi-v1-admin-kyc-pending">
                                <a href="#admin-kyc-management-GETapi-v1-admin-kyc-pending">List pending KYCs</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-kyc-management-GETapi-v1-admin-kyc--userId--documents">
                                <a href="#admin-kyc-management-GETapi-v1-admin-kyc--userId--documents">Get user KYC documents</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-kyc-management-POSTapi-v1-admin-kyc--userId--approve">
                                <a href="#admin-kyc-management-POSTapi-v1-admin-kyc--userId--approve">Approve KYC</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-kyc-management-POSTapi-v1-admin-kyc--userId--reject">
                                <a href="#admin-kyc-management-POSTapi-v1-admin-kyc--userId--reject">Reject KYC</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-listings-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-listings-management">
                    <a href="#admin-listings-management">Admin Listings Management</a>
                </li>
                                    <ul id="tocify-subheader-admin-listings-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-listings-management-GETapi-v1-admin-listings">
                                <a href="#admin-listings-management-GETapi-v1-admin-listings">List all listings</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-listings-management-GETapi-v1-admin-listings--id-">
                                <a href="#admin-listings-management-GETapi-v1-admin-listings--id-">Get listing details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-listings-management-PATCHapi-v1-admin-listings--id-">
                                <a href="#admin-listings-management-PATCHapi-v1-admin-listings--id-">Update listing details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-listings-management-PATCHapi-v1-admin-listings--id--status">
                                <a href="#admin-listings-management-PATCHapi-v1-admin-listings--id--status">Update listing status</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-users-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-users-management">
                    <a href="#admin-users-management">Admin Users Management</a>
                </li>
                                    <ul id="tocify-subheader-admin-users-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-users-management-GETapi-v1-admin-users">
                                <a href="#admin-users-management-GETapi-v1-admin-users">List all users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-users-management-GETapi-v1-admin-users--id--history">
                                <a href="#admin-users-management-GETapi-v1-admin-users--id--history">Get user history</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-users-management-PATCHapi-v1-admin-users--id--standing">
                                <a href="#admin-users-management-PATCHapi-v1-admin-users--id--standing">Update user account standing</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-general" class="tocify-header">
                <li class="tocify-item level-1" data-unique="general">
                    <a href="#general">General</a>
                </li>
                                    <ul id="tocify-subheader-general" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="general-GETapi-v1--fallbackPlaceholder-">
                                <a href="#general-GETapi-v1--fallbackPlaceholder-">GET api/v1/{fallbackPlaceholder}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-listings-public-user" class="tocify-header">
                <li class="tocify-item level-1" data-unique="listings-public-user">
                    <a href="#listings-public-user">Listings (Public & User)</a>
                </li>
                                    <ul id="tocify-subheader-listings-public-user" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="listings-public-user-GETapi-v1-listings">
                                <a href="#listings-public-user-GETapi-v1-listings">Public Market Listings</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="listings-public-user-GETapi-v1-listings--id-">
                                <a href="#listings-public-user-GETapi-v1-listings--id-">Show Public Listing</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="listings-public-user-POSTapi-v1-listings">
                                <a href="#listings-public-user-POSTapi-v1-listings">Create Listing</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="listings-public-user-POSTapi-v1-listings--id-">
                                <a href="#listings-public-user-POSTapi-v1-listings--id-">Update Listing</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="listings-public-user-GETapi-v1-user-listings">
                                <a href="#listings-public-user-GETapi-v1-user-listings">My Portfolio</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-notifications" class="tocify-header">
                <li class="tocify-item level-1" data-unique="notifications">
                    <a href="#notifications">Notifications</a>
                </li>
                                    <ul id="tocify-subheader-notifications" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="notifications-GETapi-v1-notifications">
                                <a href="#notifications-GETapi-v1-notifications">List Notifications</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-GETapi-v1-notifications-stats">
                                <a href="#notifications-GETapi-v1-notifications-stats">Get Notification Stats</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-POSTapi-v1-notifications--notification_id--mark-as-read">
                                <a href="#notifications-POSTapi-v1-notifications--notification_id--mark-as-read">Mark as Read</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-POSTapi-v1-notifications-mark-all-as-read">
                                <a href="#notifications-POSTapi-v1-notifications-mark-all-as-read">Mark All as Read</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-DELETEapi-v1-notifications--id-">
                                <a href="#notifications-DELETEapi-v1-notifications--id-">Delete Notification</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-user-dealer-kyc" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-dealer-kyc">
                    <a href="#user-dealer-kyc">User & Dealer KYC</a>
                </li>
                                    <ul id="tocify-subheader-user-dealer-kyc" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="user-dealer-kyc-POSTapi-v1-kyc-submit">
                                <a href="#user-dealer-kyc-POSTapi-v1-kyc-submit">Submit KYC</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-dealer-kyc-GETapi-v1-kyc-status">
                                <a href="#user-dealer-kyc-GETapi-v1-kyc-status">Check KYC Status</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: August 2, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Backend API for Patina - Luxury Watch Marketplace.</p>
<aside>
    <strong>Base URL</strong>: <code>http://10.10.28.53:81</code>
</aside>
<p><strong>Welcome to the Patina API Documentation.</strong></p>
<p>This backend provides endpoints for: <strong>Authentication</strong>, <strong>User &amp; Dealer KYC</strong>, <strong>Watch Listings Management</strong>, <strong>Realtime Chat</strong>, and <strong>Secure Escrow Transactions</strong>.</p>
<h3 id="auth-quick-start">Auth Quick Start</h3>
<ol>
<li>Register/Login to obtain a Bearer token.</li>
<li>Add header: <code>Authorization: Bearer YOUR_TOKEN</code>.</li>
<li>Use this token to authenticate requests requiring user or admin privileges.</li>
</ol>
<h3 id="overview">Overview</h3>
<p>This documentation lists all available API endpoints, their expected request parameters, and response structures. Use the &quot;Try it out&quot; feature to test APIs directly from this page.</p>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer Bearer {YOUR_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Login to obtain a personal access token. Include it in every protected request as: <code>Authorization: Bearer YOUR_TOKEN</code>. Public endpoints are explicitly marked.</p>

        <h1 id="authentication">Authentication</h1>

    <p>Endpoints for user registration, login and logout.</p>

                                <h2 id="authentication-POSTapi-v1-auth-register">Register User</h2>

<p>
</p>

<p>Register a new user account.</p>

<span id="example-requests-POSTapi-v1-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"email\": \"zbailey@example.net\",
    \"password\": \"-0pBNvYgxw\",
    \"phone_number\": \"aykcmyuwpwlvqwrs\",
    \"company_name\": \"i\",
    \"fcm_token\": \"architecto\",
    \"password_confirmation\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "email": "zbailey@example.net",
    "password": "-0pBNvYgxw",
    "phone_number": "aykcmyuwpwlvqwrs",
    "company_name": "i",
    "fcm_token": "architecto",
    "password_confirmation": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/auth/register';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'b',
            'email' =&gt; 'zbailey@example.net',
            'password' =&gt; '-0pBNvYgxw',
            'phone_number' =&gt; 'aykcmyuwpwlvqwrs',
            'company_name' =&gt; 'i',
            'fcm_token' =&gt; 'architecto',
            'password_confirmation' =&gt; 'password',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/auth/register'
payload = {
    "name": "b",
    "email": "zbailey@example.net",
    "password": "-0pBNvYgxw",
    "phone_number": "aykcmyuwpwlvqwrs",
    "company_name": "i",
    "fcm_token": "architecto",
    "password_confirmation": "password"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-register">
</span>
<span id="execution-results-POSTapi-v1-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-register" data-method="POST"
      data-path="api/v1/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-register"
                    onclick="tryItOut('POSTapi-v1-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-register"
                    onclick="cancelTryOut('POSTapi-v1-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-auth-register"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-register"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-register"
               value="-0pBNvYgxw"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>-0pBNvYgxw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="POSTapi-v1-auth-register"
               value="aykcmyuwpwlvqwrs"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>aykcmyuwpwlvqwrs</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>company_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="company_name"                data-endpoint="POSTapi-v1-auth-register"
               value="i"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>i</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fcm_token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="fcm_token"                data-endpoint="POSTapi-v1-auth-register"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-v1-auth-register"
               value="password"
               data-component="body">
    <br>
<p>The password confirmation. Example: <code>password</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-login">User Login</h2>

<p>
</p>

<p>Authenticate a user and return a token.</p>

<span id="example-requests-POSTapi-v1-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"user@example.com\",
    \"password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "user@example.com",
    "password": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/auth/login';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'user@example.com',
            'password' =&gt; 'password',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/auth/login'
payload = {
    "email": "user@example.com",
    "password": "password"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-login">
</span>
<span id="execution-results-POSTapi-v1-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-login" data-method="POST"
      data-path="api/v1/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-login"
                    onclick="tryItOut('POSTapi-v1-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-login"
                    onclick="cancelTryOut('POSTapi-v1-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-login"
               value="user@example.com"
               data-component="body">
    <br>
<p>The email of the user. Example: <code>user@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-login"
               value="password"
               data-component="body">
    <br>
<p>The password of the user. Example: <code>password</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-logout">User Logout</h2>

<p>
</p>

<p>Logout the authenticated user and invalidate the token.</p>

<span id="example-requests-POSTapi-v1-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/auth/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/auth/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/auth/logout';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/auth/logout'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-logout">
</span>
<span id="execution-results-POSTapi-v1-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-logout" data-method="POST"
      data-path="api/v1/auth/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-logout"
                    onclick="tryItOut('POSTapi-v1-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-logout"
                    onclick="cancelTryOut('POSTapi-v1-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                                <h2 id="authentication-verification-email-verification-resend-endpoints">Verification
Email verification &amp; resend endpoints.</h2>
                                                    <h2 id="authentication-POSTapi-v1-auth-verify">POST api/v1/auth/verify</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-verify">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/auth/verify" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"otp\": 4326.41688,
    \"token\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/auth/verify"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "otp": 4326.41688,
    "token": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/auth/verify';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'gbailey@example.net',
            'otp' =&gt; 4326.41688,
            'token' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/auth/verify'
payload = {
    "email": "gbailey@example.net",
    "otp": 4326.41688,
    "token": "architecto"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-verify">
</span>
<span id="execution-results-POSTapi-v1-auth-verify" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-verify"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-verify"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-verify" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-verify">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-verify" data-method="POST"
      data-path="api/v1/auth/verify"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-verify', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-verify"
                    onclick="tryItOut('POSTapi-v1-auth-verify');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-verify"
                    onclick="cancelTryOut('POSTapi-v1-auth-verify');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-verify"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/verify</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-verify"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. The <code>email</code> of an existing record in the users table. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>otp</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="otp"                data-endpoint="POSTapi-v1-auth-verify"
               value="4326.41688"
               data-component="body">
    <br>
<p>This field is required when <code>token</code> is not present. Example: <code>4326.41688</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-v1-auth-verify"
               value="architecto"
               data-component="body">
    <br>
<p>This field is required when <code>otp</code> is not present. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-resend-verification">POST api/v1/auth/resend-verification</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-resend-verification">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/auth/resend-verification" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/auth/resend-verification"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/auth/resend-verification';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'gbailey@example.net',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/auth/resend-verification'
payload = {
    "email": "gbailey@example.net"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-resend-verification">
</span>
<span id="execution-results-POSTapi-v1-auth-resend-verification" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-resend-verification"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-resend-verification"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-resend-verification" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-resend-verification">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-resend-verification" data-method="POST"
      data-path="api/v1/auth/resend-verification"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-resend-verification', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-resend-verification"
                    onclick="tryItOut('POSTapi-v1-auth-resend-verification');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-resend-verification"
                    onclick="cancelTryOut('POSTapi-v1-auth-resend-verification');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-resend-verification"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/resend-verification</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-resend-verification"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-resend-verification"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-resend-verification"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. The <code>email</code> of an existing record in the users table. Example: <code>gbailey@example.net</code></p>
        </div>
        </form>

                                <h2 id="authentication-password-password-reset-update-endpoints">Password
Password reset &amp; update endpoints.</h2>
                                                    <h2 id="authentication-POSTapi-v1-auth-forgot-password">POST api/v1/auth/forgot-password</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-forgot-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/auth/forgot-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/auth/forgot-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/auth/forgot-password';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'gbailey@example.net',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/auth/forgot-password'
payload = {
    "email": "gbailey@example.net"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-forgot-password">
</span>
<span id="execution-results-POSTapi-v1-auth-forgot-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-forgot-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-forgot-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-forgot-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-forgot-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-forgot-password" data-method="POST"
      data-path="api/v1/auth/forgot-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-forgot-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-forgot-password"
                    onclick="tryItOut('POSTapi-v1-auth-forgot-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-forgot-password"
                    onclick="cancelTryOut('POSTapi-v1-auth-forgot-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-forgot-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/forgot-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-forgot-password"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. The <code>email</code> of an existing record in the users table. Example: <code>gbailey@example.net</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-verify-password-otp">POST api/v1/auth/verify-password-otp</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-verify-password-otp">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/auth/verify-password-otp" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"otp\": 4326.41688
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/auth/verify-password-otp"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "otp": 4326.41688
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/auth/verify-password-otp';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'gbailey@example.net',
            'otp' =&gt; 4326.41688,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/auth/verify-password-otp'
payload = {
    "email": "gbailey@example.net",
    "otp": 4326.41688
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-verify-password-otp">
</span>
<span id="execution-results-POSTapi-v1-auth-verify-password-otp" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-verify-password-otp"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-verify-password-otp"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-verify-password-otp" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-verify-password-otp">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-verify-password-otp" data-method="POST"
      data-path="api/v1/auth/verify-password-otp"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-verify-password-otp', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-verify-password-otp"
                    onclick="tryItOut('POSTapi-v1-auth-verify-password-otp');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-verify-password-otp"
                    onclick="cancelTryOut('POSTapi-v1-auth-verify-password-otp');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-verify-password-otp"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/verify-password-otp</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-verify-password-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-verify-password-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-verify-password-otp"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. The <code>email</code> of an existing record in the users table. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>otp</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="otp"                data-endpoint="POSTapi-v1-auth-verify-password-otp"
               value="4326.41688"
               data-component="body">
    <br>
<p>Example: <code>4326.41688</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-reset-password-with-token">POST api/v1/auth/reset-password-with-token</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-reset-password-with-token">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/auth/reset-password-with-token" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"reset_token\": \"architecto\",
    \"password\": \"]|{+-0pBNvYg\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/auth/reset-password-with-token"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "reset_token": "architecto",
    "password": "]|{+-0pBNvYg"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/auth/reset-password-with-token';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'gbailey@example.net',
            'reset_token' =&gt; 'architecto',
            'password' =&gt; ']|{+-0pBNvYg',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/auth/reset-password-with-token'
payload = {
    "email": "gbailey@example.net",
    "reset_token": "architecto",
    "password": "]|{+-0pBNvYg"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-reset-password-with-token">
</span>
<span id="execution-results-POSTapi-v1-auth-reset-password-with-token" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-reset-password-with-token"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-reset-password-with-token"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-reset-password-with-token" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-reset-password-with-token">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-reset-password-with-token" data-method="POST"
      data-path="api/v1/auth/reset-password-with-token"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-reset-password-with-token', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-reset-password-with-token"
                    onclick="tryItOut('POSTapi-v1-auth-reset-password-with-token');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-reset-password-with-token"
                    onclick="cancelTryOut('POSTapi-v1-auth-reset-password-with-token');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-reset-password-with-token"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/reset-password-with-token</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-reset-password-with-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-reset-password-with-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-reset-password-with-token"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. The <code>email</code> of an existing record in the users table. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reset_token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reset_token"                data-endpoint="POSTapi-v1-auth-reset-password-with-token"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-reset-password-with-token"
               value="]|{+-0pBNvYg"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>]|{+-0pBNvYg</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-update-password">POST api/v1/auth/update-password</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-update-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/auth/update-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"current_password\": \"architecto\",
    \"new_password\": \"ngzmiyvdljnikhwaykcmyuwpwl\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/auth/update-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "current_password": "architecto",
    "new_password": "ngzmiyvdljnikhwaykcmyuwpwl"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/auth/update-password';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'current_password' =&gt; 'architecto',
            'new_password' =&gt; 'ngzmiyvdljnikhwaykcmyuwpwl',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/auth/update-password'
payload = {
    "current_password": "architecto",
    "new_password": "ngzmiyvdljnikhwaykcmyuwpwl"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-update-password">
</span>
<span id="execution-results-POSTapi-v1-auth-update-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-update-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-update-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-update-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-update-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-update-password" data-method="POST"
      data-path="api/v1/auth/update-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-update-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-update-password"
                    onclick="tryItOut('POSTapi-v1-auth-update-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-update-password"
                    onclick="cancelTryOut('POSTapi-v1-auth-update-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-update-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/update-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-update-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-update-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>current_password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="current_password"                data-endpoint="POSTapi-v1-auth-update-password"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>new_password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="new_password"                data-endpoint="POSTapi-v1-auth-update-password"
               value="ngzmiyvdljnikhwaykcmyuwpwl"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>ngzmiyvdljnikhwaykcmyuwpwl</code></p>
        </div>
        </form>

                <h1 id="profile">Profile</h1>

    <p>Manage the authenticated user's profile information.</p>

                                <h2 id="profile-GETapi-v1-profile-me">GET api/v1/profile/me</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-profile-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/profile/me" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/profile/me"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/profile/me';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/profile/me'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-profile-me">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;ok&quot;: false,
    &quot;message&quot;: &quot;Unauthenticated. Please login to continue.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-profile-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-profile-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-profile-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-profile-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-profile-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-profile-me" data-method="GET"
      data-path="api/v1/profile/me"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-profile-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-profile-me"
                    onclick="tryItOut('GETapi-v1-profile-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-profile-me"
                    onclick="cancelTryOut('GETapi-v1-profile-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-profile-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/profile/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-profile-me"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-profile-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-profile-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="chat">Chat</h1>

    

                        <h2 id="chat-conversations-list-create-11-or-group-conversations">Conversations
List &amp; create 1:1 or group conversations.</h2>
                                                    <h2 id="chat-GETapi-v1-chat-conversations">GET api/v1/chat/conversations</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-chat-conversations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/chat/conversations" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/conversations"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/conversations';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/conversations'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-chat-conversations">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;ok&quot;: false,
    &quot;message&quot;: &quot;Unauthenticated. Please login to continue.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-chat-conversations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-chat-conversations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-chat-conversations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-chat-conversations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-chat-conversations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-chat-conversations" data-method="GET"
      data-path="api/v1/chat/conversations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-chat-conversations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-chat-conversations"
                    onclick="tryItOut('GETapi-v1-chat-conversations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-chat-conversations"
                    onclick="cancelTryOut('GETapi-v1-chat-conversations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-chat-conversations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/chat/conversations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-chat-conversations"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-chat-conversations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-chat-conversations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="chat-POSTapi-v1-chat-conversations">POST api/v1/chat/conversations</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-chat-conversations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/chat/conversations" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/conversations"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/conversations';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'b',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/conversations'
payload = {
    "name": "b"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-chat-conversations">
</span>
<span id="execution-results-POSTapi-v1-chat-conversations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-chat-conversations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-chat-conversations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-chat-conversations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-chat-conversations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-chat-conversations" data-method="POST"
      data-path="api/v1/chat/conversations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-chat-conversations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-chat-conversations"
                    onclick="tryItOut('POSTapi-v1-chat-conversations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-chat-conversations"
                    onclick="cancelTryOut('POSTapi-v1-chat-conversations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-chat-conversations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/chat/conversations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-chat-conversations"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-chat-conversations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-chat-conversations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_ids[0]"                data-endpoint="POSTapi-v1-chat-conversations"
               data-component="body">
        <input type="text" style="display: none"
               name="user_ids[1]"                data-endpoint="POSTapi-v1-chat-conversations"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-chat-conversations"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
        </form>

                                <h2 id="chat-messages-conversation-message-retrieval-creation-editing-deletion-typing-indicators-and-read-receipts">Messages
Conversation message retrieval, creation, editing, deletion, typing indicators and read receipts.</h2>
                                                    <h2 id="chat-GETapi-v1-chat-conversations--conversation_id--messages">GET api/v1/chat/conversations/{conversation_id}/messages</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-chat-conversations--conversation_id--messages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/chat/conversations/16/messages" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/conversations/16/messages"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/conversations/16/messages';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/conversations/16/messages'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-chat-conversations--conversation_id--messages">
    </span>
<span id="execution-results-GETapi-v1-chat-conversations--conversation_id--messages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-chat-conversations--conversation_id--messages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-chat-conversations--conversation_id--messages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-chat-conversations--conversation_id--messages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-chat-conversations--conversation_id--messages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-chat-conversations--conversation_id--messages" data-method="GET"
      data-path="api/v1/chat/conversations/{conversation_id}/messages"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-chat-conversations--conversation_id--messages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-chat-conversations--conversation_id--messages"
                    onclick="tryItOut('GETapi-v1-chat-conversations--conversation_id--messages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-chat-conversations--conversation_id--messages"
                    onclick="cancelTryOut('GETapi-v1-chat-conversations--conversation_id--messages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-chat-conversations--conversation_id--messages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/chat/conversations/{conversation_id}/messages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-chat-conversations--conversation_id--messages"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-chat-conversations--conversation_id--messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-chat-conversations--conversation_id--messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="conversation_id"                data-endpoint="GETapi-v1-chat-conversations--conversation_id--messages"
               value="16"
               data-component="url">
    <br>
<p>The ID of the conversation. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="chat-POSTapi-v1-chat-messages">POST api/v1/chat/messages</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-chat-messages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/chat/messages" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "conversation_id=architecto"\
    --form "body=architecto"\
    --form "media=@/tmp/php5rvk9utrte2k8cjmfbA" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/messages"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('conversation_id', 'architecto');
body.append('body', 'architecto');
body.append('media', document.querySelector('input[name="media"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/messages';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'conversation_id',
                'contents' =&gt; 'architecto'
            ],
            [
                'name' =&gt; 'body',
                'contents' =&gt; 'architecto'
            ],
            [
                'name' =&gt; 'media',
                'contents' =&gt; fopen('/tmp/php5rvk9utrte2k8cjmfbA', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/messages'
files = {
  'conversation_id': (None, 'architecto'),
  'body': (None, 'architecto'),
  'media': open('/tmp/php5rvk9utrte2k8cjmfbA', 'rb')}
payload = {
    "conversation_id": "architecto",
    "body": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'multipart/form-data',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, files=files)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-chat-messages">
</span>
<span id="execution-results-POSTapi-v1-chat-messages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-chat-messages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-chat-messages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-chat-messages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-chat-messages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-chat-messages" data-method="POST"
      data-path="api/v1/chat/messages"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-chat-messages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-chat-messages"
                    onclick="tryItOut('POSTapi-v1-chat-messages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-chat-messages"
                    onclick="cancelTryOut('POSTapi-v1-chat-messages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-chat-messages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/chat/messages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-chat-messages"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-chat-messages"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-chat-messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="conversation_id"                data-endpoint="POSTapi-v1-chat-messages"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the conversations table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>body</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="body"                data-endpoint="POSTapi-v1-chat-messages"
               value="architecto"
               data-component="body">
    <br>
<p>This field is required when <code>media</code> is not present. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>media</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="media"                data-endpoint="POSTapi-v1-chat-messages"
               value=""
               data-component="body">
    <br>
<p>This field is required when <code>body</code> is not present. Must be a file. Must not be greater than 10240 kilobytes. Example: <code>/tmp/php5rvk9utrte2k8cjmfbA</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="parent_id"                data-endpoint="POSTapi-v1-chat-messages"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the messages table.</p>
        </div>
        </form>

                    <h2 id="chat-PATCHapi-v1-chat-messages--id-">update a message</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-v1-chat-messages--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://10.10.28.53:81/api/v1/chat/messages/16" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"body\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/messages/16"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "body": "architecto"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/messages/16';
$response = $client-&gt;patch(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'body' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/messages/16'
payload = {
    "body": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PATCHapi-v1-chat-messages--id-">
</span>
<span id="execution-results-PATCHapi-v1-chat-messages--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-chat-messages--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-chat-messages--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-chat-messages--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-chat-messages--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-v1-chat-messages--id-" data-method="PATCH"
      data-path="api/v1/chat/messages/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-chat-messages--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-chat-messages--id-"
                    onclick="tryItOut('PATCHapi-v1-chat-messages--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-chat-messages--id-"
                    onclick="cancelTryOut('PATCHapi-v1-chat-messages--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-chat-messages--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/chat/messages/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-v1-chat-messages--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-v1-chat-messages--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-v1-chat-messages--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PATCHapi-v1-chat-messages--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the message. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>body</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="body"                data-endpoint="PATCHapi-v1-chat-messages--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="chat-DELETEapi-v1-chat-messages--id-">delete a message (soft delete)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-chat-messages--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://10.10.28.53:81/api/v1/chat/messages/16" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/messages/16"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/messages/16';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/messages/16'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-chat-messages--id-">
</span>
<span id="execution-results-DELETEapi-v1-chat-messages--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-chat-messages--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-chat-messages--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-chat-messages--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-chat-messages--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-chat-messages--id-" data-method="DELETE"
      data-path="api/v1/chat/messages/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-chat-messages--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-chat-messages--id-"
                    onclick="tryItOut('DELETEapi-v1-chat-messages--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-chat-messages--id-"
                    onclick="cancelTryOut('DELETEapi-v1-chat-messages--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-chat-messages--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/chat/messages/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-chat-messages--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-chat-messages--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-chat-messages--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-chat-messages--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the message. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="chat-POSTapi-v1-chat-messages-read">POST api/v1/chat/messages/read</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-chat-messages-read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/chat/messages/read" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/messages/read"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/messages/read';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/messages/read'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-chat-messages-read">
</span>
<span id="execution-results-POSTapi-v1-chat-messages-read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-chat-messages-read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-chat-messages-read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-chat-messages-read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-chat-messages-read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-chat-messages-read" data-method="POST"
      data-path="api/v1/chat/messages/read"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-chat-messages-read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-chat-messages-read"
                    onclick="tryItOut('POSTapi-v1-chat-messages-read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-chat-messages-read"
                    onclick="cancelTryOut('POSTapi-v1-chat-messages-read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-chat-messages-read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/chat/messages/read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-chat-messages-read"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-chat-messages-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-chat-messages-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="chat-POSTapi-v1-chat-conversations--conversation--typing">broadcast typing indicator</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-chat-conversations--conversation--typing">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/chat/conversations/16/typing" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"conversation_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/conversations/16/typing"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "conversation_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/conversations/16/typing';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'conversation_id' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/conversations/16/typing'
payload = {
    "conversation_id": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-chat-conversations--conversation--typing">
</span>
<span id="execution-results-POSTapi-v1-chat-conversations--conversation--typing" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-chat-conversations--conversation--typing"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-chat-conversations--conversation--typing"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-chat-conversations--conversation--typing" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-chat-conversations--conversation--typing">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-chat-conversations--conversation--typing" data-method="POST"
      data-path="api/v1/chat/conversations/{conversation}/typing"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-chat-conversations--conversation--typing', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-chat-conversations--conversation--typing"
                    onclick="tryItOut('POSTapi-v1-chat-conversations--conversation--typing');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-chat-conversations--conversation--typing"
                    onclick="cancelTryOut('POSTapi-v1-chat-conversations--conversation--typing');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-chat-conversations--conversation--typing"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/chat/conversations/{conversation}/typing</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-chat-conversations--conversation--typing"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-chat-conversations--conversation--typing"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-chat-conversations--conversation--typing"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>conversation</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="conversation"                data-endpoint="POSTapi-v1-chat-conversations--conversation--typing"
               value="16"
               data-component="url">
    <br>
<p>The conversation. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="conversation_id"                data-endpoint="POSTapi-v1-chat-conversations--conversation--typing"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the conversations table. Example: <code>architecto</code></p>
        </div>
        </form>

                                <h2 id="chat-groups-manage-group-membership-roles">Groups
Manage group membership &amp; roles.</h2>
                                                    <h2 id="chat-POSTapi-v1-chat-groups--conversation_id--members">add group members</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-chat-groups--conversation_id--members">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/chat/groups/16/members" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/groups/16/members"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/groups/16/members';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/groups/16/members'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-chat-groups--conversation_id--members">
</span>
<span id="execution-results-POSTapi-v1-chat-groups--conversation_id--members" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-chat-groups--conversation_id--members"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-chat-groups--conversation_id--members"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-chat-groups--conversation_id--members" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-chat-groups--conversation_id--members">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-chat-groups--conversation_id--members" data-method="POST"
      data-path="api/v1/chat/groups/{conversation_id}/members"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-chat-groups--conversation_id--members', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-chat-groups--conversation_id--members"
                    onclick="tryItOut('POSTapi-v1-chat-groups--conversation_id--members');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-chat-groups--conversation_id--members"
                    onclick="cancelTryOut('POSTapi-v1-chat-groups--conversation_id--members');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-chat-groups--conversation_id--members"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/chat/groups/{conversation_id}/members</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-chat-groups--conversation_id--members"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--members"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--members"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="conversation_id"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--members"
               value="16"
               data-component="url">
    <br>
<p>The ID of the conversation. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_ids[0]"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--members"
               data-component="body">
        <input type="text" style="display: none"
               name="user_ids[1]"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--members"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table.</p>
        </div>
        </form>

                    <h2 id="chat-DELETEapi-v1-chat-groups--conversation_id--members">remove group member</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-chat-groups--conversation_id--members">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://10.10.28.53:81/api/v1/chat/groups/16/members" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"user_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/groups/16/members"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": "architecto"
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/groups/16/members';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'user_id' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/groups/16/members'
payload = {
    "user_id": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-chat-groups--conversation_id--members">
</span>
<span id="execution-results-DELETEapi-v1-chat-groups--conversation_id--members" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-chat-groups--conversation_id--members"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-chat-groups--conversation_id--members"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-chat-groups--conversation_id--members" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-chat-groups--conversation_id--members">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-chat-groups--conversation_id--members" data-method="DELETE"
      data-path="api/v1/chat/groups/{conversation_id}/members"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-chat-groups--conversation_id--members', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-chat-groups--conversation_id--members"
                    onclick="tryItOut('DELETEapi-v1-chat-groups--conversation_id--members');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-chat-groups--conversation_id--members"
                    onclick="cancelTryOut('DELETEapi-v1-chat-groups--conversation_id--members');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-chat-groups--conversation_id--members"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/chat/groups/{conversation_id}/members</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-chat-groups--conversation_id--members"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-chat-groups--conversation_id--members"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-chat-groups--conversation_id--members"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="conversation_id"                data-endpoint="DELETEapi-v1-chat-groups--conversation_id--members"
               value="16"
               data-component="url">
    <br>
<p>The ID of the conversation. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="DELETEapi-v1-chat-groups--conversation_id--members"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="chat-POSTapi-v1-chat-groups--conversation_id--leave">leave group</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-chat-groups--conversation_id--leave">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/chat/groups/16/leave" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/groups/16/leave"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/groups/16/leave';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/groups/16/leave'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-chat-groups--conversation_id--leave">
</span>
<span id="execution-results-POSTapi-v1-chat-groups--conversation_id--leave" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-chat-groups--conversation_id--leave"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-chat-groups--conversation_id--leave"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-chat-groups--conversation_id--leave" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-chat-groups--conversation_id--leave">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-chat-groups--conversation_id--leave" data-method="POST"
      data-path="api/v1/chat/groups/{conversation_id}/leave"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-chat-groups--conversation_id--leave', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-chat-groups--conversation_id--leave"
                    onclick="tryItOut('POSTapi-v1-chat-groups--conversation_id--leave');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-chat-groups--conversation_id--leave"
                    onclick="cancelTryOut('POSTapi-v1-chat-groups--conversation_id--leave');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-chat-groups--conversation_id--leave"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/chat/groups/{conversation_id}/leave</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-chat-groups--conversation_id--leave"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--leave"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--leave"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="conversation_id"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--leave"
               value="16"
               data-component="url">
    <br>
<p>The ID of the conversation. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="chat-POSTapi-v1-chat-groups--conversation_id--promote">promote a member to admin</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-chat-groups--conversation_id--promote">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/chat/groups/16/promote" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"user_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/groups/16/promote"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/groups/16/promote';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'user_id' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/groups/16/promote'
payload = {
    "user_id": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-chat-groups--conversation_id--promote">
</span>
<span id="execution-results-POSTapi-v1-chat-groups--conversation_id--promote" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-chat-groups--conversation_id--promote"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-chat-groups--conversation_id--promote"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-chat-groups--conversation_id--promote" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-chat-groups--conversation_id--promote">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-chat-groups--conversation_id--promote" data-method="POST"
      data-path="api/v1/chat/groups/{conversation_id}/promote"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-chat-groups--conversation_id--promote', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-chat-groups--conversation_id--promote"
                    onclick="tryItOut('POSTapi-v1-chat-groups--conversation_id--promote');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-chat-groups--conversation_id--promote"
                    onclick="cancelTryOut('POSTapi-v1-chat-groups--conversation_id--promote');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-chat-groups--conversation_id--promote"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/chat/groups/{conversation_id}/promote</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-chat-groups--conversation_id--promote"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--promote"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--promote"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="conversation_id"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--promote"
               value="16"
               data-component="url">
    <br>
<p>The ID of the conversation. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--promote"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="chat-POSTapi-v1-chat-groups--conversation_id--demote">demote an admin to member</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-chat-groups--conversation_id--demote">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/chat/groups/16/demote" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"user_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/chat/groups/16/demote"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/chat/groups/16/demote';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'user_id' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/chat/groups/16/demote'
payload = {
    "user_id": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-chat-groups--conversation_id--demote">
</span>
<span id="execution-results-POSTapi-v1-chat-groups--conversation_id--demote" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-chat-groups--conversation_id--demote"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-chat-groups--conversation_id--demote"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-chat-groups--conversation_id--demote" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-chat-groups--conversation_id--demote">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-chat-groups--conversation_id--demote" data-method="POST"
      data-path="api/v1/chat/groups/{conversation_id}/demote"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-chat-groups--conversation_id--demote', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-chat-groups--conversation_id--demote"
                    onclick="tryItOut('POSTapi-v1-chat-groups--conversation_id--demote');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-chat-groups--conversation_id--demote"
                    onclick="cancelTryOut('POSTapi-v1-chat-groups--conversation_id--demote');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-chat-groups--conversation_id--demote"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/chat/groups/{conversation_id}/demote</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-chat-groups--conversation_id--demote"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--demote"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--demote"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>conversation_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="conversation_id"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--demote"
               value="16"
               data-component="url">
    <br>
<p>The ID of the conversation. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="POSTapi-v1-chat-groups--conversation_id--demote"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>architecto</code></p>
        </div>
        </form>

                <h1 id="payments">Payments</h1>

    

                        <h2 id="payments-one-time-charges-create-one-off-payments-via-paymentintent-or-checkout-session">One-Time Charges
Create one-off payments via PaymentIntent or Checkout Session.</h2>
                                                    <h2 id="payments-POSTapi-v1-payment-one-time-checkout-session">Create a Stripe Checkout Session for one-time payment.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Use this to redirect the user to a Stripe-hosted payment page.</p>

<span id="example-requests-POSTapi-v1-payment-one-time-checkout-session">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/one-time/checkout-session" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"amount\": 95,
    \"currency\": \"ngz\",
    \"description\": \"Velit et fugiat sunt nihil accusantium.\",
    \"payable_type\": \"architecto\",
    \"payable_id\": 16
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/one-time/checkout-session"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": 95,
    "currency": "ngz",
    "description": "Velit et fugiat sunt nihil accusantium.",
    "payable_type": "architecto",
    "payable_id": 16
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/one-time/checkout-session';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'amount' =&gt; 95,
            'currency' =&gt; 'ngz',
            'description' =&gt; 'Velit et fugiat sunt nihil accusantium.',
            'payable_type' =&gt; 'architecto',
            'payable_id' =&gt; 16,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/one-time/checkout-session'
payload = {
    "amount": 95,
    "currency": "ngz",
    "description": "Velit et fugiat sunt nihil accusantium.",
    "payable_type": "architecto",
    "payable_id": 16
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-one-time-checkout-session">
</span>
<span id="execution-results-POSTapi-v1-payment-one-time-checkout-session" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-one-time-checkout-session"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-one-time-checkout-session"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-one-time-checkout-session" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-one-time-checkout-session">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-one-time-checkout-session" data-method="POST"
      data-path="api/v1/payment/one-time/checkout-session"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-one-time-checkout-session', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-one-time-checkout-session"
                    onclick="tryItOut('POSTapi-v1-payment-one-time-checkout-session');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-one-time-checkout-session"
                    onclick="cancelTryOut('POSTapi-v1-payment-one-time-checkout-session');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-one-time-checkout-session"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/one-time/checkout-session</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-one-time-checkout-session"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-one-time-checkout-session"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-one-time-checkout-session"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="POSTapi-v1-payment-one-time-checkout-session"
               value="95"
               data-component="body">
    <br>
<p>Must be at least 100. Example: <code>95</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="currency"                data-endpoint="POSTapi-v1-payment-one-time-checkout-session"
               value="ngz"
               data-component="body">
    <br>
<p>Must be 3 characters. Example: <code>ngz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-payment-one-time-checkout-session"
               value="Velit et fugiat sunt nihil accusantium."
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>Velit et fugiat sunt nihil accusantium.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payable_type"                data-endpoint="POSTapi-v1-payment-one-time-checkout-session"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payable_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="payable_id"                data-endpoint="POSTapi-v1-payment-one-time-checkout-session"
               value="16"
               data-component="body">
    <br>
<p>Example: <code>16</code></p>
        </div>
        </form>

                    <h2 id="payments-POSTapi-v1-payment-one-time-payment-intent">Create a PaymentIntent for use with frontend card elements (e.g., Stripe.js).</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-one-time-payment-intent">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/one-time/payment-intent" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"amount\": 95,
    \"currency\": \"ngz\",
    \"payable_type\": \"architecto\",
    \"payable_id\": 16,
    \"payment_method_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/one-time/payment-intent"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": 95,
    "currency": "ngz",
    "payable_type": "architecto",
    "payable_id": 16,
    "payment_method_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/one-time/payment-intent';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'amount' =&gt; 95,
            'currency' =&gt; 'ngz',
            'payable_type' =&gt; 'architecto',
            'payable_id' =&gt; 16,
            'payment_method_id' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/one-time/payment-intent'
payload = {
    "amount": 95,
    "currency": "ngz",
    "payable_type": "architecto",
    "payable_id": 16,
    "payment_method_id": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-one-time-payment-intent">
</span>
<span id="execution-results-POSTapi-v1-payment-one-time-payment-intent" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-one-time-payment-intent"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-one-time-payment-intent"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-one-time-payment-intent" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-one-time-payment-intent">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-one-time-payment-intent" data-method="POST"
      data-path="api/v1/payment/one-time/payment-intent"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-one-time-payment-intent', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-one-time-payment-intent"
                    onclick="tryItOut('POSTapi-v1-payment-one-time-payment-intent');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-one-time-payment-intent"
                    onclick="cancelTryOut('POSTapi-v1-payment-one-time-payment-intent');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-one-time-payment-intent"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/one-time/payment-intent</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-one-time-payment-intent"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-one-time-payment-intent"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-one-time-payment-intent"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="POSTapi-v1-payment-one-time-payment-intent"
               value="95"
               data-component="body">
    <br>
<p>Must be at least 100. Example: <code>95</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="currency"                data-endpoint="POSTapi-v1-payment-one-time-payment-intent"
               value="ngz"
               data-component="body">
    <br>
<p>Amount in cents. Must be 3 characters. Example: <code>ngz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payable_type"                data-endpoint="POSTapi-v1-payment-one-time-payment-intent"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payable_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="payable_id"                data-endpoint="POSTapi-v1-payment-one-time-payment-intent"
               value="16"
               data-component="body">
    <br>
<p>Only accepts the 'user' alias for now. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method_id"                data-endpoint="POSTapi-v1-payment-one-time-payment-intent"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                                <h2 id="payments-subscriptions-manage-user-subscription-lifecycle-create-show-cancel-resume-swap">Subscriptions
Manage user subscription lifecycle (create, show, cancel, resume, swap).</h2>
                                                    <h2 id="payments-POSTapi-v1-payment-subscriptions">Create a new subscription checkout session for the user.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-subscriptions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/subscriptions" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"price_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/subscriptions"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "price_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/subscriptions';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'price_id' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/subscriptions'
payload = {
    "price_id": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-subscriptions">
</span>
<span id="execution-results-POSTapi-v1-payment-subscriptions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-subscriptions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-subscriptions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-subscriptions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-subscriptions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-subscriptions" data-method="POST"
      data-path="api/v1/payment/subscriptions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-subscriptions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-subscriptions"
                    onclick="tryItOut('POSTapi-v1-payment-subscriptions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-subscriptions"
                    onclick="cancelTryOut('POSTapi-v1-payment-subscriptions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-subscriptions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/subscriptions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-subscriptions"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-subscriptions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-subscriptions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="price_id"                data-endpoint="POSTapi-v1-payment-subscriptions"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="payments-GETapi-v1-payment-subscriptions">Get details of the user&#039;s active subscription.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-payment-subscriptions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/payment/subscriptions" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/subscriptions"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/subscriptions';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/subscriptions'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-payment-subscriptions">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;ok&quot;: false,
    &quot;message&quot;: &quot;Unauthenticated. Please login to continue.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-payment-subscriptions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-payment-subscriptions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-payment-subscriptions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-payment-subscriptions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-payment-subscriptions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-payment-subscriptions" data-method="GET"
      data-path="api/v1/payment/subscriptions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-payment-subscriptions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-payment-subscriptions"
                    onclick="tryItOut('GETapi-v1-payment-subscriptions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-payment-subscriptions"
                    onclick="cancelTryOut('GETapi-v1-payment-subscriptions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-payment-subscriptions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/payment/subscriptions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-payment-subscriptions"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-payment-subscriptions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-payment-subscriptions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="payments-POSTapi-v1-payment-subscriptions-cancel">Cancel the user&#039;s active subscription at the end of the billing period.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-subscriptions-cancel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/subscriptions/cancel" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/subscriptions/cancel"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/subscriptions/cancel';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/subscriptions/cancel'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-subscriptions-cancel">
</span>
<span id="execution-results-POSTapi-v1-payment-subscriptions-cancel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-subscriptions-cancel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-subscriptions-cancel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-subscriptions-cancel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-subscriptions-cancel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-subscriptions-cancel" data-method="POST"
      data-path="api/v1/payment/subscriptions/cancel"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-subscriptions-cancel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-subscriptions-cancel"
                    onclick="tryItOut('POSTapi-v1-payment-subscriptions-cancel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-subscriptions-cancel"
                    onclick="cancelTryOut('POSTapi-v1-payment-subscriptions-cancel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-subscriptions-cancel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/subscriptions/cancel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-subscriptions-cancel"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-subscriptions-cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-subscriptions-cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="payments-POSTapi-v1-payment-subscriptions-resume">Resume a cancelled subscription if it&#039;s still in its grace period.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-subscriptions-resume">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/subscriptions/resume" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/subscriptions/resume"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/subscriptions/resume';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/subscriptions/resume'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-subscriptions-resume">
</span>
<span id="execution-results-POSTapi-v1-payment-subscriptions-resume" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-subscriptions-resume"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-subscriptions-resume"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-subscriptions-resume" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-subscriptions-resume">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-subscriptions-resume" data-method="POST"
      data-path="api/v1/payment/subscriptions/resume"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-subscriptions-resume', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-subscriptions-resume"
                    onclick="tryItOut('POSTapi-v1-payment-subscriptions-resume');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-subscriptions-resume"
                    onclick="cancelTryOut('POSTapi-v1-payment-subscriptions-resume');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-subscriptions-resume"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/subscriptions/resume</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-subscriptions-resume"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-subscriptions-resume"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-subscriptions-resume"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="payments-POSTapi-v1-payment-subscriptions-swap">Swap the user&#039;s subscription to a different plan.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-subscriptions-swap">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/subscriptions/swap" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"new_price_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/subscriptions/swap"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "new_price_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/subscriptions/swap';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'new_price_id' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/subscriptions/swap'
payload = {
    "new_price_id": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-subscriptions-swap">
</span>
<span id="execution-results-POSTapi-v1-payment-subscriptions-swap" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-subscriptions-swap"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-subscriptions-swap"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-subscriptions-swap" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-subscriptions-swap">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-subscriptions-swap" data-method="POST"
      data-path="api/v1/payment/subscriptions/swap"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-subscriptions-swap', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-subscriptions-swap"
                    onclick="tryItOut('POSTapi-v1-payment-subscriptions-swap');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-subscriptions-swap"
                    onclick="cancelTryOut('POSTapi-v1-payment-subscriptions-swap');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-subscriptions-swap"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/subscriptions/swap</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-subscriptions-swap"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-subscriptions-swap"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-subscriptions-swap"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>new_price_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="new_price_id"                data-endpoint="POSTapi-v1-payment-subscriptions-swap"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                                <h2 id="payments-refunds-request-refunds-for-eligible-transactions">Refunds
Request refunds for eligible transactions.</h2>
                                                    <h2 id="payments-POSTapi-v1-payment-refunds">Sends a refund request for a specific transaction.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-refunds">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/refunds" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"payment_intent_id\": \"pi_bngz\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/refunds"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "payment_intent_id": "pi_bngz"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/refunds';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'payment_intent_id' =&gt; 'pi_bngz',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/refunds'
payload = {
    "payment_intent_id": "pi_bngz"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-refunds">
</span>
<span id="execution-results-POSTapi-v1-payment-refunds" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-refunds"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-refunds"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-refunds" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-refunds">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-refunds" data-method="POST"
      data-path="api/v1/payment/refunds"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-refunds', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-refunds"
                    onclick="tryItOut('POSTapi-v1-payment-refunds');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-refunds"
                    onclick="cancelTryOut('POSTapi-v1-payment-refunds');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-refunds"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/refunds</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-refunds"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-refunds"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-refunds"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_intent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_intent_id"                data-endpoint="POSTapi-v1-payment-refunds"
               value="pi_bngz"
               data-component="body">
    <br>
<p>Must start with one of <code>pi_</code>. Example: <code>pi_bngz</code></p>
        </div>
        </form>

                                <h2 id="payments-invoices-list-download-invoices-generated-by-stripe">Invoices
List &amp; download invoices generated by Stripe.</h2>
                                                    <h2 id="payments-GETapi-v1-payment-invoices">Display a paginated list of the user&#039;s invoices.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-payment-invoices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/payment/invoices" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/invoices"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/invoices';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/invoices'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-payment-invoices">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
vary: Origin
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;ok&quot;: false,
    &quot;message&quot;: &quot;Unauthenticated. Please login to continue.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-payment-invoices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-payment-invoices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-payment-invoices"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-payment-invoices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-payment-invoices">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-payment-invoices" data-method="GET"
      data-path="api/v1/payment/invoices"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-payment-invoices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-payment-invoices"
                    onclick="tryItOut('GETapi-v1-payment-invoices');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-payment-invoices"
                    onclick="cancelTryOut('GETapi-v1-payment-invoices');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-payment-invoices"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/payment/invoices</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-payment-invoices"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-payment-invoices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-payment-invoices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="payments-GETapi-v1-payment-invoices--invoice--download">Download a specific invoice as a PDF.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-payment-invoices--invoice--download">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/payment/invoices/architecto/download" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/invoices/architecto/download"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/invoices/architecto/download';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/invoices/architecto/download'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-payment-invoices--invoice--download">
    </span>
<span id="execution-results-GETapi-v1-payment-invoices--invoice--download" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-payment-invoices--invoice--download"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-payment-invoices--invoice--download"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-payment-invoices--invoice--download" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-payment-invoices--invoice--download">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-payment-invoices--invoice--download" data-method="GET"
      data-path="api/v1/payment/invoices/{invoice}/download"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-payment-invoices--invoice--download', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-payment-invoices--invoice--download"
                    onclick="tryItOut('GETapi-v1-payment-invoices--invoice--download');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-payment-invoices--invoice--download"
                    onclick="cancelTryOut('GETapi-v1-payment-invoices--invoice--download');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-payment-invoices--invoice--download"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/payment/invoices/{invoice}/download</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-payment-invoices--invoice--download"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-payment-invoices--invoice--download"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-payment-invoices--invoice--download"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>invoice</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="invoice"                data-endpoint="GETapi-v1-payment-invoices--invoice--download"
               value="architecto"
               data-component="url">
    <br>
<p>The invoice. Example: <code>architecto</code></p>
            </div>
                    </form>

                                <h2 id="payments-payment-methods-manage-saved-cards-default-payment-method">Payment Methods
Manage saved cards &amp; default payment method.</h2>
                                                    <h2 id="payments-GETapi-v1-payment-payment-methods">Display a list of the user&#039;s saved payment methods.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-payment-payment-methods">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/payment/payment-methods" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/payment-methods"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/payment-methods';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/payment-methods'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-payment-payment-methods">
    </span>
<span id="execution-results-GETapi-v1-payment-payment-methods" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-payment-payment-methods"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-payment-payment-methods"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-payment-payment-methods" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-payment-payment-methods">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-payment-payment-methods" data-method="GET"
      data-path="api/v1/payment/payment-methods"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-payment-payment-methods', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-payment-payment-methods"
                    onclick="tryItOut('GETapi-v1-payment-payment-methods');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-payment-payment-methods"
                    onclick="cancelTryOut('GETapi-v1-payment-payment-methods');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-payment-payment-methods"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/payment/payment-methods</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-payment-payment-methods"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-payment-payment-methods"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-payment-payment-methods"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="payments-POSTapi-v1-payment-payment-methods">Add a new payment method (e.g., a card) for the user.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-payment-methods">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/payment-methods" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"payment_method_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/payment-methods"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "payment_method_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/payment-methods';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'payment_method_id' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/payment-methods'
payload = {
    "payment_method_id": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-payment-methods">
</span>
<span id="execution-results-POSTapi-v1-payment-payment-methods" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-payment-methods"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-payment-methods"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-payment-methods" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-payment-methods">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-payment-methods" data-method="POST"
      data-path="api/v1/payment/payment-methods"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-payment-methods', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-payment-methods"
                    onclick="tryItOut('POSTapi-v1-payment-payment-methods');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-payment-methods"
                    onclick="cancelTryOut('POSTapi-v1-payment-payment-methods');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-payment-methods"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/payment-methods</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-payment-methods"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-payment-methods"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-payment-methods"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method_id"                data-endpoint="POSTapi-v1-payment-payment-methods"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="payments-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default">Set a payment method as the user&#039;s default.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://10.10.28.53:81/api/v1/payment/payment-methods/architecto/set-default" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/payment-methods/architecto/set-default"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/payment-methods/architecto/set-default';
$response = $client-&gt;patch(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/payment-methods/architecto/set-default'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PATCH', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default">
</span>
<span id="execution-results-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default" data-method="PATCH"
      data-path="api/v1/payment/payment-methods/{paymentMethod}/set-default"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-payment-payment-methods--paymentMethod--set-default', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default"
                    onclick="tryItOut('PATCHapi-v1-payment-payment-methods--paymentMethod--set-default');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default"
                    onclick="cancelTryOut('PATCHapi-v1-payment-payment-methods--paymentMethod--set-default');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-payment-payment-methods--paymentMethod--set-default"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/payment/payment-methods/{paymentMethod}/set-default</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-v1-payment-payment-methods--paymentMethod--set-default"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-v1-payment-payment-methods--paymentMethod--set-default"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-v1-payment-payment-methods--paymentMethod--set-default"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>paymentMethod</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="paymentMethod"                data-endpoint="PATCHapi-v1-payment-payment-methods--paymentMethod--set-default"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="payments-DELETEapi-v1-payment-payment-methods--paymentMethod-">Delete a payment method.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-payment-payment-methods--paymentMethod-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://10.10.28.53:81/api/v1/payment/payment-methods/architecto" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/payment-methods/architecto"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/payment-methods/architecto';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/payment-methods/architecto'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-payment-payment-methods--paymentMethod-">
</span>
<span id="execution-results-DELETEapi-v1-payment-payment-methods--paymentMethod-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-payment-payment-methods--paymentMethod-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-payment-payment-methods--paymentMethod-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-payment-payment-methods--paymentMethod-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-payment-payment-methods--paymentMethod-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-payment-payment-methods--paymentMethod-" data-method="DELETE"
      data-path="api/v1/payment/payment-methods/{paymentMethod}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-payment-payment-methods--paymentMethod-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-payment-payment-methods--paymentMethod-"
                    onclick="tryItOut('DELETEapi-v1-payment-payment-methods--paymentMethod-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-payment-payment-methods--paymentMethod-"
                    onclick="cancelTryOut('DELETEapi-v1-payment-payment-methods--paymentMethod-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-payment-payment-methods--paymentMethod-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/payment/payment-methods/{paymentMethod}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-payment-payment-methods--paymentMethod-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-payment-payment-methods--paymentMethod-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-payment-payment-methods--paymentMethod-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>paymentMethod</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="paymentMethod"                data-endpoint="DELETEapi-v1-payment-payment-methods--paymentMethod-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="payments-DELETEapi-v1-payment-payment-methods">Delete all payment methods for the user.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Includes a safety check to prevent deletion if an active subscription exists.</p>

<span id="example-requests-DELETEapi-v1-payment-payment-methods">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://10.10.28.53:81/api/v1/payment/payment-methods" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/payment-methods"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/payment-methods';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/payment-methods'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-payment-payment-methods">
</span>
<span id="execution-results-DELETEapi-v1-payment-payment-methods" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-payment-payment-methods"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-payment-payment-methods"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-payment-payment-methods" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-payment-payment-methods">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-payment-payment-methods" data-method="DELETE"
      data-path="api/v1/payment/payment-methods"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-payment-payment-methods', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-payment-payment-methods"
                    onclick="tryItOut('DELETEapi-v1-payment-payment-methods');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-payment-payment-methods"
                    onclick="cancelTryOut('DELETEapi-v1-payment-payment-methods');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-payment-payment-methods"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/payment/payment-methods</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-payment-payment-methods"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-payment-payment-methods"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-payment-payment-methods"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="payments-POSTapi-v1-payment-payment-methods-setup-intent">Create a SetupIntent to securely collect payment method details on the frontend.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-payment-methods-setup-intent">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/payment-methods/setup-intent" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/payment-methods/setup-intent"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/payment-methods/setup-intent';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/payment-methods/setup-intent'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-payment-methods-setup-intent">
</span>
<span id="execution-results-POSTapi-v1-payment-payment-methods-setup-intent" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-payment-methods-setup-intent"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-payment-methods-setup-intent"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-payment-methods-setup-intent" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-payment-methods-setup-intent">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-payment-methods-setup-intent" data-method="POST"
      data-path="api/v1/payment/payment-methods/setup-intent"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-payment-methods-setup-intent', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-payment-methods-setup-intent"
                    onclick="tryItOut('POSTapi-v1-payment-payment-methods-setup-intent');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-payment-methods-setup-intent"
                    onclick="cancelTryOut('POSTapi-v1-payment-payment-methods-setup-intent');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-payment-methods-setup-intent"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/payment-methods/setup-intent</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-payment-methods-setup-intent"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-payment-methods-setup-intent"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-payment-methods-setup-intent"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="payments-POSTapi-v1-payment-payment-methods-setup-session">Create a Checkout Session in &#039;setup&#039; mode to generate a shareable link
for users to add a payment method on a Stripe-hosted page.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-payment-methods-setup-session">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/payment-methods/setup-session" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/payment-methods/setup-session"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/payment-methods/setup-session';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/payment-methods/setup-session'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-payment-methods-setup-session">
</span>
<span id="execution-results-POSTapi-v1-payment-payment-methods-setup-session" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-payment-methods-setup-session"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-payment-methods-setup-session"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-payment-methods-setup-session" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-payment-methods-setup-session">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-payment-methods-setup-session" data-method="POST"
      data-path="api/v1/payment/payment-methods/setup-session"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-payment-methods-setup-session', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-payment-methods-setup-session"
                    onclick="tryItOut('POSTapi-v1-payment-payment-methods-setup-session');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-payment-methods-setup-session"
                    onclick="cancelTryOut('POSTapi-v1-payment-payment-methods-setup-session');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-payment-methods-setup-session"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/payment-methods/setup-session</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-payment-methods-setup-session"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-payment-methods-setup-session"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-payment-methods-setup-session"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                                <h2 id="payments-billing-portal-access-stripe-hosted-customer-billing-portal">Billing Portal
Access Stripe-hosted customer billing portal.</h2>
                                                    <h2 id="payments-POSTapi-v1-payment-billing-portal">Create a new billing portal session for the authenticated user.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-payment-billing-portal">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/payment/billing-portal" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/payment/billing-portal"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/payment/billing-portal';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/payment/billing-portal'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payment-billing-portal">
</span>
<span id="execution-results-POSTapi-v1-payment-billing-portal" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payment-billing-portal"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payment-billing-portal"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payment-billing-portal" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payment-billing-portal">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payment-billing-portal" data-method="POST"
      data-path="api/v1/payment/billing-portal"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payment-billing-portal', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payment-billing-portal"
                    onclick="tryItOut('POSTapi-v1-payment-billing-portal');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payment-billing-portal"
                    onclick="cancelTryOut('POSTapi-v1-payment-billing-portal');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payment-billing-portal"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payment/billing-portal</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-payment-billing-portal"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payment-billing-portal"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payment-billing-portal"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="admin-kyc-management">Admin KYC Management</h1>

    <p>APIs for admins to review and approve/reject user KYC applications.</p>

                                <h2 id="admin-kyc-management-GETapi-v1-admin-kyc-pending">List pending KYCs</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>List all users who have submitted KYC and are waiting for approval.</p>

<span id="example-requests-GETapi-v1-admin-kyc-pending">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/admin/kyc/pending" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/kyc/pending"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/kyc/pending';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/kyc/pending'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-kyc-pending">
    </span>
<span id="execution-results-GETapi-v1-admin-kyc-pending" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-kyc-pending"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-kyc-pending"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-kyc-pending" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-kyc-pending">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-kyc-pending" data-method="GET"
      data-path="api/v1/admin/kyc/pending"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-kyc-pending', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-kyc-pending"
                    onclick="tryItOut('GETapi-v1-admin-kyc-pending');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-kyc-pending"
                    onclick="cancelTryOut('GETapi-v1-admin-kyc-pending');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-kyc-pending"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/kyc/pending</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-kyc-pending"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-kyc-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-kyc-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="admin-kyc-management-GETapi-v1-admin-kyc--userId--documents">Get user KYC documents</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a specific user's submitted KYC documents.</p>

<span id="example-requests-GETapi-v1-admin-kyc--userId--documents">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/admin/kyc/1/documents" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/kyc/1/documents"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/kyc/1/documents';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/kyc/1/documents'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-kyc--userId--documents">
    </span>
<span id="execution-results-GETapi-v1-admin-kyc--userId--documents" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-kyc--userId--documents"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-kyc--userId--documents"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-kyc--userId--documents" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-kyc--userId--documents">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-kyc--userId--documents" data-method="GET"
      data-path="api/v1/admin/kyc/{userId}/documents"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-kyc--userId--documents', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-kyc--userId--documents"
                    onclick="tryItOut('GETapi-v1-admin-kyc--userId--documents');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-kyc--userId--documents"
                    onclick="cancelTryOut('GETapi-v1-admin-kyc--userId--documents');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-kyc--userId--documents"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/kyc/{userId}/documents</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-kyc--userId--documents"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-kyc--userId--documents"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-kyc--userId--documents"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>userId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="userId"                data-endpoint="GETapi-v1-admin-kyc--userId--documents"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-kyc-management-POSTapi-v1-admin-kyc--userId--approve">Approve KYC</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Approve a user's KYC submission and upgrade them to a dealer role.</p>

<span id="example-requests-POSTapi-v1-admin-kyc--userId--approve">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/admin/kyc/1/approve" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/kyc/1/approve"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/kyc/1/approve';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/kyc/1/approve'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-kyc--userId--approve">
</span>
<span id="execution-results-POSTapi-v1-admin-kyc--userId--approve" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-kyc--userId--approve"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-kyc--userId--approve"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-kyc--userId--approve" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-kyc--userId--approve">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-kyc--userId--approve" data-method="POST"
      data-path="api/v1/admin/kyc/{userId}/approve"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-kyc--userId--approve', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-kyc--userId--approve"
                    onclick="tryItOut('POSTapi-v1-admin-kyc--userId--approve');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-kyc--userId--approve"
                    onclick="cancelTryOut('POSTapi-v1-admin-kyc--userId--approve');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-kyc--userId--approve"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/kyc/{userId}/approve</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-kyc--userId--approve"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-kyc--userId--approve"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-kyc--userId--approve"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>userId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="userId"                data-endpoint="POSTapi-v1-admin-kyc--userId--approve"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-kyc-management-POSTapi-v1-admin-kyc--userId--reject">Reject KYC</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Reject a user's KYC submission and provide a reason.</p>

<span id="example-requests-POSTapi-v1-admin-kyc--userId--reject">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/admin/kyc/1/reject" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/kyc/1/reject"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reason": "b"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/kyc/1/reject';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'reason' =&gt; 'b',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/kyc/1/reject'
payload = {
    "reason": "b"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-kyc--userId--reject">
</span>
<span id="execution-results-POSTapi-v1-admin-kyc--userId--reject" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-kyc--userId--reject"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-kyc--userId--reject"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-kyc--userId--reject" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-kyc--userId--reject">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-kyc--userId--reject" data-method="POST"
      data-path="api/v1/admin/kyc/{userId}/reject"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-kyc--userId--reject', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-kyc--userId--reject"
                    onclick="tryItOut('POSTapi-v1-admin-kyc--userId--reject');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-kyc--userId--reject"
                    onclick="cancelTryOut('POSTapi-v1-admin-kyc--userId--reject');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-kyc--userId--reject"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/kyc/{userId}/reject</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-kyc--userId--reject"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-kyc--userId--reject"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-kyc--userId--reject"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>userId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="userId"                data-endpoint="POSTapi-v1-admin-kyc--userId--reject"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-v1-admin-kyc--userId--reject"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>b</code></p>
        </div>
        </form>

                <h1 id="admin-listings-management">Admin Listings Management</h1>

    <p>APIs for managing watch listings in the admin dashboard.</p>

                                <h2 id="admin-listings-management-GETapi-v1-admin-listings">List all listings</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get all listings for admin panel including seller information and conversation counts.</p>

<span id="example-requests-GETapi-v1-admin-listings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/admin/listings" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/listings"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/listings';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/listings'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-listings">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;seller&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Omar Faruk&quot;,
                &quot;email&quot;: &quot;kaziomar@yopmail.com&quot;,
                &quot;phone_number&quot;: &quot;+1234567895&quot;,
                &quot;standing&quot;: null,
                &quot;tier&quot;: null
            },
            &quot;brand&quot;: &quot;Casio&quot;,
            &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
            &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
            &quot;sale_method&quot;: &quot;direct_sale&quot;,
            &quot;price&quot;: 26000,
            &quot;condition&quot;: &quot;Excellent&quot;,
            &quot;case_size&quot;: &quot;41mm&quot;,
            &quot;year_of_production&quot;: &quot;2026&quot;,
            &quot;location&quot;: &quot;Kolkata&quot;,
            &quot;accessories&quot;: [
                &quot;Box&quot;,
                &quot;Papers&quot;
            ],
            &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
            &quot;images&quot;: [
                &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
                &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
            ],
            &quot;brand_certificate&quot;: null,
            &quot;status&quot;: &quot;Sold&quot;,
            &quot;is_verified&quot;: false,
            &quot;rejection_reason&quot;: null,
            &quot;enquiries&quot;: 0,
            &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;,
            &quot;patina_margin&quot;: 3900,
            &quot;estimated_payout&quot;: 22100
        },
        {
            &quot;id&quot;: 1,
            &quot;seller&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Omar Faruk&quot;,
                &quot;email&quot;: &quot;kaziomar@yopmail.com&quot;,
                &quot;phone_number&quot;: &quot;+1234567895&quot;,
                &quot;standing&quot;: null,
                &quot;tier&quot;: null
            },
            &quot;brand&quot;: &quot;Casio&quot;,
            &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
            &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
            &quot;sale_method&quot;: &quot;direct_sale&quot;,
            &quot;price&quot;: 26000,
            &quot;condition&quot;: &quot;Excellent&quot;,
            &quot;case_size&quot;: &quot;41mm&quot;,
            &quot;year_of_production&quot;: &quot;2026&quot;,
            &quot;location&quot;: &quot;Kolkata&quot;,
            &quot;accessories&quot;: [
                &quot;Box&quot;,
                &quot;Papers&quot;
            ],
            &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
            &quot;images&quot;: [
                &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
                &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
            ],
            &quot;brand_certificate&quot;: null,
            &quot;status&quot;: &quot;Sold&quot;,
            &quot;is_verified&quot;: false,
            &quot;rejection_reason&quot;: null,
            &quot;enquiries&quot;: 0,
            &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;,
            &quot;patina_margin&quot;: 3900,
            &quot;estimated_payout&quot;: 22100
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-listings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-listings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-listings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-listings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-listings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-listings" data-method="GET"
      data-path="api/v1/admin/listings"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-listings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-listings"
                    onclick="tryItOut('GETapi-v1-admin-listings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-listings"
                    onclick="cancelTryOut('GETapi-v1-admin-listings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-listings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/listings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-listings"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="admin-listings-management-GETapi-v1-admin-listings--id-">Get listing details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a specific listing details for admin review.</p>

<span id="example-requests-GETapi-v1-admin-listings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/admin/listings/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/listings/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/listings/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/listings/1'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-listings--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;seller&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Omar Faruk&quot;,
            &quot;email&quot;: &quot;kaziomar@yopmail.com&quot;,
            &quot;phone_number&quot;: &quot;+1234567895&quot;,
            &quot;standing&quot;: null,
            &quot;tier&quot;: null
        },
        &quot;brand&quot;: &quot;Casio&quot;,
        &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
        &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
        &quot;sale_method&quot;: &quot;direct_sale&quot;,
        &quot;price&quot;: 26000,
        &quot;condition&quot;: &quot;Excellent&quot;,
        &quot;case_size&quot;: &quot;41mm&quot;,
        &quot;year_of_production&quot;: &quot;2026&quot;,
        &quot;location&quot;: &quot;Kolkata&quot;,
        &quot;accessories&quot;: [
            &quot;Box&quot;,
            &quot;Papers&quot;
        ],
        &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
        &quot;images&quot;: [
            &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
            &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
        ],
        &quot;brand_certificate&quot;: null,
        &quot;status&quot;: &quot;Sold&quot;,
        &quot;is_verified&quot;: false,
        &quot;rejection_reason&quot;: null,
        &quot;enquiries&quot;: 0,
        &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;,
        &quot;patina_margin&quot;: 3900,
        &quot;estimated_payout&quot;: 22100
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-listings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-listings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-listings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-listings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-listings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-listings--id-" data-method="GET"
      data-path="api/v1/admin/listings/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-listings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-listings--id-"
                    onclick="tryItOut('GETapi-v1-admin-listings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-listings--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-listings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-listings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/listings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-listings--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-admin-listings--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the listing. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-listings-management-PATCHapi-v1-admin-listings--id-">Update listing details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update listing details directly from the admin panel.</p>

<span id="example-requests-PATCHapi-v1-admin-listings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://10.10.28.53:81/api/v1/admin/listings/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"brand\": \"b\",
    \"model\": \"n\",
    \"reference_number\": \"g\",
    \"price\": 12,
    \"condition\": \"m\",
    \"case_size\": \"i\",
    \"year_of_production\": \"yvdl\",
    \"location\": \"j\",
    \"condition_notes\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/listings/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "brand": "b",
    "model": "n",
    "reference_number": "g",
    "price": 12,
    "condition": "m",
    "case_size": "i",
    "year_of_production": "yvdl",
    "location": "j",
    "condition_notes": "architecto"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/listings/1';
$response = $client-&gt;patch(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'brand' =&gt; 'b',
            'model' =&gt; 'n',
            'reference_number' =&gt; 'g',
            'price' =&gt; 12,
            'condition' =&gt; 'm',
            'case_size' =&gt; 'i',
            'year_of_production' =&gt; 'yvdl',
            'location' =&gt; 'j',
            'condition_notes' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/listings/1'
payload = {
    "brand": "b",
    "model": "n",
    "reference_number": "g",
    "price": 12,
    "condition": "m",
    "case_size": "i",
    "year_of_production": "yvdl",
    "location": "j",
    "condition_notes": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PATCHapi-v1-admin-listings--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;seller&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Omar Faruk&quot;,
            &quot;email&quot;: &quot;kaziomar@yopmail.com&quot;,
            &quot;phone_number&quot;: &quot;+1234567895&quot;,
            &quot;standing&quot;: null,
            &quot;tier&quot;: null
        },
        &quot;brand&quot;: &quot;Casio&quot;,
        &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
        &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
        &quot;sale_method&quot;: &quot;direct_sale&quot;,
        &quot;price&quot;: 26000,
        &quot;condition&quot;: &quot;Excellent&quot;,
        &quot;case_size&quot;: &quot;41mm&quot;,
        &quot;year_of_production&quot;: &quot;2026&quot;,
        &quot;location&quot;: &quot;Kolkata&quot;,
        &quot;accessories&quot;: [
            &quot;Box&quot;,
            &quot;Papers&quot;
        ],
        &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
        &quot;images&quot;: [
            &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
            &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
        ],
        &quot;brand_certificate&quot;: null,
        &quot;status&quot;: &quot;Sold&quot;,
        &quot;is_verified&quot;: false,
        &quot;rejection_reason&quot;: null,
        &quot;enquiries&quot;: 0,
        &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;,
        &quot;patina_margin&quot;: 3900,
        &quot;estimated_payout&quot;: 22100
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-v1-admin-listings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-admin-listings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-admin-listings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-admin-listings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-admin-listings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-v1-admin-listings--id-" data-method="PATCH"
      data-path="api/v1/admin/listings/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-admin-listings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-admin-listings--id-"
                    onclick="tryItOut('PATCHapi-v1-admin-listings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-admin-listings--id-"
                    onclick="cancelTryOut('PATCHapi-v1-admin-listings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-admin-listings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/listings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the listing. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brand</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brand"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>model</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="model"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reference_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reference_number"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>g</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="12"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>condition</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="condition"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="m"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>m</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_size</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_size"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="i"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>i</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>year_of_production</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="year_of_production"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="yvdl"
               data-component="body">
    <br>
<p>Must not be greater than 4 characters. Example: <code>yvdl</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>location</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="location"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="j"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>j</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>accessories</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="accessories"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>condition_notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="condition_notes"                data-endpoint="PATCHapi-v1-admin-listings--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="admin-listings-management-PATCHapi-v1-admin-listings--id--status">Update listing status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update listing status (Live, Under Review, Rejected, etc.) and verification flag.</p>

<span id="example-requests-PATCHapi-v1-admin-listings--id--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://10.10.28.53:81/api/v1/admin/listings/1/status" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"Live\",
    \"is_verified\": false,
    \"rejection_reason\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/listings/1/status"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "Live",
    "is_verified": false,
    "rejection_reason": "architecto"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/listings/1/status';
$response = $client-&gt;patch(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'status' =&gt; 'Live',
            'is_verified' =&gt; false,
            'rejection_reason' =&gt; 'architecto',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/listings/1/status'
payload = {
    "status": "Live",
    "is_verified": false,
    "rejection_reason": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PATCHapi-v1-admin-listings--id--status">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;seller&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Omar Faruk&quot;,
            &quot;email&quot;: &quot;kaziomar@yopmail.com&quot;,
            &quot;phone_number&quot;: &quot;+1234567895&quot;,
            &quot;standing&quot;: null,
            &quot;tier&quot;: null
        },
        &quot;brand&quot;: &quot;Casio&quot;,
        &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
        &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
        &quot;sale_method&quot;: &quot;direct_sale&quot;,
        &quot;price&quot;: 26000,
        &quot;condition&quot;: &quot;Excellent&quot;,
        &quot;case_size&quot;: &quot;41mm&quot;,
        &quot;year_of_production&quot;: &quot;2026&quot;,
        &quot;location&quot;: &quot;Kolkata&quot;,
        &quot;accessories&quot;: [
            &quot;Box&quot;,
            &quot;Papers&quot;
        ],
        &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
        &quot;images&quot;: [
            &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
            &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
        ],
        &quot;brand_certificate&quot;: null,
        &quot;status&quot;: &quot;Sold&quot;,
        &quot;is_verified&quot;: false,
        &quot;rejection_reason&quot;: null,
        &quot;enquiries&quot;: 0,
        &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;,
        &quot;patina_margin&quot;: 3900,
        &quot;estimated_payout&quot;: 22100
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-v1-admin-listings--id--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-admin-listings--id--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-admin-listings--id--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-admin-listings--id--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-admin-listings--id--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-v1-admin-listings--id--status" data-method="PATCH"
      data-path="api/v1/admin/listings/{id}/status"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-admin-listings--id--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-admin-listings--id--status"
                    onclick="tryItOut('PATCHapi-v1-admin-listings--id--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-admin-listings--id--status"
                    onclick="cancelTryOut('PATCHapi-v1-admin-listings--id--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-admin-listings--id--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/listings/{id}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-v1-admin-listings--id--status"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-v1-admin-listings--id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-v1-admin-listings--id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PATCHapi-v1-admin-listings--id--status"
               value="1"
               data-component="url">
    <br>
<p>The ID of the listing. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PATCHapi-v1-admin-listings--id--status"
               value="Live"
               data-component="body">
    <br>
<p>Example: <code>Live</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Under Review</code></li> <li><code>Live</code></li> <li><code>Rejected</code></li> <li><code>Sold</code></li> <li><code>Delisted</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_verified</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PATCHapi-v1-admin-listings--id--status" style="display: none">
            <input type="radio" name="is_verified"
                   value="true"
                   data-endpoint="PATCHapi-v1-admin-listings--id--status"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PATCHapi-v1-admin-listings--id--status" style="display: none">
            <input type="radio" name="is_verified"
                   value="false"
                   data-endpoint="PATCHapi-v1-admin-listings--id--status"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rejection_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="rejection_reason"                data-endpoint="PATCHapi-v1-admin-listings--id--status"
               value="architecto"
               data-component="body">
    <br>
<p>This field is required when <code>status</code> is <code>Rejected</code>. Example: <code>architecto</code></p>
        </div>
        </form>

                <h1 id="admin-users-management">Admin Users Management</h1>

    <p>APIs for managing users in the admin dashboard.</p>

                                <h2 id="admin-users-management-GETapi-v1-admin-users">List all users</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of all users for the admin dashboard.</p>

<span id="example-requests-GETapi-v1-admin-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/admin/users" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/users"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/users';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/users'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-users">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 25,
            &quot;name&quot;: &quot;Morgan Hirthe&quot;,
            &quot;email&quot;: &quot;dare.emelie@example.com&quot;,
            &quot;phone&quot;: null,
            &quot;kyc&quot;: &quot;pending&quot;,
            &quot;kyc_rejection_reason&quot;: null,
            &quot;standing&quot;: &quot;good&quot;,
            &quot;joined&quot;: &quot;Aug 2026&quot;,
            &quot;purchases&quot;: 0,
            &quot;sales&quot;: 0
        },
        {
            &quot;id&quot;: 26,
            &quot;name&quot;: &quot;Prof. Mina Bauch&quot;,
            &quot;email&quot;: &quot;okeefe.isidro@example.org&quot;,
            &quot;phone&quot;: null,
            &quot;kyc&quot;: &quot;pending&quot;,
            &quot;kyc_rejection_reason&quot;: null,
            &quot;standing&quot;: &quot;good&quot;,
            &quot;joined&quot;: &quot;Aug 2026&quot;,
            &quot;purchases&quot;: 0,
            &quot;sales&quot;: 0
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-users" data-method="GET"
      data-path="api/v1/admin/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-users"
                    onclick="tryItOut('GETapi-v1-admin-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-users"
                    onclick="cancelTryOut('GETapi-v1-admin-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-users"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="admin-users-management-GETapi-v1-admin-users--id--history">Get user history</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get user history including activity logs and recent transactions.</p>

<span id="example-requests-GETapi-v1-admin-users--id--history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/admin/users/1/history" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/users/1/history"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/users/1/history';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/users/1/history'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-users--id--history">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 27,
        &quot;name&quot;: &quot;Morgan Hirthe&quot;,
        &quot;email&quot;: &quot;imclaughlin@example.org&quot;,
        &quot;phone&quot;: null,
        &quot;kyc&quot;: &quot;pending&quot;,
        &quot;kyc_rejection_reason&quot;: null,
        &quot;standing&quot;: &quot;good&quot;,
        &quot;joined&quot;: &quot;Aug 2026&quot;,
        &quot;purchases&quot;: 0,
        &quot;sales&quot;: 0
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-users--id--history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-users--id--history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-users--id--history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-users--id--history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-users--id--history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-users--id--history" data-method="GET"
      data-path="api/v1/admin/users/{id}/history"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-users--id--history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-users--id--history"
                    onclick="tryItOut('GETapi-v1-admin-users--id--history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-users--id--history"
                    onclick="cancelTryOut('GETapi-v1-admin-users--id--history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-users--id--history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/users/{id}/history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-users--id--history"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-users--id--history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-users--id--history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-admin-users--id--history"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-users-management-PATCHapi-v1-admin-users--id--standing">Update user account standing</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update the account standing of a user (Good, Warning, Suspended).</p>

<span id="example-requests-PATCHapi-v1-admin-users--id--standing">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://10.10.28.53:81/api/v1/admin/users/1/standing" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"account_standing\": \"Good\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/admin/users/1/standing"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "account_standing": "Good"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/admin/users/1/standing';
$response = $client-&gt;patch(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'account_standing' =&gt; 'Good',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/admin/users/1/standing'
payload = {
    "account_standing": "Good"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PATCH', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PATCHapi-v1-admin-users--id--standing">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 28,
        &quot;name&quot;: &quot;Morgan Hirthe&quot;,
        &quot;email&quot;: &quot;ztromp@example.org&quot;,
        &quot;phone&quot;: null,
        &quot;kyc&quot;: &quot;pending&quot;,
        &quot;kyc_rejection_reason&quot;: null,
        &quot;standing&quot;: &quot;good&quot;,
        &quot;joined&quot;: &quot;Aug 2026&quot;,
        &quot;purchases&quot;: 0,
        &quot;sales&quot;: 0
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-v1-admin-users--id--standing" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-admin-users--id--standing"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-admin-users--id--standing"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-admin-users--id--standing" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-admin-users--id--standing">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-v1-admin-users--id--standing" data-method="PATCH"
      data-path="api/v1/admin/users/{id}/standing"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-admin-users--id--standing', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-admin-users--id--standing"
                    onclick="tryItOut('PATCHapi-v1-admin-users--id--standing');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-admin-users--id--standing"
                    onclick="cancelTryOut('PATCHapi-v1-admin-users--id--standing');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-admin-users--id--standing"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/users/{id}/standing</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-v1-admin-users--id--standing"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-v1-admin-users--id--standing"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-v1-admin-users--id--standing"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PATCHapi-v1-admin-users--id--standing"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>account_standing</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="account_standing"                data-endpoint="PATCHapi-v1-admin-users--id--standing"
               value="Good"
               data-component="body">
    <br>
<p>Example: <code>Good</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Good</code></li> <li><code>Watchlist</code></li> <li><code>Suspended</code></li></ul>
        </div>
        </form>

                <h1 id="general">General</h1>

    

                                <h2 id="general-GETapi-v1--fallbackPlaceholder-">GET api/v1/{fallbackPlaceholder}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1--fallbackPlaceholder-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/|{+-0p" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/|{+-0p"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/|{+-0p';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/|{+-0p'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1--fallbackPlaceholder-">
    </span>
<span id="execution-results-GETapi-v1--fallbackPlaceholder-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1--fallbackPlaceholder-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1--fallbackPlaceholder-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1--fallbackPlaceholder-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1--fallbackPlaceholder-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1--fallbackPlaceholder-" data-method="GET"
      data-path="api/v1/{fallbackPlaceholder}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1--fallbackPlaceholder-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1--fallbackPlaceholder-"
                    onclick="tryItOut('GETapi-v1--fallbackPlaceholder-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1--fallbackPlaceholder-"
                    onclick="cancelTryOut('GETapi-v1--fallbackPlaceholder-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1--fallbackPlaceholder-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/{fallbackPlaceholder}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1--fallbackPlaceholder-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1--fallbackPlaceholder-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1--fallbackPlaceholder-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>fallbackPlaceholder</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="fallbackPlaceholder"                data-endpoint="GETapi-v1--fallbackPlaceholder-"
               value="|{+-0p"
               data-component="url">
    <br>
<p>Example: <code>|{+-0p</code></p>
            </div>
                    </form>

                <h1 id="listings-public-user">Listings (Public & User)</h1>

    <p>APIs for viewing public listings and managing the user's own portfolio.</p>

                                <h2 id="listings-public-user-GETapi-v1-listings">Public Market Listings</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get all verified and active listings for the Discover/Market views.</p>

<span id="example-requests-GETapi-v1-listings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/listings" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/listings"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/listings';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/listings'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-listings">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;seller&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Omar Faruk&quot;,
                &quot;standing&quot;: null
            },
            &quot;brand&quot;: &quot;Casio&quot;,
            &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
            &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
            &quot;price&quot;: 26000,
            &quot;condition&quot;: &quot;Excellent&quot;,
            &quot;case_size&quot;: &quot;41mm&quot;,
            &quot;year_of_production&quot;: &quot;2026&quot;,
            &quot;location&quot;: &quot;Kolkata&quot;,
            &quot;accessories&quot;: [
                &quot;Box&quot;,
                &quot;Papers&quot;
            ],
            &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
            &quot;images&quot;: [
                &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
                &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
            ],
            &quot;brand_certificate&quot;: null,
            &quot;status&quot;: &quot;Sold&quot;,
            &quot;is_verified&quot;: false,
            &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;
        },
        {
            &quot;id&quot;: 1,
            &quot;seller&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Omar Faruk&quot;,
                &quot;standing&quot;: null
            },
            &quot;brand&quot;: &quot;Casio&quot;,
            &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
            &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
            &quot;price&quot;: 26000,
            &quot;condition&quot;: &quot;Excellent&quot;,
            &quot;case_size&quot;: &quot;41mm&quot;,
            &quot;year_of_production&quot;: &quot;2026&quot;,
            &quot;location&quot;: &quot;Kolkata&quot;,
            &quot;accessories&quot;: [
                &quot;Box&quot;,
                &quot;Papers&quot;
            ],
            &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
            &quot;images&quot;: [
                &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
                &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
            ],
            &quot;brand_certificate&quot;: null,
            &quot;status&quot;: &quot;Sold&quot;,
            &quot;is_verified&quot;: false,
            &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-listings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-listings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-listings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-listings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-listings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-listings" data-method="GET"
      data-path="api/v1/listings"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-listings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-listings"
                    onclick="tryItOut('GETapi-v1-listings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-listings"
                    onclick="cancelTryOut('GETapi-v1-listings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-listings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/listings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-listings"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="listings-public-user-GETapi-v1-listings--id-">Show Public Listing</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get details of a specific listing. Unauthenticated users can only see live listings.</p>

<span id="example-requests-GETapi-v1-listings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/listings/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/listings/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/listings/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/listings/1'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-listings--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;seller&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Omar Faruk&quot;,
            &quot;standing&quot;: null
        },
        &quot;brand&quot;: &quot;Casio&quot;,
        &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
        &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
        &quot;price&quot;: 26000,
        &quot;condition&quot;: &quot;Excellent&quot;,
        &quot;case_size&quot;: &quot;41mm&quot;,
        &quot;year_of_production&quot;: &quot;2026&quot;,
        &quot;location&quot;: &quot;Kolkata&quot;,
        &quot;accessories&quot;: [
            &quot;Box&quot;,
            &quot;Papers&quot;
        ],
        &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
        &quot;images&quot;: [
            &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
            &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
        ],
        &quot;brand_certificate&quot;: null,
        &quot;status&quot;: &quot;Sold&quot;,
        &quot;is_verified&quot;: false,
        &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-listings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-listings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-listings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-listings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-listings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-listings--id-" data-method="GET"
      data-path="api/v1/listings/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-listings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-listings--id-"
                    onclick="tryItOut('GETapi-v1-listings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-listings--id-"
                    onclick="cancelTryOut('GETapi-v1-listings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-listings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/listings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-listings--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-listings--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the listing. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="listings-public-user-POSTapi-v1-listings">Create Listing</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new listing. Requires the user to have a 'Verified' KYC status.</p>

<span id="example-requests-POSTapi-v1-listings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/listings" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "sale_method=marketplace"\
    --form "brand=b"\
    --form "model=n"\
    --form "reference_number=g"\
    --form "price=12"\
    --form "condition=Very Good"\
    --form "case_size=m"\
    --form "year_of_production=i"\
    --form "location=y"\
    --form "condition_notes=architecto"\
    --form "images[]=@/tmp/php22ukao0ufv1pfJcEbID" \
    --form "brand_certificate=@/tmp/phpnngj25br388c4JhNfkD" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/listings"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('sale_method', 'marketplace');
body.append('brand', 'b');
body.append('model', 'n');
body.append('reference_number', 'g');
body.append('price', '12');
body.append('condition', 'Very Good');
body.append('case_size', 'm');
body.append('year_of_production', 'i');
body.append('location', 'y');
body.append('condition_notes', 'architecto');
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);
body.append('brand_certificate', document.querySelector('input[name="brand_certificate"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/listings';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'sale_method',
                'contents' =&gt; 'marketplace'
            ],
            [
                'name' =&gt; 'brand',
                'contents' =&gt; 'b'
            ],
            [
                'name' =&gt; 'model',
                'contents' =&gt; 'n'
            ],
            [
                'name' =&gt; 'reference_number',
                'contents' =&gt; 'g'
            ],
            [
                'name' =&gt; 'price',
                'contents' =&gt; '12'
            ],
            [
                'name' =&gt; 'condition',
                'contents' =&gt; 'Very Good'
            ],
            [
                'name' =&gt; 'case_size',
                'contents' =&gt; 'm'
            ],
            [
                'name' =&gt; 'year_of_production',
                'contents' =&gt; 'i'
            ],
            [
                'name' =&gt; 'location',
                'contents' =&gt; 'y'
            ],
            [
                'name' =&gt; 'condition_notes',
                'contents' =&gt; 'architecto'
            ],
            [
                'name' =&gt; 'images[]',
                'contents' =&gt; fopen('/tmp/php22ukao0ufv1pfJcEbID', 'r')
            ],
            [
                'name' =&gt; 'brand_certificate',
                'contents' =&gt; fopen('/tmp/phpnngj25br388c4JhNfkD', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/listings'
files = {
  'sale_method': (None, 'marketplace'),
  'brand': (None, 'b'),
  'model': (None, 'n'),
  'reference_number': (None, 'g'),
  'price': (None, '12'),
  'condition': (None, 'Very Good'),
  'case_size': (None, 'm'),
  'year_of_production': (None, 'i'),
  'location': (None, 'y'),
  'condition_notes': (None, 'architecto'),
  'images[]': open('/tmp/php22ukao0ufv1pfJcEbID', 'rb'),
  'brand_certificate': open('/tmp/phpnngj25br388c4JhNfkD', 'rb')}
payload = {
    "sale_method": "marketplace",
    "brand": "b",
    "model": "n",
    "reference_number": "g",
    "price": 12,
    "condition": "Very Good",
    "case_size": "m",
    "year_of_production": "i",
    "location": "y",
    "condition_notes": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'multipart/form-data',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, files=files)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-listings">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;seller&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Omar Faruk&quot;,
            &quot;standing&quot;: null
        },
        &quot;brand&quot;: &quot;Casio&quot;,
        &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
        &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
        &quot;price&quot;: 26000,
        &quot;condition&quot;: &quot;Excellent&quot;,
        &quot;case_size&quot;: &quot;41mm&quot;,
        &quot;year_of_production&quot;: &quot;2026&quot;,
        &quot;location&quot;: &quot;Kolkata&quot;,
        &quot;accessories&quot;: [
            &quot;Box&quot;,
            &quot;Papers&quot;
        ],
        &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
        &quot;images&quot;: [
            &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
            &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
        ],
        &quot;brand_certificate&quot;: null,
        &quot;status&quot;: &quot;Sold&quot;,
        &quot;is_verified&quot;: false,
        &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-listings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-listings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-listings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-listings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-listings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-listings" data-method="POST"
      data-path="api/v1/listings"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-listings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-listings"
                    onclick="tryItOut('POSTapi-v1-listings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-listings"
                    onclick="cancelTryOut('POSTapi-v1-listings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-listings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/listings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-listings"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-listings"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sale_method"                data-endpoint="POSTapi-v1-listings"
               value="marketplace"
               data-component="body">
    <br>
<p>Example: <code>marketplace</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>marketplace</code></li> <li><code>direct_sale</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brand</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brand"                data-endpoint="POSTapi-v1-listings"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>model</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="model"                data-endpoint="POSTapi-v1-listings"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reference_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reference_number"                data-endpoint="POSTapi-v1-listings"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>g</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-v1-listings"
               value="12"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>condition</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="condition"                data-endpoint="POSTapi-v1-listings"
               value="Very Good"
               data-component="body">
    <br>
<p>Example: <code>Very Good</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Excellent</code></li> <li><code>Very Good</code></li> <li><code>Good</code></li> <li><code>Fair</code></li> <li><code>Vintage</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_size</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_size"                data-endpoint="POSTapi-v1-listings"
               value="m"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>m</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>year_of_production</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="year_of_production"                data-endpoint="POSTapi-v1-listings"
               value="i"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>i</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>location</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="location"                data-endpoint="POSTapi-v1-listings"
               value="y"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>y</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>accessories</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="accessories"                data-endpoint="POSTapi-v1-listings"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>condition_notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="condition_notes"                data-endpoint="POSTapi-v1-listings"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="POSTapi-v1-listings"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="POSTapi-v1-listings"
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 5120 kilobytes.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brand_certificate</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="brand_certificate"                data-endpoint="POSTapi-v1-listings"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 10240 kilobytes. Example: <code>/tmp/phpnngj25br388c4JhNfkD</code></p>
        </div>
        </form>

                    <h2 id="listings-public-user-POSTapi-v1-listings--id-">Update Listing</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update an existing listing. Will resubmit the listing for admin review.</p>

<span id="example-requests-POSTapi-v1-listings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/listings/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "sale_method=marketplace"\
    --form "brand=b"\
    --form "model=n"\
    --form "reference_number=g"\
    --form "price=12"\
    --form "condition=Vintage"\
    --form "case_size=m"\
    --form "year_of_production=i"\
    --form "location=y"\
    --form "condition_notes=architecto"\
    --form "images[]=@/tmp/phpmkkjlfk42neiaKpIMaF" \
    --form "brand_certificate=@/tmp/phponrh21j1sicsedMCmcF" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/listings/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('sale_method', 'marketplace');
body.append('brand', 'b');
body.append('model', 'n');
body.append('reference_number', 'g');
body.append('price', '12');
body.append('condition', 'Vintage');
body.append('case_size', 'm');
body.append('year_of_production', 'i');
body.append('location', 'y');
body.append('condition_notes', 'architecto');
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);
body.append('brand_certificate', document.querySelector('input[name="brand_certificate"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/listings/1';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'sale_method',
                'contents' =&gt; 'marketplace'
            ],
            [
                'name' =&gt; 'brand',
                'contents' =&gt; 'b'
            ],
            [
                'name' =&gt; 'model',
                'contents' =&gt; 'n'
            ],
            [
                'name' =&gt; 'reference_number',
                'contents' =&gt; 'g'
            ],
            [
                'name' =&gt; 'price',
                'contents' =&gt; '12'
            ],
            [
                'name' =&gt; 'condition',
                'contents' =&gt; 'Vintage'
            ],
            [
                'name' =&gt; 'case_size',
                'contents' =&gt; 'm'
            ],
            [
                'name' =&gt; 'year_of_production',
                'contents' =&gt; 'i'
            ],
            [
                'name' =&gt; 'location',
                'contents' =&gt; 'y'
            ],
            [
                'name' =&gt; 'condition_notes',
                'contents' =&gt; 'architecto'
            ],
            [
                'name' =&gt; 'images[]',
                'contents' =&gt; fopen('/tmp/phpmkkjlfk42neiaKpIMaF', 'r')
            ],
            [
                'name' =&gt; 'brand_certificate',
                'contents' =&gt; fopen('/tmp/phponrh21j1sicsedMCmcF', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/listings/1'
files = {
  'sale_method': (None, 'marketplace'),
  'brand': (None, 'b'),
  'model': (None, 'n'),
  'reference_number': (None, 'g'),
  'price': (None, '12'),
  'condition': (None, 'Vintage'),
  'case_size': (None, 'm'),
  'year_of_production': (None, 'i'),
  'location': (None, 'y'),
  'condition_notes': (None, 'architecto'),
  'images[]': open('/tmp/phpmkkjlfk42neiaKpIMaF', 'rb'),
  'brand_certificate': open('/tmp/phponrh21j1sicsedMCmcF', 'rb')}
payload = {
    "sale_method": "marketplace",
    "brand": "b",
    "model": "n",
    "reference_number": "g",
    "price": 12,
    "condition": "Vintage",
    "case_size": "m",
    "year_of_production": "i",
    "location": "y",
    "condition_notes": "architecto"
}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'multipart/form-data',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, files=files)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-listings--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;seller&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Omar Faruk&quot;,
            &quot;standing&quot;: null
        },
        &quot;brand&quot;: &quot;Casio&quot;,
        &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
        &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
        &quot;price&quot;: 26000,
        &quot;condition&quot;: &quot;Excellent&quot;,
        &quot;case_size&quot;: &quot;41mm&quot;,
        &quot;year_of_production&quot;: &quot;2026&quot;,
        &quot;location&quot;: &quot;Kolkata&quot;,
        &quot;accessories&quot;: [
            &quot;Box&quot;,
            &quot;Papers&quot;
        ],
        &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
        &quot;images&quot;: [
            &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
            &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
        ],
        &quot;brand_certificate&quot;: null,
        &quot;status&quot;: &quot;Sold&quot;,
        &quot;is_verified&quot;: false,
        &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-listings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-listings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-listings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-listings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-listings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-listings--id-" data-method="POST"
      data-path="api/v1/listings/{id}"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-listings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-listings--id-"
                    onclick="tryItOut('POSTapi-v1-listings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-listings--id-"
                    onclick="cancelTryOut('POSTapi-v1-listings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-listings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/listings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-listings--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-listings--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-listings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-v1-listings--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the listing to update. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sale_method"                data-endpoint="POSTapi-v1-listings--id-"
               value="marketplace"
               data-component="body">
    <br>
<p>Example: <code>marketplace</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>marketplace</code></li> <li><code>direct_sale</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brand</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brand"                data-endpoint="POSTapi-v1-listings--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>model</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="model"                data-endpoint="POSTapi-v1-listings--id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reference_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reference_number"                data-endpoint="POSTapi-v1-listings--id-"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>g</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-v1-listings--id-"
               value="12"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>condition</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="condition"                data-endpoint="POSTapi-v1-listings--id-"
               value="Vintage"
               data-component="body">
    <br>
<p>Example: <code>Vintage</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Excellent</code></li> <li><code>Very Good</code></li> <li><code>Good</code></li> <li><code>Fair</code></li> <li><code>Vintage</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_size</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_size"                data-endpoint="POSTapi-v1-listings--id-"
               value="m"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>m</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>year_of_production</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="year_of_production"                data-endpoint="POSTapi-v1-listings--id-"
               value="i"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>i</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>location</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="location"                data-endpoint="POSTapi-v1-listings--id-"
               value="y"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>y</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>accessories</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="accessories"                data-endpoint="POSTapi-v1-listings--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>condition_notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="condition_notes"                data-endpoint="POSTapi-v1-listings--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="POSTapi-v1-listings--id-"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="POSTapi-v1-listings--id-"
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 5120 kilobytes.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brand_certificate</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="brand_certificate"                data-endpoint="POSTapi-v1-listings--id-"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 10240 kilobytes. Example: <code>/tmp/phponrh21j1sicsedMCmcF</code></p>
        </div>
        </form>

                    <h2 id="listings-public-user-GETapi-v1-user-listings">My Portfolio</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get all listings (regardless of status) belonging to the authenticated user.</p>

<span id="example-requests-GETapi-v1-user-listings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/user/listings" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/user/listings"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/user/listings';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/user/listings'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-user-listings">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;seller&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Omar Faruk&quot;,
                &quot;standing&quot;: null
            },
            &quot;brand&quot;: &quot;Casio&quot;,
            &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
            &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
            &quot;price&quot;: 26000,
            &quot;condition&quot;: &quot;Excellent&quot;,
            &quot;case_size&quot;: &quot;41mm&quot;,
            &quot;year_of_production&quot;: &quot;2026&quot;,
            &quot;location&quot;: &quot;Kolkata&quot;,
            &quot;accessories&quot;: [
                &quot;Box&quot;,
                &quot;Papers&quot;
            ],
            &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
            &quot;images&quot;: [
                &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
                &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
            ],
            &quot;brand_certificate&quot;: null,
            &quot;status&quot;: &quot;Sold&quot;,
            &quot;is_verified&quot;: false,
            &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;
        },
        {
            &quot;id&quot;: 1,
            &quot;seller&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Omar Faruk&quot;,
                &quot;standing&quot;: null
            },
            &quot;brand&quot;: &quot;Casio&quot;,
            &quot;model&quot;: &quot;Watch- EQS-920DB-1AV&quot;,
            &quot;reference_number&quot;: &quot;EQS-920DB-1AV&quot;,
            &quot;price&quot;: 26000,
            &quot;condition&quot;: &quot;Excellent&quot;,
            &quot;case_size&quot;: &quot;41mm&quot;,
            &quot;year_of_production&quot;: &quot;2026&quot;,
            &quot;location&quot;: &quot;Kolkata&quot;,
            &quot;accessories&quot;: [
                &quot;Box&quot;,
                &quot;Papers&quot;
            ],
            &quot;condition_notes&quot;: &quot;Mint condition, barely worn.&quot;,
            &quot;images&quot;: [
                &quot;http://10.10.28.53:81/storage/listings/images/1785572033_img-4.webp&quot;,
                &quot;http://10.10.28.53:81/storage/listings/images/1785572034_sort-logo.webp&quot;
            ],
            &quot;brand_certificate&quot;: null,
            &quot;status&quot;: &quot;Sold&quot;,
            &quot;is_verified&quot;: false,
            &quot;created_at&quot;: &quot;2026-08-01T04:53:16.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-01T08:22:23.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-user-listings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-user-listings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-user-listings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-user-listings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-user-listings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-user-listings" data-method="GET"
      data-path="api/v1/user/listings"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-user-listings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-user-listings"
                    onclick="tryItOut('GETapi-v1-user-listings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-user-listings"
                    onclick="cancelTryOut('GETapi-v1-user-listings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-user-listings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/user/listings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-user-listings"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-user-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-user-listings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="notifications">Notifications</h1>

    <p>APIs for managing the authenticated user's notifications.</p>

                                <h2 id="notifications-GETapi-v1-notifications">List Notifications</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of all notifications for the authenticated user.</p>

<span id="example-requests-GETapi-v1-notifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/notifications" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/notifications"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/notifications';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/notifications'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-notifications">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        [],
        []
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-notifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-notifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-notifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-notifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-notifications" data-method="GET"
      data-path="api/v1/notifications"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-notifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-notifications"
                    onclick="tryItOut('GETapi-v1-notifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-notifications"
                    onclick="cancelTryOut('GETapi-v1-notifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-notifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/notifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-notifications"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="notifications-GETapi-v1-notifications-stats">Get Notification Stats</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get the unread count for the authenticated user.</p>

<span id="example-requests-GETapi-v1-notifications-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/notifications/stats" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/notifications/stats"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/notifications/stats';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/notifications/stats'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-notifications-stats">
    </span>
<span id="execution-results-GETapi-v1-notifications-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-notifications-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-notifications-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-notifications-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-notifications-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-notifications-stats" data-method="GET"
      data-path="api/v1/notifications/stats"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-notifications-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-notifications-stats"
                    onclick="tryItOut('GETapi-v1-notifications-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-notifications-stats"
                    onclick="cancelTryOut('GETapi-v1-notifications-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-notifications-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/notifications/stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-notifications-stats"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-notifications-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-notifications-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="notifications-POSTapi-v1-notifications--notification_id--mark-as-read">Mark as Read</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mark a specific notification as read.</p>

<span id="example-requests-POSTapi-v1-notifications--notification_id--mark-as-read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/notifications/architecto/mark-as-read" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/notifications/architecto/mark-as-read"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/notifications/architecto/mark-as-read';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/notifications/architecto/mark-as-read'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-notifications--notification_id--mark-as-read">
</span>
<span id="execution-results-POSTapi-v1-notifications--notification_id--mark-as-read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-notifications--notification_id--mark-as-read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-notifications--notification_id--mark-as-read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-notifications--notification_id--mark-as-read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-notifications--notification_id--mark-as-read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-notifications--notification_id--mark-as-read" data-method="POST"
      data-path="api/v1/notifications/{notification_id}/mark-as-read"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-notifications--notification_id--mark-as-read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-notifications--notification_id--mark-as-read"
                    onclick="tryItOut('POSTapi-v1-notifications--notification_id--mark-as-read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-notifications--notification_id--mark-as-read"
                    onclick="cancelTryOut('POSTapi-v1-notifications--notification_id--mark-as-read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-notifications--notification_id--mark-as-read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/notifications/{notification_id}/mark-as-read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-notifications--notification_id--mark-as-read"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-notifications--notification_id--mark-as-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-notifications--notification_id--mark-as-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>notification_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notification_id"                data-endpoint="POSTapi-v1-notifications--notification_id--mark-as-read"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the notification. Example: <code>architecto</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>notification</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notification"                data-endpoint="POSTapi-v1-notifications--notification_id--mark-as-read"
               value="99c72e27-6f81-432d-9486-d24830ffbc38"
               data-component="url">
    <br>
<p>The ID of the notification. Example: <code>99c72e27-6f81-432d-9486-d24830ffbc38</code></p>
            </div>
                    </form>

                    <h2 id="notifications-POSTapi-v1-notifications-mark-all-as-read">Mark All as Read</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mark all unread notifications for the authenticated user as read.</p>

<span id="example-requests-POSTapi-v1-notifications-mark-all-as-read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/notifications/mark-all-as-read" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/notifications/mark-all-as-read"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/notifications/mark-all-as-read';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/notifications/mark-all-as-read'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-notifications-mark-all-as-read">
</span>
<span id="execution-results-POSTapi-v1-notifications-mark-all-as-read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-notifications-mark-all-as-read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-notifications-mark-all-as-read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-notifications-mark-all-as-read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-notifications-mark-all-as-read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-notifications-mark-all-as-read" data-method="POST"
      data-path="api/v1/notifications/mark-all-as-read"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-notifications-mark-all-as-read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-notifications-mark-all-as-read"
                    onclick="tryItOut('POSTapi-v1-notifications-mark-all-as-read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-notifications-mark-all-as-read"
                    onclick="cancelTryOut('POSTapi-v1-notifications-mark-all-as-read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-notifications-mark-all-as-read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/notifications/mark-all-as-read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-notifications-mark-all-as-read"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-notifications-mark-all-as-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-notifications-mark-all-as-read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="notifications-DELETEapi-v1-notifications--id-">Delete Notification</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete a specific notification.</p>

<span id="example-requests-DELETEapi-v1-notifications--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://10.10.28.53:81/api/v1/notifications/architecto" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/notifications/architecto"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/notifications/architecto';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/notifications/architecto'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-notifications--id-">
</span>
<span id="execution-results-DELETEapi-v1-notifications--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-notifications--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-notifications--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-notifications--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-notifications--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-notifications--id-" data-method="DELETE"
      data-path="api/v1/notifications/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-notifications--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-notifications--id-"
                    onclick="tryItOut('DELETEapi-v1-notifications--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-notifications--id-"
                    onclick="cancelTryOut('DELETEapi-v1-notifications--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-notifications--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/notifications/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-notifications--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-notifications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-notifications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-notifications--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the notification. Example: <code>architecto</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>notification</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notification"                data-endpoint="DELETEapi-v1-notifications--id-"
               value="99c72e27-6f81-432d-9486-d24830ffbc38"
               data-component="url">
    <br>
<p>The ID of the notification. Example: <code>99c72e27-6f81-432d-9486-d24830ffbc38</code></p>
            </div>
                    </form>

                <h1 id="user-dealer-kyc">User & Dealer KYC</h1>

    <p>APIs for users and dealers to submit their KYC documents and check their status.</p>

                                <h2 id="user-dealer-kyc-POSTapi-v1-kyc-submit">Submit KYC</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Submit KYC documents for verification.</p>

<span id="example-requests-POSTapi-v1-kyc-submit">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://10.10.28.53:81/api/v1/kyc/submit" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "trade_license=@/tmp/phpv7re56uo319o7jKelCK" \
    --form "nid_front=@/tmp/phpaktaq9ova4mjbCeeIGK" \
    --form "nid_back=@/tmp/phpv3kuk6van0om1KngkGK" \
    --form "passport=@/tmp/phpl6pbnji7grkj2MHFgHK" \
    --form "utility_bill=@/tmp/phpmotdeucj7fqj9koHMIK" \
    --form "id_front=@/tmp/phpgg5r8uha5r50dFdpIJK" \
    --form "id_back=@/tmp/phpa4m7pj4j1rci5CkMcJK" \
    --form "selfie=@/tmp/phpqmmmm83nclnj3dikOKK" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/kyc/submit"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('trade_license', document.querySelector('input[name="trade_license"]').files[0]);
body.append('nid_front', document.querySelector('input[name="nid_front"]').files[0]);
body.append('nid_back', document.querySelector('input[name="nid_back"]').files[0]);
body.append('passport', document.querySelector('input[name="passport"]').files[0]);
body.append('utility_bill', document.querySelector('input[name="utility_bill"]').files[0]);
body.append('id_front', document.querySelector('input[name="id_front"]').files[0]);
body.append('id_back', document.querySelector('input[name="id_back"]').files[0]);
body.append('selfie', document.querySelector('input[name="selfie"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/kyc/submit';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'trade_license',
                'contents' =&gt; fopen('/tmp/phpv7re56uo319o7jKelCK', 'r')
            ],
            [
                'name' =&gt; 'nid_front',
                'contents' =&gt; fopen('/tmp/phpaktaq9ova4mjbCeeIGK', 'r')
            ],
            [
                'name' =&gt; 'nid_back',
                'contents' =&gt; fopen('/tmp/phpv3kuk6van0om1KngkGK', 'r')
            ],
            [
                'name' =&gt; 'passport',
                'contents' =&gt; fopen('/tmp/phpl6pbnji7grkj2MHFgHK', 'r')
            ],
            [
                'name' =&gt; 'utility_bill',
                'contents' =&gt; fopen('/tmp/phpmotdeucj7fqj9koHMIK', 'r')
            ],
            [
                'name' =&gt; 'id_front',
                'contents' =&gt; fopen('/tmp/phpgg5r8uha5r50dFdpIJK', 'r')
            ],
            [
                'name' =&gt; 'id_back',
                'contents' =&gt; fopen('/tmp/phpa4m7pj4j1rci5CkMcJK', 'r')
            ],
            [
                'name' =&gt; 'selfie',
                'contents' =&gt; fopen('/tmp/phpqmmmm83nclnj3dikOKK', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/kyc/submit'
files = {
  'trade_license': open('/tmp/phpv7re56uo319o7jKelCK', 'rb'),
  'nid_front': open('/tmp/phpaktaq9ova4mjbCeeIGK', 'rb'),
  'nid_back': open('/tmp/phpv3kuk6van0om1KngkGK', 'rb'),
  'passport': open('/tmp/phpl6pbnji7grkj2MHFgHK', 'rb'),
  'utility_bill': open('/tmp/phpmotdeucj7fqj9koHMIK', 'rb'),
  'id_front': open('/tmp/phpgg5r8uha5r50dFdpIJK', 'rb'),
  'id_back': open('/tmp/phpa4m7pj4j1rci5CkMcJK', 'rb'),
  'selfie': open('/tmp/phpqmmmm83nclnj3dikOKK', 'rb')}
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'multipart/form-data',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, files=files)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-kyc-submit">
</span>
<span id="execution-results-POSTapi-v1-kyc-submit" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-kyc-submit"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-kyc-submit"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-kyc-submit" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-kyc-submit">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-kyc-submit" data-method="POST"
      data-path="api/v1/kyc/submit"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-kyc-submit', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-kyc-submit"
                    onclick="tryItOut('POSTapi-v1-kyc-submit');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-kyc-submit"
                    onclick="cancelTryOut('POSTapi-v1-kyc-submit');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-kyc-submit"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/kyc/submit</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-kyc-submit"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-kyc-submit"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-kyc-submit"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trade_license</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="trade_license"                data-endpoint="POSTapi-v1-kyc-submit"
               value=""
               data-component="body">
    <br>
<p>This field is required when none of <code>nid_front</code>, <code>nid_back</code>, <code>passport</code>, and <code>utility_bill</code> are present. Must be a file. Must not be greater than 5120 kilobytes. Example: <code>/tmp/phpv7re56uo319o7jKelCK</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nid_front</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="nid_front"                data-endpoint="POSTapi-v1-kyc-submit"
               value=""
               data-component="body">
    <br>
<p>This field is required when none of <code>trade_license</code>, <code>passport</code>, and <code>utility_bill</code> are present. Must be a file. Must not be greater than 5120 kilobytes. Example: <code>/tmp/phpaktaq9ova4mjbCeeIGK</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nid_back</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="nid_back"                data-endpoint="POSTapi-v1-kyc-submit"
               value=""
               data-component="body">
    <br>
<p>This field is required when <code>nid_front</code> is present. Must be a file. Must not be greater than 5120 kilobytes. Example: <code>/tmp/phpv3kuk6van0om1KngkGK</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>passport</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="passport"                data-endpoint="POSTapi-v1-kyc-submit"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 5120 kilobytes. Example: <code>/tmp/phpl6pbnji7grkj2MHFgHK</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>utility_bill</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="utility_bill"                data-endpoint="POSTapi-v1-kyc-submit"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 5120 kilobytes. Example: <code>/tmp/phpmotdeucj7fqj9koHMIK</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_front</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="id_front"                data-endpoint="POSTapi-v1-kyc-submit"
               value=""
               data-component="body">
    <br>
<p>The front side of the ID card. Example: <code>/tmp/phpgg5r8uha5r50dFdpIJK</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_back</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="id_back"                data-endpoint="POSTapi-v1-kyc-submit"
               value=""
               data-component="body">
    <br>
<p>The back side of the ID card. Example: <code>/tmp/phpa4m7pj4j1rci5CkMcJK</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>selfie</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="selfie"                data-endpoint="POSTapi-v1-kyc-submit"
               value=""
               data-component="body">
    <br>
<p>A selfie of the user holding the ID. Example: <code>/tmp/phpqmmmm83nclnj3dikOKK</code></p>
        </div>
        </form>

                    <h2 id="user-dealer-kyc-GETapi-v1-kyc-status">Check KYC Status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get the authenticated user's current KYC status and submitted documents.</p>

<span id="example-requests-GETapi-v1-kyc-status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://10.10.28.53:81/api/v1/kyc/status" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://10.10.28.53:81/api/v1/kyc/status"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://10.10.28.53:81/api/v1/kyc/status';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer Bearer {YOUR_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'http://10.10.28.53:81/api/v1/kyc/status'
headers = {
  'Authorization': 'Bearer Bearer {YOUR_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-kyc-status">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;user_id&quot;: 24,
        &quot;name&quot;: &quot;Mathilde Hackett&quot;,
        &quot;email&quot;: &quot;nathanial69@example.com&quot;,
        &quot;kyc_status&quot;: &quot;pending&quot;,
        &quot;dealer_tier&quot;: &quot;unverified&quot;,
        &quot;rejection_reason&quot;: null,
        &quot;documents&quot;: []
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-kyc-status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-kyc-status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-kyc-status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-kyc-status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-kyc-status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-kyc-status" data-method="GET"
      data-path="api/v1/kyc/status"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-kyc-status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-kyc-status"
                    onclick="tryItOut('GETapi-v1-kyc-status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-kyc-status"
                    onclick="cancelTryOut('GETapi-v1-kyc-status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-kyc-status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/kyc/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-kyc-status"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-kyc-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-kyc-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                                        <button type="button" class="lang-button" data-language-name="php">php</button>
                                                        <button type="button" class="lang-button" data-language-name="python">python</button>
                            </div>
            </div>
</div>
</body>
</html>
