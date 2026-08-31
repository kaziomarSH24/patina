<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Razorpay Payment Flow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 font-sans">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Test Listing Fee Payment (₹999)</h1>
        
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="token">
                1. Enter your Bearer Token (Copy from Bruno Login API)
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="token" type="text" placeholder="Bearer 1|abc123xyz...">
        </div>

        <button id="pay-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
            2. Pay ₹999 Listing Fee
        </button>

        <div id="status" class="mt-4 text-sm font-semibold text-gray-600"></div>

        <div id="result" class="mt-6 hidden">
            <h3 class="text-lg font-bold text-green-600 mb-2">Payment Successful! 🎉</h3>
            <p class="text-sm text-gray-600 mb-4">Copy these details and paste them into your Bruno <b>Create Listing</b> API body to test the backend verification.</p>
            
            <div class="bg-gray-100 p-4 rounded text-sm font-mono overflow-x-auto">
                <p><strong>razorpay_order_id:</strong> <span id="res_order" class="select-all text-blue-600"></span></p>
                <p class="mt-2"><strong>razorpay_payment_id:</strong> <span id="res_payment" class="select-all text-blue-600"></span></p>
                <p class="mt-2"><strong>razorpay_signature:</strong> <span id="res_signature" class="select-all text-blue-600"></span></p>
            </div>
        </div>
    </div>

    <!-- Razorpay SDK -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('pay-btn').onclick = async function (e) {
            e.preventDefault();
            
            const token = document.getElementById('token').value;
            const statusDiv = document.getElementById('status');
            
            if (!token) {
                alert('Please enter your Bearer Token first!');
                return;
            }

            // Standardize token format
            const authToken = token.startsWith('Bearer ') ? token : 'Bearer ' + token;

            try {
                statusDiv.innerText = "Initiating Order with Backend API...";
                statusDiv.className = "mt-4 text-sm font-semibold text-blue-600";

                // Step 1: Call your backend to initiate the order
                const response = await fetch('/api/v1/listings/pay-fee/initiate', {
                    method: 'POST',
                    headers: {
                        'Authorization': authToken,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Failed to initiate order');
                }

                statusDiv.innerText = "Order Created: " + data.data.order_id + ". Opening Razorpay...";

                // Step 2: Open Razorpay Checkout
                const options = {
                    "key": "{{ config('services.razorpay.key') }}", 
                    "amount": data.data.amount * 100, // paise
                    "currency": data.data.currency,
                    "name": "Patina",
                    "description": "Watch Listing Fee",
                    "order_id": data.data.order_id,
                    "handler": function (response) {
                        // On Success
                        document.getElementById('result').classList.remove('hidden');
                        document.getElementById('res_order').innerText = response.razorpay_order_id;
                        document.getElementById('res_payment').innerText = response.razorpay_payment_id;
                        document.getElementById('res_signature').innerText = response.razorpay_signature;
                        
                        statusDiv.innerText = "";
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                
                const rzp1 = new Razorpay(options);
                
                rzp1.on('payment.failed', function (response){
                    alert("Payment Failed! Reason: " + response.error.description);
                });

                rzp1.open();

            } catch (error) {
                statusDiv.innerText = "Error: " + error.message;
                statusDiv.className = "mt-4 text-sm font-semibold text-red-600";
            }
        };
    </script>
</body>
</html>
