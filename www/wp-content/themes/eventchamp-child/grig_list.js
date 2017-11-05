
jQuery(document).ready(function () {

    jQuery('#list').click(function (event) {
        event.preventDefault();
        // jQuery('.event-list-styles.event-list-style-4').removeClass('events-grid-group-item');
        jQuery('.event-list-styles.event-list-style-4').addClass('events-list-group-item');
    });
    jQuery('#grid').click(function (event) {
        event.preventDefault();
        jQuery('.event-list-styles.event-list-style-4').removeClass('events-list-group-item');
        // jQuery('.event-list-styles.event-list-style-4').addClass('events-grid-group-item');
    });

    jQuery('#list_active').click(function (event) {
        event.preventDefault();
        // jQuery('.event-list-styles.event-list-style-4').removeClass('events-grid-group-item');
        jQuery('.event-list-styles.event-list-style-4').addClass('events-list-group-item');
    });
    jQuery('#grid_active').click(function (event) {
        event.preventDefault();
        jQuery('.event-list-styles.event-list-style-4').removeClass('events-list-group-item');
        // jQuery('.event-list-styles.event-list-style-4').addClass('events-grid-group-item');
    });


    jQuery('#list_upcoming').click(function (event) {
        event.preventDefault();
        // jQuery('.event-list-styles.event-list-style-4').removeClass('events-grid-group-item');
        jQuery('.event-list-styles.event-list-style-4').addClass('events-list-group-item');
    });
    jQuery('#grid_upcoming').click(function (event) {
        event.preventDefault();
        jQuery('.event-list-styles.event-list-style-4').removeClass('events-list-group-item');
        // jQuery('.event-list-styles.event-list-style-4').addClass('events-grid-group-item');
    });


    jQuery('#list_past').click(function (event) {
        event.preventDefault();
        // jQuery('.event-list-styles.event-list-style-4').removeClass('events-grid-group-item');
        jQuery('.event-list-styles.event-list-style-4').addClass('events-list-group-item');
    });
    jQuery('#grid_past').click(function (event) {
        event.preventDefault();
        jQuery('.event-list-styles.event-list-style-4').removeClass('events-list-group-item');
        // jQuery('.event-list-styles.event-list-style-4').addClass('events-grid-group-item');
    });


});