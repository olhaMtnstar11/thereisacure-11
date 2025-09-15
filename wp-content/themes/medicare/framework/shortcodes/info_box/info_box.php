<?php
function ro_info_box_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'icon' => '',
		'title' => '',
        'ex_link' => '#',
        'el_class' => ''
    ), $atts));
	
	$content = wpb_js_remove_wpautop($content, true);
	
    $class = array();
	$class[] = 'ro-info-wrap';
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<a href="<?php echo esc_url($ex_link); ?>">
				<div class="ro-info">
					<?php 
						if($icon) echo '<i class="'.esc_attr($icon).'"></i>';
						if($title) echo '<h4>'.esc_html($title).'</h4>';
						if($content) echo '<div class="ro-content">'.$content.'</div>';
					?>
				</div>
			</a>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('insert_shortcode')) { insert_shortcode('info_box', 'ro_info_box_func');}
