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
            switch ($(this).children().attr('src')) {
              case '/img/otimo.png': //otimo para pessimo
                //$(this).attr('class','success');
                valor = 'N';
                $(this).children().attr('src','/img/pessimo.png');
                break;
              case '/img/pessimo.png': //pessimo para vazio
                //$(this).attr('class','danger');
                valor = null;
                $(this).children().attr('src','/img/duvida.png');
                break;
              default: //vazio para otimo
                //$(this).attr('class','info');
                valor = 'S';
                $(this).children().attr('src','/img/otimo.png');
                break;
            }
        } else {
            switch ($(this).children().attr('src')) {
              case '/img/otimo.png':
                valor = 'B';
                $(this).children().attr('src','/img/bom.png');
                break;
              case '/img/bom.png':
                valor = 'R';
                $(this).children().attr('src','/img/ruim.png');
                break;
              case '/img/ruim.png':
                valor = 'P';
                $(this).children().attr('src','/img/pessimo.png');
                break;
              default:
                valor = 'O';
                $(this).children().attr('src','/img/otimo.png');
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