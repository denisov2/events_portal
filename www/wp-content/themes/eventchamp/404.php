<?php
/*
	* The template for displaying 404 page
*/
get_header(); ?>

	<?php eventchamp_sub_content_before(); ?>
		<?php eventchamp_container_before(); ?>
			<div class="content-title-element dark size1">
				<div class="title"><?php echo esc_html__( '404', 'eventchamp' ); ?> <span><?php echo esc_html__( 'Page', 'eventchamp' ); ?></span></div>
				<div class="separate"><i class="fa fa-cubes" aria-hidden="true"></i></div>
				<div class="description"><?php echo esc_html__( 'Page not found! The page you are looking for cannot be found.', 'eventchamp' ); ?></div>
			</div>
		<?php eventchamp_container_after(); ?>
	<?php eventchamp_sub_content_after(); ?>
	
<?php get_footer();
