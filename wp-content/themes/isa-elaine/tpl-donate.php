<?php
/**
 * Template Name: Tpl Donate
 */

get_header(); ?>

<?php if (have_rows('sections')): ?>
    <?php while (have_rows('sections')) : the_row(); ?>
        <?php
        switch (get_row_layout()) {
            case 'hero':
                get_template_part('template-parts/donate/hero');
                break;
            case 'donation_description':
                get_template_part('template-parts/donate/description');
                break;

        }
        ?>
    <?php endwhile; ?>
<?php endif; ?>

<!-- Donation Section -->
<!-- Donation Page Section -->
<section id="donate" style="max-width:900px; margin:0 auto; padding:60px 20px; text-align:center; font-family:sans-serif; background:#f9f9f9; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

    <!-- Header -->
    <h1 style="font-size:36px; margin-bottom:15px; color:#333;">Support Our Cause</h1>
    <p style="font-size:18px; color:#555; margin-bottom:40px;">
        Every donation helps us make a real impact. Thank you for your generosity!
    </p>

    <!-- Featured Image -->
    <img src="https://via.placeholder.com/800x300" alt="Cause Image" style="width:100%; max-width:800px; border-radius:10px; margin-bottom:40px;">

    <!-- GoFundMe Embed -->
    <script defer src="https://www.gofundme.com/static/js/embed.js"></script>
    <div class="gfm-embed" data-url="https://www.gofundme.com/f/help-maui-wildfire-victims" style="margin-bottom:40px;"></div>

    <!-- Optional Custom Donate Button -->
    <a href="https://www.gofundme.com/f/help-maui-wildfire-victims" target="_blank"
       style="display:inline-block; padding:16px 30px; font-size:18px; font-weight:bold; color:#fff; background:#02a95c; text-decoration:none; border-radius:8px; transition:0.3s;">
        Donate Now
    </a>

    <!-- Extra Information Section -->
    <div style="margin-top:50px; text-align:left; max-width:800px; margin-left:auto; margin-right:auto;">
        <h2 style="font-size:28px; color:#333; margin-bottom:15px;">Why We Need Your Help</h2>
        <p style="font-size:16px; color:#555; line-height:1.6;">
            Our organization works to support [insert cause here]. Every contribution helps us fund programs, resources, and initiatives that directly impact the community. Your support is crucial to continuing our mission.
        </p>

        <h2 style="font-size:28px; color:#333; margin-top:30px; margin-bottom:15px;">Contact Us</h2>
        <p style="font-size:16px; color:#555; line-height:1.6;">
            Have questions? Want to learn more about our projects? Reach out to us anytime!
            <a href="/contact" style="color:#02a95c; font-weight:bold;">Go to Contact Page</a>
        </p>
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
