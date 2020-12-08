<?php

/* HGroup
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('hgroup')) {
	function hgroup( $atts, $content = null) {

	    extract( shortcode_atts( array(
	        "type"     => "basic",
	        "title"    => "",
	        "subtitle" => "",
	        "link"     => "",
	        "el_class" => ""
	    ), $atts ) );

		if( !empty( $el_class ) ) {
	    	$el_class = ' ' . $el_class;
		}

		$link_close = '';

		if ( ! empty($link) ) {
			$link = '<a href="' . $link . '">';
			$link_close = '</a>';
		}

		if ( ! empty($subtitle) ) {
			if ( $type == 'basic' ) {
				$subtitle = '<h4 class="no-margin primary-color">' . $subtitle . '</h4>';
			} else {
				$subtitle = '<h6 class="no-margin primary-color">' . $subtitle . '</h6>';
			}
		}

		switch ( $type ) {
			case 'basic':
				$output = '<div class="' . $el_class . '">' . $subtitle . '<h1>' . $link . $title . $link_close . '</h1></div>';
				break;
			
			default:
				$output = '<div class="title' . $el_class . '">' . $subtitle . '<h2>' . $link . $title . $link_close . '</h2></div>';
				break;
		}

	    return $output;

	}

}

add_shortcode('hgroup', 'hgroup');