<?php
/**
 * Front Search Page
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

$welcart_simpleplus_grid_class  = 'g-col-6 g-col-md-3';
$welcart_simpleplus_grid_class  = apply_filters( 'welcart_simpleplus_template_parts_front_items_class', $welcart_simpleplus_grid_class );
$welcart_simpleplus_grid_class .= ' ' . welcart_simpleplus_get_round_class( 'image_settings_grid_image_radius_setting' );
$welcart_simpleplus_grid_class .= welcart_simpleplus_get_overlay_image_class( 'image_settings_grid_overlay_image_setting' );
$welcart_simpleplus_grid_class .= welcart_simpleplus_get_text_shadow_class( 'image_settings_grid_text_shadow_setting' );
?>
<article class="<?php echo esc_attr( $welcart_simpleplus_grid_class ); ?>">
	<a href="<?php the_permalink(); ?>">
	<div class="card border-0">
		<div class="card-imag-top grid-image ">
			<div class="card-image">
				<?php welcart_simpleplus_usces_the_item_image( 0, 'thumb-rect', $post ); ?>
			</div>
			<?php welcart_simpleplus_the_grid_image_tags( $post ); ?>
			<?php do_action( 'usces_theme_favorite_icon' ); ?>
		</div>
		<div class="card-body w-100">
			<h3 class="card-title item-name">
				<?php usces_the_itemName(); ?>
			</h3>
			<div class="card-text item-price">
				<?php if ( usces_the_firstCprice( 'return' ) > 0 ) : ?>
					<span class="field_cprice"><?php usces_the_firstCprice(); ?></span>
				<?php endif; ?>
				<?php usces_the_firstPriceCr(); ?><?php usces_guid_tax(); ?>
				<?php usces_crform_the_itemPriceCr_taxincluded(); ?>
				<?php wel_campaign_message(); ?>
				<?php welcart_simpleplus_the_stocks(); ?>
			</div>
		</div>
	</div>
	</a>
</article>
