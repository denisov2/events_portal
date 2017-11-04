<?php
	/*======
	*
	* Theme After Setup Start
	*
	======*/
function eventchamp_footer_srn() {
		$hide_footer = ot_get_option( 'hide_footer' );
		$default_footer_style = ot_get_option( 'default_footer_style' );
		$page_footer_style_1 = ot_get_option( 'page_footer_style_1' );
		$page_footer_style_2 = ot_get_option( 'page_footer_style_1' );	
		$page_footer_style_2_srn = ot_get_option( 'page_footer_style_1' );
		
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

			function eventchamp_copyright_srn() {
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
			
			function eventchamp_footerstyle1_srn() {
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
								
								<?php wp_reset_postdata(); ?>
							</div>
							<?php eventchamp_copyright_srn(); ?>
						<?php eventchamp_container_after(); ?>
					</footer>
				<?php
			}
			
			function eventchamp_footerstyle2_srn() {
				$page_footer_style_2 = ot_get_option( 'page_footer_style_1' );
			
				?>
					<footer class="footer footer-style2 <?php echo esc_attr( $footer_gap_status ); ?>" id="Footer">
						<?php eventchamp_container_before(); ?>
							<div class="footer-content">
							
							
								<?php wp_reset_postdata(); ?>
							</div>
							<?php eventchamp_copyright_srn(); ?>
						<?php eventchamp_container_after(); ?>
					</footer>
				<?php
			}
			
			if( !$footer_status == 'off' or $footer_status == "on" ) {
			
				if( !$page_footer_style_1 == '0' and !empty( $page_footer_style_1  ) or !$page_footer_style_2 == '0' and !empty( $page_footer_style_2  ) ) {
					
					
				
				} else {?>
					<footer class="footer footer-style2 <?php echo esc_attr( $footer_gap_status ); ?>" id="Footer">
						<?php eventchamp_container_before(); ?>
							<div class="footer-content">
								
								
								
								
								<?php wp_reset_postdata(); ?>
							</div>
							<?php eventchamp_copyright_srn(); ?>
						<?php eventchamp_container_after(); ?>
					</footer>
					<?php
				}
			} else {
			}
			
		} else {
		}
	}