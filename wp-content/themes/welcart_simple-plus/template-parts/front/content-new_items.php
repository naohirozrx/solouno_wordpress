<?php
/**
 * Front
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

$welcart_simpleplus_grid_class = welcart_simpleplus_get_article_class( get_the_ID() );
$welcart_simpleplus_grid_class = apply_filters( 'welcart_simpleplus_template_parts_front_items_class', $welcart_simpleplus_grid_class );
if ( is_home() || is_front_page() ) {
	$welcart_simpleplus_grid_class .= ' ' . welcart_simpleplus_get_round_class( 'items_list_round_setting' );
	$welcart_simpleplus_grid_class .= welcart_simpleplus_get_overlay_image_class( 'items_list_overlay_setting' );
	$welcart_simpleplus_grid_class .= welcart_simpleplus_get_text_shadow_class( 'items_list_text_shadow_setting' );
} else {
	$welcart_simpleplus_grid_class .= ' ' . welcart_simpleplus_get_round_class( 'image_settings_grid_image_radius_setting' );
	$welcart_simpleplus_grid_class .= welcart_simpleplus_get_overlay_image_class( 'image_settings_grid_overlay_image_setting' );
	$welcart_simpleplus_grid_class .= welcart_simpleplus_get_text_shadow_class( 'image_settings_grid_text_shadow_setting' );
}
?>
<article class="<?php echo esc_attr( $welcart_simpleplus_grid_class ); ?>">
	<a href="<?php the_permalink(); ?>">
	<div class="card border-0">
		<div class="card-imag-top grid-image">
			<div class="card-image">
				<?php welcart_simpleplus_sticky_thumbnail( 'thumb-rect' ); ?>
				<?php welcart_simpleplus_usces_the_item_image( 0, 'thumb-rect', $post ); ?>
			</div>
			<?php welcart_simpleplus_the_grid_image_tags( $post ); ?>
		</div>
		<div class="card-body w-100">
			<h3 class="card-title item-name">
				<?php usces_the_itemName(); ?>
			</h3>
			<div class="card-text item-price">
				<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
					<span class="field_cprice"><?php usces_the_itemCpriceCr(); ?></span>
				<?php endif; ?>
				<?php usces_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
				<?php usces_crform_the_itemPriceCr_taxincluded(); ?>
				<?php wel_campaign_message(); ?>
				<?php welcart_simpleplus_the_stocks(); ?>
			</div>
		</div>
	</div>
	</a>
</article>
