<?php
/**
 * Wc delivery page
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header();
usces_delivery_info_script();
?>
<div id="primary" class="site-content">
	<main id="content" class="cart-page" role="main">

	<?php
	if ( have_posts() ) :
		usces_remove_filter();
		?>

		<article class="post" id="wc_<?php usces_page_name(); ?>">


			<div id="delivery-info">

				<div class="cart_navi">
					<ul>
						<li><?php esc_html_e( '1.Cart', 'usces' ); ?></li>
						<li><?php esc_html_e( '2.Customer Info', 'usces' ); ?></li>
						<li class="current"><?php esc_html_e( '3.Deli. & Pay.', 'usces' ); ?></li>
						<li><?php esc_html_e( '4.Confirm', 'usces' ); ?></li>
					</ul>
				</div>

				<div class="header_explanation">
					<?php do_action( 'usces_action_delivery_page_header' ); ?>
				</div><!-- .header_explanation -->

				<div class="error_message"><?php usces_error_message(); ?></div>

				<form action="<?php usces_url( 'cart' ); ?>" method="post">

					<?php if ( wel_have_shipped() ) : ?>
					<table class="customer_form" id="delivery_flag">
						<tr>
							<th rowspan="2" scope="row"><?php esc_html_e( 'shipping address', 'usces' ); ?></th>
							<td>
								<input name="delivery[delivery_flag]" type="radio" id="delivery_flag1" onclick="document.getElementById('delivery_table').style.display = 'none';" value="0" <?php echo 0 == $usces_entries['delivery']['delivery_flag'] ? ' checked' : ''; // phpcs:ignore ?> onKeyDown="if (event.keyCode == 13) {return false;}" />
								<label for="delivery_flag1">
									<?php esc_html_e( 'same as customer information', 'usces' ); ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<input name="delivery[delivery_flag]" id="delivery_flag2" onclick="document.getElementById('delivery_table').style.display = 'table'" type="radio" value="1" <?php echo 1 == $usces_entries['delivery']['delivery_flag'] ? ' checked' : ''; // phpcs:ignore ?> onKeyDown="if (event.keyCode == 13) {return false;}" />
								<label for="delivery_flag2">
									<?php esc_html_e( 'Chose another shipping address.', 'usces' ); ?>
								</label>
							</td>
						</tr>
					</table>
						<?php do_action( 'usces_action_delivery_flag' ); ?>

					<table class="customer_form" id="delivery_table">
						<?php uesces_addressform( 'delivery', $usces_entries, 'echo' ); ?>
					</table>
					<?php endif; ?>

					<table class="customer_form" id="time">
					<?php if ( wel_have_shipped() ) : ?>
						<tr>
							<th scope="row"><?php esc_html_e( 'shipping option', 'usces' ); ?></th>
							<td colspan="2"><?php usces_the_delivery_method( $usces_entries['order']['delivery_method'] ); ?></td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Delivery date', 'usces' ); ?></th>
							<td colspan="2"><?php usces_the_delivery_date( $usces_entries['order']['delivery_date'] ); ?></td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Delivery Time', 'usces' ); ?></th>
							<td colspan="2"><?php usces_the_delivery_time( $usces_entries['order']['delivery_time'] ); ?></td>
						</tr>
					<?php endif; ?>
						<tr class="paymethodwrap">
							<th scope="row"><em><?php esc_html_e( '*', 'usces' ); ?></em><?php esc_html_e( 'payment method', 'usces' ); ?></th>
							<td colspan="2">
								<p>※SOLO UNOオーダーメイドランドセルをお申し込みの際は、注意事項をご了承の上、お支払方法をお選びくださいますようお願いいたします。</p>
								<?php usces_the_payment_method( $usces_entries['order']['payment_name'] ); ?></td>
						</tr>
					</table>

					<?php usces_delivery_secure_form(); ?>

					<?php $welcart_simpleplus_meta = usces_has_custom_field_meta( 'order' ); ?>
					<?php if ( ! empty( $welcart_simpleplus_meta ) && is_array( $welcart_simpleplus_meta ) ) : ?>
						<table class="customer_form" id="custom_order">
							<?php usces_custom_field_input( $usces_entries, 'order', '' ); ?>
						</table>
					<?php endif; ?>

					<?php if ( wel_have_dlseller_content() ) : ?>
					<table class="customer_form" id="dlseller_terms">
						<tr>
							<th rowspan="2" scope="row"><em><?php esc_html_e( '*', 'usces' ); ?></em><?php esc_html_e( 'Terms of Use', 'dlseller' ); ?></th>
							<td colspan="2"><div class="dlseller_terms"><?php dlseller_terms(); ?></div></td>
						</tr>
						<tr>
							<td colspan="2"><label for="terms"><input type="checkbox" name="offer[terms]" id="terms" /><?php esc_html_e( 'Agree', 'dlseller' ); ?></label></td>
						</tr>
					</table>
					<?php endif; ?>

					<table class="customer_form" id="notes_table">
						<tr>
							<?php $welcart_simpleplus_entry_order_note = ( empty( $usces_entries['order']['note'] ) ) ? apply_filters( 'usces_filter_default_order_note', null ) : $usces_entries['order']['note']; ?>
							<th scope="row"><?php esc_html_e( 'Notes', 'usces' ); ?></th>
							<td colspan="2"><textarea name="offer[note]" id="note" class="notes"><?php echo esc_html( $welcart_simpleplus_entry_order_note ); ?></textarea></td>
						</tr>
					</table>

					<div>
						<h4>〈オーダーメイドランドセルお申し込みの際のお支払方法に関する注意事項〉</h4>
						<p><strong>■クレジットカード支払い</strong><br />
						・組み合わせ変更により価格が変更となった場合は、ご変更後の価格にて決済いたします。</p>
						<p><strong>■銀行振込</strong><br />
						・お申し込みから14日間は組み合わせの変更が可能ですが、お振込みいただいた時点で組み合わせの確定とさせていただきます。<br />
						<br />
						・組み合わせ内容の変更により価格が変更となる場合は変更後の価格をお振込みください。<br />
						<br />
						・15日以内にお振込みください。なお、お手数料はご負担くださいますようお願いいたします。
						</p>
					</div>

					<div class="send">
						<input name="offer[cus_id]" type="hidden" value="" />
						<input name="backCustomer" type="submit" class="back_to_customer_button" value="<?php esc_html_e( 'Back', 'usces' ); ?>"<?php echo esc_attr( apply_filters( 'usces_filter_deliveryinfo_prebutton', null ) ); ?> />&nbsp;&nbsp;
						<input name="confirm" type="submit" class="to_confirm_button" value="<?php esc_html_e( ' Next ', 'usces' ); ?>"<?php echo esc_attr( apply_filters( 'usces_filter_deliveryinfo_nextbutton', null ) ); ?> />
					</div>
					<?php do_action( 'usces_action_delivery_page_inform' ); ?>
				</form>

				<div class="footer_explanation">
					<?php do_action( 'usces_action_delivery_page_footer' ); ?>
				</div><!-- .footer_explanation -->

			</div><!-- #delivery-info -->

		</article><!-- .post -->

	<?php else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</main><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
