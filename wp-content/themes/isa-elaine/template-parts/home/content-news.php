


<?php
$array = get_field('news_section');
// check if the repeater field has rows of data
if (is_array($array) && array_filter($array)):
// loop through the rows of data
    while (have_rows('news_section')) : the_row(); ?>


        <section id="news_home" class="plain-text scroll-section">


            <?php
            $section_title = get_sub_field('title');
            $section_content = get_sub_field('content_text');
            $selected_posts = get_sub_field('posts_to_show'); // Relationship field
            ?>

            <div class="events-section">
                <div class="container">

                    <?php if ($section_title): ?>
                        <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
                    <?php endif; ?>

                    <?php if ($section_content): ?>
                        <div class="section-intro">
                            <?php echo wp_kses_post($section_content); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($selected_posts): ?>
                        <div class="events-carousel-wrapper">
                            <button class="carousel-btn prev">&#10094;</button>
                            <div class="events-carousel">
                                <div class="events-track">
                                    <?php foreach ($selected_posts as $post): setup_postdata($post); ?>
                                        <div class="event-slide">
                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="event-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('medium'); ?>
                                                    </a>
                                                </div>

                                            <?php else: ?>
                                                <div class="event-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <div style="height: 183px; width: 275px"></div>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <div class="event-content">
                                                <h3 class="event-title"><a
                                                            href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>

                                                <a class="read-more-btn" href="<?php the_permalink(); ?>">Learn
                                                    More</a>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                    wp_reset_postdata(); ?>
                                </div>
                            </div>
                            <button class="carousel-btn next">&#10095;</button>
                        </div>
                    <?php else: ?>
                        <p>No posts selected.</p>
                    <?php endif; ?>

                </div>
            </div>

<div>
    <a href="/news/" class="read-more-button">Go To News →</a>
</div>


        </section>

        <!-- /.home-about -->
    <?php endwhile;endif; ?>

<!-- Thin Line Div -->
<div class="line-container">
    <div class="section-line-with-squares">
        <div class="square left"></div>
        <div class="section-line"></div>
        <div class="square right"></div>
    </div>
</div>

<style>
    .events-section {
        width: 100%;
    }
</style>
