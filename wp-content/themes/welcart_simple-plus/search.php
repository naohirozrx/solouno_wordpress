<?php
/**
 * Search
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<main id="content" role="main">

			<header class="search-header">
				<h1 class="page-title"><?php echo esc_html_e( 'Search Results', 'welcart_simpleplus' ); ?></h1>
				<p class="search-keyword"><?php echo esc_html( sprintf( __( 'Search Keyword for: %s', 'welcart_simpleplus' ), esc_html( get_search_query() ) ) ); ?>
				<?php get_search_form(); ?>
			</header><!-- .page-header -->

			<div class="type-grid item-category">
				<?php if ( have_posts() ) : ?> 
					<?php get_template_part( 'template-parts/content', 'search' ); ?>
				<?php else : ?>
					<p><?php esc_html_e( 'No posts found.', 'usces' ); ?></p>
				<?php endif; ?>
			</div>

			<div class="pagination_wrapper">
				<?php welcart_simpleplus_paginate_links(); ?>
			</div><!-- .pagenation-wrapper -->

		</main><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>
