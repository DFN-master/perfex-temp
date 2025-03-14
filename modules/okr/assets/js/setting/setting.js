(function(){
  "use strict";
  var fnServerParams = {
  }
  initDataTable('.table-circulation', admin_url + 'okr/table_circulation', false, false, fnServerParams, [0, 'desc']);
  initDataTable('.table-question', admin_url + 'okr/table_question', false, false, fnServerParams, [0, 'desc']);
  initDataTable('.table-evaluation-criteria', admin_url + 'okr/table_evaluation_criteria', false, false, fnServerParams, [0, 'desc']);
  initDataTable('.table-unit', admin_url + 'okr/table_unit', false, false, fnServerParams, [0, 'desc']);
  initDataTable('.table-category', admin_url + 'okr/table_category', false, false, fnServerParams, [0, 'desc']);

  appValidateForm($('#form_setting_circulation'), {
           'name_circulation': 'required',
           'from_date': 'required',
           'to_date': 'required',
           'type': 'required'
  });

  appValidateForm($('#form_setting_question'), {
           'question': 'required',
  });

  appValidateForm($('#form_evaluation_criteria'), {
           'group_criteria': 'required',
           'name': 'required',
           'scores': 'required',
  });
  appValidateForm($('#form_setting_category'), {
           'category': 'required',
  });
  appValidateForm($('#form_setting_unit'), {
           'unit': 'required',
  });

   $('body').on('change', '#type', function() {
     $('#yearly').addClass('hide');
     $('#quarterly').addClass('hide');
     $('#monthly').addClass('hide');
     $('#ctime').addClass('hide');
     $('input[name="name_circulation"]').val('');
     if($('#type').val() == 'okr_yearly'){
          $('#yearly').removeClass('hide');
          $('input[name="name_circulation"]').val($('#year option:selected').text());
     } else if($('#type').val() == 'okr_quarterly'){
          $('#yearly').removeClass('hide');
          $('#quarterly').removeClass('hide');
          $('input[name="name_circulation"]').val($('#year option:selected').text()+'/'+$('#quarter option:selected').text());
     } else if($('#type').val() == 'okr_monthly'){
          $('#yearly').removeClass('hide');
          $('#monthly').removeClass('hide');
          $('input[name="name_circulation"]').val($('#year option:selected').text()+'/'+$('#month option:selected').text());
     } else {
          $('#ctime').removeClass('hide');
     }
     
   });

   $('body').on('change', '#year', function() {
     if($('#type').val() == 'okr_yearly'){
          $('input[name="name_circulation"]').val($('#year option:selected').text());
     } else if($('#type').val() == 'okr_quarterly'){
          $('input[name="name_circulation"]').val($('#year option:selected').text()+'/'+$('#quarter option:selected').text());
     } else if($('#type').val() == 'okr_monthly'){
          $('input[name="name_circulation"]').val($('#year option:selected').text()+'/'+$('#month option:selected').text());
     }
   });

   $('body').on('change', '#quarter', function() {
     $('input[name="name_circulation"]').val($('#year option:selected').text()+'/'+$('#quarter option:selected').text());
   });

   $('body').on('change', '#month', function() {
     $('input[name="name_circulation"]').val($('#year option:selected').text()+'/'+$('#month option:selected').text());
   });
})(jQuery);


function add_setting_circulation(){
  	"use strict";
	$('.update-title').addClass('hide');
  	$('.add-title').removeClass('hide');
     $('#ctime').removeClass('hide');
     $('#type').change();
     $('input[name="id"]').val('');
 	$('input[name="name_circulation"]').val('');
 	$('input[name="from_date"]').val('');
 	$('input[name="to_date"]').val('');
     $('#type').val('okr_custom').selectpicker('refresh');
     $('#year').val(new Date().getFullYear()).selectpicker('refresh');
     $('#quarter').val(1).selectpicker('refresh');
     $('#month').val(1).selectpicker('refresh');
     $('#yearly').addClass('hide');
     $('#quarterly').addClass('hide');
     $('#monthly').addClass('hide');
  	$('#setting_circulation').modal();
}

function update_setting_circulation(el){
     "use strict";
     $('#yearly').addClass('hide');
     $('#quarterly').addClass('hide');
     $('#monthly').addClass('hide');
     $('#ctime').addClass('hide');
     $('input[name="name_circulation"]').val('');
     $('input[name="id"]').val($(el).data('id'));
     $('input[name="name_circulation"]').val($(el).data('name'));
     $('input[name="from_date"]').val($(el).data('fromdate'));
     $('input[name="to_date"]').val($(el).data('todate'));
     $('.update-title').removeClass('hide');
     $('.add-title').addClass('hide');
     $('#type').val($(el).data('type')).selectpicker('refresh');
     $('#year').val($(el).data('year')).selectpicker('refresh');
     $('#quarter').val($(el).data('quarter')).selectpicker('refresh');
     $('#month').val($(el).data('month')).selectpicker('refresh');
     if($('#type').val() == 'okr_yearly'){
          $('#yearly').removeClass('hide');
     } else if($('#type').val() == 'okr_quarterly'){
          $('#yearly').removeClass('hide');
          $('#quarterly').removeClass('hide');
     } else if($('#type').val() == 'okr_monthly'){
          $('#yearly').removeClass('hide');
          $('#monthly').removeClass('hide');
     } else {
          $('#ctime').removeClass('hide');
     }
     $('#setting_circulation').modal();
}

function add_setting_question(){
  	"use strict";
	$('.update-title').addClass('hide');
  	$('.add-title').removeClass('hide');
    $('input[name="id"]').val('');
 	$('input[name="question"]').val('');
  	$('#setting_question').modal();
}

function update_setting_question(el){
     "use strict";
     $('input[name="id"]').val($(el).data('id'));
     $('textarea[name="question"]').val($(el).data('question'));
     $('.update-title').removeClass('hide');
     $('.add-title').addClass('hide');
     $('#setting_question').modal();
}

function add_setting_unit(){
    "use strict";
    $('.update-title').addClass('hide');
    $('.add-title').removeClass('hide');
    $('input[name="id"]').val('');
    $('input[name="unit"]').val('');
    $('#setting_unit').modal();
}

function update_setting_unit(el){
     "use strict";
     $('input[name="id"]').val($(el).data('id'));
     $('input[name="unit"]').val($(el).data('unit'));
     $('.update-title').removeClass('hide');
     $('.add-title').addClass('hide');
     $('#setting_unit').modal();
}

function add_setting_evaluation_criteria(){
  	"use strict";
	$('.update-title').addClass('hide');
  	$('.add-title').removeClass('hide');
    $('input[name="id"]').val('');
  	$('#evaluation_criteria').modal();
}

function update_setting_evaluation_criteria(el){
     "use strict";
     $('input[name="id"]').val($(el).data('id'));
     $('select[name="group_criteria"]').val($(el).data('criteria')).change();
     $('input[name="name"]').val($(el).data('name'));
     $('input[name="scores"]').val($(el).data('scores'));
     $('.update-title').removeClass('hide');
     $('.add-title').addClass('hide');
     $('#evaluation_criteria').modal();
}


function add_setting_category(){
    "use strict";
    $('.update-title').addClass('hide');
    $('.add-title').removeClass('hide');
    $('input[name="id"]').val('');
    $('input[name="category"]').val('');
    $('#setting_category').modal();
}

function update_setting_category(el){
     "use strict";
     $('input[name="id"]').val($(el).data('id'));
     $('input[name="category"]').val($(el).data('category'));
     $('.update-title').removeClass('hide');
     $('.add-title').addClass('hide');
     $('#setting_category').modal();
}