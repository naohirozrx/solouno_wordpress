<?php
/**
 * Init
 *
 * @package Welcart
 */

/**
 * Load textdomain
 */
function welcart_simpleplus_load_textdomain() {
	load_theme_textdomain( 'welcart_simpleplus', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'welcart_simpleplus_load_textdomain' );

if ( ! welcart_simpleplus_is_active( 'usc-e-shop/usc-e-shop.php' ) ) {
	add_action( 'admin_notices', 'welcart_simpleplus_required_message' );
}

/**
 * Welcart required message
 */
function welcart_simpleplus_required_message() {
	echo wp_kses_post( '<div class="message error"><p>' . __( 'Welcart SimplePlus theme requires <strong>Welcart e-Commerce</strong>. Please <a href="plugins.php">enable Welcart e-Commerce</a>.', 'welcart_simpleplus' ) . '</p></div>' );
}

/**
 * Is Welcart activated
 *
 * @param string $plugin Plugin.
 * @return bool
 */
function welcart_simpleplus_is_active( $plugin ) {
	if ( function_exists( 'is_plugin_active' ) ) {
		return is_plugin_active( $plugin );
	} else {
		return in_array(
			$plugin,
			get_option( 'active_plugins' ),
			true
		);
	}
}
