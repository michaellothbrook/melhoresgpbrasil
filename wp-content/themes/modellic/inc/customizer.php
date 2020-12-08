<?php

$forms = get_posts(array(
    'post_type'     => 'wpcf7_contact_form',
    'numberposts'   => -1
));

$list_forms = array( 'disable' => 'Disable' );

foreach ( $forms as $form ) {
	$list_forms[ $form->ID ] = $form->post_title;
}


function modellic_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

$wc_attributes = $wc_attributes_conveterd = array();

if (function_exists('wc_get_attribute_taxonomies')) {
	$wc_attributes = wc_get_attribute_taxonomies();
}

foreach ($wc_attributes as $value) {
	$wc_attributes_conveterd[ 'pa_' . $value->attribute_name ] = $value->attribute_label;
}

$enable_disable = array(
    'on'  => esc_attr__( 'Enable', 'modellic' ),
    'off' => esc_attr__( 'Disable', 'modellic' )
);

$footer_columns = array( 'col s12' => 'full width', 'col s12 m9'  => '3/4', 'col s12 m8'  => '2/3', 'col s12 m6'  => '1/2', 'col s12 m4'  => '1/3', 'col s12 m3'  => '1/4', 'disabled' => 'disabled' );

// Config
Kirki::add_config( 'modellic', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );

/* Menus Mobile Nav Breakpoint
-------------------------------------------------------------------------------------------------------------------*/

Kirki::add_section( 'nav_breakpoint', array(
    'title'          => __( 'Mobile Navigation Breakpoint', 'modellic' ),
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'panel'          => 'nav_menus'
) );

	Kirki::add_field( 'modellic', array(
		'type'        => 'number',
		'settings'    => 'modellic_nav_breakpoint',
		'label'       => esc_attr__( 'Page Width In Pixels', 'modellic' ),
		'section'     => 'nav_breakpoint',
		'default'     => '990'
	) );

/* Header
-------------------------------------------------------------------------------------------------------------------*/

	Kirki::add_section( 'header', array(
	    'title'          => esc_html__( 'Header', 'modellic' ),
	    'priority'       => 100,
	    'capability'     => 'edit_theme_options',
	) );

		/* Cart icon */

		Kirki::add_field( 'modellic', array(
			'type'        => 'switch',
			'settings'    => 'cart_icon',
			'label'       => esc_html__( 'Show Cart Icon In Menu', 'modellic' ),
			'section'     => 'header',
			'default'     => 'on',
			'priority'    => 10,
			'choices'     => $enable_disable,
		) );

		/* Top bar enable */

		Kirki::add_field( 'modellic', array(
			'type'        => 'switch',
			'settings'    => 'top_bar',
			'label'       => esc_html__( 'Show Top Bar', 'modellic' ),
			'section'     => 'header',
			'default'     => 'on',
			'priority'    => 10,
			'choices'     => $enable_disable,
		) );

		/* Top bar text */

		Kirki::add_field( 'modellic', array(
			'type'        => 'code',
			'settings'    => 'top_bar_text',
			'label'       => esc_html__( 'Top Bar Text', 'modellic' ),
			'section'     => 'header',
			'default'     => '<li><span>Phone:</span> +1 800 234 567</li><li><span>Email:</span> <a href="mailto:info@modellic.com">info@modellic.com</a></li>',
			'priority'    => 10,
			'choices'     => array(
				'language' => 'html',
				'theme'    => 'monokai',
				'height'   => 250,
			),
		) );

/* Styling
-------------------------------------------------------------------------------------------------------------------*/

	Kirki::add_section( 'color_theme', array(
	    'title'          => esc_html__( 'Color Theme', 'modellic' ),
	    'priority'       => 100,
	    'capability'     => 'edit_theme_options',
	) );

		// Brand / Link Color

		Kirki::add_field( 'modellic', array(
		    'type'        => 'multicolor',
		    'settings'    => 'color_theme',
		    'label'       => esc_attr__( 'Brand / Link Color', 'modellic' ),
		    'section'     => 'color_theme',
		    'priority'    => 10,
		    'choices'     => array(
		        'accent'       => esc_attr__( 'Accent Color', 'modellic' ),
		        'accent_hover' => esc_attr__( 'Accent Hover Color', 'modellic' ),
		    ),
		    'default'     => array(
		        'accent'       => '#9c9057',
		        'accent_hover' => '#7d7346',
		    ),
		) );

		// Main color theme

		Kirki::add_field( 'modellic', array(
			'type'        => 'select',
			'settings'    => 'main_color_theme',
			'label'       => esc_html__( 'Main Color Theme', 'modellic' ),
			'section'     => 'color_theme',
			'default'     => 'dark',
			'priority'    => 10,
			'multiple'    => 1,
			'choices'     =>  array(
				'dark'    => 'Dark (customisable)',
				'white'   => 'White',
			),
		) );

		// Background colors

		Kirki::add_field( 'modellic', array(
		    'type'        => 'multicolor',
		    'settings'    => 'body_bg',
		    'label'       => esc_attr__( 'Body Background', 'modellic' ),
		    'section'     => 'color_theme',
		    'priority'    => 10,
		    'choices'     => array(
		        'body'          => esc_attr__( 'Body Background', 'modellic' ),
		        'header_footer' => esc_attr__( 'Header / Footer Bakground', 'modellic' ),
		    ),
		    'default'     => array(
		        'body'          => '#181818',
		        'header_footer' => '#0c0c0c',
		    ),
		    'active_callback' => [
				[
					'setting'  => 'main_color_theme',
					'operator' => '=',
					'value'    => 'dark',
				]
			],
		) );

		Kirki::add_field( 'modellic', [
			'type'        => 'color',
			'settings'    => 'border_color',
			'label'       => __( 'Border Color', 'modellic' ),
			'description' => esc_html__( 'Line color all over the theme - borders, separators, decorative elements etc.', 'modellic' ),
			'section'     => 'color_theme',
			'default'     => '#282828',
		    'active_callback' => [
				[
					'setting'  => 'main_color_theme',
					'operator' => '=',
					'value'    => 'dark',
				]
			],
		] );

/* Typography
-------------------------------------------------------------------------------------------------------------------*/

	Kirki::add_section( 'theme_typography', array(
	    'title'          => esc_html__( 'Typography', 'modellic' ),
	    'priority'       => 100,
	    'capability'     => 'edit_theme_options',
	) );

		Kirki::add_field( 'modellic', [
			'type'        => 'typography',
			'settings'    => 'modellic-body_font',
			'label'       => esc_html__( 'Body', 'modellic' ),
			'section'     => 'theme_typography',
			'default'     => [
				'font-family'    => 'Montserrat',
				'variant'        => '300',
				'font-size'      => '17px',
				'line-height'    => '1.6',
				'color'          => '#181818',
				'text-transform' => 'none',
			],
			'priority'    => 10,
			'transport'   => 'auto',
			'choices' => [
				'fonts' => [
					'standard' => [
						'Georgia, Times, serif',
						'Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif',
					],
				],
			],
		] );

		Kirki::add_field( 'modellic', [
			'type'        => 'typography',
			'settings'    => 'modellic-headings_font',
			'label'       => esc_html__( 'Headings', 'modellic' ),
			'section'     => 'theme_typography',
			'default'     => [
				'font-family'    => 'Montserrat',
				'variant'        => '700',
				'color'          => '#ffffff',
				'text-transform' => 'uppercase',
			],
			'priority'    => 10,
			'transport'   => 'auto',
			'choices' => [
				'fonts' => [
					'standard' => [
						'Georgia, Times, serif',
						'Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif',
					],
				],
			],
		] );

		Kirki::add_field( 'modellic', [
			'type'        => 'typography',
			'settings'    => 'modellic-navigation_font',
			'label'       => esc_html__( 'Main Menu', 'modellic' ),
			'section'     => 'theme_typography',
			'default'     => [
				'font-family'    => 'Montserrat',
				'variant'        => '300',
				'color'          => '#ffffff',
				'text-transform' => 'uppercase',
			],
			'priority'    => 10,
			'transport'   => 'auto',
			'choices' => [
				'fonts' => [
					'standard' => [
						'Georgia, Times, serif',
						'Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif',
					],
				],
			],
		] );

		Kirki::add_field( 'modellic', [
			'type'        => 'typography',
			'settings'    => 'modellic-logo_font',
			'label'       => esc_html__( 'Logo', 'modellic' ),
			'section'     => 'theme_typography',
			'default'     => [
				'font-family'    => 'Montserrat',
				'variant'        => '700',
				'color'          => '#ffffff',
				'text-transform' => 'uppercase',
			],
			'priority'    => 10,
			'transport'   => 'auto',
			'choices' => [
				'fonts' => [
					'standard' => [
						'Georgia, Times, serif',
						'Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif',
					],
				],
			],
		] );

/* Shop
-------------------------------------------------------------------------------------------------------------------*/

	Kirki::add_panel( 'shop', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Shop', 'modellic' ),
	) );

		// Archives

		Kirki::add_section( 'shop-archives', array(
		    'title'          => esc_html__( 'Archives', 'modellic' ),
		    'priority'       => 100,
		    'panel'          => 'shop',
		    'capability'     => 'edit_theme_options',
		) );

			// Layout

			Kirki::add_field( 'color_theme', array(
				'type'        => 'select',
				'settings'    => 'modellic-archive_template',
				'label'       => esc_html__( 'Layout', 'modellic' ),
				'section'     => 'shop-archives',
				'default'     => 'standard',
				'priority'    => 10,
				'choices'     =>  array(
					'standard'  => 'standard',
					'fullwidth' => 'full width'
				),
			) );

			// Product columns

			Kirki::add_field( 'modellic', array(
				'type'        => 'select',
				'settings'    => 'modellic-archive_columns',
				'label'       => esc_html__( 'Desktop Product Columns', 'modellic' ),
				'section'     => 'shop-archives',
				'default'     => '3',
				'priority'    => 10,
				'choices'     =>  array(
						'1' => 1,
						'2' => 2,
						'3' => 3,
						'4' => 4,
						'5' => 5,
						'6' => 6,
					),
			) );

			Kirki::add_field( 'modellic', array(
				'type'        => 'select',
				'settings'    => 'modellic-archive_columns_sidebar',
				'label'       => esc_html__( 'Sidebar Desktop Product Columns', 'modellic' ),
				'description' => esc_html__( 'This settings will be used instead of "Desktop Product Columns" on product archive pages with sidebar.', 'modellic' ),
				'section'     => 'shop-archives',
				'default'     => '3',
				'priority'    => 10,
				'choices'     =>  array(
						'1' => 1,
						'2' => 2,
						'3' => 3,
						'4' => 4,
						'5' => 5,
						'6' => 6,
					),
			) );

			// Tablet product columns

			Kirki::add_field( 'modellic', array(
				'type'        => 'select',
				'settings'    => 'modellic-tablet_columns',
				'label'       => esc_html__( 'Tablet Product Columns', 'modellic' ),
				'section'     => 'shop-archives',
				'default'     => '2',
				'priority'    => 10,
				'choices'     =>  array(
						'1' => 1,
						'2' => 2,
						'3' => 3,
						'4' => 4,
						'5' => 5,
						'6' => 6,
					),
			) );

			Kirki::add_field( 'modellic', array(
				'type'        => 'select',
				'settings'    => 'modellic-tablet_columns_sidebar',
				'label'       => esc_html__( 'Sidebar Tablet Product Columns', 'modellic' ),
				'description' => esc_html__( 'This settings will be used instead of "Tablet Product Columns" on product archive pages with sidebar.', 'modellic' ),
				'section'     => 'shop-archives',
				'default'     => '2',
				'priority'    => 10,
				'choices'     =>  array(
						'1' => 1,
						'2' => 2,
						'3' => 3,
						'4' => 4,
						'5' => 5,
						'6' => 6,
					),
			) );

			// Mobile product columns

			Kirki::add_field( 'modellic', array(
				'type'        => 'select',
				'settings'    => 'modellic-mobile_columns',
				'label'       => esc_html__( 'Mobile Product Columns', 'modellic' ),
				'section'     => 'shop-archives',
				'default'     => '1',
				'priority'    => 10,
				'choices'     =>  array(
						'1' => 1,
						'2' => 2,
						'3' => 3,
						'4' => 4,
					),
			) );

			// Product per page

			Kirki::add_field( 'modellic', array(
				'type'        => 'number',
				'settings'    => 'modellic-products_per_page',
				'label'       => esc_html__( 'Product Per Page', 'modellic' ),
				'section'     => 'shop-archives',
				'priority'    => 10,
				'default'     => 12,
				'choices'     => [
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				],
			) );

			// Show / hide sort and number of products

			Kirki::add_field( 'modellic', array(
				'type'        => 'switch',
				'settings'    => 'modellic-number_sorting',
				'label'       => esc_html__( 'Number Of Products And Sorting', 'modellic' ),
				'section'     => 'shop-archives',
				'default'     => '0',
				'priority'    => 10,
				'transport'   => 'refresh',
				'choices'     => $enable_disable,
			) );

			// Show attributes

			Kirki::add_field( 'modellic', array(
				'type'        => 'multicheck',
				'settings'    => 'modellic_show_attributes',
				'label'       => esc_html__( 'Show Attribues', 'modellic' ),
				'description' => esc_html__( 'Select which attributes you want to show on product item by hover. If none selected means no hover overlay.', 'modellic' ),
				'section'     => 'shop-archives',
				'default'     => '',
				'priority'    => 10,
				'choices'     => $wc_attributes_conveterd,
			) );

		// Product Single

		Kirki::add_section( 'single-product', array(
		    'title'          => esc_html__( 'Single Product', 'modellic' ),
		    'priority'       => 100,
		    'panel'          => 'shop',
		    'capability'     => 'edit_theme_options',
		) );

			// Gallery

			Kirki::add_field( 'modellic', array(
				'type'        => 'select',
				'settings'    => 'modellic-gallery_type',
				'label'       => esc_html__( 'Gallery Type', 'modellic' ),
				'section'     => 'single-product',
				'default'     => 'horizontal',
				'priority'    => 10,
				'choices'     =>  array(
					'horizontal' => 'Horizontal',
					'vertical'   => 'Vertical',
				),
			) );

			// Horizontal gallery position

			Kirki::add_field( 'modellic', array(
				'type'        => 'select',
				'settings'    => 'modellic-horizontal_gallery_position',
				'label'       => esc_html__( 'Horizontal Gallery Position', 'modellic' ),
				'description' => esc_html__( 'Gallery position related to page title', 'modellic' ),
				'section'     => 'single-product',
				'default'     => 'before',
				'priority'    => 10,
				'choices'     => array(
					'before' => 'Before',
					'after'  => 'After',
				),
				'active_callback' => [
					[
						'setting'  => 'modellic-gallery_type',
						'operator' => '=',
						'value'    => 'horizontal',
					]
				],
			) );

			// Booking Form

			if (class_exists('WPCF7')) {
				Kirki::add_field( 'modellic', array(
					'type'        => 'select',
					'settings'    => 'modellic-booking_form',
					'label'       => esc_html__( 'Booking Form', 'modellic' ),
					'section'     => 'single-product',
					'default'     => 'none',
					'priority'    => 10,
					'multiple'    => 0,
					'choices'     =>  $list_forms,
				) );
			}

		/* Show Product Categories & Tags */

		Kirki::add_field( 'modellic', array(
			'type'        => 'switch',
			'settings'    => 'modellic-product_categories_tags',
			'label'       => esc_html__( 'Show Categories & Tags', 'modellic' ),
			'section'     => 'single-product',
			'default'     => 'on',
			'priority'    => 10,
			'choices'     => $enable_disable,
		) );

		/* Show Price And Add To Cart */

		Kirki::add_field( 'modellic', array(
			'type'        => 'switch',
			'settings'    => 'modellic-price_add_to_cart',
			'label'       => esc_html__( 'Show Price And Add To Cart', 'modellic' ),
			'section'     => 'single-product',
			'default'     => 'on',
			'priority'    => 10,
			'choices'     => $enable_disable,
		) );

		// Product attributes suffix

		Kirki::add_section( 'attributes', array(
		    'title'          => esc_html__( 'Product Attributes Suffixes', 'modellic' ),
		    'priority'       => 100,
		    'panel'          => 'shop',
		    'capability'     => 'edit_theme_options',
		) );

		foreach ($wc_attributes as $attribute) {

			$attribute_name = 'pa_' . $attribute->attribute_name;

			Kirki::add_field( 'modellic', array(
				'type'     => 'text',
				'settings' => $attribute_name,
				'label'    => $attribute->attribute_label,
				'section'  => 'attributes',
				'priority' => 10,
			) );

		}

/* Footer Settings
-------------------------------------------------------------------------------------------------------------------*/

Kirki::add_section( 'footer', array(
    'title'          => esc_html__( 'Footer', 'modellic' ),
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
) );

	// Footer Text

	$copyright = wp_kses_post( __( '&copy; 2015 Modellic. Web design &amp; development by <a href="http://coffeecreamthemes.com" target="_blank">Coffeecreamthemes.com</a>', 'modellic' ) );

	Kirki::add_field( 'modellic', array(
		'type'        => 'code',
		'settings'    => 'footer_text',
		'label'       => esc_html__( 'Footer Text', 'modellic' ),
		'section'     => 'footer',
		'default'     => $copyright,
		'priority'    => 10,
		'choices'     => array(
			'language' => 'html',
			'theme'    => 'monokai',
			'height'   => 250,
		),
	) );

	/* Widgetized footer */

	Kirki::add_field( 'modellic', array(
		'type'        => 'switch',
		'settings'    => 'widgetized_footer',
		'label'       => esc_html__( 'Widgetized Footer', 'modellic' ),
		'section'     => 'footer',
		'default'     => 'on',
		'priority'    => 10,
		'choices'     => $enable_disable,
	) );

	// Footer Widget Area 1

	Kirki::add_field( 'modellic', array(
		'type'        => 'select',
		'settings'    => 'footer_sidebar_1',
		'label'       => esc_html__( 'Footer Sidebar Column 1', 'modellic' ),
		'section'     => 'footer',
		'default'     => 'col s12 m3',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => $footer_columns,
	) );

	// Footer Widget Area 2

	Kirki::add_field( 'modellic', array(
		'type'        => 'select',
		'settings'    => 'footer_sidebar_2',
		'label'       => esc_html__( 'Footer Sidebar Column 2', 'modellic' ),
		'section'     => 'footer',
		'default'     => 'col s12 m3',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => $footer_columns,
	) );

	// Footer Widget Area 3

	Kirki::add_field( 'modellic', array(
		'type'        => 'select',
		'settings'    => 'footer_sidebar_3',
		'label'       => esc_html__( 'Footer Sidebar Column 3', 'modellic' ),
		'section'     => 'footer',
		'default'     => 'col s12 m3',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => $footer_columns,
	) );

	// Footer Widget Area 4

	Kirki::add_field( 'modellic', array(
		'type'        => 'select',
		'settings'    => 'footer_sidebar_4',
		'label'       => esc_html__( 'Footer Sidebar Column 4', 'modellic' ),
		'section'     => 'footer',
		'default'     => 'col s12 m3',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => $footer_columns,
	) );

/* CSS
-------------------------------------------------------------------------------------------------------------------*/

/**
* Convert a hexa decimal color code to its RGB equivalent
*
* @param string $hexStr (hexadecimal color value)
* @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
* @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
* @return array or string (depending on second parameter. Returns False if invalid hex color value)
*/
function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

/**
 * Apply our custom background color to the <body> of the document.
 */
function modellic_custom_styles() {

ob_start();

$defaults = array(
	'accent'       => '#9c9057',
	'accent_hover' => '#7d7346',
);

$defaults_bg = array(
    'body'          => '#181818',
    'header_footer' => '#0c0c0c',
);

$color_theme = get_theme_mod( 'color_theme', $defaults );
$body_bg = get_theme_mod( 'body_bg', $defaults_bg );
$border_color = get_theme_mod( 'border_color', '#282828' );
$theme_logo_id = get_theme_mod( 'custom_logo' );

if ( ! empty( $theme_logo_id ) ) {

	$theme_logo = wp_get_attachment_metadata( $theme_logo_id );

	$header_height = $theme_logo['height'] + 30;
	$header_height_top_bar = $theme_logo['height'] + 91; ?>

	nav, nav .nav-wrapper i, nav a.button-collapse, nav a.button-collapse i {
		height: <?php echo $header_height; ?>px;
		line-height: <?php echo $header_height; ?>px;
	}

	@media only screen and (min-width: <?php echo get_theme_mod( 'modellic_nav_breakpoint', '990' ); ?>px) {
		nav, nav .nav-wrapper i, nav a.button-collapse, nav a.button-collapse i {
		    height: <?php echo $header_height; ?>px;
		    line-height: <?php echo $header_height; ?>px;
		}
	}

	body.top-bar-0 {
		padding-top: <?php echo $header_height; ?>px;
	}

	body.top-bar-1 {
		padding-top: <?php echo $header_height_top_bar; ?>px;
	}

<?php } ?>

body, div.bg-overlay:before, #sidebar-wrapper #sidebar,
#sidebar .select2-selection, body .select2-dropdown,
body .select2-container--default .select2-search--dropdown .select2-search__field { background: <?php echo esc_attr( $body_bg['body'] ); ?>; }
#horizontal-gallery::-webkit-scrollbar-thumb { border-color: <?php echo esc_attr( $body_bg['body'] ); ?>; }

#header, #pre-footer, .price-table h4, .favorites-list li:hover, #header li:hover, .dropdown-content, input[type="text"], input[type="password"], input[type="email"], input[type="url"], input[type="time"], input[type="date"], input[type="datetime-local"], input[type="tel"], input[type="number"], input[type="search"], textarea, select
{ background: <?php echo esc_attr( $body_bg['header_footer'] ); ?>; }
body ul.wpuf_packs h3, body ul.wpuf_packs h3 { background: <?php echo esc_attr( $body_bg['header_footer'] ); ?> !important; }

.products .product a .hover { background: rgba(<?php echo hex2RGB( $body_bg['body'], true); ?>, .85); }

body.page-template-page-blank #header.no-background {
	background: linear-gradient(to bottom, rgba(<?php echo hex2RGB( $body_bg['header_footer'], true); ?>,0.7) 0%, rgba(<?php echo hex2RGB( $body_bg['header_footer'], true); ?>,0.33) 40%, rgba(<?php echo hex2RGB( $body_bg['header_footer'], true); ?>,0) 100%);
}

a, #header .sidenav-trigger, .primary-color, .theme-white .primary-color, address:before, footer address:before, footer .phone:before, footer .email:before, #header ul li a:hover, #header #tools a:hover, #header ul li.active > a, #header ul li a.active, ul > li:before, blockquote:before, .share a i, #pre-footer address:before, #pre-footer .phone:before, #pre-footer .email:before, #sidebar .widget.widget_facet h6:before, .simplefavorite-button, .simplefavorite-button:focus, .latest-post .date, body .facetwp-star:hover, body .facetwp-star:hover ~ .facetwp-star, body .facetwp-star.selected, body .facetwp-star.selected ~ .facetwp-star, #sidebar .widget.widget_facet h3:before, body .wpuf-menu-item.active a, .woocommerce-MyAccount-navigation li.is-active a,
input.select2-search__field::placeholder,
body .select2-container--default .select2-selection--single .select2-selection__placeholder,
body .select2-container--default .select2-selection--single .select2-selection__rendered {
	color: <?php echo esc_attr( $color_theme['accent'] ); ?>;
}
body .select2-container--default .select2-selection--single .select2-selection__arrow b { border-top-color: <?php echo esc_attr( $color_theme['accent'] ); ?>; }

.brand-color, .star-rating span:before {
	color: <?php echo esc_attr( $color_theme['accent'] ); ?> !important;
}

a:hover, .tabs .tab a:hover, body .facetwp-star:hover, body .facetwp-page:hover {
	color: <?php echo esc_attr( $color_theme['accent_hover'] ); ?>;
}

.onsale:before, .btn, .submit, .button, .btn, .btn-large, .btn:focus, .btn-large:focus, input[type=submit], input[type=submit]:focus, .price-table h3, .title h1:before, .title h1:after, .woocommerce-pagination ul li .current, .pagination .current, #header .dropdown-content li:hover, #header .dropdown-content li.active, .title h1:before, .title h1:after, .row.title h1:before, .row.title h1:after, button, input[type="submit"], .title h2:before, .title h2:after, .woocommerce-products-header h1:before, .woocommerce-products-header h1:after, .wc-tabs li.active a, body .facetwp-page.active, #sidebar .widget.widget_facet .noUi-connect, #sidebar .widget.widget_facet .noUi-horizontal .noUi-handle, #sidebar .widget.widget_facet .noUi-horizontal .noUi-handle.noUi-active, body #infinite-handle span button {
	background-color: <?php echo esc_attr( $color_theme['accent'] ); ?>;
}
body ul.wpuf_packs .wpuf-sub-button a,
body ul.wpuf_packs .wpuf-sub-button a {
	background-color: <?php echo esc_attr( $color_theme['accent'] ); ?> !important;
}

.spinner-blue, .spinner-blue-only, .simplefavorite-button, .simplefavorite-button:focus {
	border-color: <?php echo esc_attr( $color_theme['accent'] ); ?>;
}

.wc-bookings-date-picker .ui-datepicker td.bookable a, .tabs .indicator {
	background-color: <?php echo esc_attr( $color_theme['accent'] ); ?> !important;
}

.btn:hover, .submit:hover, .button:hover, .btn:hover, .btn-large:hover, input[type=submit]:hover, .simplefavorite-button:hover, .wc-tabs li a:hover {
	background-color: <?php echo esc_attr( $color_theme['accent_hover'] ); ?>;
}
body ul.wpuf_packs .wpuf-sub-button a:hover,
body ul.wpuf_packs .wpuf-sub-button a:hover {
	background-color: <?php echo esc_attr( $color_theme['accent_hover'] ); ?> !important;
	box-shadow: none;
}

#pre-footer ul li a,
#pre-footer .widget_archive ul li,
#pre-footer .widget_categories ul li,
#pre-footer .widget_recent_comments ul li,
#pre-footer .widget_rss ul li,
.price-table,
.price-table li,
body ul.wpuf_packs .wpuf-sub-desciption li,
body ul.wpuf_packs .wpuf-sub-desciption li:last-child,
#sidebar .widget.widget_facet,
.woocommerce-pagination a, .woocommerce-pagination span, .facetwp-pager a, .facetwp-pager span,
th, td,
.vc_separator .vc_sep_holder .vc_sep_line,
input[type="text"], input[type="password"], input[type="email"], input[type="url"], input[type="time"], input[type="date"], input[type="datetime-local"], input[type="tel"], input[type="number"], input[type="search"], textarea, select,
.wc-tabs,
#reviews #review_form_wrapper,
.stars a,
#sidebar .widget > ul li,
.container .latest-post,
.divider,
.woocommerce-MyAccount-navigation ul,
.favorites-list li,
.dropdown-content li > a,
#sidebar .select2-selection, body .select2-dropdown,
body .select2-container--default .select2-search--dropdown .select2-search__field {
	border-color: <?php echo esc_attr( $border_color ); ?>;
}
#pre-footer ul li a:before {
	color: <?php echo esc_attr( $border_color ); ?>;
}

@media (max-width: <?php echo get_theme_mod( 'modellic_nav_breakpoint', '990' ); ?>px) {
	#header .sidenav-trigger {
		display: block;
	}
	.sidenav {
	    position: fixed;
	    width: 75%;
	    left: 0;
	    top: 0;
	    margin: 0;
	    transform: translateX(-100%);
	    height: 100%;
	    height: calc(100% + 60px);
	    padding-bottom: 60px;
	    background: <?php echo esc_attr( $body_bg['body'] ); ?>;
	    z-index: 999;
	    overflow-y: auto;
	    will-change: transform;
	    backface-visibility: hidden;
	    transform: translateX(-105%);
	}
	.theme-white #mobile-nav { background-color: #fff; }
	.sidenav .collapsible { margin: 0; }
	.sidenav li { float: none; position: relative; border-bottom: <?php echo esc_attr( $border_color ); ?> 1px solid; }
	nav .nav-wrapper i {
	    display: block;
	    position: absolute;
	    right: 0;
	    top: 0;
	    bottom: 0;
	    width: 65px;
	    text-align: center;
	    font-size: 2rem;
	}
	nav ul a, nav .nav-wrapper i {
	    font-size: 1.5rem;
	}
	nav .nav-wrapper i.icon-angle-down {
	    font-size: 2rem;
	    border-left: <?php echo esc_attr( $border_color ); ?> 1px solid;
	}
	.theme-white .sidenav li,
	.theme-white nav .nav-wrapper i.icon-angle-down { border-color: #ddd; }
	.dropdown-content {
		border-top: <?php echo esc_attr( $border_color ); ?> 1px solid;
		position: static;
		opacity: 1;
	}
	.dropdown-content li > a {
		font-size: 1.25rem;
		padding-left: 2rem;
	}
	.admin-bar .has-background .sidenav {
		margin-top: 0;
	}
	body {
		padding-top: 67px;
	}
  body.top-bar-1 {
    padding-top: 123px;
  }
}

@media (min-width: <?php echo get_theme_mod( 'modellic_nav_breakpoint', '990' ); ?>px) {
	#header .dropdown:hover > .dropdown-content {
		display: block;
		opacity: 1;
	}
}

<?php
$body_font = get_theme_mod('modellic-body_font');
$headings_font = get_theme_mod('modellic-headings_font');
$navigation_font = get_theme_mod('modellic-navigation_font');
$logo_font = get_theme_mod('modellic-logo_font');
?>

body {
<?php if ( ! empty( $body_font['font-family'] ) ): ?>font-family: <?php echo $body_font['font-family']; ?>;<?php endif; ?>
<?php if ( ! empty( $body_font['variant'] ) ): ?>font-variant: <?php echo $body_font['variant']; ?>;<?php endif; ?>
<?php if ( ! empty( $body_font['font-weight'] ) ): ?>font-weight: <?php echo $body_font['font-weight']; ?>;<?php endif; ?>
<?php if ( ! empty( $body_font['font-size'] ) ): ?>font-size: <?php echo $body_font['font-size']; ?>;<?php endif; ?>
<?php if ( ! empty( $body_font['line-height'] ) ): ?>line-height: <?php echo $body_font['line-height']; ?>;<?php endif; ?>
<?php if ( ! empty( $body_font['color'] ) ): ?>color: <?php echo $body_font['color']; ?>;<?php endif; ?>
<?php if ( ! empty( $body_font['text-transform'] ) ): ?>text-transform: <?php echo $body_font['text-transform']; ?>;<?php endif; ?>
}

h1, h2, h3, h4, h5, h6, h7, .tp-caption, #sidebar .widget.widget_facet h3, .wpuf-sub-cost, body ul.wpuf_packs h3, body ul.wpuf_packs h3, .post-password-form p:first-child {
<?php if ( ! empty( $headings_font['font-family'] ) ): ?>font-family: <?php echo $headings_font['font-family']; ?>;<?php endif; ?>
<?php if ( ! empty( $headings_font['variant'] ) ): ?>font-variant: <?php echo $headings_font['variant']; ?>;<?php endif; ?>
<?php if ( ! empty( $headings_font['font-weight'] ) ): ?>font-weight: <?php echo $headings_font['font-weight']; ?>;<?php endif; ?>
<?php if ( ! empty( $headings_font['color'] ) ): ?>color: <?php echo $headings_font['color']; ?>;<?php endif; ?>
<?php if ( ! empty( $headings_font['text-transform'] ) ): ?>text-transform: <?php echo $headings_font['text-transform']; ?>;<?php endif; ?>
}

#header li a {
<?php if ( ! empty( $navigation_font['font-family'] ) ): ?>font-family: <?php echo $navigation_font['font-family']; ?>;<?php endif; ?>
<?php if ( ! empty( $navigation_font['variant'] ) ): ?>font-variant: <?php echo $navigation_font['variant']; ?>;<?php endif; ?>
<?php if ( ! empty( $navigation_font['font-weight'] ) ): ?>font-weight: <?php echo $navigation_font['font-weight']; ?>;<?php endif; ?>
<?php if ( ! empty( $navigation_font['color'] ) ): ?>color: <?php echo $navigation_font['color']; ?>;<?php endif; ?>
<?php if ( ! empty( $navigation_font['text-transform'] ) ): ?>text-transform: <?php echo $navigation_font['text-transform']; ?>;<?php endif; ?>
}

nav .custom-logo-link {
<?php if ( ! empty( $logo_font['font-family'] ) ): ?>font-family: <?php echo $logo_font['font-family']; ?>;<?php endif; ?>
<?php if ( ! empty( $logo_font['variant'] ) ): ?>font-variant: <?php echo $logo_font['variant']; ?>;<?php endif; ?>
<?php if ( ! empty( $logo_font['font-weight'] ) ): ?>font-weight: <?php echo $logo_font['font-weight']; ?>;<?php endif; ?>
<?php if ( ! empty( $logo_font['color'] ) ): ?>color: <?php echo $logo_font['color']; ?>;<?php endif; ?>
<?php if ( ! empty( $logo_font['text-transform'] ) ): ?>text-transform: <?php echo $logo_font['text-transform']; ?>;<?php endif; ?>
}

	<?php

	$style = ob_get_contents();
	ob_end_clean();

	// Add the CSS inline.
	// Please note that you must first enqueue the actual 'modellic-style' stylesheet.
	// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples
	wp_add_inline_style( 'modellic-style', $style );

}
add_action( 'wp_enqueue_scripts', 'modellic_custom_styles', 130 );

/**
 * Cache the customizer styles
 */
function modellic_customizer_styles_cache() {
	global $wp_customize;

	// Check we're not on the Customizer.
	// If we're on the customizer then DO NOT cache the results.
	if ( ! isset( $wp_customize ) ) {

		// Get the theme_mod from the database
		$data = get_theme_mod( 'modellic_customizer_styles', false );

		// If the theme_mod does not exist, then create it.
		if ( $data == false ) {
			// We'll be adding our actual CSS using a filter
			$data = apply_filters( 'modellic_styles_filter', null );
			// Set the theme_mod.
			set_theme_mod( 'modellic_customizer_styles', $data );
		}

	// If we're on the customizer, get all the styles using our filter
	} else {

		$data = apply_filters( 'modellic_styles_filter', null );

	}

	// Add the CSS inline.
	// Please note that you must first enqueue the actual 'modellic-style' stylesheet.
	// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples
	wp_add_inline_style( 'modellic-style', $data );

}
add_action( 'wp_enqueue_scripts', 'modellic_customizer_styles_cache', 130 );

/**
 * Reset the cache when saving the customizer
 */
function modellic_reset_style_cache_on_customizer_save() {

	remove_theme_mod( 'modellic_customizer_styles' );

}
add_action( 'customize_save_after', 'modellic_reset_style_cache_on_customizer_save' );

?>
