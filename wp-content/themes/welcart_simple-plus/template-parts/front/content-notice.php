<?php
/**
 * Front
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */
/*
$welcart_simpleplus_notice = welcart_simpleplus_get_news_display_posts_sticky();

$welcart_simpleplus_sticky_posts = get_option( 'sticky_posts' );
$welcart_simpleplus_sticky_news  = false;
foreach ( $welcart_simpleplus_sticky_posts as $welcart_simpleplus_sticky_post ) {
	if ( 'news' === get_post_type( $welcart_simpleplus_sticky_post ) ) {
		$welcart_simpleplus_sticky_news = true;
		break;
	}
}
if ( $welcart_simpleplus_sticky_news ) :
	usces_remove_filter();
	if ( $welcart_simpleplus_notice->have_posts() ) :?>
		<section class="notice <?php welcart_simpleplus_the_notice_class(); ?>">
			<div class="container">
				<p class="notice-content">
				<?php
				while ( $welcart_simpleplus_notice->have_posts() ) :
					$welcart_simpleplus_notice->the_post();
					?>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				<?php endwhile; ?>
				</p>
			</div>
		</section>
		<?php
	endif;
	usces_reset_filter();
endif;
wp_reset_postdata();
*/