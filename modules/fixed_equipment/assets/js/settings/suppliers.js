(function(){
	"use strict";
	var fnServerParams = {
	}
	initDataTable('.table-suppliers', admin_url + 'fixed_equipment/suppliers_table', false, false, fnServerParams, [0, 'desc']);
	appValidateForm($('#form_suppliers'), {
		'supplier_name': 'required'
	})
})(jQuery);

/**
 * add supplier
 */
function add(){
	"use strict";
	$('#add').modal('show');
	$('#add .add-title').removeClass('hide');
	$('#add .edit-title').addClass('hide');
	$('#add input[name="id"]').val('');
	$('#add input[name="supplier_name"]').val('');
	$('#add input[name="address"]').val('');
	$('#add input[name="city"]').val('');
	$('#add input[name="state"]').val('');
	$('#add select[name="country"]').val('').change();
	$('#add input[name="zip"]').val('');
	$('#add input[name="contact_name"]').val('');
	$('#add input[name="phone"]').val('');
	$('#add input[name="fax"]').val('');
	$('#add input[name="email"]').val('');
	$('#add input[name="url"]').val('');
	$('#add textarea[name="note"]').val('');
	$('#ic_pv_file').remove();
}

/**
 * edit supplier
 */
function edit(id){
	"use strict";
	$('#add').modal('show');
	$('#add .add-title').addClass('hide');
	$('#add .edit-title').removeClass('hide');
	$('#add input[name="id"]').val(id);
	var requestURL = admin_url+'fixed_equipment/get_modal_content_suppliers/' + (typeof(id) != 'undefined' ? id : '');
	requestGetJSON(requestURL).done(function(response) {
		$('#add .modal-body').html('');
		$('#add .modal-body').html(response.data);
		init_selectpicker();		
		appValidateForm($('#form_suppliers'), {
			'suppliers_name': 'required'
		})
	}).fail(function(data) {
		alert_float('danger', 'Error');
	});
}

/**
 * { preview ic btn }
 *
 * @param        invoker  The invoker
 */
 function preview_ic_btn(invoker){
 	"use strict";
 	var id = $(invoker).attr('id');
 	var rel_id = $(invoker).attr('rel_id');
 	var type = $(invoker).attr('type_item');
 	view_ic_file(id, rel_id,type);
 }

/**
 * { view ic file }
 *
 * @param        id      The identifier
 * @param        rel_id  The relative identifier
 * @param        type    The type
 */
 function view_ic_file(id, rel_id,type) {
 	"use strict";
 	$('#ic_file_data').empty();
 	$("#ic_file_data").load(admin_url + 'fixed_equipment/file_item/' + id + '/' + rel_id + '/' + type, function(response, status, xhr) {
 		if (status == "error") {
 			alert_float('danger', xhr.statusText);
 		}
 	});
 }

/**
 * Closes a modal preview.
 */
 function close_modal_preview(){
 	"use strict";
 	$('._project_file').modal('hide');
 }

/**
 * { delete ic attachment }
 *
 * @param        id       The identifier
 * @param        invoker  The invoker
 */
 function delete_ic_attachment(id,invoker) {
 	"use strict";
 	var type = $(invoker).attr('type_item');
 	console.log(type);
 	if (confirm_delete()) {
 		requestGet('fixed_equipment/delete_file_item/' + id+'/'+type).done(function(success) {
 			if (success == 1) {
 				$("#ic_pv_file").find('[data-attachment-id="' + id + '"]').remove();
 			}
 		}).fail(function(error) {
 			alert_float('danger', error.responseText);
 		});
 	}
 }