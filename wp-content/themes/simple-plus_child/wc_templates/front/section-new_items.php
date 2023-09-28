<?php
/**
 * Front New items
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

if ( ! get_theme_mod( 'items_list_display_setting', true ) ) {
	return;
}
?>

<section class="new-items">
	<?php if ( welcart_simpleplus_get_term_img( get_theme_mod( 'items_list_category_setting', 'item' ) ) ) : ?>
		<div class="category-title-area">
			<?php echo wp_kses_post( welcart_simpleplus_get_term_img( get_theme_mod( 'items_list_category_setting', 'item' ) ) ); ?>
			<h2 class="text-center content-title"><?php echo esc_html( get_theme_mod( 'items_list_label_setting', 'NEW ARRIVAL' ) ); ?></h2>
		</div>
	<?php else : ?>
		<h2 class="text-center content-title"><?php echo esc_html( get_theme_mod( 'items_list_label_setting', 'NEW ARRIVAL' ) ); ?></h2>
	<?php endif; ?>
	<div class="container">
		<div class="grid">
			<?php
			$welcart_simpleplus_index = 0;

			$welcart_simpleplus_post_per_page          = welcart_simpleplus_get_top_item_per_pages();
			$welcart_simpleplus_new_items_posts_sticky = welcart_simpleplus_get_new_items_posts_sticky();
			$welcart_simpleplus_new_items_posts        = welcart_simpleplus_get_new_items_posts();

			$welcart_simpleplus_sticky_posts = get_option( 'sticky_posts' );
			$welcart_simpleplus_sticky_items = false;
			foreach ( $welcart_simpleplus_sticky_posts as $welcart_simpleplus_sticky_item ) {
				if ( 'post' === get_post_type( $welcart_simpleplus_sticky_item ) ) {
					$welcart_simpleplus_sticky_items = true;
					break;
				}
			}

			if ( $welcart_simpleplus_sticky_items ) :
				if ( $welcart_simpleplus_new_items_posts_sticky->have_posts() ) {
					while ( $welcart_simpleplus_new_items_posts_sticky->have_posts() ) {
						$welcart_simpleplus_new_items_posts_sticky->the_post();
						usces_remove_filter();
						usces_the_item();
						usces_have_skus();
						get_template_part( 'template-parts/front/content', 'new_items' );
						$welcart_simpleplus_index++;
					}
				}
				wp_reset_postdata();
			endif;

			if ( $welcart_simpleplus_new_items_posts->have_posts() ) {
				while ( $welcart_simpleplus_post_per_page > $welcart_simpleplus_index && $welcart_simpleplus_new_items_posts->have_posts() ) {
					$welcart_simpleplus_new_items_posts->the_post();
					usces_remove_filter();
					usces_the_item();
					usces_have_skus();
					get_template_part( 'template-parts/front/content', 'new_items' );
					$welcart_simpleplus_index++;
				}
			}
			wp_reset_postdata();
			?>
		</div>
		<div class="text-center read-more">
			<a href="<?php echo esc_url( welcart_simpleplus_get_new_items_link() ); ?>" class="btn  btn-outline-dark btn-readmore">
				<?php esc_html_e( 'View More', 'welcart_simpleplus' ); ?>
			</a>
		</div>
	</div>
</section>
