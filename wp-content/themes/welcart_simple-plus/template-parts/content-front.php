<?php
/**
 * Content
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-img"><?php the_post_thumbnail( 'full' ); ?></div>
			<?php endif; ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</article>

		<?php
	endwhile;
else :
	?>

		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php
endif;
