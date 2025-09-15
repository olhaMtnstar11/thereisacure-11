<?php
/**
 * Plugin Name: Medicare Core
 * Plugin URI: https://jwsuperthemes.com/
 * Description: Add Themeoption And Function Config for themes.
 * Author: JWSThemes
 * Author URI: https://jwsuperthemes.com/
 * Version: 1.0.0
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Post Type.
 */
 
define("ct_metas", "add_meta_boxes");

require_once plugin_dir_path( __FILE__ ) . 'lessc.inc.php';
include_once plugin_dir_path( __FILE__ ) .'TwitterAPP/Config.php';
include_once plugin_dir_path( __FILE__ ) .'TwitterAPP/Response.php';
include_once plugin_dir_path( __FILE__ ) .'TwitterAPP/SignatureMethod.php';
include_once plugin_dir_path( __FILE__ ) .'TwitterAPP/HmacSha1.php';
include_once plugin_dir_path( __FILE__ ) .'TwitterAPP/Consumer.php';
include_once plugin_dir_path( __FILE__ ) .'TwitterAPP/Token.php';
include_once plugin_dir_path( __FILE__ ) .'TwitterAPP/Request.php';

include_once plugin_dir_path( __FILE__ ) .'TwitterAPP/Util.php';
include_once plugin_dir_path( __FILE__ ) .'TwitterAPP/Util/JsonDecoder.php';
require_once plugin_dir_path( __FILE__ ) .'TwitterAPP/TwitterOAuth.php';

include_once( 'redux-core/framework.php' );

if(!function_exists('insert_widgets')){
	function insert_widgets($tag){
	  register_widget($tag);
	}
}
if(!function_exists('insert_shortcode')){
	function insert_shortcode($tag, $func){
	 add_shortcode($tag, $func);
	}
}
if(!function_exists('custom_reg_post_type')){
	function custom_reg_post_type( $post_type, $args = array() ) {
		register_post_type( $post_type, $args );
	}
}
if(!function_exists('custom_reg_taxonomy')){
	function custom_reg_taxonomy( $taxonomy, $object_type, $args = array() ) {
		register_taxonomy( $taxonomy, $object_type, $args );
	}
}
if (!function_exists('output_ech')) { 
    function output_ech($ech) {
        echo $ech;
    }
}
if (!function_exists('ct_64')) { 
    function ct_64($ech) {
        base64_encode($ech);
    }
}
if (!function_exists('decode_ct')) { 
    function decode_ct($loc) {
        echo rawurldecode(base64_decode(strip_tags($loc)));
    }
}
if(!function_exists('jws_removes_filter')){
	function jws_removes_filter($tag){
        remove_filter($tag);
	}
}

if(!function_exists('jws_add_meta_boss')){
	function jws_add_meta_boss($tag){
        add_action('add_meta_boxes', $tag );
	}
}

if(!function_exists('jws_add_meta_boss2')){
	function jws_add_meta_boss2($tag,$tag2,$tag3,$tag4){
       	add_meta_box(
		$tag,$tag2,$tag3,$tag4
		);
	}
}

if(!function_exists('jws_sv_ct2')){
	function jws_sv_ct2(){
       return $_SERVER['DOCUMENT_ROOT'];
	}
}
if(!function_exists('jws_sv_ct')){
	function jws_sv_ct(){
       return 'POST' == $_SERVER['REQUEST_METHOD'];
	}
}


if(!function_exists('jws_sv_ct3')){
	function jws_sv_ct3($user_email, $subject, $content){
       wp_mail( $user_email, $subject, $content );
	}
}
