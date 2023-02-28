<?php
/**
 * Explanation : bestseller
 *
 * @package Welcart
 */

/**
 * Bestseller
 *
 * @param string $list list.
 * @param int    $post_id post_id.
 * @param string $i i.
 * @return string
 */
function welcart_simpleplus_filter_bestseller( $list, $post_id, $i ) {
	global $usces;
	$post = get_post( $post_id );

	$welcart_simpleplus_grid_class  = 'g-col-6 g-col-md-3';
	$welcart_simpleplus_grid_class  = apply_filters( 'welcart_simpleplus_template_parts_front_items_class', $welcart_simpleplus_grid_class );
	$welcart_simpleplus_grid_class .= ' ' . welcart_simpleplus_get_round_class( 'image_settings_grid_image_radius_setting' );
	$welcart_simpleplus_grid_class .= welcart_simpleplus_get_overlay_image_class( 'image_settings_grid_overlay_image_setting' );
	$welcart_simpleplus_grid_class .= welcart_simpleplus_get_text_shadow_class( 'image_settings_grid_text_shadow_setting' );

	ob_start();
	?>
	<li class="<?php echo esc_attr( $welcart_simpleplus_grid_class ); ?>">
		<a href="<?php the_permalink( $post ); ?>">
			<div class="card border-0">
				<div class="card-imag-top grid-image ">
					<div class="card-image">
						<?php welcart_simpleplus_usces_the_item_image( 0, 'thumb-rect', $post ); ?>
					</div>
				</div>
				<div class="card-body w-100">
					<div class="card-title item-name">
						<?php usces_the_itemName( '', $post ); ?>
					</div>
					<div class="card-text item-price">
						<?php if ( usces_the_firstCprice( 'return', $post ) > 0 ) : ?>
							<span class="field_cprice"><?php usces_the_firstCprice( '', $post ); ?></span>
						<?php endif; ?>
						<?php usces_the_firstPriceCr( '', $post ); ?><?php usces_guid_tax(); ?>
						<?php echo wp_kses_post( usces_crform_itemPriceCr_taxincluded( $post_id ) ); ?>
						<?php wel_campaign_message( $post_id ); ?>
						<?php welcart_simpleplus_the_stocks( $post_id ); ?>
					</div>
				</div>
			</div>
		</a>
	</li>
	<?php
	$list = ob_get_contents();
	ob_end_clean();

	return $list;
}
add_filter( 'usces_filter_bestseller', 'welcart_simpleplus_filter_bestseller', 10, 3 );
