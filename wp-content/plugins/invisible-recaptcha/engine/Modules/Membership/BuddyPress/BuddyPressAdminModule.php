<?php

namespace InvisibleReCaptcha\Modules\Membership\BuddyPress;


use InvisibleReCaptcha\MchLib\Plugin\MchBaseAdminPlugin;
use InvisibleReCaptcha\MchLib\Utils\MchHtmlUtils;
use InvisibleReCaptcha\Modules\BaseAdminModule;

class BuddyPressAdminModule extends BaseAdminModule
{
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
		$favIconUrl = MchBaseAdminPlugin::getPluginBaseUrl() . '/assets/admin/images/buddypress-favicon.png';
		$favIconUrl = esc_url($favIconUrl);
		echo("<div style='margin-top:20px;'>BuddyPressはインストールできません。</div>");
		

	}


}