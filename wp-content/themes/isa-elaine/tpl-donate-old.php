<?php
/**
 * Template Name: Tpl Donate old
 * Description: A custom donation page template with PayPal and check options, using ACF fields.
 */


//donate-menu-item - add in wp-dashboard this class in menu item
?>

<?php get_header();

?>


<!--------------------- HERO SECTION --------------------->

<?php

// Check ACF flexible content inside Group 'donate'
// Check if we have flexible content rows
if (have_rows('sections')):
    while (have_rows('sections')) : the_row();
        if (get_row_layout() == 'hero'): ?>
            <!--------------------- HERO SECTION 2 --------------------->
            <!--------------------- HERO SECTION 2 --------------------->

            <section class="default-hero default-hero-donate-2">
                <div class="responsive-bg-donate "
                     style="background-image: url('<?php echo esc_url(get_sub_field("image")); ?>');"></div>
            </section>
            <!--------------------- HERO SECTION 2 --------------------->
            <!--------------------- HERO SECTION 2 --------------------->
            <!--------------------- Donation Description Section --------------------->

            <!--------------------- Check section --------------------->
        <?php elseif (get_row_layout() == 'donation_description'): ?>
            <section class="">
                <div class="container font-bodoni-italic-6">
                    <?php if (get_sub_field('description')): ?>
                        <?php echo wp_kses_post(get_sub_field('description')); ?>
                    <?php endif; ?>
                </div>
            </section>
            <!--------------------- Check section --------------------->


            <!-- new new new new new new-->
            <!-- new new new new new new-->
            <!-- new new new new new new-->

        <?php elseif (get_row_layout() == 'stripe'): ?>
            <section style="margin-bottom: 100px">
                <div class="container">
                    <div class="donation-box">
                        <form action="/create-checkout-stripe-session.php" method="POST" id="payment-form-stripe"
                              class="border-form">
                            <ul class="custom-asterisk-list">
                                <!-- STEP 1 -->
                                <li style="display: none;"><p>Would you like to make your gift a monthly donation? </p>


                                    <div class="payment-method-select nowrap">
                                        <label class="btn-radio active">
                                            <input type="radio" name="donation-frequency" checked value="once"
                                                   onchange="toggleFrequency()">One-Time
                                        </label>

<!--
                                        <label class="btn-radio ">
                                            <input type="radio" name="donation-frequency" value="monthly"
                                                   onchange="toggleFrequency()">Monthly
                                        </label>

-->
                                        <input type="hidden" name="donation_frequency" id="donation_frequency"
                                               value="once">

                                    </div>

                                </li>
                                <!-- STEP 2 -->
                                <li><p>Choose Your Gift Amount</p>

                                    <div class="payment-method-select flex-wrap">
                                        <label for="donation-amount-0" class="btn-radio" style="display: none">
                                            <input id="donation-amount-0" type="radio" name="donation-amount" value="0"
                                                   style="display: none;">
                                        </label>
                                        <label for="donation-amount-50" class="btn-radio">
                                            <input id="donation-amount-50" type="radio" name="donation-amount"
                                                   value="50" onchange="handleDonationAmountChange()"> $50
                                        </label>
                                        <label for="donation-amount-100" class="btn-radio active">
                                            <input id="donation-amount-100" type="radio" name="donation-amount"
                                                   value="100" onchange="handleDonationAmountChange()"> $100
                                        </label>
                                        <label for="donation-amount-250" class="btn-radio">
                                            <input id="donation-amount-250" type="radio" name="donation-amount"
                                                   value="250" onchange="handleDonationAmountChange()"> $250
                                        </label>
                                        <label for="donation-amount-500" class="btn-radio">
                                            <input id="donation-amount-500" type="radio" name="donation-amount"
                                                   value="500" onchange="handleDonationAmountChange()"> $500
                                        </label>
                                        <label for="donation-amount-1000" class="btn-radio">
                                            <input id="donation-amount-1000" type="radio" name="donation-amount"
                                                   value="1000" onchange="handleDonationAmountChange()"> $1,000
                                        </label>
                                        <label for="donation-amount-other" class="btn-radio">
                                            <input id="donation-amount-other" type="radio" name="donation-amount"
                                                   value="other" onchange="handleDonationAmountChange()"> Other
                                        </label>
                                    </div>


                                    <!-- Hidden custom input for 'Other' amount -->
                                    <div id="custom-amount-container" style="">
                                        <input
                                                type="text"
                                                id="amount-stripe"
                                                name="amount-stripe"
                                                class="custom-email-input"
                                                placeholder="Enter custom amount"
                                                inputmode="decimal"
                                        />
                                        <p id="amount-stripe-error" style="display:none; color:red;">Please enter a valid amount greater than $1</p>
                                        <p id="amount-stripe-limit-error" style="display:none; color:red;">Your donation exceeds Stripe’s maximum allowed total of $999,999.99. Please reduce the amount.</p>
                                    </div>
                                    <input type="hidden" id="final_donation_amount" name="final_donation_amount"
                                           value="100">

                                    <input type="hidden" id="raw_donation_amount" name="raw_donation_amount" value="100">


                                </li>


                            </ul>

                            <h2 class="donation-title">Payment</h2>
                            <ul class="custom-asterisk-list">
                                <!-- STEP 1 -->
                                <li><span>EMAIL ADDRESS</span>
                                    <div class="email-input-container">
                                        <input 
                                            type="email" 
                                            id="donor-email" 
                                            name="donor-email" 
                                            class="custom-email-input" 
                                            placeholder="you@example.com" 
                                            style="border-color: rgb(224, 217, 201);"
                                        >
                                        <small class="email-helper-text">Your receipt will be emailed here.</small>
                                    </div>
                                </li>

                                <li><span>PAYMENT METHOD</span>


                                    <div class="add-fee-checkbox" id="card-checkbox-container">
                                        <label class="checkbox-label" id="card-checkbox-label">
                                            <input class="custom-radio" type="radio" name="payment-method"
                                                   id="card-checkbox" value="card" checked>

                                            <span class="label-text">Credit Card</span>
                                        </label>
                                    </div>

                                    <div class="add-fee-checkbox" id="bank-checkbox-container">
                                        <label class="checkbox-label" id="bank-checkbox-label">
                                            <input class="custom-radio" type="radio" name="payment-method"
                                                   id="bank-checkbox" value="bank">
                                            <span class="label-text">Bank Transfer</span>
                                        </label>
                                    </div>

                                    <!--

                                             <div class="add-fee-checkbox" id="paypal-checkbox-container">
                                        <label class="checkbox-label" id="paypal-checkbox-label">
                                            <input class="custom-radio" type="radio" name="payment-method" id="paypal-checkbox" value="paypal" disabled>
                                            <span class="label-text">paypal</span>
                                        </label>
                                    </div>

                                      -->


                                </li>

                                <li><span>PROCESSING FEES</span>


                                    <!-- fee -->
                                    <div class="add-fee-checkbox" id="fee-checkbox-container">
                                        <label id="fee-checkbox-label" class="checkbox-label">
                                            <input class="custom-checkbox" type="checkbox" name="add-fee-checkbox"
                                                   id="add-fee-checkbox"/>
                                            <span class="label-text">I would like to cover the processing fees for this donation.</span>
                                        </label>
                                    </div>


                                </li>

                            </ul>


                            <!-- Info Field Notice -->

                            <div id="card-fields">
                                <div id="card-number-element" class="stripe-input"></div>
                                <div id="card-expiry-element" class="stripe-input"></div>
                                <div id="card-cvc-element" class="stripe-input"></div>
                            </div>

                            <div id="bank-fields" style="display: none;">
                                <div id="bank-name-element" class="stripe-input"></div>
                            </div>


                            <!-- Hidden Inputs -->


                            <p id="stripe-fee-description" style="font-size: 14px; color: whitesmoke;"></p>

                            <!-- Card Fields -->
                            <div id="card-fields">
                                <div id="card-number-element" class="stripe-input"></div>
                                <div id="card-expiry-element" class="stripe-input"></div>
                                <div id="card-cvc-element" class="stripe-input"></div>
                            </div>

                            <!-- Bank Fields -->
                            <div id="bank-fields" style="display: none;">
                                <div id="bank-name-element" class="stripe-input"></div>
                            </div>


                            <!-- Display calculated amounts -->
                            <div style="position: relative; padding-left: 20px;">
                                <div id="donation-summary">
                                    <p class="donation-line"><span style="font-size: small; margin-bottom: 0px;">Total Gift Amount</span><span id="total-display" style="font-size: x-large; font-weight: bold;">$0.00</span></p>
                                    <!-- <p class="donation-line">Processing Fee: <span id="fee-display">$0.00</span></p>
                                    <p class="donation-line">Your Donation: <span id="donation-display">$0.00</span></p>-->
                                </div>
                            </div>

                            <!-- Hidden inputs if you want to send these to backend -->
                            <input type="hidden" id="donation_fee" name="donation_fee" value="">
                            <input type="hidden" id="donation_total" name="donation_total" value="">


                            <!-- Final Step -->
                            <button id="submit-stripe" type="submit">Your Giving Details</button>
                        </form>

                    </div>
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

            <!-- new new new new new new-->
            <!-- new new new new new new-->
            <!-- new new new new new new-->


        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>


<!--------------------- squareup squareup squareup 222222--------------------->
<?php get_footer(); ?>


<script>
    // Constants
    const MAX_STRIPE_TOTAL = 999999.99;
    let lastPresetAmount = 100;
    let isAutoAdjusting = false;
    let selectedPaymentMethod = 'card';

    // Format number into USD
    function formatCurrency(value) {
        const number = parseFloat(value.replace(/[^0-9.]/g, ''));
        if (isNaN(number)) return '';
        return number.toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function validateStripeLimit(amount, method, includeFee) {
        const result = calculateDonation(amount, method, includeFee);
        const limitError = document.getElementById('amount-stripe-limit-error');
        const finalAmountInput = document.getElementById('final_donation_amount');
        const input = document.getElementById('amount-stripe');

        if (result.total > MAX_STRIPE_TOTAL) {
            limitError.style.display = "block";
            input.classList.add("error");
            updateSummaryDisplay(0, 0, 0);
            finalAmountInput.value = '';
            return false;
        } else {
            limitError.style.display = "none";
            input.classList.remove("error");
            return true;
        }
    }


    // Calculate total, fee, and net donation
    function calculateDonation(amountInput, method, includeFee) {
        let total, fee, donationAmount;
        amountInput = parseFloat(amountInput);

        if (isNaN(amountInput) || amountInput <= 0) {
            return { total: 0, fee: 0, donationAmount: 0 };
        }

        if (includeFee) {
            if (method === 'card') {
                total = (amountInput + 0.30) / 0.971;
            } else {
                const estimated = amountInput / (1 - 0.008);
                total = (estimated * 0.008 <= 5.00) ? estimated : amountInput + 5.00;
            }
            fee = total - amountInput;
            donationAmount = amountInput;
        } else {
            total = amountInput;
            fee = (method === 'card') ? (amountInput * 0.029 + 0.30) : Math.min(amountInput * 0.008, 5.00);
            donationAmount = amountInput - fee;
        }

        return {
            total: +(total).toFixed(2),
            fee: +(fee).toFixed(2),
            donationAmount: +(donationAmount).toFixed(2)
        };
    }

    function updateSummaryDisplay(total, fee, donation) {
        const format = val => val.toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        const totalEl = document.getElementById('total-display');
        const feeEl = document.getElementById('fee-display');
        const donationEl = document.getElementById('donation-display');
        if (totalEl) totalEl.textContent = format(total);
        if (feeEl) feeEl.textContent = format(fee);
        if (donationEl) donationEl.textContent = format(donation);

        const feeInput = document.getElementById('donation_fee');
        const totalInput = document.getElementById('donation_total');
        if (feeInput) feeInput.value = fee;
        if (totalInput) totalInput.value = total;
    }

    function handlePaymentMethodChange() {
        const selected = document.querySelector('input[name="payment-method"]:checked');
        if (!selected) return;
        selectedPaymentMethod = selected.value;

        const labelText = document.querySelector('#fee-checkbox-label .label-text');
        const amount = parseFloat(document.getElementById('raw_donation_amount')?.value || 0);
        const simulated = calculateDonation(amount, selectedPaymentMethod, true);
        const fee = simulated.total - simulated.donationAmount;

        const feeDisplay = isNaN(fee) ? '$0.00' : fee.toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        if (labelText) {
            labelText.innerHTML = `I would like to add <strong>${feeDisplay}</strong> to my donation to help offset the processing fees.`;
        }

        // Hide/show Stripe fields
        document.getElementById('card-fields').style.display = selectedPaymentMethod === 'card' ? 'block' : 'none';
        document.getElementById('bank-fields').style.display = selectedPaymentMethod === 'bank' ? 'block' : 'none';
    }

    function handleDonationAmountChange() {
        const selected = document.querySelector('input[name="donation-amount"]:checked');
        const customAmountInput = document.getElementById('amount-stripe');
        const customInputContainer = document.getElementById('custom-amount-container');
        const errorMessage = document.getElementById('amount-stripe-error');
        const feeCheckbox = document.getElementById('add-fee-checkbox');
        const hiddenFinalAmount = document.getElementById('final_donation_amount');

        const includeFee = feeCheckbox?.checked;
        const method = selectedPaymentMethod;

        if (!selected) return;

        let amount = 0;

        if (selected.value === "other") {
            customInputContainer.style.display = "block";
            const formatted = formatCurrency(lastPresetAmount.toString());
            customAmountInput.value = formatted;

            const inputHandler = function () {
                const val = parseFloat(this.value.replace(/[^0-9.]/g, ''));
                const methodEl = document.querySelector('input[name="payment-method"]:checked');
                const method = methodEl ? methodEl.value : 'card';
                const feeCheckbox = document.getElementById('add-fee-checkbox');
                const includeFee = feeCheckbox ? feeCheckbox.checked : false;

                const limitErrorEl = document.getElementById('amount-stripe-limit-error');

                if (isNaN(val) || val < 1) {
                    errorMessage.style.display = "block";
                    if (limitErrorEl) limitErrorEl.style.display = "none";
                    if (customAmountInput) customAmountInput.style.borderColor = "rgb(255, 0, 0)";
                    hiddenFinalAmount.value = '';
                    updateSummaryDisplay(0, 0, 0);
                    return;
                } else {
                    errorMessage.style.display = "none";
                    if (customAmountInput) customAmountInput.style.borderColor = ""; // reset
                }

                lastPresetAmount = val;
                const result = calculateDonation(val, method, includeFee);

                // Stripe limit check
                if (result.total > MAX_STRIPE_TOTAL) {
                    if (limitErrorEl) limitErrorEl.style.display = "block";
                    if (customAmountInput) {
                        customAmountInput.classList.add("error");
                        customAmountInput.style.borderColor = "rgb(255, 0, 0)";
                    }
                    hiddenFinalAmount.value = '';
                    updateSummaryDisplay(0, 0, 0);
                    return;
                } else {
                    if (limitErrorEl) limitErrorEl.style.display = "none";
                    if (customAmountInput) {
                        customAmountInput.classList.remove("error");
                        customAmountInput.style.borderColor = ""; // reset to default
                    }
                }

                hiddenFinalAmount.value = (result.donationAmount * 100).toFixed(0);
                updateSummaryDisplay(result.total, result.fee, result.donationAmount);
                document.getElementById('raw_donation_amount').value = val.toFixed(2);
                handlePaymentMethodChange();
            };

            customAmountInput.removeEventListener('input', inputHandler);
            customAmountInput.addEventListener('input', inputHandler);
            customAmountInput.removeEventListener('blur', inputHandler);
            customAmountInput.addEventListener('blur', inputHandler);

        } else {
            customInputContainer.style.display = "none";
            errorMessage.style.display = "none";

            const limitErrorEl = document.getElementById('amount-stripe-limit-error');
            if (limitErrorEl) limitErrorEl.style.display = "none";
            if (customAmountInput) customAmountInput.classList.remove("error");

            amount = parseFloat(selected.value);
            lastPresetAmount = amount;
            customAmountInput.value = formatCurrency(amount.toString());
            document.getElementById('raw_donation_amount').value = amount.toFixed(2);
        }

        amount = lastPresetAmount;
        const result = calculateDonation(amount, method, includeFee);
        hiddenFinalAmount.value = (result.donationAmount * 100).toFixed(0);
        updateSummaryDisplay(result.total, result.fee, result.donationAmount);

        if (!isAutoAdjusting) {
            isAutoAdjusting = true;

            let changedMethod = false;
            let changedFee = false;

            // Auto-switch to bank for large donations
            if (amount > 500 && selectedPaymentMethod !== 'bank') {
                const bankOption = document.getElementById('bank-checkbox');
                if (bankOption) {
                    bankOption.checked = true;
                    selectedPaymentMethod = 'bank'; // update global
                    changedMethod = true;
                }
            }

            // Auto-check "cover fee" if fee is large
            if (result.fee > 20 && !feeCheckbox.checked) {
                feeCheckbox.checked = true;
                changedFee = true;
            }

            if (changedMethod || changedFee) {
                // Recalculate once with updated method/fee status
                setTimeout(() => {
                    isAutoAdjusting = false;
                    handleDonationAmountChange(); // trigger full recalculation
                }, 10);
                return;
            }

            isAutoAdjusting = false;
        }

        handlePaymentMethodChange();

        if (result.total > MAX_STRIPE_TOTAL) {
            // Hide other error just in case
            document.getElementById('amount-stripe-error').style.display = "none";

            // Show the max total error
            document.getElementById('amount-stripe-limit-error').style.display = "block";

            // Optional: red border on input
            customAmountInput?.classList.add("error");

            updateSummaryDisplay(0, 0, 0);
            hiddenFinalAmount.value = '';
            return;
        } else {
            document.getElementById('amount-stripe-limit-error').style.display = "none";
            customAmountInput?.classList.remove("error");
        }
    }

    function toggleFrequency() {
        const selected = document.querySelector('input[name="donation-frequency"]:checked');
        const frequency = selected ? selected.value : 'once';
        document.getElementById('donation_frequency').value = frequency;
    }

    // Initialize input styling and logic
    document.addEventListener("DOMContentLoaded", function () {
        // Prevent enter from submitting form
        document.getElementById('payment-form-stripe')?.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && e.target.tagName.toLowerCase() !== 'textarea') {
                e.preventDefault();
            }
        });

        // Setup border color for email input
        const emailInput = document.getElementById("donor-email");
        if (emailInput) {
            function updateBorderColor() {
                if (!emailInput.value) {
                    emailInput.style.borderColor = "#E0D9C9";
                } else if (emailInput.checkValidity()) {
                    emailInput.style.borderColor = "#0867E8";
                } else {
                    emailInput.style.borderColor = "#ff0000";
                }
            }

            emailInput.addEventListener("input", updateBorderColor);
            emailInput.addEventListener("blur", updateBorderColor);
            updateBorderColor();
        }

        // Donation radio group styling
        document.querySelectorAll('.btn-radio input[type="radio"]').forEach((input) => {
            input.addEventListener('change', () => {
                const groupName = input.name;
                document.querySelectorAll(`.btn-radio input[name="${groupName}"]`).forEach(radio => {
                    const label = radio.closest('.btn-radio');
                    if (label) label.classList.remove('active');
                });

                const selectedLabel = input.closest('.btn-radio');
                if (selectedLabel) selectedLabel.classList.add('active');
            });
        });

        // Payment method change events
        document.querySelectorAll('input[name="payment-method"]').forEach(input =>
            input.addEventListener('change', handleDonationAmountChange)
        );

        // Cover fee checkbox
        document.getElementById('add-fee-checkbox')?.addEventListener('change', handleDonationAmountChange);

        // Set default option if not selected
        const defaultDonationRadio = document.querySelector('input[name="donation-amount"][value="100"]');
        if (defaultDonationRadio && !document.querySelector('input[name="donation-amount"]:checked')) {
            defaultDonationRadio.checked = true;
        }

        handlePaymentMethodChange();
        handleDonationAmountChange();
    });

    // Currency formatting logic for custom input
    (function () {
        const input = document.getElementById("amount-stripe");

        if (input) {
            input.addEventListener("focus", function () {
                this.value = this.value.replace(/[^0-9.]/g, '');
            });

            input.addEventListener("blur", function () {
                if (!this.value.trim()) {
                    this.value = "";
                    return;
                }
                this.value = formatCurrency(this.value);
            });

            input.addEventListener("input", function () {
                let val = this.value.replace(/[^0-9.]/g, '');
                const parts = val.split('.');
                if (parts.length > 2) {
                    val = parts[0] + '.' + parts[1];
                }
                this.value = val;
            });
        }
    })();
</script>



<style>
    .default-hero-donate-2 {
        padding: 0;
        padding-top: 120px;
        padding-bottom: 100px;
        display: flex;
        justify-content: center;
    }

    /*  style for donation form from square  */
    .donation-form {
        max-width: 400px;
        margin: 40px auto;
        padding: 24px;
        border: 1px solid #0867E8;
        border-radius: 12px;
        background-color: #000000;
        font-family: 'Silkaextra_light', sans-serif;
    }

    .donation-form h2 {
        text-align: center;
        margin-bottom: 17px;
    }

    #card-container {
        margin: 20px 0;
    }

    #card-button {
        width: 100%;
        padding: 12px;
        background-color: #0070ba;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    #card-button:hover {
        background-color: #005f98;
    }

    #payment-status-container {
        margin-top: 20px;
        text-align: center;
        color: #cc0000;
        font-weight: bold;
    }

    #card-container {
        margin: 20px 0;
    }

    #payment-status {
        margin-top: 20px;
        font-weight: bold;
    }

    #preset-amounts {
        margin-bottom: 10px;
    }

    #preset-amounts button {
        margin-right: 8px;
        padding: 6px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        cursor: pointer;
    }

    button[type="submit"] {
        cursor: pointer;
        font-family: "iA Writer Duo", sans-serif;
        font-stretch: condensed;
        display: block;
        padding: 12px 40px;
        box-sizing: border-box;
        text-align: center;

        background-color: black;
        color: #ffffff;
        text-decoration: none;
        width: 100%;
        line-height: 1;
        font-size: 24px;
        /* border-radius: 35px; */
    }


    .amount-input-wrapper {
        display: flex;
        align-items: center;
        border: 1px solid black;
        background: #222353;
        color: #0867E8;
        font-family: 'Silka', sans-serif;
        font-size: 24px;
        height: 64px;
        padding: 0 16px;
        position: relative;
        box-sizing: border-box;
        margin-right: 15px;
    }

    .amount-input-wrapper input[type="text"] {
        border: none;
        background-color: #222353 !important;
        color: #0867E8;
        font-size: 24px;
        width: 280px;
        outline: none;
        font-family: 'Silka', sans-serif;
    }

    .amount-dollar {
        margin-right: 16px;
        margin-bottom: 0px !important;
        padding-right: 16px;
        border-right: 2px solid black;
        font-size: 20px;
        color: #0867E8;
        display: flex;
        align-items: center;
    }

    .preset-buttons {
        display: flex;
        justify-content: flex-start;
        margin-bottom: 2.1em;
    }

    .custom-amount {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 2.1em;
        gap: 0; /* default: no gap */
    }

    /* Apply gap only when screen is small enough to cause wrapping */
    @media (max-width: 881px) {
        .custom-amount {
            gap: 2.1em;
        }
    }

    .amount-input-label {
        height: 62px;
        color: #0867E8;
        font-size: 24px;
        font-family: "Silkalight", sans-serif;
        display: flex;
        align-items: center;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 4px;
        display: block;
    }

    input.error {
        border: 2px solid red;
    }

    .border-form {

    }

    .amount-btn {
        margin-right: 15px;
        margin-top: 0px;
    }

    .payment-forms-row form {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
    }


    #add-fee-checkbox {
        width: 30px;
        height: 30px;
        appearance: none;
        -webkit-appearance: none;
        border: 3px solid #E0D9C9;
        cursor: pointer;
        position: relative;
        background-color: #fff;

    }

    /* Black fill when checked */
    #add-fee-checkbox:checked {
        background-color: #0867E8;
        border: 3px solid #0867E8;
    }


    /* Custom checkmark */
    #add-fee-checkbox:checked::after {
        content: '';
        position: absolute;
        top: 4px;
        left: 8px;
        width: 8px;
        height: 14px;
        border: solid white;
        border-width: 0 3px 3px 0;
        transform: rotate(45deg);
    }

    .label-text {
        margin: 0 !important;
        padding-left: 15px;

    }

    .checkbox-label {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 16px;
        color: #000000;
        user-select: none;
        transition: color 0.3s ease;
    }


    /* radioradioradioradioradioradioradio */
    .payment-method-select {
        display: flex;
        gap: 1em;
        margin-bottom: 1.5em;
        flex-wrap: nowrap;
    }

    .btn-radio {
        flex: 1 1 300px; /* Equal width on wrap, minimum 200px */
        padding: 12px;
        background-color: #E0D9C9;
        color: #94928E;

        border-radius: 0;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s;
        font-size: 24px;
        text-align: center;
        user-select: none;
        position: relative;

        height: 62px;

        display: flex;
        align-items: center; /* Vertical center */
        justify-content: center; /* Optional: horizontal center */
    }

    .btn-radio input[type="radio"] {
        display: none;
    }

    .btn-radio:hover {
        background-color: rgb(213, 204, 184);

    }

    .btn-radio.active {
        background-color: #0867E8;
        border-color: #0867E8;
        color: #fff;
    }


    .step-instruction {
        font-size: 16px;
        font-weight: 500;
        margin-top: 1.5em;
        margin-bottom: 0.5em;
        color: #000000; /* Adjust to match your site's design */
    }


    .responsive-bg-donate {
        width: 100vw;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

        /* 👇 Set aspect ratio using padding-bottom (example: 16:9 = 56.25%) */
        aspect-ratio: 222 / 100;

        /* OR fallback for older browsers: */
        /* padding-bottom: 56.25%; */ /* only use if you skip aspect-ratio */

        /* Optional: smooth scaling */
        transition: background-image 0.3s ease;
    }


    .custom-asterisk-list {
        list-style: none !important;
        padding: 0;
        margin: 0 !important;
        font-family: "iA Writer Duo", Courier, monospace;
        font-size: 18px;
        line-height: 1.6;

    }

    .custom-asterisk-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 40px;
        font-size: 18px !important;
    }

    .custom-asterisk-list li p {

        font-size: 18px !important;
    }


    .custom-asterisk-list li::before {
        content: "*";
        position: absolute;
        left: 0;
        color: #0867E8; /* Apple-style blue */
        font-size: 18px !important;
    }


    /* input email*/
    .custom-email-input {
        width: 100%;
        height: 48px;
        padding: 0 12px;
        border: 2px solid #E0D9C9; /* default green when empty */
        background-color: #fff;
        font-size: 16px;
        color: #333;
        box-sizing: border-box;
        transition: border-color 0.3s, background-color 0.3s;
    }

    /* Placeholder style (green text) */
    .custom-email-input::placeholder {
        color: #E0D9C9 !important;;
    }

    /* When email is typed (not empty) */
    .custom-email-input:not(:placeholder-shown) {
        border-color: #0867E8; /* blue when not empty */
    }

    /* Focus state — keep it blue for consistency */
    .custom-email-input:focus {
        border-color: #0867E8;
        outline: none;
        background-color: #f0f8ff;
    }

    .custom-email-input::placeholder {
        color: #E0D9C9;
    !important;
    }

    .email-helper-text {
        display: block;
        margin-top: 6px;
        font-size: 14px;
        color: #555;
        font-style: italic;
    }

    /* input email*/

    .donation-title {
        margin-top: 80px;
    }


    .custom-radio {
        width: 30px;
        height: 30px;
        appearance: none;
        -webkit-appearance: none;
        border: 3px solid #E0D9C9;
        cursor: pointer;
        position: relative;
        background-color: #fff;
        border-radius: 4px; /* square like checkbox — use 50% if you want circular */
        vertical-align: middle;
        display: inline-block;
        margin: 0;
    }

    /* Checked state: blue background */
    .custom-radio:checked {
        background-color: #0867E8;
        border-color: #0867E8;
    }

    /* White checkmark inside radio */
    .custom-radio:checked::after {
        content: '';
        position: absolute;
        top: 4px;
        left: 8px;
        width: 8px;
        height: 14px;
        border: solid white;
        border-width: 0 3px 3px 0;
        transform: rotate(45deg);
    }

    /* Text next to radio */
    .label-text {
        margin: 0 !important;
        padding-left: 15px;
        vertical-align: middle;
        display: inline-block;
    }

    .add-fee-checkbox {
        margin-bottom: 12px;
    }

    .custom-amount-container {
        display: none;
        margin-top: 10px;
        margin-bottom: 1.5em;
    }

    #donation-summary {
        border: 2px solid rgb(224, 217, 201);
        border-radius: 4px;
        background-color: #fff;
        padding: 12px 16px;
        font-family: inherit;
        font-size: 16px;
        color: black;
        width: 100%;
        line-height: 1.6;
        margin: 0px 20px 100px 0px;
    }

    #donation-summary .donation-line {
        margin: 8px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-family: "iA Writer Duo", sans-serif;
    }

    #donation-summary .donation-line span {
        float: right;
        color: #333;
        font-weight: 500;
    }


</style>
