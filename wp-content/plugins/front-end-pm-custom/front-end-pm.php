<?php
/*
Plugin Name:	Front End PM (Ver.Build Salon)
Plugin URI:		https://www.shamimsplugins.com/contact-us/
Description:	DM機能を追加します。
Version:		11.2.1
Author:			Shamim Hasan
License:		GPLv2 or later
License URI:	https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:	front-end-pm
Domain Path:	/languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Front_End_Pm {
	private static $instance;

	private function __construct() {
		$this->constants();
		$this->includes();
		$this->actions();
		//$this->filters();
	}

	public static function init() {
		if ( ! self::$instance instanceof self ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	function constants() {
		global $wpdb;
		define( 'FEP_PLUGIN_VERSION', '11.2.1' );
		define( 'FEP_DB_VERSION', '1121' );
		define( 'FEP_PLUGIN_FILE', __FILE__ );
		define( 'FEP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		define( 'FEP_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

		if ( ! defined ('FEP_MESSAGE_TABLE' ) ) {
			define( 'FEP_MESSAGE_TABLE', $wpdb->base_prefix . 'fep_messages' );
		}
		if ( ! defined ('FEP_META_TABLE' ) ) {
			define( 'FEP_META_TABLE', $wpdb->base_prefix . 'fep_messagemeta' );
		}
		if ( ! defined ('FEP_PARTICIPANT_TABLE' ) ) {
			define( 'FEP_PARTICIPANT_TABLE', $wpdb->base_prefix . 'fep_participants' );
		}
		if ( ! defined ('FEP_ATTACHMENT_TABLE' ) ) {
			define( 'FEP_ATTACHMENT_TABLE', $wpdb->base_prefix . 'fep_attachments' );
		}
	}

	function includes() {
		require_once( FEP_PLUGIN_DIR . 'functions.php' );
		require_once( FEP_PLUGIN_DIR . 'default-hooks.php' );
	}

	function actions() {
		register_activation_hook( __FILE__ , array( $this, 'fep_plugin_activate' ) );
		register_deactivation_hook( __FILE__ , array( $this, 'fep_plugin_deactivate' ) );
	}

	function fep_plugin_activate() {
	}

	function fep_plugin_deactivate() {
	}
} //END Class
Front_End_Pm::init();

function frontendpm_hide_update_notice($data) {
    $plugin_name = 'front-end-pm/front-end-pm.php';
    if (isset($data->response[$plugin_name])) {
        unset($data->response[$plugin_name]);
    }
    return $data;
}
add_filter('site_option__site_transient_update_plugins', 'frontendpm_hide_update_notice');