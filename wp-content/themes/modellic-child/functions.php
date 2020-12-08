<?php add_action( 'wp_enqueue_scripts', 'modellic_theme_enqueue_styles' );
function modellic_theme_enqueue_styles() {
 
    $parent_style = 'modellic-style';
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array('materialize') );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    ); 
} ?>