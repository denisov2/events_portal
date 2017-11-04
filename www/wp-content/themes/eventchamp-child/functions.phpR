<?php
add_action('wp_enqueue_scripts', 'eventchamp_enqueue_styles');
function eventchamp_enqueue_styles()
{
    wp_enqueue_style('eventchamp-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('eventchamp-child-style', get_stylesheet_directory_uri() . '/style.css');

}


function eventchamp_categorized_events_output_new($atts, $content = null)
{
    $atts = shortcode_atts(
        array(
            'style' => '',
            'allbutton' => '',
            'alleventstab' => '',
            'eventcount' => '',
            'excludecategories' => '',
            'includecategories' => '',
            'excludeevents' => '',
            'offset' => '',
            'price' => '',
            'status' => '',
            'category' => '',
            'location' => '',
            'date' => '',
            'excerpt' => '',
            'sortby' => '',
            'ordertype' => '',
            'hideexpired' => '',
        ), $atts
    );

    $output = "";

    if ($atts["price"] == "true") {
        $price_status = "true";
    } else {
        $price_status = "false";
    }

    if ($atts["status"] == "true") {
        $status_status = "true";
    } else {
        $status_status = "false";
    }

    if ($atts["category"] == "true") {
        $category_status = "true";
    } else {
        $category_status = "false";
    }

    if ($atts["location"] == "true") {
        $location_status = "true";
    } else {
        $location_status = "false";
    }

    if ($atts["date"] == "true") {
        $date_status = "true";
    } else {
        $date_status = "false";
    }

    if ($atts["excerpt"] == "true") {
        $excerpt_status = "true";
    } else {
        $excerpt_status = "false";
    }

    if (!empty($atts['excludecategories'])) {
        $excludecategories = explode(',', $atts['excludecategories']);
    } else {
        $excludecategories = "";
    }

    if (!empty($atts['includecategories'])) {
        $includecategories = explode(',', $atts['includecategories']);
    } else {
        $includecategories = "";
    }

    if (!empty($atts['excludeevents'])) {
        $excludeevents = explode(',', $atts['excludeevents']);
    } else {
        $excludeevents = array();
    }

    $hideexpired = $atts["hideexpired"];
    if ($hideexpired == "true") {
        $expired_ids = eventchamp_expired_event_ids();
    } else {
        $expired_ids = array();
    }
    $excludeevents = array_merge($excludeevents, $expired_ids);

    if ($atts["ordertype"]) {
        $ordertype = $atts["ordertype"];
    } else {
        $ordertype = "";
    }

    if ($atts["sortby"] == "name") {
        $sortby = "name";
    } elseif ($atts["sortby"] == "upcomingevents") {
        $sortby = "meta_value";
    } else {
        $sortby = "";
    }

    $eventcat_terms = get_terms(array(
        'taxonomy' => 'eventcat',
        'exclude' => $excludecategories,
        'include' => $includecategories,
        'hide_empty' => false
    ));

    if (!empty($eventcat_terms) && !is_wp_error($eventcat_terms)) {
        $output .= '<div class="categorized-events">';
        $output .= '<ul class="nav nav-tabs" role="tablist">';
        if ($atts["alleventstab"] == "true") {
            $output .= '<li role="presentation"><a href="#categorized_events_all" aria-controls="categorized_events_all" role="tab" data-toggle="tab">' . esc_html__('All', 'eventchamp') . '</a></li>';
        }
        foreach ($eventcat_terms as $eventcat_term) {
            $eventcat_term_name = $eventcat_term->name;
            $eventcat_term_slug = $eventcat_term->slug;
            $output .= '<li role="presentation"><a href="#categorized_events_' . esc_attr($eventcat_term_slug) . '" aria-controls="categorized_events_' . esc_attr($eventcat_term_slug) . '" role="tab" data-toggle="tab">' . esc_attr($eventcat_term_name) . '</a></li>';
        }
        $output .= '</ul>';
        $output .= '<div class="tab-content">';
        if ($atts["alleventstab"] == "true") {
            $output .= '<div role="tabpanel" class="tab-pane" id="categorized_events_all">';
            $args = array(
                'posts_per_page' => $atts["eventcount"],
                'post_status' => 'publish',
                'post__not_in' => $excludeevents,
                'offset' => $atts["offset"],
                'ignore_sticky_posts' => true,
                'post_type' => 'event',
                'order' => $ordertype,
                'orderby' => $sortby,
                'meta_key' => 'event_start_date'
            );

            if (!empty($excludecategories) or !empty($includecategories)) {
                if (!empty($includecategories)) {
                    $defaults = array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'eventcat',
                                'field' => 'term_id',
                                'terms' => $includecategories,
                            ),
                        ),
                    );
                    $args = wp_parse_args($args, $defaults);
                }

                if (!empty($excludecategories)) {
                    $defaults = array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'eventcat',
                                'field' => 'term_id',
                                'terms' => $excludecategories,
                                'operator' => 'NOT IN'
                            ),
                        ),
                    );
                    $args = wp_parse_args($args, $defaults);
                }
            }

            $wp_query = new WP_Query($args);
            if (!empty($wp_query)) {
                $output .= '<div class="event-list column-3">';
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
                    if ($atts["style"] == "style2") {
                        $output .= eventchamp_event_list_style_3($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    } elseif ($atts["style"] == "style3") {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    } else {
                        $output .= eventchamp_event_list_style_1($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                }
                $output .= '</div>';
            }
            wp_reset_postdata();

            if ($atts["allbutton"] == "true") {
                $output .= '<a href="' . esc_url(get_post_type_archive_link('event')) . '" class="all-button">' . esc_html__('All Events', 'eventchamp') . '</a>';
            }
            $output .= '</div>';
        }
        foreach ($eventcat_terms as $eventcat_term) {
            $eventcat_term_name = $eventcat_term->name;
            $eventcat_term_term_id = $eventcat_term->term_id;
            $eventcat_term_slug = $eventcat_term->slug;
            $output .= '<div role="tabpanel" class="tab-pane" id="categorized_events_' . esc_attr($eventcat_term_slug) . '">';
            $args = array(
                'posts_per_page' => $atts["eventcount"],
                'post_status' => 'publish',
                'post__not_in' => $excludeevents,
                'offset' => $atts["offset"],
                'ignore_sticky_posts' => true,
                'post_type' => 'event',
                'order' => $ordertype,
                'orderby' => $sortby,
                'meta_key' => 'event_start_date',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'eventcat',
                        'field' => 'slug',
                        'terms' => array($eventcat_term_slug),
                    ),
                ),
            );
            $wp_query = new WP_Query($args);
            if (!empty($wp_query)) {
                $output .= '<div class="event-list column-3">';
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
                    if ($atts["style"] == "style2") {
                        $output .= eventchamp_event_list_style_3($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    } elseif ($atts["style"] == "style3") {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    } else {
                        $output .= eventchamp_event_list_style_1($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                }
                $output .= '</div>';
            }
            wp_reset_postdata();

            if ($atts["allbutton"] == "true") {
                $output .= '<a href="' . esc_url(get_term_link($eventcat_term_term_id)) . '" class="all-button">' . esc_html__('All', 'eventchamp') . ' ' . esc_attr($eventcat_term_name) . ' ' . esc_html__('Events', 'eventchamp') . '</a>';
            }
            $output .= '</div>';
        }
        $output .= '</div>';
        $output .= '</div>';
    }
    return $output;
}

add_shortcode("eventchamp_categorized_events_new", "eventchamp_categorized_events_output_new");

function eventchamp_event_list_style_4_new( $post_id = "", $image = "", $category = "", $date = "", $location = "", $excerpt = "", $status = "", $price = "" ) {
    if( !empty( $post_id ) ) {
        $output  = "";
        $output .= '<div class="event-list-styles event-list-style-4">';

        $output .= '<div class="content">';

        if( $image == 'true' ) {
            if ( has_post_thumbnail( $post_id ) ) {
                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'eventchamp-event-list' );
            } else {
                $image_url = "";
            }

            if( !empty( $image_url ) ) {
                $output .= '<div class="image">';
                $output .= '<img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" />';
                $output .= '</div>';
            }
        }


        $output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

        if( $date == 'true' or $category == 'true' ) {
            $event_cats = wp_get_post_terms( $post_id, 'eventcat' );
            $event_location = get_post_meta( get_the_ID(), 'event_location', true );
            $event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
            if( !empty( $event_cats ) ) {
                $output .= '<div class="details">';
                if( $category == 'true' ) {
                    if( !empty( $event_cats ) ) {
                        $output .= '<div class="category"><ul class="post-categories">';
                        foreach( $event_cats as $event_cat ) {
                            $output .= '<li><a href="' . get_term_link( $event_cat->term_id ) . '" title="' . esc_attr( $event_cat->name ) . '">' . esc_attr( $event_cat->name ) . '</a></li>';
                        }
                        $output .= '</ul></div>';
                    }
                }

                if( $date == 'true' ) {
                    if( !empty( $event_start_date ) ) {
                        $output .= '<div class="date">';
                        $output .= '<i class="fa fa-calendar" aria-hidden="true"></i>';
                        $output .= '<span>' . esc_attr( eventchamp_global_date_converter( $date = $event_start_date ) ) . '</span>';
                        $output .= '</div>';
                    }
                }
                $output .= '</div>';
            }
        }

        if( $excerpt == 'true' ) {
            $excerpt_content = get_the_excerpt();
            if( !empty( $excerpt_content ) ) {
                $output .= '<div class="excerpt">' . get_the_excerpt() . '</div>';
            }
        }

        $output .= "<div class='left-label'>8 days left</div>";

        if( !empty( $event_location ) or !empty( $event_remaining_tickets ) or $status == 'true' or $location == 'true' or $status == 'true' ) {
            $output .= '<div class="details">';
            if( $location == 'true' ) {
                if( !empty( $event_location ) ) {
                    $location = get_term( $event_location, 'location' );
                    if( !empty( $location ) ) {
                        $output .= '<div class="location">';
                        $output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
                        $output .= '<span>' . esc_attr( $location->name ) . '</span>';
                        $output .= '</div>';
                    }
                }
            }

            if( $status == 'true' ) {
                $output .= '<div class="status">';
                $output .= '<i class="fa fa-hourglass" aria-hidden="true"></i>';
                $output .= eventchamp_event_status( $post_id = get_the_ID() );
                $output .= '</div>';
            }

            if( $price == 'true' ) {
                $event_remaining_tickets = get_post_meta( get_the_ID(), 'event_remaining_tickets', true );
                if( !empty( $event_remaining_tickets ) ) {
                    $output .= '<div class="price">';
                    $output .= '<i class="fa fa-credit-card" aria-hidden="true"></i>';
                    $product_id = wc_get_product( $event_remaining_tickets );
                    $output .= '<div class="price">' . $product_id->get_price_html() . '</div>';
                    $output .= '</div>';
                }
            }
            $output .= '</div>';
        }
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
    )
);

