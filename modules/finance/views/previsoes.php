<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  <div class="_buttons">
                     <h3>Previsões</h3>
                  </div>
                  <div class="clearfix"></div>
                  <hr class="hr-panel-heading">
                  <div style="min-height:600px;">
                        <canvas style="height: 600px; width: 100%;" id="finance-chart"></canvas>
                        <input type="hidden" id="data-finance" value='<?php echo json_encode($chart)?>'>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
<script>
    const ctx = document.getElementById('finance-chart').getContext('2d');
    const data = JSON.parse(document.getElementById('data-finance').value);
    const myChart = new Chart(ctx, {
        type: 'bar',
        data:  data,
        options:{
                locale: 'pt-BR',
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                        }
                    }
                },
                scales: {
                    yAxes: [{
                      ticks: {
                        callback: function (value) {
                            return value.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                        },
                        beginAtZero: true,
                    }
                }]
            },}
    });
</script>
</body>
</html>