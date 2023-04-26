<?php
	if(
		is_home()
		|| is_page('aboutus')
		|| is_page('product')
		|| is_archive('news')
		|| is_singular('news')
		|| is_page('flow')
		|| is_page('disney')
		|| is_page('showroom')
		|| is_archive('exhibit')
		|| is_singular('exhibit')
		|| is_page('request')
		|| is_page('law')
		|| is_page('privacy')
	):
		include_once('header_web.php');
	else:
		include_once('header_ec.php');
	endif;
?>
