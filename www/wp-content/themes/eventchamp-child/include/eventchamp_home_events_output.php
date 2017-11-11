<?php
/**
 * Created by PhpStorm.
 * User: denisov
 * Date: 04.11.2017
 * Time: 20:34
 */

function eventchamp_home_events_output($atts, $content = null)
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
            'ico_status' => '',
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


    // выводим вкладки с категориями

    if (!empty($eventcat_terms) && !is_wp_error($eventcat_terms)) {
        $output .= '<div class="categorized-events">';
        $output .= '<ul class="nav nav-tabs" role="tablist">';

        /* if ($atts["alleventstab"] == "true") {
             $output .= '<li role="presentation"><a href="#events_all" aria-controls="events_all" role="tab" data-toggle="tab">' . esc_html__('All', 'All ICO') . '</a></li>';
         }
         $output .= '<li role="presentation"><a href="#events_active" aria-controls="events_active" role="tab" data-toggle="tab">Active ICO</a></li>';
         $output .= '<li role="presentation"><a href="#events_upcoming" aria-controls="events_upcoming" role="tab" data-toggle="tab">Upcoming ICO</a></li>';
         $output .= '<li role="presentation"><a href="#events_past" aria-controls="events_past" role="tab" data-toggle="tab">Past ICO</a></li>';

         $output .= '</ul>';
 */

        // содержимое вкладки со ВСЕМИ событиями
        $output .= '<div class="tab-content">';

        $output .= '<div role="tabpanel" class="tab-pane" id="events_all">';
        $args_adv = [
            'posts_per_page' => $atts["eventcount"],
            'post_status' => 'publish',
            'post__not_in' => $excludeevents,
            'o  ffset' => $atts["offset"],
            'ignore_sticky_posts' => true,
            'post_type' => 'event',
            'order' => $ordertype,
            'orderby' => $sortby,
            'meta_key' => 'event_start_date',
            'meta_query' => [
                [
                    'key' => 'event_adv',
                    'value' => 1,
                ],
            ],
        ];

        $args_no_adv = [
            'posts_per_page' => $atts["eventcount"],
            'post_status' => 'publish',
            'post__not_in' => $excludeevents,
            'o  ffset' => $atts["offset"],
            'ignore_sticky_posts' => true,
            'post_type' => 'event',
            'order' => $ordertype,
            'orderby' => $sortby,
            'meta_key' => 'event_start_date',
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key' => 'event_adv',
                    'value' => 0,
                ],
                [
                    'key' => 'event_adv',
                    'compare' => 'NOT EXISTS',
                ],
            ],
        ];

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
                $args_adv = wp_parse_args($args_adv, $defaults);
                $args_no_adv = wp_parse_args($args_no_adv, $defaults);
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
                $args_adv = wp_parse_args($args_adv, $defaults);
                $args_no_adv = wp_parse_args($args_no_adv, $defaults);
            }
        }
        $wp_query_adv = new WP_Query($args_adv);
        $wp_query_no_adv = new WP_Query($args_no_adv);

        if (!empty($wp_query_adv) || !empty($wp_query_no_adv)) {

            $output .= '
				<div class="sort_home">
				<div class="sort_home_text"><span><a href="#events_all" aria-controls="events_all" role="tab" data-toggle="tab">All</a><span> events with
				<span><a href="#events_active" aria-controls="events_active" role="tab" data-toggle="tab">Active ICO</a><span>
				with <a href="#events_upcoming" aria-controls="events_upcoming" role="tab" data-toggle="tab">Upcoming ICO</a><span>
				with <a href="#events_past" aria-controls="events_past" role="tab" data-toggle="tab">Past ICO</a><span>
				 </div>
                    <div class="well well-sm ">
                        <div class="btn-group">
                            <a href="#" id="list" class="list-all btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
                            </span></a> <a href="#" id="grid" class="grid-all btn btn-default btn-sm"><span
                                class="glyphicon glyphicon-th"></span></a>
                        </div>
                    </div>
				</div>	';


            $output .= '<div class="event-header-list events-hidens"> ';
            $output .= '<div class="col-xs-12 col-md-4"><div class="ev_name"><p>Name</p> </div><div class="ev_cat"><p>Category</p></div></div>';
            $output .= '<div class="col-xs-12 col-md-5"><div class="ev_desc"><p>Description</p> </div><div class="ev_date"><p>Start Date</p><p>End Date</p></div></div>';
            $output .= '<div class="col-xs-12 col-md-3"><div class="ev_rating"><p>Rating</p><p>Country</p> </div><div class="ev_links"><p>Links</p></div></div>';
            $output .= '</div>';

            $output .= '<div id="products_event" class="event-list column-3">';

            // объявления с рекламой
            while ($wp_query_adv->have_posts()) {
                $wp_query_adv->the_post();

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
            while ($wp_query_no_adv->have_posts()) {
                $wp_query_no_adv->the_post();

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

            $output .= '</div>';
        }
        wp_reset_postdata();

        if ($atts["allbutton"] == "true") {
            $output .= '<a href="' . esc_url(get_post_type_archive_link('event')) . '" class="all-button">' . esc_html__('All Events', 'eventchamp') . '</a>';
        }
        $output .= '</div>';

        // выводим по очереди вкладку с каждым тип ICO

        $output .= '<div role="tabpanel" class="tab-pane" id="events_active">';

        $wp_query_adv = new WP_Query($args_adv);
        $wp_query_no_adv = new WP_Query($args_no_adv);

        if (!empty($wp_query_adv) || !empty($wp_query_no_adv)) {

            $output .= '
				<div class="sort_home">
				<div class="sort_home_text"><span><a href="#events_all" aria-controls="events_all" role="tab" data-toggle="tab">All</a><span> events with
				<span><a href="#events_active" aria-controls="events_active" role="tab" data-toggle="tab">Active ICO</a><span>
				with <a href="#events_upcoming" aria-controls="events_upcoming" role="tab" data-toggle="tab">Upcoming ICO</a><span>
				with <a href="#events_past" aria-controls="events_past" role="tab" data-toggle="tab">Past ICO</a><span>
				 </div>
                    <div class="well well-sm ">
                        <div class="btn-group">
                            <a href="#" id="list" class="list-all btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
                            </span></a> <a href="#" id="grid" class="grid-all btn btn-default btn-sm"><span
                                class="glyphicon glyphicon-th"></span></a>
                        </div>
                    </div>
				</div>	';


            $output .= '<div class="event-header-list events-hidens"> ';
            $output .= '<div class="col-xs-12 col-md-4"><div class="ev_name"><p>Name</p> </div><div class="ev_cat"><p>Category</p></div></div>';
            $output .= '<div class="col-xs-12 col-md-5"><div class="ev_desc"><p>Description</p> </div><div class="ev_date"><p>Start Date</p><p>End Date</p></div></div>';
            $output .= '<div class="col-xs-12 col-md-3"><div class="ev_rating"><p>Rating</p><p>Country</p> </div><div class="ev_links"><p>Links</p></div></div>';
            $output .= '</div>';
            $output .= '<div class="event-list column-3">';

            while ($wp_query_adv->have_posts()) {
                $wp_query_adv->the_post();

                $cur_post_id = get_the_ID();
                $event_start_date = get_post_meta($cur_post_id, 'event_start_date', true);
                $event_end_date = get_post_meta($cur_post_id, 'event_end_date', true);

                $event_start_date_last = date_format(date_create($event_start_date), "Y-m-d");
                $event_end_date_last = date_format(date_create($event_end_date), "Y-m-d");
                $date_now = date("Y-m-d");

                if (!empty($event_start_date) or !empty($event_end_date)) {

                    if ($date_now >= $event_start_date_last and $date_now <= $event_end_date_last) {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                }
            }
            while ($wp_query_no_adv->have_posts()) {
                $wp_query_no_adv->the_post();

                $cur_post_id = get_the_ID();
                $event_start_date = get_post_meta($cur_post_id, 'event_start_date', true);
                $event_end_date = get_post_meta($cur_post_id, 'event_end_date', true);

                $event_start_date_last = date_format(date_create($event_start_date), "Y-m-d");
                $event_end_date_last = date_format(date_create($event_end_date), "Y-m-d");
                $date_now = date("Y-m-d");

                if (!empty($event_start_date) or !empty($event_end_date)) {

                    if ($date_now >= $event_start_date_last and $date_now <= $event_end_date_last) {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                }
            }
            $output .= '</div>';
        }
        wp_reset_postdata();

        /* if ($atts["allbutton"] == "true") {
             $output .= '<a href="' . esc_url(get_term_link($eventcat_term_term_id)) . '" class="all-button">' . esc_html__('All', 'eventchamp') . ' ' . esc_attr($eventcat_term_name) . ' ' . esc_html__('Events', 'eventchamp') . '</a>';
         }*/
        $output .= '</div>';

        $output .= '<div role="tabpanel" class="tab-pane" id="events_upcoming">';

        $wp_query_adv = new WP_Query($args_adv);
        $wp_query_no_adv = new WP_Query($args_no_adv);

        if (!empty($wp_query_adv) || !empty($wp_query_no_adv)) {

            $output .= '
				<div class="sort_home">
				<div class="sort_home_text"><span><a href="#events_all" aria-controls="events_all" role="tab" data-toggle="tab">All</a><span> events with
				<span><a href="#events_active" aria-controls="events_active" role="tab" data-toggle="tab">Active ICO</a><span>
				with <a href="#events_upcoming" aria-controls="events_upcoming" role="tab" data-toggle="tab">Upcoming ICO</a><span>
				with <a href="#events_past" aria-controls="events_past" role="tab" data-toggle="tab">Past ICO</a><span>
				 </div>
                    <div class="well well-sm ">
                        <div class="btn-group">
                            <a href="#" id="list" class="list-all btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
                            </span></a> <a href="#" id="grid" class="grid-all btn btn-default btn-sm"><span
                                class="glyphicon glyphicon-th"></span></a>
                        </div>
                    </div>
				</div>	';

            $output .= '<div class="event-header-list events-hidens"> ';
            $output .= '<div class="col-xs-12 col-md-4"><div class="ev_name"><p>Name</p> </div><div class="ev_cat"><p>Category</p></div></div>';
            $output .= '<div class="col-xs-12 col-md-5"><div class="ev_desc"><p>Description</p> </div><div class="ev_date"><p>Start Date</p><p>End Date</p></div></div>';
            $output .= '<div class="col-xs-12 col-md-3"><div class="ev_rating"><p>Rating</p><p>Country</p> </div><div class="ev_links"><p>Links</p></div></div>';
            $output .= '</div>';

            $output .= '<div class="event-list column-3">';
            while ($wp_query_adv->have_posts()) {
                $wp_query_adv->the_post();

                $cur_post_id = get_the_ID();
                $event_start_date = get_post_meta($cur_post_id, 'event_start_date', true);
                $event_end_date = get_post_meta($cur_post_id, 'event_end_date', true);

                $event_start_date_last = date_format(date_create($event_start_date), "Y-m-d");
                $event_end_date_last = date_format(date_create($event_end_date), "Y-m-d");
                $date_now = date("Y-m-d");

                if (!empty($event_start_date) or !empty($event_end_date)) {

                    if ($event_start_date_last > $date_now) {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                }
            }

            while ($wp_query_no_adv->have_posts()) {
                $wp_query_no_adv->the_post();

                $cur_post_id = get_the_ID();
                $event_start_date = get_post_meta($cur_post_id, 'event_start_date', true);
                $event_end_date = get_post_meta($cur_post_id, 'event_end_date', true);

                $event_start_date_last = date_format(date_create($event_start_date), "Y-m-d");
                $event_end_date_last = date_format(date_create($event_end_date), "Y-m-d");
                $date_now = date("Y-m-d");

                if (!empty($event_start_date) or !empty($event_end_date)) {

                    if ($event_start_date_last > $date_now) {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                }
            }
            $output .= '</div>';
        }
        wp_reset_postdata();

        /* if ($atts["allbutton"] == "true") {
             $output .= '<a href="' . esc_url(get_term_link($eventcat_term_term_id)) . '" class="all-button">' . esc_html__('All', 'eventchamp') . ' ' . esc_attr($eventcat_term_name) . ' ' . esc_html__('Events', 'eventchamp') . '</a>';
         }*/
        $output .= '</div>';

        // выводим по очереди вкладку с каждым тип ICO

        $output .= '<div role="tabpanel" class="tab-pane" id="events_past">';

        $wp_query_adv = new WP_Query($args_adv);
        $wp_query_no_adv = new WP_Query($args_no_adv);;

        if (!empty($wp_query_adv) || !empty($wp_query_no_adv)) {

            $output .= '
				<div class="sort_home">
				<div class="sort_home_text"><span><a href="#events_all" aria-controls="events_all" role="tab" data-toggle="tab">All</a><span> events with
				<span><a href="#events_active" aria-controls="events_active" role="tab" data-toggle="tab">Active ICO</a><span>
				with <a href="#events_upcoming" aria-controls="events_upcoming" role="tab" data-toggle="tab">Upcoming ICO</a><span>
				with <a href="#events_past" aria-controls="events_past" role="tab" data-toggle="tab">Past ICO</a><span>
				 </div>
                    <div class="well well-sm ">
                        <div class="btn-group">
                            <a href="#" id="list" class="list-all btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
                            </span></a> <a href="#" id="grid" class="grid-all btn btn-default btn-sm"><span
                                class="glyphicon glyphicon-th"></span></a>
                        </div>
                    </div>
				</div>	';

            $output .= '<div class="event-header-list events-hidens"> ';
            $output .= '<div class="col-xs-12 col-md-4"><div class="ev_name"><p>Name</p> </div><div class="ev_cat"><p>Category</p></div></div>';
            $output .= '<div class="col-xs-12 col-md-5"><div class="ev_desc"><p>Description</p> </div><div class="ev_date"><p>Start Date</p><p>End Date</p></div></div>';
            $output .= '<div class="col-xs-12 col-md-3"><div class="ev_rating"><p>Rating</p><p>Country</p> </div><div class="ev_links"><p>Links</p></div></div>';
            $output .= '</div>';
            $output .= '<div class="event-list column-3">';
            while ($wp_query_adv->have_posts()) {
                $wp_query_adv->the_post();

                $cur_post_id = get_the_ID();
                $event_start_date = get_post_meta($cur_post_id, 'event_start_date', true);
                $event_end_date = get_post_meta($cur_post_id, 'event_end_date', true);

                $event_start_date_last = date_format(date_create($event_start_date), "Y-m-d");
                $event_end_date_last = date_format(date_create($event_end_date), "Y-m-d");
                $date_now = date("Y-m-d");

                if (!empty($event_start_date) or !empty($event_end_date)) {

                    if ($date_now > $event_end_date) {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                }
            }

            while ($wp_query_no_adv->have_posts()) {
                $wp_query_no_adv->the_post();

                $cur_post_id = get_the_ID();
                $event_start_date = get_post_meta($cur_post_id, 'event_start_date', true);
                $event_end_date = get_post_meta($cur_post_id, 'event_end_date', true);

                $event_start_date_last = date_format(date_create($event_start_date), "Y-m-d");
                $event_end_date_last = date_format(date_create($event_end_date), "Y-m-d");
                $date_now = date("Y-m-d");

                if (!empty($event_start_date) or !empty($event_end_date)) {

                    if ($date_now > $event_end_date) {
                        $output .= eventchamp_event_list_style_4_new($post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status);
                    }
                }
            }
            $output .= '</div>';
        }
        wp_reset_postdata();

        /* if ($atts["allbutton"] == "true") {
             $output .= '<a href="' . esc_url(get_term_link($eventcat_term_term_id)) . '" class="all-button">' . esc_html__('All', 'eventchamp') . ' ' . esc_attr($eventcat_term_name) . ' ' . esc_html__('Events', 'eventchamp') . '</a>';
         }*/
        $output .= '</div>';

        /******** END TABS *********/

        $output .= '</div>';
        $output .= '</div>';
    }
    return $output;
}
