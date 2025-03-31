<?php 
/*
Practice Task: Implement a Payment Gateway Adapter
Scenario:
You are building an e-commerce platform, and your system needs to support multiple payment gateways like PayPal and Stripe. However, each gateway has a different API structure.

To keep your code clean and consistent, you will use the Adapter Pattern to create a unified interface that allows your system to interact with different payment providers without modifying existing code.

Your Task
1️⃣ Create a PaymentProcessor interface that defines a pay($amount) method.
2️⃣ Implement two separate classes for different payment providers:

PayPalPayment: Uses PayPal’s sendPayment($amount).

StripePayment: Uses Stripe’s chargeAmount($amount).
3️⃣ Create Adapter Classes that adapt these payment methods to match PaymentProcessor.

PayPalAdapter: Converts sendPayment($amount) into pay($amount).

StripeAdapter: Converts chargeAmount($amount) into pay($amount).
4️⃣ Write a test case where the system processes payments using both PayPal and Stripe via the Adapter.

Expected Usage Example
Once you implement the Adapter Pattern correctly, your code should work like this:

php
Copy
Edit
$paypalAdapter = new PayPalAdapter(new PayPalPayment());
$stripeAdapter = new StripeAdapter(new StripePayment());

$paypalAdapter->pay(100);  // PayPal processes $100
$stripeAdapter->pay(200);  // Stripe processes $200
✅ Expected Output:

nginx
Copy
Edit
Processing $100 via PayPal...
Charging $200 via Stripe...
Bonus Challenges
✅ Extendability: Add another payment gateway (e.g., Google Pay, Apple Pay) without modifying existing code.
✅ Dependency Injection: Pass the adapter to a function that expects a PaymentProcessor interface.
✅ Logging: Add logging inside the adapters to track all transactions.

*/

interface PaymentProcessor
{
    public function pay($amount);
}

class PayPalPayment
{
    public function sendPayment($amount)
    {
        echo "Paying $amount via PayPal...\n";
    }
}

class StripePayment
{
    public function chargeAmount($amount)
    {
        echo "Charging $amount via Stripe...\n";
    }
}

class PayPalAdapter implements PaymentProcessor
{
    private $paypal;

    public function __construct(PayPalPayment $paypal)
    {
        $this->paypal = $paypal;
    }

    public function pay($amount)
    {
        $this->paypal->sendPayment($amount);
    }
}

class StripeAdapter implements PaymentProcessor
{
    private $stripe;

    public function __construct(StripePayment $stripe)
    {
        $this->stripe = $stripe;
    }

    public function pay($amount)
    {
        $this->stripe->chargeAmount($amount);
    }
}

$paypalAdapter = new PayPalAdapter(new PayPalPayment());
$stripeAdapter = new StripeAdapter(new StripePayment());
$paypalAdapter->pay(100);
$stripeAdapter->pay(200);