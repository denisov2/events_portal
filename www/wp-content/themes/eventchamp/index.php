<?php
/*
	* The template for displaying archive
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
						eventchamp_archive_post_list();
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