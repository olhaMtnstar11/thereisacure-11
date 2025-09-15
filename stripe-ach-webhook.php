<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
require __DIR__ . '/wp-content/themes/isa-elaine/stripe-php/init.php';

// Set Stripe secret key
\Stripe\Stripe::setApiKey('sk_test_51RidE34gNYgtyhYfkPkFqgum56P1WGiKlJxKoOflORQM97Pt44N1eipiQpmZk0ltQMASgoxgQSjcbCmlWQkWGY7B00tQqqwYEz');

// Webhook secret
$endpoint_secret = 'whsec_xdWF3euQYg2wxGxnYxC1LYbDuVR7Hwz1';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

try {
    $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
} catch (\UnexpectedValueException | \Stripe\Exception\SignatureVerificationException $e) {
    file_put_contents(__DIR__ . '/ach-debug-log.txt', "Signature error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
    http_response_code(400);
    exit('Webhook error');
}

file_put_contents(__DIR__ . '/ach-debug-log.txt', "Event type: " . $event->type . PHP_EOL, FILE_APPEND);





switch ($event->type) {

    case 'payment_intent.requires_action':
    case 'payment_intent.requires_confirmation':
        $intent = $event->data->object;

        // Bail early if not ACH
        $paymentMethods = $intent->payment_method_types ?? [];
        if (!in_array('us_bank_account', $paymentMethods)) {
            http_response_code(200);
            echo json_encode(['status' => 'ignored - unsupported payment method']);
            exit();
        }

        $paymentMethod = \Stripe\PaymentMethod::retrieve($intent->payment_method);
        if ($paymentMethod->type !== 'us_bank_account') {
            http_response_code(200);
            echo json_encode(['status' => 'ignored - not ACH']);
            exit();
        }


    // Check if microdeposit verification is required
    $verificationUrl = $intent->next_action->verify_with_microdeposits->hosted_verification_url ?? '';








        // Get donor info
        $email = $intent->receipt_email ?? $intent->metadata->donor_email ?? '';
        $name = $intent->metadata->donor_name ?? 'Donor';

        if (empty($email)) {
            $email = 'yourtestemail@example.com'; // fallback for safety
        }

        add_filter('wp_mail_from', fn() => 'donations@isaelaine.org');
        add_filter('wp_mail_from_name', fn() => 'Isa Elaine Foundation');

        $subject = "Action Required: Verify Your Bank to Complete Your Donation";
        $headers = ['Content-Type: text/html; charset=UTF-8'];

    $message = '
<html>
<head><style>
  body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
  .email-container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #eee; background: #fafafa; }
  .header { text-align: left; margin-bottom: 20px; }
  .logo { max-height: 80px; }
  .details-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
  .details-table td { padding: 8px 0; vertical-align: top; }
  .footer { margin-top: 30px; font-size: 14px; color: #777; text-align: left; }
  hr { border: none; border-top: 1px solid #ddd; margin: 30px 0; }
  .btn {
    display: inline-block;
    padding: 12px 20px;
    background-color: #0073aa;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
  }
</style></head>
<body>
  <div class="email-container">
    <div class="header">
      <img src="http://thereisacure.wpenginepowered.com/wp-content/uploads/2025/07/favicon.png?ver=1751981853" alt="Isa Elaine Foundation Logo" class="logo">
    </div>
    <p>Dear ' . htmlspecialchars($name) . ',</p>
    <p>Your bank account is connected but requires <strong>verification via microdeposits</strong> before we can complete your donation.</p>
    <p>Please check your bank statement for two small deposits from Stripe, then click the button below to enter those amounts and finalize your donation.</p>
    <hr>';

    if (!empty($verificationUrl)) {
        $message .= '<p><a href="' . htmlspecialchars($verificationUrl) . '" class="btn" target="_blank" rel="noopener">
        Verify Your Bank Account
        </a></p>';
    } else {
        $message .= '<p>No verification link was provided by Stripe. Please contact us at <a href="mailto:donations@isaelaine.org">donations@isaelaine.org</a> for assistance.</p>';
    }

    $message .= '
    <br>
    <p>With heartfelt thanks,</p>
    <p>Isa Elaine Foundation <br>
       <a href="https://thereisacure.wpenginepowered.com/">thereisacure.org</a></p>
  </div>
</body>
</html>
';

        if (!empty($verificationUrl)) {
            $message .= '<p><a href="' . htmlspecialchars($verificationUrl) . '" class="btn" target="_blank" rel="noopener">
        Verify Your Bank Account
        </a></p>';
        } else {
            $message .= '<p>No verification link was provided by Stripe. Please contact us at <a href="mailto:donations@isaelaine.org">donations@isaelaine.org</a> for assistance.</p>';
        }

        $message .= '
    <br>
    <p>With heartfelt thanks,</p>
    <p>Isa Elaine Foundation <br>
       <a href="https://thereisacure.wpenginepowered.com/">thereisacure.org</a></p>
  </div>
</body>
</html>
';

        wp_mail($email, $subject, $message, $headers);
        break;



    case 'payment_intent.processing':
    case 'payment_intent.succeeded':
        $intent = $event->data->object;

        // Bail early if not ACH
        $paymentMethods = $intent->payment_method_types ?? [];
        if (!in_array('us_bank_account', $paymentMethods)) {
            http_response_code(200);
            echo json_encode(['status' => 'ignored - unsupported payment method']);
            exit();
        }

        $paymentMethod = \Stripe\PaymentMethod::retrieve($intent->payment_method);
        if ($paymentMethod->type !== 'us_bank_account') {
            http_response_code(200);
            echo json_encode(['status' => 'ignored - not ACH']);
            exit();
        }

        file_put_contents(__DIR__ . '/ach-debug-log.txt', "Full Intent:\n" . print_r($intent, true), FILE_APPEND);

        // Retrieve full PaymentIntent to get client_secret (if not already full)
        $paymentIntent = \Stripe\PaymentIntent::retrieve($intent->id);
        $clientSecret = $paymentIntent->client_secret;

        // Construct thank you URL with client secret
        $thankYouUrl = 'https://thereisacure.wpenginepowered.com/thank-you-page?payment_intent_client_secret=' . urlencode($clientSecret);

        // Get charge from latest_charge (may be null if still processing)
        $charge_id = $intent->latest_charge ?? null;
        $charge = $charge_id ? \Stripe\Charge::retrieve($charge_id) : null;

        $amount = $charge ? $charge->amount / 100 : 0;
        $receipt_url = $charge->receipt_url ?? '';
        $billing = $charge->billing_details ?? new stdClass();

        $metadata = $intent->metadata ?? new stdClass();

        // Email fallback order: billing email, receipt email, metadata donor email
        $email = $billing->email
            ?? $intent->receipt_email
            ?? $metadata->donor_email
            ?? '';

        // Name fallback
        $name = $billing->name
            ?? $metadata->donor_name
            ?? 'Donor';

        $purpose = $metadata->purpose ?? '';

        // Log email for debug
        file_put_contents(__DIR__ . '/ach-debug-log.txt', "Email extracted: $email\n", FILE_APPEND);

        if (empty($email)) {
            // fallback test email to avoid errors
            $email = 'yourtestemail@example.com';
            file_put_contents(__DIR__ . '/ach-debug-log.txt', "Fallback email used: $email\n", FILE_APPEND);
        }

        if (!empty($email)) {
            add_filter('wp_mail_from', fn() => 'donations@isaelaine.org');
            add_filter('wp_mail_from_name', fn() => 'Isa Elaine Foundation');

            $subject = $event->type === 'payment_intent.succeeded'
                ? "Your ACH donation is complete!"
                : "We've received your ACH donation — processing";

            $headers = ['Content-Type: text/html; charset=UTF-8'];

            // Build the HTML message
            $message = '
<html>
<head><style>
  body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
  .email-container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #eee; background: #fafafa; }
  .header { text-align: left; margin-bottom: 20px; }
  .logo { max-height: 80px; }
  .details-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
  .details-table td { padding: 8px 0; vertical-align: top; }
  .footer { margin-top: 30px; font-size: 14px; color: #777; text-align: left; }
  hr { border: none; border-top: 1px solid #ddd; margin: 30px 0; }
</style></head>
<body>
  <div class="email-container">
    <div class="header">
      <img src="http://thereisacure.wpenginepowered.com/wp-content/uploads/2025/07/favicon.png?ver=1751981853" alt="Isa Elaine Foundation Logo" class="logo">
    </div>
    <p>Dear ' . htmlspecialchars($name) . ',</p>
    <p>' . (
                $event->type === 'payment_intent.succeeded'
                    ? "We’re happy to let you know that your ACH donation has been <strong>successfully completed</strong>."
                    : "Thank you for initiating a donation via bank account. Your bank is now processing the transfer. This can take <strong>3–5 business days</strong>."
                ) . '</p>

<p>You’re helping a mother get closer to answers she’s waited years to hear. You’re helping a young boy begin treatment that didn’t exist just a few years ago. You’re helping researchers and families face the unknown.</p>
<p>Because of your gift, we can make discoveries – advancing us closer to answers and better treatments that give children hope, healing, and a future.</p>
   <br>
     <p>With heartfelt thanks,</p>
        <p> Isa Elaine Foundation <br>
           <a href="https://thereisacure.wpenginepowered.com/">thereisacure.org</a></p>
   <br>
    <table class="details-table">
      <tr><td><strong>Donation Amount:</strong></td><td>$' . number_format($amount, 2) . '</td></tr>' .
                (!empty($purpose) ? '<tr><td><strong>Purpose:</strong></td><td>' . htmlspecialchars($purpose) . '</td></tr>' : '') .
                '<tr><td><strong>Payment Intent ID:</strong></td><td>' . htmlspecialchars($paymentIntent->id) . '</td></tr>' .
                ($charge_id ? '<tr><td><strong>Charge ID:</strong></td><td>' . htmlspecialchars($charge_id) . '</td></tr>' : '') .
                ($event->type === 'payment_intent.succeeded' && !empty($receipt_url)
                    ? '<tr><td><strong>Receipt:</strong></td><td><a href="' . htmlspecialchars($receipt_url) . '" target="_blank" rel="noopener">View Your Receipt</a></td></tr>'
                    : '') .
                '</table>
    <hr>
    <p>You can check your donation status anytime here: <a href="' . htmlspecialchars($thankYouUrl) . '" target="_blank" rel="noopener">View Your Donation Details</a></p>
    <div class="footer">

    </div>
  </div>
</body>
</html>
';





            $sent = wp_mail($email, $subject, $message, $headers);

            file_put_contents(__DIR__ . '/ach-debug-log.txt', "Email sent? " . ($sent ? 'YES' : 'NO') . PHP_EOL, FILE_APPEND);
        }
        break;

    case 'payment_intent.payment_failed':
        $intent = $event->data->object;
        file_put_contents(__DIR__ . '/ach-debug-log.txt', "FAILED Intent:\n" . print_r($intent, true), FILE_APPEND);
        break;

    default:
        file_put_contents(__DIR__ . '/ach-debug-log.txt', "Ignored event type: " . $event->type . PHP_EOL, FILE_APPEND);
        break;
}

http_response_code(200);
echo json_encode(['status' => 'success']);
exit();
