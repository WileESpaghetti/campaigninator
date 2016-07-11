<?php
add_action( 'init', 'campaigninator_tax_utm_term', 0 );

// Register Custom Taxonomy
function campaigninator_tax_utm_term() {

    $labels = array(
        'name'                       => _x( 'Campaign Terms', 'Taxonomy General Name', 'campaigninator' ),
        'singular_name'              => _x( 'Campaign Term', 'Taxonomy Singular Name', 'campaigninator' ),
        'menu_name'                  => __( 'Campaign Terms', 'campaigninator' ),
        'all_items'                  => __( 'All Items', 'campaigninator' ),
        'parent_item'                => __( 'Parent Item', 'campaigninator' ),
        'parent_item_colon'          => __( 'Parent Item:', 'campaigninator' ),
        'new_item_name'              => __( 'New Item Name', 'campaigninator' ),
        'add_new_item'               => __( 'Add New Item', 'campaigninator' ),
        'edit_item'                  => __( 'Edit Item', 'campaigninator' ),
        'update_item'                => __( 'Update Item', 'campaigninator' ),
        'view_item'                  => __( 'View Item', 'campaigninator' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'campaigninator' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'campaigninator' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'campaigninator' ),
        'popular_items'              => __( 'Popular Items', 'campaigninator' ),
        'search_items'               => __( 'Search Items', 'campaigninator' ),
        'not_found'                  => __( 'Not Found', 'campaigninator' ),
        'no_terms'                   => __( 'No items', 'campaigninator' ),
        'items_list'                 => __( 'Items list', 'campaigninator' ),
        'items_list_navigation'      => __( 'Items list navigation', 'campaigninator' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => false,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'rewrite'                    => true,
    );
    register_taxonomy( 'n8r_utm_term', array( 'campaigninator_link' ), $args );

}
