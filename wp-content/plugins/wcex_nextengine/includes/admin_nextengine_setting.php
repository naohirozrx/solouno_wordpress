<?php
/**
 * Admin setting page.
 *
 * @package WCEX NEXT ENGINE
 * @since 1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $usces;

$ne_option = get_option( 'usces_ne_setting', array() );
if ( isset( $_POST['usces_option_update'] ) ) {
	check_admin_referer( 'admin_ne_setting', '_nonce_ne_setting' );
	$post_data                  = $usces->stripslashes_deep_post( $_POST );
	$ne_option['order_address'] = ( isset( $post_data['order_address'] ) ) ? trim( $post_data['order_address'] ) : '';
	$ne_option['store_account'] = ( isset( $post_data['store_account'] ) ) ? trim( $post_data['store_account'] ) : '';
	$ne_option['store_key']     = ( isset( $post_data['store_key'] ) ) ? trim( $post_data['store_key'] ) : '';
	unset( $ne_option['api_upd'] );
	$ne_option['api_upd'] = array();
	if ( isset( $post_data['api_upd'] ) ) {
		foreach ( (array) $post_data['api_upd'] as $upd ) {
			array_push( $ne_option['api_upd'], wp_unslash( $upd ) );
		}
	}
	$ne_option['link_necd'] = ( isset( $post_data['link_necd'] ) ) ? (int) trim( $post_data['link_necd'] ) : 0;
	unset( $ne_option['item_post_status'] );
	$ne_option['item_post_status'] = array( 'publish' );
	if ( isset( $post_data['item_post_status'] ) ) {
		foreach ( (array) $post_data['item_post_status'] as $status ) {
			if ( 'publish' != $status ) {
				array_push( $ne_option['item_post_status'], $status );
			}
		}
	}
	$ne_option['item_list_display'] = ( isset( $post_data['item_list_display'] ) ) ? (int) trim( $post_data['item_list_display'] ) : 0;
	$ne_option['item_shipped']      = ( isset( $post_data['item_shipped'] ) ) ? (int) trim( $post_data['item_shipped'] ) : 0;
	$ne_option['order_number']      = ( isset( $post_data['order_number'] ) ) ? (int) trim( $post_data['order_number'] ) : 0;
	$ne_option['save_log']          = ( isset( $post_data['save_log'] ) ) ? (int) trim( $post_data['save_log'] ) : 0;
	update_option( 'usces_ne_setting', $ne_option );
	$usces->action_status  = 'success';
	$usces->action_message = __( 'Successfully updated.', 'usces' );
}
$order_address     = ( isset( $ne_option['order_address'] ) ) ? $ne_option['order_address'] : '';
$store_account     = ( isset( $ne_option['store_account'] ) ) ? $ne_option['store_account'] : '';
$store_key         = ( isset( $ne_option['store_key'] ) ) ? $ne_option['store_key'] : '';
$api_upd           = ( isset( $ne_option['api_upd'] ) ) ? $ne_option['api_upd'] : array();
$link_necd         = ( isset( $ne_option['link_necd'] ) ) ? (int) $ne_option['link_necd'] : 0;
$item_post_status  = ( isset( $ne_option['item_post_status'] ) ) ? $ne_option['item_post_status'] : array();
$item_list_display = ( isset( $ne_option['item_list_display'] ) ) ? (int) $ne_option['item_list_display'] : 0;
$item_shipped      = ( isset( $ne_option['item_shipped'] ) ) ? (int) $ne_option['item_shipped'] : 0;
$order_number      = ( isset( $ne_option['order_number'] ) ) ? (int) $ne_option['order_number'] : 0;
?>
<div class="wrap">
<h1>ネクストエンジン設定</h1>
	<?php usces_admin_action_status(); ?>
<form method="post" action="">
<table class="form-table">
<tbody>
<tr>
<th scope="row">受注用メールアドレス</th>
<td><input type="text" name="order_address" id="order_address" class="regular-text" value="<?php echo esc_attr( $order_address ); ?>"/><p class="description" id="order_address">ネクストエンジンから発行される「受注用メールアドレス」を入力します。</p></td>
</tr>
<tr>
<th scope="row">ストアアカウント</th>
<td><input type="text" name="store_account" id="store_account" class="regular-text" value="<?php echo esc_attr( $store_account ); ?>"/><p class="description" id="store_account">ネクストエンジンの汎用店舗で設定する「ストアアカウント」を入力します。<br />「入力は任意」となっていますが、必ず設定してください。</p></td>
</tr>
<tr>
<th scope="row">認証キー</th>
<td><input type="text" name="store_key" id="store_key" class="regular-text" value="<?php echo esc_attr( $store_key ); ?>"/><p class="description" id="store_key">ネクストエンジンの汎用店舗で設定する「認証キー」を入力します。<br />「入力は任意」となっていますが、設定されることをお勧めします。</p></td>
</tr>
<tr>
<th scope="row">連携機能</th>
<td><fieldset>
<label><input type="checkbox" name="api_upd[]" id="api_upd_stock" value="stock"<?php checked( in_array( 'stock', $api_upd ) ); ?>><span>在庫更新を利用する</span></label><br />
<p class="description">ネクストエンジンからの在庫更新リクエストを受信します。</p><br />
<label><input type="checkbox" name="api_upd[]" id="api_upd_transaction" value="transaction"<?php checked( in_array( 'transaction', $api_upd ) ); ?>><span>受注登録を利用する</span></label><br />
<p class="description">NE汎用メールフォーマットを送信して、ネクストエンジンのシステムに受注データを登録します。</p></fieldset></td>
</tr>
<tr>
<tr>
<th scope="row">商品コードの紐付</th>
<td><fieldset>
<label><input type="radio" name="link_necd" value="0"<?php checked( $link_necd, 0 ); ?>/><span>「SKUコード」を使用する</span></label><br />
<label><input type="radio" name="link_necd" value="1"<?php checked( $link_necd, 1 ); ?>/><span>「NE連携CD」を使用する</span></label><br />
<p class="description">ネクストエンジンの「商品コード」と、Welcart の商品を紐付けるキーを選択します。</p></fieldset></td>
</tr>
<tr>
<th scope="row">在庫更新する商品</th>
<td><fieldset>
<label><input type="checkbox" name="item_post_status[]" value="publish" checked="checked" disabled="disabled" ><span>公開</span></label><br />
<label><input type="checkbox" name="item_post_status[]" value="future"<?php checked( in_array( 'future', $item_post_status ) ); ?>><span>予約投稿</span></label><br />
<label><input type="checkbox" name="item_post_status[]" value="draft"<?php checked( in_array( 'draft', $item_post_status ) ); ?>><span>下書き</span></label><br />
<label><input type="checkbox" name="item_post_status[]" value="private"<?php checked( in_array( 'private', $item_post_status ) ); ?>><span>非公開</span></label><br />
<p class="description">ネクストエンジンからの在庫更新リクエストで更新される商品の表示状態を選択します。「公開済み」の商品は必須選択です。</p></fieldset></td>
</tr>
<tr>
<th scope="row">商品一覧リストのSKU表示</th>
<td><fieldset>
<label><input type="radio" name="item_list_display" value="0"<?php checked( $item_list_display, 0 ); ?>/><span>「SKUコード」を表示する</span></label><br />
<label><input type="radio" name="item_list_display" value="1"<?php checked( $item_list_display, 1 ); ?>/><span>「NE連携CD」を表示する</span></label><br />
<label><input type="radio" name="item_list_display" value="2"<?php checked( $item_list_display, 2 ); ?>/><span>「SKU表示名」を表示する</span></label><br />
<p class="description">商品リストに表示する「SKUコード」を変更することができます。</p></fieldset></td>
</tr>
<tr>
<th scope="row">出荷済フラグ</th>
<td><fieldset>
<label><input type="radio" name="item_shipped" value="0"<?php checked( $item_shipped, 0 ); ?>/><span>通常取込</span></label><br />
<label><input type="radio" name="item_shipped" value="1"<?php checked( $item_shipped, 1 ); ?>/><span>出荷確定済にする</span></label><br />
<p class="description">取り込む受注データを強制的に「出荷済み」にしたい場合のみ設定してください。</p></fieldset></td>
</tr>
<tr>
<th scope="row">注文コード</th>
<td><fieldset>
<label><input type="radio" name="order_number" value="0"<?php checked( $order_number, 0 ); ?>/><span>ID</span></label><br />
<label><input type="radio" name="order_number" value="1"<?php checked( $order_number, 1 ); ?>/><span>注文番号</span></label><br />
<p class="description">NE汎用メールフォーマットの「注文コード」を変更することができます。</p></fieldset></td>
</tr>
<tr>
<th scope="row">在庫更新APIログ</th>
<td><input type="button" id="save_log" class="button" value="在庫更新APIログを表示"></td>
</tr>
</tbody>
</table>
<p class="submit"><input type="submit" name="usces_option_update" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes' ); ?>" /></p>
	<?php wp_nonce_field( 'admin_ne_setting', '_nonce_ne_setting' ); ?>
</form>
<div class="clear"></div>
<div id="stock_update_log" title="在庫更新APIログ" style="display:none;">
	<fieldset>
		<div id="stock-update-list"></div>
	</fieldset>
</div>
</div><!-- wpwrap -->
