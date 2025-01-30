<script>
(function(){
  "use strict";
  <?php if (!isset($okrs_edit)) {?>
    $('.staff-current').removeClass("hide");
    $('.department-current').addClass('hide');
    $('select[name="department"]').val('').change();
  <?php }?>

})(jQuery);

function get_select_key_result(){
  jQuery.ajaxSetup({
        async: false
    });
    var d = $.post(admin_url + 'okr/get_select_key_result_html', {
        okr_id: $('#okr_superior').val(),
    });
    jQuery.ajaxSetup({
        async: true
    });
    d.done(function(output){
      $('#parent_kr').html(output);
      init_selectpicker();
        return true;
    });
}
</script>