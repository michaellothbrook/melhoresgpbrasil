<?php get_header(); ?>

<section id="content">

	<div class="container">

		<?php if ( is_search() ) { ?>

			<hgroup class="row title">
				<div class="col s12">
					<h6><?php esc_html_e('Search Results', 'modellic'); ?></h6>
					<h4><?php printf( esc_html__( 'for: "%s"', 'modellic' ), get_search_query() ); ?></h4>
				</div>
			</hgroup>

		<?php } else if( is_home() ) {

			$blog_title_text = get_the_title( get_option('page_for_posts', true) );

			if( ! empty( $blog_title_text ) ) { ?>

				<div class="title">
					<h1><?php echo esc_html( $blog_title_text ); ?></h1>
				</div>

			<?php } ?>

		<?php } else if( is_category() ) { ?>

			<div class="title">
				<h1><?php single_cat_title(); ?></h1>
			</div>

		<?php } ?>

		<div class="row">
			<div class="col s12 m8 l8 xl9">

				<?php if ( have_posts() ) :

					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						if ( is_single() && (get_post_type() == 'post') ) {

							get_template_part( 'content-single', get_post_format() );

						} else {

							get_template_part( 'content', get_post_format() );

						}

					endwhile;

					// Previous/next page navigation.
					the_posts_pagination( array(
						'screen_reader_text' => false,
						'prev_text'          => '<i class="icon-chevron-left"></i>',
						'next_text'          => '<i class="icon-chevron-right"></i>',
						'before_page_number' => '',
					) );

				else :

					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif; ?>

			</div>
			<div class="col s12 m4 l4 xl3" id="sidebar-wrapper">
				<div id="sidebar-closer"></div>
				<div id="sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>

</section>

<?php get_footer(); ?>
