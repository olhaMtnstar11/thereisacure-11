<?php
/*
Template Name: Stripe Thank You
*/
get_header();
$hero = get_field('hero_section');
?>

<?php if ($hero && !empty($hero['image'])) : ?>
    <section class="default-hero default-hero-donate-2" style="padding-bottom: 50px!important; padding-top: 150px">
        <div class="thank-you-bg container"
             style="background-image: url('<?php echo esc_url($hero['image']); ?>');"></div>
    </section>
<?php endif; ?>



<section class="plain-text" style="padding-top: 0!important;">
    <div class="container">
        <p id="thank-you-message">Processing your donation...</p>
    </div>
</section>

<!-- Thin Line Div -->
<div class="line-container">
    <div class="section-line-with-squares">
        <div class="square left"></div>
        <div class="section-line"></div>
        <div class="square right"></div>
    </div>
</div>

<?php get_footer(); ?>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_51RidE34gNYgtyhYfo7DwecY6DNVbPDTGqEEes3wypUlzUv7o30QdoPXcE8mhXwJ4h6Ke2OyxUCvxHakDJuvPH4rE00z6s1BU7g');

    const urlParams = new URLSearchParams(window.location.search);
    const clientSecret = urlParams.get("payment_intent_client_secret");

    if (clientSecret) {
        stripe.retrievePaymentIntent(clientSecret).then(({ paymentIntent }) => {
            const amount = (paymentIntent.amount / 100).toFixed(2);

            switch (paymentIntent.status) {
                case "succeeded":
                    document.getElementById("thank-you-message").innerHTML =
                        `<strong>Thank you for your donation of $${amount}!</strong><br><br>` +
                        `Your transaction has been successfully completed.<br><br>` +

                        `We’ve emailed your receipt for your records - please check your inbox (and spam folder if you don’t see it).<br><br>` +
                        `<em>Note: This donation is not tax-deductible.</em>`;
                    break;
                case "requires_action":
                    if (paymentIntent.next_action && paymentIntent.next_action.type === "verify_with_microdeposits") {
                        const verificationUrl = paymentIntent.next_action.verify_with_microdeposits.hosted_verification_url;
                        document.getElementById("thank-you-message").innerHTML = `
      <strong>Thank you for starting your donation!</strong><br><br>

We’ve initiated your bank transfer, but your donation is not complete yet.<br><br>

To finish, you’ll need to verify your bank account. This ensures your payment is secure and helps us process your gift.<br><br>

We’ve sent an email with simple instructions and a secure link to complete the verification.<br>
Please check your inbox (and your spam/junk folder if you don’t see it).<br><br>

<em>Note: Bank account verification can take 1–2 business days as small deposits arrive in your account.</em>
    `;
                    } else {
                        document.getElementById("thank-you-message").textContent =
                            "Your payment requires additional action to complete.";
                    }
                    break;
                case "processing":
                    document.getElementById("thank-you-message").innerHTML =
                        `<strong>Thank you for your donation of $${amount}!</strong><br><br>` +
                        `Your payment is currently being processed via bank account transfer.<br><br>` +
                        `Bank transfers typically take <strong>3–5 business days</strong> to complete.<br><br>` +
                        `You will receive a confirmation email once your payment is finalized — please check your inbox (and spam folder if you don’t see it).<br><br>` +
                        `<em>Note: This donation is not tax-deductible.</em>`;
                    break;

                case "requires_payment_method":
                case "requires_confirmation":
                    document.getElementById("thank-you-message").textContent =
                        `Your payment of $${amount} did not go through. Please try again or contact support if the issue persists.`;
                    break;

                default:
                    document.getElementById("thank-you-message").textContent =
                        `We’re processing your donation of $${amount}. You’ll receive an update shortly via email.`;
                    break;
            }
        }).catch((error) => {
            console.error("Stripe error:", error);
            document.getElementById("thank-you-message").textContent =
                "Something went wrong while confirming your donation. Please contact support.";
        });
    } else {
        document.getElementById("thank-you-message").textContent =
            "Missing payment details. Please contact support.";
    }





</script>

<style>
    .thank-you-bg {
        width: 100vw;
        background-size: cover;
        background-position: center;
        aspect-ratio: 400 / 100;
    }

    .btn-verify {
        text-decoration: none;
            list-style: none !important;
            margin: 20px 0 !important;
            font-family: "iA Writer Duo", Courier, monospace;
            font-size: 18px;
            line-height: 1.6;
            background-color: #0867E8;
            border-color: #0867E8;
            color: #fff;
            flex: 1 1 300px;
            padding: 12px;
            border-radius: 0;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
            text-align: center;
            user-select: none;
            position: relative;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
    }

    .btn-verify:hover,
    .btn-verify:focus {
        background-color: #005bb5; /* darker blue on hover/focus */
        outline: none;
    }



    #thank-you-message {
        font-size: 21px;
    }

    #thank-you-message strong{
font-size: 27px;
    }

</style>
