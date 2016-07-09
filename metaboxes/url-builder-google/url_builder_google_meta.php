<?php
// FIXME needs to update campaign urls when permalink changes
// FIXME ensure duplicate campaign links are not stored

add_action( 'add_meta_boxes', 'campaigninator_on_add_meta_boxes' );
add_action( 'save_post', 'campaigninator_on_save_post_class_meta', 10, 2 );
add_action( 'admin_enqueue_scripts', 'campaigninator_on_admin_enqueue_scripts' );

function campaigninator_on_admin_enqueue_scripts() {
    wp_register_script( 'campaigninator-url-builder-google-meta', CAMPAIGNINATOR_URL . 'metaboxes/url-builder-google/url_builder_google_meta.js', array('jquery-ui-autocomplete'), CAMPAIGNINATOR_VERSION, true );
    
    wp_enqueue_script(  'campaigninator-url-builder-google-meta' );
}

function campaigninator_on_add_meta_boxes() {
    add_meta_box(
        'campaigninator_url_builder_google_meta',
        __( 'Google Campaign Generator', 'campaigninator' ),
        'campaigninator_url_builder_google_meta_meta_callback',
        'post',// FIXME loop through all post types
        'normal',
        'high'
    );
}

function campaigninator_url_builder_google_meta_meta_callback( $post ) {
//    wp_nonce_field( 'ypkword_entry_audio_meta_on_save', 'ypkword_entry_translation_meta_box_nonce' );
    require( CAMPAIGNINATOR_PATH . 'metaboxes/url-builder-google/url_builder_google_meta.tpl.php' );
}

function campaigninator_on_save_post_class_meta( $post_id, $post ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

//    if ( empty( $_POST['campaigninator_url_builder_google_meta_box_nonce'] ) ) {
//        return;
//    }

//    if ( ! wp_verify_nonce( $_POST['campaigninator_url_builder_google_meta_box_nonce'], 'campaigninator_url_builder_google_meta_on_save' ) ) {
//        return;
//    }

//    $postTypeCorrect = isset( $_POST['post_type'] ) && 'campaigninator_link' != $_POST['post_type'];
//    if ( ! $postTypeCorrect ) {
//        return;
//    }

    // Check the user's permissions.
    // TODO use constant/custom capabilities array
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['campaigninator_utm_name'] ) ) {
        $name = sanitize_text_field( $_POST['campaigninator_utm_name'] );
        
        // FIXME refactor this into it's own logic
        
        $utmTerms = array_filter(explode(',', sanitize_text_field($_POST['campaigninator_utm_term']))); // FIXME does this trim?
        // FIXME EMD

        if ( empty( $name ) ) {
//            delete_post_meta( $post_id, 'campaigninator_utm_name' );
        } else {
//            add_post_meta(    $post_id, 'campaigninator_utm_name', $name, true );
//            update_post_meta( $post_id, 'campaigninator_utm_name', $name );
            remove_action('save_post', 'campaigninator_on_save_post_class_meta');
            wp_insert_post(array(
                "post_title" => $name,
                "post_content" => "",
                "post_type" => "campaigninator_link",
                "post_status" => "publish",
                "meta_input" => array(
                    "campaigninator_post_id" => $post_id
                ),
                "tax_input" => array(
                    "n8r_utm_term" => $utmTerms
                )
            ));
            add_action( 'save_post', 'campaigninator_on_save_post_class_meta', 10, 2 );
        }
    }
}

add_action( 'wp_ajax_campaigninator_add_link_google_analytics', 'campaigninator_add_link_google_analytics');
function campaigninator_add_link_google_analytics() {
//    campaigninator_utm_name // FIXME possible duplicate date (campaign)
//    campaigninator_utm_source*
//    campaigninator_utm_medium*
//    campaigninator_utm_campaign* // todo post name
//    campaigninator_utm_term
//    campaigninator_utm_content
    $campaign = array();
    $utmTerms = array();
    $json = ! empty( $_REQUEST['json'] ); // New-style request

//    FIXME check nonce
//    if ( ! isset( $_POST['yupword_audio_meta_box_nonce'] ) ) {
//        return;
//    }
//
//    if ( ! wp_verify_nonce( $_POST['yupword_audio_meta_box_nonce'], 'yupword_audio_meta_box_save' ) ) {
//        return;
//    }

    if ( ! isset( $_POST['post_id'] ) ) {
        wp_die( -1 );
    }

    $post_id = intval( $_POST['post_id'] );
    if ($post_id < 1) {
        wp_die( -1 ); // invalid post id
    }
    $campaign['campaigninator_post_id'] = $post_id;

    // QUESTION: may need to move this to the init action? (http://clivern.com/how-to-secure-wordpress-plugins/)
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        wp_die(-1);
    }

    if (! isset($_POST['campaigninator_utm_name'])) {
        // required field missing
        wp_die( -1 );
    }
    $campaign['campaigninator_utm_name'] = sanitize_text_field($_POST['campaigninator_utm_name']);

    if (! isset($_POST['campaigninator_utm_source'])) {
        // required field missing
        wp_die( -1 );
    }
    $campaign['campaigninator_utm_source'] = sanitize_text_field($_POST['campaigninator_utm_source']);

    if (! isset($_POST['campaigninator_utm_medium'])) {
        // required field missing
        wp_die( -1 );
    }
    $campaign['campaigninator_utm_medium'] = sanitize_text_field($_POST['campaigninator_utm_medium']);

    if (! isset($_POST['campaigninator_utm_campaign'])) {
        // required field missing
        wp_die( -1 );
    }
    $campaign['campaigninator_utm_campaign'] = sanitize_text_field($_POST['campaigninator_utm_campaign']);
    
    
    // FIXME isset check
    $campaign['campaigninator_utm_term'] = sanitize_text_field($_POST['campaigninator_utm_term']);
    $utmTerms = array_filter(explode(',', $campaign['campaigninator_utm_term'])); // FIXME does this trim?
    unset($campaign['campaigninator_utm_term']);

    // FIXME isset check
    $campaign['campaigninator_utm_content'] = sanitize_text_field($_POST['campaigninator_utm_content']);
    


// TODO delete request
//    if ( empty($audioUrl) ) {
//        $deleteMetaSuccessful = delete_post_meta($post_id, 'ypkword_audio_id');
//        if ( $deleteMetaSuccessful ) {
//            $return = '';
//            $json ? wp_send_json_success( $return ) : wp_die( $return );
//        } else {
//            wp_die( 0 );
//        }
//    }
    
    remove_action('save_post', 'campaigninator_on_save_post_class_meta');
    $return = wp_insert_post(array( // FIXME not sure what the actual return value is
        "post_title" => $name,
        "post_content" => "",
        "post_type" => "campaigninator_link",
        "post_status" => "publish",
        "meta_input" => $campaign,
        "tax_input" => array(
            "n8r_utm_term" => $utmTerms
        )
    ));
    add_action( 'save_post', 'campaigninator_on_save_post_class_meta', 10, 2 );

    $json ? wp_send_json_success( $return ) : wp_die( $return );

    wp_die( 0 );
}
