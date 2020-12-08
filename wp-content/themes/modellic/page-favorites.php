<?php /* Template name: Favorites */

get_header();

	if ( have_posts() ) :

		while ( have_posts() ) : the_post(); ?>

			<section id="content">
				<div class="container">

					<div class="title">
						<?php the_title('<h1>', '</h1>'); ?>
					</div>

					<?php the_content(); ?>

					<?php the_user_favorites_list(
					        $user_id = get_current_user_id(),
                            $site_id = get_current_blog_id(),
                            $include_links = true,
                            $filters = null,
                            $include_button = true,
                            $include_thumbnails = true,
                            $thumbnail_size = 'thumbnail',
                            $include_excerpt = true
                    ); ?>

				</div>
			</section>
			
		<?php endwhile; 

	else :

		get_template_part( 'content', 'none' );

	endif;

get_footer(); ?>