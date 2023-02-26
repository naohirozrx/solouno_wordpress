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

	<section id="primary" class="site-content">
		<main id="content" role="main" class="container">

			<?php get_template_part( 'template-parts/category', 'header' ); ?>

			<?php if ( usces_is_cat_of_item( get_query_var( 'cat' ) ) ) : ?>

				<div class="type-grid item-category">
					<?php if ( have_posts() ) : ?> 
						<!-- 商品の場合 テンプレート -->
						<?php get_template_part( 'template-parts/category', 'item' ); ?>
					<?php else : ?>
						<p class="no-data"><?php esc_html_e( 'No posts found.', 'usces' ); ?></p>
					<?php endif; ?>
				</div>

			<?php else : ?>

				<div class="post-category">
					<div class="container">
						<div class="grid">
						<?php if ( have_posts() ) : ?>
							<!-- 商品ではない場合場合 テンプレート -->
							<?php
							while ( have_posts() ) :
								the_post();
								?>
								<article class="<?php echo esc_attr( $welcart_simpleplus_grid_class ); ?>">
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
							<?php endwhile; ?>
						<?php else : ?>
							<p class="no-data"><?php esc_html_e( 'No posts found.', 'usces' ); ?></p>
						<?php endif; ?>
						</div>
					</div>
				</div>

			<?php endif; ?>

			<div class="pagination_wrapper">
				<?php welcart_simpleplus_paginate_links(); ?>
			</div><!-- .pagenation-wrapper -->

		</main><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>
