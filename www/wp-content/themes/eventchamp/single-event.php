<?php
/**
	* The template for displaying single event
*/
get_header(); ?>

	<?php eventchamp_sub_content_before(); ?>
		<?php
			$post_post_title = ot_get_option( 'post_post_title' );
			if( !$post_post_title == 'off' or $post_post_title == 'on' ) {
				eventchamp_archive_title();
			} else {
				eventchamp_archive_title_blank();
			}

			$event_disable_featured_image_gallery = get_post_meta( get_the_ID(), 'event_disable_featured_image_gallery', true );
			$event_featured_image = get_post_meta( get_the_ID(), 'event_featured_image', true );
			$event_location = get_post_meta( get_the_ID(), 'event_location', true );
			$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
			$event_start_time = get_post_meta( get_the_ID(), 'event_start_time', true );
			$event_end_date = get_post_meta( get_the_ID(), 'event_end_date', true );
			$event_end_time = get_post_meta( get_the_ID(), 'event_end_time', true );
			$event_organizer = get_post_meta( get_the_ID(), 'event_organizer', true );
			$event_phone = get_post_meta( get_the_ID(), 'event_phone', true );
			$event_email = get_post_meta( get_the_ID(), 'event_email', true );
			$event_extra_sidebar_button_link = get_post_meta( get_the_ID(), 'event_extra_sidebar_button_link', true );
			$event_extra_sidebar_button_title = get_post_meta( get_the_ID(), 'event_extra_sidebar_button_title', true );
			$event_extra_sidebar_target = get_post_meta( get_the_ID(), 'event_extra_sidebar_target', true );
			$event_detailed_address = get_post_meta( get_the_ID(), 'event_detailed_address', true );
			$official_web_site = get_post_meta( get_the_ID(), 'event_official_web_site', true );
			$social_media_facebook = get_post_meta( get_the_ID(), 'event_social_media_facebook', true );
			$social_media_twitter = get_post_meta( get_the_ID(), 'event_social_media_twitter', true );
			$social_media_googleplus = get_post_meta( get_the_ID(), 'event_social_media_googleplus', true );
			$social_media_instagram = get_post_meta( get_the_ID(), 'event_social_media_instagram', true );
			$social_media_youtube = get_post_meta( get_the_ID(), 'event_social_media_youtube', true );
			$social_media_flickr = get_post_meta( get_the_ID(), 'event_social_media_flickr', true );
			$social_media_soundcloud = get_post_meta( get_the_ID(), 'event_social_media_soundcloud', true );
			$social_media_vimeo = get_post_meta( get_the_ID(), 'event_social_media_vimeo', true );
			$social_media_linkedin = get_post_meta( get_the_ID(), 'event_social_media_linkedin', true );
			$event_remaining_tickets = get_post_meta( get_the_ID(), 'event_remaining_tickets', true );
			$event_tickets = get_post_meta( get_the_ID(), 'event_tickets', true );
			$event_sponsors = get_post_meta( get_the_ID(), 'event_sponsors', true );
			$event_schedule = get_post_meta( get_the_ID(), 'event_schedule', true );
			$event_speakers = get_post_meta( get_the_ID(), 'event_speakers', true );
			$event_venue = get_post_meta( get_the_ID(), 'event_venue', true );
			$event_image_gallery = get_post_meta( get_the_ID(), 'event_image_gallery', true );
			$event_google_street_link = get_post_meta( get_the_ID(), 'event_google_street_link', true );
			$event_faq = get_post_meta( get_the_ID(), 'event_faq', true );
			$event_cats = wp_get_post_terms( get_the_ID(), 'eventcat' );
			$event_tags = wp_get_post_terms( get_the_ID(), 'event_tags' );
			$event_contact_form = ot_get_option( 'event_contact_form' );
			$googlemapapi = ot_get_option( 'googlemapapi' );
			$event_related_events = ot_get_option( 'event_related_events' );
			$event_extra_tab1_content = get_post_meta( get_the_ID(), 'event_extra_tab1_content', true );
			$event_extra_tab1_title = get_post_meta( get_the_ID(), 'event_extra_tab1_title', true );
			$event_extra_tab2_content = get_post_meta( get_the_ID(), 'event_extra_tab2_content', true );
			$event_extra_tab2_title = get_post_meta( get_the_ID(), 'event_extra_tab2_title', true );
			$event_media_tab_images = get_post_meta( get_the_ID(), 'event_media_tab_images', true );



		?>
		<?php eventchamp_container_before(); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php eventchamp_row_before(); ?>
					<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left right fixedSidebar">
						<div class="post-list post-content-list">
							<article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post-wrapper">
									<?php
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
									?>
									<?php
										$content_control = get_the_content();
										if( !empty( $content_control ) ) {
											echo '<div class="post-content-body">';
												the_content();
											echo '</div>';
										}
									?>
									<?php if( !empty( $event_schedule ) or !empty( $event_speakers ) or !empty( $event_tickets ) or !empty( $event_detailed_address ) or !empty( $event_google_street_link ) or !empty( $event_faq ) or !empty( $event_extra_tab1_content ) or !empty( $event_media_tab_images ) or $event_related_events == "on" ) { ?>
										<div class="event-detail-tabs">
											<ul class="nav nav-tabs" role="tablist">
												<?php if( !empty( $event_schedule ) ) { ?>
													<li role="presentation">
														<a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab">
															<i class="fa fa-calendar" aria-hidden="true"></i>
															<?php echo esc_html__( 'Schedule' , 'eventchamp' ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( !empty( $event_speakers ) ) { ?>
													<li role="presentation">
														<a href="#speakers" aria-controls="speakers" role="tab" data-toggle="tab">
															<i class="fa fa-users" aria-hidden="true"></i>
															<?php echo esc_html__( 'Speakers' , 'eventchamp' ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( !empty( $event_tickets ) ) { ?>
													<li role="presentation">
														<a href="#tickets" aria-controls="tickets" role="tab" data-toggle="tab">
															<i class="fa fa-ticket" aria-hidden="true"></i>
															<?php echo esc_html__( 'Ticket & Prices' , 'eventchamp' ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( !empty( $event_detailed_address ) ) { ?>
													<li role="presentation">
														<a href="#map" aria-controls="map" role="tab" data-toggle="tab">
															<i class="fa fa-map" aria-hidden="true"></i>
															<?php echo esc_html__( 'Map' , 'eventchamp' ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( !empty( $event_google_street_link ) ) { ?>
													<li role="presentation">
														<a href="#3dtour" aria-controls="3dtour" role="tab" data-toggle="tab">
															<i class="fa fa-street-view" aria-hidden="true"></i>
															<?php echo esc_html__( '3D Tour' , 'eventchamp' ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( !empty( $event_contact_form ) ) { ?>
													<li role="presentation">
														<a href="#contactform" aria-controls="contactform" role="tab" data-toggle="tab">
															<i class="fa fa-wpforms" aria-hidden="true"></i>
															<?php echo esc_html__( 'Contact Form' , 'eventchamp' ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( !empty( $event_faq ) ) { ?>
													<li role="presentation">
														<a href="#faq" aria-controls="faq" role="tab" data-toggle="tab">
															<i class="fa fa-question-circle" aria-hidden="true"></i>
															<?php echo esc_html__( 'FAQ' , 'eventchamp' ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( !empty( $event_extra_tab1_content ) and !empty( $event_extra_tab1_title ) ) { ?>
													<li role="presentation">
														<a href="#extra-tab1" aria-controls="extra-tab1" role="tab" data-toggle="tab">
															<i class="fa fa-plus-circle" aria-hidden="true"></i>
															<?php echo get_post_meta( get_the_ID(), 'event_extra_tab1_title', true ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( !empty( $event_extra_tab2_content ) and !empty( $event_extra_tab2_title ) ) { ?>
													<li role="presentation">
														<a href="#extra-tab2" aria-controls="extra-tab2" role="tab" data-toggle="tab">
															<i class="fa fa-plus-circle" aria-hidden="true"></i>
															<?php echo get_post_meta( get_the_ID(), 'event_extra_tab2_title', true ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( !empty( $event_media_tab_images ) ) { ?>
													<li role="presentation">
														<a href="#media-images" aria-controls="media-images" role="tab" data-toggle="tab">
															<i class="fa fa-picture-o" aria-hidden="true"></i>
															<?php echo esc_html__( 'Images', 'eventchamp' ); ?>
														</a>
													</li>
												<?php } ?>
												<?php if( $event_related_events == "on" ) { ?>
													<li role="presentation">
														<a href="#related-events" aria-controls="related-events" role="tab" data-toggle="tab">
															<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
															<?php echo esc_html__( 'Related Events', 'eventchamp' ); ?>
														</a>
													</li>
												<?php } ?>
											</ul>
											<div class="tab-content">
												<?php if( !empty( $event_schedule ) ) { ?>
													<div role="tabpanel" class="tab-pane eventchamp-dropdown" id="schedule">
														<?php echo eventchamp_schedule( $post_id = get_the_ID() ); ?>
													</div>
												<?php } ?>
												<?php if( !empty( $event_speakers ) ) { ?>
													<div role="tabpanel" class="tab-pane" id="speakers">
														<?php echo eventchamp_speakers( $post_id = get_the_ID(), $column = "3" ); ?>
													</div>
												<?php } ?>
												<?php if( !empty( $event_tickets ) ) { ?>
													<div role="tabpanel" class="tab-pane" id="tickets">
														<?php echo eventchamp_pricing_table( $post_id = get_the_ID(), $text_column = "1" ); ?>
													</div>
												<?php } ?>
												<?php if( !empty( $event_detailed_address ) ) { ?>
													<div role="tabpanel" class="tab-pane" id="map">
														<?php
															if( !empty( $googlemapapi ) ) {
																$googlemapapi = $googlemapapi;
															} else {
																$googlemapapi = "AIzaSyCJCkvBbxfRoHwUrj9x3uptUEDodTYGMbo";
															}
														?>
														<iframe width="100%" height="450" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=<?php echo esc_attr( $googlemapapi ); ?>&q=<?php echo esc_attr( $event_detailed_address ); ?>"></iframe>
													</div>
												<?php } ?>
												<?php if( !empty( $event_google_street_link ) ) { ?>
													<div role="tabpanel" class="tab-pane" id="3dtour">
														<iframe width="100%" height="450" frameborder="0" src="<?php echo esc_url( $event_google_street_link ); ?>"></iframe>
													</div>
												<?php } ?>
												<?php if( !empty( $event_contact_form ) ) { ?>
													<div role="tabpanel" class="tab-pane" id="contactform">
														<?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( $event_contact_form ) . '"]' ); ?>
													</div>
												<?php } ?>
												<?php if( !empty( $event_faq ) ) { ?>
													<div role="tabpanel" class="tab-pane eventchamp-dropdown" id="faq">
														<?php echo eventchamp_faq( $post_id = get_the_ID() ); ?>
													</div>
												<?php } ?>
												<?php if( !empty( $event_extra_tab1_content ) ) { ?>
													<div role="tabpanel" class="tab-pane eventchamp-dropdown" id="extra-tab1">
														<?php echo wpautop( get_post_meta( get_the_ID(), 'event_extra_tab1_content', true ) ); ?>
													</div>
												<?php } ?>
												<?php if( !empty( $event_extra_tab2_content ) ) { ?>
													<div role="tabpanel" class="tab-pane eventchamp-dropdown" id="extra-tab2">
														<?php echo wpautop( get_post_meta( get_the_ID(), 'event_extra_tab2_content', true ) ); ?>
													</div>
												<?php } ?>
												<?php if( !empty( $event_media_tab_images ) ) { ?>
													<div role="tabpanel" class="tab-pane eventchamp-dropdown" id="media-images">
														<?php
															$event_media_tab_images =  explode( ',', get_post_meta( get_the_ID(), 'event_media_tab_images', true ) );
															if( !empty( $event_media_tab_images ) ) {
																echo '<div class="media-images-tab-list">';
																	echo '<ul>';
																		foreach ($event_media_tab_images as $event_media_tab_image) {
																			$image_big_url = wp_get_attachment_image_url( $event_media_tab_image, 'eventchamp-event-slider', true, true );
																			echo '<li><a href="' . esc_url( $image_big_url ) . '" title="" rel="prettyPhoto[media-images-tab]">' . wp_get_attachment_image( $event_media_tab_image, 'eventchamp-event-sponsor-big', true, true ) . '</a></li>';
																		}
																	echo '</ul>';
																echo '</div>';
														}
														?>
													</div>
												<?php } ?>
												<?php if( $event_related_events == "on" ) { ?>
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
						if( !empty( $event_location ) or !empty( $event_start_date ) or !empty( $event_start_time ) or !empty( $event_end_date ) or !empty( $event_end_time ) or !empty( $event_organizer ) or !empty( $event_cats ) or !empty( $event_phone ) or !empty( $event_email ) or !empty( $event_detailed_address ) or !empty( $official_web_site ) or !empty( $social_media_facebook ) or !empty( $social_media_twitter ) or !empty( $social_media_googleplus ) or !empty( $social_media_instagram ) or !empty( $social_media_youtube ) or !empty( $social_media_flickr ) or !empty( $social_media_soundcloud ) or !empty( $social_media_vimeo ) or !empty( $social_media_linkedin ) or !empty( $event_remaining_tickets ) or !empty( $event_tickets ) or !empty( $event_sponsors ) or !empty( $event_tags ) or !empty( $event_venue ) ) {
					?>
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 event-detail-widgets">
							<?php if( !empty( $event_location ) or !empty( $event_start_date ) or !empty( $event_start_time ) or !empty( $event_end_date ) or !empty( $event_end_time ) or !empty( $event_organizer ) or !empty( $event_cats ) or !empty( $event_phone ) or !empty( $event_email ) or !empty( $event_detailed_address ) or !empty( $official_web_site ) or !empty( $social_media_facebook ) or !empty( $social_media_twitter ) or !empty( $social_media_googleplus ) or !empty( $social_media_instagram ) or !empty( $social_media_youtube ) or !empty( $social_media_flickr ) or !empty( $social_media_soundcloud ) or !empty( $social_media_vimeo ) or !empty( $social_media_linkedin ) or !empty( $event_remaining_tickets ) or !empty( $event_tickets ) or !empty( $event_sponsors ) or !empty( $event_tags ) ) { ?>
								<div class="widget-box event-details-widget">
									<div class="widget-title"><?php echo esc_html__( 'Event' , 'eventchamp' ); ?> <span><?php echo esc_html__( 'Details' , 'eventchamp' ); ?></span></div>
									<ul>
										<?php
										$event_start_date_last = date_format( date_create( $event_start_date ), "Y-m-d" );
										$event_end_date_last = date_format( date_create( $event_end_date ), "Y-m-d" );
										$date_now = date("Y-m-d");

										 if( !empty( $event_start_date ) and $event_start_date_last > $date_now ) {
											?>
											<li class="counter">
												<i class="fa fa-clock-o" aria-hidden="true"></i>
												<div>
													<div class="getting-started">
														<div class="days">
															<div class="count"></div>
															<div class="title"><?php esc_html_e( 'Days', 'eventchamp' ); ?></div>
														</div>
														<div class="hours">
															<div class="count"></div>
															<div class="title"><?php esc_html_e( 'Hours', 'eventchamp' ); ?></div>
														</div>
														<div class="minutes">
															<div class="count"></div>
															<div class="title"><?php esc_html_e( 'Min', 'eventchamp' ); ?></div>
														</div>
														<div class="secondes">
															<div class="count"></div>
															<div class="title"><?php esc_html_e( 'Sec', 'eventchamp' ); ?></div>
														</div>
													</div>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $event_start_date ) or !empty( $event_start_time ) ) { ?>
											<li>
												<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Start Date' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo eventchamp_global_date_converter( $date = $event_start_date ) . ' ' . esc_attr( $event_start_time );
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $event_end_date ) or !empty( $event_end_time ) ) { ?>
											<li>
												<i class="fa fa-calendar-times-o" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'End Date' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo eventchamp_global_date_converter( $date = $event_end_date ) . ' ' . esc_attr( $event_end_time );
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $event_location ) ) {
											$location = get_term( $event_location, 'location' );
											if( !empty( $location ) ) {
											 ?>
												<li>
													<i class="fa fa-map-marker" aria-hidden="true"></i>
													<span><?php echo esc_html__( 'Location' , 'eventchamp' ); ?></span>
													<div>
														<?php
														 	echo '<a href="' . esc_url( get_term_link( $location->term_id ) ) . '" title="' . esc_attr( $location->name ) . '">' . esc_attr( $location->name ) . '</a>';
														 ?>
													</div>
												</li>
											<?php } ?>
										<?php } ?>
										<?php if( !empty( $event_venue ) ) { ?>
											<li>
												<i class="fa fa-map-signs" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Venue' , 'eventchamp' ); ?></span>
												<div><a href="<?php echo get_the_permalink( $event_venue ); ?>" title="<?php echo get_the_title( $event_venue ); ?>"><?php echo get_the_title( $event_venue ); ?></a>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $event_organizer ) ) {
											$organizer = get_term( $event_organizer, 'organizer' );
											if( !empty( $organizer ) ) {
										?>
												<li>
													<i class="fa fa-user-circle-o" aria-hidden="true"></i>
													<span><?php echo esc_html__( 'Organizer' , 'eventchamp' ); ?></span>
													<div>
														<?php
														 		echo esc_attr( $organizer->name );
														 ?>
													</div>
												</li>
											<?php } ?>
										<?php } ?>
										<?php if( !empty( $event_cats ) ) { ?>
											<li>
												<i class="fa fa-folder-open-o" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Category' , 'eventchamp' ); ?></span>
												<div>
													<ul class="list">
														<?php
															foreach( $event_cats as $event_cat ) {
																echo '<li><a href="' . get_term_link( $event_cat->term_id ) . '" title="' . esc_attr( $event_cat->name ) . '">' . esc_attr( $event_cat->name ) . '</a></li>';
															}
														 ?>
													 </ul>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $event_phone ) ) { ?>
											<li>
												<i class="fa fa-phone" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Phone' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo '<a href="tel:' . esc_attr( $event_phone ) . '">' . esc_attr( $event_phone ) . '</a>';
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $event_email ) ) { ?>
											<li>
												<i class="fa fa-envelope-o" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Email' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo '<a href="mailto:' . esc_attr( $event_email ) . '">' . esc_attr( $event_email ) . '</a>';
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $event_detailed_address ) ) { ?>
											<li>
												<i class="fa fa-map-o" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Address' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo esc_attr( $event_detailed_address );
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $official_web_site ) or !empty( $social_media_facebook ) or !empty( $social_media_twitter ) or !empty( $social_media_googleplus ) or !empty( $social_media_instagram ) or !empty( $social_media_youtube ) or !empty( $social_media_flickr ) or !empty( $social_media_soundcloud ) or !empty( $social_media_vimeo ) or !empty( $social_media_linkedin ) ) { ?>
											<li>
												<i class="fa fa-share-alt" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Web Sites' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo '<ul class="official-sites">';
															if( !empty( $official_web_site ) ) {
																echo '<li><a href="' . esc_url( $official_web_site ) . '" class="officialsite" title="' . esc_html__( 'Facebook', 'eventchamp' ) . '" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a></li>';
															}

															if( !empty( $social_media_facebook ) ) {
																echo '<li><a href="' . esc_url( $social_media_facebook ) . '" class="facebook" title="' . esc_html__( 'Facebook', 'eventchamp' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
															}
															
															if( !empty( $social_media_twitter ) ) {
																echo '<li><a href="' . esc_url( $social_media_twitter ) . '" class="twitter" title="' . esc_html__( 'Twitter', 'eventchamp' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
															}

															if( !empty( $social_media_googleplus ) ) {
																echo '<li><a href="' . esc_url( $social_media_googleplus ) . '" class="googleplus" title="' . esc_html__( 'Google+', 'eventchamp' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
															}

															if( !empty( $social_media_instagram ) ) {
																echo '<li><a href="' . esc_url( $social_media_instagram ) . '" class="instagram" title="' . esc_html__( 'Instagram', 'eventchamp' ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>';
															}

															if( !empty( $social_media_youtube ) ) {
																echo '<li><a href="' . esc_url( $social_media_youtube ) . '" class="youtube" title="' . esc_html__( 'YouTube', 'eventchamp' ) . '" target="_blank"><i class="fa fa-youtube"></i></a></li>';
															}

															if( !empty( $social_media_flickr ) ) {
																echo '<li><a href="' . esc_url( $social_media_flickr ) . '" class="flickr" title="' . esc_html__( 'Flickr', 'eventchamp' ) . '" target="_blank"><i class="fa fa-flickr"></i></a></li>';
															}

															if( !empty( $social_media_soundcloud ) ) {
																echo '<li><a href="' . esc_url( $social_media_soundcloud ) . '" class="soundcloud" title="' . esc_html__( 'SoundCloud', 'eventchamp' ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a></li>';
															}

															if( !empty( $social_media_vimeo ) ) {
																echo '<li><a href="' . esc_url( $social_media_vimeo ) . '" class="vimeo" title="' . esc_html__( 'Vimeo', 'eventchamp' ) . '" target="_blank"><i class="fa fa-vimeo"></i></a></li>';
															}

															if( !empty( $social_media_linkedin ) ) {
																echo '<li><a href="' . esc_url( $social_media_linkedin ) . '" class="linkedin" title="' . esc_html__( 'LinkedIn', 'eventchamp' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
															}
														echo "<ul>";
													 ?>
												</div>
											</li>
											<li class="extraGap"></li>
										<?php } ?>
										<?php if( !empty( $event_remaining_tickets ) ) { ?>
											<li class="button-content">
												<a href="#ticket-tab" class="ticketLink" title="<?php echo esc_html__( 'Remaining Ticket' , 'eventchamp' ); ?>">
													<i class="fa fa-ticket" aria-hidden="true"></i>
													<span class="title"><?php echo esc_html__( 'Remaining Ticket' , 'eventchamp' ); ?>:</span>
													<span class="content"><?php $ticket_product_id = wc_get_product( $event_remaining_tickets ); echo $ticket_product_id->get_stock_quantity(); ?> <?php echo esc_html__( 'Ticket' , 'eventchamp' ); ?></span>
												</a>
											</li>
										<?php } ?>
										<?php if( !empty( $event_tickets ) ) { ?>
											<li class="button-content">
												<a href="#ticket-tab" class="ticketLink" title="<?php echo esc_html__( 'Buy Ticket & Show Details' , 'eventchamp' ); ?>">
													<i class="fa fa-credit-card" aria-hidden="true"></i>
													<span class="title"><?php echo esc_html__( 'Buy Ticket & Show Details' , 'eventchamp' ); ?></span>
												</a>
											</li>
										<?php } ?>
										<?php if( !empty( $event_contact_form ) ) { ?>
											<li class="button-content">
												<a href="#ticket-tab" class="contactLink" title="<?php echo esc_html__( 'Send A Message' , 'eventchamp' ); ?>">
													<i class="fa fa-wpforms" aria-hidden="true"></i>
													<span class="title"><?php echo esc_html__( 'Send A Message' , 'eventchamp' ); ?></span>
												</a>
											</li>
										<?php } ?>
										<?php if( !empty( $event_extra_sidebar_button_link ) or !empty( $event_extra_sidebar_button_title ) ) { ?>
											<li class="button-content">
												<a href="<?php echo esc_url( $event_extra_sidebar_button_link ); ?>"" target="<?php echo esc_attr( $event_extra_sidebar_target ); ?>" title="<?php echo esc_attr( $event_extra_sidebar_button_title ); ?>">
													<i class="fa fa-link" aria-hidden="true"></i>
													<span class="title"><?php echo esc_attr( $event_extra_sidebar_button_title ); ?></span>
												</a>
											</li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
							<?php if( !empty( $event_sponsors ) ) { ?>
								<div class="widget-box event-sponsors-widget">
									<div class="widget-title"><?php echo esc_html__( 'Sponsors' , 'eventchamp' ); ?></div>
									<?php
										echo '<ul>';
											foreach ( $event_sponsors as $event_sponsor ) {
												if( !empty( $event_sponsor ) ) {
													echo '<li>';
														if( !empty( $event_sponsor["title"] ) ) {
															$spoonsor_name = $event_sponsor["title"];
														} else {
															$spoonsor_name = esc_html__( 'Sponsor', 'eventchamp' );
														}

														if( !empty( $event_sponsor["event_sponsor_link"] ) ) {
															echo '<a href="' . esc_url( $event_sponsor["event_sponsor_link"] ) . '" target="_blank" title="' . esc_attr( $spoonsor_name ) . '" rel="nofollow">';
																if( !empty( $event_sponsor["event_sponsor_logo"] ) ) {
																	$sponsor_logo_attachment_id = eventchamp_attachment_id( $event_sponsor["event_sponsor_logo"] );
																	echo wp_get_attachment_image( $sponsor_logo_attachment_id, 'eventchamp-event-sponsor', true, true );
																}
															echo '</a>';
														} else {
															if( !empty( $event_sponsor["event_sponsor_logo"] ) ) {
																$sponsor_logo_attachment_id = eventchamp_attachment_id( $event_sponsor["event_sponsor_logo"] );
																echo wp_get_attachment_image( $sponsor_logo_attachment_id, 'eventchamp-event-sponsor', true, true );
															}
														}
													echo '</li>';
												}
											}
										echo '</ul>';
									?>
								</div>
							<?php } ?>
							<?php if( !empty( $event_tags ) ) { ?>
								<div class="widget-box event-tag-widget">
									<div class="widget-title"><?php echo esc_html__( 'Tags' , 'eventchamp' ); ?></div>
									<div>
										<ul class="list">
											<?php
												foreach( $event_tags as $event_tag ) {
													echo '<li><a href="' . get_term_link( $event_tag->term_id ) . '" title="' . esc_attr( $event_tag->name ) . '">' . esc_attr( $event_tag->name ) . '</a></li>';
												}
											 ?>
										 </ul>
									</div>
								</div>
							<?php } ?>
							<?php
								$event_detail_sidebar_select = ot_get_option( 'event_detail_sidebar_select' );
								if ( !empty( $event_detail_sidebar_select) ) {
									if ( is_active_sidebar( $event_detail_sidebar_select ) )  {
										dynamic_sidebar( $event_detail_sidebar_select ); 
									}
								}
							?>
						</div>
					<?php } ?>
				<?php eventchamp_row_after(); ?>
			<?php endwhile; ?>
		<?php eventchamp_container_after(); ?>
	<?php eventchamp_sub_content_after(); ?>

<?php get_footer();