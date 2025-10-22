<?php get_header();
/**
 * Template name: general template
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

    <?php if (have_rows('Sections')): ?>
        <?php while (have_rows('Sections')): the_row(); ?>
            <!-- 1-hero section -->
            <?php if (get_row_layout() == 'hero_section'): ?>
                <!-- Main title -->
                <div class="general-tpl-section">
                    <?php if (get_sub_field('title')): ?>
                        <h2 class="mb-4"><?php echo esc_html(get_sub_field('title')); ?></h2>
                    <?php endif; ?>
                </div>
                <!-- Sub title -->
                <div class="general-tpl-section">
                    <?php if (get_sub_field('sub_title')): ?>
                        <h4 class="mb-6 sub-title font-ia-writer-duo"><?php echo esc_html(get_sub_field('sub_title')); ?></h4>
                    <?php endif; ?>
                </div>
                <!-- responsive hero image -->
                <?php if (get_sub_field('image_mobile') || get_sub_field('image_desktop')): ?>
                    <div class="general-tpl-section">
                        <img class="hero-content-img"
                             src=""
                             data-mobile="<?php echo get_sub_field('image_mobile'); ?>"
                             data-desktop="<?php echo get_sub_field('image_desktop'); ?>"
                             alt="image">
                    </div>
                <?php endif; ?>




                <!-- 2 column grid section -->
            <?php elseif (get_row_layout() == 'faq'): ?>
                <?php if (get_row_layout() == 'faq'): ?>
                    <div class="general-tpl-section">
                    <?php if ($title = get_sub_field('title')): ?>
                        <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                        <?php if (have_rows('faq_items')): ?>
                            <div class="faq-wrapper">
                                <?php while (have_rows('faq_items')): the_row(); ?>
                                    <?php
                                    $question = get_sub_field('question');
                                    $answer   = get_sub_field('answer');
                                    ?>
                                    <div class="faq-item">
                                        <?php if ($question): ?>
                                            <h3 class="faq-question"><?php echo esc_html($question); ?></h3>
                                        <?php endif; ?>

                                        <?php if ($answer): ?>
                                            <div class="faq-answer">
                                                <?php echo wp_kses_post($answer); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>


                                    <!-- Thin Line Div -->
                                    <div class="line-container">
                                        <div class="section-line-with-squares">
                                            <div class="square left"></div>
                                            <div class="section-line"></div>
                                            <div class="square right"></div>
                                        </div>
                                    </div>



                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>









                </div>
                <?php endif; ?>









                <!-- 2 column grid section -->
            <?php elseif (get_row_layout() == '3_column_grid'): ?>
                <?php if (get_row_layout() == '3_column_grid'): ?>
                    <!-- 3 column grid -->


                    <div class="general-tpl-section">
                        <?php if (get_sub_field('title_main_column')): ?>
                            <h3 class="mb-4"><?php echo esc_html(get_sub_field('title_main_column')); ?></h3>
                        <?php endif; ?>
                    </div>


                    <div class="grid-container general-tpl-section-content">
                        <div class="left-column">
                            <?php if (get_sub_field('content_1')): ?>
                                <?php echo wp_kses_post(get_sub_field('content_1')); ?>
                            <?php endif; ?>
                        </div>


                        <?php if (get_sub_field('content_2') && get_sub_field("2_column_count")): ?>
                            <div class="middle-column">


                                <?php echo wp_kses_post(get_sub_field('content_2')); ?>
                                <div>
                                    <?php
                                    $icon = get_sub_field('icon_image');
                                    $pdf_label = get_sub_field('label_file');
                                    $pdf_link = get_sub_field('file'); // file field
                                    ?>
                                    <?php if ($icon || $pdf_link): ?>
                                        <div class="download-block">
                                            <!-- LEFT COLUMN -->
                                            <div class="download-block-left font-ia-writer-duo">
                                                <?php if ($pdf_link): ?>
                                                    <?php if ($icon): ?>
                                                        <a href="<?php echo esc_url($pdf_link['url']); ?>"
                                                           target="_blank">
                                                            <img src="<?php echo esc_url($icon); ?>" alt="">
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <a href="<?php echo esc_url($pdf_link['url']); ?>" target="_blank"
                                                   class="">
                                                    <p class="download-block-title"><?php echo esc_html($pdf_label); ?>
                                                        ↗ </p>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php elseif (get_sub_field('content_2_1') && !get_sub_field("2_column_count")): ?>
                            <div class="middle-column middle-one-column">
                                <?php echo wp_kses_post(get_sub_field('content_2_1')); ?>
                                <div>
                                    <?php
                                    $icon = get_sub_field('icon_image');
                                    $pdf_label = get_sub_field('label_file');
                                    $pdf_link = get_sub_field('file'); // file field
                                    ?>
                                    <?php if ($icon || $pdf_link): ?>
                                        <div class="download-block">
                                            <!-- LEFT COLUMN -->
                                            <div class="download-block-left font-ia-writer-duo">
                                                <?php if ($pdf_link): ?>
                                                    <?php if ($icon): ?>
                                                        <a href="<?php echo esc_url($pdf_link['url']); ?>"
                                                           target="_blank">
                                                            <img src="<?php echo esc_url($icon); ?>" alt="">
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <a href="<?php echo esc_url($pdf_link['url']); ?>" target="_blank"
                                                   class="">
                                                    <p class="download-block-title"><?php echo esc_html($pdf_label); ?>
                                                        ↗ </p>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php if (get_sub_field('content_3')): ?>
                            <div class="right-column">
                                <?php echo wp_kses_post(get_sub_field('content_3')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>


            <?php elseif (get_row_layout() == 'news_section'): ?>
                <?php if (get_row_layout() == 'news_section'): ?>
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

                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="news-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('medium'); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="news-excerpt">
                                                <?php the_excerpt(); ?>
                                                <a class="read-more-btn" href="<?php the_permalink(); ?>">Read More</a>
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


                <?php endif; ?>


                <!-- anchor_link -->
            <?php elseif (get_row_layout() == 'anchor_link'): ?>
                <?php if (get_row_layout() == 'anchor_link'): ?>
                    <?php
                    // Get the ID for the anchor from ACF subfield
                    $anchor_id = get_sub_field('anchor_id'); // e.g., "daily-life-coping"
                    ?>

                    <?php if ($anchor_id): ?>
                        <div id="<?php echo esc_attr($anchor_id); ?>" style="scroll-margin-top: 120px;" class="anchor-section">
                    <?php endif; ?>

                <?php endif; ?>

                <!-- anchor_link close -->
            <?php elseif (get_row_layout() == 'anchor_close'): ?>
                <?php if (get_row_layout() == 'anchor_close'): ?>


                    </div>


                <?php endif; ?>


            <?php elseif (get_row_layout() == 'box_with_border'): ?>
                <?php if (get_row_layout() == 'box_with_border'): ?>

                    <div class="box-with-border-section">
                        <?php
                        $is_italic = get_sub_field('italic'); // true/false
                        $italic_class = $is_italic ? 'box-with-border-italic' : '';
                        ?>
                        <div class="box-with-border <?php echo esc_attr($italic_class); ?>">
                            <?php if (get_sub_field('content')): ?>
                                <?php echo wp_kses_post(get_sub_field('content')); ?>
                            <?php endif; ?>
                            <span></span> <!-- invisible, used for bottom corners -->
                        </div>
                    </div>


                <?php endif; ?>




            <?php elseif (get_row_layout() == 'events'): ?>
                <?php if (get_row_layout() == 'events'):
                    ?>
                    <?php
                    $section_title = get_sub_field('title');
                    $section_content = get_sub_field('content_text');
                    $posts_per_page = get_sub_field('posts_per_page') ?: 5; // default to 5
                    $event_category = get_sub_field('event_category'); // taxonomy term object
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

                            <?php
                            // Build query arguments
                            $args = [
                                'post_type' => 'event',
                                'posts_per_page' => $posts_per_page,
                                'orderby' => 'event_date', // custom field for event date
                                'order' => 'ASC',
                            ];

                            $event_categories = get_sub_field('event_category'); // array of term objects

                            if ($event_categories) {
                                $args['tax_query'] = [
                                    [
                                        'taxonomy' => 'event_category', // your event CPT taxonomy
                                        'field' => 'term_id',
                                        'terms' => wp_list_pluck($event_categories, 'term_id'),
                                    ]
                                ];
                            }

                            $events_query = new WP_Query($args);

                            if ($events_query->have_posts()) : ?>
                                <div class="events-carousel-wrapper">
                                    <button class="carousel-btn prev">&#10094;</button>
                                    <div class="events-carousel">
                                        <div class="events-track">
                                            <?php while ($events_query->have_posts()): $events_query->the_post(); ?>
                                                <div class="event-slide">
                                                    <?php if (has_post_thumbnail()): ?>
                                                        <div class="event-thumb">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_post_thumbnail('medium'); ?>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="event-content">
                                                        <h3 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                        <?php if ($date = get_field('event_date')): ?>
                                                            <div class="event-date"><?php echo date_i18n('F j, Y', strtotime($date)); ?></div>
                                                        <?php endif; ?>
                                                        <?php if ($location = get_field('event_location')): ?>
                                                            <div class="event-location"><?php echo esc_html($location); ?></div>
                                                        <?php endif; ?>
                                                        <p class="event-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                                        <a class="read-more-btn" href="<?php the_permalink(); ?>">Learn More</a>
                                                    </div>
                                                </div>
                                            <?php endwhile; wp_reset_postdata(); ?>
                                        </div>
                                    </div>
                                    <button class="carousel-btn next">&#10095;</button>
                                </div>
                            <?php else: ?>
                                <p>No events found.</p>
                            <?php endif; wp_reset_postdata(); ?>
                        </div>
                    </div>


                <?php endif; ?>






                    <!-- line -->
            <?php elseif (get_row_layout() == 'line'): ?>
                <?php if (get_row_layout() == 'line'): ?>
                    <!-- Thin Line Div -->
                    <div class="line-container" style="margin: 100px 0;">
                        <div class="section-line-with-squares">
                            <div class="square left"></div>
                            <div class="section-line"></div>
                            <div class="square right"></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- 3-some different content -->
            <?php elseif (get_row_layout() == '1_column'): ?>
                <?php if (get_row_layout() == '1_column'): ?>
                    <!-- some different content -->
                    <div class="general-tpl-section general-block">
                        <?php if (get_sub_field('content_4')): ?>
                            <?php echo wp_kses_post(get_sub_field('content_4')); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>


                <!--4-partner -->
            <?php elseif (get_row_layout() == 'partner'): ?>
                <?php if (get_row_layout() == 'partner'): ?>
                    <div class="partner-logos">
                        <?php if (get_sub_field('partner_item')): ?>
                            <?php while (have_rows('partner_item')): the_row();
                                $logo = get_sub_field('logo');
                                if (!empty($logo)) :
                                    ?>
                                    <a target="_blank" href="<?php echo esc_url(get_sub_field('link')); ?>"
                                       class="partner-logo">
                                        <img src="<?php echo esc_url($logo); ?>" alt=" ">
                                    </a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- 5-accordion -->
            <?php elseif (get_row_layout() == 'accordion'): ?>
                <?php if (get_row_layout() == 'accordion'):
                    $title = get_sub_field('title');
                    $content = get_sub_field('content');
                    $id = uniqid('acc-'); // unique id for aria-controls
                    ?>
                    <div class="general-tpl-section">
                        <h2 class="sub-title font-ia-writer-duo accordion-title">
                            <button class="acc-trigger"
                                    aria-controls="<?php echo esc_attr($id); ?>"
                                    aria-expanded="false">
                                <?php echo esc_html($title); ?>
                                <span class="acc-icon" aria-hidden="true"></span>
                            </button>
                        </h2>
                    </div>
                    <div class="grid-container general-tpl-section-content grid-accordion">
                        <div class="left-column">
                        </div>
                        <div class="middle-column accordion-content ">
                            <div id="<?php echo esc_attr($id); ?>"
                                 class="acc-panel"
                                 role="region"
                                 hidden>
                                <?php echo wp_kses_post($content); ?>
                            </div>
                        </div>
                        <div class="right-column">
                        </div>
                    </div>


                <?php endif; ?>
                <!-- 6-documents section -->
            <?php elseif (get_row_layout() == 'download_document'): ?>
                <?php if (get_row_layout() == 'download_document'): ?>
                    <!-- column grid -->

                    <div class="documents-section">

                        <div class="documents-column">
                            <?php
                            while (have_posts()) : the_post(); ?>
                                <?php
                                $documents = get_sub_field('attached_documents'); // relationship field
                                if ($documents):
                                    foreach ($documents as $doc):
                                        $file = get_field('file', $doc->ID); // file field from 'document' CPT
                                        $icon = get_field('icon', $doc->ID); // optional icon/image field
                                        $pdf_label = get_the_title($doc->ID); // use the document title
                                        ?>
                                        <?php if ($icon || $file): ?>
                                        <div class="download-block">
                                            <!-- LEFT COLUMN -->
                                            <div class="download-block-left font-ia-writer-duo">
                                                <?php if ($file): ?>
                                                    <?php if ($icon): ?>
                                                        <a href="<?php echo esc_url($file['url']); ?>" target="_blank">
                                                            <img src="<?php echo esc_url($icon); ?>" alt="">
                                                        </a>
                                                    <?php endif; ?>
                                                    <a href="<?php echo esc_url($file['url']); ?>" target="_blank"
                                                       class="">
                                                        <p class="download-block-title">
                                                            <?php echo esc_html($pdf_label); ?> ↗
                                                        </p>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    endforeach;
                                else:
                                    echo '<p>No documents attached.</p>';
                                endif;
                                ?>
                            <?php endwhile; ?>
                        </div>


                    </div>

                <?php endif; ?>
                    <!-- 6-documents section -->
                <?php elseif (get_row_layout() == 'data-list-col'): ?>
                    <?php if (get_row_layout() == 'data-list-col'): ?>
                    <div class="general-tpl-section">
                        <?php if (get_sub_field('title')): ?>
                            <h3 class="mb-4"><?php echo esc_html(get_sub_field('title')); ?></h3>
                        <?php endif; ?>
                    </div>
                    <div class="general-tpl-section">
                        <?php if (get_sub_field('content')): ?>
                             <?php echo wp_kses_post(get_sub_field('content')); ?>
                        <?php endif; ?>
                    </div>
                    <section class="data-list general-tpl-section " >
                        <div class="data-list-wrapper">
                            <div class="data-list-header">
                                <div class="data-list-col data-list-col--title"><?php the_sub_field('label_1'); ?></div>
                                <div class="data-list-col data-list-col--title"><?php the_sub_field('label_2'); ?></div>
                            </div>

                            <?php if (have_rows('care_team_list')): ?>
                                <?php while (have_rows('care_team_list')): the_row(); ?>
                                    <div class="data-list-row">
                                        <div class="data-list-col data-list-col--left"><?php the_sub_field('label_1'); ?></div>
                                        <div class="data-list-col data-list-col--right"><?php the_sub_field('label_2'); ?></div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                    <div class="general-tpl-section">
                        <?php if (get_sub_field('content_2')): ?>
                            <?php echo wp_kses_post(get_sub_field('content_2')); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>


                <!--5- documents section -->
            <?php elseif (get_row_layout() == '2_image5050'): ?>
                <?php if (get_row_layout() == '2_image5050'): ?>
                    <!-- 3 column grid -->
                    <div class="grid-container general-tpl-section-content">
                        <div class="left-column">

                        </div>

                        <div class="middle-column middle-one-column">
                            <div class="two-image-row">
                                <div>
                                    <?php if (get_sub_field('isa_image_1')): ?>
                                        <img src="<?php echo esc_url(get_sub_field('isa_image_1')); ?>" alt="">
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <?php if (get_sub_field('isa_image_2')): ?>
                                        <img src="<?php echo esc_url(get_sub_field('isa_image_2')); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <div class="right-column">

                        </div>

                    </div>
                <?php endif; ?>


                <!--7-icons-statistic-->
            <?php elseif (get_row_layout() == 'icons-statistic'): ?>
                <?php if (get_row_layout() == 'icons-statistic'): ?>


                    <div class="icons-statistic-box">


                        <div class="">
                            <?php if (get_sub_field('title')): ?>
                                <h3 class="mb-4"><?php echo esc_html(get_sub_field('title')); ?></h3>
                            <?php endif; ?>
                        </div>

                        <div class="icons-statistic-items">

                            <?php if (get_sub_field('item')): ?>
                                <?php while (have_rows('item')): the_row();
                                    $icon = get_sub_field('icon');
                                    $label = get_sub_field('label');
                                    $description = get_sub_field('description');


                                    if (!empty($icon)) :
                                        ?>


                                        <div class="icons-statistic-item">
                                            <div class="icons-statistic-img">
                                                <img src="<?php echo esc_url($icon); ?>" alt=" ">
                                            </div>


                                            <div class="m-3">
                                                <?php echo esc_html($label); ?>
                                            </div>
                                            <div class="m-3">
                                                <?php echo esc_html($description); ?>
                                            </div>

                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>


                        </div>


                    </div>


                <?php endif; ?>


            <?php endif; ?>
        <?php endwhile; ?>
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

    document.addEventListener("DOMContentLoaded", function () {
        const menus = document.querySelectorAll(".types-nbia-sub-menu, .left-menu");
        const footer = document.querySelector("footer");
        const contact = document.querySelector("#contact-us");

        if (!menus.length || (!footer && !contact)) return;

        function toggleMenuVisibility() {
            const windowHeight = window.innerHeight;
            const footerRect = footer ? footer.getBoundingClientRect() : null;
            const contactRect = contact ? contact.getBoundingClientRect() : null;

            const footerVisible = footerRect && footerRect.top < windowHeight;
            const contactVisible = contactRect && contactRect.top < windowHeight;

            menus.forEach(menu => {
                if (footerVisible || contactVisible) {
                    menu.style.display = "none";
                } else {
                    menu.style.display = "block";
                }
            });
        }

        window.addEventListener("scroll", toggleMenuVisibility);
        window.addEventListener("resize", toggleMenuVisibility);
        toggleMenuVisibility(); // run once on load
    });





    document.addEventListener("DOMContentLoaded", function () {
        const questions = document.querySelectorAll(".faq-question");

        questions.forEach((question) => {
            question.addEventListener("click", () => {
                const answer = question.nextElementSibling;
                answer.classList.toggle("active");
            });
        });
    });



</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.querySelector('.events-carousel-wrapper');
        if (!wrapper) return;
        const track = wrapper.querySelector('.events-track');
        const slides = wrapper.querySelectorAll('.event-slide');
        const prevBtn = wrapper.querySelector('.carousel-btn.prev');
        const nextBtn = wrapper.querySelector('.carousel-btn.next');

        let currentIndex = 0;
        let visibleSlides = 3;
        let isDragging = false;
        let startX = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;
        let animationID;
        let maxTranslate = 0;

        function updateVisibleSlides() {
            const width = window.innerWidth;
            if (width <= 600) visibleSlides = 1;
            else if (width <= 992) visibleSlides = 2;
            else visibleSlides = 3;
        }

        function markSingleState() {
            // if only one slide total -> add .single to track
            if (slides.length === 1) {
                track.classList.add('single');
            } else {
                track.classList.remove('single');
            }
        }

        function updateCarousel() {
            if (!slides.length) return;
            const slideWidth = slides[0].offsetWidth + parseInt(getComputedStyle(track).gap || 20);
            maxTranslate = -(slides.length - visibleSlides) * slideWidth;

            // Keep index within bounds
            if (currentIndex < 0) currentIndex = 0;
            if (currentIndex > slides.length - visibleSlides) currentIndex = Math.max(0, slides.length - visibleSlides);

            prevTranslate = -currentIndex * slideWidth;
            track.style.transform = `translateX(${prevTranslate}px)`;

            // Show/hide buttons and dragging based on number of slides vs visibleSlides
            if (slides.length <= visibleSlides) {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
                track.style.cursor = 'default';
                disableDragging();
            } else {
                prevBtn.style.display = currentIndex === 0 ? 'none' : 'block';
                nextBtn.style.display = currentIndex >= slides.length - visibleSlides ? 'none' : 'block';
                track.style.cursor = 'grab';
                enableDragging();
            }
        }

        // Navigation buttons
        nextBtn.addEventListener('click', () => {
            if (currentIndex < slides.length - visibleSlides) {
                currentIndex++;
                updateCarousel();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

        // Drag / swipe handlers (same as your fixed version)
        function dragStart(e) {
            if (slides.length <= visibleSlides) return;
            isDragging = true;
            startX = e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
            track.style.transition = 'none';
            animationID = requestAnimationFrame(animation);
        }

        function dragAction(e) {
            if (!isDragging) return;
            const currentX = e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
            const delta = currentX - startX;
            currentTranslate = prevTranslate + delta;
            // clamp
            if (currentTranslate > 0) currentTranslate = 0;
            if (currentTranslate < maxTranslate) currentTranslate = maxTranslate;
        }

        function dragEnd() {
            if (!isDragging) return;
            cancelAnimationFrame(animationID);
            isDragging = false;
            track.style.transition = 'transform 0.4s ease';
            const slideWidth = slides[0].offsetWidth + parseInt(getComputedStyle(track).gap || 20);
            const movedSlides = Math.round(-currentTranslate / slideWidth);
            currentIndex = Math.min(Math.max(0, movedSlides), Math.max(0, slides.length - visibleSlides));
            prevTranslate = -currentIndex * slideWidth;
            track.style.transform = `translateX(${prevTranslate}px)`;
            updateCarousel();
        }

        function animation() {
            track.style.transform = `translateX(${currentTranslate}px)`;
            if (isDragging) requestAnimationFrame(animation);
        }

        function enableDragging() {
            track.addEventListener('mousedown', dragStart);
            track.addEventListener('touchstart', dragStart, {passive: true});
            track.addEventListener('mouseup', dragEnd);
            track.addEventListener('mouseleave', dragEnd);
            track.addEventListener('touchend', dragEnd);
            track.addEventListener('mousemove', dragAction);
            track.addEventListener('touchmove', dragAction);
        }

        function disableDragging() {
            track.removeEventListener('mousedown', dragStart);
            track.removeEventListener('touchstart', dragStart);
            track.removeEventListener('mouseup', dragEnd);
            track.removeEventListener('mouseleave', dragEnd);
            track.removeEventListener('touchend', dragEnd);
            track.removeEventListener('mousemove', dragAction);
            track.removeEventListener('touchmove', dragAction);
        }

        window.addEventListener('resize', () => {
            updateVisibleSlides();
            // recalc after a short delay so DOM has updated
            setTimeout(() => {
                markSingleState();
                updateCarousel();
            }, 120);
        });

        // Initialize
        updateVisibleSlides();
        markSingleState();
        updateCarousel();
    });
</script>











<style>

    .box-with-border-section {
        padding: 0 25%;
        margin-bottom: 120px;
    }


    .box-with-border {
        font-family: iA Writer Duo, sans-serif;
        font-size: 17px;
        padding: 75px 100px;
        border: 1px dashed #0867E8;
        position: relative; /* allow absolute children */
    }

    .box-with-border-italic {
        font-family: "Bodoni 6", serif;
        font-style: italic;
    }


    /* Corner squares */
    .box-with-border::before,
    .box-with-border::after,
    .box-with-border span::before,
    .box-with-border span::after {
        content: "";
        width: 6px;
        height: 6px;
        background-color: #0867E8;
        position: absolute;
    }

    /* top-left */
    .box-with-border::before {
        top: -3px;
        left: -3px;
    }

    /* top-right */
    .box-with-border::after {
        top: -3px;
        right: -3px;
    }

    /* bottom-left */
    .box-with-border span::before {
        bottom: -3px;
        left: -3px;
    }

    /* bottom-right */
    .box-with-border span::after {
        bottom: -3px;
        right: -3px;
    }

    .box-with-border p {
        margin-bottom: 0;
    }

    .box-with-border b {
        color: #0867E8;
    }


    @media (max-width: 966px) {
        .box-with-border {
            padding: 50px;
        }
    }

    @media (max-width: 567px) {
        .box-with-border-section {
            max-width: 930px;
            padding-left: 25px;
            padding-right: 25px;
        }

        .box-with-border {
            padding: 25px;
        }
    }




    .data-list-wrapper {
        display: flex;
        flex-direction: column;
        gap: 10px; /* spacing between rows */
        margin-bottom: 2.1em;
    }

    .data-list-header,
    .data-list-row {
        display: grid;
        grid-template-columns: 1fr 2fr;
        padding: 12px 16px;
        border: 1px solid #0867E8;

    }

    .data-list-header {
        background-color: #0867E8;
        font-weight: 700;
        color: white;
    }

    .data-list-col {
        padding: 4px 8px;
    }

    .data-list-col--left {
        font-weight: 600;
        color: #333;
    }

    .data-list-col--right {
        color: #555;
    }

    .data-list-col--title {
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ✅ Mobile view */
    @media (max-width: 600px) {
        .data-list-header {
            display: none;
        }

        .data-list-row {
            grid-template-columns: 1fr;
            border: 1px solid #0867E8;

            background: #fafafa;
        }

        .data-list-col--left {
            font-weight: 700;
            margin-bottom: 5px;
        }
    }






    .faq-section {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .faq-item {
        padding: 15px 0;
    }

    .faq-question {
        font-size: 1.2em;
        font-weight: 600;
        cursor: pointer;
        position: relative;
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: all 0.5s ease; /* makes opening slower */
        padding-top: 0;
        font-size: 1em;
        color: #333;
    }

    .faq-answer.active {
        max-height: 1000px; /* adjust depending on content size */
        opacity: 1;
        padding-top: 10px;
    }






    /*eee vvv eee nnn ttt ssss*/
    .events-carousel-wrapper {
        position: relative;
        overflow: hidden;
        max-width: 1200px;
        margin: 0 auto;

    }

    .events-carousel {
        overflow: hidden;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .events-track {
        display: flex;
        transition: transform 0.4s ease;
        gap: 20px;
        justify-content: center;
        width: 100%;
    }

    /* when track has .single class — center & make single card 300px */
    .events-track.single {
        justify-content: center; /* center the only slide */
    }

    .events-track.single .event-slide {
         flex: 0 0 300px;     /* fixed width for the single item */
         max-width: 300px;
     }

    /* ensure image and content scale nicely inside the fixed width */
    .events-track.single .event-thumb img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* optional: reduce track gap when single */
    .events-track.single { gap: 16px; }


    .event-slide {
        flex: 0 0 calc(33.333% - 20px); /* 3 per row on desktop */
        max-width: calc(33.333% - 20px);
        box-sizing: border-box;
        border: 1px dashed #0867E8;
        overflow: hidden;
        background: #fff;
        display: flex;
        flex-direction: column;
        text-decoration: none; /* make entire slide clickable */
        color: inherit;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .event-slide:hover {

    }



    .event-thumb img {
        width: 100%;
        display: block;
    }

    .event-content {
        padding: 15px 20px;
    }

    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: #0867E8;
        color: #fff;
        border: none;
        padding: 10px 15px;

        cursor: pointer;
        font-size: 24px;
        z-index: 10;
        opacity: 0.8;
    }

    .carousel-btn:hover { opacity: 1; }

    .carousel-btn.prev { left: 10px; }
    .carousel-btn.next { right: 10px; }

    @media (max-width: 992px) {
        .event-slide { flex: 0 0 calc(50% - 20px); max-width: calc(50% - 20px); }
        .events-track {gap: 5px; justify-content: space-between}
    }

    @media (max-width: 600px) {
        .event-slide { flex: 0 0 calc(100% - 20px); max-width: calc(100% - 20px); }
    }

</style>