<?php
/**
 * Functions
 *
 * Welcart Simple Plus Child Functions, Definitions and Include Files.
 *
 * @category   Theme
 * @package    Welcart
 * @subpackage Simple Plus Child
 * @author     welcart.com
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://www.welcart.com
 * @since      1.0.0
 */

/**
 * Enqueue Styles & Scripts.
 */
function theme_enqueue_styles() {
	$template_dir = get_template_directory_uri();

	wp_enqueue_style( 'parent-style', $template_dir . '/style.css', array( 'usces_default_css' ), 1.0 );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'welcart_simpleplus_css' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 10 );

function arrow_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'arrow_mime_types');

function post_has_archive( $args, $post_type ) {

  if ( 'post' == $post_type ) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'news'; //任意のスラッグ名
  }
  return $args;

}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );