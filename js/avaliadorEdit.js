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
				$("#senhaAvaliador").val(avaliador.desSenha);		
				
			
			}
		});			
	}
	$("#btnCancelar").click(function() {
		window.location= "avaliadorVis.php";
	});
});

	
	$("#saveAvaliador").click(function() {	
		console.log($("#senhaAvaliador").val());
		console.log($("#confirmaSenhaAvaliador").val());
		if($("#senhaAvaliador").val() == $("#confirmaSenhaAvaliador").val()){
			$("#loader").show();
			
			var obj = DadosAvaliador();
			console.log(obj);
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
		}
		else{
			alert("As senhas digitadas são diferentes.");
		}
	});
	

function DadosAvaliador(){
	var obj = {};
	obj['Cod_Avaliador'] = $("#codAvaliador").val();
	obj['Nom_Avaliador'] = $("#nomAvaliador").val();
	obj['Cod_Especialidade'] = $("#nomEspecialidade").val();
	obj['Des_Email'] = $("#emailAvaliador").val();
	obj['Des_Login'] = $("#loginAvaliador").val();
	obj['Des_Senha'] = $("#senhaAvaliador").val();
	console.log(obj);
	return obj;
}