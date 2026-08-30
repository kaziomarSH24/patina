<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Test Flow</title>
    <!-- Tailwind CSS for basic styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Razorpay SDK -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body class="bg-gray-100 p-8 font-sans">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Mobile App Simulation: Dealer Onboarding</h1>
        <p class="text-gray-600 mb-6">Logged in as: <strong class="text-black">{{ $user->name }}</strong></p>
        
        <!-- Step 1: Loading Plans -->
        <div id="step-1" class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Step 1: Select a Plan</h2>
            <div id="plans-container" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <p class="text-gray-500">Loading plans from API...</p>
            </div>
        </div>

        <!-- Log Area for visibility -->
        <div class="mt-8 p-4 bg-gray-900 text-green-400 rounded font-mono text-sm h-64 overflow-y-auto" id="logBox">
            > Simulator started...
        </div>
    </div>

    <script>
        const API_TOKEN = "{{ $token }}";
        const API_BASE = "/api/v1";

        function log(msg) {
            const box = document.getElementById('logBox');
            box.innerHTML += `<br>> ${msg}`;
            box.scrollTop = box.scrollHeight;
        }

        // Standard fetch wrapper with auth header
        async function apiCall(endpoint, method = 'GET', body = null) {
            const options = {
                method,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${API_TOKEN}`
                }
            };
            if (body) options.body = JSON.stringify(body);
            
            const res = await fetch(`${API_BASE}${endpoint}`, options);
            return await res.json();
        }

        // Fetch Plans on Load
        async function loadPlans() {
            log('Fetching subscription plans (/api/v1/subscription-plans)...');
            try {
                const response = await apiCall('/subscription-plans');
                const container = document.getElementById('plans-container');
                container.innerHTML = '';
                
                if(response.data) {
                    response.data.forEach(plan => {
                        const div = document.createElement('div');
                        div.className = "border rounded p-4 text-center hover:shadow-lg cursor-pointer transition-all";
                        div.innerHTML = `
                            <h3 class="font-bold text-lg">${plan.name}</h3>
                            <p class="text-xl font-semibold text-blue-600 my-2">₹${plan.price}</p>
                            <button onclick="selectPlan(${plan.id}, '${plan.name}')" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700">Select</button>
                        `;
                        container.appendChild(div);
                    });
                    log('Plans loaded successfully.');
                }
            } catch(e) {
                log('Error loading plans: ' + e);
            }
        }

        // When a plan is clicked, simulate the mobile app's sequential API calls
        async function selectPlan(planId, planName) {
            log(`Selected Plan: ${planName} (ID: ${planId})`);
            
            // Simulating Step 2: Form Submit
            log('Simulating Business Details submission (/api/v1/dealer/onboarding/submit)...');
            
            const submitData = {
                subscription_plan_id: planId,
                business_name: "Demo Watch Store",
                address: "123 Demo Street, Web",
                phone_number: "+8801999999991",
                approx_monthly_inventory: "10-50",
                website_link: "https://demostore.com"
            };

            const submitRes = await apiCall('/dealer/onboarding/submit', 'POST', submitData);
            
            if(submitRes.ok === true || submitRes.success) {
                log('Onboarding data saved successfully. Profile is pending.');
                
                // Immediately call Checkout Initiation
                log('Initiating Checkout (/api/v1/dealer/subscription/initiate)...');
                const initRes = await apiCall('/dealer/subscription/initiate', 'POST');
                
                if((initRes.ok === true || initRes.success) && initRes.data) {
                    const subData = initRes.data;
                    log(`Razorpay Subscription ID generated: ${subData.subscription_id}`);
                    openRazorpay(subData);
                } else {
                    log('Error initiating subscription: ' + JSON.stringify(initRes));
                }

            } else {
                log('Error submitting onboarding: ' + JSON.stringify(submitRes));
            }
        }

        // Open Razorpay Modal
        function openRazorpay(data) {
            log('Opening Razorpay Checkout Modal...');
            var options = {
                "key": data.razorpay_key,
                "subscription_id": data.subscription_id,
                "name": "Patina",
                "description": data.plan_name + " Subscription",
                "image": "https://your-logo-url.com/logo.png", 
                "handler": function (response) {
                    // This function is called on success
                    log(`Payment SUCCESS! Payment ID: ${response.razorpay_payment_id}`);
                    log('Webhook will now receive this in the background and activate the profile.');
                    alert('Payment successful! Your dealer profile is now active.');
                },
                "prefill": {
                    "name": "{{ $user->name }}",
                    "email": "{{ $user->email }}",
                    "contact": "{{ $user->phone_number }}"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            
            rzp1.on('payment.failed', function (response){
                log(`Payment FAILED! Reason: ${response.error.description}`);
            });
            
            rzp1.open();
        }

        // Initialize
        loadPlans();
    </script>
</body>
</html>
