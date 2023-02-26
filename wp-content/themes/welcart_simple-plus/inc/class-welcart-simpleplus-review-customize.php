<?php
/**
 * Review Customized
 *
 * @package welcart
 */

/**
 * Category Custom Fields
 */
class Welcart_Simpleplus_Review_Customize {

	/**
	 * Constructer
	 */
	public function __construct() {
		add_action( 'usces_action_login_page_inform', array( $this, 'login_inform_referer' ) );
		add_action( 'usces_action_after_login', array( $this, 'after_login_redirect' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars_filter' ) );
	}

	/**
	 * Add query vars filter
	 *
	 * @param array $vars vars.
	 * @return array
	 */
	public function add_query_vars_filter( $vars ) {
		$vars[] = 'login_ref';
		return $vars;
	}


	/**
	 * Login Inform Referer
	 */
	public function login_inform_referer() {
		$login_ref = get_query_var( 'login_ref' );
		if ( $login_ref ) :
			wp_nonce_field( 'to_ref_page', 'after_login_redirect' );?>
			<input type="hidden" name="login_ref" value="<?php echo esc_attr( $login_ref ); ?>" />
			<?php
		endif;
	}
	/**
	 * After Login Redirect
	 */
	public function after_login_redirect() {

		$login_ref = isset( $_REQUEST['login_ref'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['login_ref'] ) ) : '';
		if ( isset( $_POST['after_login_redirect'] )
			&& ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['after_login_redirect'] ) ), 'to_ref_page' )
		) {
			exit;
		}

		if ( ! empty( $login_ref ) ) {
			wp_safe_redirect( esc_url( $login_ref . '#wc-reviews' ) );
			exit;
		}
	}

	/**
	 * Review.
	 *
	 * @param string $comment Comment.
	 * @param array  $args Comment.
	 * @param array  $depth Comment.
	 */
	public function wc_review( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'comment':
				?>
				<li <?php comment_class(); ?> id="li-review-<?php comment_ID(); ?>">
					<div id="comment-<?php comment_ID(); ?>">
						<?php if ( '0' === $comment->comment_approved ) : ?>
							<p class="review-meta reviewmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<?php printf( wp_kses_post( '%1$s %2$s', 'welcart_simpleplus' ), wp_kses_post( get_comment_date() ), wp_kses_post( get_comment_time() ) ); ?></a><?php edit_comment_link( __( '(Edit)', 'welcart_simpleplus' ), ' ' ); ?>
							</p><!-- .review-meta .reviewmetadata -->
							<p class="waitting"><em><?php esc_html_e( 'Thank you for the review. Please wait for a while until it is published.', 'welcart_simpleplus' ); ?></em></p>
						<?php else : ?>
							<p class="review-author vcard">
								<span class="author-icon"><span></span></span>
								<?php printf( '%s', get_comment_author_link() . esc_html__( 'says:', 'welcart_simpleplus' ) ); ?>
							</p><!-- .review-author .vcard -->
							<div class="review-body"><?php comment_text(); ?></div>
							<p class="review-meta reviewmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<?php esc_attr( comment_date() ); ?></a><?php edit_comment_link( __( '(Edit)', 'welcart_simpleplus' ), ' ' ); ?>
							</p><!-- .review-meta .reviewmetadata -->
						<?php endif; ?>
					</div><!-- #review-##  -->
				<?php
				break;
			default:
				break;
		endswitch;
	}
}

