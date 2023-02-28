<?php
/**
 * Category Item Loop
 *
 * @package welcart
 */

?>

<div class="container">
	<div class="grid">

		<?php
		while ( have_posts() ) :
			the_post();
			usces_the_item();
			usces_have_skus();
			get_template_part( 'template-parts/front/content', 'new_items' );
			?>
		<?php endwhile; ?>
	</div>
</div>
