<?php
/**
 * Front
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>
<li>
	<a href="<?php the_permalink(); ?>">
		<div class="time">
			<?php the_time( get_option( 'date_format' ) ); ?>
		</div>
		<?php the_title(); ?>
	</a>
</li>
