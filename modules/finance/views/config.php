<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                    <?php echo form_open_multipart('', ['id' => 'setup_form']); ?>
                        <div class="_buttons">
                            <h3>Configurações Financeiras</h3>
                        </div>
                        <hr class="hr-panel-heading">

                        <div class="form-group">
                            <label for="finance_cron_hour" class="control-label"><?php echo _l('Hora da Conciliação Automática'); ?></label>
                            <input type="number" name="finance_cron_hour" id="finance_cron_hour" class="form-control" value="<?php echo get_option('finance_cron_hour'); ?>">
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <input style="cursor: pointer;" type="checkbox" id="finance_auto_conciliacao" name="finance_auto_conciliacao" value="1" <?php echo get_option('finance_auto_conciliacao') == 1 ? 'checked' : ''; ?>>
                                <label style="cursor: default;"><?php echo _l('Conciliação Automática'); ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <input style="cursor: pointer;" type="checkbox" id="finance_create_expense_by_extrato" name="finance_create_expense_by_extrato" value="1" <?php echo get_option('finance_create_expense_by_extrato') == 1 ? 'checked' : ''; ?>>
                                <label style="cursor: default;"><?php echo _l('Criar Despesa pelo Extrato'); ?></label>
                            </div>
                        </div>

                        <div class="btn-bottom-toolbar text-right">
                            <button type="submit" class="btn btn-info">Salvar Configurações</button>
                        </div> 
                    <?php echo form_close(); ?>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
</body>
</html>