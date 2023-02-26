<?php
/**
 * Product Review Template
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

/* It does not display anything when you do not accept the comment. */
if ( comments_open() ) :
	?>

	<?php
	if ( usces_is_membersystem_state() ) :
		?>
		<div class="entry-review">
			<?php
			/* Only when you are logged in Welcart, the comment form is displayed. */
			if ( usces_is_login() ) :

				comment_form(
					array(
						'id_form'              => 'reviewform',
						'id_submit'            => 'submit',
						'title_reply'          => '',
						'title_reply_to'       => '',
						'cancel_reply_link'    => '',
						'label_submit'         => __( 'Submit a review', 'welcart_simpleplus' ),
						'comment_field'        => '<p class="review-form-review"><label for="comment">' . __( 'Write a review', 'welcart_simpleplus' ) .
						'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
						'</textarea></p>',
						'must_log_in'          => '',
						'logged_in_as'         => '',
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' =>
							'<p class="comment-form-author">' .
							'<label for="author">' . __( 'Nickname', 'welcart_simpleplus' ) . '<span>' . __( '（Nickname will be published.）', 'welcart_simpleplus' ) . '</span></label> ' .
							'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
							'" size="30" /></p>',
						),
					)
				);

			else :
				?>

				<p class="reviews-btn">
					<?php // phpcs:ignore; ?>
					<a href="<?php echo esc_url( add_query_arg( array( 'login_ref' => urlencode( ( empty( $_SERVER['HTTPS'] ) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ) ), USCES_MEMBER_URL ) ); ?>">
						<?php esc_html_e( 'To login', 'welcart_simpleplus' ); ?>
					</a>
				</p>
				<p class="not-login-reviews"><?php esc_html_e( 'When you log in you can post a review.', 'welcart_simpleplus' ); ?></p>

				<?php
			endif;
			?>
		</div>
		<?php
	endif;
	?>

	<?php
endif;

