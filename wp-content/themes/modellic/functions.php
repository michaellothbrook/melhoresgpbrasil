<?php

/* Theme setup
-------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'modellic_setup' ) ) :

	function modellic_setup() {

		if ( ! isset( $content_width ) ) {
			$content_width = 1280;
		}

        load_theme_textdomain( 'modellic', get_template_directory() . '/languages' );

        add_theme_support( 'title-tag' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'woocommerce' );

        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
        
        add_theme_support( 'customize-selective-refresh-widgets' );

		register_nav_menus( array(
			'primary' => esc_html__( 'Main Menu', 'modellic' ),
            'top-bar' => esc_html__( 'Top Bar', 'modellic' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'gallery',
			'caption',
		) );

        add_theme_support('custom-logo', array(
            'height'      => 100,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true,
        ) );

        if ( ! class_exists('FacetWP') ) {
            add_theme_support( 'infinite-scroll', array(
                'container' => 'content-loop',
                'wrapper'   => false,
                'type'      => 'click',
            ) );
        }

	}

endif;

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

add_action( 'after_setup_theme', 'modellic_setup' );

function filter_jetpack_infinite_scroll_js_settings( $settings ) {
    $settings['text'] = esc_html__( 'Load more&nbsp;', 'modellic' );
    return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'filter_jetpack_infinite_scroll_js_settings' );

/* Body class
-------------------------------------------------------------------------------------------------------------------*/

function modellic_body_classes( $classes ) {

    // Color theme
    $color_theme = get_theme_mod('main_color_theme', 'black');

    // Gallery type
    $gallery_type = get_theme_mod('modellic-gallery_type', 'horizontal');

    if( $gallery_type == 'vertical' ) {
        $gallery_position = 'after';
    } else  {
        // Product single gallery position
        $gallery_position = get_theme_mod('modellic-horizontal_gallery_position', 'before');
    }

    // Top bar
    $top_bar = get_theme_mod('top_bar', '1');

    if ($top_bar != 1) {
        $top_bar = 0;
    }

    // Columns
    $desktop_columns = get_theme_mod('modellic-archive_columns', 3);
    $desktop_columns_sidebar = get_theme_mod('modellic-archive_columns_sidebar', 3);
    $tablet_columns = get_theme_mod('modellic-tablet_columns', 2);
    $tablet_columns_sidebar = get_theme_mod('modellic-tablet_columns_sidebar', 2);
    $mobile_columns = get_theme_mod('modellic-mobile_columns', 1);


    $classes[] = 'theme-' . $color_theme;
    $classes[] = 'gallery-position-' . $gallery_position . '-title';
    $classes[] = 'top-bar-' . $top_bar;
    $classes[] = 'desktop-columns-' . $desktop_columns;
    $classes[] = 'desktop-columns-sidebar-' . $desktop_columns_sidebar;
    $classes[] = 'tablet-columns-' . $tablet_columns;
    $classes[] = 'tablet-columns-sidebar-' . $tablet_columns_sidebar;
    $classes[] = 'mobile-columns-' . $mobile_columns;

    if ( is_archive() && is_active_sidebar('shop') ) {
        $classes[] = 'sidebar-enabled-columns';
    }

    return $classes;
}

add_filter( 'body_class', 'modellic_body_classes', 10, 3 );

/* Enqueue CSS and JS and Fonts
-------------------------------------------------------------------------------------------------------------------*/

function modellic_scripts() {

	/* === CSS ==== */

	wp_enqueue_style( 'materialize', get_template_directory_uri() . '/css/materialize.css' );

    wp_enqueue_style( 'iconmoon', get_template_directory_uri() . '/css/icomoon/style.css' );

	wp_enqueue_style( 'modellic-style', get_stylesheet_uri(), array('materialize') );

    wp_enqueue_style( 'facetwp', get_template_directory_uri() . '/css/facetwp.css' );

    // remove favorites style
    if( class_exists('SimpleFavorites') ) {
        wp_dequeue_style( 'simple-favorites' );
    }

	/* === JS ==== */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'modellic_scripts' );

// Remove version parameter from enqueued scripts and styles
add_filter( 'style_loader_src', 'coffeecream_remove_version' );
add_filter( 'script_loader_src', 'coffeecream_remove_version' );

function coffeecream_remove_version( $url ) {
    return remove_query_arg( 'ver', $url );
}

/* Register Widgetized Locations
-------------------------------------------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'modellic_widgets_init' );

function modellic_widgets_init() {

    $sidebars = array(
        'blog'             => array( esc_html__('Blog', 'modellic'), esc_html__('Displayed on a blog archive and single post.', 'modellic') ),
        'page'             => array( esc_html__('Page', 'modellic'), esc_html__('Displayed on pages with sidebar template.', 'modellic') ),
        'shop'             => array( esc_html__('Shop', 'modellic'), esc_html__('Displayed on a shop archive page.', 'modellic') ),
        'testimonials'     => array( esc_html__('Testimonials', 'modellic'), esc_html__('Displayed on a testimonials archive page.', 'modellic') ),
        'shop-archive'     => array( esc_html__('Shop Archive', 'modellic'), esc_html__('Displayed on a shop archive page.', 'modellic') ),
    );

    $sidebars_footer = array(
        'footer-sidebar-1' => array( esc_html__('Footer Sidebar 1', 'modellic'), esc_html__('Displayed on 1 columns of footer.', 'modellic') ),
        'footer-sidebar-2' => array( esc_html__('Footer Sidebar 2', 'modellic'), esc_html__('Displayed on 2 columns of footer.', 'modellic') ),
        'footer-sidebar-3' => array( esc_html__('Footer Sidebar 3', 'modellic'), esc_html__('Displayed on 3 columns of footer.', 'modellic') ),
        'footer-sidebar-4' => array( esc_html__('Footer Sidebar 4', 'modellic'), esc_html__('Displayed on 4 columns of footer.', 'modellic') ),
    );

    foreach ($sidebars as $key => $sidebar) {

        // Register widgetized locations
        register_sidebar(array(
            'name'          => $sidebar[0],
            'description'   => $sidebar[1],
            'id'            => $key,
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

    }

    foreach ($sidebars_footer as $key => $sidebar) {

        // Register widgetized locations
        register_sidebar(array(
            'name'          => $sidebar[0],
            'description'   => $sidebar[1],
            'id'            => $key,
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));

    }

}

add_action( 'woocommerce_after_shop_loop', 'shop_archive_sidebar', 20 );
function shop_archive_sidebar() {
    echo '<div class="widgetarea-shop-archive container">';
        dynamic_sidebar('shop-archive');
    echo '</div>';
}

/* Comments Layout
-------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'modellic_comment' ) ) {
    function modellic_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) {
        case 'pingback' :
        case 'trackback' :
            // Display trackbacks differently than normal comments ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="pingback">
                    <p><?php esc_html_e( 'Pingback:', 'modellic' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'modellic' ), '<span class="edit-link">', '</span>' ); ?></p>
                </div>
            <?php
            break;
        default :
            // Proceed with normal comments.
            global $post; ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

                <div id="comment-<?php comment_ID(); ?>" class="comment_container">

                    <?php echo get_avatar( $comment, 60 ); ?>

                    <div class="comment-text">

                        <p class="meta">

                            <?php printf(
                                '<strong>%1$s</strong> &mdash; <time datetime="%2$s">%3$s</time>: %4$s',
                                get_comment_author_link(),
                                get_comment_time( 'c' ),
                                get_comment_date(),
                                // If current post author is also comment author, make it known visually.
                                ( $comment->user_id === $post->post_author ) ? '<span class="badge">' . esc_html__( 'author', 'modellic' ) . '</span>' : ''
                            ); ?>

                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="icon-reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

                            <?php edit_comment_link( '<i class="icon-pencil"></i>'); ?>

                        </p>

                        <?php if ( '0' == $comment->comment_approved ) {
                            ?><p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'modellic' ); ?></p><?php
                        } ?>

                        <div class="description"><?php comment_text(); ?></div>

                    </div>

                </div><?php
            break;
        }
    }
}

/* Excerpt Length
-------------------------------------------------------------------------------------------------------------------*/

function the_excerpt_max_charlength($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            return mb_substr( $subex, 0, $excut ) . '&hellip;';
        } else {
            return $subex . '&hellip;';
        }
    } else {
        return $excerpt . '&hellip;';
    }
}

/* Visual Composer
-------------------------------------------------------------------------------------------------------------------*/

if (class_exists('WPBakeryVisualComposerAbstract')) {

	function requireVcExtend(){
		require_once get_template_directory() . '/vc_templates/extend-vc.php';
	}
	add_action('init', 'requireVcExtend', 2);

    require_once( get_template_directory() . '/vc_templates/hgroup.php' );
    require_once( get_template_directory() . '/vc_templates/pricing-table.php' );
    require_once( get_template_directory() . '/vc_templates/testimonial.php' );
    require_once( get_template_directory() . '/vc_templates/button.php' );
    require_once( get_template_directory() . '/vc_templates/recent-blog-posts.php' );
}

add_action( 'vc_before_init', 'modellic_vcSetAsTheme' );

function modellic_vcSetAsTheme() {
    vc_set_as_theme();
}

/* Remove license message
-------------------------------------------------------------------------------------------------------------------*/

function remove_license_window() {
    echo '<style type="text/css">#verify-purchase-code, #vc_license-activation-notice, .rs-update-notice-wrap { display: none !important; }</style>';
}

add_action('admin_head', 'remove_license_window');

/* Bootstrap Nav Walker
-------------------------------------------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/inc/wp_bootstrap_navwalker.php' );

/* Template Tags
-------------------------------------------------------------------------------------------------------------------*/

require get_template_directory() . '/inc/template-tags.php';

/* Facet Widget
-------------------------------------------------------------------------------------------------------------------*/

require get_template_directory() . '/inc/class-wp-widget-facet.php';

if  ( ! function_exists('facetwpPagination')) {
    function facetwpPagination() {
        echo facetwp_display( 'pager' );
    }
}

if ( class_exists('FacetWP') ) {
    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
    add_action( 'woocommerce_after_shop_loop', 'facetwpPagination', 10 );
}

/* Plugins Installation & After Activation Actions
-------------------------------------------------------------------------------------------------------------------*/

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/plugins.php';

/* Customizer
-------------------------------------------------------------------------------------------------------------------*/

if (class_exists('Kirki')) {
    require get_template_directory() . '/inc/customizer.php';
}

/* WooCommerce integration
-------------------------------------------------------------------------------------------------------------------*/

require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/woocommerce-single.php';


/* Favorites icon for menu
-------------------------------------------------------------------------------------------------------------------*/


if( class_exists('Favorites') ) {
    add_filter('wp_nav_menu_items', 'modellic_favorites', 10, 2);
}

function modellic_favorites($menu, $args) {

    // Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
    if ( 'primary' !== $args->theme_location ) return $menu;

    ob_start();

        $title = esc_html__('Favorites', 'modellic');

        $favorites_url = get_permalink( get_page_by_path( 'favorites' ) );

        $favorites_total = get_user_favorites_count();

        $menu_item = '<li class="menu-item-favorites"><a href="' . esc_url( $favorites_url ) . '" title="' . $title . '"><i class="icon-heart"></i> ' . $favorites_total . '</a></li>';

        echo $menu_item;

    $favorites_link = ob_get_clean();

    return $menu . $favorites_link;

}

/* Set homepage, blog page and menus after import
-------------------------------------------------------------------------------------------------------------------*/

function modellic_after_import() {
    // Use a static front page
    $home = get_page_by_title( 'Home' );
    update_option( 'page_on_front', $home->ID );
    update_option( 'show_on_front', 'page' );

    // Set the blog page
    $blog = get_page_by_title( 'Blog' );
    update_option( 'page_for_posts', $blog->ID );

    // Set menus
    $theme_locations = get_registered_nav_menus();

    foreach ($theme_locations as $location => $description ) {

        switch($location) {
            case 'primary':
                $menu = get_term_by('name', 'Main Menu', 'nav_menu');
            break;

            case 'top-bar':
                $menu = get_term_by('name', 'Top Bar', 'nav_menu');
            break;
        }

        if( isset($menu) ) {
            $theme_locations[$location] = $menu->term_id;
        }

    }

    set_theme_mod( 'nav_menu_locations', $theme_locations );

}

add_action( 'import_end', 'modellic_after_import' );

/* Demo data import
-------------------------------------------------------------------------------------------------------------------*/

function ocdi_import_files() {
  return array(
    array(
      'import_file_name'             => 'Demo Content',
      'import_file_url'              => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/content.xml',
      'import_widget_file_url'       => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/widgets.wie',
      'import_customizer_file_url'   => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/customizer-options.dat',
      'import_preview_image_url'     => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/img/demo-content.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the sliders separately: Slider Revolution > Slider Revolution > Import Slider. Slider file is located in modellic/demo-data/sliders/slider-black.zip.', 'modellic' ),
      'preview_url'                  => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/',
    ),
    array(
      'import_file_name'             => 'White / Gold Color Settings',
      'import_customizer_file_url'   => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/colors/white-gold.dat',
      'import_preview_image_url'     => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/img/white-gold.png',
      'import_notice'                => __( 'This is style options import without content import. Its recommended to import them manually via Appearance > Customize > Export/Import. Color files are located in the theme folder modellic/demo-data/colors.', 'modellic' ),
      'preview_url'                  => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/?theme_color=white-gold',
    ),
    array(
      'import_file_name'             => 'Black / Yellow Color Settings',
      'import_customizer_file_url'   => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/colors/black-yellow.dat',
      'import_preview_image_url'     => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/img/black-yellow.png',
      'import_notice'                => __( 'This is style options import without content import. Its recommended to import them manually via Appearance > Customize > Export/Import. Color files are located in the theme folder modellic/demo-data/colors.', 'modellic' ),
      'preview_url'                  => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/?theme_color=black-yellow',
    ),
    array(
      'import_file_name'             => 'Purple / Pink Color Settings',
      'import_customizer_file_url'   => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/colors/purple-pink.dat',
      'import_preview_image_url'     => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/img/purple-pink.png',
      'import_notice'                => __( 'This is style options import without content import. Its recommended to import them manually via Appearance > Customize > Export/Import. Color files are located in the theme folder modellic/demo-data/colors.', 'modellic' ),
      'preview_url'                  => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/?theme_color=purple-pink',
    ),
    array(
      'import_file_name'             => 'Brown / Orange Color Settings',
      'import_customizer_file_url'   => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/colors/brown-orange.dat',
      'import_preview_image_url'     => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/img/brown-orange.png',
      'import_notice'                => __( 'This is style options import without content import. Its recommended to import them manually via Appearance > Customize > Export/Import. Color files are located in the theme folder modellic/demo-data/colors.', 'modellic' ),
      'preview_url'                  => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/?theme_color=brown-orange',
    ),
    array(
      'import_file_name'             => 'Navy / Lime Color Settings',
      'import_customizer_file_url'   => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/colors/navy-lime.dat',
      'import_preview_image_url'     => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/img/navy-lime.png',
      'import_notice'                => __( 'This is style options import without content import. Its recommended to import them manually via Appearance > Customize > Export/Import. Color files are located in the theme folder modellic/demo-data/colors.', 'modellic' ),
      'preview_url'                  => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/?theme_color=navy-lime',
    ),
    array(
      'import_file_name'             => 'Dark / Gold Color Settings (Default)',
      'import_customizer_file_url'   => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/colors/dark-gold.dat',
      'import_preview_image_url'     => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/wp-content/themes/modellic/demo-data/img/dark-gold.png',
      'import_notice'                => __( 'This is style options import without content import. Its recommended to import them manually via Appearance > Customize > Export/Import. Color files are located in the theme folder modellic/demo-data/colors.', 'modellic' ),
      'preview_url'                  => 'http://www.coffeecreamthemes.com/themes/modellic/wordpress/?theme_color=dark-gold',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

/* Before import actions
-------------------------------------------------------------------------------------------------------------------*/

function ocdi_before_import_setup() {

    $widgets = get_option( 'sidebars_widgets' );
    $widgets["footer-sidebar-1"] = array();

    // Clear default widgets added on theme activation
    update_option('sidebars_widgets', $widgets);

}
add_action( 'pt-ocdi/before_content_import_execution', 'ocdi_before_import_setup' );

/* Set homepage, blog page and menus after import
-------------------------------------------------------------------------------------------------------------------*/

function ocdi_after_import_setup() {

    // Use a static front page
    $home = get_page_by_title( 'Home' );
    update_option( 'page_on_front', $home->ID );
    update_option( 'show_on_front', 'page' );

    // Set the blog page
    $blog = get_page_by_title( 'Blog' );
    update_option( 'page_for_posts', $blog->ID );

    // Set the shop page
    /*$shop = get_page_by_title( 'Models' );
    update_option( 'woocommerce_shop_page_id', $shop->ID );*/

    // Set menus
    $theme_locations = get_registered_nav_menus();

    foreach ($theme_locations as $location => $description ) {

        switch($location) {

            case 'primary':
                $menu = get_term_by('name', 'Main Menu', 'nav_menu');
                break;

            case 'top-bar':
                $menu = get_term_by('name', 'Top Bar', 'nav_menu');
                break;
        }

        if( isset($menu) ) {
            $theme_locations[$location] = $menu->term_id;
        }

    }

    set_theme_mod( 'nav_menu_locations', $theme_locations );

}

add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );

/* Disable the emoji's
-------------------------------------------------------------------------------------------------------------------*/

function modellic_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'modellic_disable_emojis_tinymce' );
}
add_action( 'init', 'modellic_disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param    array  $plugins
 * @return   array             Difference betwen the two arrays
 */
function modellic_disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
