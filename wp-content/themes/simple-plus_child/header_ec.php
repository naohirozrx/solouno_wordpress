<?php
/**
 * Theme Name: Header
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<script type="text/javascript" charset="utf-8" async defer>
    !function(e,t,n,a,c,s,o){e.FirstContact=c,e.fcSrc="https://first-contact.jp/assets/js/firstcontact.js",e[c]=e[c]||function(){(e[c].q=e[c].q||[]).push(arguments)},e[c].l=1*new 
Date,s=t.createElement(n),o=t.getElementsByTagName(n)[0],s.async=1,s.src=fcSrc,o.parentNode.insertBefore(s,o)}(window,document,"script",0,"firstcontact");
    firstcontact("73af129b-ce50-f2f6-1552-815bc6380940");
</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta name="format-detection" content="telephone=no"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'welcart_simpleplus_body_before' ); ?>
	<?php welcart_simpleplus_the_notice( 'over-header' ); ?>
	<header id="header" class="container-fluid scroll d-flex flex-column justify-content-center fixed-top <?php welcart_simpleplus_header_class(); ?>" data-scroll-offset="<?php echo esc_attr( get_theme_mod( 'menu-offset_display_setting', 200 ) ); ?>">
		<?php do_action( 'welcart_simpleplus_header_before' ); ?>
		<div class="row g-0 justify-content-between">
			<!-- ハンバーガーボタン -->
			<div class="col-auto d-block d-lg-none">
				<?php get_template_part( 'template-parts/header/menu-btn' ); ?>
			</div>
			<!-- ロゴ -->
			<div class="main-logo col order-lg-1 col-lg-auto text-center">
				<?php welcart_simpleplus_the_site_title(); ?>
			</div>

			<!-- メニュー -->
			<?php get_template_part( 'template-parts/header/global-menu', 'sp' ); ?>
			<div class="global-menu-pc-row">
				<?php get_template_part( 'template-parts/header/global-menu', 'pc' ); ?>
				<!-- カート -->
				<div class="col-auto order-3 cart-btn">
					<?php get_template_part( 'template-parts/header/incart' ); ?>
				</div>
			</div>
		</div>
		<?php do_action( 'welcart_simpleplus_header_after' ); ?>
	</header>

	<?php welcart_simpleplus_header_image(); ?>

	<?php do_action( 'welcart_simpleplus_after_header_image' ); ?>

	<?php
	if ( ! is_home() && ! is_front_page() ) :
		welcart_simpleplus_the_notice( 'content-top' );
	endif;
	?>
