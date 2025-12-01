<?php
$array = get_field('poem');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('poem')) : the_row(); ?>
        <section id="poem" class="plain-text scroll-section">

            <div class="poem-pictures">
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







            <?php if (have_rows('partner_item', 'option')): ?>
                <div class="carousel" id="carousel" role="region" aria-label="Logo Carousel">
                    <div class="carousel-container" id="carouselContainer" role="list">
                        <?php while (have_rows('partner_item', 'option')): the_row();
                            $logo = get_sub_field('logo');
                            if (!empty($logo)) : ?>

                                <div class="carousel-item" role="listitem">
                                    <a target="_blank" href="<?php echo esc_url(get_sub_field('link')); ?>" class="partner-logo-carousel">
                                        <img src="<?php echo esc_url($logo); ?>" alt="">
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>

                    </div>
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


/*     carousel!!!       */
    :root {
        --items-per-page: 10;
    }

    .carousel {
        width: 100%;
        overflow: hidden;
        position: relative;
        padding: 50px 0;
    }

    .carousel-container {
        /* Prevent logos from wrapping to the next line */
        white-space: nowrap;
    }

    .carousel-item {
        display: inline-block;
        min-width: calc(100% / var(--items-per-page));
        box-sizing: border-box;
        padding: 10px;
        text-align: center;

    }



    .partner-logo-carousel img {
        cursor: pointer;
        max-height: 60px;
        width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }




    @media (max-width: 1400px) {

        .carousel {
            padding: 10px 0;
        }
        .partner-logo-carousel img {
            max-height: 40px;

        }

        .poem-pictures {
            height: 200px;
            overflow: hidden;
        }


    }
    @media (max-width: 966px) {

        .carousel {
            padding: 100px 0;
        }

        .partner-logo-carousel img {
            max-height: 50px;

        }

        .poem-pictures {
            height: 100%;
            overflow: hidden;
        }

    }


</style>




<script>

    // Clone the carousel content to create a continuous loop
    const carouselItems = carouselContainer.innerHTML;
    carouselContainer.innerHTML += carouselItems;

    // Set up animation
    let scrollLeft = 0;
    const scrollSpeed = 3; // Adjust the scroll speed as needed

    function animateCarousel(timestamp) {
        if (!lastTimestamp) {
            lastTimestamp = timestamp;
        }

        const deltaTime = timestamp - lastTimestamp;
        lastTimestamp = timestamp;

        scrollLeft += scrollSpeed * deltaTime / 60; // Normalize speed
        if (scrollLeft >= carouselContainer.scrollWidth / 2) {
            scrollLeft = 0;
        }
        carouselContainer.style.transform = `translateX(-${scrollLeft}px)`;

        requestAnimationFrame(animateCarousel);
    }

    let lastTimestamp = null;
    requestAnimationFrame(animateCarousel);

</script>



