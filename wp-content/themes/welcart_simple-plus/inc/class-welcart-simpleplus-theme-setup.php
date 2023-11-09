<?php
/**
 * Welcart simple plus theme setup
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

/**
 * Class
 */
class Welcart_SimplePlus_Theme_Setup {

	/**
	 * Widgets
	 *
	 * @var mixed
	 */
	public $widgets = null;

	/**
	 * Sticky custom posts
	 *
	 * @var mixed
	 */
	public $sticky_custom_posts = null;

	/**
	 * Terms customize
	 *
	 * @var mixed
	 */
	public $terms_customize = null;

	/**
	 * Review customize
	 *
	 * @var mixed
	 */
	public $review_customize = null;

	/**
	 * Constructer
	 */
	public function __construct() {

		require_once get_template_directory() . '/inc/class-bootstrap-5-navbar-walker.php';

		// 先頭固定表示をカスタム投稿に拡張.
		require_once get_template_directory() . '/inc/class-welcart-simpleplus-sticky-customposts.php';
		$this->sticky_custom_posts = new Welcart_Simpleplus_Sticky_CustomPosts();

		// カテゴリーに画像を登録できるように拡張.
		require_once get_template_directory() . '/inc/class-welcart-simpleplus-term-customize.php';
		$this->terms_customize = new Welcart_Simpleplus_Term_Customize();

		// レビュー用の拡張.
		require_once get_template_directory() . '/inc/class-welcart-simpleplus-review-customize.php';
		$this->review_customize = new Welcart_Simpleplus_Review_Customize();

		// 初期設定.
		add_action( 'after_setup_theme', array( $this, 'setup' ) );

		// 管理画面のスクリプトの読み込み.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_footer', array( $this, 'the_theme_version' ) );
		add_filter( 'wp_page_menu_args', array( $this, 'page_menu_args' ), 10 );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		// フロントのスクリプト読み込み.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ), 12 );
		add_action( 'wp_enqueue_scripts', array( $this, 'dashicons_dequeue_dashicon' ), 10 );

		// 抜粋の長さ.
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 10 );
		add_filter( 'excerpt_mblength', array( $this, 'excerpt_mblength' ), 10 );

		// カスタム投稿タイプの登録.
		add_action( 'init', array( $this, 'create_post_type' ) );

		add_action( 'the_post', array( $this, 'the_post' ), 9 );
		add_filter( 'wcex_sku_select_filter_single_item_autodelivery', 'welcart_simpleplus_single_item_autodelivery_sku_select', 10 );

		/* Plugin Hook Remove WCEX Mobile */
		remove_filter( 'usces_filter_cart_row', 'wcmb_cart_row_of_smartphone_wct', 10, 3 );
		remove_filter( 'usces_filter_confirm_row', 'wcmb_confirm_row_of_smartphone_wct', 10, 3 );

		add_action( 'pre_get_posts', array( $this, 'pre_get_posts_query' ) );

		// 商品検索時のクエリ変数を指定.
		add_filter( 'query_vars', array( $this, 'add_query_vars_filter' ) );

		add_filter( 'usces_filter_member_update_settlement_page_sidebar', array( $this, 'member_update_settlement_page_sidebar' ), 10, 1 );

		// prefetchを追加.
		add_filter( 'wp_resource_hints', array( $this, 'add_resource_hints' ), 10, 2 );

		// no-imageの置き換え.
		add_filter( 'post_thumbnail_html', array( $this, 'filter_post_thumbnail_html_no_image' ), 10, 1 );

		// カテゴリーページのタイトル前の文言を削除.
		add_filter( 'get_the_archive_title', array( $this, 'remove_category_pre_title' ), 10, 1 );

		// ノーイメージの時にBodyのclassを追加.
		add_filter( 'body_class', array( $this, 'no_image_body_class' ), 10, 1 );

		add_filter( 'welcart_simpleplus_header_class', array( $this, 'notice_header_class' ), 10, 1 );

		// 関連商品部分の作り替え.
		add_filter( 'usces_filter_assistance_item_list', array( $this, 'assistance_item_list' ), 10, 0 );

		// 投稿タイプアーカイブの title 属性変更.
		add_filter( 'document_title_parts', array( $this, 'welcart_simpleplus_title_output' ), 10, 1 );
	}

	/**
	 * Setup
	 *
	 * @return void
	 */
	public function setup() {

		add_theme_support( 'post-thumbnails' );
		add_image_size( 'thumb-rect', 650, 650, true );
		add_image_size( 'thumb-rect-nocrop', 650, 650, false );

		add_theme_support( 'title-tag' );

		$args = array(
			'flex-width'    => true,
			'width'         => 3842,
			'height'        => 2160,
			'default-image' => get_theme_file_uri( '/assets/images/image-top.webp' ),
		);
		add_theme_support( 'custom-header', $args );

		register_nav_menus(
			array(
				'header'    => __( 'Header Global Navigation PC', 'welcart_simpleplus' ),
				'header_sp' => __( 'Header Global Navigation SP', 'welcart_simpleplus' ),
				'footer'    => __( 'Footer Navigation', 'usces' ),
			)
		);

		register_default_headers(
			array(
				'basic-default' => array(
					'url'           => '%s/assets/images/image-top.webp',
					'thumbnail_url' => '%s/assets/images/image-top.webp',
				),
			)
		);
	}

	/* Admin page _ Add style */
	/**
	 * Basic_admin_enqueue_scripts
	 *
	 * @param string $hook hook.
	 * @return void
	 */
	public function admin_enqueue_scripts( $hook ) {
		if ( 'welcart-shop_page_usces_itemedit' === $hook || 'widgets.php' === $hook ) {
			wp_enqueue_style( 'basic_admin_style', get_template_directory_uri() . '/css/admin.css', array(), $this->get_theme_version() );
		}
		wp_enqueue_script( 'welcart_simpleplus_admin_script', get_theme_file_uri( '/js/admin-script.js' ), array( 'jquery' ), true, true );
	}

	/**
	 * Create post type
	 * カスタム投稿タイプの登録
	 * 投稿タイプ特集 slug Topic
	 * 投稿タイプNews slug News
	 *
	 * @return void
	 */
	public function create_post_type() {

		$topic_slug = get_theme_mod( 'topics_list_slug_setting', 'topic' );
		$news_slug  = get_theme_mod( 'news_list_slug_setting', 'news' );

		// Topics.
		$labels = array(
			'name'               => __( 'Topic', 'welcart_simpleplus' ),
			'singular_name'      => __( 'Topic', 'welcart_simpleplus' ),
			'add_new'            => _x( 'Add New', 'post' ),
			'add_new_item'       => __( 'Add New Topic', 'welcart_simpleplus' ),
			'edit_item'          => __( 'Edit' ),
			'new_item'           => __( 'New Topic', 'welcart_simpleplus' ),
			'view_item'          => __( 'View Topic', 'welcart_simpleplus' ),
			'search_items'       => __( 'Search for Topic', 'welcart_simpleplus' ),
			'not_found'          => __( 'Nothing a Post of Topic', 'welcart_simpleplus' ),
			'not_found_in_trash' => __( 'Nothing in The Trash', 'welcart_simpleplus' ),
			'parent_item_colon'  => '',
		);
		$args   = array(
			'label'         => __( 'Topic', 'welcart_simpleplus' ),
			'labels'        => $labels,
			'public'        => true,
			'has_archive'   => true,
			'hierarchical'  => true,
			'menu_position' => 7,
			'show_ui'       => true,
			'show_in_rest'  => true,
			'supports'      => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'revisions',
				'excerpt',
				'custom-fields',
			),
			'taxonomies'    => array( 'topic_cat', 'topic_tag' ),
		);
		register_post_type( $topic_slug, $args );

		// News.
		$labels = array(
			'name'               => __( 'News', 'welcart_simpleplus' ),
			'singular_name'      => __( 'News', 'welcart_simpleplus' ),
			'add_new'            => _x( 'Add New', 'post' ),
			'add_new_item'       => __( 'Add New News', 'welcart_simpleplus' ),
			'edit_item'          => __( 'Edit' ),
			'new_item'           => __( 'New News', 'welcart_simpleplus' ),
			'view_item'          => __( 'View News', 'welcart_simpleplus' ),
			'search_items'       => __( 'Search for News', 'welcart_simpleplus' ),
			'not_found'          => __( 'Nothing a Post of News', 'welcart_simpleplus' ),
			'not_found_in_trash' => __( 'Nothing in The Trash', 'welcart_simpleplus' ),
			'parent_item_colon'  => '',
		);
		$args   = array(
			'label'         => __( 'News', 'welcart_simpleplus' ),
			'labels'        => $labels,
			'public'        => true,
			'has_archive'   => true,
			'hierarchical'  => true,
			'menu_position' => 7,
			'show_ui'       => true,
			'show_in_rest'  => true,
			'supports'      => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'revisions',
				'excerpt',
				'custom-fields',
			),
			'taxonomies'    => array( 'news_cat', 'news_tag' ),
		);
		register_post_type( $news_slug, $args );
	}

	/**
	 * Welcart_simpleplus_theme_version
	 *
	 * @return void
	 */
	public function the_theme_version() {
		$theme_ver = $this->get_theme_version();
		echo wp_kses_post( '<!-- Type Basic : v' . $theme_ver . " -->\n" );
	}

	/**
	 * Welcart_simpleplus_get_theme_version
	 *
	 * @return int
	 */
	public function get_theme_version() {
		$themename = 'welcart_simpleplus';
		$theme     = wp_get_theme( $themename );
		return ! empty( $theme ) ? $theme->get( 'Version' ) : '0';
	}

	/**
	 * Welcart_page_menu_args
	 *
	 * @param array $args args.
	 * @return array
	 */
	public function page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}

	/**
	 * Widget and Widgets Area Register
	 *
	 * @return void
	 */
	public function widgets_init() {

		// 商品一覧ウィジェットの読み込み.
		require get_template_directory() . '/widgets/class-basic-item-list.php';

		// welcart_basicからあるが、Gutenbergが間に合うのであれば削除予定.
		register_widget( 'Basic_Item_List' );

		include_once get_template_directory() . '/inc/class-welcart-simpleplus-theme-widgets-init.php';

		$this->widgets = new Welcart_SimplePlus_Theme_Widgets_Init();
	}

	/* wp_enqueue_scripts */
	/**
	 * Welcart_simpleplus_scripts_styles
	 *
	 * @return void
	 */
	public function enqueue_scripts_styles() {
		wp_enqueue_style( 'welcart_simpleplus_font_inter', '//fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap', array(), $this->get_theme_version() );

		if ( defined( 'WCEX_POPLINK' ) ) {
			if ( $this->is_poplink_page() ) {
				wp_enqueue_style( 'wc_basic_poplink', get_template_directory_uri() . '/css/poplink.css', array(), $this->get_theme_version() );
			}
		}
		if ( is_user_logged_in() ) {
			$get_theme_file_uri = apply_filters( 'welcart_simpleplus_footer_styles', get_theme_file_uri( '/css/logged-in.css' ) );
			wp_enqueue_style( 'logged-in-style', $get_theme_file_uri, array(), '1.0', true );
		}

		wp_enqueue_style( 'welcart_simpleplus_css', get_theme_file_uri( '/css/theme_style.min.css' ), array(), $this->get_theme_version() );
		wp_enqueue_script( 'welcart_simpleplus_bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), $this->get_theme_version(), true );
		wp_enqueue_script( 'welcart_simpleplus_js', get_template_directory_uri() . '/js/front-customized.js', array( 'welcart_simpleplus_bootstrap_js' ), $this->get_theme_version(), true );
	}

	/* wp_enqueue_scripts */
	/**
	 * Wp_deregister_style
	 *
	 * @return void
	 */
	public function dashicons_dequeue_dashicon() {
		if ( current_user_can( 'update_core' ) ) {
			return;
		}
		wp_deregister_style( 'dashicons' );
	}

	/**
	 * Is poplink page
	 *
	 * @return bool
	 */
	public function is_poplink_page() {
		$wcpl = get_option( 'wcpl' );
		if ( empty( $wcpl ) || is_admin() ) {
			return false;
		}

		global $wp_query;
		$flag = false;
		foreach ( $wcpl['setup']['enabled_page'] as $enabled_page ) {
			if ( isset( $wp_query[ $enabled_page ] ) && $wp_query[ $enabled_page ] ) {
				$flag = true;
				break;
			}
		}
		return $flag;
	}

	/**
	 * Welcart_excerpt_length
	 *
	 * @param int $length length.
	 * @return int
	 */
	public function excerpt_length( $length ) {
		return 40;
	}

	/**
	 * Welcart_simpleplus_excerpt_mblength
	 *
	 * @param int $length length.
	 * @return int
	 */
	public function excerpt_mblength( $length ) {
		return 110;
	}

	/**
	 * Welcart_simpleplus_the_post
	 *
	 * @return void
	 */
	public function the_post() {
		global $post;

		if ( 'item' === $post->post_mime_type ) {
			$product           = wel_get_product( $post->ID );
			$select_sku_switch = $product['select_sku_switch'];
			if ( ! defined( 'WCEX_SKU_SELECT' ) || 1 !== (int) $select_sku_switch ) {
				remove_action( 'usces_action_single_item_outform', 'wcad_action_single_item_outform' );
				add_action( 'usces_action_single_item_outform', 'welcart_simpleplus_action_single_item_outform' );
			}
		}
	}

	/**
	 * Welcart_simpleplus_query
	 *
	 * @param object $query query.
	 * @return void
	 */
	public function pre_get_posts_query( $query ) {
		// pre_get_posts.
		$item_cat     = get_category_by_slug( 'item' );
		$item_cat_id  = $item_cat->cat_ID;
		$sticky_posts = get_option( 'sticky_posts' );
		if ( ! $query->is_main_query() ) {
			return;
		}

		if ( ! $query->is_admin && $query->is_search && ! get_query_var( 'search_item' ) ) {
			$query->set( 'category_name', 'item' );
		}

		if ( 'posts' === get_option( 'show_on_front' ) && ( $query->is_home() || $query->is_front_page() ) ) {
			$this->posts_per_page( $query );
		}

		// ホームページの選択が固定ページかつ「投稿ページ」を選択した場合はindex.phpになる.
		if ( 'page' === get_option( 'show_on_front' ) && $query->is_home() ) {
			$query->set( 'ignore_sticky_posts', true );
			$query->set( 'category__not_in', array( $item_cat_id ) );
		}

		$query->set( 'ignore_sticky_posts', true );
		if ( ! is_admin() ) {
			$query->set( 'post__not_in', $sticky_posts );
		}

		return $query;
	}

	/**
	 * Welcart simpleplus posts per page
	 *
	 * @param object $query query.
	 * @return void
	 */
	public function posts_per_page( $query ) {
		$h_itemcat = get_option( 'welcart_simpleplus_h_itemcat' );
		$h_itemnum = get_option( 'welcart_simpleplus_h_itemnum' );
		if ( empty( $h_itemcat ) ) {
			$h_itemcat = 'itemreco';
		}
		if ( empty( $h_itemnum ) ) {
			$h_itemnum = '10';
		}

		$query->set( 'category_name', $h_itemcat );
		$query->set( 'posts_per_page', $h_itemnum );
	}

	/**
	 * Add query vars filter
	 *
	 * @param array $vars querys.
	 * @return array
	 */
	public function add_query_vars_filter( $vars ) {
		$vars[] = 'search_item';
		return $vars;
	}

	/**
	 * Member update settlement page sidebar
	 *
	 * @param array $sidebar comment about this variable.
	 * @return array
	 */
	public function member_update_settlement_page_sidebar( $sidebar ) {
		return '';
	}

	/**
	 * Preconnectを追加 Google Font用
	 *
	 * @param array  $hints hints.
	 * @param string $relation_type relation_type.
	 * @return array
	 */
	public function add_resource_hints( $hints, $relation_type ) {
		if ( ! is_admin() ) {
			if ( 'preconnect' === $relation_type ) {
				$hints[] = '//fonts.googleapis.com';
				$hints[] = '//fonts.gstatic.com';
			}
		}
		return $hints;
	}

	/**
	 * Filter post thumbnail html no image
	 *
	 * @param string $html html.
	 * @return string
	 */
	public function filter_post_thumbnail_html_no_image( $html ) {
		if ( $html ) {
			return $html;
		}
		if ( file_exists( get_stylesheet_directory() . '/assets/images/default.png' ) ) {
			$no_image = '<img src="' . get_stylesheet_directory_uri() . '/assets/images/default.png" alt="no-image">';
		} elseif ( file_exists( get_template_directory() . '/assets/images/default.png' ) ) {
			$no_image = '<img src="' . get_template_directory_uri() . '/assets/images/default.png" alt="no-image">';
		}
		return apply_filters( 'welcart_simpleplus_filter_post_thumbnail_html_no_image', $no_image );
	}

	/**
	 * Plugin Name: Seamless Sticky Custom Post Types
	 * Plugin URI: https://wordpress.org/plugins/seamless-sticky-custom-post-types/
	 * Description: Extends the native sticky post functionality to custom post types in a way that is identical to default posts.
	 * Author: Jascha Ephraim
	 * Version: 1.4
	 * Author URI: http://jaschaephraim.com/
	 * License: GPL2
	 *
	 * Copyright 2013  Jascha Ephraim  (email : jascha@jaschaephraim.com)
	 *
	 * This program is free software; you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License, version 2, as
	 * published by the Free Software Foundation.
	 *
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with this program; if not, write to the Free Software
	 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	 */
	public function sscpt_admin_enqueue_scripts() {

		$screen = get_current_screen();

		// Only continue if this is an edit screen for a custom post type.
		if ( ! in_array( $screen->base, array( 'post', 'edit' ), true ) || in_array( $screen->post_type, array( 'post', 'page' ), true ) ) {
			return;
		}

		// Editing an individual custom post.
		if ( 'post' === $screen->base ) {
			$is_sticky = is_sticky();
			$js_vars   = array(
				'screen'                 => 'post',
				'is_sticky'              => $is_sticky ? 1 : 0,
				'checked_attribute'      => checked( $is_sticky, true, false ),
				'label_text'             => __( 'Stick this post to the front page' ),
				'sticky_visibility_text' => __( 'Public, Sticky' ),
			);

		// Browsing custom posts.
		} else {
			global $wpdb;

			$sticky_posts = implode( ', ', array_map( 'absint', (array) get_option( 'sticky_posts' ) ) );
			$sticky_count = $sticky_posts
				? $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( 1 ) FROM $wpdb->posts WHERE post_type = %s AND post_status NOT IN ('trash', 'auto-draft') AND ID IN ($sticky_posts)", $screen->post_type ) ) // phpcs:ignore
				: 0;

			$js_vars = array(
				'screen'            => 'edit',
				'post_type'         => $screen->post_type,
				'status_label_text' => __( 'Status' ),
				'label_text'        => __( 'Make this post sticky' ),
				'sticky_text'       => __( 'Sticky' ),
				'sticky_count'      => $sticky_count,
			);
		}

		// Enqueue js and pass it specified variables.
		wp_enqueue_script(
			'sscpt-admin',
			plugins_url( 'admin.min.js', __FILE__ ),
			array( 'jquery' ),
			time(),
			true
		);
		wp_localize_script( 'sscpt-admin', 'sscpt', $js_vars );
	}

	/**
	 * Remove category pre title
	 *
	 * @param string $title title.
	 * @return string
	 */
	public function remove_category_pre_title( $title ) {
		$res = '';
		if ( is_category() ) {
			$res = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$res = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$res = '' . get_the_author() . '';
		} elseif ( is_date() ) {
			$res = get_the_time( 'F, Y' );
		}
		return apply_filters( 'welcart_simpleplus_remove_category_pre_title', $res, $title );
	}

	/**
	 * No image body class
	 *
	 * @param array $classes classes.
	 * @return array
	 */
	public function no_image_body_class( $classes ) {
		if ( ! get_header_image() ) {
			// ヘッダーイメージがない時はBodyにクラスを追加してリターン.
			return array_merge( $classes, array( 'no-header-image' ) );
		}
		return $classes;
	}

	/**
	 * Notice header class
	 *
	 * @param string $class class.
	 * @return string
	 */
	public function notice_header_class( $class ) {
		$theme_mod = get_theme_mod( 'notice_notice_area_setting', 'content-top' );
		if ( 'over-header' === $theme_mod ) {
			$class .= ' header-in-notice';
		}
		return $class;
	}

	/**
	 * Assistance item list
	 *
	 * @return object
	 */
	public function assistance_item_list() {
		global $post;
		$width  = apply_filters( 'usces_filter_assistance_item_width', 100 );
		$height = apply_filters( 'usces_filter_assistance_item_height', 100 );
		usces_the_item();
		usces_have_skus();
		ob_start();
		get_template_part( 'template-parts/front/content', 'assistance_items' );
		$list = ob_get_contents();
		ob_end_clean();
		return $list;
	}

	/**
	 * Document Archive title
	 *
	 * @param array $title title tag.
	 * @return array
	 */
	public function welcart_simpleplus_title_output( $title ) {
		$topic_slug = get_theme_mod( 'topics_list_slug_setting', 'topic' );
		$news_slug  = get_theme_mod( 'news_list_slug_setting', 'news' );
		if ( is_post_type_archive( $topic_slug ) ) {
			$topics_label = get_theme_mod( 'topics_list_label_setting', 'TOPICS' );
			if ( ! empty( $topics_label ) ) {
				$title['title'] = $topics_label;
			} else {
				$title['title'] = __( 'Topic', 'welcart_simpleplus' );
			}
		} elseif ( is_post_type_archive( $news_slug ) ) {
			$news_label = get_theme_mod( 'news_list_label_setting', 'NEWS' );
			if ( ! empty( $news_label ) ) {
				$title['title'] = $news_label;
			} else {
				$title['title'] = __( 'News', 'welcart_simpleplus' );
			}
		}
		return $title;
	}
}
