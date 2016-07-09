<?php
// Register hooks
add_action('admin_print_scripts', 'add_script');
add_action('admin_head', 'add_script_config');

/**
 * Add script to admin page
 */
function add_script() {
    // Build in tag auto complete script
    wp_enqueue_script( 'suggest' );
}

/**
 * add script to admin page
 */
function add_script_config() {
    ?>

    <script type="text/javascript" >
        // Function to add auto suggest
        function setSuggest(id) {
            jQuery('#' + id).suggest("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=n8r_utm_term", {multiple:false, multipleSep: ","});
        }
        
        jQuery(document).ready(function() {
            setSuggest('campaigninator_utm_term');
        });
    </script>
    <?php
}
?>
