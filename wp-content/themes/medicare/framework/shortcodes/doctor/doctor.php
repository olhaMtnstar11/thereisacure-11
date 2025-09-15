<?php
function ro_doctor_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'columns' =>  3,
		'orderby' => 'none',
        'order' => 'none',
        'animation' => '',
        'el_class' => '',
		'show_image' => 0,
        'show_title' => 0,
        'show_excerpt' => 0,
        'show_meta' => 0,
    ), $atts));
			
    $class = array();
    $class[] = 'ro-doctor-wrapper clearfix';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'doctor',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'doctor_department',
                                    'field' => 'id',
                                    'terms' => $category
                                )
                        );
    }
    $wp_query = new WP_Query($args);
	
    ob_start();
	
	if ( $wp_query->have_posts() ) {
		$class_columns = '';
		switch ($columns) {
			case 1:
				$class_columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				break;
			case 2:
				$class_columns = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
				break;
			case 3:
				$class_columns = 'col-xs-12 col-sm-12 col-md-4 col-lg-4';
				break;
			case 4:
				$class_columns = 'col-xs-12 col-sm-12 col-md-3 col-lg-3';
				break;
			default:
				$class_columns = 'col-xs-12 col-sm-12 col-md-3 col-lg-3';
				break;
		}
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="row">
			<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<div class="<?php echo esc_attr($class_columns); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="ro-doctor-item">
							<div class="ro-doctor-inner">
								<?php 
								$doctor_extra_img = get_post_meta( get_the_ID(), 'tb_doctor_extra_img', true );
								if( $doctor_extra_img ) {
									echo '<img src="'.esc_url($doctor_extra_img).'" alt="Doctor">';
								} else {
									if ( has_post_thumbnail() && $show_image ) { the_post_thumbnail('full'); } 
								}								
								?>
								<div class="ro-doctor-overlay">
									<?php if( $show_title ) { ?>
										<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									<?php } ?>
									<?php
										$icon_doctor = get_post_meta( get_the_ID(), 'tb_doctor_icon', true );
										if( $icon_doctor ) echo '<div class="ro-icon"><i class="'.esc_attr($icon_doctor).'"></i></div>';
									?>
								</div>
							</div>
							<div class="ro-doctor-content">
								<?php if( $show_excerpt ) { ?>
									<div class="ro-excerpt"><?php the_excerpt(); ?></div>
								<?php } ?>
								<div class="ro-hr"></div>
								<?php if( $show_meta ) { ?>
									<div class="ro-meta">
										<?php
											$doctor_phone = get_post_meta( get_the_ID(), 'tb_doctor_phone', true );
											if( $doctor_phone ) echo '<div class="ro-phone">'.$doctor_phone.'</div>';
											$doctor_email = get_post_meta( get_the_ID(), 'tb_doctor_Email', true ); 
											if( $doctor_email ) echo '<div class="ro-email">'.$doctor_email.'</div>';
											$doctor_address = get_post_meta( get_the_ID(), 'tb_doctor_address', true );
											if( $doctor_address ) echo '<div class="ro-address">'.$doctor_address.'</div>';
										?>
									</div>
								<?php } ?>
							</div>
						</div>
					</article>
				</div>
			<?php } ?>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('doctor', 'ro_doctor_func'); }
