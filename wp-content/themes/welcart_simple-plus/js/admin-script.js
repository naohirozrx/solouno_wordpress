// カテゴリー編集時のみに限定
jQuery(function ($) {
	if (term_args.currentScreen === 'edit-category') {
		$('textarea#description').closest('tr.form-field').remove();
	}

	let fileFrame;

	$(document).on('click', '#wcct-term-thumbnail-action', function (e) {
		e.preventDefault();

		if (fileFrame) {
			fileFrame.open();
			return;
		}

		fileFrame = wp.media({
			title: term_args?.categoryImageText,
			library: {
				type: 'image',
				author: userSettings.uid,
			},
			button: {
				text: term_args?.setTheCategoryImageText,
				close: true,
			},
			multiple: false,
		});

		fileFrame.on('select', function () {
			const attachment = fileFrame
				.state()
				.get('selection')
				.first()
				.toJSON();
			$('#wcct-term-thumbnail-url').val(attachment.url);
			$('#wcct-term-thumbnail-id').val(attachment.id);
			$('#wcct-term-thumbnail-preview').html(
				'<img style="max-width: 100%;" src="' + attachment.url + '" />'
			);
		});

		fileFrame.open();
	});
});
