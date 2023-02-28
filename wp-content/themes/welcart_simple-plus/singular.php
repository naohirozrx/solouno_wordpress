<?php
/**
 * Singular for Single & Pages
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header(); ?>

	<div id="primary" class="site-content<?php welcart_simpleplus_main_class(); ?>">
		<main id="content" role="main">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

				<?php if ( ! usces_is_item() ) : ?>

					<div class="comment-area">
					<div class="feedback">
						<?php wp_link_pages(); ?>
					</div>
						<?php comments_template( '', true ); ?>
					</div><!-- .comment-area -->

				<?php endif; ?>

			<?php endwhile; else : ?>

			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

		<?php endif; ?>

		</main><!-- #content -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>
