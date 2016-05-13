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
			echo '<label style="margin-bottom: 10;">' . $listaPerguntas[$i]['Des_Pergunta'] . '</label>';
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
			
			if($listaPerguntas[$i]['Ind_Pergunta_ComboBox']){
				echo '<div class="col-md-3 nopadding" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_ComboBox">';				
				
				$listaOpcoes = $Prontuario->getOpcoesCombo($listaPerguntas[$i]['Cod_Pergunta']);
				
				echo '<select class="form-control">';
				echo '<option value="">Selecione</option>';
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<option value="'.$listaOpcoes[$j]['Cod_Item_Combo'].'">'.$listaOpcoes[$j]['Des_Item_Combo'].'</option>';
				}
				echo '</select>';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Outros']){
				echo '<div id="divOutros" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Outros" class="form-horizontal">';
				echo '<label class="control-label col-md-1 nopadding">Outros:</label>';
				echo '<div class="col-md-3">
					  <input id="Ind_Pergunta_Outros" type="text" class="form-control">
					  </div>';
				echo '</div>';
			
			}
				
			if($listaPerguntas[$i]['Ind_Pergunta_Observacao']){
				echo '<div id="divObservacao" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Observacao">';
				echo '<label class="control-label col-md-1 nopadding">Observação:</label>';
				echo '<div class="col-md-5">
						<input id="Ind_Pergunta_Observacao" type="text" class="form-control">
						</div>';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Cite']){
				echo '<div id="divCite" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Cite" class="form-horizontal">';
				echo '<label class="control-label col-md-1 nopadding">Cite:</label>';
				echo '<div class="col-md-3">
					  <input id="Ind_Pergunta_Cite" type="text" class="form-control">
					  </div>';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Radio']){
				echo '<div class="col-md-9 nopadding" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Radio">';
				
				$listaOpcoes = $Prontuario->getOpcoesRadio($listaPerguntas[$i]['Cod_Pergunta']);
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<div class="col-md-6 nopadding">';
					echo '<label class="control-label col-md-2">' . $listaOpcoes[$j]['Des_Item_Radio'] . '</label>';
					echo '<input id="Ind_Pergunta_Radio[]" name="Ind_Pergunta_Radio[]" type="radio" value="'.$listaOpcoes[$j]['Cod_Item_Radio'].'" class="form-horizontal" >';
					echo '</div>';
				}
				
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_CheckBox']){
				
				echo '<div class="col-md-12 nopadding" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_CheckBox">';
				
				$listaOpcoes = $Prontuario->getOpcoesCheck($listaPerguntas[$i]['Cod_Pergunta']);
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<div class="col-md-12 nopadding">';
					echo '<label class="control-label col-md-2">' . $listaOpcoes[$j]['Des_Item_Check'] . '</label>';
					echo '<input id="Ind_Pergunta_CheckBox[]" type="checkbox" value="'.$listaOpcoes[$j]['Cod_Item_Check'].'"class="form-horizontal" >';
					echo '</div>';
				}
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Multi_Combo']){
			
				echo '<div data-multi="0">';
				echo '<div class="col-md-3" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Multi_Combo" style="padding-left: 0;">';
				
				$listaOpcoes = $Prontuario->getCategoriaMultiCombo($listaPerguntas[$i]['Cod_Pergunta']);
				
				echo '<select class="form-control">';
				echo '<option value="" >Selecione</option>';
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<option value="'.$listaOpcoes[$j]['Cod_Categoria_Combo'].'">'.$listaOpcoes[$j]['Des_Categoria'].'</option>';
				}
				echo '</select>';
				echo '</div>';
				
				echo '<div data-itens="0"></div>';
				
				echo '</div>';
				
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
                                    	<div style="padding-bottom: 10px">
                                    		<button id="novo" type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Novo</button>
                                    		<button id="save" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                                    		<div id='divHistoricoProntuarios' class="btn-group">
                                    		</div>
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
	                             	</div>
	                         	</div>
	                     	</div>                                    
	                	</div>
                
                	<!-- /.col-lg-12 -->
            		</div>
        		</div>
    		</div>
            <!-- /.row -->        				
    	</div>
		<!-- /#page-wrapper -->    		
    </div>
    <!-- /#wrapper -->    
	<?php include("includes/footer.php"); ?>	
	<script src="js/clienteEdit.js"></script>
</body>
</html>