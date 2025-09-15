<?php get_header();
/**
 * Template name: Key Points page
 */
?>


<?php

$array_faq = get_field('faq');
// check if the repeater field has rows of data
if (is_array($array_faq) && array_filter($array_faq)):
// loop through the rows of data
while (have_rows('faq')) : the_row();

?>

    <section id="fqa" class="plain-text">
        <div class="container">

            <div class="new-section back-link">
                <a href="/home">
                    ← back
                </a>
            </div>
        </div>

        <div class="container">


            <?php if (get_sub_field('title')): ?>
                <h2 class="mb-5 small-caps"><?php echo esc_html(get_sub_field('title')); ?></h2>
            <?php endif; ?>

            
            <!-- Questions Indexed -->
             <div id="questions" style="margin-bottom: 75vh;">
             <?php if (have_rows('qa_item')): ?>
                <?php $index = 1; ?>
                    <?php while (have_rows('qa_item')): the_row(); ?>
                        <?php if (get_sub_field('question')): ?>
                            <div style="margin: 30px 0px;"><a class="question" href="#question-<?php echo $index; ?>"><?php echo wp_kses_post(get_sub_field('question')); ?> →</a></div>
                        <?php endif; ?>
                    <?php $index++; ?>
                <?php endwhile; ?>
            <?php endif; ?>
            </div>
            <!-- / Questions Indexed -->


            <?php if (have_rows('qa_item')): ?>
                <?php $index = 1; ?>
                <?php while (have_rows('qa_item')): the_row(); ?>



                    <?php if (get_sub_field('content_copy')): ?>
                        <div id="question-<?php echo $index; ?>" class="content-text" style="padding-top: 120px;">
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

                    <?php $index++; ?>
                <?php endwhile; ?>
            <?php endif; ?>



        </div>
    </section>

<?php endwhile;endif; ?>



<style>
    .question {
        color: #0867E8;
        font-size: 16px;
        font-family: 'iA Writer Duo', sans-serif;
    }

    .question:hover {
        text-decoration: underline;
    }
</style>











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
        const responsiveImgs = document.querySelectorAll(".responsive-key-img");

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