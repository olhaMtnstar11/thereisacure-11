<?php
$array = get_field('navigation_section');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('navigation_section')) : the_row(); ?>
        <section id="navigation" class="plain-text">
            <div class="navigation-row">
                <?php while (have_rows('navigation')): the_row();
                    $image_mobile = get_sub_field('image');
                    $image_desktop = get_sub_field('image_desktop');
                    ?>
                    <div class="navigation-card">


                        <?php if (get_sub_field('image')): ?>
                            <div class="card-image">
                                <a href="<?php echo get_sub_field('link'); ?>">


                                    <img
                                            data-desktop-src="<?php echo esc_url($image_desktop); ?>"
                                            data-mobile-src="<?php echo esc_url($image_mobile); ?>"
                                            alt="link"
                                            class="navigation-link-image"
                                            src=""
                                    />
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="mobile-container-navigation">
                            <!--
                            <?php if (get_sub_field('title')): ?>


                                <a class="navigation-title" href="<?php echo get_sub_field('link'); ?>">
                                    <h2 class="card-title"><?php echo esc_html(get_sub_field('title')); ?></h2>
                                </a>

                            <?php endif; ?>
                            -->
                        </div>
                        <div class="mobile-container-navigation">
                            <?php if (get_sub_field('text')): ?>
                                <div class="card-text">
                                    <?php echo wp_kses_post(get_sub_field('text')); ?>
                                </div>
                                <div class="read-more-box">
                                    <a class="read-more-button" href="<?php echo get_sub_field('link'); ?>">
                                        <?php echo get_sub_field('link_text'); ?> →
                                    </a>
                                </div>

                            <?php endif; ?>
                        </div>


                    </div>
                <?php endwhile; ?>
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
    .navigation-row {
        display: flex;
        flex-wrap: wrap; /* allow items to wrap */
        justify-content: center; /* center items in row */
        gap: 3rem; /* optional: space between items */

    }

    .navigation-card {
        flex: 0 1 450px; /* flexible: grow/shrink with min width */
        max-width: 450px; /*     prevent items from being too wide */
        display: flex;
        flex-direction: column;
    }


    .card-title {
        font-size: 34px;
        margin-bottom: 15px;
    }

    .card-image {
        /*
        height: -webkit-fill-available;
        */
    }

    .card-image img {
        width: 100%;
        height: auto;
    }

    .card-text {
        font-family: "Bodoni 06", sans-serif;
        font-size: 17px;
        line-height: 1.5;
    }

    .hidden-text {
        display: none;
    }

    .hidden-text.show {
        display: block;
    }

    .read-more-button {
        font-family: "iA Writer Duo", sans-serif;
        background-color: transparent;
        text-align: left;
        width: 190px;
        border: 1px solid #0867E8;
        border-radius: 50px;
        font-size: 15px;
        padding: 3px 20px 3px 20px;
        cursor: pointer;
        margin: 30px 0;
        text-transform: uppercase;
    }

    .read-more-button a {
        color: #0867E8 !important;
    }

    a.read-more-button {
        color: #0867E8;
        transition: all 0.3s ease;
    }

    .read-more-button:hover {
        opacity: 0.8;
        background: #6096ef45;
    }

    .navigation-card a:hover {
       /* color: #0867E8;*/
        transition: all 0.3s ease;
    }

    .mobile-container-navigation {
        padding: 0 0;
    }

    .read-more-box {
        margin-bottom: 90px;
    }

    @media (max-width: 966px) {
        .mobile-container-navigation {
            padding: 0 25px;
        }

        .navigation-card {
            flex: 0 1 100%; /* flexible: grow/shrink with min width */
            max-width: 100%;
           /*   max-width: 500px;     prevent items from being too wide */
        }

        .read-more-button {
            font-size: 16px;

        }

        .card-text p{
            font-size: 15px;
        }

    }

</style>

<script>
    function updateHeroImages() {
        const isMobile = window.innerWidth < 966;

        document.querySelectorAll('.navigation-link-image').forEach(img => {
            const mobileSrc = img.getAttribute('data-mobile-src');
            const desktopSrc = img.getAttribute('data-desktop-src');

            img.src = isMobile ? mobileSrc : desktopSrc;

            // Optional: change aspect ratio by adjusting container styles if needed

        });
    }

    document.addEventListener('DOMContentLoaded', updateHeroImages);
    window.addEventListener('resize', updateHeroImages);
</script>