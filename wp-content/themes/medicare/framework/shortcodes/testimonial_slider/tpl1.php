<div class="ro-testimonial-slider flexslider ro-section-item">
	<ul class="slides">
		<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
			<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail', false); ?>
			<li class="ro-testimonial-slider-item" data-thumb="<?php echo esc_url($attachment_image[0]); ?>">
				<div class="ro-content">
					<div class="ro-quote"><i class="icon icon-quote-left"></i></div>
					<?php if( $show_title ) { ?>
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<?php } ?>
					<?php if( $show_meta ) { ?>
						<div class="ro-meta"><?php echo get_post_meta( get_the_ID(), 'tb_testimonial_age', true ).' - '.get_post_meta( get_the_ID(), 'tb_testimonial_company', true ); ?></div>
					<?php } ?>
						<div class="ro-hr ro-full"></div>
					<?php if( $show_excerpt ) { ?>
						<div class="ro-excerpt"><?php the_excerpt(); ?></div>
					<?php } ?>
				</div>
			</li>
		<?php } ?>
	</ul>
</div>