<?php
$array = get_field('poem');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('poem')) : the_row(); ?>
        <section id="poem" class="plain-text scroll-section">

            <div>
                <?php if (get_sub_field('poem_logo')): ?>
                    <img class="poem-img" src="<?php echo esc_url(get_sub_field('poem_logo')); ?>" alt="">
                <?php endif; ?>

            </div>
            <div class="poem-text">
                <?php if (get_sub_field('poem_text')): ?>
                    <?php echo wp_kses_post(get_sub_field('poem_text')); ?>
                <?php endif; ?>
            </div>

            <div class="poem-logo">
                <?php if (get_sub_field('little_logo')): ?>
                    <img class=""
                         src="<?php echo esc_url(get_sub_field('little_logo')); ?>" alt="">
                <?php endif; ?>
            </div>


            <?php if (have_rows('partner_item')): ?>
                <div class="partner-logos">
                    <?php while (have_rows('partner_item')): the_row();
                        $logo = get_sub_field('logo');
                        if (!empty($logo)) : ?>
                            <a target="_blank" href="<?php echo esc_url(get_sub_field('link')); ?>" class="partner-logo">
                                <img src="<?php echo esc_url($logo); ?>" alt="">
                            </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>


        </section>

        <!-- Thin Line Div -->
        <div class="line-container">
            <div class="section-line-with-squares">
                <div class="square left"></div>
                <div class="section-line"></div>
                <div class="square right"></div>
            </div>
        </div>

    <?php endwhile;endif; ?>

<style>
    .general-tpl-section {
        width: 100%;
        padding-left: 26%;
        padding-right: 26%;
        margin-right: auto;
        margin-left: auto;
    }






    .poem-logo {
        text-align: center;
    }

    @media (max-width: 966px) {
        .poem-text {
            font-size: 16px;
        }
    }




</style>
<script>

</script>



