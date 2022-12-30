<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
//define( 'DB_NAME', '_mousee_58ts6yae' );
define( 'DB_NAME', '7hsv8_solouno_wp' );

/** MySQL データベースのユーザー名 */
//define( 'DB_USER', '7hsv8_solouno' );
define( 'DB_USER', 'root' );

/** MySQL データベースのパスワード */
//define( 'DB_PASSWORD', '3_Q+JQLpYYK.' );
define( 'DB_PASSWORD', 'cielciel0303' );

/** MySQL のホスト名 */
//define( 'DB_HOST', 'mysql017.phy.heteml.lan' );
define( 'DB_HOST', 'mysql90.conoha.ne.jp	' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

define('WP_HOME', 'http://'.$_SERVER['HTTP_HOST']);
define('WP_SITEURL', 'http://'.$_SERVER['HTTP_HOST']);


/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'A!_pNp[Eb;CE0|p2FN:J;|q6{a0iqn[-oP0[_.a0}6`>_%,dS`)iXyfxOVV_}qF)' );
define( 'SECURE_AUTH_KEY',  '{{~VJ3Ll0k4:p%s}~090ogo][ARU-1bH>56byICo/{32Bl@fb[VG1Ad/e;ip(~=_' );
define( 'LOGGED_IN_KEY',    '`/z/W]2jTwcyYxT@++a!J^:*IwxP<%oL>eZp0SOKF,~78x=)6r*G&^OO+C8{Hmma' );
define( 'NONCE_KEY',        'GCF|yyl^8&[72I%z@/`{GooQ-nqTPS/zzS=nG2!F7]D0fHpzU&;5u4L5h[O=oc)d' );
define( 'AUTH_SALT',        ';_HW=J5;f~&Aku@`zG[kAgf#2:@hq|B5VmSm;N1vq7<RrGrhq#H-j)/b]D}#fd8@' );
define( 'SECURE_AUTH_SALT', 'GQ7W8zHpwX|d8+Bo-nzvu$M(Hp+(J*|tZ_FY:rE9EfeCo9-0n!lX%>eM7oTHxu@M' );
define( 'LOGGED_IN_SALT',   '+a&_HJ_q*3/x2_og{Q_Bi2rghB)U<}9{3(UAPs-Yl_LeT@BtkZ:JR6,>|>nORooK' );
define( 'NONCE_SALT',       'u}o~-01x:DSiYxS~Mhm8ex<5&4KWi>9SQpwcgoPv.#Tkz($Bnq~HdQDjKr{/9|fR' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

add_filter('xmlrpc_enabled', '__return_false');

add_filter('xmlrpc_methods', function($methods) {
    unset($methods['pingback.ping']);
    unset($methods['pingback.extensions.getPingbacks']);
    return $methods;
});