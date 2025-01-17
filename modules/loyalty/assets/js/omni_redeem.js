(function(){
	"use strict";
	$(window).on('load', function() {
		customer_loyaty();
	});
	$(document).on("change",'.tab-pane.active select[name="client_id"]',function() {
		customer_loyaty();
	});
	$(document).on("click",'#general_tab',function() {
		customer_loyaty();
	});
})(jQuery);

/**
 * { auto redeem pos }
 *
 * @param        invoker  The invoker
 */
 function auto_redeem_pos(invoker) {
 	"use strict";
 	var tab = $('.tab-pane.active');
 	var val_to = 0;
 	var weight = tab.find('input[name="weight"]').val();
 	var rate_percent = tab.find('input[name="rate_percent"]').val();
 	var total_cart = tab.find('input[name="total_cart"]').val();
 	var max = 0;
 	var data_max = tab.find('input[name="data_max"]').val();
 	var min_point = $('input[name="min_point"]').val();
 	if(parseFloat(invoker.value) > parseFloat(data_max)){	
 		$('#alert').modal('show').find('.alert_content').text('Point invalid!');
 	}else{
 		if(parseFloat(invoker.value) < parseFloat(min_point)){
			$(invoker).val(min_point).change();
			alert_float('warning','Point invalid!');
		}else{
	 		if( tab.find('select[name="client_id"]').val() != ''){
	 			max = (rate_percent*total_cart)/100;
	 			if(invoker.value != ''){
	 				val_to = invoker.value*weight;
	 				if(val_to <= max){
	 					tab.find('input[name="redeem_to"]').val(round_loy(val_to));
	 				}else{
	 					var redeem_from = Math.floor(max/weight);
	 					tab.find('input[name="redeem_from"]').val(redeem_from).change();
	 					tab.find('input[name="redeem_to"]').val(round_loy(max));
	 				}
	 			}
	 			else{
	 				tab.find('input[name="redeem_to"]').val('');
	 			}
	 		}else{
	 			$('#alert').modal('show').find('.alert_content').text('Please choose customer!');
	 		}
	 	}
 	}
 }

/**
 * { auto redeem }
 *
 * @param        invoker  The invoker
 * @param        weight   The weight
 */
 function auto_redeem(invoker, weight) {
 	"use strict";
 	var total = $('input[name="total"]').val();
 	var val_to = 0;
 	var max = 0;
 	var rate_percent = $('input[name="rate_percent"]').val();
 	if(invoker.value != ''){
 		val_to = invoker.value*weight;
 	}
 	max = (total*rate_percent)/100;

 	if(val_to > max){
 		var redeem_from = Math.floor(max/weight);
 		$('input[name="redeem_from"]').val(redeem_from).change();
 		$('input[name="redeem_to"]').val(round_loy(max));
 	}else{
 		$('input[name="redeem_to"]').val(round_loy(val_to));
 	}
 }

/**
 * Removes a commas.
 *
 * @param        str     The string
 * @return       { string }
 */
 function removeCommas(str) {
 	"use strict";
 	return(str.replace(/,/g,''));
 }

/**
 * { redeem order }
 */
 function redeem_order(){
 	"use strict";
 	var val_to = $('input[name="redeem_to"]').val();
 	var total = $('input[name="total"]').val();
 	var max = 0;
 	var rate_percent = $('input[name="rate_percent"]').val();
 	max = (total*rate_percent)/100;
 	if(val_to != ''){
 		if(val_to <= max){
 			if($('input[name="voucher"]').val() != ''){
 				$('input[name="discount_type"]').val(2);
 			}else{
 				$('input[name="discount_type"]').val(0);
 			}

 			$('input[name="other_discount"]').val(val_to);
 			total_cart();
 		}else{
 			if($('input[name="voucher"]').val() != ''){
 				$('input[name="discount_type"]').val(2);
 			}else{
 				$('input[name="discount_type"]').val(0);
 			}
 			$('input[name="other_discount"]').val(round_loy(max));
 			$('input[name="redeem_to"]').val(round_loy(max));
 			total_cart();
 		}
 	}else{
 		alert_float('warning','Enter the number of points you want to redeem!');
 	}
 }

/**
 * { redeem pos order }
 */
 function redeem_pos_order(){
 	"use strict";
 	var tab = $('.tab-pane.active');
 	var val_to = tab.find('input[name="redeem_to"]').val();
 	if(val_to != ''){
 		tab.find('input[name="discount_type"]').val(0);
 		tab.find('input[name="other_discount"]').val(round_loy(val_to));
 		total_cart();
 	}else{
 		tab.find('input[name="discount_type"]').val(0);
 		tab.find('input[name="other_discount"]').val(0);
 		total_cart();
 		alert_float('warning','Enter the number of points you want to redeem!');
 	}
 }

 function round_loy(val){
 	"use strict";
 	return Math.round(val * 100) / 100;
 }
 function customer_loyaty(){
 	"use strict";
 	var tab = $('.tab-pane.active');
 	var id = tab.find('select[name="client_id"]').val();
 	var total_cart = tab.find('input[name="total_cart"]').val();
 	var max = 0;
 	if(typeof id != 'undefined' && id != ''){
 		$.post(admin_url + 'loyalty/get_client_info_loy/' +id).done(function(response) {
 			response = JSON.parse(response);

 			if(response.type == 'partial'){
 				tab.find('span[id="point_span"]').html('');
 				tab.find('span[id="point_span"]').append(response.point);

 				tab.find('input[name="data_max"]').val(response.point);
 				tab.find('input[name="weight"]').val(response.weight);
 				tab.find('input[name="min_point"]').val(response.min);

 			}else{
 				max = (response.max_received*total_cart)/100;
 				tab.find('span[id="point_span"]').html('');
 				tab.find('span[id="point_span"]').append(response.point);

 				tab.find('input[name="redeem_from"]').val(response.val);

 				if(response.val_to <= max){
 					tab.find('input[name="redeem_to"]').val(response.val_to);
 				}else{
 					tab.find('input[name="redeem_to"]').val(max);
 				}

 				if( tab.find('input[name="redeem_from"]').val() != '' &&  tab.find('input[name="redeem_to"]').val() != ''){
 					tab.find('input[name="redeem_from"]').attr(response.disabled,true);
 					tab.find('input[name="redeem_to"]').attr(response.disabled,true);
 				}

 				tab.find('input[name="weight"]').val(response.weight);
 			}

 			tab.find('input[name="rate_percent"]').val(response.max_received);
 			if(response.hide != ''){
 				tab.find('#div_pos_redeem').addClass(response.hide);
 			}else{
 				tab.find('#div_pos_redeem').removeClass('hide');
 			}
 		});
 	}else{
 		tab.find('span[id="point_span"]').html('');
 		tab.find('span[id="point_span"]').append(0);
 		tab.find('input[name="data_max"]').val(0);
 		tab.find('input[name="weight"]').val(0);
 		tab.find('#div_pos_redeem').addClass('hide');
 	}
 }

