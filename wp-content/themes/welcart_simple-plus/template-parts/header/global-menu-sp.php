<?php
/**
 * Template Parts Global Menu SP
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>

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
					<ul class="navbar-nav flex-column">
						<?php if ( usces_is_membersystem_state() ) : ?>
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
						</li>
					</ul>
					<?php
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
						?>
				</div>
			</div>
		</nav>
		<!-- SNS -->
		<?php get_template_part( 'template-parts/header/sp', 'sns' ); ?>
	</div>
</div>
