<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress 
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area<?php if ( !have_comments() ) : ?> no-comments<?php endif; ?>">

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title"><?php esc_html_e( 'Comments', 'modellic' ); ?></h4>

		<?php modellic_comment_nav(); ?>

		<ol class="comment-list commentlist"><?php
			wp_list_comments( array(
				'callback'    => 'modellic_comment',
				'short_ping'  => true,
				'avatar_size' => 60,
				'per_page'    => 1000
			) );
		?></ol>

		<?php modellic_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'modellic' ); ?></p>
	<?php endif; ?>

	<?php

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
		'author' => '<div class="row"><div class="col s12 m12 l6"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . esc_html__( 'Name', 'modellic' ) . ( $req ? ' *' : '' ) . '"></div>',
		'email'  => '<div class="col s12 m12 l6"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . esc_html__( 'Email', 'modellic' ) . ( $req ? ' *' : '' ) . '"></div></div>',
	);

	$args = array(
		'id_form'           => 'commentform',
		'id_submit'         => 'submit',
		'class_submit'      => 'btn btn-large',
		'name_submit'       => 'submit',
		'title_reply'       => esc_html__( 'Leave a Reply', 'modellic' ),
		'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'modellic' ),
		'cancel_reply_link' => esc_html__( 'Cancel Reply', 'modellic' ),
		'label_submit'      => esc_html__( 'Post Comment', 'modellic' ),

		'comment_field' => '<div class="row"><div class="col s12"><textarea id="comment" name="comment" aria-required="true" placeholder="' . esc_html__( 'Comment', 'modellic' ) . '"></textarea></div></div>',

		'must_log_in'   => '<p class="must-log-in">' . sprintf( wp_kses_post( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'modellic' ) ), wp_login_url( apply_filters( 'the_permalink', esc_url( get_permalink() ) ) ) ) . '</p>',

		'logged_in_as'  => '<p class="logged-in-as">' . sprintf( wp_kses_post( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'modellic' ) ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', esc_url( get_permalink() ) ) ) ) . '</p>',

		'comment_notes_before' => '',

		'comment_notes_after'  => '',

		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	); ?>

	<?php comment_form( $args ); ?>

</div>