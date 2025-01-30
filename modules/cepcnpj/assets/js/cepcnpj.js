jQuery(document).ready(function($){
    //Automação por CNPJ
    $('#vat').on('input', function(){
        var cnpj = $(this).val().replace(/[^0-9]/g, '');

        if(cnpj.length < 14){
            return false;
        }

        $.ajax({
            url: 'https://www.receitaws.com.br/v1/cnpj/'+cnpj,
            method: 'GET',
            dataType: 'jsonp',
            beforeSend: function(){

            },
            success: function(data){
                $('#company').val(ucwords(data.nome));
                $('#address').val(ucwords(data.logradouro));
                $('#city').val(ucwords(data.municipio));
                $('#state').val(data.uf);
                $('#phonenumber').val(data.telefone);
                $('#zip').val(data.cep);
            }
        });
    });

    //Automação por CEP
    $('#zip').on('input', function(){
        console.log('ZIP');
        var cep = $(this).val().replace(/[^0-9]/g, '');
        if(cep.length < 8){
            return false;
        }
        $.ajax({
            url: 'https://viacep.com.br/ws/'+cep+'/json/',
            method: 'GET',
            dataType: 'json',
            beforeSend: function(){

            },
            success: function(data){
                if (data.logradouro && data.logradouro.trim() !== "") {
                    $('#address').val(ucwords(data.logradouro));
                }
                if (data.localidade && data.localidade.trim() !== "") {
                    $('#city').val(ucwords(data.localidade));
                }
                if (data.uf && data.uf.trim() !== "") {
                    $('#state').val(data.uf);
                }
            }
        });
    });

    $('#lead-modal').on('shown.bs.modal', function(){
        // Ative a função de AJAX para o campo zip
        $('#zip').on('input', function(){
            var cep = $(this).val().replace(/[^0-9]/g, '');
            if(cep.length < 8){
                return false;
            }
            $.ajax({
                url: 'https://viacep.com.br/ws/'+cep+'/json/',
                method: 'GET',
                dataType: 'json',
                beforeSend: function(){

                },
                success: function(data){
                    /**Verificar se data.logradouro é vazio "" se for não cadastra */
                    if (data.logradouro && data.logradouro.trim() !== "") {
                        $('#address').val(ucwords(data.logradouro));
                    }
                    if (data.localidade && data.localidade.trim() !== "") {
                        $('#city').val(ucwords(data.localidade));
                    }
                    if (data.uf && data.uf.trim() !== "") {
                        $('#state').val(data.uf);
                    }
                }
            });
        });

    });

});

function ucwords(str) {
    return str.toLowerCase().replace(/\b\w/g, function(char) {
        return char.toUpperCase();
    });
}
