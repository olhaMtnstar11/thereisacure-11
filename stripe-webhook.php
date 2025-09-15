<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
require __DIR__ . '/wp-content/themes/isa-elaine/stripe-php/init.php';

// Set Stripe secret key
\Stripe\Stripe::setApiKey('sk_test_51RidE34gNYgtyhYfkPkFqgum56P1WGiKlJxKoOflORQM97Pt44N1eipiQpmZk0ltQMASgoxgQSjcbCmlWQkWGY7B00tQqqwYEz');

// Webhook secret
$endpoint_secret = 'whsec_pTPWPpsI38D4CWRZgtrLgS5nnn6snOHy';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

try {
    $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
} catch (\UnexpectedValueException | \Stripe\Exception\SignatureVerificationException $e) {
    http_response_code(400);
    exit('Webhook error: invalid payload or signature');
}

// Only handle payment_intent.succeeded
if ($event->type === 'payment_intent.succeeded') {
    $paymentIntent = $event->data->object;

    // Check if payment method is card — bail if not
    $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentIntent->payment_method);
    if ($paymentMethod->type !== 'card') {
        http_response_code(200);
        echo json_encode(['status' => 'ignored - not card']);
        exit();
    }

    // Extract metadata
    $metadata = $paymentIntent->metadata ?? new stdClass();
    $email = $metadata->donor_email ?? '';
    $name = $metadata->donor_name ?? 'Donor';



    $charge_id = $paymentIntent->latest_charge ?? null;
    $charge = null;
    $donor_amount = 0;
    $total_charged = 0;
    $receipt_url = '';

    if ($charge_id) {
        $charge = \Stripe\Charge::retrieve($charge_id);
        $donor_amount = $charge->amount / 100; // convert cents to dollars
        $total_charged = $donor_amount; // no fee split here, just charge amount
        $receipt_url = $charge->receipt_url ?? '';
    }

    $clientSecret = $paymentIntent->client_secret ?? '';
    $thankYouUrl = 'https://thereisacure.wpenginepowered.com/thank-you-page?payment_intent_client_secret=' . urlencode($clientSecret);

// Prepare email
    $subject = "Thank you for your donation!";

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
    <br>
    <p>Dear ' . htmlspecialchars($name) . ',</p>
    <p>You’re helping a mother get closer to answers she’s waited years to hear. You’re helping a young boy begin treatment that didn’t exist just a few years ago. You’re helping researchers and families face the unknown.</p>
<p>Because of your gift, we can make discoveries – advancing us closer to answers and better treatments that give children hope, healing, and a future.</p>
   <br>
     <p>With heartfelt thanks,</p>
        <p> Isa Elaine Foundation <br>
           <a href="https://thereisacure.wpenginepowered.com/">thereisacure.org</a></p>
   <br>
    <table class="details-table">
      <tr><td><strong>Donation Amount:</strong></td><td>$' . number_format($total_charged, 2) . '</td></tr>' .
        (!empty($receipt_url)
            ? '<tr><td><strong>Receipt:</strong></td><td><a href="' . htmlspecialchars($receipt_url) . '" target="_blank" rel="noopener">View Your Receipt</a></td></tr>'
            : '') .
        (!empty($paymentIntent->id)
            ? '<tr><td><strong>Payment Intent ID:</strong></td><td>' . htmlspecialchars($paymentIntent->id) . '</td></tr>'
            : '') .
        (!empty($charge_id)
            ? '<tr><td><strong>Charge ID:</strong></td><td>' . htmlspecialchars($charge_id) . '</td></tr>'
            : '') . '
    </table>
    <hr>
  
    <p>You can check your donation status anytime here: <a href="' . htmlspecialchars($thankYouUrl) . '" target="_blank" rel="noopener">View Your Donation Details</a></p>
 
    <div class="footer">

    </div>
  </div>
</body>
</html>
';



    // Send email if email exists
    if (!empty($email)) {
        add_filter('wp_mail_from', fn() => 'donations@isaelaine.org');
        add_filter('wp_mail_from_name', fn() => 'Isa Elaine Foundation');
        wp_mail($email, $subject, $message, ['Content-Type: text/html; charset=UTF-8']);
    }

    http_response_code(200);
    echo json_encode(['status' => 'success']);
    exit();
}

// All other event types ignored
http_response_code(200);
echo json_encode(['status' => 'ignored - event type']);
exit();
