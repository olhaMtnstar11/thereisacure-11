<?php
require __DIR__ . '/wp-content/themes/isa-elaine/stripe-php/init.php';

\Stripe\Stripe::setApiKey('sk_test_51RidE34gNYgtyhYfkPkFqgum56P1WGiKlJxKoOflORQM97Pt44N1eipiQpmZk0ltQMASgoxgQSjcbCmlWQkWGY7B00tQqqwYEz');

header('Content-Type: application/json');

$intentId            = $_POST['payment_intent_id'] ?? '';
$amount              = isset($_POST['amount']) ? intval($_POST['amount']) : 0;
$donor_email         = trim($_POST['donor-email'] ?? '');
$donor_name          = trim($_POST['donor-name'] ?? '');
$donation_note       = trim($_POST['donation_note'] ?? '');
$donor_type          = isset($_POST['stripe_donor_type']) ? strtolower(trim($_POST['stripe_donor_type'])) : 'individual';
$company_name        = trim($_POST['company_name'] ?? '');
$company_ein         = trim($_POST['company_ein'] ?? '');
$donor_phone         = trim($_POST['donor-phone'] ?? '');
$payment_method_type = trim($_POST['payment-method-type'] ?? '');

if (!$intentId || $amount < 100) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid payment intent ID or amount.']);
    exit;
}

// Base metadata
$metadata = [
    'donor_name'          => $donor_name,
    'donor_email'         => $donor_email,
    'donation_note'       => $donation_note,
    'donor_type'          => $donor_type,
    'donor_phone'         => $donor_phone,
    'payment_method_type' => $payment_method_type,
    'updated_via'         => 'frontend-adjustment',
    'updated_at'          => date('c'),
];

// Only add company fields if donor_type is organization
if ($donor_type === 'organization') {
    if ($company_name !== '') {
        $metadata['company_name'] = $company_name;
    }
    if ($company_ein !== '') {
        $metadata['company_ein'] = $company_ein;
    }
}

try {
    $intent = \Stripe\PaymentIntent::update($intentId, [
        'amount' => $amount,
        'payment_method_types' => ['us_bank_account', 'card'],
        'metadata' => $metadata,
    ]);

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

