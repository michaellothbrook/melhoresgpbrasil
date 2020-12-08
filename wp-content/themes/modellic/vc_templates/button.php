<?php

/* Button
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('button')) {
	function button( $atts, $content = null) {

	    extract( shortcode_atts( array(
	        "size"      => "btn",
	        "link"      => "",
	        "icon"      => "",
	        "icon_pos"  => "",
	        "btn_align" => "",
	        "el_class"  => ""
	    ), $atts ) );

		if( !empty( $el_class ) ) {	$el_class .= ' ' . $el_class; }

	    if( !empty( $icon ) ) {	$icon = '<i class="icon-' . $icon . '"></i>'; }

        $link = ( $link == '||' ) ? '' : $link;
        $link = vc_build_link( $link );
        if ( strlen( $link['url'] ) > 0 ) {
            $a_href = esc_url( $link['url'] );
            $a_title = $link['title'];
            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
        }

		if( $icon_pos != 'after' ) {
			$output = '<div class="btn-container ' . $btn_align . '"><a href="' . $a_href . '" class="' . $size . $el_class . '" target="' . $a_target . '">' . $icon . $a_title . '</a></div>';
		} else {
			$output = '<div class="btn-container ' . $btn_align . '"><a href="' . $a_href . '" class="' . $size . $el_class . '" target="' . $a_target . '">' . $a_title . $icon . '</a></div>';
		}

	    return $output;

	}

}

add_shortcode('button', 'button');
