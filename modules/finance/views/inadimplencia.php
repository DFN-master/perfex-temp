<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  <div class="_buttons">
                    <h3>Inadimplências</h3>
                  </div>
                  <div class="clearfix"></div>
                  <hr class="hr-panel-heading">
                  <table class="table dt-table" data-order-col="0" data-order-type="asc">
                     <thead>
                        <tr role="row">
                            <th class="toggleable sorting" id="valor-servicos">
                              Client ID
                           </th>
                            <th class="toggleable sorting" id="valor-servicos">
                              Cliente
                           </th>
                           <th class="toggleable sorting" id="numero-invoice">
                              Quantia
                           </th>
                           <th class="toggleable sorting" id="numero-invoice">
                              Faturas Abertas
                           </th>
                           <!-- <th class="toggleable sorting" id="data-emissao">
                              Status
                           </th> -->
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($get as $key => $value) {
                            echo '<tr>';
                                echo '<td>';
                                    echo $value['id'];
                                    echo'<div class="row-options">
                                            <a target="_blank" href="'.$link.'/admin/clients/client/'.$value['id'].'">Ver</a>
                                        </div>';
                                echo '</td>';
                                echo '<td>';
                                    echo $key;
                                echo '</td>';
                                echo '<td>';
                                    echo "R$ ".number_format($value['total'],2,",",".");
                                echo '</td>';
                                echo '<td>';
                                    echo $value['qntd'];
                                echo '</td>';
                                // echo '<td>';
                                //     switch ($key['status']) {
                                //         case 1:
                                //             echo '<span class="label label-danger  s-status invoice-status-6">NÃO PAGO</span>';
                                //             break;

                                //         case 2:
                                //             echo '<span class="label label-success  s-status invoice-status-6">PAGO</span>';
                                //             break;

                                //         case 3:
                                //             echo '<span class="label label-warning  s-status invoice-status-6">PARCIALMENTE PAGO</span>';
                                //             break;

                                //         case 4:
                                //             echo '<span class="label label-warning  s-status invoice-status-6">VENCIDO</span>';
                                //             break;

                                //         case 5:
                                //             echo '<span class="label label-default  s-status invoice-status-6">CANCELADO</span>';
                                //             break;

                                //         case 6:
                                //             echo '<span class="label label-default  s-status invoice-status-6">RASCUNHO</span>';
                                //             break;
                                        
                                //         default:
                                //             # code...
                                //             break;
                                //     }
                                // echo '</td>';
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