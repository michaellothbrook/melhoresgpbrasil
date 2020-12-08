<?php

/* Recent Blog Posts
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('recent_blog_posts')) {
	function recent_blog_posts( $atts, $content = null) {

	    extract( shortcode_atts( array(
	        "posts"      => 2,
	        "categories" => "",
	        "el_class"   => ""
	    ), $atts ) );

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $posts,
			'cat'            => $categories
	    );

	    switch ($posts) {
	    	case 3:
	    		$column_class = 'vc_col-sm-4';
	    		break;

	    	case 4:
	    		$column_class = 'vc_col-sm-3';
	    		break;
	    	
	    	default:
	    		$column_class = 'vc_col-sm-6';
	    		break;
	    }

	    $output = '';

	    $blog_query = new WP_Query( $args );

		if( $blog_query->have_posts() ) {

			if( !empty($el_class) ) $el_class = ' ' . $el_class;

			$output .= '<div class="recent-blog-posts' . $el_class . '"><div class="vc_row">';

			while ( $blog_query->have_posts() ) {

				$blog_query->the_post();

				$output .= '<div class="latest-post ' . $column_class . '">';

	            	if( has_post_thumbnail() ) {
	            		$output .= '<a href="' . esc_url( get_permalink() ) . '" class="post-thumb">' . get_the_post_thumbnail(get_the_ID(), 'blog', array('class' => 'responsive-img')) . '</a>';
	            	}

	            	$output .= sprintf('<div class="row"><div class="col m3 l2 date"><div class="day">%1$s</div><div class="month">%2$s %3$s</div></div><div class="col m9 l10 text">', get_the_date( 'j' ), get_the_date( 'M' ), get_the_date( 'Y' ) );

		            	$output .= '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title(get_the_ID()) . '</a></h2>';

						$output .= '<p>' . get_the_excerpt('') . '</p>';

						$output .= '<p><a href="' . esc_url( get_permalink() ) . '" class="btn">' . esc_html__("Read more", "modellic") . '</a></p>';

					$output .= '</div></div>';

				$output .= '</div>';
				
			}

			$output .= '</div></div>';
		
		}

		wp_reset_postdata();

	    return $output;

	}

}

add_shortcode('recent-blog-posts', 'recent_blog_posts');