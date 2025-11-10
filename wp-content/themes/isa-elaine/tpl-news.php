<?php get_header();
/**
 * Template name: News page
 */
?>

    <!-- back button -->
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



<?php
$section_title = get_sub_field('title');
$section_content = get_sub_field('content');
$posts_per_page = get_sub_field('posts_per_page') ?: 3;
$news_category = get_sub_field('news_category'); // taxonomy term object
?>


    <div>
        <div class="container">
            <?php if ($section_title): ?>
                <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>

            <?php if ($section_content): ?>
                <div class="section-intro">
                    <?php echo wp_kses_post($section_content); ?>
                </div>
            <?php endif; ?>

            <?php
            // Build query arguments
            $args = [
                'post_type' => 'news',
                'posts_per_page' => $posts_per_page,
                'orderby' => 'date',
                'order' => 'DESC',
            ];

            $news_categories = get_sub_field('news_category'); // array of term objects

            if ($news_categories) {
                $args['tax_query'] = [
                    [
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => wp_list_pluck($news_categories, 'term_id'), // get array of IDs
                    ]
                ];
            }

            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) : ?>
                <div class="news-list">
                    <?php while ($news_query->have_posts()): $news_query->the_post(); ?>
                        <article class="news-item">

                            <div class="news-box">
                                <div class="news-picture">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="news-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="news-content">

                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="news-excerpt">
                                        <?php the_excerpt(); ?>
                                        <a class="read-more-btn" href="<?php the_permalink(); ?>">Read More</a>
                                    </div>

                                </div>
                            </div>


                            <!-- Thin Line Div -->
                            <div class="line-container">
                                <div class="section-line-with-squares">
                                    <div class="square left"></div>
                                    <div class="section-line"></div>
                                    <div class="square right"></div>
                                </div>
                            </div>


                        </article>

                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>No news found.</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>

    </section>



    <!-- contact us form -->
<?php if (get_field('contact_us_section')): ?>
    <section class="two-columns" id="contact-us">
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