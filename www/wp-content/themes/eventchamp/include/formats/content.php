<?php
/*
	* The template used for displaying single content
*/
?>

<div class="post-list post-content-list">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-wrapper">
			<?php eventchamp_featured_image_post( $post_id = get_the_ID() ); ?>
			<div class="post-content-body">
				<?php the_content(); ?>
			</div>
			<?php
				$post_post_share_buttons = ot_get_option( 'post_post_share_buttons' );
				$post_post_tags = ot_get_option( 'post_post_tags' );
				if ( !$post_post_tags == 'off' or $post_post_tags == 'on' or !$post_post_share_buttons == 'off' or $post_post_share_buttons == 'on' ) { 
			?>
				<div class="post-content-footer">
					<?php
						$post_post_information = ot_get_option( 'post_post_information' );
						if ( !$post_post_information == 'off' or $post_post_information == 'on' ) {
							$output = "";
							$post_id = get_the_ID();
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
							echo $output;
						}

						wp_link_pages(
							array(
								'before' => '<div class="post-page-wrapper"><span class="post-page-wrapper-title">' . esc_html__( 'Pages:', 'eventchamp' ) . '</span>',
								'after' => '</div>',
								'link_before' => '<span>',
								'link_after' => '</span>',
							)
						);

						if ( !$post_post_share_buttons == 'off' or $post_post_share_buttons == 'on' ) {
							echo eventchamp_social_share();
						}

						if ( !$post_post_tags == 'off' or $post_post_tags == 'on' ) {
							$tags_title = esc_html__( 'Tags:', 'eventchamp' );
							the_tags( '<div class="post-tags"><div class="title">' . $tags_title . '</div><span>', '</span><span>', '</span></div>' );
						}
					?>
				</div>
			<?php } ?>
		</div>
	</article>
</div>