<article id="post-<?php the_ID(); ?>" <?php post_class('latest-post row'); ?>>
	<div class="col s12">
		<?php the_title( '<h1>', '</h1>' ); ?>

		<div class="meta">
			<div class="row">
				<div class="col s12 m12 l9">

					<?php esc_html_e( 'Posted', 'modellic' ); ?>

					<time datetime="<?php echo date(DATE_W3C); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>

					<?php esc_html_e( 'by', 'modellic' ); ?>

					<?php echo get_the_author_link(); ?>

					<?php if( has_category() ) { ?><?php esc_html_e('in', 'modellic'); ?> <?php the_category(', '); ?><?php } ?>
				</div>
				<div class="col s12 m12 l3 share">
					<a href="#comments"><i class="icon-comment"></i> <?php comments_number( '0', '1', '%' ); ?></a></a>
				</div>
			</div>
		</div>

		<?php modellic_post_thumbnail(); ?>

		<?php the_content();

		if( has_tag() ) {
			the_tags( '<ul class="tags"><li><i class="icon-tag"></i></li><li>', '</li><li>', '</li></ul>' );
		}

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'modellic' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'modellic' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );

		if ( is_single() && ( get_post_type() == 'post' ) && comments_open() ) {
			comments_template();
		} ?>

	</div>
</article>
