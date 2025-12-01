<?php
$array = get_field('childhood_dementia');

if (is_array($array) && array_filter($array)):
    while (have_rows('childhood_dementia')) : the_row();
        // Get subfields
        $map_image = get_sub_field('map'); // image URL
        $logo_image = get_sub_field('childhood_dementia_logo'); // single image URL
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        ?>

        <section id="childhood_dementia" class="plain-text scroll-section">
            <div class="" style="width:  100%; max-height: 100%;">

                <!-- Map Image -->
                <?php if ($map_image): ?>
                    <div class="map-image">
                        <img src="<?php echo esc_url($map_image); ?>" alt="<?php echo esc_attr($title); ?>">
                    </div>
                <?php endif; ?>
            </div>
            <!-- Gold background logo -->
            <?php if ($logo_image): ?>
                <div class="logos-container">


                    <div class="logo-items childhood-text-content">
                        <img class=""
                             src="<?php echo esc_url(get_field('logo', 'option')); ?>"
                             alt="<?php echo esc_attr(get_bloginfo()); ?>">

                        <img style="padding: 5px" src="<?php echo esc_url($logo_image); ?>"
                             alt="Childhood Dementia Logo">
                    </div>


                    <!-- Text content -->
                    <div class=" container childhood-text-content">
                        <?php if ($title): ?>
                            <h2 class="small-caps "><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>
                        <?php if ($content): ?>
                            <div class="content">
                                <?php echo wp_kses_post($content); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endif; ?>


        </section>

        <!-- Decorative Line -->
        <div class="line-container">
            <div class="section-line-with-squares">
                <div class="square left"></div>
                <div class="section-line"></div>
                <div class="square right"></div>
            </div>
        </div>

    <?php endwhile; endif; ?>

<style>
    /* Map Image */
    .map-image {
        text-align: center;
    }

    .map-image img {
        max-width: 100%;
        max-height: 250px;

    }

    /* Gold background logo section */
    .logos-container {
        background-color: #cdb78d4a;
        width: 100%;
        /*  padding: 50px 0;*/
        text-align: center;
        /*  margin-bottom: 100px;*/
    }

    .logos-container .logo-items {

        display: flex;

        justify-content: center;
        align-items: stretch;
        align-content: center;
        flex-wrap: nowrap;
        flex-direction: row;
        gap: 40px;
    }

    .logos-container .logo-items img {

        background-color: white;
        max-height: 100px;
        display: inline-block;

    }

    /* Text content */
    .childhood-text-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: justify;
        padding: 20px;
    }

    .childhood-text-content h2 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .childhood-text-content .content p {
        font-size: 17px;
        line-height: 1.9;
    }

    .childhood-text-content .content a {
        color: #0867E8;
        text-decoration: underline;
        cursor: pointer;
    }

    .childhood-text-content .content p:last-child {
        margin-bottom: 0px;
    }


    @media (max-width: 1400px) {
        .childhood-text-content h2 {
            font-size: 17px !important;
            margin-bottom: 15px;
        }

        .childhood-text-content .content p {
            font-size: 14px !important;
            line-height: 1.5;
        }

        .logos-container .logo-items img {
            max-height: 60px;
        }
        .map-image img {
            width: 100%;
            max-height: 200px;
        }

    }


    @media (max-width: 966px) {
        .map-image img {
            width: 100%;
            max-height: 100%;
        }
    }


</style>

