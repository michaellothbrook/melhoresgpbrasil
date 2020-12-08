<article id="post-<?php the_ID(); ?>" <?php post_class('latest-post'); ?>>
	<div class="row"><?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			$time_string = '<time class="entry-date col m3 l2 date" datetime="%1$s"><div class="day">%2$s</div><div class="month primary-color">%3$s %4$s</div></time>';

			printf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date( 'j' ),
				get_the_date( 'M' ),
				get_the_date( 'Y' )
			);
		} ?>
		<div class="col m9 l10 text">
			<?php modellic_post_thumbnail(); ?>
			<h2 class="entry-title">
				<?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
				<span class="primary-color"><?php printf( '%1$s %2$s', esc_html__( 'by', 'modellic' ), get_the_author()	); ?></span>
			</h2>
			<?php the_content('');

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'modellic' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'modellic' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) ); ?>
			<p><a class="btn" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Read more', 'modellic' ); ?></a></p>
		</div>
	</div>
</article>