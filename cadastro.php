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
			MontaPerguntas($listaGrupos[$i]['Cod_Grupo']);
			echo '</div>';
			MontaGrupos($listaGrupos[$i]['Cod_Grupo']);
		}
		 
		return $listaGrupos;
	}
	
	function MontaPerguntas($codGrupo){
		global $Prontuario;
		
		$listaPerguntas = $Prontuario->getPerguntas($codGrupo);
			
		for($i=0; $i < sizeof($listaPerguntas); $i++)
		{
			echo '<div id='. $listaPerguntas[$i]['Cod_Pergunta'] .'>';
			echo '</br>';
			echo '<div>';
			echo $listaPerguntas[$i]['Des_Pergunta'];
			echo '</div>';
			echo '</br>';
			
			if($listaPerguntas[$i]['Ind_Pergunta_Aberta']){
				echo '<input id="" class="form-control">';
				echo '</br>';
			}
			else if($listaPerguntas[$i]['Ind_Pergunta_SimNao']){
				echo '<div class="col-md-3">
                	<div class="btn-group btn-toggle text-right" data-toggle="buttons">
                    	<label class="btn btn-primary active">
                        	<input name="options" value="option1" type="radio" checked="checked">Sim
                        </label>
                        <label class="btn btn-default">
                        	<input name="options" value="option2" type="radio">Não
                        </label>
                    </div>
                </div>';
				echo '</br>';
			}
			else if($listaPerguntas[$i]['Ind_Pergunta_Qual']){
				echo '<input id="" class="form-control">';
				echo '</br>';
			}
			else if($listaPerguntas[$i]['Ind_Pergunta_Quando']){
				echo '<input id="" class="form-control">';
				echo '</br>';
			}
			else if($listaPerguntas[$i]['Ind_Pergunta_Outros']){
				echo '<input id="" class="form-control">';
				echo '</br>';
			}
			else if($listaPerguntas[$i]['Ind_Pergunta_Cite']){
				echo '<input id="" class="form-control">';
				echo '</br>';
			}
			else if($listaPerguntas[$i]['Ind_Pergunta_Observacao']){
				echo '<input id="" class="form-control">';
				echo '</br>';
			}
			else if($listaPerguntas[$i]['ind_Pergunta_ComboBox']){
				echo '<select name="sexo">
				<option>Fem</option>
				<option>Masc</option>
				</select>';
				echo '</br>';
			}
			else if($listaPerguntas[$i]['Ind_Pergunta_Radio']){
				echo '<input type="radio" id="" value="true" class="form-control" >';
				echo '<input type="radio" id="" value="false" class="form-control" >';
				echo '</br>';
			}
			else if($listaPerguntas[$i]['Ind_Pergunta_CheckBox']){
				echo '<input type="checkbox" name="testeB[]" value="a" id="aA" class="form-control" >';
				echo '</br>';
			}
			echo '</div>';
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
                        <div class="panel-heading">
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
                        <div class="panel-heading">
                            Dados Cadastrais
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                        <div class="form-group col-md-2">
                                            <label>Código</label>
                                            <input id="codCliente" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Nome</label>
                                            <input id="nomCliente" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Telefone</label>
                                            <input id="telCliente" class="form-control">
                                        </div>								
										 <div class="form-group col-md-4">
                                            <label>Cor</label>
                                            <input id="corCliente" class="form-control">
                                        </div>	
                                         <div class="form-group col-md-4">
                                            <label>Escolaridade</label>
                                            <input id="escolaridadeCliente" class="form-control">
                                        </div>	
                                         <div class="form-group col-md-4">
                                            <label>Ocupação</label>
                                            <input id="ocupacaoCliente" class="form-control">
                                        </div>	
                                        <div class="form-group col-md-4">
                                            <label>Estado Civil</label>
                                            <input id="estadoCivilCliente" class="form-control">
                                        </div>	
                                         <div class="form-group col-md-4">
                                            <label>Naturalidade</label>
                                            <input id="naturalidadeCliente" class="form-control">
                                        </div>	
                                        <div class="form-group col-md-4">
                                            <label>Sexo</label>
                                            <input id="sexoCliente" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Data de Nascimento</label>
                                            <input id="dataNascimentoCliente" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Número de Filhos</label>
                                            <input id="numeroFilhosCliente" class="form-control">
                                        </div>	
                                        <div class="form-group col-md-4">
                                            <label>Endereço</label>
                                            <input id="enderecoCliente" class="form-control">
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
						                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Histórico Prontuário
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="divQuestionario">
                                    	<div id='divHistoricoProntuarios'>
                                    		<button type="button">Novo</button>
                                    	</div>
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
    <!-- /#wrapper -->
    
	<?php include("includes/footer.php"); ?>	
	<script>
		$(document).ready(function() {

			$("#save").click(function() {
				var obj = [{"Cod_Pergunta":"1","Respostas":[{"TipoPergunta":"Ind_Pergunta_SimNao","Valor":"1"}]},{"Cod_Pergunta":"2","Respostas":[{"TipoPergunta":"Ind_Pergunta_SimNao","Valor":"0"}]},{"Cod_Pergunta":"1000","Respostas":[{"TipoPergunta":"Ind_Pergunta_CheckBox","Valor":[2,3]}]}];
		
				$.post( "ajax/prontuario.ajax.php", { listaRespostas: JSON.stringify(obj) }, function(data) {
					var retorno = jQuery.parseJSON(data);

					if(retorno.Sucesso) {
						$('#alert .text').append(retorno.Mensagem);
						$('#alert').addClass("alert-success");
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
					
					if(ui.item) {
						$.ajax({
							url: "ajax/cliente.ajax.php?codigo=" + ui.item.codigo,
							success: function (data) {
								console.log(data);
								var cliente = jQuery.parseJSON(data);
								console.log(cliente);
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
									
								if(cliente.prontuario.length != 0){
									for(var i=0; i < cliente.prontuario.length; i++){
										var divButton = ("<button type='button' name='btnPront" + cliente.prontuario[i].NumProntuario + "'>" + cliente.prontuario[i].DtaProntuario);
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
            
		});
	</script>
</body>
</html>
