$(document).ready(function() {
    $("td").click(function() {
    	var estilo = $(this).attr('class');
    	if(estilo == 'info') {
        	$(this).attr("class","success");
            $(this).children("span").attr("class","glyphicon glyphicon-thumbs-up");
        } else if(estilo == "success") {
            $(this).attr("class","danger");
            $(this).children("span").attr("class","glyphicon glyphicon-thumbs-down");
        } else {
            $(this).attr("class","info");
            $(this).children("span").attr("class","");
        }
    });
});