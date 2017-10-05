<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
		<?php eventchamp_loader(); ?>
		<?php eventchamp_wrapper_before(); ?>
			<?php eventchamp_content_before(); ?>
				<?php eventchamp_header(); ?>
				<?php eventchamp_mobile_header(); ?>