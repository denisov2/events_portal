<?php
/**
	* The template for displaying single speaker
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

			$speaker_disable_featured_image_gallery = get_post_meta( get_the_ID(), 'speaker_disable_featured_image_gallery', true );
			$speaker_featured_image = get_post_meta( get_the_ID(), 'speaker_featured_image', true );
			$speaker_profession = get_post_meta( get_the_ID(), 'speaker_profession', true );
			$speaker_company = get_post_meta( get_the_ID(), 'speaker_company', true );
			$speaker_location = get_post_meta( get_the_ID(), 'speaker_location', true );
			$speaker_phone = get_post_meta( get_the_ID(), 'speaker_phone', true );
			$speaker_email = get_post_meta( get_the_ID(), 'speaker_email', true );
			$speaker_detailed_address = get_post_meta( get_the_ID(), 'speaker_address', true );
			$official_web_site = get_post_meta( get_the_ID(), 'speaker_official_web_site', true );
			$social_media_facebook = get_post_meta( get_the_ID(), 'speaker_social_media_facebook', true );
			$social_media_twitter = get_post_meta( get_the_ID(), 'speaker_social_media_twitter', true );
			$social_media_googleplus = get_post_meta( get_the_ID(), 'speaker_social_media_googleplus', true );
			$social_media_instagram = get_post_meta( get_the_ID(), 'speaker_social_media_instagram', true );
			$social_media_youtube = get_post_meta( get_the_ID(), 'speaker_social_media_youtube', true );
			$social_media_flickr = get_post_meta( get_the_ID(), 'speaker_social_media_flickr', true );
			$social_media_soundcloud = get_post_meta( get_the_ID(), 'speaker_social_media_soundcloud', true );
			$social_media_vimeo = get_post_meta( get_the_ID(), 'speaker_social_media_vimeo', true );
			$social_media_linkedin = get_post_meta( get_the_ID(), 'speaker_social_media_linkedin', true );
			$social_media_github = get_post_meta( get_the_ID(), 'speaker_social_media_github', true );
			$speaker_image_gallery = get_post_meta( get_the_ID(), 'speaker_image_gallery', true );
		?>
		<?php eventchamp_container_before(); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php eventchamp_row_before(); ?>
					<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left right fixedSidebar">
						<div class="post-list post-content-list">
							<article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post-wrapper">
									<?php
										if( !empty( $speaker_image_gallery ) and $speaker_disable_featured_image_gallery == "off" or !$speaker_disable_featured_image_gallery == "on" ) {
											$post_gallery_images =  explode( ',', get_post_meta( get_the_ID(), 'speaker_image_gallery', true ) );
											if( !empty( $post_gallery_images ) ) {
												echo '<div class="post-featured-header">';
													echo '<div class="swiper-container gloria-sliders post-featured-header-image-gallery" data-item="1" data-column-space="0">';
														echo '<div class="swiper-wrapper">';
															foreach ($post_gallery_images as $image) {
																echo '<div class="swiper-slide">' . wp_get_attachment_image( $image, 'eventchamp-big-post', true, true ) . '</div>';
															}
														echo '</div>';
													echo '</div>';
													echo '<div class="swiper-button-next next"></div>';
													echo '<div class="swiper-button-prev prev"></div>';
												echo '</div>';
											}
										} elseif( !empty( $speaker_featured_image ) and $speaker_disable_featured_image_gallery == "on" ) {
											echo '<div class="post-featured-header">';
												$img_id = eventchamp_attachment_id( $speaker_featured_image );
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
								</div>
							</article>
						</div>
					</div>
					<?php
						if( !empty( $speaker_location ) or !empty( $speaker_company ) or !empty( $speaker_profession ) or !empty( $speaker_phone ) or !empty( $speaker_email ) or !empty( $speaker_detailed_address ) or !empty( $official_web_site ) or !empty( $social_media_facebook ) or !empty( $social_media_twitter ) or !empty( $social_media_googleplus ) or !empty( $social_media_instagram ) or !empty( $social_media_youtube ) or !empty( $social_media_flickr ) or !empty( $social_media_soundcloud ) or !empty( $social_media_vimeo ) or !empty( $social_media_linkedin ) or !empty( $social_media_github ) ) {
					?>
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 event-detail-widgets">
							<?php if( !empty( $speaker_location ) or !empty( $speaker_company ) or !empty( $speaker_profession ) or !empty( $speaker_phone ) or !empty( $speaker_email ) or !empty( $speaker_detailed_address ) or !empty( $official_web_site ) or !empty( $social_media_facebook ) or !empty( $social_media_twitter ) or !empty( $social_media_googleplus ) or !empty( $social_media_instagram ) or !empty( $social_media_youtube ) or !empty( $social_media_flickr ) or !empty( $social_media_soundcloud ) or !empty( $social_media_vimeo ) or !empty( $social_media_linkedin ) or !empty( $social_media_github ) ) { ?>
								<div class="widget-box event-details-widget">
									<div class="widget-title"><?php echo esc_html__( 'About the' , 'eventchamp' ); ?> <span><?php echo esc_html__( 'Speaker' , 'eventchamp' ); ?></span></div>
									<ul>
										<?php if( !empty( $speaker_profession ) ) { ?>
											<li>
												<i class="fa fa-briefcase" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Profession' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo esc_attr( $speaker_profession );
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $speaker_company ) ) { ?>
											<li>
												<i class="fa fa-building-o" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Company' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo esc_attr( $speaker_company );
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $speaker_location ) ) { 
											$location = get_term( $speaker_location, 'location' );
											if( !empty( $location ) ) { 
										?>
												<li>
													<i class="fa fa-map-marker" aria-hidden="true"></i>
													<span><?php echo esc_html__( 'Location' , 'eventchamp' ); ?></span>
													<div>
														<?php
														 	echo esc_attr( $location->name );
														 ?>
													</div>
												</li>
											<?php } ?>
										<?php } ?>
										<?php if( !empty( $speaker_phone ) ) { ?>
											<li>
												<i class="fa fa-phone" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Phone' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo '<a href="tel:' . esc_attr( $speaker_phone ) . '">' . esc_attr( $speaker_phone ) . '</a>';
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $speaker_email ) ) { ?>
											<li>
												<i class="fa fa-envelope-o" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Email' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo '<a href="mailto:' . esc_attr( $speaker_email ) . '">' . esc_attr( $speaker_email ) . '</a>';
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $speaker_detailed_address ) ) { ?>
											<li>
												<i class="fa fa-map-o" aria-hidden="true"></i>
												<span><?php echo esc_html__( 'Address' , 'eventchamp' ); ?></span>
												<div>
													<?php
														echo esc_attr( $speaker_detailed_address );
													 ?>
												</div>
											</li>
										<?php } ?>
										<?php if( !empty( $official_web_site ) or !empty( $social_media_facebook ) or !empty( $social_media_twitter ) or !empty( $social_media_googleplus ) or !empty( $social_media_instagram ) or !empty( $social_media_youtube ) or !empty( $social_media_flickr ) or !empty( $social_media_soundcloud ) or !empty( $social_media_vimeo ) or !empty( $social_media_linkedin ) or !empty( $social_media_github ) ) { ?>
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

															if( !empty( $social_media_github ) ) {
																echo '<li><a href="' . esc_url( $social_media_github ) . '" class="github" title="' . esc_html__( 'GitHub', 'eventchamp' ) . '" target="_blank"><i class="fa fa-github"></i></a></li>';
															}
														echo "<ul>";
													 ?>
												</div>
											</li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
							<?php
								$speaker_detail_sidebar_select = ot_get_option( 'speaker_detail_sidebar_select' );
								if ( !empty( $speaker_detail_sidebar_select) ) {
									if ( is_active_sidebar( $speaker_detail_sidebar_select ) )  {
										dynamic_sidebar( $speaker_detail_sidebar_select ); 
									}
								}
							?>
						</div>
					<?php } ?>
				<?php eventchamp_row_after(); ?>
				<?php
					$content_control = get_the_content();
					if( !empty( $content_control ) ) {
						echo '<div class="post-content-body">';
							the_content();
						echo '</div>';
					}
				?>
			<?php endwhile; ?>
		<?php eventchamp_container_after(); ?>
	<?php eventchamp_sub_content_after(); ?>

<?php get_footer();