$(document).ready(function($) {

    $('#sel-extrato').change(function() {

        //filtro por banco
        var selection = $(this).val();
        var dataset = $('#extrato tbody tr');

        if(selection.length == 0){
            dataset.show();
            $('.chk_boxes1').prop('checked', false);
        }else{
            $('.chk_boxes1').prop('checked', false);
            dataset.hide();
            var status = $(".extrato span").filter(function(){
                var statu = $(this).text(),
                    index = $.inArray(statu, selection);
                    statu, selection;
                    return index >= 0;
            }).parent().parent();
            status.children('td').children('.checkbox').children('.chk_boxes1').prop('checked', true)
            status.show();
        }

        var tr          = $(".tr-relatorios")
        var a           = 0;
        var num         = [];

        //calculo do total
        for(i=0; i < tr.length; i++){
            if($("#tr-relatorios-"+i).css('display') != "none"){
                total   = $(".total-val-"+i);
                up      = $(".up-val-"+i+" a");
                console.log(up.css('color'));
                if(a == 0){
                    if(up.css('color') == "rgb(132, 197, 41)"){
                        real = getMoney(up.text());
                    }else if(up.css('color') == "rgb(252, 45, 66)"){
                        real = parseInt('-'+getMoney(up.text()));
                    }
                    total.text(formatReal(real));
                    num.push(real);
                }else{
                    if(up.css('color') == "rgb(132, 197, 41)"){
                        real = parseInt(getMoney(up.text()) + num[a-1]);
                    }else if(up.css('color') == "rgb(252, 45, 66)"){
                        real = parseInt(num[a-1] - getMoney(up.text()));
                    }
                    total.text(formatReal(real));
                    num.push(real);
                }
                $('#extrato').DataTable().data()[i][6] = formatReal(real);
                a++;
            }
        }

    });
  });

//formata dinheiro
function getMoney( str )
{
    return parseInt( str.replace(/[\D]+/g,'') );
}
function formatReal( int )
{
    var tmp = int+'';
    tmp = tmp.replace(/([0-9]{2})$/g, ".$1");
    if( tmp.length > 6 ){
            tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, "$1.$2");
    }
    tmp = parseInt(tmp);
    teste = "R$ "+tmp.toLocaleString('pt-br', {minimumFractionDigits: 2});
    return teste;
}

$('#finance-tipo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var codigo_conta = button.data('codigo_conta')
    var classificacao_conta = button.data('classificacao_conta')
    var nome_conta = button.data('nome_conta')
    var tipo_conta = button.data('tipo_conta')
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-body input#codigo_conta').val(codigo_conta)
    modal.find('.modal-body input#classificacao_conta').val(classificacao_conta)
    modal.find('.modal-body input#nome_conta').val(nome_conta)
    modal.find('.modal-body input#tipo_conta').val(tipo_conta)
    modal.find('.modal-body input#update').val(id)


    if(button.data('tipo') === "update"){
        modal.find('.modal-header .modal-title').text( "Editar Tipo" )
    }else{
        modal.find('.modal-header .modal-title').text( "Adicionar Novo Tipo" )
    }
});

$('#finance-aporte').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var socio = button.data('socio')
    var cpf_cnpj = button.data('cpf_cnpj')
    var comprovante = button.data('comprovante')
    var valor = button.data('valor')
    var date = button.data('date')
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-body input#socio').val(socio)
    modal.find('.modal-body input#cpf_cnpj').val(cpf_cnpj)
    modal.find('.modal-body input#valor').val(valor)
    modal.find('.modal-body input#date').val(date)
    modal.find('.modal-body input#update').val(id)


    if(button.data('tipo') === "update"){
        modal.find('.modal-header .modal-title').text( "Editar Aporte" )
        modal.find('.modal-body input#file').removeAttr('required')
    }else{
        modal.find('.modal-header .modal-title').text( "Adicionar Novo Aporte" )
        modal.find('.modal-body input#file').attr('required', true)
    }
});
url = window.location.pathname.split('/');
url1 = url[url.length - 1];
url2 = url[url.length - 2];

if(url1 == 'expense' || url2 == 'expense' ){
    $(document).ready(function($) {
        var urlparans = window.location.href.split('=');
        var nome = decodeURI(urlparans[1].split('&')[0]);
        var valor = urlparans[2].split('&')[0];
        var data = urlparans[3];

        $('input[name="expense_name"]').val(nome)
        $('input[name="date"]').val(data)
        $('input[name="amount"]').val(valor)
    });
}