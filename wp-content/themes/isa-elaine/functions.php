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

            'footer-mobile-menu-1' => __('Mobile menu footer part 1'), // ✅ mobile menu


            'for-families' => __('For Families'),


            'for-families-header' => __('For families header'),
            'for-clinic-header' => __('For clinic header'),


            'why-we-exist' => __('Why We Exist'),
            'understanding-childhood-dementia' => __('Understanding Childhood Dementia'),
            'for-researchers' => __('For Researchers'),
            'take-action' => __('Take Action'),

            'types-of-nbia' => __('Types of NBIA'),

            'mobile_menu' => __('mobile menu'),
  'new-menu' => __('New menu'),
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
// Shortcode for "Types of NBIA" menu
function types_of_nbia_menu_shortcode() {
    ob_start();
    wp_nav_menu(array(
        'theme_location' => 'types-of-nbia',
        'container'      => false,
        'menu_class'     => 'types-of-nbia',
    ));
    return ob_get_clean();
}
add_shortcode('types_of_nbia', 'types_of_nbia_menu_shortcode');


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



//js for acf general template
function add_custom_template_script() {
    // Check if this page uses your template OR is the front page
    if (is_page_template('tpl-content.php') || is_front_page()) {
        wp_enqueue_script(
            'general-template',
            get_template_directory_uri() . '/assets/js/general-template.js',
            array(), // dependencies if needed
            null, // version
            true  // load in footer
        );
    }
}
add_action('wp_enqueue_scripts', 'add_custom_template_script');


//js for header  nav
function add_header_nav_script() {
    wp_enqueue_script(
        'header-nav',
        get_template_directory_uri() . '/assets/js/header-nav.js',
        array(),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'add_header_nav_script');


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


// Post type for News
// Register taxonomy for news categories
function register_news_category_taxonomy() {
    $labels = [
        'name'              => 'News Categories',
        'singular_name'     => 'News Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'News Categories',
    ];

    register_taxonomy('news_category', ['news'], [
        'hierarchical'      => true,  // like categories
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'news-category'],
    ]);
}
add_action('init', 'register_news_category_taxonomy');


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




// Change the excerpt "more" text to a custom button
function custom_excerpt_more($more) {
    global $post;
    return ' ... ';
}
add_filter('excerpt_more', 'custom_excerpt_more');





function create_event_post_type() {
    register_post_type('event', array(
        'labels' => array(
            'name' => __('Events'),
            'singular_name' => __('Event')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
        'show_in_rest' => true, // for Gutenberg/ACF
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    ));
}
add_action('init', 'create_event_post_type');


/**
 * 1) Fill missing/empty alts for images rendered via wp_get_attachment_image().
 */
add_filter( 'wp_get_attachment_image_attributes', function ( $attr, $attachment ) {

    $current = isset( $attr['alt'] ) ? trim( $attr['alt'] ) : '';

    // If there's already a meaningful alt, keep it.
    if ( $current !== '' && strtolower( $current ) !== 'alt' ) {
        return $attr;
    }

    $media_alt = trim( (string) get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) );

    if ( $media_alt !== '' ) {
        $attr['alt'] = $media_alt;
    } else {
        // Prefer empty alt over junk.
        $attr['alt'] = '';
    }

    return $attr;
}, 10, 2 );







/**
 * Step 1: wp_get_attachment_image() safety net.
 */
add_filter( 'wp_get_attachment_image_attributes', function ( $attr, $attachment ) {

    $current = isset( $attr['alt'] ) ? trim( $attr['alt'] ) : '';

    // Keep any non-empty, non-placeholder alt.
    if ( $current !== '' && strtolower( $current ) !== 'alt' ) {
        return $attr;
    }

    $media_alt = trim( (string) get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) );

    if ( $media_alt !== '' ) {
        $attr['alt'] = $media_alt;
    } else {
        $attr['alt'] = ''; // prefer empty to junk
    }

    return $attr;

}, 10, 2 );


/**
 * Step 2: Global HTML pass using output buffering.
 */
add_action( 'template_redirect', function () {

    // Only front-end, only normal HTML.
    if (
        is_admin()
        || wp_doing_ajax()
        || ( defined( 'REST_REQUEST' ) && REST_REQUEST )
        || ( function_exists( 'wp_is_json_request' ) && wp_is_json_request() )
        || is_feed()
        || is_embed()
    ) {
        return;
    }

    ob_start( 'auto_fill_image_alts_in_html' );
} );


/**
 * Buffer callback: patch all <img> tags.
 */
function auto_fill_image_alts_in_html( $html ) {
    // Quick bail-out if no images.
    if ( stripos( $html, '<img' ) === false ) {
        return $html;
    }

    $pattern = '/<img\b[^>]*>/i';

    return preg_replace_callback( $pattern, 'auto_fill_image_alts_img_callback', $html );
}


/**
 * Process a single <img> tag:
 * - Respect existing useful alt text.
 * - Use attachment_url_to_postid() to resolve Media Library item.
 * - Inject its alt text when appropriate.
 */
function auto_fill_image_alts_img_callback( $matches ) {
    static $alt_cache = [];

    $img = $matches[0];

    // 1) Existing alt?
    $has_alt = preg_match( '/\balt\s*=\s*([\'"])(.*?)\1/i', $img, $alt_match );
    $current_alt = $has_alt ? trim( html_entity_decode( $alt_match[2], ENT_QUOTES ) ) : '';

    // If alt is already meaningful, leave it alone.
    if ( $current_alt !== '' && strtolower( $current_alt ) !== 'alt' ) {
        return $img;
    }

    // 2) Get src.
    if ( ! preg_match( '/\bsrc\s*=\s*([\'"])(.*?)\1/i', $img, $src_match ) ) {
        return $img; // no src; nothing we can do
    }

    $src = $src_match[2];
    if ( ! $src ) {
        return $img;
    }

    // Normalize URL for lookup: strip query string.
    $lookup = strtok( $src, '?' );

    // 3) Map URL to attachment ID (cache to avoid repeated DB hits).
    if ( isset( $alt_cache[ $lookup ] ) ) {
        $media_alt = $alt_cache[ $lookup ];
    } else {
        $attachment_id = attachment_url_to_postid( $lookup );
        if ( ! $attachment_id ) {
            $alt_cache[ $lookup ] = '';
            return $img; // not a library image, bail
        }

        $media_alt = trim( (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) );
        $alt_cache[ $lookup ] = $media_alt;
    }

    // 4) No alt in library? If existing alt was literal "alt", normalize to empty.
    if ( $media_alt === '' ) {
        if ( $has_alt && strtolower( $current_alt ) === 'alt' ) {
            $img = preg_replace( '/\balt\s*=\s*([\'"])(.*?)\1/i', ' alt=""', $img, 1 );
        }
        return $img;
    }

    $media_alt_esc = esc_attr( $media_alt );

    // 5) Inject or replace alt.
    if ( $has_alt ) {
        // Replace empty/placeholder alt attribute.
        $img = preg_replace(
            '/\balt\s*=\s*([\'"])(.*?)\1/i',
            ' alt="' . $media_alt_esc . '"',
            $img,
            1
        );
    } else {
        // No alt attr — insert one before closing angle.
        $img = preg_replace(
            '/\s*\/?>$/',
            ' alt="' . $media_alt_esc . '"$0',
            $img
        );
    }

    return $img;
}







