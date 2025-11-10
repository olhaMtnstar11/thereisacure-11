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

<div style="display:flex; justify-content:center; width:100%;">
  <div id="donate-form" style="max-width:700px; width:100%;">
    <div id="phoqQyDyn2VDFPYxlzvZ0" classy="731753"></div>
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
<?php get_footer(); ?>
