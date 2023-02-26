<?php
/**
 * WC Sku Select Service
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header();
?>
<div id="primary" class="site-content">
	<main id="content" role="main">

	<?php
	if ( have_posts() ) :
		the_post();
		?>

		<article <?php post_class( 'article-item article-item-service' ); ?> id="post-<?php the_ID(); ?>">

			<?php usces_remove_filter(); ?>
			<?php usces_the_item(); ?>
			<?php usces_have_skus(); ?>

			<div class="group-gallery">
				<?php welcart_simpleplus_single_item_image_carousel(); ?>
			</div><!-- .gallery-item -->

			<div class="group-add-item">
				<h2 class="item-name"><?php usces_the_itemName(); ?></h2>
				<div class="item-code"><?php usces_the_itemCode(); ?></div>

				<div class="current-status">
					<?php wel_campaign_message(); ?>
					<?php welcart_simpleplus_the_stocks(); ?>
					<?php welcart_simpleplus_num_review_text_anchor(); ?>
				</div>
				<?php usces_get_item_custom( $post->ID, 'table' ); ?>

				<?php if ( 'continue' === wel_get_item_chargingtype() ) : ?>
					<!-- Charging Type Continue shipped -->
					<div class="field">
						<table class="dlseller">
							<tr>
								<th>
									<?php esc_html_e( 'First Withdrawal Date', 'dlseller' ); ?>
								</th>
								<td>
									<?php echo wp_kses_post( dlseller_first_charging( $post->ID ) ); ?>
								</td>
							</tr>
							<?php if ( 0 < (int) $usces_item['dlseller_interval'] ) : ?>
								<tr>
									<th>
										<?php esc_html_e( 'Contract Period', 'dlseller' ); ?>
									</th>
									<td>
										<?php echo wp_kses_post( $usces_item['dlseller_interval'] ); ?>
										<?php esc_html_e( 'month (Automatic Updates)', 'welcart_simpleplus' ); ?>
									</td>
								</tr>
							<?php endif; ?>
						</table>
					</div>
				<?php endif; ?>

				<form action="<?php echo esc_url_raw( USCES_CART_URL ); ?>" method="post">
					<div class="skuform" id="skuform">

						<?php if ( 'continue' === wel_get_item_chargingtype() ) : ?>
							<div class="frequency">
								<span class="field-frequency">
									<?php dlseller_frequency_name( $post->ID, 'amount' ); ?>
								</span>
							</div>
						<?php endif; ?>

						<?php wcex_sku_select_form(); ?>

						<?php if ( usces_is_options() ) : ?>
							<dl class="item-option">
								<?php while ( usces_have_options() ) : ?>
								<dt><?php usces_the_itemOptName(); ?></dt>
								<dd><?php usces_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
								<?php endwhile; ?>
							</dl>
						<?php endif; ?>

						<div class="zaikostatus">
							<?php esc_html_e( 'stock status', 'usces' ); ?> : <span class="ss_stockstatus"><?php usces_the_itemZaikoStatus(); ?></span>
						</div>

						<div class="field-price">
							<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
								<span class="field-cprice ss_cprice"><?php usces_the_itemCpriceCr(); ?></span>
							<?php endif; ?>
							<span class="sell_price ss_price"><?php usces_the_itemPriceCr(); ?></span><?php usces_guid_tax(); ?>
							<?php wcex_sku_select_crform_the_itemPriceCr_taxincluded(); ?>
						</div>

						<?php welcart_simpleplus_soldout(); ?>
						<div class="add-to-cart">
							<span class="quantity c-box"><?php esc_html_e( 'Quantity', 'usces' ); ?><?php usces_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></span>
							<span class="cart-button c-box"><?php usces_the_itemSkuButton( get_theme_mod( 'itempage_incart_text_setting', __( 'Add to Shopping Cart', 'usces' ) ), 0 ); ?></span>
						</div>
						<div class="error-message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>
						<div class="wcss_loading"></div>
					</div><!-- .skuform -->
					<?php do_action( 'usces_action_single_item_inform' ); ?>
				</form>
				<?php do_action( 'usces_action_single_item_outform' ); ?>

			</div><!-- .group-add-item -->

			<!-- アコーディオンメニュー -->
			<?php get_template_part( 'template-parts/item/accordion-list' ); ?>

			<!-- 関連商品 -->
			<?php usces_assistance_item( $post->ID, __( 'An article concerned', 'usces' ) ); ?>

		</article>

	<?php else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</main><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
