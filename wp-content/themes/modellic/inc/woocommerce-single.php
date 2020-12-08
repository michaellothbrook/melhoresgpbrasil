<?php

/* Show price and add to cart
-------------------------------------------------------------------------------------------------------------------*/

$price_add_to_cart = get_theme_mod( 'modellic-price_add_to_cart', '0' );

if( ! $price_add_to_cart ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

    remove_action( 'modellic_before_attributes', 'woocommerce_template_loop_price', 10 );
}

/* Wrap product details (single product)
-------------------------------------------------------------------------------------------------------------------*/

function modellic_before_product_details() {
    if( is_single() ) {
        echo('<div class="container">');
    }
} 
function modellic_after_product_details() {
    if( is_single() ) {
        echo('</div>');
    }
}

add_action( 'woocommerce_before_single_product_summary', 'modellic_before_product_details', 101 );
add_action( 'woocommerce_after_single_product_summary', 'modellic_after_product_details', 101 );

/* Wrap and wrap title (single product)
-------------------------------------------------------------------------------------------------------------------*/

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_before_single_product_summary', 'modellic_single_title', 15 );

function modellic_single_title() {

    ?><div class="container title"><?php

        the_title( '<h1 itemprop="name" class="product_title entry-title">', '</h1>' );

        ?><div class="prev_next_favorite"><?php

            if( function_exists( 'the_favorites_button' ) ) {
                echo do_shortcode('[favorite_button post_id="' . get_the_id() . '" site_id="' . get_current_blog_id() . '"]');
            }

            modellic_prev_next_display();

        ?></div>
    </div><?php

}

/* Move excerpt before exerything else
-------------------------------------------------------------------------------------------------------------------*/

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 5 );

/* Move meta after excerpt and disable if option set
-------------------------------------------------------------------------------------------------------------------*/

$product_categories_tags = get_theme_mod( 'modellic-product_categories_tags', 'on' );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

if ( $product_categories_tags ) {
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 6 );
}

/* Gallery & thumbnail changes
-------------------------------------------------------------------------------------------------------------------*/

$gallery_type = get_theme_mod('modellic-gallery_type', 'horizontal');
$gallery_position = get_theme_mod('modellic-horizontal_gallery_position', 'before');


if( $gallery_type != "vertical" ) {

	if( $gallery_position == 'before' ) {
		// Move gallery before title
		remove_action( "woocommerce_before_single_product_summary", "woocommerce_show_product_images", 20 );
		add_action( 'woocommerce_before_single_product_summary', "woocommerce_show_product_images", 10 );
	}

	add_action( 'woocommerce_single_product_summary' , 'modellic_product_attributes_column', 1 );

} else {

	remove_action( "woocommerce_before_single_product_summary", "woocommerce_show_product_images", 20 ); // Remove default gallery
	add_action( 'woocommerce_single_product_summary' , 'modellic_vertical_gallery_column', 1 ); // Add product summary with gallery

}

/* Built the gallery, product attributes column and product price & details column
-------------------------------------------------------------------------------------------------------------------*/

// Horizontal gallery case
function modellic_product_attributes_column() {
    global $product; ?>
    
    <div class="row">
        <div class="col s12 m6">
            <?php echo apply_filters( 'list_attributes_title', '<h3>' . esc_html__( 'Dimensions', 'woocommerce' ) . '</h3>' ); ?>
            <?php $product->list_attributes(); ?>
        </div>
        <div class="col s12 m6">

<?php }

// Verticall gallery case
function modellic_vertical_gallery_column() {
    global $product; ?>
    
    <div class="row">
        <div class="col s12 m6">
			<?php woocommerce_show_product_images(); ?>
        </div>
        <div class="col s12 m6">

<?php }

add_action( 'woocommerce_single_product_summary' , 'modellic_price_column_end', 100 );

function modellic_price_column_end() {
    echo('</div></div>');
}

// Enable the right template for images gallery (horizontal or vertical)
function woocommerce_show_product_images() {

	global $gallery_type;

	if( $gallery_type != 'vertical' ) {
		wc_get_template( '/modellic/horizontal-gallery.php' );
	} else {
		wc_get_template( 'single-product/product-image.php' );
	}

}

/* Remove sale flash on single page
-------------------------------------------------------------------------------------------------------------------*/

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/* CF7 bookign form
-------------------------------------------------------------------------------------------------------------------*/

/**
 * Register meta boxes.
 */
function modellic_register_meta_boxes() {
    if (class_exists('WPCF7')) {
        add_meta_box( 'modellic-booking', __( 'Booking Form', 'modellic' ), 'modellic_display_callback', 'product' );
    }
}
add_action( 'add_meta_boxes', 'modellic_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function modellic_display_callback( $post ) { ?>

    <div class="modellic_box">
        <style scoped>
            .modellic_box{
                display: grid;
                grid-template-columns: max-content 1fr;
                grid-row-gap: 10px;
                grid-column-gap: 20px;
            }
            .modellic_field{
                display: contents;
            }
        </style>
        <p class="meta-options modellic_field">
            <label for="modellic_booking_form">Form</label>


            <select id="modellic_booking_form" name="modellic_booking_form"><?php

                $forms = get_posts(array(
                    'post_type'     => 'wpcf7_contact_form',
                    'numberposts'   => -1
                ));

                $current_value = esc_attr( get_post_meta( get_the_ID(), 'modellic_booking_form', true ) );

                $list_forms = array( 'none' => 'None' ); ?>

                <option value="default"<?php if ( empty( $current_value ) || $current_value == 'default' ) { echo ' selected'; } ?>><?php _e( 'Default', 'modellic' ); ?></option>
                <option value="disable"<?php if ( $current_value == 'disable' ) { echo ' selected'; } ?>><?php _e( 'Disable', 'modellic' ); ?></option>

                <?php foreach ( $forms as $form ) { ?>
                    <option value="<?php echo esc_attr( $form->ID ); ?>"<?php if ( $current_value == $form->ID ) { echo ' selected'; } ?>>
                        <?php echo esc_attr( $form->post_title ); ?>        
                    </option>
                <?php } ?>
            </select>
        </p>
    </div>

<?php }

/* Booking Form
-------------------------------------------------------------------------------------------------------------------*/

function modellic_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = ['modellic_booking_form'];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'modellic_save_meta_box' );

function modellic_display_booking_form() {
    $booking_option_settings = get_theme_mod( 'modellic-booking_form', 'disable' );
    $form_id_product = esc_attr( get_post_meta( get_the_ID(), 'modellic_booking_form', true ) );

    if ( $form_id_product == 'disable' ) return;
    if ( $booking_option_settings == 'disable' && ( $form_id_product == 'default' || empty( $form_id_product ) ) ) return;

    if ( $form_id_product == 'default' || empty( $form_id_product ) ) {
        echo do_shortcode('[contact-form-7 id="' . $booking_option_settings . '"]');
    } else {
        echo do_shortcode('[contact-form-7 id="' . $form_id_product . '"]');
    }

}

if (class_exists('WPCF7')) {
   add_action('woocommerce_single_product_summary', 'modellic_display_booking_form', 55);
}

/* Prev / next product link
-------------------------------------------------------------------------------------------------------------------*/

function modellic_prev_next_product($post_id, $categories_as_array) {

    // Get post according post id
    $query_args = array(
        'post__in' => array($post_id),
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'post_type' => 'product',
        'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $categories_as_array
                )
            )
        );

    $result_single = new WP_Query($query_args);

    if( $result_single->have_posts() ) {

        $result_single->the_post();

        global $product; ?>

        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" class="prev_next"><?php

            if ( get_the_title() ) {
                the_title();
            } else {
                the_ID();
            }

        ?></a>

        <?php wp_reset_query();
    }
}

function modellic_prev_next_display() {

    if ( is_singular('product') ) {

        global $post;

        // get categories
        $terms = wp_get_post_terms( $post->ID, 'product_cat' );

        if( !empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $cats_array[] = $term->term_id;
            }
        } else {
            $cats_array = '';
        }

        // get all posts in current categories
        $query_args = array(
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'post_type' => 'product',
            'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => $cats_array
                    )
                )
            );

        $result = new WP_Query($query_args);

        // show next and prev only if we have 3 or more
        if ($result->post_count > 2) {

            $prev_product_id = -1;
            $next_product_id = -1;

            $found_product = false;
            $i = 0;

            $current_product_index = $i;
            $current_product_id = get_the_ID();

            $first_product_index = '';

            if ($result->have_posts()) {

                while ($result->have_posts()) {

                    $result->the_post();
                    $current_id = get_the_ID();

                    if ($current_id == $current_product_id) {
                        $found_product = true;
                        $current_product_index = $i;
                    }

                    $is_first = ($current_product_index == $first_product_index);

                    if ($is_first) {
                        $prev_product_id = get_the_ID(); // if product is first then 'prev' = last product
                    } else {
                        if (!$found_product && $current_id != $current_product_id) {
                            $prev_product_id = get_the_ID();
                        }
                    }

                    if ($i == 0) { // if product is last then 'next' = first product
                        $next_product_id = get_the_ID();
                    }

                    if ($found_product && $i == $current_product_index + 1) {
                        $next_product_id = get_the_ID();
                    }

                    $i++;
                }

                echo '<div class="prev-next-container">';

                    if ($prev_product_id != -1) {
                        echo '<div class="link-prev">';
                            modellic_prev_next_product( $prev_product_id, $cats_array );
                        echo '</div>';
                    }
                    if ($next_product_id != -1) {
                        echo '<div class="link-next">';
                            modellic_prev_next_product( $next_product_id, $cats_array );
                        echo '</div>';
                    }

                echo '</div>';

            }

            wp_reset_query();
        }
    }

} ?>