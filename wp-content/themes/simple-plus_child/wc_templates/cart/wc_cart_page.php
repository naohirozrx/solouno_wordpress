<?php
/**
 * WC Cart Page
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header();
?>
<div id="primary" class="site-content">
	<main id="content" class="cart-page" role="main">

	<?php
	if ( have_posts() ) :
		usces_remove_filter();
		?>

		<article class="post" id="wc_<?php usces_page_name(); ?>">

			<div class="cart_navi">
				<ul>
					<li class="current"><?php esc_html_e( '1.Cart', 'usces' ); ?></li>
					<li><?php esc_html_e( '2.Customer Info', 'usces' ); ?></li>
					<li><?php esc_html_e( '3.Deli. & Pay.', 'usces' ); ?></li>
					<li><?php esc_html_e( '4.Confirm', 'usces' ); ?></li>
				</ul>
			</div>

			<div class="header_explanation">
				<?php do_action( 'usces_action_cart_page_header' ); ?>
			</div><!-- .header_explanation -->

			<div class="error_message"><?php usces_error_message(); ?></div>

			<form action="<?php usces_url( 'cart' ); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">
			<?php if ( usces_is_cart() ) : ?>
				<div id="cart">
				<?php //echo apply_filters( 'usces_theme_filter_upbutton', '<div class="upbutton">' . __( 'Press the `update` button when you change the amount of items.', 'usces' ) . '<input name="upButton" type="submit" value="' . __( 'Quantity renewal', 'usces' ) . '" onclick="return uscesCart.upCart()" /></div>' ); // phpcs:ignore ?>
					<table cellspacing="0" id="cart_table">
						<thead>
							<tr>
								<th scope="row" class="num">No.</th>
								<th class="thumbnail"> </th>
								<th class="productname"><?php esc_html_e( 'item name', 'usces' ); ?></th>
								<th class="unitprice"><?php esc_html_e( 'Unit price', 'usces' ); ?></th>
								<th class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?></th>
								<th class="subtotal"><?php esc_html_e( 'Amount', 'usces' ); ?><?php usces_guid_tax(); ?></th>
								<th class="stock"><?php esc_html_e( 'stock status', 'usces' ); ?></th>
								<th class="action"></th>
							</tr>
						</thead>
						<tbody>
							<?php usces_get_cart_rows(); ?>
							<tr style="border:none;" class="changebutton">
								<td colspan="8" style="border:none;">
									<div class="upbutton">数量を変更した場合は必ず更新ボタンを押してください。<input name="upButton" type="submit" value="数量更新" onclick="return uscesCart.upCart()"></div>
								</td>
							</tr>

						</tbody>
						<tfoot>
							<tr>
								<th colspan="2" class="num">
									<div class="currency_code"><?php esc_html_e( 'Currency', 'usces' ); ?> : <?php usces_crcode(); ?></div>
								</th>
								<th class="thumbnail"></th>
								<th class="productname"></th>
								<th colspan="2" scope="row" class="aright amount-text"><?php esc_html_e( 'total items', 'usces' ); ?><?php usces_guid_tax(); ?></th>
								<th colspan="2" class="aright amount"><?php usces_crform( usces_total_price( 'return' ), true, false ); ?></th>
							</tr>
						</tfoot>
					</table>
					<?php if ( $usces_gp ) : ?>
					<div class="gp"><img src="<?php bloginfo( 'template_directory' ); ?>/images/gp.gif" alt="<?php esc_attr_e( 'Business package discount', 'usces' ); ?>" /><span><?php esc_html_e( 'The price with this mark applys to Business pack discount.', 'usces' ); ?></span></div>
					<?php endif; ?>
				</div><!-- #cart -->
			<?php else : ?>
				<div class="no_cart"><?php esc_html_e( 'There are no items in your cart.', 'usces' ); ?></div>
			<?php endif; ?>

				<div class="send"><?php usces_get_cart_button(); ?></div>
				<?php do_action( 'usces_action_cart_page_inform' ); ?>
			</form>

			<div class="footer_explanation">
				<?php do_action( 'usces_action_cart_page_footer' ); ?>
			</div><!-- .footer_explanation -->

		</article><!-- .post -->

	<?php else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</main><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
