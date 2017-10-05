<?php
/*======
*
* Latest Posts Widget
*
======*/
	function eventchamp_latest_posts_register_widgets() {
		register_widget( 'eventchamp_latest_posts_widget' );
	}
	add_action( 'widgets_init', 'eventchamp_latest_posts_register_widgets' );

	class eventchamp_latest_posts_widget extends WP_Widget {
		function __construct() {
			parent::__construct(
		            'eventchamp_latest_posts_widget',
	        	    esc_html__( 'Eventchamp Theme: Latest Posts Widget', 'eventchamp' ),
	 	           array( 'description' => esc_html__( 'Latest posts widget.', 'eventchamp' ), )
			);
		}
		
		function widget( $args, $instance ) {
			echo $args['before_widget'];

				$latest_posts_widget_title = esc_attr( $instance['latest_posts_widget_title'] );
				if ( !empty( $instance['latest_posts_widget_title'] ) ) {
					echo '<div class="widget-title">'. esc_attr( $latest_posts_widget_title ) .'</div>';
				}

				if( $instance) {
					$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
					$latest_posts_widget_category = strip_tags( esc_attr( $instance['latest_posts_widget_category'] ) );
					$latest_posts_widget_exclude = strip_tags( esc_attr( $instance['latest_posts_widget_exclude'] ) );
					$latest_posts_widget_offset = strip_tags( esc_attr( $instance['latest_posts_widget_offset'] ) );
					$latest_posts_widget_post_count = strip_tags( esc_attr( $instance['latest_posts_widget_post_count'] ) );
				}
				
				/*------------- Exclude Start -------------*/
				if( !empty( $latest_posts_widget_exclude ) ) :
					$latest_posts_widget_exclude = $latest_posts_widget_exclude;
					$latest_posts_widget_exclude = explode( ',', $latest_posts_widget_exclude );
				else:
					$latest_posts_widget_exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				?>
				<?php eventchamp_widget_before(); ?>
					<div class="latest-posts-widget">
						<?php
							$args_latest_posts = array(
								'posts_per_page' => $latest_posts_widget_post_count,
								'post_status' => 'publish',
								'post__not_in' => $latest_posts_widget_exclude,
								'offset' => $latest_posts_widget_offset,
								'ignore_sticky_posts'    => true,
								'post_type' => 'post',
								'cat' => $latest_posts_widget_category
							); 
							$wp_query = new WP_Query($args_latest_posts);
							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								echo eventchamp_post_list_style_3( $post_id = get_the_ID(), $post_information = "true", $post_image = "true", $post_category = "true" );
							}
							wp_reset_postdata();
						?>
					</div>
				<?php eventchamp_widget_after(); ?>

			<?php echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['latest_posts_widget_title'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_title'] ) );
			$instance['latest_posts_widget_category'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_category'] ) );
			$instance['latest_posts_widget_exclude'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_exclude'] ) );
			$instance['latest_posts_widget_offset'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_offset'] ) );
			$instance['latest_posts_widget_post_count'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_post_count'] ) );

			return $instance;
		}

		function form($instance) {

			$latest_posts_widget_title = '';
			$latest_posts_widget_category = '';
			$latest_posts_widget_exclude = '';
			$latest_posts_widget_offset = '';
			$latest_posts_widget_post_count = '';

			if( $instance) {
				$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
				$latest_posts_widget_category = strip_tags( esc_attr( $instance['latest_posts_widget_category'] ) );
				$latest_posts_widget_exclude = strip_tags( esc_attr( $instance['latest_posts_widget_exclude'] ) );
				$latest_posts_widget_offset = strip_tags( esc_attr( $instance['latest_posts_widget_offset'] ) );
				$latest_posts_widget_post_count = strip_tags( esc_attr( $instance['latest_posts_widget_post_count'] ) );
			} ?>
			 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_post_count' ) ); ?>"><?php esc_html_e( 'Post Count:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_post_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_post_count' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_post_count ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_category' ) ); ?>"><?php esc_html_e( 'Category:', 'eventchamp' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name('latest_posts_widget_category') ); ?>" id="<?php echo esc_attr( $this->get_field_id('latest_posts_widget_category') ); ?>" class="widefat"> 
					<option value=""><?php echo esc_html__( 'All Categories', 'eventchamp' ); ?></option>
					<?php
					 $categories =  get_categories('child_of=0'); 
					 foreach ($categories as $category) {
						$category_select_control = '';
						if ( $latest_posts_widget_category == $category->cat_ID )
						{
							$category_select_control = "selected";
						}
						$option = '<option value="' . esc_attr( $category->cat_ID ) . '"' . $category_select_control . '>';
						$option .= $category->cat_name;
						$option .= '</option>';
						echo balanceTags( $option );
					 }
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_exclude' ) ); ?>"><?php esc_html_e( 'Exclude Posts:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_exclude' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_exclude ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_offset' ) ); ?>"><?php esc_html_e( 'Offset:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_offset' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_offset ); ?>" />
			</p>

		<?php }
	}

/*======
*
* Latest Events Widget
*
======*/
	function eventchamp_latest_events_register_widgets() {
		register_widget( 'eventchamp_latest_events_widget' );
	}
	add_action( 'widgets_init', 'eventchamp_latest_events_register_widgets' );

	class eventchamp_latest_events_widget extends WP_Widget {
		function __construct() {
			parent::__construct(
		            'eventchamp_latest_events_widget',
	        	    esc_html__( 'Eventchamp Theme: Latest Events Widget', 'eventchamp' ),
	 	           array( 'description' => esc_html__( 'Latest events widget.', 'eventchamp' ), )
			);
		}
		
		function widget( $args, $instance ) {
			echo $args['before_widget'];

				$latest_events_widget_title = esc_attr( $instance['latest_events_widget_title'] );
				if ( !empty( $instance['latest_events_widget_title'] ) ) {
					echo '<div class="widget-title">'. esc_attr( $latest_events_widget_title ) .'</div>';
				}

				if( $instance) {
					$latest_events_widget_style = strip_tags( esc_attr( $instance['latest_events_widget_style'] ) );
					$latest_events_widget_title = strip_tags( esc_attr( $instance['latest_events_widget_title'] ) );
					$latest_events_widget_category = strip_tags( esc_attr( $instance['latest_events_widget_category'] ) );
					$latest_events_widget_exclude = strip_tags( esc_attr( $instance['latest_events_widget_exclude'] ) );
					$latest_events_widget_ids = strip_tags( esc_attr( $instance['latest_events_widget_ids'] ) );
					$latest_events_widget_offset = strip_tags( esc_attr( $instance['latest_events_widget_offset'] ) );
					$latest_events_widget_event_count = strip_tags( esc_attr( $instance['latest_events_widget_event_count'] ) );
				}
				
				/*------------- Exclude Start -------------*/
				if( !empty( $latest_events_widget_exclude ) ) :
					$latest_events_widget_exclude = $latest_events_widget_exclude;
					$latest_events_widget_exclude = explode( ',', $latest_events_widget_exclude );
				else:
					$latest_events_widget_exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Event ID's Start -------------*/
				if( !empty( $latest_events_widget_ids ) ) :
					$latest_events_widget_ids = $latest_events_widget_ids;
					$latest_events_widget_ids = explode( ',', $latest_events_widget_ids );
				else:
					$latest_events_widget_ids = "";
				endif;
				/*------------- Event ID's End -------------*/
				?>
				<?php eventchamp_widget_before(); ?>
					<div class="latest-events-widget <?php echo esc_attr( $latest_events_widget_style ); ?>">
						<?php
							if( !empty( $latest_events_widget_category ) ) {
								$query_args = array(
									'posts_per_page' => $latest_events_widget_event_count,
									'post_status' => 'publish',
									'post__not_in' => $latest_events_widget_exclude,
									'post__in' => $latest_events_widget_ids,
									'offset' => $latest_events_widget_offset,
									'ignore_sticky_posts' => true,
									'post_type' => 'event',
									'tax_query' => array(
										array(
											'taxonomy' => 'eventcat',
											'field' => 'term_id',
											'terms' => $latest_events_widget_category,
										),
									),
								); 
							} else {
								$query_args = array(
									'posts_per_page' => $latest_events_widget_event_count,
									'post_status' => 'publish',
									'post__not_in' => $latest_events_widget_exclude,
									'post__in' => $latest_events_widget_ids,
									'offset' => $latest_events_widget_offset,
									'ignore_sticky_posts' => true,
									'post_type' => 'event',
								); 
							}
							$wp_query = new WP_Query($query_args);
							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								if( $latest_events_widget_style == "style2" ) {
									echo eventchamp_event_list_style_2( $post_id = get_the_ID(), $image = "true", $date = "true", $location = "false" );
								} else {
									echo eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = "false", $date = "true", $location = "true", $excerpt = "false", $status = "true", $price = "false" );						
								}
							}
							wp_reset_postdata();
						?>
					</div>
				<?php eventchamp_widget_after(); ?>

			<?php echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['latest_events_widget_style'] = strip_tags( esc_attr( $new_instance['latest_events_widget_style'] ) );
			$instance['latest_events_widget_title'] = strip_tags( esc_attr( $new_instance['latest_events_widget_title'] ) );
			$instance['latest_events_widget_category'] = strip_tags( esc_attr( $new_instance['latest_events_widget_category'] ) );
			$instance['latest_events_widget_exclude'] = strip_tags( esc_attr( $new_instance['latest_events_widget_exclude'] ) );
			$instance['latest_events_widget_ids'] = strip_tags( esc_attr( $new_instance['latest_events_widget_ids'] ) );
			$instance['latest_events_widget_offset'] = strip_tags( esc_attr( $new_instance['latest_events_widget_offset'] ) );
			$instance['latest_events_widget_event_count'] = strip_tags( esc_attr( $new_instance['latest_events_widget_event_count'] ) );

			return $instance;
		}

		function form($instance) {

			$latest_events_widget_style = '';
			$latest_events_widget_title = '';
			$latest_events_widget_category = '';
			$latest_events_widget_exclude = '';
			$latest_events_widget_ids = '';
			$latest_events_widget_offset = '';
			$latest_events_widget_event_count = '';

			if( $instance) {
				$latest_events_widget_style = strip_tags( esc_attr( $instance['latest_events_widget_style'] ) );
				$latest_events_widget_title = strip_tags( esc_attr( $instance['latest_events_widget_title'] ) );
				$latest_events_widget_category = strip_tags( esc_attr( $instance['latest_events_widget_category'] ) );
				$latest_events_widget_exclude = strip_tags( esc_attr( $instance['latest_events_widget_exclude'] ) );
				$latest_events_widget_ids = strip_tags( esc_attr( $instance['latest_events_widget_ids'] ) );
				$latest_events_widget_offset = strip_tags( esc_attr( $instance['latest_events_widget_offset'] ) );
				$latest_events_widget_event_count = strip_tags( esc_attr( $instance['latest_events_widget_event_count'] ) );
			} ?>
			 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_events_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_events_widget_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_event_count' ) ); ?>"><?php esc_html_e( 'Event Count:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_event_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_events_widget_event_count' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_events_widget_event_count ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_category' ) ); ?>"><?php esc_html_e( 'Event Category:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_events_widget_category' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_events_widget_category ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_exclude' ) ); ?>"><?php esc_html_e( 'Exclude Events:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_events_widget_exclude' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_events_widget_exclude ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_ids' ) ); ?>"><?php esc_html_e( "Events ID's:", "eventchamp" ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_ids' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_events_widget_ids' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_events_widget_ids ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_offset' ) ); ?>"><?php esc_html_e( 'Offset:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_events_widget_offset' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_events_widget_offset ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_style' ) ); ?>"><?php esc_html_e( 'Widget Style:', 'eventchamp' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name('latest_events_widget_style') ); ?>" id="<?php echo esc_attr( $this->get_field_id('latest_events_widget_style') ); ?>" class="widefat"> 
					<option value="style1" <?php if( $latest_events_widget_style == "style1" ) { echo "selected"; } ?>><?php echo esc_html__( 'Style 1', 'eventchamp' ); ?></option>
					<option value="style2" <?php if( $latest_events_widget_style == "style2" ) { echo "selected"; } ?>><?php echo esc_html__( 'Style 2', 'eventchamp' ); ?></option>
				</select>
			</p>

		<?php }
	}

/*======
*
* Latest Venues Widget
*
======*/
	function eventchamp_latest_venues_register_widgets() {
		register_widget( 'eventchamp_latest_venues_widget' );
	}
	add_action( 'widgets_init', 'eventchamp_latest_venues_register_widgets' );

	class eventchamp_latest_venues_widget extends WP_Widget {
		function __construct() {
			parent::__construct(
		            'eventchamp_latest_venues_widget',
	        	    esc_html__( 'Eventchamp Theme: Latest Venues Widget', 'eventchamp' ),
	 	           array( 'description' => esc_html__( 'Latest venues widget.', 'eventchamp' ), )
			);
		}
		
		function widget( $args, $instance ) {
			echo $args['before_widget'];

				$latest_venues_widget_title = esc_attr( $instance['latest_venues_widget_title'] );
				if ( !empty( $instance['latest_venues_widget_title'] ) ) {
					echo '<div class="widget-title">'. esc_attr( $latest_venues_widget_title ) .'</div>';
				}

				if( $instance) {
					$latest_venues_widget_style = strip_tags( esc_attr( $instance['latest_venues_widget_style'] ) );
					$latest_venues_widget_title = strip_tags( esc_attr( $instance['latest_venues_widget_title'] ) );
					$latest_venues_widget_exclude = strip_tags( esc_attr( $instance['latest_venues_widget_exclude'] ) );
					$latest_venues_widget_ids = strip_tags( esc_attr( $instance['latest_venues_widget_ids'] ) );
					$latest_venues_widget_offset = strip_tags( esc_attr( $instance['latest_venues_widget_offset'] ) );
					$latest_venues_widget_venue_count = strip_tags( esc_attr( $instance['latest_venues_widget_venue_count'] ) );
				}
				
				/*------------- Exclude Start -------------*/
				if( !empty( $latest_venues_widget_exclude ) ) :
					$latest_venues_widget_exclude = $latest_venues_widget_exclude;
					$latest_venues_widget_exclude = explode( ',', $latest_venues_widget_exclude );
				else:
					$latest_venues_widget_exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Venue ID's Start -------------*/
				if( !empty( $latest_venues_widget_ids ) ) :
					$latest_venues_widget_ids = $latest_venues_widget_ids;
					$latest_venues_widget_ids = explode( ',', $latest_venues_widget_ids );
				else:
					$latest_venues_widget_ids = "";
				endif;
				/*------------- Venue ID's End -------------*/
				?>
				<?php eventchamp_widget_before(); ?>
					<div class="latest-venues-widget <?php echo esc_attr( $latest_venues_widget_style ); ?>">
						<?php
							$query_args = array(
								'posts_per_page' => $latest_venues_widget_venue_count,
								'post_status' => 'publish',
								'post__not_in' => $latest_venues_widget_exclude,
								'post__in' => $latest_venues_widget_ids,
								'offset' => $latest_venues_widget_offset,
								'ignore_sticky_posts' => true,
								'post_type' => 'venue',
							);
							$wp_query = new WP_Query($query_args);
							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								if( $latest_venues_widget_style == "style2" ) {
									echo eventchamp_venue_list_style_2( $post_id = get_the_ID(), $image = "true", $location = "true" );
								} else {
									echo eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = "true", $excerpt = "false" );						
								}
							}
							wp_reset_postdata();
						?>
					</div>
				<?php eventchamp_widget_after(); ?>

			<?php echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['latest_venues_widget_style'] = strip_tags( esc_attr( $new_instance['latest_venues_widget_style'] ) );
			$instance['latest_venues_widget_title'] = strip_tags( esc_attr( $new_instance['latest_venues_widget_title'] ) );
			$instance['latest_venues_widget_exclude'] = strip_tags( esc_attr( $new_instance['latest_venues_widget_exclude'] ) );
			$instance['latest_venues_widget_ids'] = strip_tags( esc_attr( $new_instance['latest_venues_widget_ids'] ) );
			$instance['latest_venues_widget_offset'] = strip_tags( esc_attr( $new_instance['latest_venues_widget_offset'] ) );
			$instance['latest_venues_widget_venue_count'] = strip_tags( esc_attr( $new_instance['latest_venues_widget_venue_count'] ) );

			return $instance;
		}

		function form($instance) {

			$latest_venues_widget_style = '';
			$latest_venues_widget_title = '';
			$latest_venues_widget_exclude = '';
			$latest_venues_widget_ids = '';
			$latest_venues_widget_offset = '';
			$latest_venues_widget_venue_count = '';

			if( $instance) {
				$latest_venues_widget_style = strip_tags( esc_attr( $instance['latest_venues_widget_style'] ) );
				$latest_venues_widget_title = strip_tags( esc_attr( $instance['latest_venues_widget_title'] ) );
				$latest_venues_widget_exclude = strip_tags( esc_attr( $instance['latest_venues_widget_exclude'] ) );
				$latest_venues_widget_ids = strip_tags( esc_attr( $instance['latest_venues_widget_ids'] ) );
				$latest_venues_widget_offset = strip_tags( esc_attr( $instance['latest_venues_widget_offset'] ) );
				$latest_venues_widget_venue_count = strip_tags( esc_attr( $instance['latest_venues_widget_venue_count'] ) );
			} ?>
			 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_venues_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_venues_widget_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_venue_count' ) ); ?>"><?php esc_html_e( 'Venue Count:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_venue_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_venues_widget_venue_count' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_venues_widget_venue_count ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_exclude' ) ); ?>"><?php esc_html_e( 'Exclude Venues:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_venues_widget_exclude' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_venues_widget_exclude ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_ids' ) ); ?>"><?php esc_html_e( "Venues ID's:", "eventchamp" ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_ids' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_venues_widget_ids' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_venues_widget_ids ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_offset' ) ); ?>"><?php esc_html_e( 'Offset:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_venues_widget_offset' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_venues_widget_offset ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_venues_widget_style' ) ); ?>"><?php esc_html_e( 'Widget Style:', 'eventchamp' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name('latest_venues_widget_style') ); ?>" id="<?php echo esc_attr( $this->get_field_id('latest_venues_widget_style') ); ?>" class="widefat"> 
					<option value="style1" <?php if( $latest_venues_widget_style == "style1" ) { echo "selected"; } ?>><?php echo esc_html__( 'Style 1', 'eventchamp' ); ?></option>
					<option value="style2" <?php if( $latest_venues_widget_style == "style2" ) { echo "selected"; } ?>><?php echo esc_html__( 'Style 2', 'eventchamp' ); ?></option>
				</select>
			</p>

		<?php }
	}

/*======
*
* Latest Speakers Widget
*
======*/
	function eventchamp_latest_speakers_register_widgets() {
		register_widget( 'eventchamp_latest_speakers_widget' );
	}
	add_action( 'widgets_init', 'eventchamp_latest_speakers_register_widgets' );

	class eventchamp_latest_speakers_widget extends WP_Widget {
		function __construct() {
			parent::__construct(
		            'eventchamp_latest_speakers_widget',
	        	    esc_html__( 'Eventchamp Theme: Latest Speakers Widget', 'eventchamp' ),
	 	           array( 'description' => esc_html__( 'Latest speakers widget.', 'eventchamp' ), )
			);
		}
		
		function widget( $args, $instance ) {
			echo $args['before_widget'];

				$latest_speakers_widget_title = esc_attr( $instance['latest_speakers_widget_title'] );
				if ( !empty( $instance['latest_speakers_widget_title'] ) ) {
					echo '<div class="widget-title">'. esc_attr( $latest_speakers_widget_title ) .'</div>';
				}

				if( $instance) {
					$latest_speakers_widget_title = strip_tags( esc_attr( $instance['latest_speakers_widget_title'] ) );
					$latest_speakers_widget_exclude = strip_tags( esc_attr( $instance['latest_speakers_widget_exclude'] ) );
					$latest_speakers_widget_ids = strip_tags( esc_attr( $instance['latest_speakers_widget_ids'] ) );
					$latest_speakers_widget_offset = strip_tags( esc_attr( $instance['latest_speakers_widget_offset'] ) );
					$latest_speakers_widget_speaker_count = strip_tags( esc_attr( $instance['latest_speakers_widget_speaker_count'] ) );
				}
				
				/*------------- Exclude Start -------------*/
				if( !empty( $latest_speakers_widget_exclude ) ) :
					$latest_speakers_widget_exclude = $latest_speakers_widget_exclude;
					$latest_speakers_widget_exclude = explode( ',', $latest_speakers_widget_exclude );
				else:
					$latest_speakers_widget_exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Speaker ID's Start -------------*/
				if( !empty( $latest_speakers_widget_ids ) ) :
					$latest_speakers_widget_ids = $latest_speakers_widget_ids;
					$latest_speakers_widget_ids = explode( ',', $latest_speakers_widget_ids );
				else:
					$latest_speakers_widget_ids = "";
				endif;
				/*------------- Speaker ID's End -------------*/
				?>
				<?php eventchamp_widget_before(); ?>
					<div class="latest-speakers-widget style1">
						<?php
							$query_args = array(
								'posts_per_page' => $latest_speakers_widget_speaker_count,
								'post_status' => 'publish',
								'post__not_in' => $latest_speakers_widget_exclude,
								'post__in' => $latest_speakers_widget_ids,
								'offset' => $latest_speakers_widget_offset,
								'ignore_sticky_posts' => true,
								'post_type' => 'speaker',
							);
							$wp_query = new WP_Query($query_args);
							while ( $wp_query->have_posts() ) {
								$wp_query->the_post();
								echo eventchamp_speaker_list_style_1( $post_id = get_the_ID(), $image = "true", $profession = "true" );
							}
							wp_reset_postdata();
						?>
					</div>
				<?php eventchamp_widget_after(); ?>

			<?php echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['latest_speakers_widget_title'] = strip_tags( esc_attr( $new_instance['latest_speakers_widget_title'] ) );
			$instance['latest_speakers_widget_exclude'] = strip_tags( esc_attr( $new_instance['latest_speakers_widget_exclude'] ) );
			$instance['latest_speakers_widget_ids'] = strip_tags( esc_attr( $new_instance['latest_speakers_widget_ids'] ) );
			$instance['latest_speakers_widget_offset'] = strip_tags( esc_attr( $new_instance['latest_speakers_widget_offset'] ) );
			$instance['latest_speakers_widget_speaker_count'] = strip_tags( esc_attr( $new_instance['latest_speakers_widget_speaker_count'] ) );

			return $instance;
		}

		function form($instance) {

			$latest_speakers_widget_title = '';
			$latest_speakers_widget_exclude = '';
			$latest_speakers_widget_ids = '';
			$latest_speakers_widget_offset = '';
			$latest_speakers_widget_speaker_count = '';

			if( $instance) {
				$latest_speakers_widget_title = strip_tags( esc_attr( $instance['latest_speakers_widget_title'] ) );
				$latest_speakers_widget_exclude = strip_tags( esc_attr( $instance['latest_speakers_widget_exclude'] ) );
				$latest_speakers_widget_ids = strip_tags( esc_attr( $instance['latest_speakers_widget_ids'] ) );
				$latest_speakers_widget_offset = strip_tags( esc_attr( $instance['latest_speakers_widget_offset'] ) );
				$latest_speakers_widget_speaker_count = strip_tags( esc_attr( $instance['latest_speakers_widget_speaker_count'] ) );
			} ?>
			 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_speakers_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_speakers_widget_title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_speaker_count' ) ); ?>"><?php esc_html_e( 'Speaker Count:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_speaker_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_speakers_widget_speaker_count' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_speakers_widget_speaker_count ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_exclude' ) ); ?>"><?php esc_html_e( 'Exclude Speakers:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_speakers_widget_exclude' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_speakers_widget_exclude ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_ids' ) ); ?>"><?php esc_html_e( "Speakers ID's:", "eventchamp" ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_ids' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_speakers_widget_ids' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_speakers_widget_ids ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_offset' ) ); ?>"><?php esc_html_e( 'Offset:', 'eventchamp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_speakers_widget_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_speakers_widget_offset' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_speakers_widget_offset ); ?>" />
			</p>

		<?php }
	}