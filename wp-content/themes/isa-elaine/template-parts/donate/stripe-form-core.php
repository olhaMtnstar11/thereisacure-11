<form method="POST" id="payment-form-stripe" class="border-form donate-form-css">
    <div id="initial-donor-section">
        <ul class="custom-asterisk-list">
            <!-- Donation Frequency -->
            <li style="display: none;">
                <p>Would you like to make your gift a monthly donation?</p>
                <div class="payment-method-select nowrap">
                    <label class="btn-radio active">
                        <input type="radio" name="donation-frequency" checked value="once" onchange="toggleFrequency()">One-Time
                    </label>
                    <input type="hidden" name="donation_frequency" id="donation_frequency" value="once">
                </div>
            </li>

            <!-- Preset Amounts + Custom Amount -->
            <li>
                <span>Choose Your Gift Amount</span>
                <div class="payment-method-select flex-wrap donation-amount-options">
                    <label class="btn-radio"><input type="radio" name="donation-amount" value="50"> $50</label>
                    <label class="btn-radio active"><input type="radio" name="donation-amount" value="100"> $100</label>
                    <label class="btn-radio"><input type="radio" name="donation-amount" value="250"> $250</label>
                    <label class="btn-radio"><input type="radio" name="donation-amount" value="500"> $500</label>
                    <label class="btn-radio"><input type="radio" name="donation-amount" value="other"> Other</label>
                </div>
                <div id="custom-amount-container" style="display:none">
                    <input type="text" id="amount-stripe" class="custom-email-input" placeholder="Enter custom amount" inputmode="decimal" />
                    <p id="amount-stripe-error" class="error-message" style="display:none">Please enter a valid amount greater than $1</p>
                </div>
                <input type="hidden" id="final_donation_amount" name="final_donation_amount" value="">
                <input type="hidden" id="raw_donation_amount" name="raw_donation_amount" value="">
            </li>

            <!-- Donor Type Toggle -->
            <li>
                <span>Donor Type</span>
                <div class="payment-method-select flex-wrap">
                    <label class="btn-radio active"><input type="radio" name="donor-type" value="individual" checked> Individual</label>
                    <label class="btn-radio"><input type="radio" name="donor-type" value="organization"> Organization</label>
                </div>
            </li>

            <!-- Company Info -->
            <li id="organization-fields" style="display: none;" >

                <div class="input-wrapper" style="">
                    <input type="text" name="company_name" style="margin-bottom: 20px" placeholder="Company Name" class="custom-email-input">
                </div>
                <!--  <input type="text" name="company_name" style="margin-bottom: 20px" placeholder="Company Name" class="custom-email-input">  -->
                <input type="text" name="company_ein" placeholder="EIN (optional)" class="custom-email-input">
            </li>

            <!-- Personal Info -->
            <li class="asterisk-list"><input type="text" id="donor-name" name="donor-name" placeholder="Full Name" class="custom-email-input" required></li>
            <li class="asterisk-list"><input type="email" id="donor-email" name="donor-email" placeholder="Email Address" class="custom-email-input" required></li>
            <li><label for="donor-phone"></label><input type="tel" id="donor-phone" name="donor-phone" placeholder="Phone Number (optional)" class="custom-email-input"></li>

            <!-- Note -->
            <li><textarea name="donation_note" rows="10" placeholder="Optional note or dedication..." class="custom-email-input"></textarea></li>
        </ul>

        <button type="button" id="continue-to-payment" class="payment-btn" disabled>Continue to Payment Info →</button>
    </div>

    <div id="payment-method-section" style="display:none;">
        <ul class="custom-asterisk-list">
            <!-- Payment Method -->
            <li>
                <span>Payment Method</span>
                <div id="payment-element"></div>
            </li>

            <!-- Fee Cover -->
            <li style="margin-bottom: 20px">
                <label class="custom-checkbox-wrapper">
                    <input type="checkbox" name="add-fee-checkbox" id="add-fee-checkbox" class="styled-checkbox" />
                    <span class="label-text">I would like to cover the processing fees for this donation.</span>
                </label>
            </li>

            <!-- Disclaimer -->
            <li>
                <label class="custom-checkbox-wrapper">
                    <input type="checkbox" name="tax-disclaimer" id="tax-disclaimer" class="styled-checkbox" required />
                    <span class="label-text">I understand this donation is not tax deductible.</span>
                </label>
            </li>
        </ul>

        <!-- Summary -->
        <div id="donation-summary">
            <p class="donation-line">
                <span>Total Donation</span><span id="total-display">$0.00</span>
            </p>
            <input type="hidden" id="donation_fee" name="donation_fee" value="">
            <input type="hidden" id="donation_total" name="donation_total" value="">
        </div>

        <!-- Submit -->
        <button type="submit" id="submit-stripe" class="payment-btn" disabled>Donate Now</button>
    </div>
</form>

<script>
    const orgFields = document.getElementById('organization-fields');
    document.querySelectorAll('input[name="donor-type"]').forEach(input => {
        input.addEventListener('change', () => {
            orgFields.style.display = input.value === 'organization' ? 'block' : 'none';
        });
    });


    //reloading the form if you will come from back button
    window.addEventListener("pageshow", function (event) {
        if (event.persisted || (window.performance && window.performance.getEntriesByType("navigation")[0]?.type === "back_forward")) {
            // Reload the page from server (not cache)
            window.location.reload();
        }
    });


</script>