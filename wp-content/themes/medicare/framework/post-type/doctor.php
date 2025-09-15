<?php
// Register Custom Post Type
function tb_add_post_type_doctor() {
	// Register department
	$labels = array(
            'name'              => _x( 'Doctor Department', 'taxonomy general name', 'medicare' ),
            'singular_name'     => _x( 'Doctor Department', 'taxonomy singular name', 'medicare' ),
            'search_items'      => __( 'Search Doctor Department', 'medicare' ),
            'all_items'         => __( 'All Doctor Department', 'medicare' ),
            'parent_item'       => __( 'Parent Doctor Department', 'medicare' ),
            'parent_item_colon' => __( 'Parent Doctor Department:', 'medicare' ),
            'edit_item'         => __( 'Edit Doctor Department', 'medicare' ),
            'update_item'       => __( 'Update Doctor Department', 'medicare' ),
            'add_new_item'      => __( 'Add New Doctor Department', 'medicare' ),
            'new_item_name'     => __( 'New Doctor Department Name', 'medicare' ),
            'menu_name'         => __( 'Doctor Department', 'medicare' ),
    );
	
	$args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'doctor_department' ),
    );
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'doctor_department', array( 'doctor' ), $args );
    }
	
    // Register Hospital
    $labels = array(
            'name'              => _x( 'Doctor Hospital', 'taxonomy general name', 'medicare' ),
            'singular_name'     => _x( 'Doctor Hospital', 'taxonomy singular name', 'medicare' ),
            'search_items'      => __( 'Search Doctor Hospital', 'medicare' ),
            'all_items'         => __( 'All Doctor Hospital', 'medicare' ),
            'parent_item'       => __( 'Parent Doctor Hospital', 'medicare' ),
            'parent_item_colon' => __( 'Parent Doctor Hospital:', 'medicare' ),
            'edit_item'         => __( 'Edit Doctor Hospital', 'medicare' ),
            'update_item'       => __( 'Update Doctor Hospital', 'medicare' ),
            'add_new_item'      => __( 'Add New Doctor Hospital', 'medicare' ),
            'new_item_name'     => __( 'New Doctor Hospital Name', 'medicare' ),
            'menu_name'         => __( 'Doctor Hospital', 'medicare' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'doctor_hospital' ),
    );
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'doctor_hospital', array( 'doctor' ), $args );
    }
	
    //Register tags
    $labels = array(
            'name'              => _x( 'Doctor Tag', 'taxonomy general name', 'medicare' ),
            'singular_name'     => _x( 'Doctor Tag', 'taxonomy singular name', 'medicare' ),
            'search_items'      => __( 'Search Doctor Tag', 'medicare' ),
            'all_items'         => __( 'All Doctor Tag', 'medicare' ),
            'parent_item'       => __( 'Parent Doctor Tag', 'medicare' ),
            'parent_item_colon' => __( 'Parent Doctor Tag:', 'medicare' ),
            'edit_item'         => __( 'Edit Doctor Tag', 'medicare' ),
            'update_item'       => __( 'Update Doctor Tag', 'medicare' ),
            'add_new_item'      => __( 'Add New Doctor Tag', 'medicare' ),
            'new_item_name'     => __( 'New Doctor Tag Name', 'medicare' ),
            'menu_name'         => __( 'Doctor Tag', 'medicare' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'doctor_tag' ),
    );
    
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'doctor_tag', array( 'doctor' ), $args );
    }
    
    //Register post type doctor
    $labels = array(
            'name'                => _x( 'Doctor', 'Post Type General Name', 'medicare' ),
            'singular_name'       => _x( 'Doctor Item', 'Post Type Singular Name', 'medicare' ),
            'menu_name'           => __( 'Doctor', 'medicare' ),
            'parent_item_colon'   => __( 'Parent Item:', 'medicare' ),
            'all_items'           => __( 'All Items', 'medicare' ),
            'view_item'           => __( 'View Item', 'medicare' ),
            'add_new_item'        => __( 'Add New Item', 'medicare' ),
            'add_new'             => __( 'Add New', 'medicare' ),
            'edit_item'           => __( 'Edit Item', 'medicare' ),
            'update_item'         => __( 'Update Item', 'medicare' ),
            'search_items'        => __( 'Search Item', 'medicare' ),
            'not_found'           => __( 'Not found', 'medicare' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'medicare' ),
    );
    $args = array(
            'label'               => __( 'Doctor', 'medicare' ),
            'description'         => __( 'Doctor Description', 'medicare' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions' ),
            'taxonomies'          => array( 'doctor_category', 'doctor_department', 'doctor_tag' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-pressthis',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
    );
    
    if(function_exists('custom_reg_post_type')) {
        custom_reg_post_type( 'doctor', $args );
    }
    
}

// Hook into the 'init' action
add_action( 'init', 'tb_add_post_type_doctor', 0 );
