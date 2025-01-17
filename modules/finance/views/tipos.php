<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
   <div class="content">
      <div class="modal fade" id="finance-tipo" tabindex="-1" role="dialog">
         <form action="" method="post">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Novo Tipo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                           <input type="hidden" name="csrf_token_name" value="<?php echo $_COOKIE["csrf_cookie_name"]?>">
                           <input type="hidden" value="NULL" name="update" id="update">
                           <div class="form-group" app-field-wrapper="royalties">
                              <label for="codigo_conta" class="control-label">
                                 <small class="req text-danger">* </small>Código da Conta
                              </label>
                              <input required type="text" id="codigo_conta" name="codigo_conta" class="form-control" value="" aria-invalid="false">
                           </div>
                           <div class="form-group">
                              <label for="classificacao_conta" class="control-label"> 
                                 <small class="req text-danger">* </small>Classificação da Conta
                              </label>
                              <input required type="number" id="classificacao_conta" name="classificacao_conta" class="form-control" value="" aria-invalid="false">
                           </div>
                           <div class="form-group" app-field-wrapper="nome_conta">
                              <label for="nome_conta" class="control-label"> 
                                 <small class="req text-danger">* </small>Nome da Conta
                              </label>
                              <input required type="text" id="nome_conta" name="nome_conta" class="form-control" value="" required aria-invalid="false">
                           </div>                        
                           <div class="form-group" app-field-wrapper="tipo_conta">
                              <label for="tipo_conta" class="control-label"> 
                                 <small class="req text-danger">* </small>Tipo de Conta
                              </label>
                              <input required type="text" maxlength="1" id="tipo_conta" name="tipo_conta" class="form-control" value="" required aria-invalid="false">
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
                    <h3>Tipos</h3>
                  </div>
                  <div class="clearfix"></div>
                  <hr class="hr-panel-heading">
                  <div class="row">
                     <div style="width: auto; padding-right: 25px;" class="col-md-2 border-right">
                           <a style="margin: 15px 0 20px 20px;" data-toggle="modal" data-target="#finance-tipo" data-tipo="post" class="btn btn-info">Adicionar</a>
                     </div>
                     <div style="padding-left: 25px;" class="col-md-10">
                        <h4 style="margin-top: 0">Importar XML ou CSV</h4>
                        <form method="POST" action="" enctype="multipart/form-data">
                        <div class="input-group">
                              <input type="hidden" name="csrf_token_name" value="<?php echo $_COOKIE["csrf_cookie_name"]?>">
                              <input type="file" class="form-control" accept=".xml, .csv" size="25" id="file" name="file">
                              <span class="input-group-btn">
                                 <button class="btn btn-default" type="submit">Importar</button>
                              </span>
                        </div>
                     </div>
                  </div>
                  </form>
                  <hr class="hr-panel-heading">
                  <table class="table dt-table" data-order-col="0" data-order-type="asc">
                     <thead>
                        <tr role="row">
                            <th class="toggleable sorting" id="valor-servicos">
                              Código da Conta
                           </th>
                            <th class="toggleable sorting" id="valor-servicos">
                              Classificação da Conta
                           </th>
                           <th class="toggleable sorting" id="numero-invoice">
                              Nome da Conta
                           </th>
                           <th class="toggleable sorting" id="numero-invoice">
                              Tipo de Conta
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($get as $key => $value) {
                            echo '<tr>';
                                echo '<td>';
                                    echo $value['codigo_conta'];
                                    echo'<div class="row-options">
                                    <a style="cursor: pointer;" data-toggle="modal" data-target="#finance-tipo" data-id="'.$value['id'].'" data-codigo_conta="'.$value['codigo_conta'].'" data-nome_conta="'.$value['nome_conta'].'" data-classificacao_conta="'.$value['classificacao_conta'].'" data-tipo_conta="'.$value['tipo_conta'].'" data-tipo="update">Editar</a>
                                    |
                                    <a class="text-danger" href="'.$link.'/admin/finance/tipos?delete='.$value['id'].'">Deletar</a>
                                 </div>';
                                echo '</td>';
                                echo '<td>';
                                    echo $value['classificacao_conta'];
                                echo '</td>';
                                echo '<td>';
                                    echo $value['nome_conta'];
                                echo '</td>';
                                echo '<td>';
                                    echo $value['tipo_conta'];
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