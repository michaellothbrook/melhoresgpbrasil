<?php

add_filter('woocommerce_product_description_heading', '__return_false');
add_filter('woocommerce_product_additional_information_heading', '__return_false');

// Archive layout type (standard / full width)
$archive_layout = get_theme_mod( 'modellic-archive_template', 'standard' );

// Price and add to cart
$price_add_to_cart = get_theme_mod( 'modellic-price_add_to_cart', '1' );

/* Remove add to cart
-------------------------------------------------------------------------------------------------------------------*/

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/* Remove breadcrums
-------------------------------------------------------------------------------------------------------------------*/

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/* Change content wrapper (archives + single product)
-------------------------------------------------------------------------------------------------------------------*/

// Remove default wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Add theme wrapper
add_action('woocommerce_before_main_content', 'modellic_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'modellic_wrapper_end', 10);

// Get columns number and template type and set as classes to opening wrapper element
function modellic_wrapper_start() {

    global $archive_layout;

    if( !is_single() && $archive_layout != 'fullwidth' ) {
        echo( '<div class="container"><section id="main" class="archive-template-' . $archive_layout . '">' );
    } else {
        echo( '<section id="main" class="archive-template-' . $archive_layout . '">' );
    }

}

// Close wrapper
function modellic_wrapper_end() {

    global $archive_layout;

    if( ! is_single() && $archive_layout != 'fullwidth' ) {
        echo( '</section></div>' );
    } else {
        echo( '</section>' );
    }
}

/* Change number or products per page
-------------------------------------------------------------------------------------------------------------------*/

add_filter( 'loop_shop_per_page', 'modellic_loop_shop_per_page', 20 );

function modellic_loop_shop_per_page( $cols ) {
  $cols = get_theme_mod( 'modellic-products_per_page', 12 );
  return $cols;
}

/* Change number of related products output
-------------------------------------------------------------------------------------------------------------------*/

add_filter( 'woocommerce_output_related_products_args', 'modellic_related_products_args', 20 );

function modellic_related_products_args( $args ) {
    $products_per_row = get_theme_mod( 'modellic-archive_columns', 3 );
    $args['posts_per_page'] = $products_per_row;
    $args['columns'] = $products_per_row;
    return $args;
}

/* Wrap results count and sorting in a DIV
-------------------------------------------------------------------------------------------------------------------*/

$show_number_sorting = get_theme_mod( 'modellic-number_sorting', 'on' );

if( $show_number_sorting ) {

    add_action( 'woocommerce_before_shop_loop', 'product_results_meta_open', 19 );
    add_action( 'woocommerce_before_shop_loop', 'product_results_meta_close', 31 );

    function product_results_meta_open() {

        global $archive_layout;

        if( $archive_layout != 'fullwidth') {
            echo '<div class="product-results-meta">';
        } else {
            echo '<div class="product-results-meta container">';
        }

    }

    function product_results_meta_close() {
        echo '</div>';
    }

} else {

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

}

/* Shop cart icon for menu
-------------------------------------------------------------------------------------------------------------------*/

$menu_cart_icon = get_theme_mod('cart_icon', 1);

if( $menu_cart_icon && class_exists('WooCommerce') ) {
    add_filter('wp_nav_menu_items','modellic_wcmenucart', 10, 2);
}

function modellic_wcmenucart($menu, $args) {

    // Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
    if ( 'primary' !== $args->theme_location ) return $menu;

    //if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    ob_start();

        global $woocommerce;
        $viewing_cart = esc_html__('View your shopping cart', 'modellic');
        $start_shopping = esc_html__('Start shopping', 'modellic');
        $cart_url = $woocommerce->cart->get_cart_url();
        $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
        $cart_contents_count = $woocommerce->cart->cart_contents_count;
        $cart_contents = $cart_contents_count;
        $cart_total = $woocommerce->cart->get_cart_total();

        if ($cart_contents_count == 0) {
            $menu_item = '<li class="menu-item-cart"><a class="wcmenucart-contents" href="' . esc_url( $shop_page_url ) . '" title="' . $start_shopping . '">';
        } else {
            $menu_item = '<li class="menu-item-cart"><a class="wcmenucart-contents" href="' . esc_url( $cart_url ) . '" title="' . $viewing_cart . '">';
        }

        $menu_item .= '<i class="icon-shopping-cart"></i> ';

        $menu_item .= $cart_contents;
        $menu_item .= '</a></li>';
        echo $menu_item;

    $cart_link = ob_get_clean();

    return $menu . $cart_link;

}

/* Ratings stars
-------------------------------------------------------------------------------------------------------------------*/

add_filter('woocommerce_product_get_rating_html', 'modellic_rating_html', 10, 2);

function modellic_rating_html($rating_html, $rating) {
  if ( $rating > 0 ) {
    $title = sprintf( esc_html__( 'Rated %s out of 5', 'woocommerce' ), $rating );
  } else {
    $title = esc_html__( 'Not yet rated', 'woocommerce' );
    $rating = 0;
  }

  $rating_html  = '<div class="star-rating" title="' . esc_html( $title ) . '">';
  $rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . esc_html( $rating ) . '</strong> ' . esc_html__( 'out of 5', 'woocommerce' ) . '</span>';
  $rating_html .= '</div>';

  return $rating_html;
}

/* Decide about a product box thumbnail template
-------------------------------------------------------------------------------------------------------------------*/

function woocommerce_template_loop_product_thumbnail() {

    global $product;

    // Get visible attributes
    $show_attributes = get_theme_mod('modellic_show_attributes');

    if( !empty( $show_attributes ) && is_array( $show_attributes ) ) {

        // Get current product attributes
        $attributes = $product->get_attributes();

        // Flip array
        $show_attributes = array_flip( $show_attributes );

        // Get actual visible attributes
        $result_attributes = array_intersect_key( $attributes, $show_attributes );

    }

    echo woocommerce_get_product_thumbnail();

    if( !empty( $result_attributes ) ) { ?>
        <div class="hover">
            <div class="description">
                <?php
                /**
                 * modellic_before_attributes hook.
                 *
                 * @hooked woocommerce_template_loop_title - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action('modellic_before_attributes'); ?>
                <ul>
                    <?php foreach ( $result_attributes as $attribute ) { ?>
                        <li>
                            <span class="primary-color"><?php echo wc_attribute_label( $attribute['name'] ); ?></span><?php

                            if ( $attribute['is_taxonomy'] ) {

                                $values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
                                echo apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values );
                                echo get_theme_mod( $attribute['name'] );

                            } else {

                                // Convert pipes to commas and display values
                                $values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
                                echo apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values );
                                echo get_theme_mod( $attribute['name'] );

                            } ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php }

}

/* Move sidebar before content & wrap columns for content and sidebar
-------------------------------------------------------------------------------------------------------------------*/

function markup_sidebar_open() {
    ?><div class="row"><div class="col s12 m4 l4 xl3" id="sidebar-wrapper"><div id="sidebar-closer"></div><div id="sidebar"><?php
}

function markup_sidebar_close() {
    ?></div></div><div class="col s12 m8 l8 xl9"><?php
}

function markup_content_close() {
    ?></div></div><?php
}

function fullwidth_sidebar() {
    ?><div id="sidebar-wrapper"><div id="sidebar-closer"></div><div id="sidebar"><?php woocommerce_get_sidebar(); ?></div></div><?php
}

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/* Manage sidebar and product box depend on archive template
-------------------------------------------------------------------------------------------------------------------*/

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 ); // Remove title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); // Remove rating
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 ); // Remove price

if ( $archive_layout != 'fullwidth' ) {

    /* Place title, price, rating outside of a A tag
    -------------------------------------------------------------------------------------------------------------------*/

    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 6 ); // Add rating
    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_title', 7 ); // Add title
    if( $price_add_to_cart ) {
        add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 8 ); // Add price
    }

}

if ( is_active_sidebar( 'shop' ) && $archive_layout != 'fullwidth' ) { // If full width layout

    $shop_sidebar_active = false;

    add_action( 'woocommerce_before_shop_loop', 'markup_sidebar_open', 1 );
    add_action( 'woocommerce_before_shop_loop', 'woocommerce_get_sidebar', 2 );
    add_action( 'woocommerce_before_shop_loop', 'markup_sidebar_close', 3 );
    add_action( 'woocommerce_after_shop_loop', 'markup_content_close', 20 );

} else if ( $archive_layout == 'fullwidth' ) { // If fullwidth layout

    remove_action( 'woocommerce_before_main_content', 'modellic_shop_title', 15 );

    add_action( 'woocommerce_after_shop_loop', 'fullwidth_sidebar', 20 );

    add_action( 'modellic_before_attributes', 'woocommerce_template_loop_rating', 3 ); // Add rating
    add_action( 'modellic_before_attributes', 'woocommerce_template_loop_product_title', 5 ); // Add title
    if( $price_add_to_cart ) {
        add_action('modellic_before_attributes', 'woocommerce_template_loop_price', 10); // Add price
    }

}

/**
 * Show the product title in the product loop. By default this is an H2.
 */
function woocommerce_template_loop_product_title() {
    global $product;

    if (get_theme_mod('modellic-archive_template') == 'fullwidth') {
        echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>';
    } else {
        $link = get_the_permalink();
        echo '<a href="' . esc_url( $link ) . '"><h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2></a>';
    }
}

?>
