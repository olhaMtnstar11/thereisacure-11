<?php
/* Define THEME */
if (!defined('URI_PATH')) define('URI_PATH', get_template_directory_uri());
if (!defined('ABS_PATH')) define('ABS_PATH', get_template_directory());
if (!defined('URI_PATH_FR')) define('URI_PATH_FR', URI_PATH.'/framework');
if (!defined('ABS_PATH_FR')) define('ABS_PATH_FR', ABS_PATH.'/framework');
if (!defined('URI_PATH_ADMIN')) define('URI_PATH_ADMIN', URI_PATH_FR.'/admin');
if (!defined('ABS_PATH_ADMIN')) define('ABS_PATH_ADMIN', ABS_PATH_FR.'/admin');
/* Theme Options */

require_once (ABS_PATH_ADMIN.'/theme-options.php');
require_once (ABS_PATH_ADMIN.'/index.php');
global $tb_options;
/* Template Functions */
require_once ABS_PATH_FR . '/template-functions.php';
/* Template Functions */
require_once ABS_PATH_FR . '/templates/post-functions.php';
/* Post Type */
require_once ABS_PATH_FR.'/post-type/doctor.php';
require_once ABS_PATH_FR.'/post-type/testimonial.php';
/* Function for Framework */
require_once ABS_PATH_FR . '/includes.php';
/* Register Sidebar */
if (!function_exists('ro_RegisterSidebar')) {
	function ro_RegisterSidebar(){
		register_sidebar(array(
			'name' => __('Main Sidebar', 'medicare'),
			'id' => 'tbtheme-main-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Blog Left Sidebar', 'medicare'),
			'id' => 'tbtheme-left-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Blog Right Sidebar', 'medicare'),
			'id' => 'tbtheme-right-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebars(4, array(
			'name' => __('Custom Sidebar %d', 'medicare'),
			'id' => 'tbtheme-custom-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Header Top Sidebar', 'medicare'),
			'id' => 'tbtheme-header-top-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Search On Menu Sidebar', 'medicare'),
			'id' => 'tbtheme-search-on-menu-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Menu Canvas Sidebar', 'medicare'),
			'id' => 'tbtheme-menu-canvas-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="wg-title">',
			'after_title' => '</h3>',
		));
		register_sidebars(4, array(
			'name' => __('Footer Top Widget %d', 'medicare'),
			'id' => 'tbtheme-footer-top-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebars(2, array(
			'name' => __('Footer Bottom Widget %d', 'medicare'),
			'id' => 'tbtheme-footer-bottom-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
	}
}
add_action( 'init', 'ro_RegisterSidebar' );
function _medicare_filter_fw_ext_backups_demos($demos)
	{
		$demos_array = array(
			'medicare' => array(
				'title' => esc_html__('Medicare Demo', 'medicare'),
				'screenshot' => 'https://gavencreative.com/import_demo/medicare/screenshot.jpg',
				'preview_link' => 'https://medicare.jwsuperthemes.com',
			),
		);
        $download_url = 'https://gavencreative.com/import_demo/medicare/download-script/';
		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);

			$demos[$demo->get_id()] = $demo;

			unset($demo);
		}

		return $demos;
	}
	add_filter('fw:ext:backups-demo:demos', '_medicare_filter_fw_ext_backups_demos');
/* Add Stylesheet And Script */
function ro_theme_enqueue_style() {
	global $tb_options;
    wp_enqueue_style( 'jws-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:600,500,400,300', false ); 
	wp_enqueue_style( 'bootstrap.min', URI_PATH.'/assets/css/bootstrap.min.css', false );
	wp_enqueue_style('flexslider.css', URI_PATH . "/assets/css/flexslider.css",array(),"");
	wp_enqueue_style('font-awesome', URI_PATH.'/assets/css/font-awesome.min.css', array(), '4.1.0');
	wp_enqueue_style('font-ionicons', URI_PATH.'/assets/css/ionicons.min.css', array(), '1.5.2');
	wp_enqueue_style('medicare_icon', URI_PATH.'/assets/css/medicare_icon.css', array(), '1.0.0');
	wp_enqueue_style( 'tb.core.min', URI_PATH.'/assets/css/tb.core.min.css', false );
	wp_enqueue_style( 'style', URI_PATH.'/style.css', false );	
}
add_action( 'wp_enqueue_scripts', 'ro_theme_enqueue_style' );

function ro_theme_enqueue_script() {
	global $tb_options;
	$tb_smoothscroll =& $tb_options['tb_smoothscroll'];
	wp_enqueue_script( 'bootstrap.min', URI_PATH.'/assets/js/bootstrap.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'datepicker.min', URI_PATH.'/assets/js/datepicker.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'menu', URI_PATH.'/assets/js/menu.js', array('jquery'), '', true  );
	wp_enqueue_script( 'jquery.flexslider-min', URI_PATH.'/assets/js/jquery.flexslider-min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'parallax', URI_PATH.'/assets/js/parallax.js', array('jquery'), '', true  );
	if($tb_smoothscroll){
		wp_enqueue_script( 'SmoothScroll', URI_PATH.'/assets/js/SmoothScroll.js', array('jquery'), '', true );
	}
	wp_enqueue_script( 'main', URI_PATH.'/assets/js/main.js', array('jquery'), '', true  );
}
add_action( 'wp_enqueue_scripts', 'ro_theme_enqueue_script' );
function tb_Header() {
    global $tb_options,$post;
    $header_layout = isset($tb_options["tb_header_layout"]) ? $tb_options["tb_header_layout"] : 'header-v1';
    if($post){
        $tb_header = get_post_meta($post->ID, 'tb_header', true)?get_post_meta($post->ID, 'tb_header', true):'global';
        $header_layout = $tb_header=='global'?$header_layout:$tb_header;
    }
    switch ($header_layout) {
        case 'header-v1':
            get_template_part('framework/headers/header', 'v1');
            break;
		case 'header-v2':
            get_template_part('framework/headers/header', 'v2');
            break;
		default :
			get_template_part('framework/headers/header', 'v1');
			break;
    }
}
/** remove redux menu under the tools **/
	add_action( 'admin_menu', 'ro_theme_remove_redux_menu',12 );
	function ro_theme_remove_redux_menu() {
		remove_submenu_page('tools.php','redux-about');
	}	
/* Style Inline */
function ro_add_style_inline() {
    global $tb_options;
    $custom_style = null;
    if (isset($tb_options['custom_css_code']) && $tb_options['custom_css_code']) {
        $custom_style .= "{$tb_options['custom_css_code']}";
    }
	$path = URI_PATH;
    wp_enqueue_style('wp_custom_style', URI_PATH . '/assets/css/wp_custom_style.css',array('style'));
    
	/* Body background */
    $tb_background_color =& $tb_options['tb_background']['background-color'];
    $tb_background_image =& $tb_options['tb_background']['background-image'];
    $tb_background_repeat =& $tb_options['tb_background']['background-repeat'];
    $tb_background_position =& $tb_options['tb_background']['background-position'];
    $tb_background_size =& $tb_options['tb_background']['background-size'];
    $tb_background_attachment =& $tb_options['tb_background']['background-attachment'];
	$custom_style .= "body{ background-color: $tb_background_color;}";
	if($tb_background_image){
		$custom_style .= "body{ background: url('$tb_background_image') $tb_background_repeat $tb_background_attachment $tb_background_position;background-size: $tb_background_size;}";
	}
	/* Title bar background */
    $tb_title_bar_bg_color =& $tb_options['tb_title_bar_bg']['background-color'];
    $title_bar_bg_image =& $tb_options['tb_title_bar_bg']['background-image'];
    $title_bar_bg_repeat =& $tb_options['tb_title_bar_bg']['background-repeat'];
    $title_bar_bg_position =& $tb_options['tb_title_bar_bg']['background-position'];
    $title_bar_bg_size =& $tb_options['tb_title_bar_bg']['background-size'];
    $title_bar_bg_attachment =& $tb_options['tb_title_bar_bg']['background-attachment'];
	$custom_style .= ".ro-blog-header { background-color: $tb_title_bar_bg_color;}";
	if($title_bar_bg_image){
		$custom_style .= ".ro-blog-header { background: url('$title_bar_bg_image') $title_bar_bg_repeat $title_bar_bg_attachment $title_bar_bg_position;background-size: $title_bar_bg_size;}";
	}
    wp_add_inline_style( 'wp_custom_style', $custom_style );
    /*End Font*/
}
add_action( 'wp_enqueue_scripts', 'ro_add_style_inline' );
/* Less */
if(isset($tb_options['tb_less'])&&$tb_options['tb_less']){
    require_once ABS_PATH_FR.'/presets.php';
}
/* Widgets */
require_once ABS_PATH_FR.'/widgets/abstract-widget.php';
require_once ABS_PATH_FR.'/widgets/widgets.php';
