<?php
/**
 * Wc Member Completion Page
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

get_header();
?>

<div id="primary" class="site-content">
	<main id="content" class="member-page" role="main">

	<?php
	if ( have_posts() ) :
		usces_remove_filter();
		?>

		<article class="post" id="wc_<?php usces_page_name(); ?>">

			<h1 class="member_page_title"><?php esc_html_e( 'Completion', 'usces' ); ?></h1>

			<div id="memberpages">

				<div class="header_explanation">
					<?php do_action( 'usces_action_membercompletion_page_header' ); ?>
				</div><!-- .header_explanation -->

				<?php $welcart_simpleplus_member_compmode = usces_page_name( 'return' ); ?>
				<?php if ( 'newcompletion' === $welcart_simpleplus_member_compmode ) : ?>
					<p><?php esc_html_e( 'Thank you in new membership.', 'usces' ); ?></p>

				<?php elseif ( 'editcompletion' === $welcart_simpleplus_member_compmode ) : ?>
					<p><?php esc_html_e( 'Membership information has been updated.', 'usces' ); ?></p>

				<?php elseif ( 'lostcompletion' === $welcart_simpleplus_member_compmode ) : ?>
					<p><?php esc_html_e( 'I transmitted an email.', 'usces' ); ?></p>
					<p><?php esc_html_e( 'Change your password by following the instruction in this mail.', 'usces' ); ?></p>

				<?php elseif ( 'changepasscompletion' === $welcart_simpleplus_member_compmode ) : ?>
					<p><?php esc_html_e( 'Password has been changed.', 'usces' ); ?></p>

				<?php endif; ?>

				<div class="footer_explanation">
					<?php do_action( 'usces_action_membercompletion_page_footer' ); ?>
				</div><!-- .footer_explanation -->

				<p><a href="<?php usces_url( 'member' ); ?>"><?php esc_html_e( 'to vist membership information page', 'usces' ); ?></a></p>

				<div class="send">
					<a href="<?php echo esc_url( home_url() ); ?>" class="back_to_top_button"><?php esc_html_e( 'Back to the top page.', 'usces' ); ?></a>
				</div>
			</div><!-- #memberpages -->

		</article><!-- .post -->

	<?php else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</main><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
