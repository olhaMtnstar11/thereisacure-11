<?php
/*
Template Name: 404 Template
*/
?>
<?php get_header(); ?>
	<div class="main-content ro-blog-sub-article-container-3">
		<div class="container">
			<div class="error404-wrap">
				<h1 class="error-code"><?php _e('404','medicare');?></h1>
				<p class="error-message">
					<?php _e('It looks like nothing was found at this location!','medicare');?></br>
					<?php _e('Go Back ','medicare');?><a title="<?php _e('Home','medicare');?>" href="<?php echo esc_url( home_url( '/'  ) );?>"><i class="fa fa-home"></i><?php _e('Home','medicare');?></a>
				</p>
			</div>
		</div>
	</div>
<?php get_footer(); ?>