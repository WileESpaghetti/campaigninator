<!--
    TODO
    show errors when required fields are empty or invalid
-->
<?php add_thickbox() ?>
<div style="display:none" id="campaigninator_generator">
    <form
        id="campaiginator_google_analytics_campaign_generator"
        class="js-campaiginator_google_analytics_campaign_generator"
        name="campaiginator_google_analytics_campaign_generator"
    >
        <input id="campaigninator_post_id" name="campaigninator_post_id" type="hidden" value="<?php print(get_the_ID()) ?>">

        <p class="alternate">
            <label>
                <?php _e('Destination URL', 'campaigninator') ?>
            </label>

            <br>

            <a href="<?php the_permalink() ?>"><?php the_permalink() ?></a>
        </p>
        
        <p>
            <label>
                <?php _e('Preset', 'campaigninator'); ?><br>
                <select>
                    <option>
                        <!-- FIXME blanks all of the fields -->
                    </option>
                    <option>
                        <?php _e('Default', 'campaigninator'); ?>
                    </option>
                </select>
            </label>
            
            <span class="description"><br>
                <?php _e('Fill out campaign with preset values', 'campaigninator') ?>
            </span>
        </p>

        <p class="alternate">
            <label>
                <?php _e('Campaign *', 'campaigninator'); ?><br>
                <input class="regular-text" id="campaigninator_utm_name" name="campaigninator_utm_name"
                       placeholder="<?php _e('Why are they coming to you?', 'campaigninator') ?>">
            </label>
            
            <br>
            
            <span class="description">
                <?php _e('The individual campaign name, slogan, promo code, etc. for a product.', 'campaigninator') ?>
            </span>
        </p>

        <p>
            <label>
                <?php _e('Source *', 'campaigninator'); ?><br>
                <input class="regular-text" id="campaigninator_utm_source" name="campaigninator_utm_source"
                       placeholder="<?php _e('Where are they coming from?', 'campaigninator') ?>">
            </label>
            
            <br>
            
            <span class="description">
                <?php _e('Identify the advertiser, site, publication, etc. that is sending traffic to your property, ' .
                    'for example: google, newsletter4, billboard.', 'campaigninator'); ?>
            </span>
        </p>

        <p class="alternate">
            <label>
                <?php _e('Medium *', 'campaigninator'); ?><br>
                <input class="regular-text" id="campaigninator_utm_medium" name="campaigninator_utm_medium"
                       placeholder="<?php _e('How are they getting to you?', 'campaigninator') ?>">
            </label>
            
            <br>
            
            <span class="description">
                <?php _e('The advertising or marketing medium, example: banner or email newsletter.', 'campaigninator') ?>
            </span>
        </p>

        <p>
            <label>
                <?php _e('Term', 'campaigninator'); ?><br>
                <input class="regular-text" id="campaigninator_utm_term"name="campaigninator_utm_term"
                       placeholder="<?php _e('Used to identify PPC keyword', 'campaigninator') ?>">
            </label>
            
            <br>
            
            <span class="description">
                <?php _e('Identify paid search keywords. If you\'re manually tagging paid keyword campaigns, you should ' .
                    'also use utm_term to specify the keyword.', 'campaigninator') ?>
            </span>
        </p>

        <p class="alternate">
            <label>
                <?php _e('Content', 'campaigninator'); ?><br>
                <input class="regular-text" id="campaigninator_utm_content" name="campaigninator_utm_content"
                       placeholder="<?php _e('Different ads or place on the page', 'campaigninator') ?>">
            </label>
            
            <br>
            
            <span class="description">
                <?php _e('Used to differentiate similar content, or links within the same ad. For example, if you ' .
                    'have two call-to-action links within the same email message, you can use utm_content and set ' .
                    'different values for each so you can tell which version is more effective', 'campaigninator') ?>
            </span>
        </p>

        <p>
            <!-- FIXME not sure if this is best at the top or bottom of the URL builder -->
            <label>
                <?php _e('Preview', 'campaigninator') ?>
            </label>
            
            <br>

            <a href="<?php the_permalink() ?>"><?php the_permalink() ?></a>
            <!-- TODO link does not reflect changes in filled out text boxes -->
            <!-- TODO add buttons for copy -->
        </p>

        <!-- TODO add waiting animation similar to "update" button -->
        <span class="spinner"></span>
        <input name="campaigninator_google_campaign_save_preset" id="campaigninator_google_campaign_save_preset" class="js-campaigninator_google_campaign_save_preset button button-large" type="submit" value="Save as preset">

        <span class="spinner" id="spinner_save_campaign"></span>
        <input name="campaigninator_google_campaign_submit" id="campaigninator_google_campaign_submit" class="js-campaigninator_google_campaign_submit button button-primary button-large" type="submit" value="Add campaign">
    </form>
</div>