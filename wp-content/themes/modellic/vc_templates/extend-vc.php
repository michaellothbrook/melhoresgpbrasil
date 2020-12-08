<?php

$order_by_values = array(
	'',
	esc_html__( 'Date', 'modellic' ) => 'date',
	esc_html__( 'ID', 'modellic' ) => 'ID',
	esc_html__( 'Author', 'modellic' ) => 'author',
	esc_html__( 'Title', 'modellic' ) => 'title',
	esc_html__( 'Modified', 'modellic' ) => 'modified',
	esc_html__( 'Random', 'modellic' ) => 'rand',
	esc_html__( 'Comment count', 'modellic' ) => 'comment_count',
	esc_html__( 'Menu order', 'modellic' ) => 'menu_order',
);

$order_way_values = array(
	'',
	esc_html__( 'Descending', 'modellic' ) => 'DESC',
	esc_html__( 'Ascending', 'modellic' ) => 'ASC',
);

/* HGroup
-------------------------------------------------------------------------------------------------------------------*/

vc_map( array(
    "name"                    => esc_html__("HGroup", "modellic"),
    "base"                    => "hgroup",
    "description"             => esc_html__("Header group (title and subtitle)", "modellic"),
    "show_settings_on_create" => true,
    "weight"                  => 1,
    "category"                => 'Modellic Custom',
    "group"                   => 'Modellic Custom',
    "content_element"         => true,
    "params"                  => array(
		array(
		"type"       => "dropdown",
		"heading"    => esc_html__("Style", "modellic"),
		"param_name" => "type",
		"value" => array(
			"Basic"                  => "basic",
			"Alternative (centered)" => "alternative",
			),
		),
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Title", "modellic" ),
			"param_name"  => "title",
			"value"       => "",
		),
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Subtitle", "modellic" ),
			"param_name"  => "subtitle",
			"value"       => "",
		),
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "URL for Title", "modellic" ),
			"param_name"  => "link",
			"value"       => "",
		),
	    array(
	        "type"        => "textfield",
	        "heading"     => esc_html__("Extra class name", "modellic"),
	        "param_name"  => "el_class",
	        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modellic")
	    ),
    ),
) );

/* Pricing Table
-------------------------------------------------------------------------------------------------------------------*/

vc_map( array(
    "name"                    => esc_html__("Pricing Table", "modellic"),
    "base"                    => "pricing_table",
    "show_settings_on_create" => true,
    "weight"                  => 1,
    "category"                => 'Modellic Custom',
    "group"                   => 'Modellic Custom',
    "content_element"         => true,
    "params"                  => array(
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Title", "modellic" ),
			"param_name"  => "title",
			"value"       => "",
		),
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Price", "modellic" ),
			"param_name"  => "price",
			"value"       => "",
		),
    	array(
			"type"        => "textarea_html",
			"heading"     => esc_html__( "List", "modellic" ),
			"param_name"  => "content",
			"value"       => "<ul><li>List Item</li><li>List Item</li><li>List Item</li></ul>",
		),

    	array(
			"type"        => "dropdown",
			"class"       => "",
			"heading"     => esc_html__( "Button", "modellic" ),
			"param_name"  => "button",
			"value"       => array(
				'No Button'   => 'no-button',
				'Link'        => 'link',
				'Add to Cart' => 'buy',
				),
		),
        array(
            "type"        => "vc_link",
            "heading"     => esc_html__("Link", "modellic"),
            "param_name"  => "link",
			'dependency'  => array(
				'element' => 'button',
				'value'   => array( 'link' )
				),
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__("Product ID", "modellic"),
            "param_name"  => "product_id",
			'dependency'  => array(
				'element' => 'button',
				'value'   => array( 'buy' )
				),
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__("Button Text", "modellic"),
            "param_name"  => "button_text",
			'dependency'  => array(
				'element' => 'button',
				'value'   => array( 'buy' )
				),
        ),
	    array(
	        "type"        => "textfield",
	        "heading"     => esc_html__("Extra class name", "modellic"),
	        "param_name"  => "el_class",
	        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modellic")
	    ),
    ),
) );

/* Button
-------------------------------------------------------------------------------------------------------------------*/

vc_remove_element( "vc_btn" );

vc_map( array(
    "name"                    => esc_html__("Button", "modellic"),
    "base"                    => "button",
    "show_settings_on_create" => true,
    "weight"                  => 1,
    "category"                => 'Modellic Custom',
    "group"                   => 'Modellic Custom',
    "content_element"         => true,
    "params"                  => array(
    	array(
			"type"        => "dropdown",
			"class"       => "",
			"heading"     => esc_html__( "Size", "modellic" ),
			"param_name"  => "size",
			"value"       => array(
				'Normal' => 'btn',
				'Large'  => 'btn-large',
				),
		),
        array(
            "type"       => "vc_link",
            "heading"    => esc_html__("Link", "modellic"),
            "param_name" => "link",
        ),
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Icon", "modellic" ),
			"param_name"  => "icon",
			"value"       => "",
		),
    	array(
			"type"        => "dropdown",
			"class"       => "",
			"heading"     => esc_html__( "Icon Position", "modellic" ),
			"param_name"  => "icon_pos",
			"value"       => array(
				'Before' => 'before',
				'After'  => 'after',
				),
		),
    	array(
			"type"        => "dropdown",
			"class"       => "",
			"heading"     => esc_html__( "Button Align", "modellic" ),
			"param_name"  => "btn_align",
			"value"       => array(
				'Left'   => 'btn-left',
				'Center' => 'btn-center',
				'Right'  => 'btn-right',
				),
		),
	    array(
	        "type"        => "textfield",
	        "heading"     => esc_html__("Extra class name", "modellic"),
	        "param_name"  => "el_class",
	        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modellic")
	    ),
    ),
) );

/* Testimonials
-------------------------------------------------------------------------------------------------------------------*/

vc_map( array(
    "name"                    => esc_html__("Testimonial", "modellic"),
    "base"                    => "testimonial",
    "show_settings_on_create" => true,
    "weight"                  => 1,
    "category"                => 'Modellic Custom',
    "group"                   => 'Modellic Custom',
    "content_element"         => true,
    "params"                  => array(
    	array(
			"type"        => "dropdown",
			"class"       => "",
			"heading"     => esc_html__( "Show", "modellic" ),
			"param_name"  => "show",
			"value"       => array(
				'Random'       => 'random',
				'Latest'       => 'latest',
				'Selected ID' => 'selected',
				),
		),
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Selected ID", "modellic" ),
			"param_name"  => "posts_ids",
			"value"       => "",
			"description" => esc_html__( "Testimonial post ID, example: 95.", "modellic" ),
			'dependency'  => array(
				'element' => 'show',
				'value'   => array( 'selected' )
				),
		),
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Extra class name", "modellic" ),
			"param_name"  => "el_class",
			"value"       => "",
			"description" => esc_html__( "Style particular content element differently - add a class name and refer to it in custom CSS.", "modellic" ),
		),
    ),
) );

/* Instagram
-------------------------------------------------------------------------------------------------------------------*/

if( function_exists('display_instagram') ) {
	vc_map( array(
	    "name"                    => esc_html__("Instagram Feed", "modellic"),
	    "base"                    => "instagram-feed",
	    "show_settings_on_create" => false,
	    "weight"                  => 1,
	    "category"                => 'Modellic Custom',
	    "group"                   => 'Modellic Custom',
	    "content_element"         => true,
	) );
}

/* Favorites List
-------------------------------------------------------------------------------------------------------------------*/

if( class_exists('SimpleFavorites') ) {
	vc_map( array(
	    "name"                    => esc_html__("Favorites List", "modellic"),
	    "base"                    => "user_favorites",
	    "show_settings_on_create" => true,
	    "weight"                  => 1,
	    "category"                => 'Modellic Custom',
	    "group"                   => 'Modellic Custom',
	    "content_element"         => true,
	    "params"                  => array(
	    	array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Include Buttons", "modellic" ),
				"param_name" => "include_buttons",
				"value"      => array(
									'',
									esc_html__( "yes", "modellic" ) => 'true',
									esc_html__( "no", "modellic" ) => 'false'
									),
				),
	    	),
	) );
}

/* Recent Blog Posts
-------------------------------------------------------------------------------------------------------------------*/

vc_map( array(
    "name"                    => esc_html__("Recent Blog Posts", "modellic"),
    "base"                    => "recent-blog-posts",
    "show_settings_on_create" => true,
    "weight"                  => 1,
    "category"                => 'Modellic Custom',
    "group"                   => 'Modellic Custom',
    "content_element"         => true,
    "params"                  => array(
    	array(
			"type"        => "dropdown",
			"heading"     => esc_html__( "Posts", "modellic" ),
			"description" => esc_html__( "How many latest posts / columns to get.", "modellic" ),
			"param_name"  => "posts",
			"value"       => array(
				'2' => 2,
				'3' => 3,
				'4' => 4,
				),
		),
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Categories", "modellic" ),
			"param_name"  => "categories",
			"value"       => "",
			"description" => esc_html__( "Category ID or several ID's, example: 2,45,34.", "modellic" ),
		),
    	array(
			"type"        => "textfield",
			"heading"     => esc_html__( "Extra class name", "modellic" ),
			"param_name"  => "el_class",
			"value"       => "",
			"description" => esc_html__( "Style particular content element differently - add a class name and refer to it in custom CSS.", "modellic" ),
		),
    ),
) );

/* WP User Frontend Documentation
-------------------------------------------------------------------------------------------------------------------*/

if( class_exists('WP_User_Frontend') ) {

	vc_map( array(
	    "name"                    => esc_html__("WPUF Form", "modellic"),
	    "desciption"              => esc_html__("Show the form in a new page. Replace X with the form number.", "modellic"),
	    "base"                    => "wpuf_form",
	    "show_settings_on_create" => true,
	    "category"                => 'WP User Frontend',
	    "group"                   => 'WP User Frontend',
	    "content_element"         => true,
	    "params"                  => array(
	    	array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Form ID", "modellic" ),
				"param_name" => "id",
	    	),
	    ),
	) );

	vc_map( array(
	    "name"                    => esc_html__("WPUF Dashboard", "modellic"),
	    "base"                    => "wpuf_dashboard",
	    "show_settings_on_create" => true,
	    "category"                => 'WP User Frontend',
	    "group"                   => 'WP User Frontend',
	    "content_element"         => true,
	    "params"                  => array(
	    	array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Post Type (optional)", "modellic" ),
				"description" => esc_html__( "Loads specific post types in. Replace x with post type name. Like - 'products' for WooCommerce.", "modellic" ),
				"param_name"  => "post_type",
	    	),
	    ),
	) );

	vc_map( array(
	    "name"                    => esc_html__("WPUF Edit", "modellic"),
	    "description"             => esc_html__("Loads the form fields in the frontend to edit a post.", "modellic"),
	    "base"                    => "wpuf_edit",
	    "show_settings_on_create" => false,
	    "category"                => 'WP User Frontend',
	    "group"                   => 'WP User Frontend',
	    "content_element"         => true,
	) );

	vc_map( array(
	    "name"                    => esc_html__("WPUF Meta", "modellic"),
	    "desciption"              => esc_html__("Show post meta data in the frontend.", "modellic"),
	    "base"                    => "wpuf-meta",
	    "show_settings_on_create" => true,
	    "category"                => 'WP User Frontend',
	    "group"                   => 'WP User Frontend',
	    "content_element"         => true,
	    "params"                  => array(
	    	array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Meta Key", "modellic" ),
				"param_name"  => "name",
	    	),
	    	array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Type", "modellic" ),
				"param_name"  => "type",
	    	),
	    ),
	) );

	vc_map( array(
	    "name"                    => esc_html__("WPUF Subscription Packs", "modellic"),
	    "description"             => esc_html__("List all the published subscription packs.", "modellic"),
	    "base"                    => "wpuf_sub_pack",
	    "show_settings_on_create" => false,
	    "category"                => 'WP User Frontend',
	    "group"                   => 'WP User Frontend',
	    "content_element"         => true,
	) );

	vc_map( array(
	    "name"                    => esc_html__("WPUF Subscription Information", "modellic"),
	    "description"             => esc_html__("Show subscription information.", "modellic"),
	    "base"                    => "wpuf_sub_info",
	    "show_settings_on_create" => false,
	    "category"                => 'WP User Frontend',
	    "group"                   => 'WP User Frontend',
	    "content_element"         => true,
	) );

	vc_map( array(
	    "name"                    => esc_html__("WPUF Account", "modellic"),
	    "description"             => esc_html__("This shortcode creates an account page for the user with four other pages.", "modellic"),
	    "base"                    => "wpuf_account",
	    "show_settings_on_create" => false,
	    "category"                => 'WP User Frontend',
	    "group"                   => 'WP User Frontend',
	    "content_element"         => true,
	) );

}

?>
