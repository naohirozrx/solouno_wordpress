<?php
/**
 * Plugin Name: WCEX Multi Price
 * Plugin URI: https://www.welcart.com/
 * Description: This plug-in is an extension plug-in dedicated to Welcart. Please use in conjunction with the Welcart e-Commerce.
 * Version: 1.3.1
 * Author: Collne Inc.
 * Author URI: https://www.welcart.com/
 * Text Domain: multiprice
 * Domain Path: /languages/
 *
 * @package WCEX Multi Price
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! defined( 'USCES_EX_PLUGIN' ) ) {
	define( 'USCES_EX_PLUGIN', 1 );
}
define( 'WCEX_MULTIPRICE', true );
define( 'WCEX_MULTIPRICE_VERSION', '1.3.1.2209151' );
define( 'WCEX_MULTIPRICE_BASENAME', plugin_basename( dirname( __FILE__ ) ) );
define( 'WCEX_MULTIPRICE_URL', plugins_url() . '/' . WCEX_MULTIPRICE_BASENAME );
define( 'WCEX_MULTIPRICE_DIR', WP_PLUGIN_DIR . '/' . WCEX_MULTIPRICE_BASENAME );

if ( defined( 'USCES_VERSION' ) ) :
	load_plugin_textdomain( 'multiprice', false, WCEX_MULTIPRICE_BASENAME . '/languages' );

	$wcmp_usces_ver = ( version_compare( USCES_VERSION, '1.1-bata', '>=' ) ) ? 1 : 0;
	if ( 1 === $wcmp_usces_ver ) {
		$wcmp_cart_number = (int) get_option( 'usces_cart_number' );
		$wcmp_opts        = usces_get_opts( $wcmp_cart_number, 'name' );
	}

	add_action( 'admin_print_styles', 'wcex_multiprice_admin_styles' );
	add_action( 'admin_enqueue_scripts', 'wcex_multiprice_admin_scripts' );
	add_action( 'admin_menu', 'wcex_multiprice_admin_menu', 10 );
	add_action( 'wp_ajax_wcex_multiprice_get_option_value', 'wcex_multiprice_get_option_value' );

	global $usces;
	if ( 0 == $usces->use_js ) {
		add_filter( 'usces_filter_incart_check', 'wcex_multiprice_usces_filter_incart_check', 10, 3 );
	} else {
		add_filter( 'usces_filter_inCart_js_check', 'wcex_multiprice_usces_filter_inCart_js_check', 10 );
		if ( defined( 'WCEX_DLSELLER' ) ) {
			add_filter( 'dlseller_filter_regular_js_check', 'wcex_multiprice_dlseller_filter_regular_js_check', 10, 6 );
		}
	}
	if ( version_compare( USCES_VERSION, '1.0.6', '<=' ) ) {
		add_filter( 'usces_filter_inCart_price', 'wcex_multiprice_usces_filter_inCart_price', 10, 2 );
		add_filter( 'usces_filter_upCart_price', 'wcex_multiprice_usces_filter_upCart_price', 10, 3 );
	} else {
		add_filter( 'usces_filter_realprice', 'wcex_multiprice_usces_filter_realprice', 10, 2 );
	}
	add_filter( 'usces_filter_add_ordercart_sku', 'wcex_multiprice_usces_filter_add_ordercart_sku', 10, 2 );
endif;

/**
 * Admin style.
 * admin_print_styles
 */
function wcex_multiprice_admin_styles() {
	if ( isset( $_REQUEST['page'] ) && 'wcex_multiprice' == wp_unslash( $_REQUEST['page'] ) ) { // phpcs:ignore
		wp_enqueue_style( 'wcex_multiprice_style', WCEX_MULTIPRICE_URL . '/css/wcex_multiprice.css', array(), WCEX_MULTIPRICE_VERSION );
	}
}

/**
 * Admin script.
 * admin_enqueue_scripts
 */
function wcex_multiprice_admin_scripts() {
	if ( isset( $_REQUEST['page'] ) && 'wcex_multiprice' == wp_unslash( $_REQUEST['page'] ) ) { // phpcs:ignore
		wp_enqueue_script( 'jquery-ui-tabs', array( 'jquery-ui-core' ) ); // phpcs:ignore
		wp_enqueue_script( 'jquery-cookie-script', WCEX_MULTIPRICE_URL . '/js/jquery.cookie.js', array( 'jquery' ), WCEX_MULTIPRICE_VERSION );
		wp_enqueue_script( 'wcex_multiprice_js', WCEX_MULTIPRICE_URL . '/js/wcex_multiprice.js', array( 'jquery' ), WCEX_MULTIPRICE_VERSION );
	}
}

/**
 * Admin menu.
 * admin_menu
 */
function wcex_multiprice_admin_menu() {
	add_submenu_page( USCES_PLUGIN_BASENAME, __( 'Multi Price', 'multiprice' ), __( 'Multi Price', 'multiprice' ), 'level_5', 'wcex_multiprice', 'wcex_multiprice_page' );
}

/**
 * Get option.
 *
 * @param  string $name Option name.
 * @param  int    $id Option ID.
 * @return array
 */
function wcex_multiprice_get_option( $name, $id ) {
	global $wcmp_opts;
	$opt = ( isset( $wcmp_opts[ $name ] ) ) ? $wcmp_opts[ $name ] : array();

	return $opt;
}

/**
 * Get option from ajax.
 */
function wcex_multiprice_get_option_value() {
	global $usces;

	$sts           = 0;
	$msg           = '';
	$option1_value = '';
	$option2_value = '';

	$cart_number = wp_unslash( $_POST['cart_number'] ); // phpcs:ignore
	if ( ! empty( $_POST['key1'] ) && '#NONE#' != wp_unslash( $_POST['key1'] ) ) { // phpcs:ignore
		$opt          = wcex_multiprice_get_option( wp_unslash( $_POST['key1'] ), $cart_number ); // phpcs:ignore
		$opt['value'] = wcex_change_line_break( $opt['value'] );
		$c            = '';
		$selects      = explode( "\n", $opt['value'] );
		foreach ( $selects as $v ) {
			$option1_value .= $c . esc_js( addslashes( $v ) );
			$c              = '#;#';
		}
		$option1_value = trim( $option1_value, '#;#' );
	}
	if ( ! empty( $_POST['key2'] ) && '#NONE#' != wp_unslash( $_POST['key2'] ) ) { // phpcs:ignore
		$opt          = wcex_multiprice_get_option( wp_unslash( $_POST['key2'] ), $cart_number ); // phpcs:ignore
		$opt['value'] = wcex_change_line_break( $opt['value'] );
		$c            = '';
		$selects      = explode( "\n", $opt['value'] );
		foreach ( $selects as $v ) {
			$option2_value .= $c . esc_js( addslashes( $v ) );
			$c              = '#;#';
		}
		$option2_value = trim( $option2_value, '#;#' );
	}

	$res = array(
		'sts'           => $sts,
		'msg'           => $msg,
		'option1_value' => $option1_value,
		'option2_value' => $option2_value,
	);
	wp_send_json( $res );
}

/**
 * Admin page.
 */
function wcex_multiprice_page() {
	global $usces, $wcmp_usces_ver;

	$cart_number     = (int) get_option( 'usces_cart_number' );
	$wcex_multiprice = unserialize( get_option( 'wcex_multiprice' ) );

	/* Initial value setting */
	if ( empty( $wcex_multiprice ) ) {
		$initid                                  = 'price1';
		$wcex_multiprice                         = array();
		$wcex_multiprice[ $initid ]['name']      = '';
		$wcex_multiprice[ $initid ]['type']      = 'add';
		$wcex_multiprice[ $initid ]['dimension'] = 1;
		$wcex_multiprice[ $initid ]['option1']   = '#NONE#';
		$wcex_multiprice[ $initid ]['option2']   = '#NONE#';
		$wcex_multiprice[ $initid ]['price']     = array();
		update_option( 'wcex_multiprice', serialize( $wcex_multiprice ) );

	/* Update */
	} elseif ( isset( $_POST['wcex_multiprice_update'] ) ) {
		check_admin_referer( 'wcex_multiprice', 'wc_nonce' );
		$updid      = wp_unslash( $_POST['wcex_multiprice_id'][0] );
		// $dimension  = $_POST[ 'wcex_multiprice_dimension_' . $updid ];
		$name       = sanitize_text_field( wp_unslash( $_POST[ 'wcex_multiprice_name_' . $updid ] ) );
		$option1    = wp_unslash( $_POST[ 'wcex_multiprice_option1_' . $updid ] );
		$option2    = wp_unslash( $_POST[ 'wcex_multiprice_option2_' . $updid ] );
		$price_key1 = isset( $_POST[ $updid . '_key1' ] ) ? wp_unslash( $_POST[ $updid . '_key1' ] ) : array();
		$price_key2 = isset( $_POST[ $updid . '_key2' ] ) ? wp_unslash( $_POST[ $updid . '_key2' ] ) : array();
		$price_val  = isset( $_POST[ $updid . '_val' ] ) ? wp_unslash( $_POST[ $updid . '_val' ] ) : array();
		$price      = array();

		/* [Option1] */
		if ( ! empty( $option1 ) && '#NONE#' != $option1 ) {
			$opt    = wcex_multiprice_get_option( $option1, $cart_number );
			$means1 = (int) $opt['means'];
			$value1 = ( 0 == $means1 ) ? $opt['value'] : '';
		} else {
			$means1 = -1;
			$value1 = '';
		}

		/* [Option2] */
		if ( ! empty( $option2 ) && '#NONE#' != $option2 ) {
			$opt    = wcex_multiprice_get_option( $option2, $cart_number );
			$means2 = (int) $opt['means'];
			$value2 = ( 0 == $means2 ) ? $opt['value'] : '';
		} else {
			$means2 = -1;
			$value2 = '';
		}
		$value1 = wcex_change_line_break( $value1 );
		$value2 = wcex_change_line_break( $value2 );

		if ( 0 == $means1 ) {
			if ( 0 == $means2 ) { /* [Option1]:Single-select, [Option2]:Single-select */
				$selects1 = explode( "\n", $value1 );
				$selects2 = explode( "\n", $value2 );
				$i        = 0;
				foreach ( $selects1 as $v1 ) {
					$j = 0;
					foreach ( $selects2 as $v2 ) {
						$price[ $v1 ][ $v2 ] = (int) $price_val[ $i ][ $j ];
						$j++;
					}
					$i++;
				}
				$dimension = 2;
			} elseif ( 2 == $means2 ) { /* [Option1]:Single-select, [Option2]:Text */
				$selects1 = explode( "\n", $value1 );
				$i        = 0;
				foreach ( $selects1 as $v1 ) {
					$j = 0;
					foreach ( (array) $price_key2 as $key2 ) {
						$key2                  = ( '' != $key2 ) ? (int) $key2 : 'max';
						$price[ $v1 ][ $key2 ] = (int) $price_val[ $i ][ $j ];
						$j++;
					}
					$i++;
				}
				$dimension = 2;
			} else { /* [Option1]:Single-select Only. */
				$selects1 = explode( "\n", $value1 );
				$i        = 0;
				foreach ( $selects1 as $v1 ) {
					$price[ $v1 ] = (int) $price_val[ $i ][0];
					$i++;
				}
				$dimension = 1;
			}
		} elseif ( 2 == $means1 ) {
			if ( 0 == $means2 ) { /* [Option1]:Text, [Option2]:Single-select */
				$selects2 = explode( "\n", $value2 );
				$i        = 0;
				foreach ( (array) $price_key1 as $key1 ) {
					$j = 0;
					foreach ( $selects2 as $v2 ) {
						$key1                  = ( '' != $key1 ) ? (int) $key1 : 'max';
						$price[ $key1 ][ $v2 ] = (int) $price_val[ $i ][ $j ];
						$j++;
					}
					$i++;
				}
				$dimension = 2;
			} elseif ( 2 == $means2 ) { /* [Option1]:Text, [Option2]:Text */
				$i = 0;
				foreach ( (array) $price_key1 as $key1 ) {
					$key1 = ( '' != $key1 ) ? (int) $key1 : 'max';
					$j    = 0;
					foreach ( (array) $price_key2 as $key2 ) {
						$key2                    = ( '' != $key2 ) ? (int) $key2 : 'max';
						$price[ $key1 ][ $key2 ] = (int) $price_val[ $i ][ $j ];
						$j++;
					}
					$i++;
				}
				$dimension = 2;
			} else { /* [Option1]:Text Only. */
				$i = 0;
				foreach ( (array) $price_key1 as $key1 ) {
					$key1           = ( '' != $key1 ) ? (int) $key1 : 'max';
					$price[ $key1 ] = (int) $price_val[ $i ][0];
					$i++;
				}
				$dimension = 1;
			}
		}

		$wcex_multiprice[ $updid ]['name']      = $name;
		$wcex_multiprice[ $updid ]['dimension'] = $dimension;
		$wcex_multiprice[ $updid ]['option1']   = $option1;
		$wcex_multiprice[ $updid ]['option2']   = $option2;
		$wcex_multiprice[ $updid ]['price']     = $price;

		update_option( 'wcex_multiprice', serialize( $wcex_multiprice ) );
		$rule_name             = ( ! empty( $name ) ) ? $name : __( 'Rule', 'multiprice' ) . str_replace( 'price', '', $updid );
		$usces->action_status  = 'success';
		$usces->action_message = sprintf( __( '%s updated.', 'multiprice' ), $rule_name );

	/* Add new */
	} elseif ( isset( $_POST['wcex_multiprice_add'] ) ) {
		check_admin_referer( 'wcex_multiprice', 'wc_nonce' );
		// if ( ! empty( $wcex_multiprice['price1']['price'] ) ) {
		$newidnum = 1;
		foreach ( (array) $wcex_multiprice as $mpid => $value ) {
			$idnum = (int) substr( $mpid, 5 );
			if ( $newidnum < $idnum ) {
				$newidnum = $idnum;
			}
		}
		$newidnum++;
		$newid = 'price' . $newidnum;

		$wcex_multiprice[ $newid ]['type']      = 'add';
		$wcex_multiprice[ $newid ]['name']      = '';
		$wcex_multiprice[ $newid ]['dimension'] = 1;
		$wcex_multiprice[ $newid ]['option1']   = '#NONE#';
		$wcex_multiprice[ $newid ]['option2']   = '#NONE#';
		$wcex_multiprice[ $newid ]['price']     = array();

		update_option( 'wcex_multiprice', serialize( $wcex_multiprice ) );
		$usces->action_status  = 'success';
		$usces->action_message = __( 'Added a new price list.', 'multiprice' );
		// }

	/* Delete */
	} elseif ( isset( $_POST['wcex_multiprice_delete'] ) ) {
		check_admin_referer( 'wcex_multiprice', 'wc_nonce' );
		$delid     = wp_unslash( $_POST['wcex_multiprice_id'][0] );
		$rule_name = ( ! empty( $wcex_multiprice[ $delid ]['name'] ) ) ? $wcex_multiprice[ $delid ]['name'] : __( 'Rule', 'multiprice' ) . str_replace( 'price', '', $delid );

		unset( $wcex_multiprice[ $delid ] );
		if ( empty( $wcex_multiprice ) ) {
			$initid                                  = 'price1';
			$wcex_multiprice                         = array();
			$wcex_multiprice[ $initid ]['type']      = 'add';
			$wcex_multiprice[ $initid ]['name']      = '';
			$wcex_multiprice[ $initid ]['dimension'] = 1;
			$wcex_multiprice[ $initid ]['option1']   = '#NONE#';
			$wcex_multiprice[ $initid ]['option2']   = '#NONE#';
			$wcex_multiprice[ $initid ]['price']     = array();
		}
		update_option( 'wcex_multiprice', serialize( $wcex_multiprice ) );
		$usces->action_status  = 'success';
		$usces->action_message = sprintf( __( '%s deleted.', 'multiprice' ), $rule_name );

	/* Cancel */
	} elseif ( isset( $_POST['wcex_multiprice_cancel'] ) ) {
		/* There's no processing. */
	}

	/* Common Options */
	$options      = array();
	$option_means = "'',";
	$i            = 0;
	$c            = '';

	global $wcmp_opts;
	foreach ( (array) $wcmp_opts as $key => $opt ) {
		if ( in_array( $opt['means'], array( 0, 2, 3 ) ) ) {
			$options[ $i ]['key']   = $key;
			$options[ $i ]['means'] = $opt['means'];
			$option_means          .= $c . "'{$opt['means']}'";
			$i++;
			$c = ',';
		}
	}

	if ( empty( $usces->action_message ) || '' == $usces->action_message ) {
		$usces->action_status  = 'none';
		$usces->action_message = '';
	}

	require( USCES_WP_PLUGIN_DIR . '/' . WCEX_MULTIPRICE_BASENAME . '/wcex_multiprice_admin_page.php' );
}

/**
 * Check Add to Cart.
 * usces_filter_inCart_js_check
 *
 * @param int $post_id Post ID.
 */
function wcex_multiprice_usces_filter_inCart_js_check( $post_id ) { // phpcs:ignore
	global $usces, $wcmp_usces_ver;
	$usces_itemopts = array();
	$script         = '';

	if ( 1 === $wcmp_usces_ver ) {
		$usces_itemopts = usces_get_opts( $post_id, 'name' );
	} else {
		$fields = get_post_custom( $post_id );
		foreach ( $fields as $key => $value ) {
			if ( preg_match( '/^_iopt_/', $key, $match ) ) {
				$opt_key                    = substr( $key, 6 );
				$usces_itemopts[ $opt_key ] = maybe_unserialize( $value[0] );
			}
		}
	}

	$wcex_multiprice = unserialize( get_option( 'wcex_multiprice' ) );

	if ( ! empty( $wcex_multiprice ) && ! empty( $usces_itemopts ) ) {
		ob_start();
		foreach ( (array) $wcex_multiprice as $mpid => $value ) {
			$dimension = $value['dimension'];
			$option1   = $value['option1'];
			$option2   = ( ! empty( $value['option2'] ) ) ? $value['option2'] : '';
			$price     = $value['price'];
			$max_key1  = 0;
			$max_key2  = 0;

			$means1     = -1;
			$essential1 = -1;
			$means2     = -1;
			$essential2 = -1;

			foreach ( (array) $usces_itemopts as $itemkey => $itemopts ) {
				if ( $option1 === $itemkey ) {
					$opt        = wcex_multiprice_get_option( $option1, $post_id );
					$means1     = (int) $opt['means'];
					$essential1 = (int) $opt['essential'];
				}
				if ( 2 == $dimension && $option2 === $itemkey ) {
					$opt        = wcex_multiprice_get_option( $option2, $post_id );
					$means2     = (int) $opt['means'];
					$essential2 = (int) $opt['essential'];
				}
			}

			if ( 2 == $dimension ) {
				if ( 0 == $means1 ) {
					if ( 2 == $means2 ) { /* [Option1]:Single-select, [Option2]:Text */
						$key1 = array_keys( $price );
						foreach ( $price[ $key1[0] ] as $y_key => $y_val ) {
							if ( 'max' === (string) $y_key ) {
								$max_key2 = 0;
							} else {
								$max_key2 = (int) $y_key;
							}
						}
					}
				} elseif ( 2 == $means1 ) {
					if ( 0 == $means2 ) { /* [Option1]:Text, [Option2]:Single-select */
						foreach ( $price as $x_key => $x_val ) {
							if ( 'max' === (string) $x_key ) {
								$max_key1 = 0;
							} else {
								$max_key1 = (int) $x_key;
							}
						}
					} elseif ( 2 == $means2 ) { /* [Option1]:Text, [Option2]:Text */
						foreach ( $price as $x_key => $x_val ) {
							if ( 'max' === (string) $x_key ) {
								$max_key1 = 0;
								foreach ( $price[ $x_key ] as $y_key => $y_val ) {
									if ( 'max' === (string) $y_key ) {
										$max_key2 = 0;
									} else {
										$max_key2 = (int) $y_key;
									}
								}
								break;
							} else {
								$max_key1 = (int) $x_key;
								foreach ( $price[ $x_key ] as $y_key => $y_val ) {
									if ( 'max' === (string) $y_key ) {
										$max_key2 = 0;
									} else {
										$max_key2 = (int) $y_key;
									}
								}
							}
						}
					}
				}
			} else {
				if ( 2 == $means1 ) { /* [Option1]:Text Only. */
					foreach ( $price as $x_key => $x_val ) {
						if ( 'max' === (string) $x_key ) {
							$max_key1 = 0;
						} else {
							$max_key1 = (int) $x_key;
						}
					}
				}
			}

			if ( 2 == $means1 ) {
				$option1_name = ( 1 === $wcmp_usces_ver ) ? urlencode( $option1 ) : $option1;
				echo 'var skuob1 = document.getElementById("itemOption["+post_id+"]["+sku+"][' . $option1_name . ']");' . "\n";
				if ( 0 === $essential1 ) {
					echo 'if ( skuob1.value != "" ) {' . "\n";
				}
				echo 'if ( skuob1.value.match(/[^0-9]/g) ) {
					mes += "' . sprintf( __( 'Please enter %s using half-byte numbers.', 'multiprice' ), $option1 ) . '"+"\n";
				}' . "\n";
				if ( $max_key1 > 0 ) {
					echo 'if ( skuob1.value > ' . $max_key1 . ' ) {
						mes += "' . sprintf( __( 'It exceeds the maximum value(%2$s) of %1$s.', 'multiprice' ), $option1, $max_key1 ) . '"+"\n";
					}' . "\n";
				}
				if ( 0 === $essential1 ) {
					echo '}' . "\n";
				}
			}
			if ( 2 == $means2 ) {
				$option2_name = ( 1 === $wcmp_usces_ver ) ? urlencode( $option2 ) : $option2;
				echo 'var skuob2 = document.getElementById("itemOption["+post_id+"]["+sku+"][' . $option2_name . ']");' . "\n";
				if ( 0 === $essential2 ) {
					echo 'if ( skuob2.value != "" ) {' . "\n";
				}
				echo 'if ( skuob2.value.match(/[^0-9]/g) ) {
					mes += "' . sprintf( __( 'Please enter %s using half-byte numbers.', 'multiprice' ), $option2 ) . '"+"\n";
				}' . "\n";
				if ( $max_key2 > 0 ) {
					echo 'if ( skuob2.value > ' . $max_key2 . ' ) {
						mes += "' . sprintf( __( 'It exceeds the maximum value(%2$s) of %1$s.', 'multiprice' ), $option2, $max_key2 ) . '"+"\n";
					}' . "\n";
				}
				if ( 0 === $essential2 ) {
					echo '}' . "\n";
				}
			}

			if ( 0 <= $means1 ) {
				break;
			}
		}
		$script = ob_get_contents();
		ob_end_clean();
	}

	echo $script; // phpcs:ignore
}

/**
 * Check Add to Cart.
 * dlseller_filter_regular_js_check
 */
function wcex_multiprice_dlseller_filter_regular_js_check() {
	global $usces, $wcmp_usces_ver;
	$args           = func_get_args();
	$post_id        = $args[1];
	$usces_itemopts = array();
	$script         = '';

	if ( 1 === $wcmp_usces_ver ) {
		$usces_itemopts = usces_get_opts( $post_id, 'name' );
	} else {
		$fields = get_post_custom( $post_id );
		foreach ( $fields as $key => $value ) {
			if ( preg_match( '/^_iopt_/', $key, $match ) ) {
				$opt_key                    = substr( $key, 6 );
				$usces_itemopts[ $opt_key ] = maybe_unserialize( $value[0] );
			}
		}
	}

	$wcex_multiprice = unserialize( get_option( 'wcex_multiprice' ) );

	if ( ! empty( $wcex_multiprice ) && ! empty( $usces_itemopts ) ) {
		ob_start();
		foreach ( (array) $wcex_multiprice as $mpid => $value ) {
			$dimension = $value['dimension'];
			$option1   = $value['option1'];
			$option2   = ( ! empty( $value['option2'] ) ) ? $value['option2'] : '';
			$price     = $value['price'];
			$max_key1  = 0;
			$max_key2  = 0;

			$means1     = -1;
			$essential1 = -1;
			$means2     = -1;
			$essential2 = -1;

			foreach ( (array) $usces_itemopts as $itemkey => $itemopts ) {
				if ( $option1 === $itemkey ) {
					$opt        = wcex_multiprice_get_option( $option1, $post_id );
					$means1     = (int) $opt['means'];
					$essential1 = (int) $opt['essential'];
				}
				if ( 2 == $dimension && $option2 === $itemkey ) {
					$opt        = wcex_multiprice_get_option( $option2, $post_id );
					$means2     = (int) $opt['means'];
					$essential2 = (int) $opt['essential'];
				}
			}

			if ( 2 == $dimension ) {
				if ( 0 == $means1 ) {
					if ( 2 == $means2 ) { /* [Option1]:Single-select, [Option2]:Text */
						$key1 = array_keys( $price );
						foreach ( $price[ $key1[0] ] as $y_key => $y_val ) {
							if ( 'max' === (string) $y_key ) {
								$max_key2 = 0;
							} else {
								$max_key2 = (int) $y_key;
							}
						}
					}
				} elseif ( 2 == $means1 ) {
					if ( 0 == $means2 ) { /* [Option1]:Text, [Option2]:Single-select */
						foreach ( $price as $x_key => $x_val ) {
							if ( 'max' === (string) $x_key ) {
								$max_key1 = 0;
							} else {
								$max_key1 = (int) $x_key;
							}
						}
					} elseif ( 2 == $means2 ) { /* [Option1]:Text, [Option2]:Text */
						foreach ( $price as $x_key => $x_val ) {
							if ( 'max' === (string) $x_key ) {
								$max_key1 = 0;
								foreach ( $price[ $x_key ] as $y_key => $y_val ) {
									if ( 'max' === (string) $y_key ) {
										$max_key2 = 0;
									} else {
										$max_key2 = (int) $y_key;
									}
								}
								break;
							} else {
								$max_key1 = (int) $x_key;
								foreach ( $price[ $x_key ] as $y_key => $y_val ) {
									if ( 'max' === (string) $y_key ) {
										$max_key2 = 0;
									} else {
										$max_key2 = (int) $y_key;
									}
								}
							}
						}
					}
				}
			} else {
				if ( 2 == $means1 ) { /* [Option1]:Text Only. */
					foreach ( $price as $x_key => $x_val ) {
						if ( 'max' === (string) $x_key ) {
							$max_key1 = 0;
						} else {
							$max_key1 = (int) $x_key;
						}
					}
				}
			}

			if ( 2 == $means1 ) {
				$option1_name = ( 1 === $wcmp_usces_ver ) ? urlencode( $option1 ) : $option1;
				echo 'var skuob1 = document.getElementById("itemOption_regular["+post_id+"]["+sku+"][' . esc_html( $option1_name ) . ']");' . "\n";
				if ( 0 === $essential1 ) {
					echo 'if ( skuob1.value != "" ) {' . "\n";
				}
				echo 'if ( skuob1.value.match(/[^0-9]/g) ) {
					mes += "' . sprintf( __( 'Please enter %s using half-byte numbers.', 'multiprice' ), $option1 ) . '"+"\n";
				}' . "\n";
				if ( $max_key1 > 0 ) {
					echo 'if ( skuob1.value > ' . $max_key1 . ' ) {
						mes += "' . sprintf( __( 'It exceeds the maximum value(%2$s) of %1$s.', 'multiprice' ), $option1, $max_key1 ) . '"+"\n";
					}' . "\n";
				}
				if ( 0 === $essential1 ) {
					echo '}' . "\n";
				}
			}
			if ( 2 == $means2 ) {
				$option2_name = ( 1 === $wcmp_usces_ver ) ? urlencode( $option2 ) : $option2;
				echo 'var skuob2 = document.getElementById("itemOption_regular["+post_id+"]["+sku+"][' . esc_html( $option2_name ) . ']");' . "\n";
				if ( 0 === $essential2 ) {
					echo 'if ( skuob2.value != "" ) {' . "\n";
				}
				echo 'if ( skuob2.value.match(/[^0-9]/g) ) {
					mes += "' . sprintf( __( 'Please enter %s using half-byte numbers.', 'multiprice' ), $option2 ) . '"+"\n";
				}' . "\n";
				if ( $max_key2 > 0 ) {
					echo 'if ( skuob2.value > ' . $max_key2 . ' ) {
						mes += "' . sprintf( __( 'It exceeds the maximum value(%2$s) of %1$s.', 'multiprice' ), $option2, $max_key2 ) . '"+"\n";
					}' . "\n";
				}
				if ( 0 === $essential2 ) {
					echo '}' . "\n";
				}
			}

			if ( $means1 >= 0 ) {
				break;
			}
		}
		$script = ob_get_contents();
		ob_end_clean();
	}

	return $script;
}

/**
 * Check Add to Cart.
 * usces_filter_incart_check
 *
 * @param  string $mes Message.
 * @param  int    $post_id Post ID.
 * @param  string $sku SKU code.
 * @return string
 */
function wcex_multiprice_usces_filter_incart_check( $mes, $post_id, $sku ) {
	global $usces, $wcmp_usces_ver;
	$usces_itemopts = array();

	if ( 1 === $wcmp_usces_ver ) {
		$usces_itemopts = usces_get_opts( $post_id, 'name' );
	} else {
		$fields = get_post_custom( $post_id );
		foreach ( $fields as $key => $value ) {
			if ( preg_match( '/^_iopt_/', $key, $match ) ) {
				$opt_key                    = substr( $key, 6 );
				$usces_itemopts[ $opt_key ] = maybe_unserialize( $value[0] );
			}
		}
	}

	$wcex_multiprice = unserialize( get_option( 'wcex_multiprice' ) );

	if ( ! empty( $wcex_multiprice ) && ! empty( $usces_itemopts ) ) {
		foreach ( (array) $wcex_multiprice as $mpid => $value ) {
			$dimension = $value['dimension'];
			$option1   = $value['option1'];
			$option2   = ( ! empty( $value['option2'] ) ) ? $value['option2'] : '';
			$price     = $value['price'];
			$max_key1  = 0;
			$max_key2  = 0;

			$means1     = -1;
			$essential1 = -1;
			$means2     = -1;
			$essential2 = -1;

			foreach ( (array) $usces_itemopts as $itemkey => $itemopts ) {
				if ( $option1 === $itemkey ) {
					$opt        = wcex_multiprice_get_option( $option1, $post_id );
					$means1     = (int) $opt['means'];
					$essential1 = (int) $opt['essential'];
				}
				if ( 2 == $dimension && $option2 === $itemkey ) {
					$opt        = wcex_multiprice_get_option( $option2, $post_id );
					$means2     = (int) $opt['means'];
					$essential2 = (int) $opt['essential'];
				}
			}

			if ( 2 == $dimension ) {
				if ( 0 == $means1 ) {
					if ( 2 == $means2 ) { /* [Option1]:Single-select, [Option2]:Text */
						$key1 = array_keys( $price );
						foreach ( $price[ $key1[0] ] as $y_key => $y_val ) {
							if ( 'max' === (string) $y_key ) {
								$max_key2 = 0;
							} else {
								$max_key2 = (int) $y_key;
							}
						}
					}
				} elseif ( 2 == $means1 ) {
					if ( 0 == $means2 ) { /* [Option1]:Text, [Option2]:Single-select */
						foreach ( $price as $x_key => $x_val ) {
							if ( 'max' === (string) $x_key ) {
								$max_key1 = 0;
							} else {
								$max_key1 = (int) $x_key;
							}
						}
					} elseif ( 2 == $means2 ) { /* [Option1]:Text, [Option2]:Text */
						foreach ( $price as $x_key => $x_val ) {
							if ( 'max' === (string) $x_key ) {
								$max_key1 = 0;
								foreach ( $price[ $x_key ] as $y_key => $y_val ) {
									if ( 'max' === (string) $y_key ) {
										$max_key2 = 0;
									} else {
										$max_key2 = (int) $y_key;
									}
								}
								break;
							} else {
								$max_key1 = (int) $x_key;
								foreach ( $price[ $x_key ] as $y_key => $y_val ) {
									if ( 'max' === (string) $y_key ) {
										$max_key2 = 0;
									} else {
										$max_key2 = (int) $y_key;
									}
								}
							}
						}
					}
				}
			} else {
				if ( 2 == $means1 ) { /* [Option1]:Text Only. */
					foreach ( $price as $x_key => $x_val ) {
						if ( 'max' === (string) $x_key ) {
							$max_key1 = 0;
						} else {
							$max_key1 = (int) $x_key;
						}
					}
				}
			}

			if ( 2 == $means1 ) {
				$option1_name  = ( 1 === $wcmp_usces_ver ) ? urlencode( $option1 ) : $option1;
				$option1_value = ( isset( $_POST['itemOption'][ $post_id ][ $sku ][ $option1_name ] ) ) ? sanitize_text_field( wp_unslash( $_POST['itemOption'][ $post_id ][ $sku ][ $option1_name ] ) ) : ''; // phpcs:ignore
				if ( '' != $option1_value ) {
					if ( ! preg_match( '/^[0-9]+$/', $option1_value ) ) {
						$mes[ $post_id ][ $sku ] = sprintf( __( 'Please enter %s using half-byte numbers.', 'multiprice' ), $option1 ) . '<br />'; // phpcs:ignore
					} elseif ( $max_key1 > 0 ) {
						if ( (int) $option1_value > $max_key1 ) {
							$mes[ $post_id ][ $sku ] = sprintf( __( 'It exceeds the maximum value(%2$s) of %1$s.', 'multiprice' ), $option1, $max_key1 ) . '<br />'; // phpcs:ignore
						}
					}
				}
			}
			if ( 2 == $means2 ) {
				$option2_name  = ( 1 === $wcmp_usces_ver ) ? urlencode( $option2 ) : $option2;
				$option2_value = ( isset( $_POST['itemOption'][ $post_id ][ $sku ][ $option2_name ] ) ) ? sanitize_text_field( wp_unslash( $_POST['itemOption'][ $post_id ][ $sku ][ $option2_name ] ) ) : ''; // phpcs:ignore
				if ( '' != $option2_value ) {
					if ( ! preg_match( '/^[0-9]+$/', $option2_value ) ) {
						$mes[ $post_id ][ $sku ] = sprintf( __( 'Please enter %s using half-byte numbers.', 'multiprice' ), $option2 ) . '<br />'; // phpcs:ignore
					} elseif ( $max_key2 > 0 ) {
						if ( (int) $option2_value > $max_key2 ) {
							$mes[ $post_id ][ $sku ] = sprintf( __( 'It exceeds the maximum value(%2$s) of %1$s.', 'multiprice' ), $option2, $max_key2 ) . '<br />'; // phpcs:ignore
						}
					}
				}
			}

			if ( $means1 >= 0 ) {
				break;
			}
		}
	}

	return $mes;
}

/**
 * Add to cart.
 * usces_filter_inCart_price
 *
 * @param  float $price Selling price.
 * @param  array $serial Cart data.
 * @return float
 */
function wcex_multiprice_usces_filter_inCart_price( $price, $serial ) { // phpcs:ignore
	global $usces;

	$cart    = $usces->cart->key_unserialize( $serial );
	$post_id = $cart['post_id'];
	$sku     = $cart['sku'];
	$quant   = $cart['quantity'];
	$skus    = $usces->get_skus( $post_id, 'ARRAY_A' );
	$price   = wcex_multiprice_get_price( $skus[ $sku ]['price'], $serial );

	return $usces->cart->get_realprice( $post_id, $sku, $quant, $price );
}

/**
 * Update cart.
 * usces_filter_upCart_price
 *
 * @param  float $price Selling price.
 * @param  array $serial Cart data.
 * @param  int   $index Cart index.
 * @return float
 */
function wcex_multiprice_usces_filter_upCart_price( $price, $serial, $index ) { // phpcs:ignore
	global $usces;

	$cart    = $usces->cart->key_unserialize( $serial );
	$post_id = $cart['post_id'];
	$sku     = $cart['sku'];
	$quant   = $cart['quantity'];
	$skus    = $usces->get_skus( $post_id, 'ARRAY_A' );
	$price   = wcex_multiprice_get_price( $skus[ $sku ]['price'], $serial );

	return $usces->cart->get_realprice( $post_id, $sku, $quant, $price );
}

/**
 * Change Price.
 * usces_filter_realprice
 *
 * @param  float $price Selling price.
 * @param  array $serial Cart data.
 * @return float
 */
function wcex_multiprice_usces_filter_realprice( $price, $serial ) {
	return wcex_multiprice_get_price( $price, $serial );
}

/**
 * Order edit form.
 * usces_filter_add_ordercart_sku
 *
 * @param  array $sku SKU data.
 * @param  array $post_data POST data.
 * @return array
 */
function wcex_multiprice_usces_filter_add_ordercart_sku( $sku, $post_data ) {
	$options = array();
	if ( ! empty( $post_data['itemOption'] ) ) {
		foreach ( (array) $post_data['itemOption'] as $key => $value ) {
			$options[ urlencode( $key ) ] = urlencode( $value );
		}
	}

	$cart         = array(
		'post_id'  => $post_data['post_id'],
		'sku'      => $post_data['sku'],
		'quantity' => 1,
		'options'  => $options,
	);
	$sku['price'] = wcex_multiprice_get_price( $sku['price'], null, $cart );
	return $sku;
}

/**
 * Price calculation.
 *
 * @param  float $org_price Selling price.
 * @param  array $serial Cart data.
 * @param  array $cart Cart data.
 * @return float
 */
function wcex_multiprice_get_price( $org_price, $serial, $cart = array() ) {
	global $usces, $wcmp_usces_ver;
	if ( empty( $cart ) ) {
		$cart = $usces->cart->key_unserialize( $serial );
	}
	$post_id   = $cart['post_id'];
	$sku       = $cart['sku'];
	$quant     = $cart['quantity'];
	$options   = $cart['options'];
	$total_add = 0;

	if ( ! empty( $options ) ) {
		$wcex_multiprice = unserialize( get_option( 'wcex_multiprice' ) );
		foreach ( (array) $wcex_multiprice as $mpid => $value ) {
			$dimension = $value['dimension'];
			$option1   = $value['option1'];
			$option2   = ( ! empty( $value['option2'] ) ) ? $value['option2'] : '';
			$price     = $value['price'];
			$add_price = 0;

			/* [Option1] */
			$opt = wcex_multiprice_get_option( $option1, $post_id );
			if ( empty( $opt ) ) {
				continue;
			}
			$means1 = (int) $opt['means'];
			if ( 1 === $wcmp_usces_ver ) {
				if ( isset( $options[ urlencode( $option1 ) ] ) ) {
					if ( is_array( $options[ urlencode( $option1 ) ] ) ) {
						$option1_value = urldecode( array_values( $options[ urlencode( $option1 ) ] )[0] );
					} else {
						$option1_value = urldecode( $options[ urlencode( $option1 ) ] );
					}
				} else {
					if ( isset( $options[ $option1 ] ) ) {
						$option1_value = urldecode( $options[ $option1 ] );
					} else {
						$option1_value = '';
					}
				}
			} else {
				$temp_opt_val  = $options[ $option1 ];
				$option1_value = empty( $temp_opt_val ) ? '' : ( version_compare( USCES_VERSION, '1.0', '>=' ) ? urldecode( $temp_opt_val ) : $temp_opt_val );
			}

			/* [Option2] */
			if ( 2 == $dimension ) {
				$opt    = wcex_multiprice_get_option( $option2, $post_id );
				$means2 = (int) $opt['means'];
				if ( 1 === $wcmp_usces_ver ) {
					if ( isset( $options[ urlencode( $option2 ) ] ) ) {
						if ( is_array( $options[ urlencode( $option2 ) ] ) ) {
							$option2_value = urldecode( array_values( $options[ urlencode( $option2 ) ] )[0] );
						} else {
							$option2_value = urldecode( $options[ urlencode( $option2 ) ] );
						}
					} else {
						if ( isset( $options[ $option2 ] ) ) {
							$option2_value = urldecode( $options[ $option2 ] );
						} else {
							$option2_value = '';
						}
					}
				} else {
					$temp_opt_val  = $options[ $option2 ];
					$option2_value = ( empty( $temp_opt_val ) || '#NONE#' == $temp_opt_val ) ? '' : ( version_compare( USCES_VERSION, '1.0', '>=' ) ? urldecode( $temp_opt_val ) : $temp_opt_val );
				}
			} else {
				$option2_value = '';
				$means2        = -1;
			}

			/* Multi-pricing available */
			if ( ! empty( $option1_value ) ) {
				if ( 2 == $dimension && ! empty( $option2_value ) ) {
					if ( 0 == $means1 ) {
						if ( 0 == $means2 ) { /* [Option1]:Single-select, [Option2]:Single-select */
							$add_price = (int) $price[ $option1_value ][ $option2_value ];
						} elseif ( 2 == $means2 ) { /* [Option1]:Single-select, [Option2]:Text */
							foreach ( $price[ $option1_value ] as $y_key => $y_val ) {
								if ( 'max' === (string) $y_key ) {
									$add_price = (int) $y_val;
									break;
								}
								if ( (int) $y_key >= (int) $option2_value ) {
									$add_price = (int) $y_val;
									break;
								}
							}
						}
					} elseif ( 2 == $means1 ) {
						if ( 0 == $means2 ) { /* [Option1]:Text, [Option2]:Single-select */
							foreach ( $price as $x_key => $x_val ) {
								if ( 'max' === (string) $x_key ) {
									$add_price = (int) $x_val[ $option2_value ];
									break;
								}
								if ( (int) $x_key >= (int) $option1_value ) {
									$add_price = (int) $x_val[ $option2_value ];
									break;
								}
							}
						} elseif ( 2 == $means2 ) { /* [Option1]:Text, [Option2]:Text */
							foreach ( $price as $x_key => $x_val ) {
								if ( 'max' === (string) $x_key ) {
									foreach ( $price[ $x_key ] as $y_key => $y_val ) {
										if ( 'max' === (string) $y_key ) {
											$add_price = (int) $y_val;
											break;
										}
										if ( (int) $y_key >= (int) $option2_value ) {
											$add_price = (int) $y_val;
											break;
										}
									}
									break;
								}
								if ( (int) $x_key >= (int) $option1_value ) {
									foreach ( $price[ $x_key ] as $y_key => $y_val ) {
										if ( 'max' === (string) $y_key ) {
											$add_price = (int) $y_val;
											break;
										}
										if ( (int) $y_key >= (int) $option2_value ) {
											$add_price = (int) $y_val;
											break;
										}
									}
									break;
								}
							}
						}
					}
				} else {
					if ( 0 == $means1 ) { /* [Option1]:Single-select Only. */
						$add_price = (int) $price[ $option1_value ];
					} elseif ( 2 == $means1 ) { /* [Option1]:Text Only. */
						foreach ( $price as $x_key => $x_val ) {
							if ( 'max' === (string) $x_key ) {
								$add_price = (int) $x_val;
								break;
							}
							if ( (int) $x_key >= (int) $option1_value ) {
								$add_price = (int) $x_val;
								break;
							}
						}
					}
				}
				$args       = compact( 'org_price', 'cart', 'dimension', 'option1', 'option2', 'price', 'add_price' );
				$add_price  = apply_filters( 'wcex_filter_multiprice_add_price', $add_price, $args );
				$total_add += $add_price;
			}
		}
		$org_price += $total_add;
	}

	return $org_price;
}

/**
 * Price List
 *
 * @param int    $post_id Post ID.
 * @param string $option1 Option1.
 * @param string $option2 Option2.
 * @param string $out 'return' | ''.
 */
function wcex_multiprice_table( $post_id, $option1, $option2 = null, $out = '' ) {
	$table = '';

	$wcex_multiprice = unserialize( get_option( 'wcex_multiprice' ) );

	if ( ! empty( $wcex_multiprice ) && ! empty( $option1 ) ) {

		/* [Option1] */
		$opt    = wcex_multiprice_get_option( $option1, $post_id );
		$means1 = (int) $opt['means'];
		$value1 = ( 0 == $means1 ) ? $opt['value'] : '';

		/* [Option2] */
		if ( ! empty( $option2 ) ) {
			$opt       = wcex_multiprice_get_option( $option2, $post_id );
			$means2    = (int) $opt['means'];
			$value2    = ( 0 == $means2 ) ? $opt['value'] : '';
			$dimension = 2;
		} else {
			$means2    = -1;
			$value2    = '';
			$dimension = 1;
		}
		$value1 = wcex_change_line_break( $value1 );
		$value2 = wcex_change_line_break( $value2 );

		$price = array();
		foreach ( (array) $wcex_multiprice as $mpid => $value ) {
			if ( 1 == $dimension && $option1 == $value['option1'] && '#NONE#' == $value['option2'] ) {
				$price = $value['price'];
				break;
			} elseif ( 2 == $dimension && $option1 == $value['option1'] && $option2 == $value['option2'] ) {
				$price = $value['price'];
				break;
			}
		}

		if ( ! empty( $price ) ) {
			ob_start();
			?>
<table class="wcex_multiprice_list">
	<tbody>
			<?php
			if ( 0 == $means1 ) {
				if ( 0 == $means2 ) { /* [Option1]:Single-select, [Option2]:Single-select */
					$selects1 = explode( "\n", $value1 );
					$selects2 = explode( "\n", $value2 );
					echo '<tr><th></th>';
					foreach ( $selects2 as $v2 ) {
						echo '<th>' . esc_html( $v2 ) . '</th>';
					}
					echo '</tr>';
					foreach ( $selects1 as $v1 ) {
						echo '<tr><th nowrap>' . esc_html( $v1 ) . '</th>';
						foreach ( $selects2 as $v2 ) {
							echo '<td>' . esc_html( $price[ $v1 ][ $v2 ] ) . '</td>';
						}
						echo '</tr>';
					}
				} elseif ( 2 == $means2 ) { /* [Option1]:Single-select, [Option2]:Text */
					echo '<tr><th></th>';
					$y_from = 0;
					foreach ( $price as $x_key => $x_val ) {
						foreach ( $price[ $x_key ] as $y_key => $y_val ) {
							echo '<th>' . esc_html( $y_from ) . esc_html__( ' - ', 'multiprice' ) . wcex_multiprice_set_key_value( $y_key, 'return' ) . '</th>';
							$y_from = $y_key + 1;
						}
						break;
					}
					echo '</tr>';
					$selects1 = explode( "\n", $value1 );
					foreach ( $selects1 as $v1 ) {
						echo '<tr><th nowrap>' . esc_html( $v1 ) . '</th>';
						foreach ( $price[ $v1 ] as $y_key => $y_val ) {
							echo '<td>' . esc_html( $price[ $v1 ][ $y_key ] ) . '</td>';
						}
						echo '</tr>';
					}
				} else { /* [Option1]:Single-select Only. */
					$selects1 = explode( "\n", $value1 );
					foreach ( $selects1 as $v1 ) {
						echo '<tr><th>' . esc_html( $v1 ) . '</th><td>' . esc_html( $price[ $v1 ] ) . '</td></tr>';
					}
				}
			} elseif ( 2 == $means1 ) {
				if ( 0 == $means2 ) { /* [Option1]:Text, [Option2]:Single-select */
					$selects2 = explode( "\n", $value2 );
					echo '<tr><th></th>';
					foreach ( $selects2 as $v2 ) {
						echo '<th>' . esc_html( $v2 ) . '</th>';
					}
					echo '</tr>';
					$x_from = 0;
					foreach ( $price as $x_key => $x_val ) {
						echo '<tr><th>' . esc_html( $x_from ) . esc_html__( ' - ', 'multiprice' ) . wcex_multiprice_set_key_value( $x_key, 'return' ) . '</th>';
						foreach ( $price[ $x_key ] as $y_key => $y_val ) {
							echo '<td>' . esc_html( $price[ $x_key ][ $y_key ] ) . '</td>';
						}
						echo '</tr>';
						$x_from = $x_key + 1;
					}
				} elseif ( 2 == $means2 ) { /* [Option1]:Text, [Option2]:Text */
					echo '<tr><th></th>';
					$y_from = 0;
					foreach ( $price as $x_key => $x_val ) {
						foreach ( $price[ $x_key ] as $y_key => $y_val ) {
							echo '<th>' . esc_html( $y_from ) . esc_html__( ' - ', 'multiprice' ) . wcex_multiprice_set_key_value( $y_key, 'return' ) . '</th>';
							$y_from = $y_key + 1;
						}
						break;
					}
					echo '</tr>';
					$x_from = 0;
					foreach ( $price as $x_key => $x_val ) {
						echo '<tr><th>' . esc_html( $x_from ) . esc_html__( ' - ', 'multiprice' ) . wcex_multiprice_set_key_value( $x_key, 'return' ) . '</th>';
						foreach ( $price[ $x_key ] as $y_key => $y_val ) {
							echo '<td>' . esc_html( $price[ $x_key ][ $y_key ] ) . '</td>';
						}
						echo '</tr>';
						$x_from = $x_key + 1;
					}
				} else { /* [Option1]:Text Only. */
					$x_from = 0;
					foreach ( $price as $x_key => $x_val ) {
						echo '<tr>
							<th>' . esc_html( $x_from ) . esc_html__( ' - ', 'multiprice' ) . wcex_multiprice_set_key_value( $x_key, 'return' ) . '</th>
							<td>' . esc_html( $price[ $x_key ] ) . '</td>
						</tr>';
						$x_from = $x_key + 1;
					}
				}
			}
			?>
	</tbody>
</table>
			<?php
			$table = apply_filters( 'wcex_filter_multiprice_list_table', ob_get_contents() );
			ob_end_clean();
		}
	}

	if ( 'return' == $out ) {
		return $table;
	} else {
		echo $table; // phpcs:ignore
	}
}

/**
 * Maximum value not shown.
 *
 * @param string $key Key.
 * @param string $out 'return' | ''.
 */
function wcex_multiprice_set_key_value( $key, $out = '' ) {
	if ( 'return' == $out ) {
		return ( 'max' === $key ) ? '' : $key;
	} else {
		echo ( 'max' === $key ) ? '' : $key; // phpcs:ignore
	}
}

/**
 * Change newline character.
 *
 * @param string $value Value.
 * @return string
 */
function wcex_change_line_break( $value ) {
	$cr    = array( "\r\n", "\r" );
	$value = trim( $value );
	$value = str_replace( $cr, "\n", $value );
	return $value;
}
