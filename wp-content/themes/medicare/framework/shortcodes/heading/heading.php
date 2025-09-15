<?php
function ro_heading_func($atts) {
    extract(shortcode_atts(array(
		'tpl' => 'tpl1',
        'text' => '',
        'sub_text' => '',
        'el_class' => ''
    ), $atts));

    $class = array();
    $class[] = 'ro-hr-heading';
    $class[] = $tpl;
    $class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<?php
				if ( $tpl == 'tpl1' && $sub_text ) echo '<h6>'.esc_html($sub_text).'</h6>';
				if ( $text ) echo '<h4>'.esc_html($text).'</h4>';
				if ( $tpl == 'tpl2' && $sub_text ) echo '<span>'.esc_html($sub_text).'</span>';
			?>
		</div>
    <?php
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('heading', 'ro_heading_func'); }
