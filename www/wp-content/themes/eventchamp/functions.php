<?php
	define( 'EVENTCHAMP_VERSION', '1.3.9' );
	include ( get_template_directory() . '/include/core.php');
	include ( get_template_directory() . '/include/admin.php');
	include ( get_template_directory() . '/include/widgets.php');
	include ( get_template_directory() . '/include/customize.php');
	include  (get_template_directory() . '/include/tgm.php' );

	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
	add_filter( 'ot_theme_mode', '__return_true' );
	if ( ! class_exists( 'OT_Loader' ) ) {
		require get_template_directory() .'/include/admin/ot-loader.php';
	}