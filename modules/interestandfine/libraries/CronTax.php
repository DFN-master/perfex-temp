<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CronTax
{
    public static function loadCron()
    {
        $https_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";

        $actual_link = $https_link.($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['HTTP_HOST']."/perfex_crm" : $_SERVER['HTTP_HOST']);

        hooks()->add_action('after_cron_run', 'cronsJobsInterestAndFine');
        function cronsJobsInterestAndFine(){
            /**se hoje for sabado ou domingo, não faça nada */
            if(date('N') == 6 || date('N') == 7){
                return;
            }

            $CI = &get_instance();
            $CI->load->model('Invoices_model');
            $faturas = $CI->Invoices_model->get(null, ['status' => '4']);
            foreach ($faturas as $key => $value) {
                /**Verificar rempver desconto */
                if(get_option('iaf_remover_desconto') == 1){
                    $update['discount_percent'] = 0;
                    $value['discount_percent'] = 0;
                    $update['discount_total'] = 0;
                    $update['discount_type'] = '';
                }


                $juros = get_option('iaf_juros') / 30;
                $juros = number_format($juros, 2, '.', '');
                $multa = get_option('iaf_multa');
                $multa = number_format($multa, 2, '.', '');
                $jurosFinal = 0;

                /**Verificar se tem carencia */
                if(get_option('iaf_carencia') > 0){
                    $date = DateTime::createFromFormat('Y-m-d', $value['duedate']);
                    $date->modify('+'.get_option('iaf_carencia').' day');

                    /**Dia de carencia precisa ter um dia a mais que a tada atual */
                    $date->modify('+1 day');
                    if(new Datetime() <= $date){
                        continue;
                    }
                    /**Volta 1d para que a soma fique certa, esse 1 dia seria apenas para não rodar na data atual com diferença de horas */
                    $date->modify('-1 day');

                    $date = $date->format('Y-m-d');
                    $date = DateTime::createFromFormat('Y-m-d', $date);
                    $diferenca = $date->diff(new Datetime());

                    if($diferenca->invert == 1){
                        continue;
                    }
                }else{
                    $date = DateTime::createFromFormat('Y-m-d', $value['duedate']);
                    $diferenca = $date->diff(new Datetime());
                }

                if($diferenca->y != 0){
                    $jurosFinal = $juros * (($diferenca->y * 365)+($diferenca->m * 30) + $diferenca->d);
                }else if($diferenca->m != 0){
                    $jurosFinal = $juros * (($diferenca->m * 30) + $diferenca->d);
                }else if($diferenca->d != 0){
                    $jurosFinal = $juros * $diferenca->d;
                }else{
                    $jurosFinal = $juros;
                }

                $porc = ($jurosFinal + $multa)/100;
                $adjustment = $porc * $value['subtotal'];
                $total = $adjustment + $value['subtotal'] + $value['total_tax'] - $value['discount_percent'];
                $v_multa = $multa*$value['subtotal']/100;
                $v_juros = $jurosFinal*$value['subtotal']/100;
                $clientnote = 'Multas('.$multa.'% - <span class="text-danger">
                R$'.number_format($v_multa,2,",",".").'</span>)
                e Juros('.$jurosFinal.'% - <span class="text-danger">
                R$'.number_format($v_juros,2,",",".").'</span>)
                Adicionados ao Ajuste devido ao Vencimento da Fatura';

                $value['adjustment'] = number_format($adjustment, 2, '.', '');
                $value['total'] = number_format($total, 2, '.', '');
                $value['clientnote'] = $clientnote;

                $update['adjustment'] = number_format($adjustment, 2, '.', '');
                $update['total'] = number_format($total, 2, '.', '');
                $update['clientnote'] = $clientnote;
                $update['billing_street'] = $value['billing_street'];
                $update['duedate'] = $value['duedate'];
                $update['allowed_payment_modes'] = unserialize($value['allowed_payment_modes']);
                try{
                    $CI->Invoices_model->update($update, $value['id']);
                }catch(Exception $e){
                }
            }
        }
    }
}