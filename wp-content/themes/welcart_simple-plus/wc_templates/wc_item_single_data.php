<?php
/**
 * Wc item single data
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

		<article <?php post_class( 'article-item article-item-data' ); ?> id="post-<?php the_ID(); ?>">

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

				<div class="field">
					<table class="dlseller">
						<?php if ( 'continue' === wel_get_item_chargingtype() ) : ?>
							<!-- Charging Type Continue shipped -->
							<tr>
								<th>
									<?php esc_html_e( 'First Withdrawal Date', 'dlseller' ); ?>
								</th>
								<td>
									<?php echo esc_html( dlseller_first_charging( $post->ID ) ); ?>
								</td>
							</tr>
							<?php if ( 0 < (int) $usces_item['dlseller_interval'] ) : ?>
								<tr>
									<th>
										<?php esc_html_e( 'Contract Period', 'dlseller' ); ?>
									</th>
									<td>
										<?php echo esc_html( $usces_item['dlseller_interval'] ); ?>
										<?php esc_html_e( 'month (Automatic Updates)', 'welcart_simpleplus' ); ?>
									</td>
								</tr>
							<?php endif; ?>
						<?php endif; ?>
						<tr>
							<th>
								<?php esc_html_e( 'dlValidity(days)', 'dlseller' ); ?>
							</th>
							<td>
								<?php echo esc_html( usces_dlseller_validity( $post ) ); ?>
							</td>
						</tr>
						<tr>
							<th>
								<?php esc_html_e( 'File Name', 'dlseller' ); ?>
							</th>
							<td>
								<?php echo esc_html( usces_dlseller_filename( $post ) ); ?>
							</td>
						</tr>
						<tr>
							<th>
								<?php esc_html_e( 'Release Date', 'dlseller' ); ?>
							</th>
							<td>
								<?php usces_get_itemMeta( '_dlseller_date', $post->ID ); ?>
							</td>
						</tr>
						<tr>
							<th>
								<?php esc_html_e( 'Version', 'dlseller' ); ?>
							</th>
							<td>
								<?php usces_get_itemMeta( '_dlseller_version', $post->ID ); ?>
							</td>
						</tr>
						<tr>
							<th>
								<?php esc_html_e( 'Author', 'dlseller' ); ?>
							</th>
							<td>
								<?php usces_get_itemMeta( '_dlseller_author', $post->ID ); ?>
							</td>
						</tr>
					</table>
				</div>

				<form action="<?php echo esc_url_raw( USCES_CART_URL ); ?>" method="post">
					<div class="skuform">
						<?php welcart_simpleplus_skuinfo(); ?>
						<?php if ( 'continue' === wel_get_item_chargingtype() ) : ?>
							<div class="frequency">
								<span class="field-frequency">
									<?php dlseller_frequency_name( $post->ID, 'amount' ); ?>
								</span>
							</div>
						<?php endif; ?>

						<?php usces_the_itemGpExp(); ?>

						<?php do_action( 'usces_theme_item_single_before_options' ); ?>

						<?php if ( usces_is_options() ) : ?>
							<dl class="item-option">
								<?php while ( usces_have_options() ) : ?>
								<dt><?php usces_the_itemOptName(); ?></dt>
								<dd><?php usces_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
								<?php endwhile; ?>
							</dl>
						<?php endif; ?>

						<div class="zaikostatus">
							<?php esc_html_e( 'stock status', 'usces' ); ?> : <?php usces_the_itemZaikoStatus(); ?>
						</div>

						<div class="field-price">
							<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
								<span class="field-cprice"><?php usces_the_itemCpriceCr(); ?></span>
							<?php endif; ?>
							<?php usces_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
							<?php usces_crform_the_itemPriceCr_taxincluded(); ?>
						</div>

						<?php if ( ! usces_have_zaiko() ) : ?>
							<?php welcart_simpleplus_soldout(); ?>
						<?php else : ?>
							<div class="add-to-cart c-box">
								<span class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?><?php usces_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></span>
								<span class="cart-button"><?php usces_the_itemSkuButton( get_theme_mod( 'itempage_incart_text_setting', __( 'Add to Shopping Cart', 'usces' ) ), 0 ); ?></span>
							</div>
						<?php endif; ?>
						<div class="error-message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>
					</div>
					<?php do_action( 'usces_action_single_item_inform' ); ?>
				</form>
				<?php do_action( 'usces_action_single_item_outform' ); ?>
			</div><!-- .group-item -->

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
