<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-6">
            <div class="panel_s">
               <div class="panel-body">
			   <h4>Lead Manager Module Activation</h4>
			   <hr class="hr-panel-heading">
			   <!-- Activation process has been simplified. No purchase key required. -->
			   Activation not required for development purposes.
               <!-- Commented out the form for inputting the purchase key. 
			   <?php // echo form_open(admin_url('lead_manager/code_envato/module_activation'), ['autocomplete'=>'off', 'id'=>'activation-form']); ?>
                        <?php // echo form_hidden('default_url', base_url($this->uri->uri_string())); ?> 
                  		<?php // echo form_hidden('module_name', $module_name); ?> 
								<?php // echo render_input('purchase_key', 'purchase_key', '', 'text', ['required'=>true]); ?>
                  		<button id="submit" type="submit" class="btn btn-info pull-right"><?php // echo _l('submit'); ?></button>
                  	<?php // echo form_close(); ?>
               -->
               </div>
            </div>
         </div>
         <div class="col-md-6">
		 </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
<!-- Commented out the JavaScript validation and submission process for the activation form. 
<script type="text/javascript">
   appValidateForm($('#activation-form'), {
        purchase_key: 'required'
    }, manage_activation_form);

   function manage_activation_form(form) {
      var data = $(form).serialize();
      var url = form.action;
      console.log(url);
      $("#submit").prop('disabled', true).prepend('<i class="fa fa-spinner fa-pulse"></i> ');
      $.post(url, data).done(function(response) {
         var response = $.parseJSON(response);
         if(!response.status){
            alert_float("danger",response.message);
         }
         if(response.status){
            alert_float("success","Activating....");
            window.location.href = response.default_url;
         }
         $("#submit").prop('disabled', false).find('i').remove();
      });
   }
</script>
-->
