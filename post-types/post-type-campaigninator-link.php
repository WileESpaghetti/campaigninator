<?php
// Register Custom Post Type
add_action( 'init', 'campaigninator_link_post_type', 0 );

function campaigninator_link_post_type() {

    $labels = array(
        'name'                  => _x( 'Campaigninator Links', 'Post Type General Name', 'campaigninator' ),
        'singular_name'         => _x( 'Campaigninator Link', 'Post Type Singular Name', 'campaigninator' ),
        'menu_name'             => __( 'Campaigninator Link', 'campaigninator' ),
        'name_admin_bar'        => __( 'Campaigninator Link', 'campaigninator' ),
        'archives'              => __( 'Campaigninator Link Archives', 'campaigninator' ),
        'parent_item_colon'     => __( 'Parent Item:', 'campaigninator' ),
        'all_items'             => __( 'All Items', 'campaigninator' ),
        'add_new_item'          => __( 'Add New Item', 'campaigninator' ),
        'add_new'               => __( 'Add New', 'campaigninator' ),
        'new_item'              => __( 'New Item', 'campaigninator' ),
        'edit_item'             => __( 'Edit Item', 'campaigninator' ),
        'update_item'           => __( 'Update Item', 'campaigninator' ),
        'view_item'             => __( 'View Item', 'campaigninator' ),
        'search_items'          => __( 'Search Item', 'campaigninator' ),
        'not_found'             => __( 'Not found', 'campaigninator' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'campaigninator' ),
        'featured_image'        => __( 'Featured Image', 'campaigninator' ),
        'set_featured_image'    => __( 'Set featured image', 'campaigninator' ),
        'remove_featured_image' => __( 'Remove featured image', 'campaigninator' ),
        'use_featured_image'    => __( 'Use as featured image', 'campaigninator' ),
        'insert_into_item'      => __( 'Insert into item', 'campaigninator' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'campaigninator' ),
        'items_list'            => __( 'Items list', 'campaigninator' ),
        'items_list_navigation' => __( 'Items list navigation', 'campaigninator' ),
        'filter_items_list'     => __( 'Filter items list', 'campaigninator' ),
    );
    $args = array(
        'label'                 => __( 'Campaigninator Link', 'campaigninator' ),
        'description'           => __( 'Campaign Link', 'campaigninator' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'custom-fields', ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => false,
        'show_in_menu'          => false,
        'menu_position'         => 5,
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'rewrite'               => false,
        'capability_type'       => 'page',
    );
    register_post_type( 'campaigninator_link', $args );

}
