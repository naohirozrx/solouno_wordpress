<?php
/**
 * Operation logs extensions.
 * Enable/Disable the operation log metabox on:
 * - The editing order screen
 * - The editing member screen
 *
 * @package  Welcart
 * @author   Collne Inc.
 */

/**
 * OPERATION_LOG class
 */
class OPERATION_LOG {
	/**
	 * Extended Options.
	 *
	 * @var object
	 */
	public static $opts;

	/**
	 * Construct.
	 */
	public function __construct() {

		self::initialize_data();

		if ( is_admin() ) {
			add_action( 'usces_action_admin_system_extentions', array( $this, 'setting_form' ) );
			add_action( 'init', array( $this, 'save_data' ) );
		}
	}

	/**
	 * Handle init data.
	 */
	public function initialize_data() {
		$options                                      = get_option( 'usces_ex' );
		$options['system']['operation_log']['status'] = isset( $options['system']['operation_log']['status'] ) ? (int) $options['system']['operation_log']['status'] : 1;
		$options['system']['operation_log']['order_status']  = isset( $options['system']['operation_log']['order_status'] ) ? (int) $options['system']['operation_log']['order_status'] : 1;
		$options['system']['operation_log']['member_status'] = isset( $options['system']['operation_log']['member_status'] ) ? (int) $options['system']['operation_log']['member_status'] : 1;

		update_option( 'usces_ex', $options );
		self::$opts = $options['system']['operation_log'];
	}

	/**
	 * Check if the operation log is enabled or not.
	 *
	 * @return boolean true/false
	 */
	public static function is_enabled() {
		return 1 === self::$opts['status'];
	}

	/**
	 * Check if the operation log is enabled or not.
	 *
	 * @return boolean true/false
	 */
	public static function is_disabled() {
		return 0 === self::$opts['status'];
	}

	/**
	 * Check if the order metabox is enabled or not.
	 *
	 * @return boolean true/false
	 */
	public static function is_order_metabox_enabled() {
		return self::is_enabled() && 1 === self::$opts['order_status'];
	}

	/**
	 * Check if the member metabox is enabled or not.
	 *
	 * @return boolean true/false
	 */
	public static function is_member_metabox_enabled() {
		return self::is_enabled() && 1 === self::$opts['member_status'];
	}

	/**
	 * Handle save data.
	 */
	public function save_data() {
		global $usces;

		$action = filter_input( INPUT_POST, 'usces_operation_log_option_update' );
		if ( ! empty( $action ) ) {
			check_admin_referer( 'admin_system', 'wc_nonce' );

			$status        = filter_input( INPUT_POST, 'operation_log_status' );
			$order_status  = filter_input( INPUT_POST, 'order_operation_log_status' );
			$member_status = filter_input( INPUT_POST, 'member_operation_log_status' );

			self::$opts['status'] = (int) $status;
			if ( self::is_disabled() ) {
				$order_status  = 0;
				$member_status = 0;
			}
			self::$opts['order_status']  = (int) $order_status;
			self::$opts['member_status'] = (int) $member_status;

			$options                            = get_option( 'usces_ex' );
			$options['system']['operation_log'] = self::$opts;
			update_option( 'usces_ex', $options );
		}
	}

	/**
	 * Handel build setting from.
	 */
	public function setting_form() {
		$status        = self::$opts['status'];
		$order_status  = self::$opts['order_status'];
		$member_status = self::$opts['member_status'];
		?>
		<form action="" method="post" name="option_form" id="operation_log_form">
			<div class="postbox">
				<div class="postbox-header">
					<h2>
						<span><?php esc_attr_e( 'Operation Log', 'usces' ); ?></span>
						<?php if ( self::$opts['status'] ) { ?>
							<span class="running"><?php esc_attr_e( 'Running', 'usces' ); ?></span>
						<?php } else { ?>
							<span class="stopped"><?php esc_attr_e( 'Stopped', 'usces' ); ?></span>
						<?php } ?>
					</h2>
					<div class="handle-actions">
						<button type="button" class="handlediv" id="operation_log">
							<span class="screen-reader-text">
								<?php
								// translators: %s: Toggle panel name.
								sprintf( esc_html__( 'Toggle panel: %s' ), esc_html__( 'Operation Log', 'usces' ) );
								?>
							</span>
							<span class="toggle-indicator"></span>
						</button>
					</div>
				</div>
				<div class="inside">
					<table class="form_table">
						<tr height="35">
							<th class="system_th"><a style="cursor:pointer;" onclick="toggleVisibility('ex_operation_log_status');"><?php esc_attr_e( 'Operation Log', 'usces' ); ?></a></th>
							<td width="10">
								<input name="operation_log_status" id="operation_log_status0" type="radio" value="0" <?php checked( '0', $status ); ?>/>
							</td>
							<td width="100"><label for="operation_log_status0"><?php esc_attr_e( 'disable', 'usces' ); ?></label></td>
							<td width="10">
								<input name="operation_log_status" id="operation_log_status1" type="radio" value="1" <?php checked( '1', $status ); ?> />
							</td><td width="100"><label for="operation_log_status1"><?php esc_attr_e( 'enable', 'usces' ); ?></label></td>
							<td><div id="ex_operation_log_status" class="explanation"><?php esc_attr_e( 'Control enable or disable the operation log.', 'usces' ); ?><?php esc_attr_e( 'Select "Disable" if you wish to stop the operation log.', 'usces' ); ?></div></td>
						</tr>
						<tr height="35" class="metabox_operation_log_status" style="display:none;">
							<th class="system_th"><a style="cursor:pointer;" onclick="toggleVisibility('ex_order_operation_log_status');"><?php esc_attr_e( 'Order Operation Log', 'usces' ); ?></a></th>
							<td width="10">
								<input name="order_operation_log_status" id="order_operation_log_status0" type="radio" value="0" <?php checked( '0', $order_status ); ?>/>
							</td>
							<td width="100"><label for="order_operation_log_status0"><?php esc_attr_e( 'disable', 'usces' ); ?></label></td>
							<td width="10">
								<input name="order_operation_log_status" id="order_operation_log_status1" type="radio" value="1" <?php checked( '1', $order_status ); ?> />
							</td><td width="100"><label for="order_operation_log_status1"><?php esc_attr_e( 'enable', 'usces' ); ?></label></td>
							<td><div id="ex_order_operation_log_status" class="explanation"><?php esc_attr_e( 'Control enable or disable the display of the order operation log.', 'usces' ); ?><?php esc_attr_e( 'Select "Disable" if you wish to stop the display of the order operation log.', 'usces' ); ?></div></td>
						</tr>
						<tr height="35" class="metabox_operation_log_status" style="display:none;">
							<th class="system_th"><a style="cursor:pointer;" onclick="toggleVisibility('ex_member_operation_log_status');"><?php esc_attr_e( 'Member Operation Log', 'usces' ); ?></a></th>
							<td width="10">
								<input name="member_operation_log_status" id="member_operation_log_status0" type="radio" value="0" <?php checked( '0', $member_status ); ?>/>
							</td>
							<td width="100"><label for="member_operation_log_status0"><?php esc_attr_e( 'disable', 'usces' ); ?></label></td>
							<td width="10">
								<input name="member_operation_log_status" id="member_operation_log_status1" type="radio" value="1" <?php checked( '1', $member_status ); ?> />
							</td><td width="100"><label for="member_operation_log_status1"><?php esc_attr_e( 'enable', 'usces' ); ?></label></td>
							<td><div id="ex_member_operation_log_status" class="explanation"><?php esc_attr_e( 'Control enable or disable the display of the member operation log.', 'usces' ); ?><?php esc_attr_e( 'Select "Disable" if you wish to stop the display of the member operation log.', 'usces' ); ?></div></td>
						</tr>
					</table>
					<hr />
					<input name="usces_operation_log_option_update" type="submit" class="button button-primary" value="<?php esc_attr_e( 'change decision', 'usces' ); ?>" />
					<script type="text/javascript">
						(function ($) {
							const operationLog = {
								statusRadioEles: $('input[type=radio][name=operation_log_status]'),
								subSettingEles: $('tr.metabox_operation_log_status'),
								start: function () {
									this.onClickStatusRadio();
									this.onReady();
								},
								onClickStatusRadio: function () {
									const _self = this;
									_self.statusRadioEles.on('click', function () {
										const isEnabled = '1' === this.value;
										if (isEnabled) {
											_self.subSettingEles.fadeIn();
										} else {
											_self.subSettingEles.fadeOut();
										}
									});
								},
								onReady: function () {
									const checkedRadioStatusEle = $(
										'input[type=radio][name=operation_log_status]:checked'
									);
									checkedRadioStatusEle.trigger('click');
								},
							};

							operationLog.start();
						})(jQuery);
					</script>
				</div>
			</div><!--postbox-->
			<?php wp_nonce_field( 'admin_system', 'wc_nonce' ); ?>
		</form>
		<?php
	}
}
