<?php
/**
 * WCEX NEXT ENGINE Functions.
 *
 * @package WCEX NEXT ENGINE
 * @since 1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get SKU select switch.
 *
 * @param  int $post_id Post ID.
 * @return int
 */
function wcne_get_select_sku_switch( $post_id = 0 ) {
	$select_sku_switch = false;
	if ( defined( 'WCEX_SKU_SELECT' ) ) {
		if ( empty( $post_id ) ) {
			global $post;
			if ( $post->ID ) {
				$post_id = $post->ID;
			}
		}
		if ( defined( 'USCES_VERSION' ) && version_compare( USCES_VERSION, '2.7.0', '<' ) ) {
			$select_sku_switch = get_post_meta( $post_id, '_select_sku_switch', true );
		} else {
			$product = wel_get_product( $post_id );
			if ( ! empty( $product['select_sku_switch'] ) && 1 === (int) $product['select_sku_switch'] ) {
				$select_sku_switch = true;
			}
		}
	}
	return $select_sku_switch;
}
