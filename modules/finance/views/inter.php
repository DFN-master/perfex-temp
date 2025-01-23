<?php defined('BASEPATH') or exit('No direct script access allowed');
$format = get_option('dateformat');
$format = explode("|", $format)[0];
?>
<?php init_head();?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                    <div class="col-lg-12 col-xs-12 col-md-12">
                        <h4>Saldo bancário</h4>
                    </div>
                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                    <?php  echo "R$ ".number_format($saldo->disponivel,2,",","."); ?>
                                </h3>
                                <span class="text-success">Disponível</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                    <?php echo "R$ ".number_format($saldo->bloqueadoCheque,2,",","."); ?>
                                </h3>
                                <span class="text-danger">Bloqueado/Cheque</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                    <?php echo "R$ ".number_format($saldo->bloqueadoJudicialmente,2,",","."); ?>
                                </h3>
                                <span class="text-danger">Bloqueado/Judicialmente</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                <?php echo "R$ ".number_format($saldo->bloqueadoAdministrativo,2,",","."); ?>
                                </h3>
                                <span class="text-danger">Bloqueado/Administrativo</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                <?php echo "R$ ".number_format($saldo->limite,2,",","."); ?>
                                </h3>
                                <span class="text-default">Limite</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                <?php echo "R$ ".number_format($saldo->limite + $saldo->bloqueadoAdministrativo + $saldo->bloqueadoJudicialmente + $saldo->bloqueadoCheque + $saldo->disponivel,2,",","."); ?>
                                </h3>
                                <span class="text-info">Total</span>
                            </div>
                        </div>
                    </div>

                </div>
               <div class="panel-body">
                  <div class="_buttons">
                    <h3>Extrato Bancário dos últimos 90 dias</h3>
                  </div>
                  <div class="clearfix"></div>
                  <hr class="hr-panel-heading">
                  <table class="table dt-table" data-order-col="0" data-order-type="desc">
                     <thead>
                        <tr role="row">
                            <th class="toggleable sorting" id="data">
                              Data
                            </th>
                            <th class="toggleable sorting" id="tipoT">
                              Tipo da Transação
                            </th>
                            <th class="toggleable sorting" id="tipoO">
                              Tipo da Operação
                            </th>
                            <th class="toggleable sorting" id="valor">
                              Valor
                            </th>
                            <th class="toggleable sorting" id="titulo">
                              Titulo
                            </th>
                            <th class="toggleable sorting" id="descricao">
                              Descrição
                            </th>
                            <th class="toggleable sorting" id="codigo">
                              Código
                            </th>
                            <th class="toggleable sorting" id="acoes">
                              Ações
                            </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($transacoes->transacoes as $value) {
                            $date_pri = DateTime::createFromFormat('Y-m-d', $value->dataEntrada);
                            $data_exp = $date_pri->format($format);
                            echo '<tr>';
                                echo "<td>$value->dataEntrada</td>";
                                echo "<td>$value->tipoTransacao</td>";
                                echo "<td>$value->tipoOperacao</td>";
                                echo "<td>R$".number_format($value->valor,2,",",".")."</td>";
                                echo "<td>$value->titulo</td>";
                                echo "<td>$value->descricao</td>";
                                echo "<td>$value->codigoHistorico</td>";
                                echo "<td>";echo ($value->tipoOperacao == "D")?'<a href="'.base_url('admin/expenses/expense?nome='.$value->descricao.'&valor='.$value->valor.'&data='.$data_exp).'" target="_blank">Salvar</a>':""; echo "</td>";
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