<?php
$array = get_field('partners');

if (is_array($array) && array_filter($array)):
    while (have_rows('partners')) : the_row();
        $title_research = get_sub_field('title_research');
        $title_awareness = get_sub_field('title_awareness');
        $image_research = get_sub_field('image_research'); // image URL

        $image_awareness = get_sub_field('image_awareness'); // image URL
        ?>

        <section id="home_partners" class="plain-text scroll-section">

            <div class="home-partners-wrapper">


                <div class="home_partners_container">
                    <?php if ($title_awareness): ?>
                        <h3 class="section-title"><?php echo esc_html($title_awareness); ?></h3>
                    <?php endif; ?>

                    <div class="flex-partners awareness">
                        <?php if (have_rows('partners_awareness')): ?>
                            <?php while (have_rows('partners_awareness')) : the_row();
                                $logo = get_sub_field('logo'); // image URL
                                if ($logo): ?>


                                    <a target="_blank" href="<?php echo esc_url(get_sub_field('url')); ?>"
                                       class="partner-logo new-partners">
                                        <img src="<?php echo esc_url($logo); ?>" alt="">
                                    </a>


                                <?php endif;
                            endwhile; ?>
                        <?php endif; ?>
                    </div>


                    <div class="img-partner-section">


                        <div class="partner-image-container awareness-img">
                            <img style="max-width: 200px" src="<?php echo esc_url($image_awareness); ?>" alt="">
                        </div>


                    </div>


                </div>


            </div>


        </section>
        <section id="home_partners" class="plain-text scroll-section">

            <div class="home-partners-wrapper">

                <div class="home_partners_container">
                    <?php if ($title_research): ?>
                        <h3 class="section-title"><?php echo esc_html($title_research); ?></h3>
                    <?php endif; ?>

                    <div class="flex-partners research" style="">
                        <?php if (have_rows('partners_research')): ?>
                            <?php while (have_rows('partners_research')) : the_row();
                                $logo = get_sub_field('logo'); // image URL
                                if ($logo): ?>

                                    <a target="_blank" href="<?php echo esc_url(get_sub_field('url')); ?>"
                                       class="partner-logo new-partners">
                                        <img src="<?php echo esc_url($logo); ?>" alt="">
                                    </a>

                                <?php endif;
                            endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <div style="position: relative; padding: 0 20%">


                        <div class="partner-image-container research-img">
                            <img style="max-width: 200px" src="<?php echo esc_url($image_research); ?>" alt="">
                        </div>
                    </div>

                </div>
            </div>

        </section>

    <?php endwhile; endif; ?>
<!-- Decorative Line -->
<div class="line-container">
    <div class="section-line-with-squares">
        <div class="square left"></div>
        <div class="section-line"></div>
        <div class="square right"></div>
    </div>
</div>

<style>


    .home-partners-wrapper {
        width: 100%;

        font-family: iA Writer Duo, sans-serif;
        padding: 0px 0 0 0 !important;
        height: auto;
        justify-content: flex-start !important;

    }

    .home_partners_container {


    }

    .home_partners_container h3 {
        text-align: center;
    }


    .flex-partners {
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        padding: 60px 30px;
        flex-direction: row;
        gap: 40px;

    }

    .awareness {
        flex-wrap: nowrap;
        background-color: #cdb78d4a;
    }

    .research {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        background-color: #C7DDF3;


    }


    .partner-image-container {
        display: flex;
        width: 100%;
        position: relative;
        height: 110px; /* or whatever size you want */
        overflow: visible; /* allow image to spill outside */
        z-index: 10; /* make sure it’s on top */
    }

    .partner-image-container img {
        position: absolute;
        bottom: 0;


        /*   transform: translate(80%, -50%); adjust placement visually */
        max-width: 400px; /* keep original size */
        height: auto;
        z-index: 20; /* ensure image is above container */
    }

    .awareness-img.partner-image-container img {
        left: 0;
        transform: translate(100%, 40%);
        -ms-transform: translate(100%, 40%); /* IE9 */
    }

    .research-img.partner-image-container img {
        right: 0;
        transform: translate(0%, 22%);
        -ms-transform: translate(0%, 22%); /* IE9 */
    }

    .partner-logo.new-partners img {
        max-height: 100px;
        width: 200px;
    }

    .img-partner-section {
        position: relative;
        padding: 0 20%;
    }

    @media (max-width: 1400px) {

        .awareness-img.partner-image-container img {

            transform: translate(150%, 40%);
            -ms-transform: translate(150%, 40%); /* IE9 */
        }

        .research-img.partner-image-container img {

            transform: translate(50%, 24%);
            -ms-transform: translate(50%, 24%); /* IE9 */
        }

        .img-partner-section {

            padding: 0 0;
        }

        .partner-logo.new-partners img {

            width: 170px;
        }
    }




    @media (max-width: 966px) {


        .awareness-img.partner-image-container img  {

            transform: translate(10%, 25%);
            -ms-transform: translate(10%, 25%); /* IE9 */
        }

        .research-img.partner-image-container img {

            transform: translate(25%, 10%);
            -ms-transform: translate(25%, 10%); /* IE9 */
        }


        .home-partners-wrapper {
            width: 100%;
            font-family: iA Writer Duo, sans-serif;
            padding: 0 0 0 0 !important;
            height: auto;
            justify-content: flex-start !important;
margin-bottom: 200px;
        }

        .flex-partners.research {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px 0px;
            justify-items: center;
            align-items: center;
            padding: 60px 30px;
        }


        .partner-image-container {
            justify-content: center;
            margin-top: 30px;
        }

        .flex-partners {
  gap: 0px
        }

    }
</style>
