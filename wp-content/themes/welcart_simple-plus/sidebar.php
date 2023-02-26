<?php
/**
 * Sidebar
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

global $usces;

$welcart_simpleplus_aside = get_theme_mod( 'sidebar_display_setting', 'invisible' );
if ( 'invisible' === $welcart_simpleplus_aside ) {
	return;
}
?>

<aside id="secondary" class="secondary widget-area" role="complementary">

	<?php
	if ( ! dynamic_sidebar( 'side-widget-area' ) ) :
		// Default Welcart Category Widget
		$welcart_simpleplus_default_category_widget_args = array(
			'before_widget' => '<section id="welcart_category-3" class="widget widget_welcart_category">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget_title">',
			'after_title'   => '</h3>',
		);
		$welcart_simpleplus_welcart_category             = array(
			'title'    => __( 'Item Category', 'usces' ),
			'icon'     => 1,
			'cat_slug' => 'itemgenre',
		);
		the_widget( 'Welcart_category', $welcart_simpleplus_welcart_category, $welcart_simpleplus_default_category_widget_args );

		// Default Welcart Calendar Widget
		$welcart_simpleplus_default_calendar_widget_args = array(
			'before_widget' => '<section id="welcart_calendar-3" class="widget widget_welcart_calendar">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget_title">',
			'after_title'   => '</h3>',
		);
		$welcart_simpleplus_welcart_calendar             = array(
			'title' => __( 'Business Calendar', 'usces' ),
			'icon'  => 1,
		);
		the_widget( 'Welcart_calendar', $welcart_simpleplus_welcart_calendar, $welcart_simpleplus_default_calendar_widget_args );
	endif;
	?>

</aside><!-- #secondary -->
