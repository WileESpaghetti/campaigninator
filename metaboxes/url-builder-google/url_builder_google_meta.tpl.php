<!--
FIXME need to add rel, title, etc. to link
FIXME add help or info to show description of url parameteters: https://support.google.com/analytics/answer/1033863#parameters
FIXME create post type for each URL type. post type has a 1:* POST:$SERVICE CAMPAIGN URLS
FIXME find out which of these are optional

TODO update preview link as you type
TODO maybe use the_permalink filter to add URL campaign parameters
TODO hide generator until someone clicks edit on an existing link, or clicks the add new button
TODO dropdown for campaign templates / should fill using tags from a link post that has a special "features" taxonomy that has the value of "template" or something else, then we can just query posts to get a list of those
TODO should be able to have a default campaign to auto-fill values
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
<form
    id="campaiginator_google_analytics_campaign_generator"
    class="js-campaiginator_google_analytics_campaign_generator"
    name="campaiginator_google_analytics_campaign_generator"
>
<p>
    <label>
        <?php _e('Campaign Name', 'campaigninator'); ?><br>
        <input id="FIXME" class="regular-text" name="campaigninator_utm_name" value="FIXME">
        <span class="description"><br>
            The individual campaign name, slogan, promo code, etc. for a product.
        </span>
    </label>
</p>

<p>
    <label>
        <?php _e('Campaign Source', 'campaigninator'); ?><br>
        <input id="FIXME" class="regular-text" name="FIXME" value="FIXME">
    </label><br>
    <span class="description">
        Identify the advertiser, site, publication, etc. that is sending traffic to your property, for example: google,
        newsletter4, billboard.
    </span>
</p>

<p>
    <label>
        <?php _e('Campaign Medium', 'campaigninator'); ?><br>
        <input id="FIXME" class="regular-text" name="FIXME" value="FIXME">
    </label><br>
    <span class="description">
        The advertising or marketing medium, for example: cpc, banner, email newsletter.
    </span>
</p>

<p>
    <label>
        <?php _e('Campaign Term', 'campaigninator'); ?><br>
        <input id="campaign_term" class="regular-text" name="FIXME" value="FIXME">
    </label><br>
    <span class="description">
        Identify paid search keywords. If you're manually tagging paid keyword campaigns, you should also use utm_term
        to specify the keyword.
    </span>
</p>

<p>
    <label>
        <?php _e('Campaign Content', 'campaigninator'); ?><br>
        <input id="FIXME" class="regular-text" name="FIXME" value="FIXME">
        <span class="description"><br>
            Used to differentiate similar content, or links within the same ad. For example, if you have two
            call-to-action links within the same email message, you can use utm_content and set different values for
            each so you can tell which version is more effective
        </span>
    </label>
</p>

<p>
    <!-- FIXME not sure if this is best at the top or bottom of the URL builder -->
    <label><?php _e('Preview', 'campaigninator') ?></label><br>
    <a href="<?php the_permalink() ?>"><?php the_permalink() ?></a>
</p>
    
    <input name="campaigninator_google_campaign_submit" id="campaigninator_google_campaign_submit" class="js-campaigninator_google_campaign_submit button button-primary button-large" type="submit" value="Add campaign">
</form>

<script>
    (function($) {
        $(document).ready(function() {
            var $form = $('.js-campaiginator_google_analytics_campaign_generator');
            var $addBtn = $('.js-campaigninator_google_campaign_submit');

            function handleSubmit(event) {
                event.preventDefault();
                alert('boo!');
                // TODO reset form on success
                return false;
            }

            // FIXME should be called from an $form.on('submit') but metaboxes strip out <form> tags
            $addBtn.on('click', handleSubmit);
        });
    }(jQuery));
</script>

<!--
TODO show list of exiting URLs and allow them to be edited
TODO each existing link should let you take the following actions: visit, edit, delete

TODO show an "Add new" button
-->

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
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata(); // FIXME does not reset to original post
var_dump(get_the_title());