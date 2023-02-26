<?php
/**
 * The template for displaying revie-list
 *
 * @package welcart_assertive
 */

/* It does not display anything when you do not accept the comment. */
if ( ! comments_open() ) {
	return;
}
/* If this product has review */
if ( have_comments() ) :
	?>
	<div class="entry-review-list">
		<?php
		if ( 0 < get_comments_number() ) :
			?>

				<div class="review-header">
					<p class="review-item-thumbnail"><?php usces_the_itemImage( 0, 150, 150, $post ); ?></p>
					<h3 id="wc-reviews-title" class="review-title">
						<?php
						/* translators: %s: search term */
						printf( esc_attr__( 'Reviews to %s', 'welcart_simpleplus' ), esc_html( usces_the_itemName( 'return' ) ) );
						?>
					</h3>
				</div>

			<?php
		endif;
		?>

		<ol class="wc-reviewlist">

			<?php
				wp_list_comments(
					array(
						'type'     => 'comment',
						'callback' => 'wc_review',
					)
				);
			?>

		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?> 
			<div id="review-paginate" class="review-paginate">
				<?php
				paginate_comments_links(
					array(
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
					)
				);
				?>
			</div><!-- #review-paginate -->
		<?php endif; ?>
	</div>
	<?php
else :
	?>

	<p class="no-reviews"><?php esc_html_e( 'We hope that you will post a review.', 'welcart_simpleplus' ); ?></p>

	<?php
endif;
