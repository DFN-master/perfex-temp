<?php defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php init_head(); setlocale(LC_MONETARY, 'pt_BR');?>

<style>
    th{text-align: center; padding: 2px;}
    .thheader{text-align: center; padding-left: 5px; padding-right: 5px; font-weight: 500; line-height: unset !important;}
    .yellow{ background: #f7e861;}
    .blue{ color: #646cf4;}
    .green{ color: #a0ed5d; font-weight: 500;}
    .beige{ background: #f4a971;}
    .red{ color: red; background-color: none; border-color: none;}
    .green > th{line-height: 30px;}
    .thead-blue{background: #4CC1F7;}
    .thead-blue th{color: white !important;}

</style>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <h4>Caixa da Empresa</h4>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="col-lg-12 col-xs-12 col-md-12 total-column">
                            <div class="row">
                                <div class="col-lg-9 col-xs-9 col-md-9">
                                    <div>
                                        <h3 class="text-muted _total <?php echo  ($invoicesFull - $expensesFull < 0)? sprintf('red') : sprintf('blue'); ?>">
                                            <?php echo "R$ ".number_format($invoicesFull - $expensesFull,2,",","."); ?>
                                        </h3>
                                        <span class="text-default">Caixa</span>
                                    </div>

                                    <div class="border-up-caixa"></div>
                                    <hr class="hr-caixa">
                                    <div class="border-down-caixa"></div>

                                    <div class="pull-left">
                                        <h3 class="text-muted _total">
                                            <?php  echo "R$ ".number_format($invoicesFull,2,",","."); ?>
                                        </h3>
                                        <span class="text-info">Entradas</span>
                                    </div>
                                    <div class="pull-right">
                                        <h3 class="text-muted _total">
                                            <?php echo "R$ ".number_format($expensesFull,2,",","."); ?>
                                        </h3>
                                        <span class="text-danger">Saídas</span>
                                    </div>
                                    <div>
                                        <i></i>
                                    </div>
                                </div>

                                <div class="left-border col-lg-3 col-xs-3 col-md-3">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($invoicesPendentes,2,",","."); ?>
                                    </h3>
                                    <span class="text-default">A receber/Pendentes</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="col-lg-12 col-xs-12 col-md-12">
                                <h4>Situação deste ano</h4>
                            </div>
                        <div class="col-lg-12 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">

                                    <h3 class="text-muted _total <?php echo  ($dre['13']['resultadoFinal']['0'] < 0)? sprintf('red') : sprintf('blue'); ?>">
                                        <?php echo "R$ ".number_format($dre['13']['resultadoFinal']['0'],2,",","."); ?>
                                    </h3>
                                    <span class="text-default">Entradas - Saídas</span>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="panel-body">
                    <div class="col-lg-12 col-xs-12 col-md-12">
                        <h4>Caixa da empresa</h4>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                    <?php echo "R$ ".number_format($invoicesPendentes,2,",","."); ?>
                                </h3>
                                <span class="text-default">A receber/Pendentes</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                    <?php  echo "R$ ".number_format($invoicesFull,2,",","."); ?>
                                </h3>
                                <span class="text-info">Entradas</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                    <?php echo "R$ ".number_format($expensesFull,2,",","."); ?>
                                </h3>
                                <span class="text-danger">Saídas</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h3 class="text-muted _total">
                                <?php echo "R$ ".number_format($invoicesFull - $expensesFull,2,",","."); ?>
                                </h3>
                                <span class="text-success">Em Caixa</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-body">
                        <!-- Propostas -->
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <h4>Propostas</h4>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($proposta['enviado'],2,",","."); ?>
                                    </h3>
                                    <span class="text-default">Propostas enviadas</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php
                                        echo "R$ ".number_format($proposta['revisado'],2,",","."); ?>
                                    </h3>
                                    <span class="text-info">Propostas revisadas</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($proposta['perdido'],2,",","."); ?>
                                    </h3>
                                    <span class="text-danger">Propostas perdidas</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($proposta['aceito'],2,",","."); ?>
                                    </h3>
                                    <span class="text-success">Propostas aceitas</span>
                                </div>
                            </div>
                        </div>

                    </div>
                <div class="panel-body">
                        <!-- Orçamentos -->
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <h4>Orçamentos</h4>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($orcamento['enviado'],2,",","."); ?>
                                    </h3>
                                    <span class="text-default">Orçamentos enviados</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($orcamento['expirado'],2,",","."); ?>
                                    </h3>
                                    <span class="text-info">Orçamentos expirados</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($orcamento['perdido'],2,",","."); ?>
                                    </h3>
                                    <span class="text-danger">Orçamentos perdidos</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($orcamento['aceito'],2,",","."); ?>
                                    </h3>
                                    <span class="text-success">Orçamentos aceitos</span>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="panel-body">
                        <!-- Orçamentos -->
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <h4>Faturas Recorrentes</h4>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($recorrentes['naoPago'],2,",","."); ?>
                                    </h3>
                                    <span class="text-default">Faturas Recorrentes Não Pagas</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($recorrentes['pago'],2,",","."); ?>
                                    </h3>
                                    <span class="text-info">Faturas Recorrentes Pagas</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($recorrentes['recdate'],2,",","."); ?>
                                    </h3>
                                    <span class="text-danger">Faturas Recorrentes até o Fim do Ano</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h3 class="text-muted _total">
                                        <?php echo "R$ ".number_format($recorrentes['new'],2,",","."); ?>
                                    </h3>
                                    <span class="text-success">Faturas não Recorrentes</span>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
</body>
</html>