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
                                    $answer = get_sub_field('answer');
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


                <?php endif; ?><?php elseif (get_row_layout() == 'carousel'): ?>
                <?php if (get_row_layout() == 'carousel'):
                    ?>
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
                                                        <p class="event-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></p>
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
                <?php endif; ?>


            <?php elseif (get_row_layout() == 'poem-logo'): ?>
                <?php if (get_row_layout() == 'poem-logo'): ?>
                    <div class="poem-logo" style="margin: 120px 0">
                        <?php
                        $theme_logo = get_field('logo', 'option'); // from Theme Settings
                        $logo_width = get_sub_field('poem_logo_width'); // number field
                        if ($theme_logo):
                            // fallback width if not set
                            $max_width = $logo_width ? intval($logo_width) . 'px' : '120px';
                            ?>
                            <img class="p-3"
                                 style="max-width: <?php echo esc_attr($max_width); ?>;"
                                 src="<?php echo esc_url($theme_logo); ?>"
                                 alt="Site Logo">
                        <?php endif; ?>
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


            <?php elseif (get_row_layout() == 'general_partners'): ?>
                <?php if (get_row_layout() == 'general_partners'): ?>
                    <section class="partner-tpl-section box-with-border ">



                            <?php if (have_rows('partner_item', 'option')): ?>
                                <div class="partner-logos">
                                    <?php while (have_rows('partner_item', 'option')): the_row();
                                        $logo = get_sub_field('logo');
                                        if (!empty($logo)) : ?>
                                            <a target="_blank" href="<?php echo esc_url(get_sub_field('link')); ?>"
                                               class="partner-logo">
                                                <img src="<?php echo esc_url($logo); ?>" alt="">
                                            </a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>



                    </section>
                <?php endif; ?>



            <?php elseif (get_row_layout() == 'social_media'): ?>
                <?php if (get_row_layout() == 'social_media'): ?>
                    <section class="partner-tpl-section box-with-border ">



                            <?php if (have_rows('social_media', 'option')): ?>
                                <div class="partner-logos">
                                    <?php while (have_rows('social_media', 'option')): the_row();
                                        $logo = get_sub_field('logo');
                                        if (!empty($logo)) : ?>
                                            <a target="_blank" href="<?php echo esc_url(get_sub_field('link')); ?>"
                                               class="partner-logo">
                                                <img src="<?php echo esc_url($logo); ?>" alt="">
                                            </a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>



                    </section>
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
                    <section class="data-list general-tpl-section ">
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




