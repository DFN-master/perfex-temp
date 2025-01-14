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
                        <?php echo form_open_multipart(admin_url('finance/despesas/importFinal')); ?>
                            <div class="form-group">
                                <label><?php echo _l('Meio de Pagamento'); ?></label>
                                <select name="idpaymentmodes" id="idpaymentmodes" class="form-control">
                                    <option selected disabled><?php echo _l('Selecione o Meio de Pagamento'); ?></option>
                                    <?php foreach ($paymentModes as $paymentmode): if(!is_numeric($paymentmode['id'])) continue; //Garante que vamos ter apenas com ID numerico ?>
                                        <option value="<?php echo $paymentmode['id']; ?>"><?php echo $paymentmode['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php echo form_hidden('filename', $filename); ?>
                            <div class="row">
                                <?php foreach ($headers as $key => $header): ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo $header; ?></label>
                                            <select name="<?php echo $key; ?>" id="<?php echo $key; ?>" class="form-control">
                                                <option selected value=""><?php echo _l('Selecione um valor correspondente'); ?></option>
                                                <option value="data">Data</option>
                                                <option value="descricao">Descrição</option>
                                                <option value="valor">Valor</option>
                                                <option value="saldo">Saldo</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary"><?php echo _l('Salvar'); ?></button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    $(document).ready(function() {
        $('select').on('change', checkSelects);

        function checkSelects() {
            var selects = $('select');
            var selectedValues = [];

            selects.each(function() {
                var select = $(this);
                var selectedValue = select.val();

                if (selectedValues.includes(selectedValue)) {
                    alert_float('warning', 'Por favor, selecione um valor diferente para cada campo.');
                    select.val('');
                    return false;
                }

                if(selectedValue != '' && selectedValue != null){
                    selectedValues.push(selectedValue);
                }
            });

            return true;
        }
    });
</script>