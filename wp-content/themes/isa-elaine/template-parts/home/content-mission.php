<?php
$array = get_field('mission');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('mission')) : the_row();
        $image_mobile = get_sub_field('image');
        $image_desktop = get_sub_field('image_desktop');
        ?>
        <section id="mission" class="plain-text">
            <div class="mission-grid">


                <?php if ($image_mobile || $image_desktop): ?>

                <div class="mission-item-1" style="padding-bottom: 120px;">
                    <img
                            class="mission-image"
                            data-desktop-src="<?php echo esc_url($image_desktop); ?>"
                            data-mobile-src="<?php echo esc_url($image_mobile); ?>"
                            alt="mission-image"
                            src=""
                    />
                </div>
                <?php endif; ?>
                <!--
                <div class="mission-item-2">
                    <?php while (have_rows('right_column')): the_row();
                        $image = get_sub_field('image');
                        $title = get_sub_field('image_title');
                        $content = get_sub_field('content');
                        $button = get_sub_field('button_name');

                        $link = get_sub_field('button_link');
                        ?>
                        <div class="mission-navigation-item">
                            <?php if ($image): ?>
                                <img src="<?php echo esc_url($image); ?>" alt="">
                            <?php endif; ?>

                            <?php if ($title): ?>
                                <img src="<?php echo esc_url($title); ?>" alt="">
                            <?php endif; ?>

                            <?php if ($content): ?>
                                <?php echo wp_kses_post($content); ?>
                            <?php endif; ?>

                            <?php if ($button): ?>
                                <div class="mission-navigation-item-button">
                                    <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($button); ?></a>
                                </div>

                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                -->

                <div class="mission-item-3" style="padding-top: 120px;">
                    <?php if (get_sub_field('title')): ?>
                        <h2 class="mb-5"><?php echo esc_html(get_sub_field('title')); ?></h2>
                    <?php endif; ?>
                    <?php if (get_sub_field('center_column')): ?>
                        <div class="two-column-text-mission">

                            <?php echo wp_kses_post(get_sub_field('center_column')); ?>
                        </div>
                    <?php endif; ?>




                    <?php
                    $icon = get_sub_field('icon_image');
                    $pdf_label = 'ISA ELAINE FOUNDATION OVERVIEW PDF';
                    $pdf_link = get_sub_field('file'); // file field
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


        <!-- /.home-about -->
    <?php endwhile;endif; ?>

<style>


    .mission-item-1 {

        grid-column: 1 / 2;
        width: 65% !important;
        margin-left: 35%;
    !important;

    }

    .mission-item-1 img.mission-image {
        grid-column: 1 / 2;
        grid-row: 1 / 2;
        order: 0;
        max-width: 100% !important;
        margin: 10% auto !important;
    }

    .mission-item-3 {
        width: 65% !important;
        margin-left: 35%;
    !important;
        text-align: left !important;
        grid-column: 1 / 2;
        grid-row: 2 / 3;
        order: 1;
    }


    .mission-item-2 {
        font-size: 14px;
        display: flex;
        flex-direction: column;
        gap: 150px;
        padding: 0 50px 0 150px;
        justify-content: flex-end;
        height: 100%;
        grid-column: 2 / 3;
        grid-row: 1 / 3;
    }


    .mission-item-2 {
        font-size: 14px;
        flex: 0 0 26%;
        display: flex;
        flex-direction: column;
        gap: 150px;
        padding: 0 50px 0 150px;
        justify-content: flex-end;
        height: 100%;
    }

    .mission-navigation-item {
        padding: 25px;
        text-align: left;
    }

    .mission-navigation-item img {
        width: 100%;
        height: auto;
        margin-bottom: 0.5rem;
    }

    .mission-navigation-item a {
        display: inline-block;
        color: #0867E8;
    }


    /*from navigation button */
    .mission-navigation-item-button {
        font-family: "iA Writer Duo", sans-serif;
        background-color: transparent;
        text-align: left;
        border: 1.5px solid #0867E8;
        border-radius: 50px;
        padding: 10px 24px;
        cursor: pointer;
        margin: 30px 0;
        text-transform: uppercase;
        width: 230px !important;
        font-size: 14px !important;
    }

    .mission-navigation-item-button a {
        color: #0867E8 !important;
    }

    a.mission-navigation-item-button {
        color: #0867E8;
        transition: all 0.3s ease;
    }

    .mission-navigation-item-button:hover {
        opacity: 0.8;
        background: #6096ef45;
    }


    /* MOBILE */
    @media (max-width: 1600px) {
        .mission-item-2 {
            order: 2;
            font-size: 14px;
            flex: 0 0 400px;
            display: flex;
            flex-direction: column;
            gap: 100px;
            padding: 0 0 0 0;
        }

        .mission-navigation-item-button {
            padding: 10px 10px;
            width: 200px !important;

        }

        .mission-grid {
            gap: 0px;
        }

        .two-column-text-mission {
            column-count: 1!important;
        }

        .mission-item-1 {
            flex: 0 0 55%;
        }

        .mission-item-3 {
            margin-left: 31%;
        }
    }


    @media (max-width: 966px) {
        .mission-grid {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 20px;
            margin-bottom: 2em;
        }

        .mission-item-1 img.mission-image {
            order: 1;
            max-width: 100% !important;
            margin: 10% 0 !important;
            grid-column: unset !important;
            grid-row: unset !important;
        }

        .mission-item-2 {
            order: 2;
            flex: none !important;
            padding: 0;
            gap: 100px;
            grid-column: unset !important;
            grid-row: unset !important;
        }

        .mission-item-3 {
            order: 3;
            width: 100% !important;
            margin-left: 0 !important;
            margin-top: 20px !important;
            padding: 0 25px !important;
            grid-column: unset !important;
            grid-row: unset !important;
        }
    }


    /*-----------------*/


    .new-section h2 {
        padding-bottom: 70px;
    }


    .three-column p {
        padding-left: 10px;
    }


    .two-column-text-mission {
        font-size: 20px;
        column-count: 1;
        column-gap: 20px;
        line-height: 1.6;
        text-align: left;
        hyphens: auto;
        -webkit-hyphens: auto;
        -ms-hyphens: auto;
    }

    .two-column-text-mission h2 {
        margin-top: 200px;
        margin-bottom: 15px !important;
    }

    .firs-column-mission-image-box img.mission-image {
        max-width: 50%;
        height: auto;
        display: block;
        margin-left: auto; /* 👈 Push image to the right */
    }


    .two-column-text-mission {
        column-count: 2;
    }

    .mission-grid {
        display: grid;
        grid-template-columns: 70% 30%;
        margin-bottom: 2.1em;
        justify-content: center;
        align-items: center;

    }

    .mission-item-1 {
        flex: 0 0 60%;

    }

    .mission-item-1 img {
        height: auto;
        display: block;

    }

    .mission-image {
        max-width: 60%;
        margin: 10% 0 30% 35%;
    }


    @media (max-width: 966px) {
        .mission-grid {
            grid-template-columns: 1fr;
        }

        .two-column-text-mission {
            column-count: 1; /* stack into one column on smaller screens */
        }


        .three-column p {
            max-width: 300px;
        }

        .two-column-text-mission h2 {
            margin-top: 10px;
            margin-bottom: 15px !important;
        }

        .mission-grid {
            flex-wrap: wrap-reverse;
            justify-content: center;
        }

        .two-column-text-mission {
            column-count: 1;
        }


        .mission-item-1 {
            order: 1;
            flex: 0 0 100%;
            padding: 0 0;
            width: 100% !important;
            margin: 0 !important;
        }

        .mission-item-1 img {
            margin: 0 0 30px 0;


        }

        .mission-item-3 {
            margin-top: 150px;
            margin-left: 0;
            width: 100%;
            padding: 0 25px;
        }


        .mission-image {
            max-width: 100%;
            margin: 10%;
        }

        .mission-navigation-item img:first-of-type {
            padding: 0 65px;
            margin: 0;
        }

        .mission-navigation-item img:last-of-type {
            padding-right: 100px;
            margin: 0;
        }
    }


</style>
<script>
    function updateHeroImages() {
        const isMobile = window.innerWidth < 966;

        document.querySelectorAll('.mission-image').forEach(img => {
            const mobileSrc = img.getAttribute('data-mobile-src');
            const desktopSrc = img.getAttribute('data-desktop-src');

            img.src = isMobile ? mobileSrc : desktopSrc;

            // Optional: change aspect ratio by adjusting container styles if needed

        });
    }

    document.addEventListener('DOMContentLoaded', updateHeroImages);
    window.addEventListener('resize', updateHeroImages);
</script>