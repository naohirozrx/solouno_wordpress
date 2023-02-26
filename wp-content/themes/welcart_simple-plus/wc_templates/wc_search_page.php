<?php
/**
 * Wc search page
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header(); ?>

<div id="primary" class="site-content wc_search">
	<main id="content" role="main">

	<?php
	if ( have_posts() ) :
		have_posts();
		the_post();
		?>

		<header class="search-header">
			<h1 class="page-title">
				<?php the_title(); ?>
			</h1>
		</header><!-- .page-header -->

		<section class="post" id="<?php echo esc_html( $post->post_name ); ?>">

			<?php $welcart_simpleplus_uscpaged = ( isset( $_REQUEST['paged'] ) ) ? (int) $_REQUEST['paged'] : 1; // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
			<script type="text/javascript">
				function usces_nextpage() {
					document.getElementById('usces_paged').value = <?php echo esc_attr( $welcart_simpleplus_uscpaged + 1 ); ?>;
					document.searchindetail.submit();
				}
				function usces_prepage() {
					document.getElementById('usces_paged').value = <?php echo esc_attr( $welcart_simpleplus_uscpaged - 1 ); ?>;
					document.searchindetail.submit();
				}
				function newsubmit() {
					document.getElementById('usces_paged').value = 1;
				}
			</script>

		<div id="searchbox" class="search-content">
			<?php // ******* part of result ************** ?>
			<?php
			usces_remove_filter();
			if ( isset( $_REQUEST['usces_search'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$welcart_simpleplus_search_query = apply_filters(
					'usces_filter_search_query',
					array(
						'category__and'  => usces_search_categories(),
						'posts_per_page' => 10,
						'paged'          => $welcart_simpleplus_uscpaged,
					)
				);
				$welcart_simpleplus_my_query     = new WP_Query( $welcart_simpleplus_search_query );
				?>

				<div class="title"><?php esc_html_e( 'Search results', 'usces' ); ?>&nbsp;&nbsp;<?php echo number_format( $welcart_simpleplus_my_query->found_posts ); ?><?php esc_html_e( 'cases', 'usces' ); ?></div>

				<?php if ( $welcart_simpleplus_my_query->have_posts() ) : ?>

					<?php $welcart_simpleplus_search_result = apply_filters( 'usces_filter_search_result', null, $welcart_simpleplus_my_query ); ?>

					<div class="type-grid item-category">
						<?php if ( ! empty( $welcart_simpleplus_search_result ) ) : ?>
							<?php echo esc_html( $welcart_simpleplus_search_result ); ?>
						<?php else : ?>

							<div class="container">
								<div class="grid">
								<?php
								while ( $welcart_simpleplus_my_query->have_posts() ) :
									$welcart_simpleplus_my_query->the_post();
									usces_the_item();
									get_template_part( 'template-parts/front/content', 'search_items' );
								endwhile;
								?>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<div class="navigation-wrap">
						<div class="navigation">
							<?php if ( $welcart_simpleplus_uscpaged > 1 ) : ?>
								<a onclick="usces_prepage();"><?php esc_html_e( '&laquo; Previous article', 'usces' ); ?></a>
							<?php endif; ?>
							<?php if ( $welcart_simpleplus_uscpaged < $welcart_simpleplus_my_query->max_num_pages ) : ?>
								<a onclick="usces_nextpage();"><?php esc_html_e( 'Next article &raquo;', 'usces' ); ?></a>
							<?php endif; ?>
						</div>
					</div>

				<?php else : ?>
					<div class="searchitems"><p><?php esc_html_e( 'The article was not found.', 'usces' ); ?></p></div>
				<?php endif; ?>

				<?php
			endif;
			wp_reset_postdata();
			?>

			<form name="searchindetail" action="<?php echo esc_url_raw( wel_get_cart_url() ); ?>usces_page=search_item" method="post">

				<div class="field">
					<label class="outlabel"><?php esc_html_e( 'Categories: AND Search', 'usces' ); ?></label><?php usces_categories_checkbox(); ?>
				</div>

				<div class="send">
					<input name="usces_search_button" class="usces_search_button" type="submit" value="<?php esc_html_e( 'Search', 'usces' ); ?>" onclick="newsubmit()" />
					<input name="paged" id="usces_paged" type="hidden" value="<?php esc_attr( $welcart_simpleplus_uscpaged ); ?>" />
					<input name="usces_search" type="hidden" />
				</div>
				<?php do_action( 'usces_action_search_item_inform', 'usces' ); ?>

			</form>

		</div><!-- #searchbox -->

		</section><!-- .post -->
	<?php endif; ?>

	</main><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
