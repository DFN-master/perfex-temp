<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                    <?php echo form_open_multipart(admin_url('cepcnpj/configuracoes/save'), ['id' => 'setup_form']); ?>
                        <div class="_buttons">
                            <h3>Configurações</h3>
                        </div>
                        <hr class="hr-panel-heading">

                        <div class="form-group">
                            <label for="diletec_cron_cep_run" class="control-label"><?php echo _l('Qual CRON utilizar'); ?></label>
                            <!-- diletec_cron_cep_run -->
                            <select class="form-control" id="diletec_cron_cep_run" name="diletec_cron_cep_run">
                                <option value="0" <?php echo get_option('diletec_cron_cep_run') == 0 ? 'selected' : ''; ?>><?php echo _l('Separada'); ?></option>
                                <option value="1" <?php echo get_option('diletec_cron_cep_run') == 1 ? 'selected' : ''; ?>><?php echo _l('Padrão do Perfex CRM'); ?></option>
                            </select>
                            <p style="padding: 0 15px;">
                                <?php
                                    if(get_option('diletec_cron_cep_run') == 0){
                                        echo "<br><span class='label label-danger  s-status invoice-status-1'>Importante:</span>";
                                        echo "<br> Para configurar a CRON você deve usar CRON COMMAND: wget -q -O- ".site_url('cepcnpj/cron')." > /dev/null 2>&1";
                                    }
                                ?>
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="cepcnpj_font_company" class="control-label"><?php echo _l('Nomes devem ser'); ?></label>
                            <!-- cepcnpj_font_company -->
                            <select class="form-control" id="cepcnpj_font_company" name="cepcnpj_font_company">
                                <option value="0" <?php echo get_option('cepcnpj_font_company') == 0 ? 'selected' : ''; ?>><?php echo _l('Primeira letra maiuscula o resto minuscula'); ?></option>
                                <option value="1" <?php echo get_option('cepcnpj_font_company') == 1 ? 'selected' : ''; ?>><?php echo _l('Tudo em Maiuscula'); ?></option>
                                <option value="2" <?php echo get_option('cepcnpj_font_company') == 2 ? 'selected' : ''; ?>><?php echo _l('Tudo em Minuscula'); ?></option>
                            </select>
                        </div>

                        <!-- submit -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><?php echo _l('Salvar'); ?></button>
                        </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>