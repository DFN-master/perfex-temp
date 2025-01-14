const cepHrm = {
    init: o => {
        o.blur(function () {
            cepHrm.buscar()
        }), cepHrm.mascara(o)
    },
    buscar: o => {

        let e = $("#zip_code").cleanVal();

        let a = /^[0-9]{8}$/.test(e);

        let t = "https://viacep.com.br/ws/" + e + "/json/?callback=?";

        "" !== e && (a ? (o || cepHrm.modal_buscando(), $.getJSON(t, function (e) {
            "erro" in e ? (cepHrm.modal_naoEncontrado(),
                    cepHrm.limparDados()) : o ? cepHrm.inserirDados(e, o) : (cepHrm.modal_encontrado(), cepHrm.inserirDados(e))
        })) : (cepHrm.modal_incompleto(), cepHrm.limparDados()))
    },
    mascara: o => {
        var e = {
            onKeyPress: function (o, e, a, t) {
                $("#zip_code").mask("00000-000", t)
            },
            onComplete: () => {
                o.blur()
            }
        };
        $("#zip_code").mask("00000-000", e)
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
            html: "Verifique se o CEP <b>" + $("#zip_code").val() + "</b> está correto. Caso esteja, digite o endereço manualmente!"
        })
    },
    inserirDados: (endereco, e) => {
        let logradouro = endereco.logradouro;
    
        e && ("" !== e.num && (logradouro += ", Nº " + e.num), "" !== e.complemento),
                logradouro += " é " + endereco.bairro,
                $("#zip_code, #billing_zip, #shipping_zip, #zip").val(endereco.cep),
                $("#address, #billing_street, #shipping_street").val(logradouro),
                $("#city, #billing_city, #shipping_city").val(endereco.localidade),
                $("#state, #billing_state, #shipping_state").val(endereco.uf),
                $('#estado_cnpj').val(endereco.uf).selectpicker('refresh'),
                $("#bairro_cnpj").val(endereco.bairro),
                $("#billing_country, #shipping_country").val("32").selectpicker("refresh");

    },
    limparDados: () => {
        $("#billing_zip, #shipping_zip").val(""),
                $("#address, #billing_street, #shipping_street").val(""),
                $("#city, #billing_city, #shipping_city").val(""),
                $("#state, #billing_state, #shipping_state").val(""),
                $("#billing_country .filter-option-inner-inner, #shipping_country .filter-option-inner-inner").text("")
    }
};

const cnpjHrm = {
    init: el => {
        el.on('blur', function () {
            cnpjHrm.buscar(el)
        }), cnpjHrm.mascara(el)
    },
    mascara: o => {
        o.length && o.mask("00.000.000/0000-00", cnpjHrm.opcoes)
    },
    opcoes: {
        onKeyPress: function (o, e, a, t) {
            var mask = ["000.000.000-000", "00.000.000/0000-00"];
            a.mask("00.000.000/0000-00", t)
        },
        onComplete: (o, e, a) => {
            18 == o.length && a.blur()
        }
    },
    buscar: elemt => {
        let cnpjValor = null;

        $(elemt).each(function (_, el) {
            if (el.value) {
                cnpjValor = el.value;
            }
        })

        let e = elemt.cleanVal();
        
        cnpjValor = cnpjValor.replace(/\D+/gm, '');

        let url = "https://www.receitaws.com.br/v1/cnpj/" + cnpjValor;

        if (14 == cnpjValor.length) {
            $.ajax({
                url,
                dataType: "jsonp",
                beforeSend: cnpjHrm.modal_consultando(),
                success: function (o) {

                    if (null === o)
                        return cnpjHrm.modal_try_again();
                    "ATIVA" != o.situacao && "ERROR" != o.status ? cnpjHrm.modal_situation_not_active(o)
                            : ("OK" == o.status ? cnpjHrm.modal_status_ok() : "ERROR" == o.status &&
                                    cnpjHrm.modal_status_error(o.message),
                                    "ERROR" != o.status && cnpjHrm.inserirDados(o))
                },
                error: function () {
                    cnpjHrm.modal_try_again()
                }
            })
        }
    },
    inserirDados: infoEmpresa => {

        const {logradouro, municipio, numero, nome, qsa, cnpj, complemento} = infoEmpresa;

        let cepNumero = infoEmpresa.cep.replace(".", "");

        $('input[name="identification"]').val(cnpj);

        if (qsa.length) {
            $('#socio').val('0').selectpicker('refresh');
        }

        $('#endereco_cnpj, #resident').val(`${logradouro}, ${numero}, ${complemento}`);

        $('#zip_code').val(cepNumero);

        $('#cidade_cnpj, #current_address').val(municipio);

        // $('#razao_social, #firstname').val(nome);

        if (document.getElementById('zip_code')) {
            cepHrm.buscar(cepNumero);
        }

        $('#razao_social').val(infoEmpresa.nome);

        $("#contact_info, #phonenumber").val(infoEmpresa.telefone);

        $("#contact_info").val(infoEmpresa.email); /*, #email*/

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
            e.dismiss || cnpjHrm.inserirDados(o)
        })
    },
    modal_status_ok: () => {
        Swal.fire({
            icon: "success",
            title: "Dados do CNPJ importados com sucesso!",
            showConfirmButton: !1,
            timer: 2e3
        });
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

cnpjHrm.init($('input[name="identification"]'));

if ($("#zip_code")) {
    cepHrm.init($("#zip_code"));
}

$('#Personal_tax_code').mask('000.000.000-00', {reverse: true}).blur(function () {
    validarCPF($(this));
})