<?php get_header();
/**
 * Template name: Family Story template
 */
?>
<?php

//get_template_part('template-parts/general/content', 'default-hero');
function transformString($input)
{
    // Приведение строки к нижнему регистру
    $lowercase = strtolower($input);

    // Удаление всех знаков препинания с использованием регулярного выражения
    $cleaned = preg_replace('/[^\w\s]/u', '', $lowercase);

    // Замена пробелов на символ подчеркивания
    $result = str_replace(' ', '_', $cleaned);

    return $result;
}

?>

<!-- back button -->
<section id="family-story-tpl" class="plain-text general-section">
    <div class="general-tpl-section back-link">
        <?php
        $back_url = wp_get_referer();

        if (!$back_url) {
            // fallback: go to first category
            $terms = get_the_terms(get_the_ID(), 'news_category');
            if ($terms && !is_wp_error($terms)) {
                $back_url = get_term_link($terms[0]);
            } else {
                // fallback: main archive
                $back_url = get_post_type_archive_link('news'); // replace 'news' with your CPT key
            }
        }
        ?>

        <a href="<?php echo esc_url($back_url); ?>">
            ← back
        </a>

        <!--  breadcrumbs    -->
        <!--    <?php my_custom_breadcrumbs(); ?>  -->
    </div>


    <div class="general-tpl-section">
        <?php if (get_field('title')): ?>
            <h2 class="mb-4"><?php echo esc_html(get_field('title')); ?></h2>
        <?php endif; ?>
    </div>
    <!-- Sub title -->
    <div class="general-tpl-section">
        <?php if (get_field('sub_title')): ?>
            <h4 class="mb-6 sub-title font-ia-writer-duo"><?php echo esc_html(get_field('sub_title')); ?></h4>
        <?php endif; ?>
    </div>


    <?php if (get_field('content')): ?>

        <div class="grid-container general-tpl-section-content">
            <div class="left-column">
            </div>


            <div class="middle-column middle-one-column">
                <?php echo wp_kses_post(get_field('content')); ?>
            </div>


            <div class="right-column">
            </div>

        </div>
    <?php endif; ?>




    <?php if (have_rows('story')): ?>
        <div class=" general-tpl-section story-repeater">
            <?php while (have_rows('story')): the_row(); ?>
                <?php
                $name = get_sub_field('name');
                $description = get_sub_field('description'); // optional if you still need it
                $image = get_sub_field('image');      // returns URL


                $originalString = get_sub_field('name');
                $transformedString = transformString($originalString);



                ?>

                <?php if ($image): ?>
                    <div class="story-repeater-item">
                        <a data-fancybox-close-button="false" data-fancybox
                           data-src="#hidden-bio-<?php echo $transformedString; ?>"
                           href="javascript:;">
                            <div class="story-repeater-image">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name); ?>"/>
                                <?php if ($name): ?>
                                    <div class="overlay">
                                        <span><?php echo esc_html($name); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>


                <div style="width: 100%;" class="hidden-content" id="hidden-bio-<?php echo $transformedString; ?>">
                    <!-- Sticky Close Button -->
                    <button type="button"
                            class="fancybox-custom-close fancybox-button fancybox-close-small"
                            data-fancybox-close onclick="$.fancybox.close();">
                        <svg xmlns='http://www.w3.org/2000/svg'
                             width='20'
                             height='20'
                             viewBox='0 0 24 24'>
                            <path d='M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z'
                                  fill='rgba(240,245,250,.6)'/>
                        </svg>
                    </button>
                    <!-- content -->
                    <div class="fancybox-content-padding">
                        <?php echo $description; ?>
                    </div>

                </div>


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


<!-- contact us form -->
<?php if (get_field('contact_us_section')): ?>
    <section class="two-columns">
        <div class="heading">
            <div class="container">
                <?php echo do_shortcode(get_field('contact_us_section')); ?>
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
<?php endif; ?>


<?php
get_footer();
?>


<style>


</style>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const responsiveImgs = document.querySelectorAll(".hero-content-img");

        function updateImages() {
            const isDesktop = window.innerWidth >= 967;

            responsiveImgs.forEach(img => {
                const src = isDesktop ? img.dataset.desktop : img.dataset.mobile;
                if (src) img.src = src;
            });
        }

        updateImages(); // Initial load
        window.addEventListener("resize", updateImages); // Update on resize
    });


    //accordion
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.acc-trigger');
        if (!btn) return;

        const panelId = btn.getAttribute('aria-controls');
        const panel = document.getElementById(panelId);
        const isOpen = btn.getAttribute('aria-expanded') === 'true';

        // close
        if (isOpen) {
            btn.setAttribute('aria-expanded', 'false');
            panel.setAttribute('hidden', '');
        }
        // open
        else {
            btn.setAttribute('aria-expanded', 'true');
            panel.removeAttribute('hidden');
        }
    });


    //detect the current section in view
    document.addEventListener('DOMContentLoaded', function () {
        const sections = document.querySelectorAll('.anchor-section');
        const menuLinks = document.querySelectorAll('.for-families li a');

        function activateMenu() {
            let scrollPos = window.scrollY || window.pageYOffset;

            sections.forEach(section => {
                const top = section.offsetTop - 120; // offset for header
                const bottom = top + section.offsetHeight;
                const id = section.getAttribute('id');

                if (scrollPos >= top && scrollPos < bottom) {
                    menuLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.hash === '#' + id) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }

        // Highlight on scroll
        window.addEventListener('scroll', activateMenu);

        // Highlight on load (deep links)
        activateMenu();

        // Smooth scroll + highlight on click
        menuLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                const targetId = this.hash.slice(1);
                const target = document.getElementById(targetId);

                if (target) {
                    e.preventDefault();
                    window.scrollTo({
                        top: target.offsetTop - 100, // adjust offset
                        behavior: 'smooth'
                    });
                }
            });
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if(target){
                const offset = 100; // pixels from top
                const bodyRect = document.body.getBoundingClientRect().top;
                const elementRect = target.getBoundingClientRect().top;
                const elementPosition = elementRect - bodyRect;
                const offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });
</script>


<style>

    .story-content img {
        width: 100%;      /* fills container width */
        max-width: 400px; /* or any fixed width you want */
        height: auto;     /* keeps aspect ratio */
        display: block;   /* avoids inline spacing issues */
        margin: 0 auto;   /* center the image */
        object-fit: cover; /* crops if needed for container size */
    }

    .video-wrapper {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        padding-top: 25px;
        height: 0;
        overflow: hidden;
        max-width: 100%;
    }

    .video-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }



    .story-repeater {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .story-repeater-item {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }

    .story-repeater-image {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3; /* keeps all images same proportion (change ratio as you need) */
        overflow: hidden;
        border-radius: 8px;
    }

    .story-repeater-image img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* crops nicely instead of stretching */
        transition: transform 0.4s ease;
    }

    .story-repeater-item:hover img {
        transform: scale(1.05);
    }

    .story-repeater-image .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .story-repeater-item:hover .overlay {
        opacity: 1;
    }

    .story-repeater-image .overlay span {
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .story-repeater {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .story-repeater {
            grid-template-columns: 1fr;
        }
    }

</style>