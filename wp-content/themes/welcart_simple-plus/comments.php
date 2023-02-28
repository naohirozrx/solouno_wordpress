<?php
/**
 * Comments
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$welcart_simpleplus_comments_number = get_comments_number();
			if ( 1 === $welcart_simpleplus_comments_number ) {
				echo wp_kses_post( sprintf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'welcart_simpleplus' ), get_the_title() ) );
			} else {
				echo wp_kses_post(
					sprintf(
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$welcart_simpleplus_comments_number,
							'comments title',
							'welcart_simpleplus'
						),
						number_format_i18n( $welcart_simpleplus_comments_number ),
						get_the_title()
					)
				);
			}
			?>
		</h2>

		<div class="left-block">

			<ol class="comment-list">
				<?php
					wp_list_comments(
						array(
							'style'       => 'ol',
							'short_ping'  => true,
							'avatar_size' => 42,
						)
					);
				?>
			</ol><!-- .comment-list -->

			<?php the_comments_navigation(); ?>

		</div>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'welcart_simpleplus' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form(
			array(
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
			)
		);
		?>

</div><!-- .comments-area -->
