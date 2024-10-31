jQuery(document).ready(function() {
    jQuery('.phonering-alo-ph-img-circle').on('click', function(e) {
    	jQuery('.odk-wrap-call-action').show();
    	jQuery('.odk-wrap-call-action-backgroup').show();
    });

    jQuery('.odk-wrap-call-close').on('click', function(e) {
    	jQuery('.odk-wrap-call-action').hide();
    	jQuery('.odk-wrap-call-action-backgroup').hide();
    });
});