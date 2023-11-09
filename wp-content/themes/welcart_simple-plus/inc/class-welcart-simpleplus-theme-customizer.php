<?php
/**
 * Theme customizer
 * テーマ独自のカスタマイザーに関連する部分のカスタマイズ
 *
 * @package Welcart
 * @subpackage Welcart_SimplePlus
 */

/**
 * Class
 */
class Welcart_SimplePlus_Theme_Customizer {

	/**
	 * Theme name
	 *
	 * @var string
	 */
	private $theme_name = 'welcart_simpleplus';

	/**
	 * Default setting args
	 *
	 * @var array sss
	 */
	public $default_setting_args = array(
		'capability' => 'edit_theme_options',
	);

	/**
	 * Preview url
	 *
	 * @var array
	 */
	public $customizer_preview_url = array();

	/**
	 * Colors
	 *
	 * @var array
	 */
	public $wcsp_colors = array();

	/**
	 * Constructer
	 *
	 * @param array $args args.
	 */
	public function __construct( $args = array() ) {
		$constant                     = $this->get_constant();
		$this->customizer_preview_url = isset( $args['customizer_preview_url'] ) ? $args['customizer_preview_url'] : $constant['customizer_preview_url'];
		$this->wcsp_colors            = isset( $args['wcsp_colors'] ) ? $args['wcsp_colors'] : $constant['wcsp_colors'];

		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_controls_print_scripts', array( $this, 'customize_controls_print_scripts' ) );
		add_action( 'customize_preview_init', array( $this, 'live_preview' ) );

		// カスタマイザーのCSS呼び出し.
		add_action( 'wp_head', array( $this, 'header_output' ) );
		add_action( 'customize_controls_print_styles', array( $this, 'generate_css_text' ) );
	}

	/**
	 * Get constant
	 */
	public function get_constant() {

		$customizer_preview_url = array(
			'title_tagline'      => array(
				'section_id'   => 'title_tagline',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'colors'             => array(
				'section_id'   => 'colors',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'header_image'       => array(
				'section_id'   => 'header_image',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'background_image'   => array(
				'section_id'   => 'background_image',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'static_front_page'  => array(
				'section_id'   => 'static_front_page',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'custom_css'         => array(
				'section_id'   => 'custom_css',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'theme_all'          => array(
				'section_id'   => 'theme_all',
				'preview_page' => 'page_link',
				'preview_url'  => '',
			),
			'frontpage_section'  => array(
				'section_id'   => 'frontpage_section',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'sidebar_settings'   => array(
				'section_id'   => 'sidebar_settings',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'item_list_settings' => array(
				'section_id'   => 'item_list_settings',
				'preview_page' => 'cat_link',
				'preview_url'  => '',
			),
			'item_settings'      => array(
				'section_id'   => 'item_settings',
				'preview_page' => 'lastItem_link',
				'preview_url'  => '',
			),
			'cart_page'          => array(
				'section_id'   => 'cart_page',
				'preview_page' => 'cart_link',
				'preview_url'  => '',
			),
			'member_page'        => array(
				'section_id'   => 'member_page',
				'preview_page' => 'postList_link',
				'preview_url'  => '',
			),
			'archives_settings'  => array(
				'section_id'   => 'archives_settings',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'post_settings'      => array(
				'section_id'   => 'post_settings',
				'preview_page' => 'lastPost_link',
				'preview_url'  => '',
			),
			'footer_custom'      => array(
				'section_id'   => 'footer_custom',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
			'sns_button_section' => array(
				'section_id'   => 'sns_button_section',
				'preview_page' => 'front_link',
				'preview_url'  => '',
			),
		);
		$wcsp_colors            = array(
			'main-base-bg-color'               => array(
				'label'       => __( 'Entire site', 'welcart_simpleplus' ),
				'description' => __( 'Background color' ),
				'settings'    => array( 'default' => '#ffffff' ),
			),
			'general-text-color'               => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#424242' ),
			),
			'general-border-color'             => array(
				'label'       => '',
				'description' => __( 'Border color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#e7e7e7' ),
			),
			'general-caption-color'            => array(
				'label'       => '',
				'description' => __( 'Caption color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#a5a5a5' ),
			),
			'general-table-heading-bg-color'   => array(
				'label'       => '',
				'description' => __( 'Table heading background color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#efefef' ),
			),
			'general-table-heading-text-color' => array(
				'label'       => '',
				'description' => __( 'Table heading text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#424242' ),
			),
			'main-bg-color'                    => array(
				'label'       => __( 'Main color', 'welcart_simpleplus' ),
				'description' => __( 'Background color' ),
				'settings'    => array( 'default' => '#fbfbfb' ),
			),
			'text-color'                       => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#424242' ),
			),
			'border-color'                     => array(
				'label'       => '',
				'description' => __( 'Border color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#e7e7e7' ),
			),
			'accent-color'                     => array(
				'label'       => __( 'Accent color', 'welcart_simpleplus' ),
				'description' => __( 'It will be reflected in the notification etc. fixed at the beginning on the header such as the quantity of the cart icon.', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#899f6f' ),
			),
			'accent-text-color'                => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#ffffff' ),
			),
			'header-before-bg-color'           => array(
				'label'       => __( 'Before scrolling', 'welcart_simpleplus' ),
				'description' => __( 'Background color' ),
				'settings'    => array( 'default' => 'rgba(255,255,255,0)' ),
			),
			'header-before-text-color'         => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#ffffff' ),
			),
			'header-after-bg-color'            => array(
				'label'       => __( 'After scrolling', 'welcart_simpleplus' ),
				'description' => __( 'Background color' ),
				'settings'    => array( 'default' => '#ffffff' ),
			),
			'header-after-text-color'          => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#424242' ),
			),
			'btn-bg-color'                     => array(
				'label'       => __( 'Main button', 'welcart_simpleplus' ),
				'description' => __( 'Background color' ),
				'settings'    => array( 'default' => '#6c6c6c' ),
			),
			'btn-text-color'                   => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#fff' ),
			),
			'subbtn1-bg-color'                 => array(
				'label'       => __( 'Sub button 1', 'welcart_simpleplus' ),
				'description' => __( 'Background color' ),
				'settings'    => array( 'default' => '#fff' ),
			),
			'subbtn1-text-color'               => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#424242' ),
			),
			'subbtn2-bg-color'                 => array(
				'label'       => __( 'Sub button 2', 'welcart_simpleplus' ),
				'description' => __( 'Background color' ),
				'settings'    => array( 'default' => '#f1f1f1' ),
			),
			'subbtn2-text-color'               => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#424242' ),
			),
			'cartbtn-bg-color'                 => array(
				'label'       => __( 'Cart Button', 'welcart_simpleplus' ),
				'description' => __( 'Background color' ),
				'settings'    => array( 'default' => '#899f6f' ),
			),
			'cartbtn-text-color'               => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#fff' ),
			),
			'btn-hover-bg-color'               => array(
				'label'       => __( 'Button hover', 'welcart_simpleplus' ),
				'description' => __( 'Background color' ),
				'settings'    => array( 'default' => '#424242' ),
			),
			'btn-hover-text-color'             => array(
				'label'       => '',
				'description' => __( 'Text color', 'welcart_simpleplus' ),
				'settings'    => array( 'default' => '#fff' ),
			),
		);
		return compact( 'customizer_preview_url', 'wcsp_colors' );
	}

	/* Admin page _ Add style */
	/**
	 * Basic_admin_enqueue_scripts
	 *
	 * @param string $hook hook.
	 * @return void
	 */
	public function customize_controls_print_scripts( $hook ) {
		wp_enqueue_script( 'welcart_simpleplus_customizer_js', get_template_directory_uri() . '/js/customizer.js', array(), 1.0, true );
		$preview_urls = $this->get_customizer_preview_url();
		// URLの付け替え.
		$this->customizer_preview_url = array_map(
			function( $arg ) use ( $preview_urls ) {
				$arg['preview_url'] = $preview_urls[ $arg['preview_page'] ];
				return $arg;
			},
			$this->customizer_preview_url
		);
		wp_localize_script( 'welcart_simpleplus_customizer_js', 'welcartSimpleplusCustomizerSettingArgs', $this->customizer_preview_url );

		wp_enqueue_style( 'welcart_simpleplus_customizer-style', get_template_directory_uri() . '/css/customizer-style.min.css', array(), true );
	}

	/**
	 * 即時反映のための JavaScript をエンキューします。
	 * この関数はテーマ設定で 'transport'=>'postMessage' を指定した場合のみ必要です。
	 *
	 * 実行されるフック: 'customize_preview_init'
	 *
	 * @see add_action('customize_preview_init',$func)
	 * @since MyTheme 1.0
	 */
	public function live_preview() {
		wp_enqueue_script(
			'theme-customizer-preview-js', // Give the script a unique ID.
			get_template_directory_uri() . '/js/theme-customizer_preview.js', // Define the path to the JS file.
			array( 'jquery', 'customize-preview' ), // Define dependencies.
			true, // Define a version (optional).
			true // Specify whether to put in footer (leave this true).
		);
		$keys = array_keys( $this->wcsp_colors );
		wp_localize_script(
			'theme-customizer-preview-js',
			'wcspColors',
			$keys,
		);
		wp_localize_script(
			'theme-customizer-preview-js',
			'otherCustomizer',
			array(
				'image_settings_grid_image_radius_setting',
				'image_settings_grid_image_gap_setting',
				'topics_list_gap_setting',
				'topics_list_round_setting',
				'items_list_gap_setting',
				'items_list_round_setting',
			)
		);
	}

	/**
	 * Setup theme customizer
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @return void
	 */
	public function customize_register( $wp_customize ) {

		// カスタマイザーから不要なオプションを削除.
		$wp_customize->remove_control( 'display_header_text' );

		// テーマオプションパネルのid.
		$panel_id = $this->theme_name . '_theme_options';

		// Theme Options.
		// テーマオプションパネルの作成.
		$wp_customize->add_panel(
			$panel_id,
			array(
				'title'       => __( 'Theme Options', 'welcart_simpleplus' ),
				'description' => __( 'Theme Option Settings', 'welcart_simpleplus' ),
				'priority'    => 100,
				'panel'       => 'theme_options',
			)
		);

		$this->color_settings( $wp_customize );
		$this->menu_settings( $wp_customize, $panel_id );
		$this->notice_settings( $wp_customize, $panel_id );
		$this->grid_image_settings( $wp_customize, $panel_id );
		$this->front_page_settings( $wp_customize, $panel_id );
		$this->sidebar_settings( $wp_customize, $panel_id );
		$this->itempage_settings( $wp_customize, $panel_id );
		$this->cartpage_settings( $wp_customize, $panel_id );
		$this->sns_settings( $wp_customize, $panel_id );
	}

	/**
	 * Color settings
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @return void
	 */
	public function color_settings( $wp_customize ) {

		require_once dirname( __FILE__ ) . '/alpha-color-picker/alpha-color-picker.php';

		// ヘッダーテキスト色は使用しないため削除.
		$wp_customize->remove_control( 'header_textcolor' );

		// セクション作成.
		$color_args = $this->wcsp_colors;
		foreach ( $color_args as $key => $arg ) {
			$wp_customize->add_setting(
				'wcsp_colors_' . $key,
				array_merge(
					array(
						'transport'         => 'postMessage',
						'sanitize_callback' => array( $this, 'sanitize_rgba_color' ),
					),
					$arg['settings']
				)
			);
			$wp_customize->add_control(
				new Customize_Alpha_Color_Control(
					$wp_customize,
					$key . '_control',
					array(
						'label'        => $arg['label'],
						'description'  => $arg['description'],
						'section'      => 'colors',
						'settings'     => 'wcsp_colors_' . $key,
						'show_opacity' => true,
					),
				)
			);
		}
	}

	/**
	 * Menu image settings
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $theme_options_id theme_options_id.
	 * @return void
	 */
	public function menu_settings( $wp_customize, $theme_options_id ) {

		// セクション作成.
		$section_id = 'welcart_simpleplus_header_logo_section';
		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => __( 'Header Settings', 'welcart_simpleplus' ),
				'priority' => 100,
				'panel'    => $theme_options_id,
			)
		);

		$image_keys = array(
			'menu-type'   => array( // ヘッダーの設定値.
				'key'     => 'menu-type',
				'display' => array(
					'label'        => __( 'Header' ),
					'priority'     => 100,
					'setting_args' => array(
						'default' => 'every',
					),
					'type'         => 'select',
					'choices'      => array(
						'every'       => __( 'Always displayed', 'welcart_simpleplus' ),
						'scroll-top'  => __( 'Scroll top', 'welcart_simpleplus' ),
						'fade-in'     => __( 'Fade In', 'welcart_simpleplus' ),
						'under-media' => __( 'Behind the header image', 'welcart_simpleplus' ),

					),
				),
			),
			'menu-offset' => array( // ヘッダーのオフセット設定値.
				'key'     => 'menu-offset',
				'display' => array(
					'label'        => __( 'Timing to be displayed', 'welcart_simpleplus' ),
					'description'  => __( 'Set how many px scrolls the header should be displayed.', 'welcart_simpleplus' ),
					'priority'     => 200,
					'setting_args' => array(
						'default' => '200',
					),
					'type'         => 'number',
					'min'          => 0,
					'max'          => 2000,
					'step'         => 1,
				),
			),
			'logo'        => array(
				'key'              => 'header_logo',
				'pc'               => array(
					'type'     => 'image',
					'label'    => __( 'PC Logo', 'welcart_simpleplus' ),
					'priority' => 300,
				),
				'pc_before_scroll' => array(
					'type'        => 'image',
					'label'       => __( 'PC logo before scrolling', 'welcart_simpleplus' ),
					'description' => __( 'If it is not registered, the logo for PC will be displayed. <br> The white version of the PC logo is displayed.', 'welcart_simpleplus' ),
					'priority'    => 400,
				),
				'sp'               => array(
					'type'     => 'image',
					'label'    => __( 'Smartphone Logo', 'welcart_simpleplus' ),
					'priority' => 500,
				),
				'sp_before_scroll' => array(
					'type'        => 'image',
					'label'       => __( 'Smartphone Logo before scrolling', 'welcart_simpleplus' ),
					'description' => __( 'If it is not registered, the smartphone logo will be displayed. <br /> The white version of the smartphone logo will be displayed.', 'welcart_simpleplus' ),
					'priority'    => 600,
				),
			),
		);
		$this->register_customizer( $wp_customize, $image_keys, $section_id );
	}

	/**
	 * Grid image settings
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $theme_options_id theme_options_id.
	 * @return void
	 */
	public function notice_settings( $wp_customize, $theme_options_id ) {

		// セクション作成.
		$section_id = 'notice_section';
		$wp_customize->add_section(
			$section_id,
			array(
				'title'       => __( 'Notification settings', 'welcart_simpleplus' ),
				'description' => __( 'You can set where to display the information article that is fixed at the beginning.', 'welcart_simpleplus' ),
				'priority'    => 100,
				'panel'       => $theme_options_id,
			)
		);

		$register_args = array(
			'notice' => array(
				'key'         => 'notice',
				'notice_area' => array(
					'label'        => __( 'Notification area location', 'welcart_simpleplus' ),
					'priority'     => 100,
					'setting_args' => array(
						'default' => 'content-top',
					),
					'type'         => 'select',
					'choices'      => array( // Optional.
						'under-main-image' => __( 'Below the header image on the top page', 'welcart_simpleplus' ),
						'over-header'      => __( 'On the header of all pages', 'welcart_simpleplus' ),
						'content-top'      => __( 'Below the header of all pages', 'welcart_simpleplus' ),
						'no-display'       => __( 'Do not display', 'welcart_simpleplus' ),
					),
				),
			),
		);

		$this->register_customizer( $wp_customize, $register_args, $section_id );
	}

	/**
	 * Grid image settings
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $theme_options_id theme_options_id.
	 * @return void
	 */
	public function grid_image_settings( $wp_customize, $theme_options_id ) {

		$section_id = 'welcart_simpleplus_images';
		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => __( 'List image settings', 'welcart_simpleplus' ),
				'priority' => 100,
				'panel'    => $theme_options_id,
			)
		);

		$register_args = array(
			'welcart_simpleplus_images' => array(
				'key'                => 'image_settings',
				'allow_image_rect'   => array( // 画像を正方形で表示する チェックボックス.
					'label'        => __( 'Crop the image into a square', 'welcart_simpleplus' ),
					'type'         => 'checkbox',
					'setting_args' => array(
						'default' => true,
					),
					'priority'     => 200,
				),
				'grid_image_gap'     => array(// 画像間隔の設定値.
					'setting_args' => array(
						'default'           => '15',
						'transport'         => 'postMessage',
						'sanitize_callback' => 'sanitize_text_field',
					),
					'description'  => __( 'Please set the image spacing.', 'welcart_simpleplus' ),
					'priority'     => 400,
					'type'         => 'range',
					'input_attrs'  => array(
						'min'   => 0,
						'max'   => 50,
						'step'  => 1,
						'class' => 'form-range',
					),
				),
				'grid_image_radius'  => array( // 角丸の設定値.
					'setting_args' => array(
						'default'           => '15',
						'transport'         => 'postMessage',
						'sanitize_callback' => 'sanitize_text_field',
					),
					'description'  => __( 'Please set the rounded corners of the image.', 'welcart_simpleplus' ),
					'priority'     => 300,
					'type'         => 'range',
					'input_attrs'  => array(
						'min'   => 0,
						'max'   => 50,
						'step'  => 1,
						'class' => 'form-range',
					),
				),
				'grid_overlay_image' => array( // テキストの表示.
					'label'        => __( 'Overlaying text on top of image', 'welcart_simpleplus' ),
					'type'         => 'checkbox',
					'setting_args' => array(
						'default' => true,
					),
					'priority'     => 400,
				),
				'grid_text_shadow'   => array(
					'label'        => __( 'Text shadow when text is overlaid on an image', 'welcart_simpleplus' ),
					'type'         => 'checkbox',
					'setting_args' => array(
						'default' => false,
					),
					'priority'     => 500,
				),
			),
		);

		$this->register_customizer( $wp_customize, $register_args, $section_id );
	}

	/**
	 * Front Page Settings
	 * フロントページの表示部分についてのカスタマイズ
	 *
	 * theme_modに設定される値のkeyは以下の通り
	 * top_main_image_pc_setting
	 * top_main_image_sp_setting
	 * top_main_image_link_setting
	 * topics_list_setting
	 * items_list_setting
	 * news_list_setting
	 * topics_list_category_setting
	 * items_list_category_setting
	 * news_list_category_setting
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $panel_id panel_id.
	 * @return void
	 */
	public function front_page_settings( $wp_customize, $panel_id ) {

		// フロント設定パネルの作成.
		$front_section_id = 'welcart_simpleplus_front_section';

		// セクション作成.
		$wp_customize->add_section(
			$front_section_id,
			array(
				'title'    => __( 'Top page settings', 'welcart_simpleplus' ),
				'priority' => 100,
				'panel'    => $panel_id,
			)
		);

		$this->top_image_settings( $wp_customize, $panel_id, $front_section_id );

		$this->top_contents_settings( $wp_customize, $panel_id, $front_section_id );
	}

	/**
	 * トップイメージの設定部分
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $panel_id panel_id.
	 * @param string $section_id section_id.
	 * @return void
	 */
	public function top_image_settings( $wp_customize, $panel_id, $section_id ) {

		$default_setting_args = $this->default_setting_args;

		$image_keys = array(
			'top_main_image' => array(
				'key' => 'top_main_image',
				'sp'  => array(
					'type'        => 'image',
					'label'       => __( 'Header image for smartphone', 'welcart_simpleplus' ),
					'description' => __( 'If the image is not registered, the header image for the PC will be displayed even when the smartphone is displayed.', 'welcart_simpleplus' ),
					'priority'    => 200,
					'section'     => 'header_image',
				),
			),
		);
		$this->register_customizer( $wp_customize, $image_keys, $section_id );
	}

	/**
	 * トップのコンテンツ トピックや新商品・NEWSなどの設定
	 *
	 * topics_list_label_settings ラベルの文字
	 * topics_list_control_settings 表示数
	 * topics_list_gap_setting 隙間
	 * topics_list_round_setting 角丸
	 * items_list_label_settings ラベルの文字
	 * items_list_control_settings 表示数
	 * items_list_gap_setting 隙間
	 * items_list_round_setting 角丸
	 * news_list_label_settings ラベルの文字
	 * news_list_control_settings 表示数
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $panel_id panel_id.
	 * @param string $section_id section_id.
	 * @return void
	 */
	public function top_contents_settings( $wp_customize, $panel_id, $section_id ) {

		$term_choices = $this->get_term_choices();
		$term_choices = apply_filters( 'welcart_simpleplus_top_contents_settings_term_choices', $term_choices );

		$number_default       = array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		);
		$number_range_default = array(
			'min'   => 0,
			'max'   => 50,
			'step'  => 1,
			'class' => 'form-range',
		);
		$gap_default          = array(
			'default'   => '15',
			'transport' => 'postMessage',
		);
		$raound_default       = array(
			'default'   => '15',
			'transport' => 'postMessage',
		);

		$front_keys = array(
			'topics'    => array(
				'key'         => 'topics_list',
				'priority'    => 400,
				'display'     => array(
					'label'        => __( 'Show Topics', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => true,
					),
					'type'         => 'checkbox',
				),
				'slug'        => array(
					'setting_args' => array(
						'default'           => 'topic',
						'sanitize_callback' => array( $this, 'sanitize_slug' ),
					),
					'description'  => __( 'Enter the slug if you want to change the custom post type.', 'welcart_simpleplus' ),
				),
				'label'       => array( // 表示ラベル.
					'setting_args' => array(
						'default' => 'TOPICS',
					),
					'description'  => __( 'Please set a title.', 'welcart_simpleplus' ),
				),
				'control'     => array( // 表示件数の設定値.
					'description'  => __( 'Please select the number to be displayed.', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default'           => 5,
						'sanitize_callback' => array( $this, 'sanitize_number_range' ),
					),
					'type'         => 'number',
					'input_attrs'  => $number_default,
				),
				'gap'         => array( // 画像間隔の設定値.
					'setting_args' => $gap_default,
					'description'  => __( 'Please set the image spacing.', 'welcart_simpleplus' ),
					'type'         => 'range',
					'input_attrs'  => $number_range_default,
				),
				'round'       => array( // 角丸の設定値.
					'setting_args' => $raound_default,
					'description'  => __( 'Please set the rounded corners of the image.', 'welcart_simpleplus' ),
					'type'         => 'range',
					'input_attrs'  => $number_range_default,
				),
				'overlay'     => array( // テキストの表示.
					'label'        => __( 'Overlaying text on top of image', 'welcart_simpleplus' ),
					'type'         => 'checkbox',
					'setting_args' => array(
						'default' => true,
					),
				),
				'text_shadow' => array(
					'label'        => __( 'Text shadow when text is overlaid on an image', 'welcart_simpleplus' ),
					'type'         => 'checkbox',
					'setting_args' => array(
						'default' => false,
					),
				),
			),
			'item_list' => array(
				'key'         => 'items_list',
				'priority'    => 500,
				'display'     => array(
					'label'        => __( 'Show new products', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => true,
					),
					'type'         => 'checkbox',
				),
				'label'       => array( // 表示ラベル.
					'setting_args' => array(
						'default' => 'NEW ARRIVAL',
					),
					'description'  => __( 'Please set a title.', 'welcart_simpleplus' ),
				),
				'category'    => array( // 表示カテゴリー.
					'setting_args' => array(
						'default' => 'item',
					),
					'type'         => 'select',
					'description'  => __( 'Please select the category to display.', 'welcart_simpleplus' ),
					'choices'      => $term_choices,
				),
				'control'     => array( // 表示件数の設定値.
					'description'  => __( 'Please select the number to be displayed.', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default'           => 10,
						'sanitize_callback' => array( $this, 'sanitize_number_range' ),
					),
					'type'         => 'number',
					'input_attrs'  => array_merge(
						$number_default,
						array( 'max' => 20 ),
					),
				),
				'gap'         => array( // 画像間隔の設定値.
					'setting_args' => $gap_default,
					'description'  => __( 'Please set the image spacing.', 'welcart_simpleplus' ),
					'type'         => 'range',
					'input_attrs'  => $number_range_default,
				),
				'round'       => array( // 角丸サイズの設定値.
					'setting_args' => $raound_default,
					'description'  => __( 'Please set the rounded corners of the image.', 'welcart_simpleplus' ),
					'type'         => 'range',
					'input_attrs'  => $number_range_default,
				),
				'overlay'     => array(
					'label'        => __( 'Overlaying text on top of image', 'welcart_simpleplus' ),
					'type'         => 'checkbox',
					'setting_args' => array(
						'default' => true,
					),
				),
				'text_shadow' => array(
					'label'        => __( 'Text shadow when text is overlaid on an image', 'welcart_simpleplus' ),
					'type'         => 'checkbox',
					'setting_args' => array(
						'default' => false,
					),
				),
			),
			'news_list' => array(
				'key'      => 'news_list',
				'priority' => 600,
				'display'  => array(
					'label'        => __( 'Show News', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => true,
					),
					'type'         => 'checkbox',
				),
				'slug'     => array(
					'setting_args' => array(
						'default'           => 'news',
						'sanitize_callback' => array( $this, 'sanitize_slug' ),
					),
					'description'  => __( 'Enter the slug if you want to change the custom post type.', 'welcart_simpleplus' ),
				),
				'label'    => array( // 表示ラベル.
					'setting_args' => array(
						'default' => 'NEWS',
					),
					'description'  => __( 'Please set a title.', 'welcart_simpleplus' ),
				),
				'control'  => array( // 表示件数の設定値.
					'description'  => __( 'Please select the number to be displayed.', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default'           => 5,
						'sanitize_callback' => array( $this, 'sanitize_number_range' ),
					),
					'type'         => 'number',
					'input_attrs'  => $number_default,
				),
			),
		);

		$this->register_customizer( $wp_customize, $front_keys, $section_id );
	}

	/**
	 * Get term choices
	 *
	 * @return array
	 */
	public function get_term_choices() {
		// カテゴリー選択用 $term_choices.
		$item_id      = get_option( 'usces_item_cat_parent_id' );
		$item_cat     = get_category( $item_id );
		$term_choices = array(
			'item' => $item_cat->name,
		);
		if ( $item_id ) {
			$item_categories = get_categories(
				array(
					'child_of'   => $item_id,
					'hide_empty' => false,
				)
			);
			foreach ( $item_categories as $category ) {
				$term_choices[ $category->slug ] = $category->name;
			}
		}
		return $term_choices;
	}

	/**
	 * Sidebar settings
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $panel_id panel_id.
	 * @return void
	 */
	public function sidebar_settings( $wp_customize, $panel_id ) {

		$section_id = 'welcart_simpleplus_sidebar';
		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => __( 'Sidebar settings', 'welcart_simpleplus' ),
				'priority' => 100,
				'panel'    => $panel_id,
			)
		);

		$front_keys = array(
			'sidebar' => array(
				'key'      => 'sidebar',
				'priority' => 100,
				'display'  => array( // 表示件数の設定値.
					'label'        => __( 'Sidebar settings', 'welcart_simpleplus' ),
					'type'         => 'radio',
					'setting_args' => array(
						'default' => 'invisible',
					),
					'choices'      => array(
						'visible'   => __( 'Show sidebar', 'welcart_simpleplus' ),
						'invisible' => __( 'Don\'t show sidebar', 'welcart_simpleplus' ),
					),
				),
				'position' => array( // 表示件数の設定値.
					'label'        => __( 'Sidebar display location', 'welcart_simpleplus' ),
					'type'         => 'radio',
					'setting_args' => array(
						'default' => 'left',
					),
					'choices'      => array(
						'left'  => __( 'Left', 'welcart_simpleplus' ),
						'right' => __( 'Right', 'welcart_simpleplus' ),
					),
				),
			),
		);

		$this->register_customizer( $wp_customize, $front_keys, $section_id );
	}

	/**
	 * Item page settings
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $panel_id panel_id.
	 * @return void
	 */
	public function itempage_settings( $wp_customize, $panel_id ) {

		$section_id = 'item_setting';
		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => __( 'Item settings', 'welcart_simpleplus' ),
				'priority' => 100,
				'panel'    => $panel_id,
			)
		);

		$keys = array(
			'itempage' => array(
				'key'          => 'itempage',
				'priority'     => 100,
				'display_tag'  => array( // 商品タグを表示する設定値.
					'label'        => __( 'Show product tags', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => false,
					),
					'type'         => 'checkbox',
				),
				'incart_text'  => array( // カートへ入れるテキストの設定値.
					'label'        => __( 'Text to display on the button', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => __( 'Add to Shopping Cart', 'usces' ),
					),
				),
				'soldout_text' => array( // 売り切れ時の表示設定値.
					'label'        => __( 'Display when sold out', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => __( 'At present we cannot deal with this product.', 'welcart_simpleplus' ),
					),
				),
				'contact_btn'  => array( // お問い合わせボタンの表示の設定値.
					'label'        => __( 'Display of inquiry button', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => 'soldout',
					),
					'type'         => 'select',
					'choices'      => array(
						'not-show' => __( 'Do not show', 'welcart_simpleplus' ),
						'soldout'  => __( 'Displayed only when sold out', 'welcart_simpleplus' ),
					),
				),
				'contact_page' => array( // お問い合わせ先ページの設定値.
					'label'       => __( 'Inquiry Page', 'welcart_simpleplus' ),
					'description' => __( 'Select which fixed page to transition to when the inquiry button is clicked.', 'welcart_simpleplus' ),
					'type'        => 'dropdown-pages',
				),
				'contact_text' => array( // お問い合わせテキストの設定値.
					'label'        => __( 'Text to display on the button', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => __( 'Inquiries regarding this item', 'welcart_simpleplus' ),
					),
				),
				'reviews'      => array( // レビューを表示する設定値.
					'label'        => __( 'Display reviews', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => false,
					),
					'type'         => 'checkbox',
				),
			),
		);

		$this->register_customizer( $wp_customize, $keys, $section_id );
	}

	/**
	 * Cart page settings
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $panel_id panel_id.
	 * @return void
	 */
	public function cartpage_settings( $wp_customize, $panel_id ) {

		$section_id = 'cartpage_section';
		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => __( 'Cart page settings', 'welcart_simpleplus' ),
				'priority' => 100,
				'panel'    => $panel_id,
			)
		);

		$register_args = array(
			'change_link' => array(
				'key'          => 'change_link',
				'priority'     => 100,
				'allow_change' => array(
					'label'        => __( 'Change the link destination of the Continue shopping button', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => false,
					),
					'type'         => 'checkbox',
				),
				'incart_text'  => array( // カートへ入れるテキストの設定値.
					'label'        => __( 'URL of the link destination', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => '',
					),
				),
			),
		);

		$this->register_customizer( $wp_customize, $register_args, $section_id );
	}

	/**
	 * SNS settings
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param string $panel_id panel_id.
	 * @return void
	 */
	public function sns_settings( $wp_customize, $panel_id ) {

		$section_id = 'sns_section';
		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => __( 'SNS settings', 'welcart_simpleplus' ),
				'priority' => 100,
				'panel'    => $panel_id,
			)
		);

		$register_args = array(
			'sns_facebook'  => array(
				'key'        => 'facebook',
				'priority'   => 100,
				'page_name'  => array(
					'label'       => 'Facebook',
					'description' => __( 'Please enter your Facebook page name.<br />You do not need to enter https://www.facebook.com/.', 'welcart_simpleplus' ),
				),
				'allow_disp' => array(
					'label'        => __( 'No Facebook is displayed.', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => false,
					),
					'type'         => 'checkbox',
				),
			),
			'sns_instagram' => array(
				'key'        => 'instagram',
				'priority'   => 100,
				'page_name'  => array(
					'label'       => 'Instagram',
					'description' => __( 'Please enter your user name.<br />You do not need to enter https://www.instagram.com/.', 'welcart_simpleplus' ),
				),
				'allow_disp' => array(
					'label'        => __( 'Show Instagram', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => false,
					),
					'type'         => 'checkbox',
				),
			),
			'sns_twitter'   => array(
				'key'        => 'twitter',
				'priority'   => 100,
				'page_name'  => array(
					'label'       => 'Twitter',
					'description' => __( 'Please enter your user name.<br>You do not need to enter https://twitter.com/.', 'welcart_simpleplus' ),
				),
				'allow_disp' => array(
					'label'        => __( 'Show Twitter', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => false,
					),
					'type'         => 'checkbox',
				),
			),
			'sns_line'      => array(
				'key'        => 'line',
				'priority'   => 100,
				'page_name'  => array(
					'label'       => __( 'LINE official account', 'welcart_simpleplus' ),
					'description' => __( 'Please enter the URL.', 'welcart_simpleplus' ),
				),
				'allow_disp' => array(
					'label'        => __( 'Display your LINE official account', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => false,
					),
					'type'         => 'checkbox',
				),
			),
			'youtube'       => array(
				'key'        => 'youtube',
				'priority'   => 100,
				'page_name'  => array(
					'label'       => 'Youtube',
					'description' => __( 'Please enter the channel URL. do', 'welcart_simpleplus' ),
				),
				'allow_disp' => array(
					'label'        => __( 'Show Youtube', 'welcart_simpleplus' ),
					'setting_args' => array(
						'default' => false,
					),
					'type'         => 'checkbox',
				),
			),
		);

		$this->register_customizer( $wp_customize, $register_args, $section_id );
	}

	/**
	 * カスタマイザーをまとめて登録
	 *
	 * @param object $wp_customize WP_Customize_Manager.
	 * @param array  $register_args register_args.
	 * @param string $section_id section_id.
	 * @return void
	 */
	public function register_customizer( $wp_customize, $register_args, $section_id ) {

		$default_setting_args = $this->default_setting_args;

		foreach ( $register_args as $area_key => $args ) {
			$id             = $args['key'];
			$priority_cound = 0;
			foreach ( $args as $key => $val ) {
				if ( ! is_array( $val ) ) {
					continue;
				}

				// ラベルの登録.
				$setting_id   = $id . '_' . $key . '_setting';
				$setting_args = isset( $val['setting_args'] ) ? $val['setting_args'] : array();
				$wp_customize->add_setting(
					$setting_id,
					array_merge(
						$default_setting_args,
						$setting_args
					)
				);
				unset( $val['setting_args'] );

				// 表示優先度の設定 初期値100.
				$priority = isset( $args['priority'] ) ? $args['priority'] : 100;
				$type     = isset( $val['type'] ) ? $val['type'] : '';
				switch ( $type ) {
					case 'image':
						unset( $val['type'] );
						$wp_customize->add_control(
							new WP_Customize_Image_Control(
								$wp_customize,
								$id . '_' . $key,
								array_merge(
									array(
										'section'  => $section_id,
										'settings' => $setting_id,
										'priority' => $priority + $priority_cound,
									),
									$val,
								)
							)
						);
						break;

					default:
						$wp_customize->add_control(
							$id . '_' . $key,
							array_merge(
								array(
									'section'  => $section_id,
									'settings' => $setting_id,
									'priority' => $priority + $priority_cound,
								),
								$val
							)
						);
						break;
				}
			}
		}
	}

	/**
	 * Customizer Preview Url
	 * カスタマイザー用のプレビューのリンクを取得する
	 * front_link フロントページURL
	 * page_link 固定ページ
	 * cat_link 商品一覧ページURL
	 * lastItem_link 商品詳細ページ（最新一件）
	 * cart_link カートページURL
	 * member_link メンバーページURL
	 * postList_link 投稿一覧ページURL
	 * lastPost_link 投稿詳細ページ（最新一件）URL
	 *
	 * @return array
	 */
	public function get_customizer_preview_url() {

		// フロントページURL.
		$front_link = get_home_url();

		// 固定ページ.
		$page_link = get_page_link( 2 );

		// 商品一覧ページURL.
		$cat_name = get_category_by_slug( 'item' );
		$cat_id   = $cat_name->cat_ID;
		$cat_link = get_category_link( $cat_id );

		// 商品詳細ページ（最新一件）.
		$lastItem_link = get_home_url();
		$args          = array(
			'cat'            => $cat_id,
			'posts_per_page' => 1,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_type'      => 'post',
		);
		$item_posts    = get_posts( $args );
		if ( ! empty( $item_posts ) ) {
			wp_reset_postdata();
			$lastItem_link = get_permalink( $item_posts[0]->ID );
		}

		// カートページURL.
		$cart_link = usces_url( 'cart', 'return' );

		// メンバーページURL.
		$member_link = usces_url( 'member', 'return' );

		// 投稿一覧ページURL.
		$postList_link = get_category_link( 1 );

		// 投稿詳細ページ（最新一件）URL.
		$lastPost_link = get_category_link( 1 );
		$args          = array(
			'cat'            => -$cat_id,
			'posts_per_page' => 1,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_type'      => 'post',
		);
		$new_posts     = get_posts( $args );
		if ( ! empty( $new_posts ) ) {
			wp_reset_postdata();
			$lastPost_link = get_permalink( $new_posts[0]->ID );
		}

		$url_list = array(
			'front_link'    => $front_link,
			'page_link'     => $page_link,
			'cat_link'      => $cat_link,
			'lastItem_link' => $lastItem_link,
			'cart_link'     => $cart_link,
			'member_link'   => $member_link,
			'postList_link' => $postList_link,
			'lastPost_link' => $lastPost_link,
		);
		return apply_filters( 'welcart_simpleplus_customizer_preview_url', $url_list );
	}

	/**
	 * Callback
	 *
	 * @return bool
	 */
	public function callback_is_front_page() {
		return 'posts' === get_option( 'show_on_front' ) && ( is_home() || is_front_page() );
	}

	/**
	 * Sanitize image
	 *
	 * @param object $input input.
	 * @param object $setting setting.
	 * @return array
	 */
	public function sanitize_image( $input, $setting ) {
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'svg'          => 'image/svg+xml',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon',
		);
		$file  = wp_check_filetype( $input, $mimes );
		return ( $file['ext'] ? $input : $setting->default );
	}

	/**
	 * Theme sanitize number range
	 *
	 * @param int    $number number.
	 * @param object $setting setting.
	 */
	public function sanitize_number_range( $number, $setting ) {
		$number = absint( $number );
		$atts   = $setting->manager->get_control( $setting->id ) ? $setting->manager->get_control( $setting->id )->input_attrs : '';
		$min    = ( isset( $atts['min'] ) ? $atts['min'] : $number );
		$max    = ( isset( $atts['max'] ) ? $atts['max'] : $number );
		$step   = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
		return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
	}

	/**
	 * Returns default value if not set
	 *
	 * @param string $slug slug.
	 * @param array  $setting the setting object.
	 * @return string
	 */
	public function sanitize_slug( $slug, $setting ) {
		$slug = sanitize_key( $slug );
		if ( empty( $slug ) || '' === trim( $slug ) ) {
			$slug = $setting->default;
		}
		return $slug;
	}

	/**
	 * ライブプレビュー中の <head> 内に CSS を出力します。
	 *
	 * 実行されるフック: 'wp_head'
	 *
	 * @see add_action('wp_head',$func)
	 * @since MyTheme 1.0
	 */
	public function header_output() {
		$color_key        = array_keys( $this->wcsp_colors );
		$topics_gap       = get_theme_mod( 'topics_list_gap_setting', '15' );
		$topics_gap_val   = $topics_gap . 'px';
		$new_itemsgap     = get_theme_mod( 'items_list_gap_setting', '15' );
		$new_itemsgap_val = $new_itemsgap . 'px';
		$common_gap       = get_theme_mod( 'image_settings_grid_image_gap_setting', '15' );
		$common_gap_val   = $common_gap . 'px';
		?>
		<style type="text/css">
			.topics .grid {
				gap: calc( <?php echo esc_attr( $topics_gap_val ); ?>/1.6 );
			}
			.new-items .grid {
				gap: calc( <?php echo esc_attr( $new_itemsgap_val ); ?>/1.6 );
			}
			:root{
				--bs-gap : calc( <?php echo esc_attr( $common_gap_val ); ?>/1.6 );
				<?php
				$image_rect = get_theme_mod( 'image_settings_allow_image_rect_setting', true );
				$grid_image = $image_rect ? 'cover' : 'contain';
				echo esc_attr( '--grid-image-object-fit:' . $grid_image . ';' );
				self::generate_css_variable( 'grid-image-rounded-size', 'image_settings_grid_image_radius_setting', '', '%' );
				foreach ( $color_key as $key ) {
					self::generate_css_variable( $key, 'wcsp_colors_' . $key );
				}
				?>
			}
			<?php
			/* top topics */
			self::generate_css( '.topics .card-imag-top.grid-image', 'border-radius', 'topics_list_round_setting', '', '%' );
			self::generate_css( '.topics .card-imag-top.grid-image img', 'border-radius', 'topics_list_round_setting', '', '%' );
			self::generate_css( '.topics .card::before', 'border-radius', 'topics_list_round_setting', '', '%' );
			/* top item list */
			self::generate_css( '.new-items .card-imag-top .card-image', 'border-radius', 'items_list_round_setting', '', '%' );
			self::generate_css( '.new-items .card-imag-top.grid-image img', 'border-radius', 'items_list_round_setting', '', '%' );
			self::generate_css( '.new-items .card::before', 'border-radius', 'items_list_round_setting', '', '%' );
			self::generate_css( '.new-items .g-col-12.sticky-thumbnail .card .card-imag-top.grid-image .wp-post-image', 'border-radius', 'items_list_round_setting', '', '%' );
			self::generate_css( '.new-items .g-col-12.sticky-thumbnail .card .card-imag-top.grid-image .wp-post-image + img', 'border-radius', 'items_list_round_setting', '', '%' );
			?>
			@media screen and (min-width: 768px) {
				:root{
					<?php self::generate_css_variable( 'bs-gap', 'image_settings_grid_image_gap_setting', '', 'px' ); ?>
				}
				<?php
				/* gap */
				self::generate_css( '.topics .grid', 'gap', 'topics_list_gap_setting', '', 'px' );
				self::generate_css( '.new-items .grid', 'gap', 'items_list_gap_setting', '', 'px' );

				/* top item list */
				self::generate_css( '.new-items .g-col-12.sticky-thumbnail .card .card-imag-top.grid-image img', 'border-radius', 'items_list_round_setting', '', '%' );
				?>
			}
		</style>
		<?php
	}

	/**
	 * <head> 内に出力する CSS を作成します。
	 * $mod_name 設定が未定義の場合は、何も出力しません。
	 *
	 * @uses get_theme_mod()
	 * @param string $selector CSSセレクタ.
	 * @param string $style 変更する CSS *プロパティ* 名.
	 * @param string $mod_name 'theme_mod' 設定の名前.
	 * @param string $prefix （任意）CSS プロパティの前に出力する内容.
	 * @param string $postfix （任意）CSS プロパティの後に出力する内容.
	 * @param bool   $echo （任意）出力するか否か (デフォルト：true).
	 * @return string セレクタとプロパティからなる1行の CSS を返します.
	 * @since MyTheme 1.0
	 */
	public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {
		$return = '';
		$mod    = get_theme_mod( $mod_name );
		if ( is_numeric( $mod ) || 0 === strpos( $mod, '#' ) || 0 === strpos( $mod, 'rgba' ) ) {
			$return = sprintf(
				'%s { %s:%s; }',
				$selector,
				$style,
				$prefix . $mod . $postfix
			);
			if ( $echo ) {
				echo esc_attr( $return );
			}
		}
		return $return;
	}

	/**
	 * <head> 内に出力する CSS変数 を作成します。
	 * $mod_name 設定が未定義の場合は、何も出力しません。
	 *
	 * @uses get_theme_mod()
	 * @param string $selector CSS変数.
	 * @param string $mod_name 'theme_mod' 設定の名前.
	 * @param string $prefix （任意）CSS プロパティの前に出力する内容.
	 * @param string $postfix （任意）CSS プロパティの後に出力する内容.
	 * @param bool   $echo （任意）出力するか否か (デフォルト：true).
	 * @return string 変数名と値からなる1行の CSS を返します.
	 * @since MyTheme 1.0
	 */
	public static function generate_css_variable( $selector, $mod_name, $prefix = '', $postfix = '', $echo = true ) {
		$return = '';
		$mod    = get_theme_mod( $mod_name );
		if ( is_numeric( $mod ) || 0 === strpos( $mod, '#' ) || 0 === strpos( $mod, 'rgba' ) ) {
			$return = sprintf(
				'--%s:%s;',
				$selector,
				$prefix . $mod . $postfix
			);
			if ( $echo ) {
				echo esc_attr( $return );
			}
		}
		return $return;
	}

	/**
	 * RGBA カラー サニタイズ
	 *
	 * @param string $color color.
	 */
	public function sanitize_rgba_color( $color ) {
		if ( '' === $color ) {
			return '';
		}

		if ( false === strpos( $color, 'rgba' ) ) {
			$color = maybe_hash_hex_color( $color );
			return $color;
		} else {
			$color = str_replace( ' ', '', $color );
			sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
			return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
		}
	}

	/**
	 * カスタマイザーを見やすくするためにCSSで文言追加
	 *
	 * @see add_action('admin_print_styles',$func)
	 * @since MyTheme 1.0
	 */
	public function generate_css_text() {
		?>
		<style type="text/css">
			#customize-control-header-before-bg-color_control::before { content: "<?php esc_html_e( 'Header' ); ?>"; }
			#customize-control-btn-bg-color_control::before { content: "<?php esc_html_e( 'Button', 'welcart_simpleplus' ); ?>"; }
			#customize-control-topics_list_display::before { content: "<?php esc_html_e( 'Topic', 'welcart_simpleplus' ); ?>"; }
			#customize-control-items_list_display::before { content: "<?php esc_html_e( 'New Products', 'welcart_simpleplus' ); ?>"; }
			#customize-control-news_list_display::before { content: "<?php esc_html_e( 'News', 'welcart_simpleplus' ); ?>"; }
			#customize-control-itempage_display_tag::before { content: "<?php esc_html_e( 'Product tag', 'welcart_simpleplus' ); ?>"; }
			#customize-control-itempage_incart_text::before { content: "<?php esc_html_e( 'Cart Button', 'welcart_simpleplus' ); ?>"; }
			#customize-control-itempage_contact_btn::before { content: "<?php esc_html_e( 'Contact button', 'welcart_simpleplus' ); ?>"; }
			#customize-control-itempage_reviews::before { content: "<?php esc_html_e( 'Review', 'welcart_simpleplus' ); ?>"; }
			#customize-control-main-bg-color_control .description::before { content: "<?php esc_html_e( 'It will be reflected in the information list on the top page.', 'welcart_simpleplus' ); ?>"; }
			#customize-control-btn-hover-bg-color_control .description::before { content: "<?php esc_html_e( 'This is the setting when the mouse is over the main button, sub button 1, sub button 2, and cart button.', 'welcart_simpleplus' ); ?>"; }
		</style>
		<?php
	}
}
