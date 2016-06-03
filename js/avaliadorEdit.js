$(document).ready(function() {
	
	if($.urlParam('idAvaliador') != null) {
		$.ajax({
			url: "ajax/avaliador.ajax.php?codigo=" + $.urlParam('idAvaliador'),
			success: function (data) {
				var avaliador = jQuery.parseJSON(data);
				$("#codAvaliador").val(avaliador.codigo);
				$("#nomAvaliador").val(avaliador.nome);	
				$("#nomEspecialidade").val(avaliador.codEspecialidade);
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

	
	$("#saveAvaliador").click(function() {	
		
		$("#loader").show();
		
		var obj = DadosAvaliador();
		//console.log(obj);
		$.post( "ajax/avaliador.ajax.php", { dadosAvaliador: obj }, function(data) {
			var retorno = jQuery.parseJSON(data);
			console.log(retorno);
			if(retorno.Sucesso == true) {
				$('#alert .text').append(retorno.Mensagem);
				$('#alert').addClass("alert-success");
				
			} else {
				$('#alert .text').append(retorno.Mensagem);
				$('#alert').addClass("alert-danger");
			}

			$('#alert').show().delay(3000).fadeOut("fast", function() {
				$('#alert .text').html(""); 
			}); 
			
			$("#loader").hide();
		});
	});
	

function DadosAvaliador(){
	var obj = {};
	obj['Cod_Avaliador'] = $("#codAvaliador").val();
	obj['Nom_Avaliador'] = $("#nomAvaliador").val();
	obj['Cod_Especialidade'] = $("#codEspecialidade").val();
	obj['Des_Email'] = $("#desEmail").val();
	obj['Des_Login'] = $("#desLogin").val();
	obj['Des_Senha'] = $("#desSenha").val();
	
	return obj;
}