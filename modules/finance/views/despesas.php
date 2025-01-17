<?php defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php init_head(); setlocale(LC_MONETARY, 'pt_BR');?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <!-- Tabela para listar as despesas -->
                        <table id="extrato" class="table table-striped dt-table" data-order-col="0" data-order-type="asc">
                            <thead>
                                <tr role="row">
                                    <th class="not-export" style="display:none;" id="id">
                                        ID
                                    </th>
                                    <th id="date">
                                        Data
                                    </th>
                                    <th class="toggleable sorting" id="client">
                                        Tipo de Transação
                                    </th>
                                    <th class="toggleable sorting" id="nf">
                                        Valor
                                    </th>
                                    <th class="toggleable sorting" id="up_value" >
                                        Titulo
                                    </th>
                                    <th class="toggleable sorting" id="total">
                                        Descrição
                                    </th>
                                    <th class="toggleable sorting" id="description">
                                        Detalhes
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // echo  '<pre>';
                                    // var_dump($extratoEnriquecido);
                                    // echo  '</pre>';
                                    if(isset($extratoEnriquecido->expenses)){
                                        foreach ($extratoEnriquecido->expenses as $value) {
                                            if($value->tipoOperacao == "D"){
                                                echo "<tr>";
                                                    echo "<td style='display:none;'>".$value->idTransacao."</td>";
                                                    echo "<td>".$value->dataTransacao."</td>";
                                                    echo "<td>".$value->tipoTransacao."</td>";
                                                    echo "<td>".$value->valor."</td>";
                                                    echo "<td>".$value->titulo."</td>";
                                                    echo "<td>".$value->descricao."</td>";
                                                    echo "<td></td>";
                                                echo "</tr>";
                                            }
                                        }
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

<!-- FIM -->
<?php init_tail(); ?>
</body>
</html>