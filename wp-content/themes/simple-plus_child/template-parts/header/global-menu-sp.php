<?php
/**
 * Template Parts Global Menu SP
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>
<style>
	.ec-haeder-menu li {
  font-size: 18px;
}

.ec-haeder-menu li a {
  display: block;
  padding: 10px 5px;
  border-bottom: 1px solid #535353;
}

.sns {
	font-size: 24px;
	font-weight: 700;
	color: #AC7746;
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 15px;
	padding-left: 10px;
}

.sns > img {
	height: 3px;	
}

.sns a img {
  height: 42px;
}

</style>
<div id="global-menu" class="global-menu d-lg-none collapse collapse-horizontal">
	<div class="menu-scroller">
		<div class="text-end">
			<button class="menu-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#global-menu"
				aria-label="Global Menu" aria-controls="global-menu">
				<span class="navbar-toggler-icon navbar-toggler-icon-close"></span>
			</button>
		</div>

		<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
			<div class="container-fluid">
				<div class="navbar-collapse">
					<span class="sns">
						SNS<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sns-border.svg"><a href="https://www.instagram.com/solo_uno_ordermade/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sns-instagram.svg"></a>
					</span>

					<ul class="navbar-nav flex-column ec-haeder-menu">
						<!--<?php if ( usces_is_membersystem_state() ) : ?>
							<li class="nav-item login">
								<ul class="user">
									<?php do_action( 'usces_theme_action_membersystem_before' ); ?>
									<?php if ( usces_is_login() ) : /* ログインしている場合 */ ?>
										<li>
											<a class="nav-link active" href="<?php echo esc_url( USCES_MEMBER_URL ); ?>">
												<span class="user-icon"><span></span></span>
												<?php esc_html_e( 'My page', 'welcart_simpleplus' ); ?>
											</a>
										</li>
										<?php do_action( 'usces_theme_login_menu' ); ?>
									<?php else :  /* ログアウトしている場合 */ ?>
										<li>
											<a class="nav-link active" href="<?php echo esc_url( USCES_MEMBER_URL ); ?>">
												<span class="user-icon"><span></span></span>
												<?php esc_html_e( 'Log-in', 'usces' ); ?>
											</a>
										</li>
									<?php endif; ?>
									<?php do_action( 'usces_theme_action_membersystem_after' ); ?>
								</ul>
							</li>
						<?php endif; ?>
						<li class="nav-item search">
							<?php get_search_form(); ?>
						</li>-->
						<li><a href="<?php echo home_url('/')?>">HOME</a></li>
						<li><a href="<?php echo home_url('/')?>aboutus">SOLO UNOについて</a></li>
						<li><a href="<?php echo home_url('/')?>product">PRODUCT</a></li>
						<li><a href="<?php echo home_url('/')?>flow/">　オーダーメイドランドセル</a></li>
						<li><a href="<?php echo home_url('/')?>disney">　ディズニーランドセル</a></li>
						<li><a href="<?php echo home_url('/')?>marty">　マーティー</a></li>
						<li><a href="<?php echo home_url('/')?>category/item/">　ストア</a></li>
						<li><a href="<?php echo home_url('/')?>showroom">店舗情報</a></li>
						<li><a href="<?php echo home_url('/')?>news">お知らせ</a></li>
						<li><a href="<?php echo home_url('/')?>exhibit">展示会情報</a></li>
						<li><a href="<?php echo home_url('/')?>column">コラム</a></li>
						<li><a href="<?php echo home_url('/')?>request">カタログ請求</a></li>
						<li><a href="<?php echo home_url('/')?>law">特定商取引法に基づく表記</a></li>
						<li><a href="<?php echo home_url('/')?>privacy">プライバシーポリシー</a></li>
					</ul>
					<!--<?php
						wp_nav_menu(
							array(
								'theme_location' => 'header_sp',
								'menu_class'     => '',
								'items_wrap'     => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
								'container'      => false,
								'fallback_cb'    => '__return_false::fallback',
								'walker'         => new Bootstrap_5_Navbar_Walker(),
							)
						);
						?>-->
				</div>
			</div>
		</nav>
		<!-- SNS -->
		<!--<?php get_template_part( 'template-parts/header/sp', 'sns' ); ?>-->
	</div>
</div>
