<!--
FIXME need to add rel, title, etc. to link
FIXME add help or info to show description of url parameteters: https://support.google.com/analytics/answer/1033863#parameters
FIXME create post type for each URL type. post type has a 1:* POST:$SERVICE CAMPAIGN URLS
FIXME find out which of these are optional

TODO update preview link as you type
TODO maybe use the_permalink filter to add URL campaign parameters
TODO hide generator until someone clicks edit on an existing link, or clicks the add new button
TODO dropdown for campaign presets / should fill using tags from a link post that has a special "features" taxonomy that has the value of "preset" or something else, then we can just query posts to get a list of those
TODO should be able to have a default campaign to auto-fill values
TODO link should have a copy button
TODO link should have a delete button
TODO link should have an edit button
-->

<!--
utm_source: Identify the advertiser, site, publication, etc. that is sending traffic to your property, for example: google, newsletter4, billboard.
autofills: post title, but can override
required: true

utm_medium: The advertising or marketing medium, for example: cpc, banner, email newsletter.
autofills: site title, but can override
required: true

utm_campaign: The individual campaign name, slogan, promo code, etc. for a product.
autofills: maybe let you select from a list of previously made campaigns? possibly a campaign post taxonomy
required: true

utm_term: Identify paid search keywords. If you're manually tagging paid keyword campaigns, you should also use utm_term to specify the keyword.
autofills: maybe pull from tags/categories/yoast keywords
required: false

utm_content: Used to differentiate similar content, or links within the same ad. For example, if you have two call-to-action links within the same email message, you can use utm_content and set different values for each so you can tell which version is more effective
autofills: none
required: false
-->
<?php include_once(CAMPAIGNINATOR_PATH . 'metaboxes/url-builder-google/url_builder_google_generator_modal.tpl.php') ?>
<!-- TODO set custom height / width to 100% should work -->
<a class="thickbox hide-if-no-js taxonomy-add-new"
   href="#TB_inline?width=100%&height=100%&inlineId=campaigninator_generator"
   title="<?php _e('Create New Campaign', 'campaigninator') ?>">
    <?php _e('+ Create new campaign', 'campaigninator') ?>
</a>

<!--
TODO show list of exiting URLs and allow them to be edited
TODO each existing link should let you take the following actions: visit, edit, delete

TODO show an "Add new" button
-->

<?php
//Create an instance of our package class...
$testListTable = new CampaigninatorGoogleCampaignListTable();
//Fetch, prepare, sort, and filter our data...
$testListTable->prepare_items();

?>
    <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
    <form id="movies-filter" method="get">
        <!-- For plugins, we also need to ensure that the form posts back to our current page -->
<!--        <input type="hidden" name="page" value="--><?php //echo $_REQUEST['page'] ?><!--" />-->
        <!-- Now we can render the completed list table -->
        <?php $testListTable->display() ?>
    </form>
<?php
// FIXME pagination
// FIXME sorting
$links = new WP_Query(array(
    'post_type'  => 'campaigninator_link',
    "post_status" => "publish",
    "nopaging" => true,
	'meta_query' => array(
        array(
            'key'     => 'campaigninator_post_id',
            'value'   => array(get_the_ID()),
            'compare' => 'IN'
        )
    )
));

if ( $links->have_posts() ) {
    echo '<ul>';
    while ( $links->have_posts() ) {
        $links->the_post();
        printf('<li><a href="%s">%s</a></li>', get_the_permalink(), get_the_title());
    }
    echo '</ul>';
    // TODO add export / google sheets button
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata(); // FIXME does not reset to original post
//var_dump(get_the_title());