<?php
/**
 * Search Form
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>
<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
	<div class="s-box">
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" class="search-text form-control" aria-describedby="button-search" />
		<button class="btn btn-outline-secondary button-search" type="submit">
			<svg id="ico-search" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M16,14.591,12.679,11.27a6.89,6.89,0,0,0,1.409-4.226A7,7,0,0,0,7.044,0,7,7,0,0,0,0,7.044a7,7,0,0,0,7.044,7.044,6.89,6.89,0,0,0,4.226-1.409L14.591,16ZM2.013,7.044A4.983,4.983,0,0,1,7.044,2.013a4.983,4.983,0,0,1,5.031,5.031,4.983,4.983,0,0,1-5.031,5.031A4.983,4.983,0,0,1,2.013,7.044Z" fill="#777"/></svg>
		</button>
	</div>
</form>
