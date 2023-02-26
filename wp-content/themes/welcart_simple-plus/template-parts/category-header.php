<?php
/**
 * Category Item Loop
 *
 * @package welcart
 */

?>
<header class="page-header archive-header">
	<?php if ( 2 > welcart_simpleplus_category_is_first() && welcart_simpleplus_get_term_img() ) : ?>
		<div class="category-title-area">
			<?php echo wp_kses_post( welcart_simpleplus_get_term_img() ); ?>
		</div>
	<?php endif; ?>
	<?php
		the_archive_title( '<h1 class="page-title text-center">', '</h1>' );
		welcart_simpleplus_category_count_item( '<div class="category-count-item text-center">', '</div>' );
		the_archive_description( '<div class="taxonomy-description text-center">', '</div>' );
		welcart_simpleplus_category_count_page( '<div class="category-count-page text-center"><span>', '</span></div>' );
		welcart_simpleplus_the_category_filter_dropdown();
	?>
</header><!-- .page-header -->

