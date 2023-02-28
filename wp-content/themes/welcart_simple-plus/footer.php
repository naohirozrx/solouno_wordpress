<?php
/**
 * Footer
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>

	<?php if ( is_active_sidebar( 'general-widget-area' ) ) : ?>
		<div class="general-widget-area">
			<?php dynamic_sidebar( 'general-widget-area' ); ?>
		</div>
	<?php endif; ?>

	<footer>
		<?php get_template_part( 'template-parts/footer/sns' ); ?>
		<div id="site-info" class="footer-menu">
			<!-- メニュー -->
			<nav class="nav ma-auto">
				<?php welcart_simpleplus_footer_nav_menu( 'footer' ); ?>
			</nav>
		</div>
		<p class="copyright text-center"><?php welcart_simpleplus_copyright(); ?></p>
	</footer>
	<?php wp_footer(); ?>
	</body>
</html>
