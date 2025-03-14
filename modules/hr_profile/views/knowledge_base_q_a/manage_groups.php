<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper" >
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                       <div class="_buttons">
                        <?php if(has_permission('hr_manage_q_a','','create')){ ?>
                        <div class="_buttons">
                            <a href="#" onclick="new_kb_group(); return false;" class="btn btn-primary pull-left display-block">
                                <?php echo _l('new_group'); ?>
                            </a>
                            <?php } ?>
                            <a href="<?php echo admin_url('hr_profile/knowledge_base_q_a'); ?>" class="btn btn-primary pull-left display-block mleft5">
                                <?php echo _l('als_all_articles'); ?>
                            </a>
                            <div class="clearfix"></div>
                            <hr class="hr-panel-heading" />
                        </div>
                        <?php if(count($groups) > 0){ ?>
                        <table class="table dt-table scroll-responsive">
                            <thead>
                                <th><?php echo _l('group_table_name_heading'); ?></th>
                                <th><?php echo _l('group_table_isactive_heading'); ?></th>
                                <th><?php echo _l('options'); ?></th>
                            </thead>
                            <tbody>
                                <?php foreach($groups as $group){ ?>
                                <tr>
                                    <td><?php echo new_html_entity_decode($group['name']); ?> <span class="badge mleft5"><?php echo total_rows(db_prefix().'hr_knowledge_base','articlegroup='.$group['groupid']); ?></span></td>
                                    <td>
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="<?php echo new_html_entity_decode($group['groupid']); ?>" data-id="<?php echo new_html_entity_decode($group['groupid']); ?>" class="onoffswitch-checkbox" <?php if(!has_permission('hr_manage_q_a','','edit')){ echo 'disabled'; } ?> data-switch-url="<?php echo admin_url(); ?>hr_profile/knowledge_base_q_a/change_group_status" <?php if($group['active'] == 1){echo 'checked';} ?>>
                                            <label class="onoffswitch-label" for="<?php echo new_html_entity_decode($group['groupid']); ?>"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if(has_permission('hr_manage_q_a','','edit')){ ?>
                                        <a href="#" onclick="edit_kb_group(this,<?php echo new_html_entity_decode($group['groupid']); ?>); return false" data-name="<?php echo new_html_entity_decode($group['name']); ?>" data-color="<?php echo new_html_entity_decode($group['color']); ?>" data-description="<?php echo clear_textarea_breaks($group['description']); ?>" data-order="<?php echo new_html_entity_decode($group['group_order']); ?>" data-active="<?php echo new_html_entity_decode($group['active']); ?>" data-slug="<?php echo new_html_entity_decode($group['group_slug']); ?>" class="btn btn-default btn-icon"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <?php } ?>
                                        <?php if(has_permission('hr_manage_q_a','','delete')){ ?>
                                        <a href="<?php echo admin_url('hr_profile/knowledge_base_q_a/delete_group/'.$group['groupid']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } else { ?>
                        <p class="no-margin"><?php echo _l('kb_no_groups_found'); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('hr_profile/knowledge_base_q_a/group'); ?>
<?php init_tail(); ?>
</body>
</html>
