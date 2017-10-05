<?php
	/*======
	*
	* Theme Options
	*
	======*/
	function eventchamp_theme_options() {
		if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
		return false;

		$saved_settings = get_option( ot_settings_id(), array() );
		
		$custom_settings = array(
			'contextual_help' => array(
				'content' => array(
					array(
						'id' => 'option_types_help',
						'title' => esc_html__( 'Header Settings', 'eventchamp' ),
						'content' => '<p>' . esc_html__( 'Help content goes here!', 'eventchamp' ) . '</p>'
					)
				),
				'sidebar' => '<p>' . esc_html__( 'Sidebar content goes here!', 'eventchamp' ) . '</p>'
			),
			
			'sections' => array(
				array(
					'title' => '<span class="dashicons dashicons-admin-site"></span>' . esc_html__( 'General', 'eventchamp' ),
					'id' => 'general'
				),
				array(
					'title' => '<span class="dashicons dashicons-editor-kitchensink"></span>' . esc_html__( 'Header', 'eventchamp' ),
					'id' => 'header'
				),
				array(
					'title' => '<span class="dashicons dashicons-image-rotate-left"></span>' . esc_html__( 'Footer', 'eventchamp' ),
					'id' => 'footer'
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-appearance"></span>' . esc_html__( 'Color', 'eventchamp' ),
					'id' => 'colors'
				),
				array(
					'title' => '<span class="dashicons dashicons-editor-justify"></span>' . esc_html__( 'Typography', 'eventchamp' ),
					'id' => 'fonts'
				),
				array(
					'title' => '<span class="dashicons dashicons-media-text"></span>' . esc_html__( 'Posts', 'eventchamp' ),
					'id' => 'posts'
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-page"></span>' . esc_html__( 'Pages', 'eventchamp' ),
					'id' => 'pages'
				),
				array(
					'title' => '<span class="dashicons dashicons-archive"></span>' . esc_html__( 'Archives', 'eventchamp' ),
					'id' => 'archives'
				),
				array(
					'title' => '<span class="dashicons dashicons-calendar-alt"></span>' . esc_html__( 'Events', 'eventchamp' ),
					'id' => 'events'
				),
				array(
					'title' => '<span class="dashicons dashicons-location"></span>' . esc_html__( 'Venues', 'eventchamp' ),
					'id' => 'venues'
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-users"></span>' . esc_html__( 'Speakers', 'eventchamp' ),
					'id' => 'speakers'
				),
				array(
					'title' => '<span class="dashicons dashicons-schedule"></span>' . esc_html__( 'Schedule', 'eventchamp' ),
					'id' => 'schedule'
				),
				array(
					'title' => '<span class="dashicons dashicons-share"></span>' . esc_html__( 'Social Media', 'eventchamp' ),
					'id' => 'socialmedia'
				),
				array(
					'title' => '<span class="dashicons dashicons-cart"></span>' . esc_html__( 'WooCommerce', 'eventchamp' ),
					'id' => 'woocommerce'
				),
				array(
					'title' => '<span class="dashicons dashicons-hammer"></span>' . esc_html__( 'Custom Codes', 'eventchamp' ),
					'id' => 'customcodes'
				),
			),

			'settings' => array(
				/*====== General ======*/
				array(
					'label' => esc_html__( 'General', 'eventchamp' ),
					'id' => 'general_tab1',
					'type' => 'tab',
					'section' => 'general'
				),
					array(
						'label' => esc_html__( 'General Sidebar Position', 'eventchamp' ),
						'id' => 'sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general sidebar position.', 'eventchamp' ),
						'std' => 'right',
						'section' => 'general'
					),
					array(
						'label' => esc_html__( 'Loader Status', 'eventchamp' ),
						'id' => 'eventchamp_loader',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can select loader status.', 'eventchamp' ),
						'std' => 'off',
						'section' => 'general'
					),
					array(
						'label' => esc_html__( 'Loader Style', 'eventchamp' ),
						'id' => 'loader_style',
						'type' => 'radio',
						'desc' => esc_html__( 'You can select style for loader.', 'eventchamp' ),
						'std' => 'style1',
						'section' => 'general',
						'condition' => 'eventchamp_loader:is(on)',
						'choices' => array(
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => 'style1'
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => 'style2'
							),
							array(
								'label' => esc_html__( 'Style 3', 'eventchamp' ),
								'value' => 'style3'
							),
							array(
								'label' => esc_html__( 'Style 4', 'eventchamp' ),
								'value' => 'style4'
							),
						),
					),
					array(
						'label' => esc_html__( 'Google Map API', 'eventchamp' ),
						'id' => 'googlemapapi',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter your Google Map API.', 'eventchamp' ),
						'section' => 'general'
					),
					array(
						'label' => esc_html__( 'Boxed Layout', 'eventchamp' ),
						'id' => 'eventchamp_boxed',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can select boxed layout.', 'eventchamp' ),
						'std' => 'off',
						'section' => 'general'
					),
				array(
					'label' => esc_html__( 'Create Sidebar', 'eventchamp' ),
					'id' => 'general_tab4',
					'type' => 'tab',
					'section' => 'general'
				),
					array(
						'id' => 'custom_sidebars',
						'desc' => '',
						'label' => esc_html__('Create Sidebar','eventchamp'),
						'type' => 'list-item',
						'section' => 'general',
						'settings' => array(
							array(
								'label' => esc_html__('ID','eventchamp'),
								'id' => 'id',
								'type' => 'text',
								'desc' => esc_html__('Please write a lowercase id, with <strong>no spaces</strong>','eventchamp'),
							)
						)
					),

				/*====== Header ======*/
				array(
					'label' => esc_html__( 'Header Status', 'eventchamp' ),
					'id' => 'hide_header',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide header.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'header'
				),
				array(
					'label' => esc_html__( 'General Header Style', 'eventchamp' ),
					'id' => 'default_header_style',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general header style.', 'eventchamp' ),
					'std' => 'header-style-1',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo', 'eventchamp' ),
					'id' => 'eventchamp_logo',
					'type' => 'upload',
					'desc' => esc_html__( 'You can upload site logo for header.', 'eventchamp' ),
					'std' => '' . get_template_directory_uri() . '/include/assets/img/logo.png' . '',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Alternative Logo', 'eventchamp' ),
					'id' => 'eventchamp_logo_alternative',
					'type' => 'upload',
					'desc' => esc_html__( 'You can upload alternative site logo for header.', 'eventchamp' ),
					'std' => '' . get_template_directory_uri() . '/include/assets/img/logo-alternative.png' . '',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo Height', 'eventchamp' ),
					'id' => 'logo_height',
					'type' => 'measurement',
					'desc' => esc_html__( 'You can enter logo height for header. Recommended type px.', 'eventchamp' ),
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo Weight', 'eventchamp' ),
					'id' => 'logo_width',
					'type' => 'measurement',
					'desc' => esc_html__( 'You can enter logo weight for header. Recommended type px.', 'eventchamp' ),
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Logo Top Margin', 'eventchamp' ),
					'id' => 'header_logo_top_margin',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter top margin for logo.', 'eventchamp' ),
					'std' => '',
					'min_max_step'=> '0,500,1',
					'section' => 'header'
				),
				array(
					'label' => esc_html__( 'Menu Top Margin for Style 1 and 2', 'eventchamp' ),
					'id' => 'header_menu_top_margin',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter top margin for style 1 and 2.', 'eventchamp' ),
					'std' => '',
					'min_max_step'=> '0,500,1',
					'section' => 'header'
				),
				array(
					'label' => esc_html__( 'Fixed Header', 'eventchamp' ),
					'id' => 'header_fixed',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can make fixed header.', 'eventchamp' ),
					'std' => 'off',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'Social Media', 'eventchamp' ),
					'id' => 'header_social_media',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide social links from header.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),
				array(
					'label' => esc_html__( 'User Box', 'eventchamp' ),
					'id' => 'header_user_box',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide user box for header.', 'eventchamp' ),
					'std' => 'off',
					'section' => 'header',
					'condition' => 'hide_header:is(on)'
				),

				/*====== Footer ======*/
				array(
					'label' => esc_html__( 'Footer Status', 'eventchamp' ),
					'id' => 'hide_footer',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide footer.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'footer'
				),
				array(
					'label' => esc_html__( 'General Footer Style', 'eventchamp' ),
					'id' => 'default_footer_style',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general footer style.', 'eventchamp' ),
					'std' => 'footer-style-1',
					'section' => 'footer',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Footer Page', 'eventchamp' ),
					'id' => 'page_footer_style_1',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select page for footer.', 'eventchamp' ),
					'section' => 'footer',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Background for Footer Style 1', 'eventchamp' ),
					'id' => 'eventchamp_footer_bg',
					'type' => 'upload',
					'desc' => esc_html__( 'You can upload background for footer style 1.', 'eventchamp' ),
					'std' => '' . get_template_directory_uri() . '/include/assets/img/footer-style-1.jpg' . '',
					'section' => 'footer',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Background for Footer Style 2', 'eventchamp' ),
					'id' => 'eventchamp_footer_bg_style_2',
					'type' => 'upload',
					'desc' => esc_html__( 'You can upload background for footer style 2.', 'eventchamp' ),
					'std' => '' . get_template_directory_uri() . '/include/assets/img/footer-style-2.jpg' . '',
					'section' => 'footer',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Copyright Text', 'eventchamp' ),
					'id' => 'footer_copyright_text',
					'type' => 'text',
					'desc' => esc_html__( 'You can enter copyright text.', 'eventchamp' ),
					'section' => 'footer',
					'condition' => 'hide_footer:is(on)'
				),
				array(
					'label' => esc_html__( 'Footer Logo', 'eventchamp' ),
					'id' => 'hide_footer_logo',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide footer logo.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'footer'
				),
				array(
					'label' => esc_html__( 'Logo Upload', 'eventchamp' ),
					'id' => 'eventchamp_footer_logo',
					'type' => 'upload',
					'desc' => esc_html__( 'You can upload logo for footer.', 'eventchamp' ),
					'std' => '' . get_template_directory_uri() . '/include/assets/img/logo-footer.png' . '',
					'section' => 'footer',
					'condition' => 'hide_footer:is(on),hide_footer_logo:is(on)'
				),

				/*====== Colors ======*/
				array(
					'label' => esc_html__( 'General', 'eventchamp' ),
					'id' => 'colors_tab1',
					'type' => 'tab',
					'section' => 'colors'
				),
					array(
						'label' => esc_html__( 'Body Background ', 'eventchamp' ),
						'id' => 'body_background',
						'type' => 'background',
						'desc' => esc_html__( 'This is body background of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Wrapper Background', 'eventchamp' ),
						'id' => 'wrapper_background',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is wrapper background color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Theme Main Color', 'eventchamp' ),
						'id' => 'theme_main_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is main color one of site. By setting a color here, all of your elements will use this color instead of default yellow color.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Theme Alternative Color', 'eventchamp' ),
						'id' => 'theme_alternative_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is alternative color one of site. By setting a color here, all of your elements will use this color instead of default purple color.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Gradient Code', 'eventchamp' ),
						'id' => 'theme_gradient',
						'type' => 'css',
						'desc' => esc_html__( 'This is theme gradient color of site. You can look documentation file to create a gradient.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Link Color', 'eventchamp' ),
						'id' => 'link_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is link color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Link Hover Color', 'eventchamp' ),
						'id' => 'link_hover_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is link hover color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Heading Color', 'eventchamp' ),
						'id' => 'heading_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is heading(h1, h2, h3, h4, h5 and h6) color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Input Border Color', 'eventchamp' ),
						'id' => 'input_border_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is input border color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Input Background Color', 'eventchamp' ),
						'id' => 'input_background_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is input background color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Input Placeholder Color', 'eventchamp' ),
						'id' => 'input_placeholder_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is input placeholder color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Button Background Color', 'eventchamp' ),
						'id' => 'button_background_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is button background color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Button Hover Background Color', 'eventchamp' ),
						'id' => 'button_hover_background_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is button hover background color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Button Hover Text Color', 'eventchamp' ),
						'id' => 'button_hover_text_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is button hover text color of site.', 'eventchamp' ),
						'section' => 'colors'
					),
				array(
					'label' => esc_html__( 'Header', 'eventchamp' ),
					'id' => 'colors_tab2',
					'type' => 'tab',
					'section' => 'colors'
				),
					array(
						'label' => esc_html__( 'Background for Header Style 1', 'eventchamp' ),
						'id' => 'header_style_1_background_color',
						'type' => 'colorpicker-opacity',
						'desc' => esc_html__( 'This is background color for header style 1.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Link Color for Header Style 1 ', 'eventchamp' ),
						'id' => 'header_style_1_link_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is link color for header style 1.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Social Links Color for Header Style 1', 'eventchamp' ),
						'id' => 'header_style_1_social_links_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is social links color for header style 1.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Background for Header Style 2', 'eventchamp' ),
						'id' => 'header_style_2_background_color',
						'type' => 'colorpicker-opacity',
						'desc' => esc_html__( 'This is background color for header style 1.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Link Color for Header Style 2', 'eventchamp' ),
						'id' => 'header_style_2_link_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is link color for header style 2.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Social Links Color for Header Style 2', 'eventchamp' ),
						'id' => 'header_style_2_social_links_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is social links color for header style 2.', 'eventchamp' ),
						'section' => 'colors'
					),
				array(
					'label' => esc_html__( 'Footer', 'eventchamp' ),
					'id' => 'colors_tab3',
					'type' => 'tab',
					'section' => 'colors'
				),
					array(
						'label' => esc_html__( 'Background Color for Footer Style 1', 'eventchamp' ),
						'id' => 'footer_background_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is background of footer style 1.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Text Color for Copyright', 'eventchamp' ),
						'id' => 'copyright_text_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is text color of copyright.', 'eventchamp' ),
						'section' => 'colors'
					),
				array(
					'label' => esc_html__( 'Widget & Sidebar', 'eventchamp' ),
					'id' => 'colors_tab4',
					'type' => 'tab',
					'section' => 'colors'
				),
					array(
						'label' => esc_html__( 'Title Color for Sidebar Widgets', 'eventchamp' ),
						'id' => 'sidebar_widget_title_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is widget title color.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'label' => esc_html__( 'Border Color for Sidebar Widgets Title', 'eventchamp' ),
						'id' => 'sidebar_widget_title_border_color',
						'type' => 'colorpicker',
						'desc' => esc_html__( 'This is widget title border color.', 'eventchamp' ),
						'section' => 'colors'
					),
				
				/*====== Typography ======*/
				array(
					'label' => esc_html__( 'General', 'eventchamp' ),
					'id' => 'fonts_tab1',
					'type' => 'tab',
					'section' => 'fonts'
				),
					array(
						'label'       => esc_html__('Latin Extended', 'eventchamp'),
						'id'          => 'font_subsets_latin',
						'type'        => 'on_off',
						'desc'        =>  esc_html__( 'You can select character status for Latin Extended.', 'eventchamp' ),
						'section'     => 'fonts',
						'std'     => 'off'
					),
					array(
						'label'       => esc_html__('Cyrillic Extended', 'eventchamp'),
						'id'          => 'font_subsets_cyrillic',
						'type'        => 'on_off',
						'desc'        =>  esc_html__( 'You can select character status for Cyrillic.', 'eventchamp' ),
						'section'     => 'fonts',
						'std'     => 'off'
					),
					array(
						'label'       => esc_html__('Greek Extended', 'eventchamp'),
						'id'          => 'font_subsets_greek',
						'type'        => 'on_off',
						'desc'        =>  esc_html__( 'You can select character status for Greek language.', 'eventchamp' ),
						'section'     => 'fonts',
						'std'     => 'off'
					),
					array(
						'label' => esc_html__( 'Theme Main Font', 'eventchamp' ),
						'id' => 'theme_main_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font of theme.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Body', 'eventchamp' ),
						'id' => 'body_text',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font of body.', 'eventchamp' ),
						'section' => 'fonts',
						'std' => '',
					),
					array(
						'label' => esc_html__( 'H1', 'eventchamp' ),
						'id' => 'h1_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h1.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H2', 'eventchamp' ),
						'id' => 'h2_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h2.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H3', 'eventchamp' ),
						'id' => 'h3_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h3.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H4', 'eventchamp' ),
						'id' => 'h4_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h4.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H5', 'eventchamp' ),
						'id' => 'h5_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h5.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'H6', 'eventchamp' ),
						'id' => 'h6_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for h6.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Input Font', 'eventchamp' ),
						'id' => 'input_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for inputs.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Input Placeholder Font', 'eventchamp' ),
						'id' => 'input_placeholder_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for input placeholder.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Button Font', 'eventchamp' ),
						'id' => 'button_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for button.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Post Content Font', 'eventchamp' ),
						'id' => 'post_posts_content_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font of post content.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Page Content Font', 'eventchamp' ),
						'id' => 'page_content_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font of page content.', 'eventchamp' ),
						'section' => 'fonts'
					),
				array(
					'label' => esc_html__( 'Header', 'eventchamp' ),
					'id' => 'fonts_tab2',
					'type' => 'tab',
					'section' => 'fonts'
				),
					array(
						'label' => esc_html__( 'Header Font', 'eventchamp' ),
						'id' => 'header_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for header.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Header Menu Link Font', 'eventchamp' ),
						'id' => 'header_menu_link_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for header menu link.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( 'Breadcrumb Font', 'eventchamp' ),
						'id' => 'breadcrumb_font',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font for breadcrumb.', 'eventchamp' ),
						'section' => 'fonts'
					),
				array(
					'label' => esc_html__( '404 Page', 'eventchamp' ),
					'id' => 'fonts_tab3',
					'type' => 'tab',
					'section' => 'fonts'
				),
					array(
						'label' => esc_html__( '404 Page Title', 'eventchamp' ),
						'id' => '404_page_title',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font of 404 page title.', 'eventchamp' ),
						'section' => 'fonts'
					),
					array(
						'label' => esc_html__( '404 Page Text', 'eventchamp' ),
						'id' => '404_page_text',
						'type' => 'typography',
						'desc' => esc_html__( 'You can select font of 404 page text.', 'eventchamp' ),
						'section' => 'fonts'
					),

				/*====== Posts ======*/
				array(
					'label' => esc_html__( 'General Post Sidebar Position', 'eventchamp' ),
					'id' => 'post_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general sidebar position of posts.', 'eventchamp' ),
					'std' => 'right',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'General Post Sidebar Select', 'eventchamp' ),
					'id' => 'post_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select general sidebar of posts.', 'eventchamp' ),
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Information', 'eventchamp' ),
					'id' => 'post_post_information',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post information of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Category Name', 'eventchamp' ),
					'id' => 'post_post_category_name',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post category name of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Image', 'eventchamp' ),
					'id' => 'post_post_image',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post image of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Share Buttons', 'eventchamp' ),
					'id' => 'post_post_share_buttons',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post share buttons of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Tags', 'eventchamp' ),
					'id' => 'post_post_tags',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post tags of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Title', 'eventchamp' ),
					'id' => 'post_post_title',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post title of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Post Navigation', 'eventchamp' ),
					'id' => 'post_post_navigation',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide post navigation of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Related Posts', 'eventchamp' ),
					'id' => 'post_related_posts',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide related posts of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Related Posts Column', 'eventchamp' ),
					'id' => 'post_related_posts_column',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter related posts column.', 'eventchamp' ),
					'std' => '3',
					'min_max_step'=> '2,3,1',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Author Biography', 'eventchamp' ),
					'id' => 'post_author_biography',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide author biography of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),
				array(
					'label' => esc_html__( 'Comment Area', 'eventchamp' ),
					'id' => 'post_post_comment_area',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide comment area of post.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'posts'
				),

				/*====== Pages ======*/
				array(
					'label' => esc_html__( 'General Page Sidebar Position', 'eventchamp' ),
					'id' => 'page_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general sidebar position of page.', 'eventchamp' ),
					'std' => 'nosidebar',
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'General Page Sidebar Select', 'eventchamp' ),
					'id' => 'page_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select sidebar of page.', 'eventchamp' ),
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Page Title', 'eventchamp' ),
					'id' => 'page_title',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide page title of page.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Page Title Background', 'eventchamp' ),
					'id' => 'page_title_background',
					'type' => 'upload',
					'desc' => esc_html__( 'You can upload background for page title.', 'eventchamp' ),
					'std' => '' . get_template_directory_uri() . '/include/assets/img/breadcrumbs-bg.jpg' . '',
					'section' => 'pages',
				),
				array(
					'label' => esc_html__( 'Comment Area', 'eventchamp' ),
					'id' => 'page_comment_area',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide comment area on pages.', 'eventchamp' ),
					'std' => 'on',
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Terms and Conditions Page', 'eventchamp' ),
					'id' => 'page_terms_and_conditions',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select page for terms and conditions.', 'eventchamp' ),
					'section' => 'pages'
				),
				array(
					'label' => esc_html__( 'Privacy Policy Page', 'eventchamp' ),
					'id' => 'page_privacy_policy',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select page for privacy policy.', 'eventchamp' ),
					'section' => 'pages'
				),

				/*====== Archives ======*/
				array(
					'label' => esc_html__( 'Category', 'eventchamp' ),
					'id' => 'blog_tab1',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'General Category Sidebar Position', 'eventchamp' ),
						'id' => 'category_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general sidebar position of category.', 'eventchamp' ),
						'std' => 'right',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'General Category Post List Style', 'eventchamp' ),
						'id' => 'blog_category_post_list_style',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general post list style of category.', 'eventchamp' ),
						'std' => 'style1',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'General Category Title', 'eventchamp' ),
						'id' => 'blog_category_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide title of category.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'archives'
					),
					array(
						'id' => 'sidebar_select',
						'desc' => '',
						'label' => esc_html__( 'Sidebar For Categories', 'eventchamp' ),
						'type' => 'sidebar_select_category',
						'section' => 'archives',
					),
				array(
					'label' => esc_html__( 'Tag', 'eventchamp' ),
					'id' => 'blog_tab3',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'Sidebar Position for Tag Archive', 'eventchamp' ),
						'id' => 'tag_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general sidebar position of tag archive.', 'eventchamp' ),
						'std' => 'right',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Sidebar Select for Tag Archive', 'eventchamp' ),
						'id' => 'tag_sidebar_select',
						'type' => 'sidebar-select',
						'desc' => esc_html__( 'You can select sidebar of tag archive.', 'eventchamp' ),
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Post List Style for Tag Archive', 'eventchamp' ),
						'id' => 'tag_tag_post_list_style',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select tag post list style of tag archive.', 'eventchamp' ),
						'std' => 'style1',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Title for Tag Archive', 'eventchamp' ),
						'id' => 'tag_tag_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide tag title of tag archive.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'archives'
					),
				array(
					'label' => esc_html__( 'Search', 'eventchamp' ),
					'id' => 'blog_tab4',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'Sidebar Position for Search', 'eventchamp' ),
						'id' => 'search_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select sidebar position of search page.', 'eventchamp' ),
						'std' => 'right',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Sidebar Select for Search', 'eventchamp' ),
						'id' => 'search_sidebar_select',
						'type' => 'sidebar-select',
						'desc' => esc_html__( 'You can select sidebar of search page.', 'eventchamp' ),
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Post List Style for Search', 'eventchamp' ),
						'id' => 'search_search_post_list_style',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select post list style of search page.', 'eventchamp' ),
						'std' => 'style1',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Title for Search', 'eventchamp' ),
						'id' => 'search_search_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide search title of search page.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'archives'
					),
				array(
					'label' => esc_html__( 'Archive', 'eventchamp' ),
					'id' => 'blog_tab5',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'Sidebar Position for Archives', 'eventchamp' ),
						'id' => 'archive_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select sidebar position of archives.', 'eventchamp' ),
						'std' => 'right',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Sidebar Select for Archives', 'eventchamp' ),
						'id' => 'archive_sidebar_select',
						'type' => 'sidebar-select',
						'desc' => esc_html__( 'You can select sidebar of archives.', 'eventchamp' ),
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Post List Style for Archives', 'eventchamp' ),
						'id' => 'archive_archive_post_list_style',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select post list style of archives.', 'eventchamp' ),
						'std' => 'style1',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Title for Archives', 'eventchamp' ),
						'id' => 'archive_eventchamp_archive_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide title of archives.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'archives'
					),
				array(
					'label' => esc_html__( 'Attachment', 'eventchamp' ),
					'id' => 'blog_tab6',
					'type' => 'tab',
					'section' => 'archives'
				),
					array(
						'label' => esc_html__( 'Sidebar Position for Attachment', 'eventchamp' ),
						'id' => 'attachment_sidebar_position',
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select general sidebar position of attachment page.', 'eventchamp' ),
						'std' => 'nosidebar',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Sidebar Select for Attachment', 'eventchamp' ),
						'id' => 'attachment_sidebar_select',
						'type' => 'sidebar-select',
						'desc' => esc_html__( 'You can select sidebar of attachment page.', 'eventchamp' ),
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Title for Attachment', 'eventchamp' ),
						'id' => 'attachment_attachment_title',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide attachment title of attachment page.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Social Share for Attachment', 'eventchamp' ),
						'id' => 'attachment_social_share',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide social share buttons of attachment page.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'archives'
					),
					array(
						'label' => esc_html__( 'Comment Area for Attachment', 'eventchamp' ),
						'id' => 'attachment_comment_area',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide comment area of attachment page.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'archives'
					),

				/*====== Events ======*/
				array(
					'label' => esc_html__( 'Sidebar Position for Event Archive', 'eventchamp' ),
					'id' => 'event_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select the sidebar position for event archive.', 'eventchamp' ),
					'std' => 'right',
					'section' => 'events'
				),
				array(
					'label' => esc_html__( 'Sidebar Select for Event Archive', 'eventchamp' ),
					'id' => 'event_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select sidebar for event archive.', 'eventchamp' ),
					'section' => 'events'
				),
				array(
					'label' => esc_html__( 'Sidebar Select for Event Details', 'eventchamp' ),
					'id' => 'event_detail_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select sidebar for event details.', 'eventchamp' ),
					'section' => 'events'
				),
				array(
					'label' => esc_html__( 'Contact Form ID', 'eventchamp' ),
					'id' => 'event_contact_form',
					'type' => 'text',
					'desc' => esc_html__( 'You can select enter contact form id for event details.', 'eventchamp' ),
					'section' => 'events'
				),
				array(
					'label' => esc_html__( 'Event Search Results Page', 'eventchamp' ),
					'id' => 'event_search_result_page',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select page for event search results.', 'eventchamp' ),
					'section' => 'events'
				),
				array(
					'label' => esc_html__( 'Ticket Package Column For Events', 'eventchamp' ),
					'id' => 'event_ticket_package_column_for_events',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter ticket package column for events.', 'eventchamp' ),
					'std' => '2',
					'min_max_step'=> '1,2,1',
					'section' => 'events'
				),
				array(
					'label' => esc_html__( 'Related Events for Event Detail', 'eventchamp' ),
					'id' => 'event_related_events',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide related events for event detail page.', 'eventchamp' ),
					'std' => 'off',
					'section' => 'events'
				),
				array(
					'label' => esc_html__( 'Event Count for Related Events', 'eventchamp' ),
					'id' => 'event_related_events_count',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter event count for related events.', 'eventchamp' ),
					'std' => '3',
					'min_max_step'=> '2,12,1',
					'section' => 'events',
					'condition' => 'event_related_events:is(on)'
				),

				/*====== Venues ======*/
				array(
					'label' => esc_html__( 'Sidebar Position for Venue Archive', 'eventchamp' ),
					'id' => 'venue_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select general sidebar position for venue archive.', 'eventchamp' ),
					'std' => 'right',
					'section' => 'venues'
				),
				array(
					'label' => esc_html__( 'Sidebar Select for Venue Archive', 'eventchamp' ),
					'id' => 'venue_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select sidebar for venue archive.', 'eventchamp' ),
					'section' => 'venues'
				),
				array(
					'label' => esc_html__( 'Search Results Page', 'eventchamp' ),
					'id' => 'venue_search_result_page',
					'type' => 'page-select',
					'desc' => esc_html__( 'You can select page for venue search results.', 'eventchamp' ),
					'section' => 'venues'
				),
				array(
					'label' => esc_html__( 'Sidebar Select for Venue Details', 'eventchamp' ),
					'id' => 'venue_detail_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select sidebar for venue details.', 'eventchamp' ),
					'section' => 'venues'
				),
				array(
					'label' => esc_html__( 'Event List for Venue Detail', 'eventchamp' ),
					'id' => 'venue_event_list_venue_detail',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide event list for venue detail page.', 'eventchamp' ),
					'std' => 'off',
					'section' => 'venues'
				),
				array(
					'label' => esc_html__( 'Event List Count for Venue Detail', 'eventchamp' ),
					'id' => 'venue_event_list_venue_detail_count',
					'type' => 'text',
					'std' => '10',
					'desc' => esc_html__( 'You can enter event list item count for venue detail.', 'eventchamp' ),
					'section' => 'venues'
				),
				array(
					'label' => esc_html__( 'Related Venues for Venue Detail', 'eventchamp' ),
					'id' => 'venue_related_venues',
					'type' => 'on_off',
					'desc' => esc_html__( 'You can hide related venues for venue detail page.', 'eventchamp' ),
					'std' => 'off',
					'section' => 'venues'
				),
				array(
					'label' => esc_html__( 'Venue Count for Related Venues', 'eventchamp' ),
					'id' => 'venue_related_venues_count',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter venue count for related venues.', 'eventchamp' ),
					'std' => '3',
					'min_max_step'=> '2,12,1',
					'section' => 'venues',
					'condition' => 'venue_related_venues:is(on)'
				),

				/*====== Speakers ======*/
				array(
					'label' => esc_html__( 'Sidebar Position for Speaker Archive', 'eventchamp' ),
					'id' => 'speaker_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select sidebar position for speaker archive.', 'eventchamp' ),
					'std' => 'right',
					'section' => 'speakers'
				),
				array(
					'label' => esc_html__( 'Sidebar Select Speaker Archive', 'eventchamp' ),
					'id' => 'speaker_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select sidebar for speaker archive.', 'eventchamp' ),
					'section' => 'speakers'
				),
				array(
					'label' => esc_html__( 'Sidebar Select for Speaker Details', 'eventchamp' ),
					'id' => 'speaker_detail_sidebar_select',
					'type' => 'sidebar-select',
					'desc' => esc_html__( 'You can select sidebar for speaker details.', 'eventchamp' ),
					'section' => 'speakers'
				),

				/*====== Schedule ======*/
				array(
					'label' => esc_html__( 'Field for Speaker', 'eventchamp' ),
					'id' => 'schedule_speaker_detail',
					'type' => 'radio',
					'desc' => esc_html__( 'You can select speaker field for schedule.', 'eventchamp' ),
					'std' => 'profession',
					'section' => 'schedule',
					'choices' => array(
						array(
							'label' => esc_html__( 'Profession', 'eventchamp' ),
							'value' => 'profession'
						),
						array(
							'label' => esc_html__( 'Company', 'eventchamp' ),
							'value' => 'company'
						),
					),
				),

				/*====== Social Media ======*/
				array(
					'label' => esc_html__( 'Social Links', 'eventchamp' ),
					'id' => 'socialmedia_tab1',
					'type' => 'tab',
					'section' => 'socialmedia'
				),
					array(
						'label' => esc_html__( 'Facebook URL', 'eventchamp' ),
						'id' => 'social_media_facebook',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Facebook url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Twitter URL', 'eventchamp' ),
						'id' => 'social_media_twitter',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Twitter url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Google+ URL', 'eventchamp' ),
						'id' => 'social_media_googleplus',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Google+ url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Instagram URL', 'eventchamp' ),
						'id' => 'social_media_instagram',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Instagram url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'LinkedIn URL', 'eventchamp' ),
						'id' => 'social_media_linkedin',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter LinkedIn url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Vine URL', 'eventchamp' ),
						'id' => 'social_media_vine',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Vine url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Pinterest URL', 'eventchamp' ),
						'id' => 'social_media_pinterest',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Pinterest url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'YouTube URL', 'eventchamp' ),
						'id' => 'social_media_youtube',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter YouTube url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Behance URL', 'eventchamp' ),
						'id' => 'social_media_behance',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Behance url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'DeviantArt URL', 'eventchamp' ),
						'id' => 'social_media_deviantart',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter DeviantArt url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Digg URL', 'eventchamp' ),
						'id' => 'social_media_digg',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Digg url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Dribbble URL', 'eventchamp' ),
						'id' => 'social_media_dribbble',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Dribbble url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Flickr URL', 'eventchamp' ),
						'id' => 'social_media_flickr',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Flickr url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'GitHub URL', 'eventchamp' ),
						'id' => 'social_media_github',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter GitHub url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Last.fm URL', 'eventchamp' ),
						'id' => 'social_media_lastfm',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Last.fm url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Reddit URL', 'eventchamp' ),
						'id' => 'social_media_reddit',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Reddit url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'SoundCloud URL', 'eventchamp' ),
						'id' => 'social_media_soundcloud',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter SoundCloud url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Tumblr URL', 'eventchamp' ),
						'id' => 'social_media_tumblr',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Tumblr url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Vimeo URL', 'eventchamp' ),
						'id' => 'social_media_vimeo',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Vimeo url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'VK URL', 'eventchamp' ),
						'id' => 'social_media_vk',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter VK url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Medium URL', 'eventchamp' ),
						'id' => 'social_media_medium',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Medium url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'RSS URL', 'eventchamp' ),
						'id' => 'social_media_rss',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter RSS url.', 'eventchamp' ),
						'section' => 'socialmedia'
					),
				array(
					'label' => esc_html__( 'Social Share', 'eventchamp' ),
					'id' => 'socialmedia_tab2',
					'type' => 'tab',
					'section' => 'socialmedia'
				),
					array(
						'label' => esc_html__( 'General Post Share', 'eventchamp' ),
						'id' => 'hide_general_post_share',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide general post social share buttons.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Social Links For User Profile', 'eventchamp' ),
						'id' => 'user_profile_social_links',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide social links for user profile.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Facebook Share', 'eventchamp' ),
						'id' => 'social_share_facebook',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Facebook for social share.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Twitter Share', 'eventchamp' ),
						'id' => 'social_share_twitter',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Twitter for social share.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Google+ Share', 'eventchamp' ),
						'id' => 'social_share_googleplus',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Google+ for social share.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Linkedin Share', 'eventchamp' ),
						'id' => 'social_share_linkedin',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Linkedin for social share.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Pinterest Share', 'eventchamp' ),
						'id' => 'social_share_pinterest',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Pinterest for social share.', 'eventchamp' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Reddit Share', 'eventchamp' ),
						'id' => 'social_share_reddit',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Reddit for social share.', 'eventchamp' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Delicious Share', 'eventchamp' ),
						'id' => 'social_share_delicious',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Delicious for social share.', 'eventchamp' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Stumbleupon Share', 'eventchamp' ),
						'id' => 'social_share_stumbleupon',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Stumbleupon for social share.', 'eventchamp' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),
					array(
						'label' => esc_html__( 'Tumblr Share', 'eventchamp' ),
						'id' => 'social_share_tumblr',
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide Tumblr for social share.', 'eventchamp' ),
						'std' => 'off',
						'section' => 'socialmedia'
					),

				/*====== WooCommerce ======*/
				array(
					'label' => esc_html__( 'Sidebar Position for WooCommerce Shop Page', 'eventchamp' ),
					'id' => 'woocommerce_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select sidebar position of WooCommerce shop page.', 'eventchamp' ),
					'std' => 'right',
					'section' => 'woocommerce'
				),
				array(
					'label' => esc_html__( 'Sidebar Position for WooCommerce Single Product', 'eventchamp' ),
					'id' => 'woocommerce_product_sidebar_position',
					'type' => 'radio-image',
					'desc' => esc_html__( 'You can select sidebar position for WooCommerce single product.', 'eventchamp' ),
					'std' => 'right',
					'section' => 'woocommerce'
				),
				array(
					'label' => esc_html__( 'Product Column for WooCommerce Shop', 'eventchamp' ),
					'id' => 'woocommerce_shop_product_column',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter product column for WooCommerce shop page.', 'eventchamp' ),
					'std' => '4',
					'min_max_step'=> '3,6,1',
					'section' => 'woocommerce'
				),
				array(
					'label' => esc_html__( 'Related Products Count for WooCommerce', 'eventchamp' ),
					'id' => 'woocommerce_related_product_count_column',
					'type' => 'numeric-slider',
					'desc' => esc_html__( 'You can enter related products count for WooCommerce.', 'eventchamp' ),
					'std' => '4',
					'section' => 'woocommerce'
				),

				/*====== Custom Codes ======*/
				array(
					'label' => esc_html__( 'Custom CSS Codes', 'eventchamp' ),
					'id' => 'custom_css',
					'type' => 'css',
					'desc' => esc_html__( 'You can enter custom CSS codes.', 'eventchamp' ),
					'section' => 'customcodes'
				),
				array(
					'label' => esc_html__( 'Custom JavaScript Codes', 'eventchamp' ),
					'id' => 'custom_js',
					'type' => 'javascript',
					'desc' => esc_html__( 'You can enter custom JavaScript codes.', 'eventchamp' ),
					'section' => 'customcodes'
				),
			),
		);

		$custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

		if ( $saved_settings !== $custom_settings ) {
			update_option( ot_settings_id(), $custom_settings ); 
		}
		
		global $ot_has_eventchamp_theme_options;
		$ot_has_eventchamp_theme_options = true;
	}
	add_action( 'init', 'eventchamp_theme_options' );

	/*======
	*
	* Meta Boxes
	*
	======*/
	function eventchamp_meta_boxes() {
		/*====== Post Meta Boxes ======*/
		$post_meta_box = array(
			'id' => 'post_settings',
			'title' => esc_html__( 'Post Settings', 'eventchamp' ),
			'pages' => array( 'post' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-header-settings',
					'label' => esc_html__( 'Header Settings', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'header_status',
						'label' => esc_html__( 'Header Status', 'eventchamp' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide header.', 'eventchamp' ),
					),
					array(
						'id' => 'header_layout_select',
						'label'	=> esc_html__( 'Header Style', 'eventchamp' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select header style for post.', 'eventchamp' ),
					),
					array(
						'id' => 'page_title',
						'label' => esc_html__( 'Page Title & Breadcrumbs', 'eventchamp' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide page title and breadcrumbs.', 'eventchamp' ),
					),
				array(
					'id' => 'tab2-layout-settings',
					'label' => esc_html__( 'Layout Settings', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'sidebar_position',
						'label'	=> esc_html__( 'Sidebar Position', 'eventchamp' ),
						'desc' => esc_html__( 'You can select sidebar position for post.', 'eventchamp' ),
						'type' => 'radio-image',
					),
					array(
						'label' => esc_html__( 'Sidebar for Post', 'eventchamp' ),
						'desc' => esc_html__( 'You can select sidebar for post.', 'eventchamp' ),
						'id' => 'post_sidebar_select',
						'type' => 'sidebar-select'
					),
					array(
						'id' => 'full_with_container',
						'label' => esc_html__( 'Full Width Container', 'eventchamp' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can make full width contaienr.', 'eventchamp' ),
					),
				array(
					'id' => 'tab3-featured-header',
					'label' => esc_html__( 'Featured Settings', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'featured_header_status',
						'label' => esc_html__( 'Featured Header Status', 'eventchamp' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide featured header. If you want to use featured header, you should choose post format from Format.', 'eventchamp' ),
					),
					array(
						'id' => 'post_video_embed',
						'label' => esc_html__( 'Video Embed Code', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter video embed code.', 'eventchamp' ) . esc_attr( '<br><i>' ) . esc_html__( 'Example:', 'eventchamp' ) . htmlspecialchars( ' &lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube-nocookie.com/embed/OYbXaqQ3uuo&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;' ) . esc_attr( '</i>' ),
						'type' => 'text'
					),
					array(
						'id' => 'post_audio_embed',
						'label' => esc_html__( 'Audio Embed Code', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter audio embed code.', 'eventchamp' ) . esc_attr( '<br><i>' ) . esc_html__( 'Example:', 'eventchamp' ) . htmlspecialchars( ' &lt;iframe width=&quot;100%&quot; height=&quot;450&quot; scrolling=&quot;no&quot; frameborder=&quot;no&quot; src=&quot;https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/90909412&amp;amp;auto_play=false&amp;amp;hide_related=false&amp;amp;show_comments=true&amp;amp;show_user=true&amp;amp;show_reposts=false&amp;amp;visual=true&quot;&gt;&lt;/iframe&gt;' ) . esc_attr( '</i>' ),
						'type' => 'text'
					),
					array(
						'id' => 'post_images',
						'label' => esc_html__( 'Post Images', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images for gallery.', 'eventchamp' ),
						'type' => 'gallery'
					),
				array(
					'id' => 'tab4-footer-settings',
					'label' => esc_html__( 'Footer Settings', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'footer_status',
						'label' => esc_html__( 'Footer Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can hide footer.', 'eventchamp' ),
						'type' => 'on_off'
					),
					array(
						'id' => 'footer_layout_select',
						'label'	=> esc_html__( 'Footer Style', 'eventchamp' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select footer style for post.', 'eventchamp' ),
					),
			)
		);
		ot_register_meta_box( $post_meta_box );
		
		/*====== Page Meta Boxes ======*/
		$page_meta_box = array( 
			'id' => 'page_settings',
			'title' => esc_html__( 'Page Settings', 'eventchamp' ),
			'pages' => array( 'page' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-header-settings',
					'label' => esc_html__( 'Header Settings', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'header_status',
						'label' => esc_html__( 'Header Status', 'eventchamp' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide header.', 'eventchamp' ),
					),
					array(
						'id' => 'header_layout_select',
						'label'	=> esc_html__( 'Header Style', 'eventchamp' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select header style for page.', 'eventchamp' ),
					),
					array(
						'id' => 'page_title',
						'label' => esc_html__( 'Page Title & Breadcrumbs', 'eventchamp' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide page title and breadcrumbs.', 'eventchamp' ),
					),
					array(
						'id' => 'header_gap',
						'label' => esc_html__( 'Header Gap', 'eventchamp' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can remove header gap.', 'eventchamp' ),
					),
					array(
						'id' => 'featured_image_status',
						'label' => esc_html__( 'Featured Image', 'eventchamp' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can hide featured image.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Menu Location', 'eventchamp' ),
						'id' => 'page_menu_location',
						'type' => 'radio',
						'desc' => esc_html__( 'You can select menu location for post.', 'eventchamp' ),
						'choices' => array(
							array(
								'label' => esc_html__( 'Default Location', 'eventchamp' ),
								'value' => 'default'
							),
							array(
								'label' => esc_html__( 'One Page Location', 'eventchamp' ),
								'value' => 'onepage'
							),
						),
					),
					
				array(
					'id' => 'tab2-layout-settings',
					'label' => esc_html__( 'Layout Settings', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'sidebar_position',
						'label'	=> esc_html__( 'Sidebar Position', 'eventchamp' ),
						'desc' => esc_html__( 'You can select sidebar position for page.', 'eventchamp' ),
						'type' => 'radio-image',
					),
					array(
						'label' => esc_html__( 'Sidebar for Page', 'eventchamp' ),
						'desc' => esc_html__( 'You can select sidebar for page.', 'eventchamp' ),
						'id' => 'page_sidebar_select',
						'type' => 'sidebar-select'
					),
					array(
						'id' => 'full_with_container',
						'label' => esc_html__( 'Full Width Container', 'eventchamp' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can make full width contaienr.', 'eventchamp' ),
					),					
				array(
					'id' => 'tab3-footer-settings',
					'label' => esc_html__( 'Footer Settings', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'footer_status',
						'label' => esc_html__( 'Footer Status', 'eventchamp' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide footer.', 'eventchamp' ),
					),
					array(
						'id' => 'footer_layout_select',
						'label'	=> esc_html__( 'Footer Style', 'eventchamp' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select footer style for page.', 'eventchamp' ),
					),
					array(
						'id' => 'footer_gap',
						'label' => esc_html__( 'Footer Gap', 'eventchamp' ),
						'type' => 'on_off',
						'std' => 'on',
						'desc' => esc_html__( 'You can remove footer gap.', 'eventchamp' ),
					),
			)
		);
		ot_register_meta_box( $page_meta_box );

		/*====== Event Meta Boxes ======*/
		$page_meta_box = array( 
			'id' => 'event_settings',
			'title' => esc_html__( 'Event Settings', 'eventchamp' ),
			'pages' => array( 'event' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-general-details',
					'label' => esc_html__( 'General Details', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'event_start_date',
						'label' => esc_html__( 'Start Date', 'eventchamp' ),
						'type' => 'date-picker',
						'desc' => esc_html__( 'You can enter start date for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_start_time',
						'label' => esc_html__( 'Start Time', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter start time for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_end_date',
						'label' => esc_html__( 'End Date', 'eventchamp' ),
						'type' => 'date-picker',
						'desc' => esc_html__( 'You can enter end date for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_end_time',
						'label' => esc_html__( 'End Time', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter end time for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_schedule',
						'label' => esc_html__( 'Schedule', 'eventchamp' ),
						'desc' => esc_html__( 'You can create schedule for event.', 'eventchamp' ),
						'type' => 'list-item',
				        'settings' => array(
							array(
								'id' => 'event_schedule_date',
								'label' => esc_html__( 'Date', 'eventchamp' ),
								'type' => 'date-picker',
								'desc' => esc_html__( 'You can enter date for schedule item.', 'eventchamp' ),
							),
							array(
								'id' => 'event_schedule_time',
								'label' => esc_html__( 'Time', 'eventchamp' ),
								'type' => 'text',
								'desc' => esc_html__( 'You can enter time for schedule item.', 'eventchamp' ),
							),
							array(
								'id' => 'event_schedule_description',
								'label' => esc_html__( 'Description', 'eventchamp' ),
								'type' => 'textarea-simple',
								'desc' => esc_html__( 'You can enter description for schedule item.', 'eventchamp' ),
							),
							array(
								'id' => 'event_schedule_speakers',
								'label' => esc_html__( 'Speakers', 'eventchamp' ),
								'desc' => esc_html__( 'You can select speakers for schedule item.', 'eventchamp' ),
								'type' => 'custom-post-type-checkbox',
								'post_type' => 'speaker'
							),
				        ),
			        ),
					array(
						'id' => 'event_speakers',
						'label' => esc_html__( 'Speakers', 'eventchamp' ),
						'desc' => esc_html__( 'You can select speakers for event.', 'eventchamp' ),
						'type' => 'custom-post-type-checkbox',
						'post_type' => 'speaker'
					),
					array(
						'id' => 'event_faq',
						'label' => esc_html__( 'FAQ', 'eventchamp' ),
						'desc' => esc_html__( 'You can add faq for event.', 'eventchamp' ),
						'type' => 'list-item',
				        'settings' => array(
							array(
								'label' => esc_html__( 'Description', 'eventchamp' ),
								'id' => 'event_faq_description',
								'type' => 'textarea',
								'desc' => esc_html__( 'You can enter description for faq.', 'eventchamp' ),
							),
				        ),
			        ),
					array(
						'id' => 'event_extra_tab1_title',
						'label' => esc_html__( 'Extra Tab 1 Title', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter extra tab 1 title for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_extra_tab1_content',
						'label' => esc_html__( 'Extra Tab 1 Content', 'eventchamp' ),
						'type' => 'textarea-simple',
						'desc' => esc_html__( 'You can enter extra tab 1 content for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_extra_tab2_title',
						'label' => esc_html__( 'Extra Tab 2 Title', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter extra tab 2 title for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_extra_tab2_content',
						'label' => esc_html__( 'Extra Tab 2 Content', 'eventchamp' ),
						'type' => 'textarea-simple',
						'desc' => esc_html__( 'You can enter extra tab 2 content for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_default_open_tab',
						'label' => esc_html__( 'Default Open Tab', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter number. Example: 2. Default: 1.', 'eventchamp' ),
					),
				array(
					'id' => 'tab2-general-details',
					'label' => esc_html__( 'Contact', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'event_location',
						'label' => esc_html__( 'Location', 'eventchamp' ),
						'desc' => esc_html__( 'You can select location for event.', 'eventchamp' ),
						'type' => 'taxonomy-select',
						'taxonomy' => 'location'
					),
					array(
						'id' => 'event_organizer',
						'label' => esc_html__( 'Organizer', 'eventchamp' ),
						'desc' => esc_html__( 'You can select organizer for event.', 'eventchamp' ),
						'type' => 'taxonomy-select',
						'taxonomy' => 'organizer'
					),
					array(
						'id' => 'event_venue',
						'label' => esc_html__( 'Venue', 'eventchamp' ),
						'desc' => esc_html__( 'You can select venue for event.', 'eventchamp' ),
						'type' => 'custom-post-type-select',
						'post_type' => 'venue'
					),
					array(
						'id' => 'event_detailed_address',
						'label' => esc_html__( 'Detailed Address', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter detailed address for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_phone',
						'label' => esc_html__( 'Phone', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter phone for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_email',
						'label' => esc_html__( 'Email', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter email for event.', 'eventchamp' ),
					),
					array(
						'id' => 'event_google_street_link',
						'label' => esc_html__( 'Google Street View Link (3D Tour)', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Google Street View link for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Link of Extra Button for Sidebar', 'eventchamp' ),
						'id' => 'event_extra_sidebar_button_link',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter link for extra button.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Title of Extra Button for Sidebar', 'eventchamp' ),
						'id' => 'event_extra_sidebar_button_title',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter title for extra button.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Target for Extra Button', 'eventchamp' ),
						'id' => 'event_extra_sidebar_target',
						'type' => 'radio',
						'desc' => esc_html__( 'You can select target type for extra button.', 'eventchamp' ),
						'choices' => array(
							array(
								'label' => esc_html__( 'Self', 'eventchamp' ),
								'value' => 'self'
							),
							array(
								'label' => esc_html__( 'Blank', 'eventchamp' ),
								'value' => '_blank'
							),
						),
					),
				array(
					'id' => 'tab3-ticket',
					'label' => esc_html__( 'Ticket', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'event_remaining_tickets',
						'label' => esc_html__( 'Product For Remaining Tickets', 'eventchamp' ),
						'desc' => esc_html__( 'You can select product id for remaining tickets.', 'eventchamp' ),
						'type' => 'custom-post-type-select',
						'post_type' => 'product'
					),
					array(
						'id' => 'event_tickets',
						'label' => esc_html__( 'Ticket', 'eventchamp' ),
						'desc' => esc_html__( 'You can create ticket for event.', 'eventchamp' ),
						'type' => 'list-item',
				        'settings' => array(
							array(
								'id' => 'event_tickets_product',
								'label' => esc_html__( 'Product For Price', 'eventchamp' ),
								'desc' => esc_html__( 'You can select product for price.', 'eventchamp' ),
								'type' => 'custom-post-type-select',
								'post_type' => 'product'
							),
							array(
								'id' => 'event_tickets_package_feature',
								'label' => esc_html__( 'Package Feature', 'eventchamp' ),
								'type' => 'textarea-simple',
								'desc' => esc_html__( 'You can enter package feature for event. Press enter for each line.', 'eventchamp' ),
							),
							array(
								'id' => 'event_tickets_via_contact_form',
								'label' => esc_html__( 'Turn Off Credit Card Payment / Sale via Contact Form', 'eventchamp' ),
								'type' => 'on_off',
								'std' => 'off',
								'desc' => esc_html__( 'You can close credit card payment. You can activate credit card payment of choose off button.', 'eventchamp' ),
							),
							array(
								'id' => 'event_redirect_to_external_link',
								'label' => esc_html__( 'Redirect to External Link', 'eventchamp' ),
								'type' => 'on_off',
								'std' => 'off',
								'desc' => esc_html__( 'You can redirect package to external link.', 'eventchamp' ),
								'condition' => 'event_tickets_via_contact_form:is(off)'
							),
							array(
								'label' => esc_html__( 'External Link', 'eventchamp' ),
								'id' => 'event_redirect_to_external_link_link',
								'type' => 'text',
								'desc' => esc_html__( 'You can enter external link for package.', 'eventchamp' ),
								'condition' => 'event_redirect_to_external_link:is(on),event_tickets_via_contact_form:is(off)'
							),
							array(
								'label' => esc_html__( 'External Link Title', 'eventchamp' ),
								'id' => 'event_redirect_to_external_link_title',
								'type' => 'text',
								'desc' => esc_html__( 'You can enter title for external link.', 'eventchamp' ),
								'condition' => 'event_redirect_to_external_link:is(on),event_tickets_via_contact_form:is(off)'
							),
				        ),
			        ),
				array(
					'id' => 'tab4-media',
					'label' => esc_html__( 'Media & Sponsors', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'event_image_gallery',
						'label' => esc_html__( 'Images for Featured Gallery', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images for featured gallery.', 'eventchamp' ),
						'type' => 'gallery'
					),
					array(
						'id' => 'event_disable_featured_image_gallery',
						'label' => esc_html__( 'Disable Featured Image Gallery', 'eventchamp' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can disable featured image gallery.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Image for Custom Featured Image', 'eventchamp' ),
						'id' => 'event_featured_image',
						'type' => 'upload',
						'desc' => esc_html__( 'If you want to use custom featured image, you can upload image with this input.', 'eventchamp' ),
						'section' => 'header',
						'condition' => 'event_disable_featured_image_gallery:is(on)'
					),
					array(
						'id' => 'event_media_tab_images',
						'label' => esc_html__( 'Images for Media Tab', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images for media tab.', 'eventchamp' ),
						'type' => 'gallery'
					),
					array(
						'id' => 'event_sponsors',
						'label' => esc_html__( 'Sponsors', 'eventchamp' ),
						'desc' => esc_html__( 'You can add sponsor for event.', 'eventchamp' ),
						'type' => 'list-item',
				        'settings' => array(
							array(
								'id' => 'event_sponsor_logo',
								'label' => esc_html__( 'Sponsor Logo', 'eventchamp' ),
								'desc' => esc_html__( 'You can upload logo for sponsor.', 'eventchamp' ),
								'type' => 'upload'
							),
							array(
								'label' => esc_html__( 'Sponsor Web Site', 'eventchamp' ),
								'id' => 'event_sponsor_link',
								'type' => 'text',
								'desc' => esc_html__( 'You can enter sponsor web site for sponsor.', 'eventchamp' ),
							),
				        ),
			        ),
				array(
					'id' => 'tab5-event-network',
					'label' => esc_html__( 'Network', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'label' => esc_html__( 'Official Web Site', 'eventchamp' ),
						'id' => 'event_official_web_site',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter official web site for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Facebook URL', 'eventchamp' ),
						'id' => 'event_social_media_facebook',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Facebook url for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Twitter URL', 'eventchamp' ),
						'id' => 'event_social_media_twitter',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Twitter url for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Google+ URL', 'eventchamp' ),
						'id' => 'event_social_media_googleplus',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Google+ url for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Instagram URL', 'eventchamp' ),
						'id' => 'event_social_media_instagram',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Instagram url for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'YouTube URL', 'eventchamp' ),
						'id' => 'event_social_media_youtube',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter YouTube url for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Flickr URL', 'eventchamp' ),
						'id' => 'event_social_media_flickr',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Flickr url for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'SoundCloud URL', 'eventchamp' ),
						'id' => 'event_social_media_soundcloud',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter SoundCloud url for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Vimeo URL', 'eventchamp' ),
						'id' => 'event_social_media_vimeo',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Vimeo url for event.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'LinkedIn URL', 'eventchamp' ),
						'id' => 'event_social_media_linkedin',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter LinkedIn url for event.', 'eventchamp' ),
					),
			)
		);
		ot_register_meta_box( $page_meta_box );

		/*====== Speaker Meta Boxes ======*/
		$page_meta_box = array( 
			'id' => 'speaker_settings',
			'title' => esc_html__( 'Speaker Settings', 'eventchamp' ),
			'pages' => array( 'speaker' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-general-details',
					'label' => esc_html__( 'General Details', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'speaker_profession',
						'label' => esc_html__( 'Profession', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter profession for speaker.', 'eventchamp' ),
					),
					array(
						'id' => 'speaker_company',
						'label' => esc_html__( 'Company', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter company for speaker.', 'eventchamp' ),
					),
				array(
					'id' => 'tab2-general-details',
					'label' => esc_html__( 'Contact', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'speaker_location',
						'label' => esc_html__( 'Location', 'eventchamp' ),
						'desc' => esc_html__( 'You can select location for speaker.', 'eventchamp' ),
						'type' => 'taxonomy-select',
						'taxonomy' => 'location'
					),
					array(
						'id' => 'speaker_address',
						'label' => esc_html__( 'Address', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter address for speaker.', 'eventchamp' ),
					),
					array(
						'id' => 'speaker_phone',
						'label' => esc_html__( 'Phone', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter phone for speaker.', 'eventchamp' ),
					),
					array(
						'id' => 'speaker_email',
						'label' => esc_html__( 'Email', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter email for speaker.', 'eventchamp' ),
					),
				array(
					'id' => 'tab3-speaker-media',
					'label' => esc_html__( 'Media', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'speaker_image_gallery',
						'label' => esc_html__( 'Images for Featured Gallery', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images for featured gallery.', 'eventchamp' ),
						'type' => 'gallery'
					),
					array(
						'id' => 'speaker_disable_featured_image_gallery',
						'label' => esc_html__( 'Disable Featured Image Gallery', 'eventchamp' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can disable featured image gallery.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Image for Custom Featured Image', 'eventchamp' ),
						'id' => 'speaker_featured_image',
						'type' => 'upload',
						'desc' => esc_html__( 'If you want to use custom featured image, you can upload image with this input.', 'eventchamp' ),
						'section' => 'header',
						'condition' => 'speaker_disable_featured_image_gallery:is(on)'
					),
				array(
					'id' => 'tab4-speaker-network',
					'label' => esc_html__( 'Network', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'label' => esc_html__( 'Official Web Site', 'eventchamp' ),
						'id' => 'speaker_official_web_site',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter official web site for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Facebook URL', 'eventchamp' ),
						'id' => 'speaker_social_media_facebook',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Facebook url for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Twitter URL', 'eventchamp' ),
						'id' => 'speaker_social_media_twitter',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Twitter url for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Google+ URL', 'eventchamp' ),
						'id' => 'speaker_social_media_googleplus',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Google+ url for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Instagram URL', 'eventchamp' ),
						'id' => 'speaker_social_media_instagram',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Instagram url for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'YouTube URL', 'eventchamp' ),
						'id' => 'speaker_social_media_youtube',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter YouTube url for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Flickr URL', 'eventchamp' ),
						'id' => 'speaker_social_media_flickr',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Flickr url for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'SoundCloud URL', 'eventchamp' ),
						'id' => 'speaker_social_media_soundcloud',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter SoundCloud url for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Vimeo URL', 'eventchamp' ),
						'id' => 'speaker_social_media_vimeo',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Vimeo url for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'LinkedIn URL', 'eventchamp' ),
						'id' => 'speaker_social_media_linkedin',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter LinkedIn url for speaker.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'GitHub URL', 'eventchamp' ),
						'id' => 'speaker_social_media_github',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter GitHub url for speaker.', 'eventchamp' ),
					),
			)
		);
		ot_register_meta_box( $page_meta_box );

		/*====== Venue Meta Boxes ======*/
		$page_meta_box = array( 
			'id' => 'venue_settings',
			'title' => esc_html__( 'Venue Settings', 'eventchamp' ),
			'pages' => array( 'venue' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-general-details',
					'label' => esc_html__( 'General Details', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'venue_working_hours_weekdays',
						'label' => esc_html__( 'Working Hours for Weekdays', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter weekdays working hours for venue.', 'eventchamp' ),
					),
					array(
						'id' => 'venue_working_hours_saturday',
						'label' => esc_html__( 'Working Hours for Saturday', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter saturday working hours for venue.', 'eventchamp' ),
					),
					array(
						'id' => 'venue_working_hours_sunday',
						'label' => esc_html__( 'Working Hours for Sunday', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter sunday working hours for venue.', 'eventchamp' ),
					),
				array(
					'id' => 'tab2-contact',
					'label' => esc_html__( 'Contact', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'venue_location',
						'label' => esc_html__( 'Location', 'eventchamp' ),
						'desc' => esc_html__( 'You can select location for venue.', 'eventchamp' ),
						'type' => 'taxonomy-select',
						'taxonomy' => 'location'
					),
					array(
						'id' => 'venue_detailed_address',
						'label' => esc_html__( 'Detailed Address', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter detailed address for venue.', 'eventchamp' ),
					),
					array(
						'id' => 'venue_phone',
						'label' => esc_html__( 'Phone', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter phone for venue.', 'eventchamp' ),
					),
					array(
						'id' => 'venue_fax',
						'label' => esc_html__( 'Fax', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter fax for venue.', 'eventchamp' ),
					),
					array(
						'id' => 'venue_email',
						'label' => esc_html__( 'Email', 'eventchamp' ),
						'type' => 'text',
						'desc' => esc_html__( 'You can enter email for venue.', 'eventchamp' ),
					),
				array(
					'id' => 'tab3-media',
					'label' => esc_html__( 'Media & Sponsors', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'id' => 'venue_image_gallery',
						'label' => esc_html__( 'Images for Featured Gallery', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images for featured gallery.', 'eventchamp' ),
						'type' => 'gallery'
					),
					array(
						'id' => 'venue_disable_featured_image_gallery',
						'label' => esc_html__( 'Disable Featured Image Gallery', 'eventchamp' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can disable featured image gallery.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Image for Custom Featured Image', 'eventchamp' ),
						'id' => 'venue_featured_image',
						'type' => 'upload',
						'desc' => esc_html__( 'If you want to use custom featured image, you can upload image with this input.', 'eventchamp' ),
						'section' => 'header',
						'condition' => 'venue_disable_featured_image_gallery:is(on)'
					),
				array(
					'id' => 'tab4-venue-network',
					'label' => esc_html__( 'Network', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'label' => esc_html__( 'Official Web Site', 'eventchamp' ),
						'id' => 'venue_official_web_site',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter official web site for venue.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Facebook URL', 'eventchamp' ),
						'id' => 'venue_social_media_facebook',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Facebook url for venue.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Twitter URL', 'eventchamp' ),
						'id' => 'venue_social_media_twitter',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Twitter url for venue.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Google+ URL', 'eventchamp' ),
						'id' => 'venue_social_media_googleplus',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Google+ url for venue.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Instagram URL', 'eventchamp' ),
						'id' => 'venue_social_media_instagram',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Instagram url for venue.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'YouTube URL', 'eventchamp' ),
						'id' => 'venue_social_media_youtube',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter YouTube url for venue.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Flickr URL', 'eventchamp' ),
						'id' => 'venue_social_media_flickr',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Flickr url for venue.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'SoundCloud URL', 'eventchamp' ),
						'id' => 'venue_social_media_soundcloud',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter SoundCloud url for venue.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'Vimeo URL', 'eventchamp' ),
						'id' => 'venue_social_media_vimeo',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter Vimeo url for venue.', 'eventchamp' ),
					),
					array(
						'label' => esc_html__( 'LinkedIn URL', 'eventchamp' ),
						'id' => 'venue_social_media_linkedin',
						'type' => 'text',
						'desc' => esc_html__( 'You can enter LinkedIn url for venue.', 'eventchamp' ),
					),
			)
		);
		ot_register_meta_box( $page_meta_box );
	}
	add_action( 'admin_init', 'eventchamp_meta_boxes' );

	/*======
	*
	* Font List for Theme Options
	*
	======*/
	$eventchamp_font_list = array();
	function eventchamp_google_webfont() {
		global $eventchamp_font_list;
		$options = array( 
			array( 
				'option' => "theme_main_font", 
				'default' => "Poppins"
			),
			array( 
				'option' => "body_text", 
				'default' => ""
			),
			array( 
				'option' => "h1_font", 
				'default' => ""
			),
			array( 
				'option' => "h2_font", 
				'default' => ""
			),
			array( 
				'option' => "h3_font", 
				'default' => ""
			),
			array( 
				'option' => "h4_font", 
				'default' => ""
			),
			array( 
				'option' => "h5_font", 
				'default' => ""
			),
			array( 
				'option' => "h6_font", 
				'default' => ""
			),
			array( 
				'option' => "input_font", 
				'default' => ""
			),
			array( 
				'option' => "input_placeholder_font", 
				'default' => ""
			),
			array( 
				'option' => "button_font", 
				'default' => ""
			),
			array( 
				'option' => "header_default_menu_font", 
				'default' => ""
			),
			array( 
				'option' => "header_default_submenu_font", 
				'default' => ""
			),
			array( 
				'option' => "header_classic_menu_font", 
				'default' => ""
			),
			array( 
				'option' => "header_classic_submenu_font", 
				'default' => ""
			),
			array( 
				'option' => "post_posts_title_font", 
				'default' => ""
			),
			array( 
				'option' => "post_posts_content_font", 
				'default' => ""
			),
			array( 
				'option' => "post_posts_bottom_element_title_font", 
				'default' => ""
			),
			array( 
				'option' => "page_title_font", 
				'default' => ""
			),
			array( 
				'option' => "page_content_font", 
				'default' => ""
			),
			array( 
				'option' => "404_page_title", 
				'default' => ""
			),
			array( 
				'option' => "404_page_text", 
				'default' => ""
			),
			array( 
				'option' => "404_page_icon", 
				'default' => ""
			),
		);
		
		$import = '';	
		
		$language = 'latin,latin-ext';
		$font_language = ot_get_option('fonts_languages');

		if ( 'cyrillic' == $font_language )
			$language .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $font_language )
			$language .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $font_language )
			$language .= ',vietnamese';
				
		$url_check = is_ssl() ? 'https' : 'http';

		foreach($options as $option) {
			$array = ot_get_option($option['option']);
			
			if (!empty($array['font-family'])) { 
				if (!in_array($array['font-family'], $eventchamp_font_list)) {
					array_push($eventchamp_font_list, $array['font-family']);
				}
			} else if ($option['default']) {
				if (!in_array($option['default'], $eventchamp_font_list)) {
					array_push($eventchamp_font_list, $option['default']);
				}
			}
		}
		
		$fonts_list_unique = array_unique($eventchamp_font_list);
			
		foreach($fonts_list_unique as $fonts) {
			$cssfont = str_replace(' ', '+', $fonts);
			$query_args = array(
				'family' => $cssfont.':200,300,400,400i,500,600,700,700i',
				'subset' => $language,
			);
			$font_url = add_query_arg( $query_args, "$url_check://fonts.googleapis.com/css" );
			$import .= "<link href='".$font_url."' rel='stylesheet' type='text/css'>\n";
		}
		return $import;
	}

	function eventchamp_font_dropdown( $array, $field_id ) {
		if ( $field_id == "theme_one_font" ) {
			$array = array( 'font-family');
		}
		
		if ( $field_id == "theme_two_font" ) {
			$array = array( 'font-family');
		}
		
		return $array;
	}
	add_filter( 'ot_recognized_typography_fields', 'eventchamp_font_dropdown', 10, 2 );

	/*======
	*
	* Types for Theme Options
	*
	======*/
	function eventchamp_type_echo($array_value, $important = false, $default = false) {
		global $eventchamp_font_list;
		
		if(!empty($array_value)) {
			//Font Family Array
			if (!empty($array_value['font-family'])) { 
				echo "font-family: '" . $array_value['font-family'] . "';\n";
			}
			else if ($default) {
				echo "font-family: '" . $default . "';\n";
			}
			//Font Color Array
			if (!empty($array_value['font-color'])) { 
				echo "color: " . $array_value['font-color'] . ";\n";
			}
			//Font Style Array
			if (!empty($array_value['font-style'])) { 
				echo "font-style: " . $array_value['font-style'] . ";\n";
			}
			//Font Variant Array
			if (!empty($array_value['font-variant'])) { 
				echo "font-variant: " . $array_value['font-variant'] . ";\n";
			}
			//Font Weight Array
			if (!empty($array_value['font-weight'])) { 
				echo "font-weight: " . $array_value['font-weight'] . ";\n";
			}
			//Font Size Array
			if (!empty($array_value['font-size'])) { 
				
				if ($important) {
					echo "font-size: " . $array_value['font-size'] . "!important;\n";
				} else {
					echo "font-size: " . $array_value['font-size'] . "!important;\n";
				}
			}
			//Font Decoration Array
			if (!empty($array_value['text-decoration'])) { 
					echo "text-decoration: " . $array_value['text-decoration'] . " !important;\n";
			}
			//Font Transform Array
			if (!empty($array_value['text-transform'])) { 
					echo "text-transform: " . $array_value['text-transform'] . " !important;\n";
			}
			//Font Height Array
			if (!empty($array_value['line-height'])) { 
					echo "line-height: " . $array_value['line-height'] . " !important;\n";
			}
			//Font Spacing Array
			if (!empty($array_value['letter-spacing'])) { 
					echo "letter-spacing: " . $array_value['letter-spacing'] . " !important;\n";
			}
		}
		if(empty($array_value) && !empty($default)) {
			echo "font-family: '" . $default . "';\n";
		}
	}

	/*======
	*
	* Background Input Type for Theme Options
	*
	======*/
	function eventchamp_background_input( $background_settings, $background_class, $identifier){ 
		$background_settings = ot_get_option( $background_settings, array() );  
			if($background_settings['background-color'] | $background_settings['background-repeat'] | $background_settings['background-attachment'] | $background_settings['background-position'] | $background_settings['background-image'] ){
				echo esc_attr( $identifier.$background_class );

				if( !empty( $background_settings['background-color'] ) ) {
					echo "background-color: " . $background_settings['background-color'] . ";";
				}

				if( !empty( $background_settings['background-repeat'] ) ) {
					echo "background-repeat: " . $background_settings['background-repeat'] . ";";
				}

				if( !empty( $background_settings['background-attachment'] ) ) {
					echo "background-attachment: " . $background_settings['background-attachment'] . ";";
				}

				if( !empty( $background_settings['background-position'] ) ) {
					echo "background-position: " . $background_settings['background-position'] . ";";
				}

				if( !empty( $background_settings['background-image'] ) ) {
					echo "background-image: url(" . $background_settings['background-image'] . ");";
				}

				if( !empty( $background_settings['background-size'] ) ) {
					echo "background-size: " . $background_settings['background-size'] . ";";
				}
		} 
	}

	/*======
	*
	* Theme Company for Theme Options
	*
	======*/
	function eventchamp_options_name() {
		$web_site = esc_url( 'http://gloriathemes.com' );
		$web_site_title = esc_attr( "Gloria Themes" );
		$html = '<a href="' . esc_url( $web_site ) . '" target="_blank">' . esc_attr( $web_site_title ) . '</a>';
		return $html;
	}
	add_filter( 'ot_header_version_text', 'eventchamp_options_name', 10, 2 );

	/*======
	*
	* Theme Company for Theme Options
	*
	======*/
	function eventchamp_upload_name() {
		return esc_html__('Send to Theme Options', 'eventchamp');
	}
	add_filter( 'ot_upload_text', 'eventchamp_upload_name', 10, 2 );

	/*======
	*
	* Adding Theme Options from Menu
	*
	======*/
	add_filter( 'ot_theme_options_parent_slug', '__return_false' );

	/*======
	*
	* Adding Theme Options from Menu
	*
	======*/
	function eventchamp_theme_options_logo() {
		$web_site = esc_url( 'https://gloriathemes.com/' );
		$web_site_title = esc_attr( "Gloria Themes" );
		echo '<li id="option-tree-logo"><span><a href="' . esc_url( $web_site ) . '" target="_blank"></a></span>';
		$theme_version = wp_get_theme();
		echo '<span class="theme-name"><b>' . esc_attr( $theme_version->get( 'Name' ) ) . '</b><span>' . esc_attr( $theme_version->get( 'Version' ) ) . '</span></li>';
	}
	add_filter( 'ot_header_logo_link', 'eventchamp_theme_options_logo' );

	/*======
	*
	* Adding Theme Options from Menu
	*
	======*/
	function eventchamp_theme_options_header() {
		$support_site = esc_url( 'https://support.gloriathemes.com/' );
		$support_site_title = esc_attr( "Support Center" );
		$documentation_site = esc_url( 'https://docs.gloriathemes.com/' );
		$documentation_site_title = esc_attr( "Theme Documentation" );
		echo '<li id="option-tree-version"><span><a href="' . esc_url( $support_site ) . '" target="_blank">' . esc_attr( $support_site_title ) . '</a></span></li>';
		echo '<li id="option-tree-version"><span><a href="' . esc_url( $documentation_site ) . '" target="_blank">' . esc_attr( $documentation_site_title ) . '</a></span></li>';
	}
	add_filter( 'ot_header_list', 'eventchamp_theme_options_header' );

	/*======
	*
	* Sidebar Creation for Theme Options
	*
	======*/
	function eventchamp_sidebar_creation() {
		$sidebars = ot_get_option('custom_sidebars');
		if(!empty($sidebars)) {
			foreach($sidebars as $sidebar) {
				register_sidebar( array(
					'id' => 'sidebar-'.$sidebar['id'],
					'name' => $sidebar['title'],
					'before_widget' => '<aside id="%1$s" class="widget-box animate anim-fadeIn %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<div class="widget-title"><h4>',
					'after_title' => '</h4></div>',
				));
			}
		}
	}
	add_action( 'after_setup_theme', 'eventchamp_sidebar_creation' );

	if ( ! function_exists( 'ot_type_sidebar_select_category' ) ) {
		function ot_type_sidebar_select_category( $args = array() ) {
			extract( $args );
			$has_desc = $field_desc ? true : false;
			$args = array(
				'type' => 'post',
				'child_of' => 0,
				'parent' => '',
				'orderby' => 'name',
				'order' => 'ASC',
				'hide_empty' => 0,
				'hierarchical' => 0,
				'taxonomy' => 'category',
				'pad_counts' => false
			);
			$categories = get_terms( 'category', array( 'hide_empty' => false ) );
			foreach ($categories as $category) {
				$field_id = 'sidebar_select_'.$category->term_id;
				$field_name = 'option_tree[sidebar_select_'.$category->term_id.']';
				$field_value = ot_get_option($field_id);
				echo '<div class="format-setting type-sidebar-select has-desc">';
					echo '<div class="description">' . esc_html__( "You can the select sidebar for", 'eventchamp' ) . ' "' . esc_attr( $category->name ) . '."</div>';
					echo '<div class="format-setting-inner">';
						echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';

						$sidebars = $GLOBALS['wp_registered_sidebars'];

						if ( ! empty( $sidebars ) ) {
						echo '<option value="">-- ' . esc_html__( 'Choose One', 'eventchamp' ) . ' --</option>';
						foreach ( $sidebars as $sidebar ) {
							echo '<option value="' . esc_attr( $sidebar['id'] ) . '"' . selected( $field_value, $sidebar['id'], false ) . '>' . esc_attr( $sidebar['name'] ) . '</option>';
						}
						} else {
							echo '<option value="">' . esc_html__( 'No Sidebars Found', 'eventchamp' ) . '</option>';
						}
						echo '</select>';
					echo '</div>';
				echo '</div>';
			}
		}
	}

	/*======
	*
	* Image Selector for Radio Button
	*
	======*/
	function eventchamp_radio_image_selector( $array, $field_id ) {
		if ( $field_id == 'sidebar_position' or $field_id == 'post_sidebar_position' or $field_id == 'woocommerce_sidebar_position' or $field_id == 'woocommerce_product_sidebar_position' or $field_id == 'attachment_sidebar_position' or $field_id == 'category_sidebar_position' or $field_id == 'search_sidebar_position' or $field_id == 'archive_sidebar_position' or $field_id == 'author_sidebar_position' or $field_id == 'tag_sidebar_position' or $field_id == 'page_sidebar_position' or $field_id == 'layout_select_meta_box_text' or $field_id == 'event_sidebar_position' or $field_id == 'venue_sidebar_position' or $field_id == 'speaker_sidebar_position' ) {
			$array = array(
				array(
					'value' => 'nosidebar',
					'label' => esc_html__( 'None Sidebar', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/none-sidebar.jpg'
				),
				array(
					'value' => 'left',
					'label' => esc_html__( 'Left Sidebar', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/left-sidebar.jpg'
				),
				array(
					'value' => 'right',
					'label' => esc_html__( 'Right Sidebar', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/right-sidebar.jpg'
				)
			);
		}

		if ( $field_id == 'default_header_style' ) {
			$array = array(
				array(
					'value' => 'header-style-1',
					'label' => esc_html__( 'Header Style 1', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-1.jpg'
				),
			);
		}

		if ( $field_id == 'header_layout_select' ) {
			$array = array(
				array(
					'value' => 'header-style-1',
					'label' => esc_html__( 'Header Style 1', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-1.jpg'
				),
				array(
					'value' => 'header-style-2',
					'label' => esc_html__( 'Header Style 2', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/header-2.jpg'
				)
			);
		}

		if ( $field_id == 'footer_layout_select'  or $field_id == 'default_footer_style' ) {
			$array = array(
				array(
					'value' => 'footer-style-1',
					'label' => esc_html__( 'Footer Style 1', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/footer-1.jpg'
				),
				array(
					'value' => 'footer-style-2',
					'label' => esc_html__( 'Footer Style 2', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/footer-2.jpg'
				)
			);
		}

		if ( $field_id == 'blog_category_post_list_style' or $field_id == 'tag_tag_post_list_style' or $field_id == 'author_author_post_list_style' or $field_id == 'search_search_post_list_style' or $field_id == 'archive_archive_post_list_style' ) {
			$array = array(
				array(
					'value' => 'style1',
					'label' => esc_html__( 'Style 1', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/post-style1.jpg'
				),
				array(
					'value' => 'style2',
					'label' => esc_html__( 'Style 2', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/post-style2.jpg'
				)
			);
		}
		
		return $array;
	}
	add_filter( 'ot_radio_images', 'eventchamp_radio_image_selector', 10, 2 );

	/*======
	*
	* Fonts for Theme Options
	*
	======*/
	class eventchamp_font_settings {
		public  $ot_typography_id;
		public  $eventchamp_css_output = array();
		public  $eventchamp_font_output = array();
		public  $id_array = array();
		private $css_echo = array(
				'font-color' => 'color', 
				'font-family' => 'font-family', 
				'font-size' => 'font-size', 
				'font-style' => 'font-style',
				'font-variant'	=> 'font-variant',
				'font-weight' => 'font-weight',
				'letter-spacing' => 'letter-spacing',
				'line-height' => 'line-height',
				'text-decoration' => 'text-decoration',
				'text-transform' => 'text-transform'
				);

		/*====== Font List from Json  ======*/
		public function eventchamp_font_google_api(){
			ob_start();
			require get_template_directory() .'/include/assets/json/webfonts.json';
			$fonts_list = ob_get_clean();

			$fonts_list = json_decode( $fonts_list, true );
			if ( ! is_array( $fonts_list ) ) {
				$fonts_list = array();
			}
			$fonts = $fonts_list;

			$font_list_arrray = array();
			foreach ( $fonts['items'] as $key => $value) {
				$font_list_arrray[$value['family']] = $value['family'];
			}
			return $font_list_arrray;
		}
		
		/*====== Font Echo ======*/
		public function eventchamp_font_settings_echo($ot_typography_id,$selector, $default_font='Arial'){
			
			//$this->id_array[] = array('id'=>$ot_typography_id, 'default'=>$default_font );
			//Font Features Output
			$ot_typography_name = ot_get_option($ot_typography_id);

			if (!empty($ot_typography_name)) {
				$css = '';
				foreach ($ot_typography_name as $key => $value) {
					if ($this->css_echo[$key]=='font-family' && $value=='') {
						$value=$default_font;
					}
					if ($this->css_echo[$key]=='font-family') {
						$this->eventchamp_font_output[]=$value;
					}
					if (!empty($ot_typography_name[$key])) {
						$css .= $this->css_echo[$key].':'.$value.';';
					}
					if (empty($ot_typography_name['font-family'])) {
						if ($this->css_echo[$key]=='font-family') {
							$css .= 'font-family:'.$default_font .';';
						}
					}
				}
				$this->eventchamp_css_output[$ot_typography_id] = $selector."{".$css."}";
			}
			else{
				if( !empty( $default_font ) ) { 
					$this->eventchamp_css_output[$ot_typography_id] = 'font-family:'.$default_font.';';
					$this->eventchamp_css_output[$ot_typography_id] = $selector."{".'font-family:'.$default_font.';'."}";
					$this->eventchamp_font_output[]=$default_font;
				}
			}
			$font_echo = $this->eventchamp_font_output;										
		}

		/*====== CSS Output ======*/
		public function eventchamp_css_output(){
			$output = '';
			foreach ($this->eventchamp_css_output as $value) {
				$output .= $value."\n";
			}
			return $output;
		}

		/*====== CSS Echo ======*/
		public function eventchamp_css_echo($ot_typography_id,$selector, $where, $default=''){
			$css = '';
			//Background
			if ($where == 'backgroundType') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$ot_typography_id = ot_get_option( $ot_typography_id, array() );  
					if($ot_typography_id['background-color'] | $ot_typography_id['background-repeat'] | $ot_typography_id['background-attachment'] | $ot_typography_id['background-position'] | $ot_typography_id['background-image'] ){
						if( !empty( $ot_typography_id['background-color'] ) ) {
							$css .= $selector;
							$css .= "{background-color: " . $ot_typography_id['background-color'] . ";}";
						}

						if( !empty( $ot_typography_id['background-repeat'] ) ) {
							$css .= $selector;
							$css .= "{background-repeat: " . $ot_typography_id['background-repeat'] . ";}";
						}

						if( !empty( $ot_typography_id['background-attachment'] ) ) {
							$css .= $selector;
							$css .= "{background-attachment: " . $ot_typography_id['background-attachment'] . ";}";
						}

						if( !empty( $ot_typography_id['background-position'] ) ) {
							$css .= $selector;
							$css .= "{background-position: " . $ot_typography_id['background-position'] . ";}";
						}

						if( !empty( $ot_typography_id['background-image'] ) ) {
							$css .= $selector;
							$css .= "{background-image: url(" . $ot_typography_id['background-image'] . ");}";
						}

						if( !empty( $ot_typography_id['background-size'] ) ) {
							$css .= $selector;
							$css .= "{background-size: " . $ot_typography_id['background-size'] . ";}";
						}
					}
				}
			}

			//Background
			if ($where == 'background') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{background:'.ot_get_option($ot_typography_id).';}';
				}
			}

			//Background Color
			if ($where == 'background-color') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{background-color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			//Background Image
			if ($where == 'background-image') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{background-image:url('.ot_get_option($ot_typography_id).');}';
				}
			}

			//Border Color
			elseif ($where == 'border-color') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{border-color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'color') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'max-height') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{max-height:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'paddingTopBottom') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{padding:'.ot_get_option($ot_typography_id).' 0px;}';
				}
			}

			elseif ($where == 'stroke') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{stroke:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'border-top-color') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{border-top-color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'border-bottom-color') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{border-bottom-color:'.ot_get_option($ot_typography_id).';}';
				}
			}

			elseif ($where == 'just-code') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= '{'.ot_get_option($ot_typography_id).'}';
				}
			}

			elseif ($where == 'custom-css-code') {
				if (!empty(ot_get_option($ot_typography_id))) {
					$css .= $selector;
					$css .= ot_get_option($ot_typography_id);
				}
			}

			return $css;
		}

		/*====== Font Output ======*/
		public function eventchamp_font_output(){

			$ot_font_subset_latin = ot_get_option ('font_subsets_latin');
			$font_subsets_cyrillic = ot_get_option ('font_subsets_cyrillic');
			$font_subsets_greek = ot_get_option ('font_subsets_greek');

			if ($ot_font_subset_latin == 'on' && $font_subsets_cyrillic == 'on' && $font_subsets_greek == 'on') {
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,greek,greek-ext,latin-ext';
			}
			elseif ($ot_font_subset_latin == 'on' && $font_subsets_cyrillic == 'on') {
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,latin-ext';
			}
			elseif ($font_subsets_greek == 'on' && $font_subsets_cyrillic == 'on') {
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,greek,greek-ext';
			}
			elseif ($ot_font_subset_latin == 'on' && $font_subsets_greek == 'on') {
				$ot_font_subset_echo = 'greek,greek-ext,latin-ext';
			}
			elseif($ot_font_subset_latin == 'on'){
				$ot_font_subset_echo = 'latin-ext';
			}
			elseif($font_subsets_cyrillic == 'on'){
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext';
			}
			elseif($font_subsets_greek == 'on'){
				$ot_font_subset_echo = 'greek,greek-ext';
			}
			else{
				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,greek,greek-ext,latin-ext';
			}

			if (is_ssl()) {
				$ssl_control = 'https';
			}
			else{
				$ssl_control = 'http';
			}

			$fonts_url = '';
			$font_uniq = array_unique($this->eventchamp_font_output);
			foreach ($font_uniq as $value) {
				$font_name = str_replace(' ', '+', $value);
				$fonts_url .= "<link href='$ssl_control://fonts.googleapis.com/css?family=".$font_name.":200,300,400,500,600,700&subset=".$ot_font_subset_echo."' rel='stylesheet' type='text/css'>\n";
			}
			echo $fonts_url;
		}
	}
	add_filter( 'ot_recognized_font_families', array('eventchamp_font_settings','eventchamp_font_google_api'));

	/*======
	*
	* Design for Category
	*
	======*/
	function eventchamp_category_edit_settings( $term, $taxonomy ) {
		$eventchamp_category_sidebar_style  = get_term_meta( $term->term_id, 'eventchamp_category_sidebar_style', true );
		$eventchamp_category_category_post_list  = get_term_meta( $term->term_id, 'eventchamp_category_category_post_list', true );
		$eventchamp_category_title  = get_term_meta( $term->term_id, 'eventchamp_category_title', true );
	?>

		<tr class="form-field gloria-custom-admin-row gloria-custom-admin-row-column">
			<th scope="row" valign="top">
				<label><?php esc_html_e( 'Sidebar Style', 'eventchamp' ); ?></label>
			</th>
				
			<td>
				<div>
					<p>
						<input type="radio" name="eventchamp_category_sidebar_style" id="eventchamp-category-sidebar-1" value="nosidebar" class="radio" <?php if( $eventchamp_category_sidebar_style == 'nosidebar' ){ echo 'checked="checked"'; } ?>>
						<label for="eventchamp-category-sidebar-1"><img for="eventchamp-category-header-1" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/none-sidebar.jpg'; ?>" alt="<?php echo esc_html__( 'None Sidebar', 'eventchamp' ); ?>"></label>
					</p>
				</div>

				<div>
					<p>
						<input type="radio" name="eventchamp_category_sidebar_style" id="eventchamp-category-sidebar-2" value="left" class="radio" <?php if( $eventchamp_category_sidebar_style == 'left' ){ echo 'checked="checked"'; } ?>>
						<label for="eventchamp-category-sidebar-2"><img for="eventchamp-category-header-2" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/left-sidebar.jpg'; ?>" alt="<?php echo esc_html__( 'Left Sidebar', 'eventchamp' ); ?>"></label>
					</p>
				</div>

				<div>
					<p>
						<input type="radio" name="eventchamp_category_sidebar_style" id="eventchamp-category-sidebar-3" value="right" class="radio" <?php if( $eventchamp_category_sidebar_style == 'right' ){ echo 'checked="checked"'; } ?>>
						<label for="eventchamp-category-sidebar-3"><img for="eventchamp-category-header-3" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/right-sidebar.jpg'; ?>" alt="<?php echo esc_html__( 'Right Sidebar', 'eventchamp' ); ?>"></label>
					</p>
				</div>
			</td>
		</tr>

		<tr class="form-field gloria-custom-admin-row gloria-custom-admin-row-column">
			<th scope="row" valign="top">
				<label><?php esc_html_e( 'Post List Style', 'eventchamp' ); ?></label>
			</th>
				
			<td>
				<div>
					<p>
						<input type="radio" name="eventchamp_category_category_post_list" id="eventchamp-category-post-list-style-1" value="post-list-style-1" class="radio" <?php if( $eventchamp_category_category_post_list == 'post-list-style-1' ){ echo 'checked="checked"'; } ?>>
						<label for="eventchamp-category-post-list-style-1"><img for="eventchamp-category-post-list-style-1" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/post-style1.jpg'; ?>" alt="<?php echo esc_html__( 'Style 1', 'eventchamp' ); ?>"></label>
					</p>
				</div>

				<div>
					<p>
						<input type="radio" name="eventchamp_category_category_post_list" id="eventchamp-category-post-list-style-2" value="post-list-style-2" class="radio" <?php if( $eventchamp_category_category_post_list == 'post-list-style-2' ){ echo 'checked="checked"'; } ?>>
						<label for="eventchamp-category-post-list-style-2"><img for="eventchamp-category-post-list-style-2" src="<?php echo get_template_directory_uri() . '/include/assets/img/admin/post-style2.jpg'; ?>" alt="<?php echo esc_html__( 'Style 2', 'eventchamp' ); ?>"></label>
					</p>
				</div>
			</td>
		</tr>

		<tr class="form-field gloria-custom-admin-row gloria-custom-admin-row-column gloria-custom-admin-row-radio-active">
			<th scope="row" valign="top">
				<label><?php esc_html_e( 'Category Title', 'eventchamp' ); ?></label>
			</th>
				
			<td>
				<div>
					<p>
						<input type="radio" name="eventchamp_category_title" id="eventchamp-category-title-1" value="on" class="radio" <?php if( $eventchamp_category_title == 'on' ){ echo 'checked="checked"'; } ?>>
						<label for="eventchamp-category-title-1"><?php echo esc_html__( 'On', 'eventchamp' ); ?></label>
					</p>
				</div>

				<div>
					<p>
						<input type="radio" name="eventchamp_category_title" id="eventchamp-category-title-2" value="off" class="radio" <?php if( $eventchamp_category_title == 'off' ){ echo 'checked="checked"'; } ?>>
						<label for="eventchamp-category-title-2"><?php echo esc_html__( 'Off', 'eventchamp' ); ?></label>
					</p>
				</div>
			</td>
		</tr>

	  <?php
	}
	add_action( 'category_edit_form_fields', 'eventchamp_category_edit_settings', 10,2 );

	function eventchamp_category_settings_save( $term_id, $tt_id, $taxonomy ) { 
		if ( isset( $_POST['eventchamp_category_sidebar_style'] ) ) {
			update_term_meta( $term_id, 'eventchamp_category_sidebar_style', $_POST['eventchamp_category_sidebar_style'] );
		}

		if ( isset( $_POST['eventchamp_category_category_post_list'] ) ) {
			update_term_meta( $term_id, 'eventchamp_category_category_post_list', $_POST['eventchamp_category_category_post_list'] );
		}

		if ( isset( $_POST['eventchamp_category_title'] ) ) {
			update_term_meta( $term_id, 'eventchamp_category_title', $_POST['eventchamp_category_title'] );
		}
	}
	add_action( 'edit_term', 'eventchamp_category_settings_save', 10,3 );