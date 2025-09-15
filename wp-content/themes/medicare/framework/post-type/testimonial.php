<?php
// Register Custom Post Type
function tb_add_post_type_testimonial() {
    // Register taxonomy
    $labels = array(
            'name'              => _x( 'Testimonial Category', 'taxonomy general name', 'medicare' ),
            'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name', 'medicare' ),
            'search_items'      => __( 'Search Testimonial Category', 'medicare' ),
            'all_items'         => __( 'All Testimonial Category', 'medicare' ),
            'parent_item'       => __( 'Parent Testimonial Category', 'medicare' ),
            'parent_item_colon' => __( 'Parent Testimonial Category:', 'medicare' ),
            'edit_item'         => __( 'Edit Testimonial Category', 'medicare' ),
            'update_item'       => __( 'Update Testimonial Category', 'medicare' ),
            'add_new_item'      => __( 'Add New Testimonial Category', 'medicare' ),
            'new_item_name'     => __( 'New Testimonial Category Name', 'medicare' ),
            'menu_name'         => __( 'Testimonial Category', 'medicare' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'testimonial_category' ),
    );
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'testimonial_category', array( 'testimonial' ), $args );
    }
    //Register tags
    $labels = array(
            'name'              => _x( 'Testimonial Tag', 'taxonomy general name', 'medicare' ),
            'singular_name'     => _x( 'Testimonial Tag', 'taxonomy singular name', 'medicare' ),
            'search_items'      => __( 'Search Testimonial Tag', 'medicare' ),
            'all_items'         => __( 'All Testimonial Tag', 'medicare' ),
            'parent_item'       => __( 'Parent Testimonial Tag', 'medicare' ),
            'parent_item_colon' => __( 'Parent Testimonial Tag:', 'medicare' ),
            'edit_item'         => __( 'Edit Testimonial Tag', 'medicare' ),
            'update_item'       => __( 'Update Testimonial Tag', 'medicare' ),
            'add_new_item'      => __( 'Add New Testimonial Tag', 'medicare' ),
            'new_item_name'     => __( 'New Testimonial Tag Name', 'medicare' ),
            'menu_name'         => __( 'Testimonial Tag', 'medicare' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'testimonial_tag' ),
    );
    
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'testimonial_tag', array( 'testimonial' ), $args );
    }
    
    //Register post type Testimonial
    $labels = array(
            'name'                => _x( 'Testimonial', 'Post Type General Name', 'medicare' ),
            'singular_name'       => _x( 'Testimonial Item', 'Post Type Singular Name', 'medicare' ),
            'menu_name'           => __( 'Testimonial', 'medicare' ),
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
            'label'               => __( 'Testimonial', 'medicare' ),
            'description'         => __( 'Testimonial Description', 'medicare' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),
            'taxonomies'          => array( 'testimonial_category', 'testimonial_tag' ),
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
        custom_reg_post_type( 'testimonial', $args );
    }
    
}

// Hook into the 'init' action
add_action( 'init', 'tb_add_post_type_testimonial', 0 );
