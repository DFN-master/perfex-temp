<?php defined('BASEPATH') or exit('No direct script access allowed');
//echo '<pre>';var_dump($dre);echo'</pre>';?>
<?php init_head(); setlocale(LC_MONETARY, 'pt_BR');
?>
<?php
    $title = "";
    $style = 'style="color: red; font-weight: bold;"';
?>
<style>
    th{border: dashed 1px #000; text-align: center; padding: 2px;}
    .thheader{text-align: center; padding-left: 5px; padding-right: 5px; font-weight: 500; line-height: unset !important;}
    .yellow{ background: #f7e861;}
    .blue{ background: #646cf4; color: #ffffff;}
    .green{ background: #a0ed5d; font-weight: 500;}
    .beige{ background: #f4a971;}
    .red{ color: red; background-color: none; border-color: none;}
    .green > th{line-height: 30px;}
</style>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                    <div class="col-md-10">
                       <?php

                            if(isset($_GET['y'])){
                                echo '<h4>Você está visualizando o DRE do ano de '.$_GET['y'].'</h4>';
                            }else{
                                echo '<h4>Você está visualizando o DRE do ano de '.date('Y').'</h4>';
                            }
                       ?>
                    </div>
                    <div class="col-md-2">
                        <form>
                            <div class="dt-buttons btn-group">

                                <select name="y" id="y" class="btn btn-default buttons-collection btn-default-dt-options">
                                  <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                                  <?php
                                    for ($i=date('Y'); $i > 2010; $i--) {
                                        if($i != date('Y')){
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    }
                                  ?>
                                </select>
                                <button class="btn btn-default buttons-collection btn-default-dt-options">Escolher</button>
                            </div>
                        </form>
                    </div>

               </div>

                <!--DRE Simples -->
               <div class="panel-body" style="overflow-y: hidden;">
                   <h4>Demonstrativo do Resultado do Exercício</h4>
                    <table style="padding-right: 18px; display: block; float: left;">
                        <thead>
                            <tr>
                                <th class="thheader yellow">ITENS</th>
                                <th class="thheader yellow">JANEIRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">FEVEREIRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">MARÇO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">ABRIL</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">MAIO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">JUNHO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">JULHO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">AGOSTO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">SETEMBRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">OUTUBRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">NOVEMBRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">DEZEMBRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">TOTAL</th>
                                <th class="yellow">%</th>
                            </tr>
                            <tr>
                                <th title="Ideal: 100%" class="thheader yellow">Receita Bruta de Vendas</th>
                                <th><?php echo $dre['1']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['1']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['2']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['2']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['3']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['3']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['4']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['4']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['5']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['5']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['6']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['6']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['7']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['7']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['8']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['8']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['9']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['9']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['10']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['10']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['11']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['11']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['12']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['12']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['13']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['13']['receitaBruta']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Ideal: 45%" class="thheader red yellow">Custo Mercadorias Vendidas</th>
                                <th><?php echo $dre['1']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['1']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['2']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['2']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['3']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['3']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['4']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['4']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['5']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['5']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['6']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['6']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['7']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['7']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['8']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['8']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['9']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['9']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['10']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['10']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['11']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['11']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['12']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['12']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['13']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['13']['custoMercadoria']['1'];?></th>
                            </tr>
                            <tr class="thheader blue">
                                <th>Lucro Bruto</th>
                                <th><?php echo $dre['1']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['1']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['2']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['2']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['3']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['3']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['4']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['4']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['5']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['5']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['6']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['6']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['7']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['7']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['8']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['8']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['9']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['9']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['10']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['10']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['11']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['11']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['12']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['12']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['13']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['13']['lucroBruto']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Ideal: 8%" class="thheader red yellow">Despesas Variáveis (Impostos)</th>
                                <th><?php echo $dre['1']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['1']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['2']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['2']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['3']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['3']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['4']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['4']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['5']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['5']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['6']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['6']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['7']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['7']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['8']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['8']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['9']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['9']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['10']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['10']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['11']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['11']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['12']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['12']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['13']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['13']['despesasVariaveis']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Ideal: 2,5% + 1,5% = 4%" class="thheader red yellow">Despesas Vendas + Comissões</th>
                                <th><?php echo $dre['1']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['1']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['2']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['2']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['3']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['3']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['4']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['4']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['5']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['5']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['6']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['6']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['7']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['7']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['8']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['8']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['9']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['9']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['10']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['10']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['11']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['11']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['12']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['12']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['13']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['13']['despesasVendas']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Despesas operacionais 3%, Adm 5%, Ocupação 8% Energia 1,5% = até 17,5%" class="thheader red yellow">Outras Despesas</th>
                                <th><?php echo $dre['1']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['1']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['2']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['2']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['3']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['3']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['4']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['4']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['5']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['5']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['6']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['6']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['7']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['7']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['8']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['8']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['9']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['9']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['10']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['10']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['11']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['11']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['12']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['12']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['13']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['13']['outrasDespesas']['1'];?></th>
                            </tr>
                            <tr class="thheader blue">
                                <th>Margem de Contribuição</th>
                                <th><?php echo $dre['1']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['1']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['2']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['2']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['3']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['3']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['4']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['4']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['5']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['5']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['6']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['6']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['7']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['7']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['8']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['8']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['9']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['9']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['10']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['10']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['11']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['11']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['12']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['12']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['13']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['13']['margemDeContribuicao']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Bom até 30%" class="thheader red yellow">Despesas Fixas</th>
                                <th><?php echo $dre['1']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['1']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['2']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['2']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['3']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['3']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['4']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['4']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['5']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['5']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['6']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['6']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['7']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['7']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['8']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['8']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['9']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['9']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['10']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['10']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['11']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['11']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['12']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['12']['despesasFixas']['1'];?></th>
                                <th><?php echo $dre['13']['despesasFixas']['0'];?></th>
                                <th><?php echo $dre['13']['despesasFixas']['1'];?></th>
                            </tr>
                            <tr class="thheader blue">
                                <th>Resultado Operacional</th>
                                <th><?php echo $dre['1']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['1']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['2']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['2']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['3']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['3']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['4']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['4']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['5']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['5']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['6']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['6']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['7']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['7']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['8']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['8']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['9']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['9']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['10']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['10']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['11']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['11']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['12']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['12']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['13']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['13']['resultadoOperacional']['1'];?></th>
                            </tr>
                            <tr>
                                <th class="thheader red yellow">Investimentos</th>
                                <th><?php echo $dre['1']['investimentos']['0'];?></th>
                                <th><?php echo $dre['1']['investimentos']['1'];?></th>
                                <th><?php echo $dre['2']['investimentos']['0'];?></th>
                                <th><?php echo $dre['2']['investimentos']['1'];?></th>
                                <th><?php echo $dre['3']['investimentos']['0'];?></th>
                                <th><?php echo $dre['3']['investimentos']['1'];?></th>
                                <th><?php echo $dre['4']['investimentos']['0'];?></th>
                                <th><?php echo $dre['4']['investimentos']['1'];?></th>
                                <th><?php echo $dre['5']['investimentos']['0'];?></th>
                                <th><?php echo $dre['5']['investimentos']['1'];?></th>
                                <th><?php echo $dre['6']['investimentos']['0'];?></th>
                                <th><?php echo $dre['6']['investimentos']['1'];?></th>
                                <th><?php echo $dre['7']['investimentos']['0'];?></th>
                                <th><?php echo $dre['7']['investimentos']['1'];?></th>
                                <th><?php echo $dre['8']['investimentos']['0'];?></th>
                                <th><?php echo $dre['8']['investimentos']['1'];?></th>
                                <th><?php echo $dre['9']['investimentos']['0'];?></th>
                                <th><?php echo $dre['9']['investimentos']['1'];?></th>
                                <th><?php echo $dre['10']['investimentos']['0'];?></th>
                                <th><?php echo $dre['10']['investimentos']['1'];?></th>
                                <th><?php echo $dre['11']['investimentos']['0'];?></th>
                                <th><?php echo $dre['11']['investimentos']['1'];?></th>
                                <th><?php echo $dre['12']['investimentos']['0'];?></th>
                                <th><?php echo $dre['12']['investimentos']['1'];?></th>
                                <th><?php echo $dre['13']['investimentos']['0'];?></th>
                                <th><?php echo $dre['13']['investimentos']['1'];?></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr class="thheader blue">
                                <th title="Lucro ou prejuízo">Resultado Final</th>
                                <th><?php echo $dre['1']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['1']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['2']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['2']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['3']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['3']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['4']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['4']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['5']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['5']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['6']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['6']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['7']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['7']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['8']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['8']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['9']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['9']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['10']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['10']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['11']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['11']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['12']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['12']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['13']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['13']['resultadoFinal']['1'];?></th>
                            </tr>
                            <tr class="thheader beige">
                                <th>Ponto de Equilibrio</th>
                                <th><?php echo $dre['1']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['1']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['2']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['2']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['3']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['3']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['4']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['4']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['5']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['5']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['6']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['6']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['7']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['7']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['8']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['8']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['9']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['9']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['10']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['10']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['11']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['11']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['12']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['12']['pontoDeEquilibrio']['1'];?></th>
                                <th><?php echo $dre['13']['pontoDeEquilibrio']['0'];?></th>
                                <th><?php echo $dre['13']['pontoDeEquilibrio']['1'];?></th>
                            </tr>
                            <tr class="green">
                                <th class="thheader">Margem de Lucratividade</th>
                                <th><?php //echo $dre['1']['margemDeLucratividade']['0'];?> JANEIRO</th>
                                <th><?php //echo $dre['1']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['2']['margemDeLucratividade']['0'];?> FEVEREIRO</th>
                                <th><?php //echo $dre['2']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['3']['margemDeLucratividade']['0'];?> MARÇO</th>
                                <th><?php //echo $dre['3']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['4']['margemDeLucratividade']['0'];?> ABRIL</th>
                                <th><?php //echo $dre['4']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['5']['margemDeLucratividade']['0'];?> MAIO</th>
                                <th><?php //echo $dre['5']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['6']['margemDeLucratividade']['0'];?> JUNHO</th>
                                <th><?php //echo $dre['6']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['7']['margemDeLucratividade']['0'];?> JULHO</th>
                                <th><?php //echo $dre['7']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['8']['margemDeLucratividade']['0'];?> AGOSTO</th>
                                <th><?php //echo $dre['8']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['9']['margemDeLucratividade']['0'];?> SETEMBRO</th>
                                <th><?php //echo $dre['9']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['10']['margemDeLucratividade']['0'];?> OUTUBRO</th>
                                <th><?php //echo $dre['10']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['11']['margemDeLucratividade']['0'];?> NOVEMBRO</th>
                                <th><?php //echo $dre['11']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['12']['margemDeLucratividade']['0'];?> DEZEMBRO</th>
                                <th><?php //echo $dre['12']['margemDeLucratividade']['1'];?></th>
                                <th><?php //echo $dre['13']['margemDeLucratividade']['0'];?> TOTAL</th>
                                <th><?php //echo $dre['13']['margemDeLucratividade']['1'];?></th>
                            </tr>
                            <tr>
                                <th class="thheader yellow">Bruta</th>
                                <th><?php echo $dre['1']['bruta']['0'];?></th>
                                <th><?php echo $dre['1']['bruta']['1'];?></th>
                                <th><?php echo $dre['2']['bruta']['0'];?></th>
                                <th><?php echo $dre['2']['bruta']['1'];?></th>
                                <th><?php echo $dre['3']['bruta']['0'];?></th>
                                <th><?php echo $dre['3']['bruta']['1'];?></th>
                                <th><?php echo $dre['4']['bruta']['0'];?></th>
                                <th><?php echo $dre['4']['bruta']['1'];?></th>
                                <th><?php echo $dre['5']['bruta']['0'];?></th>
                                <th><?php echo $dre['5']['bruta']['1'];?></th>
                                <th><?php echo $dre['6']['bruta']['0'];?></th>
                                <th><?php echo $dre['6']['bruta']['1'];?></th>
                                <th><?php echo $dre['7']['bruta']['0'];?></th>
                                <th><?php echo $dre['7']['bruta']['1'];?></th>
                                <th><?php echo $dre['8']['bruta']['0'];?></th>
                                <th><?php echo $dre['8']['bruta']['1'];?></th>
                                <th><?php echo $dre['9']['bruta']['0'];?></th>
                                <th><?php echo $dre['9']['bruta']['1'];?></th>
                                <th><?php echo $dre['10']['bruta']['0'];?></th>
                                <th><?php echo $dre['10']['bruta']['1'];?></th>
                                <th><?php echo $dre['11']['bruta']['0'];?></th>
                                <th><?php echo $dre['11']['bruta']['1'];?></th>
                                <th><?php echo $dre['12']['bruta']['0'];?></th>
                                <th><?php echo $dre['12']['bruta']['1'];?></th>
                                <th><?php echo $dre['13']['bruta']['0'];?></th>
                                <th><?php echo $dre['13']['bruta']['1'];?></th>
                            </tr>
                            <tr>
                                <th class="thheader yellow">Operacional</th>
                                <th><?php echo $dre['1']['operacional']['0'];?></th>
                                <th><?php echo $dre['1']['operacional']['1'];?></th>
                                <th><?php echo $dre['2']['operacional']['0'];?></th>
                                <th><?php echo $dre['2']['operacional']['1'];?></th>
                                <th><?php echo $dre['3']['operacional']['0'];?></th>
                                <th><?php echo $dre['3']['operacional']['1'];?></th>
                                <th><?php echo $dre['4']['operacional']['0'];?></th>
                                <th><?php echo $dre['4']['operacional']['1'];?></th>
                                <th><?php echo $dre['5']['operacional']['0'];?></th>
                                <th><?php echo $dre['5']['operacional']['1'];?></th>
                                <th><?php echo $dre['6']['operacional']['0'];?></th>
                                <th><?php echo $dre['6']['operacional']['1'];?></th>
                                <th><?php echo $dre['7']['operacional']['0'];?></th>
                                <th><?php echo $dre['7']['operacional']['1'];?></th>
                                <th><?php echo $dre['8']['operacional']['0'];?></th>
                                <th><?php echo $dre['8']['operacional']['1'];?></th>
                                <th><?php echo $dre['9']['operacional']['0'];?></th>
                                <th><?php echo $dre['9']['operacional']['1'];?></th>
                                <th><?php echo $dre['10']['operacional']['0'];?></th>
                                <th><?php echo $dre['10']['operacional']['1'];?></th>
                                <th><?php echo $dre['11']['operacional']['0'];?></th>
                                <th><?php echo $dre['11']['operacional']['1'];?></th>
                                <th><?php echo $dre['12']['operacional']['0'];?></th>
                                <th><?php echo $dre['12']['operacional']['1'];?></th>
                                <th><?php echo $dre['13']['operacional']['0'];?></th>
                                <th><?php echo $dre['13']['operacional']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Ideal o minimo de 20%" class="thheader yellow">Líquida</th>
                                <th><?php echo $dre['1']['liquida']['0'];?></th>
                                <th><?php echo $dre['1']['liquida']['1'];?></th>
                                <th><?php echo $dre['2']['liquida']['0'];?></th>
                                <th><?php echo $dre['2']['liquida']['1'];?></th>
                                <th><?php echo $dre['3']['liquida']['0'];?></th>
                                <th><?php echo $dre['3']['liquida']['1'];?></th>
                                <th><?php echo $dre['4']['liquida']['0'];?></th>
                                <th><?php echo $dre['4']['liquida']['1'];?></th>
                                <th><?php echo $dre['5']['liquida']['0'];?></th>
                                <th><?php echo $dre['5']['liquida']['1'];?></th>
                                <th><?php echo $dre['6']['liquida']['0'];?></th>
                                <th><?php echo $dre['6']['liquida']['1'];?></th>
                                <th><?php echo $dre['7']['liquida']['0'];?></th>
                                <th><?php echo $dre['7']['liquida']['1'];?></th>
                                <th><?php echo $dre['8']['liquida']['0'];?></th>
                                <th><?php echo $dre['8']['liquida']['1'];?></th>
                                <th><?php echo $dre['9']['liquida']['0'];?></th>
                                <th><?php echo $dre['9']['liquida']['1'];?></th>
                                <th><?php echo $dre['10']['liquida']['0'];?></th>
                                <th><?php echo $dre['10']['liquida']['1'];?></th>
                                <th><?php echo $dre['11']['liquida']['0'];?></th>
                                <th><?php echo $dre['11']['liquida']['1'];?></th>
                                <th><?php echo $dre['12']['liquida']['0'];?></th>
                                <th><?php echo $dre['12']['liquida']['1'];?></th>
                                <th><?php echo $dre['13']['liquida']['0'];?></th>
                                <th><?php echo $dre['13']['liquida']['1'];?></th>
                            </tr>
                        </thead>
                    </table>
               </div>

                <!--DRE Detalhada-->
                <div class="panel-body" style="overflow-y: hidden;">
                    <h4>Demonstrativo do Resultado do Exercício Analítico</h4>
                    <table style="padding-right: 18px; display: block; float: left;">
                        <thead>
                            <tr>
                                <th class="thheader yellow">ITENS</th>
                                <th class="thheader yellow">JANEIRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">FEVEREIRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">MARÇO</th>
                                <th class="yellow">%</th>

                                <th class="thheader yellow">1º Trimestre</th>
                                <th class="yellow">%</th>

                                <th class="thheader yellow">ABRIL</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">MAIO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">JUNHO</th>
                                <th class="yellow">%</th>

                                <th class="thheader yellow">2º Trimestre</th>
                                <th class="yellow">%</th>

                                <th class="thheader yellow">JULHO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">AGOSTO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">SETEMBRO</th>
                                <th class="yellow">%</th>

                                <th class="thheader yellow">3º Trimestre</th>
                                <th class="yellow">%</th>

                                <th class="thheader yellow">OUTUBRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">NOVEMBRO</th>
                                <th class="yellow">%</th>
                                <th class="thheader yellow">DEZEMBRO</th>
                                <th class="yellow">%</th>

                                <th class="thheader yellow">4º Trimestre</th>
                                <th class="yellow">%</th>

                                <th class="thheader yellow">TOTAL</th>
                                <th class="yellow">%</th>
                            </tr>
                            <tr>
                                <th title="100%" class="thheader yellow">Receita Bruta de Vendas</th>
                                <th><?php echo $dre['1']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['1']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['2']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['2']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['3']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['3']['receitaBruta']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>

                                <th><?php echo $dre['4']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['4']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['5']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['5']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['6']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['6']['receitaBruta']['1'];?></th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>

                                <th><?php echo $dre['7']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['7']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['8']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['8']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['9']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['9']['receitaBruta']['1'];?></th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>

                                <th><?php echo $dre['10']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['10']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['11']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['11']['receitaBruta']['1'];?></th>
                                <th><?php echo $dre['12']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['12']['receitaBruta']['1'];?></th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>

                                <th><?php echo $dre['13']['receitaBruta']['0'];?></th>
                                <th><?php echo $dre['13']['receitaBruta']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Ideal: 45%" class="thheader red yellow">Custo Mercadorias Vendidas</th>
                                <th><?php echo $dre['1']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['1']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['2']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['2']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['3']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['3']['custoMercadoria']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['custoMercadoria']['0'] +$dre['2']['custoMercadoria']['0'] + $dre['3']['custoMercadoria']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>

                                <th><?php echo $dre['4']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['4']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['5']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['5']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['6']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['6']['custoMercadoria']['1'];?></th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['custoMercadoria']['0'] +$dre['5']['custoMercadoria']['0'] + $dre['6']['custoMercadoria']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>


                                <th><?php echo $dre['7']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['7']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['8']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['8']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['9']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['9']['custoMercadoria']['1'];?></th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['custoMercadoria']['0'] +$dre['8']['custoMercadoria']['0'] + $dre['9']['custoMercadoria']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>


                                <th><?php echo $dre['10']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['10']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['11']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['11']['custoMercadoria']['1'];?></th>
                                <th><?php echo $dre['12']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['12']['custoMercadoria']['1'];?></th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['custoMercadoria']['0'] +$dre['11']['custoMercadoria']['0'] + $dre['12']['custoMercadoria']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>


                                <th><?php echo $dre['13']['custoMercadoria']['0'];?></th>
                                <th><?php echo $dre['13']['custoMercadoria']['1'];?></th>
                            </tr>
                            <tr class="thheader blue">
                                <th>Lucro Bruto</th>
                                <th><?php echo $dre['1']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['1']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['2']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['2']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['3']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['3']['lucroBruto']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['lucroBruto']['0'] +$dre['2']['lucroBruto']['0'] + $dre['3']['lucroBruto']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>

                                <th><?php echo $dre['4']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['4']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['5']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['5']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['6']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['6']['lucroBruto']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['lucroBruto']['0'] +$dre['5']['lucroBruto']['0'] + $dre['6']['lucroBruto']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>

                                <th><?php echo $dre['7']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['7']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['8']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['8']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['9']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['9']['lucroBruto']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['lucroBruto']['0'] +$dre['8']['lucroBruto']['0'] + $dre['9']['lucroBruto']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>

                                <th><?php echo $dre['10']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['10']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['11']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['11']['lucroBruto']['1'];?></th>
                                <th><?php echo $dre['12']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['12']['lucroBruto']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['lucroBruto']['0'] +$dre['11']['lucroBruto']['0'] + $dre['12']['lucroBruto']['0'];
                                ?></th>
                                <th class="thheader yellow">100%</th>

                                <th><?php echo $dre['13']['lucroBruto']['0'];?></th>
                                <th><?php echo $dre['13']['lucroBruto']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Até 8%" class="thheader red yellow">Despesas Variáveis (Impostos)</th>
                                <th><?php echo $dre['1']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['1']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['2']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['2']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['3']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['3']['despesasVariaveis']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['despesasVariaveis']['0'] +$dre['2']['despesasVariaveis']['0'] + $dre['3']['despesasVariaveis']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] !=0)?
                                    ($dre['1']['despesasVariaveis']['0'] + $dre['2']['despesasVariaveis']['0'] + $dre['3']['despesasVariaveis']['0'])
                                    /
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['4']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['4']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['5']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['5']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['6']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['6']['despesasVariaveis']['1'];?></th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['despesasVariaveis']['0'] +$dre['5']['despesasVariaveis']['0'] + $dre['6']['despesasVariaveis']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                    ($dre['4']['despesasVariaveis']['0'] + $dre['5']['despesasVariaveis']['0'] + $dre['6']['despesasVariaveis']['0'])
                                    /
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['7']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['7']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['8']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['8']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['9']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['9']['despesasVariaveis']['1'];?></th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['despesasVariaveis']['0'] +$dre['8']['despesasVariaveis']['0'] + $dre['9']['despesasVariaveis']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']!=0)?
                                    ($dre['7']['despesasVariaveis']['0'] + $dre['8']['despesasVariaveis']['0'] + $dre['9']['despesasVariaveis']['0'])
                                    /
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['10']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['10']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['11']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['11']['despesasVariaveis']['1'];?></th>
                                <th><?php echo $dre['12']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['12']['despesasVariaveis']['1'];?></th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['despesasVariaveis']['0'] +$dre['11']['despesasVariaveis']['0'] + $dre['12']['despesasVariaveis']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] != 0)?
                                    ($dre['10']['despesasVariaveis']['0'] + $dre['11']['despesasVariaveis']['0'] + $dre['12']['despesasVariaveis']['0'])
                                    /
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['13']['despesasVariaveis']['0'];?></th>
                                <th><?php echo $dre['13']['despesasVariaveis']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Ideal: 2,5% + 1,5 = 4%" class="thheader red yellow">Despesas Vendas (Comissões)</th>
                                <th><?php echo $dre['1']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['1']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['2']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['2']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['3']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['3']['despesasVendas']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['despesasVendas']['0'] +$dre['2']['despesasVendas']['0'] + $dre['3']['despesasVendas']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                    ($dre['1']['despesasVendas']['0'] + $dre['2']['despesasVendas']['0'] + $dre['3']['despesasVendas']['0'])
                                    /
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['4']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['4']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['5']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['5']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['6']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['6']['despesasVendas']['1'];?></th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['despesasVendas']['0'] +$dre['5']['despesasVendas']['0'] + $dre['6']['despesasVendas']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                    ($dre['4']['despesasVendas']['0'] + $dre['5']['despesasVendas']['0'] + $dre['6']['despesasVendas']['0'])
                                    /
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['7']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['7']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['8']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['8']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['9']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['9']['despesasVendas']['1'];?></th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['despesasVendas']['0'] +$dre['8']['despesasVendas']['0'] + $dre['9']['despesasVendas']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']!=0)?
                                    ($dre['7']['despesasVendas']['0'] + $dre['8']['despesasVendas']['0'] + $dre['9']['despesasVendas']['0'])
                                    /
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['10']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['10']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['11']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['11']['despesasVendas']['1'];?></th>
                                <th><?php echo $dre['12']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['12']['despesasVendas']['1'];?></th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['despesasVariaveis']['0'] +$dre['11']['despesasVariaveis']['0'] + $dre['12']['despesasVariaveis']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] != 0)?
                                    ($dre['10']['despesasVariaveis']['0'] + $dre['11']['despesasVariaveis']['0'] + $dre['12']['despesasVariaveis']['0'])
                                    /
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['13']['despesasVendas']['0'];?></th>
                                <th><?php echo $dre['13']['despesasVendas']['1'];?></th>
                            </tr>
                            <tr title="">
                                <th class="thheader red yellow">Outras Despesas</th>
                                <th><?php echo $dre['1']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['1']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['2']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['2']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['3']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['3']['outrasDespesas']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['outrasDespesas']['0'] +$dre['2']['outrasDespesas']['0'] + $dre['3']['outrasDespesas']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                    ($dre['1']['outrasDespesas']['0'] + $dre['2']['outrasDespesas']['0'] + $dre['3']['outrasDespesas']['0'])
                                    /
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['4']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['4']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['5']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['5']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['6']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['6']['outrasDespesas']['1'];?></th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['outrasDespesas']['0'] +$dre['5']['outrasDespesas']['0'] + $dre['6']['outrasDespesas']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                    ($dre['4']['outrasDespesas']['0'] + $dre['5']['outrasDespesas']['0'] + $dre['6']['outrasDespesas']['0'])
                                    /
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['7']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['7']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['8']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['8']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['9']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['9']['outrasDespesas']['1'];?></th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['outrasDespesas']['0'] +$dre['8']['outrasDespesas']['0'] + $dre['9']['outrasDespesas']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'] != 0)?
                                    ($dre['7']['outrasDespesas']['0'] + $dre['8']['outrasDespesas']['0'] + $dre['9']['outrasDespesas']['0'])
                                    /
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['10']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['10']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['11']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['11']['outrasDespesas']['1'];?></th>
                                <th><?php echo $dre['12']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['12']['outrasDespesas']['1'];?></th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['outrasDespesas']['0'] +$dre['11']['outrasDespesas']['0'] + $dre['12']['outrasDespesas']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] !=0)?
                                    ($dre['10']['outrasDespesas']['0'] + $dre['11']['outrasDespesas']['0'] + $dre['12']['outrasDespesas']['0'])
                                    /
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['13']['outrasDespesas']['0'];?></th>
                                <th><?php echo $dre['13']['outrasDespesas']['1'];?></th>
                            </tr>
                            <tr title="Até 6%" class="thheader blue">
                                <th>Margem de Contribuição</th>
                                <th><?php echo $dre['1']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['1']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['2']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['2']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['3']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['3']['margemDeContribuicao']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['margemDeContribuicao']['0'] +$dre['2']['margemDeContribuicao']['0'] + $dre['3']['margemDeContribuicao']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                    (
                                        ($dre['1']['despesasVendas']['0'] + $dre['2']['despesasVendas']['0'] + $dre['3']['despesasVendas']['0']) +
                                        ($dre['1']['despesasVariaveis']['0'] + $dre['2']['despesasVariaveis']['0'] + $dre['3']['despesasVariaveis']['0']) +
                                        ($dre['1']['outrasDespesas']['0'] + $dre['2']['outrasDespesas']['0'] + $dre['3']['outrasDespesas']['0'])
                                    )
                                    /
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['4']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['4']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['5']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['5']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['6']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['6']['margemDeContribuicao']['1'];?></th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['margemDeContribuicao']['0'] +$dre['5']['margemDeContribuicao']['0'] + $dre['6']['margemDeContribuicao']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                    (
                                        ($dre['4']['despesasVendas']['0'] + $dre['5']['despesasVendas']['0'] + $dre['6']['despesasVendas']['0']) +
                                        ($dre['4']['despesasVariaveis']['0'] + $dre['5']['despesasVariaveis']['0'] + $dre['6']['despesasVariaveis']['0']) +
                                        ($dre['4']['outrasDespesas']['0'] + $dre['5']['outrasDespesas']['0'] + $dre['6']['outrasDespesas']['0'])
                                    )
                                    /
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['7']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['7']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['8']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['8']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['9']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['9']['margemDeContribuicao']['1'];?></th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['margemDeContribuicao']['0'] +$dre['8']['margemDeContribuicao']['0'] + $dre['9']['margemDeContribuicao']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'] != 0)?
                                    (
                                        ($dre['7']['despesasVendas']['0'] + $dre['8']['despesasVendas']['0'] + $dre['9']['despesasVendas']['0']) +
                                        ($dre['7']['despesasVariaveis']['0'] + $dre['8']['despesasVariaveis']['0'] + $dre['9']['despesasVariaveis']['0']) +
                                        ($dre['7']['outrasDespesas']['0'] + $dre['8']['outrasDespesas']['0'] + $dre['9']['outrasDespesas']['0'])
                                    )
                                    /
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['10']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['10']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['11']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['11']['margemDeContribuicao']['1'];?></th>
                                <th><?php echo $dre['12']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['12']['margemDeContribuicao']['1'];?></th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['margemDeContribuicao']['0'] +$dre['11']['margemDeContribuicao']['0'] + $dre['12']['margemDeContribuicao']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] != 0)?
                                    (
                                        ($dre['10']['despesasVendas']['0'] + $dre['11']['despesasVendas']['0'] + $dre['12']['despesasVendas']['0']) +
                                        ($dre['10']['despesasVariaveis']['0'] + $dre['11']['despesasVariaveis']['0'] + $dre['12']['despesasVariaveis']['0']) +
                                        ($dre['10']['outrasDespesas']['0'] + $dre['11']['outrasDespesas']['0'] + $dre['12']['outrasDespesas']['0'])
                                    )
                                    /
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>
                                <th><?php echo $dre['13']['margemDeContribuicao']['0'];?></th>
                                <th><?php echo $dre['13']['margemDeContribuicao']['1'];?></th>
                            </tr>
                            <tr>
                                <th title="Até 20%" class="thheader red yellow">Despesas Fixas</th>
                                <th><?php echo $dre['1']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if($dre['1']['despesasFixas']['1'] > "25%"){
                                        $dre['1']['despesasFixas']['1'] = floatval(str_replace('%', '', $dre['1']['despesasFixas']['1']));
                                        echo "Você ficou ". ($dre['1']['despesasFixas']['1'] - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['1']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['1']['despesasFixas']['1'];?>
                                </th>
                                <th><?php echo $dre['2']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['2']['despesasFixas']['1']) > "25"){
                                        /**remover o % mas deoxar o . do $dre['2']['despesasFixas']['1'] */
                                        $dre['2']['despesasFixas']['1'] = floatval(str_replace('%', '', $dre['2']['despesasFixas']['1']));
                                        echo "Você ficou ". ($dre['2']['despesasFixas']['1'] - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['2']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['2']['despesasFixas']['1'];?>
                                </th>
                                <th><?php echo $dre['3']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['3']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['3']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['3']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['3']['despesasFixas']['1']; ?>
                                </th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['despesasFixas']['0'] +$dre['2']['despesasFixas']['0'] + $dre['3']['despesasFixas']['0'];
                                ?></th>

                                <?php
                                    $mx = 0;
                                    $mc = 0;
                                    echo '<th class="thheader yellow" title="';
                                    if(number_format( (
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                    ($dre['1']['despesasFixas']['0'] + $dre['2']['despesasFixas']['0'] + $dre['3']['despesasFixas']['0'])
                                    /
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                    * 100) - $mx
                                    , 2, '.', '') > 0){
                                        echo "Você ultrapassou o limite em ".number_format
                                        (
                                            ((
                                                (
                                                ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                                ($dre['1']['despesasFixas']['0'] + $dre['2']['despesasFixas']['0'] + $dre['3']['despesasFixas']['0'])
                                                /
                                                ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0)
                                                * 100
                                            ) - $mx) - 20
                                            , 2, '.', ''
                                        )."%";
                                    }else{
                                        echo "Você ficou ".number_format( (
                                            ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                            ($dre['1']['despesasFixas']['0'] + $dre['2']['despesasFixas']['0'] + $dre['3']['despesasFixas']['0'])
                                            /
                                            ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                            * 100) -$mc
                                            , 2, '.', '')."% abaixo do limite permitido";
                                                $style = "";
                                    }
                                    echo '" '.$style.'>';

                                    echo number_format(
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                    ($dre['1']['despesasFixas']['0'] + $dre['2']['despesasFixas']['0'] + $dre['3']['despesasFixas']['0'])
                                    /
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                    * 100, 2, '.', '')
                                ?>
                                %</th>

                                <th><?php echo $dre['4']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['4']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['4']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['4']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['4']['despesasFixas']['1'];?>
                                </th>
                                <th><?php echo $dre['5']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['5']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['5']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['5']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['5']['despesasFixas']['1'];?>
                                </th>
                                <th><?php echo $dre['6']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['6']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['6']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['6']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['6']['despesasFixas']['1'];?>
                                </th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['despesasFixas']['0'] +$dre['5']['despesasFixas']['0'] + $dre['6']['despesasFixas']['0'];
                                ?></th>

                                <?php
                                echo '<th class="thheader yellow" title="';
                                    if(
                                        number_format( (
                                        ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                        ($dre['4']['despesasFixas']['0'] + $dre['5']['despesasFixas']['0'] + $dre['6']['despesasFixas']['0'])
                                        /
                                        ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                        * 100) - $mx
                                        , 2, '.', '') > 0)
                                    {
                                        echo "Você ultrapassou o limite em ".number_format(
                                            ((
                                            ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                            ($dre['4']['despesasFixas']['0'] + $dre['5']['despesasFixas']['0'] + $dre['6']['despesasFixas']['0'])
                                            /
                                            ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                            * 100) - $mx) -20
                                        , 2, '.', '')."%";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo "Você ficou ".number_format( (
                                        ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                        ($dre['4']['despesasFixas']['0'] + $dre['5']['despesasFixas']['0'] + $dre['6']['despesasFixas']['0'])
                                        /
                                        ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                        * 100) -$mc
                                        , 2, '.', '')."% abaixo do limite permitido";
                                        $style = "";
                                    }
                                    echo '" '.$style.'>';

                                echo number_format(
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                    ($dre['4']['despesasFixas']['0'] + $dre['5']['despesasFixas']['0'] + $dre['6']['despesasFixas']['0'])
                                    /
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['7']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['7']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['7']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['7']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['7']['despesasFixas']['1'];?>
                                </th>
                                <th><?php echo $dre['8']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['8']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['8']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['8']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['8']['despesasFixas']['1'];?>
                                </th>
                                <th><?php echo $dre['9']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['9']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['9']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['9']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['9']['despesasFixas']['1'];?>
                                </th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['despesasFixas']['0'] +$dre['8']['despesasFixas']['0'] + $dre['9']['despesasFixas']['0'];
                                ?></th>

                                <?php
                                echo '<th class="thheader yellow" title="';
                                    if(
                                        number_format(
                                            ((
                                            ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'] != 0)?
                                            ($dre['7']['despesasFixas']['0'] + $dre['8']['despesasFixas']['0'] + $dre['9']['despesasFixas']['0'])
                                            /
                                            ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                            * 100) - $mx) -20
                                        , 2, '.', '') > 0)
                                    {
                                        echo "Você ultrapassou o limite em ".number_format( (($dre['7']['despesasFixas']['0'] + $dre['8']['despesasFixas']['0'] + $dre['9']['despesasFixas']['0'])
                                        /
                                        ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'])
                                        * 100) - $mx
                                        , 2, '.', '')."%";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo "Você ficou ".number_format( (
                                        ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']!= 0)?
                                        ($dre['7']['despesasFixas']['0'] + $dre['8']['despesasFixas']['0'] + $dre['9']['despesasFixas']['0'])
                                        /
                                        ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                        * 100) -$mc
                                        , 2, '.', '')."% abaixo do limite permitido";
                                        $style = "";
                                    }
                                 echo '" '.$style.'>';

                                echo number_format(
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'] != 0)?
                                    ($dre['7']['despesasFixas']['0'] + $dre['8']['despesasFixas']['0'] + $dre['9']['despesasFixas']['0'])
                                    /
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['10']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['10']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['10']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['10']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['10']['despesasFixas']['1'];?>
                                </th>
                                <th><?php echo $dre['11']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['11']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['11']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['11']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['11']['despesasFixas']['1'];?>
                                </th>
                                <th><?php echo $dre['12']['despesasFixas']['0'];?></th>
                                <th
                                 title="<?php
                                    if( preg_replace("/[^0-9]/", "", $dre['12']['despesasFixas']['1']) > "25"){
                                        echo "Você ficou ". (floatval($dre['12']['despesasFixas']['1']) - 20)."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['12']['despesasFixas']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['12']['despesasFixas']['1'];?>
                                </th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['despesasFixas']['0'] +$dre['11']['despesasFixas']['0'] + $dre['12']['despesasFixas']['0'];
                                ?></th>

                                <?php
                                echo '<th class="thheader yellow" title="';
                                    if(
                                        number_format(
                                            ((
                                                ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] != 0)?
                                                ($dre['10']['despesasFixas']['0'] + $dre['11']['despesasFixas']['0'] + $dre['12']['despesasFixas']['0'])
                                                /
                                                ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                                * 100) - $mx) -20
                                        , 2, '.', '') > 0)
                                    {
                                        echo "Você ultrapassou o limite em ".number_format( (($dre['10']['despesasFixas']['0'] + $dre['11']['despesasFixas']['0'] + $dre['12']['despesasFixas']['0'])
                                        /
                                        ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'])
                                        * 100) - $mx
                                        , 2, '.', '')."%";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo "Você ficou ".number_format( (
                                        ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] != 0)?
                                        ($dre['10']['despesasFixas']['0'] + $dre['11']['despesasFixas']['0'] + $dre['12']['despesasFixas']['0'])
                                        /
                                        ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                        * 100) -$mc
                                        , 2, '.', '')."% abaixo do limite permitido";
                                        $style = "";
                                    }
                                echo '" '.$style.'>';

                                echo number_format(
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] != 0)?
                                    ($dre['10']['despesasFixas']['0'] + $dre['11']['despesasFixas']['0'] + $dre['12']['despesasFixas']['0'])
                                    /
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['13']['despesasFixas']['0'];?></th>
                                <th title="
                                <?php
                                    if($dre['13']['despesasFixas']['1'] > "20%"){
                                        echo "Você ficou ". ($dre['13']['despesasFixas']['1'])."% acima do máximo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['13']['despesasFixas']['1'];
                                        $style="";
                                    }
                                    echo '" '.$style;

                                ?>">
                                 <?php   echo $dre['13']['despesasFixas']['1']; ?>
                                </th>
                            </tr>
                            <?php
                                $SaTo = 0;
                                $m = 1;
                                $valorMes = array();
                                foreach($saidaMesDetail as $key => $indice){
                                    if($key == "GPS" || $key == "Funcionários"){
                                        $title = "GPS + Funcionários = 15%";
                                        $mx = 15;
                                    }elseif($key == "Retirada"){
                                        $title = "Retirada (Prólabore) = 5%";
                                        $mx = 5;
                                    }elseif($key == "ocupação"){
                                        $title = "Alugual e condomínio = 7%";
                                        $mx = 7;
                                    }elseif($key == "Investimentos"){
                                        $title = "Investimentos até 5%";
                                        $mx = 5;
                                    }elseif($key == "Hosting"){
                                        $title = "Hosting até 18%";
                                        $mx = 18;
                                    }else{
                                        $title = "Despesas com Luz, Aguá, Telefone e outros até 7%";
                                        $mx = 7;
                                    }
                                    echo '<tr data-toggle="tooltip" data-placement="bottom" data-original-title="'.$title.'">';
                                    echo '<th class="thheader red yellow">'.$key.'</th>';

                                    foreach($indice as $keys){
                                        $title = "";
                                        $style = 'style="color: red; font-weight: bold;"';
                                        if(isset($keys[0])){
                                            $SaTo = $SaTo + $keys[0];
                                            echo "<th>$keys[0]</th>";
                                            array_push($valorMes, (string)$keys[0]);
                                        }else{
                                            echo "<th>0</th>";
                                            array_push($valorMes, 0);
                                        }

                                        echo '<th title="';
                                        if($dre[$m]['receitaBruta']['0'] > 0 AND isset($keys[0])){
                                            if( number_format( (($keys[0] / $dre[$m]['receitaBruta']['0']) * 100) - $mx, 2, '.', '') > 0 ){
                                                echo "Você ultrapassou o limite em ".number_format( (($keys[0] / $dre[$m]['receitaBruta']['0']) * 100) - $mx, 2, '.', '')."%";
                                            }else{
                                                echo "Você ficou ".number_format( (($keys[0] / $dre[$m]['receitaBruta']['0']) * 100) - $mx, 2, '.', '')."% abaixo do limite permitido";
                                                $style = "";
                                            }
                                        }elseif($dre[$m]['receitaBruta']['0'] < 1 AND isset($keys[0])){
                                            echo "Você ficou acima do limite permitido";
                                        }else{
                                            echo "Você ficou abaixo do limite permitido";
                                        }
                                        // var_dump('O que tem: '.$dre[$m]['receitaBruta']['0'].' - '.$keys[0]);
                                        if($dre[$m]['receitaBruta']['0'] == 0 OR !isset($keys[0])){
                                            $v1 = 0;
                                            //$v1 = number_format( ($SaTo / $mx) * 100, 2, '.', '');
                                        }else{
                                            $v1 = number_format( ($keys[0] / $dre[$m]['receitaBruta']['0']) * 100, 2, '.', '');
                                        }
                                        echo '" '.$style.'>'.
                                        $v1
                                        .'%</th>';

                                        if($m == 3){
                                            echo '<th class="thheader yellow">'.number_format($valorMes[0]+$valorMes[1]+$valorMes[2], 2, '.', '').'</th>';

                                            echo '<th class="thheader yellow" title="';
                                            if(number_format( (($valorMes[0]+$valorMes[1]+$valorMes[2]) / ($dre[1]['receitaBruta']['0']+$dre[2]['receitaBruta']['0']+$dre[3]['receitaBruta']['0']) * 100) - $mx
                                            , 2, '.', '') > 0){
                                                echo "Você ultrapassou o limite em ".number_format( (($valorMes[0]+$valorMes[1]+$valorMes[2]) / ($dre[1]['receitaBruta']['0']+$dre[2]['receitaBruta']['0']+$dre[3]['receitaBruta']['0']) * 100) - $mx
                                            , 2, '.', '')."%";
                                            }else{
                                                echo "Você ficou ".number_format( (($valorMes[0]+$valorMes[1]+$valorMes[2]) / ($dre[1]['receitaBruta']['0']+$dre[2]['receitaBruta']['0']+$dre[3]['receitaBruta']['0']) * 100) -$mc
                                            , 2, '.', '')."% abaixo do limite permitido";
                                                $style = "";
                                            }
                                            echo '" '.$style.'>';

                                            echo number_format(
                                                ($valorMes[0]+$valorMes[1]+$valorMes[2]) / ($dre[1]['receitaBruta']['0']+$dre[2]['receitaBruta']['0']+$dre[3]['receitaBruta']['0']) * 100
                                            , 2, '.', '');
                                            echo '%</th>';
                                        }
                                        if($m == 6){
                                            echo '<th class="thheader yellow">'.number_format($valorMes[3]+$valorMes[4]+$valorMes[5], 2, '.', '').'</th>';
                                            /**Tratar o title */
                                            if(isset($valorMes[6]) AND $valorMes[6] > 0){
                                                $v6 = (($valorMes[4]+$valorMes[5]+$valorMes[6]) / ($dre[4]['receitaBruta']['0']+$dre[5]['receitaBruta']['0']+$dre[6]['receitaBruta']['0']) * 100);
                                            }else{
                                                $v6 = 0;
                                            }

                                            echo '<th class="thheader yellow" title="';
                                            if(number_format( $v6 - $mx
                                            , 2, '.', '') > 0){
                                                echo "Você ultrapassou o limite em ".number_format( $v6 - $mx
                                            , 2, '.', '')."%";
                                            }else{
                                                echo "Você ficou ".number_format( $v6 -$mx
                                            , 2, '.', '')."% abaixo do limite permitido";
                                                $style = "";
                                            }
                                            echo '" '.$style.'>';

                                            echo number_format(
                                                $v6
                                            , 2, '.', '');
                                            echo '%</th>';
                                        }
                                        if($m == 9){
                                            echo '<th class="thheader yellow">'.number_format($valorMes[6]+$valorMes[7]+$valorMes[8], 2, '.', '').'</th>';
                                            /**Tratar o title */
                                            if(isset($valorMes[9]) AND $valorMes[9] > 0){
                                                $v9 = (($valorMes[7]+$valorMes[8]+$valorMes[9]) / ($dre[7]['receitaBruta']['0']+$dre[8]['receitaBruta']['0']+$dre[9]['receitaBruta']['0']) * 100);
                                            }else{
                                                $v9 = 0;
                                            }

                                            echo '<th class="thheader yellow" title="';
                                            if(number_format( $v9 - $mx
                                            , 2, '.', '') > 0){
                                                echo "Você ultrapassou o limite em ".number_format( $v9 - $mx
                                            , 2, '.', '')."%";
                                            }else{
                                                echo "Você ficou ".number_format( $v9 -$mx
                                            , 2, '.', '')."% abaixo do limite permitido";
                                                $style = "";
                                            }
                                            echo '" '.$style.'>';

                                            echo number_format(
                                                $v9
                                            , 2, '.', '');
                                            echo '%</th>';
                                        }
                                        if($m == 12){
                                            echo '<th class="thheader yellow">'.number_format($valorMes[9]+$valorMes[10]+$valorMes[11], 2, '.', '').'</th>';
                                            /**Tratar o title */
                                            if(isset($valorMes[12]) AND $valorMes[12] > 0){
                                                $v12 = (($valorMes[10]+$valorMes[11]+$valorMes[12]) / ($dre[10]['receitaBruta']['0']+$dre[11]['receitaBruta']['0']+$dre[12]['receitaBruta']['0']) * 100);
                                            }else{
                                                $v12 = 0;
                                            }

                                            echo '<th class="thheader yellow" title="';
                                            if(number_format( $v12 - $mx
                                            , 2, '.', '') > 0){
                                                echo "Você ultrapassou o limite em ".number_format( $v12 - $mx
                                            , 2, '.', '')."%";
                                            }else{
                                                echo "Você ficou ".number_format( $v12 -$mx
                                            , 2, '.', '')."% abaixo do limite permitido";
                                                $style = "";
                                            }
                                            echo '" '.$style.'>';

                                            echo number_format(
                                                $v12
                                            , 2, '.', '');
                                            echo '%</th>';
                                        }
                                        $m = $m +1;
                                    }
                                    echo "<th>$SaTo</th>";
                                    echo '<th title="';
                                        if(number_format( (($SaTo / $dre['13']['receitaBruta']['0']) * 100) - $mx
                                        , 2, '.', '') > 0){
                                            echo "Você ultrapassou o limite em ".number_format( (($SaTo / $dre['13']['receitaBruta']['0']) * 100) - $mx
                                        , 2, '.', '')."%";
                                            $style = 'style="color: red; font-weight: bold;"';
                                        }else{
                                            echo "Você ficou ".number_format( (($SaTo / $dre['13']['receitaBruta']['0']) * 100) -$mx
                                        , 2, '.', '')."% abaixo do limite permitido";
                                            $style = 'style=""';
                                        }
                                    echo '" '.$style.'>';
                                    echo number_format( ($SaTo / $dre['13']['receitaBruta']['0']) * 100, 2, '.', '')
                                    .'%</th>';
                                    echo "</tr>";
                                    unset($SaTo); $SaTo = 0;
                                    //var_dump($valorMes);
                                    $valorMes = array();
                                    $m = 1;
                                }

                            ?>
                            <tr class="thheader blue">
                                <th title="Acima de 20%">Resultado Operacional</th>
                                <th><?php echo $dre['1']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['1']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['2']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['2']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['3']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['3']['resultadoOperacional']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['resultadoOperacional']['0'] +$dre['2']['resultadoOperacional']['0'] + $dre['3']['resultadoOperacional']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                    (
                                        $dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] -
                                        ($dre['1']['despesasVendas']['0'] + $dre['2']['despesasVendas']['0'] + $dre['3']['despesasVendas']['0']) -
                                        ($dre['1']['despesasVariaveis']['0'] + $dre['2']['despesasVariaveis']['0'] + $dre['3']['despesasVariaveis']['0']) -
                                        ($dre['1']['outrasDespesas']['0'] + $dre['2']['outrasDespesas']['0'] + $dre['3']['outrasDespesas']['0']) -
                                        ($dre['1']['despesasFixas']['0'] + $dre['2']['despesasFixas']['0'] + $dre['3']['despesasFixas']['0'])
                                    )
                                    /
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['4']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['4']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['5']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['5']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['6']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['6']['resultadoOperacional']['1'];?></th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['despesasVendas']['0'] +$dre['5']['despesasVendas']['0'] + $dre['6']['despesasVendas']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                    (
                                        $dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] -
                                        ($dre['4']['despesasVendas']['0'] + $dre['5']['despesasVendas']['0'] + $dre['6']['despesasVendas']['0']) -
                                        ($dre['4']['despesasVariaveis']['0'] + $dre['5']['despesasVariaveis']['0'] + $dre['6']['despesasVariaveis']['0']) -
                                        ($dre['4']['outrasDespesas']['0'] + $dre['5']['outrasDespesas']['0'] + $dre['6']['outrasDespesas']['0']) -
                                        ($dre['4']['despesasFixas']['0'] + $dre['5']['despesasFixas']['0'] + $dre['6']['despesasFixas']['0'])
                                    )
                                    /
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['7']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['7']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['8']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['8']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['9']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['9']['resultadoOperacional']['1'];?></th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['despesasVendas']['0'] +$dre['8']['despesasVendas']['0'] + $dre['9']['despesasVendas']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'] != 0)?
                                    (
                                        $dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'] -
                                        ($dre['7']['despesasVendas']['0'] + $dre['8']['despesasVendas']['0'] + $dre['9']['despesasVendas']['0']) -
                                        ($dre['7']['despesasVariaveis']['0'] + $dre['8']['despesasVariaveis']['0'] + $dre['9']['despesasVariaveis']['0']) -
                                        ($dre['7']['outrasDespesas']['0'] + $dre['8']['outrasDespesas']['0'] + $dre['9']['outrasDespesas']['0']) -
                                        ($dre['7']['despesasFixas']['0'] + $dre['8']['despesasFixas']['0'] + $dre['9']['despesasFixas']['0'])
                                    )
                                    /
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['10']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['10']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['11']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['11']['resultadoOperacional']['1'];?></th>
                                <th><?php echo $dre['12']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['12']['resultadoOperacional']['1'];?></th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['despesasVariaveis']['0'] +$dre['11']['despesasVariaveis']['0'] + $dre['12']['despesasVariaveis']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] != 0)?
                                    (
                                        $dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] -
                                        ($dre['10']['despesasVendas']['0'] + $dre['11']['despesasVendas']['0'] + $dre['12']['despesasVendas']['0']) -
                                        ($dre['10']['despesasVariaveis']['0'] + $dre['11']['despesasVariaveis']['0'] + $dre['12']['despesasVariaveis']['0']) -
                                        ($dre['10']['outrasDespesas']['0'] + $dre['11']['outrasDespesas']['0'] + $dre['12']['outrasDespesas']['0']) -
                                        ($dre['10']['despesasFixas']['0'] + $dre['11']['despesasFixas']['0'] + $dre['12']['despesasFixas']['0'])
                                    )
                                    /
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['13']['resultadoOperacional']['0'];?></th>
                                <th><?php echo $dre['13']['resultadoOperacional']['1'];?></th>
                            </tr>
                            <tr title="Até 5%">
                                <th class="thheader red yellow">Investimentos</th>
                                <th><?php echo $dre['1']['investimentos']['0'];?></th>
                                <th><?php echo $dre['1']['investimentos']['1'];?></th>
                                <th><?php echo $dre['2']['investimentos']['0'];?></th>
                                <th><?php echo $dre['2']['investimentos']['1'];?></th>
                                <th><?php echo $dre['3']['investimentos']['0'];?></th>
                                <th><?php echo $dre['3']['investimentos']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['investimentos']['0'] +$dre['2']['investimentos']['0'] + $dre['3']['investimentos']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                    ($dre['1']['investimentos']['0'] + $dre['2']['investimentos']['0'] + $dre['3']['investimentos']['0'])
                                    /
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['4']['investimentos']['0'];?></th>
                                <th><?php echo $dre['4']['investimentos']['1'];?></th>
                                <th><?php echo $dre['5']['investimentos']['0'];?></th>
                                <th><?php echo $dre['5']['investimentos']['1'];?></th>
                                <th><?php echo $dre['6']['investimentos']['0'];?></th>
                                <th><?php echo $dre['6']['investimentos']['1'];?></th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['investimentos']['0'] +$dre['5']['investimentos']['0'] + $dre['6']['investimentos']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                    ($dre['4']['investimentos']['0'] + $dre['5']['investimentos']['0'] + $dre['6']['investimentos']['0'])
                                    /
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['7']['investimentos']['0'];?></th>
                                <th><?php echo $dre['7']['investimentos']['1'];?></th>
                                <th><?php echo $dre['8']['investimentos']['0'];?></th>
                                <th><?php echo $dre['8']['investimentos']['1'];?></th>
                                <th><?php echo $dre['9']['investimentos']['0'];?></th>
                                <th><?php echo $dre['9']['investimentos']['1'];?></th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['investimentos']['0'] +$dre['8']['investimentos']['0'] + $dre['9']['investimentos']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'] != 0)?
                                    ($dre['7']['investimentos']['0'] + $dre['8']['investimentos']['0'] + $dre['9']['investimentos']['0'])
                                    /
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['10']['investimentos']['0'];?></th>
                                <th><?php echo $dre['10']['investimentos']['1'];?></th>
                                <th><?php echo $dre['11']['investimentos']['0'];?></th>
                                <th><?php echo $dre['11']['investimentos']['1'];?></th>
                                <th><?php echo $dre['12']['investimentos']['0'];?></th>
                                <th><?php echo $dre['12']['investimentos']['1'];?></th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['investimentos']['0'] +$dre['11']['investimentos']['0'] + $dre['12']['investimentos']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] != 0)?
                                    ($dre['10']['investimentos']['0'] + $dre['11']['investimentos']['0'] + $dre['12']['investimentos']['0'])
                                    /
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['13']['investimentos']['0'];?></th>
                                <th><?php echo $dre['13']['investimentos']['1'];?></th>
                            </tr>
                            <tr title="Mínimo de 20%" class="thheader blue">
                                <th title="Lucro ou prejuízo">Resultado Final</th>
                                <th><?php echo $dre['1']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['1']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['2']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['2']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['3']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['3']['resultadoFinal']['1'];?></th>
                                <!--1º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['1']['resultadoFinal']['0'] +$dre['2']['resultadoFinal']['0'] + $dre['3']['resultadoFinal']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] != 0)?
                                    (
                                        $dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0'] -
                                        ($dre['1']['despesasVendas']['0'] + $dre['2']['despesasVendas']['0'] + $dre['3']['despesasVendas']['0']) -
                                        ($dre['1']['despesasVariaveis']['0'] + $dre['2']['despesasVariaveis']['0'] + $dre['3']['despesasVariaveis']['0']) -
                                        ($dre['1']['outrasDespesas']['0'] + $dre['2']['outrasDespesas']['0'] + $dre['3']['outrasDespesas']['0']) -
                                        ($dre['1']['despesasFixas']['0'] + $dre['2']['despesasFixas']['0'] + $dre['3']['despesasFixas']['0']) -
                                        ($dre['1']['investimentos']['0'] + $dre['2']['investimentos']['0'] + $dre['3']['investimentos']['0'])
                                    )
                                    /
                                    ($dre['1']['receitaBruta']['0'] +$dre['2']['receitaBruta']['0'] + $dre['3']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['4']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['4']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['5']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['5']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['6']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['6']['resultadoFinal']['1'];?></th>
                                <!--2º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['4']['resultadoFinal']['0'] +$dre['5']['resultadoFinal']['0'] + $dre['6']['resultadoFinal']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] != 0)?
                                    (
                                        $dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0'] -
                                        ($dre['4']['despesasVendas']['0'] + $dre['5']['despesasVendas']['0'] + $dre['6']['despesasVendas']['0']) -
                                        ($dre['4']['despesasVariaveis']['0'] + $dre['5']['despesasVariaveis']['0'] + $dre['6']['despesasVariaveis']['0']) -
                                        ($dre['4']['outrasDespesas']['0'] + $dre['5']['outrasDespesas']['0'] + $dre['6']['outrasDespesas']['0']) -
                                        ($dre['4']['despesasFixas']['0'] + $dre['5']['despesasFixas']['0'] + $dre['6']['despesasFixas']['0']) -
                                        ($dre['4']['investimentos']['0'] + $dre['5']['investimentos']['0'] + $dre['6']['investimentos']['0'])
                                    )
                                    /
                                    ($dre['4']['receitaBruta']['0'] +$dre['5']['receitaBruta']['0'] + $dre['6']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['7']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['7']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['8']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['8']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['9']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['9']['resultadoFinal']['1'];?></th>
                                <!--3º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['7']['resultadoFinal']['0'] +$dre['7']['resultadoFinal']['0'] + $dre['7']['resultadoFinal']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'] != 0)?
                                    (
                                        $dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0'] -
                                        ($dre['7']['despesasVendas']['0'] + $dre['8']['despesasVendas']['0'] + $dre['9']['despesasVendas']['0']) -
                                        ($dre['7']['despesasVariaveis']['0'] + $dre['8']['despesasVariaveis']['0'] + $dre['9']['despesasVariaveis']['0']) -
                                        ($dre['7']['outrasDespesas']['0'] + $dre['8']['outrasDespesas']['0'] + $dre['9']['outrasDespesas']['0']) -
                                        ($dre['7']['despesasFixas']['0'] + $dre['8']['despesasFixas']['0'] + $dre['9']['despesasFixas']['0']) -
                                        ($dre['7']['investimentos']['0'] + $dre['8']['investimentos']['0'] + $dre['9']['investimentos']['0'])
                                    )
                                    /
                                    ($dre['7']['receitaBruta']['0'] +$dre['8']['receitaBruta']['0'] + $dre['9']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['10']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['10']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['11']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['11']['resultadoFinal']['1'];?></th>
                                <th><?php echo $dre['12']['resultadoFinal']['0'];?></th>
                                <th><?php echo $dre['12']['resultadoFinal']['1'];?></th>
                                <!--4º Trimestre-->
                                <th class="thheader yellow"><?php
                                echo $dre['10']['resultadoFinal']['0'] +$dre['11']['resultadoFinal']['0'] + $dre['12']['resultadoFinal']['0'];
                                ?></th>
                                <th class="thheader yellow">
                                <?php echo number_format(
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] != 0)?
                                    (
                                        $dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0'] -
                                        ($dre['10']['despesasVendas']['0'] + $dre['11']['despesasVendas']['0'] + $dre['12']['despesasVendas']['0']) -
                                        ($dre['10']['despesasVariaveis']['0'] + $dre['11']['despesasVariaveis']['0'] + $dre['12']['despesasVariaveis']['0']) -
                                        ($dre['10']['outrasDespesas']['0'] + $dre['11']['outrasDespesas']['0'] + $dre['12']['outrasDespesas']['0']) -
                                        ($dre['10']['despesasFixas']['0'] + $dre['11']['despesasFixas']['0'] + $dre['12']['despesasFixas']['0']) -
                                        ($dre['10']['investimentos']['0'] + $dre['11']['investimentos']['0'] + $dre['12']['investimentos']['0'])
                                    )
                                    /
                                    ($dre['10']['receitaBruta']['0'] +$dre['11']['receitaBruta']['0'] + $dre['12']['receitaBruta']['0']):0
                                    * 100, 2, '.', '') ?>
                                %</th>

                                <th><?php echo $dre['13']['resultadoFinal']['0'];?></th>
                                <th
                                 title="<?php
                                    if($dre['13']['resultadoFinal']['1'] < "20%"){
                                        echo "Você ficou ". ($dre['13']['resultadoFinal']['1'] . "20%")."% abaixo do mínimo";
                                        $style = 'style="color: red; font-weight: bold;"';
                                    }else{
                                        echo $dre['13']['resultadoFinal']['1'];
                                        $style="";
                                    }
                                 echo '" '.$style;
                                 ?>"
                                >
                                    <?php echo $dre['13']['resultadoFinal']['1'];?>
                                </th>
                            </tr>

                        </thead>
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