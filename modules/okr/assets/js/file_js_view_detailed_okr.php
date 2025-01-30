<script>
(function($){
  	"use strict";

    if("<?php echo $add_task; ?>" == '0'){
        $('.new-task-relation').hide();
    }
    var fnServerParams = {
        "id_s" : '[name="id"]'
    }
    initDataTable('.table-history', admin_url + 'okr/table_history', false, false, fnServerParams, [0, 'desc']);
})(jQuery);
</script>