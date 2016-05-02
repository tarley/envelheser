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
				echo '<label>Observa√ß√£o:</label>';
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
                                            <label>CÛdigo</label>
                                            <input id="codCliente" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Nome</label>
                                            <input id="nomCliente" class="form-control" disabled>
                                        </div>
										<div class="form-group col-md-4">
                                            <label>EndereÁo</label>
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
                                            <label>OcupaÁ„o</label>
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
                            Hist√≥rico Prontu√°rio
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
							                <div id="divMontaProntruario" class="panel panel-default" style="display: none;">
							                <div class="panel-body">
							                            <div class="row">
							                                <div class="col-lg-12">	
																<div>
							                                    	<?php 
							                                    		MontaGrupos(null);
							                                    	?>
							                                    </div>
							                                </div>
							                             </div>
							                         </div>                                    
							                </div>	
<!-- 									<div> -->
                                    	<?php 
//                                     		MontaGrupos(null);
//                                     	?>
<!--                                     </div> -->
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
	<script src="js/cadastro.js"></script>
</body>
</html>