<?php
/**
 * Front-Customized.php
 *
 * @package Welcart
 */

/**
 * Usces_cart.css Reset
 *
 * @return void
 */
function welcart_simpleplus_remove_usces_cart_css() {
	global $usces;
	$usces->options['system']['no_cart_css'] = 1;
}
add_action( 'wp_enqueue_scripts', 'welcart_simpleplus_remove_usces_cart_css', 8 );

/**
 * Search results exclude the member page and cart page
 *
 * @param object $query query.
 */
function welcart_simpleplus_search_filter( $query ) {
	$page_cart   = get_page_by_path( 'usces-cart' );
	$page_member = get_page_by_path( 'usces-member' );
	if ( ! $query->is_admin && $query->is_search ) {
		$query->set( 'post__not_in', array( $page_cart->ID, $page_member->ID ) );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'welcart_simpleplus_search_filter' );

/**
 * NO-IMAGE
 *
 * @param array $icon_dirs icon_dirs.
 * @return array
 */
function welcart_simpleplus_icon_dirs( $icon_dirs ) {
	if ( file_exists( get_stylesheet_directory() . '/assets/images/default.png' ) ) {
		$icon_dir     = get_stylesheet_directory() . '/assets/images';
		$icon_dir_uri = get_stylesheet_directory_uri() . '/assets/images';
	} elseif ( file_exists( get_template_directory() . '/assets/images/default.png' ) ) {
		$icon_dir     = get_template_directory() . '/assets/images';
		$icon_dir_uri = get_template_directory_uri() . '/assets/images';
	} else {
		return $icon_dirs;
	}
	$icon_dirs = array( $icon_dir => $icon_dir_uri );
	return $icon_dirs;
}
add_filter( 'icon_dirs', 'welcart_simpleplus_icon_dirs' );

/**
 * Image size of assistance item
 *
 * @param int $size size.
 * @return int
 */
function welcart_simpleplus_assistance_item_size( $size ) {
	return 165;
}
add_filter( 'usces_filter_assistance_item_width', 'welcart_simpleplus_assistance_item_size' );
add_filter( 'usces_filter_assistance_item_height', 'welcart_simpleplus_assistance_item_size' );

/**
 * Image size of list item
 *
 * @param string $html html.
 * @param string $content content.
 * @return string
 */
function welcart_simpleplus_item_list_loopimg( $html, $content ) {
	global $post;

	$html = '<div class="loopimg"><a href="' . get_permalink( $post->ID ) . '">' . usces_the_itemImage( 0, 300, 300, $post, 'return' ) . '</a></div>' .
	'<div class="loopexp"><div class="field">' . $content . '</div></div>';

	return $html;
}
add_filter( 'usces_filter_item_list_loopimg', 'welcart_simpleplus_item_list_loopimg', 10, 2 );


/**
 * Remove hentry
 *
 * @param array $classes classes.
 * @return array
 */
function welcart_simpleplus_remove_hentry( $classes ) {

	$idx = array_search( 'hentry', $classes, true );
	if ( false !== $idx ) {
		unset( $classes[ $idx ] );
	}

	return $classes;
}
add_filter( 'post_class', 'welcart_simpleplus_remove_hentry' );

/**
 * 買い物を続けるボタンのリンク先カスタマイズ
 *
 * @param array $link link.
 * @return string
 */
function welcart_simpleplus_cart_prebutton( $link ) {
	if ( get_theme_mod( 'change_link_allow_change_setting', false ) ) {
		$url = get_theme_mod( 'change_link_incart_text_setting', '' );
		if ( ! empty( $url ) ) {
			$link = ' onclick="location.href=\'' . $url . '\'"';
		}
	}

	return $link;
}
add_filter( 'usces_filter_cart_prebutton', 'welcart_simpleplus_cart_prebutton' );

/**
 * カート投入時の数量変更
 *
 * @param string $html html.
 * @param string $cart cart.
 * @return string
 */
function welcart_simpleplus_widgetcart_total_quant( $html, $cart ) {
	global $usces;
	$quant = $usces->get_total_quantity( $cart );

	$html .= '
	<script type="text/javascript">
		jQuery("header .total-quant").html("' . $quant . '");
	</script>';

	return $html;
}
add_filter( 'widgetcart_get_cart_row', 'welcart_simpleplus_widgetcart_total_quant', 10, 2 );
