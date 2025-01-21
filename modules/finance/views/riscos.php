<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); setlocale(LC_MONETARY, 'pt_BR');?>

<style>
    th{border: dashed 1px #000; text-align: center; padding: 2px;}
    .thheader{text-align: center; padding-left: 5px; padding-right: 5px; font-weight: 500; line-height: unset !important;}
    .yellow{ background: #f7e861; color: #ffffff;}
    .blue{ background: #646cf4; color: #ffffff;}
    .bgred{ background: red; color: #ffffff;}
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
                    <div class="col-md-12">
                       <?php
                        echo '<h4>Você está visualizando os clientes de risco do ano de '.date('Y').'</h4>';
                       ?>
                    </div>
                    
                    <div class="panel-body" style="overflow-y: hidden;">
                    
                        <table style="padding-right: 18px; display: block; float: left;">
                            <thead>
                                <tr style="background: #000; color:#fff;">
                                    <th>RISCO</th>
                                    <th>EMPRESA</th>
                                    <th>MOTIVO</th>
                                    <th>CALCULO</th>
                                    <th>REPRESENTATIVIDADE</th>
                                </tr>
                            </thead>
                            <?php
                                foreach ($risco as $key) {
                                    if(( ($key['totalfull'] / $saida) *10 ) > 1){
                                        $color = "bgred";
                                    }elseif(( ($key['totalfull'] / $saida) *10 ) > 0.5){
                                        $color = "yellow";
                                    }else{
                                        $color = "blue";
                                    }
                                    echo "<tr>";
                                    echo '<th class="'.$color.'" title="Quanto mais perto ou acima de 1, mais risco essa empresa representa.">'.number_format(($key['totalfull'] / $saida) *10, 3, '.', '').'</th>';
                                    echo "<th>".$key['company']."</th>";
                                    echo "<th>(Entrada - Faturamento com o cliente) é menos que os custos</th>";
                                    echo '<th title="Quantidade em R$ dos custos que este cliente paga."> 
                                    Entrada R$'.$entrada.' - Cliente R$'.$key['totalfull'].' - Saídas R$'.$saida.' = <span class="red"> R$'. (($entrada - $key['totalfull']) - $saida) .
                                    '</span></th>';
                                    echo '<th title="Quantidade em % dos custos que este cliente paga.">'.number_format(($key['totalfull'] / $saida) * 100, 2, '.', '').'%</th>';
                                    echo "</tr>";
                                }
                            ?>
                            
                            <?php
                                // foreach ($b as $key) {
                                //     echo "<tr>";
                                //     echo '<th class="yellow">B</th>';
                                //     echo "<th>".$key['company']."</th>";
                                //     echo "<th>R$".number_format($key['totalfull'], 2, '.', '')."</th>";
                                //     echo "</tr>";
                                // }
                            ?>
                            
                            <?php
                                // foreach ($c as $key) {
                                //     echo "<tr>";
                                //     echo '<th class="bgred">C</th>';
                                //     echo "<th>".$key['company']."</th>";
                                //     echo "<th>R$".number_format($key['totalfull'], 2, '.', '')."</th>";
                                //     echo "</tr>";
                                // }
                            ?>
                        </table>
                    </div>
                    <h5>Como funciona?</h5>
                    <p>
                        Campos:
                    </p>
                    <li>
                        Risco: Até 1.0 o risco é alto, acima disso ainda mais alto. 
                    </li>
                    <li>
                        Empresa: Nome da empresa.
                    </li>
                    <li>
                        Motico: Mótivo do risco.
                    </li>
                    <li>
                        Cálculo: Mostra como estaria o resultado da empresa no ano, se não tivesse este cliente.
                    </li>
                    <li>
                        Representatividade: Mostra em (%) Porcentagem o quanto este cliente paga das saídas da empresa.
                    </li>
                    </br>
                    <p>
                        Mais informações:
                    </p>
                    <li>
                        Porque vejo muitas empresas? Se isso acontece, isso pode significa que a saúde financeira da sua empresa está ruim.
                    </li>
                    <li>
                        Porque não vejo nenhuma empresa? Isso pode significa que a saúde financeira da sua empresa está ótima, pois ao perder qualquer cliente não afetará os redimentos a ponto de negativar o saldo do ano.
                    </li>
                    <li>
                        Tem mais sinais de riscos? Sim, veja a Curva ABC, se você tem clientes que representam um valor maior que %3 das entradas, esses clientes podem vir a ser um risco para a sua empresa.
                    </li>
                    
                </div>
            </div>
        </div>
    </div>
</div>
                    




<?php init_tail(); ?>
</body>
</html>