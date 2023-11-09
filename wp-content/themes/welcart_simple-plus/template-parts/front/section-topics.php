<?php
/**
 * Front Topics
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

if ( ! get_theme_mod( 'topics_list_display_setting', true ) ) {
	return;
}
$topic_slug = get_theme_mod( 'topics_list_slug_setting', 'topic' );
?>

<section class="topics">
	<h2 class="text-center content-title"><?php echo esc_html( get_theme_mod( 'topics_list_label_setting', 'TOPICS' ) ); ?></h2>
	<div class="container">
		<?php
		$welcart_simpleplus_index = 0;

		$welcart_simpleplus_post_per_page      = get_theme_mod( 'topics_list_control_setting', 5 );
		$welcart_simpleplus_topic_posts        = welcart_simpleplus_get_topics_posts();
		$welcart_simpleplus_topic_posts_sticky = welcart_simpleplus_get_topics_posts_sticky();

		if ( $welcart_simpleplus_topic_posts_sticky->have_posts() || $welcart_simpleplus_topic_posts->have_posts() ) :

			$welcart_simpleplus_sticky_posts  = get_option( 'sticky_posts' );
			$welcart_simpleplus_sticky_topics = false;
			foreach ( $welcart_simpleplus_sticky_posts as $welcart_simpleplus_sticky_topic ) {
				if ( get_post_type( $welcart_simpleplus_sticky_topic ) === $topic_slug ) {
					$welcart_simpleplus_sticky_topics = true;
					break;
				}
			}
			?>
			<div class="grid">
				<?php
				if ( $welcart_simpleplus_sticky_topics ) :
					while ( $welcart_simpleplus_topic_posts_sticky->have_posts() ) :
						$welcart_simpleplus_topic_posts_sticky->the_post();
						get_template_part( 'template-parts/front/content', 'topics', array( 'current_post' => $welcart_simpleplus_topic_posts_sticky->current_post ) );
						$welcart_simpleplus_index++;
					endwhile;
					wp_reset_postdata();
				endif;
				?>
				<?php
				while ( $welcart_simpleplus_post_per_page > $welcart_simpleplus_index && $welcart_simpleplus_topic_posts->have_posts() ) :
					$welcart_simpleplus_topic_posts->the_post();
					get_template_part( 'template-parts/front/content', 'topics', array( 'current_post' => $welcart_simpleplus_topic_posts->current_post ) );
					$welcart_simpleplus_index++;
				endwhile;
				?>
			</div>
			<div class="text-center read-more">
				<a href="<?php echo esc_url( get_post_type_archive_link( $topic_slug ) ); ?>" class="btn btn-outline-dark btn-readmore"><?php esc_html_e( 'View More', 'welcart_simpleplus' ); ?></a>
			</div>
			<?php
		else :
			?>
			<p class="no-data m-5 text-center"><?php esc_html_e( 'No posts found.', 'usces' ); ?></p>
			<?php
		endif;
		wp_reset_postdata();
		?>
	</div>
</section>
