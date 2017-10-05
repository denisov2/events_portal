<?php
/*
	* The template for displaying event category
*/
get_header(); ?>
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
						echo '<div class="event-list column-2">';
							while ( have_posts() ) : the_post();
								echo eventchamp_event_list_style_1( $post_id = get_the_ID(), $image = "true", $category = "true", $date = "true", $location = "true", $excerpt = "true", $status = "true", $price = "true" );
							endwhile;
						echo '</div>';
						eventchamp_pagination();		
					} else {
						get_template_part( 'include/formats/content', 'none' );
					}
					?>
				<?php eventchamp_content_area_after(); ?>
				
				<?php get_sidebar(); ?> 
			<?php eventchamp_row_after(); ?>
			
		<?php eventchamp_container_after(); ?>
	<?php eventchamp_sub_content_after(); ?>
	
<?php get_footer();