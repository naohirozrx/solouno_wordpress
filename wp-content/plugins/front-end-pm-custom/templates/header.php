<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$box_class = 'fep-box-size';
if ( $max_total && ( ( $max_total * 90 ) / 100 ) <= $total_count ) {
	$box_class .= ' fep-font-red';
}
?>
<div id="fep-wrapper">
	<div id="fep-header" class="fep-table">
		<div>
			<div>

			    <!-- 改変 -->
			    <a href="https://<?PHP print $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]; ?>/archives/author/<?PHP echo fep_user_name( $user_ID ); //ユーザー名 ?>">
				<?php echo get_avatar( $user_ID, 64, '', fep_user_name( $user_ID ) ); ?>

				</a>
			</div>
			<div>


                <!-- 改変 -->
				<div><?php echo fep_user_name( $user_ID ); ?>さんに
					<span class="fep_unread_message_count_text">
					    <a href="<?php echo fep_query_url('messagebox'); ?>">
					    <?php printf( _n( '%s message', '%s messages', $unread_count, 'front-end-pm' ), number_format_i18n( $unread_count ) ); ?>
					    </a>
					 </span>
					が届いています
				</div>


				<div class="<?php echo $box_class; ?>"><?php 
					esc_html_e( 'Message box size:', 'front-end-pm' );
					echo strip_tags( sprintf( __( '%1$s of %2$s', 'front-end-pm' ), '<span class="fep_total_message_count">' . number_format_i18n( $total_count ) . '</span>', $max_text ), '<span>' ); ?>
				</div>
			</div>
			<?php do_action( 'fep_header_note', $user_ID ); ?>
		</div>
	</div>