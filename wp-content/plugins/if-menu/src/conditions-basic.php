<?php

add_filter('if_menu_conditions', 'if_menu_basic_conditions');

function if_menu_basic_conditions(array $conditions) {
	global $wp_roles;


	// User roles
	foreach ($wp_roles->role_names as $roleId => $role) {
		$conditions[] = array(
			'id'		=>	'user-is-' . $roleId,
			'name'		=>	sprintf(__('%sの場合', 'if-menu'), $role),
			'alias'		=>	sprintf(__('%sの場合', 'if-menu'), $role),
			'condition'	=>	function() use($roleId) {
				global $current_user;
				return is_user_logged_in() && in_array($roleId, $current_user->roles);
			},
			'group'		=>	__('ユーザー属性', 'if-menu')
		);
	}

	if (defined('WP_ALLOW_MULTISITE') && WP_ALLOW_MULTISITE === true) {
		$conditions[] = array(
			'id'		=>	'user-is-super-admin',
			'name'		=>	sprintf(__('%sの場合', 'if-menu'), 'Super Admin'),
			'condition'	=>	'is_super_admin',
			'group'		=>	__('ユーザー属性', 'if-menu')
		);
	}


	// User state
	$conditions[] = array(
		'id'		=>	'user-logged-in',
		'name'		=>	__('ログインしている場合', 'if-menu'),
		'alias'		=>	__('ログインしている場合', 'if-menu'),
		'condition'	=>	'is_user_logged_in',
		'group'		=>	__('ユーザー属性', 'if-menu')
	);

	if (defined('WP_ALLOW_MULTISITE') && WP_ALLOW_MULTISITE === true) {
		$conditions[] = array(
			'id'		=>	'user-logged-in-current-site',
			'name'		=>	__('このサイトにログインしている場合', 'if-menu'),
			'condition'	=>	function() {
				return current_user_can('read');
			},
			'group'		=>	__('ユーザー属性', 'if-menu')
		);
	}

	$conditions[] = array(
		'id'		=>	'users-can-register',
		'name'		=>	__('ユーザー登録できる場合', 'if-menu'),
		'condition'	=>	function() {
			return (bool) get_option('users_can_register');
		},
		'group'		=>	__('ユーザー属性', 'if-menu')
	);


	// Page type
	$conditions[] = array(
		'id'		=>	'front-page',
		'name'		=>	__('トップページの場合', 'if-menu'),
		'condition'	=>	'is_',
		'group'		=>	__('ページ属性', 'if-menu')
	);

	$conditions[] = array(
		'id'		=>	'single-post',
		'name'		=>	__('投稿ページの場合', 'if-menu'),
		'condition'	=>	'is_front_page',
		'group'		=>	__('ページ属性', 'if-menu')
	);

	$conditions[] = array(
		'id'		=>	'single-page',
		'name'		=>	__('固定ページの場合', 'if-menu'),
		'condition'	=>	'is_page',
		'group'		=>	__('ページ属性', 'if-menu')
	);


	// Devices
	$conditions[] = array(
		'id'		=>	'is-mobile',
		'name'		=>	__('モバイル表示の場合', 'if-menu'),
		'condition'	=>	'wp_is_mobile',
		'group'		=>	__('デバイス', 'if-menu')
	);


	// Language
	$conditions[] = array(
		'id'		=>	'language-is-rtl',
		'name'		=>	__('アラビア語の場合', 'if-menu'),
		'condition'	=>	'is_LTR',
		'group'		=>	__('言語', 'if-menu')
	);


	return $conditions;
}
