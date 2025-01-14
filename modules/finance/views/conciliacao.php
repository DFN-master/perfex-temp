<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <h4 class="no-margin col-md-6"><?php echo _l('Extrato'); ?> <a href="<?php echo admin_url('finance/despesas/import'); ?>" class="btn btn-default btn-icon">+ Importar Extrato</a></h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table dt-table dt-table-exists"  data-order-col="0" data-order-type="desc"    >
                                    <thead>
                                        <tr>
                                            <th><?php echo _l('Data'); ?></th>
                                            <th><?php echo _l('Descrição'); ?></th>
                                            <th><?php echo _l('Valor'); ?></th>
                                            <th><?php echo _l('Saldo'); ?></th>
                                            <th><?php echo _l('Conciliação'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($extratos as $key => $extrato) { ?>
                                            <tr>
                                                <td><?php echo $extrato->data; ?></td>
                                                <td><?php echo $extrato->descricao; ?></td>
                                                <td>
                                                    <?php echo _l('R$').number_format($extrato->valor,2,",","."); ?>
                                                </td>
                                                <td>
                                                    <?php echo _l('R$').number_format($extrato->saldo,2,",","."); ?>
                                                </td>
                                                <td>
                                                    <select name="<?php echo $extrato->id; ?>" id="<?php echo $extrato->id; ?>" class="form-control">
                                                        <option value="">Selecione uma opção</option>
                                                        <?php 
                                                            if($extrato->tipo == "D"){
                                                                foreach ($expenses as $key => $expense) {
                                                                    $selected = ($extrato->conciliacao_id == $expense['id']) ? 'selected' : '';
                                                                    echo '<option value="'.$expense['id'].'" '.$selected.'>'.$expense['expense_name'].' | '.$expense['date'].'</option>';
                                                                }
                                                            }else if($extrato->tipo == "C"){
                                                                foreach ($invoices as $key => $invoice) {
                                                                    $selected = ($extrato->conciliacao_id == $invoice['id']) ? 'selected' : '';
                                                                    echo '<option value="'.$invoice['id'].'" '.$selected.'>'.$invoice['prefix'].$invoice['number'].' | '.$invoice['date'].'</option>';
                                                                }
                                                            } 
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    $(function() {
        // Registra os valores selecionados anteriormente
        var selectedValues = {};

        // Função para atualizar os selects, desabilitando ou habilitando options
        function updateSelectOptions(selectedId, selectedValue) {
            $('select').each(function() {
                var selectId = $(this).attr('id');

                // Se o valor anterior não é vazio e diferente do valor atual, habilita o valor anterior
                if (selectedValues[selectedId] && selectedValues[selectedId] !== selectedValue) {
                    $(`select option[value="${selectedValues[selectedId]}"]`).prop('disabled', false);
                }

                // Desabilita a opção selecionada nos outros selects
                if (selectId !== selectedId && selectedValue) {
                    $(`select option[value="${selectedValue}"]`).prop('disabled', true);
                }

                // Atualiza o registro do valor selecionado
                selectedValues[selectedId] = selectedValue;
            });
        }

        // Inicializa todos os options como habilitados
        $('select option').prop('disabled', false);

        // Função para inicializar os estados dos selects ao carregar a página
        function initializeSelects() {
            $('select').each(function() {
                var id = $(this).attr('id');
                var value = $(this).val();
                if (value) {
                    updateSelectOptions(id, value);
                }
            });
        }

        // Evento de mudança para os selects
        $('select').change(function() {
            var id = $(this).attr('id');
            var value = $(this).val();

            // Atualiza os selects
            updateSelectOptions(id, value);

            // Requisição para conciliar (se necessário)
            if (value) {
                $.post('<?php echo admin_url('finance/despesas/conciliar'); ?>', {
                    id: id,
                    value: value
                }, function(data) {
                    if (data == 'ok') {
                        alert_float('success', 'Conciliado com sucesso!');
                    } else {
                        alert_float('danger', 'Erro ao conciliar!');
                    }
                });
            }
        });
        // Chama a função para inicializar os selects ao carregar a página
        initializeSelects();
    });
</script>

