<?php
/**
 * Plugins Functions
 * プラグインを利用しているときに使うテンプレート関数
 *
 * @package welcart
 */

/**
 * Welcart simpleplus widgetcart btn
 */
function welcart_simpleplus_widgetcart_btn() {
	// WCEX Widget Cart プラグインが有効
	if ( ! defined( 'WCEX_WIDGET_CART' ) ) {
		return false; // 早期リターン
	}
	?>
	<div class="view-cart">
		<div class="widgetcart-close-btn">
			<a type="button" aria-hidden="true" data-bs-toggle="offcanvas" data-bs-target="#wgct_row_group" aria-controls="offcanvasTop">
			<svg id="ico-cart" xmlns="http://www.w3.org/2000/svg" width="16.001" height="12.996" viewBox="0 0 16.001 12.996"><circle cx="1" cy="1" r="1" transform="translate(5.172 10.996)" fill="#777"/><circle cx="1" cy="1" r="1" transform="translate(11.06 10.996)" fill="#777"/><path d="M16.943,5.443H5.37L4.94,3.726h-3a1,1,0,1,0,0,2H3.378l2.055,8h9.384l.5-2H6.995l-.25-1h8.822Z" transform="translate(-0.942 -3.726)" fill="#777"/></svg>
			<span class="total-quant">
				<?php usces_totalquantity_in_cart(); ?>
			</span>
			</a>
		</div>

		<div id="wgct_row_group" class="offcanvas offcanvas-top" tabindex="-1" aria-labelledby="offcanvasTopLabel">
			<div id="wgct_row" class="offcanvas-body">
				<?php
				// phpcs:ignore
				echo widgetcart_get_cart_row();
				?>
			</div>
			<div class="offcanvas-footer text-end p-3">
				<button type="button" class="btn offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close">閉じる</button>
			</div>
		</div>
	</div><!-- .view-cart -->
	<div id="wgct_alert"></div>
	<?php
}
