<?php
/**
 * Template Parts Global In Cart
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

if ( defined( 'WCEX_WIDGET_CART' ) ) : // ウィジェットカート対応
	welcart_simpleplus_widgetcart_btn();
else :
	?>
<a href="<?php echo esc_url_raw( USCES_CART_URL ); ?>">
	<svg id="ico-cart" xmlns="http://www.w3.org/2000/svg" width="16.001" height="12.996" viewBox="0 0 16.001 12.996"><circle cx="1" cy="1" r="1" transform="translate(5.172 10.996)" fill="#777"/><circle cx="1" cy="1" r="1" transform="translate(11.06 10.996)" fill="#777"/><path d="M16.943,5.443H5.37L4.94,3.726h-3a1,1,0,1,0,0,2H3.378l2.055,8h9.384l.5-2H6.995l-.25-1h8.822Z" transform="translate(-0.942 -3.726)" fill="#777"/></svg>
	<span class="total-quant">
		<?php usces_totalquantity_in_cart(); ?>
	</span>
</a>
	<?php
endif;
