
<?php
$size = '';
$ribonTypeA = '';
$ribonTypeB = '';
$ribonTypeC = '';
$ribonTypeD = '';
$ribonTypePriceA = '';
$ribonTypePriceB = '';
$ribonTypePriceC = '';
$ribonTypePriceD = '';
$ribonTypeNameA = '';
$ribonTypeNameB = '';
$ribonTypeNameC = '';
$ribonTypeNameD = '';
$price_price = 0;

if(isset($_POST['size'])):
	$size = htmlspecialchars($_POST['size'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypeA'])):
	$ribonTypeA = htmlspecialchars($_POST['ribonTypeA'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypeB'])):
	$ribonTypeB = htmlspecialchars($_POST['ribonTypeB'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypeC'])):
	$ribonTypeC = htmlspecialchars($_POST['ribonTypeC'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypeD'])):
	$ribonTypeD = htmlspecialchars($_POST['ribonTypeD'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypePriceA'])):
	$ribonTypePriceA = htmlspecialchars($_POST['ribonTypePriceA'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypePriceB'])):
	$ribonTypePriceB = htmlspecialchars($_POST['ribonTypePriceB'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypePriceC'])):
	$ribonTypePriceC = htmlspecialchars($_POST['ribonTypePriceC'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypePriceD'])):
	$ribonTypePriceD = htmlspecialchars($_POST['ribonTypePriceD'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypeNameA'])):
	$ribonTypeNameA = htmlspecialchars($_POST['ribonTypeNameA'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypeNameB'])):
	$ribonTypeNameB = htmlspecialchars($_POST['ribonTypeNameB'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypeNameC'])):
	$ribonTypeNameC = htmlspecialchars($_POST['ribonTypeNameC'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['ribonTypeNameD'])):
	$ribonTypeNameD = htmlspecialchars($_POST['ribonTypeNameD'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['price'])):
	$price_price = htmlspecialchars($_POST['price'], ENT_QUOTES, "UTF-8");
endif;


$price_price = number_format($price_price);

$pricetext = "¥$price_price<em class='tax'>（税込）</em>";

if($ribonTypeA == ''):
	header('Location: https://sim.solouno-ordermade.com/');
	exit;
endif;
?>
<?php
/**
 * Product Page Template
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header();

$welcart_simpleplus_primary_class = isset( $args ) && isset( $args['column'] ) ? $args['column'] : '';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
	$(function() {

		$('.item-option > dd:nth-child(2) > select option[value="<?php echo $size; ?>【<?php echo $size; ?>】"]').prop('selected', true);

		$('.item-option > dd:nth-child(4) > select option[value="<?php echo $ribonTypeNameA; ?>【<?php echo $ribonTypeA; ?>】"]').prop('selected', true);
		if("<?php echo $ribonTypeNameB; ?>" == "なし") {
			$('.item-option > dd:nth-child(6) > select option[value="<?php echo $ribonTypeB; ?>"]').prop('selected', true);
		} else {
			$('.item-option > dd:nth-child(6) > select option[value="<?php echo $ribonTypeNameB; ?>【<?php echo $ribonTypeB; ?>】"]').prop('selected', true);
		}
		if("<?php echo $ribonTypeNameC; ?>" == "なし") {
			$('.item-option > dd:nth-child(8) > select option[value="<?php echo $ribonTypeC; ?>"]').prop('selected', true);
		} else {
			$('.item-option > dd:nth-child(8) > select option[value="<?php echo $ribonTypeNameC; ?>【<?php echo $ribonTypeC; ?>】"]').prop('selected', true);
		}
		$('.item-option > dd:nth-child(10) > select option[value="<?php echo $ribonTypeNameD; ?>【<?php echo $ribonTypeD; ?>】"]').prop('selected', true);

		$('.field-price').html("<?php echo $pricetext; ?>");

	});
</script>

<div id="primary" class="site-content site-content-grid <?php echo esc_attr( $welcart_simpleplus_primary_class ); ?>">
	<main id="content" role="main">

	<?php
	if ( have_posts() ) :
		the_post();
		?>

		<article <?php post_class( 'article-item' ); ?> id="post-<?php the_ID(); ?>">
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
					</table>
				</div>
				<?php endif; ?>

				<form action="<?php echo esc_html( USCES_CART_URL ); ?>" method="post">

					<?php do { ?>
						<div class="skuform custombagspec">

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
								<dl class="item-option" style="position:relative;">
									<?php while ( usces_have_options() ) : ?>
									<dt><?php usces_the_itemOptName(); ?></dt>
									<dd><?php usces_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
									<?php endwhile; ?>
									<div style="position:absolute; left: 0; top: 0; width: 100%; height:100%;"></div>

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
									<div class="consent-wrap">
										<input type="checkbox" required id="consent" /><label for="consent">販売規約に同意します</label>
									</div>
									<span class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?><?php usces_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></span>
									<span class="cart-button"><?php usces_the_itemSkuButton( get_theme_mod( 'itempage_incart_text_setting', __( 'Add to Shopping Cart', 'usces' ) ), 0 ); ?></span>
								</div>
							<?php endif; ?>
							<div class="error-message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>
						</div><!-- .skuform -->
					<?php } while ( usces_have_skus() ); ?>
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
