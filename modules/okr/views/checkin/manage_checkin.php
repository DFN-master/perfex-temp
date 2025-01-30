<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php init_head();?>
<div id="wrapper">
<div class="content">
<div class="panel_s" id="okr_s">
<div class="panel-body overflow-x-auto">
	<br>
	<br>
	<div class="row">
		<?php
$circulation_cky_current = '';
if (isset($cky_current)) {
	$circulation_cky_current = $cky_current;
}

$type = [
	['id' => 1, 'name' => _l('personal')],
	['id' => 2, 'name' => _l('department')],
	['id' => 3, 'name' => _l('company')],
];
?>
<input type="hidden" name="render_type" id="render_type" value="checkin"/>
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
	<table id="data" class="table table-bordered tree-move">
        <thead>
            <tr>
                <th scope="col" class="text-center"><?php echo _l('object'); ?></th>
                <th scope="col" class="text-center"><?php echo _l('circulation'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('key_results'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('progress'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('confidence_level'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('category'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('type'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('person_in_charge'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('actions'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('recently_checkin'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('upcoming_checkin'); ?></th>
		        <th scope="col" class="text-center"><?php echo _l('approval_status'); ?></th>
            </tr>
        </thead>
        <tbody>
    		<?php echo okr_html_entity_decode($array_tree); ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
<!-- HIDDEN / POP-UP DIV -->
<div id="pop-up">
   <p>
  </p>

</div>
<?php init_tail();?>
<?php require 'modules/okr/assets/js/file_js_checkin.php';?>
</body>
</html>