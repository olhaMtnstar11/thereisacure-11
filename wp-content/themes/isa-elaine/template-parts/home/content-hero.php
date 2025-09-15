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
        <section class="home-hero" style="position: relative; ">
            <div class="hero-container">
                <div class="responsive-bg-home"
                     data-desktop-bg="<?php echo esc_url($bg_d); ?>"
                     data-mobile-bg="<?php echo esc_url($bg_m); ?>">
                </div>

                <div class="hero-section">
                    <div class="hero-title"><?php echo wp_kses_post($title); ?></div>
                    <div class="hero-content">
                        <?php echo wp_kses_post($content); ?>


                        <div class="hero-button-box">
                            <a class="hero-button" href="<?php echo esc_url($linkButton1); ?>">
                                <?php echo esc_html($labelButton1); ?>
                            </a>
                            <a class="hero-button" href="<?php echo esc_url($linkButton2); ?>">
                                <?php echo esc_html($labelButton2); ?>
                            </a>
                        </div>


                    </div>
                </div>
            </div>


        </section>
    <?php endwhile;
endif; ?>


<script>

    function updateHeroBackgrounds() {
        const isMobile = window.innerWidth < 966;

        document.querySelectorAll('.responsive-bg-home').forEach(div => {
            const mobileBg = div.getAttribute('data-mobile-bg');
            const desktopBg = div.getAttribute('data-desktop-bg');

            if (isMobile) {
                div.style.backgroundImage = `url(${mobileBg})`;
                div.style.aspectRatio = '3 / 2'; // 10/20
            } else {
                div.style.backgroundImage = `url(${desktopBg})`;
                div.style.aspectRatio = '9 / 3'; // 20/20
            }
        });
    }

    document.addEventListener('DOMContentLoaded', updateHeroBackgrounds);
    window.addEventListener('resize', updateHeroBackgrounds);


</script>

<style>
    .responsive-bg-home {
        width: 100vw;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        transition: background-image 0.3s ease, aspect-ratio 0.3s ease;

        position: relative;
        margin-left: 15vw;

    }


.hero-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
    align-items: center;
    width: 100%;
    flex-wrap: nowrap;
}

    .hero-section {
        position: relative;
        margin-left: 15vw;
        top: -80px;
        align-self: flex-start;
    }





    .hero-section .hero-title p {
        font-size: 62px;
        font-family: "Bodoni 11", serif !important;
        font-weight: 400 !important;
        line-height: 1.2;
        margin-bottom: 20px;
    }

    .hero-section .hero-content {
        font-family: "iA Writer Duo", sans-serif;
        font-weight: 300 !important;
        text-align: justify;
        max-width: 550px;
        font-size: 17px;
    }

    .hero-section p {
        margin: 0px;
    }

    .hero-section .hero-content p {
        line-height: 27px;
    }


    .hero-button-box {
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        align-content: space-between;
        justify-content: space-evenly;
        align-items: center;
        gap: 10px
    }

    .hero-button {
        font-family: "iA Writer Duo", sans-serif;

        text-align: center;
        width: 300px;
        border: 1px solid #CDB78D;
        border-radius: 50px;
        font-size: 17px;
        padding: 10px 20px 10px 20px;
        cursor: pointer;
        margin: 30px 0;

    }

    .hero-button:first-child {

        background-color: #CDB78D;

    }

    .hero-button a {
        color: #CDB78D !important;
    }

    a.hero-button {
        color: black;
        transition: all 0.3s ease;
    }

    .hero-button:hover {
        opacity: 0.8;

    }


    @media (max-width: 1200px) {

        .hero-section {
            top: -70px
        }

        .hero-section .hero-title p {
            font-size: 42px !important;

        }

        .hero-section .hero-content p {
            font-size: 15px;
        }



    }


    @media (max-width: 966px) {

        .responsive-bg-home {

            margin-left: 0vw;

        }
        .home-hero {
            align-items: flex-end;
        }

        .hero-section {
            top: 0px;
            margin-left: 0vw;
            padding: 0 25px;
        }
        .hero-section .hero-content {
            max-width: 100%;

        }
        .hero-section .hero-title p {
            font-size: 27px !important;
            font-family: "Bodoni 11", serif !important;
            font-weight: 400 !important;
            text-align: left;
            margin-bottom: 20px;
        }

        .hero-section .hero-content p {
            font-size: 14px;
            margin-bottom: 30px;
        }

        .hero-button-box {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            align-content: space-between;
            justify-content: space-evenly;
            align-items: center;
            gap: 0px
        }

        .hero-button {
            margin: 5px 0;
            width: 100%;
        }
    }
</style>