<?php

global $product, $post;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) { ?>

<div id="horizontal-gallery" class="frame">
    <ul class="slidee">

        <?php foreach ( $attachment_ids as $attachment_id ) {

            $image_link = wp_get_attachment_url( $attachment_id );

            if ( ! $image_link )
                continue;

            $image_title = esc_attr( get_the_title( $attachment_id ) );
            $image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

            $image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'model' ), 0, $attr = array(
                'title' => $image_title,
                'alt'   => $image_title
            ) );

            echo '<li>';
            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '%s', $image ), $attachment_id, $post->ID );
            echo '</li>';

        } ?>

    </ul>
</div>

<?php } elseif( has_post_thumbnail() ) {

    if( $gallery_width == 'content' ) { ?>
        <div class="container"><div class="row"><div class="col s12">
    <?php } ?>

            <div id="horizontal-gallery" class="frame">
                <ul class="slidee">
                    <li><?php the_post_thumbnail( apply_filters( 'single_product_small_thumbnail_size', 'model' ) ); ?></li>
                </ul>
            </div>
            <div class="scrollbar"><div class="handle"></div></div>

        <?php if( $gallery_width == 'content' ) { ?>
            </div></div></div>
        <?php }

} ?>