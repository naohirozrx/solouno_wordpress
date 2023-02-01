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



add_filter('wpcf7_validate_text', 'wpcf7_validate_kana', 11, 2); add_filter('wpcf7_validate_text*', 'wpcf7_validate_kana', 11, 2); function wpcf7_validate_kana($result,$tag){ $tag = new WPCF7_Shortcode($tag); $name = $tag->name;
  $value = isset($_POST[$name]) ? trim(wp_unslash(strtr((string) $_POST[$name], "\n", " "))) : "";

  // "firstname-kana" または "lastname-kana" の場合
  if ( $name === "sei-kana") {

    if (!preg_match("/^[ぁ-ゞー]+$/u",$value)) { // ひらがな以外だった場合
      $result->invalidate($tag, "全角ひらがなで入力してください。"); // エラーメッセージを表示
    }

  }

  if ( $name === "mei-kana" ) {

    if (!preg_match("/^[ぁ-ゞー]+$/u",$value)) { // ひらがな以外だった場合
      $result->invalidate($tag, "全角ひらがなで入力してください。"); // エラーメッセージを表示
    }

  }
  return $result;
}
?>
