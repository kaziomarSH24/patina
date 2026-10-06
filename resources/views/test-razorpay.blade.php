<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Test Flow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body class="bg-gray-100 p-8 font-sans">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Manual Payment Tester</h1>
        <p class="text-gray-600 mb-6 border-b pb-4">Paste the <code class="bg-gray-100 text-pink-500 px-1 rounded">subscription_id</code> you got from Postman to open the payment modal.</p>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Subscription ID</label>
            <input type="text" id="sub_id" placeholder="e.g. sub_TkZLFifxZIUBgr" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <button onclick="openRazorpay()" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
            Open Razorpay Checkout
        </button>

        <div class="mt-8 p-4 bg-gray-900 text-green-400 rounded font-mono text-sm h-48 overflow-y-auto" id="logBox">
            > Ready for testing...
        </div>
    </div>

    <script>
        const RAZORPAY_KEY = "{{ config('services.razorpay.key') }}";

        function log(msg) {
            const box = document.getElementById('logBox');
            box.innerHTML += `<br>> ${msg}`;
            box.scrollTop = box.scrollHeight;
        }

        function openRazorpay() {
            const subId = document.getElementById('sub_id').value.trim();
            if (!subId) {
                alert("Please enter a Subscription ID!");
                return;
            }

            log(`Opening checkout for: ${subId}...`);
            
            var options = {
                "key": RAZORPAY_KEY,
                "subscription_id": subId,
                "name": "Patina Dashboard",
                "description": "Dealer Subscription Payment",
                "handler": function (response) {
                    log(`✅ Payment SUCCESS! Payment ID: ${response.razorpay_payment_id}`);
                    log(`Signature: ${response.razorpay_signature}`);
                    log('Webhook will now process this payment in the background.');
                    alert('Payment successful! Check the admin dashboard.');
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            
            var rzp1 = new Razorpay(options);
            
            rzp1.on('payment.failed', function (response){
                log(`❌ Payment FAILED! Reason: ${response.error.description}`);
            });
            
            rzp1.open();
        }
    </script>
</body>
</html>
