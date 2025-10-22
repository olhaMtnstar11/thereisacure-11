<?php get_header();
/**
 * Template name: Research Team
 */
?>


<section id="general-tpl" class="plain-text general-section">

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
        <?php if (get_field('description')): ?>
            <h4 class="mb-6 sub-title font-ia-writer-duo"><?php echo do_shortcode(get_field('description')); ?></h4>
        <?php endif; ?>
    </div>


    <?php if (have_rows('researchers')): ?>
        <div class="general-tpl-section">
            <?php while (have_rows('researchers')): the_row();
                $title = get_sub_field('title');
                $sub_title = get_sub_field('sub_title');
                $image = get_sub_field('image');
                $description = get_sub_field('description');
                $url = get_sub_field('url_on_a_profile');
                ?>
                <div class="researcher-item">
                    <?php if ($image): ?>
                        <div class="researcher-image">
                            <div>
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                                <span class="corner tl"></span>
                                <span class="corner tr"></span>
                                <span class="corner bl"></span>
                                <span class="corner br"></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="researcher-info">
                        <?php if ($title): ?>
                            <h3 class="researcher-name">
                                <?php if ($url): ?>
                                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
                                        <?php echo esc_html($title); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo esc_html($title); ?>
                                <?php endif; ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ($sub_title): ?>
                            <p class="researcher-role"><?php echo esc_html($sub_title); ?></p>
                        <?php endif; ?>

                        <?php if ($description): ?>
                            <div class="researcher-description">
                                <?php echo wp_kses_post($description); ?>
                            </div>
                        <?php endif; ?>
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
    .researchers-list {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
        margin-top: 3rem;
    }

    .researcher-item {
        height: 250px;
        display: flex;
        align-items: flex-start;
        gap: 2rem;
        flex-wrap: wrap;
    }

    /* square image container */
    .researcher-image {
        width: 220px;
        height: 220px;
        flex-shrink: 0;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        border: 2px dashed #0867E8;     /* match PLAN page style */
        border-radius: 0;
        position: relative;             /* important for corner spans */
        box-sizing: border-box;
    }

    /* wrapper inside */
    .researcher-image > div {
        position: relative;
        width: 100%;
        height: 100%;
    }

    /* image inside box */
    .researcher-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* corner squares */
    .researcher-image .corner {
        position: absolute;
        width: 8px;
        height: 8px;
        background: #0867E8;
        z-index: 2;
    }

    /* slight -2px offsets to align perfectly on border */
    .researcher-image .corner.tl { top: -4px; left: -4px; }
    .researcher-image .corner.tr { top: -4px; right: -4px; }
    .researcher-image .corner.bl { bottom: -4px; left: -4px; }
    .researcher-image .corner.br { bottom: -4px; right: -4px; }

    .researcher-info {
        flex: 1;
    }

    .researcher-name {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    /* Researcher name link */
    .researcher-name a {
        text-decoration: underline; /* always underlined */
        color: inherit;             /* keep default text color when not hovered */
        transition: color 0.3s;     /* smooth color change on hover */
    }

    /* Hover effect */
    .researcher-name a:hover {
        color: #0867E8;             /* blue on hover */
    }
    .researcher-role {
        font-style: italic;
        color: #666;
        margin-bottom: 0.75rem;
    }

    .researcher-description {
        font-size: 1rem;
        line-height: 1.6;
    }




    @media (max-width: 768px) {
        .researcher-item {
            flex-direction: column;  /* stack vertically */
            align-items: start;     /* center items horizontally */
            text-align: left;      /* center text under image */
            gap: 1.5rem;             /* smaller gap on mobile */
        }

        .researcher-info {
            flex: unset;             /* remove flex behavior */
            width: 100%;             /* full width under image */
        }

        .researcher-name {
            font-size: 1.2rem;       /* slightly smaller on mobile */
        }

        .researcher-role {
            font-size: 1rem;
        }

        .researcher-description {
            font-size: 0.95rem;
        }

        .researcher-image {
         width: 320px;
         height: 320px;
        }
    }




</style>
