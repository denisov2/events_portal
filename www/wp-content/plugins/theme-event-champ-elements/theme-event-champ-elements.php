<?php
/**
* Plugin Name: Event Champ Theme: Elements
* Plugin URI: http://themeforest.net/user/gloriathemes
* Description: Event Champ elements plugin.
* Version: 1.0
* Author: Gloria Themes
* Author URI: http://gloriathemes.com/
*/

/*======
*
* Create Social Media Links for User Profiles
*
======*/
function eventchamp_user_profile_social_media( $user_profile_create_fields ) {
	$user_profile_create_fields['facebook'] = esc_html__( 'Facebook', 'eventchamp' );
	$user_profile_create_fields['googleplus'] = esc_html__( 'Google+', 'eventchamp' );
	$user_profile_create_fields['instagram'] = esc_html__( 'Instagram', 'eventchamp' );
	$user_profile_create_fields['linkedin'] = esc_html__( 'LinkedIn', 'eventchamp' );
	$user_profile_create_fields['vine'] = esc_html__( 'Vine', 'eventchamp' );
	$user_profile_create_fields['twitter'] = esc_html__( 'Twitter', 'eventchamp' );
	$user_profile_create_fields['pinterest'] = esc_html__( 'Pinterest', 'eventchamp' );
	$user_profile_create_fields['youtube'] = esc_html__( 'YouTube', 'eventchamp' );
	$user_profile_create_fields['behance'] = esc_html__( 'Behance', 'eventchamp' );
	$user_profile_create_fields['deviantart'] = esc_html__( 'DeviantArt', 'eventchamp' );
	$user_profile_create_fields['digg'] = esc_html__( 'Digg', 'eventchamp' );
	$user_profile_create_fields['dribbble'] = esc_html__( 'Dribbble', 'eventchamp' );
	$user_profile_create_fields['flickr'] = esc_html__( 'Flickr', 'eventchamp' );
	$user_profile_create_fields['github'] = esc_html__( 'GitHub', 'eventchamp' );
	$user_profile_create_fields['lastfm'] = esc_html__( 'Last.fm', 'eventchamp' );
	$user_profile_create_fields['reddit'] = esc_html__( 'Reddit', 'eventchamp' );
	$user_profile_create_fields['soundcloud'] = esc_html__( 'SoundCloud', 'eventchamp' );
	$user_profile_create_fields['tumblr'] = esc_html__( 'Tumblr', 'eventchamp' );
	$user_profile_create_fields['vimeo'] = esc_html__( 'Vimeo', 'eventchamp' );
	$user_profile_create_fields['vk'] = esc_html__( 'VK', 'eventchamp' );
	$user_profile_create_fields['medium'] = esc_html__( 'Medium', 'eventchamp' );
	return $user_profile_create_fields;
}
add_filter( 'user_contactmethods', 'eventchamp_user_profile_social_media', 10, 1 );

/*======
*
* Comment List Template
*
======*/
function eventchamp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
	<?php if ( 'div' != $args['style'] ) { ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php } ?>
		<div class="comment-author vcard">
			<?php
				$user = get_user_by( 'email', $comment->comment_author_email );
			?>
			<?php if ( $args['avatar_size'] != 0 ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
			<?php $allowed_html = array ( 'span' => array() ); printf( wp_kses( '<cite class="fn">%s</cite>', 'eventchamp' ), get_comment_author() ); ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php printf( esc_html__( '%1$s', 'eventchamp' ), get_comment_date(),  get_comment_time() ); ?></a>
			</div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( '<i class="fa fa-pencil" aria-hidden="true"></i>' . esc_html__( 'Edit', 'eventchamp' ), '  ', '' ); ?>
			</div>
		</div>
		
		<?php if ( $comment->comment_approved == '0' ) { ?>
			<em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'eventchamp' ); ?></em>
		<?php } ?>

		<?php comment_text(); ?>

	<?php if ( 'div' != $args['style'] ) { ?>
		</div>
	<?php } ?>
<?php
}

/*======
*
* Comment Field to Top
*
======*/
function eventchamp_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'eventchamp_move_comment_field_to_bottom' );

/*======
*
* Post Types
*
======*/
	/*====== Events ======*/
	if ( ! function_exists('eventchamp_events') ) {
		function eventchamp_events() {
			$labels = array(
				'name' => _x( 'Events', 'Events General Name', 'eventchamp' ),
				'singular_name' => _x( 'ICO', 'Events Singular Name', 'eventchamp' ),
				'menu_name' => esc_html__( 'Events', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Event:', 'eventchamp' ),
				'all_items' => esc_html__( 'All Events', 'eventchamp' ),
				'view_item' => esc_html__( 'View Event', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Event Item', 'eventchamp' ),
				'add_new' => esc_html__( 'Add New Event', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Event', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Event', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Event', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Event Found', 'eventchamp' ),
				'not_found_in_trash' => esc_html__( 'Not Event Found in Trash', 'eventchamp' ),
			);
			$args = array(
				'label' => esc_html__( 'Events', 'eventchamp' ),
				'description' => esc_html__( 'Event post type description.', 'eventchamp' ),
				'labels' => $labels,
				'supports' => array( 'title', 'comments', 'author', 'excerpt', 'thumbnail', 'revisions', 'editor', 'editor', 'custom-fields' ),
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 20,
				'menu_icon' => 'dashicons-calendar-alt',
				'can_export' => true,
				'has_archive' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'capability_type' => 'post',
			);
			register_post_type( 'event', $args );
		}
		add_action( 'init', 'eventchamp_events', 0 );
	}

	/*====== Venues ======*/
	if ( ! function_exists('eventchamp_venues') ) {
		function eventchamp_venues() {
			$labels = array(
				'name' => _x( 'Venues', 'Venues General Name', 'eventchamp' ),
				'singular_name' => _x( 'Venue', 'Venues Singular Name', 'eventchamp' ),
				'menu_name' => esc_html__( 'Venues', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Venue:', 'eventchamp' ),
				'all_items' => esc_html__( 'All Venues', 'eventchamp' ),
				'view_item' => esc_html__( 'View Venue', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Venue Item', 'eventchamp' ),
				'add_new' => esc_html__( 'Add New Venue', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Venue', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Venue', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Venue', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Venue Found', 'eventchamp' ),
				'not_found_in_trash' => esc_html__( 'Not Venue Found in Trash', 'eventchamp' ),
			);
			$args = array(
				'label' => esc_html__( 'Venues', 'eventchamp' ),
				'description' => esc_html__( 'Venue post type description.', 'eventchamp' ),
				'labels' => $labels,
				'supports' => array( 'title', 'comments', 'author', 'excerpt', 'thumbnail', 'revisions', 'editor', 'editor', 'custom-fields' ),
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 20,
				'menu_icon' => 'dashicons-store',
				'can_export' => true,
				'has_archive' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'capability_type' => 'post',
			);
			register_post_type( 'venue', $args );
		}
		add_action( 'init', 'eventchamp_venues', 0 );
	}

	/*====== Speakers ======*/
	if ( ! function_exists('eventchampspeakers') ) {
		function eventchampspeakers() {
			$labels = array(
				'name' => _x( 'Speakers', 'Speakers General Name', 'eventchamp' ),
				'singular_name' => _x( 'Speaker', 'Speakers Singular Name', 'eventchamp' ),
				'menu_name' => esc_html__( 'Speakers', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Speaker:', 'eventchamp' ),
				'all_items' => esc_html__( 'All Speakers', 'eventchamp' ),
				'view_item' => esc_html__( 'View Speaker', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Speaker Item', 'eventchamp' ),
				'add_new' => esc_html__( 'Add New Speaker', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Speaker', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Speaker', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Speaker', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Speaker Found', 'eventchamp' ),
				'not_found_in_trash' => esc_html__( 'Not Speaker Found in Trash', 'eventchamp' ),
			);
			$args = array(
				'label' => esc_html__( 'Speakers', 'eventchamp' ),
				'description' => esc_html__( 'Speaker post type description.', 'eventchamp' ),
				'labels' => $labels,
				'supports' => array( 'title', 'comments', 'author', 'excerpt', 'thumbnail', 'revisions', 'editor', 'custom-fields' ),
				'hierarchical' => false,
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 20,
				'menu_icon' => 'dashicons-microphone',
				'can_export' => true,
				'has_archive' => true,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'capability_type' => 'post',
			);
			register_post_type( 'speaker', $args );
		} 
		add_action( 'init', 'eventchampspeakers', 0 );
	}

/*======
*
* Taxonomies
*
======*/
	/*====== Locations ======*/
	if ( ! function_exists( 'location' ) ) {
		function location() {
			$labels = array(
				'name' => _x( 'Locations', 'Locations General Name', 'eventchamp' ),
				'singular_name' => _x( 'Locations', 'Locations Singular Name', 'eventchamp' ),
				'menu_name' => esc_html__( 'Locations', 'eventchamp' ),
				'all_items' => esc_html__( 'All Locations', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Location', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Location:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Location Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Location', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Location', 'eventchamp' ),
				'view_item' => esc_html__( 'View Location', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Location', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate locations with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Locations', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove locations', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used locations', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
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
			register_taxonomy( 'location', array( 'event', 'venue' ), $args );

		}
		add_action( 'init', 'location', 0 );
	}

	/*====== Organizers ======*/
	if ( ! function_exists( 'organizer' ) ) {
		function organizer() {
			$labels = array(
				'name' => _x( 'Organizers', 'Organizers General Name', 'eventchamp' ),
				'singular_name' => _x( 'Organizers', 'Organizers Singular Name', 'eventchamp' ),
				'menu_name' => esc_html__( 'Organizers', 'eventchamp' ),
				'all_items' => esc_html__( 'All Organizers', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Organizer', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Organizer:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Organizer Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Organizer', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Organizer', 'eventchamp' ),
				'view_item' => esc_html__( 'View Organizer', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Organizer', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate organizers with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Organizers', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove organizers', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used organizers', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
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
			register_taxonomy( 'organizer', array( 'event' ), $args );

		}
		add_action( 'init', 'organizer', 0 );
	}

	/*====== Tags ======*/

	if ( ! function_exists( 'event_tags' ) ) {
		/*
		function event_tags() {
			$labels = array(
				'name' => _x( 'Tags', 'Tags General Name', 'eventchamp' ),
				'singular_name' => _x( 'Tags', 'Tags Singular Name', 'eventchamp' ),
				'menu_name' => esc_html__( 'Tags', 'eventchamp' ),
				'all_items' => esc_html__( 'All Tags', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Tag', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Tag:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Tag Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Tag', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Tag', 'eventchamp' ),
				'view_item' => esc_html__( 'View Tag', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Tag', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Tags', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove tags', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used tags', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
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
			register_taxonomy( 'event_tags', array( 'event', 'venue' ), $args );

		}
		*/
		add_action( 'init', 'event_tags', 0 );
	}

	/*====== Event Categories ======*/
	if ( ! function_exists( 'eventcat' ) ) {
		function eventcat() {
			$labels = array(
				'name' => _x( 'Event Categories', 'Event Categories General Name', 'eventchamp' ),
				'singular_name' => _x( 'Event Categories', 'Event Categories Singular Name', 'eventchamp' ),
				'menu_name' => esc_html__( 'Event Categories', 'eventchamp' ),
				'all_items' => esc_html__( 'All Event Categories', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Event Category', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Event Category:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Event Category Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Event Category', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Event Category', 'eventchamp' ),
				'view_item' => esc_html__( 'View Event Category', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Event Category', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate event categories with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Event Categories', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove event categories', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used event categories', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => false,
				'show_in_nav_menus' => true,
				'show_eventcatcloud' => true,
			);
			register_taxonomy( 'eventcat', array( 'event'), $args );

		}
		add_action( 'init', 'eventcat', 0 );
	}

	/*====== Venue Categories ======*/
	if ( ! function_exists( 'venuecat' ) ) {
		function venuecat() {
			$labels = array(
				'name' => _x( 'Venue Categories', 'Venue Categories General Name', 'eventchamp' ),
				'singular_name' => _x( 'Venue Categories', 'Venue Categories Singular Name', 'eventchamp' ),
				'menu_name' => esc_html__( 'Venue Categories', 'eventchamp' ),
				'all_items' => esc_html__( 'All Venue Categories', 'eventchamp' ),
				'parent_item' => esc_html__( 'Parent Venue Category', 'eventchamp' ),
				'parent_item_colon' => esc_html__( 'Parent Venue Category:', 'eventchamp' ),
				'new_item_name' => esc_html__( 'New Venue Category Name', 'eventchamp' ),
				'add_new_item' => esc_html__( 'Add New Venue Category', 'eventchamp' ),
				'edit_item' => esc_html__( 'Edit Venue Category', 'eventchamp' ),
				'view_item' => esc_html__( 'View Venue Category', 'eventchamp' ),
				'update_item' => esc_html__( 'Update Venue Category', 'eventchamp' ),
				'separate_items_with_commas' => esc_html__( 'Separate venue categories with commas', 'eventchamp' ),
				'search_items' => esc_html__( 'Search Venue Categories', 'eventchamp' ),
				'add_or_remove_items' => esc_html__( 'Add or remove venue categories', 'eventchamp' ),
				'choose_from_most_used' => esc_html__( 'Choose from the most used venue categories', 'eventchamp' ),
				'not_found' => esc_html__( 'Not Found', 'eventchamp' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => false,
				'show_in_nav_menus' => true,
				'show_venuecatcloud' => true,
			);
			register_taxonomy( 'venuecat', array( 'venue'), $args );

		}
		add_action( 'init', 'venuecat', 0 );
	}

/*======
*
* Elements for Page Builder
*
======*/
	/*====== Events ======*/
	function eventchamp_latest_events_slider_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'startdate' => '',
				'enddate' => '',
				'location' => '',
				'eventids' => '',
				'excludeevents' => '',
				'offset' => '',
				'eventcount' => '',
				'customtextdetailsbutton' => '',
				'customtextbuynowbutton' => '',
				'loopstatus' => '',
				'autoplay' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts['excludeevents'] ) ) {
			$excludeevents = $atts['excludeevents'];
			$exclude = explode( ',', $excludeevents );
		} else {
			$exclude = "";
		}

		if( !empty( $atts['eventids'] ) ) {
			$eventids = explode( ',', $atts['eventids'] );
		} else {
			$eventids = "";
		}

		if( !empty( $atts['eventids'] ) ) {
			$orderby = "none";
		} else {
			$orderby = "date";
		}

		if( !empty( $atts['autoplay'] ) ) {
			$autoplay = $atts["autoplay"];
		} else {
			$autoplay = "false";
		}

		if( $atts["loopstatus"] == "true" ) {
			$loopstatus = "true";
		} else {
			$loopstatus = "false";
		}

		$args = array(
			'posts_per_page' => $atts["eventcount"],
			'post_status' => 'publish',
			'post__not_in' => $exclude,
			'post__in' => $eventids,
			'offset' => $atts["offset"],
			'orderby' => $orderby,
			'ignore_sticky_posts' => true,
			'post_type' => 'event',
		); 
		$wp_query = new WP_Query( $args );
		if( !empty( $wp_query ) ) {
			$event_faq = get_post_meta( get_the_ID(), 'event_faq', true );
			$output .= '<div class="swiper-container gloria-sliders latest-events-slider" data-item="1" data-column-space="0" data-sloop="' . $loopstatus . '" data-aplay="' . $autoplay . '" data-effect="fade" data-pagination=".swiper-pagination">';
				$output .= '<div class="swiper-wrapper">';
					while ( $wp_query->have_posts() ) {
						$wp_query->the_post();
						$event_tickets = get_post_meta( get_the_ID(), 'event_tickets', true );
						$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
						$event_end_date = get_post_meta( get_the_ID(), 'event_end_date', true );
						$event_location = get_post_meta( get_the_ID(), 'event_location', true );
						$event_cats = wp_get_post_terms( get_the_ID(), 'eventcat' );

						if ( has_post_thumbnail() ) {
							$bg_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'eventchamp-event-slider' );
						} else {
							$bg_url = "";
						}

						$output .= '<div class="swiper-slide">';
							$output .= '<div class="slider-wrapper" style="background-image:url(' . esc_url( $bg_url[0] ) . ');">';
								$output .= '<div class="container">';
									$output .= '<div class="opacity"></div>';
									$output .= '<div class="content">';
										$output .= '<div class="feature">';
											if( !empty( $event_cats ) ) {
												$output .= '<ul class="category">';
													foreach( $event_cats as $event_cat ) {
														$output .= '<li><a href="' . get_term_link( $event_cat->term_id ) . '" title="' . esc_attr( $event_cat->name ) . '">' . esc_attr( $event_cat->name ) . '</a></li>';
													}
												$output .= '</ul>';
											}
											$output .= '<div class="title">' . get_the_title() . '</div>';
											if( !empty( $event_start_date ) or !empty( $event_location ) ) {
												$output .= '<ul class="information">';
													if( $atts["startdate"] == "true" ) {
														if( !empty( $event_start_date ) ) {
															$output .= '<li>';
																$output .= '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>';
																$output .= '<span>' . eventchamp_global_date_converter( $event_start_date ) . '</span>';
															$output .= '</li>';
														}
													}
													if( $atts["enddate"] == "true" ) {
														if( !empty( $event_end_date ) ) {
															$output .= '<li>';
																$output .= '<i class="fa fa-calendar-times-o" aria-hidden="true"></i>';
																$output .= '<span>' . eventchamp_global_date_converter( $event_end_date ) . '</span>';
															$output .= '</li>';
														}
													}
													if( $atts["location"] == "true" ) {
														if( !empty( $event_location ) ) {
															$output .= '<li>';
																$location = get_term( $event_location, 'location' );
																if( !empty( $location ) ) {
																	$output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
																	$output .= '<span>' . $location->name . '</span>';
																}
															$output .= '</li>';
														}
													}
												$output .= '</ul>';
											}
										$output .= '</div>';
										$output .= '<div class="buttons">';
											if( !empty( $atts["customtextdetailsbutton"] ) ) {
												$button1_text = esc_attr( $atts["customtextdetailsbutton"] );
											} else {
												$button1_text = esc_html__( 'Details', 'eventchamp' );
											}

											if( !empty( $atts["customtextbuynowbutton"] ) ) {
												$button2_text = esc_attr( $atts["customtextbuynowbutton"] );
											} else {
												$button2_text = esc_html__( 'Buy Ticket', 'eventchamp' );
											}

											$output .= '<a href="' . get_the_permalink() . '" title="' . esc_attr( $button1_text ) . '">';
												$output .= '<i class="fa fa-bars" aria-hidden="true"></i>';
												$output .= '<span>' . esc_attr( $button1_text ) . '</span>';
											$output .= '</a>';
											if( !empty( $event_tickets ) ) {
												$output .= '<a href="' . get_the_permalink() . '#tickets" title="' . esc_attr( $button2_text ) . '">';
													$output .= '<i class="fa fa-credit-card" aria-hidden="true"></i>';
													$output .= '<span>' . esc_attr( $button2_text ) . '</span>';
												$output .= '</a>';
											}
										$output .= '</div>';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
					}
				$output .= '</div>';
				$output .= '<div class="swiper-pagination"></div>';
			$output .= '</div>';
		}
		wp_reset_postdata();

		return $output;
	}
	add_shortcode( "eventchamp_latest_events_slider", "eventchamp_latest_events_slider_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Events Slider', 'eventchamp' ),
			"base" => "eventchamp_latest_events_slider",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-latest-events-slider.jpg',
			"description" =>esc_html__( 'Events Slider element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event ID's", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc. Note: Leave this field blank for latest events.', 'eventchamp' ),
					"param_name" => "eventids",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludeevents",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Event Count', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event count.', 'eventchamp' ),
					"param_name" => "eventcount",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Custom Text for Details Button', 'eventchamp' ),
					"description" => esc_html__( 'You can enter custom text for details button.', 'eventchamp' ),
					"param_name" => "customtextdetailsbutton",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Custom Text for Buy Now Button', 'eventchamp' ),
					"description" => esc_html__( 'You can enter custom text for buy now button.', 'eventchamp' ),
					"param_name" => "customtextbuynowbutton",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Start Date', 'eventchamp' ),
					"description" => esc_html__( 'You can activate event start date.', 'eventchamp' ),
					"param_name" => "startdate",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'End Date', 'eventchamp' ),
					"description" => esc_html__( 'You can activate event end date.', 'eventchamp' ),
					"param_name" => "enddate",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can activate event location.', 'eventchamp' ),
					"param_name" => "location",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Loop', 'eventchamp' ),
					"description" => esc_html__( 'You can select loop status.', 'eventchamp' ),
					"param_name" => "loopstatus",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Autoplay', 'eventchamp' ),
					"description" => esc_html__( 'You can enter autoplay delay.', 'eventchamp' ),
					"param_name" => "autoplay",
					"group" => esc_html__( 'Design', 'eventchamp' ),
				),
			),
		)
		);
	}

	/*====== Event Counter Slider ======*/
	function eventchamp_event_counter_slider_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'bgimages' => '',
				'addressdate' => '',
				'titleone' => '',
				'titletwo' => '',
				'bgtext' => '',
				'excerpt' => '',
				'detaillink' => '',
				'ticketlink' => '',
				'eventdate' => '',
				'datebgtext' => '',
				'ticketlinkicon' => '',
				'detaillinkicon' => '',
				'loopstatus' => '',
				'autoplay' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts['autoplay'] ) ) {
			$autoplay = $atts["autoplay"];
		} else {
			$autoplay = "false";
		}

		if( $atts["loopstatus"] == "true" ) {
			$loopstatus = "true";
		} else {
			$loopstatus = "false";
		}

		if( !empty( $atts["addressdate"] ) or !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) or !empty( $atts["excerpt"] ) or !empty( $atts["eventdate"] ) ) {
			$output .= '<div class="eventchamp-event-counter">';
				if( !empty( $atts["bgimages"] ) ) {
					$output .= '<div class="swiper-container gloria-sliders event-counter-slider" data-column-space="0" data-item="1" data-sloop="' . $loopstatus . '" data-aplay="' . $autoplay . '" data-effect="fade">';
						$output .= '<div class="swiper-wrapper">';
								$image_ids = explode( ',', $atts["bgimages"] ); 
								foreach( $image_ids as $image_id ){
									$image_url = wp_get_attachment_image_src( $image_id, "eventchamp-event-slider" );
									$output .= '<div class="swiper-slide">';
										$output .= '<div class="bg-image" style="background-image:url(' . esc_url( $image_url[0] ) . ')"></div>';
									$output .= '</div>';
								}
						$output .= '</div>';
					$output .= '</div>';
				}
				$output .= '<div class="counter-content">';
					if( !empty( $atts["addressdate"] ) ) {
						$output .= '<div class="address-date">' . esc_attr( $atts["addressdate"] ) . '</div>';
					}
					if( !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) ) {
						$output .= '<div class="title">';
							if( !empty( $atts["bgtext"] ) ) {
								$output .= '<div class="opacity-title">' . esc_attr( $atts["bgtext"] ) . '</div>';
							}
							if( !empty( $atts["titleone"] ) ) {
								$output .= '<span class="white">' . esc_attr( $atts["titleone"] ) . '</span>';
							}
							if( !empty( $atts["titletwo"] ) ) {
								$output .= '<span class="colored">' . esc_attr( $atts["titletwo"] ) . '</span>';
							}
						$output .= '</div>';
					}
					if( !empty( $atts["excerpt"] ) ) {
						$output .= '<div class="excerpt">' . esc_attr( $atts["excerpt"] ) . '</div>';
					}
					if( !empty( $atts["detaillink"] ) or !empty( $atts["ticketlink"] ) ) {
						$output .= '<div class="buttons">';
							if( !empty( $atts["detaillink"] ) ) {
								$href = $atts["detaillink"];
								$href = vc_build_link( $href );
								if( !empty( $href["target"] ) ) {
									$target = $href["target"];
								} else {
									$target = "_parent";
								}

								if( !empty( $href["title"] ) ) {
									$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '" title="' . esc_attr( $href["title"] ) . '">';
										if( !empty( $atts["detaillinkicon"] ) ) {
											$output .= '<i class="fa fa-' . esc_attr( $atts["detaillinkicon"] ) . '" aria-hidden="true"></i>';
										} else {
											$output .= '<i class="fa fa-bars" aria-hidden="true"></i>';
										}
										$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
									$output .= '</a>';
								}
							}
							if( !empty( $atts["ticketlink"] ) ) {
								$href = $atts["ticketlink"];
								$href = vc_build_link( $href );
								if( !empty( $href["target"] ) ) {
									$target = $href["target"];
								} else {
									$target = "_parent";
								}

								if( !empty( $href["title"] ) ) {
									$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '" title="' . esc_attr( $href["title"] ) . '">';
										if( !empty( $atts["ticketlinkicon"] ) ) {
											$output .= '<i class="fa fa-' . esc_attr( $atts["ticketlinkicon"] ) . '" aria-hidden="true"></i>';
										} else {
											$output .= '<i class="fa fa-credit-card" aria-hidden="true"></i>';
										}
										$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
									$output .= '</a>';
								}
							}
						$output .= '</div>';
					}
				$output .= '</div>';

				if( !empty( $atts["eventdate"] ) ) {
					$output .= '<div class="counter">';
						if( !empty( $atts["datebgtext"] ) ) {
							$output .= '<div class="counter-opacity-title">' . esc_attr( $atts["datebgtext"] ) . '</div>';
						}
						$output .= '<div class="getting-started">';
							$output .= '<div class="days">';
								$output .= '<div class="wrapper">';
									$output .= '<div class="count"></div>';
									$output .= '<div class="title">' . esc_html__( 'Days', 'eventchamp' ) . '</div>';
								$output .= '</div>';
							$output .= '</div>';
							$output .= '<div class="hours">';
								$output .= '<div class="wrapper">';
									$output .= '<div class="count"></div>';
									$output .= '<div class="title">' . esc_html__( 'Hours', 'eventchamp' ) . '</div>';
								$output .= '</div>';
							$output .= '</div>';
							$output .= '<div class="minutes">';
								$output .= '<div class="wrapper">';
									$output .= '<div class="count"></div>';
									$output .= '<div class="title">' . esc_html__( 'Minutes', 'eventchamp' ) . '</div>';
								$output .= '</div>';
							$output .= '</div>';
							$output .= '<div class="secondes">';
								$output .= '<div class="wrapper">';
									$output .= '<div class="count"></div>';
									$output .= '<div class="title">' . esc_html__( 'Seconds', 'eventchamp' ) . '</div>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';
						$output .= "<script type='text/javascript'>
							jQuery(document).ready(function($){
								$('.getting-started').countdown('" . date( 'Y/m/d H:i:s', strtotime( $atts["eventdate"] ) ) . "', function(event) {
									$('.days .count').html(event.strftime('%D'));
									$('.hours .count').html(event.strftime('%H'));
									$('.minutes .count').html(event.strftime('%M'));
									$('.secondes .count').html(event.strftime('%S'));
								});
							});
						</script>";
					$output .= '</div>';
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_event_counter_slider", "eventchamp_event_counter_slider_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Event Counter Slider', 'eventchamp' ),
			"base" => "eventchamp_event_counter_slider",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-event-counter-slider.jpg',
			"description" =>esc_html__( 'Event Counter Slider element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => esc_html__( 'Background Images', 'eventchamp' ),
					"description" => esc_html__( 'You can upload background images.', 'eventchamp' ),
					"param_name" => "bgimages",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Address & Date", 'eventchamp' ),
					"description" => esc_html__( 'You can enter address and date.', 'eventchamp' ),
					"param_name" => "addressdate",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title One", 'eventchamp' ),
					"description" => esc_html__( 'You can enter one title.', 'eventchamp' ),
					"param_name" => "titleone",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title Two", 'eventchamp' ),
					"description" => esc_html__( 'You can enter two title.', 'eventchamp' ),
					"param_name" => "titletwo",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title Background Text", 'eventchamp' ),
					"description" => esc_html__( 'You can enter title background text.', 'eventchamp' ),
					"param_name" => "bgtext",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Excerpt", 'eventchamp' ),
					"description" => esc_html__( 'You can enter excerpt.', 'eventchamp' ),
					"param_name" => "excerpt",
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Detail Link', 'eventchamp' ),
					"description" => esc_html__( 'You can enter detail link.', 'eventchamp' ),
					"param_name" => "detaillink",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Detail Link Icon', 'eventchamp' ),
					"description" => esc_html__( 'You can enter icon name. List of icons is available in documentation file. Example: edge, automobile, bel-o.', 'eventchamp' ),
					"param_name" => "detaillinkicon",
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Ticket Link', 'eventchamp' ),
					"description" => esc_html__( 'You can enter ticket link.', 'eventchamp' ),
					"param_name" => "ticketlink",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Ticket Link Icon', 'eventchamp' ),
					"description" => esc_html__( 'You can enter the icon name. List of the icons is available in the documentation file. Example: edge, automobile, bel-o.', 'eventchamp' ),
					"param_name" => "ticketlinkicon",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event Date", 'eventchamp' ),
					"description" => esc_html__( 'You can enter the event date. Example: 2017/09/23 10:24:00', 'eventchamp' ),
					"param_name" => "eventdate",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Date Background Text", 'eventchamp' ),
					"description" => esc_html__( 'You can enter the date background text.', 'eventchamp' ),
					"param_name" => "datebgtext",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Loop', 'eventchamp' ),
					"description" => esc_html__( 'You can select loop status.', 'eventchamp' ),
					"param_name" => "loopstatus",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Autoplay', 'eventchamp' ),
					"description" => esc_html__( 'You can enter autoplay delay.', 'eventchamp' ),
					"param_name" => "autoplay",
					"group" => esc_html__( 'Design', 'eventchamp' ),
				),
			),
		)
		);
	}

	/*====== Slider with Search Tool ======*/
	function eventchamp_slider_with_search_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'bgimages' => '',
				'keyword' => '',
				'location' => '',
				'category' => '',
				'status' => '',
				'sort' => '',
				'startdate' => '',
				'enddate' => '',
				'loopstatus' => '',
				'autoplay' => '',
			), $atts
		);

		$output = "";

		if( !empty( $atts['autoplay'] ) ) {
			$autoplay = $atts["autoplay"];
		} else {
			$autoplay = "false";
		}

		if( $atts["loopstatus"] == "true" ) {
			$loopstatus = "true";
		} else {
			$loopstatus = "false";
		}

		if( $atts["keyword"] == "true" or $atts["category"] == "true" or $atts["status"] == "true" or $atts["sort"] == "true" or $atts["startdate"] == "true" or $atts["enddate"] == "true" ) {
			if( $atts["keyword"] == "true" ) {
				$keyword_total = "1";
			} else {
				$keyword_total = "0";
			}
			
			if( $atts["category"] == "true" ) {
				$category_total = "1";
			} else {
				$category_total = "0";
			}

			if( $atts["status"] == "true" ) {
				$status_total = "1";
			} else {
				$status_total = "0";
			}

			if( $atts["sort"] == "true" ) {
				$sort_total = "1";
			} else {
				$sort_total = "0";
			}

			if( $atts["location"] == "true" ) {
				$location_total = "1";
			} else {
				$location_total = "0";
			}

			if( $atts["startdate"] == "true" ) {
				$startdate_total = "1";
			} else {
				$startdate_total = "0";
			}

			if( $atts["enddate"] == "true" ) {
				$enddate_total = "1";
			} else {
				$enddate_total = "0";
			}

			$column = $keyword_total + $category_total + $sort_total + $status_total + $location_total + $startdate_total + $enddate_total;

			$event_search_result_page = ot_get_option( 'event_search_result_page' );
			$output .= '<div class="slider-with-search-tool">';
				if( !empty( $atts["bgimages"] ) ) {
					$output .= '<div class="swiper-container gloria-sliders slider-with-search-tool-slides"  data-item="1" data-column-space="0" data-sloop="' . $loopstatus . '" data-aplay="' . $autoplay . '" data-effect="fade">';
						$output .= '<div class="swiper-wrapper">';
								$image_ids = explode( ',', $atts["bgimages"] ); 
								foreach( $image_ids as $image_id ){
									$image_url = wp_get_attachment_image_src( $image_id, "eventchamp-event-slider" );
									$output .= '<div class="swiper-slide">';
										$output .= '<div class="bg-image" style="background-image:url(' . esc_url( $image_url[0] ) . ')"></div>';
									$output .= '</div>';
								}
						$output .= '</div>';
					$output .= '</div>';
				}
				$output .= '<div class="event-search-tool column-' . esc_attr( $column ) . '">';
					$output .= '<div class="container">';
						$output .= '<form method="get" action="' . get_the_permalink( $event_search_result_page ) . '">';
							$output .= '<div class="search-content">';
								if( $atts["keyword"] == "true" or $atts["category"] == "true" or $atts["status"] == "true" or $atts["sort"] == "true" or $atts["startdate"] == "true" or $atts["enddate"] == "true" ) {
									$output .= '<div class="columns">';
										if( $atts["keyword"] == "true" ) {
											$output .= '<div class="column">';
												$output .= '<input name="keyword" type="text" placeholder="' . esc_html__( 'Keywords', 'eventchamp' ) . '">';
											$output .= '</div>';
										} else {
											$output .= '<input name="keyword" type="hidden" placeholder="' . esc_html__( 'Keywords', 'eventchamp' ) . '">';
										}
										if( $atts["category"] == "true" ) {
											$output .= '<div class="column">';
												$output .= '<select name="category" class="cs-select">';
													$output .= '<option value="">' . esc_html__( 'Category', 'eventchamp' ) . '</option>';
													$eventcat_terms = get_terms( array( 'taxonomy' => 'eventcat', 'hide_empty' => false ) );
													if ( ! empty( $eventcat_terms ) && ! is_wp_error( $eventcat_terms ) ) {
														foreach ( $eventcat_terms as $eventcat_term ) {
															$eventcat_term_name = $eventcat_term->name;
															$eventcat_term_slug = $eventcat_term->slug;
															$eventcat_term_term_group = $eventcat_term->term_group;
															$output .= '<option value="' . esc_attr( $eventcat_term_slug ) . '" data-class="cat-id-' . esc_attr( $eventcat_term_term_group ) . '">' . esc_attr( $eventcat_term_name ) . '</option>';
														}
													}
												$output .= '</select>';
											$output .= '</div>';
										}
										if( $atts["location"] == "true" ) {
											$output .= '<div class="column">';
												$output .= '<select name="location" class="cs-select">';
													$output .= '<option value="">' . esc_html__( 'Location', 'eventchamp' ) . '</option>';
													$eventcat_terms = get_terms( array( 'taxonomy' => 'location', 'hide_empty' => false ) );
													if ( ! empty( $eventcat_terms ) && ! is_wp_error( $eventcat_terms ) ) {
														foreach ( $eventcat_terms as $eventcat_term ) {
															$eventcat_term_name = $eventcat_term->name;
															$eventcat_term_slug = $eventcat_term->slug;
															$eventcat_term_term_id = $eventcat_term->term_id;
															$output .= '<option value="' . esc_attr( $eventcat_term_term_id ) . '">' . esc_attr( $eventcat_term_name ) . '</option>';
														}
													}
												$output .= '</select>';
											$output .= '</div>';
										}
										if( $atts["status"] == "true" ) {
											$output .= '<div class="column">';
												$output .= '<select name="status" class="cs-select">';
													$output .= '<option value="">' . esc_html__( 'Status', 'eventchamp' ) . '</option>';
													$output .= '<option value="upcoming">' . esc_html__( 'Upcoming', 'eventchamp' ) . '</option>';
													$output .= '<option value="incoming">' . esc_html__( 'Incoming', 'eventchamp' ) . '</option>';
													$output .= '<option value="expired">' . esc_html__( 'Expired', 'eventchamp' ) . '</option>';
												$output .= '</select>';
											$output .= '</div>';
										}
										if( $atts["startdate"] == "true" ) {
											$output .= '<div class="column">';
												$output .= '<input type="text"  name="startdate" value="" placeholder="' . esc_html__( 'Start Date', 'eventchamp' ) . '" class="eventsearchdate-datepicker" />';
											$output .= '</div>';
										}
										if( $atts["enddate"] == "true" ) {
											$output .= '<div class="column">';
												$output .= '<input type="text"  name="enddate" value="" placeholder="' . esc_html__( 'End Date', 'eventchamp' ) . '" class="eventsearchdate-datepicker" />';
											$output .= '</div>';
										}
										if( $atts["sort"] == "true" ) {
											$output .= '<div class="column">';
												$output .= '<select name="sort" class="cs-select">';
													$output .= '<option value="">' . esc_html__( 'Sort by', 'eventchamp' ) . '</option>';
													$output .= '<option value="startdate">' . esc_html__( 'Start Date', 'eventchamp' ) . '</option>';
													$output .= '<option value="enddate">' . esc_html__( 'End Date', 'eventchamp' ) . '</option>';
													$output .= '<option value="creationdate">' . esc_html__( 'Creation Date', 'eventchamp' ) . '</option>';
													$output .= '<option value="nameaz">' . esc_html__( 'Name A > Z', 'eventchamp' ) . '</option>';
													$output .= '<option value="nameza">' . esc_html__( 'Name Z > A', 'eventchamp' ) . '</option>';
												$output .= '</select>';
											$output .= '</div>';
										}
									$output .= '</div>';
									$output .= '<button type="submit"><i class="fa fa-search" aria-hidden="true"></i><span>' . esc_html__( 'Search', 'eventchamp' ) . '</span></button>';
								}
							$output .= '</div>';
						$output .= '</form>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;
	}
	add_shortcode( "eventchamp_slider_with_search", "eventchamp_slider_with_search_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Slider with Search Tool', 'eventchamp' ),
			"base" => "eventchamp_slider_with_search",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-event-slider-with-search-tool.jpg',
			"description" =>esc_html__( 'Slider with Search Tool element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => esc_html__( 'Background Images', 'eventchamp' ),
					"description" => esc_html__( 'You can upload background images.', 'eventchamp' ),
					"param_name" => "bgimages",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Start Date', 'eventchamp' ),
					"description" => esc_html__( 'You can active start date.', 'eventchamp' ),
					"param_name" => "startdate",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'End Date', 'eventchamp' ),
					"description" => esc_html__( 'You can active end date.', 'eventchamp' ),
					"param_name" => "enddate",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Keyword', 'eventchamp' ),
					"description" => esc_html__( 'You can active keyword option.', 'eventchamp' ),
					"param_name" => "keyword",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category', 'eventchamp' ),
					"description" => esc_html__( 'You can active category option.', 'eventchamp' ),
					"param_name" => "category",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can active location option.', 'eventchamp' ),
					"param_name" => "location",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Status', 'eventchamp' ),
					"description" => esc_html__( 'You can active status option.', 'eventchamp' ),
					"param_name" => "status",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Sort Type', 'eventchamp' ),
					"description" => esc_html__( 'You can active sort type option.', 'eventchamp' ),
					"param_name" => "sort",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Loop', 'eventchamp' ),
					"description" => esc_html__( 'You can select loop status.', 'eventchamp' ),
					"param_name" => "loopstatus",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Autoplay', 'eventchamp' ),
					"description" => esc_html__( 'You can enter autoplay delay.', 'eventchamp' ),
					"param_name" => "autoplay",
				),
			),
		)
		);
	}

	/*====== Title of Content ======*/
	function eventchamp_content_title_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'size' => '',
				'title' => '',
				'titleone' => '',
				'titletwo' => '',
				'description' => '',
				'icon' => '',
			), $atts
		);

		$output = "";

		if( !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) or !empty( $atts["description"] ) ) {
			$output .= '<div class="content-title-element ' . esc_attr( $atts["title"] ) . ' ' . esc_attr( $atts["size"] ) . '">';
				if( !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) ) {
					$output .= '<div class="title">';
						if( !empty( $atts["titleone"] ) ) {
							$output .= esc_attr( $atts["titleone"] );
						}
						if( !empty( $atts["titleone"] ) or !empty( $atts["titletwo"] ) ) {
							$output .= ' ';
						}
						if( !empty( $atts["titletwo"] ) ) {
							$output .= '<span>' . esc_attr( $atts["titletwo"] ) . '</span>';
						}
					$output .= '</div>';
				}
				$output .= '<div class="separate">';
					if( !empty( $atts["icon"] ) ) {
						$output .= '<i class="fa fa-' . esc_attr( $atts["icon"] ) . '" aria-hidden="true"></i>';
					} else {
						$output .= '<i class="fa fa-cube" aria-hidden="true"></i>';
					}
				$output .= '</div>';
				if( !empty( $atts["description"] ) ) {
					$output .= '<div class="description">' . esc_attr( $atts["description"] ) . '</div>';
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_content_title", "eventchamp_content_title_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Content Title', 'eventchamp' ),
			"base" => "eventchamp_content_title",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-content-title.jpg',
			"description" =>esc_html__( 'Content Title element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Size', 'eventchamp' ),
					"description" => esc_html__( 'You can select title size.', 'eventchamp' ),
					"param_name" => "size",
					'save_always' => true,
					'value' => array(
						esc_html__( 'Size 1', 'eventchamp' ) => 'size1',
						esc_html__( 'Size 2', 'eventchamp' ) => 'size2',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Style', 'eventchamp' ),
					"description" => esc_html__( 'You can select title style.', 'eventchamp' ),
					"param_name" => "title",
					'save_always' => true,
					'value' => array(
						esc_html__( 'Dark', 'eventchamp' ) => 'dark',
						esc_html__( 'White', 'eventchamp' ) => 'white',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title One", 'eventchamp' ),
					"description" => esc_html__( 'You can enter title for light font.', 'eventchamp' ),
					"param_name" => "titleone",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Title Two', 'eventchamp' ),
					"description" => esc_html__( 'You can enter title for bold font.', 'eventchamp' ),
					"param_name" => "titletwo",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Description', 'eventchamp' ),
					"description" => esc_html__( 'You can enter description.', 'eventchamp' ),
					"param_name" => "description",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Icon', 'eventchamp' ),
					"description" => esc_html__( 'You can enter icon name. List of icons is available in documentation file. Example: edge, automobile, bel-o.', 'eventchamp' ),
					"param_name" => "icon",
				)
			),
		)
		);
	}

	/*====== Event Search Tool ======*/
/*
	function eventchamp_event_search_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'style' => '',
				'title' => '',
				'keyword' => '',
				'location' => '',
				'category' => '',
				'status' => '',
				'sort' => '',
				'startdate' => '',
				'enddate' => '',
			), $atts
		);

		$output = "";

		if( $atts["keyword"] == "true" or $atts["category"] == "true" or $atts["status"] == "true" or $atts["sort"] == "true" ) {
			if( $atts["keyword"] == "true" ) {
				$keyword_total = "1";
			} else {
				$keyword_total = "0";
			}

			if( $atts["category"] == "true" ) {
				$category_total = "1";
			} else {
				$category_total = "0";
			}

			if( $atts["status"] == "true" ) {
				$status_total = "1";
			} else {
				$status_total = "0";
			}

			if( $atts["sort"] == "true" ) {
				$sort_total = "1";
			} else {
				$sort_total = "0";
			}

			if( $atts["location"] == "true" ) {
				$location_total = "1";
			} else {
				$location_total = "0";
			}

			if( $atts["startdate"] == "true" ) {
				$startdate_total = "1";
			} else {
				$startdate_total = "0";
			}

			if( $atts["enddate"] == "true" ) {
				$enddate_total = "1";
			} else {
				$enddate_total = "0";
			}

			$column = $keyword_total + $category_total + $sort_total + $status_total + $location_total + $startdate_total + $enddate_total;

			$event_search_result_page = ot_get_option( 'event_search_result_page' );
			$output .= '<div class="event-search-tool title-' . esc_attr( $atts["title"] ) . ' column-' . esc_attr( $column ) . ' ' . esc_attr( $atts["style"] ) . '">';
				$output .= '<div class="container">';
					$output .= '<form method="get" action="' . get_the_permalink( $event_search_result_page ) . '">';
						$output .= '<div class="search-content">';
							if( $atts["title"] == "true" )  {
								$output .= '<div class="title"><i class="fa fa-search-plus" aria-hidden="true"></i>' . esc_html__( 'Event Search', 'eventchamp' ) . ':</div>';
							}
							if( $atts["keyword"] == "true" or $atts["category"] == "true" or $atts["status"] == "true" or $atts["sort"] == "true" ) {
								$output .= '<div class="columns">';
									if( $atts["keyword"] == "true" ) {
										$output .= '<div class="column">';
											$output .= '<input name="keyword" type="text" placeholder="' . esc_html__( 'Keywords', 'eventchamp' ) . '">';
										$output .= '</div>';
									} else {
										$output .= '<input name="keyword" type="hidden" placeholder="' . esc_html__( 'Keywords', 'eventchamp' ) . '">';
									}
									if( $atts["category"] == "true" ) {
										$output .= '<div class="column">';
											$output .= '<select name="category" class="cs-select">';
												$output .= '<option value="">' . esc_html__( 'Category', 'eventchamp' ) . '</option>';
												$eventcat_terms = get_terms( array( 'taxonomy' => 'eventcat', 'hide_empty' => false ) );
												if ( ! empty( $eventcat_terms ) && ! is_wp_error( $eventcat_terms ) ) {
													foreach ( $eventcat_terms as $eventcat_term ) {
														$eventcat_term_term_id = $eventcat_term->term_id;
														$eventcat_term_name = $eventcat_term->name;
														$eventcat_term_slug = $eventcat_term->slug;
														$eventcat_term_term_group = $eventcat_term->term_group;
														$output .= '<option value="' . esc_attr( $eventcat_term_slug ) . '" data-class="cat-id-' . esc_attr( $eventcat_term_term_id ) . '">' . esc_attr( $eventcat_term_name ) . '</option>';
													}
												}
											$output .= '</select>';
										$output .= '</div>';
									}
									if( $atts["location"] == "true" ) {
										$output .= '<div class="column">';
											$output .= '<select name="location" class="cs-select">';
												$output .= '<option value="">' . esc_html__( 'Location', 'eventchamp' ) . '</option>';
												$eventcat_terms = get_terms( array( 'taxonomy' => 'location', 'hide_empty' => false ) );
												if ( ! empty( $eventcat_terms ) && ! is_wp_error( $eventcat_terms ) ) {
													foreach ( $eventcat_terms as $eventcat_term ) {
														$eventcat_term_name = $eventcat_term->name;
														$eventcat_term_slug = $eventcat_term->slug;
														$eventcat_term_term_id = $eventcat_term->term_id;
														$output .= '<option value="' . esc_attr( $eventcat_term_term_id ) . '">' . esc_attr( $eventcat_term_name ) . '</option>';
													}
												}
											$output .= '</select>';
										$output .= '</div>';
									}
									if( $atts["status"] == "true" ) {
										$output .= '<div class="column">';
											$output .= '<select name="status" class="cs-select">';
												$output .= '<option value="">' . esc_html__( 'Status', 'eventchamp' ) . '</option>';
												$output .= '<option value="upcoming">' . esc_html__( 'Upcoming', 'eventchamp' ) . '</option>';
												$output .= '<option value="incoming">' . esc_html__( 'Incoming', 'eventchamp' ) . '</option>';
												$output .= '<option value="expired">' . esc_html__( 'Expired', 'eventchamp' ) . '</option>';
											$output .= '</select>';
										$output .= '</div>';
									}
									if( $atts["startdate"] == "true" ) {
										$output .= '<div class="column">';
											$output .= '<input type="text"  name="startdate" value="" placeholder="' . esc_html__( 'Start Date', 'eventchamp' ) . '" class="eventsearchdate-datepicker" />';
										$output .= '</div>';
									}
									if( $atts["enddate"] == "true" ) {
										$output .= '<div class="column">';
											$output .= '<input type="text"  name="enddate" value="" placeholder="' . esc_html__( 'End Date', 'eventchamp' ) . '" class="eventsearchdate-datepicker" />';
										$output .= '</div>';
									}
									if( $atts["sort"] == "true" ) {
										$output .= '<div class="column">';
											$output .= '<select name="sort" class="cs-select">';
												$output .= '<option value="">' . esc_html__( 'Sort by', 'eventchamp' ) . '</option>';
												$output .= '<option value="startdate">' . esc_html__( 'Start Date', 'eventchamp' ) . '</option>';
												$output .= '<option value="enddate">' . esc_html__( 'End Date', 'eventchamp' ) . '</option>';
												$output .= '<option value="creationdate">' . esc_html__( 'Creation Date', 'eventchamp' ) . '</option>';
												$output .= '<option value="nameaz">' . esc_html__( 'Name A > Z', 'eventchamp' ) . '</option>';
												$output .= '<option value="nameza">' . esc_html__( 'Name Z > A', 'eventchamp' ) . '</option>';
											$output .= '</select>';
										$output .= '</div>';
									}
								$output .= '</div>';
								$output .= '<button type="submit"><i class="fa fa-search" aria-hidden="true"></i><span>' . esc_html__( 'Search', 'eventchamp' ) . '</span></button>';
							}
						$output .= '</div>';
					$output .= '</form>';
				$output .= '</div>';
			$output .= '</div>';

		}

		return $output;
	}
	add_shortcode( "eventchamp_event_search", "eventchamp_event_search_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Event Search Tool', 'eventchamp' ),
			"base" => "eventchamp_event_search",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-event-search-tool.jpg',
			"description" =>esc_html__( 'Event Search Tool element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Style', 'eventchamp' ),
					"description" => esc_html__( 'You can select title style.', 'eventchamp' ),
					"param_name" => "style",
					'save_always' => true,
					'value' => array(
						esc_html__( 'White', 'eventchamp' ) => 'white',
						esc_html__( 'Dark', 'eventchamp' ) => 'dark',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Search Title', 'eventchamp' ),
					"description" => esc_html__( 'You can active search title.', 'eventchamp' ),
					"param_name" => "title",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Start Date', 'eventchamp' ),
					"description" => esc_html__( 'You can active start date.', 'eventchamp' ),
					"param_name" => "startdate",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'End Date', 'eventchamp' ),
					"description" => esc_html__( 'You can active end date.', 'eventchamp' ),
					"param_name" => "enddate",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Keyword', 'eventchamp' ),
					"description" => esc_html__( 'You can active keyword option.', 'eventchamp' ),
					"param_name" => "keyword",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category', 'eventchamp' ),
					"description" => esc_html__( 'You can active category option.', 'eventchamp' ),
					"param_name" => "category",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can active location option.', 'eventchamp' ),
					"param_name" => "location",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Status', 'eventchamp' ),
					"description" => esc_html__( 'You can active status option.', 'eventchamp' ),
					"param_name" => "status",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Sort Type', 'eventchamp' ),
					"description" => esc_html__( 'You can active sort type option.', 'eventchamp' ),
					"param_name" => "sort",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
			),
		)
		);
	}

	/*====== Event Search Results ======*/

/*
	function eventchamp_events_search_results_output( $atts, $content = null ) {
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

			if( !empty( $atts['eventids'] ) ) {
				$eventids = explode( ',', $atts['eventids'] );
			} else {
				$eventids = "";
			}

			if( $atts["price"] == "true" ) {
				$price_status = "true";
			} else {
				$price_status = "false";
			}

			if( $atts["status"] == "true" ) {
				$status_status = "true";
			} else {
				$status_status = "false";
			}

			if( $atts["category"] == "true" ) {
				$category_status = "true";
			} else {
				$category_status = "false";
			}

			if( $atts["location"] == "true" ) {
				$location_status = "true";
			} else {
				$location_status = "false";
			}

			if( $atts["date"] == "true" ) {
				$date_status = "true";
			} else {
				$date_status = "false";
			}

			if( $atts["excerpt"] == "true" ) {
				$excerpt_status = "true";
			} else {
				$excerpt_status = "false";
			}

			if( !empty( $atts['includecategories'] ) ) {
				$includecategories = explode( ',', $atts['includecategories'] );
			} else {
				$includecategories = "";
			}

			if( !empty( $atts['excludecategories'] ) ) {
				$excludecategories = explode( ',', $atts['excludecategories'] );
			} else {
				$excludecategories = "";
			}

			if( !empty( $atts['excludeevents'] ) ) {
				$excludeevents = explode( ',', $atts['excludeevents'] );
			} else {
				$excludeevents = array();
			}

			$hideexpired = $atts["hideexpired"];
			if( $hideexpired == "on" ) {
				$expired_ids = eventchamp_expired_event_ids();
			} else {
				$expired_ids = array();
			}
			$excludeevents = array_merge( $excludeevents, $expired_ids );

			if( isset( $_GET['keyword'] ) ) {
				if( isset( $_GET['keyword'] ) ) {
					$keyword = esc_js( esc_sql( balanceTags( htmlspecialchars( esc_html__( $_GET["keyword"] ) ) ) ) );
				} else {
					$keyword = "";
				}

				if( isset( $_GET['category'] ) ) {
					$category = esc_js( esc_sql( balanceTags( htmlspecialchars( esc_html__( $_GET["category"] ) ) ) ) );
				} else {
					$category = "";
				}

				if( isset( $_GET['status'] ) ) {
					$status = esc_js( esc_sql( balanceTags( htmlspecialchars( esc_html__( $_GET["status"] ) ) ) ) );
				} else {
					$status = "";
				}

				if( isset( $_GET['sort'] ) ) {
					$sort = esc_js( esc_sql( balanceTags( htmlspecialchars( esc_html__( $_GET["sort"] ) ) ) ) );
				} else {
					$sort = "";
				}

				if( isset( $_GET['location'] ) ) {
					$location = esc_js( esc_sql( balanceTags( htmlspecialchars( esc_html__( $_GET["location"] ) ) ) ) );
				} else {
					$location = "";
				}

				if( isset( $_GET['startdate'] ) ) {
					$startdate = esc_js( esc_sql( balanceTags( htmlspecialchars( esc_html__( $_GET["startdate"] ) ) ) ) );
					$startdate_empty_control = esc_js( esc_sql( balanceTags( htmlspecialchars( esc_html__( $_GET["startdate"] ) ) ) ) );
				} else {
					$startdate = "";
					$startdate_empty_control = "";
				}

				if( isset( $_GET['enddate'] ) ) {
					$enddate = esc_js( esc_sql( balanceTags( htmlspecialchars( esc_html__( $_GET["enddate"] ) ) ) ) );
					$enddate_empty_control = esc_js( esc_sql( balanceTags( htmlspecialchars( esc_html__( $_GET["enddate"] ) ) ) ) );
				} else {
					$enddate = "";
					$enddate_empty_control = "";
				}

				if( !empty( $startdate ) ) {
					$startdate_compare = ">=";
				} else {
					$startdate = "-";
					$startdate_compare = "LIKE";
				}

				if( !empty( $enddate ) ) {
					$enddate_compare = "<=";
				} else {
					$enddate = $startdate;
					$enddate_compare = ">=";
				}

				if( $status == "upcoming" ) {
					$compare = ">";
					$compare2 = "BETWEEN";
				} elseif( $status == "incoming" ) {
					$compare = "<=";
					$compare2 = ">=";
				} elseif( $status == "expired" ) {
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

			if( isset( $_GET['sort'] ) ) {
				if( $_GET['sort'] == "startdate" ) {
					$order = "ASC";
					$orderby = "meta_value";
					$meta_key = "event_start_date";
				} elseif( $_GET['sort'] == "enddate" ) {
					$order = "DESC";
					$orderby = "meta_value";
					$meta_key = "event_start_date";
				} elseif( $_GET['sort'] == "creationdate" ) {
					$order = "DESC";
					$orderby = "date";
					$meta_key = "";
				} elseif( $_GET['sort'] == "nameza" ) {
					$order = "DESC";
					$orderby = "title";
					$meta_key = "";
				} else {
					$order = "ASC";
					$orderby = "title";
					$meta_key = "";
				}
			} else {
				$order = "ASC";
				$orderby = "title";
				$meta_key = "";
			}

			if( isset( $_GET['location'] ) ) {
				if( !empty( $_GET['location'] ) ) {
					$location = esc_attr( $_GET['location'] );
					$location_comp = "=";
				} else {
					$location = "none";
					$location_comp = "NOT LIKE";
				}
			} else {
				$location = "none";
				$location_comp = "NOT LIKE";
			}

			$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );
			if( empty( $paged ) ) { $paged = 1; }

			if( !empty( $startdate_empty_control ) or !empty( $enddate_empty_control ) ) {
				if( !empty( $category ) ) {
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
						),
					);
				}
			} else {
				if( !empty( $category ) ) {
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
						),
					);
				}
			}

			if( !empty( $includecategories ) ) {
				$defaults = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'eventcat',
							'field' => 'slug',
							'terms' => $includecategories,
						),
					),
				);
				$args = wp_parse_args( $args, $defaults );
			}

			if( !empty( $excludecategories ) ) {
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
				$args = wp_parse_args( $args, $defaults2 );
			}

			$output .= '<div class="events-list-grid eventchamp-search-results">';
				$wp_query = new WP_Query( $args );
				if( !empty( $wp_query ) ) {
					$output .= '<div class="event-list column-2">';
						if( $wp_query->have_posts() ) {
							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );

							}
						} else {
							$output .= '<p>' . esc_html__( "There are no results that match your search.", "eventchamp" ) . '</p>';
						}
					$output .= '</div>';
				}
				wp_reset_postdata();

				if ( $atts['pagination'] == 'true' ) {
					$output .= eventchamp_element_pagination( $paged = $paged, $query = $wp_query );
				}
			$output .= '</div>';

		return $output;
	}
	add_shortcode( "eventchamp_events_search_results", "eventchamp_events_search_results_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Event Search Results', 'eventchamp' ),
			"base" => "eventchamp_events_search_results",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-events-search-results.jpg',
			"description" =>esc_html__( 'Event Search Results element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event Count", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event count for each tab.', 'eventchamp' ),
					"param_name" => "eventcount",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Include Event Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter category slugs. Example: travel.', 'eventchamp' ),
					"param_name" => "includecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Event Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter category slugs. Example: travel.', 'eventchamp' ),
					"param_name" => "excludecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludeevents",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
					"description" => esc_html__( 'You can hide expired events.', 'eventchamp' ),
					"param_name" => "hideexpired",
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Pagination', 'eventchamp' ),
					"description" => esc_html__( 'You can select pagination status.', 'eventchamp' ),
					"param_name" => "pagination",
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Price', 'eventchamp' ),
					"description" => esc_html__( 'You can active event price.', 'eventchamp' ),
					"param_name" => "price",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Status', 'eventchamp' ),
					"description" => esc_html__( 'You can active event status.', 'eventchamp' ),
					"param_name" => "status",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category', 'eventchamp' ),
					"description" => esc_html__( 'You can active event category.', 'eventchamp' ),
					"param_name" => "category",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can active event location.', 'eventchamp' ),
					"param_name" => "location",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Date', 'eventchamp' ),
					"description" => esc_html__( 'You can active event date.', 'eventchamp' ),
					"param_name" => "date",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
					"description" => esc_html__( 'You can active event excerpt.', 'eventchamp' ),
					"param_name" => "excerpt",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
			),
		)
		);
	}
*/

	/*====== Categorized Events ======*/
	function eventchamp_categorized_events_output( $atts, $content = null ) {
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

			if( $atts["price"] == "true" ) {
				$price_status = "true";
			} else {
				$price_status = "false";
			}

			if( $atts["status"] == "true" ) {
				$status_status = "true";
			} else {
				$status_status = "false";
			}

			if( $atts["category"] == "true" ) {
				$category_status = "true";
			} else {
				$category_status = "false";
			}

			if( $atts["location"] == "true" ) {
				$location_status = "true";
			} else {
				$location_status = "false";
			}

			if( $atts["date"] == "true" ) {
				$date_status = "true";
			} else {
				$date_status = "false";
			}

			if( $atts["excerpt"] == "true" ) {
				$excerpt_status = "true";
			} else {
				$excerpt_status = "false";
			}

			if( !empty( $atts['excludecategories'] ) ) {
				$excludecategories = explode( ',', $atts['excludecategories'] );
			} else {
				$excludecategories = "";
			}

			if( !empty( $atts['includecategories'] ) ) {
				$includecategories = explode( ',', $atts['includecategories'] );
			} else {
				$includecategories = "";
			}

			if( !empty( $atts['excludeevents'] ) ) {
				$excludeevents = explode( ',', $atts['excludeevents'] );
			} else {
				$excludeevents = array();
			}

			$hideexpired = $atts["hideexpired"];
			if( $hideexpired == "true" ) {
				$expired_ids = eventchamp_expired_event_ids();
			} else {
				$expired_ids = array();
			}
			$excludeevents = array_merge( $excludeevents, $expired_ids );

			if( $atts["ordertype"] ) {
				$ordertype = $atts["ordertype"];
			} else {
				$ordertype = "";
			}

			if( $atts["sortby"] == "name" ) {
				$sortby = "name";
			} elseif( $atts["sortby"] == "upcomingevents" ) {
				$sortby = "meta_value";
			} else {
				$sortby = "";
			}

			$eventcat_terms = get_terms( array(
				'taxonomy' => 'eventcat',
				'exclude' => $excludecategories,
				'include' => $includecategories,
				'hide_empty' => false
			) );

			if ( ! empty( $eventcat_terms ) && ! is_wp_error( $eventcat_terms ) ) {
				$output .= '<div class="categorized-events">';
					$output .= '<ul class="nav nav-tabs" role="tablist">';
						if( $atts["alleventstab"] == "true" ) {
							$output .= '<li role="presentation"><a href="#categorized_events_all" aria-controls="categorized_events_all" role="tab" data-toggle="tab">' . esc_html__( 'All', 'eventchamp' ) . '</a></li>';
						}
						foreach ( $eventcat_terms as $eventcat_term ) {
							$eventcat_term_name = $eventcat_term->name;
							$eventcat_term_slug = $eventcat_term->slug;
							$output .= '<li role="presentation"><a href="#categorized_events_' . esc_attr( $eventcat_term_slug ) . '" aria-controls="categorized_events_' . esc_attr( $eventcat_term_slug ) . '" role="tab" data-toggle="tab">' . esc_attr( $eventcat_term_name ) . '</a></li>';
						}
					$output .= '</ul>';
					$output .= '<div class="tab-content">';
						if( $atts["alleventstab"] == "true" ) {
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

								if( !empty( $excludecategories ) or !empty( $includecategories ) ) {
									if( !empty( $includecategories ) ) {
										$defaults = array(
											'tax_query' => array(
												array(
													'taxonomy' => 'eventcat',
													'field' => 'term_id',
													'terms' => $includecategories,
												),
											),
										);
										$args = wp_parse_args( $args, $defaults );
									}

									if( !empty( $excludecategories ) ) {
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
										$args = wp_parse_args( $args, $defaults );
									}
								}

								$wp_query = new WP_Query( $args );
								if( !empty( $wp_query ) ) {
									$output .= '<div class="event-list column-3">';
										while ( $wp_query->have_posts() ) {
											$wp_query->the_post();
											if( $atts["style"] == "style2" ) {
												$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );	
											} elseif( $atts["style"] == "style3" ) {
												$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );
											} else {
												$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );												
											}
										}
									$output .= '</div>';
								}
								wp_reset_postdata();

								if( $atts["allbutton"] == "true" ) {
									$output .= '<a href="' . esc_url( get_post_type_archive_link( 'event' ) ) . '" class="all-button">' . esc_html__( 'All Events', 'eventchamp' ) . '</a>';
								}
							$output .= '</div>';
						}
						foreach ( $eventcat_terms as $eventcat_term ) {
							$eventcat_term_name = $eventcat_term->name;
							$eventcat_term_term_id = $eventcat_term->term_id;
							$eventcat_term_slug = $eventcat_term->slug;
							$output .= '<div role="tabpanel" class="tab-pane" id="categorized_events_' . esc_attr( $eventcat_term_slug ) . '">';
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
											'terms' => array( $eventcat_term_slug ),
										),
									),
								); 
								$wp_query = new WP_Query( $args );
								if( !empty( $wp_query ) ) {
									$output .= '<div class="event-list column-3">';
										while ( $wp_query->have_posts() ) {
											$wp_query->the_post();
											if( $atts["style"] == "style2" ) {
												$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );
											} elseif( $atts["style"] == "style3" ) {
												$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );
											} else {
												$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );										
											}
										}
									$output .= '</div>';
								}
								wp_reset_postdata();

								if( $atts["allbutton"] == "true" ) {
									$output .= '<a href="' . esc_url( get_term_link( $eventcat_term_term_id ) ) . '" class="all-button">' . esc_html__( 'All', 'eventchamp' ) . ' ' . esc_attr( $eventcat_term_name ) . ' ' . esc_html__( 'Events', 'eventchamp' ) . '</a>';
								}
							$output .= '</div>';
						}
					$output .= '</div>';
				$output .= '</div>';
			}

		return $output;
	}
	add_shortcode( "eventchamp_categorized_events", "eventchamp_categorized_events_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Categorized Events', 'eventchamp' ),
			"base" => "eventchamp_categorized_events",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-categorized-events.jpg',
			"description" =>esc_html__( 'Categorized Events element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event Count", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event count for each tab.', 'eventchamp' ),
					"param_name" => "eventcount",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter categories ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Include Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter categories ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "includecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludeevents",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Order Type', 'eventchamp' ),
					"description" => esc_html__( 'You can select order type.', 'eventchamp' ),
					"param_name" => "ordertype",
					'save_always' => true,
					"group" => esc_html__( 'General', 'eventchamp' ),
					'value' => array(
						esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Sort By', 'eventchamp' ),
					"description" => esc_html__( 'You can select sort type.', 'eventchamp' ),
					"param_name" => "sortby",
					'save_always' => true,
					"group" => esc_html__( 'General', 'eventchamp' ),
					'value' => array(
						esc_html__( 'Added Date', 'eventchamp' ) => 'addeddate',
						esc_html__( 'Upcoming Events', 'eventchamp' ) => 'upcomingevents',
						esc_html__( 'Name', 'eventchamp' ) => 'name',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
					"description" => esc_html__( 'You can hide expired events.', 'eventchamp' ),
					"param_name" => "hideexpired",
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'List Style', 'eventchamp' ),
					"description" => esc_html__( 'You can select list style.', 'eventchamp' ),
					"param_name" => "style",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
						esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
						esc_html__( 'Style 3', 'eventchamp' ) => 'style3',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'All Events Button', 'eventchamp' ),
					"description" => esc_html__( 'You can active all events button.', 'eventchamp' ),
					"param_name" => "allbutton",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'All Events Tab', 'eventchamp' ),
					"description" => esc_html__( 'You can active all events tab.', 'eventchamp' ),
					"param_name" => "alleventstab",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Price', 'eventchamp' ),
					"description" => esc_html__( 'You can active event price.', 'eventchamp' ),
					"param_name" => "price",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Status', 'eventchamp' ),
					"description" => esc_html__( 'You can active event status.', 'eventchamp' ),
					"param_name" => "status",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category', 'eventchamp' ),
					"description" => esc_html__( 'You can active event category.', 'eventchamp' ),
					"param_name" => "category",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can active event location.', 'eventchamp' ),
					"param_name" => "location",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Date', 'eventchamp' ),
					"description" => esc_html__( 'You can active event date.', 'eventchamp' ),
					"param_name" => "date",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
					"description" => esc_html__( 'You can active event excerpt.', 'eventchamp' ),
					"param_name" => "excerpt",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
			),
		)
		);
	}

	/*====== Event Carousel ======*/
	function eventchamp_events_list_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'eventids' => '',
				'allbutton' => '',
				'navbuttons' => '',
				'eventcount' => '',
				'includecategories' => '',
				'excludecategories' => '',
				'excludeevents' => '',
				'offset' => '',
				'price' => '',
				'status' => '',
				'category' => '',
				'location' => '',
				'date' => '',
				'excerpt' => '',
				'ordertype' => '',
				'sortby' => '',
				'hideexpired' => '',
				'column' => '',
				'loopstatus' => '',
				'autoplay' => '',
			), $atts
		);

		$output = "";

			if( !empty( $atts['eventids'] ) ) {
				$eventids = explode( ',', $atts['eventids'] );
			} else {
				$eventids = "";
			}

			if( !empty( $atts['column'] ) ) {
				$column = $atts["column"];
			} else {
				$column = "3";
			}

			if( !empty( $atts['autoplay'] ) ) {
				$autoplay = $atts["autoplay"];
			} else {
				$autoplay = "false";
			}

			if( $atts["loopstatus"] == "true" ) {
				$loopstatus = "true";
			} else {
				$loopstatus = "false";
			}

			if( $atts["price"] == "true" ) {
				$price_status = "true";
			} else {
				$price_status = "false";
			}

			if( $atts["status"] == "true" ) {
				$status_status = "true";
			} else {
				$status_status = "false";
			}

			if( $atts["category"] == "true" ) {
				$category_status = "true";
			} else {
				$category_status = "false";
			}

			if( $atts["location"] == "true" ) {
				$location_status = "true";
			} else {
				$location_status = "false";
			}

			if( $atts["date"] == "true" ) {
				$date_status = "true";
			} else {
				$date_status = "false";
			}

			if( $atts["excerpt"] == "true" ) {
				$excerpt_status = "true";
			} else {
				$excerpt_status = "false";
			}

			if( !empty( $atts['includecategories'] ) ) {
				$includecategories = explode( ',', $atts['includecategories'] );
			} else {
				$includecategories = "";
			}

			if( !empty( $atts['excludecategories'] ) ) {
				$excludecategories = explode( ',', $atts['excludecategories'] );
			} else {
				$excludecategories = "";
			}

			if( !empty( $atts['excludeevents'] ) ) {
				$excludeevents = explode( ',', $atts['excludeevents'] );
			} else {
				$excludeevents = array();
			}

			$hideexpired = $atts["hideexpired"];
			if( $hideexpired == "true" ) {
				$expired_ids = eventchamp_expired_event_ids();
			} else {
				$expired_ids = array();
			}
			$excludeevents = array_merge( $excludeevents, $expired_ids );

			if( !empty( $atts['eventids'] ) ) {
				$orderby = "none";
			} else {
				$orderby = "date";
			}

			if( $atts["ordertype"] ) {
				$ordertype = $atts["ordertype"];
			} else {
				$ordertype = "";
			}

			if( $atts["sortby"] == "name" ) {
				$sortby = "name";
			} elseif( $atts["sortby"] == "upcomingevents" ) {
				$sortby = "meta_value";
			} else {
				$sortby = "";
			}

			$args = array(
				'posts_per_page' => $atts["eventcount"],
				'post_status' => 'publish',
				'post__not_in' => $excludeevents,
				'order' => $ordertype,
				'orderby' => $sortby,
				'meta_key' => 'event_start_date',
				'post__in' => $eventids,
				'offset' => $atts["offset"],
				'ignore_sticky_posts' => true,
				'post_type' => 'event',
			);

			if( !empty( $includecategories ) ) {
				$defaults = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'eventcat',
							'field' => 'slug',
							'terms' => $includecategories,
						),
					),
				);
				$args = wp_parse_args( $args, $defaults );
			}

			if( !empty( $excludecategories ) ) {
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
				$args = wp_parse_args( $args, $defaults2 );
			}

			$output .= '<div class="events-list-carousel">';
				$wp_query = new WP_Query( $args );
				if( !empty( $wp_query ) ) {
					$output .= '<div class="swiper-container gloria-sliders events-list-carousel" data-item="' . $column . '" data-column-space="30" data-sloop="' . $loopstatus . '" data-aplay="' . $autoplay . '">';
						$output .= '<div class="swiper-wrapper">';
							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								$output .= '<div class="swiper-slide">';
									$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );
								$output .= '</div>';
							}
						$output .= '</div>';
						$output .= '<div class="pagination">';

							if( $atts["navbuttons"] == "true" ) {
								$output .= '<div class="pagination-left prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>';
							}

							if( $atts["allbutton"] == "true" ) {
								$output .= '<div><a href="' . esc_url( get_post_type_archive_link( 'event' ) ) . '" class="all-button">' . esc_html__( 'All Events', 'eventchamp' ) . '</a></div>';
							}

							if( $atts["navbuttons"] == "true" ) {
								$output .= '<div class="pagination-right next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>';
							}
						$output .= '</div>';


					$output .= '</div>';
				}
				wp_reset_postdata();
			$output .= '</div>';

		return $output;
	}
	add_shortcode( "eventchamp_events_list", "eventchamp_events_list_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Event Carousel', 'eventchamp' ),
			"base" => "eventchamp_events_list",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-events-list.jpg',
			"description" =>esc_html__( 'Event Carousel element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event ID's", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc. Note: Leave this field blank for latest events.', 'eventchamp' ),
					"param_name" => "eventids",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event Count", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event count for each tab.', 'eventchamp' ),
					"param_name" => "eventcount",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Include Event Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter categories slugs. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "includecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Event Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter category slugs. Example: travel.', 'eventchamp' ),
					"param_name" => "excludecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludeevents",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Order Type', 'eventchamp' ),
					"description" => esc_html__( 'You can select order type.', 'eventchamp' ),
					"param_name" => "ordertype",
					'save_always' => true,
					"group" => esc_html__( 'General', 'eventchamp' ),
					'value' => array(
						esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Sort By', 'eventchamp' ),
					"description" => esc_html__( 'You can select sort type.', 'eventchamp' ),
					"param_name" => "sortby",
					'save_always' => true,
					"group" => esc_html__( 'General', 'eventchamp' ),
					'value' => array(
						esc_html__( 'Added Date', 'eventchamp' ) => 'addeddate',
						esc_html__( 'Upcoming Events', 'eventchamp' ) => 'upcomingevents',
						esc_html__( 'Name', 'eventchamp' ) => 'name',
					),
				),	
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
					"description" => esc_html__( 'You can hide expired events.', 'eventchamp' ),
					"param_name" => "hideexpired",
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Column', 'eventchamp' ),
					"description" => esc_html__( 'You can select column.', 'eventchamp' ),
					"param_name" => "column",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( '1', 'eventchamp' ) => '1',
						esc_html__( '2', 'eventchamp' ) => '2',
						esc_html__( '3', 'eventchamp' ) => '3',
						esc_html__( '4', 'eventchamp' ) => '4',
						esc_html__( '5', 'eventchamp' ) => '5',
						esc_html__( '6', 'eventchamp' ) => '6',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Loop', 'eventchamp' ),
					"description" => esc_html__( 'You can select loop status.', 'eventchamp' ),
					"param_name" => "loopstatus",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Autoplay', 'eventchamp' ),
					"description" => esc_html__( 'You can enter autoplay delay.', 'eventchamp' ),
					"param_name" => "autoplay",
					"group" => esc_html__( 'Design', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'All Events Button', 'eventchamp' ),
					"description" => esc_html__( 'You can active all events button.', 'eventchamp' ),
					"param_name" => "allbutton",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Navigation Buttons', 'eventchamp' ),
					"description" => esc_html__( 'You can active navigation buttons.', 'eventchamp' ),
					"param_name" => "navbuttons",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Price', 'eventchamp' ),
					"description" => esc_html__( 'You can active event price.', 'eventchamp' ),
					"param_name" => "price",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Status', 'eventchamp' ),
					"description" => esc_html__( 'You can active event status.', 'eventchamp' ),
					"param_name" => "status",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category', 'eventchamp' ),
					"description" => esc_html__( 'You can active event category.', 'eventchamp' ),
					"param_name" => "category",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can active event location.', 'eventchamp' ),
					"param_name" => "location",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Date', 'eventchamp' ),
					"description" => esc_html__( 'You can active event date.', 'eventchamp' ),
					"param_name" => "date",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
					"description" => esc_html__( 'You can active event excerpt.', 'eventchamp' ),
					"param_name" => "excerpt",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
			),
		)
		);
	}

	/*====== Event List ======*/
	function eventchamp_events_list_grid_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'style' => '',
				'column' => '',
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
				'ordertype' => '',
				'sortby' => '',
				'hideexpired' => '',
			), $atts
		);

		$output = "";

			if( !empty( $atts['eventids'] ) ) {
				$eventids = explode( ',', $atts['eventids'] );
			} else {
				$eventids = "";
			}

			if( $atts["price"] == "true" ) {
				$price_status = "true";
			} else {
				$price_status = "false";
			}

			if( $atts["status"] == "true" ) {
				$status_status = "true";
			} else {
				$status_status = "false";
			}

			if( $atts["category"] == "true" ) {
				$category_status = "true";
			} else {
				$category_status = "false";
			}

			if( $atts["location"] == "true" ) {
				$location_status = "true";
			} else {
				$location_status = "false";
			}

			if( $atts["date"] == "true" ) {
				$date_status = "true";
			} else {
				$date_status = "false";
			}

			if( $atts["excerpt"] == "true" ) {
				$excerpt_status = "true";
			} else {
				$excerpt_status = "false";
			}

			if( !empty( $atts['includecategories'] ) ) {
				$includecategories = explode( ',', $atts['includecategories'] );
			} else {
				$includecategories = "";
			}

			if( !empty( $atts['excludecategories'] ) ) {
				$excludecategories = explode( ',', $atts['excludecategories'] );
			} else {
				$excludecategories = "";
			}

			if( !empty( $atts['excludeevents'] ) ) {
				$excludeevents = explode( ',', $atts['excludeevents'] );
			} else {
				$excludeevents = array();
			}

			$hideexpired = $atts["hideexpired"];
			if( $hideexpired == "true" ) {
				$expired_ids = eventchamp_expired_event_ids();
			} else {
				$expired_ids = array();
			}
			$excludeevents = array_merge( $excludeevents, $expired_ids );

			if( !empty( $atts['eventids'] ) ) {
				$orderby = "none";
			} else {
				$orderby = "date";
			}

			if( $atts["ordertype"] ) {
				$ordertype = $atts["ordertype"];
			} else {
				$ordertype = "";
			}

			if( $atts["column"] ) {
				$column = $atts["column"];
			} else {
				$column = "2";
			}

			if( $atts["sortby"] == "name" ) {
				$sortby = "name";
			} elseif( $atts["sortby"] == "upcomingevents" ) {
				$sortby = "meta_value";
			} else {
				$sortby = "";
			}

			$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );
			if( empty( $paged ) ) { $paged = 1; }

			$args = array(
				'posts_per_page' => $atts["eventcount"],
				'post_status' => 'publish',
				'post__not_in' => $excludeevents,
				'offset' => $atts["offset"],
				'paged' => $paged,
				'order' => $ordertype,
				'orderby' => $sortby,
				'meta_key' => 'event_start_date',
				'ignore_sticky_posts' => true,
				'post_type' => 'event',
				'post__in' => $eventids,
			);

			if( !empty( $includecategories ) ) {
				$defaults = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'eventcat',
							'field' => 'slug',
							'terms' => $includecategories,
						),
					),
				);
				$args = wp_parse_args( $args, $defaults );
			}

			if( !empty( $excludecategories ) ) {
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
				$args = wp_parse_args( $args, $defaults2 );
			}

			$output .= '<div class="events-list-grid">';
				$wp_query = new WP_Query( $args );
				if( !empty( $wp_query ) ) {
					$output .= '<div class="event-list column-' . $column . '">';
						while ( $wp_query->have_posts() ) {
							$wp_query->the_post();
							if( $atts["style"] == "style2" ) {
								$output .= eventchamp_event_list_style_3( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );	
							} elseif( $atts["style"] == "style3" ) {
								$output .= eventchamp_event_list_style_4( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );
							} else {
								$output .= eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $date = $date_status, $location = $location_status, $excerpt = $excerpt_status, $status = $status_status, $price = $price_status );											
							}							
						}
					$output .= '</div>';
				}
				wp_reset_postdata();

				if ( $atts['pagination'] == 'true' ) {
					$output .= eventchamp_element_pagination( $paged = $paged, $query = $wp_query );
				}
			$output .= '</div>';

		return $output;
	}
	add_shortcode( "eventchamp_events_list_grid", "eventchamp_events_list_grid_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Event List', 'eventchamp' ),
			"base" => "eventchamp_events_list_grid",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-events-list-grid.jpg',
			"description" =>esc_html__( 'Event List element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event ID's", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc. Note: Leave this field blank for latest events.', 'eventchamp' ),
					"param_name" => "eventids",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event Count", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event count for each tab.', 'eventchamp' ),
					"param_name" => "eventcount",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Include Event Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter category slugs. Example: travel.', 'eventchamp' ),
					"param_name" => "includecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Event Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter category slugs. Example: travel.', 'eventchamp' ),
					"param_name" => "excludecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Events', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludeevents",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Order Type', 'eventchamp' ),
					"description" => esc_html__( 'You can select order type.', 'eventchamp' ),
					"param_name" => "ordertype",
					'save_always' => true,
					"group" => esc_html__( 'General', 'eventchamp' ),
					'value' => array(
						esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Sort By', 'eventchamp' ),
					"description" => esc_html__( 'You can select sort type.', 'eventchamp' ),
					"param_name" => "sortby",
					'save_always' => true,
					"group" => esc_html__( 'General', 'eventchamp' ),
					'value' => array(
						esc_html__( 'Added Date', 'eventchamp' ) => 'addeddate',
						esc_html__( 'Upcoming Events', 'eventchamp' ) => 'upcomingevents',
						esc_html__( 'Name', 'eventchamp' ) => 'name',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Pagination', 'eventchamp' ),
					"description" => esc_html__( 'You can select pagination status.', 'eventchamp' ),
					"param_name" => "pagination",
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Hide Expired Events', 'eventchamp' ),
					"description" => esc_html__( 'You can hide expired events.', 'eventchamp' ),
					"param_name" => "hideexpired",
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'List Style', 'eventchamp' ),
					"description" => esc_html__( 'You can select list style.', 'eventchamp' ),
					"param_name" => "style",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
						esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
						esc_html__( 'Style 3', 'eventchamp' ) => 'style3',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Column', 'eventchamp' ),
					"description" => esc_html__( 'You can select column.', 'eventchamp' ),
					"param_name" => "column",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( '1', 'eventchamp' ) => '1',
						esc_html__( '2', 'eventchamp' ) => '2',
						esc_html__( '3', 'eventchamp' ) => '3',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Price', 'eventchamp' ),
					"description" => esc_html__( 'You can active event price.', 'eventchamp' ),
					"param_name" => "price",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Status', 'eventchamp' ),
					"description" => esc_html__( 'You can active event status.', 'eventchamp' ),
					"param_name" => "status",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category', 'eventchamp' ),
					"description" => esc_html__( 'You can active event category.', 'eventchamp' ),
					"param_name" => "category",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can active event location.', 'eventchamp' ),
					"param_name" => "location",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Date', 'eventchamp' ),
					"description" => esc_html__( 'You can active event date.', 'eventchamp' ),
					"param_name" => "date",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
					"description" => esc_html__( 'You can active event excerpt.', 'eventchamp' ),
					"param_name" => "excerpt",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
			),
		)
		);
	}

	/*====== Single Event Content ======*/
	function eventchamp_event_content_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'contenttype' => '',
				'eventid' => '',
			), $atts
		);

		$output = "";

		if( !empty( $atts["contenttype"] ) or !empty( $atts["eventid"] ) ) {
			$output .= '<div class="eventchamp-event-content">';
				if( $atts["contenttype"] == "speaker" ) {
					if( !empty( $atts["eventid"] ) ) {
						$output .= eventchamp_speakers( $post_id = esc_attr( $atts["eventid"] ), $column = "4" );
					}
				} elseif( $atts["contenttype"] == "schedule" ) {
					if( !empty( $atts["eventid"] ) ) {
						$output .= '<div class="eventchamp-dropdown">' . eventchamp_schedule( $post_id = esc_attr( $atts["eventid"] ) ) . '</div>';
					}
				} elseif( $atts["contenttype"] == "ticket" ) {
					if( !empty( $atts["eventid"] ) ) {
						$output .= eventchamp_pricing_table( $post_id = esc_attr( $atts["eventid"] ), $text_column = "2" );
					}
				} elseif( $atts["contenttype"] == "sponsor" ) {
					if( !empty( $atts["eventid"] ) ) {
						$event_sponsors = get_post_meta( esc_attr( $atts["eventid"] ), 'event_sponsors', true );
						if( !empty( $event_sponsors ) ) {
							$output .= '<div class="sponsors">';
								$output .= '<ul>';
									foreach ( $event_sponsors as $event_sponsor ) {
										if( !empty( $event_sponsor ) ) {
											$output .= '<li>';
												if( !empty( $event_sponsor["title"] ) ) {
													$spoonsor_name = $event_sponsor["title"];
												} else {
													$spoonsor_name = esc_html__( 'Sponsor', 'eventchamp' );
												}

												if( !empty( $event_sponsor["event_sponsor_link"] ) ) {
													$output .= '<a href="' . esc_url( $event_sponsor["event_sponsor_link"] ) . '" target="_blank" title="' . esc_attr( $spoonsor_name ) . '" rel="nofollow">';
														if( !empty( $event_sponsor["event_sponsor_logo"] ) ) {
															$sponsor_logo_attachment_id = eventchamp_attachment_id( $event_sponsor["event_sponsor_logo"] );
															$output .= wp_get_attachment_image( $sponsor_logo_attachment_id, 'eventchamp-event-sponsor-big', true, true );
														}
													$output .= '</a>';
												} else {
													if( !empty( $event_sponsor["event_sponsor_logo"] ) ) {
														$sponsor_logo_attachment_id = eventchamp_attachment_id( $event_sponsor["event_sponsor_logo"] );
														$output .= wp_get_attachment_image( $sponsor_logo_attachment_id, 'eventchamp-event-sponsor-big', true, true );
													}
												}
											$output .= '</li>';
										}
									}
								$output .= '</ul>';
							$output .= '</div>';
						}
					}
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_event_content", "eventchamp_event_content_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Single Event Content', 'eventchamp' ),
			"base" => "eventchamp_event_content",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-event-content.jpg',
			"description" =>esc_html__( 'Single Event Content element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Content Type', 'eventchamp' ),
					"description" => esc_html__( 'You can select event content.', 'eventchamp' ),
					"param_name" => "contenttype",
					'save_always' => true,
					'value' => array(
						esc_html__( 'Speaker', 'eventchamp' ) => 'speaker',
						esc_html__( 'Schedule', 'eventchamp' ) => 'schedule',
						esc_html__( 'Ticket', 'eventchamp' ) => 'ticket',
						esc_html__( 'Sponsor', 'eventchamp' ) => 'sponsor',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event ID", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event id.', 'eventchamp' ),
					"param_name" => "eventid",
				)
			),
		)
		);
	}

	/*====== Speaker List ======*/
	function eventchamp_speakers_list_grid_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'speakerids' => '',
				'speakercount' => '',
				'excludespeakers' => '',
				'offset' => '',
				'pagination' => '',
				'ordertype' => '',
				'sortby' => '',
			), $atts
		);

		$output = "";

			if( !empty( $atts['speakerids'] ) ) {
				$speakerids = explode( ',', $atts['speakerids'] );
			} else {
				$speakerids = "";
			}

			if( !empty( $atts['excludespeakers'] ) ) {
				$excludespeakers = explode( ',', $atts['excludespeakers'] );
			} else {
				$excludespeakers = "";
			}

			if( $atts["ordertype"] ) {
				$ordertype = $atts["ordertype"];
			} else {
				$ordertype = "";
			}

			if( $atts["sortby"] == "name" ) {
				$sortby = "name";
			} else {
				$sortby = "";
			}

			$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );
			if( empty( $paged ) ) { $paged = 1; }

			$args = array(
				'posts_per_page' => $atts["speakercount"],
				'post_status' => 'publish',
				'post__not_in' => $excludespeakers,
				'offset' => $atts["offset"],
				'paged' => $paged,
				'order' => $ordertype,
				'orderby' => $sortby,
				'ignore_sticky_posts' => true,
				'post_type' => 'speaker',
				'post__in' => $speakerids,
			); 

			$output .= '<div class="speakers-list-grid">';
				$wp_query = new WP_Query( $args );
				if( !empty( $wp_query ) ) {
					$output .= '<div class="speakers-list column-7">';
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
												$output .= '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">';
													$output .= get_the_post_thumbnail( get_the_ID(), 'eventchamp-speaker' );
												$output .= '</a>';
											$output .= '</div>';
										}

										$speakers_title = get_the_title();

										if( !empty( $speakers_title ) ) {
											$output .= '<div class="name">';
												$output .= '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">';
													$output .= get_the_title();
												$output .= '</a>';
											$output .= '</div>';
										}

										$speaker_excerpt = get_the_excerpt();

										if( !empty( $speaker_excerpt ) ) {
											$output .= '<div class="excerpt">';
												$output .= get_the_excerpt();
											$output .= '</div>';
										}

										$output .= '<div class="details">';
											$output .= '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="more-button">' . esc_html__( 'Profile', 'eventchamp' ) . '</a>';
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
					$output .= '</div>';
				}
				wp_reset_postdata();

				if ( $atts['pagination'] == 'true' ) {
					$output .= eventchamp_element_pagination( $paged = $paged, $query = $wp_query );
				}
			$output .= '</div>';

		return $output;
	}
	add_shortcode( "eventchamp_speakers_list_grid", "eventchamp_speakers_list_grid_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Spekear List', 'eventchamp' ),
			"base" => "eventchamp_speakers_list_grid",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-speakers-list-grid.jpg',
			"description" =>esc_html__( 'Speaker List element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Spekear ID's", 'eventchamp' ),
					"description" => esc_html__( 'You can enter speaker ids. Separate with commas 1,2,3 etc. Note: Leave this field blank for latest speakers.', 'eventchamp' ),
					"param_name" => "speakerids",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Spekear Count", 'eventchamp' ),
					"description" => esc_html__( 'You can enter speaker count for each tab.', 'eventchamp' ),
					"param_name" => "speakercount",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Spekears', 'eventchamp' ),
					"description" => esc_html__( 'You can enter speaker ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludespeakers",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Order Type', 'eventchamp' ),
					"description" => esc_html__( 'You can select order type.', 'eventchamp' ),
					"param_name" => "ordertype",
					'save_always' => true,
					"group" => esc_html__( 'General', 'eventchamp' ),
					'value' => array(
						esc_html__( 'DESC', 'eventchamp' ) => 'DESC',
						esc_html__( 'ASC', 'eventchamp' ) => 'ASC',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Sort By', 'eventchamp' ),
					"description" => esc_html__( 'You can select sort type.', 'eventchamp' ),
					"param_name" => "sortby",
					'save_always' => true,
					"group" => esc_html__( 'General', 'eventchamp' ),
					'value' => array(
						esc_html__( 'Added Date', 'eventchamp' ) => 'addeddate',
						esc_html__( 'Name', 'eventchamp' ) => 'name',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Pagination', 'eventchamp' ),
					"description" => esc_html__( 'You can select pagination status.', 'eventchamp' ),
					"param_name" => "pagination",
					"group" => esc_html__( 'General', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
			),
		)
		);
	}

	/*====== Venue Carousel ======*/
	function eventchamp_venues_list_carousel_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'venueids' => '',
				'allbutton' => '',
				'navbuttons' => '',
				'venuecount' => '',
				'excludevenues' => '',
				'offset' => '',
				'location' => '',
				'excerpt' => '',
				'style' => '',
				'column' => '',
				'loopstatus' => '',
				'autoplay' => '',
			), $atts
		);

		$output = "";

			if( $atts["location"] == "true" ) {
				$location_status = "true";
			} else {
				$location_status = "false";
			}

			if( $atts["excerpt"] == "true" ) {
				$excerpt_status = "true";
			} else {
				$excerpt_status = "false";
			}

			if( !empty( $atts['excludevenues'] ) ) {
				$excludevenues = explode( ',', $atts['excludevenues'] );
			} else {
				$excludevenues = "";
			}

			if( !empty( $atts['venueids'] ) ) {
				$venueids = explode( ',', $atts['venueids'] );
			} else {
				$venueids = "";
			}

			if( !empty( $atts['column'] ) ) {
				$column = $atts["column"];
			} else {
				$column = "3";
			}

			if( !empty( $atts['autoplay'] ) ) {
				$autoplay = $atts["autoplay"];
			} else {
				$autoplay = "false";
			}

			if( $atts["loopstatus"] == "true" ) {
				$loopstatus = "true";
			} else {
				$loopstatus = "false";
			}

			$args = array(
				'posts_per_page' => $atts["venuecount"],
				'post_status' => 'publish',
				'post__not_in' => $excludevenues,
				'offset' => $atts["offset"],
				'post__in' => $venueids,
				'ignore_sticky_posts' => true,
				'post_type' => 'venue',
			); 
			$output .= '<div class="venues-list-carousel ' . $atts["style"] . '">';
				$wp_query = new WP_Query( $args );
				if( !empty( $wp_query ) ) {
					$output .= '<div class="swiper-container gloria-sliders venues-list-carousel" data-item="' . $column . '" data-column-space="30" data-sloop="' . $loopstatus . '" data-aplay="' . $autoplay . '">';
						$output .= '<div class="swiper-wrapper">';
							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								$output .= '<div class="swiper-slide">';
									$output .= eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = $location_status, $excerpt = $excerpt_status );
								$output .= '</div>';
							}
						$output .= '</div>';
						$output .= '<div class="pagination">';

							if( $atts["navbuttons"] == "true" ) {
								$output .= '<div class="pagination-left prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>';
							}

							if( $atts["allbutton"] == "true" ) {
								$output .= '<div><a href="' . esc_url( get_post_type_archive_link( 'venue' ) ) . '" class="all-button">' . esc_html__( 'All Venues', 'eventchamp' ) . '</a></div>';
							}

							if( $atts["navbuttons"] == "true" ) {
								$output .= '<div class="pagination-right next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>';
							}
						$output .= '</div>';

					$output .= '</div>';
				}
				wp_reset_postdata();
			$output .= '</div>';

		return $output;
	}
	add_shortcode( "eventchamp_venues_list_carousel", "eventchamp_venues_list_carousel_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Venue Carousel', 'eventchamp' ),
			"base" => "eventchamp_venues_list_carousel",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-venues-list-carousel.jpg',
			"description" =>esc_html__( 'Venue Carousel element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Venue Count", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event count for each tab.', 'eventchamp' ),
					"param_name" => "venuecount",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Venue Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter categories ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "includecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Venues', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludevenues",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Column', 'eventchamp' ),
					"description" => esc_html__( 'You can select column.', 'eventchamp' ),
					"param_name" => "column",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( '1', 'eventchamp' ) => '1',
						esc_html__( '2', 'eventchamp' ) => '2',
						esc_html__( '3', 'eventchamp' ) => '3',
						esc_html__( '4', 'eventchamp' ) => '4',
						esc_html__( '5', 'eventchamp' ) => '5',
						esc_html__( '6', 'eventchamp' ) => '6',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Loop', 'eventchamp' ),
					"description" => esc_html__( 'You can select loop status.', 'eventchamp' ),
					"param_name" => "loopstatus",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Autoplay', 'eventchamp' ),
					"description" => esc_html__( 'You can enter autoplay delay.', 'eventchamp' ),
					"param_name" => "autoplay",
					"group" => esc_html__( 'Design', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Style', 'eventchamp' ),
					"description" => esc_html__( 'You can select style.', 'eventchamp' ),
					"param_name" => "style",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'Dark', 'eventchamp' ) => 'dark',
						esc_html__( 'White', 'eventchamp' ) => 'white',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'All Venues Button', 'eventchamp' ),
					"description" => esc_html__( 'You can active all venues button.', 'eventchamp' ),
					"param_name" => "allbutton",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Navigation Buttons', 'eventchamp' ),
					"description" => esc_html__( 'You can active navigation buttons.', 'eventchamp' ),
					"param_name" => "navbuttons",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can active event location.', 'eventchamp' ),
					"param_name" => "location",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
					"description" => esc_html__( 'You can active event excerpt.', 'eventchamp' ),
					"param_name" => "excerpt",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
			),
		)
		);
	}

	/*====== Venue List ======*/
	function eventchamp_venues_list_grid_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'venueids' => '',
				'venuecount' => '',
				'excludevenues' => '',
				'offset' => '',
				'location' => '',
				'excerpt' => '',
			), $atts
		);

		$output = "";

			if( $atts["location"] == "true" ) {
				$location_status = "true";
			} else {
				$location_status = "false";
			}

			if( $atts["excerpt"] == "true" ) {
				$excerpt_status = "true";
			} else {
				$excerpt_status = "false";
			}

			if( !empty( $atts['excludevenues'] ) ) {
				$excludevenues = explode( ',', $atts['excludevenues'] );
			} else {
				$excludevenues = "";
			}

			if( !empty( $atts['venueids'] ) ) {
				$venueids = explode( ',', $atts['venueids'] );
			} else {
				$venueids = "";
			}

			if( !empty( $atts['venueids'] ) ) {
				$orderby = "none";
			} else {
				$orderby = "date";
			}

			$args = array(
				'posts_per_page' => $atts["venuecount"],
				'post_status' => 'publish',
				'post__not_in' => $excludevenues,
				'post__in' => $venueids,
				'orderby' => $orderby,
				'offset' => $atts["offset"],
				'ignore_sticky_posts' => true,
				'post_type' => 'venue',
			); 
			$output .= '<div class="venue-list column-2">';
				$wp_query = new WP_Query( $args );
				if( !empty( $wp_query ) ) {
					$output .= '<div class="swiper-container venues-list-grid">';
							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								$output .= eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = $location_status, $excerpt = $excerpt_status );
							}
					$output .= '</div>';
				}
				wp_reset_postdata();
			$output .= '</div>';

		return $output;
	}
	add_shortcode( "eventchamp_venues_list_grid", "eventchamp_venues_list_grid_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Venue List', 'eventchamp' ),
			"base" => "eventchamp_venues_list_grid",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-venues-list-grid.jpg',
			"description" =>esc_html__( 'Venue List element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Event ID's", 'eventchamp' ),
					"description" => esc_html__( 'You can enter venue ids. Separate with commas 1,2,3 etc. Note: Leave this field blank for latest venues.', 'eventchamp' ),
					"param_name" => "venueids",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Venue Count", 'eventchamp' ),
					"description" => esc_html__( 'You can enter event count for each tab.', 'eventchamp' ),
					"param_name" => "venuecount",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Venue Categories', 'eventchamp' ),
					"description" => esc_html__( 'You can enter categories ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "includecategories",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Venues', 'eventchamp' ),
					"description" => esc_html__( 'You can enter event ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludevenues",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
					"group" => esc_html__( 'General', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Location', 'eventchamp' ),
					"description" => esc_html__( 'You can active event location.', 'eventchamp' ),
					"param_name" => "location",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
					"description" => esc_html__( 'You can active event excerpt.', 'eventchamp' ),
					"param_name" => "excerpt",
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
			),
		)
		);
	}

	/*====== Banner Box ======*/
	function eventchamp_banner_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'bannertitleone' => '',
				'bannertitletwo' => '',
				'link' => '',
				'bannerbg' => '',
			), $atts
		);

		$output = "";

		if( !empty( $atts["bannertitleone"] ) or !empty( $atts["bannertitletwo"] ) or !empty( $atts["link"] ) ) {

			if( !empty( $atts["link"] ) ) {
				$href = $atts["link"];
				$href = vc_build_link( $href );
				if( !empty( $href["target"] ) ) {
					$target = $href["target"];
				} else {
					$target = "_parent";
				}
			}

			if( !empty( $atts["bannerbg"] ) ) {
				$bannerbg = $atts["bannerbg"];
			} else {
				$bannerbg = "";
			}

			$output .= '<div class="eventchamp-banner" style="background-image:url(' . esc_url( wp_get_attachment_url( $bannerbg, 'full', true, true ) ) . ');">';

				if( !empty( $atts["link"] ) ) {
					$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '" title="' . esc_attr( $href["title"] ) . '">';
				}

					$output .= '<div class="content">';
						if( !empty( $atts["bannertitleone"] ) ) {
							$output .= '<span class="italic">' . esc_attr( $atts["bannertitleone"] ) . '</span>';
						}
						if( !empty( $atts["bannertitletwo"] ) ) {
							$output .= '<span class="bold">' . esc_attr( $atts["bannertitletwo"] ) . '</span>';
						}
					$output .= '</div>';

				if( !empty( $atts["link"] ) ) {
					$output .= '</a>';
				}

			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_banner", "eventchamp_banner_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Banner Box', 'eventchamp' ),
			"base" => "eventchamp_banner",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-banner.jpg',
			"description" =>esc_html__( 'Banner Box element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Banner Title One", 'eventchamp' ),
					"description" => esc_html__( 'You can enter banner title for light font.', 'eventchamp' ),
					"param_name" => "bannertitleone",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Banner Title Two", 'eventchamp' ),
					"description" => esc_html__( 'You can enter banner title for light font.', 'eventchamp' ),
					"param_name" => "bannertitletwo",
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Banner Link', 'eventchamp' ),
					"description" => esc_html__( 'You can enter more link.', 'eventchamp' ),
					"param_name" => "link",
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( 'Background', 'eventchamp' ),
					"description" => esc_html__( 'You can upload banner background.', 'eventchamp' ),
					"param_name" => "bannerbg",
				),
			),
		)
		);
	}

	/*====== Service Box ======*/
	function eventchamp_service_box_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'title' => '',
				'text' => '',
				'icon' => '',
				'servicelink' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts["title"] ) or !empty( $atts["text"] ) ) {
			$output .= '<div class="eventchamp-service-box">';
				if( !empty( $atts["icon"] ) ) {
					$output .= '<i class="fa fa-' . esc_attr( $atts["icon"] ) . '"></i>';
				}

					if( !empty( $atts["title"] ) ) {
						if( !empty( $atts["servicelink"] ) ) {
							$href = $atts["servicelink"];
							$href = vc_build_link( $href );
							if( !empty( $href["target"] ) ) {
								$target = $href["target"];
							} else {
								$target = "_parent";
							}

							if( !empty( $href["url"] ) ) {
								$output .= '<div class="title">';
									$output .= '<a href="' . esc_url( $href["url"] ) . '" title="' . esc_attr( $atts["title"] ) . '" target="' . esc_attr( $target ) . '" class="button-link">' . esc_attr( $atts["title"] ) . '</a>';
								$output .= '</div>';
							}
						} else {
							$output .= '<div class="title">' . esc_attr( $atts["title"] ) . '</div>';
						}
					}

				if( !empty( $atts["text"] ) ) {
					$output .= '<p>' . esc_attr( $atts["text"] ) . '</p>';
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_service_box", "eventchamp_service_box_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Service Box', 'eventchamp' ),
			"base" => "eventchamp_service_box",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-service-box.jpg',
			"description" =>esc_html__( 'Service Box element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", 'eventchamp' ),
					"description" => esc_html__( 'You can enter service title.', 'eventchamp' ),
					"param_name" => "title",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Text", 'eventchamp' ),
					"description" => esc_html__( 'You can enter service text.', 'eventchamp' ),
					"param_name" => "text",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Icon', 'eventchamp' ),
					"description" => esc_html__( 'You can enter icon name. List of icons is available in documentation file. Example: edge, automobile, bel-o.', 'eventchamp' ),
					"param_name" => "icon",
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Link', 'eventchamp' ),
					"description" => esc_html__( 'You can enter link.', 'eventchamp' ),
					"param_name" => "servicelink",
				),
			),
		)
		);
	}

	/*====== Blog List ======*/
	function eventchamp_latest_posts_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'category' => '',
				'excludeposts' => '',
				'posttag' => '',
				'postids' => '',
				'offset' => '',
				'postcount' => '',
				'style' => '',
				'pagination' => '',
				'categoryname' => '',
				'postinformation' => '',
				'excerpt' => '',
				'readmore' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts['excludeposts'] ) ) {
			$excludeposts = $atts['excludeposts'];
			$exclude = explode( ',', $excludeposts );
		} else {
			$exclude = "";
		}

		if( !empty( $atts['postids'] ) ) {
			$postids = explode( ',', $atts['postids'] );
		} else {
			$postids = "";
		}

		if( $atts['categoryname'] == "true" ) {
			$category_status = "true";
		} else {
			$category_status = "";
		}

		if( $atts['postinformation'] == "true" ) {
			$information_status = "true";
		} else {
			$information_status = "";
		}

		if( $atts['excerpt'] == "true" ) {
			$excerpt_status = "true";
		} else {
			$excerpt_status = "";
		}

		if( $atts['readmore'] == "true" ) {
			$readmore_status = "true";
		} else {
			$readmore_status = "";
		}

		$style = $atts['style'];

		$paged = is_front_page() ? get_query_var( 'page', 1 ) : get_query_var( 'paged', 1 );
		if( empty( $paged ) ) { $paged = 1; }

		$query_arg = array(
			'posts_per_page' => $atts['postcount'],
			'post__not_in' => $exclude,
			'tag' => $atts['posttag'],
			'cat' => $atts['category'],
			'post__in' => $postids,
			'offset' => $atts['offset'],
			'paged' => $paged,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'post_type' => 'post',
		);
		$post_query = new WP_Query( $query_arg );

		if ( $post_query->have_posts() ) {
			$output .= '<div class="eventchamp-latest-posts-element ' . esc_attr( $style ) . '">';
				if( $style == "style2" ) {
					$output .= '<div class="archive-post-list-style-2 post-list">';
						while ( $post_query->have_posts() ) {
							$post_query->the_post();
							$output .= eventchamp_post_list_style_2( $post_id = get_the_ID(), $image = "true", $category = $category_status, $excerpt = $excerpt_status, $read_more = $readmore_status, $post_info = $information_status );
						}
						wp_reset_postdata();
					$output .= '</div>';
				} elseif( $style == "style3" ) {
					$output .= '<div class="archive-post-list-style-3 post-list">';
						while ( $post_query->have_posts() ) {
							$post_query->the_post();
							$output .= eventchamp_post_list_style_3( $post_id = get_the_ID(), $image = "true", $post_info = $information_status );
						}
						wp_reset_postdata();
					$output .= '</div>';
				} else {
					$output .= '<div class="archive-post-list-style-1 post-list">';
						while ( $post_query->have_posts() ) {
							$post_query->the_post();
							$output .= eventchamp_post_list_style_1( $post_id = get_the_ID(), $image = "true", $category = $category_status, $excerpt = $excerpt_status, $read_more = $readmore_status, $post_info = $information_status );
						}
						wp_reset_postdata();
					$output .= '</div>';
				}

				if ( $atts['pagination'] == 'true' ) {
					$output .= eventchamp_element_pagination( $paged = $paged, $query = $post_query );
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_latest_posts", "eventchamp_latest_posts_output" );

	if(function_exists('vc_map')){
		$posts_list = get_posts(array(
			'orderby' => 'title',
			'order' => 'ASC',
			'post_type' => 'post'
		));

		$posts_array = array();
		$posts_array[esc_html__( 'All Categories', 'eventchamp' )] = "-";
		foreach($posts_list as $post) {
			$posts_array[$post->post_title . " (id:" . esc_attr( $post->ID ) . ")"] = $post->ID;
		}

		$post_categories = get_terms("category");
		$post_categories_array = array();
		$post_categories_array[__("All Categories", 'eventchamp')] = "-";
		foreach($post_categories as $post_category) {
			$post_categories_array[$post_category->name] =  $post_category->term_id;
		}

		vc_map( array(
			"name" => esc_html__( 'Blog List', 'eventchamp' ),
			"base" => "eventchamp_latest_posts",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-latest-posts.jpg',
			"description" =>esc_html__( 'Blog List element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category', 'eventchamp' ),
					"description" => esc_html__( 'You can select category.', 'eventchamp' ),
					"param_name" => "category",
					"value" => $post_categories_array,
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Tag', 'eventchamp' ),
					"description" => esc_html__( 'You can enter post tag.', 'eventchamp' ),
					"param_name" => "posttag",
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Post ID's", 'eventchamp' ),
					"description" => esc_html__( 'You can enter post ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "postids",
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Posts', 'eventchamp' ),
					"description" => esc_html__( 'You can enter post ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludeposts",
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Post Count', 'eventchamp' ),
					"description" => esc_html__( 'You can enter post count.', 'eventchamp' ),
					"param_name" => "postcount",
					"group" => "General",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Style', 'eventchamp' ),
					"description" => esc_html__( 'You can select element style.', 'eventchamp' ),
					"param_name" => "style",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
						esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
						esc_html__( 'Style 3', 'eventchamp' ) => 'style3',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Pagination', 'eventchamp' ),
					"description" => esc_html__( 'You can select pagination status.', 'eventchamp' ),
					"param_name" => "pagination",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category Name', 'eventchamp' ),
					"description" => esc_html__( 'You can hide category name.', 'eventchamp' ),
					"param_name" => "categoryname",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Post Information', 'eventchamp' ),
					"description" => esc_html__( 'You can hide post information.', 'eventchamp' ),
					"param_name" => "postinformation",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
					"description" => esc_html__( 'You can hide post excerpt.', 'eventchamp' ),
					"param_name" => "excerpt",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Read More', 'eventchamp' ),
					"description" => esc_html__( 'You can hide read more button.', 'eventchamp' ),
					"param_name" => "readmore",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				)
			),
		)
		);
	}

	/*====== Blog Carousel ======*/
	function eventchamp_latest_posts_carousel_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'category' => '',
				'excludeposts' => '',
				'posttag' => '',
				'postids' => '',
				'offset' => '',
				'postcount' => '',
				'style' => '',
				'pagination' => '',
				'categoryname' => '',
				'postinformation' => '',
				'excerpt' => '',
				'readmore' => '',
				'link' => '',
				'column' => '',
				'autoplay' => '',
				'loopstatus' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts['column'] ) ) {
			$column = $atts["column"];
		} else {
			$column = "3";
		}

		if( !empty( $atts['autoplay'] ) ) {
			$autoplay = $atts["autoplay"];
		} else {
			$autoplay = "false";
		}

		if( $atts["loopstatus"] == "true" ) {
			$loopstatus = "true";
		} else {
			$loopstatus = "false";
		}

		if( !empty( $atts['excludeposts'] ) ) {
			$excludeposts = $atts['excludeposts'];
			$exclude = explode( ',', $excludeposts );
		} else {
			$exclude = "";
		}

		if( !empty( $atts['postids'] ) ) {
			$postids = explode( ',', $atts['postids'] );
		} else {
			$postids = "";
		}

		if( $atts['categoryname'] == "true" ) {
			$category_status = "true";
		} else {
			$category_status = "";
		}

		if( $atts['postinformation'] == "true" ) {
			$information_status = "true";
		} else {
			$information_status = "";
		}

		if( $atts['excerpt'] == "true" ) {
			$excerpt_status = "true";
		} else {
			$excerpt_status = "";
		}

		if( $atts['readmore'] == "true" ) {
			$readmore_status = "true";
		} else {
			$readmore_status = "";
		}

		if( !empty( $atts["link"] ) ) {
			$href = $atts["link"];
			$href = vc_build_link( $href );
			if( !empty( $href["target"] ) ) {
				$target = $href["target"];
			} else {
				$target = "_parent";
			}
		}

		$query_arg = array(
			'posts_per_page' => $atts['postcount'],
			'post__not_in' => $exclude,
			'tag' => $atts['posttag'],
			'cat' => $atts['category'],
			'post__in' => $postids,
			'offset' => $atts['offset'],
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'post_type' => 'post',
		);
		$post_query = new WP_Query( $query_arg );

		if ( $post_query->have_posts() ) {
			$output .= '<div class="swiper-container gloria-sliders eventchamp-latest-posts-carousel"  data-item="' . $column . '" data-column-space="30" data-sloop="' . $loopstatus . '" data-aplay="' . $autoplay . '">';
				$output .= '<div class="swiper-wrapper">';
					while ( $post_query->have_posts() ) {
						$post_query->the_post();
						$output .= '<div class="swiper-slide">' . eventchamp_post_list_style_2( $post_id = get_the_ID(), $image = "true", $category = $category_status, $excerpt = $excerpt_status, $read_more = $readmore_status, $post_info = $information_status ) . '</div>';
					}
					wp_reset_postdata();
				$output .= '</div>';
				if ( $atts['pagination'] == 'true' ) {
					$output .= '<div class="pagination">';
						$output .= '<div class="pagination-left prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>';
							if( !empty( $atts["link"] ) ) {
								$output .= '<div><a href="' . esc_url( $href["url"] ) . '" title="' . esc_attr( $href["title"] ) . '" target="' . esc_attr( $target ) . '" class="all-button">' . esc_attr( $href["title"] ) . '</a></div>';
							}
						$output .= '<div class="pagination-right next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>';
					$output .= '</div>';
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_latest_posts_carousel", "eventchamp_latest_posts_carousel_output" );

	if(function_exists('vc_map')){
		$posts_list = get_posts(array(
			'orderby' => 'title',
			'order' => 'ASC',
			'post_type' => 'post'
		));

		$posts_array = array();
		$posts_array[esc_html__( 'All Categories', 'eventchamp' )] = "-";
		foreach($posts_list as $post) {
			$posts_array[$post->post_title . " (id:" . esc_attr( $post->ID ) . ")"] = $post->ID;
		}

		$post_categories = get_terms("category");
		$post_categories_array = array();
		$post_categories_array[__("All Categories", 'eventchamp')] = "-";
		foreach($post_categories as $post_category) {
			$post_categories_array[$post_category->name] =  $post_category->term_id;
		}

		vc_map( array(
			"name" => esc_html__( 'Blog Carousel', 'eventchamp' ),
			"base" => "eventchamp_latest_posts_carousel",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-latest-posts-carousel.jpg',
			"description" =>esc_html__( 'Blog Carousel element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category', 'eventchamp' ),
					"description" => esc_html__( 'You can select category.', 'eventchamp' ),
					"param_name" => "category",
					"value" => $post_categories_array,
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Tag', 'eventchamp' ),
					"description" => esc_html__( 'You can enter post tag.', 'eventchamp' ),
					"param_name" => "posttag",
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Post ID's", 'eventchamp' ),
					"description" => esc_html__( 'You can enter post ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "postids",
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Exclude Posts', 'eventchamp' ),
					"description" => esc_html__( 'You can enter post ids. Separate with commas 1,2,3 etc.', 'eventchamp' ),
					"param_name" => "excludeposts",
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Offset', 'eventchamp' ),
					"description" => esc_html__( 'You can enter offset number.', 'eventchamp' ),
					"param_name" => "offset",
					"group" => "General",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Post Count', 'eventchamp' ),
					"description" => esc_html__( 'You can enter post count.', 'eventchamp' ),
					"param_name" => "postcount",
					"group" => "General",
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Blog Link', 'eventchamp' ),
					"description" => esc_html__( 'You can enter blog link.', 'eventchamp' ),
					"param_name" => "link",
					"group" => "General",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Column', 'eventchamp' ),
					"description" => esc_html__( 'You can select column.', 'eventchamp' ),
					"param_name" => "column",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( '1', 'eventchamp' ) => '1',
						esc_html__( '2', 'eventchamp' ) => '2',
						esc_html__( '3', 'eventchamp' ) => '3',
						esc_html__( '4', 'eventchamp' ) => '4',
						esc_html__( '5', 'eventchamp' ) => '5',
						esc_html__( '6', 'eventchamp' ) => '6',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Loop', 'eventchamp' ),
					"description" => esc_html__( 'You can select loop status.', 'eventchamp' ),
					"param_name" => "loopstatus",
					'save_always' => true,
					"group" => esc_html__( 'Design', 'eventchamp' ),
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Autoplay', 'eventchamp' ),
					"description" => esc_html__( 'You can enter autoplay delay.', 'eventchamp' ),
					"param_name" => "autoplay",
					"group" => esc_html__( 'Design', 'eventchamp' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Pagination', 'eventchamp' ),
					"description" => esc_html__( 'You can select pagination status.', 'eventchamp' ),
					"param_name" => "pagination",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Category Name', 'eventchamp' ),
					"description" => esc_html__( 'You can hide category name.', 'eventchamp' ),
					"param_name" => "categoryname",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Post Information', 'eventchamp' ),
					"description" => esc_html__( 'You can hide post information.', 'eventchamp' ),
					"param_name" => "postinformation",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Excerpt', 'eventchamp' ),
					"description" => esc_html__( 'You can hide post excerpt.', 'eventchamp' ),
					"param_name" => "excerpt",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Read More', 'eventchamp' ),
					"description" => esc_html__( 'You can hide read more button.', 'eventchamp' ),
					"param_name" => "readmore",
					"group" => "Design",
					'save_always' => true,
					'value' => array(
						esc_html__( 'False', 'eventchamp' ) => 'false',
						esc_html__( 'True', 'eventchamp' ) => 'true',
					),
				)
			),
		)
		);
	}

	/*====== Testimonial Carousel ======*/
	function eventchamp_testimonials_output( $atts, $content = null ) {		
		$atts = shortcode_atts(
			array(
				'column' => '',
				'loopstatus' => '',
				'autoplay' => '',
			), $atts
		);

		if( !empty( $atts['column'] ) ) {
			$column = $atts["column"];
		} else {
			$column = "3";
		}

		if( !empty( $atts['autoplay'] ) ) {
			$autoplay = $atts["autoplay"];
		} else {
			$autoplay = "false";
		}

		if( $atts["loopstatus"] == "true" ) {
			$loopstatus = "true";
		} else {
			$loopstatus = "false";
		}

		$output = '';
			$output .= '<div class="swiper-container gloria-sliders eventchamp-testimonials-carousel" data-item="' . $column . '" data-column-space="30" data-sloop="' . $loopstatus . '" data-aplay="' . $autoplay . '">';
				$output .= '<div class="swiper-wrapper">';
					$output .= do_shortcode( $content );
				$output .= '</div>';
				$output .= '<div class="swiper-pagination"></div>';
			$output .= '</div>';

			return $output;
	}
	add_shortcode( "eventchamp_testimonials", "eventchamp_testimonials_output" );

	function eventchamp_testimonials_item_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'image' => '',
				'name' => '',
				'text' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts["name"] ) or !empty( $atts["text"] ) ) {
			$output .= '<div class="swiper-slide">';
				if( !empty( $atts["image"] ) ) {
					if( !empty( $atts["image"] ) ) {
						$image = $atts["image"];
					} else {
						$image = "";
					}
					$output .= '<div class="image">';
						$output .= wp_get_attachment_image( $image, 'thumbnail', true, array( "alt" => $atts["name"] ) );
					$output .= '</div>';
				}
				if( !empty( $atts["text"] ) ) {
					$output .= '<div class="content">';
						$output .= '<p>' . esc_attr( $atts["text"] ) . '</p>';
						if( !empty( $atts["name"] ) ) {
							$output .= '<div class="name">' . esc_attr( $atts["name"] ) . '</div>';
						}
					$output .= '</div>';
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode("eventchamp_testimonials_item", "eventchamp_testimonials_item_shortcode");

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Testimonial Carousel', 'eventchamp' ),
			"base" => "eventchamp_testimonials",
			"as_parent" => array('only' => 'eventchamp_testimonials_item'),
			"js_view" => 'VcColumnView',
			"content_element" => true,
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-testimonials.jpg',
			"description" =>esc_html__( 'Testimonial Carousel element.', 'eventchamp' ),
			"params" => array(
					array(
						"type" => "dropdown",
						"heading" => esc_html__( 'Column', 'eventchamp' ),
						"description" => esc_html__( 'You can select column.', 'eventchamp' ),
						"param_name" => "column",
						'save_always' => true,
						'value' => array(
							esc_html__( '1', 'eventchamp' ) => '1',
							esc_html__( '2', 'eventchamp' ) => '2',
							esc_html__( '3', 'eventchamp' ) => '3',
							esc_html__( '4', 'eventchamp' ) => '4',
							esc_html__( '5', 'eventchamp' ) => '5',
							esc_html__( '6', 'eventchamp' ) => '6',
						),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( 'Loop', 'eventchamp' ),
						"description" => esc_html__( 'You can select loop status.', 'eventchamp' ),
						"param_name" => "loopstatus",
						'save_always' => true,
						'value' => array(
							esc_html__( 'False', 'eventchamp' ) => 'false',
							esc_html__( 'True', 'eventchamp' ) => 'true',
						),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Autoplay', 'eventchamp' ),
						"description" => esc_html__( 'You can enter autoplay delay.', 'eventchamp' ),
						"param_name" => "autoplay",
					),
				)
		)
		);
	}

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__("Testimonial Carousel Item", 'eventchamp'),
			"base" => "eventchamp_testimonials_item",
			"as_child" => array( 'only' => 'eventchamp_testimonials' ),
			"content_element" => true,
			"category" => esc_html__("Event Champ Theme", 'eventchamp'),
			"icon" => get_template_directory_uri().'/include/assets/img/icons/eventchamp-testimonials.jpg',
			"description" =>esc_html__( 'Testimonial Carousel Item element.','eventchamp'),
			"params" => array(
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_html__( 'Image','eventchamp'),
					"description" => esc_html__( 'You can upload customer image. Suitably: 110x110', 'eventchamp'),
					"param_name" => "image",
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__( 'Name','eventchamp'),
					"description" => esc_html__( 'You can enter customer name.', 'eventchamp'),
					"param_name" => "name",
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__( 'Content','eventchamp'),
					"description" => esc_html__( 'You can enter customer feedback.', 'eventchamp'),
					"param_name" => "text",
				)
			)
		) );
	}

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_eventchamp_testimonials extends WPBakeryShortCodesContainer {}
	}

	/*====== Number Counter ======*/
	function eventchamp_step_boxes_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'countertitle' => '',
				'style' => '',
				'counternumber' => '',
			), $atts
		);
		
		$output = '';
			
		if( !empty( $atts['counternumber'] ) or !empty( $atts['countertitle'] ) ) {
			$output .= '<div class="eventchamp-counter ' . esc_attr( $atts["style"] ) . '">';
				if( !empty( $atts['counternumber'] ) ) {
					if( !empty( $atts['counternumber'] ) ) {
						$counternumber = esc_attr( $atts['counternumber'] );
					} else {
						$counternumber = "1";
					}

					if( !empty( $atts['counternumber'] ) ) {
						$output .= '<div class="number">' . esc_attr( $atts['counternumber'] ) . '</div>';
					}
					if( !empty( $atts['countertitle'] ) ) {
						$output .= '<div class="title">' . esc_attr( $atts['countertitle'] ) . '</div>';
					}
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode("eventchamp_step_boxes", "eventchamp_step_boxes_shortcode");

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__("Number Counter", 'eventchamp'),
			"base" => "eventchamp_step_boxes",
			"class" => "",
			"category" => esc_html__("Event Champ Theme", 'eventchamp'),
			"icon" => get_template_directory_uri().'/include/assets/img/icons/eventchamp-counter.png',
			"description" =>esc_html__( 'Number Counter element.','eventchamp'),
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__("Title",'eventchamp'),
					"description" => esc_html__("You can enter counter title.", 'eventchamp'),
					"param_name" => "countertitle",
					"value" => ""
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__("Number",'eventchamp'),
					"description" => esc_html__("You can enter counter number.", 'eventchamp'),
					"param_name" => "counternumber",
					"value" => ""
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Style', 'eventchamp' ),
					"description" => esc_html__( 'You can select style.', 'eventchamp' ),
					"param_name" => "style",
					'save_always' => true,
					'value' => array(
						esc_html__( 'Colored', 'eventchamp' ) => 'colored',
						esc_html__( 'White', 'eventchamp' ) => 'white',
					),
				),
			)
		) );
	}

	/*====== Contact Box ======*/
	function eventchamp_contact_box_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'address' => '',
				'email' => '',
				'phone' => '',
				'fax' => '',
				'abouttext' => '',
				'aboutlink' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts["address"] ) or !empty( $atts["email"] ) or !empty( $atts["phone"] ) or !empty( $atts["fax"] ) or !empty( $atts["abouttext"] ) or !empty( $atts["aboutlink"] ) ) {
			$output .= '<div class="eventchamp-contact-box">';
				if( !empty( $atts["abouttext"] ) ) {
					$output .= '<div class="contact-row about-text">' . esc_attr( $atts["abouttext"] ) . '</div>';
				}

				if( !empty( $atts["address"] ) ) {
					$output .= '<div class="contact-row address"><i class="fa fa-map-marker" aria-hidden="true"></i>' . esc_attr( $atts["address"] ) . '</div>';
				}

				if( !empty( $atts["email"] ) ) {
					$output .= '<div class="contact-row email"><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:' . esc_attr( str_replace(' ', '', $atts["email"] ) ) . '">' . esc_attr( $atts["email"] ) . '</a></div>';
				}

				if( !empty( $atts["phone"] ) ) {
					$output .= '<div class="contact-row phone"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+' . esc_attr( str_replace(' ', '', $atts["phone"] ) ) . '">' . esc_attr( $atts["phone"] ) . '</a></div>';
				}

				if( !empty( $atts["fax"] ) ) {
					$output .= '<div class="contact-row fax"><i class="fa fa-fax" aria-hidden="true"></i>' . esc_attr( $atts["fax"] ) . '</div>';
				}

				if( !empty( $atts["aboutlink"] ) ) {
					$href = $atts["aboutlink"];
					$href = vc_build_link( $href );
					if( !empty( $href["target"] ) ) {
						$target = $href["target"];
					} else {
						$target = "_parent";
					}

					$output .= '<div class="contact-row about-link">';
						$output .= '<a href="' . esc_url( $href["url"] ) . '" title="' . esc_attr( $href["title"] ) . '" target="' . esc_attr( $target ) . '" class="about-more-link">' . esc_attr( $href["title"] ) . '</a>';
					$output .= '</div>';
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_contact_box", "eventchamp_contact_box_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Contact Box', 'eventchamp' ),
			"base" => "eventchamp_contact_box",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-contact-box.jpg',
			"description" =>esc_html__( 'Contact Box element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Address", 'eventchamp' ),
					"description" => esc_html__( 'You can enter address.', 'eventchamp' ),
					"param_name" => "address",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Email", 'eventchamp' ),
					"description" => esc_html__( 'You can enter email.', 'eventchamp' ),
					"param_name" => "email",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Phone", 'eventchamp' ),
					"description" => esc_html__( 'You can enter phone.', 'eventchamp' ),
					"param_name" => "phone",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Fax", 'eventchamp' ),
					"description" => esc_html__( 'You can enter fax.', 'eventchamp' ),
					"param_name" => "fax",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "About Text", 'eventchamp' ),
					"description" => esc_html__( 'You can enter about text.', 'eventchamp' ),
					"param_name" => "abouttext",
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'About Link', 'eventchamp' ),
					"description" => esc_html__( 'You can enter about link.', 'eventchamp' ),
					"param_name" => "aboutlink",
				),
			),
		)
		);
	}

	/*====== App Box ======*/
	function eventchamp_app_box_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'applestore' => '',
				'googleplay' => '',
				'windowstore' => '',
				'amazon' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts["applestore"] ) or !empty( $atts["googleplay"] ) or !empty( $atts["windowstore"] ) or !empty( $atts["amazon"] ) ) {
			$output .= '<div class="eventchamp-app-box">';
				if( !empty( $atts["applestore"] ) ) {
					$output .= '<div class="app-item applestore">';
						$href = $atts["applestore"];
						$href = vc_build_link( $href );
						if( !empty( $href["target"] ) ) {
							$target = $href["target"];
						} else {
							$target = "_parent";
						}

						$output .= '<a href="' . esc_url( $href["url"] ) . '" title="' . esc_attr( $href["title"] ) . '" target="' . esc_attr( $target ) . '">';
							$output .= '<i class="fa fa-apple" aria-hidden="true"></i>';
							$output .= '<div class="description">';
								$output .= '<span class="name">' . esc_html__( 'Download via', 'eventchamp' ) . '</span>';
								$output .= '<span class="app-name">' . esc_html__( 'Apple Store', 'eventchamp' ) . '</span>';
							$output .= '</div>';
						$output .= '</a>';
					$output .= '</div>';
				}
				if( !empty( $atts["googleplay"] ) ) {
					$output .= '<div class="app-item googleplay">';
						$href = $atts["googleplay"];
						$href = vc_build_link( $href );
						if( !empty( $href["target"] ) ) {
							$target = $href["target"];
						} else {
							$target = "_parent";
						}
						
						$output .= '<a href="' . esc_url( $href["url"] ) . '" title="' . esc_attr( $href["title"] ) . '" target="' . esc_attr( $target ) . '">';
							$output .= '<i class="fa fa-play" aria-hidden="true"></i>';
							$output .= '<div class="description">';
								$output .= '<span class="name">' . esc_html__( 'Download via', 'eventchamp' ) . '</span>';
								$output .= '<span class="app-name">' . esc_html__( 'Google Play', 'eventchamp' ) . '</span>';
							$output .= '</div>';
						$output .= '</a>';
					$output .= '</div>';
				}
				if( !empty( $atts["windowstore"] ) ) {
					$output .= '<div class="app-item windowstore">';
						$href = $atts["windowstore"];
						$href = vc_build_link( $href );
						if( !empty( $href["target"] ) ) {
							$target = $href["target"];
						} else {
							$target = "_parent";
						}
						
						$output .= '<a href="' . esc_url( $href["url"] ) . '" title="' . esc_attr( $href["title"] ) . '" target="' . esc_attr( $target ) . '">';
							$output .= '<i class="fa fa-windows" aria-hidden="true"></i>';
							$output .= '<div class="description">';
								$output .= '<span class="name">' . esc_html__( 'Download via', 'eventchamp' ) . '</span>';
								$output .= '<span class="app-name">' . esc_html__( 'Windows', 'eventchamp' ) . '</span>';
							$output .= '</div>';
						$output .= '</a>';
					$output .= '</div>';
				}
				if( !empty( $atts["amazon"] ) ) {
					$output .= '<div class="app-item amazon">';
						$href = $atts["amazon"];
						$href = vc_build_link( $href );
						if( !empty( $href["target"] ) ) {
							$target = $href["target"];
						} else {
							$target = "_parent";
						}
						
						$output .= '<a href="' . esc_url( $href["url"] ) . '" title="' . esc_attr( $href["title"] ) . '" target="' . esc_attr( $target ) . '">';
							$output .= '<i class="fa fa-amazon" aria-hidden="true"></i>';
							$output .= '<div class="description">';
								$output .= '<span class="name">' . esc_html__( 'Download via', 'eventchamp' ) . '</span>';
								$output .= '<span class="app-name">' . esc_html__( 'Amazon', 'eventchamp' ) . '</span>';
							$output .= '</div>';
						$output .= '</a>';
					$output .= '</div>';
				}
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_app_box", "eventchamp_app_box_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'App Box', 'eventchamp' ),
			"base" => "eventchamp_app_box",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-app-box.jpg',
			"description" =>esc_html__( 'App Box element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Apple Store', 'eventchamp' ),
					"description" => esc_html__( 'You can enter Apple Store link.', 'eventchamp' ),
					"param_name" => "applestore",
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Google Play', 'eventchamp' ),
					"description" => esc_html__( 'You can enter Google Play link.', 'eventchamp' ),
					"param_name" => "googleplay",
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Windows Store', 'eventchamp' ),
					"description" => esc_html__( 'You can enter Windows Store link.', 'eventchamp' ),
					"param_name" => "windowstore",
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Amazon', 'eventchamp' ),
					"description" => esc_html__( 'You can enter Amazon link.', 'eventchamp' ),
					"param_name" => "amazon",
				),
			),
		)
		);
	}

	/*====== Button ======*/
	function eventchamp_button_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'buttonlink' => '',
				'icon' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts["buttonlink"] ) ) {
			$output .= '<div class="eventchamp-button">';
				$href = $atts["buttonlink"];
				$href = vc_build_link( $href );
				if( !empty( $href["target"] ) ) {
					$target = $href["target"];
				} else {
					$target = "_parent";
				}

				$output .= '<a href="' . esc_url( $href["url"] ) . '" target="' . esc_attr( $target ) . '" title="' . esc_attr( $href["title"] ) . '">';
					if( !empty( $atts["icon"] ) ) {
						$output .= '<i class="fa fa-' . esc_attr( $atts["icon"] ) . '" aria-hidden="true"></i>';
					}
					$output .= '<span>' . esc_attr( $href["title"] ) . '</span>';
				$output .= '</a>';
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_button", "eventchamp_button_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Button', 'eventchamp' ),
			"base" => "eventchamp_button",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-button.jpg',
			"description" =>esc_html__( 'Button element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "vc_link",
					"heading" => esc_html__( 'Button Link', 'eventchamp' ),
					"description" => esc_html__( 'You can enter button link.', 'eventchamp' ),
					"param_name" => "buttonlink",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Icon', 'eventchamp' ),
					"description" => esc_html__( 'You can enter icon name. List of icons is available in documentation file. Example: edge, automobile, bel-o.', 'eventchamp' ),
					"param_name" => "icon",
				)
			),
		)
		);
	}

	/*====== Modal Button ======*/
	function eventchamp_modal_button_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'buttontitle' => '',
				'text' => '',
				'content' => '',
				'shortcode' => '',
				'iframe' => '',
				'icon' => '',
			), $atts
		);
		
		$output = '';

		 $atts['content'] = $content;

		$rand = rand( 1, 99999 );

		if( !empty( $atts["buttontitle"] ) ) {
			$output .= '<div class="eventchamp-button">';
				$output .= '<a title="' . esc_attr( $atts["buttontitle"] ) . '" type="button" data-toggle="modal" data-target="#modal_' . esc_attr( $rand ) . '">';
					if( !empty( $atts["icon"] ) ) {
						$output .= '<i class="fa fa-' . esc_attr( $atts["icon"] ) . '" aria-hidden="true"></i>';
					}
					$output .= '<span>' . esc_attr( $atts["buttontitle"] ) . '</span>';
				$output .= '</a>';
			$output .= '</div>';
			$output .= '<div class="modal fade bs-example-modal-lg eventchamp-modal" id="modal_' . esc_attr( $rand ) . '" tabindex="-1" role="dialog" aria-labelledby="modal_' . esc_attr( $rand ) . 'Label">
						  <div class="modal-dialog modal-lg" role="document">
						    <div class="modal-content">
						    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						    	<div class="modal-body">';
									if( !empty( $atts["text"] ) ) {
										$output .= '<div class="content">' . $atts["text"] . '</div>';
									}
									if( !empty( $atts["content"] ) ) {
										$output .= '<div class="content">' . $atts["content"] . '</div>';
									}
									if( !empty( $atts["shortcode"] ) ) {
										$output .= '<div class="content">' . do_shortcode( '[mc4wp_form id="' . esc_attr( $atts["shortcode"] ) . '"]' ) . '</div>';
									}
									if( !empty( $atts["iframe"] ) ) {
										$output .= '<iframe width="100%" height="550" frameborder="0" src="' . esc_url( $atts["iframe"] ) . '"></iframe>';
									}
								$output .= '</div>';
						    $output .= '</div>
						  </div>
						</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_modal_button", "eventchamp_modal_button_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Modal Button', 'eventchamp' ),
			"base" => "eventchamp_modal_button",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-button.jpg',
			"description" =>esc_html__( 'Modal Button element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Button Title', 'eventchamp' ),
					"description" => esc_html__( 'You can enter button title.', 'eventchamp' ),
					"param_name" => "buttontitle",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Icon', 'eventchamp' ),
					"description" => esc_html__( 'You can enter icon name. List of icons is available in documentation file. Example: edge, automobile, bel-o.', 'eventchamp' ),
					"param_name" => "icon",
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__( 'Standard Content', 'eventchamp' ),
					"description" => esc_html__( 'You can enter content for modal.', 'eventchamp' ),
					"param_name" => "text",
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__( 'HTML Content', 'eventchamp' ),
					"description" => esc_html__( 'You can enter html content for modal.', 'eventchamp' ),
					"param_name" => "content",
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__( 'Shortcode', 'eventchamp' ),
					"description" => esc_html__( 'You can enter your shortcode for modal.', 'eventchamp' ),
					"param_name" => "shortcode",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Map Iframe Link', 'eventchamp' ),
					"description" => esc_html__( 'You can enter map iframe link.', 'eventchamp' ),
					"param_name" => "iframe",
				)
			),
		)
		);
	}

	/*====== MailChimp Newsletter ======*/
	function eventchamp_mailchimp_newsletter_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => '',
				'style' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts["id"] ) ) {
			$output = '<div class="eventchamp-newsletter-element ' . esc_attr( $atts["style"] ) . '">';
				$output .= do_shortcode( '[mc4wp_form id="' . esc_attr( $atts["id"] ) . '"]' );
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( "eventchamp_mailchimp_newsletter", "eventchamp_mailchimp_newsletter_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'MailChimp Newsletter', 'eventchamp' ),
			"base" => "eventchamp_mailchimp_newsletter",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-mailchimp-newsletter.jpg',
			"description" =>esc_html__( 'MailChimp Newsletter element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'MailChimp Newsletter ID', 'eventchamp' ),
					"description" => esc_html__( 'You can enter MailChimp newsletter id.', 'eventchamp' ),
					"param_name" => "id",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Style', 'eventchamp' ),
					"description" => esc_html__( 'You can select title style.', 'eventchamp' ),
					"param_name" => "style",
					'save_always' => true,
					'value' => array(
						esc_html__( 'Dark', 'eventchamp' ) => 'dark',
						esc_html__( 'White', 'eventchamp' ) => 'white',
					),
				),
			),
		)
		);
	}

	/*====== Icon List ======*/
	function eventchamp_icon_list_output( $atts, $content = null ) {		
		$atts = shortcode_atts(
			array(
				'style' => '',
			), $atts
		);

			$output = '';

			$output .= '<div class="eventchamp-icon-list ' . esc_attr( $atts["style"] ) . '">';
				$output .= '<ul>';
					$output .= do_shortcode( $content );
				$output .= '</ul>';
			$output .= '</div>';


			return $output;
	}
	add_shortcode( "eventchamp_icon_list", "eventchamp_icon_list_output" );

	function eventchamp_icon_list_item_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'text' => '',
				'icon' => '',
			), $atts
		);
		
		$output = '';

		if( !empty( $atts["text"] ) ) {
			$output .= '<li>';
				if( !empty( $atts["icon"] ) ) {
					$output .= '<i class="fa fa-' . esc_attr( $atts["icon"] ) . '" aria-hidden="true"></i>';
				}
				if( !empty( $atts["text"] ) ) {
					$output .= '<div class="text">' . esc_attr( $atts["text"] ) . '</div>';
				}
			$output .= '</li>';
		}

		return $output;
	}
	add_shortcode("eventchamp_icon_list_item", "eventchamp_icon_list_item_shortcode");

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Icon List', 'eventchamp' ),
			"base" => "eventchamp_icon_list",
			"as_parent" => array('only' => 'eventchamp_icon_list_item'),
			"js_view" => 'VcColumnView',
			"content_element" => true,
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-icon-list.jpg',
			"description" =>esc_html__( 'Icon List element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Style', 'eventchamp' ),
					"description" => esc_html__( 'You can select style.', 'eventchamp' ),
					"param_name" => "style",
					'save_always' => true,
					'value' => array(
						esc_html__( 'Style 1', 'eventchamp' ) => 'style1',
						esc_html__( 'Style 2', 'eventchamp' ) => 'style2',
					),
				),
			)
		)
		);
	}

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__("Icon List Item", 'eventchamp'),
			"base" => "eventchamp_icon_list_item",
			"as_child" => array( 'only' => 'eventchamp_icon_list' ),
			"content_element" => true,
			"category" => esc_html__("Event Champ Theme", 'eventchamp'),
			"icon" => get_template_directory_uri().'/include/assets/img/icons/eventchamp-icon-list.jpg',
			"description" =>esc_html__( 'Icon List Item element.','eventchamp'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Text', 'eventchamp' ),
					"description" => esc_html__( 'You can enter text.', 'eventchamp' ),
					"param_name" => "text",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Icon', 'eventchamp' ),
					"description" => esc_html__( 'You can enter icon name. List of icons is available in documentation file. Example: edge, automobile, bel-o.', 'eventchamp' ),
					"param_name" => "icon",
				),
			)
		) );
	}

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_eventchamp_icon_list extends WPBakeryShortCodesContainer {}
	}

	/*====== Video / Audio Player ======*/
	function eventchamp_video_audio_element_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'contenttype' => '',
				'videoid' => '',
				'html5link' => '',
				'posterimage' => '',
			), $atts
		);
		
		$output = '';

			if( !empty( $atts["videoid"] ) or !empty( $atts["html5link"] ) ) {
				$output .= '<div class="eventchamp-video-audio-element">';

					if( $atts["contenttype"] == "vimeo" ) {
						if( !empty( $atts["videoid"] ) ) {
							$output .= '<div data-type="vimeo" data-video-id="' . esc_attr( $atts["videoid"] ) . '"></div>';
						}
					} elseif( $atts["contenttype"] == "html5video" ) {
						if( !empty( $atts["html5link"] ) ) {
							$output .= '<video poster="' . esc_url( wp_get_attachment_url( esc_attr( $atts["posterimage"] ), 'full', true, true ) ) . '" controls>
										  <source src="' . esc_url( $atts["html5link"] ) . '" type="video/mp4">
										</video>';
						}
					} elseif( $atts["contenttype"] == "html5audio" ) {
						if( !empty( $atts["html5link"] ) ) {
							$output .= '<audio controls>
										  <source src="' . esc_url( $atts["html5link"] ) . '" type="audio/mp3">
										</audio>';
						}
					} else {
						if( !empty( $atts["videoid"] ) ) {
							$output .= '<div data-type="youtube" data-video-id="' . esc_attr( $atts["videoid"] ) . '"></div>';
						}
					}

				$output .= '</div>';
			}

		return $output;
	}
	add_shortcode( "eventchamp_video_audio_element", "eventchamp_video_audio_element_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Video / Audio Player', 'eventchamp' ),
			"base" => "eventchamp_video_audio_element",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-video-audio-element.jpg',
			"description" =>esc_html__( 'Video / Audio Player element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Content Type', 'eventchamp' ),
					"description" => esc_html__( 'You can select content type.', 'eventchamp' ),
					"param_name" => "contenttype",
					'save_always' => true,
					'value' => array(
						esc_html__( 'YouTube', 'eventchamp' ) => 'youtube',
						esc_html__( 'Vimeo', 'eventchamp' ) => 'vimeo',
						esc_html__( 'HTML5 Video', 'eventchamp' ) => 'html5video',
						esc_html__( 'HTML5 Audio', 'eventchamp' ) => 'html5audio',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Video ID for YouTube / Video', 'eventchamp' ),
					"description" => esc_html__( 'You can enter video id for YouTube / Vimeo.', 'eventchamp' ),
					"param_name" => "videoid",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( 'Video / Audio Link for HTML5', 'eventchamp' ),
					"description" => esc_html__( 'You can enter video / audio link for HTML5 player.', 'eventchamp' ),
					"param_name" => "html5link",
				),
				array(
					"type" => "attach_image",
					"class" => "",
					"heading" => esc_html__( 'Video Poster for HTML5 Vimeo','eventchamp'),
					"description" => esc_html__( 'You can upload HTML video poster image.', 'eventchamp'),
					"param_name" => "posterimage",
				),
			),
		)
		);
	}

	/*====== Event Calendar ======*/
	function eventchamp_event_calendar_output( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'contenttype' => '',
			), $atts
		);
		
		$output = '';
		$items = '';

		$args = array(
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'post_type' => 'event',
		);
		$wp_query = new WP_Query( $args );
		if( !empty( $wp_query ) ) {
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
				if( empty( $event_start_date ) ) {
					$event_start_date = "";
				}

				$event_start_time = get_post_meta( get_the_ID(), 'event_start_time', true );
				if( !empty( $event_start_time ) ) {
					$event_start_time = "T" . $event_start_time;
				} else {
					$event_start_time = "";					
				}

				$event_end_date = get_post_meta( get_the_ID(), 'event_end_date', true );
				if( empty( $event_end_date ) ) {
					$event_end_date = "";
				}

				$event_end_time = get_post_meta( get_the_ID(), 'event_end_time', true );
				if( !empty( $event_end_time ) ) {
					$event_end_time = "T" . $event_end_time;
				} else {
					$event_end_time = "";
				}

				$items .= "{
							id: " . get_the_ID() . ",
							title: '" . the_title_attribute( array( 'echo' => 0, 'post' => get_the_ID() ) ) . "',
							url: '" . get_the_permalink() . "',
							start: '" . $event_start_date . $event_start_time . "',
							end: '" . $event_end_date . $event_end_time . "'
						},
						";
			}

			$date_now = date("Y-m-d");

			if( $atts["contenttype"] == "calendar" ) {
				$type = "month";
				$def = "";
			} elseif( $atts["contenttype"] == "calendarlistweek" ) {
				$type = "month,listWeek";
				$def = "";
			} elseif( $atts["contenttype"] == "calendarlistday" ) {
				$type = "month,listDay";
				$def = "";
			} elseif( $atts["contenttype"] == "fully" ) {
				$type = "month,agendaWeek,agendaDay,listWeek";
				$def = "";
			} elseif( $atts["contenttype"] == "listweek" ) {
				$type = "listWeek";
				$def = "defaultView: 'listWeek',";
			} elseif( $atts["contenttype"] == "listday" ) {
				$type = "listDay";
				$def = "defaultView: 'listDay',";
			} else {
				$type = "month";
				$def = "";
			}

			wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
				$('#calendar-datepicker').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: '" . $type .  "'
					},
					defaultDate: '".$date_now."',
					" . $def . "
					navLinks: true,
					editable: true,
					eventLimit: true,
					events: [".$items."]
				});
			});" );
		}
		wp_reset_postdata();

		$output .= '<div class="event-calendar-element">';
			$output .= '<div id="calendar-datepicker"></div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( "eventchamp_event_calendar", "eventchamp_event_calendar_output" );

	if(function_exists('vc_map')){
		vc_map( array(
			"name" => esc_html__( 'Event Calendar', 'eventchamp' ),
			"base" => "eventchamp_event_calendar",
			"category" => esc_html__( 'Event Champ Theme', 'eventchamp' ),
			"icon" => get_template_directory_uri() . '/include/assets/img/icons/eventchamp-event-calendar.jpg',
			"description" =>esc_html__( 'Event Calendar element.', 'eventchamp' ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( 'Content Type', 'eventchamp' ),
					"description" => esc_html__( 'You can select content type.', 'eventchamp' ),
					"param_name" => "contenttype",
					'save_always' => true,
					'value' => array(
						esc_html__( 'Calendar', 'eventchamp' ) => 'calendar',
						esc_html__( 'Calendar + List Week', 'eventchamp' ) => 'calendarlistweek',
						esc_html__( 'Calendar + List Day', 'eventchamp' ) => 'calendarlistday',
						esc_html__( 'Fully', 'eventchamp' ) => 'fully',
						esc_html__( 'List Week', 'eventchamp' ) => 'listweek',
						esc_html__( 'List Day', 'eventchamp' ) => 'listday',
						esc_html__( 'External Dragging', 'eventchamp' ) => 'externaldragging',
					),
				),
			),
		)
		);
	}