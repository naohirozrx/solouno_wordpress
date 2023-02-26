<?php
/**
 * Functions
 *
 * @package Welcart
 */

/* Init */
require_once get_template_directory() . '/inc/init-functions.php';

if ( ! defined( 'USCES_VERSION' ) ) {
	return;
}

/* includes */
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/plugin-functions.php';
require_once get_template_directory() . '/inc/widget-customized.php';
require_once get_template_directory() . '/inc/front-customized.php';
require_once get_template_directory() . '/inc/class-welcart-simpleplus-theme-setup.php';

/* Theme Setup */
$welcart_simpleplus_setup = new Welcart_SimplePlus_Theme_Setup();

/* Theme customizer */
require get_template_directory() . '/inc/class-welcart-simpleplus-theme-customizer.php';
add_action(
	'init',
	function() {
		$welcart_simpleplus_customizer = new Welcart_SimplePlus_Theme_Customizer();
	}
);
