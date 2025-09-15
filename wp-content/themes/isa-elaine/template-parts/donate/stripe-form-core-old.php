<form method="POST" id="payment-form-stripe" class="border-form">
    <ul class="custom-asterisk-list">
        <!-- STEP 1 -->
        <li style="display: none;">
            <p>Would you like to make your gift a monthly donation? </p>
            <div class="payment-method-select nowrap">
                <label class="btn-radio active">
                    <input type="radio" name="donation-frequency" checked value="once" onchange="toggleFrequency()">One-Time
                </label>
                <!--
                <label class="btn-radio ">
                    <input type="radio" name="donation-frequency" value="monthly" onchange="toggleFrequency()">Monthly
                </label>
                -->
                <input type="hidden" name="donation_frequency" id="donation_frequency" value="once">
            </div>
        </li>
        <!-- STEP 2 -->
        <li>
            <p>Choose Your Gift Amount</p>
            <div class="payment-method-select flex-wrap">
                <label for="donation-amount-0" class="btn-radio" style="display: none">
                    <input id="donation-amount-0" type="radio" name="donation-amount" value="0" style="display: none;">
                </label>
                <label for="donation-amount-50" class="btn-radio">
                    <input id="donation-amount-50" type="radio" name="donation-amount" value="50" onchange="handleDonationAmountChange()"> $50
                </label>
                <label for="donation-amount-100" class="btn-radio active">
                    <input id="donation-amount-100" type="radio" name="donation-amount" value="100" onchange="handleDonationAmountChange()"> $100
                </label>
                <label for="donation-amount-250" class="btn-radio">
                    <input id="donation-amount-250" type="radio" name="donation-amount" value="250" onchange="handleDonationAmountChange()"> $250
                </label>
                <label for="donation-amount-500" class="btn-radio">
                    <input id="donation-amount-500" type="radio" name="donation-amount" value="500" onchange="handleDonationAmountChange()"> $500
                </label>
                <label for="donation-amount-1000" class="btn-radio">
                    <input id="donation-amount-1000" type="radio" name="donation-amount" value="1000" onchange="handleDonationAmountChange()"> $1,000
                </label>
                <label for="donation-amount-other" class="btn-radio">
                    <input id="donation-amount-other" type="radio" name="donation-amount" value="other" onchange="handleDonationAmountChange()"> Other
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
            <input type="hidden" id="final_donation_amount" name="final_donation_amount" value="100">
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
                    <input class="custom-radio" type="radio" name="payment-method" id="card-checkbox" value="card" checked>
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
     
    <div id="payment-element"></div>

    <!--
    <div id="card-fields">
        <div id="card-number-element" class="stripe-input"></div>
        <div id="card-expiry-element" class="stripe-input"></div>
        <div id="card-cvc-element" class="stripe-input"></div>
    </div>
    <div id="bank-fields">
        <div id="bank-name-element" class="stripe-input"></div>
    </div>
    -->
    <!-- Hidden Inputs -->
    <p id="stripe-fee-description" style="font-size: 14px; color: whitesmoke;"></p>
    <!-- Display calculated amounts -->
    <?php get_template_part('template-parts/donate/donation-summary'); ?>
    <!-- Hidden inputs if you want to send these to backend -->
    <input type="hidden" id="donation_fee" name="donation_fee" value="">
    <input type="hidden" id="donation_total" name="donation_total" value="">
    <!-- Final Step -->
    <button id="submit-stripe" type="submit">Your Giving Details</button>
</form>