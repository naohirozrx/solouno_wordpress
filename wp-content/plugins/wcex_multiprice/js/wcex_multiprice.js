jQuery(document).ready(function($) {
	var $tabs = $('#wcex_multiprice_tabs').tabs();
	if( $.fn.jquery < "1.10" ) {
		var $tabs = $('#wcex_multiprice_tabs').tabs({
			cookie: {
				expires: 1
			}
		});
	} else {
		$( "#wcex_multiprice_tabs" ).tabs({
			active: ($.cookie("wcex_multiprice_tabs")) ? $.cookie("wcex_multiprice_tabs") : 0
			, activate: function( event, ui ){
				$.cookie("wcex_multiprice_tabs", $(this).tabs("option", "active"));
			}
		});
	}

	// Prevent Submit by Enter key
	$("form input").keypress(function(e) {
		if( (e.which && e.which == 13) || (e.keyCode && e.keyCode == 13) ) {
			return false;
		} else {
			return true;
		}
	});

	// Change Option1
	$('.wcex_multiprice_option1').change(function() {
		var id = $(':input[name="wcex_multiprice_id[]"]:eq('+$tabs.tabs('option', tabs_selected())+')').val();
		if($(this).val() != '#NONE#') {
			if($(this).val() == $('#wcex_multiprice_option2_'+id).val()) {
				alert(wcex_multiprice_data.message02);
				$(this).attr({selectedIndex:0});
				return;
			}
			pricevalues($tabs.tabs('option', tabs_selected()));
		}
	});

	// Change Option2
	$('.wcex_multiprice_option2').change(function() {
		var id = $(':input[name="wcex_multiprice_id[]"]:eq('+$tabs.tabs('option', tabs_selected())+')').val();
		if($(this).val() == $('#wcex_multiprice_option1_'+id).val()) {
			alert(wcex_multiprice_data.message01);
			$(this).attr({selectedIndex:0});
			return;
		}
		pricevalues($tabs.tabs('option', tabs_selected()));
	});

	// Add a condition
	$('[name*="wcex_multiprice_dimension"]').change(function() {
		var id = $(this).closest('form').find('input[name="wcex_multiprice_id[]"]').val();
		var itemOption2 = $('#wcex_multiprice_item_option2_' + id);

		if($(this).is(":checked")) {
			itemOption2.show();
		} else {
			$('#wcex_multiprice_option2_' + id).val('#NONE#');
			pricevalues($tabs.tabs('option', tabs_selected()));
			itemOption2.hide();
		}
	});

	// Change Key1
	$('.wcex_multiprice_key1').bind("changeKey1", 
		function(event, name) {
			var key = $(':input[name="'+name+'"]').val();
			if(key == '' || !checkIsNumber(key)) return;
			var namekey = name.split('_');
			var index = $('[name*="'+namekey[0]+'_key1"]').index(this) + 1;
			var idkey = '#'+namekey[0]+'_addx_'+index;
			if($(idkey).text() != undefined) {
				$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
			}
		}
	);
	$('.wcex_multiprice_key1').change(function() {
		$(this).trigger("changeKey1", [$(this).attr('name')]);
	});

	// Change Key2
	$('.wcex_multiprice_key2').bind("changeKey2", 
		function(event, name) {
			var key = $(':input[name="'+name+'"]').val();
			if(key == '' || !checkIsNumber(key)) return;
			var namekey = name.split('_');
			var index = $('[name*="'+namekey[0]+'_key2"]').index(this) + 1;
			var idkey = '#'+namekey[0]+'_addy_'+index;
			if($(idkey).text() != undefined) {
				$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
			}
		}
	);
	$('.wcex_multiprice_key2').change(function() {
		$(this).trigger("changeKey2", [$(this).attr('name')]);
	});

	//$('form').submit(function() {
	$(':submit').click(function(ev) {
		var index = $tabs.tabs('option', tabs_selected());
		var id = $(':input[name="wcex_multiprice_id[]"]:eq('+index+')').val();
		//$('#wcex_multiprice_selected_id').val(id);
		//$('#wcex_multiprice_selected_index').val(index);
		var name = ev.target.name;

		// Delete
		if(0 <= name.indexOf('wcex_multiprice_delete')) {
			if( confirm(wcex_multiprice_data.confirm01.replace("%s", $('#wcex_multiprice_name_'+id).val())) ) {
				return true;
			} else {
				return false;
			}

		// Update
		} else if(0 <= name.indexOf('wcex_multiprice_update')) {
			var namecheck = true;
			$('input[id^="wcex_multiprice_name_"]').each(function() {
				if("wcex_multiprice_name_"+id != $(this).attr("id")) {
					if($('input[name="wcex_multiprice_name_'+id+'"]').val() == $(this).val()) {
						alert(wcex_multiprice_data.message06);
						namecheck = false;
						return false;
					}
				}
			});
			if(!namecheck) {
				return false;
			}

			var option1 = $('#wcex_multiprice_option1_'+id).val();
			if(option1 == '#NONE#') {
				alert(wcex_multiprice_data.message03);
				return false;
			}
			var option2 = $('#wcex_multiprice_option2_'+id).val();
			//var means1 = wcex_multiprice_data.option_means[$('#wcex_multiprice_option1_'+id).attr('selectedIndex')];
			//var means2 = (option2 == '#NONE#') ? -1 : wcex_multiprice_data.option_means[$('#wcex_multiprice_option2_'+id).attr('selectedIndex')];
			var means1 = wcex_multiprice_data.option_means[$('#wcex_multiprice_option1_'+id).get(0).selectedIndex];
			var means2 = (option2 == '#NONE#') ? -1 : wcex_multiprice_data.option_means[$('#wcex_multiprice_option2_'+id).get(0).selectedIndex];
			if( means1 == 0 || means1 == 3 ) {/* [Option1]:Single-select or Radio-button */
				if( means2 == 0 || means2 == 3 ) {/* [Option2]:Single-select or Radio-button */
					var len_key1 = $('[id*="'+id+'_key1"]').length;
					var len_key2 = $('[id*="'+id+'_key2"]').length;
					for(i = 0; i < len_key1; i++) {
						for(j = 0; j < len_key2; j++) {
							val = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
							if(val == '' || !checkIsNumber(val)) {
								alert(wcex_multiprice_data.message04);
								return false;
							}
						}
					}

				} else if(means2 == 2) {/* [Option2]:Text */
					var len_key1 = $('[id*="'+id+'_key1"]').length;
					var len_key2 = $('[name*="'+id+'_key2"]').length;
					if(len_key2 == 0) {
						alert(wcex_multiprice_data.message04);
						return false;
					}
					len_key2--;
					for(i = 0; i < len_key2; i++) {
						key2 = $(':input[name="'+id+'_key2['+i+']"]').val();
						if(key2 == '' || !checkIsNumber(key2)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
					}
					// Last column
					key2 = $(':input[name="'+id+'_key2['+i+']"]').val();
					if(key2 != '') {// The last key can be unentered.
						if(!checkIsNumber(key2)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
					}
					len_key2++;
					for(i = 0; i < len_key1; i++) {
						for(j = 0; j < len_key2; j++) {
							val = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
							if(val == '' || !checkIsNumber(val)) {
								alert(wcex_multiprice_data.message04);
								return false;
							}
						}
					}

				} else {/* [Option1]:Single-select or Radio-button */
					var len_key1 = $('[id*="'+id+'_key1"]').length;
					for(i = 0; i < len_key1; i++) {
						val = $(':input[name="'+id+'_val['+i+'][0]"]').val();
						if(val == '' || !checkIsNumber(val)) {
							alert(wcex_multiprice_data.message04);
							return false;
						}
					}
				}

			} else if(means1 == 2) {/* [Option1]:Text */
				if( means2 == 0 || means2 == 3) {/* [Option2]:Single-select or Radio-button */
					var len_key1 = $('[name*="'+id+'_key1"]').length;
					var len_key2 = $('[id*="'+id+'_key2"]').length;
					len_key1--;
					for(i = 0; i < len_key1; i++) {
						key1 = $(':input[name="'+id+'_key1['+i+']"]').val();
						if(key1 == '' || !checkIsNumber(key1)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
						for(j = 0; j < len_key2; j++) {
							val = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
							if(val == '' || !checkIsNumber(val)) {
								alert(wcex_multiprice_data.message04);
								return false;
							}
						}
					}
					// Last row
					key1 = $(':input[name="'+id+'_key1['+i+']"]').val();
					if(key1 != '') {// The last key can be unentered.
						if(!checkIsNumber(key1)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
					}
					for(j = 0; j < len_key2; j++) {
						val = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
						if(val == '' || !checkIsNumber(val)) {
							alert(wcex_multiprice_data.message04);
							return false;
						}
					}

				} else if(means2 == 2) {/* [Option2]:Text */
					var len_key1 = $('[name*="'+id+'_key1"]').length;
					var len_key2 = $('[name*="'+id+'_key2"]').length;
					len_key2--;
					for(i = 0; i < len_key2; i++) {
						key2 = $(':input[name="'+id+'_key2['+i+']"]').val();
						if(key2 == '' || !checkIsNumber(key2)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
					}
					// Last column
					key2 = $(':input[name="'+id+'_key2['+i+']"]').val();
					if(key2 != '') {// The last key can be unentered.
						if(!checkIsNumber(key2)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
					}
					len_key1--;
					len_key2++;
					for(i = 0; i < len_key1; i++) {
						key1 = $(':input[name="'+id+'_key1['+i+']"]').val();
						if(key1 == '' || !checkIsNumber(key1)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
						for(j = 0; j < len_key2; j++) {
							val = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
							if(val == '' || !checkIsNumber(val)) {
								alert(wcex_multiprice_data.message04);
								return false;
							}
						}
					}
					// Last row
					key1 = $(':input[name="'+id+'_key1['+i+']"]').val();
					if(key1 != '') {// The last key can be unentered.
						if(!checkIsNumber(key1)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
					}
					for(j = 0; j < len_key2; j++) {
						val = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
						if(val == '' || !checkIsNumber(val)) {
							alert(wcex_multiprice_data.message04);
							return false;
						}
					}

				} else {/* [Option1]:Text Only. */
					var len_key1 = $('[name*="'+id+'_key1"]').length;
					len_key1--;
					for(i = 0; i < len_key1; i++) {
						key1 = $(':input[name="'+id+'_key1['+i+']"]').val();
						if(key1 == '' || !checkIsNumber(key1)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
						val = $(':input[name="'+id+'_val['+i+'][0]"]').val();
						if(val == '' || !checkIsNumber(val)) {
							alert(wcex_multiprice_data.message04);
							return false;
						}
					}
					// Last row
					key1 = $(':input[name="'+id+'_key1['+i+']"]').val();
					if(key1 != '') {// The last key can be unentered.
						if(!checkIsNumber(key1)) {
							alert(wcex_multiprice_data.message05);
							return false;
						}
					}
					val = $(':input[name="'+id+'_val['+i+'][0]"]').val();
					if(val == '' || !checkIsNumber(val)) {
						alert(wcex_multiprice_data.message04);
						return false;
					}
				}
			}

		// Add new
		} else if(name == 'wcex_multiprice_add') {

		// Cancel
		} else if(0 <= name.indexOf('wcex_multiprice_cancel')) {

		} else {
			return false;
		}
	});

	// Price setting
	function pricevalues(selected) {
		var id = $(':input[name="wcex_multiprice_id[]"]:eq('+selected+')').val();
		var option1 = $('#wcex_multiprice_option1_'+id).val();
		if(option1 == '#NONE#') return;
		var option2 = $('#wcex_multiprice_option2_'+id).val();
		//var means1 = wcex_multiprice_data.option_means[$('#wcex_multiprice_option1_'+id).attr('selectedIndex')];
		//var means2 = (option2 == '#NONE#') ? -1 : wcex_multiprice_data.option_means[$('#wcex_multiprice_option2_'+id).attr('selectedIndex')];
		var means1 = wcex_multiprice_data.option_means[$('#wcex_multiprice_option1_'+id).get(0).selectedIndex];
		var means2 = (option2 == '#NONE#') ? -1 : wcex_multiprice_data.option_means[$('#wcex_multiprice_option2_'+id).get(0).selectedIndex];

		// Get the original values
		var key1 = new Array();
		var key2 = new Array();
		var val = new Array(200);
		for(i = 0; i < 200; i++) {
			val[i] = new Array(200);
		}
		var len_key1 = ($('[name*="'+id+'_key1"]').length < 0) ? 0 : $('[name*="'+id+'_key1"]').length;

		var len_key1_id = ($('[id*="'+id+'_key1"]').length < 0) ? 0 : $('[id*="'+id+'_key1"]').length;
		var len_key2 = ($('[name*="'+id+'_key2"]').length < 0) ? 0 : $('[name*="'+id+'_key2"]').length;
		var len_key2_id = ($('[id*="'+id+'_key2"]').length < 0) ? 0 : $('[id*="'+id+'_key2"]').length;
		if(len_key1 > 0) {
			if(len_key2 > 0) {/* [Option1]:Text, [Option2]:Text */
				for(i = 0; i < len_key2; i++) {
					key2[i] = $(':input[name="'+id+'_key2['+i+']"]').val();
				}
				for(i = 0; i < len_key1; i++) {
					key1[i] = $(':input[name="'+id+'_key1['+i+']"]').val();
					for(j = 0; j < len_key2; j++) {
						val[i][j] = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
					}
				}
			} else if(len_key2_id > 0) {/* [Option1]:Text, [Option2]:Single-select */
				for(i = 0; i < len_key1; i++) {
					key1[i] = $(':input[name="'+id+'_key1['+i+']"]').val();
					for(j = 0; j < len_key2_id; j++) {
						val[i][j] = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
					}
				}
			} else {/* [Option1]:Text Only. */
				for(i = 0; i < len_key1; i++) {
					key1[i] = $(':input[name="'+id+'_key1['+i+']"]').val();
					val[i][0] = $(':input[name="'+id+'_val['+i+'][0]"]').val();
				}
			}
		} else if(len_key1_id > 0) {
			if(len_key2 > 0) {/* [Option1]:Single-select, [Option2]:Text */
				for(i = 0; i < len_key2; i++) {
					key2[i] = $(':input[name="'+id+'_key2['+i+']"]').val();
				}
				for(i = 0; i < len_key1_id; i++) {
					for(j = 0; j < len_key2; j++) {
						val[i][j] = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
					}
				}
			} else if(len_key2_id > 0) {/* [Option1]:Single-select, [Option2]:Single-select */
				for(i = 0; i < len_key1_id; i++) {
					for(j = 0; j < len_key2_id; j++) {

						val[i][j] = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
					}
				}
			} else {/* [Option1]:Single-select Only. */
				for(i = 0; i < len_key1_id; i++) {
					val[i][0] = $(':input[name="'+id+'_val['+i+'][0]"]').val();
				}
			}
		}

		if(means1 == 2) $('[name*="'+id+'_key1"]').unbind("changeKey1");
		if(means2 == 2) $('[name*="'+id+'_key2"]').unbind("changeKey2");
		if(means1 == 0 || means2 == 0) {
			$.ajax({
				url: ajaxurl,
				type: "POST",
				data: {
					action: "wcex_multiprice_get_option_value",
					cart_number: wcex_multiprice_data.cart_number,
					key1: option1,
					key2: option2
				}
			}).done(function( retVal ) {
				var sts = retVal.sts;
				var msg = retVal.msg;
				if(sts != 0) {
					alert(msg);
					return;
				}

				$('#wcex_multiprice_'+id).empty();
				if(means2 == 2) {
					$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_addcol_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_addcol+'">');
					$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_delcol_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_delcol+'">');
					$('#wcex_multiprice_'+id).append('<span class="wcex_multiprice_title">'+wcex_multiprice_data.lbl_col+option2+'</span>');
				}
				$('<table id="wcex_multiprice_table_'+id+'" class="wcex_multiprice_table"></table>').html('<tbody></tbody>').appendTo('#wcex_multiprice_'+id);

				if(means1 == 0) {
					if(means2 == 0) {/* [Option1]:Single-select, [Option2]:Single-select */
						var value1 = retVal.option1_value.split('#;#');
						var value2 = retVal.option2_value.split('#;#');
						var td = "";
						for(i = 0; i < value2.length; i++) {
							td += '<th class="mltp_th"><span id="'+id+'_key2_'+i+'">'+value2[i]+'</span></th>';
						}
						$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
						for(i = 0; i < value1.length; i++) {
							td = "";
							for(j = 0; j < value2.length; j++) {
								td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+setVal(val[i][j])+'"></td>';
							}
							$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_key1_'+i+'">'+value1[i]+'</span></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
						}

					} else if(means2 == 2) {/* [Option1]:Single-select, [Option2]:Text */
						var value1 = retVal.option1_value.split('#;#');
						if(len_key2 > 0) {
							var td = "";
							var y_from = wcex_multiprice_data.lbl_from0;
							for(i = 0; i < len_key2; i++) {
								td += '<th class="mltp_th"><span id="'+id+'_addy_'+i+'">'+y_from+'</span><input type="text" name="'+id+'_key2['+i+']" class="wcex_multiprice_key2" value="'+setVal(key2[i])+'"></th>';
								y_from = (key2[i] == '' || !checkIsNumber(key2[i])) ? '' : (parseInt(key2[i]) + 1) + wcex_multiprice_data.lbl_dash;
							}
							$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
							for(i = 0; i < value1.length; i++) {
								td = "";
								for(j = 0; j < len_key2; j++) {
									td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+setVal(val[i][j])+'"></td>';
								}
								$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_key1_'+i+'">'+value1[i]+'</span></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
							}
						} else if(len_key2_id > 0) {
							var td = "";
							var y_from = wcex_multiprice_data.lbl_from0;
							for(i = 0; i < len_key2_id; i++) {
								td += '<th class="mltp_th"><span id="'+id+'_addy_'+i+'">'+y_from+'</span><input type="text" name="'+id+'_key2['+i+']" class="wcex_multiprice_key2" value=""></th>';
								y_from = '';
							}
							$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
							for(i = 0; i < value1.length; i++) {
								td = "";
								for(j = 0; j < len_key2_id; j++) {
									td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+setVal(val[i][j])+'"></td>';
								}
								$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_key1_'+i+'">'+value1[i]+'</span></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
							}
						} else {
							$('<tr></tr>').html('<th class="mltp_th"></th><th class="mltp_th"><span id="'+id+'_addy_0">'+wcex_multiprice_data.lbl_from0+'</span><input type="text" name="'+id+'_key2[0]" class="wcex_multiprice_key2" value=""></th>').appendTo('#wcex_multiprice_table_'+id+' tbody');
							for(i = 0; i < value1.length; i++) {
								$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_key1_'+i+'">'+value1[i]+'</span></th><td><input type="text" name="'+id+'_val['+i+'][0]" class="wcex_multiprice_val" value="'+setVal(val[i][0])+'"></td>').appendTo('#wcex_multiprice_table_'+id+' tbody');
							}
						}
						$('[name*="'+id+'_key2"]').bind("changeKey2", 
							function(event, name) {
								var key = $(':input[name="'+name+'"]').val();
								if(key == '' || !checkIsNumber(key)) return;
								var namekey = name.split('_');
								var index = $('[name*="'+namekey[0]+'_key2"]').index(this) + 1;
								var idkey = '#'+namekey[0]+'_addy_'+index;
								if($(idkey).text() != undefined) {
									$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
								}
							}
						);
						$('[name*="'+id+'_key2"]').change(function() {
							$(this).trigger("changeKey2", [$(this).attr('name')]);
						});

					} else {/* [Option1]:Single-select Only. */
						var value1 = retVal.option1_value.split('#;#');
						for(i = 0; i < value1.length; i++) {
							$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_key1_'+i+'">'+value1[i]+'</span></th><td><input type="text" name="'+id+'_val['+i+'][0]" class="wcex_multiprice_val" value="'+setVal(val[i][0])+'"></td>').appendTo('#wcex_multiprice_table_'+id+' tbody');
						}
					}

				} else if(means1 == 2) {
					if(means2 == 0) {/* [Option1]:Text, [Option2]:Single-select */
						var value2 = retVal.option2_value.split('#;#');
						var td = "";
						for(i = 0; i < value2.length; i++) {
							td += '<th class="mltp_th"><span id="'+id+'_key2_'+i+'">'+value2[i]+'</span></th>';
						}
						$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
						if(len_key1 > 0) {
							var x_from = wcex_multiprice_data.lbl_from0;
							for(i = 0; i < len_key1; i++) {
								td = "";
								for(j = 0; j < value2.length; j++) {
									td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+setVal(val[i][j])+'"></td>';
								}
								$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value="'+setVal(key1[i])+'"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
								x_from = (key1[i] == '' || !checkIsNumber(key1[i])) ? '' : (parseInt(key1[i]) + 1) + wcex_multiprice_data.lbl_dash;
							}
						} else if(len_key1_id > 0) {
							var x_from = wcex_multiprice_data.lbl_from0;
							for(i = 0; i < len_key1_id; i++) {
								td = "";
								for(j = 0; j < value2.length; j++) {
									td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+setVal(val[i][j])+'"></td>';
								}
								$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value=""></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
								x_from = '';
							}
						} else {
							td = "";
							for(i = 0; i < value2.length; i++) {
								td += '<td><input type="text" name="'+id+'_val[0]['+i+']" class="wcex_multiprice_val" value="'+setVal(val[0][i])+'"></td>';
							}
							$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_0">'+wcex_multiprice_data.lbl_from0+'</span><input type="text" name="'+id+'_key1[0]" class="wcex_multiprice_key1" value=""></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
						}
					}
					$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_addrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_addrow+'">');
					$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_delrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_delrow+'">');
					$('#wcex_multiprice_'+id).append('<span class="wcex_multiprice_title">'+wcex_multiprice_data.lbl_row+option1+'</span>');
					$('[name*="'+id+'_key1"]').bind("changeKey1", 
						function(event, name) {
							var key = $(':input[name="'+name+'"]').val();
							if(key == '' || !checkIsNumber(key)) return;
							var namekey = name.split('_');
							var index = $('[name*="'+namekey[0]+'_key1"]').index(this) + 1;
							var idkey = '#'+namekey[0]+'_addx_'+index;
							if($(idkey).text() != undefined) {
								$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
							}
						}
					);
					$('[name*="'+id+'_key1"]').change(function() {
						$(this).trigger("changeKey1", [$(this).attr('name')]);
					});
				}
			}).fail(function( retVal ) {
				alert('Ajax error in wcex_multiprice');
			});
			return false;

		} else {
			$('#wcex_multiprice_'+id).empty();
			if(means2 == 2) {
				$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_addcol_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_addcol+'">');
				$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_delcol_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_delcol+'">');
				$('#wcex_multiprice_'+id).append('<span class="wcex_multiprice_title">'+wcex_multiprice_data.lbl_col+option2+'</span>');
			}
			$('<table id="wcex_multiprice_table_'+id+'" class="wcex_multiprice_table"></table>').html('<tbody></tbody>').appendTo('#wcex_multiprice_'+id);

			if(means1 == 2 && means2 == 2) {/* [Option1]:Text, [Option2]:Text */
				if(len_key1 > 0) {
					if(len_key2 > 0) {
						var td = "";
						var y_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key2; i++) {
							td += '<th class="mltp_th"><span id="'+id+'_addy_'+i+'">'+y_from+'</span><input type="text" name="'+id+'_key2['+i+']" class="wcex_multiprice_key2" value="'+setVal(key2[i])+'"></th>';
							y_from = (key2[i] == '' || !checkIsNumber(key2[i])) ? '' : (parseInt(key2[i]) + 1) + wcex_multiprice_data.lbl_dash;
						}
						$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
						var x_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key1; i++) {
							td = "";
							for(j = 0; j < len_key2; j++) {
								td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+setVal(val[i][j])+'"></td>';
							}
							$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value="'+setVal(key1[i])+'"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
							x_from = (key1[i] == '' || !checkIsNumber(key1[i])) ? '' : (parseInt(key1[i]) + 1) + wcex_multiprice_data.lbl_dash;
						}
					} else if(len_key2_id > 0) {
						var td = "";
						var y_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key2_id; i++) {
							td += '<th class="mltp_th"><span id="'+id+'_addy_'+i+'">'+y_from+'</span><input type="text" name="'+id+'_key2['+i+']" class="wcex_multiprice_key2" value=""></th>';
							y_from = '';
						}
						$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
						var x_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key1; i++) {
							td = "";
							for(j = 0; j < len_key2_id; j++) {
								td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+setVal(val[i][j])+'"></td>';
							}
							$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value="'+setVal(key1[i])+'"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
							x_from = (key1[i] == '' || !checkIsNumber(key1[i])) ? '' : (parseInt(key1[i]) + 1) + wcex_multiprice_data.lbl_dash;
						}
					} else {
						$('<tr></tr>').html('<th class="mltp_th"></th><th class="mltp_th"><span id="'+id+'_addy_0">'+wcex_multiprice_data.lbl_from0+'</span><input type="text" name="'+id+'_key2[0]" class="wcex_multiprice_key2" value=""></th>').appendTo('#wcex_multiprice_table_'+id+' tbody');
						var x_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key1; i++) {
							$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value="'+setVal(key1[i])+'"></th><td><input type="text" name="'+id+'_val['+i+'][0]" class="wcex_multiprice_val" value="'+setVal(val[i][0])+'"></td>').appendTo('#wcex_multiprice_table_'+id+' tbody');
							x_from = (key1[i] == '' || !checkIsNumber(key1[i])) ? '' : (parseInt(key1[i]) + 1) + wcex_multiprice_data.lbl_dash;
						}
					}
				} else if(len_key1_id > 0) {
					if(len_key2 > 0) {
						var td = "";
						var y_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key2; i++) {
							td += '<th class="mltp_th"><span id="'+id+'_addy_'+i+'">'+y_from+'</span><input type="text" name="'+id+'_key2['+i+']" class="wcex_multiprice_key2" value="'+setVal(key2[i])+'"></th>';
							y_from = (key2[i] == '' || !checkIsNumber(key2[i])) ? '' : (parseInt(key2[i]) + 1) + wcex_multiprice_data.lbl_dash;
						}
						$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
						var x_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key1_id; i++) {
							td = "";
							for(j = 0; j < len_key2; j++) {
								td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+setVal(val[i][j])+'"></td>';
							}
							$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value="'+setVal(key1[i])+'"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
							x_from = '';
						}
					} else if(len_key2_id > 0) {
						var td = "";
						var y_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key2_id; i++) {
							td += '<th class="mltp_th"><span id="'+id+'_addy_'+i+'">'+y_from+'</span><input type="text" name="'+id+'_key2['+i+']" class="wcex_multiprice_key2" value=""></th>';
							y_from = '';
						}
						$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
						var x_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key1_id; i++) {
							td = "";
							for(j = 0; j < len_key2_id; j++) {
								td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+setVal(val[i][j])+'"></td>';
							}
							$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value="'+setVal(key1[i])+'"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
							x_from = '';
						}
					} else {
						$('<tr></tr>').html('<th class="mltp_th"></th><th class="mltp_th"><span id="'+id+'_addy_0">'+wcex_multiprice_data.lbl_from0+'</span><input type="text" name="'+id+'_key2[0]" class="wcex_multiprice_key2" value=""></th>').appendTo('#wcex_multiprice_table_'+id+' tbody');
						var x_from = wcex_multiprice_data.lbl_from0;
						for(i = 0; i < len_key1_id; i++) {
							$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value=""></th><td><input type="text" name="'+id+'_val['+i+'][0]" class="wcex_multiprice_val" value="'+setVal(val[i][0])+'"></td>').appendTo('#wcex_multiprice_table_'+id+' tbody');
							x_from = '';
						}
					}
				} else {
					$('<tr></tr>').html('<th class="mltp_th"></th><th class="mltp_th"><span id="'+id+'_addy_0">'+wcex_multiprice_data.lbl_from0+'</span><input type="text" name="'+id+'_key2[0]" class="wcex_multiprice_key2" value=""></th>').appendTo('#wcex_multiprice_table_'+id+' tbody');
					$('<tr></tr>').html('<th class="mltp_th"><span id="'+id+'_addx_0">'+wcex_multiprice_data.lbl_from0+'</span><input type="text" name="'+id+'_key1[0]" class="wcex_multiprice_key1" value=""></th><td><input type="text" name="'+id+'_val[0][0]" class="wcex_multiprice_val" value="'+val[0][0]+'"></td>').appendTo('#wcex_multiprice_table_'+id+' tbody');
				}
				$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_addrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_addrow+'">');
				$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_delrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_delrow+'">');
				$('#wcex_multiprice_'+id).append('<span class="wcex_multiprice_title">'+wcex_multiprice_data.lbl_row+option1+'</span>');
				$('[name*="'+id+'_key1"]').bind("changeKey1", 
					function(event, name) {
						var key = $(':input[name="'+name+'"]').val();
						if(key == '' || !checkIsNumber(key)) return;
						var namekey = name.split('_');
						var index = $('[name*="'+namekey[0]+'_key1"]').index(this) + 1;
						var idkey = '#'+namekey[0]+'_addx_'+index;
						if($(idkey).text() != undefined) {
							$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
						}
					}
				);
				$('[name*="'+id+'_key1"]').change(function() {
					$(this).trigger("changeKey1", [$(this).attr('name')]);
				});
				$('[name*="'+id+'_key2"]').bind("changeKey2", 
					function(event, name) {
						var key = $(':input[name="'+name+'"]').val();
						if(key == '' || !checkIsNumber(key)) return;
						var namekey = name.split('_');
						var index = $('[name*="'+namekey[0]+'_key2"]').index(this) + 1;
						var idkey = '#'+namekey[0]+'_addy_'+index;
						if($(idkey).text() != undefined) {
							$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
						}
					}
				);
				$('[name*="'+id+'_key2"]').change(function() {
					$(this).trigger("changeKey2", [$(this).attr('name')]);
				});

			} else if(means1 == 2) {/* [Option1]:Text Only. */
				if(len_key1 > 0) {
					var x_from = wcex_multiprice_data.lbl_from0;
					for(i = 0; i < len_key1; i++) {
						$('<tr></tr>').html('<th class="mltp_th"><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value="'+setVal(key1[i])+'"></th><td><input type="text" name="'+id+'_val['+i+'][0]" class="wcex_multiprice_val" value="'+setVal(val[i][0])+'"></td>').appendTo('#wcex_multiprice_table_'+id+' tbody');
						x_from = (key1[i] == '' || !checkIsNumber(key1[i])) ? '' : (parseInt(key1[i]) + 1) + wcex_multiprice_data.lbl_dash;
					}
				} else if(len_key1_id > 0) {
					var x_from = wcex_multiprice_data.lbl_from0;
					for(i = 0; i < len_key1_id; i++) {
						$('<tr></tr>').html('<th class="mltp_th"><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value=""></th><td><input type="text" name="'+id+'_val['+i+'][0]" class="wcex_multiprice_val" value="'+setVal(val[i][0])+'"></td>').appendTo('#wcex_multiprice_table_'+id+' tbody');
						x_from = '';
					}
				} else {
					$('<tr></tr>').html('<th class="mltp_th"><span id="'+id+'_addx_0">'+wcex_multiprice_data.lbl_from0+'</span><input type="text" name="'+id+'_key1[0]" class="wcex_multiprice_key1" value=""></th><td><input type="text" name="'+id+'_val[0][0]" class="wcex_multiprice_val" value=""></td>').appendTo('#wcex_multiprice_table_'+id+' tbody');
				}
				$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_addrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_addrow+'">');
				$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_delrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_delrow+'">');
				$('#wcex_multiprice_'+id).append('<span class="wcex_multiprice_title">'+wcex_multiprice_data.lbl_row+option1+'</span>');
				$('[name*="'+id+'_key1"]').bind("changeKey1", 
					function(event, name) {
						var key = $(':input[name="'+name+'"]').val();
						if(key == '' || !checkIsNumber(key)) return;
						var namekey = name.split('_');
						var index = $('[name*="'+namekey[0]+'_key1"]').index(this) + 1;
						var idkey = '#'+namekey[0]+'_addx_'+index;
						if($(idkey).text() != undefined) {
							$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
						}
					}
				);
				$('[name*="'+id+'_key1"]').change(function() {
					$(this).trigger("changeKey1", [$(this).attr('name')]);
				});
			}
		}
	};

	// Add column
	$('body').on('click', '[id*="wcex_multiprice_addcol"]', function() {
		var id = $(':input[name="wcex_multiprice_id[]"]:eq('+$tabs.tabs('option', tabs_selected())+')').val();
		var len_key2 = $('[name*="'+id+'_key2"]').length;
		if(len_key2 == 0) return;
		var len_val = $('[name*="'+id+'_val"]').length;
		var len_key1 = len_val / len_key2;

		var key2 = new Array();
		for(i = 0; i < len_key2; i++) {
			key2[i] = $(':input[name="'+id+'_key2['+i+']"]').val();
		}
		var key1 = new Array();
		//var means1 = wcex_multiprice_data.option_means[$('#wcex_multiprice_option1_'+id).attr('selectedIndex')];
		var means1 = wcex_multiprice_data.option_means[$('#wcex_multiprice_option1_'+id).get(0).selectedIndex];
		if(means1 == 0) {/* [Option1]:Single-select, [Option2]:Text */
			for(i = 0; i < len_key1; i++) {
				key1[i] = $('#'+id+'_key1_'+i+'').text();
			}

		} else {/* [Option1]:Text, [Option2]:Text */
			for(i = 0; i < len_key1; i++) {
				key1[i] = $(':input[name="'+id+'_key1['+i+']"]').val();
			}
		}
		var val = new Array();
		for(i = 0; i < len_key1; i++) {
			val[i] = new Array();
			for(j = 0; j < len_key2; j++) {
				val[i][j] = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
			}
		}

		if(means1 == 2) $('[name*="'+id+'_key1"]').unbind("changeKey1");
		$('[name*="'+id+'_key2"]').unbind("changeKey2");
		$('#wcex_multiprice_'+id).empty();
		$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_addcol_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_addcol+'">');
		$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_delcol_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_delcol+'">');
		$('#wcex_multiprice_'+id).append('<span class="wcex_multiprice_title">'+wcex_multiprice_data.lbl_col+$('#wcex_multiprice_option2_'+id).val()+'</span>');
		$('<table id="wcex_multiprice_table_'+id+'" class="wcex_multiprice_table"></table>').html('<tbody></tbody>').appendTo('#wcex_multiprice_'+id);

		var td = "";
		var y_from = wcex_multiprice_data.lbl_from0;
		for(i = 0; i < len_key2; i++) {
			td += '<th class="mltp_th"><span id="'+id+'_addy_'+i+'">'+y_from+'</span><input type="text" name="'+id+'_key2['+i+']" class="wcex_multiprice_key2" value="'+key2[i]+'"></th>';
			y_from = (key2[i] == '' || !checkIsNumber(key2[i])) ? '' : (parseInt(key2[i]) + 1) + wcex_multiprice_data.lbl_dash;
		}
		td += '<th class="mltp_th"><span id="'+id+'_addy_'+i+'">'+y_from+'</span><input type="text" name="'+id+'_key2['+i+']" class="wcex_multiprice_key2" value=""></th>';
		$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');

		if(means1 == 0) {/* [Option1]:Single-select, [Option2]:Text */
			for(i = 0; i < len_key1; i++) {
				td = "";
				for(j = 0; j < len_key2; j++) {
					td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+val[i][j]+'"></td>';
				}
				td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value=""></td>';
				$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_key1_'+i+'">'+key1[i]+'</span></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
			}

		} else {/* [Option1]:Text, [Option2]:Text */
			var x_from = wcex_multiprice_data.lbl_from0;
			for(i = 0; i < len_key1; i++) {
				td = "";
				for(j = 0; j < len_key2; j++) {
					td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+val[i][j]+'"></td>';
				}
				td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value=""></td>';
				$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value="'+key1[i]+'"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
				x_from = (key1[i] == '' || !checkIsNumber(key1[i])) ? '' : (parseInt(key1[i]) + 1) + wcex_multiprice_data.lbl_dash;
			}
			$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_addrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_addrow+'">');
			$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_delrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_delrow+'">');
			$('#wcex_multiprice_'+id).append('<span class="wcex_multiprice_title">'+wcex_multiprice_data.lbl_row+$('#wcex_multiprice_option1_'+id).val()+'</span>');
			$('[name*="'+id+'_key1"]').bind("changeKey1", 
				function(event, name) {
					var key = $(':input[name="'+name+'"]').val();
					if(key == '' || !checkIsNumber(key)) return;
					var namekey = name.split('_');
					var index = $('[name*="'+namekey[0]+'_key1"]').index(this) + 1;
					var idkey = '#'+namekey[0]+'_addx_'+index;
					if($(idkey).text() != undefined) {
						$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
					}
				}
			);
			$('[name*="'+id+'_key1"]').change(function() {
				$(this).trigger("changeKey1", [$(this).attr('name')]);
			});
		}
		$('[name*="'+id+'_key2"]').bind("changeKey2", 
			function(event, name) {
				var key = $(':input[name="'+name+'"]').val();
				if(key == '' || !checkIsNumber(key)) return;
				var namekey = name.split('_');
				var index = $('[name*="'+namekey[0]+'_key2"]').index(this) + 1;
				var idkey = '#'+namekey[0]+'_addy_'+index;
				if($(idkey).text() != undefined) {
					$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
				}
			}
		);
		$('[name*="'+id+'_key2"]').change(function() {
			$(this).trigger("changeKey2", [$(this).attr('name')]);
		});
	});

	// Delete row
	$('body').on('click', '[id*="wcex_multiprice_delcol"]', function() {
		var id = $(':input[name="wcex_multiprice_id[]"]:eq('+$tabs.tabs('option', tabs_selected())+')').val();
		var len_key2 = $('[name*="'+id+'_key2"]').length;
		if(len_key2 == 1) return;
		var len_val = $('[name*="'+id+'_val"]').length;
		var len_key1 = len_val / len_key2;

		var key2 = new Array();
		for(i = 0; i < len_key2; i++) {
			key2[i] = $(':input[name="'+id+'_key2['+i+']"]').val();
		}
		var key1 = new Array();
		//var means1 = wcex_multiprice_data.option_means[$('#wcex_multiprice_option1_'+id).attr('selectedIndex')];
		var means1 = wcex_multiprice_data.option_means[$('#wcex_multiprice_option1_'+id).get(0).selectedIndex];
		if(means1 == 0) {/* [Option1]:Single-select, [Option2]:Text */
			for(i = 0; i < len_key1; i++) {
				key1[i] = $('#'+id+'_key1_'+i+'').text();
			}

		} else {/* [Option1]:Text, [Option2]:Text */
			for(i = 0; i < len_key1; i++) {
				key1[i] = $(':input[name="'+id+'_key1['+i+']"]').val();
			}
		}
		var val = new Array();
		for(i = 0; i < len_key1; i++) {
			val[i] = new Array();
			for(j = 0; j < len_key2; j++) {
				val[i][j] = $(':input[name="'+id+'_val['+i+']['+j+']"]').val();
			}
		}

		if(means1 == 2) $('[name*="'+id+'_key1"]').unbind("changeKey1");
		$('[name*="'+id+'_key2"]').unbind("changeKey2");
		$('#wcex_multiprice_'+id).empty();
		$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_addcol_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_addcol+'">');
		$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_delcol_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_delcol+'">');
		$('#wcex_multiprice_'+id).append('<span class="wcex_multiprice_title">'+wcex_multiprice_data.lbl_col+$('#wcex_multiprice_option2_'+id).val()+'</span>');
		$('<table id="wcex_multiprice_table_'+id+'" class="wcex_multiprice_table"></table>').html('<tbody></tbody>').appendTo('#wcex_multiprice_'+id);

		len_key2--;

		var td = "";
		var y_from = wcex_multiprice_data.lbl_from0;
		for(i = 0; i < len_key2; i++) {
			td += '<th class="mltp_th"><span id="'+id+'_addy_'+i+'">'+y_from+'</span><input type="text" name="'+id+'_key2['+i+']" class="wcex_multiprice_key2" value="'+key2[i]+'"></th>';
			y_from = (key2[i] == '' || !checkIsNumber(key2[i])) ? '' : (parseInt(key2[i]) + 1) + wcex_multiprice_data.lbl_dash;
		}
		$('<tr></tr>').html('<th class="mltp_th"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');

		if(means1 == 0) {/* [Option1]:Single-select, [Option2]:Text */
			for(i = 0; i < len_key1; i++) {
				td = "";
				for(j = 0; j < len_key2; j++) {
					td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+val[i][j]+'"></td>';
				}
				$('<tr></tr>').html('<th class="mltp_th" nowrap><span id="'+id+'_key1_'+i+'">'+key1[i]+'</span></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
			}

		} else {/* [Option1]:Text, [Option2]:Text */
			var x_from = wcex_multiprice_data.lbl_from0;
			for(i = 0; i < len_key1; i++) {
				td = "";
				for(j = 0; j < len_key2; j++) {
					td += '<td><input type="text" name="'+id+'_val['+i+']['+j+']" class="wcex_multiprice_val" value="'+val[i][j]+'"></td>';
				}
				$('<tr></tr>').html('<th class="mltp_th"><span id="'+id+'_addx_'+i+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+i+']" class="wcex_multiprice_key1" value="'+key1[i]+'"></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
				x_from = (key1[i] == '' || !checkIsNumber(key1[i])) ? '' : (parseInt(key1[i]) + 1) + wcex_multiprice_data.lbl_dash;
			}
			$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_addrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_addrow+'">');
			$('#wcex_multiprice_'+id).append('<input type="button" id="wcex_multiprice_delrow_'+id+'" class="button button_multiprice" value="'+wcex_multiprice_data.lbl_delrow+'">');
			$('#wcex_multiprice_'+id).append('<span class="wcex_multiprice_title">'+wcex_multiprice_data.lbl_row+$('#wcex_multiprice_option1_'+id).val()+'</span>');
			$('[name*="'+id+'_key1"]').bind("changeKey1", 
				function(event, name) {
					var key = $(':input[name="'+name+'"]').val();
					if(key == '' || !checkIsNumber(key)) return;
					var namekey = name.split('_');
					var index = $('[name*="'+namekey[0]+'_key1"]').index(this) + 1;
					var idkey = '#'+namekey[0]+'_addx_'+index;
					if($(idkey).text() != undefined) {
						$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
					}
				}
			);
			$('[name*="'+id+'_key1"]').change(function() {
				$(this).trigger("changeKey1", [$(this).attr('name')]);
			});
		}
		$('[name*="'+id+'_key2"]').bind("changeKey2", 
			function(event, name) {
				var key = $(':input[name="'+name+'"]').val();
				if(key == '' || !checkIsNumber(key)) return;
				var namekey = name.split('_');
				var index = $('[name*="'+namekey[0]+'_key2"]').index(this) + 1;
				var idkey = '#'+namekey[0]+'_addy_'+index;
				if($(idkey).text() != undefined) {
					$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
				}
			}
		);
		$('[name*="'+id+'_key2"]').change(function() {
			$(this).trigger("changeKey2", [$(this).attr('name')]);
		});
	});

	// Add row
	$('body').on('click', '[id*="wcex_multiprice_addrow"]', function() {
		var id = $(':input[name="wcex_multiprice_id[]"]:eq('+$tabs.tabs('option', tabs_selected())+')').val();
		var len_key1 = $('[name*="'+id+'_key1"]').length;
		if(len_key1 == 0) return;

		var lastrow = parseInt(len_key1) - 1;
		var lastval = $(':input[name="'+id+'_key1['+lastrow+']"]').val();
		//if(lastval == '') return;
		var x_from = (lastval == '') ? '' : (parseInt(lastval) + 1) + wcex_multiprice_data.lbl_dash;

		var option2 = $('#wcex_multiprice_option2_'+id).val();
		if(option2 == '#NONE#') {
			$('<tr></tr>').html('<th class="mltp_th"><span id="'+id+'_addx_'+len_key1+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+len_key1+']" class="wcex_multiprice_key1" value=""></th><td><input type="text" name="'+id+'_val['+len_key1+'][0]" class="wcex_multiprice_val" value=""></td>').appendTo('#wcex_multiprice_table_'+id+' tbody');

		} else {
			var len_key2 = $('[name*="'+id+'_val[0]"]').length;
			var td = "";
			for(var i = 0; i < len_key2; i++) {
				td += '<td><input type="text" name="'+id+'_val['+len_key1+']['+i+']" class="wcex_multiprice_val" value=""></td>';
			}
			$('<tr></tr>').html('<th class="mltp_th"><span id="'+id+'_addx_'+len_key1+'">'+x_from+'</span><input type="text" name="'+id+'_key1['+len_key1+']" class="wcex_multiprice_key1" value=""></th>'+td).appendTo('#wcex_multiprice_table_'+id+' tbody');
		}
		$(':input[name="'+id+'_key1['+len_key1+']"]').bind("changeKey1", 
			function(event, name) {
				var key = $(':input[name="'+name+'"]').val();
				if(key == '' || !checkIsNumber(key)) return;
				var namekey = name.split('_');
				var index = $('[name*="'+namekey[0]+'_key1"]').index(this) + 1;
				var idkey = '#'+namekey[0]+'_addx_'+index;
				if($(idkey).text() != undefined) {
					$(idkey).text((parseInt(key)+1)+wcex_multiprice_data.lbl_dash);
				}
			}
		);
		$(':input[name="'+id+'_key1['+len_key1+']"]').change(function() {
			$(this).trigger("changeKey1", [$(this).attr('name')]);
		});
	});

	// Delete row
	$('body').on('click', '[id*="wcex_multiprice_delrow"]', function() {
		var id = $(':input[name="wcex_multiprice_id[]"]:eq('+$tabs.tabs('option', tabs_selected())+')').val();
		var len_key1 = $('[name*="'+id+'_key1"]').length;
		if(len_key1 == 1) return;

		var tbl = document.getElementById('wcex_multiprice_table_'+id);
		tbl.deleteRow(tbl.rows.length - 1);
	});

	function tabs_selected() {
		return ( $.fn.jquery < "1.10" ) ? "selected" : "active";
	}
});

// Numeric check
function checkIsNumber(argValue) {
	if(argValue.match(/[^0-9|^\-]/g)) {
		// Pattern match 0 to 9, NG except "-".
		return false;
	}
	// To get the number of "-".
	var count = 0;
	for(var i = 0; i < argValue.length; i++) {
		if (argValue.charAt(i) == "-") {
			count++;
		}
	}
	if(2 <= count) {
		// NG if two or more "-" characters are entered.
		return false;
	}
	if(count == 1 && argValue.charAt(0) != "-") {
		// NG if "-" is entered and there is no leading "-".
		return false;
	}
	if(count == 1 && argValue.length == 1) {
		// NG for "-" only.
		return false;
	}
	return true;
}

function setVal(argValue) {
	return (!argValue || argValue === null || argValue === undefined) ? '' : argValue;
}
