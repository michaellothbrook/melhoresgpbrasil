<?php if( function_exists('is_woocommerce') && is_woocommerce() ) {

	// Shop Sidebar
	dynamic_sidebar('shop');	

} else if( is_page() ) {

	// Page sidebar
	dynamic_sidebar('page');

} else {

	// Blog sidebar
	dynamic_sidebar('blog');

} ?>