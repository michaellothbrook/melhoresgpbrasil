<?php get_header(); ?>

	<section id="content">
		<div class="container">

			<div class="title">
				<h1><?php esc_html_e( 'Testimonials', 'modellic' ); ?></h1>
			</div>

			<?php if ( is_active_sidebar( 'testimonials' ) ) { ?><div class="row"><div class="col s12 m8 l8 xl9"><?php } ?>

			<?php if ( have_posts() ) :

				while ( have_posts() ) : the_post();

					get_template_part( 'content-testimonial', get_post_format() );

				endwhile;

			else :

				get_template_part( 'content', 'none' );

			endif;

			if ( is_active_sidebar( 'testimonials' ) ) { ?></div><div class="col s12 m4 l4 xl3" id="sidebar"><?php dynamic_sidebar( 'testimonials' ); ?></div></div><?php } ?>

		</div>
	</section>
			
<?php get_footer(); ?>