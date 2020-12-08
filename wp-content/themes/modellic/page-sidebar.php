<?php /* Template name: With Sidebar */
get_header();

	if ( have_posts() ) :

		while ( have_posts() ) : the_post(); ?>

			<section id="content">
				<div class="container">

					<div class="title">
						<?php the_title('<h1>', '</h1>'); ?>
					</div>

					<div class="row">
						<div class="col s12 m8 l8 xl9">
							<?php the_content(); ?>
						</div>
						<div class="col s12 m4 l4 xl3" id="sidebar-wrapper">
							<div id="sidebar-closer"></div>
							<div id="sidebar">
								<?php dynamic_sidebar( 'page' ); ?>
							</div>
						</div>
					</div>

				</div>
			</section>
			
		<?php endwhile; 

	else :

		get_template_part( 'content', 'none' );

	endif;

get_footer(); ?>