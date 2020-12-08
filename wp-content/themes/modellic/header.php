<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="no-background" id="header">
	<div class="container">

		<?php // Get top bar if enabled
		$top_bar = get_theme_mod('top_bar', '1');

		if( $top_bar == 1 ) {
			get_template_part( 'top-bar' );
		} ?>

		<div class="navbar">
			<nav>
				<div class="nav-wrapper">

					<?php if ( has_custom_logo() ) {
		            	the_custom_logo();
		            } else { ?>
		                <a href="<?php echo esc_url( home_url('/') ); ?>" class="custom-logo-link"><?php bloginfo('name'); ?></a>
		            <?php } ?>

					<a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="icon-bars"></i></a>

					<?php wp_nav_menu( array(
					    'menu'              => 'primary',
					    'theme_location'    => 'primary',
					    'depth'             => 3,
					    'container'         => false,
					    'menu_class'        => 'sidenav',
					    'menu_id'           => 'mobile-nav',
		                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		                'walker'            => new wp_bootstrap_navwalker()
					) ); ?>

				</div>
			</nav>
		</div>
	</div>
</header>
