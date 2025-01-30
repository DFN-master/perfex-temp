<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php init_head();?>
<div id="wrapper">
<div class="content">
<div class="panel_s">
<div class="panel-body">
    <div id="tab-okr-detail" class="horizontal-scrollable-tabs">
        <div class="horizontal-tabs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
                <li role="presentation" class="active"><a href="#detail_content" aria-controls="detail_content" role="tab" data-toggle="tab"><?php echo _l('okrs'); ?></a></li>
                <li role="presentation"><a href="#tab_tasks" onclick="init_rel_tasks_table(<?php echo okr_html_entity_decode($okrs_id); ?>,'okrs'); return false;" aria-controls="tab_tasks" role="tab" data-toggle="tab"><?php echo _l('tasks'); ?></a></li>
                <li role="presentation"><a href="#tab_checkin" onclick="init_rel_tasks_table(<?php echo okr_html_entity_decode($okrs_id); ?>,'okrs'); return false;" aria-controls="tab_checkin" role="tab" data-toggle="tab"><?php echo _l('checkin'); ?></a></li>
            </ul>
            <!-- Tab panes -->
    	</div>
    </div>
    <div class="tab-content content-tabpanel">
        <div role="tabpanel" class="tab-pane active" id="detail_content">
        	<div class="clearfix"></div>
        	<div class="row mtop5">
        		<div class="col-md-3">
        			<div class="bold">
			    		<?php echo _l('your_target'); ?>
			    		<div class="pull-right">:</div>
			    	</div>
        		</div>
        		<div class="col-md-9">
			    	<?php echo okr_html_entity_decode($your_target); ?>
        		</div>
        	</div>
        	<?php if (isset($parent_okr)) {?>
        		<div class="row mtop5">
	        		<div class="col-md-3">
	        			<div class="bold">
				    		<?php echo _l('okr_superior'); ?>
				    		<div class="pull-right">:</div>
				    	</div>
	        		</div>
	        		<div class="col-md-9">
				    	<a href="<?php echo admin_url('okr/show_detail_node/' . $parent_okr->id); ?>"><?php echo okr_html_entity_decode($parent_okr->your_target); ?></a>
	        		</div>
	        	</div>
        	<?php }?>
        	<?php if (isset($parent_key_result)) {?>
        		<div class="row mtop5">
	        		<div class="col-md-3">
	        			<div class="bold">
				    		<?php echo _l('parent_key_result'); ?>
				    		<div class="pull-right">:</div>
				    	</div>
	        		</div>
	        		<div class="col-md-9">
				    	<a href="<?php echo admin_url('okr/show_detail_node/' . $parent_okr->id); ?>"><?php echo okr_html_entity_decode($parent_key_result->main_results); ?></a>
	        		</div>
	        	</div>
        	<?php }?>
        	<div class="row mtop5">
        		<div class="col-md-3">
        			<div class="bold">
			    		<?php echo _l('circulation'); ?>
			    		<div class="pull-right">:</div>
			    	</div>
        		</div>
        		<div class="col-md-9">
			    	<?php echo okr_html_entity_decode($circulation); ?>
        		</div>
        	</div>
        	<div class="row mtop5">
        		<div class="col-md-3">
        			<div class="bold">
			    		<?php echo _l('person_in_charge'); ?>
			    		<div class="pull-right">:</div>
			    	</div>
        		</div>
        		<div class="col-md-9">
			    	<?php echo okr_html_entity_decode($person_assigned); ?>
        		</div>
        	</div>
        	<div class="row mtop5">
        		<div class="col-md-3">
        			<div class="bold">
			    		<?php echo _l('display'); ?>
			    		<div class="pull-right">:</div>
			    	</div>
        		</div>
        		<div class="col-md-9">
			    	<?php echo okr_html_entity_decode($display); ?>
        		</div>
        	</div>
        	<div class="row mtop5">
        		<div class="col-md-3">
        			<div class="bold">
			    		<?php echo _l('status'); ?>
			    		<div class="pull-right">:</div>
			    	</div>
        		</div>
        		<div class="col-md-9">
			    	<?php echo okr_html_entity_decode($status); ?>
        		</div>
        	</div>
        	<div class="row mtop5">
        		<div class="col-md-3">
        			<div class="bold">
			    		<?php echo _l('progress'); ?>
			    		<div class="pull-right">:</div>
			    	</div>
        		</div>
        		<div class="col-md-9">
			    	<?php echo okr_html_entity_decode($progress); ?>
        		</div>
        	</div>
        	<div class="row mtop5">
				<div class="col-md-12">
					 <div class="table-responsive s_table">
				         <table class="table close-shift-items-table items table-main-invoice-edit has-calculations no-mtop">
				            <thead>
				               <tr>
				                  <th width="5%" align="center">#</th>
				                  <th width="25%" align="left"><?php echo _l('main_results'); ?></th>
				                  <th width="10%" align="left"><?php echo _l('target'); ?></th>
				                  <!--<th width="10%" align="left"><?php echo _l('achieved'); ?></th>-->
				                  <th width="10%" align="left"><?php echo _l('progress'); ?></th>
				                  <th width="15%" align="left"><?php echo _l('confidence_level'); ?></th>
				                  <th width="25%" align="left"><?php echo _l('plan'); ?></th>
				                  <th width="20%" align="left"><?php echo _l('results'); ?></th>
				               </tr>
				            </thead>
				            <tbody>
				            	<?php
$count = 0;
foreach ($key_results as $kr) {
	$count++;
	$unit_text = '';
	if (!is_null($kr['unit_text'])) {
		$unit_text = ' (' . $kr['unit_text'] . ')';
	}
	$confidence_level_class = '';
	$confidence_level = '';
	if ($kr['confidence_level'] == 1) {
		$confidence_level_class = 'is_fine';
		$confidence_level = _l('is_fine');
	} else if ($kr['confidence_level'] == 3) {
		$confidence_level_class = 'very_good';
		$confidence_level = _l('very_good');
	} else {
		$confidence_level_class = 'not_so_good';
		$confidence_level = _l('not_so_good');
	}
	?>
								<tr>
								<td align="center"><?php echo okr_html_entity_decode($count); ?></td>
				            	<td><?php echo okr_html_entity_decode($kr['main_results']); ?></td>
				            	<td><?php echo okr_html_entity_decode($kr['target'] . $unit_text); ?></td>
				            	<!--<td><?php echo okr_html_entity_decode($kr['achieved'] . $unit_text); ?></td>-->
				            	<td class="view_detail_okr_progress">
				            		<?php
$progress = '0';
	if (!is_null($kr['progress'])) {
		$progress = $kr['progress'];
	}
	?>
				            		<div class="progress no-margin progress-bar-mini cus_tran">
						                <div class="progress-bar progress-bar-danger no-percent-text not-dynamic" role="progressbar" aria-valuenow="<?php echo okr_html_entity_decode($progress); ?>" aria-valuemin="0" aria-valuemax="100" style="<?php echo okr_html_entity_decode($progress . '%'); ?>" data-percent="<?php echo okr_html_entity_decode($progress); ?>">
						                </div>
						            </div>
						            <?php echo okr_html_entity_decode($progress . '%'); ?>
				            	</td>
				            	<td>
				            		<div class="default">
				                    	<div class="<?php echo $confidence_level_class; ?>">
				                    		<label>
				                    			<input type="radio" checked><span class="mleft5"><?php echo $confidence_level; ?></span>
				                    		</label>
				                    	</div>
				                    </div>
				            	</td>
				            	<td><?php echo okr_html_entity_decode($kr['plan']); ?></td>
				            	<td><?php echo okr_html_entity_decode($kr['results']); ?></td>
				            </tr>
				            	<?php }?>
				            </tbody>
				        </table>
				    </div>
				</div>
			</div>
          </div>
        <div role="tabpanel" class="tab-pane" id="tab_tasks">
 			<?php init_relation_tasks_table(array('data-new-rel-id' => $okrs_id, 'data-new-rel-type' => 'okrs'));?>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab_checkin">
 			<?php $this->load->view('checkin/history', ['id' => $okrs_id]);?>
        </div>

    </div>
</div>
</div>
</div>
</div>

<?php init_tail();?>
<?php require 'modules/okr/assets/js/file_js_view_detailed_okr.php';?>
</body>
</html>