<?php
/**
 * The template for displaying single event
 */
get_header(); ?>

<?php eventchamp_sub_content_before(); ?>
<?php
$post_post_title = ot_get_option('post_post_title');
if (!$post_post_title == 'off' or $post_post_title == 'on') {
    eventchamp_archive_title();
} else {
    eventchamp_archive_title_blank();
}

$event_disable_featured_image_gallery = get_post_meta(get_the_ID(), 'event_disable_featured_image_gallery', true);
$event_featured_image = get_post_meta(get_the_ID(), 'event_featured_image', true);
$event_location = get_post_meta(get_the_ID(), 'event_location', true);
$event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true);
$event_start_time = get_post_meta(get_the_ID(), 'event_start_time', true);
$event_end_date = get_post_meta(get_the_ID(), 'event_end_date', true);
$event_end_time = get_post_meta(get_the_ID(), 'event_end_time', true);
$event_organizer = get_post_meta(get_the_ID(), 'event_organizer', true);
$event_phone = get_post_meta(get_the_ID(), 'event_phone', true);
$event_email = get_post_meta(get_the_ID(), 'event_email', true);
$event_extra_sidebar_button_link = get_post_meta(get_the_ID(), 'event_extra_sidebar_button_link', true);
$event_extra_sidebar_button_title = get_post_meta(get_the_ID(), 'event_extra_sidebar_button_title', true);
$event_extra_sidebar_target = get_post_meta(get_the_ID(), 'event_extra_sidebar_target', true);
$event_detailed_address = get_post_meta(get_the_ID(), 'event_detailed_address', true);
$official_web_site = get_post_meta(get_the_ID(), 'event_official_web_site', true);
$social_media_facebook = get_post_meta(get_the_ID(), 'event_social_media_facebook', true);
$social_media_twitter = get_post_meta(get_the_ID(), 'event_social_media_twitter', true);
$social_media_googleplus = get_post_meta(get_the_ID(), 'event_social_media_googleplus', true);
$social_media_instagram = get_post_meta(get_the_ID(), 'event_social_media_instagram', true);
$social_media_youtube = get_post_meta(get_the_ID(), 'event_social_media_youtube', true);
$social_media_flickr = get_post_meta(get_the_ID(), 'event_social_media_flickr', true);
$social_media_soundcloud = get_post_meta(get_the_ID(), 'event_social_media_soundcloud', true);
$social_media_vimeo = get_post_meta(get_the_ID(), 'event_social_media_vimeo', true);
$social_media_linkedin = get_post_meta(get_the_ID(), 'event_social_media_linkedin', true);
$event_remaining_tickets = get_post_meta(get_the_ID(), 'event_remaining_tickets', true);
$event_tickets = get_post_meta(get_the_ID(), 'event_tickets', true);
$event_sponsors = get_post_meta(get_the_ID(), 'event_sponsors', true);
$event_schedule = get_post_meta(get_the_ID(), 'event_schedule', true);
$event_speakers = get_post_meta(get_the_ID(), 'event_speakers', true);
$event_venue = get_post_meta(get_the_ID(), 'event_venue', true);
$event_image_gallery = get_post_meta(get_the_ID(), 'event_image_gallery', true);
$event_google_street_link = get_post_meta(get_the_ID(), 'event_google_street_link', true);
$event_faq = get_post_meta(get_the_ID(), 'event_faq', true);
$event_cats = wp_get_post_terms(get_the_ID(), 'eventcat');
$event_tags = wp_get_post_terms(get_the_ID(), 'event_tags');
$event_contact_form = ot_get_option('event_contact_form');
$googlemapapi = ot_get_option('googlemapapi');
$event_related_events = ot_get_option('event_related_events');
$event_extra_tab1_content = get_post_meta(get_the_ID(), 'event_extra_tab1_content', true);
$event_extra_tab1_title = get_post_meta(get_the_ID(), 'event_extra_tab1_title', true);
$event_extra_tab2_content = get_post_meta(get_the_ID(), 'event_extra_tab2_content', true);
$event_extra_tab2_title = get_post_meta(get_the_ID(), 'event_extra_tab2_title', true);
$event_media_tab_images = get_post_meta(get_the_ID(), 'event_media_tab_images', true);


// CHANGES
$event_adv = get_post_meta(get_the_ID(), 'event_adv', true);

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


?>
<?php eventchamp_container_before(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php eventchamp_row_before(); ?>
    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left right fixedSidebar">
        <div class="post-list post-content-list">
            <article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="post-wrapper">


                    <?php

                    /*

                        if( !empty( $event_image_gallery ) and $event_disable_featured_image_gallery == "off" or !$event_disable_featured_image_gallery == "on" ) {
                            $post_gallery_images =  explode( ',', get_post_meta( get_the_ID(), 'event_image_gallery', true ) );
                            if( !empty( $post_gallery_images ) ) {
                                echo '<div class="post-featured-header">';
                                    echo '<div class="swiper-container gloria-sliders post-featured-header-image-gallery" data-item="1" data-column-space="0">';
                                        echo '<div class="swiper-wrapper">';
                                            foreach ($post_gallery_images as $image) {
                                                echo '<div class="swiper-slide">' . wp_get_attachment_image( $image, 'eventchamp-big-event', true, true ) . '</div>';
                                            }
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="swiper-button-next next"></div>';
                                    echo '<div class="swiper-button-prev prev"></div>';
                                echo '</div>';
                            }
                        } elseif( !empty( $event_featured_image ) and $event_disable_featured_image_gallery == "on" ) {
                            echo '<div class="post-featured-header">';
                                $img_id = eventchamp_attachment_id( $event_featured_image );
                                echo '<div class="swiper-slide">' . wp_get_attachment_image( $img_id, 'eventchamp-big-post', true, true ) . '</div>';
                            echo '</div>';
                        } else {
                            if ( has_post_thumbnail() ) {
                                echo '<div class="post-featured-header">';
                                    echo get_the_post_thumbnail( get_the_ID(), 'eventchamp-big-post' );
                                echo '</div>';
                            }
                        }
                    */
                    ?>

                    <div class="event-wrapper">

                        <div class="event-one-header">
                            <div class="event-info">
                                <div class="event-info-dates col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                                    <?php if (has_post_thumbnail()) {
                                        echo '<div class="post-featured-header">';
                                        if(!empty (get_the_post_thumbnail(get_the_ID(), array(320, 320)) ) ) {
                                            echo get_the_post_thumbnail(get_the_ID(), array(320, 320))  ;
                                        } else {
                                            echo '<div class="image">';
                                            echo '<img src="/wp-content/themes/eventchamp-child/No_image_available.svg"  />';
                                            echo '</div>';
                                        }
                                        echo '</div>';
                                    }

                                    $event_start_date_last = date_format(date_create($event_start_date), "Y-m-d");
                                    $event_end_date_last = date_format(date_create($event_end_date), "Y-m-d");
                                    $date_now = date("Y-m-d");

                                    $datetime_start = new DateTime($event_start_date);
                                    $datetime_end = new DateTime($event_end_date);
                                    $datetime_now = new DateTime($date_now);

                                    $interval_days_left = $datetime_now->diff($datetime_end);
                                    $interval_days_past = $datetime_start->diff($datetime_now);
                                    $interval_days_all = $datetime_start->diff($datetime_end);

                                    $border_left_width = intval($interval_days_past->days / $interval_days_all->days * 180, null);
                                    ?>
                                    <div class="all_labels">

                                        <?php
                                        if ($date_now >= $event_start_date_last && $date_now <= $event_end_date_last) {
                                            $counter_width = ($interval_days_past->days / $interval_days_all->days) * 100;
                                            echo '<div class="left-label"><span class="counter-back">
                            					<span class="counter-bar" style="width: ' . $counter_width . '%;"></span>
				                                </span>
				                        <span class="counter-count">' . $interval_days_past->days . ' out of ' . $interval_days_all->days . '</span>';
                                        } else {
                                            echo "<div class='left-label' style='border-left: none'>";
                                            echo eventchamp_event_status(get_the_ID());
                                        }
                                        ?>
                                    </div>
                                    <div class="left-labels"><?= $event_start_date ?> </div>
                                    <div class="left-labelss"><?= $event_end_date ?></div>
                                </div>
                                <div class="button-content">
                                    <a href="#subscribe-tab" class="ticketLink" title="Remaining Ticket">
                                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                        <span class="content">SUBSCRIBE</span>
                                    </a>
                                </div>
                            </div>


                            <div class="event-info-general  col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                                <div class="event-info-general  col-lg-10 col-md-10 col-sm-10 col-xs-10 ">
                                    <h1>
                                        <?= get_the_title() ?></h1>
                                </div>
                                <div class="event-average-rating col-lg-2 col-md-2 col-sm-2 col-xs-2  ">
                                    <div class="rating-circle"><?= $average_rating ?></div>
                                </div>
                                <?php
                                $event_cats = wp_get_post_terms(get_the_ID(), 'eventcat');
                                if (!empty($event_cats)) {
                                    foreach ($event_cats as $event_cat) {
                                        echo '<div class="category"><ul class="post-categories">';
                                        echo '<li><a href="' . get_term_link($event_cat->term_id) . '" title="' . esc_attr($event_cat->name) . '">' . esc_attr($event_cat->name) . '</a></li>';
                                        echo '</ul></div>';
                                    }
                                }
                                ?>
                                <div class="clear"></div>
                                <div class="event-description"><p><?= the_excerpt() ?> </p></div>

                                <?php $locations = wp_get_post_terms(get_the_ID(), 'location');
                                if (!empty($locations)) { ?>
                                <div class="event-locations">
                                    <div class="event-details-widget event-locations-left col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <ul>
                                                <li>
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span><?php echo esc_html__('Location', 'eventchamp'); ?></span>
                                                    <div>
                                                        <?php
                                                        foreach($locations as $location) {
                                                            echo '<a href="' . esc_url(get_term_link($location)) . '" title="' . esc_attr($location->name) . '">' . esc_attr($location->name) . '</a> ';
                                                        }
                                                        ?>
                                                    </div>
                                                </li>
                                        </ul>
                                    </div>
                                </div>

                                <?php }  ?>

                                <?php $event_tags = wp_get_post_terms(get_the_ID(), 'event_tags');

                                if (!empty($event_tags)) { ?>
                                    <div class="event-locations">
                                        <div class="event-details-widget event-locations-left col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <ul>
                                                <li>
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span><?php echo esc_html__('Platforms', 'eventchamp'); ?></span>
                                                    <div>
                                                        <?php
                                                        foreach($event_tags as $event_tag) {
                                                            echo '<a href="' . esc_url(get_term_link($event_tag)) . '" title="' . esc_attr($event_tag->name) . '">' . esc_attr($event_tag->name) . '</a> ';
                                                        }
                                                        ?>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                <?php }  ?>

                                <div class="event-share"><span>SHARE:</span>
                                    <script type="text/javascript">(function (w, doc) {
                                            if (!w.__utlWdgt) {
                                                w.__utlWdgt = true;
                                                var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
                                                s.type = 'text/javascript';
                                                s.charset = 'UTF-8';
                                                s.async = true;
                                                s.src = ('https:' == w.location.protocol ? 'https' : 'http') + '://w.uptolike.com/widgets/v1/uptolike.js';
                                                var h = d[g]('body')[0];
                                                h.appendChild(s);
                                            }
                                        })(window, document);
                                    </script>
                                    <div data-mobile-view="true" data-share-size="30" data-like-text-enable="false"
                                         data-background-alpha="0.0" data-pid="1712604" data-mode="share"
                                         data-background-color="#ffffff" data-hover-effect="rotate-cw"
                                         data-share-shape="round-rectangle" data-share-counter-size="12"
                                         data-icon-color="#ffffff" data-mobile-sn-ids="fb.vk.tw.ok.wh.vb.tm."
                                         data-text-color="#000000" data-buttons-color="#ffffff"
                                         data-counter-background-color="#ffffff" data-share-counter-type="disable"
                                         data-orientation="horizontal" data-following-enable="false"
                                         data-sn-ids="fb.tw.gp.em.tm." data-preview-mobile="false"
                                         data-selection-enable="false" data-exclude-show-more="true"
                                         data-share-style="11" data-counter-background-alpha="1.0"
                                         data-top-button="false" class="uptolike-buttons"></div>
                                </div>

                            </div>
                        </div>

                        <div class="event-ratings-info  col-md-12  ">
                            <div class="event-average-rating col-lg-2 col-md-2 col-sm-2 col-xs-12  ">
                                <h5>Average Rating </h5>

                                <div class="rating-circle"><?= $average_rating ?></div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12  ">
                                <?php
                                $i = 1;
                                foreach ($ratings_titles as $key => $criteria) {

                                    if (isset ($rating_data[$key]) && $rating_data[$key]) {
                                        $rating = isset ($rating_data[$key]) ? $rating_data[$key] : 'Not set';
                                        $border_left_width = $rating * 30;
                                        if ($i % 3 == 2) $class = "rating-box-2";
                                        elseif ($i % 3 == 0) $class = "rating-box-3";
                                        else $class = "";

                                        ?>
                                        <div class="rating-item">
                                            <div class="rating-label"><?= $criteria ?></div>
                                            <div class="rating-box <?= $class ?> "
                                                 style="border-left-width: <?= $border_left_width ?>px"><?= $rating ?>
                                                /10
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>

                            </div>
                        </div>
                        <div class="clear"></div>
                        <?php
                        $content_control = get_the_content();
                        if (!empty($content_control)) {
                            echo '<div class="post-content-body">';
                            the_content();
                            echo '</div>';
                        }
                        ?>
                        <div class="button-content-all col-md-12">
                            <?php if (!empty($official_web_site)) {
                                echo '<div class="button-content bottom"><a href="' . esc_url($official_web_site) . '" class="officialsite" title="' . esc_html__('VISIT SITE', 'eventchamp') . '" target="_blank"><i class="fa fa-link" aria-hidden="true"></i><span class="content">VISIT SITE</span></a></div>';
                            } ?>

                            <div class="button-content bottom">
                                <a href="#subscribe-tab" class="ticketLink" title="Remaining Ticket">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    <span class="content">WHITEPAPER</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($event_schedule) or !empty($event_speakers) or !empty($event_tickets) or !empty($event_detailed_address) or !empty($event_google_street_link) or !empty($event_faq) or !empty($event_extra_tab1_content) or !empty($event_media_tab_images) or $event_related_events == "on") { ?>
                        <div class="event-detail-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <?php if (!empty($event_schedule)) { ?>
                                    <li role="presentation">
                                        <a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo esc_html__('Schedule', 'eventchamp'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($event_speakers)) { ?>
                                    <li role="presentation">
                                        <a href="#speakers" aria-controls="speakers" role="tab" data-toggle="tab">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <?php echo esc_html__('Speakers', 'eventchamp'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($event_tickets)) { ?>
                                    <li role="presentation">
                                        <a href="#tickets" aria-controls="tickets" role="tab" data-toggle="tab">
                                            <i class="fa fa-ticket" aria-hidden="true"></i>
                                            <?php echo esc_html__('Ticket & Prices', 'eventchamp'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($event_detailed_address)) { ?>
                                    <li role="presentation">
                                        <a href="#map" aria-controls="map" role="tab" data-toggle="tab">
                                            <i class="fa fa-map" aria-hidden="true"></i>
                                            <?php echo esc_html__('Map', 'eventchamp'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($event_google_street_link)) { ?>
                                    <li role="presentation">
                                        <a href="#3dtour" aria-controls="3dtour" role="tab" data-toggle="tab">
                                            <i class="fa fa-street-view" aria-hidden="true"></i>
                                            <?php echo esc_html__('3D Tour', 'eventchamp'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($event_contact_form)) { ?>
                                    <li role="presentation">
                                        <a href="#contactform" aria-controls="contactform" role="tab" data-toggle="tab">
                                            <i class="fa fa-wpforms" aria-hidden="true"></i>
                                            <?php echo esc_html__('Contact Form', 'eventchamp'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($event_faq)) { ?>
                                    <li role="presentation">
                                        <a href="#faq" aria-controls="faq" role="tab" data-toggle="tab">
                                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            <?php echo esc_html__('FAQ', 'eventchamp'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($event_extra_tab1_content) and !empty($event_extra_tab1_title)) { ?>
                                    <li role="presentation">
                                        <a href="#extra-tab1" aria-controls="extra-tab1" role="tab" data-toggle="tab">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            <?php echo get_post_meta(get_the_ID(), 'event_extra_tab1_title', true); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($event_extra_tab2_content) and !empty($event_extra_tab2_title)) { ?>
                                    <li role="presentation">
                                        <a href="#extra-tab2" aria-controls="extra-tab2" role="tab" data-toggle="tab">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            <?php echo get_post_meta(get_the_ID(), 'event_extra_tab2_title', true); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($event_media_tab_images)) { ?>
                                    <li role="presentation">
                                        <a href="#media-images" aria-controls="media-images" role="tab"
                                           data-toggle="tab">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            <?php echo esc_html__('Images', 'eventchamp'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if ($event_related_events == "on") { ?>
                                    <li role="presentation">
                                        <a href="#related-events" aria-controls="related-events" role="tab"
                                           data-toggle="tab">
                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                            <?php echo esc_html__('Related Events', 'eventchamp'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <?php if (!empty($event_schedule)) { ?>
                                    <div role="tabpanel" class="tab-pane eventchamp-dropdown" id="schedule">
                                        <?php echo eventchamp_schedule($post_id = get_the_ID()); ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($event_speakers)) { ?>
                                    <div role="tabpanel" class="tab-pane" id="speakers">
                                        <?php echo eventchamp_speakers($post_id = get_the_ID(), $column = "3"); ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($event_tickets)) { ?>
                                    <div role="tabpanel" class="tab-pane" id="tickets">
                                        <?php echo eventchamp_pricing_table($post_id = get_the_ID(), $text_column = "1"); ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($event_detailed_address)) { ?>
                                    <div role="tabpanel" class="tab-pane" id="map">
                                        <?php
                                        if (!empty($googlemapapi)) {
                                            $googlemapapi = $googlemapapi;
                                        } else {
                                            $googlemapapi = "AIzaSyCJCkvBbxfRoHwUrj9x3uptUEDodTYGMbo";
                                        }
                                        ?>
                                        <iframe width="100%" height="450" frameborder="0"
                                                src="https://www.google.com/maps/embed/v1/place?key=<?php echo esc_attr($googlemapapi); ?>&q=<?php echo esc_attr($event_detailed_address); ?>"></iframe>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($event_google_street_link)) { ?>
                                    <div role="tabpanel" class="tab-pane" id="3dtour">
                                        <iframe width="100%" height="450" frameborder="0"
                                                src="<?php echo esc_url($event_google_street_link); ?>"></iframe>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($event_contact_form)) { ?>
                                    <div role="tabpanel" class="tab-pane" id="contactform">
                                        <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($event_contact_form) . '"]'); ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($event_faq)) { ?>
                                    <div role="tabpanel" class="tab-pane eventchamp-dropdown" id="faq">
                                        <?php echo eventchamp_faq($post_id = get_the_ID()); ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($event_extra_tab1_content)) { ?>
                                    <div role="tabpanel" class="tab-pane eventchamp-dropdown" id="extra-tab1">
                                        <?php echo wpautop(get_post_meta(get_the_ID(), 'event_extra_tab1_content', true)); ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($event_extra_tab2_content)) { ?>
                                    <div role="tabpanel" class="tab-pane eventchamp-dropdown" id="extra-tab2">
                                        <?php echo wpautop(get_post_meta(get_the_ID(), 'event_extra_tab2_content', true)); ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($event_media_tab_images)) { ?>
                                    <div role="tabpanel" class="tab-pane eventchamp-dropdown" id="media-images">
                                        <?php
                                        $event_media_tab_images = explode(',', get_post_meta(get_the_ID(), 'event_media_tab_images', true));
                                        if (!empty($event_media_tab_images)) {
                                            echo '<div class="media-images-tab-list">';
                                            echo '<ul>';
                                            foreach ($event_media_tab_images as $event_media_tab_image) {
                                                $image_big_url = wp_get_attachment_image_url($event_media_tab_image, 'eventchamp-event-slider', true, true);
                                                echo '<li><a href="' . esc_url($image_big_url) . '" title="" rel="prettyPhoto[media-images-tab]">' . wp_get_attachment_image($event_media_tab_image, 'eventchamp-event-sponsor-big', true, true) . '</a></li>';
                                            }
                                            echo '</ul>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if ($event_related_events == "on") { ?>
                                    <div role="tabpanel" class="tab-pane eventchamp-dropdown" id="related-events">
                                        <?php eventchamp_related_events(); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </article>
        </div>
    </div>
    <?php
    if (!empty($event_location) or !empty($event_start_date) or !empty($event_start_time) or !empty($event_end_date) or !empty($event_end_time) or !empty($event_organizer) or !empty($event_cats) or !empty($event_phone) or !empty($event_email) or !empty($event_detailed_address) or !empty($official_web_site) or !empty($social_media_facebook) or !empty($social_media_twitter) or !empty($social_media_googleplus) or !empty($social_media_instagram) or !empty($social_media_youtube) or !empty($social_media_flickr) or !empty($social_media_soundcloud) or !empty($social_media_vimeo) or !empty($social_media_linkedin) or !empty($event_remaining_tickets) or !empty($event_tickets) or !empty($event_sponsors) or !empty($event_tags) or !empty($event_venue)) {
        ?>
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 event-detail-widgets">
            <?php if (!empty($event_location) or !empty($event_start_date) or !empty($event_start_time) or !empty($event_end_date) or !empty($event_end_time) or !empty($event_organizer) or !empty($event_cats) or !empty($event_phone) or !empty($event_email) or !empty($event_detailed_address) or !empty($official_web_site) or !empty($social_media_facebook) or !empty($social_media_twitter) or !empty($social_media_googleplus) or !empty($social_media_instagram) or !empty($social_media_youtube) or !empty($social_media_flickr) or !empty($social_media_soundcloud) or !empty($social_media_vimeo) or !empty($social_media_linkedin) or !empty($event_remaining_tickets) or !empty($event_tickets) or !empty($event_sponsors) or !empty($event_tags)) { ?>
                <div class="widget-box event-details-widget">
                    <div class="widget-title"><?php echo esc_html__('Event', 'eventchamp'); ?>
                        <span><?php echo esc_html__('Details', 'eventchamp'); ?></span></div>
                    <ul>
                        <?php
                        $event_start_date_last = date_format(date_create($event_start_date), "Y-m-d");
                        $event_end_date_last = date_format(date_create($event_end_date), "Y-m-d");
                        $date_now = date("Y-m-d");

                        if (!empty($event_start_date) and $event_start_date_last > $date_now) {
                            ?>
                            <li class="counter">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>

                                <div>
                                    <div class="getting-started">
                                        <div class="days">
                                            <div class="count"></div>
                                            <div class="title"><?php esc_html_e('Days', 'eventchamp'); ?></div>
                                        </div>
                                        <div class="hours">
                                            <div class="count"></div>
                                            <div class="title"><?php esc_html_e('Hours', 'eventchamp'); ?></div>
                                        </div>
                                        <div class="minutes">
                                            <div class="count"></div>
                                            <div class="title"><?php esc_html_e('Min', 'eventchamp'); ?></div>
                                        </div>
                                        <div class="secondes">
                                            <div class="count"></div>
                                            <div class="title"><?php esc_html_e('Sec', 'eventchamp'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_start_date) or !empty($event_start_time)) { ?>
                            <li>
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Start Date', 'eventchamp'); ?></span>

                                <div>
                                    <?php
                                    echo eventchamp_global_date_converter($date = $event_start_date) . ' ' . esc_attr($event_start_time);
                                    ?>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_end_date) or !empty($event_end_time)) { ?>
                            <li>
                                <i class="fa fa-calendar-times-o" aria-hidden="true"></i>
                                <span><?php echo esc_html__('End Date', 'eventchamp'); ?></span>

                                <div>
                                    <?php
                                    echo eventchamp_global_date_converter($date = $event_end_date) . ' ' . esc_attr($event_end_time);
                                    ?>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_location)) {
                            $location = get_term($event_location, 'location');
                            if (!empty($location)) {
                                ?>
                                <li>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span><?php echo esc_html__('Location', 'eventchamp'); ?></span>

                                    <div>
                                        <?php
                                        echo '<a href="' . esc_url(get_term_link($location->term_id)) . '" title="' . esc_attr($location->name) . '">' . esc_attr($location->name) . '</a>';
                                        ?>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                        <?php if (!empty($event_venue)) { ?>
                            <li>
                                <i class="fa fa-map-signs" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Venue', 'eventchamp'); ?></span>

                                <div><a href="<?php echo get_the_permalink($event_venue); ?>"
                                        title="<?php echo get_the_title($event_venue); ?>"><?php echo get_the_title($event_venue); ?></a>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_organizer)) {
                            $organizer = get_term($event_organizer, 'organizer');
                            if (!empty($organizer)) {
                                ?>
                                <li>
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                    <span><?php echo esc_html__('Organizer', 'eventchamp'); ?></span>

                                    <div>
                                        <?php
                                        echo esc_attr($organizer->name);
                                        ?>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                        <?php if (!empty($event_cats)) { ?>
                            <li>
                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Category', 'eventchamp'); ?></span>

                                <div>
                                    <ul class="list">
                                        <?php
                                        foreach ($event_cats as $event_cat) {
                                            echo '<li><a href="' . get_term_link($event_cat->term_id) . '" title="' . esc_attr($event_cat->name) . '">' . esc_attr($event_cat->name) . '</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_phone)) { ?>
                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Phone', 'eventchamp'); ?></span>

                                <div>
                                    <?php
                                    echo '<a href="tel:' . esc_attr($event_phone) . '">' . esc_attr($event_phone) . '</a>';
                                    ?>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_email)) { ?>
                            <li>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Email', 'eventchamp'); ?></span>

                                <div>
                                    <?php
                                    echo '<a href="mailto:' . esc_attr($event_email) . '">' . esc_attr($event_email) . '</a>';
                                    ?>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_detailed_address)) { ?>
                            <li>
                                <i class="fa fa-map-o" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Address', 'eventchamp'); ?></span>

                                <div>
                                    <?php
                                    echo esc_attr($event_detailed_address);
                                    ?>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if (!empty($official_web_site) or !empty($social_media_facebook) or !empty($social_media_twitter) or !empty($social_media_googleplus) or !empty($social_media_instagram) or !empty($social_media_youtube) or !empty($social_media_flickr) or !empty($social_media_soundcloud) or !empty($social_media_vimeo) or !empty($social_media_linkedin)) { ?>
                            <li>
                                <i class="fa fa-share-alt" aria-hidden="true"></i>
                                <span><?php echo esc_html__('Web Sites', 'eventchamp'); ?></span>

                                <div>
                                    <?php
                                    echo '<ul class="official-sites">';
                                    if (!empty($official_web_site)) {
                                        echo '<li><a href="' . esc_url($official_web_site) . '" class="officialsite" title="' . esc_html__('Facebook', 'eventchamp') . '" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a></li>';
                                    }

                                    if (!empty($social_media_facebook)) {
                                        echo '<li><a href="' . esc_url($social_media_facebook) . '" class="facebook" title="' . esc_html__('Facebook', 'eventchamp') . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
                                    }

                                    if (!empty($social_media_twitter)) {
                                        echo '<li><a href="' . esc_url($social_media_twitter) . '" class="twitter" title="' . esc_html__('Twitter', 'eventchamp') . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
                                    }

                                    if (!empty($social_media_googleplus)) {
                                        echo '<li><a href="' . esc_url($social_media_googleplus) . '" class="googleplus" title="' . esc_html__('Google+', 'eventchamp') . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
                                    }

                                    if (!empty($social_media_instagram)) {
                                        echo '<li><a href="' . esc_url($social_media_instagram) . '" class="instagram" title="' . esc_html__('Instagram', 'eventchamp') . '" target="_blank"><i class="fa fa-instagram"></i></a></li>';
                                    }

                                    if (!empty($social_media_youtube)) {
                                        echo '<li><a href="' . esc_url($social_media_youtube) . '" class="youtube" title="' . esc_html__('YouTube', 'eventchamp') . '" target="_blank"><i class="fa fa-youtube"></i></a></li>';
                                    }

                                    if (!empty($social_media_flickr)) {
                                        echo '<li><a href="' . esc_url($social_media_flickr) . '" class="flickr" title="' . esc_html__('Flickr', 'eventchamp') . '" target="_blank"><i class="fa fa-flickr"></i></a></li>';
                                    }

                                    if (!empty($social_media_soundcloud)) {
                                        echo '<li><a href="' . esc_url($social_media_soundcloud) . '" class="soundcloud" title="' . esc_html__('SoundCloud', 'eventchamp') . '" target="_blank"><i class="fa fa-soundcloud"></i></a></li>';
                                    }

                                    if (!empty($social_media_vimeo)) {
                                        echo '<li><a href="' . esc_url($social_media_vimeo) . '" class="vimeo" title="' . esc_html__('Vimeo', 'eventchamp') . '" target="_blank"><i class="fa fa-vimeo"></i></a></li>';
                                    }

                                    if (!empty($social_media_linkedin)) {
                                        echo '<li><a href="' . esc_url($social_media_linkedin) . '" class="linkedin" title="' . esc_html__('LinkedIn', 'eventchamp') . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
                                    }
                                    echo "<ul>";
                                    ?>
                                </div>
                            </li>
                            <li class="extraGap"></li>
                        <?php } ?>
                        <?php if (!empty($event_remaining_tickets)) { ?>
                            <li class="button-content">
                                <a href="#ticket-tab" class="ticketLink"
                                   title="<?php echo esc_html__('Remaining Ticket', 'eventchamp'); ?>">
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    <span class="title"><?php echo esc_html__('Remaining Ticket', 'eventchamp'); ?>
                                        :</span>
                                    <span
                                        class="content"><?php $ticket_product_id = wc_get_product($event_remaining_tickets);
                                        echo $ticket_product_id->get_stock_quantity(); ?><?php echo esc_html__('Ticket', 'eventchamp'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_tickets)) { ?>
                            <li class="button-content">
                                <a href="#ticket-tab" class="ticketLink"
                                   title="<?php echo esc_html__('Buy Ticket & Show Details', 'eventchamp'); ?>">
                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                    <span
                                        class="title"><?php echo esc_html__('Buy Ticket & Show Details', 'eventchamp'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_contact_form)) { ?>
                            <li class="button-content">
                                <a href="#ticket-tab" class="contactLink"
                                   title="<?php echo esc_html__('Send A Message', 'eventchamp'); ?>">
                                    <i class="fa fa-wpforms" aria-hidden="true"></i>
                                    <span class="title"><?php echo esc_html__('Send A Message', 'eventchamp'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (!empty($event_extra_sidebar_button_link) or !empty($event_extra_sidebar_button_title)) { ?>
                            <li class="button-content">
                                <a href="<?php echo esc_url($event_extra_sidebar_button_link); ?>"
                                   target="<?php echo esc_attr($event_extra_sidebar_target); ?>"
                                   title="<?php echo esc_attr($event_extra_sidebar_button_title); ?>">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                    <span
                                        class="title"><?php echo esc_attr($event_extra_sidebar_button_title); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>




            <?php
            $event_detail_sidebar_select = ot_get_option('event_detail_sidebar_select');
            if (!empty($event_detail_sidebar_select)) {
                if (is_active_sidebar($event_detail_sidebar_select)) {
                    dynamic_sidebar($event_detail_sidebar_select);
                }
            }
            ?>
        </div>
    <?php } ?>
    <?php eventchamp_row_after(); ?>
<?php endwhile; ?>
<?php eventchamp_container_after(); ?>
<?php eventchamp_sub_content_after() ?>

<?php get_footer(); ?>