<?php
	/*======
	*
	* Theme After Setup Start
	*
	======*/
	function eventchamp_setup(){
		load_theme_textdomain( 'eventchamp', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'quote', 'gallery', 'image', 'video', 'audio', 'chat', 'link' ) );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		if( function_exists( 'add_image_size' ) ) { 
			add_image_size( 'eventchamp-big-post', 870, 450, true );
			add_image_size( 'eventchamp-small-post', 420, 290, true );
			add_image_size( 'eventchamp-event-sponsor', 130, 80, true );
			add_image_size( 'eventchamp-event-sponsor-big', 170, 150, true );
			add_image_size( 'eventchamp-speaker', 614, 637, true );
			add_image_size( 'eventchamp-speaker-schedule', 40, 40, true );
			add_image_size( 'eventchamp-avatar', 85, 85, true );
			add_image_size( 'eventchamp-event-slider', 1920, 950, true );
			add_image_size( 'eventchamp-event-list', 952, 579, true );
			add_image_size( 'eventchamp-big-event', 870, 560, true );
			add_image_size( 'eventchamp-page-banner', 1920, 235, true );
			add_image_size( 'eventchamp-medium-middle', 350, 350, true );
		}
		
		if( ! isset( $content_width ) ) {
			$content_width = 600;
		}
		
		if( is_singular() ) wp_enqueue_script( 'comment-reply' );
	}
	add_action( 'after_setup_theme', 'eventchamp_setup' );

	/*======
	*
	* Theme Scripts & Styles
	*
	======*/
	function eventchamp_scripts()
	{
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/include/assets/js/bootstrap.min.js', array(), false, true );
		wp_enqueue_script( 'prettyphoto', true, array(), false, true );
		wp_enqueue_script( 'jquery-ui-datepicker', true, array(), false, true );
		$eventchamp_fixed_sidebar = ot_get_option( 'eventchamp_fixed_sidebar' );
		if( $eventchamp_fixed_sidebar == 'on' or !$eventchamp_fixed_sidebar == 'off' ) {
			wp_enqueue_script( 'eventchamp-fixed-sidebar', get_template_directory_uri() . '/include/assets/js/fixed-sidebar.js', array(), false, true  );
		}
		$header_fixed = ot_get_option( 'header_fixed' );
		if( $header_fixed == 'on' ) {
			wp_enqueue_script( 'eventchamp-fixed-header', get_template_directory_uri() . '/include/assets/js/fixed-header.js', array(), false, true  );
		}
		wp_enqueue_script( 'eventchamp', get_template_directory_uri() . '/include/assets/js/eventchamp.js', array(), false, true  );
		wp_enqueue_script('ajax-app');
		wp_enqueue_script( 'ajax-login-register-script', get_template_directory_uri() . '/include/assets/js/user-box.js', array(), false, true );
		wp_localize_script('ajax-login-register-script', 'ptajax', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		));

		if( is_single() ) {
			$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
			if( !empty( $event_start_date ) )
			wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
				$('.getting-started').countdown('" . date( 'Y/m/d', strtotime( $event_start_date ) ) . "', function(event) {
					$('.days .count').html(event.strftime('%D'));
					$('.hours .count').html(event.strftime('%H'));
					$('.minutes .count').html(event.strftime('%M'));
					$('.secondes .count').html(event.strftime('%S'));
				});
			});" );
			$event_default_open_tab = get_post_meta( get_the_ID(), 'event_default_open_tab', true );
			if( !empty( $event_default_open_tab ) )
			wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
				$('.event-detail-tabs .tab-content .tab-pane:first-child').removeClass('active');
				$('.event-detail-tabs .nav-tabs li:first-child').removeClass('active');

				$('.event-detail-tabs .tab-content .tab-pane:nth-child(" . esc_attr( $event_default_open_tab ) . ")').addClass('active');
				$('.event-detail-tabs .nav-tabs li:nth-child(" . esc_attr( $event_default_open_tab ) . ")').addClass('active');
			});" );
		}


		wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
			$('.categorized-events .nav-tabs').flexMenu({linkText:'" . esc_html__( "More", "eventchamp" ) . "',linkTitle:'" . esc_html__( "View More", "eventchamp" ) . "',linkTextAll:'" . esc_html__( "Menu", "eventchamp" ) . "',linkTitleAll:'" . esc_html__( "Open/Close Menu", "eventchamp" ) . "'});
			$('.event-detail-tabs .nav-tabs').flexMenu({linkText:'" . esc_html__( "More", "eventchamp" ) . "',linkTitle:'" . esc_html__( "View More", "eventchamp" ) . "',linkTextAll:'" . esc_html__( "Menu", "eventchamp" ) . "',linkTitleAll:'" . esc_html__( "Open/Close Menu", "eventchamp" ) . "'});
		});" );

		$custom_js = ot_get_option( 'custom_js' );
		if( !empty( $custom_js ) ) {
			wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
				" . ot_get_option( 'custom_js' ) . "
			});" );			
		}

		wp_enqueue_style( 'prettyphoto', true  );
		wp_enqueue_style( 'jquery-ui-datepicker', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/include/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/include/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'scrollbar', get_template_directory_uri() . '/include/assets/css/scrollbar.css' );
		wp_enqueue_style( 'select', get_template_directory_uri() . '/include/assets/css/select.css' );
		wp_enqueue_style( 'swiper', get_template_directory_uri() . '/include/assets/css/swiper.min.css' );
		wp_enqueue_style( 'plyr-io', get_template_directory_uri() . '/include/assets/css/plyr.css' );
		wp_enqueue_style( 'eventchamp', get_stylesheet_uri() );
	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_scripts' );

	/*======
	*
	* Admin Scripts & Styles
	*
	======*/
	function eventchamp_admin_scripts() {
		wp_enqueue_style( 'ot-admin-css', get_template_directory_uri() . '/include/admin/assets/css/ot-admin.css', false, '1.0' );
		wp_enqueue_style( 'eventchamp-admin', get_template_directory_uri() . '/include/assets/css/admin.css', false, '1.0' );
		wp_enqueue_script( 'eventchamp-admin', get_template_directory_uri() . '/include/assets/js/admin.js', false, '1.0' );
	}
	add_action( 'admin_enqueue_scripts', 'eventchamp_admin_scripts' );

	/*======
	*
	* Body Classes
	*
	======*/
	function eventchamp_class_names( $classes ) {
		$classes[] = 'eventchamp-theme';
		$woocommerce_shop_product_column = esc_attr( ot_get_option( 'woocommerce_shop_product_column' ) );
		if( !empty( $woocommerce_shop_product_column ) ) {
			$classes[] = ' eventchamp-shop-column-' . $woocommerce_shop_product_column;
		}
		return $classes;
	}
	add_filter( 'body_class', 'eventchamp_class_names' );

	/*======
	*
	* Excerpt More
	*
	======*/
	function eventchamp_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'eventchamp_excerpt_more' );

	/*======
	*
	* Excerpt for Pages
	*
	======*/
	function eventchamp_excerpts_for_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}
	add_action( 'init', 'eventchamp_excerpts_for_pages' );

	/*======
	*
	* Word Cutter
	*
	======*/
	function eventchamp_word_cutter( $string, $word_limit ) {
		$words = explode( ' ', $string, ( $word_limit + 1 ) );
		if( count( $words ) > $word_limit ) {
			array_pop( $words );
		}
		return implode( ' ', $words );
	}

	/*======
	*
	* Author Box
	*
	======*/
	function eventchamp_author_box() {
		$author = get_the_author();
		$author_description = get_the_author_meta( 'description' );
		$author_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
		$author_avatar = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 120 ) );
		if ( $author_description ) { ?>
			<div class="post-author">
				<?php eventchamp_content_title( $text = esc_html__ ( "About The Author", "eventchamp" ) ); ?>
				<aside class="about-author">
					<?php if ( $author_avatar ) : ?>
						<div class="about-image">
							<a href="<?php echo esc_url( $author_url ); ?>" rel="author">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 170 ) ); ?>
							</a>
						</div>
					<?php endif; ?>
					<div class="about-content">
						<div class="author-name">
							<a href="<?php echo esc_url( $author_url ); ?>" rel="author">
								<?php printf( esc_html__( '%s', 'eventchamp' ), $author ); ?>
							</a>
						</div>
						<?php eventchamp_user_social_media_sites(); ?>
						<p><?php echo esc_attr( $author_description ); ?></p>
					</div>
				</aside>
			</div>
		<?php }
	}

	/*======
	*
	* Loader
	*
	======*/
	function eventchamp_loader() {
		$eventchamp_loader = ot_get_option( 'eventchamp_loader' );
		$loader_style = ot_get_option( 'loader_style' );
		if( !$eventchamp_loader == 'off' or $eventchamp_loader == 'on' ) {
			if( $loader_style == 'style2' ) {
				echo '<div class="loader-wrapper loader-style2">
						<div class="spinner">
							<div class="bounce1"></div>
							<div class="bounce2"></div>
							<div class="bounce3"></div>
						</div>
					  </div>';
			} elseif( $loader_style == 'style3' ) {
				echo '<div class="loader-wrapper loader-style3">
						<div class="spinner"></div>
					  </div>';
			} elseif( $loader_style == 'style4' ) {
				echo '<div class="loader-wrapper loader-style4">
						<div class="sk-fading-circle">
							<div class="sk-circle1 sk-circle"></div>
							<div class="sk-circle2 sk-circle"></div>
							<div class="sk-circle3 sk-circle"></div>
							<div class="sk-circle4 sk-circle"></div>
							<div class="sk-circle5 sk-circle"></div>
							<div class="sk-circle6 sk-circle"></div>
							<div class="sk-circle7 sk-circle"></div>
							<div class="sk-circle8 sk-circle"></div>
							<div class="sk-circle9 sk-circle"></div>
							<div class="sk-circle10 sk-circle"></div>
							<div class="sk-circle11 sk-circle"></div>
							<div class="sk-circle12 sk-circle"></div>
						</div>
					  </div>';
			} else {
				echo '<div class="loader-wrapper loader-style1">
						<div class="spinner">
						  <div class="double-bounce1"></div>
						  <div class="double-bounce2"></div>
						</div>
					  </div>';
			}
		}
	}

	/*======
	*
	* Global Date Converter
	*
	======*/
	function eventchamp_global_date_converter( $date = "" ) {
		$date = date_i18n( get_option( 'date_format' ), strtotime( $date ) );
		return $date;
	}

	/*======
	*
	* Header
	*
	======*/
	function eventchamp_header() {
		$hide_header = ot_get_option( 'hide_header' );
		$default_header_style = ot_get_option( 'default_header_style' );
		
		if( !$hide_header == 'off' or $hide_header == 'on' ) {
			if ( is_page() or is_single() ) {
				global $post;
				$header_style = get_post_meta( $post->ID, 'header_layout_select', true);
				$header_status = get_post_meta( $post->ID, 'header_status', true);
				$page_menu_location = get_post_meta( $post->ID, 'page_menu_location', true);
				$header_gap = get_post_meta( $post->ID, 'header_gap', true);
			}
			else {
				$header_style = "";
				$header_status = "";
				$page_menu_location = "";
				$header_gap = "";
			}
		
			if ( $page_menu_location == "default" ) {
				$menu_location = 'mainmenu';
			} elseif ( $page_menu_location == "onepage" ) {
				$menu_location = "onepagemenu";		
			} else {
				$menu_location = "mainmenu";		
			}

			if( !$header_gap == 'off' or $header_gap == "on" ) {
				$header_gap_status = "remove-gap";
			} else {
				$header_gap_status = "remove-gap-removed";			
			}
			
			function eventchamp_headerstyle1() {
				if ( is_page() or is_single() ) {
					global $post;
					$page_menu_location = get_post_meta( $post->ID, 'page_menu_location', true);
					$header_gap = get_post_meta( $post->ID, 'header_gap', true);
				}
				else {
					$page_menu_location = "";
					$header_gap = "";
				}

				if( !$header_gap == 'off' or $header_gap == "on" ) {
					$header_gap_status = "remove-gap";
				} else {
					$header_gap_status = "remove-gap-removed";			
				}
			
				if ( $page_menu_location == "default" ) {
					$menu_location = 'mainmenu';
				} elseif ( $page_menu_location == "onepage" ) {
					$menu_location = "onepagemenu";		
				} else {
					$menu_location = "mainmenu";		
				}
			?>
				<div class="header header-style-1<?php echo ' ' . esc_attr( $header_gap_status ); ?>">
					<div class="container">
						<div class="header-main-area">
							<?php eventchamp_site_logo(); ?>
							<div class="header-menu">
								<div class="header-top-bar">
									<?php eventchamp_header_elements(); ?>
								</div>
								<nav class="navbar">
									<?php
										wp_nav_menu(
											array(
												'menu' => 'mainmenu',
												'theme_location' => $menu_location,
												'depth' => 5,
												'container' => 'div',
												'container_class' => 'collapse navbar-collapse',
												'menu_class' => 'nav navbar-nav',
												'fallback_cb' => 'eventchamp_walker::fallback',
												'walker' => new eventchamp_walker()
											)
										);
									?>
								</nav>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			
			function eventchamp_headerstyle2() {
				if ( is_page() or is_single() ) {
					global $post;
					$page_menu_location = get_post_meta( $post->ID, 'page_menu_location', true);
					$header_gap = get_post_meta( $post->ID, 'header_gap', true);
				}
				else {
					$page_menu_location = "";
					$header_gap = "";
				}

				if( !$header_gap == 'off' or $header_gap == "on" ) {
					$header_gap_status = "remove-gap";
				} else {
					$header_gap_status = "remove-gap-removed";			
				}
			
				if ( $page_menu_location == "default" ) {
					$menu_location = 'mainmenu';
				} elseif ( $page_menu_location == "onepage" ) {
					$menu_location = "onepagemenu";		
				} else {
					$menu_location = "mainmenu";		
				}
			?>
				<div class="header header-style-1 header-style-2<?php echo ' ' . esc_attr( $header_gap_status ); ?>">
					<div class="container">
						<div class="header-main-area">
							<?php eventchamp_site_alternative_logo(); ?>
							<?php eventchamp_site_logo(); ?>
							<div class="header-menu">
								<div class="header-top-bar">
									<?php eventchamp_header_elements(); ?>
								</div>
								<nav class="navbar">
									<?php
										wp_nav_menu(
											array(
												'menu' => 'mainmenu',
												'theme_location' => $menu_location,
												'depth' => 5,
												'container' => 'div',
												'container_class' => 'collapse navbar-collapse',
												'menu_class' => 'nav navbar-nav',
												'fallback_cb' => 'eventchamp_walker::fallback',
												'walker' => new eventchamp_walker()
											)
										);
									?>
								</nav>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			
			if( !$header_status == 'off' or $header_status == "on" ) {
				
				if ( is_page() or is_single() ) {
					
					if( $header_style == "header-style-2" ) {
						eventchamp_headerstyle2();
					} elseif( $header_style == "header-style-1" ) {
						eventchamp_headerstyle1();
					} else {
						
						if( $default_header_style == "header-style-2" ) {
							eventchamp_headerstyle2();
						} else {
							eventchamp_headerstyle1();
						}
						
					}
					
				} elseif( is_category() ) {
					
					$cat = get_queried_object();
					$cat_id = $cat->term_id;
					$eventchamp_category_header_style = get_term_meta( $cat_id, 'eventchamp_category_header_style', true );
					
					if( $eventchamp_category_header_style == "header-style-2" ) {
						eventchamp_headerstyle2();
					} elseif( $eventchamp_category_header_style == "header-style-1" ) {
						eventchamp_headerstyle1();
					} else {
						
						if( $default_header_style == "header-style-2" ) {
							eventchamp_headerstyle2();
						} else {
							eventchamp_headerstyle1();
						}
						
					}
					
				} else {
				
					if( $default_header_style == "header-style-2" ) {
						eventchamp_headerstyle2();
					} else {
						eventchamp_headerstyle1();
					}

				}
				
			}
		}
	}

	/*======
	*
	* Mobile Header
	*
	======*/
	function eventchamp_mobile_header() {
		if ( is_page() or is_single() ) {
			global $post;
			$page_menu_location = get_post_meta( $post->ID, 'page_menu_location', true);
		}
		else {
			$page_menu_location = "";
		}
	
		if ( $page_menu_location == "default" ) {
			$menu_location = 'mainmenu';
		} elseif ( $page_menu_location == "onepage" ) {
			$menu_location = "onepagemenu";		
		} else {
			$menu_location = "mainmenu";		
		}
		?>
			<header class="mobile-header">
				<div class="logo-area">
					<div class="container">
						<?php eventchamp_site_logo(); ?>
						<div class="mobile-menu-icon">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</header>
			<div class="mobile-menu-wrapper"></div>
			<div class="mobile-menu scrollbar-outer">
				<div class="mobile-menu-top">
					<div class="logo-area">
						<?php eventchamp_site_logo(); ?>
						<div class="mobile-menu-icon">
							<i class="fa fa-times-thin" aria-hidden="true"></i>
						</div>
					</div>
					<nav class="mobile-navbar">
						<?php
							wp_nav_menu(
								array(
									'menu' => 'mainmenu',
									'theme_location' => $menu_location,
									'depth' => 5,
									'container' => 'div',
									'container_class' => 'collapse navbar-collapse',
									'menu_class' => 'nav navbar-nav',
									'fallback_cb' => 'eventchamp_walker::fallback',
									'walker' => new eventchamp_walker()
								)
							);
						?>
					</nav>
				</div>
				<div class="mobile-menu-bottom">
					<?php eventchamp_header_elements(); ?>
				</div>
			</div>
		<?php
	}

	/*======
	*
	* Site Main Logo
	*
	======*/
	function eventchamp_site_logo() {
		echo '<div class="header-logo">';
			$logo = ot_get_option( 'eventchamp_logo' );
			$logo_height = ot_get_option( 'logo_height' ); if( !empty( $logo_height ) ) { $logo_height = 'height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"'; }
			$logo_width = ot_get_option( 'logo_width' ); if( !empty( $logo_width ) ) { $logo_width = 'width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"'; }
			if( !$logo == ""  ) {
				echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'eventchamp' ) . '" src="' . esc_url( ot_get_option( 'eventchamp_logo' ) ) . '" ' . $logo_height . $logo_width . ' /></a></div>';
			} else {
				echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'eventchamp' ) . '" src="' . get_template_directory_uri() . '/include/assets/img/logo.png" /></a></div>';
			}
		echo '</div>';
	}

	/*======
	*
	* Site Alternative Logo
	*
	======*/
	function eventchamp_site_alternative_logo() {
		echo '<div class="header-logo header-alternative-logo">';
			$logo = ot_get_option( 'eventchamp_logo_alternative' );
			$logo_height = ot_get_option( 'logo_height' ); if( !empty( $logo_height ) ) { $logo_height = 'height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"'; }
			$logo_width = ot_get_option( 'logo_width' ); if( !empty( $logo_width ) ) { $logo_width = 'width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"'; }
			if( !$logo == ""  ) {
				echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'eventchamp' ) . '" src="' . esc_url( ot_get_option( 'eventchamp_logo_alternative' ) ) . '" ' . $logo_height . $logo_width . ' /></a></div>';
			} else {
				echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'eventchamp' ) . '" src="' . get_template_directory_uri() . '/include/assets/img/logo-alternative.png" /></a></div>';
			}
		echo '</div>';
	}

	/*======
	*
	* Elements for Header
	*
	======*/
	function eventchamp_header_elements() {
		$header_user_box = ot_get_option( 'header_user_box' );
		if( $header_user_box == 'on' ) {
			if( ! is_user_logged_in() ){ 
				echo'<ul class="user-box-links">
					<li>
						<a href="" data-target="#user_login_popup" data-toggle="modal">' . esc_html__( 'Login', 'eventchamp' ) . '</a>
						<a href="" data-target="#user_register_popup" data-toggle="modal">' . esc_html__( 'Sign Up', 'eventchamp' ) . '</a>
					</li>
				</ul>';
			} else {
				$current_user = wp_get_current_user();
				if( !empty( $current_user->ID ) ) {
					$loggined_user_id = $current_user->ID;
				} else {
					$loggined_user_id = "";
				}
				echo'<ul class="user-box-links">
					<li>
						<a href="' . esc_url( get_edit_profile_url( $current_user->ID ) ) . '" " title="' . esc_html__( 'Profile', 'eventchamp' ) . '">' . esc_html__( 'Profile', 'eventchamp' ) . '</a>
						<a href="' . esc_url( wp_logout_url( home_url( '/' ) ) ) . ' " title="' . esc_html__( 'Log Out', 'eventchamp' ) . '">' . esc_html__( 'Log Out', 'eventchamp' ) . '</a>
					</li>
				</ul>';
			}
		}

		$header_social_media = ot_get_option( 'header_social_media' );
		if( $header_social_media == 'on' or !$header_social_media == 'off' ) {
			echo eventchamp_social_media_sites();			
		}
	}

	/*======
	*
	* Register & Login Form
	*
	======*/
	function eventchamp_userbox() {
		$header_user_box = ot_get_option( 'header_user_box' );
		$header_social_login_system = ot_get_option( 'header_social_login_system' );
		if( !$header_user_box == 'off' or $header_user_box == 'on' ) {
			if( ! is_user_logged_in() ){ 
				?>
				<div class="modal fade pt-user-modal" id="user_login_popup" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="user-box">
								<div class="user-box-login">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
									<div class="pt-login">
										<form id="pt_login_form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
											<div class="form-group">
												<input class="required" name="pt_user_login" type="text" placeholder="<?php echo esc_html__('Username', 'eventchamp') ?>" />
											</div>
											<div class="form-group">
												<input class="required" name="pt_user_pass" id="pt_user_pass" type="password" placeholder="<?php echo esc_html__('Password', 'eventchamp')?>" />
											</div>
											<div class="form-group login-form-remember-me">
												<div class="login-remember-me-wrapper">
													<input type="checkbox" value="None" id="login-remember-me-wrapper-input" name="pt_remember_me" />
													<label for="login-remember-me-wrapper-input" id="login-remember-me-wrapper-label"><?php echo esc_html__('Remember Me', 'eventchamp')?></label>
												</div>
											</div>
											<div class="form-group login-form-button">
												<input type="hidden" name="action" value="eventchamp_login"/>
												<button data-loading-text="<?php echo esc_html__('Loading...', 'eventchamp') ?>" type="submit"><?php echo esc_html__('Sign in', 'eventchamp'); ?></button>
											</div>
											<div class="bottom-links">
											<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>"><?php echo esc_html__('Lost Password?', 'eventchamp') ?></a>
											<a href="" data-target="#user_register_popup" data-toggle="modal" class="create-an-account" data-dismiss="modal"><?php echo esc_html__('Create an Account', 'eventchamp') ?></a>
											</div>
											<?php wp_nonce_field( 'ajax-login-nonce', 'login-security' ); ?>
										</form>
										<div class="pt-errors"></div>
									</div>
									<div class="pt-loading">
										<p><i class="fa fa-refresh fa-spin"></i><br><?php echo esc_html__('Loading...', 'eventchamp') ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade pt-user-modal" id="user_register_popup" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="user-box">
								<div class="user-box-login">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
									<div class="pt-register">
										<?php
											if( get_option("users_can_register") == "0" ) {
												echo '<p class="users_can_register">' . esc_html__( 'New membership are not allowed.', 'eventchamp' ) . '</p>';
											} else {
										?>
										<form id="pt_registration_form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="POST">
											<div class="form-group">
												<input class="required" name="pt_user_login" placeholder="<?php echo esc_html__('Username', 'eventchamp'); ?>" type="text"/>
											</div>
											<div class="form-group">
												<input class="required" name="pt_user_email" id="pt_user_email" placeholder="<?php echo esc_html__('Email', 'eventchamp'); ?>" type="email"/>
											</div>
											<div class="form-group login-form-remember-me">
												<div class="login-remember-me-wrapper">
													<div class="description">
														<?php
															$page_terms_and_conditions = ot_get_option( 'page_terms_and_conditions' );
															if( !empty( $page_terms_and_conditions ) ) {
																$page_terms_and_conditions = get_the_permalink( $page_terms_and_conditions );
															} else {
																$page_terms_and_conditions = home_url( '/' );
															}

															$page_privacy_policy = ot_get_option( 'page_privacy_policy' );
															if( !empty( $page_privacy_policy ) ) {
																$page_privacy_policy = get_the_permalink( $page_privacy_policy );
															} else {
																$page_privacy_policy = home_url( '/' );
															}
														?>
														<?php echo esc_html__('By creating an account you agree to our', 'eventchamp' ); ?>
														<a href="<?php echo esc_url( $page_terms_and_conditions ); ?>" target="_blank"><?php echo esc_html__('terms and conditions', 'eventchamp' ); ?></a>
														<?php echo esc_html__('and our', 'eventchamp' ); ?>
														<a href="<?php echo esc_url( $page_privacy_policy ); ?>" target="_blank"><?php echo esc_html__('privacy policy.', 'eventchamp' ); ?></a>
													</div>
												</div>
											</div>
											<div class="form-group login-form-button register-form-button">
												<input type="hidden" name="action" value="eventchamp_register"/>
												<button data-loading-text="<?php echo esc_html__('Loading...', 'eventchamp') ?>" type="submit"><?php echo esc_html__('Be Member', 'eventchamp'); ?></button>
											</div>
											<?php wp_nonce_field( 'ajax-login-nonce', 'register-security' ); ?>
										</form>
										<div class="pt-errors"></div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
		}
	}
	add_action( 'wp_footer', 'eventchamp_userbox' );

	function eventchamp_login(){
		$user_login = $_POST['pt_user_login'];	
		$user_pass = $_POST['pt_user_pass'];
		$remember = $_POST['pt_remember_me'];
		if(isset($_POST['pt_remember_me'])) {
			$remember_me = "true";
		} else {
			$remember_me = "false";
		}

		if( !check_ajax_referer( 'ajax-login-nonce', 'login-security', false ) ){
			echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . esc_html__('Session token has expired, please reload the page and try again.', 'eventchamp') . '</div>' ) );
		}
		elseif( empty( $user_login ) || empty( $user_pass ) ){
			echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . esc_html__('Please fill all form fields.', 'eventchamp' ) . '</div>' ) );
		} else {
			$user = wp_signon( array( 'user_login' => $user_login, 'user_password' => $user_pass, 'remember' => $remember_me ), false );
			if( is_wp_error( $user ) ){
				echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . $user->get_error_message() . '</div>' ) );
			} else{
				echo json_encode( array( 'error' => false, 'message' => '<div class="alert-ok">' . esc_html__('Login successful, you are being redirected.', 'eventchamp') . '</div>' ) );
			}
		}
		die();
	}
	add_action( 'wp_ajax_nopriv_eventchamp_login', 'eventchamp_login' );

	function eventchamp_register(){
			$user_login	= $_POST['pt_user_login'];	
			$user_email	= $_POST['pt_user_email'];
			
			if( !check_ajax_referer( 'ajax-login-nonce', 'register-security', false ) ){
				echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . esc_html__( 'Session token has expired, please reload the page and try again', 'eventchamp' ).'</div>' ) );
				die();
			}
		 	
		 	elseif( empty( $user_login ) || empty( $user_email ) ){
				echo json_encode( array( 'error' => true, 'message' => '<div class="alert-no">' . esc_html__( 'Please fill all form fields', 'eventchamp' ) . '</div>' ) );
				die();
		 	}
			
			$errors = register_new_user($user_login, $user_email);
			if( is_wp_error( $errors ) ){
				$registration_error_messages = $errors->errors;
				$display_errors = '<div class="alert alert-no">';
					foreach( $registration_error_messages as $error ){
						$display_errors .= '<p>' . $error[0] . '</p>';
					}
				$display_errors .= '</div>';
				echo json_encode( array( 'error' => true, 'message' => $display_errors ) );
			} else {
				echo json_encode( array( 'error' => false, 'message' => '<div class="alert-ok">' . esc_html__( 'Registration completed. Please check your e-mail.', 'eventchamp' ) . '</p>' ) );
			}
		 	die();
	}
	add_action( 'wp_ajax_nopriv_eventchamp_register', 'eventchamp_register' );

	/*======
	*
	* Menu Walker
	*
	======*/
	class eventchamp_walker extends Walker_Nav_Menu {
		/**
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
		}
		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$li_attributes = '';
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			//Add class and attribute to LI element that contains a submenu UL.
			if ($args->has_children){
				$classes[] 		= 'dropdown';
				$li_attributes .= ' data-dropdown="dropdown"';
			}
			$classes[] = 'menu-item-' . $item->ID;
			//If we are on the current page, add the active class to that menu item.
			$classes[] = ($item->current) ? 'active' : '';

			//Make sure you still add all of the WordPress classes.
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

			//Add attributes to link element.
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$attributes .= ($args->has_children) ? ' ' : ''; 

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before;
				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
			$item_output .= ($args->has_children) ? '<i class="fa fa-angle-down" aria-hidden="true"></i>' : '';
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element Data object
		 * @param array $children_elements List of elements to continue traversing.
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args
		 * @param string $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
	        if ( ! $element )
	            return;
	        $id_field = $this->db_fields['id'];
	        // Display this element.
	        if ( is_object( $args[0] ) )
	           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
	        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	    }
	}

	/*======
	*
	* Footer
	*
	======*/
	function eventchamp_footer() {
		$hide_footer = ot_get_option( 'hide_footer' );
		$default_footer_style = ot_get_option( 'default_footer_style' );
		$page_footer_style_1 = ot_get_option( 'page_footer_style_1' );
		$page_footer_style_2 = ot_get_option( 'page_footer_style_1' );
		
		if( !$hide_footer == 'off' or $hide_footer == 'on' ) {
			if ( is_page() or is_single() ) {
				global $post;
				$footer_gap = get_post_meta( $post->ID, 'footer_gap', true);
				$footer_style = get_post_meta( $post->ID, 'footer_layout_select', true);
				$footer_status = get_post_meta( $post->ID, 'footer_status', true);
			}
			else {
				$post = "";
				$footer_gap = "";
				$footer_style = "";
				$footer_status = "";
			}

			if( !$footer_gap == 'off' or $footer_gap == "on" ) {
				$footer_gap_status = "remove-gap";
			} else {
				$footer_gap_status = "remove-gap-removed";			
			}

			function eventchamp_copyright() {
				$hide_footer_logo = ot_get_option( 'hide_footer_logo' );
				$eventchamp_footer_logo = ot_get_option( 'eventchamp_footer_logo' );
				$footer_copyright_text = ot_get_option( 'footer_copyright_text' );
				if( !empty( $footer_copyright_text ) or $hide_footer_logo == "on" or !$hide_footer_logo == "off" or !empty( $eventchamp_footer_logo )  ) {
					echo '<div class="footer-copyright">';
						if( $hide_footer_logo == "on" or !$hide_footer_logo == "off" ) {
							if( !empty( $eventchamp_footer_logo ) ) {
								echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="footer-logo" title="' . get_bloginfo( 'name' ) . '"><img src="' . esc_url( $eventchamp_footer_logo ) . '" alt="' . get_bloginfo( 'name' ) . '" /></a>';
							}
						}

					if( !empty( $footer_copyright_text ) ) {
						echo '<p>' . $footer_copyright_text . '</p>';
					}
					echo '</div>';
					}
			}
			
			function eventchamp_footerstyle1() {
				$page_footer_style_1 = ot_get_option( 'page_footer_style_1' );
				if ( is_page() or is_single() ) {
					global $post;
					$footer_gap = get_post_meta( $post->ID, 'footer_gap', true);
				}
				else {
					$post = "";
					$footer_gap = "";
				}

				if( !$footer_gap == 'off' or $footer_gap == "on" ) {
					$footer_gap_status = "remove-gap";
				} else {
					$footer_gap_status = "remove-gap-removed";			
				}
				?>
					<footer class="footer footer-style1 <?php echo esc_attr( $footer_gap_status ); ?>" id="Footer">
						<?php eventchamp_container_before(); ?>
							<div class="footer-content">
								<?php
									$args_footer_page_content = array(
										'p' => $page_footer_style_1,
										'ignore_sticky_posts' => true,
										'post_type' => 'page',
										'post_status' => 'publish'
									);
									$wp_query = new WP_Query( $args_footer_page_content );
									while ( $wp_query->have_posts() ) :
									$wp_query->the_post();
									$postid = get_the_ID();
								?>
									<?php echo do_shortcode( get_the_content() ); ?>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							</div>
							<?php eventchamp_copyright(); ?>
						<?php eventchamp_container_after(); ?>
					</footer>
				<?php
			}
			
			function eventchamp_footerstyle2() {
				$page_footer_style_2 = ot_get_option( 'page_footer_style_1' );
				if ( is_page() or is_single() ) {
					global $post;
					$footer_gap = get_post_meta( $post->ID, 'footer_gap', true);
				}
				else {
					$post = "";
					$footer_gap = "";
				}

				if( !$footer_gap == 'off' or $footer_gap == "on" ) {
					$footer_gap_status = "remove-gap";
				} else {
					$footer_gap_status = "remove-gap-removed";			
				}
				?>
					<footer class="footer footer-style2 <?php echo esc_attr( $footer_gap_status ); ?>" id="Footer">
						<?php eventchamp_container_before(); ?>
							<div class="footer-content">
								<?php
									$args_footer_page_content = array(
										'p' => $page_footer_style_2,
										'ignore_sticky_posts' => true,
										'post_type' => 'page',
										'post_status' => 'publish'
									);
									$wp_query = new WP_Query( $args_footer_page_content );
									while ( $wp_query->have_posts() ) :
									$wp_query->the_post();
									$postid = get_the_ID();
								?>
									<?php echo do_shortcode( get_the_content() ); ?>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							</div>
							<?php eventchamp_copyright(); ?>
						<?php eventchamp_container_after(); ?>
					</footer>
				<?php
			}
			
			if( !$footer_status == 'off' or $footer_status == "on" ) {
			
				if( !$page_footer_style_1 == '0' and !empty( $page_footer_style_1  ) or !$page_footer_style_2 == '0' and !empty( $page_footer_style_2  ) ) {
					
					if ( is_page() or is_single() ) {
						
						if( $footer_style == "footer-style-2" ) {
							eventchamp_footerstyle2();
						} elseif( $footer_style == "footer-style-1" ) {
							eventchamp_footerstyle1();
						} else {
							
							if( $default_footer_style == "footer-style-2" ) {
								eventchamp_footerstyle2();
							} else {
								eventchamp_footerstyle1();
							}
							
						}
						
					} elseif( is_category() ) {
					
						$cat = get_queried_object();
						$cat_id = $cat->term_id;
						$eventchamp_category_footer_style = get_term_meta( $cat_id, 'eventchamp_category_footer_style', true );
						
						if( $eventchamp_category_footer_style == "footer-style-2" ) {
							eventchamp_footerstyle2();
						} elseif( $eventchamp_category_footer_style == "footer-style-1" ) {
							eventchamp_footerstyle1();
						} else {
							
							if( $default_footer_style == "footer-style-2" ) {
								eventchamp_footerstyle2();
							} else {
								eventchamp_footerstyle1();
							}
							
						}
						
					} else {
						
						if( $default_footer_style == "footer-style-2" ) {
							eventchamp_footerstyle2();
						} else {
							eventchamp_footerstyle1();
						}
						
					}
				
				} else {
					echo '<div class="no-footer-blank"></div>';
				}
			} else {
			}
			
		} else {
		}
	}

	/*======
	*
	* Featured Image for Post
	*
	======*/
	function eventchamp_featured_image_post( $post_id = "" ) {
		$featured_header_status = get_post_meta( $post_id, 'featured_header_status', true );
		$post_gallery_images_control =  get_post_meta( $post_id, 'post_images', true );

		if( $featured_header_status == "on" or !$featured_header_status == "off" ) {
			if ( has_post_format( 'video' ) ) {
				$post_video_embed = get_post_meta( $post_id, 'post_video_embed', true );
				if( !empty( $post_video_embed ) ) {
					$post_video_embed_new = balanceTags( stripcslashes( $post_video_embed ) );
					echo '<div class="post-featured-header">';
						echo balanceTags( stripslashes( addslashes( $post_video_embed_new ) ) );

						$post_post_category_name = ot_get_option( 'post_post_category_name' );
						if ( !$post_post_category_name == 'off' or $post_post_category_name == 'on' ) {
							echo '<div class="category">';
								the_category( '', '' );
							echo '</div>';
						}
					echo '</div>';
				}
			} elseif( has_post_format( 'audio' ) ) {
				$post_audio_embed = get_post_meta( $post_id, 'post_audio_embed', true );
				if( !empty( $post_audio_embed ) ) {
					$post_audio_embed_new = balanceTags ( stripcslashes( $post_audio_embed ) );
					echo '<div class="post-featured-header">';
						echo balanceTags ( stripslashes( addslashes( $post_audio_embed_new ) ) );

						$post_post_category_name = ot_get_option( 'post_post_category_name' );
						if ( !$post_post_category_name == 'off' or $post_post_category_name == 'on' ) {
							echo '<div class="category">';
								the_category( '', '' );
							echo '</div>';
						}
					echo '</div>';
				}
			} elseif( has_post_format( 'gallery' ) and !empty( $post_gallery_images_control ) ) {
				$post_gallery_images =  explode( ',', get_post_meta( $post_id, 'post_images', true ) );
				if( !empty( $post_gallery_images ) ) {
					echo '<div class="post-featured-header">';
						echo '<div class="swiper-container gloria-sliders post-featured-header-image-gallery" data-item="1" data-column-space="0">';
							echo '<div class="swiper-wrapper">';
								foreach ($post_gallery_images as $image) {
									echo '<div class="swiper-slide">' . wp_get_attachment_image( $image, 'eventchamp-big-post', true, true ) . '</div>';
								}
							echo '</div>';
						echo '</div>';

						$post_post_category_name = ot_get_option( 'post_post_category_name' );
						if ( !$post_post_category_name == 'off' or $post_post_category_name == 'on' ) {
							echo '<div class="category">';
								the_category( '', '' );
							echo '</div>';
						}
						echo '<div class="swiper-button-next next"></div>';
						echo '<div class="swiper-button-prev prev"></div>';
					echo '</div>';
				}
			} else {
				$post_post_image = ot_get_option( 'post_post_image' );
				if ( !$post_post_image == 'off' or $post_post_image == 'on' ) {
					if ( has_post_thumbnail() ) {
						echo '<div class="post-featured-header">';
							echo get_the_post_thumbnail( $post_id, 'eventchamp-big-post' );

							$post_post_category_name = ot_get_option( 'post_post_category_name' );
							if ( !$post_post_category_name == 'off' or $post_post_category_name == 'on' ) {
								if( is_single() ) {
									echo '<div class="category">';
										the_category( '', '' );
									echo '</div>';
								}
							}
						echo '</div>';
					}
				}
			}
		}
	}

	/*======
	*
	* Finding Slug
	*
	======*/
	function eventchamp_to_slug( $string ) {
		return strtolower( trim( preg_replace('/[^A-Za-z0-9-]+/', '-', $string ) ) );
	}

	/*======
	*
	* Finding Attachment ID from Guid
	*
	======*/
	if( ! function_exists( 'eventchamp_attachment_id' ) ) {
		function eventchamp_attachment_id( $url ) {
			$attachment_id = 0;
			$dir = wp_upload_dir();
			if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
				$file = basename( $url );
				$query_args = array(
					'post_type'   => 'attachment',
					'post_status' => 'inherit',
					'fields'      => 'ids',
					'meta_query'  => array(
						array(
							'value'   => $file,
							'compare' => 'LIKE',
							'key'     => '_wp_attachment_metadata',
						),
					)
				);
				$query = new WP_Query( $query_args );
				if ( $query->have_posts() ) {
					foreach ( $query->posts as $post_id ) {
						$meta = wp_get_attachment_metadata( $post_id );
						$original_file       = basename( $meta['file'] );
						$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
						if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
							$attachment_id = $post_id;
							break;
						}
					}
				}
			}
			return $attachment_id;
		}
	}

	/*======
	*
	* FAQ of Event
	*
	======*/
	function eventchamp_faq( $post_id = "" ) {
		if( !empty( $post_id ) ) {
			$event_faq = get_post_meta( $post_id, 'event_faq', true );
			$output = "";
			$output .= '<div class="panel-group" id="faq-accardion" role="tablist" aria-multiselectable="true">';
				foreach ( $event_faq as $event_faq_item ) {
					if( !empty( $event_faq_item ) ) {
						$faq_rand_id = rand( 0, 999999 );
						$faq_title = $event_faq_item["title"];
						$faq_description = $event_faq_item["event_faq_description"];
							if( !empty( $faq_title ) or !empty( $faq_date ) or !empty( $faq_time ) ) {
								$output .= '<div class="panel panel-default">';
									if( !empty( $faq_title ) ) {
										$output .= '<div class="panel-heading" role="tab" id="#faq-heading-' . esc_attr( $faq_rand_id ) . '">';
											$output .= '<a role="button" data-toggle="collapse" data-parent="#faq-accardion" href="#faq-collapse-' . esc_attr( $faq_rand_id ) . '" aria-expanded="true" aria-controls="faq-collapse-' . esc_attr( $faq_rand_id ) . '">';
													$output .= esc_attr( $faq_title );
											$output .= '<i class="fa fa-angle-down" aria-hidden="true"></i></a>';
										$output .= '</div>';
									}
									if( !empty( $faq_description ) or !empty( $faq_speakers ) ) {
										$output .= '<div id="faq-collapse-' . esc_attr( $faq_rand_id ) . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="faq-heading-' . esc_attr( $faq_rand_id ) . '">';
											$output .= '<div class="panel-body">';
												if( !empty( $faq_description ) ) {
													$output .= $faq_description;
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

	/*======
	*
	* Schedule of Event
	*
	======*/
/*
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
															$output .= '<div class="title">' . esc_html__( 'Speakers', 'eventchamp' ) . ':</div>';
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
																					$output .= '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">';
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
																					$output .= '</a>';
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
		*/
	/*======
	*
	* Speaker of Event
	*
	======*/
	/*
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
					wp_reset_postdata();
				$output .= '</div>';
			}
			return $output;
		}
	}
	*/

	function eventchamp_speaker_list_style_1( $post_id = "", $image = "", $profession = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			$output .= '<div class="speaker-list-styles speaker-list-style-1">';
				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
					} else {
						$image_url = "";
					}

					if( !empty( $image_url ) ) {
						$output .= '<div class="image">';
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
						$output .= '</div>';
					}
				}

				$output .= '<div class="content">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

					if( $profession == 'true' ) {
						$speaker_profession = get_post_meta( get_the_ID(), 'speaker_profession', true );
						if( !empty( $speaker_profession ) ) {
							$output .= '<div class="information">';
								$output .= '<div class="briefcase">';
									$output .= '<i class="fa fa-briefcase" aria-hidden="true"></i>';
									 	$output .= '<span>' . esc_attr( $speaker_profession ) . '</span>';
								$output .= '</div>';
							$output .= '</div>';
						}
					}
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	/*======
	*
	* Pricing Tables of Event
	*
	======*/
	function eventchamp_pricing_table( $post_id = "", $text_column = "1" ) {
		if( !empty( $post_id ) ) {

			$event_ticket_package_column_for_events = ot_get_option( 'event_ticket_package_column_for_events' );
			if( !empty( $event_ticket_package_column_for_events ) ) {
				$text_column = esc_attr( $event_ticket_package_column_for_events ) ;
			} else {
				$text_column = "2";
			}

			$event_tickets = get_post_meta( $post_id, 'event_tickets', true );
			$output = '';
			if( !empty( $event_tickets ) ) {
				$output .= '<div class="pricing-table column-' . esc_attr( $text_column ) . '">';
					foreach ( $event_tickets as $event_ticket ) {
						$ticket_title = $event_ticket["title"];
						$ticket_product = $event_ticket["event_tickets_product"];
						$ticket_feature = $event_ticket["event_tickets_package_feature"];
						$event_tickets_via_contact_form = $event_ticket["event_tickets_via_contact_form"];
						$event_redirect_to_external_link = $event_ticket["event_redirect_to_external_link"];
						$event_redirect_to_external_link_link = $event_ticket["event_redirect_to_external_link_link"];
						$event_redirect_to_external_link_title = $event_ticket["event_redirect_to_external_link_title"];
						if( !empty( $ticket_title ) or  !empty( $ticket_product ) or  !empty( $ticket_feature ) ) {
							$output .= '<div class="pricing-table-item">';
								$output .= '<div class="wrapper">';
									if( !empty( $ticket_title ) or  !empty( $ticket_product ) ) {
										$output .= '<div class="left">';
											if( !empty( $ticket_title ) ) {
												$output .= '<div class="title">' . esc_attr( $ticket_title ) . '</div>';
											}
											if( !empty( $ticket_product ) ) {
												$ticket_product_id = wc_get_product( $ticket_product );
												$output .= '<div class="price">' . $ticket_product_id->get_price_html() . '</div>';
											}

											if( $event_tickets_via_contact_form == "on" or !$event_tickets_via_contact_form == "off" ) {
												$output .= '<a href="#contactform" aria-controls="contactform" role="tab" data-toggle="tab" class="button contactLink">' . esc_html__( 'Buy Ticket', 'eventchamp' ) . '</a>';
											} elseif( $event_redirect_to_external_link == "on" or !$event_redirect_to_external_link == "off" ) {
												$output .= '<a href="' . esc_url( $event_redirect_to_external_link_link ) . '" class="button" target="_blank">' . esc_attr( $event_redirect_to_external_link_title ) . '</a>';
											} else {
												if( !empty( $ticket_product ) ) {
													$output .= '<a href="?add-to-cart=' . $ticket_product . '" class="button">' . esc_html__( 'Buy Ticket', 'eventchamp' ) . '</a>';
												} else {
													$output .= '<a href="#contactform" aria-controls="contactform" role="tab" data-toggle="tab" class="button contactLink">' . esc_html__( 'Buy Ticket', 'eventchamp' ) . '</a>';
												}
											}
										$output .= '</div>';
									}
									if( !empty( $ticket_feature ) ) {
										$output .= '<div class="right">';
											$output .= '<div class="content">' . wpautop( $ticket_feature ) . '</div>';
										$output .= '</div>';
									}
								$output .= '</div>';
							$output .= '</div>';
						}
					}
				$output .= '</div>';
			}
			return $output;
		}
	}

	/*======
	*
	* Event Status of Event
	*
	======*/
	function eventchamp_event_status( $post_id = "" ) {
		if( !empty( $post_id ) ) {
			$output = "";
			$event_start_date = get_post_meta( $post_id, 'event_start_date', true );
			$event_end_date = get_post_meta( $post_id, 'event_end_date', true );

			$event_start_date_last = date_format( date_create( $event_start_date ), "Y-m-d" );
			$event_end_date_last = date_format( date_create( $event_end_date ), "Y-m-d" );
			$date_now = date("Y-m-d");
			if( !empty( $event_start_date ) or !empty( $event_end_date ) ) {
				$output .= '<div class="status">';
					if( $event_start_date_last > $date_now ) {
						$output .= '<div class="statusStarting">' . esc_html__( 'Starting soon', 'eventchamp' ) . '</div>';
					} elseif( $date_now >= $event_start_date_last and $date_now <= $event_end_date_last ) {
						$output .= '<div class="statusShowing">' . esc_html__( 'Showing', 'eventchamp' ) . '</div>';
					} elseif( $event_start_date_last >= $date_now and $event_start_date_last <= $event_end_date_last ) {
						$output .= esc_html__( 'Incoming', 'eventchamp' );
					} elseif( $event_start_date_last <= $date_now and $event_end_date_last >= $date_now ) {
						$output .= esc_html__( 'Incoming', 'eventchamp' );
					} else {
						$output .='<div class="statusEnded">' . esc_html__( 'Ended', 'eventchamp' ) . '</div>';
					}		
				$output .= '</div>';	
			}
			return $output;
		}
	}

	/*======
	*
	* Expired Event ID's
	*
	======*/
	function eventchamp_expired_event_ids() {
		$date_now = date("Y-m-d");
		$ids = array();
		$args = array(
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'post_type' => 'event',
			'meta_key' => 'event_start_date',
			'meta_query' => array(
				array(
					'key' => 'event_end_date',
					'compare' => '<=',
					'value' => $date_now,
				),
			),
		);
		$wp_query = new WP_Query( $args );
		if( !empty( $wp_query ) ) {
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				$ids[] = get_the_ID();
			}
		}
		wp_reset_postdata();
		return $ids;
	}

	/*======
	*
	* Post Navigation
	*
	======*/
	function eventchamp_post_navigation() {
		$post_post_navigation = ot_get_option( 'post_post_navigation' );
		if ( !$post_post_navigation == 'off' or $post_post_navigation == 'on' ) {
		$eventchamp_post_navigation_prev = '<span>' . esc_html__( 'Previous', 'eventchamp' ) . '</span>';
		$eventchamp_post_navigation_next = '<span>' . esc_html__( 'Next', 'eventchamp' ) . '</span>';
		$prevPost = get_previous_post( false );
		$nextPost = get_next_post( false );
		?>
		<div class="post-navigation">
			<nav>
				<ul>
					<?php if( !empty( $prevPost ) ) { ?>
						<li class="previous">
							<?php previous_post_link( '%link', '<i class="fa fa-angle-left" aria-hidden="true"></i>' . $eventchamp_post_navigation_prev ); ?>
						</li>
					<?php } ?>
					<?php if( !empty( $nextPost ) ) { ?>
						<li class="next">
							<?php next_post_link( '%link', $eventchamp_post_navigation_next . '<i class="fa fa-angle-right" aria-hidden="true"></i>' ); ?>
						</li>
					<?php } ?>
				</ul>
			</nav>
		</div>
		<?php
		}
	}

	/*======
	*
	* Related Posts
	*
	======*/
	function eventchamp_related_posts() {
		global $post;
		$tags = wp_get_post_tags( $post->ID );
		$post_related_posts = ot_get_option( 'post_related_posts' );
		$post_post_navigation = ot_get_option( 'post_post_navigation' );

		$post_related_count = ot_get_option( 'post_related_posts_column' );
		if( !empty( $post_related_count ) ) {
			$post_related_count = $post_related_count;
		} else {
			$post_related_count = "3";
		}
		
		if( !$post_related_posts == 'off' or $post_related_posts == 'on' or !$post_post_navigation == 'off' or $post_post_navigation == 'on' ) {
			echo '<div class="post-related-navigation">';
				if( !$post_related_posts == 'off' or $post_related_posts == 'on' ) {
					if ( $tags ) {
					?>
						<?php eventchamp_content_title( $text = esc_html__ ( "Related Posts", "eventchamp" ) ); ?>
						<div class="related-posts-columns related-posts-column-<?php echo esc_attr( $post_related_count ); ?>">
							<?php
								$tag_ids = array();
								foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
								$args = array(
									'tag__in' => $tag_ids,
									'post__not_in' => array( $post->ID ),
									'post_status' => 'publish',
									'posts_type' => 'post',
									'ignore_sticky_posts' => true,
									'posts_per_page' => $post_related_count
								);
								$my_query = new wp_query( $args );
								while( $my_query->have_posts() ) {
									$my_query->the_post();
									echo eventchamp_post_list_style_2( $post_id = get_the_ID(), $image = "true", $category = "false", $excerpt = "false", $read_more = "false", $post_info = "true" );
								}
								wp_reset_postdata();
							?>
						</div>
					<?php }
				}
			echo '</div>';
		}
	}

	/*======
	*
	* Related Events
	*
	======*/
	function eventchamp_related_events() {
		global $post;
		$tags = wp_get_post_terms( $post->ID, 'event_tags' );
		$event_related_events_count = ot_get_option( 'event_related_events_count' );
		$event_related_events = ot_get_option( 'event_related_events' );

		if( !empty( $event_related_events_count ) ) {
			$event_related_events_count = $event_related_events_count;
		} else {
			$event_related_events_count = "3";
		}

		if( $event_related_events == "on" ) {
			echo '<div class="related-events-wrapper event-list column-2">';
				if ( $tags ) {
					$tag_ids = array();
					foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
					$args = array(
						'post__not_in' => array( $post->ID ),
						'post_status' => 'publish',
						'post_type' => 'event',
						'ignore_sticky_posts' => true,
						'posts_per_page' => $event_related_events_count,
						'tax_query' => array(
							array(
								'taxonomy' => 'event_tags',
								'field' => 'term_id',
								'terms' => $tag_ids,
							),
						),
					);
					$my_query = new wp_query( $args );
					while( $my_query->have_posts() ) {
						$my_query->the_post();
						echo eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "true", $status = "true", $price = "true" );
					}
				}
				wp_reset_postdata();
			echo '</div>';
		}
	}

	/*======
	*
	* Related Venues
	*
	======*/
	function eventchamp_related_venues() {
		global $post;
		$tags = wp_get_post_terms( $post->ID, 'event_tags' );
		$venue_related_venues_count = ot_get_option( 'venue_related_venues_count' );
		$venue_related_venues = ot_get_option( 'venue_related_venues' );

		if( !empty( $venue_related_venues_count ) ) {
			$venue_related_venues_count = $venue_related_venues_count;
		} else {
			$venue_related_venues_count = "3";
		}

		if( $venue_related_venues == "on" ) {
			echo '<div class="related-venues-wrapper">';
				echo '<div class="widget-title">' . esc_html__( 'Related' , 'eventchamp' ) . ' <span>' . esc_html__( 'Venues' , 'eventchamp' ) . '</span></div>';
				echo '<div class="venue-list column-3">';
					if ( $tags ) {
						$tag_ids = array();
						foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
						$args = array(
							'post__not_in' => array( $post->ID ),
							'post_status' => 'publish',
							'post_type' => 'venue',
							'ignore_sticky_posts' => true,
							'posts_per_page' => $venue_related_venues_count,
							'tax_query' => array(
								array(
									'taxonomy' => 'event_tags',
									'field' => 'term_id',
									'terms' => $tag_ids,
								),
							),
						);
						$my_query = new wp_query( $args );
						while( $my_query->have_posts() ) {
							$my_query->the_post();
							echo eventchamp_venue_list_style_1( $post_id = get_the_ID(), $image = "true", $location = "true", $excerpt = "true" );
						}
					}
					wp_reset_postdata();
				echo '</div>';
			echo '</div>';
		}
	}

	/*======
	*
	* Pagination for Archive
	*
	======*/
	function eventchamp_pagination() {
		if( is_singular() )
			return;

		global $wp_query;

		if( $wp_query->max_num_pages <= 1 )
			return;

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $wp_query->max_num_pages );

		if( $paged >= 1 )
			$links[] = $paged;

		if( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		$eventchamp_post_navigation_prev = '<span>' . esc_html__( 'Previous', 'eventchamp' ) . '</span>';
		$eventchamp_post_navigation_next = '<span>' . esc_html__( 'Next', 'eventchamp' ) . '</span>';
		$prev_text = '<i class="fa fa-angle-left" aria-hidden="true"></i>' . $eventchamp_post_navigation_prev;
		$next_text = $eventchamp_post_navigation_next . '<i class="fa fa-angle-right" aria-hidden="true"></i>';

		echo '<nav class="post-pagination"><ul>' . "\n";

		if( get_previous_posts_link() )
			printf( '<li>' . get_previous_posts_link( $prev_text ) . '</li>' );

		?>
			<li class="total-pages"><span><?php echo esc_html__( 'Page', 'eventchamp' ) . ' ' . $paged . ' ' . esc_html__( 'of', 'eventchamp' ) . ' ' . $max; ?></span></li>
		<?php
		if( get_next_posts_link() )
			printf( '<li>' . get_next_posts_link( $next_text ) . '</li>' );

		echo '</ul></nav>' . "\n";
	}

	/*======
	*
	* Pagination for Elements
	*
	======*/
	function eventchamp_element_pagination( $paged = "", $query = "" ) {
		if( !empty( $paged ) or !empty( $query ) ) {
			$output = "";
			$eventchamp_post_navigation_prev = '<span>' . esc_html__( 'Previous', 'eventchamp' ) . '</span>';
			$eventchamp_post_navigation_next = '<span>' . esc_html__( 'Next', 'eventchamp' ) . '</span>';	
			$prev_text = '<i class="fa fa-angle-left" aria-hidden="true"></i>' . $eventchamp_post_navigation_prev;
			$next_text = $eventchamp_post_navigation_next . '<i class="fa fa-angle-right" aria-hidden="true"></i>';
			$output .= '<nav class="post-pagination">';
				$output .= '<ul>';
					$prev_link = get_previous_posts_link( $prev_text );
					if( !empty( $prev_link ) ) {
						$output .= '<li class="previous">' . get_previous_posts_link( $prev_text ) . '</li>';					
					}
					$next_link = get_next_posts_link( $next_text, $query->max_num_pages );
					if( !empty( $next_link ) ) {
						$output .= '<li class="next">' . get_next_posts_link( $next_text, $query->max_num_pages ) . '</li>';
					}
				$output.= '</ul>';
			$output .= '</nav>';
			return $output;
		}
	}

	/*======
	*
	* Menus
	*
	======*/
	register_nav_menus( 
		array(
			'mainmenu' => esc_html__( 'Main Menu', 'eventchamp' ),
			'onepagemenu' => esc_html__( 'One Page Menu', 'eventchamp' ),
			'footermenu' => esc_html__( 'Footer Menu', 'eventchamp' ),
		)
	);

	/*======
	*
	* Social Media Sites
	*
	======*/
	function eventchamp_social_media_sites() {
		$output = '';
		$output .='<ul class="social-links">';
			if( !ot_get_option( 'social_media_facebook' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_facebook' ) . '" class="facebook" title="' . esc_html__( 'Facebook', 'eventchamp' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_twitter' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_twitter' ) . '" class="twitter" title="' . esc_html__( 'Twitter', 'eventchamp' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_googleplus' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_googleplus' ) . '" class="googleplus" title="' . esc_html__( 'Google+', 'eventchamp' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_instagram' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_instagram' ) . '" class="instagram" title="' . esc_html__( 'Instagram', 'eventchamp' ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_linkedin' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_linkedin' ) . '" class="linkedin" title="' . esc_html__( 'Linkedin', 'eventchamp' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_vine' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_vine' ) . '" class="vine" title="' . esc_html__( 'Vine', 'eventchamp' ) . '" target="_blank"><i class="fa fa-vine"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_youtube' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_youtube' ) . '" class="youtube" title="' . esc_html__( 'YouTube', 'eventchamp' ) . '" target="_blank"><i class="fa fa-youtube"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_pinterest' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_pinterest' ) . '" class="pinterest" title="' . esc_html__( 'Pinterest', 'eventchamp' ) . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_behance' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_behance' ) . '" class="behance" title="' . esc_html__( 'Behance', 'eventchamp' ) . '" target="_blank"><i class="fa fa-behance"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_deviantart' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_deviantart' ) . '" class="deviantart" title="' . esc_html__( 'Deviantart', 'eventchamp' ) . '" target="_blank"><i class="fa fa-deviantart"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_digg' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_digg' ) . '" class="digg" title="' . esc_html__( 'Digg', 'eventchamp' ) . '" target="_blank"><i class="fa fa-digg"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_dribbble' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_dribbble' ) . '" class="dribbble" title="' . esc_html__( 'Dribbble', 'eventchamp' ) . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_flickr' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_flickr' ) . '" class="flickr" title="' . esc_html__( 'Flickr', 'eventchamp' ) . '" target="_blank"><i class="fa fa-flickr"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_github' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_github' ) . '" class="github"" title="' . esc_html__( 'GitHub', 'eventchamp' ) . '" target="_blank"><i class="fa fa-github"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_lastfm' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_lastfm' ) . '" class="lastfm" title="' . esc_html__( 'Last.fm', 'eventchamp' ) . '" target="_blank"><i class="fa fa-lastfm"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_reddit' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_reddit' ) . '" class="reddit" title="' . esc_html__( 'Reddit', 'eventchamp' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_soundcloud' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_soundcloud' ) . '" class="soundcloud" title="' . esc_html__( 'SoundCloud', 'eventchamp' ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_tumblr' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_tumblr' ) . '" class="tumblr" title="' . esc_html__( 'Tumblr', 'eventchamp' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_vimeo' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_vimeo' ) . '" class="vimeo" title="' . esc_html__( 'Vimeo', 'eventchamp' ) . '" target="_blank"><i class="fa fa-vimeo"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_vk' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_vk' ) . '" class="vk" title="' . esc_html__( 'VK', 'eventchamp' ) . '" target="_blank"><i class="fa fa-vk"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_medium' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_medium' ) . '" class="medium" title="' . esc_html__( 'Medium', 'eventchamp' ) . '" target="_blank"><i class="fa fa-medium"></i></a></li>';
			endif;

			if( !ot_get_option( 'social_media_rss' ) == ""  ) :
				$output .='<li><a href="' . ot_get_option( 'social_media_rss' ) . '" class="rss" title="' . esc_html__( 'RSS', 'eventchamp' ) . '" target="_blank"><i class="fa fa-rss"></i></a></li>';
			endif;
		$output .='</ul>';
		return balanceTags ( stripslashes( addslashes( $output ) ) );
	}

	/*======
	*
	* Social Share
	*
	======*/
	function eventchamp_social_share() {
		$social_share_facebook = ot_get_option( 'social_share_facebook' );
		$social_share_twitter = ot_get_option( 'social_share_twitter' );
		$social_share_googleplus = ot_get_option( 'social_share_googleplus' );
		$social_share_linkedin = ot_get_option( 'social_share_linkedin' );
		$social_share_pinterest = ot_get_option( 'social_share_pinterest' );
		$social_share_reddit = ot_get_option( 'social_share_reddit' );
		$social_share_delicious = ot_get_option( 'social_share_delicious' );
		$social_share_stumbleupon = ot_get_option( 'social_share_stumbleupon' );
		$social_share_tumblr = ot_get_option( 'social_share_tumblr' );
		$social_share_link_title = esc_html__( 'Share to', 'eventchamp' );
		$hide_general_post_share = ot_get_option( 'hide_general_post_share' );
		$share_post_id = get_the_ID();
		
		$title = "";
		$facebook = "";
		$twitter = "";
		$googleplus = "";
		$linkedin = "";
		$pinterest = "";	
		$reddit = "";
		$delicious = "";
		$stumbleupon = "";
		$tumblr = "";
		
		if( !$hide_general_post_share == 'off' or $hide_general_post_share == "on" ) {
			if( is_single() ) {
				$title = '<div class="title">' . esc_html__( 'Share:', 'eventchamp' ) . '</div>';
			}

			if( !$social_share_facebook == 'off' or $social_share_facebook == 'on' ) {
				$facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'eventchamp' ) . '" target="_blank"><i class="fa fa-facebook"></i>' . '<span>' . esc_html__( 'Facebook', 'eventchamp' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_twitter == 'off' or $social_share_twitter == 'on' ) {
				$twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . urlencode( get_the_title() ). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'eventchamp' ) . '" target="_blank"><i class="fa fa-twitter"></i>' . '<span>' . esc_html__( 'Twitter', 'eventchamp' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_googleplus == 'off' or $social_share_googleplus == 'on' ) {
				$googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'eventchamp' ) . '" target="_blank"><i class="fa fa-google-plus"></i>' . '<span>' . esc_html__( 'Google+', 'eventchamp' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_linkedin == 'off' or $social_share_linkedin == 'on' ) {
				$linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'eventchamp' ) . '" target="_blank"><i class="fa fa-linkedin"></i>' . '<span>' . esc_html__( 'LinkedIn', 'eventchamp' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_pinterest == 'off' or $social_share_pinterest == 'on' ) {
				$pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'eventchamp' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i>' . '<span>' . esc_html__( 'Pinterest', 'eventchamp' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_reddit == 'off' or $social_share_reddit == 'on' ) {
				$reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'eventchamp' ) . '" target="_blank"><i class="fa fa-reddit"></i>' . '<span>' . esc_html__( 'Reddit', 'eventchamp' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_delicious == 'off' or $social_share_delicious == 'on' ) {
				$delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'eventchamp' ) . '" target="_blank"><i class="fa fa-delicious"></i>' . '<span>' . esc_html__( 'Delicious', 'eventchamp' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_stumbleupon == 'off' or $social_share_stumbleupon == 'on' ) {
				$stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'eventchamp' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i>' . '<span>' . esc_html__( 'Stumbleupon', 'eventchamp' ) . '</span>' . '</a></li>';
			}

			if( !$social_share_tumblr == 'off' or $social_share_tumblr == 'on' ) {
				$tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'eventchamp' ) . '" target="_blank"><i class="fa fa-tumblr"></i>' . '<span>' . esc_html__( 'Tumblr', 'eventchamp' ) . '</span>' . '</a></li>';
			}
		}
		
		$before = '<div class="post-share">' . $title . '<ul>';
		$after = '</ul></div>';
		
		$output = $before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $after;
		return balanceTags ( stripslashes( addslashes( $output ) ) );
	}

	/*======
	*
	* Social Media Sites for User
	*
	======*/
	function eventchamp_user_social_media_sites( $user_id = "" ) {
		$user_profile_social_media_facebook = get_the_author_meta( 'facebook', $user_id );
		$user_profile_social_media_googleplus = get_the_author_meta( 'googleplus', $user_id );
		$user_profile_social_media_instagram = get_the_author_meta( 'instagram', $user_id );
		$user_profile_social_media_linkedin = get_the_author_meta( 'linkedin', $user_id );
		$user_profile_social_media_vine = get_the_author_meta( 'vine', $user_id );
		$user_profile_social_media_twitter = get_the_author_meta( 'twitter', $user_id );
		$user_profile_social_media_pinterest = get_the_author_meta( 'pinterest', $user_id );
		$user_profile_social_media_youtube = get_the_author_meta( 'youtube', $user_id );
		$user_profile_social_media_behance = get_the_author_meta( 'behance', $user_id );
		$user_profile_social_media_deviantart = get_the_author_meta( 'deviantart', $user_id );
		$user_profile_social_media_digg = get_the_author_meta( 'digg', $user_id );
		$user_profile_social_media_dribbble = get_the_author_meta( 'dribbble', $user_id );
		$user_profile_social_media_flickr = get_the_author_meta( 'flickr', $user_id );
		$user_profile_social_media_github = get_the_author_meta( 'github', $user_id );
		$user_profile_social_media_lastfm = get_the_author_meta( 'lastfm', $user_id );
		$user_profile_social_media_reddit = get_the_author_meta( 'reddit', $user_id );
		$user_profile_social_media_soundcloud = get_the_author_meta( 'soundcloud', $user_id );
		$user_profile_social_media_tumblr = get_the_author_meta( 'tumblr', $user_id );
		$user_profile_social_media_vimeo = get_the_author_meta( 'vimeo', $user_id );
		$user_profile_social_media_vk = get_the_author_meta( 'vk', $user_id );
		$user_profile_social_media_medium = get_the_author_meta( 'medium', $user_id );

		if( !$user_profile_social_media_medium == "" or !$user_profile_social_media_vk == "" or !$user_profile_social_media_vimeo == "" or !$user_profile_social_media_tumblr == "" or !$user_profile_social_media_soundcloud == "" or !$user_profile_social_media_reddit == "" or !$user_profile_social_media_lastfm == "" or !$user_profile_social_media_github == "" or !$user_profile_social_media_flickr == "" or !$user_profile_social_media_dribbble == "" or !$user_profile_social_media_digg == "" or !$user_profile_social_media_deviantart == "" or !$user_profile_social_media_behance == "" or !$user_profile_social_media_youtube == "" or !$user_profile_social_media_pinterest == "" or !$user_profile_social_media_twitter == "" or !$user_profile_social_media_vine == "" or !$user_profile_social_media_linkedin == "" or !$user_profile_social_media_facebook == "" or !$user_profile_social_media_googleplus == ""  or !$user_profile_social_media_instagram == "" ) { ?>

			<div class="author-social-links">
				<ul>
					<?php if( !$user_profile_social_media_facebook == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_facebook ); ?>" title="<?php echo esc_html__( 'Facebook', 'eventchamp' ); ?>" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_googleplus == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_googleplus ); ?>" title="<?php echo esc_html__( 'Google+', 'eventchamp' ); ?>" target="_blank" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_instagram == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_instagram ); ?>" title="<?php echo esc_html__( 'Instagram', 'eventchamp' ); ?>" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_linkedin == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_linkedin ); ?>" title="<?php echo esc_html__( 'LinkedIn', 'eventchamp' ); ?>" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_vine == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_vine ); ?>" title="<?php echo esc_html__( 'Vine', 'eventchamp' ); ?>" target="_blank" class="vine"><i class="fa fa-vine"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_twitter == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_twitter ); ?>" title="<?php echo esc_html__( 'Twitter', 'eventchamp' ); ?>" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_pinterest == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_pinterest ); ?>" title="<?php echo esc_html__( 'Pinterest', 'eventchamp' ); ?>" target="_blank" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_youtube == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_youtube ); ?>" title="<?php echo esc_html__( 'YouTube', 'eventchamp' ); ?>" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_behance == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_behance ); ?>" title="<?php echo esc_html__( 'Behance', 'eventchamp' ); ?>" target="_blank" class="behance"><i class="fa fa-behance"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_deviantart == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_deviantart ); ?>" title="<?php echo esc_html__( 'DeviantArt', 'eventchamp' ); ?>" target="_blank" class="deviantart"><i class="fa fa-deviantart"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_digg == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_digg ); ?>" title="<?php echo esc_html__( 'Digg', 'eventchamp' ); ?>" target="_blank" class="digg"><i class="fa fa-digg"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_dribbble == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_dribbble ); ?>" title="<?php echo esc_html__( 'Dribbble', 'eventchamp' ); ?>" target="_blank" class="dribbble"><i class="fa fa-dribbble"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_flickr == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_flickr ); ?>" title="<?php echo esc_html__( 'Flickr', 'eventchamp' ); ?>" target="_blank" class="flickr"><i class="fa fa-flickr"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_github == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_github ); ?>" title="<?php echo esc_html__( 'GitHub', 'eventchamp' ); ?>" target="_blank" class="github"><i class="fa fa-github"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_lastfm == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_lastfm ); ?>" title="<?php echo esc_html__( 'Last.fm', 'eventchamp' ); ?>" target="_blank" class="lastfm"><i class="fa fa-lastfm"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_reddit == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_reddit ); ?>" title="<?php echo esc_html__( 'Reddit', 'eventchamp' ); ?>" target="_blank" class="reddit"><i class="fa fa-reddit"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_soundcloud == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_soundcloud ); ?>" title="<?php echo esc_html__( 'SoundCloud', 'eventchamp' ); ?>" target="_blank" class="soundcloud"><i class="fa fa-soundcloud"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_tumblr == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_tumblr ); ?>" title="<?php echo esc_html__( 'Tumblr', 'eventchamp' ); ?>" target="_blank" class="tumblr"><i class="fa fa-tumblr"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_vimeo == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_vimeo ); ?>" title="<?php echo esc_html__( 'Vimeo', 'eventchamp' ); ?>" target="_blank" class="vimeo"><i class="fa fa-vimeo"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_vk == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_vk ); ?>" title="<?php echo esc_html__( 'VK', 'eventchamp' ); ?>" target="_blank" class="vk"><i class="fa fa-vk"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_medium == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_medium ); ?>" title="<?php echo esc_html__( 'Medium', 'eventchamp' ); ?>" target="_blank" class="medium"><i class="fa fa-medium"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		<?php
		}
	}

	/*======
	*
	* WooCommerce Support for Theme
	*
	======*/
	if(class_exists('Woocommerce') ) {
		function eventchamp_woocommerce_support() {
			add_theme_support( 'woocommerce' );
		}
		add_action( 'after_setup_theme', 'eventchamp_woocommerce_support' );
	}

	/*======
	*
	* WooCommerce Columns for Related Products
	*
	======*/
	function eventchamp_related_products_column( $args ) {
		$related_product_count = esc_attr( ot_get_option( 'woocommerce_related_product_count_column' ) );
		if( !empty( $related_product_count ) ) {
			$args['posts_per_page'] = $related_product_count;
			$args['columns'] = 4;
		} else {
			$args['posts_per_page'] = 4;
			$args['columns'] = 4;
		}
		return $args;
	}
	add_filter( 'woocommerce_output_related_products_args', 'eventchamp_related_products_column' );

	/*======
	*
	* WooCommerce Columns for Shop Products
	*
	======*/
	if (!function_exists('eventchamp_shop_products_column')) {
		function eventchamp_shop_products_column() {
			$woocommerce_shop_product_column = esc_attr( ot_get_option( 'woocommerce_shop_product_column' ) );
			if( !empty( $woocommerce_shop_product_column ) ) {
				return $woocommerce_shop_product_column;
			} else {
				return 3;
			}
		}
	}
	add_filter('loop_shop_columns', 'eventchamp_shop_products_column');

	/*======
	*
	* WooCommerce Buy Now Button
	*
	======*/
	function eventchamp_buy_now_button( $product_id = "" ) {
		if( !empty( $product_id ) ) {
			$output = '<a href="' . get_the_permalink( $product_id ). '" class="more-button" title="' . the_title_attribute( array( 'echo' => 0,  'post' => $product_id ) ) . '">';
				$output .= '<i class="fa fa-shopping-basket" aria-hidden="true"></i>';
				$output .= '<span>' . esc_html__( 'Buy Now', 'eventchamp' ) . '</span>';
			$output .= '</a>';
			return $output;
		}
	}

	/*======
	*
	* WooCommerce Product Price
	*
	======*/
	function eventchamp_product_price( $product_id = "" ) {
		if( !empty( $product_id ) ) {
			global $product;
			$output = '<div class="price">' . balanceTags( stripslashes( addslashes( $product->get_price_html() ) ) ) . '</div>';
			return $output;
		}
	}

	/*======
	*
	* Event Lists
	*
	======*/
	function eventchamp_event_list_style_1( $post_id = "", $image = "", $category = "", $date = "", $location = "", $excerpt = "", $status = "", $price = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			$output .= '<div class="event-list-styles event-list-style-1">';
				if( $image == 'true' ) {
						if ( has_post_thumbnail( $post_id ) ) {
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'eventchamp-event-list' );
						} else {
							$image_url = "";
						}

						if( !empty( $image_url ) ) {
							$output .= '<div class="image">';
								$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';

								if( $status == 'true' ) {
									$output .= eventchamp_event_status( $post_id = get_the_ID() );
								}

								if( $price == 'true' ) {
									$event_remaining_tickets = get_post_meta( get_the_ID(), 'event_remaining_tickets', true );
									if( !empty( $event_remaining_tickets ) ) {
										$product_id = wc_get_product( $event_remaining_tickets );
										$output .= '<div class="price">' . $product_id->get_price_html() . '</div>';
									}
								}

							$output .= '</div>';
						}
				}

				$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

					if( $date == 'true' or $location == 'true' or $category == 'true' ) {
						$event_cats = wp_get_post_terms( $post_id, 'eventcat' );
						$event_location = get_post_meta( get_the_ID(), 'event_location', true );
						$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
						if( !empty( $event_cats ) or !empty( $event_location ) or !empty( $event_start_date ) ) {
							$output .= '<div class="details">';
								if( $category == 'true' ) {
									if( !empty( $event_cats ) ) {
										$output .= '<div class="category"><ul class="post-categories">';
											foreach( $event_cats as $event_cat ) {
												$output .= '<li><a href="' . get_term_link( $event_cat->term_id ) . '" title="' . esc_attr( $event_cat->name ) . '">' . esc_attr( $event_cat->name ) . '</a></li>';
											}
										$output .= '</ul></div>';
									}
								}
								if( $location == 'true' ) {
									if( !empty( $event_location ) ) {
										$location = get_term( $event_location, 'location' );
										if( !empty( $location ) ) {
											$output .= '<div class="location">';
												$output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
												if( !empty( $location ) ) {
												 	$output .= '<span>' . esc_attr( $location->name ) . '</span>';
												}
											$output .= '</div>';
										}
									}
								}
								if( $date == 'true' ) {
									if( !empty( $event_start_date ) ) {
										$output .= '<div class="date">';
											$output .= '<i class="fa fa-calendar" aria-hidden="true"></i>';
										 	$output .= '<span>' . esc_attr( eventchamp_global_date_converter( $date = $event_start_date ) ) . '</span>';
										$output .= '</div>';
									}
								}
							$output .= '</div>';
						}
					}

				if( $excerpt == 'true' ) {
					$excerpt_content = get_the_excerpt();
					if( !empty( $excerpt_content ) ) {
						$output .= '<div class="excerpt">' . get_the_excerpt() . '</div>';
					}
				}
			$output .= '</div>';
			return $output;
		}
	}

	function eventchamp_event_list_style_2( $post_id = "", $image = "", $date = "", $location = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			$output .= '<div class="event-list-styles event-list-style-2">';
				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
					} else {
						$image_url = "";
					}

					if( !empty( $image_url ) ) {
						$output .= '<div class="image">';
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
						$output .= '</div>';
					}
				}

				$output .= '<div class="content">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

					if( $date == 'true' or $location == 'true' ) {
						$event_location = get_post_meta( get_the_ID(), 'event_location', true );
						$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
						if( !empty( $event_location ) or !empty( $event_start_date ) ) {
							$output .= '<div class="information">';
								if( $location == 'true' ) {
									if( !empty( $event_location ) ) {
										$location = get_term( $event_location, 'location' );
										if( !empty( $location ) ) {
											$output .= '<div class="location">';
												$output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
												if( !empty( $location ) ) {
												 	$output .= '<span>' . esc_attr( $location->name ) . '</span>';
												}
											$output .= '</div>';
										}
									}
								}
								if( $date == 'true' ) {
									if( !empty( $event_start_date ) ) {
										$output .= '<div class="date">';
											$output .= '<i class="fa fa-calendar" aria-hidden="true"></i>';
										 	$output .= '<span>' . esc_attr( eventchamp_global_date_converter( $date = $event_start_date ) ) . '</span>';
										$output .= '</div>';
									}
								}
							$output .= '</div>';
						}
					}
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function eventchamp_event_list_style_3( $post_id = "", $image = "", $category = "", $date = "", $location = "", $excerpt = "", $status = "", $price = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			$output .= '<div class="event-list-styles event-list-style-3">';
				if( $image == 'true' ) {
						if ( has_post_thumbnail( $post_id ) ) {
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'eventchamp-event-list' );
						} else {
							$image_url = "";
						}

						if( !empty( $image_url ) ) {
							$output .= '<div class="image">';
								$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';

							$output .= '</div>';
						}
				}

				$output .= '<div class="content">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

						if( $date == 'true' or $category == 'true' ) {
							$event_cats = wp_get_post_terms( $post_id, 'eventcat' );
							$event_location = get_post_meta( get_the_ID(), 'event_location', true );
							$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
							if( !empty( $event_cats ) ) {
								$output .= '<div class="details">';
									if( $category == 'true' ) {
										if( !empty( $event_cats ) ) {
											$output .= '<div class="category"><ul class="post-categories">';
												foreach( $event_cats as $event_cat ) {
													$output .= '<li><a href="' . get_term_link( $event_cat->term_id ) . '" title="' . esc_attr( $event_cat->name ) . '">' . esc_attr( $event_cat->name ) . '</a></li>';
												}
											$output .= '</ul></div>';
										}
									}

									if( $date == 'true' ) {
										if( !empty( $event_start_date ) ) {
											$output .= '<div class="date">';
												$output .= '<i class="fa fa-calendar" aria-hidden="true"></i>';
											 	$output .= '<span>' . esc_attr( eventchamp_global_date_converter( $date = $event_start_date ) ) . '</span>';
											$output .= '</div>';
										}
									}
								$output .= '</div>';
							}
						}

					if( $excerpt == 'true' ) {
						$excerpt_content = get_the_excerpt();
						if( !empty( $excerpt_content ) ) {
							$output .= '<div class="excerpt">' . get_the_excerpt() . '</div>';
						}
					}

					if( !empty( $event_location ) or !empty( $event_remaining_tickets ) or $status == 'true' or $location == 'true' or $status == 'true' ) {
						$output .= '<div class="details">';
							if( $location == 'true' ) {
								if( !empty( $event_location ) ) {
									$location = get_term( $event_location, 'location' );
									if( !empty( $location ) ) {
										$output .= '<div class="location">';
											$output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
										 	$output .= '<span>' . esc_attr( $location->name ) . '</span>';
										$output .= '</div>';
									}
								}
							}

							if( $status == 'true' ) {
								$output .= '<div class="status">';
									$output .= '<i class="fa fa-hourglass" aria-hidden="true"></i>';
									$output .= eventchamp_event_status( $post_id = get_the_ID() );
								$output .= '</div>';
							}

							if( $price == 'true' ) {
								$event_remaining_tickets = get_post_meta( get_the_ID(), 'event_remaining_tickets', true );
								if( !empty( $event_remaining_tickets ) ) {
									$output .= '<div class="price">';
										$output .= '<i class="fa fa-credit-card" aria-hidden="true"></i>';
										$product_id = wc_get_product( $event_remaining_tickets );
										$output .= '<div class="price">' . $product_id->get_price_html() . '</div>';
									$output .= '</div>';
								}
							}
						$output .= '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	function eventchamp_event_list_style_4( $post_id = "", $image = "", $category = "", $date = "", $location = "", $excerpt = "", $status = "", $price = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			$output .= '<div class="event-list-styles event-list-style-4">';
				if( $image == 'true' ) {
						if ( has_post_thumbnail( $post_id ) ) {
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'eventchamp-event-list' );
						} else {
							$image_url = "";
						}

						if( !empty( $image_url ) ) {
							$output .= '<div class="image">';
								$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';

							$output .= '</div>';
						}
				}

				$output .= '<div class="content">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

						if( $date == 'true' or $category == 'true' ) {
							$event_cats = wp_get_post_terms( $post_id, 'eventcat' );
							$event_location = get_post_meta( get_the_ID(), 'event_location', true );
							$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
							if( !empty( $event_cats ) ) {
								$output .= '<div class="details">';
									if( $category == 'true' ) {
										if( !empty( $event_cats ) ) {
											$output .= '<div class="category"><ul class="post-categories">';
												foreach( $event_cats as $event_cat ) {
													$output .= '<li><a href="' . get_term_link( $event_cat->term_id ) . '" title="' . esc_attr( $event_cat->name ) . '">' . esc_attr( $event_cat->name ) . '</a></li>';
												}
											$output .= '</ul></div>';
										}
									}

									if( $date == 'true' ) {
										if( !empty( $event_start_date ) ) {
											$output .= '<div class="date">';
												$output .= '<i class="fa fa-calendar" aria-hidden="true"></i>';
											 	$output .= '<span>' . esc_attr( eventchamp_global_date_converter( $date = $event_start_date ) ) . '</span>';
											$output .= '</div>';
										}
									}
								$output .= '</div>';
							}
						}

					if( $excerpt == 'true' ) {
						$excerpt_content = get_the_excerpt();
						if( !empty( $excerpt_content ) ) {
							$output .= '<div class="excerpt">' . get_the_excerpt() . '</div>';
						}
					}

					if( !empty( $event_location ) or !empty( $event_remaining_tickets ) or $status == 'true' or $location == 'true' or $status == 'true' ) {
						$output .= '<div class="details">';
							if( $location == 'true' ) {
								if( !empty( $event_location ) ) {
									$location = get_term( $event_location, 'location' );
									if( !empty( $location ) ) {
										$output .= '<div class="location">';
											$output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
										 	$output .= '<span>' . esc_attr( $location->name ) . '</span>';
										$output .= '</div>';
									}
								}
							}

							if( $status == 'true' ) {
								$output .= '<div class="status">';
									$output .= '<i class="fa fa-hourglass" aria-hidden="true"></i>';
									$output .= eventchamp_event_status( $post_id = get_the_ID() );
								$output .= '</div>';
							}

							if( $price == 'true' ) {
								$event_remaining_tickets = get_post_meta( get_the_ID(), 'event_remaining_tickets', true );
								if( !empty( $event_remaining_tickets ) ) {
									$output .= '<div class="price">';
										$output .= '<i class="fa fa-credit-card" aria-hidden="true"></i>';
										$product_id = wc_get_product( $event_remaining_tickets );
										$output .= '<div class="price">' . $product_id->get_price_html() . '</div>';
									$output .= '</div>';
								}
							}
						$output .= '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	/*======
	*
	* Venue Lists
	*
	======*/
	function eventchamp_venue_list_style_1( $post_id = "", $image = "", $location = "", $excerpt = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			$output .= '<div class="venue-list-styles venue-list-style-1">';
				if( $image == 'true' ) {
						if ( has_post_thumbnail( $post_id ) ) {
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'eventchamp-event-list' );
						} else {
							$image_url = "";
						}

						if( !empty( $image_url ) ) {
							$output .= '<div class="image">';
								$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
								
								if( $location == 'true' ) {
									$venue_location = get_post_meta( $post_id, 'venue_location', true );
									if( !empty( $venue_location ) ) {
										$location = get_term( $venue_location, 'location' );
										if( !empty( $location ) ) {
											$output .= '<div class="location">';
											 	$output .= '<span>' . esc_attr( $location->name ) . '</span>';
											$output .= '</div>';
										}
									}
								}

							$output .= '</div>';
						}
				}

				$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

				if( $excerpt == 'true' ) {
					$venue_excerpt = get_the_excerpt();
					if( !empty( $venue_excerpt ) ) {
						$output .= '<div class="excerpt">' . get_the_excerpt() . '</div>';
					}
				}
			$output .= '</div>';
			return $output;
		}
	}

	function eventchamp_venue_list_style_2( $post_id = "", $image = "", $location = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			$output .= '<div class="venue-list-styles venue-list-style-2">';
				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
					} else {
						$image_url = "";
					}

					if( !empty( $image_url ) ) {
						$output .= '<div class="image">';
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
						$output .= '</div>';
					}
				}

				$output .= '<div class="content">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

					if( $location == 'true' ) {
						$venue_location = get_post_meta( get_the_ID(), 'venue_location', true );
						if( !empty( $venue_location ) ) {
							$location = get_term( $venue_location, 'location' );
							if( !empty( $location ) ) {
								$output .= '<div class="information">';
									$output .= '<div class="location">';
										$output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
										 	$output .= '<span>' . esc_attr( $location->name ) . '</span>';
									$output .= '</div>';
								$output .= '</div>';
							}
						}
					}
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	/*======
	*
	* Post Lists
	*
	======*/
	function eventchamp_post_list_style_1( $post_id = "", $image = "", $category = "", $excerpt = "", $read_more = "", $post_info = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			if ( is_sticky( get_the_ID() ) ) {
				$output .= '<div class="post-list-styles post-list-style-1 sticky-post">';
			} else {
				$output .= '<div class="post-list-styles post-list-style-1">';
			}			
				if( $image == 'true' ) {
						if ( has_post_thumbnail( $post_id ) ) {
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'eventchamp-big-post' );
						} else {
							$image_url = "";
						}

						if( !empty( $image_url ) ) {
							$output .= '<div class="image">';
								$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
								if( $category == 'true' ) {
									$output .= '<div class="category">';
										$output .= get_the_category_list( '', '', $post_id );
									$output .= '</div>';
								}
							$output .= '</div>';
						}
				}

				$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

				if( $excerpt == 'true' ) {
					$post_excerpt = get_the_excerpt();
					if( !empty( $post_excerpt ) ) {
						$output .= '<div class="excerpt">' . get_the_excerpt() . '</div>';
					}
				}

				if( $read_more == 'true' or $post_info == 'true' ) {
					$output .= '<div class="bottom">';
						if( $read_more == 'true' ) {
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" class="more-button">' . esc_html__( 'More', 'eventchamp' ) . '</a>';
						}

						if( $post_info == 'true' ) {
							$output .= '<ul class="post-information">';
								$output .= '<li class="date"><i class="fa fa-calendar" aria-hidden="true"></i>' . get_the_time( get_option( 'date_format' ), $post_id ) . '</li>';
								$output .= '<li class="comment"><i class="fa fa-comment" aria-hidden="true"></i>';
									$output .= '<a href="' . get_the_permalink( $post_id ) . '#comments" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">';
										$num_comments = get_comments_number( $post_id );
										if ( $num_comments == 0 ) {
											$comments = esc_html__( '0 Comment', 'eventchamp' );
										} elseif ( $num_comments > 1 ) {
											$comments = $num_comments . ' ' . esc_html__( 'Comments', 'eventchamp' );
										} else {
											$comments = esc_html__( '1 Comment', 'eventchamp' );
										}
										$output .= $comments;
									$output .= '</a>';
								$output .= '</li>';
							$output .= '</ul>';
						}
					$output .= '</div>';
				}
			$output .= '</div>';
			return $output;
		}
	}

	function eventchamp_post_list_style_2( $post_id = "", $image = "", $category = "", $excerpt = "", $read_more = "", $post_info = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			if ( is_sticky( get_the_ID() ) ) {
				$output .= '<div class="post-list-styles post-list-style-2 sticky-post">';
			} else {
				$output .= '<div class="post-list-styles post-list-style-2">';
			}
				if( $image == 'true' ) {
						if ( has_post_thumbnail( $post_id ) ) {
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'eventchamp-small-post' );
						} else {
							$image_url = "";
						}

						if( !empty( $image_url ) ) {
							$output .= '<div class="image">';
								$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
								if( $category == 'true' ) {
									$output .= '<div class="category">';
										$output .= get_the_category_list( '', '', $post_id );
									$output .= '</div>';
								}
							$output .= '</div>';
						}
				}

				$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

				if( $excerpt == 'true' ) {
					$post_excerpt = get_the_excerpt();
					if( !empty( $post_excerpt ) ) {
						$output .= '<div class="excerpt">' . get_the_excerpt() . '</div>';
					}
				}

				if( $read_more == 'true' or $post_info == 'true' ) {
					$output .= '<div class="bottom">';
						if( $read_more == 'true' ) {
							$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" class="more-button">' . esc_html__( 'More', 'eventchamp' ) . '</a>';
						}

						if( $post_info == 'true' ) {
							$output .= '<ul class="post-information">';
								$output .= '<li class="date"><i class="fa fa-calendar" aria-hidden="true"></i>' . get_the_time( get_option( 'date_format' ), $post_id ) . '</li>';
								$output .= '<li class="comment"><i class="fa fa-comment" aria-hidden="true"></i>';
									$output .= '<a href="' . get_the_permalink( $post_id ) . '#comments" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">';
										$num_comments = get_comments_number( $post_id );
										if ( $num_comments == 0 ) {
											$comments = esc_html__( '0 Comment', 'eventchamp' );
										} elseif ( $num_comments > 1 ) {
											$comments = $num_comments . ' ' . esc_html__( 'Comments', 'eventchamp' );
										} else {
											$comments = esc_html__( '1 Comment', 'eventchamp' );
										}
										$output .= $comments;
									$output .= '</a>';
								$output .= '</li>';
							$output .= '</ul>';
						}
					$output .= '</div>';
				}
			$output .= '</div>';
			return $output;
		}
	}

	function eventchamp_post_list_style_3( $post_id = "", $image = "", $post_info = "" ) {
		if( !empty( $post_id ) ) {
			$output  = "";
			$output .= '<div class="post-list-styles post-list-style-3">';
				if( $image == 'true' ) {
					if ( has_post_thumbnail( $post_id ) ) {
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );

						if( !empty( $image_url ) ) {
							$output .= '<div class="image">';
								$output .= '<a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '" /></a>';
							$output .= '</div>';
						}
					} else {
						$image_url = "";
					}
				}

				$output .= '<div class="desc">';
					$output .= '<div class="title"><a href="' . get_the_permalink( $post_id ) . '" title="' . the_title_attribute( array( 'echo' => 0, 'post' => $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></div>';

					if( $post_info == 'true' ) {
						$output .= '<div class="post-information"><i class="fa fa-calendar" aria-hidden="true"></i>' . get_the_time( get_option( 'date_format' ), $post_id ) . '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}

	/*======
	*
	* Post Styles for Archives
	*
	======*/
	function eventchamp_archive_post_list() {
		function eventchamp_archive_post_list_style1() {
			echo '<div class="archive-post-list-style-1 post-list">';
				while ( have_posts() ) : the_post();
					echo eventchamp_post_list_style_1( $post_id = get_the_ID(), $image = "true", $category = "true", $excerpt = "true", $read_more = "true", $post_info = "true" );
				endwhile;
			echo '</div>';
		}
		
		function eventchamp_archive_post_list_style2() {
			echo '<div class="archive-post-list-style-2 post-list">';
				while ( have_posts() ) : the_post();
					echo eventchamp_post_list_style_2( $post_id = get_the_ID(), $image = "true", $category = "true", $excerpt = "true", $read_more = "true", $post_info = "true" );
				endwhile;
			echo '</div>';
		}

		if( is_category() ) {
			$archive_archive_post_list_style = ot_get_option( 'blog_category_post_list_style' );
		} elseif( is_tag() ) {
			$archive_archive_post_list_style = ot_get_option( 'tag_tag_post_list_style' );
		} elseif( is_search() ) {
			$archive_archive_post_list_style = ot_get_option( 'search_search_post_list_style' );
		} else {
			$archive_archive_post_list_style = ot_get_option( 'archive_archive_post_list_style' );
		}
		
		if( is_category() ) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$eventchamp_category_category_post_list_style = get_term_meta( $cat_id, 'eventchamp_category_category_post_list_style', true );
			if( $eventchamp_category_category_post_list_style == "post-list-style-1" ) {
				eventchamp_archive_post_list_style1();				
			} elseif( $eventchamp_category_category_post_list_style == "post-list-style-2" ) {
				eventchamp_archive_post_list_style2();				
			} else {
				if( $archive_archive_post_list_style == "style2" ) {
					eventchamp_archive_post_list_style2();
				} else {
					eventchamp_archive_post_list_style1();
				}
			}

		} else {
			if( $archive_archive_post_list_style == "style2" ) {
				eventchamp_archive_post_list_style2();
			} else {
				eventchamp_archive_post_list_style1();
			}
		}
	}

	/*======
	*
	* Breadcrumbs
	*
	======*/
	function eventchamp_breadcrumbs() {
		$text['home'] = get_bloginfo( 'name' ); // text for the 'Home' link
		$text['category'] = ' %s'; // text for a category page
		$text['search'] = '%s'; // text for a search results page
		$text['tag'] = '%s'; // text for a tag page
		$text['author'] = '%s'; // text for an author page
		$text['404'] = esc_html__( 'Page 404', 'eventchamp' ); // text for the 404 page
		$text['page'] = '%s'; // text 'Page N'
		$text['cpage'] = esc_html__( 'Comment Page', 'eventchamp' ) . ' %s'; // text 'Comment Page N'
		$wrap_before = '<div class="breadcrumbs">'; // the opening wrapper tag
		$wrap_after = '</div>'; // the closing wrapper tag
		$sep = '›'; // separator between crumbs
		$sep_before = '<span class="sep">'; // tag before separator
		$sep_after = '</span>'; // tag after separator
		$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
		$show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$show_current = 1; // 1 - show current page title, 0 - don't show
		$before = '<span class="current">'; // tag before the current crumb
		$after = '</span>'; // tag after the current crumb

		global $post;
		$home_url = home_url('/');
		$link_before = '<span>';
		$link_after = '</span>';
		$link_attr = ' ';
		$link_in_before = '<span>';
		$link_in_after = '</span>';
		$link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
		$frontpage_id = get_option('page_on_front');
		$parent_id = ($post) ? $post->post_parent : '';
		$sep = ' ' . $sep_before . $sep . $sep_after . ' ';
		$home_link = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;
		if (is_home() || is_front_page()) {
			if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;
		} else {
			echo $wrap_before;
			if ($show_home_link) echo $home_link;
			if ( is_category() ) {
				$cat = get_category(get_query_var('cat'), false);
				if ($cat->parent != 0) {
					$cats = get_category_parents($cat->parent, TRUE, $sep);
					$cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
					if ($show_home_link) echo $sep;
					echo $cats;
				}
				if ( get_query_var('paged') ) {
					$cat = $cat->cat_ID;
					echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {
					if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
				}
			} elseif ( is_search() ) {
				if (have_posts()) {
					if ($show_home_link && $show_current) echo $sep;
					if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
				} else {
					if ($show_home_link) echo $sep;
					echo $before . sprintf($text['search'], get_search_query()) . $after;
				}
			} elseif ( is_day() ) {
				if ($show_home_link) echo $sep;
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
				echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
				if ($show_current) echo $sep . $before . get_the_time('d') . $after;
			} elseif ( is_month() ) {
				if ($show_home_link) echo $sep;
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
				if ($show_current) echo $sep . $before . get_the_time('F') . $after;
			} elseif ( is_year() ) {
				if ($show_home_link && $show_current) echo $sep;
				if ($show_current) echo $before . get_the_time('Y') . $after;
			} elseif ( is_single() && !is_attachment() ) {
				if ($show_home_link) echo $sep;
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
					if ($show_current) echo $sep . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $sep);
					if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
					echo $cats;
					if ( get_query_var('cpage') ) {
						echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
					} else {
						if ($show_current) echo $before . get_the_title() . $after;
					}
				}
			/* Post Types */
			} elseif ( is_tag() ) {
				if ( get_query_var('paged') ) {
					$tag_id = get_queried_object_id();
					$tag = get_tag($tag_id);
					echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {
					if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
				}
			} elseif( is_tax() or is_archive() ) {
				if ($show_current) echo $sep . $before . sprintf( single_term_title( '', false ) ) . $after;
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				if ( get_query_var('paged') ) {
					echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {
					if ($show_current) echo $sep . $before;
				}
			} elseif ( is_attachment() ) {
				if ($show_home_link) echo $sep;
				$parent = get_post($parent_id);
				printf($link, get_permalink($parent), $parent->post_title);
				if ($show_current) echo $sep . $before . get_the_title() . $after;
			} elseif ( is_page() && !$parent_id ) {
				if ($show_current) echo $sep . $before . get_the_title() . $after;
			} elseif ( is_page() && $parent_id ) {
				if ($show_home_link) echo $sep;
				if ($parent_id != $frontpage_id) {
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						if ($parent_id != $frontpage_id) {
							$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
						}
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						echo $breadcrumbs[$i];
						if ($i != count($breadcrumbs)-1) echo $sep;
					}
				}
				if ($show_current) echo $sep . $before . get_the_title() . $after;
			} elseif ( is_author() ) {
				global $author;
				$author = get_userdata($author);
				if ( get_query_var('paged') ) {
					if ($show_home_link) echo $sep;
					echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {
					if ($show_home_link && $show_current) echo $sep;
					if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
				}
			} elseif ( is_404() ) {
				if ($show_home_link && $show_current) echo $sep;
				if ($show_current) echo $before . $text['404'] . $after;
			} elseif ( has_post_format() && !is_singular() ) {
				if ($show_home_link) echo $sep;
				echo get_post_format_string( get_post_format() );
			}
			echo $wrap_after;
		}
	}

	/*======
	*
	* Archive Titles
	*
	======*/
	function eventchamp_archive_title() {
		echo '<div class="page-title-breadcrumbs">';
			if( is_page() ) {
				if ( has_post_thumbnail() ) {
					$custom_breadcrumbs = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'eventchamp-page-banner' );
					echo '<div class="page-title-breadcrumbs-image" style="background-image:url(' . esc_url( $custom_breadcrumbs["0"] ) . ');"></div>';
				} else {
					echo '<div class="page-title-breadcrumbs-image"></div>';						
				}	
			} else {
				echo '<div class="page-title-breadcrumbs-image"></div>';
			}
			
			echo '<div class="container">';
				echo '<h1>';
					if( is_post_type_archive( 'event' ) or is_post_type_archive( 'speaker' ) or is_post_type_archive( 'venue' ) ) {
						echo post_type_archive_title();
					} elseif( is_category() ) {
						$blog_category_title = ot_get_option( 'blog_category_title' );
						if( !$blog_category_title == 'off' or $blog_category_title == 'on' ) {
							$allowed_html = array ( 'span' => array() ); wp_kses( printf( __( '<span>%s</span>', 'eventchamp' ), single_cat_title( '', false ) ) , $allowed_html );
						}
					} elseif( is_tag() ) {
						$tag_tag_title = ot_get_option( 'tag_tag_title' );
						if( !$tag_tag_title == 'off' or $tag_tag_title == 'on' ) {
							$allowed_html = array ( 'span' => array() ); wp_kses( printf( __( '<span>%s</span>', 'eventchamp' ), single_tag_title( '', false ) ) , $allowed_html );
						}
					} elseif( is_search() ) {
						$search_search_title = ot_get_option( 'search_search_title' );
						if( !$search_search_title == 'off' or $search_search_title == 'on' ) {
							$allowed_html = array ( 'span' => array() ); wp_kses ( printf( __( '<span>%s</span>', 'eventchamp' ), get_search_query() ) , $allowed_html ); 
						}
					} elseif( is_author() ) {
						printf( esc_html__( '%s', 'eventchamp' ), '' . get_the_author() . '' );
					} elseif( is_tax( 'location' ) or is_tax( 'organizer' ) or is_tax( 'event_tags' ) or is_tax( 'eventcat' ) ) {
						echo single_term_title() . ' ' . esc_html__( 'Events', 'eventchamp' );
					} elseif( is_home() ) {
						echo esc_html__( 'Home', 'eventchamp' );
					} elseif( is_attachment() ) {
						$attachment_attachment_title = ot_get_option( 'attachment_attachment_title' );
						if( !$attachment_attachment_title == 'off' or $attachment_attachment_title == 'on' ) {
							echo get_the_title();
						}
					} elseif( is_page() ) {
						$page_title = ot_get_option( 'page_title' );
						if( !$page_title == 'off' or $page_title == 'on' ) {
							echo get_the_title();
						}
					} elseif( is_single() ) {
						$post_post_title = ot_get_option( 'post_post_title' );
						if( !$post_post_title == 'off' or $post_post_title == 'on' ) {
							echo get_the_title();
						}
					} else {
						$archive_eventchamp_archive_title = ot_get_option( 'archive_eventchamp_archive_title' );
						if( !$archive_eventchamp_archive_title == 'off' or $archive_eventchamp_archive_title == 'on' ) {
							if ( is_day() ) :
								printf( esc_html__( 'Daily Archives: %s', 'eventchamp' ), get_the_date() );
							elseif ( is_month() ) :
								printf( esc_html__( 'Monthly Archives: %s', 'eventchamp' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'eventchamp' ) ) );
							elseif ( is_year() ) :
								printf( esc_html__( 'Yearly Archives: %s', 'eventchamp' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'eventchamp' ) ) );
							elseif( is_singular( 'venue' ) or is_singular( 'event' ) or is_singular( 'speaker' ) ) :
								echo get_the_title();
							else :
								echo esc_html__( 'Archives', 'eventchamp' );
							endif;
						}
					}
				echo '</h1>';
				eventchamp_breadcrumbs();
			echo '</div>';
		echo '</div>';
	}

	function eventchamp_archive_title_blank() {
		echo '<div class="archive-title-none"></div>';
	}

	/*======
	*
	* Content Titles
	*
	======*/
	function eventchamp_content_title( $text = "" ) {
		echo '<div class="content-title-wrapper">';
			echo '<div class="title">' . $text . '</div>';
		echo '</div>';
	}

	function eventchamp_content_alternative_title( $text = "" ) {
		echo '<span class="content-alternative-wrapper-title">' . $text . '</span>';
	}

	/*======
	*
	* Sidebars
	*
	======*/
	if( !function_exists( 'eventchamp_sidebars_init' ) ) {
		function eventchamp_sidebars_init() {
			register_sidebar(array(
				'id' => 'general-sidebar',
				'name' => esc_html__( 'General Sidebar', 'eventchamp' ),
				'before_widget' => '<div id="%1$s" class="general-sidebar-wrap widget-box %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-title">',
				'after_title' => '</div>',
			));
			
			register_sidebar(array(
				'id' => 'shop-sidebar',
				'name' => esc_html__( 'Shop Sidebar', 'eventchamp' ),
				'before_widget' => '<div id="%1$s" class="shop-sidebar-wrap widget-box %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-title">',
				'after_title' => '</div>',
			));
		}
	}
	add_action( 'widgets_init', 'eventchamp_sidebars_init' );

	/*======
	*
	* Sidebar & Wrapper Layouts
	*
	======*/
	function eventchamp_post_content_before() {
		if(class_exists('Woocommerce') ) {
			if( is_shop() ) {
				$sidebar_position = ot_get_option('woocommerce_sidebar_position');
			} elseif( is_product() ) {
				$sidebar_position = ot_get_option('woocommerce_product_sidebar_position');
			} elseif ( is_post_type_archive( 'event' ) ) {
				$sidebar_position = ot_get_option('event_sidebar_position');
			} elseif ( is_post_type_archive( 'venue' ) ) {
				$sidebar_position = ot_get_option('venue_sidebar_position');
			} elseif ( is_post_type_archive( 'speaker' ) ) {
				$sidebar_position = ot_get_option('speaker_sidebar_position');
			} elseif( is_category() ) {
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventchamp_category_sidebar_style = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				if( !empty( $eventchamp_category_sidebar_style ) ) {
					$sidebar_position = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				} else {
					$sidebar_position = ot_get_option('category_sidebar_position');
				}
			} elseif( is_tag() ) {
				$sidebar_position = ot_get_option('tag_sidebar_position');
			} elseif( is_author() ) {
				$sidebar_position = ot_get_option('author_sidebar_position');
			} elseif( is_search() ) {
				$sidebar_position = ot_get_option('search_sidebar_position');
			} elseif( is_archive() ) {
				$sidebar_position = ot_get_option('archive_sidebar_position');
			} elseif( is_attachment() ) {
				$sidebar_position = ot_get_option('attachment_sidebar_position');
			} elseif( is_single() ) {
				$sidebar_position = ot_get_option('post_sidebar_position');
			} elseif( is_page() ) {
				$sidebar_position = ot_get_option('page_sidebar_position');
			} else {
				$sidebar_position = ot_get_option( 'sidebar_position' );
			}

			if ( is_page() or is_single() ) {
				global $post;
				$layout_select = get_post_meta( $post->ID, 'sidebar_position', true);
			} else {
				$layout_select = "";
			}
			
			if( $layout_select == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fullwidthsidebar">';
			}
			
			elseif( $layout_select == 'left' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-right left pull-right fixedSidebar">';
			}
			
			elseif( $layout_select == 'right' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left right fixedSidebar">';
			}
			
			elseif( $sidebar_position == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fullwidthsidebar">';
			}
			
			elseif( $sidebar_position == 'left' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-right left pull-right fixedSidebar">';
			}
			
			elseif( $sidebar_position == 'right' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left right fixedSidebar">';
			}
			
			else {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left right fixedSidebar">';
			}
		} else {
			if ( is_post_type_archive( 'event' ) ) {
				$sidebar_position = ot_get_option('event_sidebar_position');
			} elseif ( is_post_type_archive( 'venue' ) ) {
				$sidebar_position = ot_get_option('venue_sidebar_position');
			} elseif ( is_post_type_archive( 'speaker' ) ) {
				$sidebar_position = ot_get_option('speaker_sidebar_position');
			} elseif( is_category() ) {
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventchamp_category_sidebar_style = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				if( !empty( $eventchamp_category_sidebar_style ) ) {
					$sidebar_position = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				} else {
					$sidebar_position = ot_get_option('category_sidebar_position');
				}
			} elseif( is_tag() ) {
				$sidebar_position = ot_get_option('tag_sidebar_position');
			} elseif( is_author() ) {
				$sidebar_position = ot_get_option('author_sidebar_position');
			} elseif( is_search() ) {
				$sidebar_position = ot_get_option('search_sidebar_position');
			} elseif( is_archive() ) {
				$sidebar_position = ot_get_option('archive_sidebar_position');
			} elseif( is_attachment() ) {
				$sidebar_position = ot_get_option('attachment_sidebar_position');
			} elseif( is_single() ) {
				$sidebar_position = ot_get_option('post_sidebar_position');
			} elseif( is_page() ) {
				$sidebar_position = ot_get_option('page_sidebar_position');
			} else {
				$sidebar_position = ot_get_option( 'sidebar_position' );
			}

			if ( is_page() or is_single() ) {
				global $post;
				$layout_select = get_post_meta( $post->ID, 'sidebar_position', true);
			} else {
				$layout_select = "";
			}
			
			if( $layout_select == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fullwidthsidebar">';
			}
			
			elseif( $layout_select == 'left' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-right left pull-right fixedSidebar">';
			}
			
			elseif( $layout_select == 'right' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left right fixedSidebar">';
			}
			
			elseif( $sidebar_position == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fullwidthsidebar">';
			}
			
			elseif( $sidebar_position == 'left' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-right left pull-right fixedSidebar">';
			}
			
			elseif( $sidebar_position == 'right' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left right fixedSidebar">';
			}
			
			else {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left right fixedSidebar">';
			}
		}
	}

	function eventchamp_post_sidebar_before() {
		if(class_exists('Woocommerce') ) {
			if( is_shop() ) {
				$sidebar_position = ot_get_option('woocommerce_sidebar_position');
			} elseif( is_product() ) {
				$sidebar_position = ot_get_option('woocommerce_product_sidebar_position');
			} elseif ( is_post_type_archive( 'event' ) ) {
				$sidebar_position = ot_get_option('event_sidebar_position');
			} elseif ( is_post_type_archive( 'venue' ) ) {
				$sidebar_position = ot_get_option('venue_sidebar_position');
			} elseif ( is_post_type_archive( 'speaker' ) ) {
				$sidebar_position = ot_get_option('speaker_sidebar_position');
			} elseif( is_category() ) {
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventchamp_category_sidebar_style = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				if( !empty( $eventchamp_category_sidebar_style ) ) {
					$cat = get_queried_object();
					$sidebar_position = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				} else {
					$sidebar_position = ot_get_option('category_sidebar_position');
				}
			} elseif( is_tag() ) {
				$sidebar_position = ot_get_option('tag_sidebar_position');
			} elseif( is_author() ) {
				$sidebar_position = ot_get_option('author_sidebar_position');
			} elseif( is_search() ) {
				$sidebar_position = ot_get_option('search_sidebar_position');
			} elseif( is_archive() ) {
				$sidebar_position = ot_get_option('archive_sidebar_position');
			} elseif( is_attachment() ) {
				$sidebar_position = ot_get_option('attachment_sidebar_position');
			} elseif( is_single() ) {
				$sidebar_position = ot_get_option('post_sidebar_position');
			} elseif( is_page() ) {
				$sidebar_position = ot_get_option('page_sidebar_position');
			} else {
				$sidebar_position = ot_get_option( 'sidebar_position' );
			}

			if ( is_page() or is_single() ) {			
				global $post;
				$layout_select = get_post_meta( $post->ID, 'sidebar_position', true);
			} else {
				$layout_select = "";
			}
			
			if( $layout_select == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hide fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $layout_select == 'left' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right left fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $layout_select == 'right' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right right fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hide fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'left' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right left fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'right' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right right fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			else {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right fixedSidebar"><div class="theiaStickySidebar">';
			}
		} else {
			if ( is_post_type_archive( 'event' ) ) {
				$sidebar_position = ot_get_option('event_sidebar_position');
			} elseif ( is_post_type_archive( 'venue' ) ) {
				$sidebar_position = ot_get_option('venue_sidebar_position');
			} elseif ( is_post_type_archive( 'speaker' ) ) {
				$sidebar_position = ot_get_option('speaker_sidebar_position');
			} elseif( is_category() ) {
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventchamp_category_sidebar_style = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				if( !empty( $eventchamp_category_sidebar_style ) ) {
					$cat = get_queried_object();
					$sidebar_position = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				} else {
					$sidebar_position = ot_get_option('category_sidebar_position');
				}
			} elseif( is_tag() ) {
				$sidebar_position = ot_get_option('tag_sidebar_position');
			} elseif( is_author() ) {
				$sidebar_position = ot_get_option('author_sidebar_position');
			} elseif( is_search() ) {
				$sidebar_position = ot_get_option('search_sidebar_position');
			} elseif( is_archive() ) {
				$sidebar_position = ot_get_option('archive_sidebar_position');
			} elseif( is_attachment() ) {
				$sidebar_position = ot_get_option('attachment_sidebar_position');
			} elseif( is_single() ) {
				$sidebar_position = ot_get_option('post_sidebar_position');
			} elseif( is_page() ) {
				$sidebar_position = ot_get_option('page_sidebar_position');
			} else {
				$sidebar_position = ot_get_option( 'sidebar_position' );
			}

			if ( is_page() or is_single() ) {			
				global $post;
				$layout_select = get_post_meta( $post->ID, 'sidebar_position', true);
			} else {
				$layout_select = "";
			}
			
			if( $layout_select == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hide fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $layout_select == 'left' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right left fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $layout_select == 'right' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right right fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hide fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'left' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right left fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'right' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right right fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			else {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right fixedSidebar"><div class="theiaStickySidebar">';
			}
		}
	}

	function eventchamp_content_area_before() {
		if(class_exists('Woocommerce') ) {
			if( is_shop() ) {
				$sidebar_position = ot_get_option('woocommerce_sidebar_position');
			} elseif( is_product() ) {
				$sidebar_position = ot_get_option('woocommerce_product_sidebar_position');
			} elseif ( is_post_type_archive( 'event' ) ) {
				$sidebar_position = ot_get_option('event_sidebar_position');
			} elseif ( is_post_type_archive( 'venue' ) ) {
				$sidebar_position = ot_get_option('venue_sidebar_position');
			} elseif ( is_post_type_archive( 'speaker' ) ) {
				$sidebar_position = ot_get_option('speaker_sidebar_position');
			} elseif( is_category() ) {
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventchamp_category_sidebar_style = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				if( !empty( $eventchamp_category_sidebar_style ) ) {
					$sidebar_position = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				} else {
					$sidebar_position = ot_get_option('category_sidebar_position');
				}
			} elseif( is_tag() ) {
				$sidebar_position = ot_get_option('tag_sidebar_position');
			} elseif( is_author() ) {
				$sidebar_position = ot_get_option('author_sidebar_position');
			} elseif( is_search() ) {
				$sidebar_position = ot_get_option('search_sidebar_position');
			} elseif( is_archive() ) {
				$sidebar_position = ot_get_option('archive_sidebar_position');
			} elseif( is_attachment() ) {
				$sidebar_position = ot_get_option('attachment_sidebar_position');
			} elseif( is_single() ) {
				$sidebar_position = ot_get_option('post_sidebar_position');
			} elseif( is_page() ) {
				$sidebar_position = ot_get_option('page_sidebar_position');
			} else {
				$sidebar_position = ot_get_option( 'sidebar_position' );
			}
			
			if( $sidebar_position == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fullwidthsidebar">';
			}
			
			elseif( $sidebar_position == 'left' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-right site-content-left pull-right fixedSidebar">';
			}
			
			elseif( $sidebar_position == 'right' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left fixedSidebar">';
			}
			
			else {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left fixedSidebar">';
			}
		} else {
			if ( is_post_type_archive( 'event' ) ) {
				$sidebar_position = ot_get_option('event_sidebar_position');
			} elseif ( is_post_type_archive( 'venue' ) ) {
				$sidebar_position = ot_get_option('venue_sidebar_position');
			} elseif ( is_post_type_archive( 'speaker' ) ) {
				$sidebar_position = ot_get_option('speaker_sidebar_position');
			} elseif( is_category() ) {
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventchamp_category_sidebar_style = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				if( !empty( $eventchamp_category_sidebar_style ) ) {
					$sidebar_position = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				} else {
					$sidebar_position = ot_get_option('category_sidebar_position');
				}
			} elseif( is_tag() ) {
				$sidebar_position = ot_get_option('tag_sidebar_position');
			} elseif( is_author() ) {
				$sidebar_position = ot_get_option('author_sidebar_position');
			} elseif( is_search() ) {
				$sidebar_position = ot_get_option('search_sidebar_position');
			} elseif( is_archive() ) {
				$sidebar_position = ot_get_option('archive_sidebar_position');
			} elseif( is_attachment() ) {
				$sidebar_position = ot_get_option('attachment_sidebar_position');
			} elseif( is_single() ) {
				$sidebar_position = ot_get_option('post_sidebar_position');
			} elseif( is_page() ) {
				$sidebar_position = ot_get_option('page_sidebar_position');
			} else {
				$sidebar_position = ot_get_option( 'sidebar_position' );
			}
			
			if( $sidebar_position == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fullwidthsidebar">';
			}
			
			elseif( $sidebar_position == 'left' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-right site-content-left pull-right fixedSidebar">';
			}
			
			elseif( $sidebar_position == 'right' ) {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left fixedSidebar">';
			}
			
			else {
				echo '<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 site-content-left fixedSidebar">';
			}
		}
	}

	function eventchamp_sidebar_before() {
		if(class_exists('Woocommerce') ) {
			if( is_shop() ) {
				$sidebar_position = ot_get_option('woocommerce_sidebar_position');
			} elseif( is_product() ) {
				$sidebar_position = ot_get_option('woocommerce_product_sidebar_position');
			} elseif ( is_post_type_archive( 'event' ) ) {
				$sidebar_position = ot_get_option('event_sidebar_position');
			} elseif ( is_post_type_archive( 'venue' ) ) {
				$sidebar_position = ot_get_option('venue_sidebar_position');
			} elseif ( is_post_type_archive( 'speaker' ) ) {
				$sidebar_position = ot_get_option('speaker_sidebar_position');
			} elseif( is_category() ) {
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventchamp_category_sidebar_style = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				if( !empty( $eventchamp_category_sidebar_style ) ) {
					$sidebar_position = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				} else {
					$sidebar_position = ot_get_option('category_sidebar_position');
				}
			} elseif( is_tag() ) {
				$sidebar_position = ot_get_option('tag_sidebar_position');
			} elseif( is_author() ) {
				$sidebar_position = ot_get_option('author_sidebar_position');
			} elseif( is_search() ) {
				$sidebar_position = ot_get_option('search_sidebar_position');
			} elseif( is_archive() ) {
				$sidebar_position = ot_get_option('archive_sidebar_position');
			} elseif( is_attachment() ) {
				$sidebar_position = ot_get_option('attachment_sidebar_position');
			} elseif( is_single() ) {
				$sidebar_position = ot_get_option('post_sidebar_position');
			} elseif( is_page() ) {
				$sidebar_position = ot_get_option('page_sidebar_position');
			} else {
				$sidebar_position = ot_get_option( 'sidebar_position' );
			}
			
			if( $sidebar_position == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hide fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'left' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right left fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'right' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right right fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			else {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right fixedSidebar"><div class="theiaStickySidebar">';
			}
		} else {
			if ( is_post_type_archive( 'event' ) ) {
				$sidebar_position = ot_get_option('event_sidebar_position');
			} elseif ( is_post_type_archive( 'venue' ) ) {
				$sidebar_position = ot_get_option('venue_sidebar_position');
			} elseif ( is_post_type_archive( 'speaker' ) ) {
				$sidebar_position = ot_get_option('speaker_sidebar_position');
			} elseif( is_category() ) {
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventchamp_category_sidebar_style = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				if( !empty( $eventchamp_category_sidebar_style ) ) {
					$sidebar_position = get_term_meta( $cat_id, 'eventchamp_category_sidebar_style', true );
				} else {
					$sidebar_position = ot_get_option('category_sidebar_position');
				}
			} elseif( is_tag() ) {
				$sidebar_position = ot_get_option('tag_sidebar_position');
			} elseif( is_author() ) {
				$sidebar_position = ot_get_option('author_sidebar_position');
			} elseif( is_search() ) {
				$sidebar_position = ot_get_option('search_sidebar_position');
			} elseif( is_archive() ) {
				$sidebar_position = ot_get_option('archive_sidebar_position');
			} elseif( is_attachment() ) {
				$sidebar_position = ot_get_option('attachment_sidebar_position');
			} elseif( is_single() ) {
				$sidebar_position = ot_get_option('post_sidebar_position');
			} elseif( is_page() ) {
				$sidebar_position = ot_get_option('page_sidebar_position');
			} else {
				$sidebar_position = ot_get_option( 'sidebar_position' );
			}
			
			if( $sidebar_position == 'nosidebar' ) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hide fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'left' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right left fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			elseif( $sidebar_position == 'right' ) {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right right fixedSidebar"><div class="theiaStickySidebar">';
			}
			
			else {
				echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 site-content-right fixedSidebar"><div class="theiaStickySidebar">';
			}
		}
	}

	function eventchamp_content_area_after() {
		echo '</div>';
	}

	function eventchamp_sidebar_after() {
		echo '</div></div>';
	}

	/*======
	*
	* Theme Wrapper
	*
	======*/
	function eventchamp_wrapper_before() {
		$eventchamp_boxed = ot_get_option('eventchamp_boxed');
		if( $eventchamp_boxed == "on" ) {
			$boxed = "boxed-true";
		} else {
			$boxed = "boxed-false";
		}
		echo '<div class="eventchamp-wrapper ' . esc_attr( $boxed ) . '" id="general-wrapper">';
	}
	function eventchamp_wrapper_after() {
		echo '</div>';
	}

	/*======
	*
	* Theme Content Wrapper
	*
	======*/
	function eventchamp_content_before() {
		echo '<div class="site-content">';
	}

	function eventchamp_content_after() {
		echo '</div>';
	}

	/*======
	*
	* Theme Sub Content Wrapper
	*
	======*/
	function eventchamp_sub_content_before() {
		echo '<div class="site-sub-content">';
	}

	function eventchamp_sub_content_after() {
		echo '</div>';
	}

	/*======
	*
	* Widget Wrapper
	*
	======*/
	function eventchamp_widget_before() {
		echo '<div class="widget-content">';
	}

	function eventchamp_widget_after() {
		echo '</div>';
	}

	/*======
	*
	* Page Content Wrapper
	*
	======*/
	function eventchamp_page_content_before() {
		echo '<div class="site-page-content">';
	}

	function eventchamp_page_content_after() {
		echo '</div>';
	}

	/*======
	*
	* Row Wrapper
	*
	======*/
	function eventchamp_row_before() {
		echo '<div class="row">';
	}
	function eventchamp_row_after() {
		echo '</div>';
	}

	/*======
	*
	* Container Wrapper
	*
	======*/
	function eventchamp_container_before() {
		echo '<div class="container">';
	}

	function eventchamp_container_after() {
		echo '</div>';
	}