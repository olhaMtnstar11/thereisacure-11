<?php get_header(); ?>

<main class="single-news">

        <?php if (have_posts()): while (have_posts()): the_post(); ?>





                <!-- back button -->
                <article id="single-news-tpl" class="plain-text general-section" <?php post_class(); ?>>
                    <div class="general-tpl-section back-link">

                        <?php
                        // Get previous page (referrer)
                        $back_url = wp_get_referer();

                        // Fallback if no referrer
                        if (!$back_url) {
                            $back_url = get_post_type_archive_link('news'); // 'news' = your CPT key
                        }
                        ?>


                        <a href="<?php echo esc_url($back_url); ?>">
                            ← back
                        </a>
                        <!--  breadcrumbs    -->
                        <!--      <?php my_custom_breadcrumbs(); ?>-->
                    </div>



                    <div class="general-tpl-section">
                            <h2 class="mb-4"><?php the_title(); ?></h2>
                    </div>
                    <div class="general-tpl-section">
                        <div class=" mb-4 sub-title font-ia-writer-duo"> <span class="date"><?php echo get_the_date(); ?></span></div>
                        <?php if (get_field('sub_title')): ?>
                            <h4 class="mb-6 sub-title font-ia-writer-duo"><?php echo esc_html(get_field('sub_title')); ?></h4>
                        <?php endif; ?>
                    </div>





                    <?php if (have_rows('Sections')): ?>
                        <?php while (have_rows('Sections')): the_row(); ?>


                                <!-- 2 column grid section -->
                            <?php if (get_row_layout() == '3_column_grid'): ?>
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


                                                        <div class="m-2">
                                                            <?php echo esc_html($label); ?>
                                                        </div>
                                                        <div class="m-2">
                                                            <?php echo esc_html($description); ?>
                                                        </div>

                                                    </div>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>


                                    </div>
                                <?php endif; ?>













                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>




                <!-- Thin Line Div -->
                <div class="line-container">

                    <div class="section-line-with-squares">
                        <div class="square left"></div>
                        <div class="section-line"></div>
                        <div class="square right"></div>
                    </div>
                </div>














                <div class="news-meta">

                    <?php the_terms(get_the_ID(), 'news_category', '<span class="category">', ', ', '</span>'); ?>
                </div>

                <?php if (has_post_thumbnail()): ?>
                    <div class="news-featured-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>






        <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>

