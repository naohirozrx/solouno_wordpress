<?php
/**
 * Item
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>
<div id="accordion-item-panels" class="accordion accordion-item-panels">

	<!-- 商品詳細 -->
	<div id="accordion-item-info" class="accordion-item">
		<h2 class="accordion-header" id="panelsStayOpen-headingOne">
			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
				<?php echo esc_html_e( 'Detail', 'usces' ); ?>
			</button>
		</h2>
		<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
			<div class="accordion-body item-description entry-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

	<!-- 商品レビュー -->
	<?php welcart_simpleplus_view_reviews(); ?>

</div>
