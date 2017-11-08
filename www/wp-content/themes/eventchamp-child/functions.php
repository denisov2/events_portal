<?php
add_action('wp_enqueue_scripts', 'eventchamp_enqueue_styles');

function eventchamp_enqueue_styles()
{
    wp_enqueue_style('eventchamp-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('eventchamp-child-style', get_stylesheet_directory_uri() . '/style.css');

}

function grid_list_script()
{
    $scriptSrc = get_stylesheet_directory_uri() . '/grig_list.js';
    wp_enqueue_script('grid_list', $scriptSrc, array(), '1.0', false);
}

add_action('wp_enqueue_scripts', 'grid_list_script');

require_once get_theme_file_path('/include/eventchamp_categorized_events_output.php');
require_once get_theme_file_path('/include/eventchamp_home_events_output.php');

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
            1 => 'Idea and amount of the market.',
            2 => 'Team.',
            3 => 'Quality of website, marketing kit etc.',
            4 => 'Development level (at a moment of adding).',
            5 => 'Competition (10 - no competitor. 0 - have more than 5 competitor from the companies that have already reached IPO).',
            6 => 'Investment security (Escrow, whitepaper, chances of realization your idea).',
        ];

        $rating_data = [];

        foreach ($ratings_titles as $key => $value) {

            $rating_data[$key] = get_post_meta(get_the_ID(), 'event_rating_' . $key, true);


        }


        if (!empty ($rating_data)) {


            $sum = 0;
            foreach ($rating_data as $rating) $sum += $rating;

            $average_rating = round($sum / count($rating_data), 1);

        } else {
            $ratings_titles = ['No data' => 0];
            $average_rating = 'Not';

        }
        $output .= '<div class="rating-circle">' . $average_rating . '</div>';

        $output .= '</div>';

        if ($date == 'true' or $category == 'true') {
            $event_cats = wp_get_post_terms($post_id, 'eventcat');
            $event_location = get_post_meta(get_the_ID(), 'event_location', true);
            $event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true);
            $event_end_date = get_post_meta(get_the_ID(), 'event_end_date', true);
            if (!empty($event_cats)) {
                $output .= '<div class="details">';
                if ($category == 'true') {
                    if (!empty($event_cats)) {
                        $output .= '<div class="category"><ul class="post-categories">';
                        foreach ($event_cats as $event_cat) {
                            $output .= '<li><a href="' . get_term_link($event_cat->term_id) . '" title="' . esc_attr($event_cat->name) . '">' . esc_attr($event_cat->name) . '</a></li>';
                        }
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
        $output .= "</div>";
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }
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



add_action( 'wpcf7_before_send_mail', 'save_new_event' );

function save_new_event($contact_form){




    $form_id = $contact_form->posted_data['_wpcf7'];




    if ($form_id == 123): // 123 => Your Form ID.
        $values_list = $_POST['valsitems'];
        $values_str = implode(", ", $values_list);

        // get mail property
        $mail = $contact_form->prop( 'mail' ); // returns array

        // add content to email body
        $mail['body'] .= 'INDUSTRIES SELECTED';
        $mail['body'] .= $values_list;


        // set mail property with changed value(s)
        $contact_form->set_properties( array( 'mail' => $mail ) );
    endif;

}


require get_theme_file_path('/include/core.php');