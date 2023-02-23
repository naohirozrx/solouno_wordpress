<?php
/**
 * Product Page Template
 *
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header();
?>
<?php
$maincolor = '';
$combicolor = '';
$backcolor = '';
$stitch = '';
$kabuse = '';
$innerdesign = '';
$sidedesign = '';
$nametype = '';
$nametext = '';

if(isset($_GET['maincolor'])) {
	$maincolor = htmlspecialchars($_GET['maincolor']);
}

if(isset($_GET['combicolor'])) {
	$combicolor = htmlspecialchars($_GET['combicolor']);
}

if(isset($_GET['backcolor'])) {
	$backcolor = htmlspecialchars($_GET['backcolor']);
}

if(isset($_GET['stitch'])) {
	$stitch = htmlspecialchars($_GET['stitch']);
}

if(isset($_GET['kabuse'])) {
	$kabuse = htmlspecialchars($_GET['kabuse']);
}

if(isset($_GET['innerdesign'])) {
	$innerdesign = htmlspecialchars($_GET['innerdesign']);
}

if(isset($_GET['sidedesign'])) {
	$sidedesign = htmlspecialchars($_GET['sidedesign']);
}

if(isset($_GET['nametype'])) {
	$nametype = htmlspecialchars($_GET['nametype']);
}

if(isset($_GET['nametext'])) {
	$nametext = htmlspecialchars($_GET['nametext']);
}

?>
<div id="primary" class="site-content">
	<div id="content" role="main">

	<?php
	if ( have_posts() ) :
		the_post();
		?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<header class="item-header">
				<h1 class="item_page_title"><?php the_title(); ?></h1>
			</header><!-- .item-header -->

			<div class="storycontent">

				<?php
				usces_remove_filter();
				usces_the_item();
				usces_have_skus();
				?>

				<div id="itempage">

					<div id="img-box">
						<div class="itemimg">
							<a href="<?php usces_the_itemImageURL( 0 ); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', null ); // phpcs:ignore ?>>
								<?php usces_the_itemImage( 0, 335, 335, $post ); ?>
							</a>
							<?php do_action( 'usces_theme_favorite_icon' ); ?>
						</div>
						<?php
						$image_ids = usces_get_itemSubImageNums();
						if ( ! empty( $image_ids ) ) :
							?>
							<div class="itemsubimg">
								<?php foreach ( $image_ids as $image_id ) : ?>
									<a href="<?php usces_the_itemImageURL( $image_id ); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', null ); // phpcs:ignore ?>>
										<?php usces_the_itemImage( $image_id, 135, 135, $post ); ?>
									</a>
								<?php endforeach; ?>
							</div>
							<?php
						endif;
						?>
					</div><!-- #img-box -->


					<div class="detail-box">
						<h2 class="item-name"><?php usces_the_itemName(); ?></h2>
						<div class="itemcode">(<?php usces_the_itemCode(); ?>)</div>
						<?php wel_campaign_message(); ?>
						<div class="item-description">
							<?php the_content(); ?>
						</div>

						<?php if ( 'continue' === wel_get_item_chargingtype() ) : ?>
						<!-- Charging Type Continue shipped -->
						<div class="field">
							<table class="dlseller">
								<tr>
									<th><?php esc_html_e( 'First Withdrawal Date', 'dlseller' ); ?></th>
									<td><?php echo esc_html( dlseller_first_charging( $post->ID ) ); ?></td>
								</tr>
								<?php if ( 0 < (int) $usces_item['dlseller_interval'] ) : ?>
									<tr>
										<th><?php esc_html_e( 'Contract Period', 'dlseller' ); ?></th>
										<td>
											<?php echo esc_html( $usces_item['dlseller_interval'] ); ?>
											<?php esc_html_e( 'month (Automatic Updates)', 'welcart_basic' ); ?>
										</td>
									</tr>
								<?php endif; ?>
							</table>
						</div>
						<?php endif; ?>
					</div><!-- .detail-box -->


					<div class="item-info">
						<?php
						$item_custom = usces_get_item_custom( $post->ID, 'list', 'return' );
						if ( $item_custom ) :
							echo wp_kses_post( $item_custom );
						endif;
						?>

						<form action="<?php echo esc_url( USCES_CART_URL ); ?>" method="post">

							<?php do { ?>
								<div class="skuform">
									<?php if ( '' !== usces_the_itemSkuDisp( 'return' ) ) : ?>
										<div class="skuname"><?php usces_the_itemSkuDisp(); ?></div>
									<?php endif; ?>

									<?php do_action( 'usces_theme_item_single_before_options' ); ?>

									<?php if ( usces_is_options() ) : ?>
										<dl class="item-option">
											<?php while ( usces_have_options() ) : ?>
												<dt><?php usces_the_itemOptName(); ?></dt>
												<dd><?php usces_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
											<?php endwhile; ?>
										</dl>
									<?php endif; ?>

									<?php usces_the_itemGpExp(); ?>

									<div class="field">
										<div class="zaikostatus"><?php esc_html_e( 'stock status', 'usces' ); ?> : <?php usces_the_itemZaikoStatus(); ?></div>

										<?php if ( 'continue' === wel_get_item_chargingtype() ) : ?>
											<div class="frequency">
												<span class="field_frequency"><?php dlseller_frequency_name( $post->ID, 'amount' ); ?></span>
											</div>
										<?php endif; ?>

										<div class="field_price">
											<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
												<span class="field_cprice"><?php usces_the_itemCpriceCr(); ?></span>
											<?php endif; ?>
											<?php usces_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
										</div>
										<?php usces_crform_the_itemPriceCr_taxincluded(); ?>
									</div>

									<?php if ( ! usces_have_zaiko() ) : ?>
										<div class="itemsoldout"><?php echo apply_filters( 'usces_filters_single_sku_zaiko_message', __( 'At present we cannot deal with this product.', 'welcart_basic' ) ); // phpcs:ignore ?></div>
									<?php else : ?>
										<div class="c-box">
											<span class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?><?php usces_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></span>
											<span class="cart-button"><?php usces_the_itemSkuButton( '&#xf07a;&nbsp;&nbsp;' . __( 'Add to Shopping Cart', 'usces' ), 0 ); ?></span>
										</div>
									<?php endif; ?>
									<div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>
								</div><!-- .skuform -->
							<?php } while ( usces_have_skus() ); ?>

							<?php do_action( 'usces_action_single_item_inform' ); ?>

							<input type="hidden" name="maincolor" value="<?php echo $maincolor?>" />
							<input type="hidden" name="combicolor" value="<?php echo $combicolor?>" />
							<input type="hidden" name="backcolor" value="<?php echo $backcolor?>" />
							<input type="hidden" name="stitch" value="<?php echo $stitch?>" />
							<input type="hidden" name="kabuse" value="<?php echo $kabuse?>" />
							<input type="hidden" name="innerdesign" value="<?php echo $innerdesign?>" />
							<input type="hidden" name="sidedesign" value="<?php echo $sidedesign?>" />
							<input type="hidden" name="nametype" value="<?php echo $nametype?>" />
							<input type="hidden" name="nametext" value="<?php echo $nametext?>" />
						</form>
						<?php do_action( 'usces_action_single_item_outform' ); ?>
					</div><!-- .item-info -->


					<?php usces_assistance_item( $post->ID, __( 'An article concerned', 'usces' ) ); ?>


				</div><!-- #itemspage -->
			</div><!-- .storycontent -->
		</article>

	<?php else : ?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
