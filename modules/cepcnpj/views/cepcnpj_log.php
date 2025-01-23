<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <p style="padding: 0 15px;">
                                Ultima atualização em <?= date('d/m/Y H:i:s', strtotime(get_option('diletec_cron_cep_data'))); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <h4 class="no-margin col-md-6"><?php echo _l('Lista de Modificações'); ?></h4>
                        </div>
                        <hr>
                        <?php echo form_open(admin_url('cepcnpj/atualizacoes/delete')); ?>
                        <?php
                            $btn = '';
                            $th = '';
                            $td = 'display: none;';
                            if (has_permission('cepcnpj', '', 'delete') OR is_admin()) {
                                $btn = '<button type="submit" class="btn btn-info">Deletar Registro</button>';
                                $th = '<th class="checkbox">
                                    <div class="checkbox">
                                        <input style="cursor: pointer;" type="checkbox" id="gerar-select-all" value="1">
                                        <label></label>
                                    </div>
                                </th>';
                                $td = '';
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table dt-table dt-table-exists"  data-order-col="1" data-order-type="desc" id="myTable">
                                    <thead>
                                        <tr>
                                            <?php echo $th; ?>
                                            <th><?php echo _l('ID'); ?></th>
                                            <th><?php echo _l('Data'); ?></th>
                                            <th><?php echo _l('Cliente'); ?></th>
                                            <th><?php echo _l('Antes'); ?></th>
                                            <th><?php echo _l('Depois'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($log as $key => $log) { ?>
                                            <tr>
                                                <!-- check para deletar  -->
                                                <td style="<?php echo $td; ?>">
                                                    <div class="checkbox checkbox-danger">
                                                        <input type="checkbox" name="ids[]" class="check" value="<?php echo $log->idcepcnpj_log; ?>">
                                                        <label for="checkbox1"></label>
                                                    </div>
                                                </td>
                                                <td id="idcepcnpj_log"><?php echo $log->idcepcnpj_log; ?></td>
                                                <td><?php
                                                    echo date('d/m/Y H:i:s', strtotime($log->data));
                                                ?></td>
                                                <td><?php echo '<a href="/admin/clients/client/'.$log->idcliente.'" target="_blank">'.$log->company.'</a>'; ?></td>
                                                <td><?php
                                                    foreach (json_decode($log->antes) as $key => $antes) {
                                                        echo '<strong>'._l($key) . ':</strong> ' . $antes . '<br>';
                                                    }
                                                ?></td>
                                                <td><?php
                                                    foreach (json_decode($log->depois) as $key => $depois) {
                                                        echo '<strong>'._l($key) . ':</strong> ' . $depois . '<br>';
                                                    }
                                                 ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-right">
                                    <br><br>
                                    <?php
                                        echo $btn;
                                    ?>
                                </div>
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
    // Pegar os ids da tabela idcepcnpj_log
    jQuery(document).ready(function() {
        // Pegue todos os elementos <td> que possuem o id "idcepcnpj_log"
        var ids = [];
        var rows = document.querySelectorAll('#myTable td[id="idcepcnpj_log"]');

        rows.forEach(function(row) {
            console.log(row);
            ids.push(row.textContent); // Adiciona o texto do <td> (que é o ID) no array
        });

        //Ajax com os ids
        jQuery.ajax({
            url: '<?= admin_url('cepcnpj/atualizacoes/view'); ?>',
            type: 'POST',
            data: {
                id: ids
            },
            success: function(response) {
                console.log(response);
            }
        });
    });

   $(document).ready(function() {
      $('#popup').hide();

      $('#gerar-select-all').change(function() {
         var isChecked = $(this).is(':checked');
         $('input[type="checkbox"]:not(:disabled)').prop('checked', isChecked);
      });

      $('#bg-popup').click(function() {
         $('#popup').hide();
         $('#bg-popup').hide();
      });

      $('.open-popup').click(function() {
         if ($('input[type="checkbox"]:checked').length === 0) {
            alert_float('danger', 'Selecione ao menos uma invoice para gerar a NF.');
         }else{
            $('#popup').show();
            $('#bg-popup').show();
         }
         return false;
      });
   });
</script>
