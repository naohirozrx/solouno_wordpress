<?php
/**
 * Front News
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

if ( ! get_theme_mod( 'news_list_display_setting', true ) ) {
	return;
}
?>

<section class="news-front">
	<div class="container">
		<h2 class="news-title"><?php echo esc_html( get_theme_mod( 'news_list_label_setting', 'NEWS' ) ); ?></h2>
		<?php
		$welcart_simpleplus_index = 0;

		$welcart_simpleplus_news_per_page     = get_theme_mod( 'news_list_control_setting', 5 );
		$welcart_simpleplus_news_posts        = welcart_simpleplus_get_news_posts();
		$welcart_simpleplus_news_posts_sticky = welcart_simpleplus_get_news_posts_sticky();
		if ( $welcart_simpleplus_news_posts->have_posts() || $welcart_simpleplus_news_posts_sticky->have_posts() ) :

			$welcart_simpleplus_sticky_posts = get_option( 'sticky_posts' );
			$welcart_simpleplus_sticky_news  = false;
			foreach ( $welcart_simpleplus_sticky_posts as $welcart_simpleplus_sticky_post ) {
				if ( 'news' === get_post_type( $welcart_simpleplus_sticky_post ) ) {
					$welcart_simpleplus_sticky_news = true;
					break;
				}
			}
			?>
			<ul>
				<?php
				if ( $welcart_simpleplus_sticky_news ) :
					while ( $welcart_simpleplus_news_posts_sticky->have_posts() ) :
						$welcart_simpleplus_news_posts_sticky->the_post();
						get_template_part( 'template-parts/front/content', 'news', array( 'current_post' => $welcart_simpleplus_news_posts_sticky->current_post ) );
						$welcart_simpleplus_index++;
					endwhile;
					wp_reset_postdata();
				endif;

				while ( $welcart_simpleplus_news_per_page > $welcart_simpleplus_index && $welcart_simpleplus_news_posts->have_posts() ) :
					$welcart_simpleplus_news_posts->the_post();
					get_template_part( 'template-parts/front/content', 'news', array( 'current_post' => $welcart_simpleplus_news_posts->current_post ) );
					$welcart_simpleplus_index++;
				endwhile;
				?>
			</ul>
			<div class="text-center read-more">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="btn  btn-outline-dark btn-readmore"><?php esc_html_e( 'View More', 'welcart_simpleplus' ); ?></a>
			</div>
			<?php
		else :
			?>
			<p class="no-data mt-5 mb-5"><?php esc_html_e( 'No posts found.', 'usces' ); ?></p>
			<?php
		endif;
		wp_reset_postdata();
		?>
	</div>
</section>
