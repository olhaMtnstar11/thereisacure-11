<?php
$array = get_field('navigation_section');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('navigation_section')) : the_row(); ?>
        <section id="navigation" class="plain-text scroll-section section-2">
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