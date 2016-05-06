$(document).ready(function() {

	$("#novo").click(function() {
		$("#save").removeAttr("disabled");
		$("button[id*='btnPront']").attr("class", "btn btn-default");
		$("#divHistPront").show();
		$("#divMontaProntruario").show();
		
		LimpaCampos();
	});			
	
	$("#save").click(function() {
		
		var obj = MontaJSON();
		
		var codCliente = $("#codCliente").val();
		console.log(JSON.stringify(obj));
		
		$.post( "ajax/prontuario.ajax.php", { CodCliente: codCliente, listaRespostas: JSON.stringify(obj) }, function(data) {
			console.log(data);
			var retorno = jQuery.parseJSON(data);
			
			console.log(retorno.Mensagem)
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
		});
	});			
	
	$("#nomeCliente").autocomplete({
		source: "ajax/cliente.ajax.php",
		minLength: 2,
		select: function(event, ui) {					

			LimpaProntuario();
			LimpaCampos();
			
			if(ui.item) {
				$.ajax({
					url: "ajax/cliente.ajax.php?codigo=" + ui.item.codigo,
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
		}
	})			
	.autocomplete("instance")._renderItem = function(ul, item) {
		return $("<li>")
			.append(item.nome + "<br><span class='ui-autocomplete-rg'>" + item.NumRg + "</span>")
			.appendTo(ul);
	};	

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
						var divObs = div.find("#divCite");
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
						radio.attr('checked', true);
						
					}
				}
			}
		});				
	});
	
	$("div[data-tipopergunta='Ind_Pergunta_Multi_Combo'] select").change(function(){
		var codCategoria = $(this).val();
		var divPai = $(this).parent().parent();
		
		var divItem = $("div[data-itens]", divPai);
		divItem.html("");
		
		if(codCategoria != "") {		
			$.ajax({
				url: "ajax/prontuario.ajax.php?codCategoria=" + codCategoria,
				success: function (data) {
					var itens = jQuery.parseJSON(data);
					
					var div = $("<div>");
					div.attr("class", "col-md-3");
					div.attr("data-tipo", "resposta");
					div.attr("data-tipopergunta", "Ind_Pergunta_Multi_Combo");
					div.attr("data-tipo", "resposta");				
					div.attr("style", "padding-right: 0");
					
					var select = $("<select>");
					select.attr("class", "form-control");
					div.append(select);				
					
					var opt = $("<option>");
					opt.val("");
					opt.text("Selecione");
					select.append(opt);
					
					for (var i = 0; i < itens.length; i++) {				
						var op = $("<option>");
						op.val(itens[i].Cod_Item_Multi_Combo);
						op.text(itens[i].Des_Item_Multi_Combo);
						select.append(op);					
					}
	
					divItem.append(div);
				}
			});
		}
	});
});

function LimpaProntuario() {
	$("#divHistoricoProntuarios").html("");
}

function LimpaCampos() {

	$("div[data-tipo='resposta'] input[type='text']").val("");
	
	$("div[data-tipo='resposta'] select").val("");
	
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
			} else {
				objRespostas['Valor'] = $("input", $(this)).val();
			}

// 					else if(tipoPergunta == "Ind_Pergunta_Qual"){
// 					}
// 					else if(tipoPergunta == "Ind_Pergunta_Quando"){
// 					}
// 					else if(tipoPergunta == "Ind_Pergunta_Outros"){
// 					}
// 					else if(tipoPergunta == "Ind_Pergunta_Cite"){
// 					}
// 					else if(tipoPergunta == "Ind_Pergunta_Observacao"){
// 					}
// 					else if(tipoPergunta == "Ind_Pergunta_ComboBox"){
// 						//to do
// 					}
// 					else if(tipoPergunta == "Ind_Pergunta_Radio"){
// 						//to do
// 					}
// 					else if(tipoPergunta == "Ind_Pergunta_CheckBox"){
// 						//to do
// 					}
			respostas.push(objRespostas);
	   	});
	   	
		arrayObj['Respostas'] = respostas;
		obj.push(arrayObj);
	});
	
	return obj;
	
}