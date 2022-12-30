<?php

namespace InvisibleReCaptcha\Modules\Membership\UltraCommunity;


use InvisibleReCaptcha\MchLib\Plugin\MchBaseAdminPlugin;
use InvisibleReCaptcha\MchLib\Utils\MchHtmlUtils;
use InvisibleReCaptcha\Modules\BaseAdminModule;

class UltraCommunityAdminModule extends BaseAdminModule
{
	CONST OPTION_LOGIN_FORM_PROTECTION_ENABLED          = 'IsLoginEnabled';
	CONST OPTION_REGISTRATION_FORM_PROTECTION_ENABLED   = 'IsRegisterEnabled';

	public  function __construct()
	{
		parent::__construct();
	}


	public function getDefaultOptions()
	{
		static $arrDefaultSettingOptions = null;
		if(null !== $arrDefaultSettingOptions)
			return $arrDefaultSettingOptions;

		$arrDefaultSettingOptions = array(

			self::OPTION_LOGIN_FORM_PROTECTION_ENABLED => array(
				'Value'      => null,
				'LabelText'  => __('ログインフォーム保護を有効にする', 'invisible-recaptcha'),
				'InputType'  => MchHtmlUtils::FORM_ELEMENT_INPUT_CHECKBOX
			),

			self::OPTION_REGISTRATION_FORM_PROTECTION_ENABLED  => array(
				'Value'      => null,
				'LabelText'  => __('登録フォーム保護を有効にする', 'invisible-recaptcha'),
				'InputType'  => MchHtmlUtils::FORM_ELEMENT_INPUT_CHECKBOX
			),

		);

		return $arrDefaultSettingOptions;

	}

	public function validateModuleSettingsFields( $arrOptions )
	{
		$arrOptions = $this->sanitizeModuleSettings($arrOptions);
		$this->registerSuccessMessage(__('変更は正常に保存されました！', 'invisible-recaptcha'));

		return $arrOptions;
	}


	public function renderModuleSettingsSectionHeader( array $arrSectionInfo ) {
		$favIconUrl = MchBaseAdminPlugin::getPluginBaseUrl() . '/assets/admin/images/ultracommunity-favicon.png';
		$favIconUrl = esc_url($favIconUrl);

		echo '<div class="mch-settings-section-header">
				<h3>

				<a style="text-decoration: none;" href="https://wordpress.org/plugins/ultra-community/" target="_blank">
					<img style="vertical-align:text-bottom; margin-bottom: -4px;" src = "' . $favIconUrl . '" width="28" height="28" />
					<span>UltraCommunity</span>
				</a>
				'.__(' 保護設定', 'invisible-recaptcha').'</h3>
			</div>';
	}


}