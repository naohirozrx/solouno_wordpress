<?php
/**
 * The Term Customized for our theme
 *
 * @package Welcart
 * @subpackage welcart_simpleplus
 * @since 1.0.0
 */

/**
 * Category Custom Fields
 */
class Welcart_Simpleplus_Term_Customize {

	/**
	 * Constructer
	 */
	public function __construct() {
		add_action( 'category_edit_form_fields', array( $this, 'edit_form_fields' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
		add_action( 'category_add_form_fields', array( $this, 'add_form_fields' ) );
		add_action( 'created_category', array( $this, 'update_term_meta' ) );
		add_action( 'edited_category', array( $this, 'update_term_meta' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enque_script' ), 11 );

		/**
		 * Category description.
		 */
		remove_filter( 'pre_term_description', 'wp_filter_kses' );
		remove_filter( 'term_description', 'wp_kses_data' );

		add_filter( 'category_edit_form_fields', array( $this, 'add_description' ) );

	}

	/**
	 * Admin enqueue scripts of category edit page.
	 * カテゴリー編集ページにスタイルを読み込む
	 *
	 * @param string $hook hook.
	 * @return void
	 */
	public function admin_enqueue( $hook ) {
		if ( ( 'term.php' === $hook || 'edit-tags.php' === $hook ) && 'category' === get_current_screen()->taxonomy ) {
			wp_enqueue_media();
		}
	}

	/**
	 * Set custom fields on the category edit top page.
	 * カテゴリー編集トップページにカスタムフィールドを設置
	 *
	 * @param string $taxonomy taxonomy.
	 * @return void
	 */
	public function add_form_fields( $taxonomy ) {
		?>
			<div class="form-field wcct-image-uploader new-form-field">
				<label for="wcct-term-thumbnail"><?php esc_html_e( 'Category image', 'welcart_simpleplus' ); ?></label>
				<p class="thumbnail-form">
					<input name="wcct-term-thumbnail-url" id="wcct-term-thumbnail-url" type="text" value="">
					<button type="button" class="button upload-button" id="wcct-term-thumbnail-action"><?php esc_html_e( 'Select Image', 'welcart_simpleplus' ); ?></button>
				</p>
				<p id="wcct-term-thumbnail-preview" class="wcct-term-thumbnail-preview"></p>
				<input name="wcct-term-thumbnail-id" id="wcct-term-thumbnail-id" type="hidden" value="">
				<?php wp_nonce_field( 'wcct_custom_terms_nonce', 'wcct_custom_terms_nonce_field' ); ?>
			</div>
		<?php
	}

	/**
	 * Set custom fields on the category edit page.
	 * カテゴリー編集ページにカスタムフィールドを設置
	 *
	 * @param object $tag WP_Term.
	 * @param string $taxonomy taxonomy.
	 * @return void
	 */
	public function edit_form_fields( $tag, $taxonomy = null ) {
		$url = get_term_meta( $tag->term_id, 'wcct-term-thumbnail-url', true );
		$id  = get_term_meta( $tag->term_id, 'wcct-term-thumbnail-id', true );
		?>
		<tr class="form-field wcct-image-uploader edit-form-field">
			<th scope="row" valign="top"><label for="wcct-term-thumbnail"><?php esc_html_e( 'Category image', 'welcart_simpleplus' ); ?></label></th>
			<td>
				<p class="thumbnail-form">
					<input name="wcct-term-thumbnail-url" id="wcct-term-thumbnail-url" type="text" value="<?php echo esc_url_raw( $url ); ?>">
					<button type="button" class="button upload-button" id="wcct-term-thumbnail-action"><?php esc_html_e( 'Select Image' ); ?></button>
				</p>
				<p id="wcct-term-thumbnail-preview" class="wcct-term-thumbnail-preview">
				<?php if ( ! empty( $url ) ) : ?>
					<img style="max-width: 100%;" src="<?php echo esc_url_raw( $url ); ?>" />
				<?php endif; ?>
				</p>
				<input name="wcct-term-thumbnail-id" id="wcct-term-thumbnail-id" type="hidden" value="<?php echo absint( $id ); ?>">
				<?php wp_nonce_field( 'wcct_custom_terms_nonce', 'wcct_custom_terms_nonce_field' ); ?>
			</td>
		</tr>
		<?php
	}

	/**
	 * Set create_term + edit_terms.
	 * 入力したフィールド値を保存
	 *
	 * @param int $term_id term_id.
	 * @return void
	 */
	public function update_term_meta( $term_id ) {
		if ( ! isset( $_POST['wcct_custom_terms_nonce_field'] )
		|| ! wp_verify_nonce(
			sanitize_key( wp_unslash( $_POST['wcct_custom_terms_nonce_field'] ) ),
			'wcct_custom_terms_nonce'
		)
		) {
			wp_nonce_ays();
		}
		$post_keys = array( 'wcct-term-thumbnail' ); // 画像の数を増やす場合はこちらを設定する
		foreach ( $post_keys as $key ) {
			$post_url = $key . '-url';
			$post_id  = $key . '-id';
			if ( isset( $_POST[ $post_url ] ) ) {
				$url = trim( esc_url_raw( wp_unslash( $_POST[ $post_url ] ) ) );
				if ( isset( $_POST[ $post_id ] ) ) {
					$id = (int) absint( wp_unslash( $_POST[ $post_id ] ) );
				}
				if ( empty( $url ) ) {
					$id = '';
				}
				update_term_meta( $term_id, $post_url, esc_url( $url ) );
				update_term_meta( $term_id, $post_id, $id );
			}
		}
	}

	/**
	 * Media Libray.
	 */
	public function admin_enque_script() {
		global $current_screen;
		$currentScreen = '';
		if ( isset( $current_screen ) ) {
			$currentScreen = $current_screen->id;
		}
		$data = array(
			'currentScreen'           => $currentScreen,
			'frontPageText'           => __( 'Front page', 'welcart_simpleplus' ),
			'setTheCategoryImageText' => __( 'Set the category image', 'welcart_simpleplus' ),
			'categoryImageText'       => __( 'Category image', 'welcart_simpleplus' ),
			'setTheCategoryImageText' => __( 'Set the category image', 'welcart_simpleplus' ),
		);
		wp_localize_script( 'welcart_simpleplus_admin_script', 'term_args', $data );
	}

	/**
	 * Add description
	 *
	 * @param object $tag WP_Term.
	 * @return void
	 */
	public function add_description( $tag ) {
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="description"><?php esc_html_e( 'Description' ); ?></label></th>
			<td>
			<?php
			$settings = array(
				'wpautop'       => true,
				'tinymce'       => false,
				'media_buttons' => true,
				'quicktags'     => true,
				'textarea_rows' => '15',
				'textarea_name' => 'description',
			);
			wp_editor( wp_kses_post( $tag->description, ENT_QUOTES, 'UTF-8' ), 'wcct_description', $settings );
			?>
				<br />
				<span class="description"><?php esc_html_e( 'The description is not prominent by default; however, some themes may show it.' ); ?></span>
			</td>
		</tr>
			<?php
	}
}
