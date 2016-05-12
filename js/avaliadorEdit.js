$(document).ready(function() {
	
	if($.urlParam('idAvaliador') != null) {
		$.ajax({
			url: "ajax/avaliador.ajax.php?codigo=" + $.urlParam('idAvaliador'),
			success: function (data) {
				var avaliador = jQuery.parseJSON(data);
				$("#codAvaliador").val(avaliador.codigo);
				$("#nomAvaliador").val(avaliador.nome);	
				
				$("#emailAvaliador").val(avaliador.desEmail);
				$("#loginAvaliador").val(avaliador.desLogin);	
				//$("#senhaAvaliador").val(avaliador.ocupacao);		
				
			
			}
		});			
	}
	
	$("#btnCancelar").click(function() {
		window.location= "avaliadorVis.php";
	});
});