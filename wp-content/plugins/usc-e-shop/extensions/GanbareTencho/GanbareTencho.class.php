<?php
/*
System extentions Ganbare Tencho 
Version: 1.0.0
Author: Collne Inc.
*/

class USCES_GANBARE_TENCHO
{
	public static $opts;

	public function __construct(){
	
		self::initialize_data();
	
		if( is_admin() ){
		
			add_action( 'usces_action_admin_system_extentions', array( $this, 'setting_form') );
			add_action( 'init', array( $this, 'save_data') );

			if( self::$opts['activate_flag'] ){
				add_action( 'usces_action_order_list_page', array( $this, 'output_csv') );
				add_action( 'usces_action_order_list_searchbox_bottom', array( $this, 'action_button') );
				add_filter( 'usces_filter_order_list_page_js', array( $this, 'add_js') );
			}
		}
	}

	/**********************************************
	* Initialize
	* Modified:2 Nov.2015
	***********************************************/
	public function initialize_data(){
		global $usces;
		$options = get_option('usces_ex');
		$options['system']['ganbare']['activate_flag'] = !isset($options['system']['ganbare']['activate_flag']) ? 0 : (int)$options['system']['ganbare']['activate_flag'];
		update_option( 'usces_ex', $options );
		self::$opts = $options['system']['ganbare'];
	}

	/**********************************************
	* save ganbare tencho option data
	* Modified:10 Oct.2015
	***********************************************/
	public function save_data(){
		global $usces;
		if(isset($_POST['usces_ganbare_option_update'])) {

			check_admin_referer( 'admin_system', 'wc_nonce' );

			self::$opts['activate_flag'] = isset($_POST['ganbare_activate_flag']) ? (int)$_POST['ganbare_activate_flag'] : 0;

			$options = get_option('usces_ex');
			$options['system']['ganbare'] = self::$opts;
			update_option('usces_ex', $options);
		}
	}	
	/**********************************************
	* setting_form
	* Modified:10 Oct.2015
	***********************************************/
	public function setting_form(){
		$status =  self::$opts['activate_flag'] ? '<span class="running">' . __('Running', 'usces') . '</span>' : '<span class="stopped">' . __('Stopped', 'usces') . '</span>';
?>
	<form action="" method="post" name="option_form" id="ganbare_form">
	<div class="postbox">
		<div class="postbox-header">
			<h2><span><?php _e('Ganbare Tencho','usces'); ?></span><?php echo $status; ?></h2>
			<div class="handle-actions"><button type="button" class="handlediv" id="ganbare"><span class="screen-reader-text"><?php echo esc_html( sprintf( __( 'Toggle panel: %s' ), __( 'Ganbare Tencho', 'usces' ) ) ); ?></span><span class="toggle-indicator"></span></button></div>
		</div>
		<div class="inside">
		<table class="form_table">
			<tr height="35">
			    <th class="system_th"><a style="cursor:pointer;" onclick="toggleVisibility('ex_ganbare_activate_flag');"><?php _e('Activation', 'usces'); ?></a></th>
			    <td width="10"><input name="ganbare_activate_flag" id="ganbare_activate_flag0" type="radio" value="0"<?php if(self::$opts['activate_flag'] === 0) echo 'checked="checked"'; ?> /></td><td width="100"><label for="ganbare_activate_flag0"><?php _e('disable', 'usces'); ?></label></td>
			    <td width="10"><input name="ganbare_activate_flag" id="ganbare_activate_flag1" type="radio" value="1"<?php if(self::$opts['activate_flag'] === 1) echo 'checked="checked"'; ?> /></td><td width="100"><label for="ganbare_activate_flag1"><?php _e('enable', 'usces'); ?></label></td>
				<td><div id="ex_ganbare_activate_flag" class="explanation"><?php _e("Activation the Ganbare-Tencho function.<br>It also can be used as data for the Tempo-Up.", 'usces'); ?></div></td>
			</tr>
		</table>
		<hr />
		<input name="usces_ganbare_option_update" type="submit" class="button button-primary" value="<?php _e('change decision','usces'); ?>" />
		</div>
	</div><!--postbox-->
	<?php wp_nonce_field( 'admin_system', 'wc_nonce' ); ?>
	</form>
<?php
	}

	/*************************************
	 * outpu CSV
	 * Modified:10 Oct.2015
	 ************************************/
	public function output_csv( $order_action ) {
		if( 'ganbare_tencho_csv' == $order_action && check_admin_referer('csv-nonce', 'nonce') ){
			$this->outcsv_shipping();
		}
	}

	public function action_button() {
		echo '
		<input type="button" id="dl_ganbare_tencho_csv" class="searchbutton button" value="' . __('Ganbare Tencho data output', 'usces') . '" />
		';
	}

	public function add_js( $html ) {
		$html .= '
		$("#dl_ganbare_tencho_csv").click(function() {
			if( $("input[name*=\'listcheck\']:checked").length == 0 ) {
				alert("'.__('Choose the data.', 'usces').'");
				$("#oederlistaction").val("");
				return false;
			}
			var listcheck = "";
			$("input[name*=\'listcheck\']").each(function(i) {
				if( $(this).prop("checked") ) {
					listcheck += "&listcheck["+i+"]="+$(this).val();
				}
			});
			location.href = "'.USCES_ADMIN_URL.'?page=usces_orderlist&order_action=ganbare_tencho_csv"+listcheck+"&noheader=true&nonce=' . wp_create_nonce('csv-nonce') . '";
		});
		';
		//echo $html;
		return $html;
	}

	public function outcsv_shipping() {
		global $usces;

		$filename = "ganbare".date('YmdHis', current_time('timestamp')).".csv";
		$ids = $_GET['listcheck'];

		$line = '';
		$ldata = array(
			'????????????'				=> '', 
			'????????????????????????'		=> '', 
			'????????????'				=> '', 
			'?????????'				=> '', 
			'???????????????'			=> '', 
			'SKU???'					=> '', 
			'SKU?????????'				=> '', 
			'??????'					=> '', 
			'??????'					=> '', 
			'???????????????'			=> '', 
			'???????????????'			=> '', 
			'???????????????????????????'	=> '', 
			'???????????????????????????'	=> '', 
			'?????????????????????'		=> '', 
			'?????????????????????'		=> '', 
			'??????????????????????????????'	=> '', 
			'??????????????????????????????'	=> '', 
			'????????????????????????'		=> '', 
			'???????????????????????????'	=> '', 
			'?????????????????????'		=> '', 
			'?????????FAX??????'			=> '', 
			'???????????????'			=> '', 
			'???????????????'			=> '', 
			'???????????????????????????'	=> '', 
			'???????????????????????????'	=> '', 
			'?????????????????????'		=> '', 
			'??????????????????????????????'	=> '', 
			'??????????????????????????????'	=> '', 
			'????????????????????????'		=> '', 
			'???????????????????????????'	=> '', 
			'?????????????????????'		=> '', 
			'????????????'				=> '', 
			'????????????'				=> '', 
			'??????'					=> '', 
			'??????????????????'			=> '', 
			'?????????????????????'		=> '', 
			'???????????????'			=> '', 
			'??????????????????'			=> '', 
			'????????????'				=> '', 
			'??????'					=> '', 
			'?????????'				=> '', 
			'?????????'				=> '', 
			'?????????'				=> '', 
			'?????????????????????'		=> '', 
			'????????????'				=> '', 
			'???????????????'			=> '', 
			'???????????????'			=> '', 
		);
		$ldata = apply_filters( 'usces_filter_ganbare_tencho_column', $ldata );
		foreach( $ldata as $lkey => $lvalue ){
			$line .= '"'.$lkey.'",';
		}
		$line = trim( $line, ',' );
		$line .= "\r\n";


		foreach( (array)$ids as $order_id ) {
		
			$data = $usces->get_order_data( $order_id, 'direct' );
			$delivery = unserialize($data['order_delivery']);
			$cart = usces_get_ordercartdata($order_id);
			if( isset( $delivery['delivery_flag'] ) && 2 == $delivery['delivery_flag'] && !empty($data['mem_id']) && function_exists('msa_get_orderdestination') ){
				$orderdestination = msa_get_orderdestination( $order_id );
			}else{
				$orderdestination = array();
			}

			$deco_order_id = usces_get_deco_order_id( $order_id );

			if( !empty($data['order_delivery_date']) and $this->isdate($data['order_delivery_date']) ) {
				$arrivaldate = $data['order_delivery_date'];
			} else {
				$arrivaldate = "";
			}
			if( !empty($data['order_delivery_time']) ) {
				$arrivaltime = $data['order_delivery_time'];
			} else {
				$arrivaltime = "";
			}

			$order_date = date('Ymd', strtotime($data['order_date']));
			$total_full_price = $data['order_item_total_price'] - $data['order_usedpoint'] + $data['order_discount'] + $data['order_shipping_charge'] + $data['order_cod_fee'] + $data['order_tax'];
			if( $total_full_price < 0 ) $total_full_price = 0;
			$payments = usces_get_payments_by_name($data['order_payment_name']);
			$delivery_method_name = usces_delivery_method_name( $data['order_delivery_method'], 'return' );
			$order_memo = $usces->get_order_meta_value('order_memo', $order_id);
			$delivery_company = $usces->get_order_meta_value('delivery_company', $order_id);
			$tracking_number = $usces->get_order_meta_value( apply_filters( 'usces_filter_tracking_meta_key', 'tracking_number'), $order_id);
			$order_condition = unserialize($data['order_condition']);
			$tax_div = ( 'include' == $order_condition['tax_mode'] ) ? '??????' : '??????';

			$cart_count = ( $cart && is_array( $cart ) ) ? count( $cart ) : 0;
			for($i = 0; $i < $cart_count; $i++) {
				$cart_row = $cart[$i];
				$group_id = $cart_row['group_id'];
				if( isset( $delivery['delivery_flag'] ) && 2 == $delivery['delivery_flag'] && !empty($data['mem_id']) && isset($orderdestination[$group_id]) && function_exists('msa_get_destination') ){
					$destination_info = msa_get_destination( $data['mem_id'], $orderdestination[$group_id]['destination_id'] );
				}else{
					$destination_info = array();
				}
				
				$ldata['????????????'] = $deco_order_id;
				$ldata['????????????????????????'] = $i+1;
				$ldata['????????????'] = $data['order_date'];
				$ldata['?????????'] = $cart_row['item_name'];
				$ldata['???????????????'] = $cart_row['item_code'];
				$ldata['SKU???'] = $cart_row['sku_name'];
				$ldata['SKU?????????'] = $cart_row['sku'];
				$ldata['??????'] = $cart_row['quantity'];
				$ldata['??????'] = usces_crform($cart_row['price'], false, false, 'return', false);
				$ldata['???????????????'] = $data['order_name1'];
				$ldata['???????????????'] = $data['order_name2'];
				$ldata['???????????????????????????'] = $data['order_name3'];
				$ldata['???????????????????????????'] = $data['order_name4'];
				$ldata['?????????????????????'] = $data['order_email'];
				$ldata['?????????????????????'] = $data['order_zip'];
				$ldata['??????????????????????????????'] = $data['order_pref'];
				$ldata['??????????????????????????????'] = $data['order_address1'];
				$ldata['????????????????????????'] = $data['order_address2'];
				$ldata['???????????????????????????'] = $data['order_address3'];
				$ldata['?????????????????????'] = $data['order_tel'];
				$ldata['?????????FAX??????'] = $data['order_fax'];
				
				if( !empty($destination_info) ){
					$ldata['???????????????'] = $destination_info['msa_name'];
					$ldata['???????????????'] = $destination_info['msa_name2'];
					$ldata['???????????????????????????'] = $destination_info['msa_furigana'];
					$ldata['???????????????????????????'] = $destination_info['msa_furigana2'];
					$ldata['?????????????????????'] = $destination_info['msa_zip'];
					$ldata['??????????????????????????????'] = $destination_info['msa_pref'];
					$ldata['??????????????????????????????'] = $destination_info['msa_address1'];
					$ldata['????????????????????????'] = $destination_info['msa_address2'];
					$ldata['???????????????????????????'] = $destination_info['msa_address3'];
					$ldata['?????????????????????'] = $destination_info['msa_tel'];
				}else{
					$ldata['???????????????'] = $delivery['name1'];
					$ldata['???????????????'] = $delivery['name2'];
					$ldata['???????????????????????????'] = isset( $delivery['name3'] ) ? $delivery['name3'] : '';
					$ldata['???????????????????????????'] = isset( $delivery['name4'] ) ? $delivery['name4'] : '';
					$ldata['?????????????????????'] = $delivery['zipcode'];
					$ldata['??????????????????????????????'] = $delivery['pref'];
					$ldata['??????????????????????????????'] = $delivery['address1'];
					$ldata['????????????????????????'] = $delivery['address2'];
					$ldata['???????????????????????????'] = $delivery['address3'];
					$ldata['?????????????????????'] = $delivery['tel'];
				}
				
				$ldata['????????????'] = $data['order_payment_name'];
				$ldata['????????????'] = $delivery_method_name;
				$ldata['??????'] = $data['order_note'];
				$ldata['??????????????????'] = $arrivaldate;
				$ldata['?????????????????????'] = $arrivaltime;
				$ldata['???????????????'] = $delivery_company;
				$ldata['??????????????????'] = $tracking_number;
				$ldata['????????????'] = usces_crform($data['order_item_total_price'], false, false, 'return', false);
				$ldata['??????'] = usces_crform($data['order_shipping_charge'], false, false, 'return', false);
				$ldata['?????????'] = usces_crform($data['order_tax'], false, false, 'return', false);
				$ldata['?????????'] = usces_crform($data['order_cod_fee'], false, false, 'return', false);
				$ldata['?????????'] = usces_crform($data['order_discount'], false, false, 'return', false);
				$ldata['?????????????????????'] = $data['order_usedpoint'];
				$ldata['????????????'] = usces_crform($total_full_price, false, false, 'return', false);
				$ldata['???????????????'] = $tax_div;
				$ldata['???????????????'] = $order_memo;

				$args = compact( 'cart_row', 'i', 'destination_info', 'data', 'delivery', 'cart', 'order_id' );
				$ldata = apply_filters( 'usces_filter_ganbare_tencho_data', $ldata, $args );
				
				foreach( $ldata as $lkey => $lvalue ){
					$line .= '"'.$lvalue.'",';
				}
				$line = trim( $line, ',' );
				$line .= "\r\n";
			}
		}
		ob_end_clean();
		$line = mb_convert_encoding( $line, "SJIS-win", "UTF-8" );
		header( "Content-Type: application/octet-stream" );
		header( "Content-Disposition: attachment; filename=\"$filename\"" );
		print( $line );
		exit();
	}

	public function isdate( $date ) {
		try {
			if( empty($date) ) return false;
			new DateTime( $date );
			return true;
		} catch( Exception $e ) {
			return false;
		}
	}

}

