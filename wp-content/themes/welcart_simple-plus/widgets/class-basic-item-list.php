<?php
/**
 * Basic item list class
 *
 * @package Welcart
 */

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
/**
 * Basic_Item_List
 */
class Basic_Item_List extends WP_Widget {
// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound

	/**
	 * Constructer
	 */
	public function __construct() {
		parent::__construct( false, $name = __( 'Welcart product list', 'welcart_simpleplus' ) );
	}

	/**
	 * Widget
	 *
	 * @param array $args args.
	 * @param array $instance instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		extract( $args ); // phpcs:ignore

		$html    = '';
		$title   = empty( $instance['title'] ) ? '' : $instance['title'];
		$term_id = empty( $instance['term_id'] ) ? usces_get_cat_id( 'item' ) : $instance['term_id'];
		$number  = empty( $instance['number'] ) ? 10 : $instance['number'];

		echo wp_kses_post( $before_widget );
		if ( ! empty( $title ) ) {
			echo wp_kses_post( $before_title ) . esc_html( $title ) . wp_kses_post( $after_title );
		}

		$item_args  = array(
			'cat'            => $term_id,
			'posts_per_page' => $number,
		);
		$item_query = new WP_Query( $item_args );
		if ( $item_query->have_posts() ) {
			$html .= '<div class="item-list">';
			$html .= '<div class="grid">';
			while ( $item_query->have_posts() ) {
				$item_query->the_post();
				usces_the_item();
				$post_id = get_the_ID();
				ob_start();
					get_template_part( 'template-parts/front/content', 'other_items' );
				$html .= ob_get_contents();
				ob_end_clean();
				$html = apply_filters( 'welcart_simpleplus_filter_item_post', $html, $post_id );
			}
			wp_reset_postdata();
			$html .= '</div>';
			$html .= '</div>';
		}
		$html = apply_filters( 'welcart_simpleplus_filter_item_list', $html, $term_id, $number );
		// phpcs:ignore
		echo $html;
		echo wp_kses_post( $after_widget );
	}

	/**
	 * Form
	 *
	 * @param array $instance instance.
	 * @return void
	 */
	public function form( $instance ) {
		$item_term_id       = usces_get_cat_id( 'item' );
		$title              = empty( $instance['title'] ) ? '' : $instance['title'];
		$term_id            = empty( $instance['term_id'] ) ? $item_term_id : $instance['term_id'];
		$number             = empty( $instance['number'] ) ? 10 : $instance['number'];
		$target_arg         = array(
			'child_of' => $item_term_id,
		);
		$target_terms       = get_terms( 'category', $target_arg );
		$field_title        = $this->get_field_id( 'title' );
		$field_name         = $this->get_field_name( 'title' );
		$field_id           = $this->get_field_id( 'number' );
		$field_name_number  = $this->get_field_name( 'number' );
		$field_id_term_id   = $this->get_field_id( 'term_id' );
		$field_name_term_id = $this->get_field_name( 'term_id' )
		?>
		<p>
			<label for="<?php echo esc_attr( $field_title ); ?>"><?php esc_html_e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $field_title ); ?>" name="<?php echo esc_attr( $field_name ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $field_id_term_id ); ?>">
				<?php esc_html_e( 'Product category to show:', 'welcart_simpleplus' ); ?>
			</label>
			<select class="widefat" id="<?php echo esc_attr( $field_id_term_id ); ?>" name="<?php echo esc_attr( $field_name_term_id ); ?>">
				<option value="<?php echo esc_attr( $item_term_id ); ?>" <?php selected( $item_term_id, $term_id ); ?>>
					<?php esc_html_e( 'Items', 'usces' ); ?>
				</option>
				<?php foreach ( $target_terms as $term ) : ?>
					<option value="<?php echo esc_attr( $term->term_id ); ?>" <?php selected( $term_id, $term->term_id ); ?>>
						<?php echo esc_attr( $term->name ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $field_id ); ?>">
				<?php esc_html_e( 'Number of posts to show:' ); ?>
			</label>
			<input class="tiny-text" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_name_number ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3">
		</p>
		<?php
	}

	/**
	 * Update
	 *
	 * @param array $new_instance new_instance.
	 * @param array $old_instance old_instance.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = wp_strip_all_tags( $new_instance['title'] );
		$instance['term_id'] = wp_strip_all_tags( $new_instance['term_id'] );
		$instance['number']  = wp_strip_all_tags( $new_instance['number'] );
		return $instance;
	}
}
