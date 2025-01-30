<?php defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$file_header = array();
$file_header[] = _l('your_target');
$file_header[] = _l('circulation');
$file_header[] = _l('type');
$file_header[] = _l('department');
$file_header[] = _l('person_assigned');
$file_header[] = _l('category');
$file_header[] = _l('display');
$file_header[] = _l('main_results');
$file_header[] = _l('target');
$file_header[] = _l('unit');
$file_header[] = _l('okr_superior');
$file_header[] = _l('parent_key_result');
$file_header[] = _l('plan');
$file_header[] = _l('results');

?>

<?php init_head();?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
            <div id ="dowload_file_sample">


            </div>

            <?php if (!isset($simulate)) {
	?>
            <ul>
              <li class="text-danger">1. <?php echo _l('import_file_note_1'); ?></li>
              <li class="text-danger">2. <?php echo _l('import_file_note_2'); ?></li>
            </ul>
            <div class="table-responsive no-dt">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <?php
$total_fields = 0;

	for ($i = 0; $i < count($file_header); $i++) {
		if ($i == 0 || $i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 7 || $i == 8) {
			?>
                          <th class="bold"><span class="text-danger">*</span> <?php echo okr_html_entity_decode($file_header[$i]) ?> </th>
                          <?php
} else {
			?>
                          <th class="bold"><?php echo okr_html_entity_decode($file_header[$i]) ?> </th>

                          <?php

		}
		$total_fields++;
	}

	?>

                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i = 0; $i < 1; $i++) {
		echo '<tr>';
		for ($x = 0; $x < count($file_header); $x++) {
			echo '<td>- </td>';
		}
		echo '</tr>';
	}
	?>
                  </tbody>
                </table>
              </div>
              <hr>

              <?php }?>

            <div class="row">
              <div class="col-md-4">
               <?php echo form_open_multipart(admin_url('okr/import_okr_data'), array('id' => 'import_form')); ?>
                    <?php echo form_hidden('leads_import', 'true'); ?>
                    <?php echo render_input('file_csv', 'choose_excel_file', '', 'file'); ?>

                    <div class="form-group">
                      <button id="uploadfile" type="button" class="btn btn-info import" onclick="return uploadfilecsv(this);" ><?php echo _l('import'); ?></button>
                    </div>
                <?php echo form_close(); ?>
              </div>
              <div class="col-md-8">
                <div class="form-group" id="file_upload_response">

                </div>

              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- box loading -->
      <div id="box-loading">

      </div>

    </div>
  </div>
</div>
<?php init_tail();?>

<?php require 'modules/okr/assets/js/import_excel_okr_js.php';?>
</body>
</html>
