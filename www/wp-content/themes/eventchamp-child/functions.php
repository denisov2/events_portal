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


function eventchamp_schedule( $post_id = "" ) {
    if( !empty( $post_id ) ) {
        $event_schedule = get_post_meta( $post_id, 'event_schedule', true );
        if( !empty( $event_schedule ) ) {
            $output = "";
            $output .= '<div class="panel-group" id="schedule-accardion" role="tablist" aria-multiselectable="true">';
            foreach ( $event_schedule as $event_schedule_item ) {
                if( !empty( $event_schedule_item ) ) {
                    $schedule_rand_id = rand( 0, 999999 );
                    $schedule_title = $event_schedule_item["title"];
                    $schedule_date = $event_schedule_item["event_schedule_date"];
                    $schedule_time = $event_schedule_item["event_schedule_time"];
                    $schedule_description = $event_schedule_item["event_schedule_description"];
                    if( !empty( $event_schedule_item["event_schedule_speakers"] ) ) {
                        $schedule_speakers = $event_schedule_item["event_schedule_speakers"];
                    } else {
                        $schedule_speakers = "";
                    }
                    if( !empty( $schedule_title ) or !empty( $schedule_date ) or !empty( $schedule_time ) ) {
                        $output .= '<div class="panel panel-default">';
                        if( !empty( $schedule_title ) or !empty( $schedule_date ) or !empty( $schedule_time ) ) {
                            $output .= '<div class="panel-heading" role="tab" id="#schedule-heading-' . esc_attr( $schedule_rand_id ) . '">';
                            $output .= '<a role="button" data-toggle="collapse" data-parent="#schedule-accardion" href="#schedule-collapse-' . esc_attr( $schedule_rand_id ) . '" aria-expanded="true" aria-controls="schedule-collapse-' . esc_attr( $schedule_rand_id ) . '">';
                            if( !empty( $schedule_date ) ) {
                                $output .= '<div class="date">' . esc_attr( $schedule_date ) . '</div>';
                            }
                            if( !empty( $schedule_time ) ) {
                                $output .= '<div class="time">' . esc_attr( $schedule_time ) . '</div>';
                            }
                            if( !empty( $schedule_title ) ) {
                                $output .= '<div class="title">' . esc_attr( $schedule_title ) . '</div>';
                            }
                            $output .= '<i class="fa fa-angle-down" aria-hidden="true"></i></a>';
                            $output .= '</div>';
                        }
                        if( !empty( $schedule_description ) or !empty( $schedule_speakers ) ) {
                            $output .= '<div id="schedule-collapse-' . esc_attr( $schedule_rand_id ) . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="schedule-heading-' . esc_attr( $schedule_rand_id ) . '">';
                            $output .= '<div class="panel-body">';
                            if( !empty( $schedule_description ) ) {
                                $output .= '<div class="text">' . $schedule_description . '</div>';
                            }
                            if( !empty( $schedule_speakers ) ) {
                                $output .= '<div class="speakers">';
                                $output .= '<div class="title">' . esc_html__( 'Team', 'eventchamp' ) . ':</div>';
                                $output .= '<div class="list">';
                                $output .= '<ul>';
                                $schedule_speaker_ids = "";
                                $schedule_speaker_for_empty = "";
                                foreach ( $schedule_speakers as $schedule_speaker ) {
                                    $schedule_speaker_ids[] = $schedule_speaker;
                                    $schedule_speaker_for_empty = $schedule_speaker;
                                }

                                if( !empty( $schedule_speaker_ids ) and !empty( $schedule_speaker_for_empty ) ) {
                                    $args_posts = array(
                                        'posts_per_page' => -1,
                                        'post__in' => $schedule_speaker_ids,
                                        'post_status' => 'publish',
                                        'ignore_sticky_posts' => true,
                                        'post_type' => 'speaker',
                                    );
                                    $wp_query = new WP_Query($args_posts);
                                    while ( $wp_query->have_posts() ) {
                                        $wp_query->the_post();
                                        if( !empty( $wp_query ) ) {
                                            $output .= '<li>';
                                            $output .= '<span title="' . get_the_title() . '">';
                                            if ( has_post_thumbnail() ) {
                                                $output .= '<div class="image">' . get_the_post_thumbnail( get_the_ID(), 'eventchamp-speaker-schedule' ) . '</div>';
                                            }

                                            $speaker_name = get_the_title();

                                            $schedule_speaker_detail = ot_get_option( 'schedule_speaker_detail' );
                                            $speaker_profession = get_post_meta( get_the_ID(), 'speaker_profession', true );
                                            $speaker_company = get_post_meta( get_the_ID(), 'speaker_company', true );
                                            if( !empty( $speaker_profession ) or !empty( $speaker_company ) or !empty( $speaker_name ) ) {
                                                $output .= '<div class="desc">';
                                                if( !empty( $speaker_name ) ) {
                                                    $output .= '<div class="name">' . get_the_title() . '</div>';
                                                }
                                                if( $schedule_speaker_detail == "company" ) {
                                                    if( !empty( $speaker_company ) ) {
                                                        $output .= '<div class="company">' . esc_attr( $speaker_company ) . '</div>';
                                                    }
                                                } else {
                                                    if( !empty( $speaker_profession ) ) {
                                                        $output .= '<div class="profession">' . esc_attr( $speaker_profession ) . '</div>';
                                                    }
                                                }
                                                $output .= '</div>';
                                            }
                                            $output .= '</span>';
                                            $output .= '</li>';
                                        }
                                    }
                                    wp_reset_postdata();
                                }
                                $output .= '</ul>';
                                $output .= '</div>';
                                $output .= '</div>';
                            }
                            $output .= '</div>';
                            $output .= '</div>';
                        }
                        $output .= '</div>';
                    }
                }
            }
            $output .= '</div>';
            return $output;
        }
    }
}


function eventchamp_speakers( $post_id = "", $column = "4" ) {
    if( !empty( $post_id ) ) {
        $event_speakers = get_post_meta( $post_id, 'event_speakers', true );
        $output = '';
        if( !empty( $event_speakers ) ) {
            $output .= '<div class="speakers-list column-' . esc_attr( $column ) . '">';
            foreach ( $event_speakers as $event_speaker ) {
                $event_speaker_ids[] = $event_speaker;
            }

            $args_posts = array(
                'posts_per_page' => -1,
                'post__in' => $event_speaker_ids,
                'post_status' => 'publish',
                'ignore_sticky_posts'    => true,
                'post_type' => 'speaker',
            );
            $wp_query = new WP_Query($args_posts);
            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                $social_media_facebook = get_post_meta( get_the_ID(), 'speaker_social_media_facebook', true );
                $social_media_twitter = get_post_meta( get_the_ID(), 'speaker_social_media_twitter', true );
                $social_media_googleplus = get_post_meta( get_the_ID(), 'speaker_social_media_googleplus', true );
                $social_media_instagram = get_post_meta( get_the_ID(), 'speaker_social_media_instagram', true );
                $social_media_youtube = get_post_meta( get_the_ID(), 'speaker_social_media_youtube', true );
                $social_media_flickr = get_post_meta( get_the_ID(), 'speaker_social_media_flickr', true );
                $social_media_soundcloud = get_post_meta( get_the_ID(), 'speaker_social_media_soundcloud', true );
                $social_media_vimeo = get_post_meta( get_the_ID(), 'speaker_social_media_vimeo', true );

                $output .= '<div class="item">';
                if ( has_post_thumbnail() ) {
                    $output .= '<div class="image">';
                    $output .= '<span title="' . get_the_title() . '">';
                    $output .= '';
                    $output .= get_the_post_thumbnail( get_the_ID(), 'eventchamp-speaker' );
                    $output .= '</span>';
                    $output .= '</div>';
                }

                $speakers_title = get_the_title();

                if( !empty( $speakers_title ) ) {
                    $output .= '<div class="name">';
                    $output .= '<span title="' . get_the_title() . '">';
                    $output .= get_the_title();
                    $output .= '</span>';
                    $output .= '</div>';
                }

                $speaker_excerpt = get_the_excerpt();

                if( !empty( $speaker_excerpt ) ) {
                    $output .= '<div class="excerpt">';
                    $output .= get_the_excerpt();
                    $output .= '</div>';
                }

                $output .= '<div class="details">';

                if( !empty( $official_web_site ) or !empty( $social_media_facebook ) or !empty( $social_media_twitter ) or !empty( $social_media_googleplus ) or !empty( $social_media_instagram ) or !empty( $social_media_youtube ) or !empty( $social_media_flickr ) or !empty( $social_media_soundcloud ) or !empty( $social_media_vimeo ) ) {
                    $output .= '<ul class="social-links">';
                    if( !empty( $official_web_site ) ) {
                        $output .= '<li><a href="' . esc_url( $official_web_site ) . '" class="officialsite" title="' . esc_html__( 'Facebook', 'eventchamp' ) . '" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a></li>';
                    }

                    if( !empty( $social_media_facebook ) ) {
                        $output .= '<li><a href="' . esc_url( $social_media_facebook ) . '" class="facebook" title="' . esc_html__( 'Facebook', 'eventchamp' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
                    }

                    if( !empty( $social_media_twitter ) ) {
                        $output .= '<li><a href="' . esc_url( $social_media_twitter ) . '" class="twitter" title="' . esc_html__( 'Twitter', 'eventchamp' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
                    }

                    if( !empty( $social_media_googleplus ) ) {
                        $output .= '<li><a href="' . esc_url( $social_media_googleplus ) . '" class="googleplus" title="' . esc_html__( 'Google+', 'eventchamp' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
                    }

                    if( !empty( $social_media_instagram ) ) {
                        $output .= '<li><a href="' . esc_url( $social_media_instagram ) . '" class="instagram" title="' . esc_html__( 'Instagram', 'eventchamp' ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>';
                    }

                    if( !empty( $social_media_youtube ) ) {
                        $output .= '<li><a href="' . esc_url( $social_media_youtube ) . '" class="youtube" title="' . esc_html__( 'YouTube', 'eventchamp' ) . '" target="_blank"><i class="fa fa-youtube"></i></a></li>';
                    }

                    if( !empty( $social_media_flickr ) ) {
                        $output .= '<li><a href="' . esc_url( $social_media_flickr ) . '" class="flickr" title="' . esc_html__( 'Flickr', 'eventchamp' ) . '" target="_blank"><i class="fa fa-flickr"></i></a></li>';
                    }

                    if( !empty( $social_media_soundcloud ) ) {
                        $output .= '<li><a href="' . esc_url( $social_media_soundcloud ) . '" class="soundcloud" title="' . esc_html__( 'SoundCloud', 'eventchamp' ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a></li>';
                    }

                    if( !empty( $social_media_vimeo ) ) {
                        $output .= '<li><a href="' . esc_url( $social_media_vimeo ) . '" class="vimeo" title="' . esc_html__( 'Vimeo', 'eventchamp' ) . '" target="_blank"><i class="fa fa-vimeo"></i></a></li>';
                    }
                    $output .= '</ul>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }
            wp_reset_postdata();
            $output .= '</div>';
        }
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