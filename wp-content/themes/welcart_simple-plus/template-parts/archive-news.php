<?php
/**
 * Archive News
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>

<section id="primary" class="site-content<?php welcart_simpleplus_main_class(); ?>">
	<main id="content" class="archive-news" role="main">

		<header class="page-header">
			<h1 class="page-title"><?php echo esc_html( get_theme_mod( 'news_list_label_setting', 'NEWS' ) ); ?></h1>
		</header><!-- .page-header -->

		<?php welcart_simpleplus_category_count_page( '<div class="archive-count-page text-center"><span>', '</span></div>' ); ?>

		<div class="container">
			<ul class="news-list">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/front/content', 'news' );
					}
				}
				wp_reset_postdata();
				?>
			</ul>
		</div>

		<div class="pagination_wrapper">
			<?php welcart_simpleplus_paginate_links(); ?>
		</div><!-- .pagenation-wrapper -->

	</main><!-- #content -->
	<?php get_sidebar(); ?>
</section><!-- #primary -->
