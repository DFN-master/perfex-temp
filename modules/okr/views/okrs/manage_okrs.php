<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php init_head();?>
<?php
$type = [
	['id' => 1, 'name' => _l('personal')],
	['id' => 2, 'name' => _l('department')],
	['id' => 3, 'name' => _l('company')],
];
?>
<div id="wrapper">
<div id="okr_s" class="panel_s">
<div class="panel-body overflow-x-auto">
<div class="col-md-12">
	<?php if (has_permission('okr', '', 'create') || is_admin()) {?>
	<a href="<?php echo admin_url('okr/new_object_main'); ?>" class="btn btn-info pull-left">
    	<?php echo _l('add'); ?>
	</a>
   <?php }?>
   <?php if (is_admin()) {?>
	<a href="<?php echo admin_url('okr/okrs_chart_org'); ?>" data-toggle="tooltip" title="" class="btn btn-default mleft5 tree-chart" data-original-title="<?php echo _l('switch_to_chart_okr'); ?>" >
		<i class="fa fa-align-left" aria-hidden="true"></i> <?php echo _l('switch_to_tree_grid'); ?>
	</a>
<?php }?>
<a href="javascript:void(0)" class="btn btn-default mleft5" id="export_okr">
          <i class="fa fa-file-excel"></i> <?php echo _l('export_okr'); ?>
        </a>
        <?php if (has_permission('okr', '', 'create') || is_admin()) {?>
        <a href="<?php echo admin_url('okr/import_okr'); ?>" class="btn btn-default mleft5" id="import_okr">
          <i class="fa fa-file-excel"></i> <?php echo _l('import_okr'); ?>
        </a>
        <?php }?>
	<br>
	<br>
	<div class="row">
		<?php
$circulation_cky_current = '';
if (isset($cky_current)) {
	$circulation_cky_current = $cky_current;
}
?>
		<?php echo form_hidden('circulation_main', $circulation_cky_current); ?>
		<input type="hidden" name="render_type" id="render_type" value="okr"/>
		<div class="col-md-4">
		<?php echo render_select('circulation', $circulation, array('id', array('name_circulation')), 'circulation', ''); ?>
		</div>
		<?php if (is_admin()) {?>
		<div class="col-md-4">
			<?php echo render_select('okrs', $okrs, array('id', array('your_target')), 'okr', ''); ?>
		</div>
		<div class="col-md-4">
			<?php echo render_select('staff', $staffs, array('staffid', array('firstname', 'lastname')), 'staff', ''); ?>
		</div>
		<?php }?>
		<div class="col-md-4">
			<?php echo render_select('type', $type, array('id', array('name')), 'type', ''); ?>
		</div>
		<div class="col-md-4">
			<?php echo render_select('category', $category, array('id', array('category')), 'category', ''); ?>
		</div>
		<div class="col-md-4">
			<?php echo render_select('department', $department, array('departmentid', array('name')), 'department', ''); ?>
		</div>
	</div>
	<div class="row-table-scroll">
	    <table id="data" class="table table-bordered tree-move">
	        <thead>
	            <tr>
	                <th scope="col" class="text-center"><?php echo _l('object'); ?></th>
	                <th scope="col" class="text-center"><?php echo _l('circulation'); ?></th>
			        <th scope="col" class="text-center"><?php echo _l('key_results'); ?></th>
			        <th scope="col" class="text-center"><?php echo _l('progress'); ?></th>
			        <th scope="col" class="text-center"><?php echo _l('category'); ?></th>
			        <th scope="col" class="text-center"><?php echo _l('type'); ?></th>
			        <th scope="col" class="text-center"><?php echo _l('person_in_charge'); ?></th>
			        <th scope="col" class="text-center"><?php echo _l('status'); ?></th>
			        <th scope="col" class="text-center"><?php echo _l('option'); ?></th>
	            </tr>
	        </thead>
	        <tbody>
	    		<?php echo okr_html_entity_decode($array_tree); ?>
	        </tbody>
	    </table>
	</div>
	<div class="zoom-pannel hide">
		<section class="buttons display-flex">
		  <button class="btn btns zoom zoom-in"><i class="fa fa-search-plus font-size-20"></i></button>
		  <button class="btn btns zoom-out zoom-out"><i class="fa fa-search-minus font-size-20"></i></button>
		  <input type="range" class="zoom-range">
		  <button class="btn btns zoom-init reset"><i class="fa fa-recycle font-size-20"></i></button>
		</section>
	</div>
    <div id="okrs_tree hide">
	</div>
</div>
</div>
</div>
</div>

	<!-- Modal -->
	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel2"><?php echo _l('diagrams_okr'); ?></h4>
				</div>

				<div class="modal-body">
					<div id="tree_clone">
    				</div>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->

<!-- HIDDEN / POP-UP DIV -->
<div id="pop-up">
   <p>
  </p>

</div>
<?php init_tail();?>
<?php require 'modules/okr/assets/js/file_js.php';?>
</body>
</html>
