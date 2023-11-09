<?php
/**
 * Template Functions
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

/**
 * The site title
 *
 * @return void
 */
function welcart_simpleplus_the_site_title() {
	echo wp_kses_post( welcart_simpleplus_get_site_title() );
}

/**
 * Get site title
 *
 * @return string
 */
function welcart_simpleplus_get_site_title() {
	$pc_image               = get_theme_mod( 'header_logo_pc_setting' );
	$sp_image               = get_theme_mod( 'header_logo_sp_setting' );
	$pc_before_scroll_image = get_theme_mod( 'header_logo_pc_before_scroll_setting' );
	$sp_before_scroll_image = get_theme_mod( 'header_logo_sp_before_scroll_setting' );
	$logo_size              = apply_filters(
		'welcart_simpleplus_max_size',
		array(
			'width'  => '150px',
			'height' => '50px',
		)
	);

	$logo_class = '';
	if ( $pc_before_scroll_image ) {
		$logo_class .= ' set-before-pc-logo';
	}
	if ( $sp_before_scroll_image ) {
		$logo_class .= ' set-before-sp-logo';
	}
	if ( ! $pc_image ) {
		$logo_class .= ' not-set-pc-logo';
	}
	if ( ! $sp_image ) {
		$logo_class .= ' not-set-sp-logo';
	}

	ob_start();
	?>
	<h1 class="navbar-brand m-0 p-0 align-middle<?php echo esc_attr( $logo_class ); ?>">
		<div class="d-none d-lg-block">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php if ( $pc_image ) : ?>
					<?php if ( $pc_before_scroll_image ) : ?>
						<img width="<?php echo esc_attr( $logo_size['width'] ); ?>" height="<?php echo esc_attr( $logo_size['height'] ); ?>" src="<?php echo esc_url_raw( $pc_before_scroll_image ); ?>" class="logo scroll-before" alt="<?php bloginfo( 'name' ); ?>">
					<?php endif; ?>
					<img width="<?php echo esc_attr( $logo_size['width'] ); ?>" height="<?php echo esc_attr( $logo_size['height'] ); ?>" src="<?php echo esc_url_raw( $pc_image ); ?>" class="logo default" alt="<?php bloginfo( 'name' ); ?>">
				<?php else : ?>
						<?php bloginfo( 'name' ); ?>
				<?php endif; ?>
			</a>
		</div>
		<div class="d-lg-none">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php if ( $sp_image ) : ?>
					<?php if ( $sp_before_scroll_image ) : ?>
						<img width="<?php echo esc_attr( $logo_size['width'] ); ?>" height="<?php echo esc_attr( $logo_size['height'] ); ?>" src="<?php echo esc_url_raw( $sp_before_scroll_image ); ?>" class="logo scroll-before" alt="<?php bloginfo( 'name' ); ?>">
					<?php endif; ?>
					<img width="<?php echo esc_attr( $logo_size['width'] ); ?>" height="<?php echo esc_attr( $logo_size['height'] ); ?>" src="<?php echo esc_url_raw( $sp_image ); ?>" class="logo default" alt="<?php bloginfo( 'name' ); ?>">
				<?php else : ?>
					<?php bloginfo( 'name' ); ?>
				<?php endif; ?>
			</a>
		</div>
	</h1>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return apply_filters( 'welcart_simpleplus_get_site_title', $content );
}

/**
 * The menu login pc
 *
 * @return void
 */
function welcart_simpleplus_the_menu_login_pc() {
	$kses_defaults = wp_kses_allowed_html( 'post' );

	$svg_args = array(
		'svg'   => array(
			'id'              => true,
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true, // <= Must be lower case!.
		),
		'g'     => array( 'fill' => true ),
		'title' => array( 'title' => true ),
		'path'  => array(
			'd'    => true,
			'fill' => true,
		),
	);

	$allowed_tags = array_merge( $kses_defaults, $svg_args );
	echo wp_kses(
		welcart_simpleplus_get_menu_login_pc(),
		$allowed_tags
	);
}

/**
 * Get menu login pc
 *
 * @return void
 */
function welcart_simpleplus_get_menu_login_pc() {
	if ( ! usces_is_membersystem_state() ) {
		return;
	}
	ob_start();
	?>
		<a href="<?php echo esc_url_raw( USCES_MEMBER_URL ); ?>">
			<svg id="ico-user" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M0,16v-2c0-2.2,3.6-4,8-4s8,1.8,8,4v2Zm4-12a4,4,0,1,1,4,4A4,4,0,0,1,4,4Z" fill="#777"/></svg>
		</a>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return apply_filters( 'welcart_simpleplus_get_menu_login', $content );
}

/**
 * Get cart url
 *
 * @return string
 */
function welcart_simpleplus_get_cart_url() {
	global $usces;
	$cart_url = USCES_CART_URL . $usces->delim;
	return $cart_url;
}

/**
 * Is cart page
 *
 * @return bool
 */
function welcart_simpleplus_is_cart_page() {
	global $usces;
	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : null;
	if ( $request_uri && $usces->is_cart_page( $request_uri ) ) {
		if ( 'search_item' === $usces->page ) {
			return false;
		}
		return true;
	}
	return false;
}

/**
 * Is member page
 *
 * @return bool
 */
function welcart_simpleplus_is_member_page() {
	global $usces;
	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : null;
	if ( $request_uri && $usces->is_member_page( $request_uri ) ) {
		if ( 'search_item' === $usces->page ) {
			return false;
		}
		return true;
	}
	return false;
}

/**
 * Single item outform
 * usces_action_single_item_outform
 *
 * @return void
 */
function welcart_simpleplus_action_single_item_outform() {
	global $post, $usces;

	$product = wel_get_product( $post->ID );

	$settings = array(
		'day'   => __( 'Daily', 'autodelivery' ),
		'month' => __( 'Monthly', 'autodelivery' ),
	);
	$html     = '';
	if ( 'regular' === $usces->getItemChargingType( $post->ID ) ) :
		$regular_unit      = $product['wcad_regular_unit'];
		$regular_unit_name = array_key_exists( $regular_unit, $settings ) ? $settings[ $regular_unit ] : '';
		$regular_interval  = $product['wcad_regular_interval'];
		$regular_frequency = $product['wcad_regular_frequency'];

		if ( usces_have_zaiko_anyone( $post->ID ) ) :
			usces_the_item();
			$single_label    = apply_filters( 'wcad_filter_item_single_label_interval', __( 'Interval', 'autodelivery' ) );
			$single_interval = $regular_interval . $regular_unit_name;
			if ( 1 < (int) $regular_frequency ) {
				$frequency_label = apply_filters( 'wcad_filter_item_single_label_frequency', __( 'Frequency', 'autodelivery' ) );
				$frequency_value = $regular_frequency . __( 'times', 'autodelivery' );
			} else {
				$frequency_label = apply_filters( 'wcad_filter_item_single_label_frequency_free', __( 'Frequency', 'autodelivery' ) );
				$frequency_value = apply_filters( 'wcad_filter_item_single_value_frequency_free', __( 'Free cycle', 'autodelivery' ) );
			}
			ob_start();
			?>
<div id="wc_regular">
	<p class="regular-purchase-ttl"><?php esc_html_e( 'Regular Purchase', 'autodelivery' ); ?></p>
	<div class="field">
		<table class="autodelivery">
			<tr>
				<th>
					<?php echo esc_html( $single_label ); ?>
				</th>
				<td>
					<?php echo esc_html( $single_interval ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo esc_html( $frequency_label ); ?>
				</th>
				<td>
					<?php echo esc_html( $frequency_value ); ?>
				</td>
			</tr>
		</table>
	</div>

	<form action="<?php echo esc_url_raw( USCES_CART_URL ); ?>" method="post">
			<?php while ( usces_have_skus() ) : ?>
				<div class="skuform">

					<?php welcart_simpleplus_skuinfo(); ?>

					<?php if ( usces_is_options() ) : ?>
						<dl class="item-option">
							<?php while ( usces_have_options() ) : ?>
								<dt><?php usces_the_itemOptName(); ?></dt>
								<dd><?php wcad_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
							<?php endwhile; ?>
						</dl>
					<?php endif; ?>

					<?php usces_the_itemGpExp(); ?>

					<div class="zaikostatus">
						<?php esc_html_e( 'stock status', 'usces' ); ?> : <?php usces_the_itemZaikoStatus(); ?>
					</div>

					<div class="field-price">
						<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
							<span class="field-cprice"><?php usces_the_itemCpriceCr(); ?></span>
						<?php endif; ?>
						<?php wcad_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
						<?php wcad_crform_the_itemPriceCr_taxincluded(); ?>
					</div>

					<?php if ( ! usces_have_zaiko() ) : ?>
						<?php welcart_simpleplus_soldout(); ?>
					<?php else : ?>
						<div class="add-to-cart c-box">
							<span class="quantity"><?php wcad_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></span>
							<span class="cart-button"><?php wcad_the_itemSkuButton( __( 'Apply for a regular purchase', 'autodelivery' ), 0 ); ?></span>
						</div>
					<?php endif; ?>
					<div class="error-message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>

				</div><!-- .skuform -->
			<?php endwhile; ?>
			<?php echo esc_html( apply_filters( 'wcad_single_item_multi_sku_after_field', null ) ); ?>
			<?php do_action( 'wcad_action_single_item_inform' ); ?>
	</form>
</div>
			<?php
			$html = ob_get_contents();
			ob_end_clean();
		endif;
	endif;

	$html = apply_filters( 'welcart_simpleplus_filter_single_item_autodelivery', $html );
	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * WCEX SKU SELECT + WCEX AUTO DELIVERY
 * wcex_sku_select_filter_single_item_autodelivery
 *
 * @return void
 */
function welcart_simpleplus_single_item_autodelivery_sku_select() {
	global $post, $usces;

	$product = wel_get_product( $post->ID );

	$settings = array(
		'day'   => __( 'Daily', 'autodelivery' ),
		'month' => __( 'Monthly', 'autodelivery' ),
	);
	if ( 'regular' === $usces->getItemChargingType( $post->ID ) ) :
		$regular_unit      = $product['wcad_regular_unit'];
		$regular_unit_name = array_key_exists( $regular_unit, $settings ) ? $settings[ $regular_unit ] : '';
		$regular_interval  = $product['wcad_regular_interval'];
		$regular_frequency = $product['wcad_regular_frequency'];

		if ( usces_have_zaiko_anyone( $post->ID ) ) :
			usces_the_item();
			$single_label    = apply_filters( 'wcad_filter_item_single_label_interval', __( 'Interval', 'autodelivery' ) );
			$single_interval = $regular_interval . $regular_unit_name;
			if ( 1 < (int) $regular_frequency ) {
				$frequency_label = apply_filters( 'wcad_filter_item_single_label_frequency', __( 'Frequency', 'autodelivery' ) );
				$frequency_value = $regular_frequency . __( 'times', 'autodelivery' );
			} else {
				$frequency_label = apply_filters( 'wcad_filter_item_single_label_frequency_free', __( 'Frequency', 'autodelivery' ) );
				$frequency_value = apply_filters( 'wcad_filter_item_single_value_frequency_free', __( 'Free cycle', 'autodelivery' ) );
			}
			ob_start();
			?>
<div id="wc_regular">
	<p class="regular-purchase-ttl"><?php esc_html_e( 'Regular Purchase', 'autodelivery' ); ?></p>
	<div class="field">
		<table class="autodelivery">
			<tr>
				<th>
					<?php echo esc_html( $single_label ); ?>
				</th>
				<td>
					<?php echo esc_html( $single_interval ); ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo esc_html( $frequency_label ); ?>
				</th>
				<td>
					<?php echo esc_html( $frequency_value ); ?>
				</td>
			</tr>
		</table>
	</div>

	<form action="<?php echo esc_url_raw( USCES_CART_URL ); ?>" method="post">
		<div class="skuform" id="skuform_regular">

			<?php wcex_auto_delivery_sku_select_form(); ?>

			<?php if ( usces_is_options() ) : ?>
			<dl class="item-option">
				<?php while ( usces_have_options() ) : ?>
				<dt><?php usces_the_itemOptName(); ?></dt>
				<dd><?php wcad_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
				<?php endwhile; ?>
			</dl>
			<?php endif; ?>

			<div class="zaikostatus">
				<?php esc_html_e( 'stock status', 'usces' ); ?> : <span class="ss_stockstatus"><?php usces_the_itemZaikoStatus(); ?></span>
			</div>

			<div class="field-price">
			<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
				<span class="field-cprice ss_cprice_regular"><?php usces_the_itemCpriceCr(); ?></span>
			<?php endif; ?>
				<span class="sell_price ss_price_regular"><?php wcad_the_itemPriceCr(); ?></span><?php usces_guid_tax(); ?>
				<?php wcex_sku_select_crform_the_itemRPriceCr_taxincluded(); ?>
			</div>

			<?php welcart_simpleplus_soldout(); ?>
			<div class="add-to-cart">
				<span class="quantity c-box"><?php esc_html_e( 'Quantity', 'usces' ); ?><?php usces_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></span>
				<span class="cart-button c-box"><?php wcad_the_itemSkuButton( __( 'Apply for a regular purchase', 'autodelivery' ), 0 ); ?></span>
			</div>
			<div class="error-message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>
			<div class="wcss_loading"></div>

		</div><!-- .skuform -->
			<?php echo esc_html( apply_filters( 'wcad_single_item_multi_sku_after_field', null ) ); ?>
			<?php do_action( 'wcad_action_single_item_inform' ); ?>
	</form>
</div>
			<?php
		endif;
	endif;

	$html = ob_get_contents();
	ob_end_clean();

	$html = apply_filters( 'welcart_simpleplus_filter_single_item_autodelivery_sku_select', $html );
	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Paginate links
 *
 * @return void
 */
function welcart_simpleplus_paginate_links() {
	$args       = array(
		'type'      => 'list',
		'prev_text' => __( ' &lt; ', 'welcart_simpleplus' ),
		'next_text' => __( ' &gt; ', 'welcart_simpleplus' ),
		'type'      => 'array',
	);
	$args       = apply_filters( 'welcart_simpleplus_paginate_links', $args );
	$page_links = paginate_links( $args ) ? join( '</li><li class="page-item">', paginate_links( $args ) ) : '';
	echo wp_kses_post( '<ul class="pagination"><li class="page-item">' . str_replace( 'page-numbers', 'page-link', $page_links ) . '</li></ul>' );
}

/**
 * Footer nav menu
 *
 * @param string $theme_location theme_location.
 * @param string $container_class container_class.
 * @param string $menu_class menu_class.
 * @return void
 */
function welcart_simpleplus_footer_nav_menu( $theme_location = '', $container_class = '', $menu_class = '' ) {
	wp_nav_menu(
		array(
			'theme_location' => $theme_location,
			'container'      => $container_class,
			'menu_class'     => '',
			'fallback_cb'    => '__return_false',
			'items_wrap'     => '<ul id="%1$s" class="navbar-nav mx-auto mb-2 mb-lg-0 text-center %2$s">%3$s</ul>',
			'depth'          => 1,
		)
	);
}

/**
 * Main Class
 *
 * @param string|string[] $import Space-separated string or array of class names to add to the class list.
 * @return void
 */
function welcart_simpleplus_main_class( $import = '' ) {
	$class = explode( ' ', $import );
	if ( is_front_page() || is_home() || welcart_simpleplus_is_cart_page() || welcart_simpleplus_is_member_page() ) {
		$class[] = 'one-column';
	} else {
		$display_sidebar  = get_theme_mod( 'sidebar_display_setting', 'invisible' );
		$position_sidebar = 'set-' . get_theme_mod( 'sidebar_position_setting', 'left' );
		if ( 'invisible' === $display_sidebar ) {
			$class[] = 'one-column';
		} else {
			$class[] = 'two-column ' . $position_sidebar;
		}
	}
	echo esc_attr( implode( ' ', $class ) );
}

/**
 * 特集記事の取得
 *
 * @return Object
 */
function welcart_simpleplus_get_topics_posts() {
	$post_per_page = get_theme_mod( 'topics_list_control_setting', 5 );
	$sticky_posts  = get_option( 'sticky_posts' );
	$topic_slug    = get_theme_mod( 'topics_list_slug_setting', 'topic' );
	$args          = array(
		'post_type'      => $topic_slug,
		'posts_per_page' => $post_per_page,
		'post__not_in'   => $sticky_posts,
	);

	$query = new WP_Query( $args );

	return apply_filters( 'welcart_simpleplus_get_topics_posts', $query );
}

/**
 * 特集記事の取得（先頭表示）
 *
 * @return Object
 */
function welcart_simpleplus_get_topics_posts_sticky() {
	$post_per_page = get_theme_mod( 'topics_list_control_setting', 5 );
	$sticky_posts  = get_option( 'sticky_posts' );
	$topic_slug    = get_theme_mod( 'topics_list_slug_setting', 'topic' );
	$args          = array(
		'post_type'      => $topic_slug,
		'posts_per_page' => $post_per_page,
		'post__in'       => $sticky_posts,
		'order'          => 'post__in',
	);

	$query = new WP_Query( $args );

	return apply_filters( 'welcart_simpleplus_get_topics_posts', $query );
}

/**
 * お知らせの取得
 */
function welcart_simpleplus_get_news_posts() {

	$per_page = get_theme_mod( 'news_list_control_setting', 5 );
	if ( $per_page > 100 ) {
		$per_page = 100;
	} elseif ( $per_page < 1 ) {
		$per_page = 0;
	}
	$news_slug = get_theme_mod( 'news_list_slug_setting', 'news' );
	$args      = array(
		'post_type'      => $news_slug,
		'posts_per_page' => $per_page,
		'post__not_in'   => get_option( 'sticky_posts' ),
	);

	$query = new WP_Query( $args );

	return apply_filters( 'welcart_simpleplus_get_news_posts', $query );
}

/**
 * お知らせ（先頭表示の）情報取得
 */
function welcart_simpleplus_get_news_posts_sticky() {

	$per_page  = get_theme_mod( 'news_list_control_setting', 5 );
	$news_slug = get_theme_mod( 'news_list_slug_setting', 'news' );
	$args      = array(
		'post_type'      => $news_slug,
		'posts_per_page' => $per_page,
		'post__in'       => get_option( 'sticky_posts' ),
		'order'          => 'post__in',
	);

	$query = new WP_Query( $args );

	return apply_filters( 'welcart_simpleplus_get_news_posts', $query );
}

/**
 * お知らせ（先頭表示の）の表示内容
 */
function welcart_simpleplus_get_news_display_posts_sticky() {

	$news_slug = get_theme_mod( 'news_list_slug_setting', 'news' );
	$args      = array(
		'post_type'      => $news_slug,
		'posts_per_page' => 1,
		'post__in'       => get_option( 'sticky_posts' ),
		'order'          => 'post__in',
	);

	$query = new WP_Query( $args );

	return $query;
}

/**
 * 新着商品の表示件数取得
 *
 * @return int|mixed
 */
function welcart_simpleplus_get_top_item_per_pages() {
	$per_page = get_theme_mod( 'items_list_control_setting', 10 );
	if ( $per_page > 100 ) {
		$per_page = 100;
	} elseif ( $per_page < 1 ) {
		$per_page = 0;
	}
	return $per_page;
}

/**
 * 新着商品の取得
 */
function welcart_simpleplus_get_new_items_posts() {
	$per_page     = welcart_simpleplus_get_top_item_per_pages();
	$sticky_posts = get_option( 'sticky_posts' );

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $per_page,
		'category_name'  => get_theme_mod( 'items_list_category_setting', 'item' ),
		'post__not_in'   => $sticky_posts,
	);

	$query = new WP_Query( $args );

	return apply_filters( 'welcart_simpleplus_get_new_items_posts', $query );
}

/**
 * 新着商品の取得（先頭表示）
 */
function welcart_simpleplus_get_new_items_posts_sticky() {
	$per_page     = welcart_simpleplus_get_top_item_per_pages();
	$sticky_posts = get_option( 'sticky_posts' );

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $per_page,
		'category_name'  => get_theme_mod( 'items_list_category_setting', 'item' ),
		'post__in'       => $sticky_posts,
		'order'          => 'post__in',
	);

	$query = new WP_Query( $args );

	return apply_filters( 'welcart_simpleplus_get_new_items_posts', $query );
}

/**
 * 新着商品のURL取得
 */
function welcart_simpleplus_get_new_items_link() {
	$category_name = get_theme_mod( 'items_list_category_setting', 'item' );
	$category_id   = get_category_by_slug( $category_name )->cat_ID;

	return get_category_link( $category_id );
}

/**
 * 先頭表示の対応
 *
 * @param int $id id.
 * @return string
 */
function welcart_simpleplus_get_article_class( $id ) {
	// 先頭表示（Sticky Post）への対応.
	$sticky_posts = get_option( 'sticky_posts' );
	if ( in_array( $id, $sticky_posts, true ) ) {
		if ( has_post_thumbnail( $id ) ) {
			$grid_class = 'g-col-12 g-col-md-6 g-row-span-2 grid-size-big sticky-thumbnail';
		} else {
			$grid_class = 'g-col-12 g-col-md-6 g-row-span-2 grid-size-big';
		}
	} else {
		$grid_class = 'g-col-6 g-col-md-3';
	}
	return apply_filters( 'welcart_simpleplus_get_article_class', $grid_class );
}

/**
 * 角丸の数値に応じたクラスを付与
 *
 * @param string $setting_name Setting name of customizer.
 * @return string
 */
function welcart_simpleplus_get_round_class( $setting_name ) {
	$round = get_theme_mod( $setting_name, '15' );
	if ( (int) $round <= 10 ) {
		$grid_class = 'g-rounded-10';
	} elseif ( (int) $round <= 20 ) {
		$grid_class = 'g-rounded-20';
	} elseif ( (int) $round <= 30 ) {
		$grid_class = 'g-rounded-30';
	} elseif ( (int) $round <= 40 ) {
		$grid_class = 'g-rounded-40';
	} else { // 設定は50までの想定であるが、コード上の整合性のため50以上の場合にも50を返す.
		$grid_class = 'g-rounded-50';
	}
	return $grid_class;
}

/**
 * 画像の上にテキストを重ねた時の対応
 *
 * @param string $setting_name Setting name of customizer.
 * @return string
 */
function welcart_simpleplus_get_overlay_image_class( $setting_name ) {
	$overlay_image       = get_theme_mod( $setting_name, true );
	$overlay_image_class = '';
	if ( ! $overlay_image ) {
		$overlay_image_class = ' not-overlay-image';
	}
	return $overlay_image_class;
}

/**
 * 画像の上にテキストを重ねた時のテキストシャドウの対応
 *
 * @param string $setting_name Setting name of customizer.
 * @return string
 */
function welcart_simpleplus_get_text_shadow_class( $setting_name ) {
	$text_shadow       = get_theme_mod( $setting_name, false );
	$text_shadow_class = '';
	if ( $text_shadow ) {
		$text_shadow_class = ' add-ts';
	}
	return $text_shadow_class;
}

/**
 * SNSがあるかどうか
 *
 * @return bool
 */
function welcart_simpleplus_is_sns() {
	$sns_paterns = array( 'facebook', 'instagram', 'twitter', 'line', 'youtube' );
	$sns_paterns = apply_filters( 'welcart_simpleplus_the_sns_paterns', $sns_paterns );
	foreach ( $sns_paterns  as $key => $patern ) {
		$key_name       = get_theme_mod( $patern . '_page_name_setting', '' );
		$key_allow_disp = get_theme_mod( $patern . '_allow_disp_setting', false );
		if ( ! empty( $key_name ) && $key_allow_disp ) {
			return true;
		}
	}
	return false;
}

/**
 * SNS部分の表示
 *
 * @return void
 */
function welcart_simpleplus_the_sns() {
	$sns_paterns = array( 'facebook', 'instagram', 'twitter', 'line', 'youtube' );
	$sns_paterns = apply_filters( 'welcart_simpleplus_the_sns_paterns', $sns_paterns );
	$html        = '';
	foreach ( $sns_paterns  as $key => $patern ) {
		$key_name       = get_theme_mod( $patern . '_page_name_setting', '' );
		$key_allow_disp = get_theme_mod( $patern . '_allow_disp_setting', false );
		if ( ! empty( $key_name ) && $key_allow_disp ) {
			switch ( $patern ) {
				case 'facebook':
					$url = 'https://www.facebook.com/' . $key_name;
					break;
				case 'instagram':
					$url = 'https://www.instagram.com/' . $key_name;
					break;
				case 'twitter':
					$url = 'https://twitter.com/' . $key_name;
					break;
				default:
					$url = $key_name;
			}
			ob_start()
			?>
				<div class="col-auto">
					<a href="<?php echo esc_attr( $url ); ?>" target="_blank">
						<img width="40" height="40" src="<?php echo esc_url_raw( get_theme_file_uri( '/assets/svg/sns/ico-' . $patern . '.svg' ) ); ?>" alt="<?php echo esc_attr( $patern ); ?>" />
					</a>
				</div>
			<?php
			$content = ob_get_contents();
			ob_end_clean();
			$html .= apply_filters( 'welcart_simpleplus_sns_loop', $content, $patern );
		}
	}
	$html = apply_filters( 'welcart_simpleplus_sns', $html );
	echo wp_kses_post( $html );
}

/**
 * Header class
 *
 * @return void
 */
function welcart_simpleplus_header_class() {
	$scroll_class = get_theme_mod( 'menu-type_display_setting', 'every' );
	$scroll_class = apply_filters( 'welcart_simpleplus_header_class', $scroll_class );
	echo esc_attr( $scroll_class );
}

/**
 * カテゴリーのイメージの取得
 *
 * @param string       $term_slug term_slug.
 * @param string|array $size size.
 * @return string
 */
function welcart_simpleplus_get_term_img( $term_slug = null, $size = '' ) {
	$size = $size ? $size : 'full';
	if ( null === $term_slug ) {
		$term_slug = get_query_var( 'category_name' );
	}
	$term = get_term_by( 'slug', $term_slug, 'category' );
	if ( ! $term ) {
		return '';
	}
	$attachment_id = get_term_meta( $term->term_id, 'wcct-term-thumbnail-id', true );
	if ( ! isset( $attachment_id ) ) {
		return '';
	}
	return apply_filters( 'welcart_simpleplus_get_term_img', wp_get_attachment_image( $attachment_id, $size ) );
}

/**
 * The grid image tags
 *
 * @param object $post WP_Post.
 * @return void
 */
function welcart_simpleplus_the_grid_image_tags( $post ) {
	$display_tags          = get_theme_mod( 'itempage_display_tag_setting', false );
	$terms                 = wp_get_post_terms( $post->ID, 'category' );
	$term_slugs            = array_column( $terms, 'slug' );
	$target_slugs_new      = apply_filters( 'welcart_simpleplus_grid_tag_target_new', 'itemnew' );
	$target_slugs_itemreco = apply_filters( 'welcart_simpleplus_grid_tag_target_new', 'itemreco' );

	do_action( 'welcart_simpleplus_the_grid_image_tags_before' );
	// 新商品タグ.
	if ( $display_tags && in_array( $target_slugs_new, $term_slugs, true ) ) :
		$new_text = apply_filters( 'welcart_simpleplus_grid_tag_new_text', 'NEW' );
		?>
		<div class="grid-tag-area-new">
			<i class="grid-tag tag-new"><?php echo esc_html( $new_text ); ?></i>
		</div>
	<?php endif; ?>

	<?php do_action( 'usces_theme_favorite_icon' ); ?>

	<div class="grid-tag-area-category">
		<?php
		if ( $display_tags && in_array( $target_slugs_itemreco, $term_slugs, true ) ) :
			$itemreco_text = apply_filters( 'welcart_simpleplus_grid_tag_itemreco_text', 'HOT' );
			?>
			<i class="grid-tag tag-itemreco"><?php echo esc_html( $itemreco_text ); ?></i>
		<?php endif; ?>
		<?php
		if ( $display_tags && welcart_simpleplus_item_has_campaign( $post->ID ) ) :
			$sale_output = apply_filters( 'welcart_simpleplus_sale_tag_text', 'SALE' );
			?>
			<i class="grid-tag tag-sale"><?php echo esc_html( $sale_output ); ?></i>
		<?php endif; ?>
	</div>
	<?php
	do_action( 'welcart_simpleplus_the_grid_image_tags_after' );
}

/**
 * 商品がキャンペーン期間中かどうかの判定
 *
 * @param int $post_id post_id.
 * @return bool
 */
function welcart_simpleplus_item_has_campaign( $post_id = null ) {
	global $post, $usces;
	if ( null === $post_id ) {
		$post_id = $post->ID;
	}

	if ( 'Promotionsale' === $usces->options['display_mode'] && $post_id && in_category( (int) $usces->options['campaign_category'], $post_id ) ) {
		$res = true;
	} else {
		$res = false;
	}

	return apply_filters( 'welcart_simpleplus_item_has_campaign', $res );
}

/**
 * デフォルトのコピーライト表示を実装
 */
function welcart_simpleplus_copyright() {
	if ( function_exists( 'usces_copyright' ) ) {
		usces_copyright();
	} else {
		echo wp_kses_post( sprintf( '&copy; %s %s', gmdate( 'Y' ), bloginfo( 'title' ) ) );
	}
}

/**
 * カテゴリーページの対象商品数
 *
 * @param string $pre tag.
 * @param string $after tag.
 * @return void
 */
function welcart_simpleplus_category_count_item( $pre = '', $after = '' ) {
	global $wp_query;
	echo wp_kses_post( $pre . sprintf( __( '対象商品点数： %s点' ), $wp_query->found_posts ) . $after );
}

/**
 * カテゴリーページのページ表示
 *
 * @param string $pre tag.
 * @param string $after tag.
 * @return void
 */
function welcart_simpleplus_category_count_page( $pre = '', $after = '' ) {
	global $wp_query;

	// 商品件数の取得.
	$count = $wp_query->post_count;
	if ( 0 === $count ) {
		return; // 早期リターン.
	}

	// 現在のページ番号を取得.
	$current_pgae = welcart_simpleplus_category_is_first() - 1;
	// 1ページに表示する最大投稿数を取得.
	$num_posts = get_query_var( 'posts_per_page' );
	$from      = 0;

	if ( 0 < $num_posts ) {
		$total_item_num = $wp_query->found_posts;
		if ( 0 < $current_pgae ) {
			$from = $current_pgae * $num_posts;
		}
	}
	$last_count = $from + $count;
	if ( 1 < $count ) {
		$first_count = $from + 1;
	} else {
		$first_count = $last_count;
	}
	/* translators: %s: search term */
	echo wp_kses_post( $pre . sprintf( __( 'displays %1$s of the %2$s to %3$s in order', 'welcart_simpleplus' ), $total_item_num, $first_count, $last_count ) . $after );
}

/**
 * カテゴリー画像表示用に１ページ目かどうかの判定
 *
 * @return string
 */
function welcart_simpleplus_category_is_first() {
	$current_pgae = get_query_var( 'paged' );
	return 0 === $current_pgae ? 1 : $current_pgae;
}

/**
 * 商品画像の表示
 *
 * @param int    $number number.
 * @param string $size size.
 * @param string $post post.
 * @param string $out out.
 * @param string $media media.
 * @return void
 */
function welcart_simpleplus_usces_the_item_image( $number = 0, $size = 'thumbnail', $post = '', $out = '', $media = 'item' ) {
	echo wp_kses_post( welcart_simpleplus_usces_get_item_image( $number, $size, $post, $out, $media ) );
}

/**
 * グリッド商品画像の取得
 *
 * @param int    $number number.
 * @param string $size size.
 * @param string $post post.
 * @param string $out out.
 * @param string $media media.
 * @return string|boolean
 */
function welcart_simpleplus_usces_get_item_image( $number = 0, $size = 'thumbnail', $post = '', $out = '', $media = 'item' ) {
	global $usces;

	if ( '' === $post ) {
		global $post;
	}
	if ( ! $post ) {
		return;
	}

	$size_crop = get_theme_mod( 'image_settings_allow_image_rect_setting' ) ? '' : '-nocrop';
	if ( is_string( $size ) ) {
		$size = $size . $size_crop;
	}

	$post_id = $post->ID;

	$ptitle = '';
	if ( is_string( $number ) ) {
		$ptitle = $number;
	}
	if ( $ptitle ) {

		$picposts = new WP_Query(
			array(
				'post_type' => 'attachment',
				'name'      => $ptitle,
			)
		);
		$pictid   = empty( $picposts ) ? 0 : $picposts[0]->ID;
		$html     = wp_get_attachment_image( $pictid, $size, false );
		if ( 'item' === $media ) {
			$product = wel_get_product( $post_id );
			$code    = $product['itemCode'];
			$html    = welcart_simpleplus_replace_img_tags( $html, $code, $post_id, $pictid, $size );
			$html    = apply_filters( 'welcart_simpleplus_filter_main_img', $html, $post_id, $pictid, $size );
		}
	} else {

		$product = wel_get_product( $post_id );

		$code = $product['itemCode'];
		if ( ! $code ) {
			return false;
		}

		$name = $product['itemName'];

		if ( 0 === $number ) {
			$pictid    = (int) $usces->get_mainpictid( $code );
			$pictmeta  = wp_get_attachment_metadata( $pictid );
			$pictsizes = ( isset( $pictmeta['sizes'] ) && is_array( $pictmeta['sizes'] ) ) ? $pictmeta['sizes'] : array();

			if ( isset( $pictsizes['thumb-rect'] ) ) {
				$html = wp_get_attachment_image( $pictid, $size, true );
			} else {
				$html = wp_get_attachment_image( $pictid, apply_filters( 'welcart_simpleplus_not_thumbrect_image_size', 'medium' ), true );
			}

			if ( 'item' === $media ) {
				$html = welcart_simpleplus_replace_img_tags( $html, $code, $post_id, $pictid, $size, $name );
				$html = apply_filters( 'welcart_simpleplus_filter_main_img', $html, $post_id, $pictid, $size );
			}
		} else {
			$pictids   = $usces->get_pictids( $code );
			$ind       = $number - 1;
			$pictid    = ( isset( $pictids[ $ind ] ) && (int) $pictids[ $ind ] ) ? $pictids[ $ind ] : 0;
			$pictmeta  = wp_get_attachment_metadata( $pictid );
			$pictsizes = ( isset( $pictmeta['sizes'] ) && is_array( $pictmeta['sizes'] ) ) ? $pictmeta['sizes'] : array();

			if ( isset( $pictsizes['thumb-rect'] ) ) {
				$html = wp_get_attachment_image( $pictid, $size, false );
			} else {
				$html = wp_get_attachment_image( $pictid, apply_filters( 'welcart_simpleplus_not_thumbrect_image_size', 'medium' ), false );
			}

			if ( 'item' === $media ) {
				$html = welcart_simpleplus_replace_img_tags( $html, $code, $post_id, $pictid, $size, $name );
				$html = apply_filters( 'welcart_simpleplus_filter_sub_img', $html, $post_id, $pictid, $size );
			}
		}
	}
	return $html;
}

/**
 * 先頭固定表示商品のアイキャッチ画像対応
 *
 * @param string $size size.
 * @param int    $post_id post_id.
 */
function welcart_simpleplus_sticky_thumbnail( $size = 'thumbnail', $post_id = null ) {
	global $post;
	if ( null === $post_id ) {
		$post_id = $post->ID;
	}

	$sticky_posts = get_option( 'sticky_posts' );
	if ( ! in_array( $post_id, $sticky_posts, true ) ) {
		return;
	}

	$size_crop = get_theme_mod( 'image_settings_allow_image_rect_setting' ) ? '' : '-nocrop';
	if ( is_string( $size ) ) {
		$size = $size . $size_crop;
	}

	$html = '';
	if ( has_post_thumbnail( $post_id ) ) {
		$thumbid    = get_post_thumbnail_id( $post_id );
		$thumbmeta  = wp_get_attachment_metadata( $thumbid );
		$thumbsizes = ( isset( $thumbmeta['sizes'] ) && is_array( $thumbmeta['sizes'] ) ) ? $thumbmeta['sizes'] : array();

		if ( isset( $thumbsizes['thumb-rect'] ) ) {
			$html = get_the_post_thumbnail( $post_id, $size );
		} else {
			$html = get_the_post_thumbnail( $post_id, apply_filters( 'welcart_simpleplus_not_thumbrect_sticky_image_size', 'large' ) );
		}
	}
	echo wp_kses_post( $html );
}

/**
 * Replace img tags
 *
 * @param string $html html.
 * @param string $code code.
 * @param int    $post_id post_id.
 * @param int    $pictid pictid.
 * @param string $size size.
 * @param string $name name.
 * @return string
 */
function welcart_simpleplus_replace_img_tags( $html = '', $code = '', $post_id = 0, $pictid = 0, $size = '', $name = '' ) {
	$width  = isset( $size['width'] ) ? $size['width'] : 60;
	$height = isset( $size['height'] ) ? $size['height'] : 60;
	$alt    = 'alt="' . esc_attr( $code ) . '"';
	$alt    = apply_filters( 'usces_filter_img_alt', $alt, $post_id, $pictid, $width, $height );
	$html   = preg_replace( '/alt=\"[^\"]*\"/', $alt, $html );
	$title  = 'title="' . esc_attr( $name ) . '"';
	$title  = apply_filters( 'usces_filter_img_title', $title, $post_id, $pictid, $width, $height );
	$html   = preg_replace( '/title=\"[^\"]+\"/', $title, $html );
	return $html;
}

/**
 * Get header image
 *
 * @return void
 */
function welcart_simpleplus_header_image() {
	if ( ! ( ( is_front_page() || is_home() ) && get_header_image() ) ) {
		return;
	}

	$get_header_image = get_header_image();
	$sp_image         = get_theme_mod( 'top_main_image_sp_setting', '' );
	$main_image_class = $sp_image ? 'd-none d-md-inline-block' : '';
	?>

	<!-- トップ画像 -->
	<div class="main-image-area">
		<div class="text-white position-absolute top-50 start-50 translate-middle">
			<img src="<?php header_image(); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" class="main-image <?php echo esc_attr( $main_image_class ); ?>" alt="header_image" />
			<?php if ( $sp_image ) : ?>
				<img src="<?php echo esc_url_raw( get_theme_mod( 'top_main_image_sp_setting', $get_header_image ) ); ?>" height="100vh" width="100%" class="main-image d-md-none" alt="header_image" />
			<?php endif; ?>
		</div>
		<div class="scroll-on-main-image text-white position-absolute start-50 bottom-0 translate-middle">
			<span class="d-none">scroll</span>
		</div>
	</div>
	<?php welcart_simpleplus_the_notice( 'under-main-image' ); ?>
	<?php
}

/**
 * The notice
 *
 * @param string $position position.
 * @return void
 */
function welcart_simpleplus_the_notice( $position = 'content-top' ) {
	$settings  = array(
		'over-header'      => 'welcart_simpleplus_header_before',
		'under-main-image' => 'welcart_simpleplus_after_header_image',
		'content-top'      => 'welcart_simpleplus_content_before',
	);
	$theme_mod = get_theme_mod( 'notice_notice_area_setting', 'content-top' );
	if ( $position !== $theme_mod ) {
		return;
	}
	get_template_part( 'template-parts/front/content', 'notice' );
}

/**
 * The notice class
 *
 * @return void
 */
function welcart_simpleplus_the_notice_class() {
	$notice_position_class = get_theme_mod( 'notice_notice_area_setting', 'content-top' );
	$header_position_class = get_theme_mod( 'menu-type_display_setting', 'every' );

	$notice_class  = '';
	$notice_class .= $notice_position_class . ' ' . $header_position_class;

	echo esc_attr( $notice_class );
}

/**
 * Single item image carousel
 *
 * @return void
 */
function welcart_simpleplus_single_item_image_carousel() {
	global $post;

	$image_rect       = get_theme_mod( 'image_settings_allow_image_rect_setting', true );
	$image_rect_class = ( $image_rect ) ? 'carouesl-cover' : 'carouesl-contain';

	$images = array();
	if ( $image_rect ) {
		$images[] = array(
			'url' => usces_the_itemImage( 0, 600, 600, $post, 'return' ),
			'cap' => usces_the_itemImageDescription( 0, $post, 'return' ),
		);
	} else {
		$images[] = array(
			'url' => usces_the_itemImage( 0, 1024, 1024, $post, 'return' ),
			'cap' => usces_the_itemImageDescription( 0, $post, 'return' ),
		);
	}
	$imageids = usces_get_itemSubImageNums();
	if ( ! empty( $imageids ) ) {
		if ( $image_rect ) {
			foreach ( $imageids as $imageid ) {
				$images[] = array(
					'url' => usces_the_itemImage( $imageid, 600, 600, $post, 'return' ),
					'cap' => usces_the_itemImageDescription( $imageid, $post, 'return' ),
				);
			}
		} else {
			foreach ( $imageids as $imageid ) {
				$images[] = array(
					'url' => usces_the_itemImage( $imageid, 1024, 1024, $post, 'return' ),
					'cap' => usces_the_itemImageDescription( $imageid, $post, 'return' ),
				);
			}
		}
	}
	?>
	<div id="singleItemCarousel" class="carousel slide single-item-carousel <?php echo esc_attr( $image_rect_class ); ?>" data-bs-interval="false" data-bs-ride="carousel">

		<div class="carousel-inner">
			<?php
			$active = 'active';
			foreach ( $images as $key => $image ) :
				?>
					<div class="carousel-item <?php echo esc_attr( $active ); ?>">
						<?php echo wp_kses_post( $image['url'] ); ?>
						<div class="caption"><?php echo wp_kses_post( $image['cap'] ); ?></div>
					</div>
				<?php
				$active = '';
			endforeach;
			?>
			<span class="carousel-num"></span>

			<div class="control-tags">
				<?php welcart_simpleplus_the_grid_image_tags( $post ); ?>
				<a class="carousel-control-prev" href="#singleItemCarousel" role="button" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				</a>
				<a class="carousel-control-next" href="#singleItemCarousel" role="button" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
				</a>
			</div>
		</div>
		<div class="items-carousel-indicators d-none d-md-flex row row-cols-md-4 row-cols-lg-6 justify-content-start">
			<?php
			$active = 'active';
			foreach ( $images as $key => $image ) :
				?>
				<div data-bs-target="#singleItemCarousel" data-bs-slide-to="<?php echo esc_attr( $key ); ?>" class="<?php echo esc_attr( $active ); ?>">
					<?php echo wp_kses_post( $image['url'] ); ?>
				</div>
				<?php
				$active = '';
			endforeach;
			?>
		</div>
	</div>
	<?php
}

/**
 * SKU Image
 *
 * @param string $size size.
 * @return void
 */
function welcart_simpleplus_skuimg( $size = 'thumbnail' ) {
	global $usces;
	$sku_img_id = $usces->get_subpictid( usces_the_itemSku( 'return' ) );
	if ( ! $sku_img_id ) {
		return;
	}
	echo wp_get_attachment_image( $sku_img_id, $size, true );
}

/**
 * SKU info
 *
 * @return string
 */
function welcart_simpleplus_skuinfo() {
	global $usces;
	$sku_img  = $usces->get_subpictid( usces_the_itemSku( 'return' ) );
	$sku_name = usces_the_itemSkuDisp( 'return' );
	if ( ! $sku_img && '' === $sku_name ) {
		return false;
	}
	?>
	<div class="skuinfo">
		<?php welcart_simpleplus_skuimg(); ?>
		<?php if ( '' !== $sku_name ) : ?>
			<div class="sku-name"><?php usces_the_itemSkuDisp(); ?></div>
		<?php endif; ?>
	</div><!-- .skuinfo -->
	<?php
}

/**
 * View Reviews
 *
 * @return void
 */
function welcart_simpleplus_view_reviews() {
	$view_reviews = get_theme_mod( 'itempage_reviews_setting' );
	if ( ! $view_reviews ) {
		return;
	}
	?>
	<div id="accordion-reviews" class="accordion-item">
		<h2 class="accordion-header" id="panelsStayOpen-headingTwo">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
				<?php echo esc_html_e( 'Review', 'welcart_simpleplus' ); ?>
			</button>
		</h2>
		<div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
		<div class="accordion-body">
			<div id="wc-reviews" class="item-reviews">
				<?php comments_template( '/wc_templates/wc_review-list.php', false ); ?>
				<?php comments_template( '/wc_templates/wc_review.php', false ); ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Number Review
 *
 * @param int $post_id postID.
 * @return void
 */
function welcart_simpleplus_num_review_text_anchor( $post_id = null ) {
	global $post;
	$view_reviews = get_theme_mod( 'itempage_reviews_setting' );
	if ( ! $view_reviews ) {
		return;
	}
	if ( null === $post_id ) {
		$post_id = $post->ID;
	}
	$open_review = comments_open( $post_id );
	if ( ! $open_review ) {
		return;
	}
	$num_reviews = get_comments_number( $post_id );
	if ( 0 < $num_reviews ) {
		?>
	<p class="num-review">
		<a href="#accordion-reviews">
			<img width="15px" height="16px" src="<?php echo esc_url_raw( get_theme_file_uri( '/assets/icon/ico-note.svg' ) ); ?>" alt="review" />
			<?php /* translators: %s: search term */ ?>
			<?php printf( esc_attr__( '%s reviews', 'welcart_simpleplus' ), esc_attr( number_format_i18n( $num_reviews ) ) ); ?>
		</a>
	</p>
		<?php
	}
}

/**
 * Get current link
 *
 * @return string
 */
function welcart_simpleplus_get_current_link() {
	$current_url = empty( $_SERVER['HTTPS'] ) ? 'http://' : 'https://';
	$current_url = isset( $_SERVER['HTTP_HOST'] ) ? esc_url_raw( $current_url . wp_unslash( $_SERVER['HTTP_HOST'] ), PHP_URL_HOST ) : '';
	$current_url = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( $current_url . wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

	return apply_filters( 'welcart_simpleplus_get_current_link', $current_url );
}

if ( ! function_exists( 'wc_review' ) ) {

	/**
	 * Review.
	 *
	 * @param string $comment Comment.
	 * @param array  $args Comment.
	 * @param array  $depth Comment.
	 */
	function wc_review( $comment, $args, $depth ) { // phpcs:ignore
		global $welcart_simpleplus_setup;
		$welcart_simpleplus_setup->review_customize->wc_review( $comment, $args, $depth );
	}
}

/**
 * 在庫僅少、在庫無しのタグ表示
 *
 * @param int $post_id post_id.
 * @return void
 */
function welcart_simpleplus_the_stocks( $post_id = null ) {
	global $post;
	$html = '';
	if ( null === $post_id ) {
		$post_id = $post->ID;
	}

	if ( ! usces_have_zaiko_anyone( $post_id ) ) {// nullチェックはusces_have_zaiko_anyoneで行なっている.
		$html .= '<i class="tag tag-soldout">' . welcart_simpleplus_soldout_label( $post_id, 'return' ) . '</i>' . "\n";
	} elseif ( usces_have_fewstock( $post_id ) ) { // nullチェックはusces_have_fewstockで行なっている.
		$html = '<i class="tag tag-fewstock">' . __( 'Few Stock', 'welcart_simpleplus' ) . '</i>' . "\n";
	}
	echo wp_kses_post( apply_filters( 'welcart_simpleplus_the_stocks', $html ) );
}

/**
 * Soldout label
 *
 * @param int    $post_id Post ID.
 * @param string $out Return value or echo.
 * @return string|void
 */
function welcart_simpleplus_soldout_label( $post_id, $out = '' ) {
	global $usces;

	$stock_status = __( 'Soldout', 'welcart_simpleplus' );
	$skus         = wel_get_skus( $post_id );
	if ( 1 === count( (array) $skus ) ) {
		$stock = $skus[0]['stock'];
		if ( 2 !== (int) $stock ) {
			$stock_status = $usces->zaiko_status[ $stock ];
		}
	}
	$stock_status = apply_filters( 'welcart_simpleplus_filter_soldout_label', $stock_status, $post_id, $skus );
	if ( 'return' === $out ) {
		return $stock_status;
	} else {
		echo esc_html( $stock_status );
	}
}

/**
 * The category filter dropdown
 *
 * @return void|string
 */
function welcart_simpleplus_the_category_filter_dropdown() {
	$category_slug    = get_query_var( 'category_name' );
	$current_category = get_category_by_slug( $category_slug );
	if ( ! $current_category ) {
		return;
	}

	$args       = array(
		'type'         => 'post',
		'parent'       => $current_category->term_id,
		'orderby'      => 'name',
		'order'        => 'ASC',
		'hide_empty'   => 1,
		'hierarchical' => 1,
	);
	$categories = get_categories( $args );
	if ( empty( $categories ) ) {
		return;
	}
	ob_start();
	?>
	<div class="dropdown filter-category d-flex flex-column align-items-center">
		<button class="btn btn-filter" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
		<svg id="ico-filter" xmlns="http://www.w3.org/2000/svg" width="20.001" height="18.889" viewBox="0 0 20.001 18.889"><path d="M7.444,3a4.446,4.446,0,0,1,4.3,3.333h9.029V8.556H11.749A4.445,4.445,0,1,1,7.444,3Zm0,6.667A2.222,2.222,0,1,0,5.222,7.444,2.222,2.222,0,0,0,7.444,9.667Z" transform="translate(-3 -3)" fill="#777" fill-rule="evenodd"/><path d="M18.333,20.889a4.447,4.447,0,0,1-4.3-3.333H5V15.333h9.029a4.445,4.445,0,1,1,4.3,5.556Zm0-2.222a2.222,2.222,0,1,0-2.222-2.222A2.222,2.222,0,0,0,18.333,18.667Z" transform="translate(-2.777 -2)" fill="#777" fill-rule="evenodd"/></svg>

		<?php esc_html_e( 'narrow down', 'welcart_simpleplus' ); ?>
		</button>
		<ul class="dropdown-menu"  aria-labelledby="dropdownMenuButton1">
			<?php
			foreach ( $categories as $key => $cat ) :
				$category_img = welcart_simpleplus_get_term_img( $cat->slug, array( '44', '44' ) );
				?>
				<li>
					<a class="dropdown-item" href="<?php echo esc_attr( get_category_link( $cat->term_id ) ); ?>">
						<?php if ( ! empty( $category_img ) ) : ?>
							<span class="d-inline-block me-2"><?php echo wp_kses_post( $category_img ); ?></span>
						<?php endif; ?>
						<span class="d-inline-block link-text"><?php echo esc_html( $cat->name ); ?></span>
					</a>
				</li>
				<li><hr class="dropdown-divider"></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
	$html = ob_get_contents();
	ob_end_clean();

	$kses_defaults = wp_kses_allowed_html( 'post' );
	$svg_args      = array(
		'svg'   => array(
			'id'              => true,
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true, // <= Must be lower case!.
		),
		'g'     => array( 'fill' => true ),
		'title' => array( 'title' => true ),
		'path'  => array(
			'd'         => true,
			'fill'      => true,
			'transform' => true,
		),
	);

	$allowed_tags = array_merge( $kses_defaults, $svg_args );
	echo wp_kses( $html, $allowed_tags );
}

/**
 * Get inquiry link url
 *
 * @return string
 */
function welcart_simpleplus_get_inquiry_link_url() {

	$contact_page_id = get_theme_mod( 'itempage_contact_page_setting', '' );

	if ( defined( 'WPCF7_VERSION' ) ) {
		global $post;
		$item_id  = $post->ID;
		$sku_code = rawurlencode( usces_the_itemSku( 'return' ) );

		$url = add_query_arg(
			array(
				'from_item' => $item_id,
				'from_sku'  => $sku_code,
			),
			get_permalink( $contact_page_id )
		);

	} else {
		$url = get_permalink( $contact_page_id );
	}
	return $url;
}

/**
 * Mail components
 *
 * @return string
 */
if ( defined( 'WPCF7_VERSION' ) ) {

	/**
	 * Contact Form 7.
	 *
	 * @param object $components Comment.
	 * @param object $current_form Comment.
	 * @param object $mail_object Comment.
	 */
	function welcart_simpleplus_mail_components( $components, $current_form, $mail_object ) {
		global $usces;
		// phpcs:disable WordPress.Security.NonceVerification.Missing
		$post_id = isset( $_POST['from_item'] ) ? sanitize_text_field( wp_unslash( $_POST['from_item'] ) ) : '';
		if ( strlen( $post_id ) > 0 ) {
			$itemname = $usces->getItemName( $post_id );
			$skucode  = isset( $_POST['from_sku'] ) ? sanitize_text_field( wp_unslash( $_POST['from_sku'] ) ) : '';
			$skuname  = ( strlen( $skucode ) > 0 ) ? $usces->getItemSkuDisp( $post_id, $skucode ) : '';
			$body     = $components['body'];
			if ( strlen( $itemname ) > 0 && strlen( $skuname ) > 0 ) {
				$components['body'] = __( 'item name', 'usces' ) . '：' . $itemname . ' ' . $skuname . "\n" . $body;
			} elseif ( strlen( $itemname ) > 0 ) {
				$components['body'] = __( 'item name', 'usces' ) . '：' . $itemname . "\n" . $body;
			}
		}
		return $components;
		// phpcs:enable WordPress.Security.NonceVerification.Missing
	}
	add_filter( 'wpcf7_mail_components', 'welcart_simpleplus_mail_components', 10, 3 );
}

/**
 * Soldout
 *
 * @return void|string
 */
function welcart_simpleplus_soldout() {
	$contact_btn = get_theme_mod( 'itempage_contact_btn_setting', 'soldout' );
	ob_start();
	$contact_text = get_theme_mod( 'itempage_contact_text_setting', __( 'Inquiries regarding this item', 'welcart_simpleplus' ) );
	$soldout_text = get_theme_mod( 'itempage_soldout_text_setting', __( 'At present we cannot deal with this product.', 'welcart_simpleplus' ) );
	?>
		<?php if ( 'soldout' === $contact_btn ) : ?>
			<div class="soldout-contact-btn inquiry itemsoldout">
				<a href="<?php echo esc_url( welcart_simpleplus_get_inquiry_link_url() ); ?>"><?php echo esc_html( $contact_text ); ?></a>
			</div>
		<?php else : ?>
			<div class="itemsoldout">
				<?php echo esc_html( $soldout_text ); ?>
			</div>
		<?php endif; ?>
	<?php
	$html = ob_get_contents();
	ob_end_clean();
	echo wp_kses_post( apply_filters( 'welcart_simpleplus_soldout', $html ) );
}
