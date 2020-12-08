<?php get_header();

	if ( have_posts() ) :

		while ( have_posts() ) : the_post(); ?>

			<section id="content">
				<div class="container">

					<div class="title">
						<?php the_title('<h1>', '</h1>'); ?>
					</div>

					<?php the_content(); ?>

					<?php if ( comments_open() ) {
						comments_template();
					} ?>

				</div>
			</section>
			
		<?php endwhile; 

	else :

		get_template_part( 'content', 'none' );

	endif;

get_footer(); ?>