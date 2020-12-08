<?php /* Template name: Archive Testimonials */
get_header();

	if ( have_posts() ) :

		while ( have_posts() ) : the_post(); ?>

			<section id="content">
				<div class="container">

					<div class="title">
						<?php the_title('<h1>', '</h1>'); ?>
					</div>

					<?php 
					$args = array(
						'post_type' => 'testimonial', // enter your custom post type
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page'=> '12',  // overrides posts per page in theme settings
					);
					$loop = new WP_Query( $args );

					if( $loop->have_posts() ):
								
						while( $loop->have_posts() ): $loop->the_post(); global $post;

							get_template_part( 'content-testimonial', get_post_format() );
						
						endwhile;
						
					endif; ?>

				</div>
			</section>
			
		<?php endwhile; 

	else :

		get_template_part( 'content', 'none' );

	endif;

get_footer(); ?>