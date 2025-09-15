<?php
class RO_Doctor_List_Widget extends RO_Widget {
	public function __construct() {
		$this->widget_cssclass    = 'ro-doctor ro-widget-doctor-list';
		$this->widget_description = __( 'Display a list of your doctor on your site.', 'medicare' );
		$this->widget_id          = 'ro_doctor_list';
		$this->widget_name        = __( 'Doctor List', 'medicare' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Doctor List', 'medicare' ),
				'label' => __( 'Title', 'medicare' )
			),
			'doctor_department' => array(
				'type'   => 'tb_taxonomy',
				'std'    => '',
				'label'  => __( 'Department', 'medicare' ),
			),
			'posts_per_page' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 3,
				'label' => __( 'Number of posts to show', 'medicare' )
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'none',
				'label' => __( 'Order by', 'medicare' ),
				'options' => array(
					'none'   => __( 'None', 'medicare' ),
					'comment_count'  => __( 'Comment Count', 'medicare' ),
					'title'  => __( 'Title', 'medicare' ),
					'date'   => __( 'Date', 'medicare' ),
					'ID'  => __( 'ID', 'medicare' ),
				)
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'none',
				'label' => __( 'Order', 'medicare' ),
				'options' => array(
					'none'  => __( 'None', 'medicare' ),
					'asc'  => __( 'ASC', 'medicare' ),
					'desc' => __( 'DESC', 'medicare' ),
				)
			),
			'el_class'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Extra Class', 'medicare' )
			)
		);
		parent::__construct();
		add_action('admin_enqueue_scripts', array($this, 'widget_scripts'));
	}
        
	public function widget_scripts() {
		wp_enqueue_script('widget_scripts', URI_PATH . '/framework/widgets/widgets.js');
	}

	public function widget( $args, $instance ) {
		
		if ( $this->get_cached_widget( $args ) )
			return;
		
		global $post;
		extract( $args );
                
		$title                  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$category               = isset($instance['doctor_department'])? $instance['doctor_department'] : '';
		$posts_per_page         = absint( $instance['posts_per_page'] );
		$orderby                = sanitize_text_field( $instance['orderby'] );
		$order                  = sanitize_text_field( $instance['order'] );
		$el_class               = sanitize_text_field( $instance['el_class'] );
        
		// no 'class' attribute - add one with the value of width
        if (strpos($before_widget, 'class') === false) {
            $before_widget = str_replace('>', 'class="' . esc_attr($el_class) . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="' . esc_attr($el_class) . ' ', $before_widget);
        }
		
        ob_start();
		 
		echo ''.$before_widget;

		if ( $title )
				echo ''.$before_title . $title . $after_title;
		
		$query_args = array(
			'posts_per_page' => $posts_per_page,
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
			$query_args['tax_query'] = array(
									array(
										'taxonomy' => 'doctor_department',
										'field' => 'id',
										'terms' => $category
									)
							);
		}
		
		$wp_query = new WP_Query($query_args);                
		
		if ($wp_query->have_posts()){
			?>
			<ul class="ro-doctor-list">
				<?php while ($wp_query->have_posts()){ $wp_query->the_post(); ?>
					<li class="ro-doctor-item clearfix">
						<a href="<?php the_permalink(); ?>">
							<?php if( has_post_thumbnail() ) the_post_thumbnail('thumbnail'); ?>
							<div class="ro-content">
								<h6><?php the_title(); ?></h6>
								<span><?php echo __('Major: ', 'medicare').get_post_meta( get_the_ID(), 'tb_doctor_major', true ); ?></span>
							</div>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php 
		}
		
		wp_reset_postdata();

		echo ''.$after_widget;
                
		$content = ob_get_clean();

		echo ''.$content;

		$this->cache_widget( $args, $content );
	}
}


if(function_exists('insert_widgets')) { 

	function register_doctor_list_widget() {
		
		insert_widgets('RO_Doctor_List_Widget');
		 
	}
	add_action('widgets_init', 'register_doctor_list_widget');

} 
