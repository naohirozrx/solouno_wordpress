
<?php
$flowerTypeA = '';
$flowerTypeA2 = '';
$flowerTypeB = '';
$flowerTypeB2 = '';
$flowerTypeC = '';
$flowerTypeC2 = '';
$flowerTypeD = '';
$flowerTypePriceA = '';
$flowerTypePriceA2 = '';
$flowerTypePriceB = '';
$flowerTypePriceB2 = '';
$flowerTypePriceC = '';
$flowerTypePriceC2 = '';
$flowerTypePriceD = '';
$flowerTypeNameA = '';
$flowerTypeNameA2 = '';
$flowerTypeNameB = '';
$flowerTypeNameB2 = '';
$flowerTypeNameC = '';
$flowerTypeNameC2 = '';
$flowerTypeNameD = '';
$price_price = 0;

var_dump($_POST);

if(isset($_POST['flowerTypeA'])):
	$flowerTypeA = htmlspecialchars($_POST['flowerTypeA'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeA2'])):
	$flowerTypeA2 = htmlspecialchars($_POST['flowerTypeA2'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeB'])):
	$flowerTypeB = htmlspecialchars($_POST['flowerTypeB'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeB2'])):
	$flowerTypeB2 = htmlspecialchars($_POST['flowerTypeB2'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeC'])):
	$flowerTypeC = htmlspecialchars($_POST['flowerTypeC'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeC2'])):
	$flowerTypeC2 = htmlspecialchars($_POST['flowerTypeC2'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeD'])):
	$flowerTypeD = htmlspecialchars($_POST['flowerTypeD'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypePriceA'])):
	$flowerTypePriceA = htmlspecialchars($_POST['flowerTypePriceA'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypePriceA2'])):
	$flowerTypeAPrice2 = htmlspecialchars($_POST['flowerTypePriceA2'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypePriceB'])):
	$flowerTypePriceB = htmlspecialchars($_POST['flowerTypePriceB'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypePriceB2'])):
	$flowerTypePriceB2 = htmlspecialchars($_POST['flowerTypePriceB2'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypePriceC'])):
	$flowerTypePriceC = htmlspecialchars($_POST['flowerTypePriceC'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypePriceC2'])):
	$flowerTypePriceC2 = htmlspecialchars($_POST['flowerTypePriceC2'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypePriceD'])):
	$flowerTypePriceD = htmlspecialchars($_POST['flowerTypePriceD'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeNameA'])):
	$flowerTypeNameA = htmlspecialchars($_POST['flowerTypeNameA'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeNameA2'])):
	$flowerTypeAName2 = htmlspecialchars($_POST['flowerTypeNameA2'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeNameB'])):
	$flowerTypeNameB = htmlspecialchars($_POST['flowerTypeNameB'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeNameB2'])):
	$flowerTypeNameB2 = htmlspecialchars($_POST['flowerTypeNameB2'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeNameC'])):
	$flowerTypeNameC = htmlspecialchars($_POST['flowerTypeNameC'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeNameC2'])):
	$flowerTypeNameC2 = htmlspecialchars($_POST['flowerTypeNameC2'], ENT_QUOTES, "UTF-8");
endif;

if(isset($_POST['flowerTypeNameD'])):
	$flowerTypeNameD = htmlspecialchars($_POST['flowerTypeNameD'], ENT_QUOTES, "UTF-8");
endif;



if(isset($_POST['price'])):
	$price_price = htmlspecialchars($_POST['price'], ENT_QUOTES, "UTF-8");
endif;


$price_price = number_format($price_price);

$pricetext = "¥$price_price<em class='tax'>（税込）</em>";

if($flowerTypeA == ''):
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
<?php echo $flowerTypeNameA2; ?>【<?php echo $flowerTypeA2; ?>】
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
	$(function() {

		$('.item-option > dd:nth-child(2) > select option[value="<?php echo $flowerTypeNameA; ?>【<?php echo $flowerTypeA; ?>】"]').prop('selected', true);
		if("<?php echo $flowerTypeA2; ?>" == "なし") {
			$('.item-option > dd:nth-child(4) > select option[value="<?php echo $flowerTypeA2; ?>"]').prop('selected', true);
		} else {
			$('.item-option > dd:nth-child(4) > select option[value="<?php echo $flowerTypeNameA2; ?>【<?php echo $flowerTypeA2; ?>】"]').prop('selected', true);
		}
		$('.item-option > dd:nth-child(6) > select option[value="<?php echo $flowerTypeNameB; ?>【<?php echo $flowerTypeB; ?>】"]').prop('selected', true);
		if("<?php echo $flowerTypeB2; ?>" == "なし") {
			$('.item-option > dd:nth-child(8) > select option[value="<?php echo $flowerTypeB2; ?>"]').prop('selected', true);
		} else {
			$('.item-option > dd:nth-child(8) > select option[value="<?php echo $flowerTypeNameB2; ?>【<?php echo $flowerTypeB2; ?>】"]').prop('selected', true);
		}
		$('.item-option > dd:nth-child(10) > select option[value="<?php echo $flowerTypeNameC; ?>【<?php echo $flowerTypeNameC; ?>】"]').prop('selected', true);
		if("<?php echo $flowerTypeC2; ?>" == "なし") {
			$('.item-option > dd:nth-child(12) > select option[value="<?php echo $flowerTypeC2; ?>"]').prop('selected', true);
		} else {
			$('.item-option > dd:nth-child(12) > select option[value="<?php echo $flowerTypeNameC2; ?>【<?php echo $flowerTypeC2; ?>】"]').prop('selected', true);
		}
		$('.item-option > dd:nth-child(14) > select option[value="<?php echo $flowerTypeNameD; ?>【<?php echo $flowerTypeNameD; ?>】"]').prop('selected', true);
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
