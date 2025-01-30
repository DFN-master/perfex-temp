<script>
(function(){
  	"use strict";
    objective_chart('company_objective',<?php echo html_entity_decode($company_objectives); ?>, "<?php echo _l('company_objective') . ' (' . $company_objectives_qty . ')'; ?>");
    objective_chart('department_objective',<?php echo html_entity_decode($department_objectives); ?>, "<?php echo _l('department_objective') . ' (' . $department_objectives_qty . ')'; ?>");
    objective_chart('personal_objective',<?php echo html_entity_decode($personal_objectives); ?>, "<?php echo _l('personal_objective') . ' (' . $personal_objectives_qty . ')'; ?>");

    objective_chart('company_key_results',<?php echo html_entity_decode($company_key_results); ?>, "<?php echo _l('company_key_results') . ' (' . $company_key_results_qty . ')'; ?>");
    objective_chart('department_key_results',<?php echo html_entity_decode($department_key_results); ?>, "<?php echo _l('department_key_results') . ' (' . $department_key_results_qty . ')'; ?>");
    objective_chart('personal_key_results',<?php echo html_entity_decode($personal_key_results); ?>, "<?php echo _l('personal_key_results') . ' (' . $personal_key_results_qty . ')'; ?>");

    checkin_status_chart('company_checkin',<?php echo html_entity_decode($company_checkin); ?>, "<?php echo _l('company_checkin_status'); ?>");
    checkin_status_chart('department_checkin',<?php echo html_entity_decode($department_checkin); ?>, "<?php echo _l('department_checkin_status'); ?>");
    checkin_status_chart('personal_checkin',<?php echo html_entity_decode($personal_checkin); ?>, "<?php echo _l('personal_checkin_status'); ?>");

})(jQuery);

function change_dashboard_type(obj){
    window.location = $(obj).attr('href');
}
function objective_chart(id, value, title_c){
    Highcharts.setOptions({
        chart: {
            style: {
                fontFamily: 'inherit !important',
                fontWeight:'normal',
                fill: 'black'
            }
        },
    });

    Highcharts.chart(id, {
        chart: {
            backgroundcolor: '#fcfcfc8a',
            type: 'column'
        },
        accessibility: {
            description: null
        },
        title: {
            text: title_c
        },
        credits: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">'+<?php echo json_encode(_l('total')); ?>+'</span>: <b>{point.y}</b> <br/>',
            shared: true
        },
        legend: {
            enabled: false
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: ''
            }

        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            name: "",
            colorByPoint: true,
            data: value,

        }]
    });
}
function checkin_status_chart(id, value, title_c){
    Highcharts.setOptions({
        chart: {
            style: {
                fontFamily: 'inherit !important',
                fontWeight:'normal',
                fill: 'black'
            }
        },
    });
    Highcharts.chart(id, {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: title_c
        },
        credits: {
            enabled: false
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Ratio',
            colorByPoint: true,
            data: value
        }]
    });
}
</script>
