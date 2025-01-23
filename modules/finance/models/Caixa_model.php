<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Caixa_model extends App_Model
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

    public function caixa(){
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
        $rec = [];
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
        $query = $this->db->query('SELECT ' . db_prefix() . 'invoices.duedate, ' . db_prefix() . 'invoices.total FROM ' . db_prefix() . 'invoices WHERE ' . db_prefix() . 'invoices.status != 5 AND date like ' .'"%'.$ano.'%" OR '. db_prefix() . 'invoices.status != 6 AND duedate like ' .'"%'.$ano.'%"'); //status 5 = Cancelado e 6 = racunho
        $entradas = $query->result_array();
        foreach ($entradas as $key) {
             $invoices[] = $key['total'];
        }
        /**
         * Entrada full
         */
        $invoicesFull = array();
        $queryEntradaFull = $this->db->query('SELECT ' . db_prefix() . 'invoices.date, ' . db_prefix() . 'invoices.total FROM ' . db_prefix() . 'invoices WHERE ' . db_prefix() . 'invoices.status = 2');
        $entradasFull = $queryEntradaFull->result_array();
        foreach ($entradasFull as $key) {
            $invoicesFull[] = $key['total'];
        }

        $movimentacoes = array();
        $queryEntradaMov = $this->db->query('SELECT inv.date, inv.total, cl.company FROM ' . db_prefix() . 'invoices AS inv INNER JOIN ' . db_prefix() . 'clients AS cl on ( userid = inv.clientid) WHERE inv.status = 2 ORDER BY inv.date DESC');
        $entradasMov = $queryEntradaMov->result_array();
        foreach($entradasMov as $key){
            array_push($movimentacoes, [
            'data' => $key['date'],
           'nome' => $key['company'],
          'valor' => $key['total']
          ]);
        }

        $querySaidaMov = $this->db->query('SELECT amount, date, expense_name FROM '. db_prefix() .'expenses ORDER BY date DESC');
        //SELECT amount, date, expense_name FROM tblexpenses
        $saidasMov = $querySaidaMov->result_array();
        foreach($saidasMov as $key){
            array_push($movimentacoes, [
            'data' => $key['date'] ,
           'nome' => $key['expense_name'],
          'valor' =>-$key['amount']
          ]);
        }


        $valorEmCaixa = 0;
        foreach($movimentacoes as $key => $value){
            $valorEmCaixa = $valorEmCaixa +($value['valor']);
            $movimentacoes[$key]["valorEmCaixa"] = $valorEmCaixa;
        }

        //echo "<pre>";var_dump($invoicesFull);"</pre>";
        /**
         * Entrada atrasadas e a receber
         */
        $queryEntradaPendentes = $this->db->query('SELECT ' . db_prefix() . 'invoices.date, ' . db_prefix() . 'invoices.total FROM ' . db_prefix() . 'invoices WHERE ' . db_prefix() . 'invoices.status = 1 OR '. db_prefix() . 'invoices.status = 4');
        $entradasPendentes = $queryEntradaPendentes->result_array();
        $invoicesPendentes = [];
        foreach ($entradasPendentes as $key) {
            $invoicesPendentes[] = $key['total'];
        }
        /**
         * Proposta
         * tblproposals status 3 = Aceito
         *   4 = enviado
         *   6 = rascunho
         *   1 = cliente visualizou
         *   5 = revisado
         *   2 perdido
         */
        $queryProposta = $this->db->query('SELECT ' . db_prefix() . 'proposals.date, ' . db_prefix() . 'proposals.status, ' . db_prefix() . 'proposals.total FROM ' . db_prefix() . 'proposals');
        $propostaQ = $queryProposta->result_array();
        foreach ($propostaQ as $key) {
            array_push($propostas[$key['status']], $key['total']);
        }
        for ($i=0; $i < count($propostas); $i++) {
            if($i == 2){
                $proposta['perdido'] = array_sum($propostas[$i]);
            }elseif($i == 3){
                $proposta['aceito'] = array_sum($propostas[$i]);
            }elseif($i == 4){
                $proposta['enviado'] = array_sum($propostas[$i]);
            }elseif($i == 5){
                $proposta['revisado'] = array_sum($propostas[$i]);
            }
        }

        /**
         * Orçamento
         * tblestimates
         *   status 1 = rascunho
         *   status 2 = enviado
         *   status 3 = Declinado Perdido
         *   status 4 = Aceito virou venda
         *   status 5 = expirado
         */
        $queryOrcamento = $this->db->query('SELECT ' . db_prefix() . 'estimates.date, ' . db_prefix() . 'estimates.status, ' . db_prefix() . 'estimates.total FROM ' . db_prefix() . 'estimates');
        $orcamentoQ = $queryOrcamento->result_array();
        foreach ($orcamentoQ as $key) {
            array_push($orcamentos[$key['status']], $key['total']);
        }
        for ($i=0; $i < count($orcamentos); $i++) {
            if($i == 2){
                $orcamento['enviado'] = array_sum($orcamentos[$i]);
            }elseif($i == 3){
                $orcamento['perdido'] = array_sum($orcamentos[$i]);
            }elseif($i == 4){
                $orcamento['aceito'] = array_sum($orcamentos[$i]);
            }elseif($i == 5){
                $orcamento['expirado'] = array_sum($orcamentos[$i]);
            }
        }

        $expenses = [];

        $expensesFull = [];


        /**
         * Saidas
         */
        $queryDespesas = $this->db->query('SELECT ' . db_prefix() . 'expenses.date, ' . db_prefix() . 'expenses.amount FROM ' . db_prefix() . 'expenses WHERE date like ' .'"%'.$ano.'%"');
        $despesas = $queryDespesas->result_array();
        foreach ($despesas as $key) {
            $expenses[] = $key['amount'];
        }
        /**
         * Saidas full
         */
        $this->db->join(db_prefix() . 'customfieldsvalues', 'relid = '.db_prefix().'expenses.id AND fieldto = "expenses"');
        $this->db->join(db_prefix() . 'customfields', db_prefix() . 'customfields.id = fieldid AND '.db_prefix() . 'customfields.slug = "expenses_status"');
        $this->db->where(db_prefix() . 'customfieldsvalues.value', 'Pago');
        $despesasFull = $this->db->get(db_prefix() . 'expenses')->result_array();

        foreach ($despesasFull as $key) {
            $expensesFull[] = $key['amount'];
        }


        // /**
        //  * Despesas Variável
        //  */
        $despesasVaria = $this->db->query('SELECT * FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            WHERE fieldto = "expenses" AND value = "Variável" AND date like ' .'"%'.$ano.'%"'
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
            'SELECT * FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            WHERE fieldto = "expenses" AND value = "Fixa" AND date like ' .'"%'.$ano.'%"'
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
            'SELECT * FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            WHERE fieldto = "expenses" AND value = "Vendas" AND date like ' .'"%'.$ano.'%"'
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
            'SELECT * FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            WHERE fieldto = "expenses" AND value = "Outras" AND date like ' .'"%'.$ano.'%"'
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
            'SELECT * FROM ' . db_prefix() . 'customfieldsvalues AS cf LEFT JOIN '
            . db_prefix() . 'expenses AS ex ON (cf.relid = ex.id)
            WHERE fieldto = "expenses" AND value = "Investimento" AND date like ' .'"%'.$ano.'%"'
        );
        $invest = $investiment->result_array();
        /**
         * Despesas Fixas mês
         */
        $investimento = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($invest as $key) {
            $d = explode('-', $key['date']);
            array_push($investimento[$d['1']], $key['amount']);
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
        $equilibrio = ($n > 0) ? array_sum($equilibrios) / $n : 0 ;



        /**
         * Lucro bruto do mês
         */
        $entradaMes = [];
        $entradaMes = ['01' => [], '02' => [], '03' => [], '04' => [], '05' => [], '06' => [], '07' => [], '08' => [], '09' => [], '10' => [], '11' => [], '12' => []];
        foreach ($entradas as $key) {
            $d = explode('-', $key['duedate']);
            if(isset($d[1])){ array_push($entradaMes[$d[1]], $key['total']); }
        }

        for ($i=0; $i < count($entradaMes)+2; $i++) {
            if($i > 0 && $i <= 12){
                if($i <= 9){
                    $e = '0'.$i;
                }else{ $e = $i; }
                if(count($entradaMes[$e]) > 0){
                    $dre[$i] = [
                        'receitaBruta' => array('0' => array_sum($entradaMes[$e]), '1' => '100%'),
                        'custoMercadoria' => array('0' => 0, '1' => '0%'),
                        'lucroBruto' => array('0' => array_sum($entradaMes[$e]) - 0, '1' => ((array_sum($entradaMes[$e]) - 0) / array_sum($entradaMes[$e]) * 100) .'%'),
                        'despesasVariaveis' => array('0' => array_sum($variavelMes[$e]), '1' => number_format((array_sum($variavelMes[$e]) / (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', '') .'%'),
                        'despesasVendas' => array('0' => array_sum($vendasMes[$e]) - 0, '1' => number_format((array_sum($vendasMes[$e]) /  (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', '') . '%'),
                        'outrasDespesas' => array('0' => array_sum($outrasMes[$e]) - 0, '1' => number_format((array_sum($outrasMes[$e]) /  (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', ''). '%'),

                        'margemDeContribuicao' => array('0' =>
                            array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]),
                            '1' => number_format(((array_sum($variavelMes[$e]) + array_sum($vendasMes[$e]) + array_sum($outrasMes[$e])) /  (array_sum($entradaMes[$e]))) * 100, 2, '.', '') . '%'),

                        'despesasFixas' => array('0' => array_sum($fixaMes[$e]) - 0, '1' => number_format((array_sum($fixaMes[$e]) /  (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', '') . '%'),

                        'resultadoOperacional' => array('0' =>
                            (array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e])),
                            '1' => number_format((array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e])) /  (array_sum($entradaMes[$e])) * 100, 2, '.', '') . '%'),

                        'investimentos' => array('0' => array_sum($investimento[$e]) - 0, '1' =>  number_format((array_sum($investimento[$e]) /  (array_sum($entradaMes[$e]) - 0)) * 100, 2, '.', '') . '%'),
                        'resultadoFinal' => array('0' =>
                        (array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e]) - array_sum($investimento[$e])),
                        '1' => number_format((array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e])- array_sum($investimento[$e])) / (array_sum($entradaMes[$e])) * 100, 2, '.', '') . '%'),

                        'pontoDeEquilibrio' => array('0' =>
                        number_format((array_sum($fixaMes[$e]) * array_sum($entradaMes[$e])) / (array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e])), 2, '.', ''),
                            '1' => number_format((((array_sum($variavelMes[$e]) + array_sum($vendasMes[$e]) + array_sum($outrasMes[$e])) /  (array_sum($entradaMes[$e]))) * 100), 2, '.', '') . '%'),

                        'bruta' => array('0' => '100%', '1' => ''),

                        'operacional' => array('0' =>
                            number_format(((array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e])) / (array_sum($entradaMes[$e])) * 100), 2, '.', ''). '%',
                            '1' => ''),

                        'liquida' => array('0' =>
                            number_format(((array_sum($entradaMes[$e]) - array_sum($variavelMes[$e]) - array_sum($vendasMes[$e]) - array_sum($outrasMes[$e]) - array_sum($fixaMes[$e])- array_sum($investimento[$e])) / (array_sum($entradaMes[$e])) * 100), 2, '.', ''). '%',
                            '1' => '')

                    ];
                    $receitaBruta[] = $dre[$i]['receitaBruta'][0];
                    $despesasVariaveis[] = $dre[$i]['despesasVariaveis'][0];
                    $despesasVendas[] = $dre[$i]['despesasVendas'][0];
                    $outrasDespesas[] = $dre[$i]['outrasDespesas'][0];
                    $despesasVendas[] = $dre[$i]['despesasVendas'][0];
                    $despesasFixas[] = $dre[$i]['despesasFixas'][0];
                    $investimentos[] = $dre[$i]['investimentos'][0];
                }
            }elseif($i == 13){
                $dre[$i] = [
                    'receitaBruta' => array('0' => array_sum($receitaBruta), '1' => '100%'),
                    'custoMercadoria' => array('0' => 0, '1' => '0%'),
                    'lucroBruto' => array('0' => array_sum($receitaBruta) - 0, '1' => ((array_sum($receitaBruta) != 0)?(array_sum($receitaBruta) - 0) / array_sum($receitaBruta):0* 100) .'%'),
                    'despesasVariaveis' => array('0' => array_sum($despesasVariaveis), '1' => number_format((array_sum($receitaBruta) != 0)?(array_sum($despesasVariaveis) / (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', '') .'%'),
                    'despesasVendas' => array('0' => array_sum($despesasVendas) - 0, '1' => number_format((array_sum($receitaBruta) != 0)?(array_sum($despesasVendas) /  (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', '') . '%'),
                    'outrasDespesas' => array('0' => array_sum($outrasDespesas) - 0, '1' => number_format((array_sum($receitaBruta) != 0)?(array_sum($outrasDespesas) /  (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', ''). '%'),

                    'margemDeContribuicao' => array('0' =>
                        array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas),
                        '1' => number_format((array_sum($receitaBruta) != 0)?((array_sum($despesasVariaveis) + array_sum($despesasVendas) + array_sum($outrasDespesas)) /  (array_sum($receitaBruta))):0 * 100, 2, '.', '') . '%'),

                    'despesasFixas' => array('0' => array_sum($despesasFixas) - 0, '1' => number_format((array_sum($receitaBruta) != 0)?(array_sum($despesasFixas) /  (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', '') . '%'),

                    'resultadoOperacional' => array('0' =>
                        (array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas)),
                        '1' => number_format((array_sum($receitaBruta) != 0)?(array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas)) /  (array_sum($receitaBruta)):0 * 100, 2, '.', '') . '%'),

                    'investimentos' => array('0' => array_sum($investimentos) - 0, '1' =>  number_format((array_sum($receitaBruta) != 0)?(array_sum($investimentos) /  (array_sum($receitaBruta) - 0)):0 * 100, 2, '.', '') . '%'),

                    'resultadoFinal' => array('0' =>
                    (array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas) - array_sum($investimentos)),
                    '1' => number_format((array_sum($receitaBruta) != 0)?(array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas)- array_sum($investimentos)) / (array_sum($receitaBruta)):0 * 100, 2, '.', '') . '%'),

                    'pontoDeEquilibrio' => array('0' =>
                    number_format(((array_sum($receitaBruta) != 0)?((array_sum($despesasFixas) * array_sum($receitaBruta)) / (array_sum($receitaBruta))):0 - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas)), 2, '.', ''),
                        '1' => number_format(((array_sum($receitaBruta) != 0)?((array_sum($despesasVariaveis) + array_sum($despesasVendas) + array_sum($outrasDespesas)) /  (array_sum($receitaBruta))):0 * 100), 2, '.', '') . '%'),

                    'bruta' => array('0' => '100%', '1' => ''),

                    'operacional' => array('0' =>
                        number_format(((array_sum($receitaBruta) != 0)?(array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas)) / (array_sum($receitaBruta)):0 * 100), 2, '.', ''). '%',
                        '1' => ''),

                    'liquida' => array('0' =>
                        number_format(((array_sum($receitaBruta) != 0)?(array_sum($receitaBruta) - array_sum($despesasVariaveis) - array_sum($despesasVendas) - array_sum($outrasDespesas) - array_sum($despesasFixas)- array_sum($investimentos)) / (array_sum($receitaBruta)):0 * 100), 2, '.', ''). '%',
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



        $this->db->where('status', 1);
        $this->db->where('currency', 1);
        $this->db->select_sum('total');
        $naoPago = $this->db->get(db_prefix() . 'invoices')->result_array();

        $this->db->where('status', 2);
        $this->db->where('currency', 1);
        $this->db->select_sum('total');
        $pago = $this->db->get(db_prefix() . 'invoices')->result_array();

        $this->db->where('duedate <', '2022-01-01');
        $this->db->group_start()->where('status', 1)->or_where('status', 2)->or_where('status', 3)->group_end();
        $this->db->where('currency', 1);
        $this->db->select_sum('total');
        $recdate = $this->db->get(db_prefix() . 'invoices')->result_array();

        $this->db->where('currency !=', 1);
        $this->db->group_start()->where('status', 1)->or_where('status', 2)->or_where('status', 3)->group_end();
        $this->db->select_sum('total');
        $new = $this->db->get(db_prefix() . 'invoices')->result_array();

        if($naoPago[0]['total'] != NULL){
            $rec['naoPago'] = $naoPago[0]['total'];
        }else{
            $rec['naoPago'] = 0;
        }

        if($pago[0]['total'] != NULL){
            $rec['pago'] = $pago[0]['total'];
        }else{
            $rec['pago'] = 0;
        }

        if($recdate[0]['total'] != NULL){
            $rec['recdate'] = $recdate[0]['total'];
        }else{
            $rec['recdate'] = 0;
        }

        if($new[0]['total'] != NULL){
            $rec['new'] = $new[0]['total'];
        }else{
            $rec['new'] = 0;
        }

        return [
            'movimentacoes' => $movimentacoes,
            'invoices' => array_sum($invoices),
            'expenses' => array_sum($expenses),
            'invoicesFull' => array_sum($invoicesFull),
            'expensesFull' => array_sum($expensesFull),
            'equilibrio' => $equilibrio,
            'entradaMes' => $entradaMes,
            'saidaMes' => $saidaMes,
            'dre' => $dre,
            'invoicesPendentes' => array_sum($invoicesPendentes),
            'orcamento' => $orcamento,
            'proposta' => $proposta,
            'recorrentes' => $rec
        ];

    }


    public function extrato($dataInicial = null, $dataFinal = null){

        $extrato = [];

        //invoices
        try{
            $this->db->select(
                db_prefix().'invoices.id, '
                .db_prefix().'invoices.date, '
                .db_prefix().'invoices.total, '
                .db_prefix().'invoices.clientnote, '
                .db_prefix().'clients.company, '
                .db_prefix().'clients.userid,'
                .db_prefix().'payment_modes.name, '
                .db_prefix().'invoicepaymentrecords.date AS data_pagamento, '
                .db_prefix().'files.attachment_key'
            );
            ($this->db->table_exists(db_prefix() .'nf'))?$this->db->select(db_prefix().'nf.num_nota'):'';
            $this->db->join(db_prefix() .'clients', db_prefix().'clients.userid = '.db_prefix().'invoices.clientid');
            $this->db->join(db_prefix() .'invoicepaymentrecords', db_prefix().'invoicepaymentrecords.invoiceid = '.db_prefix().'invoices.id', 'left');
            $this->db->join(db_prefix() .'payment_modes', db_prefix().'payment_modes.id = '.db_prefix().'invoicepaymentrecords.paymentmode', 'left');
            ($this->db->table_exists(db_prefix() .'nf'))?$this->db->join(db_prefix() .'nf', db_prefix().'invoices.id = '.db_prefix().'nf.invoices_id', 'left'):'';
            $this->db->join(db_prefix() .'files', db_prefix().'invoices.id = '.db_prefix().'files.rel_id AND '.db_prefix() .'files.rel_type = "invoice" AND '.db_prefix() .'files.file_name like "nf%" AND '.db_prefix().'files.filetype = "application/pdf"', 'left');
            $this->db->where('status', 2);
            /**Datas */
            if($dataInicial != null && $dataFinal != null){
                $this->db->where('data_pagamento >=', $dataInicial);
                $this->db->where('data_pagamento <=', $dataFinal);
            }

            $invoices = $this->db->get(db_prefix() . 'invoices')->result_array();

            $result = array();
            foreach ($invoices as $element) {
                $result[$element['id']] = $element;
            }

            $invoices = array_values($result);

            $this->db->where('selected_by_default', 1);

            $defaultPayment = $this->db->get(db_prefix() . 'payment_modes')->result_array();

            foreach ($invoices as $key => $value) {
                if($value['data_pagamento'] == null){
                    $value['data_pagamento'] = $value['date'];
                }
                array_push($extrato, [
                    'date'          => $value['data_pagamento'],
                    'client'        => $value['company'],
                    'clientid'      => $value['userid'],
                    'up_value'      => $value['total'],
                    'method'        => ($value['name'] == "")?$defaultPayment[0]['name']:$value['name'],
                    'description'   => $value['clientnote'],
                    'nf'            => ($this->db->table_exists(db_prefix() .'nf'))?$value['num_nota']:'',
                    'link_r'        => $value['attachment_key']
                ]);
            }

            //expenses
            $this->db->select(db_prefix().'expenses.id, '.db_prefix().'expenses.date, '.db_prefix().'expenses.expense_name, '.db_prefix().'expenses.amount, '.db_prefix().'expenses.note, '.db_prefix().'clients.company, '.db_prefix().'clients.userid, '.db_prefix().'files.file_name, '.db_prefix().'files.attachment_key, '.db_prefix() .'payment_modes.name');
            $this->db->join(db_prefix() . 'customfieldsvalues', 'relid = '.db_prefix().'expenses.id AND fieldto = "expenses"');
            $this->db->join(db_prefix() . 'customfields', db_prefix() . 'customfields.id = fieldid AND '.db_prefix() . 'customfields.slug = "expenses_status"');
            $this->db->join(db_prefix() .'clients', db_prefix().'clients.userid = '.db_prefix().'expenses.clientid', 'left');
            $this->db->join(db_prefix() .'payment_modes', db_prefix().'payment_modes.id = '.db_prefix().'expenses.paymentmode', 'left');
            $this->db->join(db_prefix() .'files', db_prefix().'expenses.id = '.db_prefix().'files.rel_id AND '.db_prefix() .'files.rel_type = "expense"', 'left');
            $this->db->where(db_prefix() . 'customfieldsvalues.value', 'Pago');
            /**Datas */
            if($dataInicial != null && $dataFinal != null){
                $this->db->where('expenses.date >=', $dataInicial);
                $this->db->where('expenses.date <=', $dataFinal);
            }

            $expenses = $this->db->get(db_prefix() . 'expenses')->result_array();
            //echo '<pre>';var_dump($expenses); echo '</pre>';

            $result = array();
            foreach ($expenses as $element) {
                $result[$element['id']] = $element;
            }

            $expenses = array_values($result);

            foreach ($expenses as $key => $value) {
                array_push($extrato, [
                    'date'          => $value['date'],
                    'client'        => ($value['company'] == "")? $value['expense_name']: $value['company'],
                    'clientid'      => $value['userid'],
                    'up_value'      => "-".$value['amount'],
                    'method'        => ($value['name'] == "")?$defaultPayment[0]['name']:$value['name'],
                    'description'   => $value['note'],
                    'nf'            => $value['file_name'],
                    'link_r'          => $value['attachment_key']
                ]);
            }

            usort($extrato, function($a1, $a2) {
                $v1 = strtotime($a1['date']);
                $v2 = strtotime($a2['date']);
                return $v1 - $v2; // $v2 - $v1 to reverse direction
            });

            $format = get_option('dateformat');
            $format = explode("|", $format)[0];

            foreach ($extrato as $key => $value) {

                $date = DateTime::createFromFormat('Y-m-d', $value['date']);
                $extrato[$key]['date'] = $date->format($format);

                if($key == 0){
                    $extrato[$key]['total'] = $value['up_value'];
                }else{
                    $extrato[$key]['total'] = floatval($extrato[$key-1]['total']) + floatval($value['up_value']);
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
        return $extrato;
    }

    public function payment(){
        return $this->db->get(db_prefix() . 'payment_modes')->result_array();
    }

}