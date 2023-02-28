<?php
/**
 * Content
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

usces_the_item();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card border-0">
		<div class="card-imag-top grid-image ">
			<div class="itemimg">
				<a href="<?php the_permalink(); ?>">
					<?php usces_the_itemImage( 0, 300, 300 ); ?>
					<?php do_action( 'usces_theme_favorite_icon' ); ?>
				</a>
				<?php wel_campaign_message(); ?>
			</div>
		</div>
		<div class="card-body w-100">
			<div class="itemprice">
				<?php usces_the_firstPriceCr(); ?><?php usces_guid_tax(); ?>
			</div>
			<?php usces_crform_the_itemPriceCr_taxincluded(); ?>
			<?php if ( ! usces_have_zaiko_anyone() ) : ?>
				<div class="itemsoldout">
					<?php welcart_simpleplus_soldout_label( get_the_ID() ); ?>
				</div>
			<?php endif; ?>
			<div class="itemname">
				<a href="<?php the_permalink(); ?>"  rel="bookmark">
					<?php usces_the_itemName(); ?>
				</a>
			</div>
		</div>
	</div>
</article>
