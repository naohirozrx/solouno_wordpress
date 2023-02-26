<?php
/**
 * Content
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php if ( is_single() ) : ?>
		<?php if ( ! usces_is_item() ) : ?>
			<div class="entry-meta">
				<span class="date"><time><?php the_date( get_option( 'date_format' ) ); ?></time></span>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<header class="entry-header">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-img"><?php the_post_thumbnail( 'full' ); ?></div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content( __( '(more...)' ) ); ?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ) : ?>
		<nav class="nav-links" role="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span>%title</span><em>' . esc_html__( 'Previous Post', 'welcart_simpleplus' ) . '</em>' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '<span>%title</span><em>' . esc_html__( 'Next Post', 'welcart_simpleplus' ) . '</em>' ); ?></div>
		</nav>
	<?php endif; ?>

</article>
