
jQuery(document).ready(function () {

    jQuery('#list').click(function (event) {
        event.preventDefault();
        // jQuery('.event-list-styles.event-list-style-4').removeClass('events-grid-group-item');
		
        jQuery('.event-list-styles.event-list-style-4').addClass('events-hiden');
		jQuery('.event-list-styles.event-list-style-4.events-list-group-item').removeClass('events-hiden');
		 jQuery('.event-header-list').removeClass('events-hidens');
    });
    jQuery('#grid').click(function (event) {
        event.preventDefault();
			
        jQuery('.event-list-styles.event-list-style-4').removeClass('events-hiden');
		jQuery('.event-list-styles.event-list-style-4.events-list-group-item').addClass('events-hiden');
		 jQuery('.event-header-list').addClass('events-hidens');
        // jQuery('.event-list-styles.event-list-style-4').addClass('events-grid-group-item');
    });

    jQuery('#list_active').click(function (event) {
        event.preventDefault();
        // jQuery('.event-list-styles.event-list-style-4').removeClass('events-grid-group-item');
       jQuery('.event-list-styles.event-list-style-4').addClass('events-hiden');
		jQuery('.event-list-styles.event-list-style-4.events-list-group-item').removeClass('events-hiden');
		 jQuery('.event-header-list').removeClass('events-hidens');
    });
    jQuery('#grid_active').click(function (event) {
        event.preventDefault();
        jQuery('.event-list-styles.event-list-style-4').removeClass('events-hiden');
		jQuery('.event-list-styles.event-list-style-4.events-list-group-item').addClass('events-hiden');
			 jQuery('.event-header-list').addClass('events-hidens');
        // jQuery('.event-list-styles.event-list-style-4').addClass('events-grid-group-item');
    });


    jQuery('#list_upcoming').click(function (event) {
        event.preventDefault();
        // jQuery('.event-list-styles.event-list-style-4').removeClass('events-grid-group-item');
        jQuery('.event-list-styles.event-list-style-4').addClass('events-hiden');
		jQuery('.event-list-styles.event-list-style-4.events-list-group-item').removeClass('events-hiden');
		 jQuery('.event-header-list').removeClass('events-hidens');
    });
    jQuery('#grid_upcoming').click(function (event) {
        event.preventDefault();
        jQuery('.event-list-styles.event-list-style-4').removeClass('events-hiden');
		jQuery('.event-list-styles.event-list-style-4.events-list-group-item').addClass('events-hiden');
			 jQuery('.event-header-list').addClass('events-hidens');
        // jQuery('.event-list-styles.event-list-style-4').addClass('events-grid-group-item');
    });


    jQuery('#list_past').click(function (event) {
        event.preventDefault();
        // jQuery('.event-list-styles.event-list-style-4').removeClass('events-grid-group-item');
        jQuery('.event-list-styles.event-list-style-4').addClass('events-hiden');
		jQuery('.event-list-styles.event-list-style-4.events-list-group-item').removeClass('events-hiden');
		 jQuery('.event-header-list').removeClass('events-hidens');
    });
    jQuery('#grid_past').click(function (event) {
        event.preventDefault();
        jQuery('.event-list-styles.event-list-style-4').removeClass('events-hiden');
		jQuery('.event-list-styles.event-list-style-4.events-list-group-item').addClass('events-hiden');
			 jQuery('.event-header-list').addClass('events-hidens');
        // jQuery('.event-list-styles.event-list-style-4').addClass('events-grid-group-item');
    });


});