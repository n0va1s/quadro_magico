$(document).ready(function() {
    $('.emoji').click(function(event) {
        event.preventDefault();
        var celula = $(this).attr('id').split('_');
        var quadro = $('#tipo').val();
        var valor;
        if (quadro != 'F') {
            //Para quadros de comportamento e mesada
            //as celulas ficam verde (otimo), vermelha (pessimo)
            //e azul(vazio)
            switch ($(this).children().attr('class')) {
              case 'otimo': //otimo para pessimo
                //$(this).attr('class','success');
                valor = 'N';
                $(this).children().removeClass("otimo");
                $(this).children().addClass("pessimo");
                //$(this).children().attr('class','pessimo');
                break;
              case 'pessimo': //pessimo para vazio
                //$(this).attr('class','danger');
                valor = null;
                $(this).children().removeClass("pessimo");
                $(this).children().addClass("duvida");
                //$(this).children().attr('class','duvida');
                break;
              default: //vazio para otimo
                //$(this).attr('class','info');
                valor = 'S';
                $(this).children().removeClass("duvida");
                $(this).children().addClass("otimo");
                //$(this).children().attr('class','otimo');
                break;
            }
        } else {
            switch ($(this).children().attr('class')) {
              case 'otimo':
                valor = 'B';
                $(this).children().removeClass("otimo");
                $(this).children().addClass("bom");
                //$(this).children().attr('class','bom');
                break;
              case 'bom':
                valor = 'R';
                $(this).children().removeClass("bom");
                $(this).children().addClass("ruim");
                //$(this).children().attr('class','ruim');
                break;
              case 'ruim':
                valor = 'P';
                $(this).children().removeClass("ruim");
                $(this).children().toggleClass("pessimo");
                //$(this).children().attr('class','pessimo');
                break;
              default:
                valor = 'O';
                $(this).children().removeClass("pessimo");
                $(this).children().addClass("otimo");
                //$(this).children().attr('class','otimo');
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