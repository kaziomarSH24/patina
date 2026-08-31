# Frontend Developer Guide: Watch Listing & Razorpay Payment Flow

This document explains the step-by-step process for a user to create a new watch listing, including the ₹999 Listing Fee payment via Razorpay.

---

## 🚦 Business Logic
*   **Dealer Users:** Do **NOT** need to pay the ₹999 fee. They can bypass the payment steps and go directly to **Step 3**.
*   **Private Sellers (Normal Users):** MUST pay the ₹999 fee via Razorpay before their listing is accepted by the backend.

---

## 🛠️ Step-by-Step Flow

### Step 1: Initiate Razorpay Order (Create Order)
When a Private Seller fills out the listing form and clicks "Submit/Pay", the frontend must first request an Order ID from the backend.

*   **Endpoint:** `POST /api/v1/listings/pay-fee/initiate`
*   **Headers:** `Authorization: Bearer <user_token>`
*   **Body:** None
*   **Response (Success):**
    ```json
    {
      "ok": true,
      "message": "Listing fee order created",
      "data": {
        "order_id": "order_TVwPouavqr4bhq",
        "amount": 999,
        "currency": "INR"
      }
    }
    ```

### Step 2: Open Razorpay Checkout
Using the Razorpay SDK (React Native, React, Next.js, etc.), open the payment modal using the `order_id` received from Step 1.

*   The user completes the payment via Card/UPI/NetBanking.
*   Upon successful payment, the Razorpay SDK will return a success object containing 3 crucial strings:
    1.  `razorpay_payment_id`
    2.  `razorpay_order_id`
    3.  `razorpay_signature`

### Step 3: Create the Listing (Submit to Backend)
Now that the payment is successful, the frontend submits the actual watch listing data, **appending the Razorpay payment details** to the form data.

*   **Endpoint:** `POST /api/v1/listings`
*   **Headers:** `Authorization: Bearer <user_token>`
*   **Body (Multipart Form-Data):**
    ```text
    brand: Rolex
    model: Submariner Date
    price: 1150000
    condition: Excellent
    images[0]: (file)
    ...
    razorpay_order_id: order_TVwPouavqr4bhq
    razorpay_payment_id: pay_H2wJxyz...
    razorpay_signature: d8f3e2a1b...
    ```

### ✅ Backend Validation
When the backend receives this request, it will internally verify the `razorpay_signature` with Razorpay's servers. 
*   If the payment is **100% valid**, the watch will be saved in the database and its status will be set to `Pending` (awaiting Admin approval).
*   If the payment is **fake or invalid**, the backend will throw a `400 Invalid Signature` error and the listing will **NOT** be saved.
