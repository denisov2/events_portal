<?php
add_action('wp_enqueue_scripts', 'eventchamp_enqueue_styles');

function eventchamp_enqueue_styles()
{
    wp_enqueue_style('eventchamp-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('eventchamp-child-style', get_stylesheet_directory_uri() . '/style.css');

}

function add_custom_scripts()
{
    $scriptSrc = get_stylesheet_directory_uri() . '/grig_list.js';
    wp_enqueue_script('custom_scripts', $scriptSrc, array(), '1.0', false);
    $scriptSrc = get_stylesheet_directory_uri() . '/add_event_team.js';
    wp_enqueue_script('add_event_team', $scriptSrc, array(), '1.0', false);

    wp_enqueue_script("jquery-ui.js", 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.js', array('jquery'), '1.8.8');
}

add_action('wp_enqueue_scripts', 'add_custom_scripts');


require_once get_theme_file_path('/include/eventchamp_categorized_events_output.php');
require_once get_theme_file_path('/include/eventchamp_home_events_output.php');
require_once get_theme_file_path('/include/eventchamp_search_events_output.php');
require_once get_theme_file_path('/include/eventchamp_event_list_style_4_new.php');

add_shortcode("eventchamp_categorized_events_new", "eventchamp_categorized_events_output_new");
add_shortcode("eventchamp_home_events_output", "eventchamp_home_events_output");


/*====== Tags ======*/

function event_tags()
{
    $labels = array(
        'name' => _x('Platforms', 'Tags General Name', 'eventchamp'),
        'singular_name' => _x('Platforms', 'Tags Singular Name', 'eventchamp'),
        'menu_name' => esc_html__('Platforms', 'eventchamp'),
        'all_items' => esc_html__('All Platforms', 'eventchamp'),
        'parent_item' => esc_html__('Parent Platform', 'eventchamp'),
        'parent_item_colon' => esc_html__('Parent Platform Tag:', 'eventchamp'),
        'new_item_name' => esc_html__('New Platform Tag', 'eventchamp'),
        'add_new_item' => esc_html__('Add Platform Tag', 'eventchamp'),
        'edit_item' => esc_html__('Edit Platform Tag', 'eventchamp'),
        'view_item' => esc_html__('View Platform Tag', 'eventchamp'),
        'update_item' => esc_html__('Update Platform Tag', 'eventchamp'),
        'separate_items_with_commas' => esc_html__('Separate tags with commas', 'eventchamp'),
        'search_items' => esc_html__('Search Platform Tags', 'eventchamp'),
        'add_or_remove_items' => esc_html__('Add or remove platform tag', 'eventchamp'),
        'choose_from_most_used' => esc_html__('Choose from the most used platform tag', 'eventchamp'),
        'not_found' => esc_html__('Not Found', 'eventchamp'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => false,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('event_tags', array('event', 'venue'), $args);

}


vc_map(array(
    "name" => esc_html__('Categorized Events New Design', 'eventchamp'),
    "base" => "eventchamp_categorized_events_new",
    "category" => esc_html__('Event Champ Theme', 'eventchamp'),
    "icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-categorized-events.jpg',
    "description" => esc_html__('Categorized Events element.', 'eventchamp'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Event Count", 'eventchamp'),
            "description" => esc_html__('You can enter event count for each tab.', 'eventchamp'),
            "param_name" => "eventcount",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Exclude Categories', 'eventchamp'),
            "description" => esc_html__('You can enter categories ids. Separate with commas 1,2,3 etc.', 'eventchamp'),
            "param_name" => "excludecategories",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Include Categories', 'eventchamp'),
            "description" => esc_html__('You can enter categories ids. Separate with commas 1,2,3 etc.', 'eventchamp'),
            "param_name" => "includecategories",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Exclude Events', 'eventchamp'),
            "description" => esc_html__('You can enter event ids. Separate with commas 1,2,3 etc.', 'eventchamp'),
            "param_name" => "excludeevents",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Offset', 'eventchamp'),
            "description" => esc_html__('You can enter offset number.', 'eventchamp'),
            "param_name" => "offset",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Order Type', 'eventchamp'),
            "description" => esc_html__('You can select order type.', 'eventchamp'),
            "param_name" => "ordertype",
            'save_always' => true,
            "group" => esc_html__('General', 'eventchamp'),
            'value' => array(
                esc_html__('DESC', 'eventchamp') => 'DESC',
                esc_html__('ASC', 'eventchamp') => 'ASC',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Event ICO Status ', 'eventchamp'),
            "description" => esc_html__('Active/Upcomming/past', 'eventchamp'),
            "param_name" => "ico_status",
            'save_always' => true,
            "group" => esc_html__('General', 'eventchamp'),
            'value' => array(

                esc_html__('all', 'eventchamp') => 'all',
                esc_html__('active', 'eventchamp') => 'active',
                esc_html__('upcoming', 'eventchamp') => 'upcoming',
                esc_html__('past', 'eventchamp') => 'past',
            ),
        ),

        array(
            "type" => "dropdown",
            "heading" => esc_html__('Sort By', 'eventchamp'),
            "description" => esc_html__('You can select sort type.', 'eventchamp'),
            "param_name" => "sortby",
            'save_always' => true,
            "group" => esc_html__('General', 'eventchamp'),
            'value' => array(
                esc_html__('Added Date', 'eventchamp') => 'addeddate',
                esc_html__('Upcoming Events', 'eventchamp') => 'upcomingevents',
                esc_html__('Name', 'eventchamp') => 'name',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Hide Expired Events', 'eventchamp'),
            "description" => esc_html__('You can hide expired events.', 'eventchamp'),
            "param_name" => "hideexpired",
            "group" => esc_html__('General', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('List Style', 'eventchamp'),
            "description" => esc_html__('You can select list style.', 'eventchamp'),
            "param_name" => "style",
            'save_always' => true,
            "group" => esc_html__('Design', 'eventchamp'),
            'value' => array(
                esc_html__('Style 1', 'eventchamp') => 'style1',
                esc_html__('Style 2', 'eventchamp') => 'style2',
                esc_html__('Style 3', 'eventchamp') => 'style3',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('All Events Button', 'eventchamp'),
            "description" => esc_html__('You can active all events button.', 'eventchamp'),
            "param_name" => "allbutton",
            'save_always' => true,
            "group" => esc_html__('Design', 'eventchamp'),
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('All Events Tab', 'eventchamp'),
            "description" => esc_html__('You can active all events tab.', 'eventchamp'),
            "param_name" => "alleventstab",
            'save_always' => true,
            "group" => esc_html__('Design', 'eventchamp'),
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Price', 'eventchamp'),
            "description" => esc_html__('You can active event price.', 'eventchamp'),
            "param_name" => "price",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Status', 'eventchamp'),
            "description" => esc_html__('You can active event status.', 'eventchamp'),
            "param_name" => "status",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Category', 'eventchamp'),
            "description" => esc_html__('You can active event category.', 'eventchamp'),
            "param_name" => "category",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Location', 'eventchamp'),
            "description" => esc_html__('You can active event location.', 'eventchamp'),
            "param_name" => "location",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Date', 'eventchamp'),
            "description" => esc_html__('You can active event date.', 'eventchamp'),
            "param_name" => "date",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Excerpt', 'eventchamp'),
            "description" => esc_html__('You can active event excerpt.', 'eventchamp'),
            "param_name" => "excerpt",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
    ),
));

vc_map(array(
    "name" => esc_html__('Categorized Events Home', 'eventchamp'),
    "base" => "eventchamp_home_events_output",
    "category" => esc_html__('Event Champ Theme', 'eventchamp'),
    "icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-categorized-events.jpg',
    "description" => esc_html__('Categorized Events element.', 'eventchamp'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Event Count", 'eventchamp'),
            "description" => esc_html__('You can enter event count for each tab.', 'eventchamp'),
            "param_name" => "eventcount",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Exclude Categories', 'eventchamp'),
            "description" => esc_html__('You can enter categories ids. Separate with commas 1,2,3 etc.', 'eventchamp'),
            "param_name" => "excludecategories",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Include Categories', 'eventchamp'),
            "description" => esc_html__('You can enter categories ids. Separate with commas 1,2,3 etc.', 'eventchamp'),
            "param_name" => "includecategories",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Exclude Events', 'eventchamp'),
            "description" => esc_html__('You can enter event ids. Separate with commas 1,2,3 etc.', 'eventchamp'),
            "param_name" => "excludeevents",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Offset', 'eventchamp'),
            "description" => esc_html__('You can enter offset number.', 'eventchamp'),
            "param_name" => "offset",
            "group" => esc_html__('General', 'eventchamp'),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Order Type', 'eventchamp'),
            "description" => esc_html__('You can select order type.', 'eventchamp'),
            "param_name" => "ordertype",
            'save_always' => true,
            "group" => esc_html__('General', 'eventchamp'),
            'value' => array(
                esc_html__('DESC', 'eventchamp') => 'DESC',
                esc_html__('ASC', 'eventchamp') => 'ASC',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Event ICO Status ', 'eventchamp'),
            "description" => esc_html__('Active/Upcomming/past', 'eventchamp'),
            "param_name" => "ico_status",
            'save_always' => true,
            "group" => esc_html__('General', 'eventchamp'),
            'value' => array(

                esc_html__('all', 'eventchamp') => 'all',
                esc_html__('active', 'eventchamp') => 'active',
                esc_html__('upcoming', 'eventchamp') => 'upcoming',
                esc_html__('past', 'eventchamp') => 'past',
            ),
        ),

        array(
            "type" => "dropdown",
            "heading" => esc_html__('Sort By', 'eventchamp'),
            "description" => esc_html__('You can select sort type.', 'eventchamp'),
            "param_name" => "sortby",
            'save_always' => true,
            "group" => esc_html__('General', 'eventchamp'),
            'value' => array(
                esc_html__('Added Date', 'eventchamp') => 'addeddate',
                esc_html__('Upcoming Events', 'eventchamp') => 'upcomingevents',
                esc_html__('Name', 'eventchamp') => 'name',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Hide Expired Events', 'eventchamp'),
            "description" => esc_html__('You can hide expired events.', 'eventchamp'),
            "param_name" => "hideexpired",
            "group" => esc_html__('General', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('List Style', 'eventchamp'),
            "description" => esc_html__('You can select list style.', 'eventchamp'),
            "param_name" => "style",
            'save_always' => true,
            "group" => esc_html__('Design', 'eventchamp'),
            'value' => array(
                esc_html__('Style 1', 'eventchamp') => 'style1',
                esc_html__('Style 2', 'eventchamp') => 'style2',
                esc_html__('Style 3', 'eventchamp') => 'style3',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('All Events Button', 'eventchamp'),
            "description" => esc_html__('You can active all events button.', 'eventchamp'),
            "param_name" => "allbutton",
            'save_always' => true,
            "group" => esc_html__('Design', 'eventchamp'),
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('All Events Tab', 'eventchamp'),
            "description" => esc_html__('You can active all events tab.', 'eventchamp'),
            "param_name" => "alleventstab",
            'save_always' => true,
            "group" => esc_html__('Design', 'eventchamp'),
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Price', 'eventchamp'),
            "description" => esc_html__('You can active event price.', 'eventchamp'),
            "param_name" => "price",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Status', 'eventchamp'),
            "description" => esc_html__('You can active event status.', 'eventchamp'),
            "param_name" => "status",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Category', 'eventchamp'),
            "description" => esc_html__('You can active event category.', 'eventchamp'),
            "param_name" => "category",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Location', 'eventchamp'),
            "description" => esc_html__('You can active event location.', 'eventchamp'),
            "param_name" => "location",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Date', 'eventchamp'),
            "description" => esc_html__('You can active event date.', 'eventchamp'),
            "param_name" => "date",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Excerpt', 'eventchamp'),
            "description" => esc_html__('You can active event excerpt.', 'eventchamp'),
            "param_name" => "excerpt",
            "group" => esc_html__('Design', 'eventchamp'),
            'save_always' => true,
            'value' => array(
                esc_html__('False', 'eventchamp') => 'false',
                esc_html__('True', 'eventchamp') => 'true',
            ),
        ),
    ),
));


require get_theme_file_path('/include/core.php');

//������
register_sidebar(array(
    'name' => 'Footer Sidebar 1',
    'id' => 'footer-sidebar-1',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
));
register_sidebar(array(
    'name' => 'Footer Sidebar 2',
    'id' => 'footer-sidebar-2',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
));
register_sidebar(array(
    'name' => 'Footer Sidebar 3',
    'id' => 'footer-sidebar-3',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
));
register_sidebar(array(
    'name' => 'Footer Sidebar 4',
    'id' => 'footer-sidebar-4',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
));