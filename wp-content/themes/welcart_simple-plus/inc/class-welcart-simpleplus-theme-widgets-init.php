<?php
/**
 * Welcart simple plus widgets setup
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

/**
 * Class
 */
class Welcart_SimplePlus_Theme_Widgets_Init {

	/**
	 * Constructer
	 */
	public function __construct() {

		$this->setup();
	}

	/**
	 * Setup
	 *
	 * @return void
	 */
	public function setup() {
		// デフォルトウィジェット設定.
		$default_sidebar_args = array(
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget_title">',
			'after_title'   => '</h3>',
		);

		// トップページウィジェットエリア1.
		$top_widget1 = array_merge(
			$default_sidebar_args,
			array(
				'name'        => __( 'Top page widget area 1', 'welcart_simpleplus' ),
				'id'          => 'top_widget-area1',
				'description' => apply_filters( 'welcart_simpleplus_top_widgetarea1_description', __( 'In this widget area, you can configure widgets to be displayed between the main visual and the featured listings on the top page.', 'welcart_simpleplus' ) ),
			)
		);
		register_sidebar( $top_widget1 );

		// トップページウィジェットエリア2.
		$top_widget2 = array_merge(
			$default_sidebar_args,
			array(
				'name'        => __( 'Top page widget area 2', 'welcart_simpleplus' ),
				'id'          => 'top_widget-area2',
				'description' => apply_filters( 'welcart_simpleplus_top_widgetarea2_description', __( 'In this widget area, you can configure the widget to be displayed between the featured list and the product list on the top page.', 'welcart_simpleplus' ) ),
			)
		);
		register_sidebar( $top_widget2 );

		// トップページウィジェットエリア3.
		$top_widget3 = array_merge(
			$default_sidebar_args,
			array(
				'name'        => __( 'Top page widget area 3', 'welcart_simpleplus' ),
				'id'          => 'top_widget-area3',
				'description' => apply_filters( 'welcart_simpleplus_top_widgetarea3_description', __( 'In this widget area, you can configure the widget to be displayed between the product list and the announcement list on the top page.', 'welcart_simpleplus' ) ),
			)
		);
		register_sidebar( $top_widget3 );

		// 共通ウィジェットエリア.
		$general_widget = array_merge(
			$default_sidebar_args,
			array(
				'name'        => __( 'Common Widget Area', 'welcart_simpleplus' ),
				'id'          => 'general-widget-area',
				'description' => apply_filters( 'welcart_simpleplus_common_widgetarea_description', __( 'In this widget area, you can configure the widgets to be displayed on the footer.', 'welcart_simpleplus' ) ),
			)
		);
		register_sidebar( $general_widget );

		// 商品一覧・検索結果ページのサイドバー.
		$side_widget = array_merge(
			$default_sidebar_args,
			array(
				'name'        => __( 'Sidebar Widget area', 'welcart_simpleplus' ),
				'id'          => 'side-widget-area',
				'description' => apply_filters( 'welcart_simpleplus_side_widgetarea_description', __( 'In this widget area, you can configure widgets to be displayed in the sidebar.', 'welcart_simpleplus' ) ),
			)
		);
		register_sidebar( $side_widget );
	}
}
