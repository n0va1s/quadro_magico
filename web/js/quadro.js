$(document).ready(function() {
    $("td").click(function(event) {
        event.preventDefault();
        var celula = $(this).attr('name').split("_");
        var quadro = $('#tipo').val();
        var valor;
        if (quadro != 'F') {
            //Para quadros de comportamento e mesada
            //as celulas ficam verde (otimo), vermelha (pessimo)
            //e azul(vazio)
            switch ($(this).children().attr("class")) {
              case "otimo": //otimo para pessimo
                //$(this).attr("class","success");
                valor = 'N';
                $(this).children().attr("class","pessimo");
                break;
              case "pessimo": //pessimo para vazio
                //$(this).attr("class","danger");
                valor = null;
                $(this).children().attr("class","");
                break;
              default: //vazio para otimo
                //$(this).attr("class","info");
                valor = 'S';
                $(this).children().attr("class","otimo");
                break;
            }
        } else {
            //Para quadros de férias as celulas ficam verde (otimo),
            //azul (bom), amarelo (ruim), vermelho (pessimo)
            switch ($(this).attr("class")) {
              case "info":
                $(this).attr("class","success");
                valor = 'O';
                $(this).children().attr("class","otimo");
                break;
              case "success":
                $(this).attr("class","info");
                valor = 'B';
                $(this).children().attr("class","bom");
                break;
              case "info":
                $(this).attr("class","warning");
                valor = 'R';
                $(this).children().attr("class","ruim");
                break;
              case "warning":
                $(this).attr("class","danger");
                valor = 'P';
                $(this).children().attr("class","pessimo");
                break;
              default:
                $(this).attr("class","");
                valor = null;
                $(this).children().attr("class","");
                break;
            }
        }
        
        $.ajax({
            url: '/quadro/atividade/marcar',
            type: 'POST',
            data: {dia: celula[0], atividade: celula[1], valor: valor},
            success: function () {
                console.log('OK. Marcacao realizada com sucesso ');
            },
            error: function () {
                console.log('NOK. Erro ao marcar no quadro ');
            }
        });
    });
});