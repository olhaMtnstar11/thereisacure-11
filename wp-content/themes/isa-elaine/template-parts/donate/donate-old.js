const stripe = Stripe('pk_test_51RidE34gNYgtyhYfo7DwecY6DNVbPDTGqEEes3wypUlzUv7o30QdoPXcE8mhXwJ4h6Ke2OyxUCvxHakDJuvPH4rE00z6s1BU7g');
let elements;
let paymentElement;


/*
const stripe = Stripe('pk_test_51RidE34gNYgtyhYfo7DwecY6DNVbPDTGqEEes3wypUlzUv7o30QdoPXcE8mhXwJ4h6Ke2OyxUCvxHakDJuvPH4rE00z6s1BU7g');
const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-number-element');
const bankElement = elements.create('iban', {
  supportedCountries: ['US'],
  style: {
    base: {
      fontSize: '16px',
      color: '#32325d',
    },
  },
});

bankElement.mount('#bank-name-element');
*/

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
    //document.getElementById('card-fields').style.display = selectedPaymentMethod === 'card' ? 'block' : 'none';
    //document.getElementById('bank-fields').style.display = selectedPaymentMethod === 'bank' ? 'block' : 'none';
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

// Step 1: Fetch the client secret
const form = document.getElementById('payment-form-stripe');
form?.addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const response = await fetch('/create-payment-intent.php', {
        method: 'POST',
        body: formData
    });

    const data = await response.json();

    if (data.error) {
        alert("Error: " + data.error);
        return;
    }

    const clientSecret = data.clientSecret;

    // Step 2: Initialize Elements and mount the Payment Element
    elements = stripe.elements({ clientSecret });

    paymentElement = elements.create('payment');
    paymentElement.mount('#payment-element');

    // Disable submit and show "Pay Now" once loaded
    document.getElementById('submit-stripe')?.addEventListener('click', handleConfirm);
});

async function handleConfirm(e) {
    e.preventDefault();

    const { error, paymentIntent } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            return_url: 'https://thereisacure.wpenginepowered.com/thank-you-page/',
        },
    });

    if (error) {
        alert("Payment failed: " + error.message);
    } else if (paymentIntent.status === 'succeeded') {
        window.location.href = '/thank-you-page/';
    }
}