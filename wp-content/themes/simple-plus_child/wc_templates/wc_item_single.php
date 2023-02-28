<?php
	if(is_single('custom01')):
		include_once('wc_item_single_custombag.php');
	else:
		include_once('wc_item_single_default.php');
	endif;
?>
