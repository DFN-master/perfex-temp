<?php
defined('BASEPATH') or exit('No direct script access allowed');

function sortFunction( $a, $b ) {
    $format = get_option('dateformat');
    $format = explode("|", $format)[0];
    /**Validar se $a['date] e $b['date] tem /- */
    if(strpos($a['date'], '/-') === false AND strpos($b['date'], '/-') === false){
        return strtotime(DateTime::createFromFormat($format, $a['date'])->format('Y-m-d')) - strtotime(DateTime::createFromFormat($format, $b['date'])->format('Y-m-d'));
    }
}

class Previsoes_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDespesas(){
        $this->db->join(db_prefix() . 'clients', 'userid = clientid', 'left');
        $this->db->join(db_prefix() . 'customfieldsvalues', 'relid = '.db_prefix().'expenses.id AND fieldto = "expenses"');
        $this->db->join(db_prefix() . 'customfields', db_prefix() . 'customfields.id = fieldid AND '.db_prefix() . 'customfields.slug = "expenses_status"');
        $this->db->join(db_prefix() . 'expenses_categories', db_prefix() . 'expenses_categories.id = category');
        $this->db->where(db_prefix() . 'customfieldsvalues.value !=', 'Cancelado');
        $dados = $this->db->get(db_prefix() . 'expenses')->result_array();

        $result = [];

        $format = get_option('dateformat');
        $format = explode("|", $format)[0];

        foreach ($dados as $key => $value) {
            $cycles = 0;
            $date = DateTime::createFromFormat('Y-m-d', $value['date']);

            if($value['repeat_every'] != 0 && $value['recurring_type'] != NULL){
                if($value['cycles'] == 0){
                    $value['cycles'] = 400;
                }

                while($date->format('Y') < date('Y', strtotime('+1 year')) && $cycles <= $value['cycles']) {
                    array_push($result, [
                        "name"      => (isset($value['name']))?$value['name']:"",
                        "amount"    => $value['amount'],
                        "date"      => $date->format($format),
                        "company"   => $value['company']
                    ]);
                    $date = date_add($date, date_interval_create_from_date_string($value['repeat_every'].' '.$value['recurring_type']));
                    $cycles++;
                }
            }else{
                array_push($result, [
                    "name"      => (isset($value['name']))?$value['name']:"",
                    "amount"    => $value['amount'],
                    "date"      => $date->format($format),
                    "company"   => $value['company']
                ]);
            }
        }

        foreach ($result as $key => $value) {
            $date = DateTime::createFromFormat($format, $value['date']);
            if($date){
                if($date->format('Y') < date('Y')){
                    unset($result[$key]);
                }
            }
        }

        usort($result, "sortFunction");


        return $result;
    }

    public function getFaturas(){
        $this->db->join(db_prefix() . 'clients', 'userid = clientid', 'left');
        $this->db->where(db_prefix() . 'invoices.status <=', '3');
        $dados = $this->db->get(db_prefix() . 'invoices')->result_array();

        $result = [];

        $format = get_option('dateformat');
        $format = explode("|", $format)[0];

        foreach ($dados as $key => $value) {
            $cycles = 0;
            $date = DateTime::createFromFormat('Y-m-d', $value['date']);
            if($value['duedate'] == null){
                $duedate = DateTime::createFromFormat('Y-m-d', $value['date']);
            }else{
                $duedate = DateTime::createFromFormat('Y-m-d', $value['duedate']);
            }

            if($value['recurring'] != 0){
                if($value['cycles'] == 0){
                    $value['cycles'] = 400;
                }

                if($value['recurring_type'] == NULL){
                    $value['recurring_type'] = 'month';
                }

                while($date->format('Y') < date('Y', strtotime('+1 year')) && $cycles <= $value['cycles']) {
                    array_push($result, [
                        "name"      => $value['prefix'].$value['number'],
                        "total"     => $value['total'],
                        "total_tax" => $value['total_tax'],
                        "date"      => $date->format($format),
                        "company"   => $value['company'],
                        "duedate"   => $duedate->format($format),
                        "status"    => $value['status']
                    ]);
                    $date = date_add($date, date_interval_create_from_date_string($value['recurring'].' '.$value['recurring_type']));
                    $duedate = date_add($duedate, date_interval_create_from_date_string($value['recurring'].' '.$value['recurring_type']));
                    $cycles++;
                }
            }else{
                array_push($result, [
                    "name"      => $value['prefix'].$value['number'],
                    "total"     => $value['total'],
                    "total_tax" => $value['total_tax'],
                    "date"      => $date->format($format),
                    "company"   => $value['company'],
                    "duedate"   => $duedate->format($format),
                    "status"    => $value['status']
                ]);
            }
        }

        foreach ($result as $key => $value) {
            $date = DateTime::createFromFormat($format, $value['date']);
            if($date->format('Y') < date('Y')){
                unset($result[$key]);
            }
        }
        usort($result, "sortFunction");


        return $result;
    }

    public function getDespesasTabela(){
        $this->db->join(db_prefix() . 'clients', 'userid = clientid', 'left');
        $this->db->join(db_prefix() . 'customfieldsvalues', 'relid = '.db_prefix().'expenses.id AND fieldto = "expenses"');
        $this->db->join(db_prefix() . 'customfields', db_prefix() . 'customfields.id = fieldid AND '.db_prefix() . 'customfields.slug = "expenses_status"');
        $this->db->join(db_prefix() . 'expenses_categories', db_prefix() . 'expenses_categories.id = category');
        $this->db->where(db_prefix() . 'customfieldsvalues.value', 'Aberto');
        $dados = $this->db->get(db_prefix() . 'expenses')->result_array();

        $result = [];

        $format = get_option('dateformat');
        $format = explode("|", $format)[0];

        foreach ($dados as $key => $value) {
            $i = 0;
            $cycles = 0;
            $dateOri = DateTime::createFromFormat('Y-m-d', $value['date']);
            $date = DateTime::createFromFormat('Y-m-d', $value['date']);

            if($value['repeat_every'] != 0 && $value['recurring_type'] != NULL){
                if($value['cycles'] == 0){
                    $value['cycles'] = 400;
                }

                while($date->format('Y') < date('Y', strtotime('+1 year')) && $cycles <= $value['cycles']) {
                    if($date->format('Y') >= date('Y') && $i == 0){
                        array_push($result, [
                            "name"      => (isset($value['name']))?$value['name']:"",
                            "amount"    => $value['amount'],
                            "date"      => $dateOri->format($format),
                            "company"   => $value['company']
                        ]);
                        $i++;
                    }
                    $date = date_add($date, date_interval_create_from_date_string($value['repeat_every'].' '.$value['recurring_type']));
                    $cycles++;
                }
            }else{
                if($date->format('Y') >= date('Y')){
                    array_push($result, [
                        "name"      => (isset($value['name']))?$value['name']:"",
                        "amount"    => $value['amount'],
                        "date"      => $date->format($format),
                        "company"   => $value['company']
                    ]);
                }
            }
        }

        usort($result, "sortFunction");


        return $result;
    }

    public function getFaturasTabela(){
        $this->db->join(db_prefix() . 'clients', 'userid = clientid', 'left');
        $this->db->where(db_prefix() . 'invoices.status <', '5');
        $this->db->where(db_prefix() . 'invoices.status !=', '2');
        $dados = $this->db->get(db_prefix() . 'invoices')->result_array();

        $result = [];

        $format = get_option('dateformat');
        $format = explode("|", $format)[0];

        foreach ($dados as $key => $value) {
            $i = 0;
            $cycles = 0;
            $date = DateTime::createFromFormat('Y-m-d', $value['date']);
            $dateOri = DateTime::createFromFormat('Y-m-d', $value['date']);
            $duedate = DateTime::createFromFormat('Y-m-d', $value['duedate']);

            if($value['recurring'] != 0){
                if($value['cycles'] == 0){
                    $value['cycles'] = 400;
                }

                if($value['recurring_type'] == NULL){
                    $value['recurring_type'] = 'month';
                }

                while($date->format('Y') < date('Y', strtotime('+1 year')) && $cycles <= $value['cycles']) {
                    if($date->format('Y') >= date('Y') && $i == 0){
                        array_push($result, [
                            "name"      => $value['prefix'].$value['number'],
                            "total"     => $value['total'],
                            "total_tax" => $value['total_tax'],
                            "date"      => $dateOri->format($format),
                            "company"   => $value['company'],
                            "duedate"   => $duedate->format($format),
                            "status"    => $value['status']
                        ]);
                        $i++;
                    }
                    $date = date_add($date, date_interval_create_from_date_string($value['recurring'].' '.$value['recurring_type']));
                    $cycles++;
                }
            }else{
                if($date->format('Y') >= date('Y')){
                    array_push($result, [
                        "name"      => $value['prefix'].$value['number'],
                        "total"     => $value['total'],
                        "total_tax" => $value['total_tax'],
                        "date"      => $date->format($format),
                        "company"   => $value['company'],
                        "duedate"   => $duedate->format($format),
                        "status"    => $value['status']
                    ]);
                }
            }
        }

        usort($result, "sortFunction");


        return $result;
    }

    public function getChart()
    {
        $year = date('Y');

        $months_labels   = [];
        $bg1             = [];
        $border1         = [];
        $bg2             = [];
        $border2         = [];
        $bg3             = [];
        $border3         = [];
        $total           = [];
        $amount          = [];
        $i               = 0;

        $this->load->model('finance/caixa_model');
        $caixaModel = $this->caixa_model->caixa();
        $caixa = $caixaModel['invoicesFull'] - $caixaModel['expensesFull'];
        $invoices = $this->Previsoes_model->getFaturas();
        $expenses = $this->Previsoes_model->getDespesas();

        for ($m = 1; $m <= 12; $m++) {
            $dateF = $m."/".$year;
            $total[$i] = [];
            $amount[$i] = [];
            array_push($months_labels, _l(date('F', mktime(0, 0, 0, $m, 1))));
            array_push($bg1, 'rgba(75, 192, 192, 0.2)');
            array_push($border1, 'rgb(75, 192, 192)');

            array_push($bg2, 'rgba(255, 99, 132, 0.2)');
            array_push($border2, 'rgba(255, 99, 132, 1)');

            array_push($bg3, 'rgba(54, 162, 235, 0.2)');
            array_push($border3, 'rgba(54, 162, 235, 1)');

            foreach ($invoices as $key => $value) {
                $dateT = substr($value['date'], 3);
                if((int)$dateT == (int)$dateF){
                    array_push($total[$i], $value['total']);
                }
            }

            foreach ($expenses as $key => $value) {
                $dateT = substr($value['date'], 3);
                if((int)$dateT == (int)$dateF){
                    array_push($amount[$i], $value['amount']);
                }
            }

            //var_dump($invoices);

            if (!isset($total[$i])) {
                $total[$i] = [];
            }

            if (!isset($amount[$i])) {
                $amount[$i] = [];
            }


            $total[$i]  = array_sum($total[$i]);
            $amount[$i] = array_sum($amount[$i]);

            if($i == 0){
                $caixaMes[$i] = $caixa + $total[$i] - $amount[$i];
            }else{
                $caixaMes[$i] = $caixaMes[$i - 1] + $total[$i] - $amount[$i];
            }

            $i++;
        }

        $chart = [
            'labels'   => $months_labels,
            'datasets' => [
                [
                    'label'           => 'Entrada',
                    'data'            => $total,
                    'backgroundColor' => $bg1,
                    'borderColor'     => $border1,
                    'borderWidth'     => 1,
                ],
                [
                    'label'           => 'Saída',
                    'data'            => $amount,
                    'backgroundColor' => $bg2,
                    'borderColor'     => $border2,
                    'borderWidth'     => 1,
                ],
                [
                    'label'           => 'Caixa',
                    'data'            => $caixaMes,
                    'backgroundColor' => $bg3,
                    'borderColor'     => $border3,
                    'borderWidth'     => 1,
                ],
            ],
        ];

        // echo '<pre>';var_dump($chart);echo '</pre>';
        // exit();

        return $chart;
    }
}