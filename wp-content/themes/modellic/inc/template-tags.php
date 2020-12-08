<?php
/**
 * Custom template tags for Modellic
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Modellic 1.0
 */

if ( ! function_exists( 'modellic_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Twenty Fifteen 1.0
 */
function modellic_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'modellic' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'modellic' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'modellic' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div>
	</nav>
	<?php
	endif;
}
endif;

if ( ! function_exists( 'modellic_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since Modellic 1.0
 */
function modellic_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'modellic' ) );
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s"><span>%2$s</span>%3$s</time>';

		printf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date( 'j' ),
			get_the_date( 'M' )
		);
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<div class="comments"><i class="icon-comment"></i>';
		comments_popup_link( esc_html__( '0', 'modellic' ), esc_html__( '1', 'modellic' ), esc_html__( '%', 'modellic' ) );
		echo '</div>';
	}

}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @since Modellic 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function modellic_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'modellic_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'modellic_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so modellic_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so modellic_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in {@see modellic_categorized_blog()}.
 *
 * @since Modellic 1.0
 */
function modellic_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'modellic_categories' );
}
add_action( 'edit_category', 'modellic_category_transient_flusher' );
add_action( 'save_post',     'modellic_category_transient_flusher' );

if ( ! function_exists( 'modellic_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Modellic 1.0
 */
function modellic_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) : ?>

	<div class="post-thumb">
		<?php the_post_thumbnail( 'blog', array( 'class' => "responsive-img", ) ); ?>
	</div>

	<?php else : ?>

	<a class="post-thumb" href="<?php echo esc_url( get_permalink() ); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'blog', array( 'alt' => get_the_title(), 'class' => "responsive-img", ) ); ?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'modellic_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Modellic 1.0
 *
 * @see get_url_in_content()
 *
 * @return string The Link format URL.
 */
function modellic_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', esc_url( get_permalink() ) );
}
endif;

if ( ! function_exists( 'modellic_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @since Modellic 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function modellic_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( esc_html__( 'Continue reading %s', 'modellic' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'modellic_excerpt_more' );
endif;
