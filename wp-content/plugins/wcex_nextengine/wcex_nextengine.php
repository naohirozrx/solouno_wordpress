<?php
/**
 * Plugin Name: WCEX NEXT ENGINE
 * Plugin URI: https://www.welcart.com/
 * Description: このプラグインは Welcart 専用のネクストエンジン連携プラグインです。Welcart 本体と一緒にご利用ください。
 * Author: Collne Inc.
 * Version: 1.1.3
 * Author URI: https://www.collne.com/
 *
 * @package WCEX NEXT ENGINE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! defined( 'USCES_VERSION' ) ) {
	return;
}

define( 'WCEX_NEXTENGINE', true );
define( 'WCEX_NEXTENGINE_VERSION', '1.1.3.2301051' );
define( 'WCEX_NEXTENGINE_BASENAME', plugin_basename( dirname( __FILE__ ) ) );
define( 'WCEX_NEXTENGINE_DIR', WP_PLUGIN_DIR . '/' . WCEX_NEXTENGINE_BASENAME );
define( 'WCEX_NEXTENGINE_URL', plugins_url() . '/' . WCEX_NEXTENGINE_BASENAME );

if ( ! class_exists( 'WCEX_NextEngine' ) ) {
	include_once WCEX_NEXTENGINE_DIR . '/includes/class-nextengine.php';
}

global $wcne;
$wcne = WCEX_NextEngine::get_instance();
