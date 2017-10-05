<?php
/**
	* The template for displaying woocommerce single
*/
get_header(); ?>

	<?php eventchamp_sub_content_before(); ?>
		<?php eventchamp_container_before(); ?>
			<?php eventchamp_row_before(); ?>
				<?php eventchamp_content_area_before(); ?>
					<div class="page-content">
						<?php woocommerce_content(); ?>
					</div>
				<?php eventchamp_content_area_after(); ?>					
				<?php get_sidebar( 'shop' ); ?>				
			<?php eventchamp_row_after(); ?>
		<?php eventchamp_container_after(); ?>
	<?php eventchamp_sub_content_after(); ?>
	
<?php get_footer();