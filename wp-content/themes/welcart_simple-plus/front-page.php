<?php
/**
 * Front Page
 *
 * @package Welcart
 */

$welcart_simpleplus_main_class = get_option( 'page_on_front' ) ? 'site-content front-page page_on_front' : 'site-content front-page';
get_header(); ?>

	<main id="main" class="<?php welcart_simpleplus_main_class( $welcart_simpleplus_main_class ); ?>">

		<?php welcart_simpleplus_the_notice( 'content-top' ); ?>

		<?php if ( 'page' === get_option( 'show_on_front' ) ) : ?>

			<?php get_template_part( 'template-parts/content', 'front' ); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/front' ); ?>

		<?php endif; ?>


	</main><!-- #primary -->

<?php
get_footer();
