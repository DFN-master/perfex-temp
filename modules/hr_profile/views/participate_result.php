<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-8 col-md-offset-2 survey">
	<div class="row">
		<?php 
		$training_program_point = $training_result['training_program_point'];
		$staff_training_result = $training_result['staff_training_result'];
		$result_data = $training_result['result_data'];

			$_point = $training_program_point.'/'.$staff_training_result[0]['total_question_point'];
		 ?>
		<div class="col-md-12">
			<div id="company-logo">
				<?php get_company_logo(); ?>
			</div>
			<h2 class="bold"><?php echo new_html_entity_decode($training->subject); ?></h2>
			<h2 class="bold"><?php echo new_html_entity_decode($training_result['staff_name']) ; ?>:<?php echo new_html_entity_decode($_point) ?></h2>
			<hr />
			<p><?php echo new_html_entity_decode($training->viewdescription); ?></p>
			<?php if(count($training->questions) > 0){
				$question_area = '<ul class="list-unstyled mtop25">';
				foreach($training->questions as $question){

					$true_false_text='';
					if(isset($result_data[$question['questionid']])){

						$flag_check_correct = true;

						if(count($result_data[$question['questionid']]['array_id_correct']) == count($result_data[$question['questionid']]['form_results'])){

							foreach ($result_data[$question['questionid']]['array_id_correct'] as $correct_key => $correct_value) {
								if(!in_array($correct_value, $result_data[$question['questionid']]['form_results'])){
									$flag_check_correct = false;
								}
							}
						}else{
							$flag_check_correct = false;
						}
						if($flag_check_correct == true){
							$true_false_text .='<a href="#" class="pull-left checkbox_true_false "><i class="fa fa-check text-success"></i></a>';

						}else{
							$true_false_text .='<a href="#" class="pull-left checkbox_true_false "><i class="fa fa-remove text-danger"></i></a>';

						}

					}


					$question_area .= '<li>';
					$question_area .= '<div class="form-group">';
					$question_area .= $true_false_text.'<label class="control-label" for="'.$question['questionid'].'">'.$question['question'].  ' ( Point:'.$question['point'].')</label>';
					if($question['boxtype'] == 'textarea'){
						$question_area .= '<textarea class="form-control" rows="6" name="question['.$question['questionid'].'][]" data-for="'.$question['questionid'].'" id="'.$question['questionid'].'" data-required="'.$question['required'].'"></textarea>';
					} else if($question['boxtype'] == 'checkbox' || $question['boxtype'] == 'radio'){
						$question_area .= '<div class="row box chk" data-boxid="'.$question['boxid'].'">';


						foreach($question['box_descriptions'] as $box_description){

							//TODO
							$checked = '';
							if(isset($result_data[$question['questionid']])){
								if(in_array($box_description['questionboxdescriptionid'], $result_data[$question['questionid']]['form_results'])){
									$checked = 'checked';
								}
							}

							$quetion_correct_class='';
							if($box_description['correct'] == 0){
								$quetion_correct_class .= 'quetion-correct';
							}

							
							$question_area .= '<div class="col-md-12">';
							$question_area .= ' <div class="'.$question['boxtype'].' '.$question['boxtype'].'-default">';
							$question_area .=
							'<input type="'.$question['boxtype'].'" data-for="'.$question['questionid'].'"
							name="selectable['.$question['boxid'].']['.$question['questionid'].'][]" value="'.$box_description['questionboxdescriptionid'].'" data-required="'.$question['required'].'" id="chk_'.$question['boxtype'].'_'.$box_description['questionboxdescriptionid'].'" '.$checked.'/>';
							$question_area .= '
							<label for="chk_'.$question['boxtype'].'_'.$box_description['questionboxdescriptionid'].'" class="'.$quetion_correct_class.'">
							'.$box_description['description'].'
							</label>';
							$question_area .= '</div>';
							$question_area .= '</div>';
						}
						 // end box row
						$question_area .= '</div>';
					} else {
						$question_area .= '<input type="text" data-for="'.$question['questionid'].'" class="form-control" name="question['.$question['questionid'].'][]" id="'.$question['questionid'].'" data-required="'.$question['required'].'">';
					}
					$question_area .= '</div>';
					$question_area .= '<hr /></li>';
				}
				$question_area .= '</ul>';
				echo new_html_entity_decode($question_area); ?>
				
			<?php } else { ?>
				<p class="no-margin text-center bold mtop20"><?php echo _l('hr_survey_no_questions'); ?></p>
			<?php } ?>
		</div>
	</div>
</div>
</div>

<?php 
require('modules/hr_profile/assets/js/training/participate_js.php');
?>