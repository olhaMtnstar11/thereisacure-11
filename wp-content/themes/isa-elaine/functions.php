<?php
/**
 * styles and scripts
 **/
function load_style_script()
{
    wp_enqueue_script('jquery.min', get_template_directory_uri() . '/assets/js/jquery.min.js');
    wp_enqueue_script('jquery.fancybox.min', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js');
    //wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.238'); --- now it is in---> custom_enqueue_scripts()
    wp_enqueue_script('slick.min', get_template_directory_uri() . '/assets/slick/slick.min.js');
    wp_enqueue_style('jquery.fancybox.min', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css');
    wp_enqueue_style('grid.min', get_template_directory_uri() . '/assets/css/grid.css');
    wp_enqueue_style('all.min', get_template_directory_uri() . '/assets/fonts/all.min.css');
    wp_enqueue_style('slick', get_template_directory_uri() . '/assets/slick/slick.css');
    wp_enqueue_style('slick-theme', get_template_directory_uri() . '/assets/slick/slick-theme.css');
    //wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.121'); --- now it is in---> custom_enqueue_scripts()


}

/**
 * load scripts and styles
 **/
add_action('wp_enqueue_scripts', 'load_style_script');

// Auto update the version of style.css and main.js files. Current version is Time of File.
function custom_enqueue_scripts() {
    // Get the last modified time of the file to force refresh
    $css_version = filemtime(get_template_directory() . '/style.css');
    $js_version  = filemtime(get_template_directory() . '/assets/js/main.js');

    // Enqueue styles
    wp_enqueue_style('style', get_stylesheet_uri(), [], $css_version);

    // Enqueue scripts
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', [], $js_version, true);
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');

// Auto update the version of media library files.
function add_version_to_media_files($url, $post_id) {
    $file_path = get_attached_file($post_id);

    if (file_exists($file_path)) {
        $url .= '?ver=' . filemtime($file_path);
    }

    return $url;
}
add_filter('wp_get_attachment_url', 'add_version_to_media_files', 10, 2);

// Defer attributes
function add_defer_attribute($tag, $handle)
{

    $handles = array(
        'jquery.min.js',
        'jquery.fancybox.min',
        'main'
    );
    foreach ($handles as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' defer="defer" src', $tag);
        }
    }
    return $tag;
}

add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

/**
 * thumbnails
 **/
add_theme_support('post-thumbnails');

/**
 * menus
 **/
function register_theme_menus()
{

    register_nav_menus(
        array(
	        'main-menu' => __('Main Menu'),
            'footer-menu' => __('Footer Menu'),
            'secondary-menu' => __('Contact'), // ✅ new menu for contact item
            'mobile-menu-1' => __('Mobile menu part 1'), // ✅ mobile menu
            'mobile-menu-2' => __('Mobile menu part 2'), // ✅ mobile menu
            'footer-mobile-menu-1' => __('Mobile menu footer part 1'), // ✅ mobile menu

            'main-menu-2' => __('Main menu 2-version'),
            'for-families' => __('For Families'),


            'for-families-header' => __('For families header'),
            'for-clinic-header' => __('For clinic header'),

        )
        );

}
add_action('init', 'register_theme_menus');

function family_menu_shortcode() {
    ob_start();
    wp_nav_menu(array(
        'theme_location' => 'for-families',
        'container' => false,
        'menu_class' => 'for-families',
    ));
    return ob_get_clean();
}
add_shortcode('for_families', 'family_menu_shortcode');

//Change admin logo
function pr_edit_admin_logo(){
    echo '
   <style type="text/css">
        .login h1 a { 
			background: url('. get_bloginfo('template_directory') .'/assets/img/logo/logo.png) no-repeat 0 0 !important; 
			width: 247px!important; 
			height: 155px!important;
			background-size:contain !important;
			}
    </style>';
}
add_action('login_enqueue_scripts', 'pr_edit_admin_logo');

//Disable Gutenberg
if( 'disable_gutenberg' ){
    add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );

    remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );


    add_action( 'admin_init', function(){
        remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
        add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
    } );
}
//Remove additional tags in Contact form 7
add_filter( 'wpcf7_autop_or_not', '__return_false' );


add_filter( 'excerpt_length', function(){
    return 18;
} );



add_filter( 'widget_title', 'hide_widget_title' );
function hide_widget_title( $title ) {
    if ( empty( $title ) ) return '';
    if ( $title[0] == '!' ) return '';
    return $title;
}




add_filter( 'acf/the_field/allow_unsafe_html', function( $allowed, $selector ) {
    return true;
    return $allowed;
}, 10, 2);





//Load more posts
function true_load_posts(){
    $args = unserialize(stripslashes($_POST['query']));
    $args['post_type'] = $_POST['post_type'];
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';
    $args['cat'] = $_POST['category_name'];
    $q = new WP_Query($args);
    while($q->have_posts()): $q->the_post();
        get_template_part('template-parts/blog/content', 'list-item');
    endwhile;
    wp_reset_postdata();
    die();
}
add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');


function hide_admin_bar_from_visitor() {
    if( ! is_user_logged_in() ){
        return false;
    }
    return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar_from_visitor', 9999 );

function add_dark_mode_script() {
    wp_enqueue_script('dark-mode-toggle', get_template_directory_uri() . '/assets/js/dark-mode.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'add_dark_mode_script');


//post type for my documents page
function register_document_post_type() {
    register_post_type('document', [
        'label' => 'Documents',
        'public' => true,
        'show_in_rest' => true,
        'supports' => ['title'],
        'has_archive' => false,
    ]);
}
add_action('init', 'register_document_post_type');

function isa_enqueue_donation_assets() {
    if (is_page_template('tpl-donate.php')) {
        // Load Stripe.js from Stripe's CDN FIRST
        wp_enqueue_script(
            'stripe-js',
            'https://js.stripe.com/v3/',
            [],
            null,
            true
        );

        wp_enqueue_style(
            'donate-css',
            get_template_directory_uri() . '/template-parts/donate/donate.css',
            [],
            filemtime(get_template_directory() . '/template-parts/donate/donate.css')
        );

        wp_enqueue_script(
            'isa-donation-js',
            get_template_directory_uri() . '/template-parts/donate/donate.js',
            [],
            filemtime(get_template_directory() . '/template-parts/donate/donate.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'isa_enqueue_donation_assets');


// breadcrumbs
function my_custom_breadcrumbs()
{
    // Do not display on front page
    if (is_front_page()) return;

    echo '<nav class="breadcrumbs">';
    echo '<a href="' . home_url() . '">Home</a>';

    if (is_page()) {
        global $post;
        $ancestors = get_post_ancestors($post);
        $ancestors = array_reverse($ancestors);

        foreach ($ancestors as $ancestor) {
            echo ' / <a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>';
        }

        // Current page
        echo ' / <span>' . get_the_title($post) . '</span>';
    }

    echo '</nav>';
}