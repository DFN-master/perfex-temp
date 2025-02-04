<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
   <div class="content">
      <div class="row">
            <div class="col-md-12">
                <div class="panel_s" >
                    <div class="panel-body">
                        <form action="" method="post">
                            <div class="_buttons">
                                <h3>Configurações</h3>
                                <p><a href="https://cp.diletec.com.br/ecommerce">Módulos, Suporte e Atualizações</a></p>
                            </div>
                            <div class="clearfix"></div>

                            <hr class="hr-panel-heading">

                            <label class="control-label" for="juros">Taxa de Juros</label>
                            <div class="form-group input-group-select form-group-select-task_select popover-250">
                                <div class="input-group input-group-select">
                                    <input step=".01" value="<?php echo get_option('iaf_juros');?>" type="text" id="juros" name="juros" class="form-control" autofocus="1">
                                    <div class="input-group-addon input-group-addon-bill-tasks-help" style="opacity: 1;">
                                        <span class="pointer" data-toggle="tooltip" data-title="Taxa percentual dos juros que será cobrada">
                                            <i class="fa fa-percent"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <label class="control-label" for="multa">Taxa de Multa</label>
                            <div class="form-group input-group-select form-group-select-task_select popover-250">
                                <div class="input-group input-group-select">
                                    <input step=".01" value="<?php echo get_option('iaf_multa');?>" type="text" id="multa" name="multa" class="form-control" autofocus="1">
                                    <div class="input-group-addon input-group-addon-bill-tasks-help" style="opacity: 1;">
                                        <span class="pointer" data-toggle="tooltip" data-title="Taxa percentual da multa que será cobrada">
                                            <i class="fa fa-percent"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <label class="control-label" for="carencia">Dias de Carência</label>
                            <div class="form-group input-group-select form-group-select-task_select popover-250">
                                <div class="input-group input-group-select">
                                    <input value="<?php echo (get_option('iaf_carencia'))? get_option('iaf_carencia') : 0;?>" type="number" id="carencia" name="carencia" class="form-control" autofocus="1">
                                    <div class="input-group-addon input-group-addon-bill-tasks-help" style="opacity: 1;">
                                        <span class="pointer" data-toggle="tooltip" data-title="Taxa percentual da carencia que será cobrada">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <label class="control-label" for="multa">Remover Desconto</label>
                            <div class="form-group input-group-select form-group-select-task_select popover-250">
                                <div class="input-group input-group-select">
                                    <select name="remover_desconto" id="remover_desconto" class="form-control select2" autofocus="1">
                                        <option value="0" <?php if(get_option('iaf_remover_desconto') == 0){echo 'selected';}?>>Não</option>
                                        <option value="1" <?php if(get_option('iaf_remover_desconto') == 1){echo 'selected';}?>>Sim</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="csrf_token_name" value="<?php echo $_COOKIE["csrf_cookie_name"]?>">

                            <div class="btn-bottom-toolbar text-right">
                                <button type="submit" class="btn btn-info">Salvar Configurações</button>
                            </div>
                        </form>
                     </div>
                </div>
                <?php
                    if($post_result == true){
                        echo'
                        <div class="alert alert-success" role="alert">
                            Configurações Salvas com sucesso!
                        </div>';
                    }
                ?>
            </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
</body>
</html>
