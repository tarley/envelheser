$(document).ready(function() {
	$("#btnBuscaCliente").click(function() {
		var cliente = $("#nomeCliente").val();	
		$.ajax({
			url: "ajax/cliente.ajax.php?term=" + cliente,
			success: function (data) {
				var cliente = jQuery.parseJSON(data);
				
				var tbody = $("#tablePaciente tbody");
				tbody.empty();
				
				if(cliente.length != 0){
					for(var i=0; i < cliente.length; i++){
						console.log(cliente[i]);
						var tr = $('<tr></tr>');
						var tdCod = $('<td class="text-center">' + cliente[i].codigo + '</td>');
						var tdNome = $('<td>' + cliente[i].nome + '</td>');
						var tdRg = $('<td class="text-center">' + cliente[i].NumRg + '</td>');
						var tdTelefone = $('<td class="text-center">' + cliente[i].NumTelefone + '</td>');
						var tdUltimaConsulta = $('<td class="text-center">' + cliente[i].DtaUltimoAtendimento + '</td>');
						var tdEditar = $('<td></td>');
						var divEditar = $('<div class="col-md-1 text-center"></div>');
						var btnEditar  = $('<button id="#" type="button" class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i> Editar</button>');
						divEditar.append(btnEditar);
						tdEditar.append(divEditar);
						tr.append(tdCod);
						tr.append(tdNome);
						tr.append(tdRg);
						tr.append(tdTelefone);
						tr.append(tdUltimaConsulta);
						tr.append(tdEditar);
						tbody.append(tr);
					}
				}
			
			}
		});
	});
});