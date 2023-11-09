<?php
/**
 * Archive
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header();

$topic_slug = get_theme_mod( 'topics_list_slug_setting', 'topic' );
$news_slug  = get_theme_mod( 'news_list_slug_setting', 'news' );
if ( is_post_type_archive( $topic_slug ) ) :
	get_template_part( 'template-parts/archive', 'topic' );
elseif ( is_post_type_archive( $news_slug ) ) :
	get_template_part( 'template-parts/archive', 'news' );
else :
	?>

	<section id="primary" class="<?php welcart_simpleplus_main_class( 'site-content archive-post' ); ?>">
		<main id="content" role="main">

			<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header><!-- .page-header -->

			<?php welcart_simpleplus_category_count_page( '<div class="archive-count-page text-center"><span>', '</span></div>' ); ?>

			<div class="archive-list">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
						<article <?php post_class( 'article-post' ); ?> id="post-<?php the_ID(); ?>">
							<a href="<?php the_permalink(); ?>">
								<div class="entry-img">
									<?php the_post_thumbnail( 'thumbnail' ); ?>
								</div>
								<div class="entry-info">
									<p class="date"><time><?php the_time( get_option( 'date_format' ) ); ?></time></p>
									<p class="title"><?php the_title(); ?></p>
								</div>
							</a>
						</article>
						<?php
					endwhile;
				else :
					?>

					<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

					<?php
				endif;
				?>
			</div>

			<div class="pagination_wrapper">
				<?php welcart_simpleplus_paginate_links(); ?>
			</div><!-- .pagenation-wrapper -->

		</main><!-- #content -->
		<?php get_sidebar(); ?>
	</section><!-- #primary -->

	<?php
endif;
get_footer();
