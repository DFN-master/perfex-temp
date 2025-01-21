<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  <div class="_buttons">
                    <h3>Faturas Abertas desse Ano</h3>
                  </div>
                  <div class="clearfix"></div>
                  <hr class="hr-panel-heading">
                  <table class="table dt-table" data-order-col="1" data-order-type="asc">
                     <thead>
                        <tr role="row">
                            <th style="display: none;">
                              ID
                            </th>
                            <th class="toggleable sorting" id="numero-invoice">
                              Fatura #
                            </th>
                            <th class="toggleable sorting" id="valor-servicos">
                              Quantia
                            </th>
                            <th class="toggleable sorting" id="valor-servicos">
                              Total Imposto
                           </th>
                           <th style="display:none;">
                              Data
                           </th>
                           <th class="toggleable sorting">
                              Cliente
                           </th>
                           <th>
                              Data de Vencimento
                           </th>
                           <th class="toggleable sorting">
                              Status
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($faturas as $key => $value) {
                            echo '<tr>';
                                echo '<td style="display: none;">';
                                    echo $key;
                                echo '</td>';
                                echo '<td>';
                                    echo $value['name'];
                                    // echo'<div class="row-options">
                                    //         <a target="_blank" href="'.$link.'/admin/clients/client/'.$value['id'].'">Ver</a>
                                    //     </div>';
                                echo '</td>';
                                echo '<td>';
                                    echo "R$ ".number_format($value['total'],2,",",".");
                                echo '</td>';
                                echo '<td>';
                                    echo $value['total_tax'];
                                echo '</td>';
                                echo '<td style="display:none;">';
                                    echo $value['date'];
                                echo '</td>';
                                echo '<td>';
                                    echo $value['company'];
                                echo '</td>';
                                echo '<td>';
                                    echo $value['duedate'];
                                echo '</td>';
                                echo '<td>';
                                    switch ($value['status']) {
                                        case 1:
                                            echo '<span class="label label-danger  s-status invoice-status-6">NÃO PAGO</span>';
                                            break;

                                        case 2:
                                            echo '<span class="label label-success  s-status invoice-status-6">PAGO</span>';
                                            break;

                                        case 3:
                                            echo '<span class="label label-warning  s-status invoice-status-6">PARCIALMENTE PAGO</span>';
                                            break;

                                        case 4:
                                            echo '<span class="label label-warning  s-status invoice-status-6">VENCIDO</span>';
                                            break;

                                        case 5:
                                            echo '<span class="label label-default  s-status invoice-status-6">CANCELADO</span>';
                                            break;

                                        case 6:
                                            echo '<span class="label label-default  s-status invoice-status-6">RASCUNHO</span>';
                                            break;

                                        default:
                                            # code...
                                            break;
                                    }
                                echo '</td>';
                            echo '</tr>';
                        }
                            ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
</body>
</html>