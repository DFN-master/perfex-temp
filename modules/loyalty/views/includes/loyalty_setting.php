<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php echo form_open('loyalty/loyalty_setting',array('id'=>'loyalty_setting-form')); ?>
<div class="form-group">
  <div class="checkbox checkbox-primary">
    <input type="checkbox" id="loyalty_setting" name="loyalty_setting" <?php if(get_option('loyalty_setting') == 1 ){ echo 'checked';} ?> value="loyalty_setting">
    <label for="loyalty_setting"><?php echo _l('enable_loyalty'); ?>

    </label>
  </div>
</div>

<div class="form-group">
  <div class="checkbox checkbox-primary">
    <input type="checkbox" id="loyalty_earn_points_from_redeemable_transactions" name="loyalty_earn_points_from_redeemable_transactions" <?php if(get_option('loyalty_earn_points_from_redeemable_transactions') == 1 ){ echo 'checked';} ?> value="loyalty_setting">
    <label for="loyalty_earn_points_from_redeemable_transactions"><?php echo _l('loyalty_earn_points_from_redeemable_transactions'); ?>

    </label>
  </div>
</div>

<div class="row">
  <div class="col-md-6 form-group">
    <?php $clients_gr =  explode(',',get_option('customers_group_ids_not_use_membership_tab')); ?>
      <label for="client_group"><?php echo _l('do_not_display_the_membership_tab_for_the_following_customer_groups'); ?></label>
      <select name="client_group[]" id="client_group"  class="selectpicker"  data-live-search="true" multiple="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>" >
          <option value=""></option>
          <?php foreach($client_groups as $gr){ ?>
           <option value="<?php echo loy_html_entity_decode($gr['id']); ?>" <?php if(in_array($gr['id'], $clients_gr)){ echo 'selected'; } ?>><?php echo loy_html_entity_decode($gr['name']); ?></option>
         <?php } ?>
      </select>
  </div> 

  <div class="col-md-6 form-group">
    <?php $clients_ed =  explode(',',get_option('customers_ids_not_use_membership_tab')); ?>
      <label for="client"><?php echo _l('do_not_display_the_membership_tab_for_the_following_customers'); ?></label>
      <select name="client[]" id="client" class="selectpicker" multiple="true"  data-live-search="true" data-actions-box="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>" >
        <?php foreach($clients as $cli){ ?>
         <option value="<?php echo loy_html_entity_decode($cli['userid']); ?>" <?php if(in_array($cli['userid'], $clients_ed)){ echo 'selected'; } ?> ><?php echo loy_html_entity_decode($cli['company']); ?></option>
       <?php } ?>
     </select>
  </div>
</div>

<div class="">
	
	<button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
	<?php echo form_close(); ?>
</div>
<div class="clearfix"></div>


