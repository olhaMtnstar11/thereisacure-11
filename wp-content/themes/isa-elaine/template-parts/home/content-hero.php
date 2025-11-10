<?php
$donate_button = get_field('donate_button', 'option');
if (!empty($donate_button) && $donate_button['is_donate_button']) {
    $donate_label = $donate_button['label'];
    $url = $donate_button['url'];
    $check_example = !empty($donate_button['check_example']) ? $donate_button['check_example'] : ''; // Get check image
    $address = !empty($donate_button['address']) ? $donate_button['address'] : "";
    $organization_name = !empty($donate_button['donation_organization_name']) ? $donate_button['donation_organization_name'] : get_option('blogname'); // Get check image
    $content = $donate_button['content'];
    $donate_hover_text = $donate_button['hover_text'];
}

$join_us_button = get_field('join_us_button', 'option');
if ($join_us_button['is_join_us']) {
    $join_us_label = $join_us_button['label'];
    $join_us_url = $join_us_button['url'];
    $join_us_hover_text = $join_us_button['hover_text'];
}
?>

<?php
$hero_array = get_field('hero');
if (is_array($hero_array) && array_filter($hero_array)):
    while (have_rows('hero')) : the_row();
        $bg_d = get_sub_field('background');
        $bg_m = get_sub_field('mobile_background');
        $title = get_sub_field('title');
        $content = get_sub_field('content');

        $labelButton1 = get_sub_field('laber_of_button_1');
        $labelButton2 = get_sub_field('laber_of_button_2');
        $linkButton1 = get_sub_field('link_1');
        $linkButton2 = get_sub_field('link_2');


        ?>


        <section class="home-hero scroll-section section-1">
            <div class="hero-inner">
                <div class="hero-content-block">
                    <div class="hero-title"><?php echo wp_kses_post($title); ?></div>
                    <div class="hero-content"><?php echo wp_kses_post($content); ?></div>
                    <div class="hero-button-box">
                        <?php if ($labelButton1 && $linkButton1): ?>
                            <a class="hero-button primary" href="<?php echo esc_url($linkButton1); ?>">
                                <?php echo esc_html($labelButton1); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($labelButton2 && $linkButton2): ?>
                            <a class="hero-button secondary" href="<?php echo esc_url($linkButton2); ?>">
                                <?php echo esc_html($labelButton2); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="hero-image">
                    <div class="responsive-bg-home"
                         data-desktop-bg="<?php echo esc_url($bg_d); ?>"
                         data-mobile-bg="<?php echo esc_url($bg_m); ?>">
                    </div>
                </div>
            </div>

            <?php if (have_rows('partner_item', 'option')): ?>
                <div class="partner-logos">
                    <?php while (have_rows('partner_item', 'option')): the_row();
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





    <?php endwhile;
endif; ?>








<script>

    function updateHeroBackgrounds() {
        const isMobile = window.innerWidth < 966;
        document.querySelectorAll('.responsive-bg-home').forEach(div => {
            const mobileBg = div.getAttribute('data-mobile-bg');
            const desktopBg = div.getAttribute('data-desktop-bg');
            div.style.backgroundImage = `url(${isMobile ? mobileBg : desktopBg})`;
        });
    }
    document.addEventListener('DOMContentLoaded', updateHeroBackgrounds);
    window.addEventListener('resize', updateHeroBackgrounds);

</script>

<style>
    .home-hero {

        display: flex;
        flex-direction: column;

        justify-content: space-between;
        align-items: center;
        align-self: flex-start;
    }

    /* layout of text + image */
    .hero-inner {
        padding-top: 120px;
                display: flex;
                align-items: flex-start; /* image stays near top */
        justify-content: center;
        gap: 0; /* no large gap */
        position: relative;

    }

    /* TEXT SIDE */
    .hero-content-block {
padding-right: 40px;
        max-width: 710px;
        display: flex;
        flex-direction: column;
        justify-content: center;

        z-index: 2;
        align-self: end;
    }

    .hero-title h1 {
        font-size: 56px;
        font-family: "Bodoni 11", serif;
        line-height: 1.2;
        margin-bottom: 20px;
        font-weight: 300!important;
    }

    .hero-content p{
        font-family: "iA Writer Duo", sans-serif;
        font-size: 18px;
        font-weight: 300;
        line-height: 1.6;
        max-width: 520px;
    }

    .hero-button-box {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .hero-button {
        font-family: "iA Writer Duo", sans-serif;
        border: 1px solid #CDB78D;
        border-radius: 50px;
        font-size: 17px;
        padding: 10px 30px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .hero-button.primary {
        background-color: #CDB78D;
        color: #000;
    }

    .hero-button.secondary {
        background-color: transparent;
        color: #CDB78D;
        border: none;
    }

    .hero-button:hover {
        opacity: 0.85;
    }

    /* IMAGE SIDE */
    .hero-image {
        flex: 1;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;

        z-index: 1;
        align-self: start;
    }

    .responsive-bg-home {

        width: 35vw;
        aspect-ratio: 4 / 3;
        background-size: cover;
        background-position: center;

    }



    .partner-logo img {
        max-height: 50px;
        object-fit: contain;
    }







    @media (max-width: 1400px) {

        .hero-inner {
            top: 80px;
            padding-top: 80px;
            display: flex;
            align-items: flex-start; /* image stays near top */
            justify-content: center;
            gap: 0; /* no large gap */
            position: relative;

        }




        .hero-title h1 {
            font-size: 44px;

        }


        .hero-content p{

            font-size: 15px;

        }

        .hero-content-block {

        }

        .hero-image {

        }
    }





    /* RESPONSIVE STYLES */
    @media (max-width: 966px) {
        .home-hero {
            padding: 40px 5%;
            gap: 30px;
            height: 100%;
        }

        .hero-inner {
            flex-direction: column-reverse;
            align-items: center;
            gap: 20px;
            top: 0px;
        }

        .hero-content-block {
            text-align: justify;

            transform: translate(0);
          margin: 20px 20px;
            padding: 0px;
            align-self: center;
        }

        .hero-title h1 {

            font-size: 27px;
        }


        .hero-content p{

            font-size: 15px;

        }

        .hero-button-box {
            width: 100%;
            font-size: 15px;
            justify-content: center;
            flex-wrap: wrap;
            flex-direction: column;
            align-items: stretch;
            align-content: center;
        }
        .hero-button-box a{
            font-size: 13px;
        }

        .hero-button.primary {
         width: 100%;
            text-align: center;
        }
        .hero-button.secondary {
            width: 100%;
            text-align: center;
        }
        .hero-image {
            justify-content: center;
            transform: translate(0);
        }

        .responsive-bg-home {

            width: 100vw;
        }

        .partner-logos {
            gap: 15px;
        }
    }

</style>

