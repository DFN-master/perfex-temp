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
                        echo '<h4>Você está visualizando a Curva de clientes do ano de '.date('Y').'</h4>';
                       ?>
                    </div>
                    
                    <div class="panel-body" style="overflow-y: hidden;">
                    
                        <table style="padding-right: 18px; display: block; float: left;">
                            <thead>
                                <tr style="background: #000; color:#fff;">
                                    <th>CLASS</th>
                                    <th>EMPRESA</th>
                                    <th>VALOR TOTAL ATÉ O MOMENTO</th>
                                    <th>REPRESENTATIVIDADE</th>
                                </tr>
                            </thead>
                            <?php
                                foreach ($a as $key) {
                                    echo "<tr>";
                                    echo '<th class="blue">A</th>';
                                    echo "<th>".$key['company']."</th>";
                                    echo "<th>R$".number_format($key['totalfull'], 2, '.', '')."</th>";
                                    echo '<th title="O Quanto em (%) Porcentagem que este cliente representa do faturamento da sua empresa.">'.number_format(($key['totalfull'] / $entrada) * 100, 2, '.', '').'%</th>';
                                    echo "</tr>";
                                }
                            ?>
                            
                            <?php
                                foreach ($b as $key) {
                                    echo "<tr>";
                                    echo '<th class="yellow">B</th>';
                                    echo "<th>".$key['company']."</th>";
                                    echo "<th>R$".number_format($key['totalfull'], 2, '.', '')."</th>";
                                    echo '<th title="O Quanto em (%) Porcentagem que este cliente representa do faturamento da sua empresa.">'.number_format(($key['totalfull'] / $entrada) * 100, 2, '.', '').'%</th>';
                                    echo "</tr>";
                                }
                            ?>
                            
                            <?php
                                foreach ($c as $key) {
                                    echo "<tr>";
                                    echo '<th class="bgred">C</th>';
                                    echo "<th>".$key['company']."</th>";
                                    echo "<th>R$".number_format($key['totalfull'], 2, '.', '')."</th>";
                                    echo '<th title="O Quanto em (%) Porcentagem que este cliente representa do faturamento da sua empresa.">'.number_format(($key['totalfull'] / $entrada) * 100, 2, '.', '').'%</th>';
                                    echo "</tr>";
                                }
                            ?>
                        </table>
                    </div>
                    <p>
                        Informações importantes:
                    </p>
                    <li>
                        Tenho riscos? Se você tem clientes que representam um valor maior que %3 das entradas, esses clientes podem vir a ser um risco para a sua empresa.
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>
                    




<?php init_tail(); ?>
</body>
</html>