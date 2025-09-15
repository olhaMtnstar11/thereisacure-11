<?php get_header();
/**
 * Template name: Connection page
 */
?>


<?php

    $image_mobile = get_field('image');
    $image_desktop = get_field('image_desktop');

        ?>


        <section id="connection" class="plain-text">




            <div class="new-section back-link">
                <a href="/home">
                    ← back
                </a>
            </div>




            <?php if ($image_mobile || $image_desktop): ?>
                <div class="mission-image fullwidth">
                    <img class="responsive-science-img"
                         src=""
                         data-mobile="<?php echo $image_mobile; ?>"
                         data-desktop="<?php echo $image_desktop; ?>"
                         alt="Scientific">
                </div>
            <?php endif; ?>


            <div class="new-section">
                <?php if (get_field('title')): ?>
                    <h2 class="mb-4"><?php echo esc_html(get_field('title')); ?></h2>
                <?php endif; ?>

                <?php if (get_sub_field('sub_title')): ?>
                    <h4 class="mb-6 sub-title font-ia-writer-duo"><?php echo esc_html(get_field('sub_title')); ?></h4>
                <?php endif; ?>


            </div>


            <div class="three-column-grid new-section-content">
                <div class="firs-column">
                <?php if (get_field('content_1')): ?>

                        <?php echo wp_kses_post(get_field('content_1')); ?>

                <?php endif; ?>
                </div>
                <?php if (get_field('content_2')): ?>
                    <div class="two-column-text">
                        <?php echo wp_kses_post(get_field('content_2')); ?>
                    </div>
                <?php endif; ?>

                <?php if (get_field('content_3')): ?>
                    <div class="vertical-center">
                        <?php echo wp_kses_post(get_field('content_3')); ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="new-section research-block">
                <?php if (get_field('content_4')): ?>

                        <?php echo wp_kses_post(get_field('content_4')); ?>
                <?php endif; ?>



            </div>

            <div class="container">
                <?php
                $icon = get_field('icon_image');
                $pdf_label = 'HALLMARK CHARACTERISTICS OF NEURODEGENERATIVE DISORDERS';
                $pdf_link = get_field('file'); // file field
                ?>

                <?php if ($icon || $pdf_link): ?>
                    <div class="download-block">
                        <!-- LEFT COLUMN -->
                        <div class="download-block-left font-ia-writer-duo">
                            <?php if ($pdf_link): ?>
                                <?php if ($icon): ?>
                                    <a href="<?php echo esc_url($pdf_link['url']); ?>" target="_blank">
                                        <img src="<?php echo esc_url($icon); ?>" alt="">
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($pdf_link['url']); ?>" target="_blank"
                               class="">
                                <p class="download-block-title"><?php echo esc_html($pdf_label); ?> ↗ </p>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
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
    const responsiveImgs = document.querySelectorAll(".responsive-science-img");

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


<style>
    .new-section {
    width: 100%;
    padding-left: 26%;
        margin-right: auto;
        margin-left: auto;
    }

    .new-section h2{
        padding-bottom: 40px;
    }

    .content-pic {
        max-width: 450px;
        padding: 50px 0;
    }



    .firs-column {
    text-align: center;
    }

    .vertical-center {
    display: flex;
    align-items: center;
        justify-content: center; /* optional: for horizontal centering */
        text-align: start; /* optional: for text alignment */
        font-style: italic;
        font-size: 16px;
max-width: 85%;
        hyphens: auto;
        -webkit-hyphens: auto;
        -ms-hyphens: auto;
    }
    .vertical-center p{
    padding-left: 10px;
    }

    .three-column-grid {
    gap: 17px;
        display: grid;
        grid-template-columns: 25% 50% 25%;
        margin-bottom: 2.1em;
    }

    .two-column-text {
    font-size: 20px;
        column-count: 2;
        column-gap: 20px;
        line-height: 1.6;
        text-align: left;
        hyphens: auto;
        -webkit-hyphens: auto;
        -ms-hyphens: auto;
    }

    .research-block {
    font-size: 20px;
    }

    @media (max-width: 1600px) {
    .two-column-text {
        column-count: 1;
        }

        .two-column-text img {
            max-width: 400px;

        }
    }


    @media (max-width: 966px) {
    .new-section {
        max-width: 930px;
            padding-left: 25px;
            padding-right: 25px;
        }

        .new-section-content {
        padding: 0 25px;
            text-align: left;
        }

        .three-column-grid {
        gap: 0;
    }

        .firs-column {
        text-align: left;
        }

        .two-column-text {
        column-count: 1; /* stack into one column on smaller screens */
        }
        .three-column-grid {
        grid-template-columns: 1fr; /* stack in mobile */
            margin-bottom: 0px;
        }

        .vertical-center {
        max-width: 100%;
            justify-content: end;
        }

        .vertical-center p {
        max-width: 300px;
        }

        .two-column-text img {
            max-width: 300px;

        }
    }


</style>