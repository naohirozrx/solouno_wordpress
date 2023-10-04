<?php
/**
 * Template Parts Global Menu PC
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>
<style>
	.d-flex ul {
		display: flex;
		list-style: none;
		gap: 20px;
		margin: 0 20px 0;
	}
</style>

<div id="global-menu-pc" class="global-menu global-menu-pc col order-lg-2 d-none d-lg-flex justify-content-lg-end">
	<!-- メニュー -->
	<nav class="col navbar navbar-expand-md navbar-light bg-transparent">
		<div class="container-fluid">
			<div class="navbar-collapse">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header',
						'menu_class'     => '',
						'items_wrap'     => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
						'container'      => false,
						'fallback_cb'    => '__return_false::fallback',
						'walker'         => new Bootstrap_5_Navbar_Walker(),
					)
				);
				?>
			</div>
		</div>
	</nav>

	<div class="col-auto d-flex">

		<ul>
        <li><a href="<?php echo home_url('/')?>aboutus">SOLO UNOについて</a></li>
        <li><a href="<?php echo home_url('/')?>product">PRODUCT</a></li>
        <li><a href="<?php echo home_url('/')?>showroom">店舗情報</a></li>
        <li><a href="<?php echo home_url('/')?>news">お知らせ</a></li>
        <li><a href="<?php echo home_url('/')?>exhibit">展示会情報</a></li>
        <li><a href="<?php echo home_url('/')?>column">コラム</a></li>
        <li><a href="<?php echo home_url('/')?>request">カタログ請求</a></li>
      </ul>

	</div>
</div>
