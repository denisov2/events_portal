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

    wp_enqueue_script("jquery-ui.js",'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.js', array('jquery'), '1.8.8');
}

add_action('wp_enqueue_scripts', 'add_custom_scripts');




require_once get_theme_file_path('/include/eventchamp_categorized_events_output.php');
require_once get_theme_file_path('/include/eventchamp_home_events_output.php');
require_once get_theme_file_path('/include/eventchamp_search_events_output.php');

add_shortcode("eventchamp_categorized_events_new", "eventchamp_categorized_events_output_new");
add_shortcode("eventchamp_home_events_output", "eventchamp_home_events_output");

function eventchamp_event_list_style_4_new($post_id = "", $image = "", $category = "", $date = "", $location = "", $excerpt = "", $status = "", $price = "")
{

    if (!empty($post_id)) {

        $output = "";
        $output .= '<div class="event-list-styles event-list-style-4 ">';


        $event_adv = get_post_meta(get_the_ID(), 'event_adv', true);
        $output .= $event_adv ? ' <div class="event_adv"></div><div class="text_adv">Ad</div>  ' : "";

        $output .= $event_adv ? '<div class="content adv">' : '<div class="content">';
        $output .= '<div class="content_header">';

        if ($image == 'true') {
            if (has_post_thumbnail($post_id)) {
                $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'eventchamp-event-list');
            } else {
                $image_url = "";
            }

            if (!empty($image_url)) {
                $output .= '<div class="image">';
                $output .= '<img src="' . esc_url($image_url[0]) . '" alt="' . the_title_attribute(array('echo' => 0, 'post' => $post_id)) . '" />';
                $output .= '</div>';
            } else {
                $output .= '<div class="image">';
                $output .= '<img src="/wp-content/themes/eventchamp-child/No_image_available.svg" alt="' . the_title_attribute(array('echo' => 0, 'post' => $post_id)) . '" />';
                $output .= '</div>';
            }

        }


        $output .= '<div class="title"><a href="' . get_the_permalink($post_id) . '" title="' . the_title_attribute(array('echo' => 0, 'post' => $post_id)) . '">' . get_the_title($post_id) . '</a></div>';


        
$ratings_titles = [
    1 => 'Idea and market size',
    2 => 'Team',
    3 => 'Quality of website, marketing etc',
    4 => 'Development level',
    5 => 'Competition',
    6 => 'Investment security',
];

$rating_data = [];

foreach ($ratings_titles as $key => $value) {

     if (get_post_meta(get_the_ID(), 'event_rating_' . $key, true)) {

         $rating_data[$key] = get_post_meta(get_the_ID(), 'event_rating_' . $key, true);
     }
}


if (!empty ($rating_data)) {


    $sum = 0;

    foreach ($rating_data as $rating) $sum += $rating;
    //$rating_datas = (isset($rating_data));
    $rating_datas = count($rating_data);
    $average_rating = round($sum / $rating_datas , 1);

} else {
    $ratings_titles = ['No data' => 0];
    $average_rating = '?';

}
        $output .= '<div class="rating-circle">' . $average_rating . '</div>';

        $output .= '</div>';

        if ($date == 'true' or $category == 'true') {
            /*$event_cats = wp_get_post_terms($post_id, 'eventcat');*/
            $event_cats = wp_get_post_terms(get_the_ID(), 'eventcat');
            $event_location = get_post_meta(get_the_ID(), 'event_location', true);
            $event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true);
            $event_end_date = get_post_meta(get_the_ID(), 'event_end_date', true);
            if (!empty($event_cats)) {
                $output .= '<div class="details">';
                /* if ($category == 'true') {
                     if (!empty($event_cats)) {
                         $output .= '<div class="category"><ul class="post-categories">';
                         foreach ($event_cats as $event_cat) {
                             $output .= '<li><a href="' . get_term_link($event_cat->term_id) . '" title="' . esc_attr($event_cat->name) . '">' . esc_attr($event_cat->name) . '</a></li>';
                         }
                         $output .= '</ul></div>';
                     }
                 }*/
                if (!empty($event_cats)) {
                    foreach ($event_cats as $event_cat) {
                        $output .= '<div class="category"><ul class="post-categories">';
                        $output .= '<li><a href="' . get_term_link($event_cat->term_id) . '" title="' . esc_attr($event_cat->name) . '">' . esc_attr($event_cat->name) . '</a></li>';
                        $output .= '</ul></div>';
                    }
                }

                if ($location == 'true') {
                    if (!empty($event_location)) {
                        $location = get_term($event_location, 'location');
                        if (!empty($location)) {
                            $output .= '<div class="location">';
                            $output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
                            $output .= '<span>' . esc_attr($location->name) . '</span>';
                            $output .= '</div>';
                        }
                    }
                }

                $output .= '</div>';
            }
        }

        if ($excerpt == 'true') {
            $excerpt_content = get_the_excerpt();
            if (!empty($excerpt_content)) {
                $output .= '<div class="excerpt">' . get_the_excerpt() . '</div>';
            }
        }

        $date_now = date("Y-m-d");

        $datetime_start = new DateTime($event_start_date);
        $datetime_end = new DateTime($event_end_date);
        $datetime_now = new DateTime($date_now);

        $interval_days_left = $datetime_now->diff($datetime_end);
        $interval_days_past = $datetime_start->diff($datetime_now);
        $interval_days_all = $datetime_start->diff($datetime_end);

        $output .= "<div class='all_labels'>";
        $output .= "<div class='all_left_labels '>";

        if ($datetime_now >= $datetime_start && $datetime_now <= $datetime_end) {

            $border_left_width = intval($interval_days_past->days / $interval_days_all->days * 180, null);
            $output .= "<div class='left-label' style='border-left: solid #36a53e " . $border_left_width . "px;'>";
            $output .= "<div class='left-label-inside' >" . $interval_days_left->format('%r%a days') . "</div>";

        } else {
            $output .= "<div class='left-label' style='border-left: none'>";
            $output .= eventchamp_event_status($post_id);
        }


        $output .= "</div>";
        $output .= "<div class='left-labels'>" . $event_start_date . "</div>";
        $output .= "<div class='left-labelss'>" . $event_end_date . "</div>";
        $output .= "</div>";
        $output .= "<div class='all_right_labels '>";

        $official_web_site = get_post_meta(get_the_ID(), 'event_official_web_site', true);
        $social_media_twitter = get_post_meta(get_the_ID(), 'event_social_media_twitter', true);
        if (!empty($official_web_site)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($official_web_site) . "' class='officialsite' title='" . esc_html__('VISIT SITE', 'eventchamp') . "' target='_blank'><img src='/wp-content/themes/eventchamp-child/img/url.png'></img></a></div>";
        }

        if (!empty($social_media_twitter)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_twitter) . "' class='twitter' title='" . esc_html__('Twitter', 'eventchamp') . "' target='_blank'><img src='/wp-content/themes/eventchamp-child/img/soc.png'></img></a></div>";
        }

        $output .= "<div class='all_right_labels_paper'>";
        $output .= "</div>";
        $output .= "<div class='all_right_labels_soc'>";
        $output .= "</div>";
        $output .= '</div>';
        $output .= '</div>';
        $output .= "</div>";
        $output .= "</div>";


        /*list*/

        $output .= '<div class="event-list-styles event-list-style-4 events-list-group-item events-hiden">';


        $event_adv = get_post_meta(get_the_ID(), 'event_adv', true);
        $output .= $event_adv ? ' <div class="event_adv"></div><div class="text_adv">Ad</div>  ' : "";

        $output .= $event_adv ? '<div class="content adv">' : '<div class="content">';

        
$ratings_titles = [
    1 => 'Idea and market size',
    2 => 'Team',
    3 => 'Quality of website, marketing etc',
    4 => 'Development level',
    5 => 'Competition',
    6 => 'Investment security',
];

$rating_data = [];

foreach ($ratings_titles as $key => $value) {

     if (get_post_meta(get_the_ID(), 'event_rating_' . $key, true)) {

         $rating_data[$key] = get_post_meta(get_the_ID(), 'event_rating_' . $key, true);
     }
}


if (!empty ($rating_data)) {


    $sum = 0;

    foreach ($rating_data as $rating) $sum += $rating;
    //$rating_datas = (isset($rating_data));
    $rating_datas = count($rating_data);
    $average_rating = round($sum / $rating_datas , 1);

} else {
    $ratings_titles = ['No data' => 0];
    $average_rating = '?';

}
        $output .= '<div class="col-xs-12 col-md-4">';
        $output .= '<div class="ev_name">';
        $output .= '<div class="content_header">';
        if ($image == 'true') {
            if (has_post_thumbnail($post_id)) {
                $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'eventchamp-event-list');
            } else {
                $image_url = "";
            }

            if (!empty($image_url)) {
                $output .= '<div class="image">';
                $output .= '<img src="' . esc_url($image_url[0]) . '" alt="' . the_title_attribute(array('echo' => 0, 'post' => $post_id)) . '" />';
                $output .= '</div>';
            } else {
                $output .= '<div class="image">';
                $output .= '<img src="/wp-content/themes/eventchamp-child/No_image_available.svg" alt="' . the_title_attribute(array('echo' => 0, 'post' => $post_id)) . '" />';
                $output .= '</div>';
            }

        }


        $output .= '<div class="title"><a href="' . get_the_permalink($post_id) . '" title="' . the_title_attribute(array('echo' => 0, 'post' => $post_id)) . '">' . get_the_title($post_id) . '</a></div>';


        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="ev_cat">';
        if ($date == 'true' or $category == 'true') {

            $event_cats = wp_get_post_terms(get_the_ID(), 'eventcat');


            if (!empty($event_cats)) {
                $output .= '<div class="details">';

                if (!empty($event_cats)) {
                    foreach ($event_cats as $event_cat) {
                        $output .= '<div class="category"><ul class="post-categories">';
                        $output .= '<li><a href="' . get_term_link($event_cat->term_id) . '" title="' . esc_attr($event_cat->name) . '">' . esc_attr($event_cat->name) . '</a></li>';
                        $output .= '</ul></div>';
                    }
                }


                $output .= '</div>';
            }
        }
        $output .= '</div>';
        $output .= '</div>';

        $output .= '<div class="col-xs-12 col-md-5">';
        $output .= '<div class="ev_desc">';
        if ($excerpt == 'true') {
            $excerpt_content = get_the_excerpt();
            if (!empty($excerpt_content)) {
                $output .= '<div class="excerpt">' . get_the_excerpt() . '</div>';
            }
        }
        $output .= '</div>';
        $output .= '<div class="ev_date">';
        $date_now = date("Y-m-d");

        $datetime_start = new DateTime($event_start_date);
        $datetime_end = new DateTime($event_end_date);
        $datetime_now = new DateTime($date_now);

        $interval_days_left = $datetime_now->diff($datetime_end);
        $interval_days_past = $datetime_start->diff($datetime_now);
        $interval_days_all = $datetime_start->diff($datetime_end);

        $output .= "<div class='all_labels'>";
        $output .= "<div class='all_left_labels '>";
        $output .= "<div class='left-labels'>" . $event_start_date . "</div>";
        $output .= "<div class='left-labelss'>" . $event_end_date . "</div>";
        if ($datetime_now >= $datetime_start && $datetime_now <= $datetime_end) {

            $border_left_width = intval($interval_days_past->days / $interval_days_all->days * 180, null);
            $output .= "<div class='left-label' style='border-left: solid #36a53e " . $border_left_width . "px;'>";
            $output .= "<div class='left-label-inside' >" . $interval_days_left->format('%r%a days') . "</div>";

        } else {
            $output .= "<div class='left-label' style='border-left: none'>";
            $output .= eventchamp_event_status($post_id);
        }


        $output .= '</div></div></div></div></div>';

        $output .= '<div class="col-xs-12 col-md-3">';
        $output .= '<div class="ev_rating"><p><div class="rating-circle">' . $average_rating . '</div></p>';
        $output .= '<p>';
        if (!empty($location)) {
            $output .= '<div class="location">';
            $output .= '<span>' . esc_attr($location->name) . '</span>';
            $output .= '</div>';
        }
        $output .= '</p> </div>';
        $output .= '<div class="ev_links"><p>';
        $output .= '<div class="all_right_labels ">';

        $official_web_site = get_post_meta(get_the_ID(), 'event_official_web_site', true);
        $social_media_twitter = get_post_meta(get_the_ID(), 'event_social_media_twitter', true);
        if (!empty($official_web_site)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($official_web_site) . "' class='officialsite' title='" . esc_html__('VISIT SITE', 'eventchamp') . "' target='_blank'><img src='/wp-content/themes/eventchamp-child/img/url.png'></img></a></div>";
        }

        if (!empty($social_media_twitter)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_twitter) . "' class='twitter' title='" . esc_html__('Twitter', 'eventchamp') . "' target='_blank'><img src='/wp-content/themes/eventchamp-child/img/soc.png'></img></a></div>";
        }

        $output .= "<div class='all_right_labels_paper'>";
        $output .= "</div>";
        $output .= "<div class='all_right_labels_soc'>";
        $output .= "</div>";
        $output .= '</div>';
        $output .= '</div>';


        $output .= '</p></div>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }
}


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