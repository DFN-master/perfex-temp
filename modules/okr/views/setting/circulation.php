<div class="col-md-12">
	<?php if (has_permission('okr_setting', '', 'create') || is_admin()) {?>

	<a href="#" onclick="add_setting_circulation(); return false;" class="btn btn-info pull-left">
    	<?php echo _l('add'); ?>
	</a>
	<?php }?>
</div>
<div class="col-md-12 padding-with-table">
	<?php
$table_data = array(
	_l('name'),
	_l('type'),
	_l('okr_year'),
	_l('okr_quarter'),
	_l('okr_month'),
	_l('from_date'),
	_l('to_date'),
	_l('option'),
);
render_datatable($table_data, 'circulation');
?>
</div>
<div class="modal fade" id="setting_circulation" tabindex="-1" role="dialog">
<?php echo form_open(admin_url('okr/setting_circulation'), array('id' => 'form_setting_circulation')); ?>
	<div class="modal-dialog">
    	<div class="modal-content">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">
	                <span class="add-title"><?php echo _l('add_setting_circulation'); ?></span>
	                <span class="update-title hide"><?php echo _l('update_setting_circulation'); ?></span>
	            </h4>
	        </div>
	        <div class="modal-body">
	        	 <?php echo form_hidden('id'); ?>
	        	 <?php
$cyear = date('Y');
$types = [
	['id' => 'okr_custom', 'name' => _l('okr_custom')],
	['id' => 'okr_yearly', 'name' => _l('okr_yearly')],
	['id' => 'okr_quarterly', 'name' => _l('okr_quarterly')],
	['id' => 'okr_monthly', 'name' => _l('okr_monthly')],
];
$years = [
	['id' => $cyear, 'name' => $cyear],
	['id' => $cyear + 1, 'name' => $cyear + 1],
	['id' => $cyear + 2, 'name' => $cyear + 2],
	['id' => $cyear + 3, 'name' => $cyear + 3],
	['id' => $cyear + 4, 'name' => $cyear + 4],
];
$quarters = [
	['id' => 1, 'name' => _l('okr_q1')],
	['id' => 2, 'name' => _l('okr_q2')],
	['id' => 3, 'name' => _l('okr_q3')],
	['id' => 4, 'name' => _l('okr_q4')],
];
$months = [
	['id' => 1, 'name' => _l('okr_m1')],
	['id' => 2, 'name' => _l('okr_m2')],
	['id' => 3, 'name' => _l('okr_m3')],
	['id' => 4, 'name' => _l('okr_m4')],
	['id' => 5, 'name' => _l('okr_m5')],
	['id' => 6, 'name' => _l('okr_m6')],
	['id' => 7, 'name' => _l('okr_m7')],
	['id' => 8, 'name' => _l('okr_m8')],
	['id' => 9, 'name' => _l('okr_m9')],
	['id' => 10, 'name' => _l('okr_m10')],
	['id' => 11, 'name' => _l('okr_m11')],
	['id' => 12, 'name' => _l('okr_m12')],
];
?>
	        	 <div class="row">
	        	 	<div class="col-md-4">
	        	 		<?php echo render_select('type', $types, array('id', 'name'), 'type', 'okr_custom'); ?>
	        	 	</div>
	        	 	<div class="col-md-4" id="yearly">
	        	 		<?php echo render_select('year', $years, array('id', 'name'), 'okr_year', $cyear); ?>
	        	 	</div>
	        	 	<div class="col-md-4" id="quarterly">
	        	 		<?php echo render_select('quarter', $quarters, array('id', 'name'), 'okr_quarter', 1); ?>
	        	 	</div>
	        	 	<div class="col-md-4" id="monthly">
	        	 		<?php echo render_select('month', $months, array('id', 'name'), 'okr_month', 1); ?>
	        	 	</div>
	        	 </div>
	        	 <?php echo render_input('name_circulation', 'name_circulation'); ?>
	        	<div class="row" id="ctime">
	        		<div class="col-md-6">
	        			<?php echo render_date_input('from_date', 'from_date'); ?>
	        		</div>
	        		<div class="col-md-6">
	        			<?php echo render_date_input('to_date', 'to_date'); ?>
	        		</div>
	        	</div>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
	            <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
	        </div>
      	</div>
    </div>
<?php echo form_close(); ?>
</div>
