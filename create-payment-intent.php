<?php
require __DIR__ . '/wp-content/themes/isa-elaine/stripe-php/init.php';

\Stripe\Stripe::setApiKey('sk_test_51RidE34gNYgtyhYfkPkFqgum56P1WGiKlJxKoOflORQM97Pt44N1eipiQpmZk0ltQMASgoxgQSjcbCmlWQkWGY7B00tQqqwYEz'); // Replace with your Stripe secret key

header('Content-Type: application/json');

// Collect inputs safely
$amount         = isset($_POST['final_donation_amount']) ? intval($_POST['final_donation_amount']) : 0;
$donor_email    = isset($_POST['donor-email']) ? filter_var(trim($_POST['donor-email']), FILTER_SANITIZE_EMAIL) : '';
$donor_name     = isset($_POST['donor-name']) ? filter_var(trim($_POST['donor-name']), FILTER_SANITIZE_STRING) : '';
$donor_type     = isset($_POST['donor-type']) ? filter_var(trim($_POST['donor-type']), FILTER_SANITIZE_STRING) : 'individual';

// Validation
if ($amount < 100 || !$donor_email) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing donation amount or email']);
    exit;
}

// Metadata: always include full donor context
$metadata = array_filter([
    'donor_email'   => $donor_email,
    'donor_name'    => $donor_name,
    'donor_type'    => $donor_type,
    'created_from'  => 'custom-donation-form',
], fn($v) => $v !== '');

try {
    $intent = \Stripe\PaymentIntent::create([
        'amount' => $amount,
        'currency' => 'usd',
        'payment_method_types' => ['us_bank_account', 'card'],
        'receipt_email' => $donor_email,
        'metadata' => $metadata
    ]);

    echo json_encode([
        'clientSecret' => $intent->client_secret,
        'intentId'     => $intent->id
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

