<?php
/*
	* The template used for displaying attachment
*/
?>

<div class="post-list post-content-list">
	<article id="attachment-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-wrapper">
			<div class="post-content">
				<div class="post-content-body">
					<p><?php echo wp_get_attachment_link( get_the_ID(), 'full', true, true ); ?></p>
					<?php the_content(); ?>
				</div>
				<?php
					$attachment_social_share = ot_get_option( 'attachment_social_share' );
					if ( !$attachment_social_share == 'off' or $attachment_social_share == 'on' ) {
						echo '<div class="post-content-footer">';
							eventchamp_social_share();
						echo '</div>';
					}
				?>
			</div>
		</div>
	</article>
</div>