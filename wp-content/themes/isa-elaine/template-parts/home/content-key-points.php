<?php
$array = get_field('key_points');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('key_points')) : the_row();
        $image_mobile = get_sub_field('image');
        $image_desktop = get_sub_field('image_desktop');

?>
        <section id="key-points" class="plain-text">

            <div class="container">


                <?php if (get_sub_field('title')): ?>
                    <h2 class="mb-5"><?php echo esc_html(get_sub_field('title')); ?></h2>
                <?php endif; ?>



                <div class="key-points">
                    <?php while (have_rows('point')) : the_row(); ?>
                        <?php
                        $name = get_sub_field('name');
                        $content = get_sub_field('content');
                        if ($name || $content): ?>
                            <div class="key-point-row">
                                <?php if ($name): ?>
                                    <div class="key-point-name small-caps"><?php echo esc_html($name); ?></div>
                                <?php endif; ?>

                                <?php if ($content): ?>
                                    <div class="key-point-content font-bodoni-italic-6"><?php echo wp_kses_post($content); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
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



</style>

