(function($, Campaigninator) {
    function setSuggest(field) {
        var id = '#campaigninator_utm_' + field;
        var tax = 'n8r_utm_' + field;
        var url = Campaigninator.ajaxUrl + '?action=ajax-tag-search&tax=' + tax;
        var options = {
            multiple:false,
            multipleSep: ","
        };
        
        // FIXME prevent suggest from showing 0 if no matches are found
        $(id).suggest(url, options);
    }
    
    $(document).ready(function() {
        setSuggest('source');
        setSuggest('medium');
        setSuggest('term');
    });
}(jQuery, Campaigninator));
(function($, Campaigninator) {
    $(document).ready(function() {
        var url;
        
        var $buttonSaveCampaign;
        var $buttonSavePreset;
        var $spinnerSaveCampaign;
        var $spinnerSavePreset;
        var $postId;
        var $preview;
        var $utmContent;
        var $utmMedium;
        var $utmCampaign;
        var $utmSource;
        var $utmTerm;
        // campaigninator_google_campaign_submit
        
        url = Campaigninator.ajaxUrl + '?action=campaigninator_add_link_google_analytics';
        
        function handleSave(event) {
            var data;

            $spinnerSaveCampaign.css('visibility', 'visible');

            event.preventDefault();

            data = {
                campaigninator_post_id: $postId.val(),
                campaigninator_utm_content: $utmContent.val(),
                campaigninator_utm_medium: $utmMedium.val(),
                campaigninator_utm_campaign: $utmCampaign.val(),
                campaigninator_utm_source: $utmSource.val(),
                campaigninator_utm_term: $utmTerm.val()
            };

            $.post(url, data, function(response) {
                // TODO show brief success message then close thickbox
                console.log(response);
                $spinnerSaveCampaign.css('visibility', 'hidden');
            });
            return false;
            // TODO reset form on success
        }
        
        $buttonSaveCampaign = $('.js-campaigninator_google_campaign_submit');
        // FIXME should be called from an $form.on('submit') but metaboxes strip out <form> tags
        $spinnerSaveCampaign = $('#spinner_save_campaign');
        $buttonSaveCampaign.on('click', handleSave);
        $postId = $('#campaigninator_post_id');
        $preview = $('#campaigninator_preview');
        $utmContent = $('#campaigninator_utm_content');
        $utmMedium = $('#campaigninator_utm_medium');
        $utmCampaign = $('#campaigninator_utm_campaign');
        $utmSource = $('#campaigninator_utm_source');
        $utmTerm = $('#campaigninator_utm_term');


        // $buttonSavePreset.on('click', handleSave);
        function updatePreview() {
            var url;

            url = Campaigninator.postUrl +
                '?=utm_source='  + $utmSource.val()  +
                '?=utm_medium='  + $utmMedium.val()  +
                '?=utm_term='    + $utmTerm.val()    +
                '?=utm_content=' + $utmContent.val() +
                '?=utm_campaign='  + $utmCampaign.val();
            url = encodeURI(url);
            $preview.attr('href', url);
            $preview.html(url);
            // ?utm_source=multiple%20source&utm_medium=test%20medium&utm_term=test%20term&utm_content=test%20content&utm_campaign=test%20name-->
        }
        
        $utmContent.on('keydown', updatePreview);
        $utmMedium.on('keydown',  updatePreview);
        $utmCampaign.on('keydown',    updatePreview);
        $utmSource.on('keydown',  updatePreview);
        $utmTerm.on('keydown',    updatePreview);
    });
}(jQuery, Campaigninator));
