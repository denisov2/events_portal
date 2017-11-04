<?php
/*
Template Name: Активные события 2
*/
?>

<?php get_header(); ?>

		<?php eventchamp_sub_content_before(); ?>
		<?php
			$archive_eventchamp_archive_title = ot_get_option( 'archive_eventchamp_archive_title' );
			if( !$archive_eventchamp_archive_title == 'off' or $archive_eventchamp_archive_title == 'on' ) {
				eventchamp_archive_title();
			}
		?>
		<?php eventchamp_container_before(); ?>
			<?php eventchamp_row_before(); ?>
				<?php eventchamp_content_area_before(); ?>
					<?php
					if ( have_posts() ) {
						eventchamp_archive_post_list();
						eventchamp_pagination();		
					} else {
						get_template_part( 'include/formats/content', 'none' );
					}
					?>
					<?php if (!empty($eventcat_terms) && !is_wp_error($eventcat_terms)) {
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
				$output .= '<div class="well well-sm">
        <strong>Display</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>';
                
				$output .= '<div id="products_event" class="event-list column-3">';  
			
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
    }; ?>
				<?php eventchamp_content_area_after(); ?>
				
				<?php get_sidebar(); ?> 
			<?php eventchamp_row_after(); ?>
			
		<?php eventchamp_container_after(); ?>
	<?php eventchamp_sub_content_after(); ?>
	
<?php get_footer();