<?php
/**
 * Index Page
 *
 * @package Welcart
 */

get_header(); ?>

	<div id="primary" class="site-content index-php">
		<main id="content" role="main">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'container' ); ?> id="post-<?php the_ID(); ?>">
						<div class="entry-meta">
							<span class="date"><time><?php the_time( get_option( 'date_format' ) ); ?></time></span>
						</div>
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="entry-img"><?php the_post_thumbnail( 'full' ); ?></div>
						<?php endif; ?>
						<div class="entry-content">
							<?php the_content( __( 'View All', 'welcart_simpleplus' ) ); ?>
						</div><!-- .entry-content -->
					</article>
					<?php
				endwhile;
			else :
				?>

				<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

				<?php
			endif;
			?>

			<div class="pagination_wrapper">
				<?php welcart_simpleplus_paginate_links(); ?>
			</div><!-- .pagenation-wrapper -->

		</main><!-- #content -->
	</div><!-- #primary -->


<?php
get_footer();
