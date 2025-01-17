<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('Importar Extrato'); ?></h4>
                        <hr>
                        <?php echo form_open_multipart(admin_url('finance/despesas/importar')); ?>
                            <div class="form-group">
                                <label><?php echo _l('Arquivo CSV de Importação'); ?></label>
                                <?php echo form_upload('import_file', '', ['id' => 'import_file_input', 'class' => 'form-control', 'required' => 'required', 'accept' => '.csv']); ?>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary"><?php echo _l('Salvar'); ?></button>
                            </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>