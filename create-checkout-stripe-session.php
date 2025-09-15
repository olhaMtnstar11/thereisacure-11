<?php
require __DIR__ . '/wp-content/themes/isa-elaine/stripe-php/init.php';

// Switch keys based on domain
$host = $_SERVER['HTTP_HOST'] ?? '';
$stripeKey = 'sk_test_51RidE34gNYgtyhYfkPkFqgum56P1WGiKlJxKoOflORQM97Pt44N1eipiQpmZk0ltQMASgoxgQSjcbCmlWQkWGY7B00tQqqwYEz';
\Stripe\Stripe::setApiKey($stripeKey);

// Validate required fields
if (!isset($_POST['raw_donation_amount']) || !is_numeric($_POST['raw_donation_amount']) || $_POST['raw_donation_amount'] < 1) {
    http_response_code(400);
    echo 'Invalid donation amount.';
    exit;
}

// Inputs
$raw_amount = floatval($_POST['raw_donation_amount']);

// Validate donation amount
$raw_amount = floatval($_POST['raw_donation_amount'] ?? 0);
if ($raw_amount < 1) {
    http_response_code(400);
    echo 'Invalid donation amount.';
    exit;
}


$payment_method = $_POST['payment-method'] ?? 'card';
$include_fee = isset($_POST['add-fee-checkbox']) && $_POST['add-fee-checkbox'] === 'on';
$donation_frequency = $_POST['donation_frequency'] ?? 'once';
$donor_email = trim($_POST['donor-email'] ?? '');
$is_bank = ($payment_method === 'bank' || $payment_method === 'us_bank_account');

// Extra donor fields
$donor_name = trim($_POST['donor-name'] ?? '');
$donor_phone   = trim($_POST['stripe_donor_phone'] ?? '');
$donation_note = trim($_POST['donation_note'] ?? '');

$donor_type    = trim($_POST['stripe_donor_type'] ?? 'individual');
$company_name  = trim($_POST['stripe_company_name'] ?? '');
$company_ein   = trim($_POST['stripe_company_ein'] ?? '');

// === FEE CALCULATION ===
if ($include_fee) {
    if ($is_bank) {
        $estimated = $raw_amount / (1 - 0.008);
        $fee = ($estimated * 0.008 <= 5.00) ? $estimated - $raw_amount : 5.00;
        $total = $raw_amount + $fee;
    } else {
        $total = ($raw_amount + 0.30) / 0.971;
        $fee = $total - $raw_amount;
    }
    $donation_amount = $raw_amount;
} else {
    $total = $raw_amount;
    if ($is_bank) {
        $fee = min($raw_amount * 0.008, 5.00);
    } else {
        $fee = $raw_amount * 0.029 + 0.30;
    }
    $donation_amount = $raw_amount - $fee;
}

// Round amounts and convert for Stripe
$fee = round($fee, 2);
$total = round($total, 2);
$donation_amount = round($donation_amount, 2);
$amount_to_charge = intval(round($total * 100)); // cents







// Metadata
$metadata = array_filter([
    'donor_email'       => $donor_email,
    'donor_name'        => $donor_name,
    'donor_phone'       => $donor_phone,
    'donor_type'        => $donor_type,
    'company_name'      => $company_name,
    'company_ein'       => $company_ein,
    'donation_note'     => $donation_note,
    'donation_frequency'=> $donation_frequency,
    'payment_method'    => $payment_method,
    'fee_covered'       => $include_fee ? 'yes' : 'no',
    'fee_amount'        => number_format($fee, 2, '.', ''),
    'total_charged'     => number_format($total, 2, '.', ''),
    'created_from'      => 'custom-donation-form',
    'olha_field'    => '1-olhaolhaolha'
], fn($v) => $v !== '');

// Customer data
$customer_data = [
    'name' => $donor_name,
    'email'=> $donor_email,
    'phone'=> $donor_phone,
    'metadata' => $metadata
];





// === Create Stripe Checkout Session ===
try {
    $session_data = [
        'payment_method_types' => $is_bank ? ['us_bank_account'] : ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => 'Donation'],
                'unit_amount' => $amount_to_charge,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'billing_address_collection' => 'auto',
        'customer_creation' => 'always',
        'customer_email' => $donor_email ?: null,
        'success_url' => 'https://thereisacure.wpenginepowered.com/thank-you-page?session_id={CHECKOUT_SESSION_ID}',
        'return_url' => 'https://thereisacure.wpenginepowered.com/thank-you-page?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'https://thereisacure.wpenginepowered.com/donate',
        'payment_intent_data' => [
            'metadata' => $metadata
        ],
    ];


// Optionally, you can check if a customer already exists by email
    $customer = \Stripe\Customer::create($customer_data);

// Then attach the customer to the Checkout Session
    $session_data['customer'] = $customer->id;


    $checkout_session = \Stripe\Checkout\Session::create($session_data);



    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo 'Stripe error: ' . htmlspecialchars($e->getMessage());
}


