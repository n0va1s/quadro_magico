$(document).ready(function() {
    $('.emoji').click(function(event) {
        event.preventDefault();
        var celula = $(this).attr('id').split('_');
        var quadro = $('#tipo').val();
        var valor;
        if (quadro != 'F') {
            //Para quadros de comportamento e mesada
            //a regra e fez (1), nao fez (0) ou nao teve oportunidade de fazer (0)
            switch ($(this).children().attr('class')) {
              case 'otimo': //otimo para pessimo
                valor = 1;
                $(this).children().removeClass("otimo").addClass("pessimo");
                break;
              case 'pessimo': //pessimo para vazio
                valor = null;
                $(this).children().removeClass("pessimo").addClass("duvida");
                break;
              default: //vazio para otimo
                valor = 2;
                $(this).children().removeClass("duvida").addClass("otimo");
                break;
            }
        } else {
            //Para quadros de ferias
            //a regra e otimo (4), bom(3), ruim (2), pessimo (1)
            //multiplicado pelo valor atribuido a atividade
            switch ($(this).children().attr('class')) {
              case 'otimo':
                valor = 3;
                $(this).children().removeClass("otimo").addClass("bom");
                break;
                case 'bom':
                valor = 2;
                $(this).children().removeClass("bom").addClass("ruim");
                break;
                case 'ruim':
                valor = 1;
                $(this).children().removeClass("ruim").addClass("pessimo");
                break;
                case 'pessimo':
                valor = null;
                $(this).children().removeClass("pessimo").addClass("duvida");
                break;
                default:
                valor = 4;
                $(this).children().removeClass("duvida").addClass("otimo");
                break;
            }
        }
        
        $.ajax({
            url: '/quadro/atividade/marcar',
            type: 'POST',
            data: {dia: celula[0], atividade: celula[1], valor: valor},
            success: function () {
                console.log('OK. Marcacao realizada com sucesso');
            },
            error: function () {
                console.log('NOK. Erro ao marcar no quadro');
            }
        });
    });
});