$(document).ready(function() {
	
	if($.urlParam('idCliente') != null) {
		$.ajax({
			url: "ajax/cliente.ajax.php?codigo=" + $.urlParam('idCliente'),
			success: function (data) {
				var cliente = jQuery.parseJSON(data);
				$("#codCliente").val(cliente.codigo);
				$("#telCliente").val(cliente.telefone);	
				
				$("#nomCliente").val(cliente.nome);
				$("#corCliente").val(cliente.cor);
				$("#escolaridadeCliente").val(cliente.escolaridade);	
				$("#ocupacaoCliente").val(cliente.ocupacao);		
				$("#estadoCivilCliente").val(cliente.estadoCivil);	
				$("#naturalidadeCliente").val(cliente.naturalidade);	
				$("#sexoCliente").val(cliente.sexo);	
				$("#dataNascimentoCliente").val(cliente.dataNascimento);	
				$("#numeroFilhosCliente").val(cliente.numeroFilhos);
				$("#enderecoCliente").val(cliente.endereco);
				$("#numRg").val(cliente.numRg);
				$("#divHistPront").show();
					
				if(cliente.prontuario.length != 0){
					for(var i=0; i < cliente.prontuario.length; i++){
						var divButton = ("<button type='button' class='btn btn-default' id='btnPront-" + cliente.prontuario[i].NumProntuario + "'>" + cliente.prontuario[i].DtaProntuario);
						$("#divHistoricoProntuarios").append(divButton);
						
					}
				}				
			}
		});			
	}

    $('.chosen-select').chosen({ width: "100%" });
	
	$("#novo").click(function() {
		$("#save").removeAttr("disabled");
		$("button[id*='btnPront']").attr("class", "btn btn-default");
		$("#divHistPront").show();
		$("#divMontaProntruario").show();
		
		LimpaCampos();
	});			
	
	$("#btnCancelar").click(function() {
		window.location= "clienteVis.php";
	});
	
	$("#saveCliente").click(function() {	
		
		$("#loader").show();
		
		var obj = DadosCliente();
		//console.log(obj);
		$.post( "ajax/cliente.ajax.php", { dadosCliente: obj }, function(data) {
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
	
	$("#save").click(function() {		
		
		$("#loader").show();
		
		var obj = MontaJSON();
		
		var codCliente = $("#codCliente").val();
		console.log(JSON.stringify(obj));
		
		$.post( "ajax/prontuario.ajax.php", { CodCliente: codCliente, listaRespostas: JSON.stringify(obj) }, function(data) {
			//console.log(data);
			var retorno = jQuery.parseJSON(data);
			
			//console.log(retorno.Mensagem)
			if(retorno.Sucesso == true) {
				$('#alert .text').append(retorno.Mensagem);
				$('#alert').addClass("alert-success");

				$.ajax({
					url: "ajax/cliente.ajax.php?codigo=" + retorno.CodCliente,
					success: function (data) {
						var cliente = jQuery.parseJSON(data);

						$("#divHistoricoProntuarios").empty();
						
						if(cliente.prontuario.length != 0){
							for(var i=0; i < cliente.prontuario.length; i++){
								var btn = $("<button type='button'>");
								btn.prop("id", "btnPront-" + cliente.prontuario[i].NumProntuario);
								btn.html(cliente.prontuario[i].DtaProntuario);

								if(cliente.prontuario[i].NumProntuario == retorno.NumProntuario)
									btn.addClass("btn btn-primary");
								else
									btn.addClass("btn btn-default");
								
								$("#divHistoricoProntuarios").append(btn);
								$("#save").attr("disabled", "disabled");
							}
						}				
					}
				});
				
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

	$('.btn-toggle .btn').click(function() {
		var div = $(this).parent();
	   
		div.find('.btn-primary input').attr("checked", false);             
		div.find('.btn-primary').removeClass('btn-primary').removeClass('active').addClass('btn-default');
	   
		$(this).addClass('btn-primary').addClass('active').removeClass('btn-default');
		$('input', this).attr('checked', true);        
		
	});

	$(document.body).on("click", "button[id*='btnPront']", function() {
		$("#save").attr("disabled", "disabled");
		$("button[id*='btnPront']").attr("class", "btn btn-default");
		$(this).attr("class", "btn btn-primary");
		$("#divMontaProntruario").show();
		LimpaCampos();
		var arrayId = $(this).attr("id").split('-');
		var id = arrayId[1];
		$.ajax({
			url: "ajax/prontuario.ajax.php?numProntuario=" + id,
			success: function (data) {
				var respostas = jQuery.parseJSON(data);
				for(var i=0; i < respostas.length; i++){
										
					if(respostas[i].Ind_Pergunta_Aberta == 1 ){
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var input = div.find(":text");
						input.val(respostas[i].Des_Resposta_Aberta);
					}
					if(respostas[i].Ind_Pergunta_SimNao == 1){
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var radio = div.find(":radio[value=" + respostas[i].Ind_Resposta_SimNao + "]");

						var div = radio.parent().parent();
						div.find('.btn-primary input').attr("checked", false);             
						div.find('.btn-primary').removeClass('btn-primary').removeClass('active').addClass('btn-default');
					   
						radio.parent().addClass('btn-primary').addClass('active').removeClass('btn-default');
						$('input', radio.parent()).attr('checked', true);  

					}
					if(respostas[i].Ind_Pergunta_Qual == 1){
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var divQual = div.find("div[id='divQual']");
						var input = divQual.find(":text");
						input.val(respostas[i].Des_Resposta_Qual);
					}
					if(respostas[i].Ind_Pergunta_Quando == 1){
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var divQuando = div.find("#divQuando");
						var input = divQuando.find(":text");
						input.val(respostas[i].Des_Resposta_Quando);
					}
					if(respostas[i].Ind_Pergunta_Outros == 1){
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var divOutros = div.find("#divOutros");
						var input = divOutros.find(":text");
						input.val(respostas[i].Des_Resposta_Outros);
					}
					if(respostas[i].Ind_Pergunta_Cite == 1){
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var divCite = div.find("#divCite");
						var input = divCite.find(":text");
						input.val(respostas[i].Des_Resposta_Cite);
					}
					if(respostas[i].Ind_Pergunta_Observacao == 1){
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var divObs = div.find("#divObservacao");
						var input = divObs.find(":text");
						input.val(respostas[i].Des_Resposta_Observacao);
					}
					if(respostas[i].Ind_Pergunta_ComboBox == 1){
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var combo = div.find("option[value='" + respostas[i].Cod_Resposta_ComboBox + "']");
						combo.prop('selected', true);
						combo.attr('selected', 'selected');
					}
					if(respostas[i].Ind_Pergunta_Radio == 1){
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var radio = div.find(":radio[value=" + respostas[i].Cod_Resposta_Radio + "]");
						radio.prop('checked', true);
						
					}	
					if(respostas[i].Ind_Pergunta_CheckBox == 1){
						
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						
						for (var j = 0; j < respostas[i].Lista_Resposta_Check_Box.length; j++) {
							var check = div.find(":checkbox[value='" + respostas[i].Lista_Resposta_Check_Box[j].Cod_Item_Check + "']");
							console.log(check);
							check.prop("checked", "checked");
						}
					}	
					
					if(respostas[i].Ind_Pergunta_Multi_Combo == 1){		
						var div = $("#divQuestionario").find("div[id='perg-"+ respostas[i].Cod_Pergunta +"']");
						var select = div.find(".chosen-select");
						
						var itens = [];
						for (var j = 0; j < respostas[i].Lista_Resposta_Multi_Combo.length; j++) {
							itens.push(respostas[i].Lista_Resposta_Multi_Combo[j].Cod_Item_Multi_Combo);
						}
						
						select.val(itens);
						select.trigger("chosen:updated");
					}
				}
			}
		});				
	});
});

function LimpaProntuario() {
	$("#divHistoricoProntuarios").html("");
}

function LimpaCampos() {

	$("div[data-tipo='resposta'] input[type='text']").val("");
	
	$("div[data-tipo='resposta'] select").val("");
	
	$("div[data-tipo='resposta'] .chosen-select").val("");
	$("div[data-tipo='resposta'] .chosen-select").trigger("chosen:updated");
	
	$("div[data-tipo='resposta'] :checkbox").each(function(){
		$(this).removeAttr("checked");
	});
	
	$("div[data-tipo='resposta'] :radio").each(function(){
		$(this).removeAttr("checked");
	});
	
	$("div[data-tipopergunta='Ind_Pergunta_SimNao']").each(function(){					

		var optSim = $("input[type='radio'][value=1]", $(this));
		var lblSim = optSim.parent();
		
		var optNao = $("input[type='radio'][value=0]", $(this));
		var lblNao = optNao.parent();
		
		optSim.removeAttr("checked");
		optSim.prop("checked", false);
		
		lblSim.removeClass("btn-primary");
		lblSim.removeClass("active");
		lblSim.addClass("btn-default");
		
		optNao.attr("checked", "checked");
		optNao.prop("checked", true);
		lblNao.removeClass("btn-default");
		lblNao.addClass("btn-primary");					
		lblNao.addClass("active");					
	});
}		

function MontaJSON(){
	var obj = [];
	$("div[id*='perg-']").each(function(){
		var arrayObj = {};
		var arrayId = $(this).attr("id").split('-');
	   	var id = arrayId[1];
	   	arrayObj['Cod_Pergunta'] = id;
	   	
	   	var respostas=[];
	   	
	   	$("div[data-tipo='resposta']", this).each(function(){

		   	var objRespostas = {};
		   	var tipoPergunta = $(this).attr("data-tipopergunta");
		   	objRespostas['TipoPergunta'] = tipoPergunta;
			
			if(tipoPergunta == "Ind_Pergunta_SimNao"){
				//console.log($("input:checked", $(this)).val());
				objRespostas['Valor'] = $("input:checked", $(this)).val();
			}
			else if(tipoPergunta == "Ind_Pergunta_ComboBox") {
				objRespostas['Valor'] = $("option:selected", $(this)).val();
			} 
			else if(tipoPergunta == "Ind_Pergunta_Aberta"){
				objRespostas['Valor'] = $("input", $(this)).val();
			}
			else if(tipoPergunta == "Ind_Pergunta_Qual"){
				objRespostas['Valor'] = $("input", $(this)).val();
			}
			else if(tipoPergunta == "Ind_Pergunta_Quando"){
				objRespostas['Valor'] = $("input", $(this)).val();
			}
			else if(tipoPergunta == "Ind_Pergunta_Outros"){
				objRespostas['Valor'] = $("input", $(this)).val();
			}
			else if(tipoPergunta == "Ind_Pergunta_Cite"){
				objRespostas['Valor'] = $("input", $(this)).val();
			}
			else if(tipoPergunta == "Ind_Pergunta_Observacao"){
				objRespostas['Valor'] = $("input", $(this)).val();
			}
			else if(tipoPergunta == "Ind_Pergunta_ComboBox"){
				objRespostas['Valor'] = $("input:select", $(this)).val();
			}
			else if(tipoPergunta == "Ind_Pergunta_Radio"){
				var radio = $("input:checked", $(this)).val();
				
				if(radio != null)
					objRespostas['Valor'] = $("input:checked", $(this)).val();
				else
					objRespostas['Valor'] = "";
			}
			else if(tipoPergunta == "Ind_Pergunta_CheckBox"){
				var values = [];
				$("input:checked", $(this)).each(function(){
					values.push($(this).val());
				});
				
				if(values.length > 0)
					objRespostas['Valor'] = values;
				else
					objRespostas['Valor'] = "";
			}
			else if(tipoPergunta == "Ind_Pergunta_Multi_Combo"){
				var values = [];				
				var itens = $('.chosen-select', $(this)).chosen().val();
				
				for (var i = 0; i < itens.length; i++) {
					if(itens[i] != "")
						values.push(itens[i]);
				}
				if(values.length > 0)
					objRespostas['Valor'] = values;
				else
					objRespostas['Valor'] = "";
			}
			respostas.push(objRespostas);
	   	});
	   	
		arrayObj['Respostas'] = respostas;
		obj.push(arrayObj);
	});
	
	return obj;
	
}

function DadosCliente(){
	var obj = {};
	obj['Cod_Cliente'] = $("#codCliente").val();
	obj['Nom_Cliente'] = $("#nomCliente").val();
	obj['Dta_Nascimento'] = $("#dataNascimentoCliente").val();
	obj['Num_Rg'] = $("#numRg").val();
	obj['Des_Endereco'] = $("#enderecoCliente").val();
	obj['Ind_Sexo'] = $("#sexoCliente").val();
	obj['Num_Filhos'] = $("#numeroFilhosCliente").val();
	obj['Cod_Cor'] = $("#corCliente").val();
	obj['Cod_Escolaridade'] = $("#escolaridadeCliente").val();
	obj['Cod_Ocupacao'] = $("#ocupacaoCliente").val();
	obj['Cod_Estado_Civil'] = $("#estadoCivilCliente").val();
	obj['Cod_Naturalidade'] = $("#naturalidadeCliente").val();
	
	return obj;
}