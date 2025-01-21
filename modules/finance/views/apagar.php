<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  <div class="_buttons">
                    <h3>Despesas Abertas desse Ano</h3>
                  </div>
                  <div class="clearfix"></div>
                  <hr class="hr-panel-heading">
                  <table class="table dt-table" data-order-col="0" data-order-type="asc">
                     <thead>
                        <tr role="row">
                            <th style="display:none;" class="toggleable sorting" id="valor-servicos">
                              ID
                            </th>
                            <th class="toggleable sorting" id="valor-servicos">
                              Categoria
                            </th>
                            <th class="toggleable sorting" id="valor-servicos">
                              Quantia
                           </th>
                           <th class="toggleable sorting" id="numero-invoice">
                              Data
                           </th>
                           <th class="toggleable sorting" id="numero-invoice">
                              Cliente
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($despesas as $key => $value) {
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
                                    echo "R$ ".number_format($value['amount'],2,",",".");
                                echo '</td>';
                                echo '<td>';
                                    echo $value['date'];
                                echo '</td>';
                                echo '<td>';
                                    echo $value['company'];
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