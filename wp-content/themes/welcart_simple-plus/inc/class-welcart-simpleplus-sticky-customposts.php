<?php
/**
 * 先頭固定表示
 *
 * @package welcart
 */

/**
 * Welcart simpleplus sticky custom posts
 */
class Welcart_Simpleplus_Sticky_CustomPosts {

	/**
	 * Constructer
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'super_sticky_add_meta_box' ) );
		add_action( 'pre_get_posts', array( $this, 'sticky_top_pre_get_posts' ), 100 );
		add_action( 'posts_orderby', array( $this, 'sticky_top_posts_orderby' ), 100, 20 );
		add_action( 'admin_footer', array( $this, 'remove_default_sticky_checkbox' ) );
	}

	/**
	 * Remove default sticky checkbox
	 * デフォルトの先頭固定表示が邪魔になるので削除
	 *
	 * @return void
	 */
	public function remove_default_sticky_checkbox() {
		global $post;
		if ( $post && 'item' !== $post->post_mime_type ) {
			return;
		}
		?>
		<script>
			jQuery(function ($) {
				$('#post-visibility-select #sticky-span').remove();
			})
		</script>
		<?php
	}

	/**
	 * Super sticky filter
	 *
	 * @param array $query_type query_type.
	 * @return array
	 */
	public function super_sticky_filter( $query_type ) {
		$filters = (array) apply_filters( 'welcart_simpleplus_sticky_filters', array( 'home' ) );
		return in_array( $query_type, $filters, true );
	}

	/**
	 * Super sticky post types
	 *
	 * @return array
	 */
	public function super_sticky_post_types() {
		return (array) apply_filters( 'welcart_simpleplus_sticky_post_types', array( 'topic', 'post', 'news' ) );
	}

	/**
	 * Super sticky meta
	 *
	 * @return void
	 */
	public function super_sticky_meta() {
		?>
		<input id="super-sticky" name="sticky" type="checkbox" value="sticky" <?php checked( is_sticky() ); ?> />
		<label for="super-sticky" class="selectit">
			<?php esc_attr_e( 'Fixed display at the top', 'welcart_simpleplus' ); ?>
			</label>
		<?php
	}

	/**
	 * Super sticky add meta box
	 *
	 * @return void
	 */
	public function super_sticky_add_meta_box() {
		if ( ! current_user_can( 'edit_others_posts' ) ) {
			return;
		}

		foreach ( $this->super_sticky_post_types() as $post_type ) {
			add_meta_box( 'super_sticky_meta', __( 'Sticky' ), array( $this, 'super_sticky_meta' ), $post_type, 'side', 'high' );
		}
	}

	/**
	 * Add Filter pre_get_posts.
	 *
	 * @param object $query WP_Query.
	 *
	 * @return void
	 */
	public function sticky_top_pre_get_posts( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( is_category() ) {
			if ( $query->get( 'cat' ) ) {
				$cat_obj = get_category( $query->get( 'cat' ) );
			} elseif ( $query->get( 'category_name' ) ) {
				$cat_obj = get_category_by_slug( $query->get( 'category_name' ) );
			}
			$item_obj = get_category_by_slug( 'item' );
			if ( empty( $cat_obj ) || empty( $item_obj ) ) {
				return;
			}
			if ( $item_obj->term_id !== $cat_obj->term_id && false === cat_is_ancestor_of( $item_obj, $cat_obj ) ) { // 商品カテゴリ配下.
				return;
			}
			$query->set( 'post__not_in', array() );
			$query->set( 'simpleplus_sticky', 'on' );
		}

		if ( is_post_type_archive( 'topic' ) ) { // 特集配下.
			$query->set( 'post__not_in', array() );
			$query->set( 'simpleplus_sticky', 'on' );
		}

		if ( is_post_type_archive( 'news' ) ) { // 特集配下.
			$query->set( 'post__not_in', array() );
			$query->set( 'simpleplus_sticky', 'on' );
		}

		if ( is_single() ) {
			$post__not_in = $query->get( 'post__not_in' );
			$sticky_posts = get_option( 'sticky_posts' );
			$query->set( 'post__not_in', array_diff( $post__not_in, $sticky_posts ) );
		}

		if ( is_search() ) {
			$query->set( 'post__not_in', array() );
			$query->set( 'simpleplus_sticky', 'off' );
		}

	}

	/**
	 * Add Filter posts_orderby.
	 *
	 * @param string $orderby Order By.
	 * @param object $query WP_Query.
	 */
	public function sticky_top_posts_orderby( $orderby, $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return $orderby;
		}
		if ( 'on' !== $query->get( 'simpleplus_sticky' ) ) {
			return $orderby;
		}
		global $wpdb;
		$sticky_posts = get_option( 'sticky_posts' );
		if ( is_array( $sticky_posts ) && count( $sticky_posts ) > 0 ) {

			$orderby = "FIELD({$wpdb->posts}.ID," . implode( ',', $sticky_posts ) . ") DESC, {$orderby}";
		}

		return $orderby;
	}

}
?>
