<?php
/*
Template Name: mailing-list
*/

require 'vendor/autoload.php';



$args_adv = [
    'post_status' => 'publish',
    'post_type' => 'event',
    //'order' => $ordertype,
    //'orderby' => $sortby,

];

$wp_query_adv = new WP_Query($args_adv);

$html = '<div>
							<div class="header-logo"><div class="logo"><a href="http://icotop.pro/" class="site-logo"><img alt="Logo" src="http://icotop.pro/wp-content/uploads/2017/03/1logo.png"></a></div></div>							<div class="header-menu">
								<div class="header-top-bar">
																	</div>
								
							</div>
						</div>';
$html .= "<div>";

$html .= "<h2>Next week upcoming ICO review</h2>";


while ($wp_query_adv->have_posts()) {

    $wp_query_adv->the_post();
    $post_id = get_the_ID();

    $event_start_date = get_post_meta($post_id, 'event_start_date', true);
    $event_end_date = get_post_meta($post_id, 'event_end_date', true);
    $date_now = date("Y-m-d");

    $datetime_start = new DateTime($event_start_date);
    $datetime_end = new DateTime($event_start_date);
    $datetime_now = new DateTime($date_now);

    $interval_days_left = $datetime_now->diff($datetime_end);
    $interval_days_past = $datetime_start->diff($datetime_now);
    $interval_days_all = $datetime_start->diff($datetime_end);


    $title = get_the_title();

    if ($interval_days_past->days > 0 && $interval_days_past->days <= 7) {


        $html .= "<h3>$title</h3>";
        $html .= "<p>";
        $html .= get_the_excerpt();
        $html .= "</p>";
        $html .= "<p>";
        $html .= "Start: $event_start_date. End: $event_start_date <br>";
        $html .= "Details: <a target='_blank' href='" . get_permalink() . "'>" . get_permalink() . "</a>";
        $html .= "</p>";
    }


}


$html .= "</div>";

echo $html;


use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

$SPApiClient = new ApiClient("498f717597ce5882305c33a08e013359", "7948a287174e3cc0decd629e1ab405d1", new FileStorage());

$senderName = "ICOTOP";
$senderEmail = "info@icotop.pro";

$subject = "ICO TOP weekly review 01.12.2017";
$body = $html;
$bookId = "1373564";
$name = "ICO TOP weekly review 01.12.2017";


var_dump( $SPApiClient->createCampaign(  $senderName, $senderEmail, $subject, $body, $bookId, $name ) );