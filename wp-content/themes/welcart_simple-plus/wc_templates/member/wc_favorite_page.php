<?php
/**
 * Member's favorites list page
 *
 * @package WCEX Favorites
 * @since 1.0.0
 */

// phpcs:disabled
global $usces;

$member              = $usces->get_member();
$favorites_count     = wcfv_get_favorites_count( $member['ID'] );
$favorite_option     = wcfv_get_option();
$page_title          = sprintf( __( '%s List', 'favorite' ), $favorite_option['label_name'] );
$page_title          = apply_filters( 'usces_theme_filter_page_title', $page_title, $favorite_option['label_name'] );
$no_favorite_message = sprintf( __( 'There are no %s items.', 'favorite' ), $favorite_option['label_name'] );

get_header();
?>
<div id="primary" class="site-content">
	<main id="content" class="member-page" role="main">

	<?php
	if ( have_posts() ) :
		usces_remove_filter();
		?>
		<div class="post" id="wc_member_favorite_page">

			<h1 class="member_page_title"><?php echo esc_html( $page_title ); ?></h1>

			<div class="error_message"></div>

			<?php if ( 1 > $favorites_count ) : ?>

				<div id="member-favorite" class="member-favorite section-content">
					<p class="no-data"><?php echo esc_html( $no_favorite_message ); ?></p>
				</div>

			<?php else : ?>

				<form id="member-favorite-page">
					<?php
					$favorites = wcfv_get_favorites( $member['ID'] );
					if ( 1 === $favorites_count ) {
						$args = array(
							'p' => $favorites[0],
						);
					} else {
						$args = array(
							'post__in'            => $favorites,
							'posts_per_page'      => -1,
							'orderby'             => 'post__in',
							'ignore_sticky_posts' => 1,
						);
					}
					$fv = new WP_Query( $args );
					if ( $fv->have_posts() ) :
						?>
					<div id="member-favorite" class="member-favorite section-content">
						<div class="grid">
							<?php
							while ( $fv->have_posts() ) :
								$fv->the_post();
								usces_the_item();

								get_template_part( 'template-parts/front/content', 'favorite_items' );

							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
					<?php endif; ?>
				</form>
			<?php endif; ?>

		</div>

	<?php else : ?>

		<p class="no-data"><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>
	</main>
</div>

<?php
get_footer();
