<?php

/* Testimonials
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('testimonial')) {
	function testimonial( $atts, $content = null) {

	    extract( shortcode_atts( array(
	        "show"       => "random",
	        "posts_ids"  => "",
	        "el_class"   => ""
	    ), $atts ) );

	    if( $show == 'selected' ) {
			$args = array(
				'posts_per_page' => 1,
				'post_type' => 'testimonial',
				'p'         => $posts_ids,
		    );
		} else {
			$args = array(
				'posts_per_page' => 1,
				'post_type'      => 'testimonial',
		    );
		}

	    $output = '';

	    $testimonials_query = new WP_Query( $args );

		if( $testimonials_query->have_posts() ) {

			if( !empty($el_class) ) $el_class = ' ' . $el_class;

			$output .= '<div class="center-align testimonial' . $el_class . '">';

				while ( $testimonials_query->have_posts() ) {

					$testimonials_query->the_post();

					$output .= '<div>';

						$byline = get_post_meta( get_the_ID(), '_byline', true );
						$url = get_post_meta( get_the_ID(), '_url', true );

						$output .= '<blockquote>';

							$output .= '<p>' . get_the_content() . '</p>';

							if( !empty( $url ) ) {
								$output .= '<footer><a href="' . esc_url( $url ) . '">' . esc_html( $byline ) . '</a></footer>';
							} else {
								$output .= '<footer>' . esc_html( $byline ) . '</footer>';
							}

						$output .= '</blockquote>';

					$output .= '</div>';
					
				}

			$output .= '</div>';
		
		}

		wp_reset_postdata();

	    return $output;

	}

}

add_shortcode('testimonial', 'testimonial');