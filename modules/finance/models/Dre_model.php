<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dre_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  integer (optional)
     * @return object
     * Get single goal
     */

    public function dre()
    {
        $dre = [
            '1' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => "",
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '2' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '3' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '4' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '5' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '6' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '7' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '8' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '9' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '10' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '11' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '12' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ],
            '13' => [
                'receitaBruta' => '',
                'custoMercadoria' => '',
                'lucroBruto' => '',
                'despesasVariaveis' => '',
                'despesasVendas' => '',
                'outrasDespesas' => '',
                'margemDeContribuicao' => '',
                'despesasFixas' => '',
                'resultadoOperacional' => '',
                'investimentos' => '',
                'resultadoFinal' => '',
                'pontoDeEquilibrio' => '',
                'margemDeLucratividade' => '',
                'bruta' => '',
                'operacional' => '',
                'liquida' => ''
            ]
        ];
        (isset($_GET['y']))? $ano = $_GET['y'] : $ano = date('Y');

        $invoices = [];
        $receitaBruta = [];
        $custoMercadoria = [];
        $lucroBruto = [];
        $despesasVariaveis = [];
        $despesasVendas = [];
        $outrasDespesas = [];
        $margemDeContribuicao = [];
        $despesasFixas = [];
        $resultadoOperacional = [];
        $investimentos = [];
        $resultadoFinal = [];
        $pontoDeEquilibrio = [];
        $margemDeLucratividade = [];
        $bruta = [];
        $operacional = [];
        $liquida = [];
        $proposta = [];
        $propostas = [
            '1' => [],
            '2' => [],
            '3' => [],
            '4' => [],
            '5' => [],
            '6' => []
        ];
        $orcamento = [];
        $orcamentos = [
            '1' => [],
            '2' => [],
            '3' => [],
            '4' => [],
            '5' => [],
            '6' => []
        ];

        /**
         * Entradas
         */
        $query = $this->db->query('
            SELECT inv.duedate, inv.total, pay.date FROM ' . db_prefix() . 'invoices AS inv
            LEFT JOIN ' . db_prefix() . 'invoicepaymentrecords AS pay ON (pay.invoiceid = inv.id )
            WHERE (inv.status = 2 AND pay.date like ' .'"%'.$ano.'%")'); //status 5 = Cancelado e 6 = racunho
        $entradas = $query->result_array();
        foreach ($entradas as $key) {
            // echo "<pre>";var_dump($key);echo "</pre>";
            if($key['date'] != null){
                $key['duedate'] = $key['date'];
            }
            $invoices[] = $key['total'];
        }

        $expenses = [];
        /**
         * Saidas
         */
        $queryDespesas = $this->db->query('SELECT * FROM ' . db_prefix() . 'expenses WHERE date like ' .'"%'.$ano.'%"');
        $despesas = $queryDespesas->result_array();
        foreach ($despesas as $key) {
            $expenses[] = $key['amount'];
        }



        // /**
        //  * Despesas Variável
        //  */
        $despesasVaria = $this->db->query('SELECT cf.*, ex.* FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            INNER JOIN ' . db_prefix() . 'customfields AS c ON (c.id = cf.fieldid)
            WHERE c.slug = "expenses_tipo_despesas" AND value = "Variável" AND date like ' .'"%'.$ano.'%"'
        );
        $despesasV = $despesasVaria->result_array();

        // /**
        //  * Despesas Variáveis mês
        //  */
        $variavelMes = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($despesasV as $key) {
            $d = explode('-', $key['date']);
            array_push($variavelMes[$d['1']], $key['amount']);
        }

        /**
         * Despesas Fixas
         */
        $despesasFixa = $this->db->query(
            'SELECT cf.*, ex.* FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            INNER JOIN ' . db_prefix() . 'customfields AS c ON (c.id = cf.fieldid)
            WHERE c.slug = "expenses_tipo_despesas" AND value = "Fixa" AND date like ' .'"%'.$ano.'%"'
        );
        $despesasF = $despesasFixa->result_array();
        /**
         * Despesas Fixas mês
         */
        $fixaMes = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($despesasF as $key) {
            $d = explode('-', $key['date']);
            array_push($fixaMes[$d['1']], $key['amount']);
        }

        /**
         * Despesas Vendas
         */
        $despesasVenda = $this->db->query(
            'SELECT cf.*, ex.* FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            INNER JOIN ' . db_prefix() . 'customfields AS c ON (c.id = cf.fieldid)
            WHERE c.slug = "expenses_tipo_despesas" AND value = "Vendas" AND date like ' .'"%'.$ano.'%"'
        );
        $despesasV = $despesasVenda->result_array();
        /**
         * Despesas Fixas mês
         */
        $vendasMes = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($despesasV as $key) {
            $d = explode('-', $key['date']);
            array_push($vendasMes[$d['1']], $key['amount']);
        }

        /**
         * Outras Despesas
         */
        $despesasOutra = $this->db->query(
            'SELECT cf.*, ex.* FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            INNER JOIN ' . db_prefix() . 'customfields AS c ON (c.id = cf.fieldid)
            WHERE c.slug = "expenses_tipo_despesas" AND value = "Outras" AND date like ' .'"%'.$ano.'%"'
        );
        $despesasO = $despesasOutra->result_array();
        /**
         * Despesas Fixas mês
         */
        $outrasMes = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($despesasO as $key) {
            $d = explode('-', $key['date']);
            array_push($outrasMes[$d['1']], $key['amount']);
        }

        /**
         * Investimento
         */
        $investiment = $this->db->query(
            'SELECT cf.*, ex.* FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
           INNER JOIN ' . db_prefix() . 'customfields AS c ON (c.id = cf.fieldid)
            WHERE c.slug = "expenses_tipo_despesas" AND value = "Investimento" AND date like ' .'"%'.$ano.'%"'
        );
        $invest = $investiment->result_array();
        /**
         * Despesas investimento mês
         */
        $investimento = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($invest as $key) {
            $d = explode('-', $key['date']);
            array_push($investimento[$d['1']], $key['amount']);
        }

        /**
         * Custo de Mercadoria Vendida
         */
        $cMercadoriaVendida = $this->db->query(
            'SELECT cf.*, ex.* FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            INNER JOIN ' . db_prefix() . 'customfields AS c ON (c.id = cf.fieldid)
            WHERE c.slug = "expenses_tipo_despesas" AND value = "Custo Mercadorias Vendidas" AND date like ' .'"%'.$ano.'%"'
        );
        $despesasMercadorias = $cMercadoriaVendida->result_array();
        $custoMercadoriasMes = ["01" => [], "02" => [], "03" => [], "04" => [], "05" => [], "06" => [], "07" => [], "08" => [], "09" => [], "10" => [], "11" => [], "12" => []];
        foreach ($despesasMercadorias as $key) {
            $d = explode('-', $key['date']);
            array_push($custoMercadoriasMes[$d['1']], $key['amount']);
        }


        /**
         * Equilibrio
         */
        $data = date("Y-m");
        $queryEqui = $this->db->query('SELECT ' . db_prefix() . 'expenses.date, ' . db_prefix() . 'expenses.amount FROM ' . db_prefix() . 'expenses WHERE ' . db_prefix() . 'expenses.date like "%'.$data.'%"');
        $equili = $queryEqui->result_array();
        $equilibrios = [];
        foreach ($equili as $key) {
            $equilibrios[] = $key['amount'];
        }
        $n = count($equilibrios);
        $equilibrio =  (is_array($equilibrios) AND $n != 0) ? array_sum($equilibrios) / $n : [];
        //$equilibrio = array_sum($equilibrios) / $n;



        /**
         * Lucro bruto do mês
         */
        $entradaMes = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($entradas as $key) {
            $d = explode('-', $key['duedate']);
            if(isset($d[1])){
                array_push($entradaMes[$d[1]], $key['total']);
            }
        }

        for ($i=0; $i < count($entradaMes)+2; $i++) {
            if($i > 0 && $i <= 12){
                if($i <= 9){
                    $e = '0'.$i;
                }else{ $e = $i; }
                if(count($entradaMes[$e]) > 0){
                    $dre[$i] = [
                        'receitaBruta' => array('0' => array_sum($entradaMes[$e]), '1' => '100%'),
                        'custoMercadoria' => array('0' => array_sum($custoMercadoriasMes[$e]), '1' => number_format((array_sum($custoMercadoriasMes[$e]) / array_sum($entradaMes[$e])) * 100, 2, '.', '') . '%'),
                        'lucroBruto' => array('0' => array_sum($entradaMes[$e]) - 0, '1' => ((array_sum($entradaMes[$e]) - 0) / array_sum($entradaMes[$e]) * 100) .'%'),
                        'despesasVariaveis' => array('0' => array_sum($variavelMes[$e]), '1' => number_format((array_sum($variavelMes[$e]) / (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', '') .'%'),
                        'despesasVendas' => array('0' => array_sum($vendasMes[$e]) - 0, '1' => number_format((array_sum($vendasMes[$e]) /  (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', '') . '%'),
                        'outrasDespesas' => array('0' => array_sum($outrasMes[$e]) - 0, '1' => number_format((array_sum($outrasMes[$e]) /  (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', ''). '%'),

                        'margemDeContribuicao' => array('0' =>
                            array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($custoMercadoriasMes[$e]),
                            '1' => number_format(((array_sum($variavelMes[$e]) + array_sum($vendasMes[$e]) + array_sum($outrasMes[$e]) + array_sum($custoMercadoriasMes[$e])) /  (array_sum($entradaMes[$e]))) * 100, 2, '.', '') . '%'),

                        'despesasFixas' => array('0' => array_sum($fixaMes[$e]) - 0, '1' => number_format((array_sum($fixaMes[$e]) /  (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', '') . '%'),

                        'resultadoOperacional' => array('0' =>
                            (array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e]) - array_sum($custoMercadoriasMes[$e])),
                            '1' => number_format((array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e]) - array_sum($custoMercadoriasMes[$e])) /  (array_sum($entradaMes[$e])) * 100, 2, '.', '') . '%'),

                        'investimentos' => array('0' => array_sum($investimento[$e]) - 0, '1' =>  number_format((array_sum($investimento[$e]) /  (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', '') . '%'),
                        'resultadoFinal' => array('0' =>
                        (array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e]) - array_sum($investimento[$e]) - array_sum($custoMercadoriasMes[$e])),
                        '1' => number_format((array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e]) - array_sum($investimento[$e]) - array_sum($custoMercadoriasMes[$e])) / (array_sum($entradaMes[$e])) * 100, 2, '.', '') . '%'),

                        'pontoDeEquilibrio' => array('0' =>
                        number_format((array_sum($fixaMes[$e]) * array_sum($entradaMes[$e])) / (array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($custoMercadoriasMes[$e])), 2, '.', ''),
                            '1' => number_format((((array_sum($variavelMes[$e]) + array_sum($vendasMes[$e]) + array_sum($outrasMes[$e]) + array_sum($custoMercadoriasMes[$e])) /  (array_sum($entradaMes[$e]))) * 100), 2, '.', '') . '%'),

                        'bruta' => array('0' => '100%', '1' => ''),

                        'operacional' => array('0' =>
                            number_format(((array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e]) - array_sum($custoMercadoriasMes[$e])) / (array_sum($entradaMes[$e])) * 100), 2, '.', ''). '%',
                            '1' => ''),

                        'liquida' => array('0' =>
                            number_format(((array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e]) - array_sum($investimento[$e]) - array_sum($custoMercadoriasMes[$e])) / (array_sum($entradaMes[$e])) * 100), 2, '.', ''). '%',
                            '1' => '')

                    ];
                    $receitaBruta[] = $dre[$i]['receitaBruta'][0];
                    $despesasVariaveis[] = $dre[$i]['despesasVariaveis'][0];
                    $custoMercadoria[] = $dre[$i]['custoMercadoria'][0];
                    $despesasVendas[] = $dre[$i]['despesasVendas'][0];
                    $outrasDespesas[] = $dre[$i]['outrasDespesas'][0];
                    $despesasVendas[] = $dre[$i]['despesasVendas'][0];
                    $despesasFixas[] = $dre[$i]['despesasFixas'][0];
                    $investimentos[] = $dre[$i]['investimentos'][0];
                }else{
                    $dre[$i] = [
                        'receitaBruta' => array('0' => 0, '1' => '0%'),
                        'custoMercadoria' => array('0' => 0, '1' => '0%'),
                        'lucroBruto' => array('0' => 0, '1' => '0%'),
                        'despesasVariaveis' => array('0' => 0, '1' => '0%'),
                        'despesasVendas' => array('0' => 0, '1' => '0%'),
                        'outrasDespesas' => array('0' => 0, '1' => '0%'),
                        'margemDeContribuicao' => array('0' => 0, '1' => '0%'),
                        'despesasFixas' => array('0' => 0, '1' => '0%'),
                        'resultadoOperacional' => array('0' => 0, '1' => '0%'),
                        'investimentos' => array('0' => 0, '1' => '0%'),
                        'resultadoFinal' => array('0' => 0, '1' => '0%'),
                        'pontoDeEquilibrio' => array('0' => 0, '1' => '0%'),
                        'bruta' => array('0' => '100%', '1' => ''),
                        'operacional' => array('0' => 0, '1' => '0%'),
                        'liquida' => array('0' => 0, '1' => '0%')
                    ];
                }
            }elseif($i == 13){
                $dre[$i] = [
                    'receitaBruta' => array('0' => array_sum($receitaBruta), '1' => '100%'),
                    'custoMercadoria' => array(
                        '0' => array_sum($custoMercadoria),
                        '1' => self::calculate_percentage(array_sum($custoMercadoria), array_sum($receitaBruta)) //'1' => number_format((array_sum($custoMercadoria) / array_sum($receitaBruta)) * 100, 2, '.', '') . '%'
                    ),
                    'lucroBruto' => array('0' => array_sum($receitaBruta) - 0, '1' => ((array_sum($receitaBruta)!=0)?(array_sum($receitaBruta) - 0) / array_sum($receitaBruta):0 * 100) .'%'),
                    'despesasVariaveis' => array('0' => array_sum($despesasVariaveis), '1' => number_format((array_sum($receitaBruta)!=0)?(array_sum($despesasVariaveis) / (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', '') .'%'),
                    'despesasVendas' => array('0' => array_sum($despesasVendas) - 0, '1' => number_format((array_sum($receitaBruta)!=0)?(array_sum($despesasVendas) /  (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', '') . '%'),
                    'outrasDespesas' => array('0' => array_sum($outrasDespesas) - 0, '1' => number_format((array_sum($receitaBruta)!=0)?(array_sum($outrasDespesas) /  (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', ''). '%'),

                    'margemDeContribuicao' => array('0' =>
                        array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas),
                        '1' => number_format((array_sum($receitaBruta)!=0)?((array_sum($despesasVariaveis) + array_sum($despesasVendas) + array_sum($outrasDespesas) + array_sum($custoMercadoria)) /  (array_sum($receitaBruta))):0 * 100, 2, '.', '') . '%'),

                    'despesasFixas' => array('0' => array_sum($despesasFixas) - 0, '1' => number_format((array_sum($receitaBruta)!=0)?(array_sum($despesasFixas) /  (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', '') . '%'),

                    'resultadoOperacional' => array('0' =>
                        (array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas) - array_sum($custoMercadoria)),
                        '1' => number_format((array_sum($receitaBruta)!=0)?(array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas)) /  (array_sum($receitaBruta)):0 * 100, 2, '.', '') . '%'),

                    'investimentos' => array('0' => array_sum($investimentos) - 0, '1' =>  number_format((array_sum($receitaBruta)!=0)?(array_sum($investimentos) /  (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', '') . '%'),

                    'resultadoFinal' => array('0' =>
                    (array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas) - array_sum($investimentos) - array_sum($custoMercadoria)),
                    '1' => number_format((array_sum($receitaBruta)!=0)?(array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas)- array_sum($investimentos)) / (array_sum($receitaBruta)):0 * 100, 2, '.', '') . '%'),

                    'pontoDeEquilibrio' => array('0' =>
                    number_format(((array_sum($receitaBruta)!=0)?(array_sum($despesasFixas) * array_sum($receitaBruta)) / (array_sum($receitaBruta)):0 - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($custoMercadoria)), 2, '.', ''),
                        '1' => number_format(((array_sum($receitaBruta)!=0)?((array_sum($despesasVariaveis) + array_sum($despesasVendas) + array_sum($outrasDespesas) + array_sum($custoMercadoria)) /  (array_sum($receitaBruta))):0 * 100), 2, '.', '') . '%'),

                    'bruta' => array('0' => '100%', '1' => ''),

                    'operacional' => array('0' =>
                        number_format(((array_sum($receitaBruta)!=0)?(array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas) - array_sum($custoMercadoria)) / (array_sum($receitaBruta)):0 * 100), 2, '.', ''). '%',
                        '1' => ''),

                    'liquida' => array('0' =>
                        number_format(((array_sum($receitaBruta)!=0)?(array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas) - array_sum($investimentos) - array_sum($custoMercadoria)) / (array_sum($receitaBruta)):0 * 100), 2, '.', ''). '%',
                        '1' => '')
                ];
            }
            //echo $i;

        }
        //echo '<pre>'.
        //print_r($variavelMes);

        //print_r($dre);
        //'</pre>';

        /**
         *  Saida dos mês
         */
        $saidaMes = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($despesas as $key) {
            $d = explode('-', $key['date']);
            array_push($saidaMes[$d['1']], $key['amount']);
        }

        /**
         * Saidas mês detalhada
         */
        // SELECT * FROM tblcustomfieldsvalues AS cf LEFT JOIN tblexpenses AS ex ON (cf.relid = ex.id) LEFT JOIN
        // tblexpenses_categories AS ec on (ec.id = ex.category)
        // WHERE fieldid = "8" AND value = "Fixa" AND date like '%2021%'

        //$queryDespesas = $this->db->query('SELECT * FROM ' . db_prefix() . 'expenses WHERE date like ' .'"%'.$ano.'%"');
        $queryDespesas = $this->db->query('SELECT cf.*, ex.*, ec.* FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN
        ' . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id) LEFT JOIN
        ' . db_prefix() . 'expenses_categories AS ec on (ec.id = ex.category)
        INNER JOIN ' . db_prefix() . 'customfields AS c ON (c.id = cf.fieldid)
        WHERE c.slug = "expenses_tipo_despesas" AND date like ' .'"%'.$ano.'%"'); //AND value = "Fixa"

        $despesas = $queryDespesas->result_array();
        $des = array();

        $saidaMesDetail = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($despesas as $key) {
            $d = explode('-', $key['date']);

            if(isset($des[$key['name']])){
                if(count($des[$key['name']][$d['1']]) != 0){
                    $des[$key['name']][$d['1']][0] = floatval($des[$key['name']][$d['1']][0]) + floatval($key['amount']);
                }else{
                    //array_push($des[$key['name']][$d['1']][0], floatval($key['amount']));
                    if(isset($des[$key['name']][$d['1']][0])){
                        $des[$key['name']][$d['1']][0] = floatval($des[$key['name']][$d['1']][0]) + floatval($key['amount']);
                    }else{
                        $des[$key['name']][$d['1']][0] = floatval($key['amount']);
                    }
                }
            }else{
                $des[$key['name']] = $saidaMesDetail;
                array_push($des[$key['name']][$d['1']], floatval($key['amount']));
            }
        }
        // echo json_encode($des);
        $invoicesFull = [];
        $expensesFull = [];
        $invoicesPendentes = [];

        return [
            'invoices' => array_sum($invoices),
            'expenses' => array_sum($expenses),
            'invoicesFull' => array_sum($invoicesFull),
            'expensesFull' => array_sum($expensesFull),
            'equilibrio' => $equilibrio,
            'entradaMes' => $entradaMes,
            'saidaMes' => $saidaMes,
            'saidaMesDetail' => $des,
            'dre' => $dre,
            'invoicesPendentes' => array_sum($invoicesPendentes),
            'orcamento' => $orcamento,
            'proposta' => $proposta
        ];

    }

    /**
     * Undocumented function
     *
     * @param [type] $numerator
     * @param [type] $denominator
     * @return void
     */
    public static function calculate_percentage($numerator, $denominator) {
        if ($denominator == 0) {
            return '0.00%';
        }
        return number_format(($numerator / $denominator) * 100, 2, '.', '') . '%';
    }


}