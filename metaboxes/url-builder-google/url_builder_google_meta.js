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
        console.log($(id));
    }
    
    
    $(document).ready(function() {
        setSuggest('source');
        setSuggest('medium');
        setSuggest('term');
    });
}(jQuery, Campaigninator));
(function($, Campaigninator) {
    // FIXME reset form on thickbox close
    $(document).ready(function() {
        var url;
        
        var $buttonSaveCampaign;
        var $buttonSavePreset;
        var $spinnerSaveCampaign;
        var $spinnerSavePreset;
        var $linkPostId;
        var $postId;
        var $preview;
        var $utmContent;
        var $utmMedium;
        var $utmCampaign;
        var $utmSource;
        var $utmTerm;
        var $saveSuccess;
        var $saveError;
        // campaigninator_google_campaign_submit
        
        url = Campaigninator.ajaxUrl + '?action=campaigninator_add_link_google_analytics';
        
        function handleSave(event) {
            var data;

            $spinnerSaveCampaign.css('visibility', 'visible');
            $saveError.css('display', 'none');
            $saveSuccess.css('display', 'none');

            event.preventDefault();

            data = {
                campaigninator_link_post_id: $linkPostId.val(),
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
                var result = parseInt(response, 10);
                if (result  < 1 || isNaN(result)) {
                    $saveError.fadeIn();
                } else {
                    $saveSuccess.fadeIn();
                    tb_remove();
                    window.location.reload();
                }
            });
            return false;
        }

        function updatePreview() {
            var url;

            url = Campaigninator.postUrl +
                '?=utm_source='  + $utmSource.val()  +
                '&=utm_medium='  + $utmMedium.val()  +
                '&=utm_term='    + $utmTerm.val()    +
                '&=utm_content=' + $utmContent.val() +
                '&=utm_campaign='  + $utmCampaign.val();
            url = encodeURI(url);
            $preview.attr('href', url);
            $preview.html(url);
            // ?utm_source=multiple%20source&utm_medium=test%20medium&utm_term=test%20term&utm_content=test%20content&utm_campaign=test%20name-->
        }

        // FIXME suggestions don't show up when in modal dialog: z-index: 1000000 !important
        // FIXME kind of gimpy and looses keys a lot. might be better just to scrap
        // FIXME should be called from an $form.on('submit') but metaboxes strip out <form> tags
        $buttonSaveCampaign = $('.js-campaigninator_google_campaign_submit');
        $spinnerSaveCampaign = $('#spinner_save_campaign');
        $buttonSaveCampaign.on('click', handleSave);
        // $buttonSavePreset.on('click', handleSave);
        $linkPostId = $('#campaigninator_link_post_id');
        $postId = $('#campaigninator_post_id');
        $preview = $('#campaigninator_preview');
        $utmContent = $('#campaigninator_utm_content');
        $utmMedium = $('#campaigninator_utm_medium');
        $utmCampaign = $('#campaigninator_utm_campaign');
        $utmSource = $('#campaigninator_utm_source');
        $utmTerm = $('#campaigninator_utm_term');
        $saveError = $('.js-campaigninator-notice-error');
        $saveSuccess = $('.js-campaigninator-notice-success');
        
        
        $('body').on('thickbox:removed', function() {
            var wordPressDefaultPostId = 0;
            $linkPostId.val(wordPressDefaultPostId);
            $utmContent.val('');
            $utmMedium.val('');
            $utmCampaign.val('');
            $utmSource.val('');
            $utmTerm.val('');
            $saveSuccess.fadeOut();
            $saveError.fadeOut();
            $preview.attr('href', Campaigninator.postUrl);
            $preview.html(Campaigninator.postUrl);
        });


        $utmContent.on('keydown', updatePreview);
        $utmMedium.on('keydown',  updatePreview);
        $utmCampaign.on('keydown',    updatePreview);
        $utmSource.on('keydown',  updatePreview);
        $utmTerm.on('keydown',    updatePreview);

        $('.js-edit-button').on('click', function(event) {
            $link = $(event.target);
            $linkPostId.val($link.data('linkPostId'));
            $utmContent.val($link.data('utmContent'));
            $utmMedium.val($link.data('utmMedium'));
            $utmCampaign.val($link.data('utmCampaign'));
            $utmSource.val($link.data('utmSource'));
            $utmTerm.val($link.data('utmTerm'));
        });
        
        tb_position(); // make thickbox content full width
    });
}(jQuery, Campaigninator));
