<?php
/**
 * Created by PhpStorm.
 * User: denisov
 * Date: 19.11.2017
 * Time: 15:27
 */

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
            $average_rating = round($sum / $rating_datas, 1);

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

            $counter_width = ($interval_days_past->days / $interval_days_all->days) * 100;
            $output .= '<div class="left-label"><span class="counter-back">
					<span class="counter-bar" style="width: ' . $counter_width . '%;"></span>
				</span>
				<span class="counter-count">' . $interval_days_past->days . ' out of ' . $interval_days_all->days . '</span>';

            /*
            $border_left_width = intval($interval_days_past->days / $interval_days_all->days * 180, null);
            $output .= "<div class='left-label' style='border-left: solid #36a53e " . $border_left_width . "px;'>";
            $output .= "<div class='left-label-inside' >" . $interval_days_left->format('%r%a days') . "</div>";
            */


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
        $social_media_facebook = get_post_meta(get_the_ID(), 'event_social_media_facebook', true);
        $social_media_telegram = get_post_meta(get_the_ID(), 'event_social_media_telegram', true);
        $social_media_medium = get_post_meta(get_the_ID(), 'event_social_media_medium', true);
        $social_media_slack = get_post_meta(get_the_ID(), 'event_social_media_slack', true);
        $social_media_github = get_post_meta(get_the_ID(), 'event_social_media_github', true);
        $social_media_instagram = get_post_meta(get_the_ID(), 'event_social_media_instagram', true);
        $social_media_youtube = get_post_meta(get_the_ID(), 'event_social_media_youtube', true);
        $social_media_bitcointalk = get_post_meta(get_the_ID(), 'event_social_media_bitcointalk', true);

        $social_count = 0;
        if (!empty($official_web_site)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($official_web_site) . "'  title='" . esc_html__('VISIT SITE', 'eventchamp') . "' target='_blank'><i class='fa fa-globe fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }

        if (!empty($social_media_twitter)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_twitter) . "' title='" . esc_html__('Twitter', 'eventchamp') . "' target='_blank'><i class='fa fa-twitter fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }

        if (!empty($social_media_facebook)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_facebook) . "'  title='" . esc_html__('Facebook', 'eventchamp') . "' target='_blank'><i class='fa fa-facebook fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_telegram) && $social_count < 3) {
            //    var_dump($social_media_telegram); die();
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_telegram) . "' title='" . esc_html__('Telegram', 'eventchamp') . "' target='_blank'><i class='fa fa-paper-plane fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_medium) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_medium) . "'  title='" . esc_html__('Medium', 'eventchamp') . "' target='_blank'><i class='fa fa-medium fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_slack) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_slack) . "'   title='" . esc_html__('Slack', 'eventchamp') . "' target='_blank'><i class='fa fa-slack fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_github) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_github) . "'   title='" . esc_html__('Github', 'eventchamp') . "' target='_blank'><i class='fa fa-github fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_instagram) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_instagram) . "'  title='" . esc_html__('Instagram', 'eventchamp') . "' target='_blank'><i class='fa fa-instagram fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_youtube) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_youtube) . "'  title='" . esc_html__('Youtube', 'eventchamp') . "' target='_blank'><i class='fa fa-youtube fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_bitcointalk) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_bitcointalk) . "'  title='" . esc_html__('Bitcointalk', 'eventchamp') . "' target='_blank'><i class='fa fa-bitcoin fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
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
            $average_rating = round($sum / $rating_datas, 1);

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

            $counter_width = ($interval_days_past->days / $interval_days_all->days) * 100;
            $output .= '<div class="left-label"><span class="counter-back">
					<span class="counter-bar" style="width: ' . $counter_width . '%;"></span>
				</span>
				<span class="counter-count">' . $interval_days_past->days . ' out of ' . $interval_days_all->days . '</span>';

            /*
            $border_left_width = intval($interval_days_past->days / $interval_days_all->days * 180, null);
            $output .= "<div class='left-label' style='border-left: solid #36a53e " . $border_left_width . "px;'>";
            $output .= "<div class='left-label-inside' >" . $interval_days_left->format('%r%a days') . "</div>";
            */


        } else {
            $output .= "<div class='left-label' style='border-left: none'>";
            $output .= eventchamp_event_status($post_id);
        }


        $output .= '</div></div></div></div></div>';

        $output .= '<div class="col-xs-12 col-md-3">';
        $output .= '<div class="ev_rating"><p><div class="rating-circle">' . $average_rating . '</div></p></div>';
        $output .= '<div class="ev_location"><p>';
        if (!empty($location)) {
            $output .= '<div class="location">';
            $output .= '<span>' . esc_attr($location->name) . '</span>';
            $output .= '</div>';
        }
        $output .= '</p> </div>';
        $output .= '<div class="ev_links"><p>';
        $output .= '<div class="all_right_labels ">';


        $social_count = 0;
        if (!empty($official_web_site)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($official_web_site) . "'  title='" . esc_html__('VISIT SITE', 'eventchamp') . "' target='_blank'><i class='fa fa-globe fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }

        if (!empty($social_media_twitter)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_twitter) . "' title='" . esc_html__('Twitter', 'eventchamp') . "' target='_blank'><i class='fa fa-twitter fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }

        if (!empty($social_media_facebook)) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_facebook) . "'  title='" . esc_html__('Facebook', 'eventchamp') . "' target='_blank'><i class='fa fa-facebook fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_telegram) && $social_count < 3) {
            //    var_dump($social_media_telegram); die();
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_telegram) . "' title='" . esc_html__('Telegram', 'eventchamp') . "' target='_blank'><i class='fa fa-paper-plane fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_medium) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_medium) . "'  title='" . esc_html__('Medium', 'eventchamp') . "' target='_blank'><i class='fa fa-medium fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_slack) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_slack) . "'   title='" . esc_html__('Slack', 'eventchamp') . "' target='_blank'><i class='fa fa-slack fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_github) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_github) . "'   title='" . esc_html__('Github', 'eventchamp') . "' target='_blank'><i class='fa fa-github fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_instagram) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_instagram) . "'  title='" . esc_html__('Instagram', 'eventchamp') . "' target='_blank'><i class='fa fa-instagram fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_youtube) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_youtube) . "'  title='" . esc_html__('Youtube', 'eventchamp') . "' target='_blank'><i class='fa fa-youtube fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
        }
        if (!empty($social_media_bitcointalk) && $social_count < 3) {
            $output .= "<div class='all_right_labels_url'><a href='" . esc_url($social_media_bitcointalk) . "'  title='" . esc_html__('Bitcointalk', 'eventchamp') . "' target='_blank'><i class='fa fa-bitcoin fa-2x' aria-hidden='true'></i></a></div>";
            $social_count++;
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
