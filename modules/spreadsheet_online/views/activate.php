<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
               <h4>Module Activation</h4>
               <hr class="hr-panel-heading">
               Please activate your module using your activation key.
               <br><br>
               <?php echo form_open('', ['autocomplete'=>'off', 'id'=>'activation-form']); ?>
                        <?php echo form_hidden('original_url', ''); ?> 
                        <?php echo form_hidden('module_name', ''); ?> 
                        <?php echo render_input('activation_key', 'Activation Key', '', 'text', ['required'=>true]); ?>
                        <?php echo render_input('username', 'Username', '', 'text', ['required'=>true]); ?>
                        <button id="submit" type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
                    <?php echo form_close(); ?>
               </div>
            </div>
         </div>
         <div class="col-md-6">
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
<script type="text/javascript">
   appValidateForm($('#activation-form'), {
        activation_key: 'required',
        username: 'required'
    }, manage_activation_form);

   function manage_activation_form(form) {
      var data = $(form).serialize();
      var url = form.action;
      $("#submit").prop('disabled', true).prepend('<i class="fa fa-spinner fa-pulse"></i> ');
      $.post(url, data).done(function(response) {
         // Removido o código de verificação de licença
         alert_float("success","Activating....");
         window.location.href = '<?php echo admin_url('modules'); ?>';
         $("#submit").prop('disabled', false).find('i').remove();
      });
   }
</script>
