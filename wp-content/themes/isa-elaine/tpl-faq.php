<?php get_header();
/**
 * Template name: FAQ page
 */
?>

<?php

$image_mobile = get_field('image');
$image_desktop = get_field('image_desktop');

?>

<section id="science" class="plain-text">


    <div class="container">

    <div class="new-section back-link">
        <a href="/home">
            ← back
        </a>
    </div>
    </div>


    <?php if ($image_mobile || $image_desktop): ?>
        <div class="mission-image fullwidth">
            <img class="responsive-faq-img"
                 src=""
                 data-mobile="<?php echo $image_mobile; ?>"
                 data-desktop="<?php echo $image_desktop; ?>"
                 alt="Scientific">
        </div>
    <?php endif; ?>

    <div class="container">


        <?php if (get_sub_field('title')): ?>
            <h2 class="mb-5 small-caps"><?php echo esc_html(get_sub_field('title')); ?></h2>
        <?php endif; ?>



        <?php if (have_rows('qa_item')): ?>
            <?php while (have_rows('qa_item')): the_row(); ?>



                <?php if (get_sub_field('content_copy')): ?>
                    <div class="content-text ">
                        <?php echo wp_kses_post(get_sub_field('content_copy')); ?>
                    </div>
                <?php endif; ?>

                <div class="timeline-points">
                    <ul class="faq-timeline-list">
                        <?php while (have_rows('points_copy')): the_row(); ?>
                            <?php if ($text = get_sub_field('point')): ?>
                                <li><span class="point-text"><?php echo wp_kses_post($text); ?></span></li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                </div>


            <?php endwhile; ?>
        <?php endif; ?>



    </div>
</section>








<?php if (get_field('contact_us_section')): ?>

    <section class="two-columns">
        <div class="heading">
            <div class="container">


                <?php echo do_shortcode(get_field('contact_us_section')); ?>


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

<?php endif; ?>






<?php
get_footer();
?>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const responsiveImgs = document.querySelectorAll(".responsive-faq-img");

        function updateImages() {
            const isDesktop = window.innerWidth >= 967;

            responsiveImgs.forEach(img => {
                const src = isDesktop ? img.dataset.desktop : img.dataset.mobile;
                if (src) img.src = src;
            });
        }

        updateImages(); // Initial load
        window.addEventListener("resize", updateImages); // Update on resize
    });
</script>