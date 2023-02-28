<?php
/**
 * Front
 *
 * フロントページの機能拡張をしたい場合はこちらに登録する
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

if ( is_active_sidebar( 'top_widget-area1' ) ) :
	dynamic_sidebar( 'top_widget-area1' );
endif;

get_template_part( 'template-parts/front/section', 'topics' );

if ( is_active_sidebar( 'top_widget-area2' ) ) :
	dynamic_sidebar( 'top_widget-area2' );
endif;

get_template_part( 'template-parts/front/section', 'new_items' );

if ( is_active_sidebar( 'top_widget-area3' ) ) :
	dynamic_sidebar( 'top_widget-area3' );
endif;

get_template_part( 'template-parts/front/section', 'news' );
