<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php init_head();?>
<div id="wrapper">
<div class="content">
<div class="row">
<div class="panel_s">
<div class="panel-body">
<h4 class="no-margin"><?php echo okr_html_entity_decode($title); ?></h4>
<hr class="hr-panel-heading">
<?php
$name = '';
$circulation_data = '';
$okr_superior = '';
$objective = '';
$okr_cross = '';
$display = '';
$okrs_id = '';
$category_edit = '';
$type_edit = '1';
$department_edit = '';
$person_assigned = get_staff_user_id();
$type = [
	['id' => 1, 'name' => _l('personal')],
	['id' => 2, 'name' => _l('department')],
	['id' => 3, 'name' => _l('company')],
];
if (isset($okrs_edit)) {
	$name = $okrs_edit['object']->name;
	$circulation_data = $okrs_edit['object']->circulation;
	$okr_superior = $okrs_edit['object']->okr_superior;
	$objective = $okrs_edit['object']->your_target;
	$okr_cross = explode(',', $okrs_edit['object']->okr_cross ?? '');
	$display = $okrs_edit['object']->display;
	$okrs_id = $okrs_edit['object']->id;
	$person_assigned = $okrs_edit['object']->person_assigned;
	$category_edit = $okrs_edit['object']->category;
	$type_edit = $okrs_edit['object']->type;
	$department_edit = $okrs_edit['object']->department;
}
?>
<?php echo form_open_multipart(admin_url('okr/okrs_new_main'), array('id' => 'okrs-new-main-form')); ?>
	<?php echo form_hidden('id', $okrs_id); ?>
		<?php echo render_textarea('your_target', 'your_target', $objective); ?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group" app-field-wrapper="circulation">
					<small class="req text-danger">* </small>
			<label for="okrs" class="control-label"><?php echo _l('circulation'); ?></label>
			<select id="circulation" name="circulation" class="selectpicker circulation_new" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
				<option value=""></option>
				<?php foreach ($circulation as $key => $value) {?>
					<option value="<?php echo okr_html_entity_decode($value['id']); ?>" <?php if ($circulation_data == $value['id']) {echo 'selected';}?> ><?php echo okr_html_entity_decode($value['name_circulation']); ?>
						<small>( <?php echo okr_html_entity_decode(_d($value['from_date'])); ?> - <?php echo okr_html_entity_decode(_d($value['to_date'])); ?>)</small>
					</option>
				<?php }?>
			</select>
			</div>
		</div>
		<div class="col-md-6">
			<?php echo render_select('category', $category, array('id', array('category')), 'category', $category_edit); ?>
		</div>
	</div>
	<div class="row">
		<div class="type-current col-md-6">
			<?php echo render_select('type', $type, array('id', array('name')), 'type', $type_edit); ?>
		</div>
		<div class="col-md-6 staff-current <?php echo okr_html_entity_decode($hide_check = $department_edit != "0" ? "hide" : ""); ?> <?php echo okr_html_entity_decode($type_check = $type_edit == 3 ? "hide" : ""); ?>">
			<?php echo render_select('person_assigned', $staffs, array('staffid', array('firstname', 'lastname')), 'person_assigned', $person_assigned); ?>
		</div>
		<div class="col-md-6 department-current <?php echo okr_html_entity_decode($hide_check = $department_edit != "0" ? "" : "hide"); ?> <?php echo okr_html_entity_decode($type_check = $type_edit == 3 ? "hide" : ""); ?>">
			<?php echo render_select('department', $department, array('departmentid', array('name')), 'department', $department_edit); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?php echo render_select('okr_superior', $okrs, array('id', 'your_target', 'sub_name'), 'okr_superior', $okr_superior, ['onchange' => 'get_select_key_result();']); ?>
		</div>
		<div class="col-md-6" id="parent_kr">
			<?php echo $parent_key_result; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group" app-field-wrapper="display">
				<label for="display" class="control-label"><?php echo _l('display'); ?></label>
				<select id="display" name="display" class="selectpicker" data-width="100%" data-none-selected-text="Non selected" data-live-search="true" tabindex="-98">
					<option value="1" <?php if ($display == "1") {echo 'selected';}?>><?php echo _l('public'); ?></option>
					<option value="2" <?php if ($display == "2") {echo 'selected';}?>><?php echo _l('private'); ?></option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
		<?php echo render_select('okr_cross[]', $okrs, array('id', array('your_target')), 'okr_cross', $okr_cross, array("multiple" => '')); ?>
		</div>
	</div>
	<div class="row">
	<div class="col-md-12">
		<h4><?php echo _l('key_results'); ?></h4>
		<div class="list">
	  		<?php if (!isset($okrs_edit)) {?>
		    <div id="item">
		    	<div class="row position-relative">
			    <div class="col-md-11 boder-item">
			    	<div class="col-md-4">
						<?php echo render_textarea('main_results[0]', 'main_results', '', array('rows' => 2)); ?>
			    	</div>
			    	<div class="col-md-4">
						<?php echo render_input('target[0]', 'target', '', 'number'); ?>
			    	</div>
			    	<div class="col-md-4">
						<?php echo render_select('unit[0]', $unit, array('id', array('unit')), 'unit'); ?>
			    	</div>
			    	<div class="col-md-12">
						<?php echo render_textarea('plan[0]', 'plan'); ?>
			    	</div>
			    	<div class="col-md-12">
						<?php echo render_textarea('results[0]', 'results'); ?>
			    	</div>
			    </div>
			  	<div class="col-md-1 btn_cus_clone_parent">
		          	<button name="add" class="btn new_box btn-info btn_cus_clone_children" data-ticket="true" type="button">
		          		<i class="fa fa-plus"></i>
		          	</button>
			    </div>

			    </div>
		    </div>
		    <?php } else {?>
			<?php foreach ($okrs_edit['key_results'] as $key => $key_results) {?>
				    <div id="item">
			    		<div class="row position-relative">
						    <div class="col-md-11 boder-item">
						    	<div class="col-md-4">
									<?php echo render_textarea('main_results[' . $key . ']', 'main_results', $key_results['main_results'], array('rows' => 2)); ?>
						    	</div>
						    	<div class="col-md-4">
									<?php echo render_input('target[' . $key . ']', 'target', $key_results['target'], 'number'); ?>
						    	</div>
						    	<div class="col-md-4">
									<?php echo render_select('unit[' . $key . ']', $unit, array('id', array('unit')), 'unit', $key_results['unit']); ?>
						    	</div>
						    	<div class="col-md-12">
									<?php echo render_textarea('plan[' . $key . ']', 'plan', $key_results['plan']); ?>
						    	</div>
						    	<div class="col-md-12">
									<?php echo render_textarea('results[' . $key . ']', 'results', $key_results['results']); ?>
						    	</div>
						    </div>

						  	<div class="col-md-1 btn_cus_clone_parent">
					          	<button name="add" class="btn <?php if ($key == 0) {echo 'new_box btn-info btn_cus_clone_children';} else {echo 'remove_box btn-danger btn_cus_clone_children';}?>" data-ticket="true" type="button"><i class="fa <?php if ($key == 0) {echo 'fa-plus';} else {echo 'fa-minus';}?>"></i>
					          	</button>
						    </div>
						</div>
				    </div>
		  	<?php }}?>
	  	</div>
	</div>
	</div>

	<div class="attachments_area">
		<div class="row attachments">
			<div class="attachment">
				<div class="col-md-4 mbot15">
					<div class="form-group">
						<label for="attachment" class="control-label"><?php echo _l('ticket_add_attachments'); ?></label>
						<div class="input-group">
							<input type="file" extension="<?php echo str_replace('.', '', get_option('allowed_files')); ?>" filesize="<?php echo file_upload_max_size(); ?>" class="form-control" name="attachments[0]">
							<span class="input-group-btn">
								<button class="btn btn-success add_more_attachments p8-half" data-max="<?php echo get_option('maximum_allowed_okrs_attachments'); ?>" type="button"><i class="fa fa-plus"></i></button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12" id="okrs_pv_file">
        <?php
if (isset($okrs_edit)) {
	$attachments = get_okrs_attachment($okrs_edit['object']->id);
	$file_html = '';
	if (count($attachments) > 0) {
		$file_html .= '<hr />
                        <p class="bold text-muted">' . _l('file') . '</p>';
		foreach ($attachments as $f) {
			$href_url = site_url(OKR_PATH . 'okrs_attachments/' . $f['rel_id'] . '/' . $f['file_name']) . '" download';
			if (!empty($f['external'])) {
				$href_url = $f['external_link'];
			}
			$file_html .= '<div class="mbot15 row inline-block full-width" data-attachment-id="' . $f['id'] . '">
                  <div class="col-md-8">
                     <a name="preview-okrs-btn" onclick="preview_okrs_btn(this); return false;" rel_id = "' . $f['rel_id'] . '" id = "' . $f['id'] . '" href="Javascript:void(0);" class="mbot10 btn btn-success pull-left" data-toggle="tooltip" title data-original-title="' . _l('preview_file') . '"><i class="fa fa-eye"></i></a>
                     <div class="pull-left"><i class="' . get_mime_class($f['filetype']) . '"></i></div>
                     <a href=" ' . $href_url . '" target="_blank" download>' . $f['file_name'] . '</a>
                     <br />
                     <small class="text-muted">' . $f['filetype'] . '</small>
                  </div>
                  <div class="col-md-4 text-right">';
			if ($f['staffid'] == get_staff_user_id() || is_admin()) {
				$file_html .= '<a href="#" class="text-danger" onclick="delete_okrs_attachment(' . $f['id'] . '); return false;"><i class="fa fa-times"></i></a>';
			}
			$file_html .= '</div></div>';
		}
		$file_html .= '<hr />';
		echo $file_html;
	}
}
?>
      </div>
	<div id="okrs_file_data"></div>

	<div class="clearfix"></div>
	<div class="modal-footer">
	  <a class="btn btn-danger" href="<?php echo admin_url('okr/okrs'); ?>" role="button"><?php echo _l('close'); ?></a>
	  <button id="sm_btn2" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
	</div>

</div>
</div>
</div>
</div>
</div>
<?php echo form_close(); ?>

<?php init_tail();?>
<?php require 'modules/okr/assets/js/create_okr_js.php';?>
</body>
</html>