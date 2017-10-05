<?php
/**
	* The template for displaying attachment
*/
get_header(); ?>

	<?php eventchamp_sub_content_before(); ?>
		<?php eventchamp_archive_title(); ?>
		<?php eventchamp_container_before(); ?>
			<?php eventchamp_row_before(); ?>
				<?php eventchamp_content_area_before(); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'include/formats/content-attachment' ); ?>
					<?php endwhile; ?>
					<?php
						$attachment_comment_area = ot_get_option( 'attachment_comment_area' );
						if( $attachment_comment_area == "on" or !$attachment_comment_area == "off" ) {
							while ( have_posts() ) : the_post(); 
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							endwhile;
						}
					?>
				<?php eventchamp_content_area_after(); ?>
				<?php get_sidebar(); ?>
			<?php eventchamp_row_after(); ?>
		<?php eventchamp_container_after(); ?>
	<?php eventchamp_sub_content_after(); ?>

<?php get_footer();