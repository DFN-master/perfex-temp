<script src="<?= module_dir_url('cep_cnpj_auto_no_core/assets'); ?>sweetalert2@9.js"></script>
<script src="<?= module_dir_url('cep_cnpj_auto_no_core/assets'); ?>jquery.mask.js"></script>

<script>
    let custom_field_whatsapp;
    let custom_field_razao_social;
    let custom_field_atividade_principal;
    let custom_field_email;

    $(document).ready(function() {

        let clientVat = "#<?= get_option('cepcnpjautonocore_cnpj') ?>";
        const clientPhone = "#<?= get_option('cepcnpjautonocore_telefone') ?>";
        const clientZip = "#<?= get_option('cepcnpjautonocore_cep') ?>";

        phone.init($(clientPhone));
        cep.init($(clientZip))
        cnpj.init($(clientVat))

        clientVat = $(clientVat);

        var options = {
            onKeyPress: function(cpf, ev, el, op) {
                var masks = ['000.000.000-000', '00.000.000/0000-00'];
                clientVat.mask((cpf.length > 14) ? masks[1] : masks[0], op);
            }
        }

        clientVat.val().replace(/\.|\-/gm,'').length> 11
            ? clientVat.mask('00.000.000/0000-00', options)
            : clientVat.mask('000.000.000-00#', options);
    });

    let phone = {
        init: input => {
            input.mask(phone.mascara, phone.opcoes)
        },
        mascara: o => 11 === o.replace(/\D/g, "").length ? "(00) 00000-0000" : "(00) 0000-00009",
        opcoes: {
            onKeyPress: function(o, e, a, t) {
                a.mask(phone.mascara.apply({}, arguments), t)
            }
        }
    }

    const cnpj = {
        init: input => {
            input.on('blur', function() {
                cnpj.buscar(input)
            });
        },
        buscar: o => {
            let e = o.cleanVal(),
                url = "https://www.receitaws.com.br/v1/cnpj/" + e;
            14 == e.length && $.ajax({
                url,
                dataType: "jsonp",
                beforeSend: cnpj.modal_consultando(),
                success: function(response) {
                    console.log('CNPJ:', response);
                    if (null === response)
                        return cnpj.modal_try_again();
                    "ATIVA" != response.situacao && "ERROR" != response.status ? cnpj.modal_situation_not_active(response) :
                        ("OK" == response.status ? cnpj.modal_status_ok() : "ERROR" == response.status && cnpj.modal_status_error(response.message),
                            "ERROR" != response.status && cnpj.inserirDados(response))
                },
                error: function() {
                    cnpj.modal_try_again()
                }
            })
        },
        inserirDados: response => {

            let e = response.cep.replace(".", "");

            const a = {
                num: response.numero,
                complemento: response.complemento
            };

            const clientAddress = "#<?= get_option('cepcnpjautonocore_logradouro') ?>";
            const clientState = "#<?= get_option('cepcnpjautonocore_uf') ?>";
            const clientZip = "#<?= get_option('cepcnpjautonocore_cep') ?>";
            const clientCity = "#<?= get_option('cepcnpjautonocore_municipio') ?>";
            const clientEmail = "#<?= get_option('cepcnpjautonocore_email') ?>";
            const clientFantasia = "#<?= get_option('cepcnpjautonocore_fantasia') ?>";
            const clientPhoneNumber = "#<?= get_option('cepcnpjautonocore_telefone') ?>";
            const clientCountry = "#<?= get_option('cepcnpjautonocore_pais') ?>";
            const contactPhoneNumber = "#<?= get_option('cepcnpjautonocore_contact_phonenumber') ?>";
            const name = "#<?= get_option('cepcnpjautonocore_nome') ?>";

            // Custom Fields
            const razaoSocial = "<?= get_option('cepcnpjautonocore_razao_social') ?>";
            const bairro = "<?= get_option('cepcnpjautonocore_bairro') ?>";
            const emailCNPJ = "<?= get_option('cepcnpjautonocore_email_cnpj') ?>";
            const numero = "<?= get_option('cepcnpjautonocore_numero') ?>";
            const nomeFantasia = "<?= get_option('cepcnpjautonocore_fantasia') ?>";
            const capitalSocial = "<?= get_option('cepcnpjautonocore_capital_social') ?>";

            const cepcnpjautonocore_atividade_principal = "<?= get_option('cepcnpjautonocore_atividade_principal') ?>";

            $(clientZip).val(e);

            // cep.buscar(a);

            const customFields = [{
                    id: razaoSocial,
                    value: response.nome
                }, {
                    id: bairro,
                    value: response.bairro
                },
                {
                    id: emailCNPJ,
                    value: response.email
                },
                {
                    id: numero,
                    value: response.numero
                },
                {
                    id: nomeFantasia,
                    value: response.fantasia
                },
                {
                    id: capitalSocial,
                    value: response.capital_social
                },
                {
                    id: "<?= get_option('cepcnpjautonocore_cnpj_complemento') ?>",
                    value: response.complemento
                },
                {
                    id: "<?= get_option('cepcnpjautonocore_cnpj_status') ?>",
                    value: response.status
                },
                {
                    id: "<?= get_option('cepcnpjautonocore_cnpj_data_situacao') ?>",
                    value: response.data_situacao
                },
                {
                    id: "<?= get_option('cepcnpjautonocore_cnpj_porte') ?>",
                    value: response.porte
                },
                {
                    id: "<?= get_option('cepcnpjautonocore_cnpj_tipo') ?>",
                    value: response.tipo
                },
                {
                    id: "<?= get_option('cepcnpjautonocore_cnpj_natureza_juridica') ?>",
                    value: response.natureza_juridica
                },
                {
                    id: "<?= get_option('cepcnpjautonocore_cnpj_situacao') ?>",
                    value: response.situacao
                },
                {
                    id: "<?= get_option('cepcnpjautonocore_cnpj_data_abertura') ?>",
                    value: response.abertura
                }
            ];

            customFields.map(el => {
                $('input[data-fieldid="' + el.id + '"]').val(el.value);
            });

            // Atividade Principal
            if (response.atividade_principal) {
                const atividadePrincipal = response.atividade_principal;
                if (atividadePrincipal.length > 0) {
                    $('input[data-fieldid="' + cepcnpjautonocore_atividade_principal + '"]')
                        .val(atividadePrincipal[0].code + ' - ' + atividadePrincipal[0].text);
                }
            }

            $(clientAddress + ", #billing_street, #shipping_street").val(response.logradouro);
            $(clientCity + ", #billing_city, #shipping_city").val(response.municipio);
            $(clientCountry + ",#billing_country, #shipping_country").val("32").selectpicker("refresh");
            $(clientState + ", #billing_state, #shipping_state").val(response.uf);
            // $(clientState).val(endereco.uf);
            $(clientZip + ", #billing_zip, #shipping_zip").val(response.cep.replace(".", ""));

            $(name).val(response.nome);
            $(clientFantasia).val(response.fantasia);
            $(clientPhoneNumber).val(response.telefone);

            if (contactPhoneNumber != '#') {
                $(contactPhoneNumber + ", #contact_info, #phonenumber").val(response.telefone);
            }

        },
        modal_consultando: () => {
            Swal.fire({
                title: "Consultando CNPJ...",
                timer: 1e4,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                onClose: () => {
                    clearInterval()
                }
            })
        },
        modal_situation_not_active: o => {
            Swal.fire({
                title: "Oops...",
                html: "O CNPJ informado está com a situação cadastral <b>" + o.situacao + "</b> por motivos de <b>" + o.motivo_situacao + "</b> desde <b>" + o.data_situacao + "</b>.<br/><br/>Deseja continuar mesmo assim?<br /><small>Ao concordar, vocÃª permite preenchermos os dados.</small>",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim",
                cancelButtonText: "Cancelar"
            }).then(e => {
                e.dismiss || cnpj.inserirDados(o)
            })
        },
        modal_status_ok: () => {
            Swal.fire({
                icon: "success",
                title: "Dados do CNPJ importados com sucesso!",
                showConfirmButton: !1,
                timer: 2e3
            })
        },
        modal_status_error: o => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: o,
                showConfirmButton: !1,
                timer: 2500
            })
        },
        modal_try_again: () => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Algo deu errado, aguarde alguns segundos para tentar novamente!",
                showConfirmButton: !1,
                timer: 2500
            })
        }
    };

    const cep = {
        init: o => {
            o.blur(function() {
                cep.buscar()
            }), cep.mascara(o)
        },
        buscar: o => {
            let e = $("#zip").cleanVal(),
                a = /^[0-9]{8}$/.test(e),
                t = "https://viacep.com.br/ws/" + e + "/json/?callback=?";
            "" !== e && (a ? (o || cep.modal_buscando(), $.getJSON(t, function(e) {
                "erro" in e ? (cep.modal_naoEncontrado(),
                    cep.limparDados()) : o ? cep.inserirDados(e, o) : (cep.modal_encontrado(), cep.inserirDados(e))
            })) : (cep.modal_incompleto(), cep.limparDados()))
        },
        mascara: o => {
            var e = {
                onKeyPress: function(o, e, a, t) {
                    $("#zip").mask("00000-000", t)
                },
                onComplete: () => {
                    o.blur()
                }
            };
            $("#zip").mask("00000-000", e)
        },
        modal_buscando: () => {
            Swal.fire({
                title: "Buscando CEP...",
                timer: 1e4,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                onClose: () => {
                    clearInterval()
                }
            })
        },
        modal_encontrado: () => {
            Swal.fire({
                icon: "success",
                title: "CEP Encontrado e Preenchido!",
                showConfirmButton: !1,
                timer: 2e3
            })
        },
        modal_incompleto: () => {
            Swal.fire({
                icon: "error",
                title: "CEP Incompleto",
                html: "O CEP informado está <b>incompleto</b>!",
                showConfirmButton: !1,
                timer: 2e3
            })
        },
        modal_naoEncontrado: () => {
            Swal.fire({
                icon: "warning",
                title: "CEP não encontrado",
                html: "Verifique se o CEP <b>" + $("#zip").val() + "</b> está correto. Caso esteja, digite o endereço manualmente!"
            })
        },
        inserirDados: (endereco, e) => {

            let logradouro = endereco.logradouro;

            const clientAddress = "#<?= get_option('cepcnpjautonocore_logradouro') ?>";
            const clientState = "#<?= get_option('cepcnpjautonocore_uf') ?>";
            const clientZip = "#<?= get_option('cepcnpjautonocore_cep') ?>";
            const clientCity = "#<?= get_option('cepcnpjautonocore_municipio') ?>";
            const clientCountry = "#<?= get_option('cepcnpjautonocore_pais') ?>";

            $(clientState).val(endereco.uf);
            $(clientZip + ", #billing_zip, #shipping_zip").val(endereco.cep.replace(".", ""));
            $(clientAddress).val(endereco.logradouro);
            $(clientAddress + ", #billing_street, #shipping_street").val(logradouro);
            $(clientCity + ", #billing_city, #shipping_city").val(endereco.localidade);
            $(clientState + ", #billing_state, #shipping_state").val(endereco.uf);
            $(clientCountry + ",#billing_country, #shipping_country").val("32").selectpicker("refresh");
        },
        limparDados: () => {
            // $("#billing_zip, #shipping_zip").val(""),
            // $("#address, #billing_street, #shipping_street").val(""),
            // $("#city, #billing_city, #shipping_city").val(""),
            // $("#state, #billing_state, #shipping_state").val(""),
            // $("#billing_country .filter-option-inner-inner, #shipping_country .filter-option-inner-inner").text("")
        }
    };
</script>
