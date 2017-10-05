<?php
/**
	* The template for displaying single
*/
get_header(); ?>

	<?php eventchamp_sub_content_before(); ?>
		<?php
			$post_post_title_each = get_post_meta( get_the_ID(), 'page_title', true );
			$post_post_title = ot_get_option( 'post_post_title' );
			if( !$post_post_title == 'off' or $post_post_title == 'on' ) {
				if( !$post_post_title_each == 'off' or $post_post_title_each == 'on' ) {
					eventchamp_archive_title();
				}
			}
		?>
	
		<?php eventchamp_container_before(); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php eventchamp_row_before(); ?>
					<?php eventchamp_post_content_before(); ?>
						<?php
							get_template_part( 'include/formats/content', get_post_format() );
							echo '<div class="post-content-elements">';
								$post_author_box = ot_get_option( 'post_author_box' );
								if ( !$post_author_box == 'off' or $post_author_box == 'on' ) {
									eventchamp_author_box();
								}

								eventchamp_related_posts();
								eventchamp_post_navigation();

								$post_post_comment_area = ot_get_option( 'post_post_comment_area' );
								if( $post_post_comment_area == "on" or !$post_post_comment_area == "off" ) {
									if ( comments_open() || get_comments_number() ) {
										comments_template();
									}
								}
							echo '</div>';
						?>
					<?php eventchamp_content_area_after(); ?>
					<?php get_sidebar(); ?> 
				<?php eventchamp_row_after(); ?>
			<?php endwhile; ?>
		<?php eventchamp_container_after(); ?>
	<?php eventchamp_sub_content_after(); ?>

<?php get_footer();