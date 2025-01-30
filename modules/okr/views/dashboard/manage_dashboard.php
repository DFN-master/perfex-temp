<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php init_head();?>
<div id="wrapper">
	<div class="content">
		<div class="panel_s">
			<div class="panel-body">
        <div class="row _buttons">
          <div class="col-md-6">
  				  <h4 class="no-margin text-bold ptop-15"><i class="fa fa-dashboard menu-icon"></i> <?php echo okr_html_entity_decode($title); ?></h4>
          </div>
          <div class="col-md-6">

          <div class="_hidden_inputs _filters _tasks_filters">
              <?php
echo form_hidden('this_week');
echo form_hidden('last_week');
echo form_hidden('this_month');
echo form_hidden('last_month');
echo form_hidden('this_quarter');
echo form_hidden('last_quarter');
echo form_hidden('this_year');
echo form_hidden('last_year');
?>
          </div>

          <div class="btn-group pull-right mleft4 btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btn_filter">
              <i class="fa fa-filter" aria-hidden="true"></i> <?php echo _l($active_type); ?>
            </button>
            <ul class="dropdown-menu width300">
              <li class="filter-group <?php echo $active_type == 'this_week' ? 'active' : ''; ?>" data-filter-group="group-date">
                  <a href="<?php echo admin_url('okr/dashboard?type=this_week'); ?>" data-cview="this_week" onclick="change_dashboard_type(this);return false;">
                      <?php echo _l('this_week'); ?>
                  </a>
              </li>
              <li class="filter-group <?php echo $active_type == 'last_week' ? 'active' : ''; ?>" data-filter-group="group-date">
                  <a href="<?php echo admin_url('okr/dashboard?type=last_week'); ?>" data-cview="last_week" onclick="change_dashboard_type(this);return false;">
                      <?php echo _l('last_week'); ?>
                  </a>
              </li>
                <li class="filter-group <?php echo $active_type == 'this_month' ? 'active' : ''; ?>" data-filter-group="group-date">
                  <a href="<?php echo admin_url('okr/dashboard?type=this_month'); ?>" data-cview="this_month" onclick="change_dashboard_type(this);return false;">
                      <?php echo _l('this_month'); ?>
                  </a>
              </li>
              <li class="filter-group <?php echo $active_type == 'last_month' ? 'active' : ''; ?>" data-filter-group="group-date">
                  <a href="<?php echo admin_url('okr/dashboard?type=last_month'); ?>" data-cview="last_month" onclick="change_dashboard_type(this);return false;">
                      <?php echo _l('last_month'); ?>
                  </a>
              </li>
              <li class="filter-group <?php echo $active_type == 'this_quarter' ? 'active' : ''; ?>" data-filter-group="group-date">
                  <a href="<?php echo admin_url('okr/dashboard?type=this_quarter'); ?>" data-cview="this_quarter" onclick="change_dashboard_type(this);return false;">
                      <?php echo _l('this_quarter'); ?>
                  </a>
              </li>
              <li class="filter-group <?php echo $active_type == 'last_quarter' ? 'active' : ''; ?>" data-filter-group="group-date">
                  <a href="<?php echo admin_url('okr/dashboard?type=last_quarter'); ?>" data-cview="last_quarter" onclick="change_dashboard_type(this);return false;">
                      <?php echo _l('last_quarter'); ?>
                  </a>
              </li>
              <li class="filter-group <?php echo $active_type == 'this_year' ? 'active' : ''; ?>" data-filter-group="group-date">
                  <a href="<?php echo admin_url('okr/dashboard?type=this_year'); ?>" data-cview="this_year" onclick="change_dashboard_type(this);return false;">
                      <?php echo _l('this_year'); ?>
                  </a>
              </li>
              <li class="filter-group <?php echo $active_type == 'last_year' ? 'active' : ''; ?>" data-filter-group="group-date">
                  <a href="<?php echo admin_url('okr/dashboard?type=last_year'); ?>" data-cview="last_year" onclick="change_dashboard_type(this);return false;">
                      <?php echo _l('last_year'); ?>
                  </a>
              </li>
              <div class="clearfix"></div>
            </ul>
          </div>
          </div>
        </div>
        <hr class="mtop-5">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-4 border-right">
            <div id="company_objective">
            </div>
          </div>
          <div class="col-md-4 border-right">
            <div id="department_objective">
            </div>
          </div>
          <div class="col-md-4 border-right">
            <div id="personal_objective">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 border-right">
            <div id="company_key_results">
            </div>
          </div>
          <div class="col-md-4 border-right">
            <div id="department_key_results">
            </div>
          </div>
          <div class="col-md-4 border-right">
            <div id="personal_key_results">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 border-right">
            <div id="company_checkin">
            </div>
          </div>
          <div class="col-md-4 border-right">
            <div id="department_checkin">
            </div>
          </div>
          <div class="col-md-4 border-right">
            <div id="personal_checkin">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- box loading -->
<div id="box-loading"></div>
<?php init_tail();?>
<?php require 'modules/okr/assets/js/dashboard_js.php';?>
</body>
</html>
