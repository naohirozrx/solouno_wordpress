<?php
/**
 * Category
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header();

$welcart_simpleplus_grid_class  = welcart_simpleplus_get_article_class( get_the_ID() );
$welcart_simpleplus_grid_class .= ' ' . welcart_simpleplus_get_round_class( 'image_settings_grid_image_radius_setting' );
$welcart_simpleplus_grid_class .= welcart_simpleplus_get_overlay_image_class( 'image_settings_grid_overlay_image_setting' );
$welcart_simpleplus_grid_class .= welcart_simpleplus_get_text_shadow_class( 'image_settings_grid_text_shadow_setting' );
?>
<?php
	$category = get_queried_object();
?>
	<section id="primary" class="item-archive">
		<h3><?php the_archive_title(); ?></h3>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dot.svg" class="dot">
			<?php if ( usces_is_cat_of_item( get_query_var( 'cat' ) ) ) : ?>
				<?php query_posts( array( 'category_name' =>$category->slug ,'posts_per_page'=>10) ); ?>
				<ul class="item-list">
					<?php if (have_posts() ) : ?>

						<?php
							while ( have_posts() ) :
								the_post();
								usces_the_item();
								usces_have_skus();
						?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<figure><?php
									the_post_thumbnail(
										'thumb-rect',
										array(
											'class' => 'img-fluid grid-image-rounded',
										)
									);
									?></figure>
								<span class="item-title"><?php the_title();?></span>
								<span class="price"><?php usces_the_firstPrice(); ?>円</span>
							</a>
						</li>
					<?php endwhile; ?>
					<?php else : ?>
						<p class="no-data"><?php esc_html_e( 'No posts found.', 'usces' ); ?></p>
					<?php endif; ?>
				</ul>
			<?php endif; ?>

			<div class="pagination_wrapper">
				<?php welcart_simpleplus_paginate_links(); ?>
			</div><!-- .pagenation-wrapper -->

	</section><!-- #primary -->
<?php get_sidebar('side-l');?>
<?php get_sidebar('side-r');?>

<?php get_footer(); ?>
