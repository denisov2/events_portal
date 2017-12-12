<?php
/**
 * Created by PhpStorm.
 * User: denisov
 * Date: 10.11.2017
 * Time: 12:23
 */

/*====== Event Search Tool ======*/
function eventchamp_event_search_output($atts, $content = null)
{
    $atts = shortcode_atts(
        array(
            'style' => '',
            'title' => '',
            'keyword' => '',
            'location' => '',
            'category' => '',
            'status' => 'false',
            'sort' => '',
            'startdate' => '',
            'enddate' => '',
        ), $atts
    );

    $output = "";

    if ($atts["keyword"] == "true" or $atts["category"] == "true" or $atts["status"] == "true" or $atts["sort"] == "true") {
        if ($atts["keyword"] == "true") {
            $keyword_total = "1";
        } else {
            $keyword_total = "0";
        }

        if ($atts["category"] == "true") {
            $category_total = "1";
        } else {
            $category_total = "0";
        }

        if ($atts["status"] == "true") {
            $status_total = "1";
        } else {
            $status_total = "0";
        }

        if ($atts["sort"] == "true") {
            $sort_total = "1";
        } else {
            $sort_total = "0";
        }

        if ($atts["location"] == "true") {
            $location_total = "1";
        } else {
            $location_total = "0";
        }

        if ($atts["startdate"] == "true") {
            $startdate_total = "1";
        } else {
            $startdate_total = "0";
        }

        if ($atts["enddate"] == "true") {
            $enddate_total = "1";
        } else {
            $enddate_total = "0";
        }

        $column = $keyword_total + $category_total + $sort_total + $status_total + $location_total + $startdate_total + $enddate_total;

        $event_search_result_page = ot_get_option('event_search_result_page');
        $event_search_result_page = "/search-results";

        $output .= '<div class="event-search-tool title-' . esc_attr($atts["title"]) . ' column-' . esc_attr($column) . ' ' . esc_attr($atts["style"]) . '">';
        $output .= '<div class="container">';
        // $output .= '<form method="get" action="' . get_the_permalink( $event_search_result_page ) . '">';
        $output .= '<form method="get" action="/search-results">';
        $output .= '<div class="search-content">';
        if ($atts["title"] == "true") {
            $output .= '<div class="title"><i class="fa fa-search-plus" aria-hidden="true"></i>' . esc_html__('Event Search', 'eventchamp') . ':</div>';
        }
        if ($atts["keyword"] == "true" or $atts["category"] == "true" or $atts["status"] == "true" or $atts["sort"] == "true") {
            $output .= '<div class="columns">';

            if (isset($_GET['keyword'])) {
                $keyword = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["keyword"])))));
            } else {
                $keyword = "";
            }

            if ($atts["keyword"] == "true") {


                $output .= '<div class="column">';
                $output .= '<input name="keyword" type="text" value="' . $keyword . '" placeholder="' . esc_html__('Keywords', 'eventchamp') . '">';
                $output .= '</div>';
            } else {
                $output .= '<input name="keyword"  value="' . $keyword . '" type="hidden" placeholder="' . esc_html__('Keywords', 'eventchamp') . '">';
            }
            if ($atts["category"] == "true") {

                if (isset($_GET['category'])) {
                    $category = strtolower(esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["category"]))))));
                } else {
                    $category = "";
                }

                $output .= '<div class="column">';
                $output .= '<select name="category" class="cs-select">';
                $output .= '<option value="">' . esc_html__('Category', 'eventchamp') . '</option>';
                $eventcat_terms = get_terms(array('taxonomy' => 'eventcat', 'hide_empty' => false));
                if (!empty($eventcat_terms) && !is_wp_error($eventcat_terms)) {
                    foreach ($eventcat_terms as $eventcat_term) {
                        $category == strtolower($eventcat_term->slug) ? $selected = ' selected="selected" ' : $selected = "";
                        $eventcat_term_term_id = $eventcat_term->term_id;
                        $eventcat_term_name = $eventcat_term->name;
                        $eventcat_term_slug = $eventcat_term->slug;
                        $eventcat_term_term_group = $eventcat_term->term_group;
                        $output .= '<option ' . $selected . ' value="' . esc_attr($eventcat_term_slug) . '" data-class="cat-id-' . esc_attr($eventcat_term_term_id) . '">' . esc_attr($eventcat_term_name) . '</option>';
                    }
                }
                $output .= '</select>';
                $output .= '</div>';
            }

            if (isset($_GET['location'])) {
                $location = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["location"])))));
            } else {
                $location = "";
            }

            if ($atts["location"] == "true") {
                $output .= '<div class="column">';
                $output .= '<select name="location" class="cs-select">';
                $output .= '<option value="">' . esc_html__('Location', 'eventchamp') . '</option>';
                $eventcat_terms = get_terms(array('taxonomy' => 'location', 'hide_empty' => false));
                if (!empty($eventcat_terms) && !is_wp_error($eventcat_terms)) {
                    foreach ($eventcat_terms as $eventcat_term) {
                        $selected = $location == $eventcat_term->term_id ? ' selected="selected" ' : "";
                        $eventcat_term_name = $eventcat_term->name;
                        $eventcat_term_slug = $eventcat_term->slug;
                        $eventcat_term_term_id = $eventcat_term->term_id;
                        $output .= '<option ' . $selected . ' value="' . esc_attr($eventcat_term_term_id) . '">' . esc_attr($eventcat_term_name) . '</option>';
                    }
                }
                $output .= '</select>';
                $output .= '</div>';
            }
            if ($atts["status"] == "true") {
                $output .= '<div class="column">';
                $output .= '<select name="status" class="cs-select">';
                $output .= '<option value="">' . esc_html__('Status', 'eventchamp') . '</option>';
                $output .= '<option value="upcoming">' . esc_html__('Upcoming ICO', 'eventchamp') . '</option>';
                $output .= '<option value="incoming">' . esc_html__('Active ICO', 'eventchamp') . '</option>';
                $output .= '<option value="expired">' . esc_html__('Past ICO', 'eventchamp') . '</option>';
                $output .= '</select>';
                $output .= '</div>';
            }
            if ($atts["startdate"] == "true") {
                $output .= '<div class="column">';
                $output .= '<input type="text"  name="startdate" value="" placeholder="' . esc_html__('Start Date', 'eventchamp') . '" class="eventsearchdate-datepicker" />';
                $output .= '</div>';
            }
            if ($atts["enddate"] == "true") {
                $output .= '<div class="column">';
                $output .= '<input type="text"  name="enddate" value="" placeholder="' . esc_html__('End Date', 'eventchamp') . '" class="eventsearchdate-datepicker" />';
                $output .= '</div>';
            }
            if ($atts["sort"] == "true") {
                $output .= '<div class="column">';
                $output .= '<select name="sort" class="cs-select">';
                $output .= '<option value="">' . esc_html__('Sort by', 'eventchamp') . '</option>';
                $output .= '<option value="startdate">' . esc_html__('Start Date', 'eventchamp') . '</option>';
                $output .= '<option value="enddate">' . esc_html__('End Date', 'eventchamp') . '</option>';
                $output .= '<option value="creationdate">' . esc_html__('Creation Date', 'eventchamp') . '</option>';
                $output .= '<option value="nameaz">' . esc_html__('Name A > Z', 'eventchamp') . '</option>';
                $output .= '<option value="nameza">' . esc_html__('Name Z > A', 'eventchamp') . '</option>';
                $output .= '</select>';
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '<button type="submit"><i class="fa fa-search" aria-hidden="true"></i><span>' . esc_html__('Search', 'eventchamp') . '</span></button>';
        }
        $output .= '</div>';
        $output .= '</form>';
        $output .= '</div>';
        $output .= '</div>';

    }

    return $output;
}

add_shortcode("eventchamp_event_search", "eventchamp_event_search_output");

if (function_exists('vc_map')) {
    vc_map(array(
            "name" => esc_html__('Event Search Tool', 'eventchamp'),
            "base" => "eventchamp_event_search",
            "category" => esc_html__('Event Champ Theme', 'eventchamp'),
            "icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-event-search-tool.jpg',
            "description" => esc_html__('Event Search Tool element.', 'eventchamp'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Style', 'eventchamp'),
                    "description" => esc_html__('You can select title style.', 'eventchamp'),
                    "param_name" => "style",
                    'save_always' => true,
                    'value' => array(
                        esc_html__('White', 'eventchamp') => 'white',
                        esc_html__('Dark', 'eventchamp') => 'dark',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Search Title', 'eventchamp'),
                    "description" => esc_html__('You can active search title.', 'eventchamp'),
                    "param_name" => "title",
                    'save_always' => true,
                    'value' => array(
                        esc_html__('False', 'eventchamp') => 'false',
                        esc_html__('True', 'eventchamp') => 'true',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Start Date', 'eventchamp'),
                    "description" => esc_html__('You can active start date.', 'eventchamp'),
                    "param_name" => "startdate",
                    'save_always' => true,
                    'value' => array(
                        esc_html__('False', 'eventchamp') => 'false',
                        esc_html__('True', 'eventchamp') => 'true',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('End Date', 'eventchamp'),
                    "description" => esc_html__('You can active end date.', 'eventchamp'),
                    "param_name" => "enddate",
                    'save_always' => true,
                    'value' => array(
                        esc_html__('False', 'eventchamp') => 'false',
                        esc_html__('True', 'eventchamp') => 'true',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Keyword', 'eventchamp'),
                    "description" => esc_html__('You can active keyword option.', 'eventchamp'),
                    "param_name" => "keyword",
                    'save_always' => true,
                    'value' => array(
                        esc_html__('False', 'eventchamp') => 'false',
                        esc_html__('True', 'eventchamp') => 'true',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Category', 'eventchamp'),
                    "description" => esc_html__('You can active category option.', 'eventchamp'),
                    "param_name" => "category",
                    'save_always' => true,
                    'value' => array(
                        esc_html__('False', 'eventchamp') => 'false',
                        esc_html__('True', 'eventchamp') => 'true',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Location', 'eventchamp'),
                    "description" => esc_html__('You can active location option.', 'eventchamp'),
                    "param_name" => "location",
                    'save_always' => true,
                    'value' => array(
                        esc_html__('False', 'eventchamp') => 'false',
                        esc_html__('True', 'eventchamp') => 'true',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Status', 'eventchamp'),
                    "description" => esc_html__('You can active status option.', 'eventchamp'),
                    "param_name" => "status",
                    'save_always' => true,
                    'value' => array(
                        esc_html__('False', 'eventchamp') => 'false',
                        esc_html__('True', 'eventchamp') => 'true',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Sort Type', 'eventchamp'),
                    "description" => esc_html__('You can active sort type option.', 'eventchamp'),
                    "param_name" => "sort",
                    'save_always' => true,
                    'value' => array(
                        esc_html__('False', 'eventchamp') => 'false',
                        esc_html__('True', 'eventchamp') => 'true',
                    ),
                ),
            ),
        )
    );
}

/*====== Event Search Results ======*/
function eventchamp_events_search_results_output($atts, $content = null)
{
    $atts = shortcode_atts(
        array(
            'eventids' => '',
            'eventcount' => '',
            'includecategories' => '',
            'excludecategories' => '',
            'excludeevents' => '',
            'offset' => '',
            'price' => '',
            'pagination' => '',
            'status' => '',
            'category' => '',
            'location' => '',
            'date' => '',
            'excerpt' => '',
            'hideexpired' => '',
        ), $atts
    );

    $output = "";

    $date_now = date("Y-m-d");

    if (!empty($atts['eventids'])) {
        $eventids = explode(',', $atts['eventids']);
    } else {
        $eventids = "";
    }

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

    if (!empty($atts['includecategories'])) {
        $includecategories = explode(',', $atts['includecategories']);
    } else {
        $includecategories = "";
    }

    if (!empty($atts['excludecategories'])) {
        $excludecategories = explode(',', $atts['excludecategories']);
    } else {
        $excludecategories = "";
    }

    if (!empty($atts['excludeevents'])) {
        $excludeevents = explode(',', $atts['excludeevents']);
    } else {
        $excludeevents = array();
    }

    $hideexpired = $atts["hideexpired"];
    if ($hideexpired == "on") {
        $expired_ids = eventchamp_expired_event_ids();
    } else {
        $expired_ids = array();
    }
    $excludeevents = array_merge($excludeevents, $expired_ids);

    if (isset($_GET['keyword'])) {
        if (isset($_GET['keyword'])) {
            $keyword = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["keyword"])))));
        } else {
            $keyword = "";
        }

        if (isset($_GET['category'])) {
            $category = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["category"])))));
        } else {
            $category = "";
        }

        if (isset($_GET['status'])) {
            $status = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["status"])))));
        } else {
            $status = "";
        }

        if (isset($_GET['sort'])) {
            $sort = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["sort"])))));
        } else {
            $sort = "";
        }

        if (isset($_GET['location'])) {
            $location = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["location"])))));
        } else {
            $location = "";
        }

        if (isset($_GET['startdate'])) {
            $startdate = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["startdate"])))));
            $startdate_empty_control = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["startdate"])))));
        } else {
            $startdate = "";
            $startdate_empty_control = "";
        }

        if (isset($_GET['enddate'])) {
            $enddate = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["enddate"])))));
            $enddate_empty_control = esc_js(esc_sql(balanceTags(htmlspecialchars(esc_html__($_GET["enddate"])))));
        } else {
            $enddate = "";
            $enddate_empty_control = "";
        }

        if (!empty($startdate)) {
            $startdate_compare = ">=";
        } else {
            $startdate = "-";
            $startdate_compare = "LIKE";
        }

        if (!empty($enddate)) {
            $enddate_compare = "<=";
        } else {
            $enddate = $startdate;
            $enddate_compare = ">=";
        }

        if ($status == "upcoming") {
            $compare = ">";
            $compare2 = "BETWEEN";
        } elseif ($status == "incoming") {
            $compare = "<=";
            $compare2 = ">=";
        } elseif ($status == "expired") {
            $compare = "<=";
            $compare2 = "<=";
        } else {
            $compare = "BETWEEN";
            $compare2 = "BETWEEN";
        }
    } else {
        $keyword = "";
        $category = "";
        $status = "";
        $sort = "";
        $location = "";
        $compare = "";
        $compare2 = "";
    }

    if (isset($_GET['sort'])) {
        if ($_GET['sort'] == "startdate") {

            $meta_key = "event_start_date";

            $orderby = array(
                'event_adv_case' => 'ASC',
                'event_start_date' => 'ASC'
            );

        } elseif ($_GET['sort'] == "enddate") {
            //  $order = "DESC";
            $orderby = "meta_value";
            $meta_key = "event_end_date";

            $orderby = array(
                'event_adv_case' => 'ASC',
                'event_end_case' => 'ASC'
            );

        } elseif ($_GET['sort'] == "creationdate") {

            $meta_key = "event_start_date";
            $orderby = array(
                'event_adv_case' => 'ASC',
                'event_start_date' => 'ASC'
            );

        } elseif ($_GET['sort'] == "nameza") {
            $order = "DESC";
            $orderby = "title";
            //         $meta_key = "";
            $orderby = array(
                'event_adv_case' => 'ASC',
                'title' => 'DESC'
            );


        } else {
            $order = "ASC";
            $orderby = array(
                'event_adv_case' => 'ASC',
                'title' => 'ASC'
            );
            //  $meta_key = "";
        }
    } else {
        $order = "ASC";
        //$orderby = "title";
        $orderby = array(
            'event_adv_case' => 'ASC',
            'title' => 'ASC'
        );
        $meta_key = "";

    }

    if (isset($_GET['location'])) {
        if (!empty($_GET['location'])) {
            $location = esc_attr($_GET['location']);
            $location_comp = "=";
        } else {
            $location = "none";
            $location_comp = "NOT LIKE";
        }
    } else {
        $location = "none";
        $location_comp = "NOT LIKE";
    }

    $paged = is_front_page() ? get_query_var('page', 1) : get_query_var('paged', 1);
    if (empty($paged)) {
        $paged = 1;
    }

    if (!empty($startdate_empty_control) or !empty($enddate_empty_control)) {
        if (!empty($category)) {
            $args = array(
                'posts_per_page' => $atts["eventcount"],
                'post_status' => 'publish',
                'post__not_in' => $excludeevents,
                'offset' => $atts["offset"],
                'order' => $order,
                'orderby' => $orderby,
                'meta_key' => $meta_key,
                'paged' => $paged,
                's' => $keyword,
                'ignore_sticky_posts' => true,
                'post_type' => 'event',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'eventcat',
                        'field' => 'slug',
                        'terms' => $category,
                    ),
                ),
                'meta_query' => array(
                    array(
                        'key' => 'event_start_date',
                        'compare' => $startdate_compare,
                        'value' => $startdate,
                    ),
                    array(
                        'key' => 'event_end_date',
                        'compare' => $enddate_compare,
                        'value' => $enddate,
                    ),
                    array(
                        'key' => 'event_location',
                        'compare' => $location_comp,
                        'value' => $location,
                    ),
                    array(
                        'relation' => 'OR',
                        array(
                            'key' => 'event_adv',
                            'compare' => 'NOT EXISTS',
                        ),
                        'event_adv_case' => array(
                            'key' => 'event_adv',
                            'compare' => ' EXISTS',
                        ),
                    ),
                ),
            );
        } else {
            $args = array(
                'posts_per_page' => $atts["eventcount"],
                'post_status' => 'publish',
                'post__not_in' => $excludeevents,
                'offset' => $atts["offset"],
                'order' => $order,
                'orderby' => $orderby,
                'meta_key' => $meta_key,
                'paged' => $paged,
                's' => $keyword,
                'ignore_sticky_posts' => true,
                'post_type' => 'event',
                'meta_query' => array(
                    array(
                        'key' => 'event_start_date',
                        'compare' => $startdate_compare,
                        'value' => $startdate,
                    ),
                    array(
                        'key' => 'event_end_date',
                        'compare' => $enddate_compare,
                        'value' => $enddate,
                    ),
                    array(
                        'key' => 'event_location',
                        'compare' => $location_comp,
                        'value' => $location,
                    ),
                    array(
                        'relation' => 'OR',
                        array(
                            'key' => 'event_adv',
                            'compare' => 'NOT EXISTS',
                        ),
                        'event_adv_case' => array(
                            'key' => 'event_adv',
                            'compare' => ' EXISTS',
                        ),
                    ),
                ),
            );
        }
    } else {
        if (!empty($category)) {
            $args = array(
                'posts_per_page' => $atts["eventcount"],
                'post_status' => 'publish',
                'post__not_in' => $excludeevents,
                'offset' => $atts["offset"],
                'order' => $order,
                'orderby' => $orderby,
                'meta_key' => $meta_key,
                'paged' => $paged,
                's' => $keyword,
                'ignore_sticky_posts' => true,
                'post_type' => 'event',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'eventcat',
                        'field' => 'slug',
                        'terms' => $category,
                    ),
                ),
                'meta_query' => array(
                    array(
                        'key' => 'event_start_date',
                        'compare' => $compare,
                        'value' => $date_now,
                    ),
                    array(
                        'key' => 'event_end_date',
                        'compare' => $compare2,
                        'value' => $date_now,
                    ),
                    array(
                        'key' => 'event_location',
                        'compare' => $location_comp,
                        'value' => $location,
                    ),
                    array(
                        'relation' => 'OR',
                        array(
                            'key' => 'event_adv',
                            'compare' => 'NOT EXISTS',
                        ),
                        'event_adv_case' => array(
                            'key' => 'event_adv',
                            'compare' => ' EXISTS',
                        ),
                    ),
                ),
            );
        } else {
            $args = array(
                'posts_per_page' => $atts["eventcount"],
                'post_status' => 'publish',
                'post__not_in' => $excludeevents,
                'offset' => $atts["offset"],
                'order' => $order,
                'orderby' => $orderby,
                'meta_key' => $meta_key,
                'paged' => $paged,
                's' => $keyword,
                'ignore_sticky_posts' => true,
                'post_type' => 'event',
                'meta_query' => array(
                    array(
                        'key' => 'event_start_date',
                        'compare' => $compare,
                        'value' => $date_now,
                    ),
                    array(
                        'key' => 'event_end_date',
                        'compare' => $compare2,
                        'value' => $date_now,
                    ),
                    array(
                        'key' => 'event_location',
                        'compare' => $location_comp,
                        'value' => $location,
                    ),
                    array(
                        'relation' => 'OR',
                        array(
                            'key' => 'event_adv',
                            'compare' => 'NOT EXISTS',
                        ),
                        'event_adv_case' => array(
                            'key' => 'event_adv',
                            'compare' => ' EXISTS',
                        ),
                    ),
                ),
            );
        }
    }

    if (!empty($includecategories)) {
        $defaults = array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'eventcat',
                    'field' => 'slug',
                    'terms' => $includecategories,
                ),
            ),
        );
        $args = wp_parse_args($args, $defaults);
    }

    if (!empty($excludecategories)) {
        $defaults2 = array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'eventcat',
                    'field' => 'slug',
                    'terms' => $excludecategories,
                    'operator' => 'NOT IN',
                ),
            ),
        );
        $args = wp_parse_args($args, $defaults2);
    }
    $wp_query = new WP_Query($args);
    //  формирование сетки результатов с $args
    //*****************************************
    // содержимое вкладки со ВСЕМИ событиями
    $output .= '<div class="categorized-events">';
    /*if(empty($category) && (empty($location) || $location == "none" )&& empty($status) && (empty($startdate) || $startdate == "-")) {
        $output .= '<h1><b style="color: #b11bb1;">All</b>  events with  any  status with  any  start date from  all  countries sorted by  date</h1>';
    } else {
        $output .= '<h1>All ICO with  <b style="color: #b11bb1;">'.$status.'</b>  status with <b style="color: #b11bb1;">'.$category.'</b> category  with  <b style="color: #b11bb1;">'.$startdate.'</b>  start date from  <b style="color: #b11bb1;">'.get_cat_name( $location).'</b>  countries.</h1>';
    }*/

    $output .= '<div class="sort_home">	<div class="sort_home_text"><h1><span>All</span> ICO with ';
    if (!empty($status)) {

        switch ($status) {
            case 'upcoming' :
                $output .= '<span>Upcoming ICO</span>';
                break;
            case 'expired' :
                $output .= '<span>Past ICO</span>';
                break;
            case 'incoming' :
                $output .= '<span>Active ICO</span>';
                break;
            default :
                $output .= '<span>' . esc_html__($status) . '</span>';
                break;
        }
    } else {

        $output .= '<span>any</span> status ';
    }
    $output .= ' with ';
    if (empty($startdate) || $startdate == "-") {
        $output .= '<span> any </span>';
    } else {
        $output .= '<span>' . $startdate . '</span>';
    }
    $output .= ' start date from';
    
    if (!empty($location) && $location!='none') {
        $output .= '<span> ' . get_cat_name($location) . '</span>';
    } else  {
        $output .= '<span> all </span>';
    }
    $output .= ' countries sorted by <span>date</span></h1></div>';

    $output .= '<div class="well well-sm ">
                        <div class="btn-group">
                            <a href="#" id="list" class="list-all btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
                            </span></a> <a href="#" id="grid" class="grid-all btn btn-default btn-sm"><span
                                class="glyphicon glyphicon-th"></span></a>
                        </div>
                    </div>
				</div>	';
    $output .= '<div class="tab-content">';

    $output .= '<div role="tabpanel" class="tab-pane" id="events_all">';

    if (!empty($wp_query)) {


        $output .= '<div class="event-header-list events-hidens"> ';
        $output .= '<div class="col-xs-12 col-md-4"><div class="ev_name"><p>Name</p> </div><div class="ev_cat"><p>Category</p></div></div>';
        $output .= '<div class="col-xs-12 col-md-5"><div class="ev_desc"><p>Description</p> </div><div class="ev_date"><p>Start Date</p><p>End Date</p></div></div>';
        $output .= '<div class="col-xs-12 col-md-3"><div class="ev_rating"><p>Rating</p><p>Country</p> </div><div class="ev_links"><p>Links</p></div></div>';
        $output .= '</div>';

        $output .= '<div id="products_event" class="event-list column-3">';

        // объявления
        while ($wp_query->have_posts()) {
            $wp_query->the_post();

            $cur_post_id = get_the_ID();
            $event_start_date = get_post_meta($cur_post_id, 'event_start_date', true);
            $event_end_date = get_post_meta($cur_post_id, 'event_end_date', true);

            $event_start_date_last = date_format(date_create($event_start_date), "Y-m-d");
            $event_end_date_last = date_format(date_create($event_end_date), "Y-m-d");
            $date_now = date("Y-m-d");

            if (!empty($event_start_date) or !empty($event_end_date)) {

                if ($atts['ico_status'] == 'active') {
                    if ($date_now >= $event_start_date_last and $date_now <= $event_end_date_last) {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                } elseif ($atts['ico_status'] == 'upcoming') {
                    if ($event_start_date_last > $date_now) {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                } elseif ($atts['ico_status'] == 'past') {
                    if ($date_now > $event_end_date) {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                } elseif ($atts['ico_status'] == 'all') {
                    $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                } else {
                    $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                }
            }
        }


        // объявления без рекламы

        $output .= '</div>';
    }
    wp_reset_postdata();

    if ($atts['pagination'] == 'true') {
        $output .= eventchamp_element_pagination($paged = $paged, $query = $wp_query);
    }

    $output .= '</div>'; // таб панель?

    $output .= '</div>';
    $output .= '</div>';

    //******************************************

    return $output;
}

add_shortcode("eventchamp_events_search_results", "eventchamp_events_search_results_output");

if (function_exists('vc_map')) {
    vc_map(array(
            "name" => esc_html__('Event Search Results', 'eventchamp'),
            "base" => "eventchamp_events_search_results",
            "category" => esc_html__('Event Champ Theme', 'eventchamp'),
            "icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-events-search-results.jpg',
            "description" => esc_html__('Event Search Results element.', 'eventchamp'),
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
                    "heading" => esc_html__('Include Event Categories', 'eventchamp'),
                    "description" => esc_html__('You can enter category slugs. Example: travel.', 'eventchamp'),
                    "param_name" => "includecategories",
                    "group" => esc_html__('General', 'eventchamp'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__('Exclude Event Categories', 'eventchamp'),
                    "description" => esc_html__('You can enter category slugs. Example: travel.', 'eventchamp'),
                    "param_name" => "excludecategories",
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
                    "heading" => esc_html__('Pagination', 'eventchamp'),
                    "description" => esc_html__('You can select pagination status.', 'eventchamp'),
                    "param_name" => "pagination",
                    "group" => esc_html__('General', 'eventchamp'),
                    'save_always' => true,
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
}