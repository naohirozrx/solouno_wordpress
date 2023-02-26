<?php
/**
 * Front
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

$welcart_simpleplus_topics_class = welcart_simpleplus_get_article_class( get_the_ID() );
if ( is_home() || is_front_page() ) {
	$welcart_simpleplus_topics_class .= ' ' . welcart_simpleplus_get_round_class( 'topics_list_round_setting' );
	$welcart_simpleplus_topics_class .= welcart_simpleplus_get_overlay_image_class( 'topics_list_overlay_setting' );
	$welcart_simpleplus_topics_class .= welcart_simpleplus_get_text_shadow_class( 'topics_list_text_shadow_setting' );
} else {
	$welcart_simpleplus_topics_class .= ' ' . welcart_simpleplus_get_round_class( 'image_settings_grid_image_radius_setting' );
	$welcart_simpleplus_topics_class .= welcart_simpleplus_get_overlay_image_class( 'image_settings_grid_overlay_image_setting' );
	$welcart_simpleplus_topics_class .= welcart_simpleplus_get_text_shadow_class( 'image_settings_grid_text_shadow_setting' );
}
?>
<article class="<?php echo esc_attr( $welcart_simpleplus_topics_class ); ?>">
	<a href="<?php the_permalink(); ?>">
		<div class="card border-0">
			<div class="card-imag-top grid-image">
				<?php
				the_post_thumbnail(
					'thumb-rect',
					array(
						'class' => 'img-fluid grid-image-rounded',
					)
				);
				?>
			</div>
			<div class="card-body w-100">
				<h3 class="card-title"><?php the_title(); ?></h3>
				<p class="card-text">
					<?php the_time( get_option( 'date_format' ) ); ?>
				</p>
			</div>
		</div>
	</a>
</article>
