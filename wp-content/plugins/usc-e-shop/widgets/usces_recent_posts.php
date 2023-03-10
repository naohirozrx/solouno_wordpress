<?php

class Welcart_Recent_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'usces_recent_entries', 'description' => (__( "Your site&#8217;s most recent posts.", 'usces').__( 'Non-item', 'usces' ) ) );
		parent::__construct('usces-recent-posts', 'Welcart '.__('Recent Posts', 'usces'), $widget_ops);
		$this->alt_option_name = 'usces_recent_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('usces_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		usces_remove_filter();

		ob_start();
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'usces') : $instance['title'], $instance, $this->id_base);
		$number = ( isset( $instance['number'] ) ) ? (int) $instance['number'] : 10;
		if ( !$number )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat'=>-(USCES_ITEM_CAT_PARENT_ID), 'order'=>'DESC',  'orderby'=>'date' ));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		//usces_reset_filter();
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('usces_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['usces_recent_entries']) )
			delete_option('usces_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('usces_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'usces'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'usces'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}

?>
