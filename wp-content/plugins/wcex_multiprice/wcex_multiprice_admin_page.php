<?php
/**
 * マルチプライス設定画面
 *
 * @package WCEX Multi Price
 */

?>
<script type='text/javascript'>
/* <![CDATA[ */
wcex_multiprice_data = {
	'cart_number': "<?php echo esc_attr( $cart_number ); ?>",
	'option_means': new Array( <?php echo $option_means; // phpcs:ignore ?> ),
	'confirm01': "<?php _e( 'Delete %s. Is it OK?', 'multiprice' ); // phpcs:ignore ?>",
	'message01': "<?php esc_attr_e( 'The same options as option 1 can not be set.', 'multiprice' ); ?>",
	'message02': "<?php esc_attr_e( 'The same options as option 2 can not be set.', 'multiprice' ); ?>",
	'message03': "<?php esc_attr_e( 'Option 1 is not selected.', 'multiprice' ); ?>",
	'message04': "<?php esc_attr_e( 'Please enter the amount.', 'multiprice' ); ?>",
	'message05': "<?php esc_attr_e( 'Please enter a numeric value.', 'multiprice' ); ?>",
	'message06': "<?php esc_attr_e( 'The same rule name exists.', 'multiprice' ); ?>",
	'lbl_addcol': "<?php esc_attr_e( 'Add column', 'multiprice' ); ?>",
	'lbl_delcol': "<?php esc_attr_e( 'Delete column', 'multiprice' ); ?>",
	'lbl_col': "<?php esc_attr_e( 'Column : ', 'multiprice' ); ?>",
	'lbl_addrow': "<?php esc_attr_e( 'Add row', 'multiprice' ); ?>",
	'lbl_delrow': "<?php esc_attr_e( 'Delete row', 'multiprice' ); ?>",
	'lbl_row': "<?php esc_attr_e( 'Row : ', 'multiprice' ); ?>",
	'lbl_dash': "<?php esc_attr_e( ' - ', 'multiprice' ); ?>",
	'lbl_from0': "<?php esc_attr_e( '0 - ', 'multiprice' ); ?>",
}
/* ]]> */
</script>
<div class="wrap">
<div class="usces_admin">
<h1>WCEX <?php esc_html_e( 'Multi Price', 'multiprice' ); ?></h1>
<p class="version_info">Version <?php echo esc_html( WCEX_MULTIPRICE_VERSION ); ?></p>
<?php usces_admin_action_status(); ?>
<?php
if ( ! empty( $options ) ) :
	?>
<div class="wcex_multiprice_button_box_top">
<form action="" method="post" name="option_form[]" id="option_form_new">
<input type="submit" name="wcex_multiprice_add" class="button" value="<?php esc_attr_e( 'New addition', 'usces' ); ?>" />
	<?php wp_nonce_field( 'wcex_multiprice', 'wc_nonce' ); ?>
</form>
</div>
	<?php
endif;
?>
<div id="poststuff" class="metabox-holder">
<div class="uscestabs" id="wcex_multiprice_tabs">
<?php
if ( empty( $options ) ) :
	?>
	<ul>
		<li><a href="#price1"><?php esc_html_e( 'Rule', 'multiprice' ); ?>1</a></li>
	</ul>
	<div id="price1">
		<?php esc_html_e( 'Please create a common option.', 'usces' ); ?>
	</div>
	<?php
else :
	?>
	<ul>
	<?php
	$rule_names = array();
	foreach ( $wcex_multiprice as $mpid => $value ) :
		$rule_names[ $mpid ] = ( ! empty( $value['name'] ) ) ? $value['name'] : __( 'Rule', 'multiprice' ) . str_replace( 'price', '', $mpid );
		?>
		<li><a href="#<?php echo esc_attr( $mpid ); ?>"><?php echo esc_html( $rule_names[ $mpid ] ); ?></a></li>
		<?php
	endforeach;
	?>
	</ul>
	<?php
	foreach ( $wcex_multiprice as $mpid => $value ) :
		$name              = ( ! empty( $value['name'] ) ) ? $value['name'] : $rule_names[ $mpid ];
		$dimension         = $value['dimension'];
		$option1           = $value['option1'];
		$option2           = $value['option2'];
		$price             = $value['price'];
		$dimension_checked = ( 2 == $dimension ) ? ' checked' : '';

		/* [Option1] */
		if ( ! empty( $option1 ) && '#NONE#' != $option1 ) {
			$opt    = wcex_multiprice_get_option( $option1, $cart_number );
			$means1 = (int) $opt['means'];
			$value1 = ( 0 === $means1 ) ? $opt['value'] : '';
		} else {
			$means1 = -1;
			$value1 = '';
		}

		/* [Option2] */
		if ( ! empty( $option2 ) && '#NONE#' != $option2 ) {
			$opt             = wcex_multiprice_get_option( $option2, $cart_number );
			$means2          = (int) $opt['means'];
			$value2          = ( 0 === $means2 ) ? $opt['value'] : '';
			$option2_display = '';
		} else {
			$means2          = -1;
			$value2          = '';
			$option2_display = ' style="display:none"';
		}
		$value1 = wcex_change_line_break( $value1 );
		$value2 = wcex_change_line_break( $value2 );
		?>
	<div id="<?php echo esc_attr( $mpid ); ?>">
		<div class="postbox">
		<div class="inside">
		<form action="" method="post" name="option_form[]" id="option_form_<?php echo esc_attr( $mpid ); ?>">
		<input type="hidden" name="wcex_multiprice_id[]" id="wcex_multiprice_id_<?php echo esc_attr( $mpid ); ?>" value="<?php echo esc_attr( $mpid ); ?>" />
		<input type="hidden" id="wcex_multiprice_name_<?php echo esc_attr( $mpid ); ?>" value="<?php echo esc_attr( $rule_names[ $mpid ] ); ?>" />
		<table class="wcex_multiprice_item">
			<tr height="30">
				<th><a style="cursor:pointer;" onclick="toggleVisibility('ex_name_<?php echo esc_attr( $mpid ); ?>');"><?php esc_html_e( 'Name', 'multiprice' ); ?>&nbsp;&nbsp;&nbsp;&nbsp;</a></th>
				<td><input type="text" name="wcex_multiprice_name_<?php echo esc_attr( $mpid ); ?>" value="<?php echo esc_attr( $name ); ?>" /></td>
				<td><div id="ex_name_<?php echo esc_attr( $mpid ); ?>" class="explanation"><?php esc_html_e( 'Set the rule name. If you update it with a blank, it will be set to the default value.', 'multiprice' ); ?></div></td>
			</tr>
			<tr height="30">
				<th><a style="cursor:pointer;" onclick="toggleVisibility('ex_option1_<?php echo esc_attr( $mpid ); ?>');"><?php esc_html_e( 'Option 1', 'multiprice' ); ?></a></th>
				<td><select name="wcex_multiprice_option1_<?php echo esc_attr( $mpid ); ?>" id="wcex_multiprice_option1_<?php echo esc_attr( $mpid ); ?>" class="wcex_multiprice_option1">
						<option value="#NONE#"></option>
					<?php foreach ( $options as $key => $option ) : ?>
						<?php $selected = ( $option1 == $option['key'] ) ? ' selected' : ''; ?>
						<option value="<?php echo esc_attr( $option['key'] ); ?>"<?php echo esc_html( $selected ); ?>><?php echo esc_html( $option['key'] ); ?></option>
					<?php endforeach; ?>
					</select>
				</td>
				<td><input type="checkbox" name="wcex_multiprice_dimension_<?php echo esc_attr( $mpid ); ?>" id="wcex_multiprice_dimension_<?php echo esc_attr( $mpid ); ?>" value="<?php echo esc_attr( $dimension ); ?>"<?php echo esc_html( $dimension_checked ); ?>><label for="wcex_multiprice_dimension_<?php echo esc_attr( $mpid ); ?>"><?php esc_html_e( 'Add condition', 'multiprice' ); ?></label></td>
				<td><div id="ex_option1_<?php echo esc_attr( $mpid ); ?>" class="explanation"><?php esc_html_e( 'Select the item option to link prices. Beforehand, you need to register common options from "General Setting".', 'multiprice' ); ?><br /><?php esc_html_e( 'If you check "Add condition", you can specify another item option.', 'multiprice' ); ?><?php esc_html_e( 'The two options interact to change the price.', 'multiprice' ); ?></div></td>
			</tr>
		</table>
		<table id="wcex_multiprice_item_option2_<?php echo esc_attr( $mpid ); ?>" class="wcex_multiprice_item"<?php echo $option2_display; // phpcs:ignore ?>>
			<tr height="30">
				<th><a style="cursor:pointer;" onclick="toggleVisibility('ex_option2_<?php echo esc_attr( $mpid ); ?>');"><?php esc_html_e( 'Option 2', 'multiprice' ); ?></a></th>
				<td><select name="wcex_multiprice_option2_<?php echo esc_attr( $mpid ); ?>" id="wcex_multiprice_option2_<?php echo esc_attr( $mpid ); ?>" class="wcex_multiprice_option2">
						<option value="#NONE#"></option>
					<?php foreach ( $options as $key => $option ) : ?>
						<?php $selected = ( $option2 == $option['key'] ) ? ' selected' : ''; ?>
						<option value="<?php echo esc_attr( $option['key'] ); ?>"<?php echo esc_html( $selected ); ?>><?php echo esc_html( $option['key'] ); ?></option>
					<?php endforeach; ?>
					</select>
				</td>
				<td><div id="ex_option2_<?php echo esc_attr( $mpid ); ?>" class="explanation"><?php esc_html_e( 'Select the second item option.', 'multiprice' ); ?><br /><?php esc_html_e( 'Please note that if you uncheck "Add condition", variable value of option 2 will be cleared.', 'multiprice' ); ?></div></td>
			</tr>
		</table>
		<table class="wcex_multiprice_item">
			<tr height="30">
				<th><a style="cursor:pointer;" onclick="toggleVisibility('ex_price_<?php echo esc_attr( $mpid ); ?>');"><?php esc_html_e( 'Price fluctuation value', 'multiprice' ); ?></a></th>
				<td><div id="ex_price_<?php echo esc_attr( $mpid ); ?>" class="explanation"><?php esc_html_e( 'Enter the amount to be increased or decreased relative to the price set in the item registration. You can only enter numbers, if you want cheaper, add - (minus).', 'multiprice' ); ?></div></td>
			</tr>
		</table>
		<table class="wcex_multiprice_item">
			<tr>
				<td>
					<div id="wcex_multiprice_<?php echo esc_attr( $mpid ); ?>">
					<?php if ( 2 === $means2 ) : ?>
						<input type="button" id="wcex_multiprice_addcol_<?php echo esc_attr( $mpid ); ?>" class="button button_multiprice" value="<?php esc_attr_e( 'Add column', 'multiprice' ); ?>"><input type="button" id="wcex_multiprice_delcol_<?php echo esc_attr( $mpid ); ?>" class="button button_multiprice" value="<?php esc_attr_e( 'Delete column', 'multiprice' ); ?>"><span class="wcex_multiprice_title"><?php esc_html_e( 'Column : ', 'multiprice' ); ?><?php echo esc_html( $option2 ); ?></span>
					<?php endif; ?>
						<table id="wcex_multiprice_table_<?php echo esc_attr( $mpid ); ?>" class="wcex_multiprice_table">
							<tbody>
					<?php
					/* [Option1]:Single-select or Radio-button */
					if ( in_array( $means1, array( 0, 3 ) ) ) :

						/* [Option2]:Single-select or Radio-button */
						if ( in_array( $means2, array( 0, 3 ) ) ) :
							$selects1 = explode( "\n", $value1 );
							$selects2 = explode( "\n", $value2 );
							?>
								<tr>
									<th class="mltp_th"></th>
							<?php
							$i = 0;
							foreach ( $selects2 as $v2 ) :
								?>
									<th class="mltp_th"><span id="<?php echo esc_attr( $mpid ); ?>_key2_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $v2 ); ?></span></th>
								<?php
								$i++;
							endforeach;
							?>
								</tr>
							<?php
							$i = 0;
							foreach ( $selects1 as $v1 ) :
								?>
								<tr>
									<th class="mltp_th" nowrap><span id="<?php echo esc_attr( $mpid ); ?>_key1_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $v1 ); ?></span></th>
								<?php
								$j = 0;
								foreach ( $selects2 as $v2 ) :
									$val = ( isset( $price[ $v1 ][ $v2 ] ) ) ? $price[ $v1 ][ $v2 ] : '';
									?>
									<td><input type="text" name="<?php echo esc_attr( $mpid ); ?>_val[<?php echo esc_attr( $i ); ?>][<?php echo esc_attr( $j ); ?>]" class="wcex_multiprice_val" value="<?php echo esc_attr( $val ); ?>"></td>
									<?php
									$j++;
								endforeach;
								?>
								</tr>
								<?php
								$i++;
							endforeach;

						/* [Option2]:Text */
						elseif ( 2 == $means2 ) :
							?>
								<tr>
									<th class="mltp_th"></th>
							<?php
							$y_from = 0;
							$i      = 0;
							foreach ( (array) $price as $x_key => $x_val ) :
								foreach ( $x_val as $y_key => $y_val ) :
									$y_key_value = wcex_multiprice_set_key_value( $y_key, 'return' );
									?>
									<th class="mltp_th"><span id="<?php echo esc_attr( $mpid ); ?>_addy_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $y_from ); ?><?php esc_html_e( ' - ', 'multiprice' ); ?></span><input type="text" name="<?php echo esc_attr( $mpid ); ?>_key2[<?php echo esc_attr( $i ); ?>]" class="wcex_multiprice_key2" value="<?php echo esc_attr( $y_key_value ); ?>"></th>
									<?php
									$y_from = (int) $y_key + 1;
									$i++;
								endforeach;
								break;
							endforeach;
							?>
								</tr>
							<?php
							$i        = 0;
							$selects1 = explode( "\n", $value1 );
							foreach ( $selects1 as $v1 ) :
								?>
								<tr>
									<th class="mltp_th" nowrap><span id="<?php echo esc_attr( $mpid ); ?>_key1_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $v1 ); ?></span></th>
								<?php
								$j = 0;
								foreach ( (array) $price[ $v1 ] as $y_key => $y_val ) :
									?>
									<td><input type="text" name="<?php echo esc_attr( $mpid ); ?>_val[<?php echo esc_attr( $i ); ?>][<?php echo esc_attr( $j ); ?>]" class="wcex_multiprice_val" value="<?php echo esc_attr( $price[ $v1 ][ $y_key ] ); ?>"></td>
									<?php
									$j++;
								endforeach;
								?>
								</tr>
								<?php
								$i++;
							endforeach;

						/* [Option1]:Single-select or Radio-button */
						else :
							$i        = 0;
							$selects1 = explode( "\n", $value1 );
							foreach ( $selects1 as $v1 ) :
								$val = ( isset( $price[ $v1 ] ) ) ? $price[ $v1 ] : '';
								?>
								<tr>
									<th class="mltp_th" nowrap><span id="<?php echo esc_attr( $mpid ); ?>_key1_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $v1 ); ?></span></th>
									<td><input type="text" name="<?php echo esc_attr( $mpid ); ?>_val[<?php echo esc_attr( $i ); ?>][0]" class="wcex_multiprice_val" value="<?php echo esc_attr( $val ); ?>"></td>
								</tr>
								<?php
								$i++;
							endforeach;
						endif;

					/* [Option1]:Text */
					elseif ( 2 == $means1 ) :

						/* [Option2]:Single-select or Radio-button */
						if ( in_array( $means2, array( 0, 3 ) ) ) :
							$selects2 = explode( "\n", $value2 );
							?>
								<tr>
									<th class="mltp_th"></th>
							<?php
							$i = 0;
							foreach ( $selects2 as $v2 ) :
								?>
									<th class="mltp_th"><span id="<?php echo esc_attr( $mpid ); ?>_key2_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $v2 ); ?></span></th>
								<?php
								$i++;
							endforeach;
							?>
								</tr>
							<?php
							$x_from = 0;
							$i      = 0;
							foreach ( (array) $price as $x_key => $x_val ) :
								$x_key_value = wcex_multiprice_set_key_value( $x_key, 'return' );
								?>
								<tr>
									<th class="mltp_th"><span id="<?php echo esc_attr( $mpid ); ?>_addx_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $x_from ); ?><?php esc_html_e( ' - ', 'multiprice' ); ?></span><input type="text" name="<?php echo esc_attr( $mpid ); ?>_key1[<?php echo esc_attr( $i ); ?>]" class="wcex_multiprice_key1" value="<?php echo esc_attr( $x_key_value ); ?>"></th>
								<?php
								$j = 0;
								foreach ( (array) $price[ $x_key ] as $y_key => $y_val ) :
									?>
									<td><input type="text" name="<?php echo esc_attr( $mpid ); ?>_val[<?php echo esc_attr( $i ); ?>][<?php echo esc_attr( $j ); ?>]" class="wcex_multiprice_val" value="<?php echo esc_attr( $price[ $x_key ][ $y_key ] ); ?>"></td>
									<?php
									$j++;
								endforeach;
								?>
								</tr>
								<?php
								$x_from = (int) $x_key + 1;
								$i++;
							endforeach;

						/* [Option2]:Text */
						elseif ( 2 == $means2 ) :
							?>
								<tr>
									<th class="mltp_th"></th>
							<?php
							$y_from = 0;
							$i      = 0;
							foreach ( (array) $price as $x_key => $x_val ) :
								foreach ( $x_val as $y_key => $y_val ) :
									$y_key_value = wcex_multiprice_set_key_value( $y_key, 'return' );
									?>
									<th class="mltp_th"><span id="<?php echo esc_attr( $mpid ); ?>_addy_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $y_from ); ?><?php esc_html_e( ' - ', 'multiprice' ); ?></span><input type="text" name="<?php echo esc_attr( $mpid ); ?>_key2[<?php echo esc_attr( $i ); ?>]" class="wcex_multiprice_key2" value="<?php echo esc_attr( $y_key_value ); ?>"></th>
									<?php
									$y_from = (int) $y_key + 1;
									$i++;
								endforeach;
								break;
							endforeach;
							?>
								</tr>
							<?php
							$x_from = 0;
							$i      = 0;
							foreach ( (array) $price as $x_key => $x_val ) :
								$x_key_value = wcex_multiprice_set_key_value( $x_key, 'return' );
								?>
								<tr>
									<th class="mltp_th"><span id="<?php echo esc_attr( $mpid ); ?>_addx_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $x_from ); ?><?php esc_html_e( ' - ', 'multiprice' ); ?></span><input type="text" name="<?php echo esc_attr( $mpid ); ?>_key1[<?php echo esc_attr( $i ); ?>]" class="wcex_multiprice_key1" value="<?php echo esc_attr( $x_key_value ); ?>"></th>
								<?php
								$j = 0;
								foreach ( (array) $price[ $x_key ] as $y_key => $y_val ) :
									?>
									<td><input type="text" name="<?php echo esc_attr( $mpid ); ?>_val[<?php echo esc_attr( $i ); ?>][<?php echo esc_attr( $j ); ?>]" class="wcex_multiprice_val" value="<?php echo esc_attr( $price[ $x_key ][ $y_key ] ); ?>"></td>
									<?php
									$j++;
								endforeach;
								?>
								</tr>
								<?php
								$x_from = (int) $x_key + 1;
								$i++;
							endforeach;

						/* [Option1]:Text Only. */
						else :
							$x_from = 0;
							$i      = 0;
							foreach ( (array) $price as $x_key => $x_val ) :
								$x_key_value = wcex_multiprice_set_key_value( $x_key, 'return' );
								?>
								<tr>
									<th class="mltp_th"><span id="<?php echo esc_attr( $mpid ); ?>_addx_<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $x_from ); ?><?php esc_html_e( ' - ', 'multiprice' ); ?></span><input type="text" name="<?php echo esc_attr( $mpid ); ?>_key1[<?php echo esc_attr( $i ); ?>]" class="wcex_multiprice_key1" value="<?php echo esc_attr( $x_key_value ); ?>"></th>
									<td><input type="text" name="<?php echo esc_attr( $mpid ); ?>_val[<?php echo esc_attr( $i ); ?>][0]" class="wcex_multiprice_val" value="<?php echo esc_attr( $price[ $x_key ] ); ?>"></td>
								</tr>
								<?php
								$x_from = (int) $x_key + 1;
								$i++;
							endforeach;
						endif;
					endif;
					?>
							</tbody>
						</table>
					<?php if ( 2 == $means1 ) : ?>
						<input type="button" id="wcex_multiprice_addrow_<?php echo esc_attr( $mpid ); ?>" class="button button_multiprice" value="<?php esc_attr_e( 'Add row', 'multiprice' ); ?>"><input type="button" id="wcex_multiprice_delrow_<?php echo esc_attr( $mpid ); ?>" class="button button_multiprice" value="<?php esc_attr_e( 'Delete row', 'multiprice' ); ?>"><span class="wcex_multiprice_title"><?php esc_html_e( 'Row : ', 'multiprice' ); ?><?php echo esc_html( $option1 ); ?></span>
					<?php endif; ?>
					</div>
				</td>
			</tr>
		</table>
		<div class="wcex_multiprice_button_box_bottom">
			<input type="submit" name="wcex_multiprice_update[<?php echo esc_attr( $mpid ); ?>]" class="button" value="<?php echo sprintf( __( 'Update %s', 'multiprice' ), esc_attr( $rule_names[ $mpid ] ) ); ?>" />
			<input type="submit" name="wcex_multiprice_delete[<?php echo esc_attr( $mpid ); ?>]" class="button" value="<?php echo sprintf( __( 'Delete %s', 'multiprice' ), esc_attr( $rule_names[ $mpid ] ) ); ?>" style="color:#F00;" />
			<input type="submit" name="wcex_multiprice_cancel[<?php echo esc_attr( $mpid ); ?>]" class="button" value="<?php esc_attr_e( 'Cancel', 'multiprice' ); ?>" />
		</div>
		<?php wp_nonce_field( 'wcex_multiprice', 'wc_nonce' ); ?>
		</form>
	</div><!--inside-->
	</div><!--postbox-->
	</div>
		<?php
	endforeach;
endif;
?>
</div><!--poststuff-->
</div><!--#wcex_multiprice_tabs-->
<div class="wcex_multiprice_exp">
	<p><strong><?php esc_html_e( 'Caution', 'multiprice' ); ?></strong></p>
	<p>
		<?php esc_html_e( '* When using "WCEX Multi Price", make the setting in the procedure of "Common option registration" &raquo; "Multiprice setting" &raquo; "Item registration - Item option setting".', 'multiprice' ); ?><br>
		<?php esc_html_e( '* "WCEX WCEX Multi Price" can be set for multiple price fluctuation rules. If you create a price for the same rule, the first price will be applied.', 'multiprice' ); ?><br>
		<?php esc_html_e( '* "WCEX WCEX Multi Price" will set price increase / decrease based on common option settings. Therefore, the name and value of the item option must always be the same as the common option.', 'multiprice' ); ?><br>
	</p>
</div>
</div><!--usces_admin-->
</div><!--wrap-->
