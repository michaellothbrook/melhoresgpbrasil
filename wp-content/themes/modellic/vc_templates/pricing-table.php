<?php

/* Pricing Table
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('pricing_table')) {
	function pricing_table($atts, $content = null) {
        $args = array(
            "title"       => "",
            "price"       => "",
            "button"      => "",
            "link"        => "",
            "product_id"  => "",
            "button_text" => "",
            "el_class"    => ""
        );
	        
		extract(shortcode_atts($args, $atts));

        if( !empty( $el_class ) ) {
            $el_class = ' ' . $el_class;
        }

        $output = '<div class="price-table' . $el_class . '">'; 

            $output .= '<h4>' . $title . '</h4><h3>' . $price . '</h3>';

            $output .= '<ul>';

                $output .= strip_tags($content, '<li>');

            $output .= '</ul>';

            switch ($button) {
                case 'link':
                    $link = ( $link == '||' ) ? '' : $link;
                    $link = vc_build_link( $link );
                    $use_link = false;
                    if ( strlen( $link['url'] ) > 0 ) {
                        $use_link = true;
                        $a_href = esc_url( $link['url'] );
                        $a_title = $link['title'];
                        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                    }
                    $output .= '<p><a href="' . $a_href . '" class="btn" target="' . $a_target . '">' . $a_title . '</a></p>';
                    break;
                case 'buy':
                    global $woocommerce;
                    if( !empty($woocommerce) ) {
                        $cart_url = $woocommerce->cart->get_cart_url();
                        $output .= '<p><a href="' . $cart_url . '?add-to-cart=' . $product_id . '" class="btn">' . $button_text . '</a></p>';
                    }
                    break;                
                default:
                    break;
            }

        $output .= '</div>'; 
            	    
	    return $output;
	}
}
add_shortcode('pricing_table', 'pricing_table');