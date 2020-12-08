<div id="tools"><?php

		// Top bar text strings

		global $allowed_tags;

		$top_bar_text = get_theme_mod( 'top_bar_text', __('<li><span>Phone:</span> <a href="tel:+1800234567">+1 800 234 567</a></li><li><span>Email:</span> <a href="mailto:info@modellic.com">info@modellic.com</a></li>', 'modellic') );

		if( !empty( $top_bar_text ) ) {
			?><ul class="left"><?php echo wp_kses_post( $top_bar_text ); ?></ul><?php
		}

		// Top bar menu

		wp_nav_menu( array(
		    'menu'           => 'top-bar',
		    'theme_location' => 'top-bar',
		    'depth'          => 2,
		    'container'      => false,
		    'menu_class'     => 'right',
		    'menu_id'        => 'top-bar-right',
            'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
            'walker'         => new wp_bootstrap_navwalker()
		) );

	?></div>
