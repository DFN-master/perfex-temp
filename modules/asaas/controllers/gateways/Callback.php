<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Callback extends APP_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('asaas_gateway');
    }

    public function index()
    {           
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {

            $sandbox = $this->asaas_gateway->getSetting('sandbox');
            if ($sandbox == '0') {
                $api_key = $this->asaas_gateway->decryptSetting('api_key');
                $api_url = "https://www.asaas.com";
            } else {
                $api_key = $this->asaas_gateway->decryptSetting('api_key_sandbox');
                $api_url = "https://sandbox.asaas.com";
            }

            $response = trim(file_get_contents("php://input"));
            $content = json_decode($response);

            $externalReference = $content->payment->externalReference;
            $status = $content->payment->status;
            $event = $content->event;
            $billingType = $content->payment->billingType;

            $this->db->where('hash', $externalReference);
            $invoice = $this->db->get(db_prefix() . 'invoices')->row();

                $statusMap = [
                    "PAYMENT_CREATED" => "Geração de nova cobrança",
                    "PAYMENT_AWAITING_RISK_ANALYSIS" => "Pagamento aguardando análise de risco",
                    "PAYMENT_APPROVED_BY_RISK_ANALYSIS" => "Pagamento em cartão aprovado pela análise manual de risco.",
                    "PAYMENT_REPROVED_BY_RISK_ANALYSIS" => "Pagamento reprovado pela análise de risco",
                    "PAYMENT_AUTHORIZED" => "Pagamento em cartão que foi autorizado e precisa ser capturado.",
                    "PAYMENT_UPDATED" => "Cobrança atualizada",
                    "PAYMENT_CONFIRMED" => "Cobrança confirmada (pagamento efetuado, porém o saldo ainda não foi disponibilizado).",
                    "PAYMENT_RECEIVED" => "Cobrança recebida",
                    "PAYMENT_CREDIT_CARD_CAPTURE_REFUSED" => "Falha no pagamento por cartão",
                    "PAYMENT_ANTICIPATED" => "Cobrança antecipada",
                    "PAYMENT_OVERDUE" => "Cobrança vencida",
                    "PAYMENT_DELETED" => "Cobrança removida",
                    "PAYMENT_RESTORED" => "Cobrança restaurada",
                    "PAYMENT_REFUNDED" => "Cobrança estornada",
                    "PAYMENT_PARTIALLY_REFUNDED" => "Estorno parcial",
                    "PAYMENT_REFUND_IN_PROGRESS" => "Estorno em processamento (liquidação já está agendada, cobrança será estornada após executar a liquidação).",
                    "PAYMENT_RECEIVED_IN_CASH_UNDONE" => "Recebimento em dinheiro desfeito",
                    "PAYMENT_CHARGEBACK_REQUESTED" => "Recebido chargeback",
                    "PAYMENT_CHARGEBACK_DISPUTE" => "Em disputa de chargeback",
                    "PAYMENT_AWAITING_CHARGEBACK_REVERSAL" => "Disputa vencida, aguardando repasse da adquirente",
                    "PAYMENT_DUNNING_RECEIVED" => "Recebimento de negativação",
                    "PAYMENT_DUNNING_REQUESTED" => "Negativação solicitada",
                    "PAYMENT_BANK_SLIP_VIEWED" => "Boleto visualizado pelo cliente",
                    "PAYMENT_CHECKOUT_VIEWED" => "Fatura visualizada pelo cliente"
                ];

            // check_invoice_restrictions($invoice->id, $invoiceid->hash);
            if ($invoice) {

                if ($invoice->status !== "2") {

                    if ($event == "PAYMENT_APPROVED_BY_RISK_ANALYSIS" || $event == "PAYMENT_CONFIRMED" || $event == "PAYMENT_RECEIVED") {
                        $this->asaas_gateway->addPayment([
                            'amount' => $invoice->total,
                            'invoiceid' => $invoice->id,
                            'paymentmode' => 'Asaas',
                            'paymentmethod' => $content->payment->billingType,
                            'transactionid' => $content->payment->id,
                        ]);
                         //log_activity('Asaas: ' . $statusMap2[$status] . ' para a fatura ' . $invoice->id . ', com o ID: ' . $externalReference);
                        $Mensagem = 'Asaas: '.$statusMap[$event].' para a fatura ' . $invoice->id . ', com o ID: ' . $externalReference;
                    } 
                    else {
                        //log_activity('Asaas: Estado da fatura ' . $invoice->id . ' atualizado para ' . $statusMap[$status] . ', com o ID: ' . $externalReference);
                        $Mensagem = 'Asaas: Estado da fatura ' . $invoice->id . ' atualizado para '.$event.', com o ID: ' . $externalReference;
                    }
                } else {
                    //log_activity('Asaas: Falha ao receber callback para a fatura ' . $invoice->id . ', com o ID: ' . $externalReference);
                    $Mensagem = 'Asaas: Falha ao receber callback para a fatura ' . $invoice->id . ', com o ID: ' . $externalReference;
                }
            }
        }
    }


}