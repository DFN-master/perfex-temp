<script>
(function(){
  "use strict";
  $('.tree-move').treegrid({
    enableMove: true
  })

  // nodeTemplate main
  if(document.URL == "<?php echo admin_url('okr/okrs_chart_org'); ?>"){
    var nodeTemplate = function(data) {
        if(data.name){
          return `
               <div class="div_style">
                ${data.image}${data.title}
                </div>
                <div class="contain-main">
                  <div class="content">${data.name}</div>
                  <div class="content1">${data.dp_user_icon}</div>
                </div>
              `;
            }else{
              return `
              <div class="image-okr">
                ${data.image}
              </div>
              `;
            }
        };
        var img_dir = site_url + 'modules/okr/assets/image/okrs.jpg';
        var ds = {
         'image':'<img class="img_logo_cus" src="'+img_dir+'">' ,
         'title': '<p class="title_company"><?php echo get_option('invoice_company_name'); ?></p>',
         'name' : '',
         'department' : '',
         'children': <?php echo html_entity_decode($array_tree_chart); ?>
        };
        var oc = $('#okrs_tree').orgchart({
          'data' :ds ,
          'nodeTemplate': nodeTemplate,
          'pan': true,
          'zoom': true,
          'nodeContent': "title",
          verticalLevel: 100,
          visibleLevel: 100,
          'toggleSiblingsResp': true,
          'initCompleted': function(){

            setTimeout( function(){

              // center the chart to container
              var $container = $('#okrs_tree');
              $container.scrollLeft(($container[0].scrollWidth - $container.width())/2);

              // get "zoom" and make usable
              var $chart = $('.orgchart');
              $chart.css('transform', "scale(1,1)");
              var div = $chart.css('transform');
              var values = div.split('(')[1];
              values = values.split(')')[0];
              values = values.split(',');
              var a = values[0];
              var b = values[1];
              var currentZoom = Math.sqrt(a*a + b*b);
              var zoomval = .8;
              var default_ = currentZoom;
              // zoom buttons
              $('.zoom-in').on('click', function () {
                  zoomval = currentZoom += 0.1;
                  if(zoomval > 0){
                    $chart.css('transform', div+" scale(" + zoomval + "," + zoomval + ")");
                  }
              });
              $('.zoom-out').on('click', function () {
                  if(currentZoom > 0.2){
                    zoomval = currentZoom -= 0.1;
                    $chart.css('transform', div+" scale(" + zoomval + "," + zoomval + ")");
                  }
              });

              $('.zoom-init').on('click', function(){
                zoomval = default_;
                $chart.css('transform', div+" scale(" + zoomval + "," + zoomval + ")");
              });

              $('.zoom-range').on('change', function(){
                zoomval = this.value;
                $chart.css('transform', div+" scale(" + zoomval/100 + "," + zoomval/100 + ")");
              });

            }  , 1000 );
          }
        });
      var project_progress_color = '<?php echo hooks()->apply_filters('admin_project_progress_color', '#84c529'); ?>';
      var circle = $('.project-progress').circleProgress(
        {fill: {
         gradient: [project_progress_color, project_progress_color]
       },emptyFill: 'white'}
       ).on('circle-animation-progress', function(event, progress, stepValue) {
         $(this).find('strong.okr-percent').html(parseInt(100 * stepValue) + '<i>%</i>');
       });

  }
    tooltip_mouseen();
    //tooltip_staff();

    $('#export_okr').on('click', function() {
      var data = {};
      $.post(admin_url+'okr/export_okr', data).done(function(response){
        response = JSON.parse(response);
        window.location.href = response.site_url+response.filename;
      });
    });



})(jQuery);
function tooltip_mouseen(){
  "use strict";
  $('[data-toggle="popover"]').popover({ trigger: "manual" , html: true, animation:false,placement: 'top'}).on('shown.bs.popover', function () {
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