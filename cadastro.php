<?php
	require_once 'init.php';
	
	$mysql = new MySQL();
	$Prontuario = new Prontuario($mysql->link);
	
	function MontaGrupos($codGrupoSuperior){
		global $Prontuario;
		
		$listaGrupos = $Prontuario->getGrupos($codGrupoSuperior);
		 
		for($i=0; $i < sizeof($listaGrupos); $i++)
		{
			echo '<div class="panel panel-default">';
			echo '<div class="panel-heading">';
			echo $listaGrupos[$i]['Nom_Grupo'];
			echo '</div>';
			echo '<div class="panel-body">';
			echo '<div class="row">';
			echo '<div class="col-lg-12">';
			
			MontaPerguntas($listaGrupos[$i]['Cod_Grupo']);			
			MontaGrupos($listaGrupos[$i]['Cod_Grupo']);
			
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
		 
		return $listaGrupos;
	}
	$contPergunta = 0;
	function MontaPerguntas($codGrupo){
		global $Prontuario;
		global $contPergunta;
		$listaPerguntas = $Prontuario->getPerguntas($codGrupo);
			
		for($i=0; $i < sizeof($listaPerguntas); $i++)
		{			
			echo '<div id="perg-'. $listaPerguntas[$i]['Cod_Pergunta'] .'" class="form-group clearfix">';
			echo '<div class="col-md-3">';
			echo '<label style="margin-bottom: 0;">' . $listaPerguntas[$i]['Des_Pergunta'] . '</label>';
			echo '</div>';
			
			if($listaPerguntas[$i]['Ind_Pergunta_Aberta']){
				echo '<div data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Aberta" class="col-md-6 nopadding">';
				echo '<input type="text" class="form-control">';
				echo '</div>';
				echo '</br>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_SimNao']){
				echo '<div data-tipo="resposta" data-tipopergunta="Ind_Pergunta_SimNao" class="col-md-1 nopadding">';
                echo '<div class="btn-group btn-toggle text-right" data-toggle="buttons">';
                echo '<label class="btn btn-default btn-sm">';
                echo '<input name="options' . $contPergunta . '[]" value="1" type="radio">Sim';
                echo '</label>';
                echo '<label class="btn btn-primary btn-sm active">';
                echo '<input name="options' . $contPergunta . '[]" value="0" type="radio" checked="checked">Nao';
                echo '</label>';
                echo '</div>';
                echo '</div>';
				
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Qual']){
				echo '<div id="divQual" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Qual" class="form-horizontal">';
				echo '<label class="control-label col-md-1">Qual?</label>';
				echo '<div class="col-md-3">
						<input id="Ind_Pergunta_Qual" type="text" class="form-control">
						</div>';
				echo '</div>';
				
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Quando']){
				echo '<div id="divQuando" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Quando" class="form-horizontal">';
				echo '<label class="control-label col-md-1">Quando?</label>';
				echo '<div class="col-md-3">
						<input id="Ind_Pergunta_Quando" type="text" class="form-control">
						</div>';
				echo '</div>';
				
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Outros']){
				echo '<div id="divOutros" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Outros" class="col-md-3">';
				echo '<label>Outros:</label>';
				echo '<input id="Ind_Pergunta_Outros" type="text" class="form-control">';
				echo '</div>';
				echo '</br>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Cite']){
				echo '<div id="divCite" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Cite" class="col-md-3">';
				echo '<label>Cite:</label>';
				echo '<input id="Ind_Pergunta_Cite" type="text" class="form-control">';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Observacao']){
				echo '<div id="divObservacao" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Observacao" class="col-md-3">';
				echo '<label>Observaï¿½ï¿½o:</label>';
				echo '<input id="Ind_Pergunta_Observacao" type="text" class="form-control">';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['ind_Pergunta_ComboBox']){
				echo '<div class="col-md-3" data-tipo="resposta" data-tipopergunta="ind_Pergunta_ComboBox">';				
				echo '<select>';
				$listaOpcoes = $Prontuario->getOpcoesCombo($listaPerguntas[$i]['Cod_Pergunta']);
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<option id="ind_Pergunta_ComboBox[]" value="'.$listaOpcoes[$j]['Cod_Item_Combo'].'">'.$listaOpcoes[$j]['Des_Item_Combo'].'</option>';
				}
				echo '</select>';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Radio']){
				$listaOpcoes = $Prontuario->getOpcoesRadio($listaPerguntas[$i]['Cod_Pergunta']);
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<input id="Ind_Pergunta_Radio[]" type="radio" value="'.$listaOpcoes[$j]['Cod_Item_Radio'].'" class="form-control" >';
				}
				echo '</br>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_CheckBox']){
				$listaOpcoes = $Prontuario->getOpcoesCheck($listaPerguntas[$i]['Cod_Pergunta']);
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<input id="Ind_Pergunta_CheckBox[]" type="checkbox" value="'.$listaOpcoes[$j]['Cod_Item_Check'].'" class="form-control" >';
				}
				echo '</br>';
			}
			echo '</div>';
			
			$contPergunta++;
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/header.php"); ?>
	<style>
		.ui-autocomplete-loading {
		    background: white url("components/jquery-ui/images/ui-anim_basic_16x16.gif") no-repeat scroll 99% center;
		}
		
		.ui-autocomplete-rg {
			font-style: italic;
			font-size: 10pt;
		}
		
		.ui-autocomplete-rg {
			font-style: italic;
			font-size: 10pt;
		}
	</style>
</head>
<body>
    <div id="wrapper">
		<?php include("includes/menu.php") ?>
		
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Paciente</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-search"></i>
                            Consulta
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                    	<div class="form-group col-md-6">
                                            <input id="nomeCliente" class="form-control" placeholder="Pesquisar">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-pencil-square-o"></i>
                            Dados Cadastrais
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                        <div class="form-group col-md-1">
                                            <label>Código</label>
                                            <input id="codCliente" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Nome</label>
                                            <input id="nomCliente" class="form-control" disabled>
                                        </div>
										<div class="form-group col-md-4">
                                            <label>Endereço</label>
                                            <input id="enderecoCliente" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Telefone</label>
                                            <input id="telCliente" class="form-control" disabled>
                                        </div>
										<div class="form-group col-md-2">
                                            <label>Data de Nascimento</label>
                                            <input id="dataNascimentoCliente" class="form-control" disabled>
                                        </div>	
                                        <div class="form-group col-md-2">
                                            <label>Estado Civil</label>
                                            <input id="estadoCivilCliente" class="form-control" disabled>
                                        </div>	
                                        <div class="form-group col-md-2">
                                            <label>Naturalidade</label>
                                            <input id="naturalidadeCliente" class="form-control" disabled>
                                        </div>		
                                        <div class="form-group col-md-2">
                                            <label>Escolaridade</label>
                                            <input id="escolaridadeCliente" class="form-control" disabled>
                                        </div>	
										<div class="form-group col-md-2">
                                            <label>Sexo</label>
                                            <input id="sexoCliente" class="form-control" disabled>
                                        </div>					
										<div class="form-group col-md-2">
                                            <label>Cor</label>
                                            <input id="corCliente" class="form-control" disabled>
                                        </div>		
                                        <div class="form-group col-md-2">
                                            <label>Ocupação</label>
                                            <input id="ocupacaoCliente" class="form-control" disabled>
                                        </div>	
                                        <div class="form-group col-md-1">
                                            <label>Filhos</label>
                                            <input id="numeroFilhosCliente" class="form-control" disabled>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
					<div id="alert" class="alert alert-dismissable" style="display: none">
						<span class="text"></span>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					</div>
						                    
                    <div id="divHistPront" class="panel panel-default" style="display: none;">
                        <div class="panel-heading"><i class="fa fa-list-alt"></i>
                            Histórico Prontuário
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="divQuestionario">
                                    	<div>
                                    		<button id="novo" type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Novo</button>
                                    		<button id="save" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                                    		<div id='divHistoricoProntuarios' class="btn-group">
                                    	</div>	
									<div>
                                    	<?php 
                                    		MontaGrupos(null);
                                    	?>
                                    </div>
                                </div>
                             </div>
                         </div>
                     </div>
                                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->		
    </div>
    	</div>
    </div>
    <!-- /#wrapper -->
    
	<?php include("includes/footer.php"); ?>	
	<script>
		$(document).ready(function() {

			$("#novo").click(function() {
				$("#save").removeAttr("disabled");
				$("button[id*='btnPront']").attr("class", "btn btn-default");
				
				LimpaCampos();
			});			
			
			$("#save").click(function() {
// 				var contVazios = 0;
// 				$(':text','#divQuestionario').each(function(){
// 					if($(this).val() == "")
// 						contVazios++;
// 				});

// 				if(contVazios > 0){
// 					alert("Preencha todos os campos.");
// 					return;
// 				}	
				
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
								combo.attr('selected', true);
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
		});

		function LimpaProntuario() {
			$("#divHistoricoProntuarios").html("");
		}

		function LimpaCampos() {

			$("div[data-tipo='resposta'] input[type='text']").val("");
			
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
						console.log($("input:checked", $(this)).val());
						objRespostas['Valor'] = $("input:checked", $(this)).val();
					}
					else{
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
// 					else if(tipoPergunta == "ind_Pergunta_ComboBox"){
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
	</script>
</body>
</html>