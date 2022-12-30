<?php


namespace InvisibleReCaptcha\Modules\Settings;


use InvisibleReCaptcha\MchLib\Utils\MchHtmlUtils;
use InvisibleReCaptcha\MchLib\Utils\MchWpUtils;
use InvisibleReCaptcha\Modules\BaseAdminModule;

class SettingsAdminModule extends BaseAdminModule
{
	CONST OPTION_SITE_KEY   = 'SiteKey';
	CONST OPTION_SECRET_KEY = 'SecretKey';
	CONST OPTION_LANGUAGE   = 'Language';

	CONST OPTION_BADGE_POSITION   = 'BadgePosition';
	CONST OPTION_BADGE_CUSTOM_CSS        = 'BadgeCSS';

	public function __construct()
	{
		parent::__construct();
	}

	public function getDefaultOptions() {
		static $arrDefaultSettingOptions = null;
		if(null !== $arrDefaultSettingOptions)
			return $arrDefaultSettingOptions;

		$arrDefaultSettingOptions = array(

			self::OPTION_SITE_KEY  => array(
				'Value'      => null,
				'LabelText'  => __('サイトキー', 'invisible-recaptcha'),
				'InputType'  => MchHtmlUtils::FORM_ELEMENT_INPUT_TEXT,
				'Description' => 'BuildSalon合同会社(旧MTEXPERT)で発行しているキーが標準で設定されています。
変更する場合はGoogleが提供する<a href="https://www.google.com/recaptcha/admin/">reCaptchaサイト</a>から設定してください。'
			),

			self::OPTION_SECRET_KEY  => array(
				'Value'      => true,
				'LabelText'  => __('シークレットキー', 'invisible-recaptcha'),
				'InputType'  => MchHtmlUtils::FORM_ELEMENT_INPUT_TEXT,
				'Description' => 'BuildSalon合同会社(旧MTEXPERT)で発行しているキーが標準で設定されています。
変更する場合はGoogleが提供する<a href="https://www.google.com/recaptcha/admin/">reCaptchaサイト</a>から設定してください。'
			),

			self::OPTION_LANGUAGE  => array(
					'Value'      => null,
					'LabelText'  => __('言語', 'invisible-recaptcha'),
					'InputType'  => MchHtmlUtils::FORM_ELEMENT_SELECT,
					'Description' => __('Googleがバッジとチャレンジに使用する言語を設定します。（表示される場合）', 'invisible-recaptcha')
			),

			self::OPTION_BADGE_POSITION  => array(
					'Value'      => 'bottomright',
					'LabelText'  => __('バッジの位置', 'invisible-recaptcha'),
					'InputType'  => MchHtmlUtils::FORM_ELEMENT_SELECT,
					'Description' => __('reCaptchaバッジの位置を変更します。 「インライン」値を使用すると、CSSを使用してスタイルを設定できます。', 'invisible-recaptcha')
			),

			self::OPTION_BADGE_CUSTOM_CSS => array(
					'Value'      => null,
					'LabelText'  => __('カスタムCSS', 'invisible-recaptcha'),
					'InputType'  => MchHtmlUtils::FORM_ELEMENT_INPUT_TEXTAREA,
					'Description' => __('reCaptchaバッジのスタイルを変更するために使用されるCSSです。 これはバッジの位置がインラインに設定されている場合にのみ適用されます。', 'invisible-recaptcha')
			),

		);

		return $arrDefaultSettingOptions;

	}

	public function renderModuleSettingsSectionHeader( array $arrSectionInfo ) {
		echo '<div class="mch-settings-section-header">
				<h3>'.__('reCapcthaの設定(オンラインサロンバージョン)', 'invisible-recaptcha').'</h3>
			</div>';
	}

	public function validateModuleSettingsFields( $arrOptions )
	{
		$arrOptions = $this->sanitizeModuleSettings($arrOptions);

		if(empty($arrOptions[self::OPTION_LANGUAGE])){
			unset($arrOptions[self::OPTION_LANGUAGE]);
		}

		$this->registerSuccessMessage(__('設定が変更されました。', 'invisible-recaptcha'));

		return $arrOptions;
	}

	public function renderModuleSettingsField(array $arrSettingsField)
	{
		$fieldKey   = key( $arrSettingsField );
		$fieldValue = $this->getOption( $fieldKey );

		MchWpUtils::addFilterHook($this->getFieldAttributesFilterName($fieldKey), function( $arrFieldAttributes ) use ( $fieldValue, $fieldKey) {

			if($fieldKey === SettingsAdminModule::OPTION_LANGUAGE){
				$arrFieldAttributes['options'] = wp_parse_args(SettingsAdminModule::getAvailableLanguages(), array('0' => __('自動選択', 'invisible-recaptcha')));
			}

			if($fieldKey === SettingsAdminModule::OPTION_BADGE_POSITION){
				$arrFieldAttributes['options'] = array(
					'bottomright' => __('右下', 'invisible-recaptcha'),
					'bottomleft'  => __('左下' , 'invisible-recaptcha'),
					'inline'      => __('インライン'      , 'invisible-recaptcha'),
				);
			}

			if($fieldKey === SettingsAdminModule::OPTION_BADGE_CUSTOM_CSS){
				$arrFieldAttributes['style'] = 'width:390px; height:90px;';
			}

			return $arrFieldAttributes;

		});

		return parent::renderModuleSettingsField($arrSettingsField);

	}

	public static function getAvailableLanguages()
	{
		$arrLanguages = array(
				"ar" => "Arabic",
				"af" => "Afrikaans",
				"am" => "Amharic",
				"hy" => "Armenian",
				"az" => "Azerbaijani",
				"eu" => "Basque",
				"bn" => "Bengali",
				"bg" => "Bulgarian",
				"ca" => "Catalan",
				"zh-HK" => "Chinese (Hong Kong)",
				"zh-CN" => "Chinese (Simplified)",
				"zh-TW" => "Chinese (Traditional)",
				"hr" => "Croatian",
				"cs" => "Czech",
				"da" => "Danish",
				"nl" => "Dutch",
				"en-GB" => "English (UK)",
				"en" => "English (US)",
				"et" => "Estonian",
				"fil" => "Filipino",
				"fi" => "Finnish",
				"fr" => "French",
				"fr-CA" => "French (Canadian)",
				"gl" => "Galician",
				"ka" => "Georgian",
				"de" => "German",
				"de-AT" => "German (Austria)",
				"de-CH" => "German (Switzerland)",
				"el" => "Greek",
				"gu" => "Gujarati",
				"iw" => "Hebrew",
				"hi" => "Hindi",
				"hu" => "Hungarain",
				"is" => "Icelandic",
				"id" => "Indonesian",
				"it" => "Italian",
				"ja" => "Japanese",
				"kn" => "Kannada",
				"ko" => "Korean",
				"lo" => "Laothian",
				"lv" => "Latvian",
				"lt" => "Lithuanian",
				"ms" => "Malay",
				"ml" => "Malayalam",
				"mr" => "Marathi",
				"mn" => "Mongolian",
				"no" => "Norwegian",
				"fa" => "Persian",
				"pl" => "Polish",
				"pt" => "Portuguese",
				"pt-BR" => "Portuguese (Brazil)",
				"pt-PT" => "Portuguese (Portugal)",
				"ro" => "Romanian",
				"ru" => "Russian",
				"sr" => "Serbian",
				"si" => "Sinhalese",
				"sk" => "Slovak",
				"sl" => "Slovenian",
				"es" => "Spanish",
				"es-419" => "Spanish (Latin America)",
				"sw" => "Swahili",
				"sv" => "Swedish",
				"ta" => "Tamil",
				"te" => "Telugu",
				"th" => "Thai",
				"tr" => "Turkish",
				"uk" => "Ukrainian",
				"ur" => "Urdu",
				"vi" => "Vietnamese",
				"zu" => "Zulu",
);

		return $arrLanguages;

	}
}