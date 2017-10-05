<?php
if(class_exists('Woocommerce') ) {
	if ( is_woocommerce() ) {

		if ( is_active_sidebar( 'shop-sidebar' ) )  {
			eventchamp_sidebar_before();
				dynamic_sidebar("shop-sidebar");
			eventchamp_sidebar_after(); 
		}
		
	} elseif ( is_attachment() ) {

		$attachment_sidebar_select = ot_get_option( 'attachment_sidebar_select' );

		if ( !empty( $attachment_sidebar_select) ) {
			if ( is_active_sidebar( $attachment_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $attachment_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_post_type_archive( 'event' ) ) {

		$event_sidebar_select = ot_get_option( 'event_sidebar_select' );

		if ( !empty( $event_sidebar_select) ) {
			if ( is_active_sidebar( $event_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $event_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_post_type_archive( 'venue' ) ) {

		$venue_sidebar_select = ot_get_option( 'venue_sidebar_select' );

		if ( !empty( $venue_sidebar_select) ) {
			if ( is_active_sidebar( $venue_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $venue_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_post_type_archive( 'speaker' ) ) {

		$speaker_sidebar_select = ot_get_option( 'speaker_sidebar_select' );

		if ( !empty( $speaker_sidebar_select) ) {
			if ( is_active_sidebar( $speaker_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $speaker_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif( is_single() ) {
		
		$post_id = get_the_ID();
		$post_sidebar_select = ot_get_option( 'post_sidebar_select' );
		$post_sidebar = get_post_meta( $post_id, 'post_sidebar_select', true );
		
		if( !empty( $post_sidebar ) ) {
			if ( is_active_sidebar( $post_sidebar ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $post_sidebar ); 
				eventchamp_sidebar_after();
			}
			
		} elseif ( !empty( $post_sidebar_select) ) {
			if ( is_active_sidebar( $post_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $post_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	}  elseif( is_page() ) {
		
		$post_id = get_the_ID();
		$page_sidebar_select = ot_get_option( 'page_sidebar_select' );
		$post_sidebar = get_post_meta( $post_id, 'page_sidebar_select', true );
		
		if( !empty( $post_sidebar ) ) {
			if ( is_active_sidebar( $post_sidebar ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $post_sidebar ); 
				eventchamp_sidebar_after();
			}
			
		} elseif ( !empty( $page_sidebar_select) ) {
			if ( is_active_sidebar( $page_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $page_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}

	} elseif ( is_category() ) {
		
		$cat = get_queried_object();
		$cat_id = $cat->term_id;
		$category_sidebar_settings = ot_get_option('sidebar_select_'. $cat_id); 

		if( !empty( $category_sidebar_settings ) ) {
			if ( is_active_sidebar( $category_sidebar_settings ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $category_sidebar_settings ); 
				eventchamp_sidebar_after();
			}
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	}elseif ( is_tag() ) {

		$tag_sidebar_select = ot_get_option( 'tag_sidebar_select' );

		if ( !empty( $tag_sidebar_select) ) {
			if ( is_active_sidebar( $tag_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $tag_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_author() ) {

		$author_sidebar_select = ot_get_option( 'author_sidebar_select' );

		if ( !empty( $author_sidebar_select) ) {
			if ( is_active_sidebar( $author_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $author_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_search() ) {

		$search_sidebar_select = ot_get_option( 'search_sidebar_select' );

		if ( !empty( $search_sidebar_select) ) {
			if ( is_active_sidebar( $search_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $search_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_archive() ) {

		$archive_sidebar_select = ot_get_option( 'archive_sidebar_select' );

		if ( !empty( $archive_sidebar_select) ) {
			if ( is_active_sidebar( $archive_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $archive_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) )  {
			eventchamp_post_sidebar_before();
				dynamic_sidebar("general-sidebar");
			eventchamp_sidebar_after(); 			
		}
	}
} else {
	if ( is_attachment() ) {

		$attachment_sidebar_select = ot_get_option( 'attachment_sidebar_select' );

		if ( !empty( $attachment_sidebar_select) ) {
			if ( is_active_sidebar( $attachment_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $attachment_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_post_type_archive( 'event' ) ) {

		$event_sidebar_select = ot_get_option( 'event_sidebar_select' );

		if ( !empty( $event_sidebar_select) ) {
			if ( is_active_sidebar( $event_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $event_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_post_type_archive( 'venue' ) ) {

		$venue_sidebar_select = ot_get_option( 'venue_sidebar_select' );

		if ( !empty( $venue_sidebar_select) ) {
			if ( is_active_sidebar( $venue_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $venue_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_post_type_archive( 'speaker' ) ) {

		$speaker_sidebar_select = ot_get_option( 'speaker_sidebar_select' );

		if ( !empty( $speaker_sidebar_select) ) {
			if ( is_active_sidebar( $speaker_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $speaker_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif( is_single() ) {
		
		$post_id = get_the_ID();
		$post_sidebar_select = ot_get_option( 'post_sidebar_select' );
		$post_sidebar = get_post_meta( $post_id, 'post_sidebar_select', true );
		
		if( !empty( $post_sidebar ) ) {
			if ( is_active_sidebar( $post_sidebar ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $post_sidebar ); 
				eventchamp_sidebar_after();
			}
			
		} elseif ( !empty( $post_sidebar_select) ) {
			if ( is_active_sidebar( $post_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $post_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	}  elseif( is_page() ) {
		
		$post_id = get_the_ID();
		$page_sidebar_select = ot_get_option( 'page_sidebar_select' );
		$post_sidebar = get_post_meta( $post_id, 'page_sidebar_select', true );
		
		if( !empty( $post_sidebar ) ) {
			if ( is_active_sidebar( $post_sidebar ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $post_sidebar ); 
				eventchamp_sidebar_after();
			}
			
		} elseif ( !empty( $page_sidebar_select) ) {
			if ( is_active_sidebar( $page_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $page_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}

	} elseif ( is_category() ) {
		
		$cat = get_queried_object();
		$cat_id = $cat->term_id;
		$category_sidebar_settings = ot_get_option('sidebar_select_'. $cat_id); 

		if( !empty( $category_sidebar_settings ) ) {
			if ( is_active_sidebar( $category_sidebar_settings ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $category_sidebar_settings ); 
				eventchamp_sidebar_after();
			}
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	}elseif ( is_tag() ) {

		$tag_sidebar_select = ot_get_option( 'tag_sidebar_select' );

		if ( !empty( $tag_sidebar_select) ) {
			if ( is_active_sidebar( $tag_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $tag_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_author() ) {

		$author_sidebar_select = ot_get_option( 'author_sidebar_select' );

		if ( !empty( $author_sidebar_select) ) {
			if ( is_active_sidebar( $author_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $author_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_search() ) {

		$search_sidebar_select = ot_get_option( 'search_sidebar_select' );

		if ( !empty( $search_sidebar_select) ) {
			if ( is_active_sidebar( $search_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $search_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} elseif ( is_archive() ) {

		$archive_sidebar_select = ot_get_option( 'archive_sidebar_select' );

		if ( !empty( $archive_sidebar_select) ) {
			if ( is_active_sidebar( $archive_sidebar_select ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar( $archive_sidebar_select ); 
				eventchamp_sidebar_after();
			}
			
		} else {
			if ( is_active_sidebar( 'general-sidebar' ) )  {
				eventchamp_post_sidebar_before();
					dynamic_sidebar("general-sidebar");
				eventchamp_sidebar_after(); 			
			}
		}
		
	} else {
		if ( is_active_sidebar( 'general-sidebar' ) )  {
			eventchamp_post_sidebar_before();
				dynamic_sidebar("general-sidebar");
			eventchamp_sidebar_after(); 			
		}
	}
}
