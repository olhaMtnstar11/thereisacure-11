const stripe = Stripe('pk_test_51RidE34gNYgtyhYfo7DwecY6DNVbPDTGqEEes3wypUlzUv7o30QdoPXcE8mhXwJ4h6Ke2OyxUCvxHakDJuvPH4rE00z6s1BU7g');
let elements;
let paymentElement;
let paymentIntentId = '';
let clientSecret = '';
let selectedPaymentMethod = 'card';

const MAX_STRIPE_TOTAL = 999999.99;


window.stripeComplete = false;
window.checkboxChecked = false;


function formatCurrency(amount) {
  return amount.toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 2
  });
}

function calculateFees(amount, method, coverFee) {
  let fee = 0;
  if (coverFee) {
    fee = method === 'us_bank_account' ? Math.min(amount * 0.008, 5.00) : ((amount + 0.30) / 0.971) - amount;
  } else {
    fee = method === 'us_bank_account' ? Math.min(amount * 0.008, 5.00) : amount * 0.029 + 0.30;
  }
  return parseFloat(fee.toFixed(2));
}
async function updateTotals() {
  const amountInput = document.getElementById('raw_donation_amount');
  const coverFee = document.getElementById('add-fee-checkbox')?.checked;
  const method = window.selectedPaymentMethod || 'card';

  const baseAmount = parseFloat(amountInput.value);

  // 🚫 If amount is invalid or <= 0, reset summary and exit
  if (isNaN(baseAmount) || baseAmount <= 0) {
    document.getElementById('total-display').textContent = '$0.00';
    document.getElementById('donation_fee').value = '';
    document.getElementById('donation_total').value = '';
    return;
  }

  const fee = calculateFees(baseAmount, method, coverFee);
  const total = coverFee ? baseAmount + fee : baseAmount;

  // ✅ Update the display and hidden fields
  document.getElementById('total-display').textContent = formatCurrency(total);
  document.getElementById('donation_fee').value = fee;
  document.getElementById('donation_total').value = total;

  // 🔄 Update Stripe PaymentIntent if it already exists
    if (paymentIntentId && total <= MAX_STRIPE_TOTAL) {
      try {
        await fetch('/update-payment-intent.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({
            payment_intent_id: paymentIntentId,
            amount: Math.round(total * 100),
            'donor-name': document.getElementById('donor-name')?.value.trim(),
            'donor-email': document.getElementById('donor-email')?.value.trim(),
            'donation_note': document.querySelector('textarea[name="donation_note"]')?.value.trim(),
            'donor-type': document.querySelector('input[name="donor-type"]:checked')?.value,
            'company_name': document.querySelector('input[name="company_name"]')?.value.trim(),
            'company_ein': document.querySelector('input[name="company_ein"]')?.value.trim(),
            'donor-phone': document.getElementById('donor-phone')?.value.trim().replace(/\D/g, ''),
            'payment-method-type': window.selectedPaymentMethod || 'card',
          }),
        });
      } catch (err) {
        console.error('Update PaymentIntent failed:', err);
      }
    }
}


function setAmountFromPreset(value) {
  const customAmountContainer = document.getElementById('custom-amount-container');
  const customInput = document.getElementById('amount-stripe');
  const errorEl = document.getElementById('amount-stripe-error');

  if (value === 'other') {
    customAmountContainer.style.display = 'block';
    customInput.value = formatCurrency(100);
    document.getElementById('raw_donation_amount').value = '100';
    updateTotals();
  } else {
    customAmountContainer.style.display = 'none';

    // Reset custom input field
    customInput.value = '';
    customInput.classList.remove('error', 'valid');
    errorEl.textContent = '';
    errorEl.style.display = 'none';

    document.getElementById('raw_donation_amount').value = value;
    updateTotals();
  }

  // Update visual "active" class
  document.querySelectorAll('.donation-amount-options .btn-radio').forEach(label => label.classList.remove('active'));
  const label = document.querySelector(`input[name="donation-amount"][value="${value}"]`)?.closest('.btn-radio');
  label?.classList.add('active');
}

function handleCustomAmountInput() {
  const customAmountInput = document.getElementById('amount-stripe');
  const rawField = document.getElementById('raw_donation_amount');
  const errorEl = document.getElementById('amount-stripe-error');

  const rawInput = customAmountInput.value.replace(/[^0-9.]/g, '');
  const parsed = parseFloat(rawInput);

  // Always format input, even if invalid
  customAmountInput.value = formatCurrency(isNaN(parsed) ? 0 : parsed);

  // Reset previous error
  errorEl.style.display = 'none';
  errorEl.innerHTML = '';
  customAmountInput.classList.remove('error', 'valid');

  // Empty or invalid number
  if (isNaN(parsed) || parsed < 1) {
    errorEl.textContent = 'Minimum donation is $1.';
    errorEl.style.display = 'block';
    customAmountInput.classList.add('error');
    rawField.value = '';
    updateTotals();
    return;
  }

  // Exceeds Stripe maximum
  if (parsed > MAX_STRIPE_TOTAL) {
    errorEl.innerHTML = `For donations over $999,999.99, please <a href="/#contact" style="color:#0867E8; text-decoration:underline;">contact us</a> or call <strong>(904) 685-4091</strong>.`;
    errorEl.style.display = 'block';
    customAmountInput.classList.add('error');
    rawField.value = '';
    updateTotals();
    return;
  }

  // Valid
  customAmountInput.classList.add('valid');
  rawField.value = parsed.toFixed(2);
  updateTotals();
}


async function createPaymentIntent(amount, email) {
  try {
    const response = await fetch('/create-payment-intent.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        final_donation_amount: Math.round(amount * 100),
        'donor-email': email,
        'donor-name': document.getElementById('donor-name')?.value.trim(),
        'payment-method-type': window.selectedPaymentMethod || 'card'
      })
    });
    const data = await response.json();
    if (data.clientSecret) {
      paymentIntentId = data.intentId;
      return data.clientSecret;
    } else {
      throw new Error(data.error || 'Failed to create PaymentIntent');
    }
  } catch (err) {
    alert(err.message);
    return null;
  }
}

async function maybeInitPaymentElement() {
  try {
    const amount = parseFloat(document.getElementById('raw_donation_amount')?.value || 0);
    const email = document.getElementById('donor-email')?.value.trim();
    const phone = document.getElementById('donor-phone')?.value.trim();


    let stripeComplete = false;
    let checkboxChecked = false;

    if (!email || isNaN(amount) || amount < 1 || clientSecret) return;

    clientSecret = await createPaymentIntent(amount, email);
    if (!clientSecret) return;

    elements = stripe.elements({ clientSecret });
    paymentElement = elements.create('payment', {
      defaultValues: {
        billingDetails: {
          name: document.getElementById('donor-name')?.value.trim(),
          email: document.getElementById('donor-email')?.value.trim(),
          phone: document.getElementById('donor-phone')?.value.trim(),
        }
      }
    });
    paymentElement.mount('#payment-element');

    paymentElement.on('change', (event) => {
      if (event.value?.type) {
        window.selectedPaymentMethod = event.value.type;
        updateTotals();
      }
      window.stripeComplete = event.complete;
      updateSubmitButtonState();
    });

  } catch (err) {
    console.error('maybeInitPaymentElement failed:', err);
    alert('An error occurred initializing the payment element. Check console for details.');
  }
}





document.addEventListener('DOMContentLoaded', () => {
  const continueBtn = document.getElementById('continue-to-payment');
  const paymentSection = document.getElementById('payment-method-section');



  if (continueBtn) {
    continueBtn.disabled = true;
    continueBtn.classList.add('disabled'); // Optional: style with gray button
  }



  continueBtn?.addEventListener('click', () => {
    // Blur all inputs to ensure latest values are caught
    document.querySelectorAll('#initial-donor-section input, #initial-donor-section textarea').forEach(el => el.blur());

    setTimeout(() => {
      if (!validateInitialFields()) return;

      continueBtn.style.display = 'none';
      if (paymentSection) paymentSection.style.display = 'block';
      maybeInitPaymentElement(); // only with valid data
    }, 10);
  });







  // Default setup
  const coverFeeCheckbox = document.getElementById('add-fee-checkbox');
  if (coverFeeCheckbox) coverFeeCheckbox.checked = true;

  const defaultValue = '100';
  const defaultRadio = document.querySelector(`input[name="donation-amount"][value="${defaultValue}"]`);
  if (defaultRadio) {
    defaultRadio.checked = true;
    setAmountFromPreset(defaultValue);
  }

  // Donation field logic
  document.querySelectorAll('input[name="donation-amount"]').forEach(el => {
    el.addEventListener('change', (e) => {
      setAmountFromPreset(e.target.value);
      checkInitialFormValidity();
    });
  });
  document.getElementById('amount-stripe')?.addEventListener('blur', () => {
    handleCustomAmountInput();
    checkInitialFormValidity();
  });
  document.getElementById('add-fee-checkbox')?.addEventListener('change', updateTotals);

  // Realtime feedback: Clear error when typing
  document.querySelectorAll('.custom-email-input').forEach(input => {
    input.addEventListener('input', () => {
      input.classList.remove('error');
      const err = input.parentNode.querySelector('.field-error-message');
      if (err) err.remove();

      checkInitialFormValidity();
    });
  });

  document.getElementById('payment-form-stripe').addEventListener('submit', async function (e) {
    e.preventDefault();

    try {
      if (!clientSecret || !elements || !paymentElement) {
        alert('Please enter a valid donation amount and email before proceeding.');
        return;
      }

      // 🔒 Final validation before confirming
      if (!validateInitialFields()) return;

      const fullName = document.getElementById('donor-name')?.value.trim();
      const email = document.getElementById('donor-email')?.value.trim();
      const selectedType = window.selectedPaymentMethod || 'card';

      const confirmOptions = {
        elements,
        confirmParams: {
          return_url: 'https://thereisacure.wpenginepowered.com/thank-you-page/'
        }
      };

      if (selectedType === 'us_bank_account') {
        confirmOptions.confirmParams.payment_method_data = {
          billing_details: { name: fullName, email: email }
        };
      }

      const { error } = await stripe.confirmPayment(confirmOptions);
      if (error) {
        alert(error.message);
        console.error('Stripe confirmPayment error:', error);
      }
    } catch (err) {
      console.error('Payment form submit failed:', err);
      alert('An unexpected error occurred. Check console for details.');
    }
  });

  // === Validation ===
  function validateInitialFields() {
    document.querySelectorAll('.field-error-message').forEach(el => el.remove());
    document.querySelectorAll('.custom-email-input').forEach(el => el.classList.remove('error'));

    let isValid = true;

    const nameInput = document.getElementById('donor-name');
    const emailInput = document.getElementById('donor-email');
    const amountInput = document.getElementById('raw_donation_amount');
    const donorType = document.querySelector('input[name="donor-type"]:checked')?.value;
    const rawAmount = parseFloat(amountInput?.value || 0);

    if (!nameInput.value.trim()) {
      showFieldError(nameInput, 'Full name is required');
      isValid = false;
    }

    const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim());
    if (!emailValid) {
      showFieldError(emailInput, 'Valid email is required');
      isValid = false;
    }

    if (isNaN(rawAmount) || rawAmount < 1) {
      const customAmountInput = document.getElementById('amount-stripe');
      if (customAmountInput) {
        showFieldError(customAmountInput, 'Donation amount must be at least $1');
        customAmountInput.classList.add('error');
      }
      isValid = false;
    }

    if (donorType === 'organization') {
      const companyName = document.querySelector('input[name="company_name"]');
      companyName?.addEventListener('input', checkInitialFormValidity);
      if (!companyName.value.trim()) {
        showFieldError(companyName, 'Company name is required for organization donors');
        isValid = false;
      }
    }

    return isValid;
  }

  function showFieldError(inputEl, message) {
        inputEl.classList.add('error');

        // Only append error if it doesn't already exist
        const existing = inputEl.parentNode.querySelector('.field-error-message');
        if (existing) return;

        const error = document.createElement('p');
        error.className = 'field-error-message';
        error.style.color = '#D93025';
        error.style.fontSize = '14px';
        error.style.marginTop = '4px';
        error.textContent = message;
        inputEl.parentNode.insertBefore(error, inputEl.nextSibling);
    }

  function clearFieldError(inputEl) {
    const next = inputEl.nextElementSibling;
    if (next && next.classList.contains('field-error-message')) {
      next.remove();
    }
  }

  // Realtime org toggle validation
  document.querySelectorAll('input[name="donor-type"]').forEach(input => {
    input.addEventListener('change', () => {
      const isOrg = input.value === 'organization';
      const companyName = document.querySelector('input[name="company_name"]');
      if (!companyName) return;

      if (isOrg) {
        companyName.addEventListener('input', () => {
          if (companyName.value.trim()) {
            companyName.classList.remove('error');
            companyName.classList.add('valid');
            clearFieldError(companyName);
          } else {
            companyName.classList.add('error');
            companyName.classList.remove('valid');
          }
        });

        companyName.addEventListener('blur', () => {
          if (!companyName.value.trim()) {
            showFieldError(companyName, 'Company name is required for organization donors');
          }
        });
      } else {
        companyName.classList.remove('error', 'valid');
        clearFieldError(companyName);
      }

      checkInitialFormValidity();
    });
  });

  // Real-time validation for base inputs
  [
    { id: 'donor-name', validate: val => val.trim().length > 0, message: 'Full name is required' },
    { id: 'donor-email', validate: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val), message: 'Valid email is required' }
  ].forEach(({ id, validate, message }) => {
    const input = document.getElementById(id);
    if (!input) return;

    input.addEventListener('input', () => {
      const value = input.value;
      const valid = validate(value);

      const errorEl = input.nextElementSibling;
      if (errorEl && errorEl.classList.contains('field-error-message')) {
        errorEl.remove();
      }

      if (valid) {
        input.classList.add('valid');
        input.classList.remove('error');
        clearFieldError(input);
      } else {
        input.classList.remove('valid');
        input.classList.add('error');
      }
    });

    input.addEventListener('blur', () => {
      const value = input.value;
      if (!validate(value)) {
        showFieldError(input, message);
      }
    });

  });


  const submitBtn = document.getElementById('submit-stripe');
  if (submitBtn) {
    submitBtn.disabled = true; // Disable at first
  }
  checkInitialFormValidity();




  // PHONE FORMAT: (123) 456-7890
  const phoneInput = document.getElementById('donor-phone');
  if (phoneInput) {
    phoneInput.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, ''); // Remove all non-digits
      if (value.length > 10) value = value.substring(0, 10); // Limit to 10 digits

      if (value.length > 6) {
        e.target.value = `(${value.substring(0, 3)}) ${value.substring(3, 6)}-${value.substring(6)}`;
      } else if (value.length > 3) {
        e.target.value = `(${value.substring(0, 3)}) ${value.substring(3)}`;
      } else if (value.length > 0) {
        e.target.value = `(${value}`;
      }
    });
  }

  // EIN FORMAT: 12-3456789
  const einInput = document.querySelector('input[name="company_ein"]');
  if (einInput) {
    einInput.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
      if (value.length > 9) value = value.substring(0, 9); // Max 9 digits

      if (value.length > 2) {
        e.target.value = `${value.substring(0, 2)}-${value.substring(2)}`;
      } else {
        e.target.value = value;
      }
    });
  }





});


function updateSubmitButtonState() {
  const checkbox = document.getElementById("tax-disclaimer");
  if (checkbox) {
    checkbox.addEventListener("change", () => {
      window.checkboxChecked = checkbox.checked;
      updateSubmitButtonState();
    });

    // Initial state
    window.checkboxChecked = checkbox.checked;
  }
  const submitBtn = document.getElementById("submit-stripe");

  // Ensure checkbox state is read correctly
  window.checkboxChecked = checkbox?.checked || false;

  const shouldEnable = window.stripeComplete && window.checkboxChecked;

  if (submitBtn) {
    submitBtn.disabled = !shouldEnable;
    submitBtn.classList.toggle("disabled", !shouldEnable);
  }


}



// Donation radio group styling
/*
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
*/

document.querySelectorAll('input[name="donor-type"]').forEach(el => {
  el.addEventListener('change', (e) => {
    document.querySelectorAll('input[name="donor-type"]').forEach(input => {
      input.closest('.btn-radio')?.classList.remove('active');
    });
    e.target.closest('.btn-radio')?.classList.add('active');
  });
});



function checkInitialFormValidity() {
  const name = document.getElementById('donor-name')?.value.trim();
  const email = document.getElementById('donor-email')?.value.trim();
  const amount = parseFloat(document.getElementById('raw_donation_amount')?.value || 0);
  const donorType = document.querySelector('input[name="donor-type"]:checked')?.value;
  const companyName = document.querySelector('input[name="company_name"]')?.value.trim();

  const nameValid = name.length > 0;
  const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  const amountValid = !isNaN(amount) && amount >= 1;
  const orgValid = donorType === 'organization' ? companyName.length > 0 : true;

  const isValid = nameValid && emailValid && amountValid && orgValid;

  const continueBtn = document.getElementById('continue-to-payment');
  continueBtn.disabled = !isValid;
  continueBtn.classList.toggle('disabled', !isValid);

  const submitBtn = document.getElementById('submit-stripe');
  if (submitBtn) {
    submitBtn.disabled = true; // Disable at first
  }

  // 👉 Add this: refresh submit button state on step 2
  updateSubmitButtonState();
}