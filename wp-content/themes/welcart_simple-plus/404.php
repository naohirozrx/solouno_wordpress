<?php
/**
 * 404
 *
 * @package Welcart
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<main id="content" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title">404</h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<h2 class="subtitle"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'welcart_simpleplus' ); ?></h2>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'welcart_simpleplus' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->

	</div><!-- .content-area -->

<?php get_footer(); ?>
