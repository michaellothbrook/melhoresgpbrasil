<footer id="footer-container"><?php

	$widgetized_footer = get_theme_mod('widgetized_footer', '1');

	if( $widgetized_footer != '0' ) { ?>

		<div id="pre-footer"> 
			<div class="container">
				<div class="row"><?php

					for ($i=1; $i < 5; $i++) {

						$sidebar_class = get_theme_mod('footer_sidebar_' . $i, 'col s12 m3');

						if( $sidebar_class != 'disabled' && is_active_sidebar('Footer Sidebar ' . $i) ) {

							echo('<div class="' . esc_html( $sidebar_class ) . '">');
								if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-sidebar-' . $i));
							echo('</div>');

						}

					} ?>

				</div>
			</div>
		</div><?php

	}

	$footer_text = get_theme_mod('footer_text', '&copy; 2015 Modellic. Web design &amp; development by <a href="http://coffeecreamthemes.com" target="_blank">Coffeecreamthemes.com</a>');

	if( !empty( $footer_text ) ) { ?>
		<div id="footer">
			<?php echo wp_kses_post( $footer_text ); ?>
		</div>
	<?php } ?>

</footer><div id="sidenav-overlay"></div>
<?php wp_footer(); ?>
</body>
</html>