<script>
(function(){
  "use strict";
  $(document).ready(function(){
      $(window).load(function(){
          if($('.entry-content.single-post-content').length > 0){
              var wrap = $('.entry-content.single-post-content');
              var dodai_post = wrap.height();
              var dodai_max = 800;
              if(dodai_post > dodai_max){
                  wrap.addClass('tooglereadmore');
                  wrap.append(function(){
                      return '<div class="readmore_postcontent"><a title="Read more" href="javascript:void(0);">Read more</a></div>';
                  });
                  $('body').on('click','.readmore_postcontent', function(){
                      wrap.removeClass('tooglereadmore');
                      $('body .readmore_postcontent').remove();
                  });
              }
          }
      });
  })
	$('.tree-move').treegrid({
        enableMove: true
    });
    $(document).ready(function(){
        $('#data').paging({limit:100});
    });


    $('.select-option').click(function(){
      var id = $(this).data('node');
	  	window.open(admin_url + 'okr/checkin_detailt/'+ id,"_self");
	 });
  	tooltip_mouseen_checkin();
    tooltip_staff();


})(jQuery);
function tooltip_mouseen_checkin(){
  "use strict";
  $('.effect8').popover({ trigger: "manual" , html: true, animation:false,placement: 'top'}).on('shown.bs.popover', function () {
        var popover = $(this);

        var contentEl = popover.next(".popover").find(".popover-content");
        // Show spinner while waiting for data to be fetched
        contentEl.html("<i class='fa fa-spinner fa-pulse fa-2x fa-fw'></i>");

        var myParameter = popover.data('api-parameter');
        var data = {};
        data.id = popover.data('okr');

         $.post(admin_url+'okr/objective_show',data).done(function(response){
             response = JSON.parse(response);
              contentEl.html(response);
              var project_progress_color = '<?php echo hooks()->apply_filters('admin_project_progress_color', '#84c529'); ?>';
              var circle = $('.project-progress').circleProgress({fill: {
                 gradient: [project_progress_color, project_progress_color]
               }}).on('circle-animation-progress', function(event, progress, stepValue) {
                 $(this).find('strong.okr-percent').html(parseInt(100 * stepValue) + '<i>%</i>');
               });
             $('[name="confidence_level"]').selectpicker('refresh');
          });

    }).on("mouseenter", function () {
        var _this = this;
        $(this).popover("show");
        $(".popover").on("mouseleave", function () {
            $(_this).popover('hide');
        });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide");
            }
        }, 300);
    });
}


</script>