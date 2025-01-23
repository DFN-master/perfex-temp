<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); setlocale(LC_MONETARY, 'pt_BR');?>

<style>
    /* th{text-align: center; padding: 2px;}
    .thheader{text-align: center; padding-left: 5px; padding-right: 5px; font-weight: 500; line-height: unset !important;}
    .yellow{ background: #f7e861;}
    .blue{ color: #646cf4;}
    .green{ color: #a0ed5d; font-weight: 500;}
    .beige{ background: #f4a971;}
    .red{ color: red; background-color: none; border-color: none;}
    .green > th{line-height: 30px;}
    .thead-blue{background: #4CC1F7;}
    .thead-blue th{color: white !important;} */

</style>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4>Extrato Financeiro</h4>
                        <hr class="hr-panel-heading">
                        <!-- Data de inicio e fim flotuando a direita -->
                        <div class="col-md-12">
                            <form method="get" action="<?php echo site_url('finance/extrato'); ?>" id="extrato-form" class="form-inline">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date-range">Data de Início</label>
                                        <input type="text" class="form-control datepicker" id="date-range" name="date-range" value="<?php echo date('01/m/Y'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date-range">Data de Fim</label>
                                        <input type="text" class="form-control datepicker" id="date-range" name="date-range" value="<?php echo date('t/m/Y'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info">Filtrar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="invoice_status">Método de Pagamento</label>
                                <div class="dropdown bootstrap-select show-tick bs3" style="width: 100%;">
                                    <select id="sel-extrato" name="extrato" class="selectpicker" multiple="" data-width="100%" data-none-selected-text="Todos" tabindex="-98">
                                        <?php
                                        foreach ($payment as $key => $value) {
                                            echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="extrato" class="table table-striped dt-table" data-order-col="1" data-order-type="desc">
                            <thead>
                                <tr role="row">
                                    <th class="not-export" style="display:none;" id="id">
                                        <div class="checkbox">
                                            <input class="chk_boxes" type="checkbox">
                                            <label></label>
                                        </div>
                                    </th>
                                    <th class="not-export" style="display:none;" id="id">
                                        ID
                                    </th>
                                    <th id="date">
                                        Data
                                    </th>
                                    <th class="toggleable sorting" id="client">
                                        Classificação
                                    </th>
                                    <th class="toggleable sorting" id="nf">
                                        Recibos
                                    </th>
                                    <th class="toggleable sorting" id="up_value" >
                                        Valor Alterado
                                    </th>
                                    <th class="toggleable sorting" id="total">
                                        Valor Total
                                    </th>
                                    <th class="toggleable sorting" id="description">
                                        Descrição
                                    </th>
                                    <th style="display:none;" class="toggleable sorting" id="methods">
                                        Métodos
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($extrato as $value => $key) {
                                    echo '<tr id="tr-relatorios-'.$value.'" class="tr-relatorios">';
                                        echo '<td style="display:none;">
                                                <div class="checkbox">
                                                    <input id="check['.$value.']" name="check['.$value.']" class="chk_boxes1" type="checkbox">
                                                    <label></label>
                                                </div>
                                            </td>';
                                        echo '<td style="display:none;">';
                                            echo $value;
                                        echo '</td>';
                                        echo '<td>';
                                            echo $key['date'];
                                        echo '</td>';
                                        echo '<td>';
                                            echo ($key['clientid'] != "")?'<a href="'.$link.'/admin/clients/client/'.$key['clientid'].'">'.$key['client'].'</a>': $key['client'];
                                        echo '</td>';
                                        echo '<td>';
                                            echo ($key['nf'] != '')?'<a href="'.$link.'/download/file/sales_attachment/'.$key['link_r'].'">'.$key['nf'].'</a>':'Sem Recibos Registrados';
                                        echo '</td>';
                                        echo '<td class="up-val-'.$value.'">';
                                            if($key['up_value'] > 0){
                                                echo '<a class="pull-right text-success">
                                                '."R$ ".number_format($key['up_value'],2,",",".").'
                                                </a>';
                                            }else{
                                                echo '<a class="pull-right text-danger">
                                                '."R$ ".number_format(floatval($key['up_value']),2,",",".").'
                                                </a>';
                                            }
                                        echo '</td>';
                                        echo '<td class="total-val-'.$value.'">';
                                            echo "R$ ".number_format($key['total'],2,",",".");
                                        echo '</td>';
                                        echo '<td>';
                                            echo $key['description'];
                                        echo '</td>';
                                        echo '<td class="extrato" style="display:none;">';
                                            echo '<span class="label label-default  s-status invoice-status-6">'.$key['method'].'</span>';
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