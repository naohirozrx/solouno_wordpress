<?php
/**
 * Template for delivery address member page.
 *
 * @package    WCEX Delivery Address
 * @subpackage WCEX Delivery Address/wc_templates/member
 */

get_header();
global $usces;
$usces_members = $usces->get_member();
?>
<div id="primary" class="site-content">
	<main id="content" class="member-page" role="main">

	<article class="post" id="wc_member_mda">
		<h2><?php esc_html_e( 'Delivery Address', 'welcart_simpleplus' ); ?></h2>
		<div id="memberpages">
			<div id="memberinfo" class="memb-delivery-address">
				<div class="user-info">
					<table>
						<tr>
							<th scope="row"><?php esc_html_e( 'member number', 'usces' ); ?></th>
							<td class="num"><?php echo esc_html( $usces_members['ID'] ); ?></td>
							<th><?php esc_html_e( 'Strated date', 'usces' ); ?></th>
							<td><?php echo esc_html( mysql2date( __( 'Y/m/d' ), $usces_members['registered'] ) ); ?></td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Full name', 'usces' ); ?></th>
							<td><?php usces_localized_name( $usces_members['name1'], $usces_members['name2'] ); ?></td>
							<?php if ( usces_is_membersystem_point() ) : ?>
								<th><?php esc_html_e( 'The current point', 'usces' ); ?></th>
								<td class="num"><?php echo esc_html( $usces_members['point'] ); ?></td>
							<?php else : ?>
								<th class="space">&nbsp;</th>
								<td class="space">&nbsp;</td>
							<?php endif; ?>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'e-mail adress', 'usces' ); ?></th>
							<td><?php echo esc_html( $usces_members['mailaddress1'] ); ?></td>
							<?php $welcart_simpleplus_html_reserve = '<th class="space">&nbsp;</th><td class="space">&nbsp;</td>'; ?>
							<?php echo apply_filters( 'usces_filter_memberinfo_page_reserve', $welcart_simpleplus_html_reserve, usces_memberinfo( 'ID', 'return' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						</tr>
					</table>
				</div>

				<ul class="member_submenu">
					<li class="edit_member"><a href="<?php echo esc_url( USCES_MEMBER_URL ); ?>"><?php esc_html_e( 'Return to top of member page', 'wcexda' ); ?></a></li>
					<?php do_action( 'usces_action_member_submenu_list' ); ?>
				</ul>
				<div class="header_explanation">
					<?php do_action( 'usces_action_memberinfo_page_header' ); ?>
				</div>

				<h2><?php esc_html_e( 'Register your shipping address', 'wcexda' ); ?></h2>
				<div class="msa_area">
					<div class="msa_total"><?php esc_html_e( 'Number of registrations', 'wcexda' ); ?><span id="msa_num">0</span><?php esc_html_e( 'addresses', 'wcexda' ); ?><input id="new_destination" type="button" value="<?php esc_attr_e( 'Adding a new shipping address', 'wcexda' ); ?>" /></div>
					<?php
					$welcart_simpleplus_nonce = isset( $_REQUEST['_wcnonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['_wcnonce'] ) ) : '';
					if ( isset( $_GET['mda_backurl'] ) && wp_verify_nonce( $welcart_simpleplus_nonce, WCEX_DA_Member_Page::WPNONCE ) ) :
						$welcart_simpleplus_cusurl = str_replace( 'customerinfo=1', 'customerinfo=mda', USCES_CUSTOMER_URL );
						?>
						<div class="return_navi"><a href="<?php echo esc_url_raw( $welcart_simpleplus_cusurl ); ?>"><?php esc_html_e( 'Return to Shipping Destination Settings', 'wcexda' ); ?></a></div>
						<div class="allocation_dialog_exp"><?php _e( '1. Click "Register New Shipping Address" to go to the new registration screen. <br>2. When you have finished entering your name and address, press "Register". <br>3. When you have completed your registration, press "Return to Shipping Address Settings" at the bottom of the screen. <br><br>You cannot delete a shipping address that is marked as (Yourself). To change or delete a registered shipping address, select a shipping address other than (you) from "Select a shipping address to edit".', 'wcexda' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<?php else : ?>
						<div class="allocation_dialog_exp"><?php _e( '1. Click "Register New Shipping Address" to go to the new registration screen. <br>2. When you have finished entering your name and address, press "Register". <br><br>You cannot delete a shipping address that is marked as (Yourself). To change or delete a registered shipping address, select a shipping address other than (you) from "Select a shipping address to edit".', 'wcexda' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<?php endif; ?>
					<div class="msa_operation">
						<label for="destination" class="destination_label"><?php esc_html_e( 'Select a shipping address to edit.', 'wcexda' ); ?></label><select id="destination"></select>
					</div>
					<div class="msa_field_block">
						<div class="msa_title"><?php esc_html_e( 'Delivery address', 'wcexda' ); ?> : <span id="destination_title" class="msa_title_inner"></span></div>
						<?php WCEX_DA_Member_Page::custom_delivery_field_input( 'name_pre' ); ?>
						<div class="msa_field">
							<label for="msa_company"><?php esc_html_e( 'Corporation name', 'wcexda' ); ?></label>
							<input id="msa_company" name="msa_company" type="text" />
						</div>
						<div class="msa_field">
							<label for="msa_name"><?php esc_html_e( 'Full name', 'wcexda' ); ?>???<?php esc_html_e( 'Required', 'wcexda' ); ?>???</label>
							<span class="name-ttl"><?php esc_html_e( 'Family name', 'wcexda' ); ?></span><input id="msa_name" name="msa_name" type="text" />
							<span class="name-ttl"><?php esc_html_e( 'First name', 'wcexda' ); ?></span><input id="msa_name2" name="msa_name2" type="text" />
							<span id="name_message" class="msa_message"></span>
						</div>
						<div class="msa_field">
							<label for="msa_furigana"><?php esc_html_e( 'Furigana', 'wcexda' ); ?></label>
							<span class="name-ttl">??????</span><input id="msa_furigana" name="msa_furigana" type="text" />
							<span class="name-ttl">??????</span><input id="msa_furigana2" name="msa_furigana2" type="text" />
						</div>
						<?php WCEX_DA_Member_Page::custom_delivery_field_input( 'name_after' ); ?>
						<div class="msa_field">
							<label for="zipcode"><?php esc_html_e( 'Postal code', 'wcexda' ); ?>???<?php esc_html_e( 'Required', 'wcexda' ); ?>???</label>
							<input id="zipcode" name="zipcode" type="text" />
							<?php
							if ( isset( $usces->options['address_search'] ) && 'activate' === $usces->options['address_search'] ) {
								echo "<input type='button' id='search_zipcode' class='search-zipcode button' value='????????????' onclick=\"AjaxZip3.zip2addr('zipcode', '', 'member_pref', 'msa_address1');\">";
							}
							?>
							<span id="zip_message" class="msa_message"></span>
						</div>
						<div class="msa_field">
							<label for="member_pref"><?php esc_html_e( 'Prefecture', 'wcexda' ); ?>???<?php esc_html_e( 'Required', 'wcexda' ); ?>???</label>
							<select name="member_pref" id="member_pref" class="pref">
								<option value="0">--??????--</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="????????????">????????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="????????????">????????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="?????????">?????????</option>
								<option value="????????????">????????????</option>
								<option value="?????????">?????????</option>
							</select>
							<span id="pref_message" class="msa_message"></span>
						</div>
						<div class="msa_field">
							<label for="msa_address1"><?php esc_html_e( 'Cities, towns and villages', 'wcexda' ); ?>???<?php esc_html_e( 'Required', 'wcexda' ); ?>???</label>
							<input id="msa_address1" name="msa_address1" type="text" />
							<span id="address1_message" class="msa_message"></span>
						</div>
						<div class="msa_field">
							<label for="msa_address2"><?php esc_html_e( 'Address', 'wcexda' ); ?>???<?php esc_html_e( 'Required', 'wcexda' ); ?>???</label>
							<input id="msa_address2" name="msa_address2" type="text" />
							<span id="address2_message" class="msa_message"></span>
						</div>
						<div class="msa_field">
							<label for="msa_address3"><?php esc_html_e( 'Building name, etc.', 'wcexda' ); ?></label>
							<input id="msa_address3" name="msa_address3" type="text" />
						</div>
						<div class="msa_field">
							<label for="msa_tel"><?php esc_html_e( 'Phone number', 'wcexda' ); ?>???<?php esc_html_e( 'Required', 'wcexda' ); ?>???</label>
							<input id="msa_tel" name="msa_tel" type="text" />
							<span id="tel_message" class="msa_message"></span>
						</div>
						<div class="msa_field">
							<label for="msa_fax"><?php esc_html_e( 'FAX number', 'wcexda' ); ?></label>
							<input id="msa_fax" name="msa_fax" type="text" />
							<span id="fax_message" class="msa_message"></span>
						</div>
						<?php WCEX_DA_Member_Page::custom_delivery_field_input( 'fax_after' ); ?>
						<div class="msa_field">
							<label for="msa_note"><?php esc_html_e( 'Remarks', 'wcexda' ); ?></label>
							<textarea id="msa_note" name="msa_note"></textarea>
						</div>
						<input name="_wcnonce" type="hidden" value="<?php echo esc_attr( wp_create_nonce( WCEX_DA_Member_Page::WPNONCE ) ); ?>"/>
						<input name="member_id" type="hidden" value="<?php echo esc_attr( $usces_members['ID'] ); ?>"/>
						<div id="msa_button">
							<input name="add_destination" id="add_destination" type="button" value="<?php esc_attr_e( 'Register', 'wcexda' ); ?>" />
							<input name="edit_destination" id="edit_destination" type="button" value="<?php esc_attr_e( 'Update', 'wcexda' ); ?>" />
							<input name="cancel_destination" id="cancel_destination" type="button" value="<?php esc_attr_e( 'Cancel', 'wcexda' ); ?>" />
							<input id="del_destination" type="button" value="<?php esc_attr_e( 'Delete', 'usces' ); ?>" />
						</div>
						<div id="msa_loading"></div>
					</div>
				</div>
			</div>
		</div>
	</article>
	</main><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
