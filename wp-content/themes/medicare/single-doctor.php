<?php get_header(); ?>
<?php
global $tb_options;
$tb_show_page_title = isset($tb_options['tb_post_show_page_title']) ? $tb_options['tb_post_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($tb_options['tb_post_show_page_breadcrumb']) ? $tb_options['tb_post_show_page_breadcrumb'] : 1;
$tb_post_show_post_nav = (int) isset($tb_options['tb_recipes_post_show_post_nav']) ?  $tb_options['tb_recipes_post_show_post_nav']: 1;
ro_theme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb, $tb_post_show_post_nav);

?>
	<div class="main-content ro-doctor">
		<div class="container">
			<div class="row">
				<!-- Start Content -->
				<div class="col-md-9">
					<?php while ( have_posts() ) { the_post(); $post_id = get_the_ID(); ?>
						<h4 class="ro-profile-title"><?php _e('DOCTOR\'S PROFILE', 'medicare') ?></h4>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if(has_post_thumbnail()) the_post_thumbnail('full'); ?>
							<div class="ro-content">
								<div class="ro-header">
									<h4><?php the_title(); ?></h4>
									<span class="ro-department"><?php the_terms(get_the_ID(), 'doctor_department', '', ' & ' ); ?></span>
									<?php echo ro_theme_social_share_post_render(); ?>
								</div>
								<div class="ro-desciption"><?php the_content(); ?></div>
							</div>
						</article>
					<?php } ?>
					
						<?php
						$args = array(
							'posts_per_page' => -1,
							'post_type' => 'doctor',
							'post_status' => 'publish'
						);
						
						$the_query = new WP_Query($args);
						
						wp_enqueue_script('jquery.mixitup.min', URI_PATH . '/assets/js/jquery.mixitup.min.js',array(),"2.1.5");
						
						if ( $the_query->have_posts() ) {
							?>
							<div class="ro-doctor-gird">
								<ul class="controls-filter ro-special-font">
									<li class="filter" data-filter="all"><a href="javascript:void(0);"><?php _e('All Doctors', 'medicare');?></a></li>
									<?php
										$terms = get_terms('doctor_department');
										if ( !empty( $terms ) && !is_wp_error( $terms ) ){
											foreach ( $terms as $term ) {
											?>
												<li class="filter" data-filter=".<?php echo esc_attr($term->slug); ?>"><a href="javascript:void(0);"><?php echo esc_html($term->name); ?></a></li>
											<?php
											}
										}
									?>
								</ul>
								<div id="Container" class="row ro-grid-content">
									<?php while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
										<?php
										$terms = wp_get_post_terms(get_the_ID(), 'doctor_department');
										if ( !empty( $terms ) && !is_wp_error( $terms ) ){
											$term_list = array();
											foreach ( $terms as $term ) {
												$term_list[] = $term->slug;
											}
										}
										?>
										<div class="mix col-md-4 <?php echo esc_attr(implode(' ', $term_list)); ?>" data-myorder="<?php echo get_the_ID(); ?>">
											<div class="ro-doctor-item">
												<div class="ro-item-inner">
													<?php if(has_post_thumbnail()) the_post_thumbnail('full'); ?>
													<div class="ro-overlay">
														<div class="ro-buttons ro-special-font">
															<a href="<?php the_permalink(); ?>"><i class="icon icon-plus"></i></a>															
														</div>
													</div>
												</div>
												<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
												<span class="ro-hospital"><?php the_terms(get_the_ID(), 'doctor_department', '', ' & ' ); ?></span>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
							<?php
						}
						wp_reset_postdata();
						?>
				</div>
				<!-- End Content -->
				<!-- Start Right Sidebar -->
				<div class="col-md-3">
					<h6 class="ro-related-title"><?php _e('RESULTS FROM SAME DEPARTMENT', 'medicare') ?></h6>
					<div class="ro-doctor-related">
						<?php 
							// get the custom post type's taxonomy terms
							$custom_taxterms = wp_get_object_terms( $post_id, 'doctor_department', array('fields' => 'ids') );
							
							// arguments
							$args = array(
							'post_type' => 'doctor',
							'post_status' => 'publish',
							'posts_per_page' => 8,
							'tax_query' => array(
								array(
									'taxonomy' => 'doctor_department',
									'field' => 'id',
									'terms' => $custom_taxterms
								)
							),
							'post__not_in' => array ($post_id),
							);
							$related_items = new WP_Query( $args );
							// loop over query
							if ($related_items->have_posts()) {
								echo '<ul>';
									while ( $related_items->have_posts() ) { $related_items->the_post();
										?>
											<li class="clearfix">
												<?php if(has_post_thumbnail()) the_post_thumbnail('thumbnail'); ?>
												<div class="ro-content">
													<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
													<span class="ro-hospital"><?php the_terms(get_the_ID(), 'doctor_hospital', '', ' & ' ); ?></span>
												</div>
											</li>
										<?php
									}
								echo '</ul>';
							}
							// Reset Post Data
							wp_reset_postdata();
						?>
					</div>
				</div>
				<!-- End Right Sidebar -->
			</div>
		</div>
	</div>
<?php get_footer(); ?>