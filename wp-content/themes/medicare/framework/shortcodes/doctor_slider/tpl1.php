<div class="ro-doctor-slider flexslider ro-section-item">
	<ul class="slides">
		<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
		<li class="ro-doctor-slider-item">
			<h5>
				<?php
					$icon_doctor = get_post_meta( get_the_ID(), 'tb_doctor_icon', true );
					if( $icon_doctor ) echo '<span class="'.esc_attr($icon_doctor).'"></span>';
				?>
				<?php echo get_post_meta( get_the_ID(), 'tb_doctor_major', true ); ?>
			</h5>
			<div class="ro-item-inner">
				<?php if ( has_post_thumbnail() && $show_image ) { the_post_thumbnail('medicare-slider-doctor-small-thumbnail'); } ?>
				<?php if( $show_title ) { ?>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<?php } ?>
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
		</li>
		<?php } ?>
	</ul>
</div>