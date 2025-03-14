<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>


<div id="wrapper">
 <div class="content">
  <div class="row">
   <div class="col-md-12" id="small-table">
    <div class="panel_s">
      <?php echo form_open_multipart(admin_url('fixed_equipment/goods_delivery'), array('id'=>'add_goods_delivery')); ?>
      <div class="panel-body">

        <div class="row">
         <div class="col-md-12">
          <h4 class="no-margin font-bold "><i class="fa fa-object-ungroup menu-icon" aria-hidden="true"></i> <?php echo _l($title); ?></h4>
          <hr>
        </div>
      </div>

      <?php 
      $id = '';
      $additional_discount = 0;
      $shipping_fee = 0;
      $shipping_fee_number_attr = ['min' => '0.00', 'step' => 'any'];
      if(isset($goods_delivery)){
        $id = $goods_delivery->id;
        echo form_hidden('isedit');
        $additional_discount = $goods_delivery->additional_discount;
        $shipping_fee = $goods_delivery->shipping_fee;
      }
      ?>
      <input type="hidden" name="id" value="<?php echo fe_htmldecode($id); ?>">
      <input type="hidden" name="edit_approval" value="<?php echo fe_htmldecode($edit_approval); ?>">
      <input type="hidden" name="save_and_send_request" value="false">
      <input type="hidden" name="additional_discount" value="<?php echo fe_htmldecode($additional_discount); ?>">

      <!-- start -->
      <div class="row" >
        <div class="col-md-12">
         <div class="row">

          <div class="col-md-6">
            <?php $goods_delivery_code = isset($goods_delivery)? $goods_delivery->goods_delivery_code: (isset($goods_code) ? $goods_code : '');?>
            <?php echo render_input('goods_delivery_code', 'document_number',$goods_delivery_code,'',array('disabled' => 'true')) ?>
          </div>

          <div class="col-md-3">
            <?php $date_c = isset($goods_delivery) ? $goods_delivery->date_c : $current_day ;?>
            <?php $disabled=[]; ?>

            <?php if($edit_approval == 'true'){ 
              $disabled['disabled'] = 'true' ;
            } ?>
            <?php echo render_date_input('date_c','accounting_date', _d($date_c), $disabled) ?>

          </div>
          <div class="col-md-3">
            <?php $date_add = isset($goods_delivery) ? $goods_delivery->date_add : $current_day ;?>
            <?php echo render_date_input('date_add','day_vouchers', _d($date_add), $disabled) ?>
          </div>

          <br>

          <div class="col-md-6 <?php if($pr_orders_status == false || get_warehouse_option('goods_delivery_required_po') == 0){ echo 'hide';} ;?>" >
            <div class="form-group">
             <label for="pr_order_id"><?php echo _l('reference_purchase_order'); ?></label>
             <select onchange="pr_order_change(this); return false;" name="pr_order_id" id="pr_order_id" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>" <?php if($edit_approval == 'true'){ echo 'disabled';} ; ?> >
              <option value=""></option>
              <?php foreach($pr_orders as $pr_order) { ?>
                <option value="<?php echo fe_htmldecode($pr_order['id']); ?>" <?php if(isset($goods_delivery) && ($goods_delivery->pr_order_id == $pr_order['id'])){ echo 'selected' ;} ?>><?php echo fe_htmldecode($pr_order['pur_order_number'].' - '.$pr_order['pur_order_name']); ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-6 hide">
         <div class="form-group">
          <label for="invoice_id"><?php echo _l('invoices'); ?></label>
          <select onchange="invoice_change(this); return false;" name="invoice_id" id="invoice_id" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>" <?php if($edit_approval == 'true'){ echo 'disabled';} ; ?> >
            <option value=""></option>
            <?php foreach($invoices as $invoice) { ?>
              <option value="<?php echo fe_htmldecode($invoice['id']); ?>" <?php if(isset($goods_delivery) && $goods_delivery->invoice_id == $invoice['id']){ echo 'selected'; } ?>><?php echo format_invoice_number($invoice['id']).' - '.$invoice['company'].' - '.$invoice['name']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="col-md-3">

        <div class="form-group">
          <label for="customer_code"><?php echo _l('customer_name'); ?></label>
          <select name="customer_code" id="vendor" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>" <?php if($edit_approval == 'true'){ echo 'disabled';} ; ?>  >
            <option value=""></option>
            <?php foreach($customer_code as $s) { ?>
              <option value="<?php echo fe_htmldecode($s['userid']); ?>" <?php if(isset($goods_delivery) && $goods_delivery->customer_code == $s['userid']){ echo 'selected'; } ?>><?php echo fe_htmldecode($s['company']); ?></option>
            <?php } ?>
          </select>
        </div>

      </div>


      <div class="col-md-3">
        <?php $to = (isset($goods_delivery) ? $goods_delivery->to_ : '');
        echo render_input('to_','receiver',$to, '',$disabled) ?>
      </div>
      <div class="col-md-3">
        <?php $address = (isset($goods_delivery) ? $goods_delivery->address : '');
        echo render_input('address','fe_address',$address,'', $disabled) ?>
      </div>

      <div class=" col-md-3">
        <div class="form-group">
          <label for="staff_id" class="control-label"><?php echo _l('salesman'); ?></label>
          <select name="staff_id" class="selectpicker" id="staff_id" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" <?php if($edit_approval == 'true'){ echo 'disabled';} ; ?>> 
            <option value=""></option> 
            <?php foreach($staff as $s){ ?>
              <option value="<?php echo fe_htmldecode($s['staffid']); ?>" <?php if(isset($goods_delivery) && $goods_delivery->staff_id == $s['staffid']){ echo 'selected' ;} ?>> <?php echo fe_htmldecode($s['firstname']).''.fe_htmldecode($s['lastname']); ?></option>                  
            <?php }?>
          </select>
        </div>
      </div>

      <div class="col-md-3 form-group" >
        <?php $invoice_no = (isset($goods_delivery) ? $goods_delivery->invoice_no : '');
        echo render_input('invoice_no','invoice_no',$invoice_no, '',$disabled) ?>
      </div>
      <div class="col-md-3"></div>
      <div class="col-md-3 hide">
        <a href="#" class="pull-right display-block input_method"><i class="fa fa-question-circle skucode-tooltip"  data-toggle="tooltip" title="" data-original-title="<?php echo _l('goods_delivery_warehouse_tooltip'); ?>"></i></a>

        <div class="form-group">
          <label for="warehouse_id"><?php echo _l('warehouse_name'); ?></label>
          <select name="warehouse_id" id="warehouse_id" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>" <?php if($edit_approval == 'true'){ echo 'disabled';} ; ?> >

            <option value=""></option>
            <?php foreach($warehouses as $wh_value) { ?>
              <option value="<?php echo fe_htmldecode($wh_value['warehouse_id']); ?>" <?php if(isset($goods_delivery) && $goods_delivery->warehouse_id == $wh_value['warehouse_id']){ echo 'selected'; } ?>><?php echo ($wh_value['warehouse_name']); ?></option>
            <?php } ?>
          </select>
        </div>
      </div>


    </div>


  </div>

</div>

</div>

<div class="panel-body mtop10 invoice-item">
  <div class="row">
    <div class="col-md-4">
      <?php $this->load->view('fixed_equipment/warehouses/includes/item_select'); ?>
    </div>
    <div class="col-md-8 text-right">

    </div>
  </div>

  <div class="table-responsive s_table ">
    <table class="table invoice-items-table items table-main-invoice-edit has-calculations no-mtop">
      <thead>
        <tr>
          <th></th>
          <th width="20%" align="left"><i class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" data-title="<?php echo _l('item_description_new_lines_notice'); ?>"></i> <?php echo _l('invoice_table_item_heading'); ?></th>
          <th width="15%" align="left"><?php echo _l('warehouse_name'); ?></th>
          <th width="10%" align="right" class="available_quantity"><?php echo _l('fe_available_quantity'); ?></th>
          <th width="10%" align="right" class="qty"><?php echo _l('fe_quantity'); ?></th>
          <th width="10%" align="right"><?php echo _l('rate'); ?></th>
          <th width="12%" align="right"><?php echo _l('invoice_table_tax_heading'); ?></th>
          <th width="10%" align="right"><?php echo _l('subtotal'); ?></th>
          <th width="7%" align="right"><?php echo _l('discount'); ?></th>
          <th width="10%" align="right"><?php echo _l('discount(money)'); ?></th>
          <th width="10%" align="right"><?php echo _l('total_money'); ?></th>

          <th align="center"></th>
          <th align="center"><i class="fa fa-cog"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php echo fe_htmldecode($goods_delivery_row_template); ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-8 col-md-offset-4">
    <table class="table text-right">
      <tbody>
        <tr id="subtotal">
          <td><span class="bold"><?php echo _l('subtotal'); ?> :</span>
          </td>
          <td class="wh-subtotal">
          </td>
        </tr>
        <tr id="total_discount">
          <td><span class="bold"><?php echo _l('total_discount'); ?> :</span>
          </td>
          <td class="wh-total_discount">
          </td>
        </tr>
        <tr id="wh_shipping_fee">
          <td><span class="bold"><?php echo _l('wh_shipping_fee'); ?> :</span>
          </td>
          <td class="wh-shipping_fee" width="30%">
            <?php echo render_input('shipping_fee','',$shipping_fee, 'number', $shipping_fee_number_attr); ?>
          </td>
        </tr>
        <tr id="totalmoney">
          <td><span class="bold"><?php echo _l('total_money'); ?> :</span>
          </td>
          <td class="wh-total">
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="removed-items"></div>
</div>


<div class="row">
  <div class="col-md-12 mtop15">
   <div class="panel-body bottom-transaction">

    <?php $description = (isset($goods_delivery) ? $goods_delivery->description : ''); ?>
    <?php echo render_textarea('description','note_',$description,array(),array(),'mtop15'); ?>


    <div class="btn-bottom-toolbar text-right">
      <a href="<?php echo admin_url('warehouse/manage_delivery'); ?>"class="btn btn-default text-right mright5"><?php echo _l('close'); ?></a>
      <a href="javascript:void(0)"class="btn btn-info pull-right mright5 add_goods_delivery" ><?php echo _l('save'); ?></a>
    </div>
  </div>
  <div class="btn-bottom-pusher"></div>
</div>
</div>


</div>




</div>
<?php echo form_close(); ?>
</div>
</div>
</div>
</div>
</div>
<div id="modal_wrapper"></div>
<div id="change_serial_modal_wrapper"></div>

<?php init_tail(); ?>
<?php require 'modules/fixed_equipment/assets/js/warehouses/goods_delivery_js.php'; ?>
</body>
</html>



