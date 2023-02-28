(function ($) {
	// リアルタイムに背景色を変更
	for (const key of wcspColors) {
		wp.customize('wcsp_colors_' + key, function (value) {
			value.bind(function (newval) {
				// $('body').css('background-color', newval);
				addStyleForHead(key, newval);
			});
		});
	}

	// トップページTOPICSの角丸用のクラスを設定
	wp.customize('topics_list_round_setting', function (value) {
		value.bind(function (newval) {
			renewRoundClass(
				$('.front-page section.topics div.grid article'),
				newval
			);
		});
	});

	// トップページ新着商品の角丸用のクラスを設定
	wp.customize('items_list_round_setting', function (value) {
		value.bind(function (newval) {
			renewRoundClass(
				$('.front-page section.new-items div.grid article'),
				newval
			);
		});
	});

	// 一覧ページ（トピックス、新着商品など）の角丸用のクラスを設定
	wp.customize('image_settings_grid_image_radius_setting', function (value) {
		value.bind(function (newval) {
			renewRoundClass($('.item-category div.grid article'), newval);
			renewRoundClass($('.archive-topic div.grid article'), newval);
			renewRoundClass($('.post-category div.grid article'), newval);
			renewRoundClass($('.assistance_item > ul li'), newval);
			renewRoundClass($('.member-favorite div.grid article'), newval);
			renewRoundClass(
				$('.front-page .widget_welcart_bestseller > ul li'),
				newval
			);
			renewRoundClass(
				$('.general-widget-area .widget_welcart_bestseller > ul li'),
				newval
			);
			renewRoundClass(
				$('.front-page .widget_basic_item_list article'),
				newval
			);
			renewRoundClass(
				$('.general-widget-area .widget_basic_item_list article'),
				newval
			);
		});
	});

	for (const key of otherCustomizer) {
		wp.customize(key, function (value) {
			value.bind(function (newval) {
				addStyleForHeadGrid(key, newval);
			});
		});
	}

	function addStyleForHeadGrid(key, newval) {
		const document = window.document;
		let css;
		if (document.getElementById(key)) {
			css = document.getElementById(key);
			css.textContent = '';
		} else {
			css = document.createElement('style');
			css.id = key;
		}
		$innerCssList = {
			image_settings_grid_image_radius_setting: `:root{ --grid-image-rounded-size:${newval}%}`,
			image_settings_grid_image_gap_setting: `:root{ --bs-gap:${newval}px}`,
			topics_list_round_setting: `.topics .card-imag-top.grid-image,.topics .card-imag-top.grid-image img,.topics .card::before{ border-radius:${newval}%}`,
			topics_list_gap_setting: `.topics .grid{ gap:${newval}px}`,
			items_list_round_setting: `.new-items .card-imag-top .card-image,.new-items .card-imag-top.grid-image img,.new-items .card::before,.new-items .g-col-12.sticky-thumbnail .card .card-imag-top.grid-image .wp-post-image + img,.new-items .g-col-12.sticky-thumbnail .card .card-imag-top.grid-image .wp-post-image{border-radius:${newval}%}`,
			items_list_gap_setting: `.new-items .grid{ gap:${newval}px}`,
		};
		$innerCss = $innerCssList[key];
		const rule = document.createTextNode($innerCss);
		if (css.styleSheet) {
			css.styleSheet.cssText = rule.nodeValue;
		} else {
			css.appendChild(rule);
		}
		document.getElementsByTagName('head')[0].appendChild(css);
	}

	function addStyleForHead(name, value) {
		const document = window.document;
		let css;
		if (document.getElementById(name)) {
			css = document.getElementById(name);
			css.textContent = '';
		} else {
			css = document.createElement('style');
			css.id = name;
		}
		const rule = document.createTextNode(
			':root{ --' + name + ':' + value + '}'
		);
		if (css.styleSheet) {
			css.styleSheet.cssText = rule.nodeValue;
		} else {
			css.appendChild(rule);
		}
		document.getElementsByTagName('head')[0].appendChild(css);
	}

	// 角丸再設定用の関数
	function renewRoundClass(e, newval) {
		// 一旦 g-rounded-* のクラスを削除しておく
		// @see https://qiita.com/shouchida/items/01bada913bf660cdad03
		e.removeClass(function (index, className) {
			return (className.match(/(^|\s)g-rounded-[0-9]+/g) || []).join(' ');
		});

		// 設定値に応じてクラスを付与する
		if (newval <= 10) {
			e.addClass('g-rounded-10');
		} else if (newval <= 20) {
			e.addClass('g-rounded-20');
		} else if (newval <= 30) {
			e.addClass('g-rounded-30');
		} else if (newval <= 40) {
			e.addClass('g-rounded-40');
		} else {
			// 50以上の場合
			e.addClass('g-rounded-50');
		}
	}
})(jQuery);
