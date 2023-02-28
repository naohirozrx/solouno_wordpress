<?php
/**
 * WCEX NEXT ENGINE class.
 *
 * @package WCEX NEXT ENGINE
 * @since 1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! defined( 'USCES_VERSION' ) ) {
	return;
}

/**
 * Main class.
 *
 * @since 1.0.1
 */
class WCEX_NextEngine {

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * WP_Error.
	 *
	 * @var object
	 */
	public $error = null;

	/**
	 * Location of field ne_code in csv
	 *
	 * @var int
	 */
	private $num_sku_ne_code = null;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->error = new WP_Error();

		/* Initialize the plugin. */
		add_action( 'after_setup_theme', array( $this, 'init' ) );

		/* Receive inventory update notification from NEXT ENGINE. */
		add_action( 'after_setup_theme', array( $this, 'update_stock' ), 1 );

		do_action( 'wcne_loaded' );
	}

	/**
	 * Return an instance of this class.
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Initial processing.
	 * after_setup_theme
	 */
	public function init() {

		require_once WCEX_NEXTENGINE_DIR . '/includes/functions.php';

		/* Initialize options. */
		$ne_option = get_option( 'usces_ne_setting', array() );
		if ( empty( $ne_option ) ) {
			$ne_option                      = array();
			$ne_option['order_address']     = '';
			$ne_option['store_account']     = '';
			$ne_option['store_key']         = '';
			$ne_option['api_upd']           = array();
			$ne_option['link_necd']         = 0; /* (Default) SKU code. */
			$ne_option['item_list_display'] = 0; /* (Default) SKU code. */
			$ne_option['order_number']      = 0;
			update_option( 'usces_ne_setting', $ne_option );
		}

		/* Checkout */
		add_action( 'usces_post_reg_orderdata', array( $this, 'send_nextengine_ordermail' ), 10, 2 );
		if ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
			add_action( 'wcad_action_reg_auto_orderdata', array( $this, 'send_nextengine_ordermail_regular' ), 20 );
		}

		/* Setting Page */
		add_action( 'wp_ajax_nextengine_get_log', array( $this, 'get_log' ) );
		add_action( 'wp_ajax_nextengine_delete_log', array( $this, 'delete_log' ) );
		add_action( 'admin_menu', array( $this, 'admin_submenu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'admin_print_footer_scripts', array( $this, 'admin_footer_scripts' ) );
		add_action( 'admin_footer', array( $this, 'clear_action_status' ) );

		/* Item List Page */
		if ( 0 !== (int) $ne_option['item_list_display'] ) {
			add_filter( 'usces_filter_itemlist_header', array( $this, 'itemlist_header' ) );
			add_filter( 'usces_filter_itemlist_skufield', array( $this, 'itemlist_skufield' ), 10, 2 );
		}
		if ( defined( 'USCES_VERSION' ) && version_compare( USCES_VERSION, '2.5.0', '<' ) ) {
			add_filter( 'usces_filter_dl_item_list_table', array( $this, 'csv_button' ) );
		} else {
			add_action( 'usces_action_dl_item_list_table', array( $this, 'csv_button' ) );
		}
		add_action( 'usces_action_item_master_page', array( $this, 'action_item_master_page' ) );
		add_action( 'usces_action_item_list_footer', array( $this, 'action_item_list_footer' ) );

		/* Item Edit Page */
		if ( 0 !== (int) $ne_option['link_necd'] ) {
			add_filter( 'usces_filter_sku_meta_form_advance_title', array( $this, 'sku_meta_form_advance_title' ), 20 );
			add_filter( 'usces_filter_sku_meta_form_advance_field', array( $this, 'sku_meta_form_advance_field' ), 20 );
			add_filter( 'usces_filter_sku_meta_row_advance', array( $this, 'sku_meta_row_advance' ), 20, 2 );
			add_filter( 'usces_filter_add_item_sku_meta_value', array( $this, 'add_item_sku_meta_value' ), 20 );
			add_filter( 'usces_filter_up_item_sku_meta_value', array( $this, 'up_item_sku_meta_value' ), 20 );
			add_filter( 'usces_filter_item_save_sku_metadata', array( $this, 'item_save_sku_metadata' ), 20, 2 );
		}

		/* Item CSV Download & Upload */
		if ( 0 !== (int) $ne_option['link_necd'] ) {
			if ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
				add_filter( 'wcad_filter_uploadcsv_min_field_num', array( $this, 'uploadcsv_min_field_num' ), 20 );
				add_filter( 'wcad_filter_uploadcsv_skuvalue', array( $this, 'uploadcsv_skuvalue' ), 20, 2 );
				add_filter( 'wcad_filter_downloadcsv_header', array( $this, 'downloadcsv_header' ), 20 );
				add_filter( 'wcad_filter_downloadcsv_skuvalue', array( $this, 'downloadcsv_skuvalue' ), 20, 2 );
				add_filter( 'wcad_filter_sku_uploadcsv_min_field_num', array( $this, 'uploadcsv_min_field_num' ), 20 );
				add_filter( 'wcad_filter_sku_uploadcsv_skuvalue', array( $this, 'uploadcsv_skuvalue' ), 20, 2 );
				add_filter( 'wcad_filter_downloadcsv_header_skulist', array( $this, 'downloadcsv_header' ), 20 );
				add_filter( 'wcad_filter_downloadcsv_skuvalue_skulist', array( $this, 'downloadcsv_skuvalue' ), 20, 2 );
			} else {
				add_filter( 'usces_filter_uploadcsv_min_field_num', array( $this, 'uploadcsv_min_field_num' ), 20 );
				add_filter( 'usces_filter_uploadcsv_skuvalue', array( $this, 'uploadcsv_skuvalue' ), 20, 2 );
				add_filter( 'usces_filter_downloadcsv_header', array( $this, 'downloadcsv_header' ), 20 );
				add_filter( 'usces_filter_downloadcsv_skuvalue', array( $this, 'downloadcsv_skuvalue' ), 20, 2 );
				add_filter( 'usces_filter_sku_uploadcsv_min_field_num', array( $this, 'uploadcsv_min_field_num' ), 20 );
				add_filter( 'usces_filter_sku_uploadcsv_skuvalue', array( $this, 'uploadcsv_skuvalue' ), 20, 2 );
				add_filter( 'usces_filter_downloadcsv_header_skulist', array( $this, 'downloadcsv_header' ), 20 );
				add_filter( 'usces_filter_downloadcsv_skuvalue_skulist', array( $this, 'downloadcsv_skuvalue' ), 20, 2 );
			}
		}

		/* Order List Page */
		add_action( 'usces_action_order_list_searchbox_bottom', array( $this, 'order_list_action_button' ) );
		add_filter( 'usces_filter_order_list_page_js', array( $this, 'order_list_page_js' ) );
		add_action( 'usces_action_order_list_page', array( $this, 'order_list_page_action' ) );

		/* Order Edit Page */
		add_filter( 'usces_filter_admin_ordernavi', array( $this, 'admin_ordernavi' ), 20, 2 );
		add_action( 'usces_action_order_edit_page_js', array( $this, 'admin_order_edit_page_js' ), 10, 2 );
		add_filter( 'usces_filter_order_item_ajax', array( $this, 'admin_order_item_ajax' ) );
	}

	/**
	 * Update notification from NEXT ENGINE.
	 * after_setup_theme
	 *
	 * @since 1.0.1
	 */
	public function update_stock() {
		if ( is_admin() ) {
			return;
		}

		global $wpdb, $usces;

		if ( isset( $_GET['StoreAccount'] ) && isset( $_GET['Code'] ) && isset( $_GET['Stock'] ) ) {
			$ne_option = get_option( 'usces_ne_setting', array() );
			if ( isset( $ne_option['api_upd'] ) && in_array( 'stock', $ne_option['api_upd'] ) && isset( $ne_option['store_account'] ) && filter_input( INPUT_GET, 'StoreAccount' ) === $ne_option['store_account'] && isset( $ne_option['store_key'] ) ) {
				$request_data = wp_unslash( $_GET );
				unset( $request_data['StoreAccount'] );
				unset( $request_data['ts'] );
				unset( $request_data['_sig'] );
				$this->save_log( http_build_query( $request_data ), 'request' );
				if ( isset( $ne_option['item_post_status'] ) ) {
					$post_status = implode( "','", $ne_option['item_post_status'] );
				} else {
					$post_status = 'publish';
				}
				$code  = wp_unslash( $request_data['Code'] );
				$stock = wp_unslash( $request_data['Stock'] );

				if ( version_compare( USCES_VERSION, '2.7-beta', '>=' ) ) {
					if ( isset( $ne_option['link_necd'] ) && 1 === (int) $ne_option['link_necd'] ) {
						$regexp = '.*"ne_code";s:[0-9]+:"' . $code . '";.*';
						$query  = $wpdb->prepare( "SELECT skus.meta_id, skus.post_id FROM {$wpdb->prefix}usces_skus AS skus INNER JOIN $wpdb->posts AS p ON p.ID = skus.post_id WHERE skus.advance REGEXP %s AND p.post_status IN( %s )", $regexp, $post_status );
					} else {
						$query = $wpdb->prepare( "SELECT skus.meta_id, skus.post_id FROM {$wpdb->prefix}usces_skus AS skus INNER JOIN $wpdb->posts AS p ON p.ID = skus.post_id WHERE skus.code = %s AND p.post_status IN( %s )", $code, $post_status );
					}
					$query   = stripslashes( $query );
					$sku_row = $wpdb->get_row( $query, ARRAY_A );
					if ( $sku_row ) {
						$item_order_acceptable = $usces->getItemOrderAcceptable( $sku_row['post_id'] );
						if ( 1 !== (int) $item_order_acceptable ) {
							if ( 0 === (int) $stock ) {
								$stock_status = 0;
							} else {
								$stock_status = ( 0 === (int) $stock ) ? 2 : 0;
							}
							$query = $wpdb->prepare( "UPDATE {$wpdb->prefix}usces_skus SET `stocknum` = %s, `stock` = %d WHERE `meta_id` = %d", (int) $stock, $stock_status, $sku_row['meta_id'] );
						} else {
							$query = $wpdb->prepare( "UPDATE {$wpdb->prefix}usces_skus SET `stocknum` = %s WHERE `meta_id` = %d", (int) $stock, $sku_row['meta_id'] );
						}
						$res = $wpdb->query( $query );
						$log = 'Code[' . $code . '], Stock[' . $stock . '], Update[' . $res . ']';
						$this->save_log( $log, 'update' );
					}
				} else {
					$query = $wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE `meta_key` = %s", '_isku_' );
					$metas = $wpdb->get_results( $query, ARRAY_A );
					if ( $metas && is_array( $metas ) ) {
						foreach ( $metas as $meta ) {
							$sku     = unserialize( $meta['meta_value'] );
							$ne_code = urldecode( $sku['code'] );
							if ( isset( $ne_option['link_necd'] ) && 1 === (int) $ne_option['link_necd'] ) {
								$advance = ( isset( $sku['advance'] ) ) ? $sku['advance'] : '';
								if ( ! empty( $advance ) ) {
									$advance = maybe_unserialize( $advance );
									if ( isset( $advance['ne_code'] ) ) {
										$ne_code = $advance['ne_code'];
									}
								}
							}
							if ( $code == $ne_code ) {
								$meta_id = $meta['meta_id'];
								$query   = $wpdb->prepare(
									"SELECT p.ID FROM $wpdb->posts AS p INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id WHERE p.post_status IN( %s ) AND pm.meta_id = %d",
									$post_status,
									$meta_id
								);
								$query   = stripslashes( $query );
								$post_id = $wpdb->get_var( $query );
								if ( $post_id ) {
									$item_order_acceptable = $usces->getItemOrderAcceptable( $post_id );
									if ( 1 !== (int) $item_order_acceptable ) {
										$sku['stocknum'] = $stock;
										if ( 0 === (int) $stock ) {
											$sku['stock'] = 0;
										} else {
											$sku['stock'] = ( 0 === (int) $stock ) ? 2 : 0;
										}
									} else {
										$sku['stocknum'] = $stock;
									}
									$query = $wpdb->prepare( "UPDATE $wpdb->postmeta SET `meta_value` = %s WHERE `meta_id` = %d", serialize( $sku ), $meta_id );
									$res   = $wpdb->query( $query );
									$log   = 'Code[' . $code . '], Stock[' . $stock . '], Update[' . $res . ']';
									$this->save_log( $log, 'update' );
								}
								break;
							}
						}
					}
				}

				$ts  = wp_date( 'YmdHis' );
				$sig = md5( $ne_option['store_account'] . $code . $stock . $ts . $ne_option['store_key'] );
				$xml = '<?xml version="1.0" encoding="EUC-JP"?>
<ShoppingUpdateStock version="1.0">
<ResultSet TotalResult="1">
<Request>
<Argument Name="StoreAccount" Value="' . $ne_option['store_account'] . '" />
<Argument Name="Code" Value="' . $code . '" />
<Argument Name="Stock" Value="' . $stock . '" />
<Argument Name="ts" Value="' . $ts . '" />
<Argument Name=".sig" Value="' . $sig . '" />
</Request>
<Result No="1">
<Processed>0</Processed>
</Result>
</ResultSet>
</ShoppingUpdateStock>';
				@ob_end_clean();
				header( 'Content-type: text/xml; charset=EUC-JP' );
				die( $xml );
			}
		}
	}

	/**
	 * Add the sub menu page.
	 * admin_menu
	 *
	 * @since 1.0.1
	 */
	public function admin_submenu() {
		$usces_ne_setting = add_submenu_page( USCES_PLUGIN_BASENAME, 'ネクストエンジン設定', 'ネクストエンジン設定', 'administrator', 'usces_ne_setting', array( $this, 'admin_setting_page' ) );
		add_action( 'load-' . $usces_ne_setting, array( $this, 'admin_help_setting' ) );
	}

	/**
	 * Admin setting page.
	 *
	 * @since 1.0.1
	 */
	public function admin_setting_page() {
		include WCEX_NEXTENGINE_DIR . '/includes/admin_nextengine_setting.php';
	}

	/**
	 * Admin setting page.
	 * admin_enqueue_scripts
	 *
	 * @since 1.0.0
	 * @param string $hook_suffix hook_suffix.
	 */
	public function admin_scripts( $hook_suffix ) {
		if ( 'welcart-shop_page_usces_ne_setting' === $hook_suffix ) {
			wp_enqueue_script( 'jquery-ui-dialog' );
			wp_enqueue_style( 'admin-nextengine', WCEX_NEXTENGINE_URL . '/assets/css/admin_nextengine.css', array(), WCEX_NEXTENGINE_VERSION );
		}
	}

	/**
	 * Expand scripts.
	 * admin_print_footer_scripts
	 *
	 * @since 1.0.1
	 */
	public function admin_footer_scripts() {
		global $hook_suffix;
		if ( 'welcart-shop_page_usces_ne_setting' === $hook_suffix ) :
			?>
<script type="text/javascript">
jQuery( function($) {
	$("form").submit(function() {
		var error = 0;
		if( $("#api_upd_transaction").prop("checked") ) {
			if( $("#order_address").val() == "" ) {
				$("#order_address").css({"background-color":"#FFA"}).click( function() {
					$(this).css({"background-color":"#FFF"});
				});
				error++;
			}
			if( $("#store_key").val() == "" ) {
				$("#store_key").css({"background-color":"#FFA"}).click( function() {
					$(this).css({"background-color":"#FFF"});
				});
				error++;
			}
		}
		if( $("#api_upd_transaction").prop("checked") || $("#api_upd_stock").prop("checked") ) {
			if( $("#store_account").val() == "" ) {
				$("#store_account").css({"background-color":"#FFA"}).click( function() {
					$(this).css({"background-color":"#FFF"});
				});
				error++;
			}
		}
		if( 0 < error ) {
			alert("<?php esc_html_e( 'There is incomplete data.', 'usces' ); ?>");
			return false;
		}
	});

	$(document).on( "click", "#save_log", function() {
		$("#stock_update_log").dialog("open");
	});

	$("#stock_update_log").dialog({
		bgiframe: true,
		autoOpen: false,
		height: 400,
		width: 700,
		resizable: true,
		modal: true,
		buttons: {
			"<?php esc_html_e( 'Clear log', 'usces' ); ?>": function() {
				if( confirm("<?php esc_html_e( 'Are you sure you want to delete all log ?', 'usces' ); ?>") ) {
					stock_update.delete_log();
				}
			},
			"<?php esc_html_e( 'Close' ); ?>": function() {
				$(this).dialog("close");
			}
		},
		close: function() {
		},
		open: function() {
			$("#stock-update-list").html("");
			stock_update.get_log();
		}
	});

	stock_update = {
		get_log: function() {
			$.ajax({
				url: ajaxurl,
				type: "POST",
				dataType: "json",
				data: {
					action: "nextengine_get_log"
				}
			}).done( function(retVal,dataType) {
				if( retVal.status == "OK" ) {
					$("#stock-update-list").html(retVal.result);
				}
			}).fail( function(retVal) {
			});
			return false;
		},
		delete_log: function() {
			$.ajax({
				url: ajaxurl,
				type: "POST",
				dataType: "json",
				data: {
					action: "nextengine_delete_log"
				}
			}).done( function(retVal,dataType) {
				if( retVal.status == "OK" ) {
					$("#stock-update-list").html("");
					$("#stock-update-list").html(retVal.result);
				}
			}).fail( function(retVal) {
			});
			return false;
		}
	};
});
</script>
			<?php
		endif;
	}

	/**
	 * Admin setting contextual help tab setting.
	 *
	 * @since 1.0.1
	 */
	public function admin_help_setting() {
		get_current_screen()->add_help_tab(
			array(
				'id'       => 'ne_setting',
				'title'    => 'ネクストエンジン連携設定',
				'callback' => array( $this, 'admin_help' ),
			)
		);
	}

	/**
	 * Admin setting contextual help.
	 *
	 * @since 1.0.1
	 */
	public function admin_help() {
		?>
		<dl>
			<dt>商品コードの紐付</dt>
				<dd>ネクストエンジンの「商品コード」と、Welcart の商品を紐付けるキーを選択します。</dd>
				<dd>・「SKUコード」を使用する&nbsp;…&nbsp;通常はこちらを選択します。</dd>
				<dd>・「NE連携CD」を使用する&nbsp;…&nbsp;「SKUコード」に別のルールがあるなど、ネクストエンジンの「商品コード」と同じにできない場合、こちらを選択します。SKU 毎に「NE連携CD」が追加されます。</dd>
			<dt>商品リストのSKU表示</dt>
				<dd>商品リストに表示する「SKUコード」を変更することができます。</dd>
				<dd>・「SKUコード」を表示する&nbsp;…&nbsp;通常はこちらを選択します。</dd>
				<dd>・「NE連携CD」を表示する&nbsp;…&nbsp;商品コードの紐付で「NE連携CD」を選択していないと、表示されません。</dd>
				<dd>・「SKU名」を表示する&nbsp;…&nbsp;「SKU名」を表示することも可能です。</dd>
			<dt>出荷済フラグ</dt>
				<dd>取り込む受注データを強制的に「出荷済み」にしたい場合のみ設定してください。</dd>
				<dd>・通常取込&nbsp;…&nbsp;通常はこちらを選択します。</dd>
				<dd>・出荷確定済にする&nbsp;…&nbsp;こちらを選択された場合、作業者欄へ「[汎用]CSV取込で出荷確定済にしました。」と文言が追記され、強制的に受注状態が「出荷確定済み」になります。「出荷確定日」は当データを取り込んだ日付が入ります。</dd>
		</dl>
		<?php
	}

	/**
	 * Clear status.
	 * admin_footer
	 *
	 * @since 1.0.1
	 */
	public function clear_action_status() {
		global $usces;

		$usces->action_status  = 'none';
		$usces->action_message = '';
	}

	/**
	 * Item list page sku field title.
	 * usces_filter_itemlist_header
	 *
	 * @since 1.0.1
	 * @param  string $header SKU field title.
	 * @return string
	 */
	public function itemlist_header( $header ) {
		$ne_option = get_option( 'usces_ne_setting', array() );
		if ( isset( $ne_option['item_list_display'] ) ) {
			if ( 1 === (int) $ne_option['item_list_display'] ) {
				$header['sku_key'] = '<span class="sortcolumn">NE連携CD</span>';
			} elseif ( 2 === (int) $ne_option['item_list_display'] ) {
				$header['sku_key'] = '<span class="sortcolumn">SKU名</span>';
			}
		}
		return $header;
	}

	/**
	 * Item list page sku field value.
	 * usces_filter_itemlist_skufield
	 *
	 * @since 1.0.1
	 * @param  string $skufield SKU list.
	 * @param  array  $args Compact array( 'no_sku', 'key', 'value', 'i', 'zaiko_status', 'post_id' ).
	 * @return string
	 */
	public function itemlist_skufield( $skufield, $args ) {
		extract( $args );
		$ne_option = get_option( 'usces_ne_setting', array() );
		if ( isset( $ne_option['item_list_display'] ) ) :
			ob_start();
			if ( 1 === (int) $ne_option['item_list_display'] ) :
				?>
				<td class="sku">
				<?php
				$i = 0;
				foreach ( (array) $value as $skey => $sv ) :
					$bgc = ( 1 === $i % 2 ) ? ' bgc1' : ' bgc2';
					$i++;
					$ne_code = $this->get_ne_code( $post_id, $sv['code'] );
					?>
					<div class="skuline<?php echo esc_attr( $bgc ); ?>"><?php echo esc_html( $ne_code ); ?></div>
					<?php
				endforeach;
				echo wp_kses_post( $no_sku );
				?>
				</td>
				<td class="price">
				<?php
				$i = 0;
				foreach ( (array) $value as $skey => $sv ) :
					$bgc = ( 1 === $i % 2 ) ? ' bgc1' : ' bgc2';
					$i++;
					?>
					<div class="priceline<?php echo esc_attr( $bgc ); ?>"><?php usces_crform( $sv['price'], true, false ); ?></div>
					<?php
				endforeach;
				echo wp_kses_post( $no_sku );
				?>
				</td>
				<td class="zaikonum">
				<?php
				$i = 0;
				foreach ( (array) $value as $skey => $sv ) :
					$bgc = ( 1 === $i % 2 ) ? ' bgc1' : ' bgc2';
					$i++;
					$stocknum = ( ! WCUtils::is_blank( $sv['stocknum'] ) ) ? $sv['stocknum'] : '';
					?>
					<div class="priceline<?php echo esc_attr( $bgc ); ?>"><?php echo esc_html( $stocknum ); ?></div>
					<?php
				endforeach;
				echo wp_kses_post( $no_sku );
				?>
				</td>
				<td class="zaiko">
				<?php
				$i = 0;
				foreach ( (array) $value as $skey => $sv ) :
					$zaikokey = $sv['stock'];
					$bgc      = ( 1 === $i % 2 ) ? ' bgc1' : ' bgc2';
					$i++;
					?>
					<div class="zaikoline<?php echo esc_attr( $bgc ); ?>"><?php echo esc_html( $zaiko_status[ $zaikokey ] ); ?></div>
					<?php
				endforeach;
				echo wp_kses_post( $no_sku );
				?>
				</td>
				<?php
			elseif ( 2 === (int) $ne_option['item_list_display'] ) :
				?>
				<td class="sku">
				<?php
				$i = 0;
				foreach ( (array) $value as $skey => $sv ) :
					$bgc = ( 1 === $i % 2 ) ? ' bgc1' : ' bgc2';
					$i++;
					?>
					<div class="skuline<?php echo esc_attr( $bgc ); ?>"><?php echo esc_html( $sv['name'] ); ?></div>
					<?php
				endforeach;
				echo wp_kses_post( $no_sku );
				?>
				</td>
				<td class="price">
				<?php
				$i = 0;
				foreach ( (array) $value as $skey => $sv ) :
					$bgc = ( 1 === $i % 2 ) ? ' bgc1' : ' bgc2';
					$i++;
					?>
					<div class="priceline<?php echo esc_attr( $bgc ); ?>"><?php usces_crform( $sv['price'], true, false ); ?></div>
					<?php
				endforeach;
				echo wp_kses_post( $no_sku );
				?>
				</td>
				<td class="zaikonum">
				<?php
				$i = 0;
				foreach ( (array) $value as $skey => $sv ) :
					$bgc = ( 1 === $i % 2 ) ? ' bgc1' : ' bgc2';
					$i++;
					$stocknum = ( ! WCUtils::is_blank( $sv['stocknum'] ) ) ? $sv['stocknum'] : '';
					?>
					<div class="priceline<?php echo esc_attr( $bgc ); ?>"><?php echo esc_html( $stocknum ); ?></div>
					<?php
				endforeach;
				echo wp_kses_post( $no_sku );
				?>
				</td>
				<td class="zaiko">
				<?php
				$i = 0;
				foreach ( (array) $value as $skey => $sv ) :
					$zaikokey = $sv['stock'];
					$bgc      = ( 1 === $i % 2 ) ? ' bgc1' : ' bgc2';
					$i++;
					?>
					<div class="zaikoline<?php echo esc_attr( $bgc ); ?>"><?php echo esc_html( $zaiko_status[ $zaikokey ] ); ?></div>
					<?php
				endforeach;
				echo wp_kses_post( $no_sku );
				?>
				</td>
				<?php
			endif;
			$skufield = ob_get_contents();
			ob_end_clean();
		endif;
		return $skufield;
	}

	/**
	 * Item edit page sku advance field title.
	 * usces_filter_sku_meta_form_advance_title
	 *
	 * @since 1.0.1
	 * @param  string $title SKU field title.
	 * @return string
	 */
	public function sku_meta_form_advance_title( $title ) {
		if ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
			$title  = '<th>' . __( 'regular purchase price', 'autodelivery' ) . '(' . __( usces_crcode( 'return' ), 'usces' ) . ')</th>';
			$title .= '<th>NE連携CD</th>';
		} else {
			$select_sku_switch = wcne_get_select_sku_switch();
			if ( $select_sku_switch ) {
				$title .= '<th>NE連携CD</th>';
			} else {
				$title = '<th>NE連携CD</th><th>&nbsp;</th>';
			}
		}
		return $title;
	}

	/**
	 * Item edit page sku advance field.
	 * usces_filter_sku_meta_form_advance_field
	 *
	 * @since 1.0.1
	 * @param  string $field SKU field.
	 * @return string
	 */
	public function sku_meta_form_advance_field( $field ) {
		if ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
			$field  = '<td class="item-sku-cprice"><input type="text" id="rprice" name="newskuadvance[rprice]" class="newskuprice metaboxfield" /></td>';
			$field .= '<td><input name="newskuadvance[ne_code]" id="ne_code" type="text" class="newskuprice metaboxfield" /></td>';
		} else {
			$select_sku_switch = wcne_get_select_sku_switch();
			if ( $select_sku_switch ) {
				$field .= '<td><input name="newskuadvance[ne_code]" id="newskuadvance[ne_code]" type="text" class="newskuprice metaboxfield" /></td>';
			} else {
				$field = '<td><input name="newskuadvance[ne_code]" id="newskuadvance[ne_code]" type="text" class="newskuprice metaboxfield" /></td><td></td>';
			}
		}
		return $field;
	}

	/**
	 * Item edit page sku advance new field.
	 * usces_filter_sku_meta_row_advance
	 *
	 * @since 1.0.1
	 * @param  string $field SKU field.
	 * @param  array  $sku SKU values.
	 * @return string
	 */
	public function sku_meta_row_advance( $field, $sku ) {
		$advance = ( isset( $sku['advance'] ) ) ? maybe_unserialize( $sku['advance'] ) : array();
		$ne_code = ( isset( $advance['ne_code'] ) ) ? $advance['ne_code'] : '';
		$meta_id = (int) $sku['meta_id'];
		if ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
			if ( empty( $advance ) ) {
				$rprice = '';
			} else {
				$rprice = ( isset( $advance['rprice'] ) ) ? (int) $advance['rprice'] : '';
			}
			$field  = "<td class='item-sku-cprice'><input name='itemsku[" . $meta_id . "][skuadvance][rprice]' id='rprice' class='skuprice metaboxfield' type='text' value='" . $rprice . "' /></td>";
			$field .= '<td><input name="itemsku[' . $meta_id . '][skuadvance][ne_code]" id="ne_code" class="skuprice metaboxfield" type="text" value="' . $ne_code . '" /></td>';
		} else {
			$post_id           = (int) $sku['post_id'];
			$select_sku_switch = wcne_get_select_sku_switch( $post_id );
			if ( $select_sku_switch ) {
				$field .= '<td><input name="itemsku[' . $meta_id . '][skuadvance][ne_code]" id="ne_code" class="skuprice metaboxfield" type="text" value="' . $ne_code . '" /></td>';
			} else {
				$field = '<td><input name="itemsku[' . $meta_id . '][skuadvance][ne_code]" id="ne_code" class="skuprice metaboxfield" type="text" value="' . $ne_code . '" /></td><td>&nbsp;</td>';
			}
		}
		return $field;
	}

	/**
	 * Register sku advance field.
	 * usces_filter_add_item_sku_meta_value
	 *
	 * @since 1.0.1
	 * @param  array $sku SKU values.
	 * @return array
	 */
	public function add_item_sku_meta_value( $sku ) {
		$advance       = ( isset( $sku['advance'] ) ) ? maybe_unserialize( $sku['advance'] ) : array();
		if ( is_array( $_POST['newskuadvance'] ) ) {
			if ( isset( $_POST['newskuadvance']['ne_code'] ) ) {
				$advance['ne_code'] = trim( $_POST['newskuadvance']['ne_code'] );
			}
		} else {
			$advance['ne_code'] = trim( $_POST['newskuadvance'] );
		}
		$sku['advance'] = serialize( $advance );
		return $sku;
	}

	/**
	 * Update sku advance field.
	 * usces_filter_up_item_sku_meta_value
	 *
	 * @since 1.0.1
	 * @param  array $sku SKU values.
	 * @return array
	 */
	public function up_item_sku_meta_value( $sku ) {
		$advance    = ( isset( $sku['advance'] ) ) ? maybe_unserialize( $sku['advance'] ) : array();
		if ( is_array( $_POST['skuadvance'] ) ) {
			if ( isset( $_POST['skuadvance']['ne_code'] ) ) {
				$advance['ne_code'] = trim( $_POST['skuadvance']['ne_code'] );
			}
		} else {
			$advance['ne_code'] = trim( $_POST['skuadvance'] );
		}
		$sku['advance'] = serialize( $advance );
		return $sku;
	}

	/**
	 * Update sku advance field.
	 * usces_filter_item_save_sku_metadata
	 *
	 * @since 1.0.1
	 * @param  array  $sku SKU values.
	 * @param  string $meta_id SKU meta ID.
	 * @return array
	 */
	public function item_save_sku_metadata( $sku, $meta_id ) {
		$advance = ( isset( $sku['advance'] ) ) ? maybe_unserialize( $sku['advance'] ) : array();
		$itemsku = filter_input( INPUT_POST, 'itemsku', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
		if ( isset( $itemsku[ $meta_id ]['skuadvance']['ne_code'] ) ) {
			$advance['ne_code'] = trim( $itemsku[ $meta_id ]['skuadvance']['ne_code'] );
		}
		$sku['advance'] = serialize( $advance );
		return $sku;
	}

	/**
	 * Item upload csv field number.
	 * usces_filter_uploadcsv_min_field_num
	 * usces_filter_sku_uploadcsv_min_field_num
	 * wcad_filter_uploadcsv_min_field_num
	 * wcad_filter_sku_uploadcsv_min_field_num
	 *
	 * @since 1.0.1
	 * @param  int $min_field_num SKU column number.
	 * @return int
	 */
	public function uploadcsv_min_field_num( $min_field_num ) {
		$this->num_sku_ne_code = $min_field_num;
		$min_field_num         = $min_field_num + 1;
		return $min_field_num;
	}

	/**
	 * Item upload csv sku value.
	 * usces_filter_uploadcsv_skuvalue
	 * usces_filter_sku_uploadcsv_skuvalue
	 * wcad_filter_uploadcsv_skuvalue
	 * wcad_filter_sku_uploadcsv_skuvalue
	 *
	 * @since 1.0.1
	 * @param  array $sku SKU values.
	 * @param  array $datas CSV value.
	 * @return array
	 */
	public function uploadcsv_skuvalue( $sku, $datas ) {
		global $usces;

		$advance = ( isset( $sku['advance'] ) ) ? maybe_unserialize( $sku['advance'] ) : array();
		if ( null !== $this->num_sku_ne_code && isset( $datas[ $this->num_sku_ne_code ] ) ) {
			if ( 0 === (int) $usces->options['system']['csv_encode_type'] ) {
				$advance['ne_code'] = trim( mb_convert_encoding( $datas[ $this->num_sku_ne_code ], 'UTF-8', 'SJIS' ) );
			} else {
				$advance['ne_code'] = trim( $datas[ $this->num_sku_ne_code ] );
			}
		}
		$sku['advance'] = serialize( $advance );
		return $sku;
	}

	/**
	 * Item download csv sku title.
	 * usces_filter_downloadcsv_header
	 * usces_filter_downloadcsv_header_skulist
	 * wcad_filter_downloadcsv_header
	 * wcad_filter_downloadcsv_header_skulist
	 *
	 * @since 1.0.1
	 * @param  string $title CSV header line.
	 * @return string
	 */
	public function downloadcsv_header( $title ) {
		$title .= ',NE連携CD';
		return $title;
	}

	/**
	 * Item download csv sku value.
	 * usces_filter_downloadcsv_skuvalue
	 * usces_filter_downloadcsv_skuvalue_skulist
	 * wcad_filter_downloadcsv_skuvalue
	 * wcad_filter_downloadcsv_skuvalue_skulist
	 *
	 * @since 1.0.1
	 * @param  string $line CSV value line.
	 * @param  array  $sku SKU values.
	 * @return string
	 */
	public function downloadcsv_skuvalue( $line, $sku ) {
		$advance = ( isset( $sku['advance'] ) ) ? maybe_unserialize( $sku['advance'] ) : array();
		$ne_code = ( isset( $advance['ne_code'] ) ) ? $advance['ne_code'] : '';
		$line   .= ',' . $ne_code;
		return $line;
	}

	/**
	 * Get NEXT ENGINE linkage product code.
	 *
	 * @since 1.0.1
	 * @param  int    $post_id Post ID.
	 * @param  string $sku_code SKU code.
	 * @return string
	 */
	public function get_ne_code( $post_id, $sku_code ) {
		global $usces;

		$ne_code   = '';
		$ne_option = get_option( 'usces_ne_setting', array() );
		if ( isset( $ne_option['link_necd'] ) && 1 === (int) $ne_option['link_necd'] ) {
			if ( ! empty( $post_id ) && ! empty( $sku_code ) ) {
				$skus    = $usces->get_skus( $post_id, 'code' );
				$advance = ( isset( $skus[ $sku_code ]['advance'] ) ) ? $skus[ $sku_code ]['advance'] : '';
				if ( ! empty( $advance ) ) {
					$advance = maybe_unserialize( $advance );
					if ( isset( $advance['ne_code'] ) ) {
						$ne_code = $advance['ne_code'];
					}
				}
			}
		} else {
			$ne_code = $sku_code;
		}
		return $ne_code;
	}

	/**
	 * Update notification to NEXT ENGINE.
	 * usces_post_reg_orderdata
	 *
	 * @since 1.0.1
	 * @param  int   $order_id Order number.
	 * @param  array $results Result value.
	 */
	public function send_nextengine_ordermail( $order_id, $results ) {
		global $usces;

		if ( ! $order_id ) {
			return false;
		}

		$ne_option = get_option( 'usces_ne_setting', array() );
		if ( empty( $ne_option['order_address'] ) ) {
			return false;
		}
		if ( ! in_array( 'transaction', $ne_option['api_upd'], true ) ) {
			return false;
		}

		$message = $this->ordermail_message( $order_id );
		if ( empty( $message ) ) {
			return false;
		} else {
			$subject    = __( 'An order report', 'usces' );
			$order_para = array(
				'to_name'      => __( 'An order email', 'usces' ),
				'to_address'   => $ne_option['order_address'],
				'from_name'    => get_option( 'blogname' ),
				'from_address' => $usces->options['sender_mail'],
				'return_path'  => $usces->options['error_mail'],
				'subject'      => $subject,
				'message'      => $message,
			);
			$res        = usces_send_mail( $order_para );
			if ( $res ) {
				$this->update_ordercheck_nextenginemail( $order_id );
			}
			return $res;
		}
	}

	/**
	 * Update notification to NEXT ENGINE.
	 * wcad_action_reg_auto_orderdata
	 *
	 * @since 1.0.2
	 * @param  array $args array( 'cart', 'entry', 'order_id', 'member_id', 'payments', 'charging_type', 'total_amount', 'reg_id', 'order_date' ).
	 */
	public function send_nextengine_ordermail_regular( $args ) {
		global $usces;
		extract( $args );

		if ( ! $order_id ) {
			return false;
		}

		$ne_option = get_option( 'usces_ne_setting', array() );
		if ( empty( $ne_option['order_address'] ) ) {
			return false;
		}
		if ( ! in_array( 'transaction', $ne_option['api_upd'], true ) ) {
			return false;
		}

		$payment_method = ( isset( $payments['settlement'] ) ) ? $payments['settlement'] : '';
		if ( 'acting_zeus_card' === $payment_method ) {
			$settlement_data = $usces->get_order_meta_value( $payment_method, $order_id );
			if ( ! isset( $settlement_data['result'] ) || 'OK' !== $settlement_data['result'] ) {
				return false;
			}
		} elseif ( 'acting_welcart_card' === $payment_method ) {
			$settlement_data = $usces->get_order_meta_value( $payment_method, $order_id );
			if ( ! isset( $settlement_data['ResponseCd'] ) || 'OK' !== $settlement_data['ResponseCd'] ) {
				return false;
			}
		} elseif ( 'acting_sbps_card' === $payment_method ) {
			$settlement_data = $usces->get_order_meta_value( $payment_method, $order_id );
			if ( ! isset( $settlement_data['res_result'] ) || 'OK' !== $settlement_data['res_result'] ) {
				return false;
			}
		} elseif ( 'acting_paygent_card' === $payment_method ) {
			$settlement_data = $usces->get_order_meta_value( $payment_method, $order_id );
			if ( ! $settlement_data ) {
				return false;
			} elseif ( isset( $settlement_data['settltment_status'] ) && isset( $settlement_data['settltment_errmsg'] ) ) {
				return false;
			}
		} elseif ( 'acting_paypal_cp' === $payment_method ) {
			$settlement_data = $usces->get_order_meta_value( $payment_method, $order_id );
			if ( ! isset( $settlement_data['id'] ) || ! isset( $settlement_data['status'] ) || 'COMPLETED' !== $settlement_data['status'] ) {
				return false;
			}
		} elseif ( 'COD' !== $payment_method ) {
			return false;
		}

		$message = $this->ordermail_message( $order_id );
		if ( empty( $message ) ) {
			return false;
		} else {
			$subject    = __( 'Automatic order notification', 'autodelivery' );
			$order_para = array(
				'to_name'      => __( 'An order email', 'usces' ),
				'to_address'   => $ne_option['order_address'],
				'from_name'    => get_option( 'blogname' ),
				'from_address' => $usces->options['sender_mail'],
				'return_path'  => $usces->options['error_mail'],
				'subject'      => $subject,
				'message'      => $message,
			);
			$res        = usces_send_mail( $order_para );
			if ( $res ) {
				$this->update_ordercheck_nextenginemail( $order_id );
			}
			return $res;
		}
	}

	/**
	 * Generate email body for order mail.
	 *
	 * @since 1.0.2
	 * @param  int $order_id Order ID.
	 * @return string
	 */
	public function ordermail_message( $order_id ) {
		global $usces;

		$message = '';
		$data    = $usces->get_order_data( $order_id, 'direct' );
		$cart    = usces_get_ordercartdata( $order_id );
		if ( empty( $data ) || empty( $cart ) ) {
			return $message;
		}

		$ne_option        = get_option( 'usces_ne_setting', array() );
		$total_full_price = $data['order_item_total_price'] - $data['order_usedpoint'] + $data['order_discount'] + $data['order_shipping_charge'] + $data['order_cod_fee'] + $data['order_tax'];
		if ( 0 > $total_full_price ) {
			$total_full_price = 0;
		}
		$delivery = unserialize( $data['order_delivery'] );
		$gift     = apply_filters( 'wcne_filter_ordermail_gift_option', '', $data );
		$note     = apply_filters( 'wcne_filter_ordermail_note', $data['order_note'], $data );
		if ( 1 === (int) $ne_option['order_number'] ) {
			$order_number = usces_get_deco_order_id( $order_id );
		} else {
			$order_number = sprintf( '%06d', $order_id );
		}
		$order_name    = apply_filters( 'wcne_filter_ordermail_order_name', $data['order_name1'] . ' ' . $data['order_name2'], $data );
		$order_kana    = apply_filters( 'wcne_filter_ordermail_order_kana', $data['order_name3'] . ' ' . $data['order_name4'], $data );
		$delivery_name = apply_filters( 'wcne_filter_ordermail_delivery_name', $delivery['name1'] . ' ' . $delivery['name2'], $data );
		$delivery_kana = apply_filters( 'wcne_filter_ordermail_delivery_kana', $delivery['name3'] . ' ' . $delivery['name4'], $data );

		$message .= '注文コード：' . $order_number . '
注文日時：' . wp_date( 'Y年m月d日 H時i分秒' ) . '

■注文者の情報
氏名：' . $order_name . '
氏名（フリガナ）：' . $order_kana . '
郵便番号：' . $data['order_zip'] . '
住所：' . $data['order_pref'] . $data['order_address1'] . $data['order_address2'] . $data['order_address3'] . '
電話番号：' . $data['order_tel'] . '
Ｅメールアドレス：' . $data['order_email'] . '

■支払方法
支払方法：' . $data['order_payment_name'] . '

■注文内容';
		foreach ( (array) $cart as $cart_row ) {
			$post_id        = $cart_row['post_id'];
			$sku_code       = urldecode( $cart_row['sku'] );
			$ne_code        = $this->get_ne_code( $post_id, $sku_code );
			$item_name      = $cart_row['item_name'];
			$quantity       = $cart_row['quantity'];
			$price          = $cart_row['price'];
			$options        = ( empty( $cart_row['options'] ) ) ? array() : $cart_row['options'];
			$option_details = '';
			if ( is_array( $options ) && count( $options ) > 0 ) {
				foreach ( $options as $key => $value ) {
					if ( ! empty( $key ) ) {
						$key = urldecode( $key );
						if ( is_array( $value ) ) {
							$c               = '';
							$option_details .= $key . ' : ';
							foreach ( $value as $v ) {
								$option_details .= $c . urldecode( $v );
								$c               = ', ';
							}
						} else {
							$option_details .= $key . ' : ' . urldecode( $value );
						}
					}
				}
			}
			$message .= '
------------------------------------------------------------
商品番号：' . $ne_code . '
注文商品名：' . $item_name . '
商品オプション：' . $option_details . '
単価：￥' . usces_crform( $price, false, false, 'return' ) . '
数量：' . $quantity . '
小計：￥' . usces_crform( ( $price * $quantity ), false, false, 'return' );
		}
		$message  .= '
------------------------------------------------------------
商品合計：￥' . usces_crform( $data['order_item_total_price'], false, false, 'return' ) . '
税金：￥' . usces_crform( $data['order_tax'], false, false, 'return' ) . '
送料：￥' . usces_crform( $data['order_shipping_charge'], false, false, 'return' ) . '
手数料：￥' . usces_crform( $data['order_cod_fee'], false, false, 'return' ) . '
その他費用：￥' . usces_crform( $data['order_discount'], false, false, 'return' ) . '
ポイント利用額：▲￥';
		$usedpoint = ( empty( $data['order_usedpoint'] ) ) ? '0' : $data['order_usedpoint'];
		$message  .= $usedpoint . '(' . $usedpoint . 'ポイント)
------------------------------------------------------------
合計金額(税込)：￥' . usces_crform( $total_full_price, false, false, 'return' ) . '
------------------------------------------------------------

■届け先の情報
[送付先1]
　送付先1氏名：' . $delivery_name . '
　送付先1氏名（フリガナ）：' . $delivery_kana . '
　送付先1郵便番号：' . $delivery['zipcode'] . '
　送付先1住所：' . $delivery['pref'] . $delivery['address1'] . $delivery['address2'] . $delivery['address3'] . '
　送付先1電話番号：' . $delivery['tel'] . '
　送付先1のし・ギフト包装：' . $gift . '
　送付先1お届け方法：' . usces_delivery_method_name( $data['order_delivery_method'], 'return' ) . '
　送付先1お届け希望日：';
		if ( $this->isdate( $data['order_delivery_date'] ) ) {
			list( $year, $month, $day ) = explode( '-', $data['order_delivery_date'] );
			$delivery_date              = $year . '年' . $month . '月' . $day . '日';
		} else {
			$delivery_date = $data['order_delivery_date'];
		}
		$message .= $delivery_date . '
　送付先1お届け希望時間：' . $data['order_delivery_time'] . '

■通信欄';
		$message .= "\r\n" . $note . "\r\n";

		return $message;
	}

	/**
	 * Date check.
	 *
	 * @since 1.0.1
	 * @param  array $date Date.
	 * @return boolean
	 */
	public function isdate( $date ) {
		if ( empty( $date ) ) {
			return false;
		}
		try {
			new DateTime( $date );
			list( $year, $month, $day ) = explode( '-', $date );
			$res                        = checkdate( (int) $month, (int) $day, (int) $year );
			return $res;
		} catch ( Exception $e ) {
			return false;
		}
	}

	/**
	 * Operation field of the order edit page.
	 * usces_filter_admin_ordernavi
	 *
	 * @since 1.0.1
	 * @param  string $ordernavi Operation field.
	 * @param  array  $ordercheck Check values.
	 * @return string
	 */
	public function admin_ordernavi( $ordernavi, $ordercheck ) {
		$ordernavi .= '</tr><tr><td colspan="6"><input name="check[nextenginemail]" type="checkbox" value="nextenginemail"' . checked( isset( $ordercheck['nextenginemail'] ), true, false ) . ' /><a href="#" id="next-engine-mail">NE在庫連携メール</a></td>';
		return $ordernavi;
	}

	/**
	 * Send e-mail from order edit page.
	 * usces_action_order_edit_page_js
	 *
	 * @since 1.0.1
	 * @param int   $order_id Order number.
	 * @param array $data Order data.
	 */
	public function admin_order_edit_page_js( $order_id, $data ) {
		?>
		$(document).on( "click", "#next-engine-mail", function() {
			if( ! confirm("ネクストエンジンに在庫連携メールを送信しますか？") ) {
				return;
			}
			$.ajax({
				url: uscesL10n.requestFile,
				type: "POST",
				cache: false,
				data: {
					action: "order_item_ajax",
					mode: "nextenginemail",
					order_id: $("#order_id").val(),
					checked: "nextenginemail"
				}
			}).done( function(retVal,dataType) {
				if( retVal ) {
					$("input[name=\"check[nextenginemail]\"]").prop("checked",true);
					alert("送信しました。");
				}
			}).fail( function(jqXHR,textStatus,errorThrown) {
				console.log(textStatus);
				console.log(jqXHR.status);
				console.log(errorThrown.message);
			});
			return false;
		});
		<?php
	}

	/**
	 * Send e-mail from order edit page.
	 * usces_filter_order_item_ajax
	 *
	 * @since 1.0.1
	 * @param  int $res Result value.
	 * @return int
	 */
	public function admin_order_item_ajax( $res ) {
		$mode = filter_input( INPUT_POST, 'mode', FILTER_SANITIZE_STRING );
		if ( 'nextenginemail' === $mode ) {
			$order_id = filter_input( INPUT_POST, 'order_id' );
			$results  = array();
			$res      = $this->send_nextengine_ordermail( $order_id, $results, 'admin_order' );
		}
		return $res;
	}

	/**
	 * Update sent mail flag.
	 *
	 * @since 1.0.1
	 * @param int $order_id Order number.
	 */
	public function update_ordercheck_nextenginemail( $order_id ) {
		global $wpdb;

		$order_table  = $wpdb->prefix . 'usces_order';
		$select_query = $wpdb->prepare( "SELECT `order_check` FROM $order_table WHERE `ID` = %d", $order_id );
		$order_check  = $wpdb->get_var( $select_query );
		$checkfield   = unserialize( $order_check );
		if ( ! isset( $checkfield['nextenginemail'] ) ) {
			$checkfield['nextenginemail'] = 'nextenginemail';
		}
		$update_query = $wpdb->prepare( "UPDATE $order_table SET `order_check` = %s WHERE `ID` = %d", serialize( $checkfield ), $order_id );
		$wpdb->query( $update_query );
	}

	/**
	 * Download CSV button.
	 * usces_action_order_list_searchbox_bottom
	 *
	 * @since 1.0.1
	 */
	public function order_list_action_button() {
		?>
		<input type="button" id="dl_negeneralcsv" class="button" value="ネクストエンジン汎用CSV出力" />
		<?php
	}

	/**
	 * Download CSV script.
	 * usces_filter_order_list_page_js
	 *
	 * @since 1.0.1
	 */
	public function order_list_page_js() {
		?>
		$(document).on( "click", "#dl_negeneralcsv", function() {
			if( $("input[name*=\'listcheck\']:checked").length == 0 ) {
				alert("<?php esc_html_e( 'Choose the data.', 'usces' ); ?>");
				$("#orderlistaction").val("");
				return false;
			}
			var listcheck = "";
			$("input[name*=\'listcheck\']").each( function(i) {
				if( $(this).prop("checked") ) {
					listcheck += "&listcheck["+i+"]="+$(this).val();
				}
			});
			location.href = "<?php echo esc_url( USCES_ADMIN_URL ); ?>?page=usces_orderlist&order_action=download_ne_general"+listcheck+"&noheader=true";
		});
		<?php
	}

	/**
	 * Download CSV action.
	 * usces_action_order_list_page
	 *
	 * @since 1.0.1
	 * @param string $order_action Action.
	 */
	public function order_list_page_action( $order_action ) {
		if ( 'download_ne_general' === $order_action ) {
			$this->output_general_csv();
		}
	}

	/**
	 * Output CSV data.
	 *
	 * @since 1.0.1
	 */
	private function output_general_csv() {
		global $usces;

		$ne_option    = get_option( 'usces_ne_setting', array() );
		$item_shipped = ( ! empty( $ne_option['item_shipped'] ) ) ? $ne_option['item_shipped'] : '';

		$filename = apply_filters( 'wcne_filter_outputcsv_filename', 'NextEngine_GeneralData_' . wp_date( 'YmdHis' ) . '.csv' );
		$line     = '"店舗伝票番号","受注日","受注郵便番号","受注住所１","受注住所２","受注名","受注名カナ","受注電話番号","受注メールアドレス","発送郵便番号","発送先住所１","発送先住所２","発送先名","発送先カナ","発送電話番号","支払方法","発送方法","商品計","税金","発送料","手数料","ポイント","その他費用","合計金額","ギフトフラグ","時間帯指定","日付指定","作業者欄","備考","商品名","商品コード","商品価格","受注数量","商品オプション","出荷済フラグ"' . "\r\n";
		$ids      = filter_input( INPUT_GET, 'listcheck', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );

		foreach ( (array) $ids as $order_id ) {
			$data = $usces->get_order_data( $order_id, 'direct' );
			if ( empty( $data ) ) {
				break;
			}
			$delivery = unserialize( $data['order_delivery'] );
			if ( 1 === (int) $ne_option['order_number'] ) {
				$order_number = usces_get_deco_order_id( $order_id );
			} else {
				$order_number = sprintf( '%06d', $order_id );
			}
			$order_date = str_replace( '-', '/', $data['order_date'] );

			$order_zip      = str_replace( 'ー', '-', mb_convert_kana( $data['order_zip'], 'a' ) );
			$order_zip      = str_replace( '-', '', $order_zip );
			$order_address1 = $data['order_pref'] . $data['order_address1'];
			if ( ! empty( $data['order_address2'] ) ) {
				$order_address1 .= mb_convert_kana( $data['order_address2'], 'KVC', 'UTF-8' );
			}
			$order_address2 = ( ! empty( $data['order_address3'] ) ) ? mb_convert_kana( $data['order_address3'], 'KVC', 'UTF-8' ) : '';
			$order_name     = $data['order_name1'] . $data['order_name2'];
			$order_kana     = mb_convert_kana( $data['order_name3'], 'KVC', 'UTF-8' ) . mb_convert_kana( $data['order_name4'], 'KVC', 'UTF-8' );
			$order_tel      = str_replace( 'ー', '-', mb_convert_kana( $data['order_tel'], 'a' ) );
			$order_tel      = str_replace( '-', '', $order_tel );
			$order_email    = $data['order_email'];

			$shipping_zip      = str_replace( 'ー', '-', mb_convert_kana( $delivery['zipcode'], 'a' ) );
			$shipping_zip      = str_replace( '-', '', $shipping_zip );
			$shipping_address1 = $delivery['pref'] . $delivery['address1'];
			if ( ! empty( $delivery['address2'] ) ) {
				$shipping_address1 .= mb_convert_kana( $delivery['address2'], 'KVC', 'UTF-8' );
			}
			$shipping_address2 = ( ! empty( $delivery['address3'] ) ) ? mb_convert_kana( $delivery['address3'], 'KVC', 'UTF-8' ) : '';
			$shipping_name     = $delivery['name1'] . $delivery['name2'];
			$shipping_kana     = mb_convert_kana( $delivery['name3'], 'KVC', 'UTF-8' ) . mb_convert_kana( $delivery['name4'], 'KVC', 'UTF-8' );
			$shipping_tel      = str_replace( 'ー', '-', mb_convert_kana( $delivery['tel'], 'a' ) );
			$shipping_tel      = str_replace( '-', '', $shipping_tel );

			$payment_name         = $data['order_payment_name'];
			$delivery_method_name = '';
			if ( 0 <= (int) $data['order_delivery_method'] ) {
				foreach ( (array) $usces->options['delivery_method'] as $key => $delivery_method ) {
					if ( $delivery_method['id'] === (int) $data['order_delivery_method'] ) {
						$delivery_method_name = $delivery_method['name'];
						break;
					}
				}
			}

			$item_amount     = usces_crform( $data['order_item_total_price'], false, false, 'return', false );
			$tax             = ( 'exclude' === usces_get_tax_mode() ) ? usces_crform( $data['order_tax'], false, false, 'return', false ) : '0';
			$shipping_charge = usces_crform( $data['order_shipping_charge'], false, false, 'return', false );
			$fee             = usces_crform( $data['order_cod_fee'], false, false, 'return', false );
			$usedpoint       = ( ! empty( $data['order_usedpoint'] ) ) ? $data['order_usedpoint'] : '';
			$discount        = usces_crform( $data['order_discount'], false, false, 'return', false );
			$total_amount    = $data['order_item_total_price'] - $data['order_usedpoint'] + $data['order_discount'] + $data['order_shipping_charge'] + $data['order_cod_fee'] + $data['order_tax'];
			if ( 0 > $total_amount ) {
				$total_amount = 0;
			}
			$total_amount = usces_crform( $total_amount, false, false, 'return', false );
			$gift         = apply_filters( 'wcne_filter_outputcsv_gift_option', '0', $data );
			if ( ! empty( $data['order_delivery_time'] ) ) {
				$arrivaltime = $data['order_delivery_time'];
			} else {
				$arrivaltime = '';
			}
			if ( ! empty( $data['order_delivery_date'] ) && $this->isdate( $data['order_delivery_date'] ) ) {
				$arrivaldate = str_replace( '-', '/', $data['order_delivery_date'] );
			} else {
				$arrivaldate = '';
			}
			$contact_name = apply_filters( 'wcne_filter_outputcsv_contact_name', '', $data );
			$note         = apply_filters( 'wcne_filter_outputcsv_note', $data['order_note'], $data );

			$line_header = '"' . $order_number . '",' .
				'"' . $order_date . '",' .
				'"' . $order_zip . '",' .
				'"' . $order_address1 . '",' .
				'"' . $order_address2 . '",' .
				'"' . $order_name . '",' .
				'"' . $order_kana . '",' .
				'"' . $order_tel . '",' .
				'"' . $order_email . '",' .
				'"' . $shipping_zip . '",' .
				'"' . $shipping_address1 . '",' .
				'"' . $shipping_address2 . '",' .
				'"' . $shipping_name . '",' .
				'"' . $shipping_kana . '",' .
				'"' . $shipping_tel . '",' .
				'"' . $payment_name . '",' .
				'"' . $delivery_method_name . '",' .
				'"' . $item_amount . '",' .
				'"' . $tax . '",' .
				'"' . $shipping_charge . '",' .
				'"' . $fee . '",' .
				'"' . $usedpoint . '",' .
				'"' . $discount . '",' .
				'"' . $total_amount . '",' .
				'"' . $gift . '",' .
				'"' . $arrivaltime . '",' .
				'"' . $arrivaldate . '",' .
				'"' . $contact_name . '",' .
				'"' . $note . '",';

			$cart = usces_get_ordercartdata( $order_id );
			foreach ( (array) $cart as $cart_row ) {
				$post_id        = $cart_row['post_id'];
				$sku_code       = urldecode( $cart_row['sku'] );
				$ne_code        = $this->get_ne_code( $post_id, $sku_code );
				$item_name      = $cart_row['item_name'];
				$quantity       = $cart_row['quantity'];
				$price          = usces_crform( $cart_row['price'], false, false, 'return', false );
				$options        = ( empty( $cart_row['options'] ) ) ? array() : $cart_row['options'];
				$option_details = '';
				if ( is_array( $options ) && 0 < count( $options ) ) {
					foreach ( $options as $key => $value ) {
						if ( ! empty( $key ) ) {
							$key   = urldecode( $key );
							$value = maybe_unserialize( $value );
							if ( is_array( $value ) ) {
								$c               = '';
								$option_details .= $key . ' : ';
								foreach ( $value as $v ) {
									$option_details .= $c . urldecode( $v );
									$c               = ' ';
								}
							} else {
								$option_details .= $key . ' : ' . urldecode( $value );
							}
						}
					}
				}

				$line_cart = '"' . $item_name . '",' .
				'"' . $ne_code . '",' .
				'"' . $price . '",' .
				'"' . $quantity . '",' .
				'"' . $option_details . '",' .
				'"' . $item_shipped . '"' . "\r\n";

				$line .= $line_header . $line_cart;
			}
		}

		header( 'Content-Type: application/octet-stream' );
		header( "Content-disposition: attachment; filename=\"$filename\"" );
		mb_http_output( 'pass' );
		print( mb_convert_encoding( $line, 'SJIS-win', 'UTF-8' ) );
		exit();
	}

	/**
	 * Output CSV Button.
	 */
	public function csv_button() {
		$button = '<td><input type="button" id="dl_nextengine" class="searchbutton button" value="ネクストエンジン商品登録CSV出力" /></td>';
		if ( defined( 'USCES_VERSION' ) && version_compare( USCES_VERSION, '2.5.0', '<' ) ) {
			return $button;
		} else {
			echo $button; // phpcs:ignore
		}
	}

	/**
	 * Download CSV action.
	 * usces_action_item_master_page
	 *
	 * @since 1.0.2
	 * @param string $action action.
	 */
	public function action_item_master_page( $action ) {
		if ( 'dlnextenginelist' === $action ) {
			$this->output_item_csv();
		}
	}

	/**
	 * Output Items CSV data.
	 *
	 * @since 1.0.2
	 */
	private function output_item_csv() {
		global $usces;

		$filename  = 'NEXTENGINE_ItemData_' . wp_date( 'YmdHis' ) . '.csv';
		$line      = '';
		$line     .= '"syohin_code","sire_code","syohin_name","genka_tnk","hyoji_tnk","baika_tnk","tax_rate","image_url_http","image_alt"' . "\r\n";
		$listcheck = filter_input( INPUT_GET, 'listcheck', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
		$ids       = ! empty( $listcheck ) ? $listcheck : array();
		$usces_tax = Welcart_Tax::get_instance();
		$ne_option = get_option( 'usces_ne_setting', array() );
		foreach ( (array) $ids as $post_id ) {
			$skus      = $usces->get_skus( $post_id, 'sort' );
			$item_code = ! empty( $usces->getItemCode( $post_id ) ) ? $usces->getItemCode( $post_id ) : '';
			$pictids   = array();
			$pict_uri  = '';
			$pict_alt  = '';
			if ( $usces->get_mainpictid( $item_code ) ) {
				$pictids[] = $usces->get_mainpictid( $item_code );
			}
			if ( $usces->get_pictids( $item_code ) ) {
				$pictids = array_merge( $pictids, $usces->get_pictids( $item_code ) );
			}
			foreach ( $pictids as $pictid ) {
				$pict_uri .= wp_get_attachment_url( $pictid ) . "\r\n";
				$img_alt   = get_post_meta( $pictid, '_wp_attachment_image_alt', true );
				if ( ! empty( $img_alt ) ) {
					$pict_alt .= $img_alt . "\r\n";
				}
			}
			foreach ( $skus as $sku_value ) {
				$syohin_code = '';
				$line_data   = '';
				if ( isset( $ne_option['link_necd'] ) && 1 === (int) $ne_option['link_necd'] ) {
					$advance = ( isset( $sku_value['advance'] ) ) ? $sku_value['advance'] : '';
					if ( ! empty( $advance ) ) {
						$advance = maybe_unserialize( $advance );
						if ( isset( $advance['ne_code'] ) ) {
							$syohin_code = $this->get_ne_code( $post_id, $sku_value['code'] );
						}
					}
				} else {
					$syohin_code = $sku_value['code'];
				}
				if ( 'reduced' === $usces->options['applicable_taxrate'] ) {
					$tax_rate = $usces_tax->get_sku_tax_rate( $post_id, $sku_value['code'] );
				} else {
					$tax_rate = $usces->options['tax_rate'];
				}
				$line_data .= '"' . $syohin_code . '",'; // sire_code（商品コード）.
				$line_data .= '"9999",'; // sire_code（仕入先コード）.
				$line_data .= '"' . $usces->getItemName( $post_id ) . '",'; // syohin_name（商品名）.
				$line_data .= '"0",'; // genka_tnk（原価）.
				$line_data .= '"' . $sku_value['cprice'] . '",'; // hyoji_tnk（定価）.
				$line_data .= '"' . $sku_value['price'] . '",'; // baika_tnk（売価）.
				$line_data .= '"' . $tax_rate . '",'; // tax_rate（消費税率）.
				$line_data .= '"' . usces_entity_decode( rtrim( $pict_uri ), 'csv' ) . '",'; // image_url_http（画像ダウンロード元URL）.
				$line_data .= '"' . usces_entity_decode( rtrim( $pict_alt ), 'csv' ) . '"'; // image_alt（画像説明）.
				$line_data .= "\r\n";
				$line      .= $line_data;
			}
		}
		header( 'Content-Type: application/octet-stream' );
		header( "Content-disposition: attachment; filename=\"$filename\"" );
		mb_http_output( 'pass' );
		print( mb_convert_encoding( $line, 'SJIS-win', 'UTF-8' ) ); // phpcs:ignore
		exit();
	}

	/**
	 * Add Script.
	 * usces_action_item_list_footer
	 *
	 * @since 1.0.2
	 */
	public function action_item_list_footer() {
		?>
<script>
jQuery(document).ready( function($) {
	$('#dl_nextengine').click( function() {
		if( $("input[name*='listcheck']:checked").length === 0 ) {
			alert('データが選択されていません。');
			return false;
		}
		let listcheck = '';
		$("input[name*='listcheck']").each( function(i) {
			if( $(this).prop('checked') ) {
				listcheck += '&listcheck['+i+']='+$(this).val();
			}
		});
		location.href = '<?php echo esc_js( USCES_ADMIN_URL ); ?>'+'?page=usces_itemedit&action=dlnextenginelist'+listcheck+'&noheader=true';
	});
});
</script>
		<?php
	}

	/**
	 * Save log data.
	 *
	 * @since 1.0.0
	 * @param string|array $log Log data.
	 * @param string       $log_key Log key.
	 */
	public function save_log( $log, $log_key ) {
		global $wpdb;

		$query = $wpdb->prepare(
			"INSERT INTO {$wpdb->prefix}usces_log ( `datetime`, `log`, `log_type`, `log_key` ) VALUES ( %s, %s, %s, %s )",
			wp_date( 'Y/m/d H:i:s' ),
			$log,
			'nextengine',
			$log_key
		);
		$res   = $wpdb->query( $query );
		return $res;
	}

	/**
	 * Get stock update log.
	 */
	public function get_log() {
		global $wpdb;

		$form     = '';
		$log_data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}usces_log WHERE `log_type` = 'nextengine' ORDER BY datetime DESC, `ID` DESC", ARRAY_A );
		if ( $log_data ) {
			$form = '<table class="stock-update-log"><tr><th>Date</th><th>Log</th><th>Type</th></tr>';
			foreach ( (array) $log_data as $data ) {
				$log   = ( 'request' === $data['log_key'] ) ? urldecode( $data['log'] ) : $data['log'];
				$form .= '<tr class="' . $data['log_key'] . '">
					<td nowrap>' . $data['datetime'] . '</td>
					<td>' . $log . '</td>
					<td>' . $data['log_key'] . '</td>
				</tr>';
			}
			$form .= '</table>';
		} else {
			$form = '<div class="nodata">' . __( 'There are no log data.', 'usces' ) . '</div>';
		}

		$res           = array();
		$res['status'] = 'OK';
		$res['result'] = $form;
		$res['nodata'] = ( ! $log_data ) ? 'nodata' : '';
		wp_send_json( $res );
	}

	/**
	 * Delete stock update log.
	 */
	public function delete_log() {
		global $wpdb;

		$wpdb->query( "DELETE FROM {$wpdb->prefix}usces_log WHERE `log_type` = 'nextengine'" );

		$res = $this->get_log();
		wp_send_json( $res );
	}
}
