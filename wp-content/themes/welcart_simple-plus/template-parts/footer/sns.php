<?php
/**
 * Footer SNS
 *
 * @package welcart
 */

if ( ! welcart_simpleplus_is_sns() ) {
	return;
}
?>
<div class="sns">
	<p class="text-center follow-us">follow us</p>
	<div class="row justify-content-center">
		<?php welcart_simpleplus_the_sns(); ?>
	</div>
</div>
