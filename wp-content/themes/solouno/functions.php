<?php
//イメージサイズ
include( get_template_directory().'/functions/imagesizes.php' );

//pager
include( get_template_directory().'/functions/pager.php' );

//パンくず
include( get_template_directory().'/functions/breadcrumbs.php' );


//editor css include
add_editor_style("editor-style.css");

//サムネイル有効
add_theme_support( 'post-thumbnails' );

//title有効
add_theme_support( 'title-tag' );

add_filter("the_content", "wpautop", 0, 1);

function nendebcom_theme_support_setup() {

    // Default block styles Gutenberg
    add_theme_support( 'wp-block-styles' );

    // Wide Alignment Gutenberg
    //add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', 'nendebcom_theme_support_setup' );

function post_has_archive( $args, $post_type ) {

  if ( 'post' == $post_type ) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'news'; //任意のスラッグ名
  }
  return $args;

}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

?>
