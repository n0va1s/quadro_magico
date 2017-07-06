$(document).ready(function() {
    $(".info,.success,.danger").click(function(event) {
        event.preventDefault();
        var celula = $(this).attr('id').split("_");
        var estilo = $(this).attr('class');
        var valor;
        //Trocar o estilo e a imagem da celula clicada
        if(estilo == 'info') {
            $(this).attr("class","success");
            valor = 'S';
            $(this).children("span").attr("class","glyphicon glyphicon-thumbs-up");
        } else if(estilo == "success") {
            $(this).attr("class","danger");
            valor = 'N';
            $(this).children("span").attr("class","glyphicon glyphicon-thumbs-down");
        } else {
            $(this).attr("class","info");
            valor = null;
            $(this).children("span").attr("class","");
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