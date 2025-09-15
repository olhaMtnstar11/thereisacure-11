<?php
// Check if we have flexible content rows
if (have_rows('sections')):
    while (have_rows('sections')) : the_row();
        if (get_row_layout() == 'our_mission'): ?>
            <section class="plain-text" id="mission">
                <div class="container">
                    <?php if (get_sub_field('title')): ?>
                        <h2><?php echo esc_html(get_sub_field('title')); ?></h2>
                    <?php endif; ?>
                    <?php if (get_sub_field('sub_title')): ?>
                        <h4><?php echo esc_html(get_sub_field('sub_title')); ?></h4>
                    <?php endif; ?>
                    <?php if (get_sub_field('content')): ?>
                        <div class="content-text">
                            <?php echo wp_kses_post(get_sub_field('content')); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Download Button -->
                    <?php
                    $file = get_sub_field('file'); // Get file array
                    $button_label = get_sub_field('button_label'); // Get button text
                    if ($file && $button_label): ?>





                        <div class="download-button-container">
                            <a href="<?php echo esc_url($file['url']); ?>" target="_blank" class="btn-download">
                                <?php echo esc_html($button_label); ?>
                            </a>
                        </div>


                    <?php endif; ?>
                </div>
            </section>
			<!-- Thin Line Div -->
			<div class="line-container">
				<div class="section-line"></div>
			</div>
        <?php elseif (get_row_layout() == 'isabellas-story'): ?>
            <section class="plain-text" id="story">
                <div class="container">
					<div class="isa-photo-mobile-container center" style="text-align: center; padding-bottom: 16px; max-width: 225px">
                        <?php if ($image_isa = get_sub_field('mobile_isa_photo')): ?>
                            <img class="size-full wp-image-330" src="<?php echo esc_url($image_isa); ?>" alt="" >
                        <?php endif; ?>
                    </div>
                    <?php if (get_sub_field('title')): ?>
                        <h2><?php echo esc_html(get_sub_field('title')); ?></h2>
                    <?php endif; ?>
                    <?php if (get_sub_field('sub_title')): ?>
                        <h4><?php echo esc_html(get_sub_field('sub_title')); ?></h4>
                    <?php endif; ?>
                    <?php if (get_sub_field('content')): ?>
                        <div class="content-text">
                            <?php echo wp_kses_post(get_sub_field('content')); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="container container-second">
                    <!-- New Image Field -->
                    <?php if ($image_1 = get_sub_field('image_1')): ?>
                        <img src="<?php echo esc_url($image_1); ?>" alt="Image">
                    <?php endif; ?>
                </div>
                <div class="container">
                    <!-- New WYSIWYG Content Field -->
                    <?php if (get_sub_field('content_2')): ?>
                        <div class="additional-content">
                            <?php echo wp_kses_post(get_sub_field('content_2')); ?>
                        </div>
                    <?php endif; ?>
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
        <?php elseif (get_row_layout() == 'key_points'): ?>
            <section id="key-points" class="plain-text">






                <div class="container container-second container-second-image">
                    <!-- New Image Field -->
                    <?php if ($title_image = get_sub_field('title_image')): ?>
                        <img src="<?php echo esc_url($title_image); ?>" alt="Image">
                    <?php endif; ?>
                </div>
                <div class="container">
                    <?php if (get_sub_field('title')): ?>
                        <h2><?php echo esc_html(get_sub_field('title')); ?></h2>
                    <?php endif; ?>


            <?php if (have_rows('content_box')): // Check if there are rows in the content_block repeater ?>
                <?php while (have_rows('content_box')): the_row(); // Loop through each row in content_block ?>


                    <?php if (get_sub_field('content')): // Check if border_box is checked ?>

                       <div class="container point-container">
                           <div class="point center">

                           </div>
                       </div>

                        <div class="box-outline">
                            <div class="content-text">
                                <?php
                                $kay_content = get_sub_field('content'); // Get the WYSIWYG content field
                                if ($kay_content): // Check if content exists
                                    echo wp_kses_post($kay_content); // Output the WYSIWYG content safely
                                endif;
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
               <?php endif; ?>
                </div>







            </section>
			<!-- Thin Line Div -->
			<div class="line-container">
				<div class="section-line"></div>
			</div>
        <?php elseif (get_row_layout() == 'scientific_connection'): ?>
            <section id="research" class="plain-text">
                <div class="container container-second container-second-image">
                    <!-- New Image Field -->
                    <?php if ($title_image = get_sub_field('title_image')): ?>
                        <img src="<?php echo esc_url($title_image); ?>" alt="Image">
                    <?php endif; ?>
                </div>
                <div class="container">
                    <?php if (get_sub_field('title')): ?>
                        <h2><?php echo esc_html(get_sub_field('title')); ?></h2>
                    <?php endif; ?>

                    <?php if (have_rows('content_block')): // Check if there are rows in the content_block repeater ?>
                        <?php while (have_rows('content_block')): the_row(); // Loop through each row in content_block ?>
                            <h4>
                                <?php
                                $sub_title = get_sub_field('sub_title'); // Get the sub_title field
                                if ($sub_title): // Check if sub_title exists
                                    echo esc_html($sub_title); // Output the sub_title safely
                                endif;
                                ?>
                            </h4>

                            <?php if (get_sub_field('border_box')): // Check if border_box is checked ?>
                                <div class="box-outline">
                                    <div class="content-text">
                                        <?php
                                        $content = get_sub_field('content'); // Get the WYSIWYG content field
                                        if ($content): // Check if content exists
                                            echo wp_kses_post($content); // Output the WYSIWYG content safely
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            <?php else: // If border_box is unchecked ?>
                                    <?php if (get_sub_field('content')): ?>
                                        <div class="content-text">
                                            <?php echo wp_kses_post(get_sub_field('content')); ?>
                                        </div>
                                    <?php endif; ?>

                                <?php
                                // Check if 'add_button' is checked
                                if (get_sub_field('add_button')):
                                    // Check if there's a file and a button name
                                    $file2 = get_sub_field('file');
                                    $button_name2 = get_sub_field('button_name');

                                    if ($file2 && $button_name2): // Ensure both file and button_name are available
                                        ?>
                                        <div class="download-button-container research-btn">
                                            <a href="<?php echo esc_url($file2['url']); ?>" target="_blank" class="btn-download">
                                                <?php echo esc_html($button_name2); ?>
                                            </a>
                                        </div>
                                    <?php
                                    endif;
                                endif;
                                ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </section>

			<!-- Thin Line Div -->
			<div class="line-container">
				<div class="section-line"></div>
			</div>
        <?php elseif (get_row_layout() == 'box_section'): ?>
			<section id="box-section" class="plain-text">
				<div class="container container-second">
					<?php if (have_rows('item')): ?>
						<div class="box-items">
							<?php $i = 0; // initialize a counter ?>
							<?php while (have_rows('item')): the_row(); ?>
								<?php if ($i > 0): // if not the first item, output divider ?>
									<!-- Thin Line Divider -->
									<div class="line-container">
										<div class="section-line"></div>
									</div>
								<?php endif; ?>

								<div class="box-item">
									<!-- Image on the Left (50% Width) -->
									<?php if ($image = get_sub_field('image')): ?>
										<div class="box-item-image">
											<img src="<?php echo esc_url($image); ?>" alt="Box Image">
										</div>
									<?php endif; ?>

									<!-- Content on the Right (50% Width) -->
									<div class="box-item-content">
										<?php if (get_sub_field('title')): ?>
											<h2 class="box-title"><?php echo esc_html(get_sub_field('title')); ?></h2>
										<?php endif; ?>

										<?php if (get_sub_field('text')): ?>
											<p class="box-text"><?php echo wp_kses_post(get_sub_field('text')); ?></p>
										<?php endif; ?>

										<?php if (get_sub_field('name_of_button')): ?>
											<div class="box-item-button">
												<a href="#<?php echo esc_html(get_sub_field('id')); ?>" class="btn-section">
													<span style="margin-top: -4px;"><?php echo esc_html(get_sub_field('name_of_button')); ?></span>
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>

								<?php $i++; // increment the counter ?>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>
			<!-- Thin Line Div -->
			<div class="line-container">
				<div class="section-line"></div>
			</div>
            <?php elseif (get_row_layout() == 'leading_experts'): ?>
            <section id="leading_experts" class="plain-text">
                <div class="container container-second container-second-image">
                    <!-- New Image Field -->
                    <?php if ($title_image = get_sub_field('title_image')): ?>
                        <img src="<?php echo esc_url($title_image); ?>" alt="Image">
                    <?php endif; ?>
                </div>
                <div class="container">
                    <?php if (get_sub_field('title')): ?>
                        <h2><?php echo esc_html(get_sub_field('title')); ?></h2>
                    <?php endif; ?>
                    <?php if (get_sub_field('sub_title')): ?>
                        <h4><?php echo esc_html(get_sub_field('sub_title')); ?></h4>
                    <?php endif; ?>
                        <h4></h4>
                    <?php if (get_sub_field('content')): ?>
                        <div class="content-text">
                            <?php echo wp_kses_post(get_sub_field('content')); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="container container-second">
                    <?php if ($content_image = get_sub_field('content_image')): ?>
                        <img src="<?php echo esc_url($content_image); ?>" alt="Content Image">
                    <?php endif; ?>
                </div>
            </section>
            <!-- Thin Line Div -->
			<div class="line-container">
               <div class="section-line"></div>
            </div>
            <?php endif; ?>
    <?php endwhile;
endif;
