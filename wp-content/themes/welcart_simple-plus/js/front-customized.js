(function ($) {
	$(document).ready(function () {
		$('#toTop').hide();
		$(window).on('scroll', function () {
			if ($(this).scrollTop() > 100) {
				$('#toTop').fadeIn();
			} else {
				$('#toTop').fadeOut();
			}
		});
		$('#toTop a').on('click', function () {
			const speed = 800;
			const href = $(this).attr('href');
			const target = $(
				href === '#masthead' || href === '' ? 'html' : href
			);
			const position = target.offset().top;
			$('html, body').animate({ scrollTop: position }, speed, 'swing');
			return false;
		});

		$('a.dropdown-item.dropdown-toggle').on('click', function () {
			location.href = this.href;
		});

		const totalitems = $('.carousel-inner .carousel-item').length;
		const currentindex = 1;
		$('.carousel-num').html('' + currentindex + '/' + totalitems + '');
		$('#singleItemCarousel').on('slid.bs.carousel', function () {
			const currentindex =
				$(this)
					.find('.active')
					.index('.carousel-inner .carousel-item') + 1;
			$('.carousel-num').html('' + currentindex + '/' + totalitems + '');
		});
	});

	// Contact Form7
	$(function () {
		const pair = location.search.substring(1).split('&');
		const arg = new Object();
		for (let i = 0; pair[i]; i++) {
			const kv = pair[i].split('=');
			arg[kv[0]] = kv[1];
		}
		if (undefined !== arg.from_item && undefined !== arg.from_sku) {
			$('.wpcf7-submit').on('click', function () {
				const form = $(this).parents('form');
				form.attr('action', $(this).data('action'));
				$('<input>')
					.attr({
						type: 'hidden',
						name: 'from_item',
						value: arg.from_item,
					})
					.appendTo(form);
				$('<input>')
					.attr({
						type: 'hidden',
						name: 'from_sku',
						value: arg.from_sku,
					})
					.appendTo(form);
			});
		}
	});
})(jQuery);

document.addEventListener('DOMContentLoaded', function () {
	document.querySelectorAll('.dropdown-menu').forEach(function (element) {
		element.addEventListener('click', function (e) {
			e.stopPropagation();
		});
	});

	// ページ上部から表示されるタイミング分スクロールした際にヘッダメニューを制御.
	const wcspHeaderDOM = document.querySelector('#header'),
		wcspHeaderOffset = Number(wcspHeaderDOM.dataset.scrollOffset) || 0; // 表示されるタイミング (WordPressの設定値).

	// 交差ターゲットとなる要素を登録.
	const wcspObserveDOM = document.createElement('div');
	wcspObserveDOM.id = 'wcspHeaderDisplayTiming';
	Object.assign(wcspObserveDOM.style, {
		height: wcspHeaderOffset + 'px',
		position: 'absolute',
		zIndex: '-1',
		top: '0',
	});
	document.querySelector('body').prepend(wcspObserveDOM);

	// 交差オブザーバーAPIでヘッダーメニューの表示を切り替え.
	const wcspHeaderObserver = new IntersectionObserver(
		(entries) => {
			for (let key = entries.length; key--; ) {
				// 監視領域への交差有無に応じて切り替え.
				if (entries[key].isIntersecting) {
					wcspHeaderDOM.classList.remove('scroll-in');
				} else {
					wcspHeaderDOM.classList.add('scroll-in');
				}
			}
		},
		{
			root: null, // 監視領域はブラウザのビューポート.
			rootMargin: '0px 0px -100%', // 監視領域を上辺境界に指定.
			threshold: 0, // 一部でも交差したら実行.
		}
	);
	wcspHeaderObserver.observe(document.getElementById(wcspObserveDOM.id));
});
