<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
   <div class="content">
      <div class="modal fade" id="finance-aporte" tabindex="-1" role="dialog">
         <form method="POST" action="" enctype="multipart/form-data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Novo Aporte</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="csrf_token_name" value="<?php echo $_COOKIE["csrf_cookie_name"]?>">
                            <input type="hidden" value="NULL" name="update" id="update">
                            <div class="form-group" app-field-wrapper="socio">
                                <label for="socio" class="control-label">
                                    <small class="req text-danger">* </small>Sócio
                                </label>
                                <input required type="text" id="socio" name="socio" class="form-control" value="" aria-invalid="false">
                            </div>

                            <div class="form-group">
                                <label for="cpf_cnpj" class="control-label"> 
                                    <small class="req text-danger">* </small>CPF/CNPJ
                                </label>
                                <input required type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control" value="" aria-invalid="false">
                            </div>

                            <div class="form-group">
                                <label for="file" class="control-label"> 
                                    <small class="req text-danger">* </small>Comprovante
                                </label>
                                <input required type="file" class="form-control" size="25" accept="image/*, .pdf" id="file" name="file">
                            </div>
                            
                            <div class="form-group" app-field-wrapper="valor">
                                <label for="valor" class="control-label"> 
                                    <small class="req text-danger">* </small>Valor - R$
                                    <small>(Moeda Base)</small>
                                </label>
                                <input required  step=".01" type="number" id="valor" name="valor" class="form-control" value="" required aria-invalid="false">
                            </div> 

                            <div class="form-group" app-field-wrapper="data">
                                <label for="date" class="control-label"> 
                                    <small class="req text-danger">* </small>Data
                                </label>
                                <div class="input-group">
                                    <input value="<?php echo (empty($dados))? '' : $data_exp ?>" type="text" id="date" name="date" class="form-control datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar calendar-icon"></i>
                                    </div>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </div>
            </div>
        </form>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  <div class="_buttons">
                        <h3 style="width: auto; padding-right: 25px;" class="col-md-2 border-right">Aportes</h3>
                        <div class="row">
                            <div style="width: auto;" class="col-md-2">
                                <a style="margin: 15px 0 20px 20px;" data-toggle="modal" data-target="#finance-aporte" data-tipo="post" class="btn btn-info">Adicionar</a>
                            </div>
                        </div>   
                  </div>
                  <div class="clearfix"></div>
                  <hr class="hr-panel-heading">
                  <table class="table dt-table" data-order-col="0" data-order-type="asc">
                     <thead>
                        <tr role="row">
                            <th class="toggleable sorting" id="socio">
                              Sócio
                           </th>
                            <th class="toggleable sorting" id="cpf-cnpj">
                              CPF/CNPJ
                           </th>
                           <th class="toggleable sorting" id="comprovante">
                              Comprovante
                           </th>
                           <th class="toggleable sorting" id="valor">
                              Valor
                           </th>
                           <th class="toggleable sorting" id="data">
                              Data
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($get as $key => $value) {
                            echo '<tr>';
                                echo '<td>';
                                    echo $value['socio'];
                                    echo'<div class="row-options">
                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#finance-aporte" data-id="'.$value['id'].'" data-socio="'.$value['socio'].'" data-cpf_cnpj="'.$value['cpf_cnpj'].'" data-comprovante="'.$value['comprovante'].'" data-valor="'.$value['valor'].'" data-date="'.$value['date'].'" data-tipo="update">Editar</a>
                                    |
                                    <a class="text-danger" href="'.$link.'/admin/finance/aporte?delete='.$value['id'].'">Deletar</a>
                                 </div>';
                                echo '</td>';
                                echo '<td>';
                                    echo $value['cpf_cnpj'];
                                echo '</td>';
                                echo '<td>';
                                    echo '<a target="_blank" href="'.$link.'/admin/finance/aporte/downloadaporte/'.$value['id'].'/'.$value['comprovante'].'">'.$value['comprovante'].'</a>';
                                echo '</td>';
                                echo '<td>';
                                echo "R$ ".number_format($value['valor'],2,",",".");
                                echo '</td>';
                                echo '<td>';
                                    echo $value['date'];
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