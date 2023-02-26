<?php
/**
 * Template Parts Global Menu PC
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>

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
		<?php if ( usces_is_membersystem_state() ) : ?>
			<!-- ログイン -->
			<div class="login-pc">
				<ul>
					<?php do_action( 'usces_theme_action_membersystem_before' ); ?>
					<li><?php welcart_simpleplus_the_menu_login_pc(); ?></li>
					<?php if ( usces_is_login() ) : /* ログインしている場合 */ ?>
						<?php do_action( 'usces_theme_login_menu' ); ?>
					<?php endif; ?>
					<?php do_action( 'usces_theme_action_membersystem_after' ); ?>
				</ul>
			</div>
		<?php endif; ?>
		<!-- 検索 -->
		<div class="search-pc">
			<a href="#searchForm" role="button" data-bs-toggle="collapse" data-bs-target="#searchForm" aria-expanded="false" aria-controls="searchForm">
				<svg id="ico-search" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M16,14.591,12.679,11.27a6.89,6.89,0,0,0,1.409-4.226A7,7,0,0,0,7.044,0,7,7,0,0,0,0,7.044a7,7,0,0,0,7.044,7.044,6.89,6.89,0,0,0,4.226-1.409L14.591,16ZM2.013,7.044A4.983,4.983,0,0,1,7.044,2.013a4.983,4.983,0,0,1,5.031,5.031,4.983,4.983,0,0,1-5.031,5.031A4.983,4.983,0,0,1,2.013,7.044Z" fill="#777"/></svg>
			</a>
			<div id="searchForm" class="search-box collapse" aria-labelledby="searchForm">
				<div class="card card-body">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
