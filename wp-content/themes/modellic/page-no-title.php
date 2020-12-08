<?php /* Template Name: No Title */
get_header();

	if ( have_posts() ) :

		while ( have_posts() ) : the_post(); ?>

			<div class="container">

				<?php the_content(); ?>

			</div>
			
		<?php endwhile; 

	else :

		get_template_part( 'content', 'none' );

	endif;

get_footer(); ?>