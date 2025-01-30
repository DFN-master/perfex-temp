<?php
$achieved = [];
$progress_m = [];
$confidence_level = [];
$answer = [];
$evaluation_criterias = [];
$upcoming_checkin = '';
$checked = '';
$comment = [];
$date_format = get_option('dateformat');
$date_format = explode('|', $date_format);
$date_format = $date_format[0];
if (count($key_result_checkin) > 0) {
	foreach ($key_result_checkin as $key => $value) {
		$achieved[] = $value['achieved'];
		$progress_m[] = $value['progress'];
		$confidence_level[] = $value['confidence_level'];
		$answer[] = json_decode($value['answer']);
		$evaluation_criterias[] = $value['evaluation_criteria'];
		$comment[] = $value['comment'];
		$date_checkin = date($date_format, strtotime($value['upcoming_checkin']));
		if ($value['complete_okrs'] == 1) {
			$checked = 'checked';
		}
	}
} else {
	foreach ($get_key_result as $key => $value) {
		$achieved[] = '';
		$progress_m[] = 0;
		$confidence_level[] = '';
		$answer[] = json_decode('');
		$evaluation_criterias[] = '';
		$comment[] = '';
		$upcoming_checkin = '';
	}
}
?>


<?php 
$disable = 'disabled';
if ($checkin_main->approval_status != 3) {
	if (has_permission('okr', '', 'create') || is_admin() || in_array(get_staff_user_id(), $staff_apply)) { 
		$disable = '';
	}
}
?>


<div class="checkin">

	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<h4><?php echo _l('objective'); ?> : <a href="<?php echo admin_url('okr/show_detail_node/' . $id); ?>"><?php echo okr_html_entity_decode($name); ?></a></h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4><?php echo _l('circulation'); ?> : <?php echo isset($circulation) ? okr_html_entity_decode($circulation->name_circulation) : ''; ?></h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4><?php echo _l('checkin_date'); ?> : <?php echo okr_html_entity_decode($date_checkin); ?></h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 position-relative">
					<h4><?php echo _l('progress'); ?> </h4>
					<div id="jq"
					line-progressbar
					data-percentage="<?php echo okr_html_entity_decode($progress); ?>"
					data-progress-color="#1abc9c">
				</div>
			</div>
		</div>

	</div>
	<div class="col-md-6" class="border_gray">
		<figure class="highcharts-figure">
			<div id="container"></div>
		</figure>
	</div>
</div>
<div class="row">
	<?php echo form_hidden('display', 'checkin'); ?>
	<?php echo form_hidden('circulation_from', _d($circulation->from_date)); ?>
	<?php echo form_hidden('circulation_to', _d($circulation->to_date)); ?>
	<?php echo form_hidden('special_characters', $special_characters); ?>
	<?php echo form_open_multipart(admin_url('okr/add_check_in'), array('id' => 'form_add_check_in')); ?>
	<?php echo form_hidden('type', $checkin_main->type); ?>
	<?php echo form_hidden('id', $id); ?>
	<?php echo form_hidden('recently_checkin', $date_checkin); ?>

	<div id="table-scroll" class="table-scroll">
		<div class="table-wrap">
			<table class="table table-custom main-table">
				<tr>
					<th class="fixed-side text-center"><?php echo _l('key_results'); ?></th>
					<th class="text-center"><?php echo _l('target'); ?></th>
					<th class="text-center"><?php echo _l('achieved'); ?></th>
					<th class="text-center"><?php echo _l('progress'); ?></th>
					<th class="text-center"><?php echo _l('confidence_level'); ?></th>
					<?php if ($count_question > 0) {
						foreach ($question as $key => $value) {?>
							<th class="not-fixed-side" class="text-center"><?php echo _l('question') . ' ' . ($key + 1); ?>  </th>
						<?php }}?>
						<th class="text-center"><?php echo _l('feedback_management'); ?></th>
					</tr>
					<?php if (count($get_key_result) > 0) {
						foreach ($get_key_result as $key => $value) {
							?>

							<tr data-key-result="<?php echo okr_html_entity_decode($value['id']); ?>">
								<?php echo form_hidden('rs_id[' . $key . ']', $value['id']); ?>
								<td class="main_results fixed-side vertical-align-middle">
									<div class="">
										<div class="row">
											<div class="col-md-12 ks_style">
												<?php echo okr_html_entity_decode($value['main_results']); ?>
												<?php echo form_hidden('main_results[' . $key . ']', $value['main_results']); ?>
											</div>
										</div>
										<div class="row" style="padding-left: 10px;padding-right: 10px;">
											<div class="col-md-6 btn-info popovers" style="cursor: pointer;" data-placement="top" data-content="<?php echo okr_html_entity_decode($value['plan']) ?>" data-original-title="<?php echo _l('plan') ?>" ><?php echo _l('plan'); ?></div>

											<div class="col-md-6 btn-warning popovers" style="cursor: pointer;" data-placement="top" data-content="<?php echo okr_html_entity_decode($value['results']) ?>" data-original-title="<?php echo _l('results') ?>"><?php echo _l('results_lable'); ?></div>
										</div>
									</div>
								</div>
								<div class="row">
									<h5 class="">
										<span class="label label-default task_add">+</span>
										<span class="label label-default task_list_view_rs"><i class="fa fa-eye" aria-hidden="true"></i></span>
									</h5>
								</div>
							</td>

							<td  class="fixed-side vertical-align-middle">
								<div class="target text-center">

									<?php echo form_hidden('target[' . $key . ']', $value['target']); ?>
									<span><?php echo app_format_money($value['target'], ""); ?></span>
									<span ><?php echo okr_html_entity_decode(unit_name($value['unit'])); ?></span>
									<?php echo form_hidden('unit[' . $key . ']', $value['unit']); ?>
								</div>
							</td>


							<td  class="not-fixed-side vertical-align-middle">
								<div class="achieved">
									<?php $achieved_ = (isset($achieved[$key]) ? $achieved[$key] : 0);?>
									<div class="form-group" app-field-wrapper="achieved[<?php echo okr_html_entity_decode($key); ?>]">
										<input type="text" onkeyup="formatCurrency($(this));" onblur="formatCurrency($(this), 'blur');" id="achieved" name="achieved[<?php echo okr_html_entity_decode($key); ?>]" class="form-control"  data-key="<?php echo okr_html_entity_decode($key); ?>" data-min="0" data-max="<?php echo okr_html_entity_decode($value['target']); ?>" value="<?php echo okr_html_entity_decode($achieved_); ?>" <?php echo okr_html_entity_decode($disable); ?> required>
									</div>
									<span class="symbol"><?php echo okr_html_entity_decode(unit_name($value['unit'])); ?></span>
								</div>
							</td>
							<?php $progress_m_ = (isset($progress_m[$key]) ? $progress_m[$key] : 0);?>
							<?php echo form_hidden('progress[' . $key . ']', $progress_m_); ?>
							<td id="progress_m_<?php echo okr_html_entity_decode($key); ?>" class="not-fixed-side vertical-align-middle">
								<div name="progress[<?php echo okr_html_entity_decode($key); ?>]" class="checkin-progress relative" data-value="<?php echo okr_html_entity_decode($progress_m_ / 100); ?>" data-size="55" data-thickness="5">
									<strong class="okr-percent"></strong>
								</div>
							</td>
							<?php $confidence_level_ = (isset($confidence_level[$key]) ? $confidence_level[$key] : '');?>

							<td class="not-fixed-side vertical-align-middle">
								<div class="default">
									<div class="is_fine">
										<label>
											<input type="radio" name="confidence_level[<?php echo okr_html_entity_decode($key); ?>]" value="1" <?php if ($confidence_level_ == 1) {echo 'checked';}?> <?php echo okr_html_entity_decode($disable); ?> ><span> <?php echo _l('is_fine') ?></span>
										</label>
									</div>
									<div class="not_so_good">
										<label>
											<input type="radio"  name="confidence_level[<?php echo okr_html_entity_decode($key); ?>]" value="2" <?php if ($confidence_level_ == 2) {echo 'checked';}?> <?php echo okr_html_entity_decode($disable); ?> ><span class=""> <?php echo _l('not_so_good') ?></span>
										</label>
									</div>
									<div class="very_good">
										<label>
											<input type="radio" name="confidence_level[<?php echo okr_html_entity_decode($key); ?>]" value="3" <?php if ($confidence_level_ == 3) {echo 'checked';}?> <?php echo okr_html_entity_decode($disable); ?> > <span> <?php echo _l('very_good') ?></span>
										</label>
									</div>
								</div>
							</td>

							<?php if ($count_question > 0) {
								foreach ($question as $k => $v) {
									?>

									<td class="not-fixed-side vertical-align-middle"><?php echo okr_html_entity_decode($v['question']); ?>?
										<?php $value_ = (isset($answer[$key][$k]) ? $answer[$key][$k] : '');
										$arr_atr = array('class' => 'question');
										if($disable != ''){
											$arr_atr = array('class' => 'question', 'disabled' => 'true');
										}

										echo render_textarea('answer[' . $key . '][' . $k . ']', '', $value_, $arr_atr);?>
									</td>
								<?php }}?>


								<td class="not-fixed-side vertical-align-middle">
									<?php $evaluation_criterias_ = (isset($evaluation_criterias[$key]) ? $evaluation_criterias[$key] : '');?>
									<?php $comment_ = (isset($comment[$key]) ? $comment[$key] : '');?>

									<?php

									$arr_atr_select = array();
										if($disable != ''){
											$arr_atr_select = array('class' => 'question', 'disabled' => 'true');
										}
									if (isset($evaluation_criteria) && count($evaluation_criteria) > 0) {
										echo _l('score_estimate');
										echo render_select('evaluation_criteria[' . $key . ']', $evaluation_criteria, array('id', 'name', 'scores'), '', $evaluation_criterias_, $arr_atr_select);
									}
									?>
									<?php $arr_atr = ['rows' => 4, 'cols' => 100, 'class' => 'question'];
										if($disable != ''){
											$arr_atr = ['rows' => 4, 'cols' => 100, 'class' => 'question', 'disabled' => 'true'];
										}
									echo render_textarea('comment[' . $key . ']', 'comment', $comment_, $arr_atr); ?>
								</td>

							</tr>
						<?php }
					} else {echo '<tr><td colspan="' . ($count_question + 6) . '"></td></tr>';}?>
				</table>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4">
				<?php ?>
				<?php if ($checked == '' && $disable == '') {echo render_date_input('upcoming_checkin', 'upcoming_checkin');}?>
			</div>
		</div>
		<div class="attachments_area">
			<div class="row attachments">
				<div class="attachment">
					<div class="col-md-4 mbot15">
						<div class="form-group">
							<label for="attachment" class="control-label"><?php echo _l('ticket_add_attachments'); ?></label>
							<div class="input-group">
								<input type="file" extension="<?php echo str_replace('.', '', get_option('allowed_files')); ?>" filesize="<?php echo file_upload_max_size(); ?>" class="form-control" name="attachments[0]" <?php echo okr_html_entity_decode($disable); ?> >
								<span class="input-group-btn">
									<button class="btn btn-success add_more_attachments p8-half" data-max="<?php echo get_option('maximum_allowed_okrs_attachments'); ?>" type="button" <?php echo okr_html_entity_decode($disable); ?>><i class="fa fa-plus" ></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="modal-footer">
				<div class="checkbox checkbox-primary pull-left">
					<input id="complete_okrs" name="complete_okrs" type="checkbox" <?php echo okr_html_entity_decode($checked); ?>  <?php echo okr_html_entity_decode($disable); ?>>
					<label for="complete_okrs">
						<?php echo _l('complete_okrs'); ?>
					</label>
				</div>
				<a class="btn btn-danger" href="<?php echo admin_url('okr/checkin'); ?>" role="button"><?php echo _l('close'); ?></a>
				<?php if ($checkin_main->approval_status != 3) {?>
					<?php if (has_permission('okr', '', 'create') || is_admin() || in_array(get_staff_user_id(), $staff_apply)) {?>
						<button id="sm_btn1" type="submit" class="btn btn-default"><?php echo _l('save_draft'); ?></button>
						<button id="sm_btn2" type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
					<?php }?>
				<?php }?>
				
			</div>
			<div class="col-md-4">
				<?php
				if (isset($choose_when_approving)) {
					if (count($data_approve) > 0) {
						if ($choose_when_approving == 1) {
							echo render_select('approver', $staffs_approval, array('staffid', array('firstname', 'lastname')), 'approver', [], array(), [], 'hide');
						}
					} else {
						if ($choose_when_approving == 1) {
							echo render_select('approver', $staffs_approval, array('staffid', array('firstname', 'lastname')), 'approver', [], array(), [], '');
						}
					}
				}
				?>
			</div>
		</div>
		<?php echo form_close(); ?>
		<div class="row">
			<div class="project-overview-right">
				<div class="project-overview-right">
					<?php if (count($data_approve) > 0) {
						?>
						<div class="row">
							<div class="col-md-12 p-5 text-right">
							</div>

							<div class="col-md-12 project-overview-expenses-finance">
								<br>
								<div class="clearfix"></div>
								<?php
								$has_deny = false;
								$current_approve = false;
								foreach ($data_approve as $value) {
									?>
									<div class="col-md-4 approve_parent">
										<p class="text-uppercase text-muted no-mtop bold">
											<?php
											echo get_staff_full_name($value['staffid']);
											?></p>
											<?php if ($value['approve'] == 1) {
												?>
												<img src="<?php echo base_url(OKR_IMAGE_PATH . '/approved.png'); ?>" class="approve_child_top">
												<br><br>
												<p class="bold text-center"><?php echo okr_html_entity_decode($value['note']); ?></p>
												<p class="bold text-center text-<?php if ($value['approve'] == 1) {echo 'success';} elseif ($value['approve'] == 2) {echo 'danger';}?>"><?php echo _dt($value['date']); ?>
											<?php } elseif ($value['approve'] == 2) {$has_deny = true;?>
												<img src="<?php echo base_url(OKR_IMAGE_PATH . '/rejected.png'); ?>" class="approve_child_top">
												<br><br>
												<p class="bold text-center"><?php echo $value['note']; ?></p>
												<p class="bold text-center text-<?php if ($value['approve'] == 1) {echo 'success';} elseif ($value['approve'] == 2) {echo 'danger';}?>"><?php echo _dt($value['date']); ?>
											<?php } else {
												if ($current_approve == false && $has_deny == false) {
													$current_approve = true;
													if (get_staff_user_id() == $value['staffid']) {
														?>
														<div class="row d-flex justify-content-center" >
															<a href="#" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo _l('approve'); ?><span class="caret"></span></a>
															<ul class="dropdown-menu dropdown-menu-left approve_child_bottom">
																<li>
																	<div class="col-md-12">
																		<?php echo render_textarea('reason', 'reason'); ?>
																	</div>
																</li>
																<li>
																	<div class="row text-center col-md-12">
																		<a
																		href="#"
																		data-loading-text="<?php echo _l('wait_text'); ?>"
																		onclick="approve_request(<?php echo okr_html_entity_decode($id); ?>); return false;"
																		class="btn btn-success approve_request">
																		<?php echo _l('approve'); ?>
																	</a>
																	<a
																	href="#"
																	data-loading-text="<?php echo _l('wait_text'); ?>"
																	onclick="deny_request(<?php echo okr_html_entity_decode($id); ?>); return false;"
																	class="btn btn-warning"><?php echo _l('deny'); ?>
																</a>
															</div>
														</li>
													</ul>
												</div>
												<?php
											}
										}
									}?>
								</p>
							</div>
							<?php
						}?>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal_preview" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
			</div>
		</div>

	</div>
</div>

<div id="add-task-key-result" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo _l('add_task_key_result') ?></h4>
			</div>
			<?php echo form_open(admin_url('okr/update_key_result_with_task'), array('id' => 'form_add_task')); ?>
			<div class="modal-body">
				<?php echo form_hidden('id'); ?>
				<?php echo form_hidden('okrs_id', $id); ?>
				<?php
				echo render_select('tasks[]', $tasks, array('id', array('name')), 'task_key_result', [], array('multiple' => true), [], '');
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
			</div>
			<?php echo form_close(); ?>
		</div>
		

	</div>
</div>
<!-- Modal -->
<div id="add-task-view-key-result" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo _l('view') ?></h4>
			</div>
			<div class="modal-body">
				<?php echo form_hidden('list_tasks'); ?>
				<?php echo form_hidden('key_result'); ?>
				<table class="table table-task-list scroll-responsive">
					<thead>
						<th>#</th>
						<th><?php echo _l('tasks_dt_name'); ?></th>
						<th><?php echo _l('task_status'); ?></th>
						<th><?php echo _l('tasks_dt_datestart'); ?></th>
						<th><?php echo _l('task_duedate'); ?></th>
						<th><?php echo _l('task_assigned'); ?></th>
						<th><?php echo _l('tasks_list_priority'); ?></th>
					</thead>
					<tbody></tbody>
					<tfoot>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tfoot>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
			</div>
		</div>

	</div>
</div>
</div>

</div>