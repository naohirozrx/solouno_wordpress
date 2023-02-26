const CustomizerSettings = {
	constructor(CustomizerSettingArgs) {
		wp.customize.bind('ready', function () {
			for (const arg in CustomizerSettingArgs) {
				wp.customize.section(arg.section_id, function (section) {
					section.expanded.bind(function (isExpanding) {
						if (isExpanding) {
							wp.customize.previewer.previewUrl.set(
								arg.preview_url
							);
							wp.customize.previewer.refresh();
						}
					});
				});
			}
		});
	},
};
// CustomizerSettingArgsでリンクを受け取る
if (typeof welcartSimpleplusCustomizerSettingArgs !== 'undefined') {
	const customizerSettings = CustomizerSettings.constructor(
		welcartSimpleplusCustomizerSettingArgs
	);
}
